<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class AssinafyService
{
    /**
     * Faz o download do documento assinado (certificated) da Assinafy
     * @param string $documentId
     * @param string $savePath Caminho local para salvar o PDF
     * @return bool
     */
    public function downloadSignedDocument(string $documentId, string $savePath): bool
    {
        try {
            // Garante que o diretório existe
            $dir = dirname($savePath);
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }
            // Endpoint para baixar o documento certificado
            $endpoint = "https://api.assinafy.com.br/v1/documents/{$documentId}/download/certificated";
            $response = $this->client->get($endpoint, [ 'sink' => $savePath ]);
            // Verifica se o arquivo foi salvo
            return file_exists($savePath);
        } catch (RequestException $e) {
            Log::error('AssinafyService - Erro ao baixar documento assinado: ' . $e->getMessage());
            return false;
        }
    }
    

    /**
     * Aguarda o status do documento ficar pronto para assinatura
     */
    

    protected Client $client;

    public function __construct(string $accountId, string $apiToken, string $baseUri)
    {
        // Certifique-se que o baseUri termina com barra e não inclui /accounts
        $baseUri = rtrim($baseUri, '/') . '/';
        $this->client = new Client([
            'base_uri' => $baseUri,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken,
                'X-Account-Id' => $accountId,
            ],
        ]);
    }

    /**
     * Envia o documento para a API do Assinafy e retorna o ID do documento.
     *
     * @param string $filePath
     * @return string|null
     */
    public function uploadDocument(string $filePath): ?string
    {
        try {
             // Verifica se o arquivo existe antes de tentar abrir
            // Garante que $filePath é relativo ao storage
            if (str_starts_with($filePath, storage_path())) {
                // Remove storage_path do início se vier absoluto
                $filePath = str_replace(storage_path() . DIRECTORY_SEPARATOR, '', $filePath);
            }
            $realPath = storage_path($filePath);
            Log::info("AssinafyService - Verificando arquivo: $realPath");
            if (!file_exists($realPath)) {
                Log::error("AssinafyService - Arquivo não encontrado: $realPath");
                return null;
            }

            $accountId = env('ASSINAFY_ACCOUNT_ID');
            $endpoint = "https://api.assinafy.com.br/v1/accounts/{$accountId}/documents";
            $response = $this->client->post($endpoint, [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen(storage_path($filePath), 'r'),
                        'filename' => basename($filePath),
                    ],
                ],
            ]);

            $body = json_decode($response->getBody()->getContents());
            Log::info('AssinafyService - Resposta upload:', [
                'status' => $response->getStatusCode(),
                'body' => $body
            ]);
            return $body->data->id ?? null;
        } catch (RequestException $e) {
            $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null;
            Log::error('AssinafyService - Erro ao fazer upload do documento: ' . $e->getMessage() . ' | Resposta: ' . $responseBody);
            return null;
        }
    }

    /**
     * Cria um pacote de assinatura e envia o convite para o signatário.
     *
     * @param string $documentId
     * @param string $signerName
     * @param string $signerEmail
     * @return object|null
     */
    public function createSignaturePackage(string $documentId, string $signerName, string $signerEmail): ?object
    {
        if (!$this->waitForDocumentReady($documentId)) {
            Log::error('AssinafyService - Documento não ficou pronto para assinatura após aguardar.');
            return null;
        }
        try {
            $accountId = env('ASSINAFY_ACCOUNT_ID');
            // 1. Buscar signatário pelo e-mail
            $listEndpoint = "https://api.assinafy.com.br/v1/accounts/{$accountId}/signers?search={$signerEmail}";
            try {
                $listResponse = $this->client->get($listEndpoint);
                $listBody = json_decode($listResponse->getBody()->getContents());
                $existingSigner = null;
                if (!empty($listBody->data)) {
                    foreach ($listBody->data as $signer) {
                        if (isset($signer->email) && strtolower($signer->email) === strtolower($signerEmail)) {
                            $existingSigner = $signer;
                            break;
                        }
                    }
                }
                if ($existingSigner) {
                    $signerId = $existingSigner->id;
                } else {
                    // Não existe, criar novo signatário
                    $signerPayload = [
                        'full_name' => $signerName,
                        'email' => $signerEmail,
                    ];
                    $signerEndpoint = "https://api.assinafy.com.br/v1/accounts/{$accountId}/signers";
                    $signerResponse = $this->client->post($signerEndpoint, [
                        'json' => $signerPayload
                    ]);
                    $signerBody = json_decode($signerResponse->getBody()->getContents());
                    $signerId = $signerBody->data->id ?? null;
                }
                if (!$signerId) {
                    Log::error('AssinafyService - Não foi possível obter o ID do signatário.');
                    return null;
                }
            } catch (RequestException $e) {
                $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null;
                Log::error('AssinafyService - Erro ao buscar/criar signatário: ' . $e->getMessage() . ' | Resposta: ' . $responseBody);
                return null;
            }

            // 2. Aguarda status do documento (já feito antes)
            // 3. Solicitar assinatura
            $assignmentPayload = [
                'method' => 'virtual',
                'signer_ids' => [$signerId],
            ];
            $assignmentEndpoint = "https://api.assinafy.com.br/v1/documents/{$documentId}/assignments";
            $assignmentResponse = $this->client->post($assignmentEndpoint, [
                'json' => $assignmentPayload
            ]);
            $assignmentBody = json_decode($assignmentResponse->getBody()->getContents());
            Log::info('AssinafyService - Resposta assignment:', [
                'status' => $assignmentResponse->getStatusCode(),
                'body' => $assignmentBody
            ]);
            return $assignmentBody ?? null;
        } catch (RequestException $e) {
            $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null;
            Log::error('AssinafyService - Erro ao criar assignment: ' . $e->getMessage() . ' | Resposta: ' . $responseBody);
            return null;
        }
    }
    /**
     * Aguarda o status do documento ficar pronto para assinatura
     */
    private function waitForDocumentReady($documentId, $maxTries = 10, $interval = 3): bool
    {
        $endpoint = "https://api.assinafy.com.br/v1/documents/{$documentId}";
        for ($i = 0; $i < $maxTries; $i++) {
            try {
                $response = $this->client->get($endpoint);
                $body = json_decode($response->getBody()->getContents());
                $status = $body->data->status ?? null;
                Log::info("AssinafyService - Status documento: {$status}");
                if (in_array($status, ['uploaded', 'metadata_ready', 'pending_signature'])) {
                    return true;
                }
            } catch (RequestException $e) {
                Log::error('AssinafyService - Erro ao consultar status do documento: ' . $e->getMessage());
            }
            sleep($interval);
        }
        return false;
    }
}


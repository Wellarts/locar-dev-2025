<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Locacao;
use App\Services\AssinafyService;
use Illuminate\Support\Facades\Log;

class VerificaAssinaturaDocumento extends Command
{
    protected $signature = 'documento:verificar-assinatura';
    protected $description = 'Verifica se o documento foi assinado na Assinafy e atualiza o status no banco de dados';

    public function handle()
    {
        $accountId = env('ASSINAFY_ACCOUNT_ID');
        $apiToken = env('ASSINAFY_API_TOKEN');
        $baseUri = env('BASE_URL');
        $assinafyService = new AssinafyService($accountId, $apiToken, $baseUri);

        // Busca locações com documento pendente
        $locacoes = Locacao::where('status_assinatura', '!=', 'signed')
            ->whereNotNull('document_id')
            ->get();

        foreach ($locacoes as $locacao) {
            try {
                // Consulta status do documento na Assinafy usando o ID salvo em document_id
                $endpoint = "https://api.assinafy.com.br/v1/documents/{$locacao->document_id}";
                Log::info("Consultando status do documento na Assinafy: {$locacao->document_id}");
                $client = new \GuzzleHttp\Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $apiToken,
                        'X-Account-Id' => $accountId,
                    ],
                ]);
                $response = $client->get($endpoint);
                $body = json_decode($response->getBody()->getContents());
                $status = $body->data->status ?? null;

                // Status de documento assinado conforme doc: 'certificated'
                if ($status === 'certificated') {
                    $locacao->status_assinatura = 'signed';
                    $locacao->save();
                    Log::info("Locacao {$locacao->id} atualizada para 'signed'.");
                    // Caminho local para salvar o PDF assinado
                    $savePath = storage_path('app/public/contratos_assinados/' . $locacao->id . '.pdf');
                    // Instancia o serviço Assinafy
                    $assinafyService = new \App\Services\AssinafyService($accountId, $apiToken, $baseUri);
                    $downloaded = $assinafyService->downloadSignedDocument($locacao->document_id, $savePath);
                    if ($downloaded) {
                        Log::info("Documento assinado baixado para: {$savePath}");
                    } else {
                        Log::error("Falha ao baixar documento assinado da locacao {$locacao->id}");
                    }
                }
            } catch (\Exception $e) {
                Log::error("Erro ao verificar assinatura do documento da locacao {$locacao->id}: " . $e->getMessage());
            }
        }
        $this->info('Verificação de assinatura concluída.');
    }
}

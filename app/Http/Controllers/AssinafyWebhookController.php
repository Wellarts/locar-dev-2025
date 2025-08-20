<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssinafyWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // 1. Valide a requisição (opcional, mas recomendado)
        // Verifique a documentação do Assinafy para o método de validação do webhook (ex: usando um header X-Assinafy-Signature)

        $payload = $request->json()->all();
        Log::info('Webhook Assinafy recebido.', ['payload' => $payload]);

        if (isset($payload['event'])) {
            switch ($payload['event']) {
                case 'package.signed':
                    $packageId = $payload['package']['id'];

                    $contrato = Locacao::where('assinafy_package_id', $packageId)->first();

                    if ($contrato) {
                        $contrato->status = 'assinado';
                        $contrato->save();
                        Log::info('Contrato ' . $contrato->id . ' atualizado para "assinado".');
                    }
                    break;

                // Você pode adicionar outros eventos, como 'package.expired' ou 'package.viewed'
            }
        }

        return response()->json(['status' => 'success']);
    }
}
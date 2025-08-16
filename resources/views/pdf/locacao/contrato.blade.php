<!DOCTYPE html>
<html>
<head>

<style>
    .retangulo {
        width: 100%;
        height: 2.5%;
        background-color: rgb(222, 225, 226);
        display: flex;
        align-items: center;
        text-align: center;
    }
    .texto {
        margin: auto;
        font-weight: bold;
        font-size: 16px;

    }
    .tabelas {
        border: 1px;
        border-style: solid;
        border-color: grey;
        width: 100%;
        border-collapse: collapse;
    }


    #ficha td {
    border: 1px solid rgb(160 160 160);
    padding: 0px 2px;
    }


    .tx {
        line-height:1.5;
        font-size: 15px;
    }

</style>

<style>
    .tela {
        width: 100%;
        height: 100px;
        border: 0px solid black;
        float: center;
        text-align: center;

    }
</style>

</head>
<body>

<table style="width: 100%">
  <tr>
    <td><img src="{{ asset('img/logo.png') }}" alt="Image" height="100" width="160"></td>
    <td> <p style="width: 100%; font-size:24px; font-weight: bold;" align="center">KLVIDAL LOCAÇÃO DE VEÍCULOS</p>
         <p style="font-size:16px;" align="center">Avenida Presidente Costa e Silva, 1460 - Helena Maria<br>
                                                            Osasco - SP - CEP: 06253-000 - Contato: (11) 97049-3745<br>
                                                            Email: klvidalocacaodeveiculos@gmail.com<br>
                                                            CNPJ: 41.110.090/0001-50
                                                           </p>
    </td>
  
</tr>
</table>
</table>
<div class="retangulo">
    <span class="texto">FICHA DE LOCAÇÃO</span>
</div>
<table>
</table>
<div class="retangulo">
<span class="texto">LOCATÁRIO</span>
</div>

<table class="tabelas" width="100%" id='ficha'>
<tr>
    <td colspan="2">
        <b class="tx">Nome:</b> {{$locacao->Cliente->nome}}</p>
    </td>
</tr>
<tr>
    <td colspan="2">
        <b class="tx">Endereço:</b>  {{$locacao->Cliente->endereco}}
    </td>
<tr>
    <td>
        <b class="tx">Cidade:</b> {{$locacao->Cliente->Cidade->nome}}
    </td>
    <td>
        <b class="tx">UF:</b> {{$locacao->Cliente->Estado->nome}}
    </td>
</tr>
<tr>
    <td>
        <b class="tx">Rg:</b> {{$locacao->Cliente->rg}}
    </td>
    <td>
        <b class="tx">Org Exp:</b> {{$locacao->Cliente->exp_rg}}
    </td>

</tr>
<tr>
    <td>
        <b class="tx">Telefones:</b>  {{$tel_1.' - '.$tel_2}}
    </td>
    <td>
        <b class="tx">CPF/CNPJ:</b> {{$cpfCnpj}}
    </td>
</tr>

</table>
</table>
<div class="retangulo">
<span class="texto">VEÍCULO</span>
</div>
<table class="tabelas" id='ficha'>
<tr>
    <td>
        <b class="tx">Marca:</b> {{$locacao->Veiculo->Marca->nome}}
    </td>
    <td>
        <b class="tx">Modelo:</b> {{$locacao->Veiculo->modelo}}
    </td>
    <td>
        <b class="tx">Chassi:</b> {{$locacao->Veiculo->chassi}}
    </td>
</tr>
<tr>
    <td>
        <b class="tx">Ano:</b>  {{$locacao->Veiculo->ano}}
    </td>
    <td>
        <b class="tx">Cor:</b>  {{$locacao->Veiculo->cor}}
    </td>
    <td>
        <b class="tx">Placa:</b>  {{$locacao->Veiculo->placa}}
    </td>
</tr>
</table>
<div class="retangulo">
<span class="texto">LOCAÇÃO</span>
</div>
<table class="tabelas" id='ficha'>
<tr>
    <td>
        <b class="tx">Data da Saída:</b> {{\Carbon\Carbon::parse($locacao->data_saida)->format('d/m/Y')}}
    </td>
    <td>
        <b class="tx">Hora da Saída:</b> {{$locacao->hora_saida}}
    </td>

    <td>
        <b class="tx">Data do Retorno:</b> {{\Carbon\Carbon::parse($locacao->data_retorno)->format('d/m/Y')}}
    </td>
    <td>
        <b class="tx">Hora do Retorno:</b> {{$locacao->hora_retorno}}
    </td>
</tr>
    <td>
        <b class="tx">Km de Saída:</b>  {{$locacao->km_saida}}
    </td>
    <td>
        @if($locacao->forma_locacao == 1)
            <b class="tx">Qtd de Diárias:</b> {{$locacao->qtd_diarias}}
        @elseif($locacao->forma_locacao == 2)
            <b class="tx">Qtd de Semanas:</b> {{$locacao->qtd_semanas}}
        @endif
    </td>
    <td colspan="2">
        @if($locacao->forma_locacao == 1)
            <b class="tx">Valor da Diária R$:</b> {{$locacao->Veiculo->valor_diaria}}
        @elseif($locacao->forma_locacao == 2)
            <b class="tx">Valor da Semana R$:</b> {{$locacao->Veiculo->valor_semana}}
        @endif
    </td>

</tr>
<tr>
    <td >
        <b class="tx">Km de Retorno:</b> {{$locacao->km_retorno}}
    </td>
    <td >
        <b class="tx">Valor do Desconto R$:</b> {{$locacao->valor_desconto}}
    </td>
    <td colspan="2">
        <b class="tx">Valor Total R$:</b> {{$locacao->valor_total_desconto}}
    </td>

</tr>

</table>

<table class="tabelas" id='ficha'>
<tr>
    <td>
        <b class="tx">Observações: </b> {{$locacao->obs}}
    </td>
</tr>
</table>


</div>
<div style="width: 100%; text-align: center; margin-top: 30px;">
    <p style="text-align: center;">Osasco - SP, {{ $dataAtual->isoFormat('DD MMMM YYYY') }}</p>
    <br>
    <div style="display: inline-block; text-align: center;">
        <div>
            _________________________________________<br>
            LOCADOR: KLVIDAL LOCAÇÃO DE VEÍCULOS.<br>
            <span style="font-size:10px;">Proprietário ou representante legal da Empresa</span>
        </div>
        <br><br>
        <div>
            _________________________________________<br>
            LOCATÁRIO: {{$locacao->Cliente->nome}}
        </div>
    </div>
</div>


<!-- PÁGINA 2 -->

<style>
    .break {
        page-break-before: always;
         }
    .parag {
        text-align: justify;
        font-size: 11;
    }
</style>

<div class="break">

<table style="width: 100%">
    <tr>
        <td><img src="{{ asset('img/logo.png') }}" alt="Image" height="100" width="160"></td>
      <td> <p style="width: 100%; font-size:20px; font-weight: bold" align="center">Contrato de Locação de Veículo</p>

      </td>
  </tr>
  </table>
</div>
<div>
    <p class="parag">
        Registro: <b>{{$locacao->id}}</b> 
    </p>

        
        
   <style>
        body {
            font-family: sans-serif;
            line-height: 1.5;
            margin: 20px;
        }
        h1, h2 {
            text-align: left;
        }
        .contract-header, .parties, .object, .signatures {
            margin-bottom: 20px;
        }
        .clause {
            margin-bottom: 15px;
        }
        .clause-title {
            font-weight: bold;
        }
        .signature-block {
            margin-top: 40px;
            text-align: center;
        }
        .signature-line {
            display: inline-block;
            width: 300px;
            border-top: 1px solid #000;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="parties">
        <p>
            <strong>LOCADOR:</strong> Klvidal Locação de Veículos, CNPJ: 41.110.090/0001-50, situado na Avenida Presidente Costa e Silva, 1460 Helena Maria, Osasco, e-mail: klvidalocacaodeveiculos@gmail.com.
        </p>
        <p>
            <strong>LOCATÁRIO:</strong> {{$locacao->Cliente->nome}}, com documento de identidade nº {{$locacao->Cliente->rg}}, inscrito no CPF/CNPJ: {{$cpfCnpj}}, Residente: {{$locacao->Cliente->endereco}}, {{$locacao->Cliente->Cidade->nome}} - {{$locacao->Cliente->Estado->nome}}, e-mail: {{$locacao->Cliente->email}}.
        </p>
        <p>
            Vêm, através do presente instrumento, celebrar CONTRATO DE LOCAÇÃO DE VEÍCULO AUTOMOTOR, que será regido pelas cláusulas e condições abaixo dispostas.
        </p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 1ª – DO OBJETO DO CONTRATO</h2>
        <p><strong>1.1.</strong> O objeto do presente contrato é a locação do seguinte veículo automotor:</p>
        <ul>
            <li><strong>Veículo:</strong> {{$locacao->Veiculo->Marca->nome}} / {{$locacao->Veiculo->modelo}}</li>
            <li><strong>Cor:</strong> {{$locacao->Veiculo->cor}}</li>
            <li><strong>Ano modelo:</strong> {{$locacao->Veiculo->ano}}</li>
            <li><strong>Placa:</strong> {{$locacao->Veiculo->placa}}</li>
            <li><strong>Renavam nº:</strong> {{$locacao->Veiculo->renavam}}</li>
        </ul>
        <p><strong>1.2.</strong> O automóvel será utilizado apenas na cidade de São Paulo, não sendo permitido rodar no interior, litoral e em outro estado.</p>
        <p><strong>1.3.</strong> O uso do veículo é exclusivo do LOCATÁRIO, não sendo permitido sub-rogar os direitos a terceiros ou permitir que outra pessoa conduza o veículo sem autorização expressa do LOCADOR.</p>
        <p><strong>1.3.1.</strong> O descumprimento do item 1.3 resultará em rescisão contratual, multa de R$ 1.000,00 e responsabilização total por qualquer dano ao veículo.</p>
        <p><strong>1.4.</strong> Ocorrendo a utilização do veículo por terceiros com a concordância do LOCATÁRIO, este se responsabilizará por qualquer ação civil ou criminal, isentando o LOCADOR de qualquer responsabilidade.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 2ª – DAS OBRIGAÇÕES DAS PARTES</h2>
        <p><strong>2.1. OBRIGAÇÕES DO LOCADOR:</strong></p>
        <p><strong>2.1.1.</strong> Manter o Seguro contratado para o veículo.</p>
        <p><strong>2.1.2.</strong> Realizar o pagamento do IPVA e do Seguro do veículo.</p>
        <p><strong>2.1.3.</strong> Assegurar que a documentação do veículo (licenciamento, seguro obrigatório, inspeções) esteja regularizada e válida.</p>
        <p><strong>2.1.4.</strong> Fornecer suporte em caso de problemas mecânicos não decorrentes de uso inadequado pelo LOCATÁRIO.</p>
        <p><strong>2.1.5.</strong> O LOCADOR não tem a obrigação de fornecer veículo reserva.</p>
        
        <p><strong>2.2. OBRIGAÇÕES DO LOCATÁRIO:</strong></p>
        <p><strong>2.2.1.</strong> Utilizar o veículo de acordo com a legislação, zelando por sua conservação.</p>
        <p><strong>2.2.2.</strong> O veículo permanecerá em sua posse integral, de segunda a domingo.</p>
        <p><strong>2.2.3.</strong> Pagar por quaisquer multas de trânsito ocorridas durante a vigência do contrato.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 3ª – DAS VISTORIAS</h2>
        <p><strong>3.1. Vistoria Antes da Retirada:</strong></p>
        <p><strong>3.1.1.</strong> No momento da retirada, será realizada uma vistoria conjunta para registrar as condições gerais do veículo.</p>
        <p><strong>3.1.2.</strong> A vistoria abrangerá lataria, pneus, sistemas essenciais, limpeza e acessórios.</p>
        <p><strong>3.1.3.</strong> O LOCATÁRIO deverá informar imediatamente qualquer irregularidade, que constará no Termo de Vistoria assinado pelas partes.</p>
        <p><strong>3.1.4.</strong> A vistoria será documentada por fotos enviadas ao e-mail do LOCATÁRIO.</p>
        
        <p><strong>3.2. Vistoria Mensal:</strong></p>
        <p><strong>3.2.1.</strong> O veículo será vistoriado mensalmente para verificar seu estado de conservação.</p>
        <p><strong>3.2.2.</strong> O LOCATÁRIO compromete-se a levar o veículo limpo à oficina credenciada para a vistoria.</p>
        <p><strong>3.2.3.</strong> Caso sejam identificados pequenos danos, o LOCATÁRIO será responsável por repará-los em até 15 dias.</p>
        <p><strong>3.2.4.</strong> Se o reparo imediato não for possível, o LOCATÁRIO deverá efetuar um depósito adicional semanal para cobrir as despesas.</p>
        
        <p><strong>3.3. Vistoria na Devolução:</strong></p>
        <p><strong>3.3.1.</strong> O veículo será novamente vistoriado na devolução para comparar com o relatório inicial.</p>
        <p><strong>3.3.2.</strong> O LOCATÁRIO compromete-se a devolver o veículo nas mesmas condições em que o recebeu e limpo para a avaliação.</p>
        <p><strong>3.3.3.</strong> Caso sejam constatados danos, o LOCATÁRIO será responsabilizado pelos custos de reparo.</p>
        
        <p><strong>3.4.</strong> O LOCATÁRIO declara estar ciente das vistorias e assume total responsabilidade pela conservação do veículo.</p>
        <p><strong>3.5.</strong> O não comparecimento à vistoria agendada sujeita o LOCATÁRIO ao encerramento do contrato.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 4ª – DA MANUTENÇÃO</h2>
        <p><strong>4.1. Manutenção Preventiva (Responsabilidade do LOCADOR):</strong></p>
        <p><strong>4.1.1.</strong> A manutenção preventiva será realizada exclusivamente pela oficina credenciada Didi Mecânica. Qualquer outro reparo deve ser autorizado expressamente por Waldir Mendes.</p>
        <p><strong>4.1.2.</strong> Itens cobertos pelo LOCADOR:</p>
        <ul>
            <li>Troca de Pneus (por desgaste natural).</li>
            <li>Vela e cabo de vela (a cada 5 meses).</li>
            <li>Bobina (quando apresentar falhas).</li>
            <li>Correia dentada/comando (a cada 30.000 KM).</li>
            <li>Pastilhas (entre 15.000 e 20.000 KM).</li>
            <li>Alinhamento e balanceamento.</li>
        </ul>
        <p><strong>4.1.3.</strong> Se alguma manutenção do item 4.1.2 for necessária antes do prazo, sem ser por mau uso, será custeada pelo LOCADOR.</p>

        <p><strong>4.2. Manutenção Preventiva (Responsabilidade do LOCATÁRIO):</strong></p>
        <p><strong>4.2.1.</strong> O LOCATÁRIO é exclusivamente responsável pela troca de óleo e filtro do motor a cada 10.000 km.</p>
        <p><strong>4.2.2.</strong> O não cumprimento da obrigação do item 4.2.1 responsabilizará o LOCATÁRIO por todos os danos e custos decorrentes.</p>
        <p><strong>4.2.3.</strong> O LOCATÁRIO é responsável pela manutenção de itens de desgaste por uso regular, como lâmpadas, palhetas, estofados, e outros acessórios.</p>
        <p><strong>4.2.4.</strong> Peças danificadas por má utilização do veículo são de responsabilidade do LOCATÁRIO.</p>
        <p><strong>4.2.5.</strong> Gastos decorrentes do uso de combustível adulterado serão arcados pelo LOCATÁRIO.</p>
        
        <p><strong>4.3. Monitoramento pelo LOCATÁRIO:</strong></p>
        <p><strong>4.3.1.</strong> O LOCATÁRIO deve monitorar e repor os níveis de água e óleo, assumindo os custos de reparo por danos decorrentes da falta desses fluidos.</p>
        <p><strong>4.3.2.</strong> Deverá enviar fotos dos níveis de água e óleo todo domingo via WhatsApp ao LOCADOR.</p>
        <p><strong>4.3.3.</strong> É responsabilidade do LOCATÁRIO monitorar o painel e indicadores de anomalias. Caso identifique um problema e continue a dirigir, assume integralmente os riscos. Em caso de anomalia, deve parar o veículo e contatar o LOCADOR imediatamente.</p>

        <p><strong>4.4. Prazos e Procedimentos de Manutenção:</strong></p>
        <p><strong>4.4.1.</strong> O LOCADOR realizará as manutenções em no máximo 6 horas, sem prejuízo na diária.</p>
        <p><strong>4.4.2.</strong> Se a manutenção ultrapassar 6 horas, o LOCADOR poderá abonar a diária ou rescindir o contrato com devolução da caução.</p>
        <p><strong>4.4.3.</strong> Em caso de quebra ou defeito, o LOCATÁRIO deve informar o LOCADOR em até 24 horas e apresentar o veículo para reparos.</p>
        <p><strong>4.4.4.</strong> É vedado ao LOCATÁRIO efetuar qualquer reparo sem a prévia anuência do LOCADOR, sob pena de não ser reembolsado.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 5ª – DAS MULTAS E INFRAÇÕES</h2>
        <p><strong>5.1.</strong> O pagamento das multas deve ser feito pelo LOCATÁRIO imediatamente após a constatação no sistema do DETRAN.</p>
        <p><strong>5.2.</strong> O LOCADOR indicará o LOCATÁRIO como condutor infrator, que terá legitimidade para se defender perante o órgão autuador.</p>
        <p><strong>5.3.</strong> Questionamentos sobre a procedência das multas devem ser feitos pelo LOCATÁRIO diretamente ao órgão autuador.</p>
        <p><strong>5.4.</strong> Se o recurso for vitorioso, o LOCADOR fornecerá a guia de pagamento para que o LOCATÁRIO solicite o reembolso.</p>
        <p><strong>5.5.</strong> O LOCATÁRIO deverá comparecer para assinar a transferência de pontos. A perda do prazo para transferência acarretará multa de R$ 400,00.</p>
        <p><strong>5.6.</strong> Na retirada do veículo, é obrigatório o aceite na carteira digital de trânsito indicando o LOCATÁRIO como principal condutor.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 6ª – DA UTILIZAÇÃO DO VEÍCULO</h2>
        <p><strong>6.1.</strong> O veículo deve ser utilizado exclusivamente para fins profissionais  e de acordo com as normas de trânsito.</p>
        <p><strong>6.2.</strong> A CNH do locatário deverá conter a anotação "Exerce Atividade Remunerada" (EAR).</p>
        <p><strong>6.3.</strong> A utilização inadequada pode levar à rescisão do contrato e recolhimento do veículo.</p>
        <p><strong>6.4.</strong> Qualquer modificação no veículo só pode ser feita com autorização expressa do LOCADOR.</p>
        <p><strong>6.5.</strong> O LOCATÁRIO é responsável por quaisquer danos materiais ou pessoais decorrentes da má utilização do veículo.</p>
        <p><strong>6.6.</strong> Em caso de reboque por estacionamento irregular, o LOCATÁRIO arcará com todos os custos de recuperação e uma multa de R$ 70,00 por dia em que o carro estiver no depósito.</p>
        <p><strong>6.7.</strong> O LOCATÁRIO compromete-se a guardar o veículo em garagem ou estacionamento quando não estiver em uso.</p>
        <p><strong>6.8.</strong> É vedado sair do Estado de São Paulo sem autorização por escrito do LOCADOR, sob pena de multa de R$ 300,00.</p>
        <p><strong>6.9.</strong> O LOCATÁRIO se responsabiliza por todos os acessórios do veículo (chave, documento, step, etc.) e arcará com os custos de reposição em caso de perda ou dano.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 7ª – DOS SINISTROS (ACIDENTES, ROUBO E FURTO)</h2>
        <p><strong>7.1.</strong> Em caso de qualquer evento (acidente, etc.), o LOCATÁRIO é responsável por preservar o veículo e se compromete a:</p>
        <ul>
            <li><strong>7.1.1.</strong> Informar imediatamente o LOCADOR sobre o ocorrido com todos os detalhes.</li>
            <li><strong>7.1.2.</strong> Registrar Boletim de Ocorrência, quando aplicável, e enviar cópia ao LOCADOR em até 24 horas.</li>
            <li><strong>7.1.3.</strong> Acionar a autoridade policial, se necessário.</li>
            <li><strong>7.1.4.</strong> Cooperar com o LOCADOR e/ou seguradora na apuração dos fatos.</li>
            <li><strong>7.1.5.</strong> Não realizar reparos sem autorização prévia e por escrito do LOCADOR.</li>
            <li><strong>7.1.6.</strong> Pagar taxas de liberação do veículo em caso de reboque pelo Poder Público.</li>
        </ul>
        <p><strong>7.2.</strong> O pagamento semanal não será abonado em caso de qualquer evento com o veículo.</p>
        <p><strong>7.3.</strong> Após um evento, o LOCATÁRIO poderá optar por acionar o seguro ou realizar o conserto particular, informando sua decisão em até 48 horas e arcando com todos os custos. O conserto deve ser feito em até 15 dias.</p>
        <p><strong>7.4.</strong> Em caso de <strong>roubo ou furto</strong>:</p>
        <p><strong>7.4.1.</strong> Se o veículo <strong>NÃO FOR LOCALIZADO</strong> em 45 dias, o LOCATÁRIO pagará R$ 1.000,00 referente a despesas de rastreador e documentação.</p>
        <p><strong>7.4.2.</strong> Se o veículo <strong>FOR LOCALIZADO</strong> com avarias ou sem peças, o LOCATÁRIO é responsável por pagar todas as despesas não cobertas pelo seguro.</p>
        <p><strong>7.5.</strong> A responsabilidade do LOCATÁRIO permanece mesmo que ele não esteja no interior do veículo no momento do ocorrido.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 8ª – DO SEGURO E SUAS COBERTURAS</h2>
        <p><strong>8.1.</strong> O LOCADOR disponibiliza um seguro para o veículo. O LOCATÁRIO é responsável por quaisquer danos não cobertos pela apólice.</p>
        <p><strong>8.2. Coberturas Inclusas:</strong></p>
        <ul>
            <li>Colisão.</li>
            <li>Roubo e furto qualificado.</li>
            <li>Perda total.</li>
            <li>Fenômenos da natureza (exceto chuva de granizo e água do mar).</li>
            <li>Danos a terceiros até R$ 50.000,00.</li>
            <li>Reboque até 200km.</li>
        </ul>
        <p><strong>8.3. Principais Exclusões (Sem Cobertura):</strong></p>
        <ul>
            <li>Danos por chuva de granizo ou água do mar.</li>
            <li>Danos por alagamentos onde o condutor assumiu o risco.</li>
            <li>Condutor sob efeito de álcool ou drogas.</li>
            <li>Danos por participação em competições ou rachas.</li>
            <li>Danos causados por motorista não autorizado.</li>
            <li>Danos internos e externos que não sejam de colisão.</li>
        </ul>
         <p><strong>8.3.1.</strong> A lista de exclusões não é exaustiva. O LOCATÁRIO pode solicitar uma cópia das condições gerais da apólice.</p>
        <p><strong>8.4. Franquia:</strong></p>
        <p><strong>8.4.1.</strong> Em caso de sinistro, a franquia do seguro é de <strong>6% do valor de mercado do veículo</strong> (Tabela Fipe), e seu pagamento é de responsabilidade integral do LOCATÁRIO.</p>
        <p><strong>8.5.</strong> É vedado ao LOCATÁRIO acionar o seguro sem permissão expressa do LOCADOR, sob pena de multa de R$ 200,00.</p>
        <p><strong>8.6.</strong> Se o sinistro ocorrer com o LOCATÁRIO sob efeito de álcool/drogas, ou se ele se recusar a fazer o teste do bafômetro, e o seguro negar a indenização, ele deverá arcar com o valor total do veículo (Tabela FIPE).</p>
        <p><strong>8.7.</strong> O LOCADOR pode alterar a empresa de seguros a qualquer tempo, sem aviso prévio, o que não altera as responsabilidades do LOCATÁRIO.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 9ª – DO PAGAMENTO E REAJUSTE</h2>
        <p><strong>9.1. Pagamento Semanal:</strong></p>
        <p><strong>9.1.1.</strong> O LOCATÁRIO pagará ao LOCADOR o valor de <strong>R$ {{ number_format($locacao->Veiculo->valor_semana, 2, ',', '.') }} reais</strong> toda 
        <b>{{ \Carbon\Carbon::parse($locacao->data_saida)->isoFormat('dddd') }}</b>, via PIX CNPJ: 41.110.090/0001-50 Banco Itaú Empresas em nome de Klvidal Locação de Veículos LTDA</p>
        <p><strong>9.1.2.</strong> Em caso de atraso, será cobrado um adicional de R$ 30,00 por dia, ou o LOCADOR poderá solicitar a devolução do veículo.</p>
        <p><strong>9.1.3.</strong> O comprovante de pagamento deve ser enviado até as 00:00 do dia do vencimento.</p>
        <p><strong>9.1.4.</strong> Um atraso superior a 15 dias pode resultar na rescisão do contrato, inscrição no SPC/Serasa e medidas judiciais como Busca e Apreensão, com o LOCATÁRIO arcando com todas as despesas.</p>
        <p><strong>9.1.5.</strong> O veículo poderá ser bloqueado a qualquer momento se algo estiver em desacordo com o contrato.</p>

        <p><strong>9.2. Reajuste do Aluguel:</strong></p>
        <p><strong>9.2.1.</strong> Poderá haver um reajuste semestral de 5% no valor do aluguel, podendo o LOCATÁRIO aceitar ou devolver o veículo.</p>
        <p><strong>9.2.2.</strong> Haverá também um reajuste anual com base na variação do IPCA.</p>
        <p><strong>9.2.3.</strong> O LOCADOR pode aplicar uma revisão extraordinária dos valores caso haja alteração significativa nos custos operacionais, mediante aviso prévio de 30 dias.</p>
        <p><strong>9.2.4.</strong> O LOCATÁRIO será informado dos novos valores por meio eletrônico e, caso não concorde, o contrato poderá ser rescindido.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 10ª – DA CAUÇÃO</h2>
        <p><strong>10.1.</strong> Fica estabelecida a quantia caução no valor de <strong>R$ {{ number_format($locacao->valor_caucao, 2, ',', '.') }}</strong>.</p>
        <p><strong>10.2.</strong> A caução será restituída integralmente em até 30 dias corridos após a devolução do veículo, desde que:</p>
        <ul>
            <li>O veículo seja devolvido em perfeito estado, conforme a vistoria inicial.</li>
            <li>Não existam débitos de aluguéis, multas de trânsito ou contratuais.</li>
            <li>O veículo seja devolvido limpo (interno e externo).</li>
            <li>Outros débitos pendentes sejam descontados.</li>
        </ul>
        <p><strong>10.3.</strong> Caso as condições acima não sejam atendidas, o LOCADOR poderá usar a caução para cobrir os débitos ou reparar danos.</p>
        <p><strong>10.4.</strong> O veículo deve ser devolvido com a mesma quantidade de combustível da entrega, sob pena de desconto do valor na caução.</p>
        <p><strong>10.5.</strong> Se o carro for devolvido sujo, será cobrada a lavagem.</p>
        <p><strong>10.6.</strong> Se os documentos do carro ou GNV não forem devolvidos, serão cobradas as despesas para a 2ª via e uma indenização pela indisponibilidade do carro.</p>
    </div>
    
    <div class="clause">
        <h2>CLÁUSULA 11ª – DA EXCLUSIVIDADE E INEXISTÊNCIA DE VÍNCULO TRABALHISTA</h2>
        <p><strong>11.1.</strong> A locação é pessoal e intransferível, sendo vedado ceder, transferir ou sublocar o veículo. A infração pode levar à rescisão imediata do contrato.</p>
        <p><strong>11.2.</strong> As partes concordam que não existe qualquer vínculo trabalhista entre LOCADOR e LOCATÁRIO.</p>
        <p><strong>11.3.</strong> O contrato não gera obrigações previdenciárias ou trabalhistas, não havendo subordinação, pessoalidade ou habitualidade.</p>
        <p><strong>11.4.</strong> O LOCATÁRIO assume total responsabilidade por contratos de trabalho com terceiros e se compromete a indenizar o LOCADOR por quaisquer reclamações trabalhistas.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 12ª – DA VIGÊNCIA E RESCISÃO</h2>
        <p><strong>12.1. Vigência:</strong></p>
        <p><strong>12.1.1.</strong> O contrato tem vigência a partir de <b>{{\Carbon\Carbon::parse($locacao->data_saida)->format('d/m/Y')}}</b>, com prazo mínimo de 90 dias, renovando-se automaticamente após este período.</p>
        <p><strong>12.1.2.</strong> Após 90 dias, qualquer uma das partes pode rescindir o contrato a qualquer tempo, mediante comunicação à outra parte.</p>

        <p><strong>12.2. Rescisão Antecipada:</strong></p>
        <p><strong>12.2.1.</strong> Se o LOCATÁRIO devolver o veículo antes de 90 dias, pagará multa de R$ 1.200,00.</p>
        <p><strong>12.2.2.</strong> O LOCADOR não poderá solicitar o veículo antes de 90 dias, salvo por irregularidade do LOCATÁRIO, sob pena de multa.</p>

        <p><strong>12.3. Rescisão Automática pelo LOCADOR:</strong></p>
        <p><strong>12.3.1.</strong> O contrato será rescindido automaticamente, com a retomada do carro, sem direito a indenização para o LOCATÁRIO, nos seguintes casos:</p>
        <ul>
            <li>Não devolução do carro na data e local ajustados.</li>
            <li>Acidente ou dano causado por dolo ou culpa do LOCATÁRIO.</li>
            <li>Uso inadequado do carro.</li>
            <li>Apreensão do carro por autoridades.</li>
            <li>Não quitação de débitos nos vencimentos.</li>
        </ul>
        <p><strong>12.3.2.</strong> Qualquer pendência financeira não quitada no prazo estabelecido resultará na rescisão automática e na obrigação de entrega imediata do veículo, sob pena de multa diária de R$ 150,00.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 13ª – DA VALIDAÇÃO DO CONTRATO</h2>
        <p><strong>13.1.</strong> O contrato será válido após o cumprimento das seguintes condições:</p>
        <p><strong>13.1.1. Assinatura Digital:</strong> O LOCATÁRIO deverá assinar digitalmente o contrato por meio da plataforma indicada pelo LOCADOR. Esta assinatura tem a mesma validade jurídica da manuscrita.</p>
        <p><strong>13.1.2. Assinatura Manual:</strong> O LOCATÁRIO deverá assinar manualmente o Termo de Vistoria de Retirada do Veículo.</p>
        <p><strong>13.2.</strong> A locação só será efetivada após a assinatura digital do contrato e a assinatura manual do Termo de Vistoria.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 14ª – DA DEVOLUÇÃO DO VEÍCULO</h2>
        <p><strong>14.1.</strong> Após o término do contrato, o veículo deve ser devolvido no local indicado pelo LOCADOR, sob pena de multa de R$ 200,00 por dia de atraso.</p>
        <p><strong>14.2.</strong> A não devolução do veículo após notificação por escrito configura crime de <strong>APROPRIAÇÃO INDÉBITA</strong> (Art. 168 do Código Penal), sujeito a pena de reclusão e multa.</p>
    </div>

    <div class="clause">
        <h2>CLÁUSULA 15ª - DAS NOTIFICAÇÕES</h2>
        <p><strong>15.1.</strong> Quaisquer notificações e comunicações devem ser registradas por e-mail, correspondência ou WhatsApp.</p>
        <p><strong>15.2.</strong> As partes se obrigam a informar qualquer alteração de endereço ou contato.</p>
    </div>

    <p>E, por estarem assim, justas e contratadas, as PARTES firmam o presente instrumento em 02 (duas) vias de igual teor e forma, para que produza seus efeitos legais, e após ter lido e seu conteúdo ter sido claramente entendido e aceito.</p>
<br><br>
    <div style="text-align: center; font-size: 12">Osasco, {{ $dataAtual->isoFormat('DD MMMM YYYY') }}<br><br><br><br>

            ___________________________________________________________<br>
            LOCATÁRIO: {{$locacao->Cliente->nome}}<br>
            <b>CPF:</b> {{$cpfCnpj}}<br><br><br>

            ___________________________________________________________<br>
            LOCADOR: Klvidal Locação de Veículos <br>
            <b>CNPJ:</b> 41.110.090/0001-50<br><br><br>

            @if(!empty($locacao->testemunha_1))
                        ___________________________________________________________<br>            
                        TESTEMUNHA: {{$locacao->testemunha_1}} <br>
                        <b>RG: {{$locacao->testemunha_1_rg}}</b> <Br><br><br>
            @endif

            @if(!empty($locacao->testemunha_2))
                    __________________________________________________________<br>            
                    TESTEMUNHA: {{$locacao->testemunha_2}} <br>
                    <b>RG: {{$locacao->testemunha_2_rg}}</b> <br><br><br>
            @endif
        </div>
</body>
</body>
</html>

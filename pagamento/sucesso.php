<?php
require_once('../util/valida.php');
$valida = new Valida();
$valida->verificaPermissao();

require_once('congressistaController.php');
$controller = new congressistaController();


    if(!isset($_SESSION)){
        session_start(); //Iniciando Sessão
    }

    if(!isset($_POST['token'])){
        header("Location: index.php");
    }

    //exit();
    $creditCardToken = htmlspecialchars($_POST["token"]);
    $senderHash      = htmlspecialchars($_POST["senderHash"]);
    $qntdParcelas    = htmlspecialchars($_POST["installmentQuantity"]);



    $valorParcelas   = $_SESSION['installments'][$qntdParcelas];

    if(isset($creditCard) && isset($senderHash)){

    }
    else
    {
        //exit();
    }
    //Salva de quem é o cartão
    $cardProp = htmlspecialchars($_POST["cardProp"]);       

    //Obter informações relevantes do user
    require_once('congressistaModel.php');

    $id = $_SESSION['id'];
    $congressista   = new congressistaModel();

    $dadosPessoais  = $congressista->getDadosPessoais($id);

    $usuEmail   = $dadosPessoais['email'];
    //$usuEmail = 'c'.$id.'@sandbox.pagseguro.com.br';
    //var_dump($dadosPessoais);
    $usuName    = strtoupper($dadosPessoais['nome']);
    $usuCPF     = $dadosPessoais['cpf'];
    $usuDate    = $dadosPessoais['data_nascimento'];
    $usuCel     = $dadosPessoais['celular'];
    $usuTel     = $dadosPessoais['telefone'];
    $usuCep     = $dadosPessoais['cep'];
    $usuBairro  = $dadosPessoais['bairro'];
    $usuRua     = $dadosPessoais['rua'];
    $usuRuaNum  = $dadosPessoais['numero'];
    $usuCompl   = $dadosPessoais['complemento'];
    $usuCidade  = $dadosPessoais['cidade'];
    $usuEst     = $dadosPessoais['estado'];
    $usuInscTip = $dadosPessoais['tipo_inscricao'];

    //Formatação dados do congressista
    $usuCel     = str_replace('(', '-' , $usuCel);
    $usuCel     = str_replace(')', '-' , $usuCel);
    $usuCel     = str_replace(' ', '-' , $usuCel);
    $usuCel     = explode('-',$usuCel);

    $usuCPF     = str_replace('-', '', $usuCPF);
    $usuCPF     = str_replace('.', '',$usuCPF);

    $usuCep     = str_replace('-', '',$usuCep);


    //Pega o codigo de área
    $usuCelCode = $usuCel[1];



    function formataData($data){
        $dia = substr($data, 8, 2);
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);

        $dataFormatada = $dia."/".$mes."/".$ano;
        return $dataFormatada;
    }

    $usuDate = formataData($usuDate);

    //Verifica a existência do digito 9 a mais e retira
    if(strlen($usuCel[3]) >= 4){
        $usuCel[3] = substr($usuCel[3], 1);
    }

    $usuCel = $usuCel[3] . $usuCel[4];
    $mensagem = '';
    if($cardProp == 1)
    {
        // //Pega os dados pessoais para cartão próprio
        // $propName   = $usuName;
        // $propCPF    = $usuCPF;
        // $propDate   = $usuDate;
        // $propCel    = $usuCel;
        // $propCelCode = $usuCelCode;

        //Dados relacionados a endereço : 
        $endereco = $usuRua;
        $numero = $usuRuaNum;
        $bairro = $usuBairro;
        $cep = $usuCep;
        $cidade = $usuCidade;
        $estado = $usuEst;

    }
    else
    {
        // //Pega os dados pessoais quando o cartão é de outra pessoa
        // $propName   = htmlspecialchars($_POST["propName"]);
        // $propCPF    = htmlspecialchars($_POST["propCPF"]);
        // $propDate   = htmlspecialchars($_POST["propDate"]);
        // $propCel    = htmlspecialchars($_POST["propCel"]);  
        // $cep   = htmlspecialchars($_POST["cep"]);
        // $endereco   = htmlspecialchars($_POST["endereco"]);
        // $numero     = htmlspecialchars($_POST["numero"]);
        // $bairro   = htmlspecialchars($_POST["bairro"]);
        // $cidade   = htmlspecialchars($_POST["cidade"]);
        // $estado   = htmlspecialchars($_POST["estado"]);


        // $propCel     = str_replace('(', '-' , $propCel);
        // $propCel     = str_replace(')', '-' , $propCel);
        // $propCel     = str_replace(' ', '-' , $propCel);
        // $propCel     = explode('-',$propCel);

        // $propCelCode = $propCel[1];

        // if(strlen($propCel[3]) >= 4){
        //     $propCel[3] = substr($propCel[3], 1);
        // }

        // $propCel = $propCel[3] . $propCel[4];

        // $cep = str_replace('.', '', $cep);
        // $cep = str_replace('-', '', $cep);

        // $propCPF    = str_replace('.', '', $propCPF);
        // $propCPF    = str_replace('-', '', $propCPF);


        require_once("congressistaController.php");
        $controller = new congressistaController();
        //Pega os dados pessoais quando o cartão é de outra pessoa
 
        $cep        = htmlspecialchars($_POST["cep"]);
        $endereco   = htmlspecialchars($_POST["endereco"]);
        $numero     = htmlspecialchars($_POST["numero"]);
        $bairro     = htmlspecialchars($_POST["bairro"]);
        $cidade     = htmlspecialchars($_POST["cidade"]);
        $estado     = htmlspecialchars($_POST["estado"]);


        // $propCel     = str_replace('(', '-' , $propCel);
        // $propCel     = str_replace(')', '-' , $propCel);
        // $propCel     = str_replace(' ', '-' , $propCel);
        // $propCel     = explode('-',$propCel);

        // $propCelCode = $propCel[1];

        // if(strlen($propCel[3]) >= 4){
        //     $propCel[3] = substr($propCel[3], 1);
        // }

        // $propCel = $propCel[3] . $propCel[4];

        // $cep = str_replace('.', '', $cep);
        // $cep = str_replace('-', '', $cep);

        // $propCPF    = str_replace('.', '', $propCPF);
        // $propCPF    = str_replace('-', '', $propCPF);
        
 

    

    }
       require_once("congressistaController.php");
        $controller = new congressistaController();

        $propName   = htmlspecialchars($_POST["propName"]);
        $propCPF    = htmlspecialchars($_POST["propCPF"]);
        $propDate   = htmlspecialchars($_POST["propDate"]);
        $propCel    = htmlspecialchars($_POST["propCel"]); 


        $propCel     = str_replace('(', '-' , $propCel);
        $propCel     = str_replace(')', '-' , $propCel);
        $propCel     = str_replace(' ', '-' , $propCel);
        $propCel     = explode('-',$propCel);

        $propCelCode = $propCel[1];

        if(strlen($propCel[3]) >= 4){
            $propCel[3] = substr($propCel[3], 1);
        }

        $propCel = $propCel[3] . $propCel[4];

        $cep = str_replace('.', '', $cep);
        $cep = str_replace('-', '', $cep);

        $propCPF    = str_replace('.', '', $propCPF);
        $propCPF    = str_replace('-', '', $propCPF);
        
        $mensagem = $controller->validaDadosProprietarioCartao($propName, $propCPF, $propDate, $propCelCode.$propCel, $cep, $endereco, $numero, $bairro, $cidade, $estado);

    //Descrever o tipo de inscrição
    switch ($usuInscTip) {
        case 1:
            $valorInscricao = '172.27';
            $tipoInscricaoDescricao = "Inscrição Membro de EJ NÃO filiada.";
            break;
        case 2:
            $valorInscricao = '156.65';
            $tipoInscricaoDescricao = "Inscrição Membro de EJ filiada.";
            break;
        case 3:
            $valorInscricao = '133.22';
            $tipoInscricaoDescricao = "Inscrição DIREX e Conselho Núcleo.";
            break;
        default:
            $valorInscricao = '172.27';
            break;
    }


    // if($usuInscTip == 1){ // ou seja, for R$172,27 - NÃO filiado : 
    //     switch($qntdParcelas){
    //         case 1: $valorInscricao = '172.27';
    //                 $valorParcelas  = '172.27';
    //         break;
    //         case 2: $valorInscricao = '180.39';
    //                 $valorParcelas  = '90.20';
    //         break;  
    //         case 3: $valorInscricao = '183.15';
    //                 $valorParcelas  = '61.05';
    //         break;
    //         case 4: $valorInscricao = '176.96';
    //                 $valorParcelas  = '46.24';
    //         break;
    //         case 5: $valorInscricao = '176.58';
    //                 $valorParcelas  = '37.45';
    //         break;
    //         case 6: $valorInscricao = '176.11';
    //                 $valorParcelas  = '31.58';
    //         break;
               
    //     }
    // }else if($usuInscTip == 2){ //se for Filiado
    //     switch($qntdParcelas){
    //         case 1: $valorInscricao = '156.65';
    //                 $valorParcelas  = '156.65';
    //         break;  
    //         case 2: $valorInscricao = '164.03';
    //                 $valorParcelas  = '82.02';

    //         break;
    //         case 3: $valorInscricao = '166.53';
    //                 $valorParcelas  = '55.51';
    //         break;
    //         case 4: $valorInscricao = '160.90';
    //                 $valorParcelas  = '42.04';
    //         break;
    //         case 5: $valorInscricao = '160.56';
    //                 $valorParcelas  = '34.05';
    //         break;
    //         case 6: $valorInscricao = '160.14';
    //                 $valorParcelas  = '28.72';
    //         break;
               
    //     }
    // }else if($usuInscTip == 3){ //se for do núcleo
    //     switch($qntdParcelas){
    //         case 1: $valorInscricao = '133.22';
    //                 $valorParcelas  = '133.22';
    //         break;
    //         case 2: $valorInscricao = '139.50';
    //                 $valorParcelas  = '69.75';
    //         break;
    //         case 3: $valorInscricao = '141.62';
    //                 $valorParcelas  = '47.21';
    //         break;
    //         case 4: $valorInscricao = '136.84';
    //                 $valorParcelas  = '35.75';
    //         break;
    //         case 5: $valorInscricao = '136.54';
    //                 $valorParcelas  = '28.96';
    //         break;
    //         case 6: $valorInscricao = '136.17';
    //                 $valorParcelas  = '24.42';
    //         break;
               
    //     }
    // }

    require_once('config.php');
    require_once('utils.php');
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/imagens/icone.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
    <title>Área do Congressista - Sucesso</title>
</head>


<?php
//     $params = array(
//         'email'                     => $PAGSEGURO_EMAIL,  
//         'token'                     => $PAGSEGURO_TOKEN,
//         'creditCardToken'           => $creditCardToken,
//         'senderHash'                => $senderHash,
//         'receiverEmail'             => $PAGSEGURO_EMAIL,
//         'paymentMode'               => 'default', 
//         'paymentMethod'             => 'creditCard', 
//         'currency'                  => 'BRL',
//         'itemId1'                   => '000'.$usuInscTip,
//         'itemDescription1'          => utf8_decode($tipoInscricaoDescricao),  
//         'itemAmount1'               => $valorInscricao,  
//         'itemQuantity1'             => 1,
//             //Congressista dados
//         'reference'                 => utf8_decode($id),
//         'senderName'                => utf8_decode($usuName),
//         'senderCPF'                 => utf8_decode($usuCPF),
//         'senderAreaCode'            => utf8_decode($usuCelCode),
//         'senderPhone'               => utf8_decode($usuCel),
//         'senderEmail'               => utf8_decode($usuEmail),
//         'shippingAddressStreet'     => utf8_decode($usuRua),
//         'shippingAddressNumber'     => utf8_decode($usuRuaNum),
//         'shippingAddressDistrict'   => utf8_decode($usuBairro),
//         'shippingAddressPostalCode' => utf8_decode($usuCep),
//         'shippingAddressCity'       => utf8_decode($usuCidade),
//         'shippingAddressState'      => utf8_decode($usuEst),
//         'shippingAddressCountry'    => 'BRA',
//         'shippingType'              => 1,
//         'shippingCost'              => '0.00',
//         'installmentQuantity'       => $qntdParcelas,
//         'installmentValue'          => $valorParcelas,
//         'noInterestInstallmentQuantity' => 2,
//         'creditCardHolderName'      => utf8_decode($propName),
//         'creditCardHolderCPF'       => utf8_decode($propCPF),
//         'creditCardHolderBirthDate' => utf8_decode($propDate),
//         'creditCardHolderAreaCode'  => utf8_decode($propCelCode),
//         'creditCardHolderPhone'     => utf8_decode($propCel),
//         'billingAddressStreet'     => utf8_decode($endereco),
//         'billingAddressNumber'     => utf8_decode($numero),
//         'billingAddressDistrict'   => utf8_decode($bairro),
//         'billingAddressPostalCode' => utf8_decode($cep),
//         'billingAddressCity'       => utf8_decode($cidade),
//         'billingAddressState'      => utf8_decode($estado),
//         'billingAddressCountry'    => 'BRA'
//     );
//     //print_r($_POST);

//     //var_dump($params);
//     //print_r($_SESSION);
//     $header = array('Content-Type' => 'application/json; charset=ISO-8859-1;');
//     $response = curlExec($PAGSEGURO_API_URL."/transactions", $params, $header);
//     // Filtrar caracteres especiais
//     $json = json_decode(json_encode(simplexml_load_string($response)));
//     if($json->code){// quer dizer que deu certo, então vamos inserir no banco
//         $congressista->insertPagamento($id, $json->status, $json->code, $json->installmentCount, $valorInscricao);
//         echo '<body>
    
//     <h1>Parabéns '.$_SESSION['usuario'].' !</h1>
//     <p>Sua transação foi realizada com sucesso !</p><br>
//     <p>O status da transação é : '.$json->status.'</p><br>
//     <p>O código da transação é : '.$json->code.'</p><br>
//     <p>Fique atento e acompanhe o status da transação. Qualquer problema entre em contato com : suporte.enejunesp@gmail.com.</p>

// </body>
// </html>';
//     }else{
//         echo '<body>Houve um erro na transação. Por favor, tente mais tarde.</body></html>';
//     }
//     print_r($json); 

?>

<!--     <h3>Code: <?php //echo $json->code;?></h3>
    <h3>Status: <?php //echo $json->status;?></h3>
    <p>Response: <?php //print_r($json);  ?></p> -->


<?php 
 if($mensagem === "")
    {
    $params = array(
        'email'                     => $PAGSEGURO_EMAIL,  
        'token'                     => $PAGSEGURO_TOKEN,
        'creditCardToken'           => $creditCardToken,
        'senderHash'                => $senderHash,
        'receiverEmail'             => $PAGSEGURO_EMAIL,
        'paymentMode'               => 'default', 
        'paymentMethod'             => 'creditCard', 
        'currency'                  => 'BRL',
        'itemId1'                   => '000'.$usuInscTip,
        'itemDescription1'          => utf8_decode($tipoInscricaoDescricao),  
        'itemAmount1'               => $valorInscricao,  
        'itemQuantity1'             => 1,
            //Congressista dados
        'reference'                 => utf8_decode($id),
        'senderName'                => utf8_decode($usuName),
        'senderCPF'                 => utf8_decode($usuCPF),
        'senderAreaCode'            => utf8_decode($usuCelCode),
        'senderPhone'               => utf8_decode($usuCel),
        'senderEmail'               => utf8_decode($usuEmail),
        'shippingAddressStreet'     => utf8_decode($endereco),
        'shippingAddressNumber'     => utf8_decode($numero),
        'shippingAddressDistrict'   => utf8_decode($bairro),
        'shippingAddressPostalCode' => utf8_decode($cep),
        'shippingAddressCity'       => utf8_decode($cidade),
        'shippingAddressState'      => utf8_decode($estado),
        'shippingAddressCountry'    => 'BRA',
        'shippingType'              => 3,
        'shippingCost'              => '0.00',
        'installmentQuantity'       => $qntdParcelas,
        'installmentValue'          => $valorParcelas,
        //'noInterestInstallmentQuantity' => 2,
        'creditCardHolderName'      => utf8_decode($propName),
        'creditCardHolderCPF'       => utf8_decode($propCPF),
        'creditCardHolderBirthDate' => utf8_decode($propDate),
        'creditCardHolderAreaCode'  => utf8_decode($propCelCode),
        'creditCardHolderPhone'     => utf8_decode($propCel),
        'billingAddressStreet'     => utf8_decode($usuRua),
        'billingAddressNumber'     => utf8_decode($usuRuaNum),
        'billingAddressDistrict'   => utf8_decode($usuBairro),
        'billingAddressPostalCode' => utf8_decode($usuCep),
        'billingAddressCity'       => utf8_decode($usuCidade),
        'billingAddressState'      => utf8_decode($usuEst),
        'billingAddressCountry'    => 'BRA'
    );
    

    //var_dump($params);
    //print_r($_SESSION);
    $header = array('Content-Type' => 'application/json; charset=ISO-8859-1;');
    $response = curlExec($PAGSEGURO_API_URL."/transactions", $params, $header);
    // Filtrar caracteres especiais
    $json = json_decode(json_encode(simplexml_load_string($response)));
    //print_r($json);
    if($json->code){// quer dizer que deu certo, então vamos inserir no banco

        $ejcomp = $json->grossAmount*(0.04);
        $coe = $json->netAmount - $ejcomp;

        $valor_bruto = $json->installmentCount*$valorParcelas;

        $instituicao_financeira = $valor_bruto - $valorInscricao;

        $congressista->insertPagamento($id, $json->status, $json->code, $json->installmentCount, $valorInscricao, $valorParcelas, $json->netAmount, $ejcomp, $json->feeAmount, $valor_bruto, $coe, $instituicao_financeira);

        switch($json->status){
                case '1';
                $status = "Aguardando Pagamento";
                break;

                case '2';
                $status = "Análise";
                break;

                case '3';
                $status = "Paga";
                break;

                case '4';
                $status = "Disponível";
                break;

                case '5';
                $status = "Em disputa";
                break;

                case '6';
                $status = "Devolvida";
                break;

                case '7';
                $status = "Cancelada";
                break;
        }

        include('topo.php');
        echo '<body>
    <div align="center" id="sucesso">
    <h1>Parabéns '.$_SESSION['usuario'].' !</h1>
    <h2 style="font-family: brandon_light">Sua transação foi realizada com sucesso !</h2><br>
    <p style="font-family: brandon_light; font-size: 24px;">O status da transação é : '.$status.'</p><br>
    <p style="font-family: brandon_light; font-size: 22px;">O código da transação é : '.$json->code.'</p><br>
    <p style="font-family: brandon_light; font-size: 20px;">Fique atento e acompanhe o status da transação. Qualquer problema entre em contato com : <strong>suporte.enejunesp@gmail.com</strong>.</p>
    <p style="font-family: brandon_light; font-size: 20px;"><strong>OBS</strong> : Se seu status está como Aguardando Pagamento, fique tranquilo, pois ele será alterado. Caso não seja, entre em contato conosco.
   <div class="col-xs-12">
                <br>
                <p style="text-align: center"><a class="btn-enejunesp btn-w" href="index.php" name="voltar" id="voltar" onclick="">Voltar</a></p>
    </div>
    </div>
</body>
</html>';
    }else{

    
    $erro = $json->error->code;


    switch($erro){
        case '5003': $mensagem = 'Falha de comunicação com a instituição financeira' ;break;

        case '10000': $mensagem = 'Bandeira inválida';break;

        case '10001': $mensagem = 'Cartão de crédito com tamanho inválido';break;

        case '10002': $mensagem = 'Data inválida';break;

        case '10003': $mensagem = 'Campo de segurança inválido';break;

        case '10004': $mensagem = 'CVV é obrigatório';break;

        case '10006': $mensagem = 'Campo de segurança inválido';break;

        case '53004': $mensagem = 'Quantidade de itens inválida';break;

        case '53005': $mensagem = 'Moeda é obrigatório.';break;

        case '53006': $mensagem = 'Moeda inválida';break;

        case '53007': $mensagem = 'Reference inválida';break;

        case '53008': $mensagem = 'URL de notificação inválida';break;

        case '53009': $mensagem = 'URL de notificação inválida';break;

        case '53010': $mensagem = 'Enviador de email é necessário';break;

        case '53011': $mensagem = 'Problema no envio do email';break;

        case '53012': $mensagem = 'Problema no envio do email';break;

        case '53013': $mensagem = 'É necessario preencher o nome';break;

        case '53014': $mensagem = 'Nome inválido';break;

        case '53015': $mensagem = 'Nome inválido';break;

        case '53017': $mensagem = 'CPF inválido';break;

        case '53018': $mensagem = 'É necessário especificar o código de área';break;

        case '53019': $mensagem = 'Código de área inválido';break;

        case '53020': $mensagem = 'É necessário especificar o telefone';break;

        case '53021': $mensagem = 'Telefone inválido';break;

        case '53022': $mensagem = 'É necessário especificar o código postal de cobrança';break;

        case '53023': $mensagem = 'Código postal de cobrança inválido';break;

        case '53024': $mensagem = 'É necessário especificar o endereço de cobrança';break;

        case '53025': $mensagem = 'Endereço de cobrança inválido';break;

        case '53026': $mensagem = 'É necessário especificar o número de cobrança';break;

        case '53027': $mensagem = 'Numero de cobrança inválido';break;

        case '53028': $mensagem = 'Complemento de cobrança inválido';break;

        case '53029': $mensagem = 'Distrito de cobrança é obrigatório';break;

        case '53030': $mensagem = 'Distrito de cobrança inválido';break;

        case '53031': $mensagem = 'Cidade de cobrança é requerido';break;

        case '53032': $mensagem = 'Cidade de cobrança inválida';break;

        case '53033': $mensagem = 'Estado de cobrança é obrigatório';break;

        case '53034': $mensagem = 'Estado de cobrança inválido';break;

        case '53035': $mensagem = 'País de cobrança é obrigatório';break;

        case '53036': $mensagem = 'Páis de cobrança inválido';break;

        case '53037': $mensagem = 'Token do cartão é obrigatório';break;

        case '53038': $mensagem = 'Quantidade é obrigatória';break;

        case '53039': $mensagem = 'Quantidade inválida';break;

        case '53040': $mensagem = 'Valor da parcela é obrigatório.';break;

        case '53041': $mensagem = 'Valor da parcela inválido';break;

        case '53042': $mensagem = 'Nome do portador do cartão é obrigatório.';break;

        case '53043': $mensagem = 'Nome do titular do cartão com tamanho inválido';break;

        case '53044': $mensagem = 'Nome do cartão inválido';break;

        case '53045': $mensagem = 'CPF do dono do cartão é obrigatório' ;break;


        case '53046': $mensagem = 'CPF do titular do cartão inválido';break;

        case '53047': $mensagem = 'Data de Nascimento do dono do cartão é obrigatório';break;

        case '53048': $mensagem = 'Data de nascimento do titular do cartão incorreto';break;

        case '53049': $mensagem = 'Código de área do titular do cartão é obrigatório';break;

        case '53050': $mensagem = 'Código de área do titular do cartão inválido.';break;

        case '53051': $mensagem = 'Telefone do titular do cartão é obrigatório.';break;

        case '53052': $mensagem = 'Telefone do titular do cartão inválido';break;

        case '53053': $mensagem = 'CEP do endereço de cobrança é obrigatório.';break;

        case '53054': $mensagem = 'CEP de cobrança inválido';break;

        case '53055': $mensagem = 'Rua do endereço de cobrança é obrigatório.';break;

        case '53056': $mensagem = 'Endereço de cobrança com tamanho inválido.';break;

        case '53057': $mensagem = 'Número do endereço de cobrança é obrigatório.';break;

        case '53058': $mensagem = 'Número do endereço de cobrança com tamanho inválido';break;

        case '53059': $mensagem = 'Complemento do endereço de cobrança com tamanho inválido';break;

        case '53060': $mensagem = 'Bairro do endereço de cobrança é obrigatório.';break;

        case '53061': $mensagem = 'Bairro do endereço de cobrança com tamanho inválido';break;

        case '53062': $mensagem = 'Cidade do endereço de cobrança é obrigatório.';break;

        case '53063': $mensagem = 'Cidade do endereço de cobrança com tamanho inválido';break;

        case '53064': $mensagem = 'Estado do endereço de cobrança é obrigatório.';break;

        case '53065': $mensagem = 'Estado do endereço de cobrança inválido.';break;

        case '53066': $mensagem = 'País do endereço de cobrança é obrigatório.';break;

        case '53067': $mensagem = 'País do endereço de cobrança com tamanho inválido.';break;

        case '53068': $mensagem = 'E-mail do vendedor com tamanho inválido:';break;

        case '53069': $mensagem = 'E-mail do vendedor inválido.';break;

        case '53070': $mensagem = 'Id do item é obrigatório.';break;

        case '53071': $mensagem = 'Id do item possuí tamanho inválido:';break;

        case '53072': $mensagem = 'Descrição do item é obrigatório.';break;

        case '53073': $mensagem = 'Descrição do item com tamanho inválido';break;

        case '53074': $mensagem = 'Quantidade do item é obrigatório.';break;

        case '53075': $mensagem = 'Quantidade do item fora do permitido.';break;

        case '53076': $mensagem = 'Quantidade do item inválida.';break;

        case '53077': $mensagem = ' Valor do item é obrigatório.';break;

        case '53078': $mensagem = 'Valor do item deve seguir o padrão';break;

        case '53079': $mensagem = 'Valor do item fora do permitido.';break;

        case '53081': $mensagem = 'O comprador está relacionado ao vendedor.';break;

        case '53084': $mensagem = 'Vendedor inválido, verifique se a conta do lojista é uma conta de vendedor.';break;

        case '53085': $mensagem = 'Método de pagamento não disponível.';break;

        case '53086': $mensagem = 'Valor total do carrinho fora do permitido.';break;

        case '53087': $mensagem = 'Dados de cartão inválidos.';break;

        case '53091': $mensagem = ' Identificação do comprador(hash) inválido.';break;

        case '53092': $mensagem = 'Bandeira do cartão não é aceita.';break;

        case '53095': $mensagem = 'Tipo de frete for do padrão.';break;

        case '53096': $mensagem = 'Custo de frete fora dos padrões.';break;

        case '53097': $mensagem = 'Custo de frete fora dos limites.';break;

        case '53098': $mensagem = 'Valor total do carrinho é negativo';break;

        case '53099': $mensagem = 'Valor extra incompatível';break;

        case '530101': $mensagem = 'Modo de pagamento inválido. Valores válidos são: default e gateway.';break;

        case '530102': $mensagem = 'Método de pagamento inválido. Valores aceitos são: creditCard, boleto e eft';break;

        case '530104': $mensagem = 'Custo de envio foi fornecido, endereço de envio deve estar completo.';break;

        case '530105': $mensagem = 'Informações do comprador foram fornecidas, email também deve ser fornecido.';break;

        case '530106': $mensagem = 'Dados do dono do cartão incompletos.';break;

        case '530109': $mensagem = 'Endereço de entrega foi informado, o e-mail do comprador também deve ser fornecido.';break;

        case '530110': $mensagem = 'Banco para tef é obrigatório.';break;

        case '530111': $mensagem = 'Banco não é aceito.';break;

        case '530115': $mensagem = 'Data de nascimento do comprador inválida.';break;

        case '530117': $mensagem = 'CNPJ do comprador inválido.';break;

        case '530122': $mensagem = 'Domínio do e-mail do comprador inválido. Você deve usar um e-mail @sandbox.pagseguro.com.br';break;

        case '530140': $mensagem = 'Quantidade de parcelas fora do limite. O valor deve ser maior que zero.';break;

        case '530141': $mensagem = 'Comprador está bloqueado.';break;

        case '530142': $mensagem = 'Token de cartão de crédito inválido.';break;
    } //fecha switch



    //     echo '<body><h1>Houve um erro na transação. Por favor, tente mais tarde.</h1><div class="col-xs-6">
    //             <p style="text-align: center"><a class="btn-enejunesp btn-w" href="index.php" name="voltar" id="voltar" onclick="">Voltar</a></p>
    // </div></body></html>';
    include('topo.php');
   echo '<body><br><br><div class="col-xs-12"><div class="alert alert-danger">
                                <p style="text-align: center; font-size: 28px;"><strong>ENCONTRAMOS O(S) ERRO(S):</strong><br>'.$mensagem.'<br>Está com dificuldades? Entre em contato com: <strong>suporte.enejunesp@gmail.com.</strong></p>
                                    </div></div>
                 <div class="col-xs-12">
                <br>
                <p style="text-align: center"><a class="btn-enejunesp btn-w" href="index.php" name="voltar" id="voltar" onclick="">Voltar</a></p>
    </div>
    </body></html>';
    
   } //fecha else
}
   else
   { 
     include('topo.php');
     echo '<body><div class="col-xs-12"><div class="alert alert-danger">
                                <p style="text-align: center; font-size: 28px;"><strong>ENCONTRAMOS O(S) ERRO(S):</strong><br>'.$mensagem.'<br>Está com dificuldades? Entre em contato com: <strong>suporte.enejunesp@gmail.com.</strong></p>
                                    </div></div>
                 <div class="col-xs-12">
                <br>
                <p style="text-align: center"><a class="btn-enejunesp btn-w" href="index.php" name="voltar" id="voltar" onclick="">Voltar</a></p>
    </div>
    </body></html>';
   }

   include('footer.php');
 ?>

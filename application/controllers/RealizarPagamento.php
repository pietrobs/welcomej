<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class RealizarPagamento extends CI_Controller {
	//Config SANDBOX or PRODUCTION environment
	private $SANDBOX_ENVIRONMENT;
	private $PAGSEGURO_API_URL;
	private $PAGSEGURO_RECEBER_POST;
	private $PAGSEGURO_DIRECT_PAYMENT;

	private	$PAGSEGURO_EMAIL = 'darlannakamura@hotmail.com';
	private	$PAGSEGURO_TOKEN = '777B8F8114C2489EA2DD2AE40F9BE215';

	private $VALOR_TOTAL;
	private $PORCENTAGEM_EJCOMP = 0.07;

	public function __construct(){
		parent::__construct();

		if(!isset($this->session->usuario)){
			$this->session->set_flashdata("erro",'Você precisa entrar para ter acesso a essa área.');
			redirect(base_url());
		}

		$this->SANDBOX_ENVIRONMENT = true;

		if($this->SANDBOX_ENVIRONMENT){
			$this->PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
			$this->PAGSEGURO_RECEBER_POST = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/';
			$this->PAGSEGURO_DIRECT_PAYMENT = 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
		}else{
			$this->PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
			$this->PAGSEGURO_RECEBER_POST = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/';
			$this->PAGSEGURO_DIRECT_PAYMENT = 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
		}

		//DEFININDO O VALOR DO PAGAMENTO
		if($this->session->usuario['filiado_nucleo']){
			$this->VALOR_TOTAL = "110.00";
		}else{
			$this->VALOR_TOTAL = "150.00";
		}

		$this->load->model('RealizarPagamento_model','model');
	}



	public function boleto(){
		$senderHash = $this->input->post('senderHash');

		$array = explode('@', $this->session->usuario['email']);
		$primeira_parte_email = $array[0];
		$email = $primeira_parte_email.'@sandbox.pagseguro.com.br';

		$params = array(
			'email'                     => $this->PAGSEGURO_EMAIL,  
			'token'                     => $this->PAGSEGURO_TOKEN,
			'paymentMode'               => 'default', 
			'paymentMethod'             => 'boleto', 
			'receiverEmail'             => $this->PAGSEGURO_EMAIL,
			'currency'                  => 'BRL',
			'itemId1'                   => '000'.$this->session->usuario['id'],
			'itemDescription1'          => utf8_decode("INSCRIÇÃO Welcomej 2018"),  
			'itemAmount1'               => $this->VALOR_TOTAL.'.00',  
			'itemQuantity1'             => 1,
			        //Congressista dados
			'senderHash'                => $senderHash,
			'reference'                 => utf8_decode('INGRESSO Welcomej'.$this->session->usuario['id']),
			'senderCPF'                 => '45287632819',
			'senderAreaCode'            => '18',
			'senderName'				=>  $this->session->usuario['nome'],
			'senderPhone'               => '997431595',
			'senderEmail'               => utf8_decode($email),
			'shippingAddressStreet'     => 'Avenida Presidente Vargas',
			'shippingAddressNumber'     => '1604',
			'shippingAddressDistrict'   => 'Centro',
			'shippingAddressPostalCode' => '17900000',
			'shippingAddressCity'       => 'Dracena',
			'shippingAddressState'      => 'SP',
			'shippingAddressCountry'    => 'BRA',
			'shippingType'              => 3,
			'shippingCost'              => '0.00',
		);


    //var_dump($params);
    //print_r($_SESSION);

		$header = array('Content-Type' => 'application/json; charset=ISO-8859-1;');
		$response = $this->__curlExec($this->PAGSEGURO_API_URL."/transactions", $params, $header);
    // Filtrar caracteres especiais
		$json = json_decode(json_encode(simplexml_load_string($response)));

		// print_r($json);die();

		if($json->paymentLink){
			$dados['ejcomp'] = $json->grossAmount*($this->PORCENTAGEM_EJCOMP);
			$dados['organizacao'] = $json->netAmount - $dados['ejcomp'];
			$dados['valor_bruto'] = $this->VALOR_TOTAL;
			$dados['instituicao_financeira'] = 0;
			$dados['pagseguro'] = $json->feeAmount;
			$dados['valor_liquido'] = $json->netAmount;
			$dados['parcela'] = $json->installmentCount;
			$dados['valor_parcela'] = ($json->grossAmount/$json->installmentCount);
			$dados['tipo_pagamento'] = $json->paymentMethod->type;
			$dados['id_status_pagamento'] = $json->status;
			$dados['valor'] = $this->VALOR_TOTAL;
			$dados['id_usuario'] = $this->session->usuario['id'];
			$dados['codigo_transacao'] = $json->code;



			$this->model->salvar($dados);
			echo json_encode($json->paymentLink);
			return true;
		}
		else{
			return  $json->error->code;
		}



		
	}


	private function __curlExec($url, $post = NULL, array $header = array()){
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if(count($header) > 0) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}
		if($post !== null) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post, '', '&'));
		}

        //Ignore SSL
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}



	public function creditCard($creditCardToken, $senderHash, $quantidadeParcelas, $valorParcela){
		$array = explode('@', $this->session->usuario['email']);
		$primeira_parte_email = $array[0];
		$email = $primeira_parte_email.'@sandbox.pagseguro.com.br';


		$params = array(			
			'email'                     => $this->PAGSEGURO_EMAIL,  
			'token'                     => $this->PAGSEGURO_TOKEN,
			'creditCardToken'           => $creditCardToken,
			'senderHash'                => $senderHash,
			'receiverEmail'             => $this->PAGSEGURO_EMAIL,
			'paymentMode'               => 'default', 
			'paymentMethod'             => 'creditCard', 
			'currency'                  => 'BRL',
			'itemId1'                   => '000'.$this->session->usuario['id'],
			'itemDescription1'          => utf8_decode('Ingresso Welcomej 2018'),  
			'itemAmount1'               => $this->VALOR_TOTAL,  
			'itemQuantity1'             => 1,
			'reference'                 => utf8_decode('INGRESSO Welcomej'. $this->session->usuario['id']),

			'senderName'                => utf8_decode( $this->session->usuario['nome']),
			'senderCPF'                 => '45287632819',
			'senderAreaCode'            => '18',
			'senderPhone'               => '997431595',
			'senderEmail'               => utf8_decode($email),

			'shippingAddressStreet'     => 'Avenida Presidente Vargas',
			'shippingAddressNumber'     => '1604',
			'shippingAddressDistrict'   => 'Centro',
			'shippingAddressPostalCode' => '17900000',
			'shippingAddressCity'       => 'Dracena',
			'shippingAddressState'      => 'SP',
			'shippingAddressCountry'    => 'BRA',
			'shippingType'              => 3,
			'shippingCost'              => '0.00',

			'installmentQuantity'       => $quantidadeParcelas,
			'installmentValue'          => $valorParcela,
			'creditCardHolderName'      =>  $this->session->usuario['nome'],
			'creditCardHolderCPF'       => '45287632819',
			'creditCardHolderBirthDate' => '28/03/1997',        
			'creditCardHolderAreaCode'  => '18',
			'creditCardHolderPhone'     => '997431595',
			'billingAddressStreet'     =>  'Avenida Presidente Vargas',     
			'billingAddressNumber'     =>  '1604',
			'billingAddressDistrict'   =>  'Centro',
			'billingAddressPostalCode' =>  '17900000',      
			'billingAddressCity'       =>  'Dracena',
			'billingAddressState'      =>  'SP',      
			'billingAddressCountry'    =>  'BRA');


		$header = array('Content-Type' => 'application/json; charset=ISO-8859-1;');
		$response = $this->__curlExec($this->PAGSEGURO_API_URL."/transactions", $params, $header);



		$json = json_decode(json_encode(simplexml_load_string($response)));
		

		// echo "Params:<br>";
		// print_r($params);
		// echo '<br><br><br><br>';	
		// echo "Json:<br>";
		// print_r($json); 

		if($json->code){
			$dados['ejcomp'] = $json->grossAmount*($this->PORCENTAGEM_EJCOMP);
			$dados['organizacao'] = $json->netAmount - $dados['ejcomp'];
			$dados['valor_bruto'] = $json->installmentCount*$valorParcela;
			$dados['instituicao_financeira'] = $json->grossAmount - $this->VALOR_TOTAL;
			$dados['pagseguro'] = $json->feeAmount;
			$dados['valor_liquido'] = $json->netAmount;
			$dados['parcela'] = $json->installmentCount;
			$dados['valor_parcela'] = ($json->grossAmount/$json->installmentCount);
			$dados['tipo_pagamento'] = $json->paymentMethod->type;
			$dados['id_status_pagamento'] = $json->status;
			$dados['valor'] = $this->VALOR_TOTAL;
			$dados['id_usuario'] = $this->session->usuario['id'];
			$dados['codigo_transacao'] = $json->code;

			$this->model->salvar($dados);
			return true;
		}
		else{
			return  $json->error->code;
		}
	}

	public function efetuar_pagamento(){

		$creditCardToken = $this->input->post('token');
		$senderHash = $this->input->post('senderHash');
		$quantidadeParcelas = $this->input->post('installmentQuantity');
		$aux = $quantidadeParcelas -1;
		$valorParcela = $this->input->post('installmentValue'.$aux);
		print_r($this->input->post());

		$array_aux = explode('.', $valorParcela);
		if(count($array_aux) == 1){
			$valorParcela = $valorParcela.".00";
		}

		echo '<br>Valor Parcela: '.$valorParcela;
		echo '<br>Quantidade Parcela: '.$quantidadeParcelas;

		if($this->creditCard($creditCardToken, $senderHash, $quantidadeParcelas, $valorParcela)){
			$this->session->set_flashdata('sucesso','Seu pagamento será efetivado dentro das próximas 24horas.');
		}
		else{
			$this->session->set_flashdata('erro','Houve um problema ao efetuar seu pagamento.');
		}
		getMensagem($this->session);
		// die();
		redirect(base_url('Painel'));
	}


	public function notification(){
		$notificationCode = $this->input->post('notificationCode');
		$notificationType = $this->input->post('notificationType');

		if($notificationType == 'transaction'){
			$url = $this->PAGSEGURO_RECEBER_POST.$notificationCode.'?email='.$this->PAGSEGURO_EMAIL.'&token='.$this->PAGSEGURO_TOKEN;
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$resp = curl_exec($ch);
			curl_close($ch);
			$json = json_decode(json_encode(simplexml_load_string($resp)));

			$codigo_transacao = $json->code;
			$dados['id_status_pagamento'] = $json->status;

			$this->model->atualizar_status($codigo_transacao, $dados);
		}
	}

	public function cartao_de_credito(){
		$this->load->model('congressista_model','modelcongressista');

		$dados['pagina'] = 'pagamento';
		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
		}

		$params = array(
			'email' => $this->PAGSEGURO_EMAIL,
			'token' => $this->PAGSEGURO_TOKEN
		);

		$header = array('Content-Type' => 'application/json; charset=ISO-8859-1;');
		$response = $this->__curlExec($this->PAGSEGURO_API_URL."/sessions", $params, $header);
		// var_dump($params); exit();
		$json = json_decode(json_encode(simplexml_load_string($response)));
		$data_body['sessionCode'] = $json->id;
		$data_body['PAGSEGURO_DIRECT_PAYMENT'] = $this->PAGSEGURO_DIRECT_PAYMENT;
		$data_body['valor'] = $this->VALOR_TOTAL;

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('realizarpagamento/cartao_de_credito', $data_body);
		$this->load->view('html-footer');

	}

	public function seleciona_tipo_pagamento(){
		$this->load->model('congressista_model','modelcongressista');

		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
			$dados_pagamento['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
			$dados_pagamento['pagamento'] = true;
			$dados_pagamento['info_pagamento'] = $this->modelcongressista->getPagamento();
		}
		
		$dados['pagina'] = 'pagamento';
		$dados['congressista'] = $this->modelcongressista->get();
		$dados_pagamento['PAGSEGURO_DIRECT_PAYMENT'] = $this->PAGSEGURO_DIRECT_PAYMENT;

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('realizarpagamento/pagamento',$dados_pagamento);
		$this->load->view('html-footer');

	}





}

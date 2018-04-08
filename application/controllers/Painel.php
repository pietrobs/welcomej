<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {
	private $id_usuario;

	public function __construct(){
		parent::__construct();
		$this->load->model('congressista_model','modelcongressista');
		$this->id_usuario = $this->session->usuario['id'];
	}

	public function index(){
		$dados['pagina'] = 'inicio';
		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
		}


		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('inicial',$dados_inicio);
		$this->load->view('html-footer');
	}

	public function meus_dados(){
		$acao = $this->modelcongressista->getAcao();

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
		}

		$dados['pagina'] = 'meus_dados';
		$dados['congressista'] = $this->modelcongressista->get();

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('meus_dados');
		$this->load->view('html-footer');
	}

	public function pagamento(){
		redirect('RealizarPagamento/seleciona_tipo_pagamento');
	}

	public function selecionar(){
		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
		}
		
		$dados['pagina'] = 'minicursos';

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('minicursos');
		$this->load->view('html-footer');
	}

	public function alterar_senha(){
		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;
		$dados['congressista'] = array('id'=>$this->id_usuario);

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
		}
		
		$dados['pagina'] = 'meus_dados';

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('alterar_senha');
		$this->load->view('html-footer');
	}

	public function logout(){
		session_destroy();
		redirect(base_url());
	}

}

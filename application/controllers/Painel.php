<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {
	private $id_usuario;

	public function __construct(){
		parent::__construct();
		$this->load->model('congressista_model','modelcongressista');
		$this->id_usuario = $this->session->usuario['id'];
		if(!isset($this->session->usuario)){
			$this->session->set_flashdata("erro",'Você precisa entrar para ter acesso a essa área.');
			redirect(base_url());
		}
	}

	public function index(){
		$dados['pagina'] = 'inicio';
		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
			$dados_inicio['status_pagamento'] = 0;
		}else{
			$dados['pagamento'] = true;
			$dados_inicio['status_pagamento'] = $this->modelcongressista->getStatusPagamento();

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
		$congressista =  $this->modelcongressista->get();
		$dados['pagamento'] = $congressista->ja_pagou;
		$dados['pagina'] = 'pagamento';
		$dados['congressista'] = $congressista;

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('pagamento', $dados);
		$this->load->view('sidebar',$dados);
		$this->load->view('html-footer');

	}

	public function send_photo(){

    	//verificar se já existia uma imagem lá:
		$id = $this->session->usuario['id'];
		$this->db->where('id_usuario', $id);
		$pagamento = $this->db->get('pagamento')->row();
		

		if($pagamento != null){ //ou seja, existia um pagamento:
			$foto_comprovante = $pagamento->foto_comprovante;
			unlink('uploads/comprovante/'.$foto_comprovante);
			$this->db->where('id_usuario', $id);
			$this->db->delete('pagamento');
		}

		$resposta = $this->do_upload_image('comprovante_deposito');


		if($resposta == true){
			$this->session->set_flashdata('sucesso', 'Comprovante enviado com sucesso!<br>');

		}else{
			$this->session->set_flashdata('erro', $resposta);
		}

		redirect(base_url('Painel/pagamento'));
	}

	    public function do_upload_image($name)
    {



    	$config['upload_path']          = 'uploads/comprovante';
    	$config['allowed_types']        = 'pdf|gif|jpg|png|jpeg|bmp';
    	$config['max_size']             = 4096;
    	$config['encrypt_name']         = TRUE;


    	$this->load->library('upload');
    	$this->upload->initialize($config);
    	if ( ! $this->upload->do_upload($name))
    	{
        //$error = array('error' => $this->upload->display_errors());

    		return $this->upload->display_errors();

    	}
    	else
    	{
        	//inserir no banco
    		$foto = $this->upload->data('file_name');
    		$id = $this->session->usuario['id'];
    		$this->modelcongressista->atualizaJaPagou($id);
    		return $this->modelcongressista->insert_pagamento($foto, $id);

    	}
    }


	public function selecionar(){
		$this->load->model('palestra_model','modelpalestra');
		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
		}
		
		$dados['pagina'] = 'minicursos';

		$dados_minicursos['minhas_palestras'] = $this->modelpalestra->getInscrito($this->session->usuario['id']);

		$dados_minicursos['palestras_dia_1'] = $this->modelpalestra->get(1);
		$dados_minicursos['palestras_dia_2'] = $this->modelpalestra->get(2);
		$dados_minicursos['palestras_dia_3'] = $this->modelpalestra->get(3);

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('minicursos',$dados_minicursos);
		$this->load->view('html-footer');
	}

	public function ver($id_palestra){
		$this->load->model('palestra_model','modelpalestra');
		$acao = $this->modelcongressista->getAcao();
		$dados_inicio['acao'] = $acao;

		if($acao == 0 || $acao == 1){
			$dados['pagamento'] = false;
		}else{
			$dados['pagamento'] = true;
		}
		
		$dados['pagina'] = 'minicursos';
		$dados_minicursos['palestra'] = $this->modelpalestra->getPalestra($id_palestra);
		$dados_minicursos['inscrito'] = $this->modelpalestra->inscrito($id_palestra);

		$this->load->view('html-header');
		$this->load->view('header');
		$this->load->view('sidebar',$dados);
		$this->load->view('ver',$dados_minicursos);
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


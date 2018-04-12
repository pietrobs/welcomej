<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Congressista extends CI_Controller {
	public $config;


	public function __construct(){
		parent::__construct();
		$this->load->model('congressista_model','modelcongressista');
		$this->load->model('palestra_model','modelpalestra');

	}

	public function insere(){
		if(!isset($this->session->usuario)){
			$this->session->set_flashdata("erro",'Você precisa entrar para ter acesso a essa área.');
			redirect(base_url());
		}

		$dados['nome'] = $this->input->post('nome');
		$dados['apelido'] = $this->input->post('apelido');
		$dados['celular'] = $this->input->post('celular');
		$dados['email'] = $this->input->post('email');
		$dados['rg'] = $this->input->post('rg');
		$dados['cpf'] = $this->input->post('cpf');
		$dados['restricao_alimentar'] = $this->input->post('restricao');
		$dados['descricao_restricao_alimentar'] = $this->input->post('descricao_restricao');
		$dados['empresa_junior'] = $this->input->post('empresa_junior');
		$dados['filiado_nucleo'] = $this->input->post('filiada');

		if($this->modelcongressista->insert($dados)){
			$this->session->set_flashdata('sucesso','Seu cadastro foi efetuado!');
		}else{
			$this->session->set_flashdata('erro','Houve um erro ao efetuar o cadastro!');
		}

		redirect('Painel');
	}

	public function atualiza(){
		if(!isset($this->session->usuario)){
			$this->session->set_flashdata("erro",'Você precisa entrar para ter acesso a essa área.');
			redirect(base_url());
		}

		$dados['nome'] = $this->input->post('nome');
		$dados['apelido'] = $this->input->post('apelido');
		$dados['celular'] = $this->input->post('celular');
		$dados['rg'] = $this->input->post('rg');
		$dados['cpf'] = $this->input->post('cpf');
		$dados['restricao_alimentar'] = $this->input->post('restricao');
		$dados['descricao_restricao_alimentar'] = $this->input->post('descricao_restricao');
		$dados['empresa_junior'] = $this->input->post('empresa_junior');
		$dados['filiado_nucleo'] = $this->input->post('filiada');

		if($this->modelcongressista->update($dados)){
			$this->session->set_flashdata('sucesso','Dados atualizados!');
			$usuario = $this->modelcongressista->getArray();

			$this->session->set_userdata('usuario',$usuario);

		}else{
			$this->session->set_flashdata('erro','Houve um erro ao atualizar os dados!');
		}

		redirect('Painel/meus_dados');
	}

	public function inscrever($id_palestra){
		if(!isset($this->session->usuario)){
			$this->session->set_flashdata("erro",'Você precisa entrar para ter acesso a essa área.');
			redirect(base_url());
		}
		if(count($this->modelpalestra->getInscrito($this->session->usuario['id'])) >= 5){
			$this->session->set_flashdata("erro",'Você atingiu o limite máximo de inscrição.');
			redirect('Painel/ver/'.$id_palestra);
		}
		if(!$this->modelpalestra->cheio($id_palestra)){
			$dados['id_congressista'] = $this->session->usuario['id'];
			$dados['id_palestra'] = $id_palestra;
			if($this->modelpalestra->participar($dados)){
				$this->session->set_flashdata('sucesso','Inscrição realizada.');
			}else{
				$this->session->set_flashdata('erro','Houve um erro ao realizar a inscrição. Se o problema persistir, entre em contato com a organização do evento.');
			}
		}else{
			$this->session->set_flashdata('erro','Vagas esgotadas.');
		}
		redirect('Painel/selecionar');
	}

	public function desinscrever($id){
		if(!isset($this->session->usuario)){
			$this->session->set_flashdata("erro",'Você precisa entrar para ter acesso a essa área.');
			redirect(base_url());
		}
		if($this->modelpalestra->desinscrever($id)){
			$this->session->set_flashdata('sucesso','Remoção realizada.');
		}else{
			$this->session->set_flashdata('erro','Houve um erro ao remover. Se o problema persistir, entre em contato com a organização do evento.');
		}
		redirect('Painel/selecionar');
	}

	public function alterar_senha(){
		if(!isset($this->session->usuario)){
			$this->session->set_flashdata("erro",'Você precisa entrar para ter acesso a essa área.');
			redirect(base_url());
		}

		$nova_senha = $this->input->post('nova_senha');
		$nova_senha_2 = $this->input->post('nova_senha_2');

		if($nova_senha == $nova_senha_2){
			$dados['senha'] = md5($nova_senha);
			if($this->modelcongressista->update($dados)){
				$this->session->set_flashdata('sucesso','Senha alterada com sucesso.');
				redirect('Painel/meus_dados');
			}else{
				$this->session->set_flashdata('erro','Houve um erro ao alterar sua senha. Se o problema persistir, entre em contato com a organização do evento.');
				redirect('Painel/alterar_senha');
			}
		}else{
			$this->session->set_flashdata('erro','As senhas não conferem.');
			redirect('Painel/alterar_senha');
		}
		
	}

	public function nova_senha(){
		$dados['email'] = $this->input->post('email');
		$dados['cpf'] = $this->input->post('cpf');

		if($this->modelcongressista->nova_senha($dados)){

		}else{
			$this->session->set_flashdata('erro','Houve um erro ao alterar a senha. Se o problema persistir, entre em contato com a organização do evento.');
		}
		redirect(base_url());
	}


}

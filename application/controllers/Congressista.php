<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Congressista extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('congressista_model','modelcongressista');
	}

	public function insere(){
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

	public function alterar_senha(){
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


}

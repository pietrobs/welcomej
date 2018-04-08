<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('usuario_model','modelusuario');
	}

	public function index(){
		$this->load->view('login');
	}

	public function logar(){
		$data_login['email'] = $this->input->post('email');
		$data_login['senha'] = md5($this->input->post('senha'));

		// var_dump($data_login);die();		

		$usuario = $this->modelusuario->login($data_login);

		if(count($usuario) == 0){
			$this->session->set_flashdata('erro','Email e/ou senha inválido(s)');
			redirect(base_url());
		}else{
			
			$this->session->set_userdata('usuario',$usuario);

			redirect('Painel');
		}
	}

}

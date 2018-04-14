<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprovante extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('congressista_model','modelcongressista');
    $this->load->model('comprovante_model','modelComprovante');
  }

  public function aprovar($id){
    $this->modelComprovante->setComprovanteStatus($id, 2);
    redirect("Admin/comprovantes");
  }

  public function recusar($id = 0, $justificativa = ""){
    if(null !== ($this->input->post("id"))){
      $id = $this->input->post("id");
    }
    if(null !== ($this->input->post("justificativa"))){
      $justificativa = $this->input->post("justificativa");
    }

    $this->modelComprovante->setComprovanteStatus($id, 1, $justificativa);
    redirect("Admin/comprovantes");
  }

}
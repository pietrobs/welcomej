<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minicurso extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('minicurso_model','modelminicurso');
  }

  public function insere(){
    $dados["ministrante"] = $this->input->post("ministrante");
    $dados["nome_palestra"] = $this->input->post("nome_palestra");
    $dados["descricao_palestra"] = $this->input->post("descricao_palestra");
    $dados["local"] = $this->input->post("local");
    $dados["limite"] = $this->input->post("limite");
    $dados["dia_palestra"] = $this->input->post("dia_palestra");
    $dados["periodo_palestra"] = $this->input->post("periodo_palestra");

    if($this->modelminicurso->insert($dados)){
      $this->session->set_flashdata('sucesso','O cadastro foi efetuado!');
    }else{
      $this->session->set_flashdata('erro','Houve um erro ao efetuar o cadastro!');
    }

    redirect(base_url("Admin/eventos"));
  }

  public function atualiza(){
    $dados["ministrante"] = $this->input->post("ministrante");
    $dados["nome_palestra"] = $this->input->post("nome_palestra");
    $dados["descricao_palestra"] = $this->input->post("descricao_palestra");
    $dados["local"] = $this->input->post("local");
    $dados["limite"] = $this->input->post("limite");
    $dados["dia_palestra"] = $this->input->post("dia_palestra");
    $dados["periodo_palestra"] = $this->input->post("periodo_palestra");

    if($this->modelminicurso->update($dados, $this->input->post("id"))){
      $this->session->set_flashdata('sucesso','O evento foi atualizado!');
    }else{
      $this->session->set_flashdata('erro','Houve um erro ao atualizar o evento!');
    }

    redirect(base_url("Admin/eventos"));
  }

  public function deletar($id){
    if($this->modelminicurso->delete($id)){
      $this->session->set_flashdata('sucesso','O evento foi atualizado!');
    }else{
      $this->session->set_flashdata('erro','Houve um erro ao atualizar o evento!');
    }

    redirect(base_url("Admin/eventos"));
  }
}
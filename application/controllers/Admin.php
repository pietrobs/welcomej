<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Search_filter.php");

class Admin extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model("minicurso_model", "eventoModel");
    $this->load->model("congressista_model", "congressistaModel");
    $this->load->model("comprovante_model", "comprovanteModel");
    $this->load->library("ListMaker");
  }

  public function index(){
    $this->load->view('admin/html-header-admin');
    $this->load->view('admin/header-admin');
    $this->load->view('admin/home');
    $this->load->view('admin/footer-admin');
  }
  public function eventos($attribute = 'nome_palestra', 
                          $order_by = 'ASC', 
                          $quantidade = 10, 
                          $inicio = 0, 
                          $nome = ''){

    $this->load->library('pagination');
    $searchFilter = $this->eventoModel->defaultFilter();

    if(count($this->input->post()) != 0){ 
        $searchFilter->setAttribute($this->input->post('attribute'));
        $searchFilter->setOrderBy($this->input->post('order_by'));
        $searchFilter->setLimit($this->input->post('quantidade'));
        $searchFilter->setLike($this->input->post('search_by'));
    }else{
        $searchFilter->setAttribute($attribute);
        $searchFilter->setOrderBy($order_by);
        $searchFilter->setLimit($quantidade);
        $searchFilter->setOffset($inicio);
        $searchFilter->setLike($nome);
    }

    //echo $searchFilter->getAttribute();
    $dados['eventos']  = $this->eventoModel->list_filter($searchFilter); 
    $dados['paginacao'] = $this->listmaker->getLinks($searchFilter, 
                                                     $this->eventoModel);
    $dados['filtros'] = $searchFilter;

    $this->load->view('admin/html-header-admin');
    $this->load->view('admin/header-admin');
    $this->load->view('admin/eventos/eventos', $dados);
    $this->load->view('admin/eventos/modal');
    $this->load->view('admin/footer-admin');
  }

  public function congressistas($attribute = 'nome', 
                                $order_by = 'ASC', 
                                $quantidade = 10, 
                                $inicio = 0, 
                                $nome = ''){

    $this->load->library('pagination');
    $searchFilter = $this->congressistaModel->defaultFilter();

    if(count($this->input->post()) != 0){ 
        $searchFilter->setAttribute($this->input->post('attribute'));
        $searchFilter->setOrderBy($this->input->post('order_by'));
        $searchFilter->setLimit($this->input->post('quantidade'));
        $searchFilter->setLike($this->input->post('search_by'));
    }else{
        $searchFilter->setAttribute($attribute);
        $searchFilter->setOrderBy($order_by);
        $searchFilter->setLimit($quantidade);
        $searchFilter->setOffset($inicio);
        $searchFilter->setLike($nome);
    }

    //echo $searchFilter->getAttribute();
    $dados['congressistas']  = $this->congressistaModel->list_filter($searchFilter); 
    $dados['paginacao'] = $this->listmaker->getLinks($searchFilter, 
                                                     $this->congressistaModel);
    $dados['filtros'] = $searchFilter;

    $this->load->view('admin/html-header-admin');
    $this->load->view('admin/header-admin');
    $this->load->view('admin/congressista/congressista', $dados);
    $this->load->view('admin/congressista/modal');
    $this->load->view('admin/footer-admin');
  }

  public function comprovantes($attribute = 'nome', 
                                $order_by = 'ASC', 
                                $quantidade = 10, 
                                $inicio = 0, 
                                $nome = ''){

    $this->load->library('pagination');
    $searchFilter = $this->comprovanteModel->defaultFilter();

    if(count($this->input->post()) != 0){ 
        $searchFilter->setAttribute($this->input->post('attribute'));
        $searchFilter->setOrderBy($this->input->post('order_by'));
        $searchFilter->setLimit($this->input->post('quantidade'));
        $searchFilter->setLike($this->input->post('search_by'));
    }else{
        $searchFilter->setAttribute($attribute);
        $searchFilter->setOrderBy($order_by);
        $searchFilter->setLimit($quantidade);
        $searchFilter->setOffset($inicio);
        $searchFilter->setLike($nome);
    }

    //echo $searchFilter->getAttribute();
    $comprovantes = $this->comprovanteModel->list_filter($searchFilter); 
    foreach ($comprovantes as $key => $comprovante) {
      $comprovantes[$key]["foto_comprovante"] = base_url("uploads/comprovante/".$comprovante["foto_comprovante"]);
    }
    $dados['congressistas']  = $comprovantes;
    $dados['paginacao'] = $this->listmaker->getLinks($searchFilter, 
                                                     $this->comprovanteModel);
    $dados['filtros'] = $searchFilter;

    $this->load->view('admin/html-header-admin');
    $this->load->view('admin/header-admin');
    $this->load->view('admin/comprovantes/comprovantes', $dados);
    $this->load->view('admin/comprovantes/modal');
    $this->load->view('admin/footer-admin');
  }

  public function relatorios(){

    $dados['palestras'] = $this->eventoModel->list_filter($this->eventoModel->defaultFilter());
    $this->load->view('admin/html-header-admin');
    $this->load->view('admin/header-admin');
    $this->load->view('admin/relatorios/relatorios', $dados);
    $this->load->view('admin/footer-admin'); 
  }

  public function presencaEvento($idPalestra = NULL){
    if(is_null($idPalestra)){
      $searchFilter = $this->eventoModel->defaultFilter();
      if(count($this->input->post()) != 0){ 
        $searchFilter->setAttribute($this->input->post('attribute'));
        $searchFilter->setOrderBy($this->input->post('order_by'));
        $searchFilter->setLimit($this->input->post('quantidade'));
        $searchFilter->setLike($this->input->post('search_by'));
      }

      $dados['eventos']  = $this->eventoModel->list_filter($searchFilter); 
      $dados['paginacao'] = $this->listmaker->getLinks($searchFilter, 
                                                       $this->eventoModel);
      $dados['filtros'] = $searchFilter;

      $this->load->view('admin/html-header-admin');
      $this->load->view('admin/header-admin');
      $this->load->view('admin/presenca/presenca', $dados);
      $this->load->view('admin/footer-admin'); 
    }else{
      $searchFilter = $this->congressistaModel->defaultFilter();
      if(count($this->input->post()) != 0){ 
        $searchFilter->setAttribute($this->input->post('attribute'));
        $searchFilter->setOrderBy($this->input->post('order_by'));
        $searchFilter->setLimit($this->input->post('quantidade'));
        $searchFilter->setLike($this->input->post('search_by'));
      }else{
        $searchFilter->setAttribute("presenca");
      }

      $dados['inscritos']  = $this->eventoModel->list_filter_inscritos($searchFilter, $idPalestra); 
      $dados['paginacao'] = $this->listmaker->getLinks($searchFilter, 
                                                       $this->eventoModel);
      $dados['filtros'] = $searchFilter;
      $dados['idPalestra'] = $idPalestra;

      $this->load->view('admin/html-header-admin');
      $this->load->view('admin/header-admin');
      $this->load->view('admin/presenca/registrar', $dados);
      $this->load->view('admin/footer-admin'); 
    }
  }

  
}

?>
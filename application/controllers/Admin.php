<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Search_filter.php");

class Admin extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model("minicurso_model", "eventoModel");
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

}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Search_filter.php");

class Relatorio extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('download');
    $this->load->model("minicurso_model", "eventoModel");
    $this->load->model("palestra_model", "palestraModel");
    $this->load->model("congressista_model", "congressistaModel");
    $this->load->model("realizarPagamento_model", "pagamentoModel");
  }

  public function gerar(){
    $lista_palestras = $this->input->post("palestras_list");
    $relatorio = "sep=,\n";
    $relatorio .= $this->geraRelatorioGeral($this->input->post("evento_list"));
    $relatorio .= $this->gerarRelatorioEventos($lista_palestras);
    echo $relatorio;
    $relatorio = mb_convert_encoding($relatorio, 'UTF-16LE', 'UTF-8');    
    force_download("relatorio.csv", $relatorio);
    //echo "<script>window.close();</script>";
  }

  private function geraRelatorioGeral($options){
    $relatorio = "";
    if(in_array("finanças", $options)){
      $relatorio .= $this->gerarRelatorioFinanca(); 
    }
    if(in_array("congressista", $options)){
      $relatorio .= $this->gerarRelatorioCongressistas($this->input->post("congressistas_list"));
    }
    //var_dump($relatorio);
    //exit();
    return $relatorio;
  }

  private function gerarRelatorioFinanca(){
    $relatorio = "";
    $pagamentos = $this->pagamentoModel->getPagamentos();
    $valor = $pagamentos[0]["quantidade"] * 150.0 + $pagamentos[1]["quantidade"] * 110; 
    $relatorio .= "FINANÇAS\n";
    $relatorio .= "Valor total:,".sprintf("%.2f",$valor)."\n";
    $relatorio .= "Valor Nucleo:,".sprintf("%.2f",$valor * 0.93)."\n";
    $relatorio .= "Valor EJComp:,".sprintf("%.2f",$valor * 0.07)."\n";
    $relatorio .= "\n\n";
    return $relatorio;
  }

  private function gerarRelatorioCongressistas($options){
    if(!count($options))
      return ;
    
    $relatorio = "";
    $relatorio .= "CONGRESSISTAS\n";
    foreach ($options as $key => $option) {
      switch ($option) {
        case 1:
          $relatorio .= "Nome,";
          break;
        case 2:
          $relatorio .= "Email,";
          break;
        case 3:
          $relatorio .= "CPF,";
          break;
        case 4:
          $relatorio .= "RG,";
          break;
        case 5:
          $relatorio .= "Empresa Junior,";
          break;
        case 6:
          $relatorio .= "Filiada,";
          break;
        case 7:
          $relatorio .= "Possui Restrição Alimentar,";
          break;
        case 8:
          $relatorio .= "Restrições Alimentares,";
          break;
        case 9:
          $relatorio .= "Pagou,";
          break;
        default:
          # code...
          break;
      }

    }
    $relatorio .= "\n";

    $congressistas = $this->congressistaModel->list_filter_relatorio($this->congressistaModel->defaultFilter(), in_array(9, $options));
    //exit();
    foreach ($congressistas as $key => $congressista) {
      if(in_array(1, $options)){
        $relatorio .= $congressista["nome"].",";
      }
      if(in_array(2, $options)){
        $relatorio .= $congressista["email"].",";
      }
      if(in_array(3, $options)){
        $relatorio .= '"'.$congressista["cpf"].'",';
      }
      if(in_array(4, $options)){
        $relatorio .= $congressista["rg"].",";
      }
      if(in_array(5, $options)){
        $relatorio .= $congressista["empresa_junior"].",";
      }
      if(in_array(6, $options)){
        $relatorio .= $congressista["filiado_nucleo"].",";
      }
      if(in_array(7, $options)){
        $relatorio .= (($congressista["restricao_alimentar"]) ? "Possui" : "Não possui").",";
      }
      if(in_array(8, $options)){
        $relatorio .= '"'.$congressista["descricao_restricao_alimentar"].'",';
      }
      if(in_array(9, $options)){
        $relatorio .= ($congressista["ja_pagou"] ? "Pagou" : "Não pagou").",";
      }
      $relatorio .= "\n";
    }
    $relatorio .= "\n\n";

    return $relatorio;
  }

  private function gerarRelatorioEventos($eventos){
    $relatorio = "";
    foreach ($eventos as $key => $evento) {
      $relatorio .= "Nome palestra,Ministrante palestra,Limite inscrições,Quantidade inscrições\r\n";
      $ev = $this->eventoModel->get($evento);
      $insc = $this->eventoModel->quantidadeInscritos($evento);
      $inscritos = $this->eventoModel->getInscritos($evento);
      $relatorio .= implode(",", [$ev["nome_palestra"], $ev["ministrante"], $ev["limite"], ($insc) ? $insc : 0 ]);
      $relatorio .= "\n\nInscritos palestra ".$ev["nome_palestra"]."\n";
      $relatorio .= "Nome,Empresa Junior,Presença\n";
      foreach ($inscritos as $key => $inscrito) {
        $relatorio .= implode(",", [$inscrito["nome"], $inscrito["empresa_junior"], ($inscrito["presenca"]) ? "Presente" : "Não presente"]);
        $relatorio .= "\n";
      }
      $relatorio .= "\n\n\n";
    }
    return $relatorio;
  }
}

?>
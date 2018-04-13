<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('download');
    $this->load->model("minicurso_model", "eventoModel");
    $this->load->model("palestra_model", "palestraModel");
  }

  public function gerar(){
    $lista_palestras = $this->input->post("palestras_list");
    $relatorio = "sep=,\n";
    $relatorio .= $this->gerarRelatorioEventos($lista_palestras);
    echo $relatorio;
    $relatorio = mb_convert_encoding($relatorio, 'UTF-16LE', 'UTF-8');    
    force_download("relatorio.csv", $relatorio);
    //echo "<script>window.close();</script>";
  }

  private function gerarRelatorioEventos($eventos){
    $relatorio = "";
    foreach ($eventos as $key => $evento) {
      $relatorio .= "Nome palestra,Ministrante palestra,Limite inscrições,Quantidade inscrições\r\n";
      $ev = $this->eventoModel->get($evento);
      $insc = $this->eventoModel->quantidadeInscritos($evento);
      $inscritos = $this->eventoModel->getInscritos($evento);
      $relatorio .= implode(",", [$ev["nome_palestra"], $ev["ministrante"], $ev["limite"], ($insc) ? $insc : 0 ]);
      $relatorio .= "\n\nInscritos palestra\n";
      $relatorio .= "Nome,Empresa Junior,Presença\n";
      foreach ($inscritos as $key => $inscrito) {
        $relatorio .= implode(",", [$inscrito["nome"], $inscrito["empresa_junior"]]);
        $relatorio .= "\n";
      }
      $relatorio .= "\n\n\n";
    }
    return $relatorio;
  }
}

?>
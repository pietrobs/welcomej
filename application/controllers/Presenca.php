<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presenca extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model("presenca_model", "presencaModel");
  }

  public function marcarPresenca($idPalestra, $idUsuario){
    $this->presencaModel->marcarPresenca($idPalestra, $idUsuario);
    redirect("Admin/presencaEvento/$idPalestra");
  }

  public function removerPresenca($idPalestra, $idUsuario){
    $this->presencaModel->removerPresenca($idPalestra, $idUsuario);
    redirect("Admin/presencaEvento/$idPalestra");
  }
}

?>
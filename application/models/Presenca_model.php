<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Presenca_model extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  public function marcarPresenca($idPalestra, $idUsuario){
    $this->db->where("id_palestra", $idPalestra);
    $this->db->where("id_congressista", $idUsuario);
    return $this->db->update("congressista_palestra", ["presenca" => 1]);
  }

  public function removerPresenca($idPalestra, $idUsuario){
    $this->db->where("id_palestra", $idPalestra);
    $this->db->where("id_congressista", $idUsuario);
    return $this->db->update("congressista_palestra", ["presenca" => 0]);
  }

}
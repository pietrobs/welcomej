<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comprovante_model extends CI_Model{
  private $table = "pagamento";

  public function num_rows(searchFilter $filter){ 
    $this->db = $filter->numRows($this->db, false); 
    return $this->db->get($this->table)->num_rows(); 
  }
 
  public function list_filter(searchFilter $filter){ 
      $this->db = $filter->applyFilter($this->db, false); 
      $this->db->join("congressista", "id_usuario = congressista.id", "INNER");
      $this->db->from($this->table); 
      $result = $this->db->get()->result_array(); 
      return $result; 
  } 

  public function join(){
    $this->db->join("congressista", "id_usuario = congressista.id", "INNER");
  }
 
  public function defaultFilter(){ 
      return new searchFilter("pagamento", 
                              "status", 
                              searchFilter::ASCENDANT, 
                              0, 
                              20, 
                              "congressista.nome"); 
  }

  public function setComprovanteStatus($id, $status, $justificativa = ""){
    date_default_timezone_set("America/Sao_Paulo");
    $this->db->where("id", $id);
    $data = ["status" => $status, "data_avaliacao" => date('Y-m-d H:i:s')];
    if($justificativa != ""){
      $data["justificativa"] = $justificativa;
    }
    return $this->db->update($this->table, $data);
  }
}
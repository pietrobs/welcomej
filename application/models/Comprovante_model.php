<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comprovante_model extends CI_Model{
  private $table = "pagamento";

  public function num_rows(searchFilter $filter){ 
    $this->db = $filter->numRows($this->db); 
    return $this->db->get($this->table)->num_rows(); 
  } 
 
  public function list_filter(searchFilter $filter){ 
      $this->db = $filter->applyFilter($this->db); 
      $this->db->join("congressista", "id_usuario = congressista.id", "INNER");
      $this->db->from($this->table); 
      $result = $this->db->get()->result_array(); 
      return $result; 
  } 
 
  public function defaultFilter(){ 
      return new searchFilter("congressista", 
                              "nome", 
                              searchFilter::ASCENDANT, 
                              0, 
                              20, 
                              "nome"); 
  }

  public function setComprovanteStatus($id, $status){
    $this->db->where("id", $id);
    return $this->db->update($this->table, ["status" => $status]);
  }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Minicurso_model extends CI_Model{
  private $table = "palestra";


  public function __construct(){
    parent::__construct();
  }

  public function insert($dados){
    return $this->db->insert($this->table,$dados);
  }

  public function update($dados, $id){
    $this->db->where('id_palestra',$id);
    return $this->db->update($this->table,$dados);
  }

  public function delete($id){
    $this->db->where('id_palestra', $id);
    return $this->db->delete($this->table);
  }

  public function num_rows(searchFilter $filter){
    $this->db = $filter->numRows($this->db);
    return $this->db->get($this->table)->num_rows();
  }

  public function list_filter(searchFilter $filter){
        $this->db = $filter->applyFilter($this->db);
        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function defaultFilter(){
        return new searchFilter($this->table,
                                "nome_palestra",
                                searchFilter::ASCENDANT,
                                0,
                                20,
                                "nome_palestra");
    }

}
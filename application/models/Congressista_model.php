<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Congressista_model extends CI_Model{
	private $table = "congressista";


	public function __construct(){
		parent::__construct();
	}

	public function insert($dados){
		$this->db->insert($this->table,$dados);
	}

	public function update($dados){
		$this->db->where('id',$this->session->usuario['id']);
		return $this->db->update($this->table,$dados);
	}

	public function get(){
		$this->db->where('id',$this->session->usuario['id']);
		return $this->db->get($this->table)->row();
	}

	public function getArray(){
		$this->db->where('id',$this->session->usuario['id']);
		return $this->db->get($this->table)->row_array();
	}

	public function getAcao(){
		$this->db->where('id',$this->session->usuario['id']);
		$usuario = $this->db->get($this->table)->row();

		if($usuario->ja_entrou == 0){
			$entrou['ja_entrou'] = 1;
			$this->db->flush_cache();
			$this->db->where('id',$this->session->usuario['id']);
			$this->db->update($this->table,$entrou);
			return 0;
		}else if($usuario->ja_pagou == 0){
			return 1;
		}else{
			return 2;
		}
	}


	public function getPagamento(){
		$this->db->where('id_usuario',$this->session->usuario['id']);
		$this->db->join('status_pagamento','pagamento.id_status_pagamento = status_pagamento.id');
		return $this->db->get('pagamento')->row();
	}


	//ADMIN AREA
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
                              "nome",
                              searchFilter::ASCENDANT,
                              0,
                              20,
                              "nome");
  }

  public function getById($id){
  	$this->db->where('id',$id);
		return $this->db->get($this->table)->row();
  }

  public function setar_pagamento($id, $flag){
  	$this->db->where('id', $id);
  	return $this->db->update($this->table, ['ja_pagou' => $flag]);
  }
}
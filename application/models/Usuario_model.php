<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function login($data){
		$this->db->where($data);
		return $this->db->get('congressista')->row_array();
	}

}
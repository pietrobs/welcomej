<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Palestra_model extends CI_Model{
	private $table = "palestra";


	public function __construct(){
		parent::__construct();
	}

	public function get($dia){
		$this->db->where('dia_palestra',$dia);
		return $this->db->get($this->table)->result();
	}

	public function getPalestra($id_palestra){
		$this->db->order_by('periodo_palestra','ASC');
		$this->db->where('id_palestra',$id_palestra);
		return $this->db->get($this->table)->row();
	}

	public function getInscrito($id_usuario){
		$this->db->where('congressista_palestra.id_congressista',$id_usuario);
		$this->db->join('congressista_palestra','palestra.id_palestra = congressista_palestra.id_palestra');
		return $this->db->get($this->table)->result();
	}

	public function cheio($id_palestra){
		$this->db->select('limite');
		$this->db->where('id_palestra',$id_palestra);
		$limite = $this->db->get($this->table)->row()->limite;

		$this->db->flush_cache();

		$this->db->where('id_palestra',$id_palestra);
		$this->db->from('congressista_palestra');
		$inscritos = $this->db->count_all_results();

		if($inscritos >= $limite) return true;
		return false;
	}

	public function participar($dados){
		return $this->db->insert('congressista_palestra',$dados);
	}

	public function inscrito($id_palestra){
		$this->db->where('id_palestra',$id_palestra);
		$this->db->where('id_congressista',$this->session->usuario['id']);
		$this->db->from('congressista_palestra');
		return $this->db->count_all_results() != 0;
	}

	public function desinscrever($id){
		$this->db->where('id',$id);
		return $this->db->delete('congressista_palestra');
	}


}
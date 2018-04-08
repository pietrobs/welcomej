<?php 

class RealizarPagamento_model extends CI_Model
{
	
	public function __construct(){
		parent::__construct();
	}


	public function seleciona_usuario($id_usuario){
		$this->db->where('id', $id_usuario);

		return $this->db->get('usuario')->row();
	}

	public function salvar($dados){
		$dados_congressista['ja_pagou'] = true;
		$this->db->where('id',$this->session->usuario['id']);
		$this->db->update('congressista',$dados_congressista);

		$this->db->flush_cache();

		return $this->db->insert('pagamento', $dados);
	}

	public function atualizar_status($codigo_transacao, $dados){
		$this->db->where('codigo_transacao', $codigo_transacao);
		return $this->db->update('pagamento', $dados);
	}


	
}
?>
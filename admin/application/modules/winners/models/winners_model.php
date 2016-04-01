<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Winners_model extends CI_Model {

	public function insertNewWinner($data)
	{
		$record = array(
			'header' 	=> $data['title'],
			'content' => $data['content'],
			'main_img' 	=> $data['image_path'],
			//'W_Game'	=> $data['game'],
			$data['game']	=> '1',
		);

		$this->db->insert('t_winners', $record);
	}
	public function get_winners(){

		$this->db->select('*');
		$this->db->from('t_winners');
		$query = $this->db->get();
		return $query->result();

	}
	public function getWinner($winner_id){

		$this->db->select('*');
		$this->db->from('t_winners');
		$this->db->where('id',$winner_id);
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->row();
	}

	public function updateWinner($winner_id,$data){
		$record = array(
			'header' 	=> $data['title'],
			'content' => $data['content'],
			'main_img' 	=> $data['image_path'],
			//'W_Game'	=> $data['game'],
			$data['game']	=> '1',
		);
		$this->db->where('id',$winner_id);
		$this->db->update('t_winners', $record);

	}

	public function deleteWinner($winner_id){
		$this->db->where('id', $winner_id);
		$this->db->delete('t_winners');
	}


}











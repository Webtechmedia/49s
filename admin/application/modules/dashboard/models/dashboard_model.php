<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function getLatestMembers(){
		$this->db->select('*');
		$this->db->from('members');
		$this->db->order_by('U_Id','desc');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	public function removeMember($member_id){
		$this->db->where('U_Id', $member_id);
		$this->db->delete('members');
		return $this->db->affected_rows() > 0;
	}

}
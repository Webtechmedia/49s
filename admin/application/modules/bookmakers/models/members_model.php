<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members_model extends CI_Model {
	public function getMembers($sortfield, $order,$per_page,$offset,$search)
	{

		$this->db->select('*');
		$this->db->from('members');
		if($search!=''){
			$this->db->where("(`U_FirstName` LIKE '%$search%' OR  `U_Surname` LIKE '%$search%' OR `U_Email` LIKE '%$search%' OR `U_Postcode` LIKE '%$search%' )");
		}
		if($this->session->userdata('localization')=='all'){
		}elseif($this->session->userdata('localization')=='uk'){
			$this->db->where_in('U_Country', array('GB'));
		}elseif($this->session->userdata('localization')=='foreign'){
			$this->db->where_not_in('U_Country',array('GB'));
		}

		//$this->db->order_by($sortfield, $order);
		$this->db->limit($per_page,$offset);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
		 	return $query->result();
		} else {
			return false;
		}
	}

	public function get_row_count($search)
	{
		$this->db->select('*');
		$this->db->from('members');
		if($search!=''){
			$this->db->where("(`U_FirstName` LIKE '%$search%' OR  `U_Surname` LIKE '%$search%' OR `U_Email` LIKE '%$search%')");
		}
		if($this->session->userdata('localization')=='all'){
		}elseif($this->session->userdata('localization')=='uk'){
			$this->db->where_in('U_Country', array('GB'));
		}elseif($this->session->userdata('localization')=='foreign'){
			$this->db->where_not_in('U_Country',array('GB'));
		}
		$query = $this->db->get();

		if($query->num_rows() > 0) {
		 	return $query->num_rows();
		} else {
			return 0;
		}
	}
	public function removeMember($member_id){
		$this->db->where('U_Id', $member_id);
		$this->db->delete('members');
		return $this->db->affected_rows() > 0;
	}

	public function getAllMembers(){
		return $query = $this->db->get('members');
	}

	public function getMembersByIds($selected){
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where_in("U_Id",$selected );
		return $this->db->get();
	}
}
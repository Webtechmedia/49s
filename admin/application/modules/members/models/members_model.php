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

		$this->db->order_by($sortfield, $order);
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
	public function getMember($member_id){
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('U_Id',$member_id );
		$query = $this->db->get();
		return $query->result();
	}
	public function updateMember($member_id,$data){

		if($data['49s']){$game49=1;}else{ $game49=0;}
		if($data['irish']){$irish=1;}else{ $irish=0;}
		if($data['vhr']){$vhr=1;}else{ $vhr=0;}
		if($data['vgr']){$vgr=1;}else{ $vgr=0;}
		if($data['rapido']){$rapido=1;}else{ $rapido=0;}

		$record = array(
				'U_FirstName' 		=> $data['first_name'],
				'U_Surname' 		=> $data['surname'],
				'U_Email' 			=> $data['email'],
				'U_Postcode'		=> $data['postcode'],
				'U_Age' 			=> $data['age'],
				'U_Gender' 			=> $data['gender'],
				'U_Plays49s' 		=> $game49,
				'U_PlaysILB'		=> $irish,
				'U_PlaysVHR' 		=> $vhr,
				'U_PlaysVGR' 		=> $vgr,
				'U_PlaysRapido' 	=> $rapido,
				'U_SendPromotions'	=> $data['send_promotions'],
				'U_Address1' 		=> $data['address1'],
				'U_Address2'		=> $data['address2'],
				'U_Town' 			=> $data['town'],
				'U_County' 			=> $data['county'],
				'U_Country' 		=> $data['country'],
				'U_Competitions'	=> $data['competitions'],
				'U_IsSubscribed'	=> $data['is_subscribed'],
		);

		$this->db->where('U_Id',$member_id);
		$this->db->update('members', $record);
	}


}









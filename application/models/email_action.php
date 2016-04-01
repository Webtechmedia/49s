<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Email_action extends CI_Model
{

	public function is_registered($email){
		$this->db->where('U_Email',$email);
		$this->db->from('members');
		$query = $this->db->get();
		$member_row = null;
		foreach($query->result() as $row){
			$member_row = $row;
		}
		return $member_row;
	}

	public function is_able_to_enter_competition($user){
		if($user->U_Country == "GB" || $user->U_Country == "UK" ){
			return true;
		} else {
			return false;
		}
	}

	public function is_active_competition(){
		$this->db->where('status',1);
		$this->db->from('competitions');
		$query = $this->db->get();
		$member_row = null;
		foreach($query->result() as $row){
			$member_row = $row;
		}
		return $member_row;
	}

	public function enter_competition($competition,$user){
		$this->db->set('competition_id',$competition->id);
		$this->db->set('user_id',$user->U_Id);
		$this->db->insert('competitions_to_users');
		return $this->db->insert_id();
	}

	public function is_entered_in_competition($competition,$user){
		$this->db->where('competition_id',$competition->id);
		$this->db->where('user_id',$user->U_Id);
		$this->db->from('competitions_to_users');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function user_register($post){

		$this->db->set('U_FirstName',$post['firstName']);
		$this->db->set('U_Surname',$post['surname']);
		$this->db->set('U_Email',$post['email']);
		$this->db->set('U_Postcode',$post['postcode']);
		$this->db->set('U_Age',$post['age']);
		$this->db->set('U_Gender',$post['gender']);
		$this->db->set('U_Plays49s',$post['plays49s']);
		$this->db->set('U_PlaysILB',$post['playsILB']);
		$this->db->set('U_PlaysVHR',$post['playsVHR']);
		$this->db->set('U_PlaysVGR',$post['playsVGR']);
		$this->db->set('U_PlaysRapido',$post['playsRapido']);
		$this->db->set('U_SendPromotions',$post['sendPromotions']);
		$this->db->set('U_Address1',$post['address1']);
		$this->db->set('U_Address2',$post['address2']);
		$this->db->set('U_Town',$post['town']);
		$this->db->set('U_County',$post['county']);
		$this->db->set('U_Country',$post['country']);

		$this->db->insert('members');
		$user_id = $this->db->insert_id();

		$this->db->where('U_Id',$user_id);
		$this->db->from('members');
		$query = $this->db->get();
		$member_row = null;
		foreach($query->result() as $row){
			$member_row = $row;
		}
		return $member_row;


	}

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */
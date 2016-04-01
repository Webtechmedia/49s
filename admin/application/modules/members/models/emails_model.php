<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails_model extends CI_Model {
	public function getTextEmailTemplates()
	{

		$this->db->select('*');
		$this->db->from('email_templates');
		$this->db->where('type','0');
		$this->db->order_by('created', 'desc');
		$query = $this->db->get();

 		return $query->result();

	}
	public function getHtmlEmailTemplates()
	{

		$this->db->select('*');
		$this->db->from('email_templates');
		$this->db->where('type','1');
		$this->db->order_by('created', 'desc');
		$query = $this->db->get();

		return $query->result();

	}
	public function getTextEmailContent($id){
		$this->db->select('content');
		$this->db->from('email_templates');
		$this->db->where('type','0');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row('content');

	}
	public function getHtmlEmailContent($id){
		$this->db->select('content');
		$this->db->from('email_templates');
		$this->db->where('type','1');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row('content');
	}
	public function deleteEmailTemplate($id){

		$this->db->delete('email_templates', array('id' => $id));
		return $this->db->affected_rows();

	}
	public function saveNewEmailTemplate( $type, $subject, $content){
		$this->db->set('type', $type);
		$this->db->set('template_name', $subject);
		$this->db->set('content', $content);
		$this->db->set('created', 'NOW()', FALSE);
		$this->db->insert('email_templates');
	}

	public function getAllEmailsRecipient(){
		$this->db->select('U_FirstName,U_Surname,U_Email,U_Postcode,U_Country');
		$this->db->from('members');
		//$this->db->where('U_SendPromotions','1');
		$query = $this->db->get();
		return $query->result();
	}
	public function getSelectedEmailsRecipient($email_selected){
		$this->db->select('U_FirstName,U_Surname,U_Email,U_Postcode,U_Country');
		$this->db->from('members');
		//$this->db->where('U_SendPromotions','1');
		$this->db->where_in('U_Id',$email_selected);
		$query = $this->db->get();
		return $query->result();
	}
	public function getGameEmailsRecipient($games){
		$this->db->select('U_FirstName,U_Surname,U_Email,U_Postcode,U_Country');
		$this->db->from('members');
		if(isset($games['49s'])){  $this->db->where('U_Plays49s','1'); }
		if(isset($games['ilb'])){  $this->db->where('U_PlaysILB','1');}
		if(isset($games['rapido'])){  $this->db->where('U_PlaysRapido','1'); }
		if(isset($games['vgr'])){  $this->db->where('U_PlaysVGR','1');}
		if(isset($games['vhr'])){  $this->db->where('U_PlaysVHR','1'); }
		//$this->db->where('U_SendPromotions','1');
		$query = $this->db->get();
		return $query->result();
	}
	public function getCountryEmailsRecipient($country){

		$this->db->select('U_FirstName,U_Surname,U_Email,U_Postcode,U_Country');
		$this->db->from('members');
		if($country=='uk'){  $this->db->where_in('U_Country', array('GB')); }
		if($country=='foreign'){  $this->db->where_not_in('U_Country',array('GB'));}
		//$this->db->where('U_SendPromotions','1');
		$query = $this->db->get();
		return $query->result();
	}

}









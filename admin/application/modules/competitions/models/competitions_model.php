<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Competitions_model extends CI_Model {

	public function getAllCompetitions()
	{
		$this->db->select('*');
		$this->db->from('competitions');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
		 	return $query->result();
		} else {
			return false;
		}
	}
	public function getCompetition($id){
		$this->db->select('*');
		$this->db->from('competitions');
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function inserNewCompetition($data){

	 	if($data['add']){

	 		if($data['status']=='1'){
	 			$this->db->set('status', '0');
	 			$this->db->where('status','1');
	 			$this->db->update('competitions');
	 		}

	 		$this->db->set('title', $data['title']);
	 		$this->db->set('content', $data['content']);
	 		$this->db->set('localization', $data['localization']);

	 		$date = DateTime::createFromFormat('d-m-Y H:i a', $data['date_from']);
	 		$this->db->set('date_from', $date->format('Y-m-d H:i:s'));

	 		$date = DateTime::createFromFormat('d-m-Y H:i a', $data['date_to']);
	 		$this->db->set('date_to', $date->format('Y-m-d H:i:s'));

			if($data['draw_date']!=''){
				$date = DateTime::createFromFormat('d-m-Y H:i a', $data['draw_date']);
				$this->db->set('draw_date', $date->format('Y-m-d H:i:s'));
			}

	 		$this->db->set('create_date', 'NOW()', FALSE);

	 		$this->db->set('status', $data['status']);
	 		$this->db->set('first_prize', $data['first_prize']);
	 		$this->db->set('first_prize_qty', $data['first_prize_qty']);
	 		$this->db->set('second_prize', $data['second_prize']);
	 		$this->db->set('second_prize_qty', $data['second_prize_qty']);
	 		$this->db->set('third_prize', $data['third_prize']);
	 		$this->db->set('third_prize_qty', $data['third_prize_qty']);

			$this->db->insert('competitions');

			$this->session->set_flashdata('message', 'Competition Added!!!');
			redirect('competitions');

	 	}
	}
	public function updateCompetition($data){

		if($data['save']){

			$this->db->set('title', $data['title']);
			$this->db->set('content', $data['content']);
			$this->db->set('localization', $data['localization']);

			$date = DateTime::createFromFormat('d-m-Y H:i a', $data['date_from']);
			$this->db->set('date_from', $date->format('Y-m-d H:i:s'));

			$date = DateTime::createFromFormat('d-m-Y H:i a', $data['date_to']);
			$this->db->set('date_to', $date->format('Y-m-d H:i:s'));

			if($data['draw_date']!=''){
				$date = DateTime::createFromFormat('d-m-Y H:i a', $data['draw_date']);
				$this->db->set('draw_date', $date->format('Y-m-d H:i:s'));
			}

			$this->db->set('create_date', 'NOW()', FALSE);

			$this->db->set('status', $data['status']);
			$this->db->set('first_prize', $data['first_prize']);
			$this->db->set('first_prize_qty', $data['first_prize_qty']);
			$this->db->set('second_prize', $data['second_prize']);
			$this->db->set('second_prize_qty', $data['second_prize_qty']);
			$this->db->set('third_prize', $data['third_prize']);
			$this->db->set('third_prize_qty', $data['third_prize_qty']);
			$this->db->where('id', $data['id']);
			$this->db->update('competitions');

			$this->session->set_flashdata('message', 'Competition Updated!!!');
			redirect('competitions');

		}
	}
	public function edit($id){

		if($data['edit']){

			$this->db->set('title', $data['title']);
			$this->db->set('content', $data['content']);
			$this->db->set('localization', $data['localization']);

			$date = DateTime::createFromFormat('d-m-Y H:i a', $data['date_from']);
			$this->db->set('date_from', $date->format('Y-m-d H:i:s'));

			$date = DateTime::createFromFormat('d-m-Y H:i a', $data['date_to']);
			$this->db->set('date_to', $date->format('Y-m-d H:i:s'));

			if($data['draw_date']!=''){
				$date = DateTime::createFromFormat('d-m-Y H:i a', $data['draw_date']);
				$this->db->set('draw_date', $date->format('Y-m-d H:i:s'));
			}

			$this->db->set('create_date', 'NOW()', FALSE);

			$this->db->set('status', $data['status']);
			$this->db->set('first_prize', $data['first_prize']);
			$this->db->set('first_prize_qty', $data['first_prize_qty']);
			$this->db->set('second_prize', $data['second_prize']);
			$this->db->set('second_prize_qty', $data['second_prize_qty']);
			$this->db->set('third_prize', $data['third_prize']);
			$this->db->set('third_prize_qty', $data['third_prize_qty']);

			$this->db->insert('competitions');

			$this->session->set_flashdata('message', 'Competition Added!!!');
			redirect('competitions');

		}
	}
	public function deactivate($id){
		$this->db->set('status', '0');
		$this->db->where('id',$id);
		$this->db->update('competitions');
	}
	public function activate($id){
		//deactivate all at first

		$this->db->set('status', '0');
		$this->db->where('status','1');
		$this->db->update('competitions');

		$this->db->set('status', '1');
		$this->db->where('id',$id);
		$this->db->update('competitions');
	}
	public function delete($id){
		$this->db->delete('competitions', array('id' => $id));
	}
	public function check_email($email){
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('U_Email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return true;
		} else {
			$this->form_validation->set_message('email_exist_check', 'The %s you are trying to add doesn\'t exist!');
			return false;
		}
	}
	public function addUserToCompetition($competition_id,$email){

		$this->db->select('U_Id');
		$this->db->from('members');
		$this->db->where('U_Email',$email);
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();

		if($query->num_rows() > 0) {
			//user exist, check if it hasnt been added already
			$this->db->select('id');
			$this->db->from('competitions_to_users');
			$this->db->where('competition_id',$competition_id);
			$this->db->where('user_id',$query->row('U_Id'));
			$this->db->limit(1);
			$query2 = $this->db->get();

			if($query2->num_rows() == 0) {
				$this->db->set('competition_id', $competition_id);
				$this->db->set('user_id', $row->U_Id);
				$this->db->set('enter_date', 'NOW()', FALSE);
				$this->db->insert('competitions_to_users');
				$this->session->set_flashdata('message', 'User added to competition !');
				redirect('competitions/viewCompetition/'.$competition_id);
			} else {
				$this->session->set_flashdata('error_message', 'This user has been added already!!!');
				redirect('competitions/viewCompetition/'.$competition_id);
			}
		} else {
			$this->session->set_flashdata('error_message', 'This email hasn\'t been found in database !!!');
			redirect('competitions/viewCompetition/'.$competition_id);
		}
	}

	public function getCompetitionUsers($id,$sortfield, $order,$per_page,$offset,$email_search){

		$this->db->select('U_Id,U_FirstName,U_Surname,U_Email,U_Address1,U_Address2,U_Town,U_County,U_Country');
		$this->db->from('members');
	 	$this->db->join('competitions_to_users', 'competitions_to_users.user_id = members.U_Id', 'inner');
	 	if($email_search!=''){ $this->db->where("(U_Email LIKE '%$email_search%')"); }
	 	$this->db->where('competitions_to_users.competition_id',$id);
	 	$this->db->order_by($sortfield,$order);
	 	$this->db->limit($per_page,$offset);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_row_count($id,$email_search)
	{
		$this->db->select('U_Id,U_FirstName,U_Surname,U_Email,U_Address1,U_Address2,U_Town,U_County,U_Country');
		$this->db->from('members');
		if($email_search!=''){ $this->db->where("(U_Email LIKE '%$email_search%')"); }
		$this->db->where('competitions_to_users.competition_id',$id);
	 	$this->db->join('competitions_to_users', 'competitions_to_users.user_id = members.U_Id', 'inner');
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function removeUserFromCompetition($competition_id,$user_id){
		$this->db->where('competition_id', $competition_id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('competitions_to_users');
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function getMember($member_id){
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('U_Id', $member_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}

	}
	public function addFirstPrizeUserToCompetition($competition_id,$json_member){
		$this->db->set('first_prize_winners', $json_member);
		$this->db->where('id',$competition_id);
		$this->db->update('competitions');
	}
	public function addSecondPrizeUserToCompetition($competition_id,$json_member){
		$this->db->set('second_prize_winners', $json_member);
		$this->db->where('id',$competition_id);
		$this->db->update('competitions');
	}
	public function addThirdPrizeUserToCompetition($competition_id,$json_member){
		$this->db->set('third_prize_winners', $json_member);
		$this->db->where('id',$competition_id);
		$this->db->update('competitions');
	}
	public function removeFirstPrizeWinner($competition_id,$member_id){

		$this->db->select('first_prize_winners');
		$this->db->from('competitions');
		$this->db->where('id', $competition_id);
		$query = $this->db->get();
		$row=$query->row();
		if($query->num_rows() > 0) {

			$winners=json_decode($row->first_prize_winners);
			$newWinners=array();

			foreach ($winners as $winner){
			 	if($winner->id!=$member_id){
			 		$newWinners[]=$winner;
			 	}
			}
			if(!empty($newWinners)){
				$winners=json_encode($newWinners);
			}else{
				$winners='';
			}
			$this->db->set('first_prize_winners', $winners);
			$this->db->where('id',$competition_id);
			$this->db->update('competitions');
			return true;
		} else {
			return false;
		}
	}
	public function removeSecondPrizeWinner($competition_id,$member_id){

		$this->db->select('second_prize_winners');
		$this->db->from('competitions');
		$this->db->where('id', $competition_id);
		$query = $this->db->get();
		$row=$query->row();
		if($query->num_rows() > 0) {

			$winners=json_decode($row->second_prize_winners);
			$newWinners=array();

			foreach ($winners as $winner){
				if($winner->id!=$member_id){
					$newWinners[]=$winner;
				}
			}
			if(!empty($newWinners)){
				$winners=json_encode($newWinners);
			}else{
				$winners='';
			}
			$this->db->set('second_prize_winners', $winners);
			$this->db->where('id',$competition_id);
			$this->db->update('competitions');
			return true;
		} else {
			return false;
		}
	}

	public function removeThirdPrizeWinner($competition_id,$member_id){

		$this->db->select('third_prize_winners');
		$this->db->from('competitions');
		$this->db->where('id', $competition_id);
		$query = $this->db->get();
		$row=$query->row();
		if($query->num_rows() > 0) {

			$winners=json_decode($row->third_prize_winners);
			$newWinners=array();

			foreach ($winners as $winner){
				if($winner->id!=$member_id){
					$newWinners[]=$winner;
				}
			}
			if(!empty($newWinners)){
				$winners=json_encode($newWinners);
			}else{
				$winners='';
			}
			$this->db->set('third_prize_winners', $winners);
			$this->db->where('id',$competition_id);
			$this->db->update('competitions');
			return true;
		} else {
			return false;
		}
	}


}



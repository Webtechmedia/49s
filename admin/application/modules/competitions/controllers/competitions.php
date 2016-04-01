<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Competitions extends CI_Controller
{

	function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Competitions';


		$this->load->model('competitions_model');

		$data['competitions'] = $this->competitions_model->getAllCompetitions();


		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'competitions/competitions',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	function add()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Add Competitions';
		$this->template->add_js('js/tiny_mce/tiny_mce.js');
		$this->template->add_js('js/my_tiny_mce.js');
		$this->template->add_js('js/moment-with-locales.js');
		$this->template->add_js('js/bootstrap-datetimepicker.js');
		$this->template->add_css('css/bootstrap-datetimepicker.css');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'competitions/competition_form',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	public function insertNewCompetition(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('content', 'Content', 'trim|xss_clean');
			$this->form_validation->set_rules('localization', 'Localization', 'trim|required|xss_clean|is_natural');
			$this->form_validation->set_rules('date_from', 'Date From', 'required|trim|xss_clean');
			$this->form_validation->set_rules('date_to', 'Date To', 'required|trim|xss_clean');
			$this->form_validation->set_rules('draw_date', 'Draw Date', 'trim|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'required|is_natural|trim|xss_clean');
			$this->form_validation->set_rules('first_prize', 'First Prize', 'trim|xss_clean');
			$this->form_validation->set_rules('first_prize_qty', 'First Prize Quantity', 'is_natural|trim|xss_clean');
			$this->form_validation->set_rules('second_prize', 'Second Prize', 'trim|xss_clean');
			$this->form_validation->set_rules('second_prize_qty', 'Second Prize Quantity', 'is_natural|trim|xss_clean');
			$this->form_validation->set_rules('third_prize', 'Third Prize', 'trim|xss_clean');
			$this->form_validation->set_rules('third_prize_qty', 'Third Prize Quantity', 'is_natural|trim|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
				$this->add();
			}
			else
			{
				$this->load->model('competitions_model');
				$this->competitions_model->inserNewCompetition($this->input->post());
			}
		}else{
			$this->session->set_flashdata('error_message', 'No data submitted. ');
			redirect('competitions');
		}
	}

	public function viewCompetition($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$data['competition']=$this->competitions_model->getCompetition($id);
		$data['title'] = 'View Competitions';


		$offset=$this->uri->segment(4);
		if($this->session->userdata('competition_delimiter')!=''){
			$per_page=$this->session->userdata('competition_delimiter');
		}else{
			$per_page=50;
		}

		$email_search=$this->session->userdata('competition_search_email');

		$data['users'] = $this->competitions_model->getCompetitionUsers($id,$sortfield='U_Id', $order='asc',$per_page,$offset,$email_search);
		$data['total_results'] =$this->competitions_model->get_row_count($id,$email_search);


		$this->load->library('pagination');

		$config['base_url'] = base_url('competitions/viewCompetition/'.$id.'/');
		$config['total_rows'] = $data['total_results'];
		$config['per_page'] = $per_page;
		$config['num_links'] = 2;
		$config['uri_segment'] = 4;
		$config['display_pages'] = TRUE;
		$config['constant_num_links'] = TRUE;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_open_disabled'] = "<li class='disabled'>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_open_disabled'] = "<li class='disabled'>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_open_disabled'] = "<li class='disabled'>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_open_disabled'] = "<li class='disabled'>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'competitions/competition_view',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	public function setCompetitionSearch($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->session->set_userdata('competition_search_email', $this->input->post('competition_email'));

		redirect('competitions/viewCompetition/'.$id);

	}


	public function editCompetition($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$data['competition']=$this->competitions_model->getCompetition($id);
		$data['title'] = 'Edit Competitions';
		$this->template->add_js('js/tiny_mce/tiny_mce.js');
		$this->template->add_js('js/my_tiny_mce.js');
		$this->template->add_js('js/moment-with-locales.js');
		$this->template->add_js('js/bootstrap-datetimepicker.js');
		$this->template->add_css('css/bootstrap-datetimepicker.css');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'competitions/competition_edit',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	public function saveEditCompetition(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}

		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id', 'ID', 'is_natural|trim|xss_clean');
			$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('content', 'Content', 'trim|xss_clean');
			$this->form_validation->set_rules('localization', 'Localization', 'trim|required|xss_clean|is_natural');
			$this->form_validation->set_rules('date_from', 'Date From', 'required|trim|xss_clean');
			$this->form_validation->set_rules('date_to', 'Date To', 'required|trim|xss_clean');
			$this->form_validation->set_rules('draw_date', 'Draw Date', 'trim|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'required|is_natural|trim|xss_clean');
			$this->form_validation->set_rules('first_prize', 'First Prize', 'trim|xss_clean');
			$this->form_validation->set_rules('first_prize_qty', 'First Prize Quantity', 'is_natural|trim|xss_clean');
			$this->form_validation->set_rules('second_prize', 'Second Prize', 'trim|xss_clean');
			$this->form_validation->set_rules('second_prize_qty', 'Second Prize Quantity', 'is_natural|trim|xss_clean');
			$this->form_validation->set_rules('third_prize', 'Third Prize', 'trim|xss_clean');
			$this->form_validation->set_rules('third_prize_qty', 'Third Prize Quantity', 'is_natural|trim|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{

				$this->editCompetition($this->input->post('id'));
			}
			else
			{
				$this->load->model('competitions_model');
				$this->competitions_model->updateCompetition($this->input->post());
			}
		}else{
			$this->session->set_flashdata('error_message', 'No data submitted. ');
			redirect('competitions');
		}

	}

	public function deactivate($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$this->competitions_model->deactivate($id);
		$this->session->set_flashdata('message', 'Competition deactivated. ');
		redirect('competitions');
	}

	public function activate($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$this->competitions_model->activate($id);
		$this->session->set_flashdata('message', 'Competition activated. ');
		redirect('competitions');
	}
	public function delete($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$this->competitions_model->delete($id);
		$this->session->set_flashdata('message', 'Competition deleted. ');
		redirect('competitions');
	}
	public function addUserToCompetition($competition_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('add_competition_user', 'User Email', 'valid_email|required|trim|xss_clean|callback_email_exist_check');

			if ($this->form_validation->run() == FALSE)
			{
				$this->viewCompetition($competition_id);
			}else{
				$this->load->model('competitions_model');
				$this->competitions_model->addUserToCompetition($competition_id,$this->input->post('add_competition_user'));
			}
		}else{
			$this->session->set_flashdata('error_message', 'No data submitted. ');
			redirect('competitions/viewCompetition/'.$competition_id);
		}
	}

	public function email_exist_check($email){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		return $this->competitions_model->check_email($email);
	}

	public function addFirstPrizeUserToCompetition($competition_id,$user_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$competition=$this->competitions_model->getCompetition($competition_id);

		$member=$this->competitions_model->getMember($user_id);
		$winners=array();
		$winners_array=json_decode($competition[0]->first_prize_winners);

		if($winners_array!=null){
			foreach($winners_array as $current_winner){
				$winners[]=$current_winner;
			}

		}

		if(count($winners) < $competition[0]->first_prize_qty){
			foreach ($winners as $winner){//check if user has been added already
				if($winner->id==$member[0]->U_Id){
					$this->session->set_flashdata('error_message', 'This user has been marked as a winner of first prize already!');
					redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
				}
			}

			$winners[] =  array(
				'id' => $member[0]->U_Id,
				'name'=> $member[0]->U_FirstName,
				'surname'=> $member[0]->U_Surname,
				'email' => $member[0]->U_Email
				);
			$this->competitions_model->addFirstPrizeUserToCompetition($competition_id,json_encode($winners));
			$this->session->set_flashdata('message', 'Winner of first prize added!');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}else{
			$this->session->set_flashdata('error_message', 'User can\'t be added as a winner because you have reach limit of first prize winners!');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}
	}

	public function addSecondPrizeUserToCompetition($competition_id,$user_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$competition=$this->competitions_model->getCompetition($competition_id);

		$member=$this->competitions_model->getMember($user_id);
		$winners=array();
		$winners_array=json_decode($competition[0]->second_prize_winners);

		if($winners_array!=null){
			foreach($winners_array as $current_winner){
				$winners[]=$current_winner;
			}

		}

		if(count($winners) < $competition[0]->second_prize_qty){
			foreach ($winners as $winner){//check if user has been added already
				if($winner->id==$member[0]->U_Id){
					$this->session->set_flashdata('error_message', 'This user has been marked as a winner of second prize already!');
					redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
				}
			}

			$winners[] =  array(
					'id' => $member[0]->U_Id,
					'name'=> $member[0]->U_FirstName,
					'surname'=> $member[0]->U_Surname,
					'email' => $member[0]->U_Email
			);
			$this->competitions_model->addSecondPrizeUserToCompetition($competition_id,json_encode($winners));
			$this->session->set_flashdata('message', 'Winner of second prize added!');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}else{
			$this->session->set_flashdata('error_message', 'User can\'t be added as a winner because you have reach limit of second prize winners!');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}
	}

	public function addThirdPrizeUserToCompetition($competition_id,$user_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		$competition=$this->competitions_model->getCompetition($competition_id);

		$member=$this->competitions_model->getMember($user_id);
		$winners=array();
		$winners_array=json_decode($competition[0]->third_prize_winners);

		if($winners_array!=null){
			foreach($winners_array as $current_winner){
				$winners[]=$current_winner;
			}

		}

		if(count($winners) < $competition[0]->third_prize_qty){
			foreach ($winners as $winner){//check if user has been added already
				if($winner->id==$member[0]->U_Id){
					$this->session->set_flashdata('error_message', 'This user has been marked as a winner of third prize already!');
					redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
				}
			}

			$winners[] =  array(
					'id' => $member[0]->U_Id,
					'name'=> $member[0]->U_FirstName,
					'surname'=> $member[0]->U_Surname,
					'email' => $member[0]->U_Email
			);
			$this->competitions_model->addThirdPrizeUserToCompetition($competition_id,json_encode($winners));
			$this->session->set_flashdata('message', 'Winner of third prize added!');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}else{
			$this->session->set_flashdata('error_message', 'User can\'t be added as a winner because you have reach limit of third prize winners!');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}
	}

	public function removeUserFromCompetition($competition_id,$user_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		if($this->competitions_model->removeUserFromCompetition($competition_id,$user_id)){
			$this->session->set_flashdata('message', 'User removed form competition. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}else{
			$this->session->set_flashdata('error_message', 'There was a problem with removing user from competition. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}
	}
	public function removeFirstPrizeWinner($competition_id,$member_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		if($this->competitions_model->removeFirstPrizeWinner($competition_id,$member_id)){
			$this->session->set_flashdata('message', 'Winner removed. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}else{
			$this->session->set_flashdata('error_message', 'There was a problem with removing winner from competition. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}
	}
	public function removeSecondPrizeWinner($competition_id,$member_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		if($this->competitions_model->removeSecondPrizeWinner($competition_id,$member_id)){
			$this->session->set_flashdata('message', 'Winner removed. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}else{
			$this->session->set_flashdata('error_message', 'There was a problem with removing winner from competition. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}
	}

	public function removeThirdPrizeWinner($competition_id,$member_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('competitions_model');
		if($this->competitions_model->removeThirdPrizeWinner($competition_id,$member_id)){
			$this->session->set_flashdata('message', 'Winner removed. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}else{
			$this->session->set_flashdata('error_message', 'There was a problem with removing winner from competition. ');
			redirect('competitions/viewCompetition/'.$competition_id.'/'.$offset);
		}
	}
	public function setDelimiter($competition_id,$limit){
		$this->session->set_userdata('competition_delimiter', $limit);
		redirect('competitions/viewCompetition/'.$competition_id);
	}

}





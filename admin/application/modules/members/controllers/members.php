<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller
{


	function index($offset=0)
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Members';

		$per_page=($this->session->userdata('member_delimiter') == '' ? 50 : $this->session->userdata('member_delimiter'));
		$member_search=($this->session->userdata('member_search') == '' ? '' : $this->session->userdata('member_search'));
		$sortfield=($this->session->userdata('member_sortfield') == '' ? 'U_Id' : $this->session->userdata('member_sortfield'));
		$order=($this->session->userdata('order') == '' ? 'asc' : $this->session->userdata('order'));
		$this->load->model('members_model');

		$data['members'] = $this->members_model->getMembers($sortfield, $order,$per_page,$offset,$member_search);
		$data['total_results'] =$this->members_model->get_row_count($member_search);

		if($sortfield=='U_RegistrationDate' && $order=='asc'){
			$data['registered_sort']='<a href="'.base_url('members/setSort/U_RegistrationDate/desc').'" >Registered <span class="caret" ></span></a>';
		}elseif($sortfield=='U_RegistrationDate' && $order=='desc'){
			$data['registered_sort']='<a href="'.base_url('members/setSort/U_RegistrationDate/asc').'" >Registered <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['registered_sort']='<a href="'.base_url('members/setSort/U_RegistrationDate/asc').'" >Registered </a>';
		}

		if($sortfield=='U_FirstName' && $order=='asc'){
			$data['first_name_sort']='<a href="'.base_url('members/setSort/U_FirstName/desc').'" >First Name <span class="caret" ></span></a>';
		}elseif($sortfield=='U_FirstName' && $order=='desc'){
			$data['first_name_sort']='<a href="'.base_url('members/setSort/U_FirstName/asc').'" >First Name <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['first_name_sort']='<a href="'.base_url('members/setSort/U_FirstName/asc').'" >First Name </a>';
		}

		if($sortfield=='U_Surname' && $order=='asc'){
			$data['surname_sort']='<a href="'.base_url('members/setSort/U_Surname/desc').'" >Surname <span class="caret" ></span></a>';
		}elseif($sortfield=='U_Surname' && $order=='desc'){
			$data['surname_sort']='<a href="'.base_url('members/setSort/U_Surname/asc').'" >Surname <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['surname_sort']='<a href="'.base_url('members/setSort/U_Surname/asc').'" >Surname </a>';
		}

		if($sortfield=='U_Email' && $order=='asc'){
			$data['email_sort']='<a href="'.base_url('members/setSort/U_Email/desc').'" >Email <span class="caret" ></span></a>';
		}elseif($sortfield=='U_Email' && $order=='desc'){
			$data['email_sort']='<a href="'.base_url('members/setSort/U_Email/asc').'" >Email <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['email_sort']='<a href="'.base_url('members/setSort/U_Email/asc').'" >Email </a>';
		}

		if($sortfield=='U_Address1' && $order=='asc'){
			$data['address_sort']='<a href="'.base_url('members/setSort/U_Address1/desc').'" >Address <span class="caret" ></span></a>';
		}elseif($sortfield=='U_Address1' && $order=='desc'){
			$data['address_sort']='<a href="'.base_url('members/setSort/U_Address1/asc').'" >Address <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['address_sort']='<a href="'.base_url('members/setSort/U_Address1/asc').'" >Address </a>';
		}

		if($sortfield=='U_Postcode' && $order=='asc'){
			$data['postcode_sort']='<a href="'.base_url('members/setSort/U_Postcode/desc').'" >Postcode <span class="caret" ></span></a>';
		}elseif($sortfield=='U_Postcode' && $order=='desc'){
			$data['postcode_sort']='<a href="'.base_url('members/setSort/U_Postcode/asc').'" >Postcode <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['postcode_sort']='<a href="'.base_url('members/setSort/U_Postcode/asc').'" >Postcode </a>';
		}

		if($sortfield=='U_Country' && $order=='asc'){
			$data['country_sort']='<a href="'.base_url('members/setSort/U_Country/desc').'" >Country <span class="caret" ></span></a>';
		}elseif($sortfield=='U_Country' && $order=='desc'){
			$data['country_sort']='<a href="'.base_url('members/setSort/U_Country/asc').'" >Country <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['country_sort']='<a href="'.base_url('members/setSort/U_Country/asc').'" >Country </a>';
		}


		if($sortfield=='U_Competitions' && $order=='asc'){
			$data['contest_sort']='<a href="'.base_url('members/setSort/U_Competitions/desc').'" >Contest <span class="caret" ></span></a>';
		}elseif($sortfield=='U_Competitions' && $order=='desc'){
			$data['contest_sort']='<a href="'.base_url('members/setSort/U_Competitions/asc').'" >Contest <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['contest_sort']='<a href="'.base_url('members/setSort/U_Competitions/asc').'" >Contest </a>';
		}









		$this->load->library('pagination');

		$config['base_url'] = base_url('members/index/');
		$config['total_rows'] = $data['total_results'];
		$config['per_page'] = $per_page;
		$config['num_links'] = 2;
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
		$this->template->write_view('content', 'members/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}


	public function setDelimiter(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('delimiter', 'Delimiter', 'xss_clean|required|numeric|greater_than[0]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->session->set_userdata('member_delimiter', $this->input->post('delimiter'));
			$this->index();
		}
	}
	public function setSearch(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('search', 'Search', 'xss_clean|max_length[40]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->session->set_userdata('member_search', $this->input->post('search'));
			$this->index();
		}
	}
	public function setLocalization($localization){
		$this->session->set_userdata('localization', $localization);
		$this->index();
	}
	public function deleteMember(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('members_model');
		if (is_numeric ($this->uri->segment(3)))  {
			$removeUser =$this->members_model->removeMember($this->uri->segment(3));
			if($removeUser){
				$this->session->set_flashdata('message', 'Member deleted');
				redirect('/members/');
			}else{
				$this->session->set_flashdata('error_message', 'Problem with member deletion !!!');
				redirect('/members/');
			}
			$this->index();
		} else {
			$this->session->set_flashdata('error_message', 'Incorrect member id!!!');
			redirect('/members/');
		}
	}

	public function export(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if($this->input->post('export')=='all'){
			$this->load->model('members_model');
	   		$report= $this->members_model->getAllMembers();
			$this->export_report($report);
			$this->session->set_flashdata('message', 'All members exported.');
			redirect('/members');
		}elseif($this->input->post('export')=='tagged' && $this->input->post('selected') ){

			$this->load->model('members_model');
			$report= $this->members_model->getMembersByIds($this->input->post('selected'));
			$this->export_report($report);
			$this->session->set_flashdata('message', 'All members exported.');
			redirect('/members');
		}else{
			$this->session->set_flashdata('error_message', 'You need to select at least one person for export!');
			redirect('/members');
		}
	}

	private function export_report($report){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
	    $this->load->dbutil();
	    $this->load->helper('file');
	    $this->load->helper('download');
	    $new_report = $this->dbutil->csv_from_result($report);
	    force_download('csv_file.csv', $new_report);
	}


	public function sendEmail(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if(!$this->input->post('all') && !$this->input->post('tagged') && !$this->input->post('49s') && !$this->input->post('ilb') && !$this->input->post('rapido') && !$this->input->post('vgr') && !$this->input->post('vhr') && !$this->input->post('uk-email')  && !$this->input->post('foreign-email') ){
			//echo 'nothing set';
			$this->session->set_flashdata('error_message', 'Pick at least one group of members.');
			redirect('/members');
		}elseif($this->input->post('all') && !$this->input->post('tagged') && !$this->input->post('49s') && !$this->input->post('ilb') && !$this->input->post('rapido') && !$this->input->post('vgr') && !$this->input->post('vhr') && !$this->input->post('uk-email')  && !$this->input->post('foreign-email')){
			//echo 'email to all';


			$this->session->set_userdata('email_group','all');

			$this->load->model('emails_model');
			$data['templates'] = $this->emails_model->getTextEmailTemplates();

			$this->template->add_js('js/tiny_mce/tiny_mce.js');
			$this->template->add_js('js/my_tiny_mce.js');

			$data['title'] = 'Send Email';
			$this->template->write_view('head', 'common/head',$data);
			$this->template->write_view('header', 'common/header',$data);
			$this->template->write_view('content', 'members/email_form',$data);
			$this->template->write_view('footer', 'common/footer',$data);

			$this->template->set_master_template('templates/one_column_layout');
			$this->template->render();


		}elseif(!$this->input->post('all') && $this->input->post('tagged') && !$this->input->post('49s') && !$this->input->post('ilb') && !$this->input->post('rapido') && !$this->input->post('vgr') && !$this->input->post('vhr') && !$this->input->post('uk-email')  && !$this->input->post('foreign-email')){
			//echo 'tagged';
			if($this->input->post('selected')){
				$this->session->set_userdata('email_group','tagged');
				$this->session->set_userdata('email_selected',$this->input->post('selected') );

				$this->load->model('emails_model');
				$data['templates'] = $this->emails_model->getTextEmailTemplates();

				$this->template->add_js('js/tiny_mce/tiny_mce.js');
				$this->template->add_js('js/my_tiny_mce.js');

				$data['title'] = 'Send Email';
				$this->template->write_view('head', 'common/head',$data);
				$this->template->write_view('header', 'common/header',$data);
				$this->template->write_view('content', 'members/email_form',$data);
				$this->template->write_view('footer', 'common/footer',$data);

				$this->template->set_master_template('templates/one_column_layout');
				$this->template->render();


			}else{
				$this->session->set_flashdata('error_message', 'You need to select at least one person to send email to!');
				redirect('/members');
			}
		}elseif(!$this->input->post('all') && !$this->input->post('tagged') && !$this->input->post('uk-email')  && !$this->input->post('foreign-email') && ($this->input->post('49s') || $this->input->post('ilb') || $this->input->post('rapido') || $this->input->post('vgr') || $this->input->post('vhr') )){
			//echo 'export based on selected game';

			$this->session->set_userdata('email_group','game_based');

			$email_selected_games = array();
			if($this->input->post('49s')){ $email_selected_games['49s']='U_Plays49s';}
			if($this->input->post('ilb')){ $email_selected_games['ilb']='U_PlaysILB'; }
			if($this->input->post('rapido')){ $email_selected_games['rapido']='U_PlaysRapido';}
			if($this->input->post('vgr')){ $email_selected_games['vgr']='U_PlaysVGR';}
			if($this->input->post('vhr')){ $email_selected_games['vhr']='U_PlaysVHR';}

			$this->session->set_userdata('email_selected_games',$email_selected_games);


			$this->load->model('emails_model');
			$data['templates'] = $this->emails_model->getTextEmailTemplates();

			$this->template->add_js('js/tiny_mce/tiny_mce.js');
			$this->template->add_js('js/my_tiny_mce.js');

			$data['title'] = 'Send Email';
			$this->template->write_view('head', 'common/head',$data);
			$this->template->write_view('header', 'common/header',$data);
			$this->template->write_view('content', 'members/email_form',$data);
			$this->template->write_view('footer', 'common/footer',$data);

			$this->template->set_master_template('templates/one_column_layout');
			$this->template->render();

		}elseif(!$this->input->post('all') && !$this->input->post('tagged') && !$this->input->post('49s') && !$this->input->post('ilb') && !$this->input->post('rapido') && !$this->input->post('vgr') && !$this->input->post('vhr') && ($this->input->post('uk-email')  || $this->input->post('foreign-email'))){
			//echo 'by country';
			if($this->input->post('uk-email')  && $this->input->post('foreign-email')){
				$this->session->set_flashdata('error_message', 'Please select only one option.');
				redirect('/members');
			}

			$this->session->set_userdata('email_group','by_country');
			if($this->input->post('uk-email')){
				$this->session->set_userdata('email_country','uk');
			}else{
				$this->session->set_userdata('email_country','foreign');
			}
			$this->load->model('emails_model');
			$data['templates'] = $this->emails_model->getTextEmailTemplates();

			$this->template->add_js('js/tiny_mce/tiny_mce.js');
			$this->template->add_js('js/my_tiny_mce.js');

			$data['title'] = 'Send Email';
			$this->template->write_view('head', 'common/head',$data);
			$this->template->write_view('header', 'common/header',$data);
			$this->template->write_view('content', 'members/email_form',$data);
			$this->template->write_view('footer', 'common/footer',$data);

			$this->template->set_master_template('templates/one_column_layout');
			$this->template->render();
		}else{
			//echo 'error export';
			$this->session->set_flashdata('error_message', 'Emails cannot be send based on your choice! Please correct your choice!');
			redirect('/members');
		}

	}
	public function submitEmail(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if($this->session->userdata('email_group')=='all'){
			$this->load->model('emails_model');
			$emails = $this->emails_model->getAllEmailsRecipient();

			foreach($emails as $email){
				if($this->input->post('email-type')=='text'){
					//$this->submitTextEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}elseif($this->input->post('email-type')=='html'){
					//$this->submitHtmlEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}else{
					exit('Email type problem!');
				}
			}


			$this->session->unset_userdata('email_group');
			$this->session->unset_userdata('email-type');
			$this->session->unset_userdata('email_selected_games');
			$this->session->unset_userdata('email_selected');
			$this->session->unset_userdata('email_country');


/* ===================== for test only ============================*/

			//if($this->input->post('email-type')=='text'){
			//		$this->submitTextEmail('pawelcich3@o2.pl','Pawel','Cich',$this->input->post('subject'),$this->input->post('emailcontent'));
			//	}elseif($this->input->post('email-type')=='html'){
			//		$this->submitHtmlEmail('pawelcich3@o2.pl','Pawel','Cich',$this->input->post('subject'),$this->input->post('emailcontent'));
			//	}else{
			//		exit('Email type problem!');
			//}

/* ===================== end for test only ============================*/

            $this->session->set_flashdata('message', 'Emails sent!');
			redirect('/members');



		}elseif($this->session->userdata('email_group')=='tagged'){
			$this->load->model('emails_model');
			$emails = $this->emails_model->getSelectedEmailsRecipient($this->session->userdata('email_selected'));
			foreach($emails as $email){
				if($this->input->post('email-type')=='text'){
					//$this->submitTextEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}elseif($this->input->post('email-type')=='html'){
					//$this->submitHtmlEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}else{
					exit('Email type problem!');
				}
			}
			$this->session->unset_userdata('email_group');
			$this->session->unset_userdata('email-type');
			$this->session->unset_userdata('email_selected_games');
			$this->session->unset_userdata('email_selected');
			$this->session->unset_userdata('email_country');

			$this->session->set_flashdata('message', 'Emails sent to tagged users!');
			redirect('/members');
		}elseif($this->session->userdata('email_group')=='game_based'){
			$this->load->model('emails_model');
			$emails = $this->emails_model->getGameEmailsRecipient($this->session->userdata('email_selected_games'));
			foreach($emails as $email){
				if($this->input->post('email-type')=='text'){
					//$this->submitTextEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}elseif($this->input->post('email-type')=='html'){
					//$this->submitHtmlEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}else{
					exit('Email type problem!');
				}
			}
			$this->session->unset_userdata('email_group');
			$this->session->unset_userdata('email-type');
			$this->session->unset_userdata('email_selected_games');
			$this->session->unset_userdata('email_selected');
			$this->session->unset_userdata('email_country');

			$this->session->set_flashdata('message', 'Emails sent to selected groups!');
			redirect('/members');
		}elseif($this->session->userdata('email_group')=='by_country'){
			$this->load->model('emails_model');
			$emails = $this->emails_model->getCountryEmailsRecipient($this->session->userdata('email_country'));

			foreach($emails as $email){
				if($this->input->post('email-type')=='text'){
					//$this->submitTextEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}elseif($this->input->post('email-type')=='html'){
					//$this->submitHtmlEmail($email->U_Email,$email->U_FirstName,$email->U_Surname,$this->input->post('subject'),$this->input->post('emailcontent'));
				}else{
					exit('Email type problem!');
				}
			}
			$this->session->unset_userdata('email_group');
			$this->session->unset_userdata('email-type');
			$this->session->unset_userdata('email_selected_games');
			$this->session->unset_userdata('email_selected');
			$this->session->unset_userdata('email_country');


			$this->session->set_flashdata('message', 'Emails sent!');
			redirect('/members');
		}else{
			$this->session->set_flashdata('error_message', 'No user group specified !');
			redirect('/members');
		}
	}
	public function submitTextEmail($email,$name,$surname,$subject,$content){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$content = str_replace("{name}", $name.' '.$surname, $content);

		$this->load->library('email');
		$this->email->set_mailtype("text");
		$this->email->from('noreply@49s.co.uk', '49s.co.uk');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($content);
		$this->email->send();
		//echo $this->email->print_debugger();
	}
	public function submitHtmlEmail($email,$name,$surname,$subject,$content){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$content = str_replace("{name}", $name.' '.$surname, $content);
		$this->load->library('email');
		$this->email->set_mailtype("html");
		//$this->load->library('email');
		$this->email->from('noreply@49s.co.uk', '49s.co.uk');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($content);
		$this->email->send();
	}

	public function sendTextEmail(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('emails_model');
		$data['templates'] = $this->emails_model->getTextEmailTemplates();
		$this->load->view('members/text_email_form',$data);
	}
	public function sendHtmlEmail(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('emails_model');
		$data['templates'] = $this->emails_model->getHtmlEmailTemplates();
		$this->load->view('members/html_email_form',$data);
	}
	public function getTextEmailContent($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('emails_model');
		echo $this->emails_model->getTextEmailContent($id);
	}
	public function getHtmlEmailContent($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('emails_model');
		echo $this->emails_model->getHtmlEmailContent($id);
	}
	public function deleteEmailTemplate($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('emails_model');
		echo $this->emails_model->deleteEmailTemplate($id);
	}
	public function saveNewEmailTemplate(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('emails_model');
		$this->emails_model->saveNewEmailTemplate( $this->input->post('type'), $this->input->post('subject'), $this->input->post('content'));
	}
	public function getUsersSelectedToEmail(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('emails_model');

		if($this->session->userdata('email_group')=='all'){
			$data['emails'] = $this->emails_model->getAllEmailsRecipient();
			$data['group'] = "All users.";
			$data['count'] =count($data['emails']);
			$this->load->view('chosen_user_table',$data);
		}
		if($this->session->userdata('email_group')=='tagged'){
			$data['emails'] = $this->emails_model->getSelectedEmailsRecipient($this->session->userdata('email_selected'));
			$data['group'] = "Tagged users.";
			$data['count'] =count($data['emails']);
			$this->load->view('chosen_user_table',$data);
		}
		if($this->session->userdata('email_group')=='game_based'){
			$data['emails'] = $this->emails_model->getGameEmailsRecipient($this->session->userdata('email_selected_games'));
			$data['group'] = "Game type.";
			$data['count'] =count($data['emails']);
			$this->load->view('chosen_user_table',$data);
		}
		if($this->session->userdata('email_group')=='by_country'){
			$data['emails'] = $this->emails_model->getCountryEmailsRecipient($this->session->userdata('email_country'));
			$location_name=$this->session->userdata('email_country');
			$location_name= strtoupper($location_name);
			$data['group'] = "Users by location - ".$location_name;
			$data['count'] =count($data['emails']);
			$this->load->view('chosen_user_table',$data);
		}
	}

	public function setSort($fieldname,$order){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->session->set_userdata('member_sortfield', $fieldname);
		$this->session->set_userdata('order', $order);
		redirect('members/index');
	}

	public function editMember($member_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Edit Member';

		$this->load->model('members_model');
		$data['member'] = $this->members_model->getMember($member_id);

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'members/edit_member',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();

	}

	public function updateMember($member_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->library('form_validation');

		$this->form_validation->set_rules('49s', '49s', 'callback_one_checked|xss_clean');
		$this->form_validation->set_rules('irish', 'Irish Lotto Bet', 'xss_clean');
		$this->form_validation->set_rules('vhr', 'Virtual Horse Racing', 'xss_clean');
		$this->form_validation->set_rules('vgr', 'Virtual Greyhound Racing', 'xss_clean');
		$this->form_validation->set_rules('rapido', 'Rapido', 'xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('surname', 'Surname', 'required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('age', 'Age', 'required|numeric|max_length[3]|xss_clean|callback_age_check');
		$this->form_validation->set_rules('gender', 'Gender', 'required|max_length[1]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[70]|xss_clean');
		$this->form_validation->set_rules('address1', 'Address 1', 'required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('address2', 'Address 2', 'max_length[100]|xss_clean');
		$this->form_validation->set_rules('town', 'Town', 'max_length[50]|xss_clean');
		$this->form_validation->set_rules('county', 'County', 'required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'required|max_length[10]|xss_clean');
		$this->form_validation->set_rules('country', 'Country', 'required|max_length[2]|xss_clean');
		$this->form_validation->set_rules('send_promotions', 'Send Promotions', 'xss_clean');
		$this->form_validation->set_rules('competitions', 'Competitions', 'xss_clean');
		$this->form_validation->set_rules('is_subscribed', 'Terms and Conditions', 'xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			$this->editMember($member_id);
		}
		else
		{
			$this->load->model('members_model');
			$this->members_model->updateMember($member_id,$this->input->post());
			$this->session->set_flashdata('message', 'Member Updated.');
			redirect('members/index');
		}

	}

	public function age_check($str)
	{
		if($str>=18){
			return TRUE;
		}else{
			$this->form_validation->set_message('age_check', 'You must be 18 years old or over at the time of entry');
			return FALSE;
		}
	}


	//callback_terms_check
	/*public function terms_check($str)
	{
		if($str==TRUE){
			return TRUE;
		}else{
			$this->form_validation->set_message('terms_check', 'You must agree to our Terms and Conditions');
			return FALSE;
		}
	}*/

	public function one_checked($str)
	{

		if($this->input->post('49s')=='' && $this->input->post('irish')=='' && $this->input->post('vhr')=='' && $this->input->post('vgr')=='' && $this->input->post('rapido')==''){
			$this->form_validation->set_message('one_checked', 'At least one played product needs to be checked');
			return FALSE;

		}else{
			return TRUE;
		}

	}

}










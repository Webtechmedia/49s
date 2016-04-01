<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function index()
	{
		 if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
		 	$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
		 	redirect('/');
		 }
		$data['title'] = 'Admin';

		$this->load->model('admins_model');
		$data['admins'] = $this->admins_model->getAdmins();

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'admin/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	/*for email testing only */
/*	function sendEmail(){
		$this->load->library('email');

		$this->email->from('patryk@red7mobile.com', '49s admin');
		$this->email->to('pawel@red7mobile.com');


		$this->email->subject('49s admin Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		echo $this->email->print_debugger();

	}*/
}

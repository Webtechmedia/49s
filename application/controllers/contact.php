<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}


	public function send_email()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('Email_action');
		$this->load->model('JsonOutput');
		$this->load->library('email');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);


		$this->form_validation->set_rules('content', 'content', 'trim|required|max_length[1170]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[70]');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required|max_length[270]');

		if ($this->form_validation->run() == TRUE){
			$this->email->from($this->input->post('email',''), $this->input->post('email',''));
			$this->email->to('temp.dev.mail@gmail.com');
			//$this->email->cc('pawel@red7mobile.com');

			$this->email->subject($this->input->post('subject',''));
			$this->email->message($this->input->post('content',''));

			if($this->email->send()) {

			} else {
				$this->JsonOutput->setBody( $this->email->print_debugger() );
				$this->JsonOutput->server_obj->error_msg = 'There something wrong';
				$this->JsonOutput->server_obj->error_msg_array = array();
				$this->JsonOutput->server_obj->success = false;
			}
		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();
	}


}









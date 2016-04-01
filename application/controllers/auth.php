<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function enter_competition()
	{
		$this->load->model('Email_action');
		$this->load->model('JsonOutput');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[70]');

		if ($this->form_validation->run() == TRUE){
			if($user = $this->Email_action->is_registered($this->input->post('email',''))){

				$this->process_entering_competition($user);

			} else {
				$this->JsonOutput->server_obj->error_msg = 'You need to register';
				$this->JsonOutput->server_obj->success = false;
			}
		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();
	}

	private function process_entering_competition($user){
		//var_dump($user);
		if($this->Email_action->is_able_to_enter_competition($user)){
			if($competition = $this->Email_action->is_active_competition()){
				if(!$this->Email_action->is_entered_in_competition($competition,$user)){
					if( $this->Email_action->enter_competition($competition,$user) > 0 ){
						$this->JsonOutput->server_obj->user_msg = 'You enter competition';
						$this->JsonOutput->server_obj->success = true;
					} else {
						$this->JsonOutput->server_obj->user_msg = 'You not enter competition';
						$this->JsonOutput->server_obj->success = true;
					}
				} else {
					$this->JsonOutput->server_obj->user_msg = 'You already enter competition';
					$this->JsonOutput->server_obj->success = true;
				}
			} else {
				$this->JsonOutput->server_obj->user_msg = 'There is no active competitions';
				$this->JsonOutput->server_obj->success = true;
			}
		} else {
			$this->JsonOutput->server_obj->user_msg = 'You coming from outside UK';
			$this->JsonOutput->server_obj->success = true;
		}

	}

	public function register()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('Email_action');
		$this->load->model('JsonOutput');

		$json_input = trim(file_get_contents('php://input'));


		$_POST = json_decode($json_input,true);


		$this->form_validation->set_rules('firstName', 'firstName', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('surname', 'surname', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[70]');
		$this->form_validation->set_rules('postcode', 'postcode', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('age', 'age', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('plays49s', 'plays49s', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('playsILB', 'playsILB', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('playsVHR', 'playsVHR', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('playsVGR', 'playsVGR', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('playsRapido', 'playsRapido', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('sendPromotions', 'sendPromotions', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('address1', 'address1', 'trim|required|max_length[70]');
		//$this->form_validation->set_rules('address2', 'address2', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('town', 'town', 'trim|required|max_length[70]');
		//$this->form_validation->set_rules('county', 'county', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('country', 'country', 'trim|required|max_length[70]');

		if ($this->form_validation->run() == TRUE){
			if($user = $this->Email_action->is_registered($this->input->post('email',''))){
				$this->process_entering_competition($user);
			} else {
				if($user = $this->Email_action->user_register($this->input->post())) {
					$this->process_entering_competition($user);
				} else {

					$this->JsonOutput->server_obj->error_msg = 'There was problem with registration';
					$this->JsonOutput->server_obj->success = false;
				}
			}
		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();

	}

}









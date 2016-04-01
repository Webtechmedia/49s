<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Competitions extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function get_competition(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$body = new stdClass();

		$body =  $this->Num_games_model->get_competitions();;

		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();

	}

	public function check_email(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$body = new stdClass();

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);

		$this->form_validation->set_rules('email', 'email', 'trim|required|email');

		$number_of_balls = 3;

		if ($this->form_validation->run() == TRUE) {
			$body =  $this->Num_games_model->check_if_email_valid($this->input->post('email',''));;

		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;

		}

		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();

	}

	public function enter_competition(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$body = new stdClass();

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);

		$this->form_validation->set_rules('email', 'email', 'trim|required|email');
		$this->form_validation->set_rules('competition_id', 'competition_id', 'trim|required');

		$number_of_balls = 3;

		if ($this->form_validation->run() == TRUE) {
			$body =  $this->Num_games_model->enter_competitions($this->input->post('email',''),$this->input->post('competition_id',''));;
		}

		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();

	}




}









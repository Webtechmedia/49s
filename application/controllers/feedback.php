<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function send_feedback()
	{

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');


		$body = new stdClass();

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);

		$this->form_validation->set_rules('email', 'email', 'trim|required|email');

		if ($this->form_validation->run() == TRUE) {

			$body = $this->Num_games_model->save_feedback(
				$this->input->post('downloadApp',''),
				$this->input->post('email',''),
				$this->input->post('improvement',''),
				$this->input->post('listClear',''),
				$this->input->post('listEnjoyable',''),
				$this->input->post('listInfo',''),
				$this->input->post('listInteresting',''),
				$this->input->post('listLayout',''),
				$this->input->post('listUseful',''),
				$this->input->post('looking',''),
				$this->input->post('name',''),
				$this->input->post('rate49sLD',''),
				$this->input->post('rateFount',''),
				$this->input->post('rateILBLD',''),
				$this->input->post('rateLayout',''),
				$this->input->post('rateNew',''),
				$this->input->post('rateOld',''),
				$this->input->post('suggestions',''),
				$this->input->post('twitter','')

			);

		}

		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();
	}



}









<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Misssmiley extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function miss_smiley()
	{

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');


		$body = new stdClass();

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);

		//$this->form_validation->set_rules('email', 'email', 'trim|required|email');

		if (TRUE) {

		//$body = 'asdasd';
		
			$body = $this->Num_games_model->save_misssmiley(
				$this->input->post('shopname',''),
				$this->input->post('shopnumber',''),
				$this->input->post('emailaddress',''),
				$this->input->post('managername',''),
				$this->input->post('areamanager',''),
				$this->input->post('shopaddress1',''),
				$this->input->post('shopaddress2',''),
				$this->input->post('shopaddress3',''),
				$this->input->post('postcode',''),
				$this->input->post('shopphone',''),
				$this->input->post('package','')

			);

		}

		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();
	}



}









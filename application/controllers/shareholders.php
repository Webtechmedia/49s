<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shareholders extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function shareholders_banner()
	{

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$body = new stdClass();
		$body =  $this->Num_games_model->get_shareholders();


		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();
	}

	public function shareholders_mobile_banner()
	{

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$body = new stdClass();
		$body =  $this->Num_games_model->get_shareholders_mobile();;


		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();
	}



}









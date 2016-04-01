<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function faqs()
	{

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$body = new stdClass();
		$body->faqs =  $this->Num_games_model->get_faq();;


		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();
	}



}









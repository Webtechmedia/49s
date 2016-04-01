<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Winners extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}


	public function get_all()
	{
		//$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$body = new stdClass();
		$body->s49 =  $this->Num_games_model->get_winners('is_49s');;
		$body->ilb =  $this->Num_games_model->get_winners('is_ilb');;
		$body->ra =  $this->Num_games_model->get_winners('is_ra');;
		$body->vgr =  $this->Num_games_model->get_winners('is_vgr');;
		$body->vhr =  $this->Num_games_model->get_winners('is_vhr');;


		$this->JsonOutput->setBody( $body );

		$this->JsonOutput->execute();
	}



}









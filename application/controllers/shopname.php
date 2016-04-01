<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopname extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function shop_name()
	{
	
        $this->load->model('Num_games_model');
 
        echo json_encode($this->Num_games_model->getshopname());
 
    
		
		}



}









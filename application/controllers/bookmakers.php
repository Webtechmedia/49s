<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bookmakers extends MX_Controller
{

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	public function get_geo(){
		$this->load->model('Bookmakers_model');
		$this->Bookmakers_model->get_geo() ;
	}

    public function get_near_bookmakers(){

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


        $this->load->model('Email_action');
        $this->load->model('JsonOutput');
        $this->load->model('Bookmakers_model');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);



        $this->form_validation->set_rules('address', 'latitude', 'trim|required|max_length[70]');
        //$this->form_validation->set_rules('radius', 'radius', 'trim|required|max_length[70]');

        if ($this->form_validation->run() == TRUE){


            // $places = explode(",", $this->input->post('address'));
            //print_r($places);
            //$address_loc = $this->Bookmakers_model->get_address_geo( isset($places[0]) ? $places[0] : '' , isset($places[1]) ? $places[1] : '' );


        	$address_loc = $this->Bookmakers_model->get_address_geo($this->input->post('address'));
        	 
        	 

            if($address_loc->lat != 0 && $address_loc->long != 0 ){
            	
            	 
            	
                $lat = $address_loc->lat; // latitude of centre of bounding circle in degrees
                $lon = $address_loc->long; // longitude of centre of bounding circle in degrees
                //$rad = $this->input->post('radius'); // radius of bounding circle in kilometers
                $rad = 50; // radius of bounding circle in kilometers

                $R = 6378.137;  // earth's mean radius, km

                $Calc = "(".$R." * ACos( Cos( RADIANS(B_Lat) ) * Cos( RADIANS( ".$lat." ) ) * Cos( RADIANS( ".$lon." ) - RADIANS(B_Long) ) + Sin( RADIANS(B_Lat) ) * Sin( RADIANS( ".$lat." ) ) ))";
                $sqlstring2  = "SELECT *, " . $Calc . " As Distance FROM bookmakers WHERE " . $Calc . " <= ".$rad." ORDER BY Distance limit 20";
                $query = $this->db->query(  $sqlstring2  );

                $this->JsonOutput->setBody( $query->result() );
            } else {
            	
                $this->JsonOutput->server_obj->error_msg = "Google map can't find correct address.";
                $this->JsonOutput->server_obj->error_msg_array = validation_errors();
                $this->JsonOutput->server_obj->success = false;
            }
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }

    public function get_near_bookmakers_by_lat_lng(){

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


        $this->load->model('Email_action');
        $this->load->model('JsonOutput');
        $this->load->model('Bookmakers_model');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $this->form_validation->set_rules('lat', 'latitude', 'trim|required|max_length[70]');
        $this->form_validation->set_rules('lng', 'longitude', 'trim|required|max_length[70]');
        //$this->form_validation->set_rules('radius', 'radius', 'trim|required|max_length[70]');

        if ($this->form_validation->run() == TRUE){
            $lat = $this->input->post('lat'); // latitude of centre of bounding circle in degrees
            $lon = $this->input->post('lng'); // longitude of centre of bounding circle in degrees
            //$rad = $this->input->post('radius'); // radius of bounding circle in kilometers
            $rad = 200; // radius of bounding circle in kilometers

            $R = 6378.137;  // earth's mean radius, km

            $Calc = "(".$R." * ACos( Cos( RADIANS(B_Lat) ) * Cos( RADIANS( ".$lat." ) ) * Cos( RADIANS( ".$lon." ) - RADIANS(B_Long) ) + Sin( RADIANS(B_Lat) ) * Sin( RADIANS( ".$lat." ) ) ))";
            $sqlstring2  = "SELECT *, " . $Calc . " As Distance FROM bookmakers WHERE " . $Calc . " <= ".$rad." ORDER BY Distance limit 20";
            $query = $this->db->query(  $sqlstring2  );

            $this->JsonOutput->setBody( $query->result() );
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }

	public function get_all_bookmakers()
	{
		$this->load->model('Bookmakers_model');
		$this->load->model('JsonOutput');

		$this->JsonOutput->setBody( $this->Bookmakers_model->get_all() );

		$this->JsonOutput->execute();
	}



}









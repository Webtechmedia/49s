<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_feed_view extends MX_Controller
{

	function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('admin_feed_view_model');

		$data = array();

		$this->load->view('main_view', $data);
	}

	function virtual_horse_race()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('admin_feed_view_model');

		if( $this->input->post() ){
			$this->admin_feed_view_model->update_form_race_games();
		}

		$data = array();

		$data['get_draw_dates'] = $this->admin_feed_view_model->get_horse_race_dates();
		$data['url'] = 'race_show';
		$data['game_type'] = 'horse';
		$data['heading_title']='Virtual Horse Racing';
		$this->load->view('main_view_49', $data);
	}

	function virtual_dog_race()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('admin_feed_view_model');

		if( $this->input->post() ){
			$this->admin_feed_view_model->update_form_race_games();
		}

		$data = array();

		$data['get_draw_dates'] = $this->admin_feed_view_model->get_dog_race_dates();
		$data['url'] = 'race_show';
		$data['game_type'] = 'dog';
		$data['heading_title']='Virtual Greyhound Racing';
		$this->load->view('main_view_49', $data);
	}

	function numbers_49()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('admin_feed_view_model');

		if( $this->input->post() ){
			$this->admin_feed_view_model->update_form_number_games();
		}

		$data = array();
		$data['get_draw_dates'] = $this->admin_feed_view_model->get_49_games_dates();
		$data['url'] = 'number_49_draw';
		$data['game_type'] = '49';
		$data['heading_title']='49s';
		$this->load->view('main_view_49', $data);
	}

	function numbers_lucky()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('admin_feed_view_model');

		if( $this->input->post() ){
			$this->admin_feed_view_model->update_form_number_games();
		}

		$data = array();
		$data['get_draw_dates'] = $this->admin_feed_view_model->get_lucky_games_dates();
		$data['url'] = 'number_49_draw';
		$data['game_type'] = 'il';
		$data['heading_title']='Irish Lotto';
		$this->load->view('main_view_49', $data);
	}

	function numbers_rapido()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('admin_feed_view_model');

		if( $this->input->post() ){
			$this->admin_feed_view_model->update_form_number_games();
		}

		$data = array();
		$data['get_draw_dates'] = $this->admin_feed_view_model->get_rapido_games_dates();
		$data['url'] = 'number_49_draw';
		$data['game_type'] = 'ra';
		$data['heading_title']='Rapido';
		$this->load->view('main_view_49', $data);
	}

	function draw_49($data_input)
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('Admin_feed_view_model');

		$data = array();

		$id = 0;

		if(strlen($data_input['month']) == 1){
			$data_input['month'] = '0' .$data_input['month'];
		}

		if(strlen($data_input['day']) == 1){
			$data_input['day'] = '0' .$data_input['day'];
		}

		$dates = array();
		if($data_input['game_type'] == 'ra'){
			$dates = $this->Admin_feed_view_model->get_rapido_games_dates($data_input['year'],$data_input['month'],$data_input['day']);

		} else if($data_input['game_type'] == 'il'){
			$dates = $this->Admin_feed_view_model->get_lucky_games_dates($data_input['year'],$data_input['month']);

		} else if($data_input['game_type'] == '49'){
			$dates = $this->Admin_feed_view_model->get_49_games_dates($data_input['year'],$data_input['month']);

		}



		//var_dump($data_input);
		foreach($dates as $date){
			$id = $date->id;
		}

		if($data_input['game_type'] == 'ra'){
			$event_types = $this->Admin_feed_view_model->get_events_type_from_year_month_day($id);
		} else {
			$event_types = $this->Admin_feed_view_model->get_events_type_from_year_month($id);
		}
		//

		$data['get_events'] = array();
		foreach($event_types as $event_type){
			$get_event = $this->Admin_feed_view_model->get_number_game_info($event_type->id);
			$event_type->events = array();
			foreach( $get_event as $event ){
				$draws = $this->Admin_feed_view_model->get_number_game_numbers($event->id);
				$event->draws = array();
				foreach($draws as $draw){
					$numbers = $this->Admin_feed_view_model->get_number_game_drawn($draw->id);
					$draw->numbers = $numbers;
					//var_dump($draw);
					array_push($event->draws,$draw);
				}
				array_push($event_type->events,$event);
			}
			array_push($data['get_events'],$event_type);
		}

		//var_dump($data);

		$render = $this->load->view('numbers_games_table', $data,null,true);
	}


	function bulkDelete(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if(!$this->input->post('selected')){
			$this->session->set_flashdata('error', 'You didn\'t select records to delete !');
			redirect('/feed_view/'.$this->session->userdata('game'));
		}else{
			$this->load->model('admin_feed_view_model');
			//$this->Admin_feed_view_model->deleteBulkRecords($this->input->post('selected'));
			$this->session->set_flashdata('success', 'Records deleted !');
			redirect('/feed_view/'.$this->session->userdata('game'));
		}

	}

	function deleteNumberRecord($record_Id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if($record_Id==''){
			$this->session->set_flashdata('error', 'Invalid record ID !');
			redirect('/feed_view/'.$this->session->userdata('game'));
		}else{
			$this->load->model('admin_feed_view_model');
			$this->admin_feed_view_model->delete_number_game($record_Id);
			$this->session->set_flashdata('success', 'Record deleted !');
			redirect('/feed_view/'.$this->session->userdata('game'));
		}

	}

	function deleteRaceRecord($record_Id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		if($record_Id==''){
			$this->session->set_flashdata('error', 'Invalid record ID !');
			redirect('/feed_view/'.$this->session->userdata('game'));
		}else{
			$this->load->model('admin_feed_view_model');
			$this->admin_feed_view_model->delete_race_game($record_Id);
			$this->session->set_flashdata('success', 'Record deleted !');
			redirect('/feed_view/'.$this->session->userdata('game'));
		}

	}

	function edit49($data_input)
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('Admin_feed_view_model');

		if( $this->input->post() ){
			$this->Admin_feed_view_model->update_form_number_games();
		}

		$data = array();
		$data['numbers'] = array();
		$data['numbers'] = $this->Admin_feed_view_model->get_number_game_drawn($data_input['id']);
		$render = $this->load->view('edit_49', $data,null,true);
	}

	function editrace($data_input)
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('Admin_feed_view_model');

		if( $this->input->post() ){
			$this->Admin_feed_view_model->update_form_race_games();
		}

		$data = array();
		$data['racer'] = array();
		$data['racer'] = $this->Admin_feed_view_model->get_race_selection($data_input['id']);
		$render = $this->load->view('edit_race', $data,null,true);
	}

	function race_show($data_input)
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('Admin_feed_view_model');

		$data = array();

		$id = 0;


		if(strlen($data_input['month']) == 1){
			$data_input['month'] = '0' .$data_input['month'];
		}

		if(strlen($data_input['day']) == 1){
			$data_input['day'] = '0' .$data_input['day'];
		}

		$dates = array();
		if($data_input['game_type'] == 'dog'){
			$dates = $this->Admin_feed_view_model->get_dog_race_dates($data_input['year'],$data_input['month'],$data_input['day']);

		} else if($data_input['game_type'] == 'horse'){
			$dates = $this->Admin_feed_view_model->get_horse_race_dates($data_input['year'],$data_input['month'],$data_input['day']);

		}



		//var_dump($data_input);
		foreach($dates as $date){
			$id = $date->id;
		}

		if( $this->input->post() ){
			$this->Admin_feed_view_model->update_form_race_games();
		}

		$data = array();

		$event_types = $this->Admin_feed_view_model->get_events_type_from_year_month_day($id);
		//

		$data['get_events'] = array();
		foreach($event_types as $event_type){
			$get_event = $this->Admin_feed_view_model->get_race_game_info($event_type->id);
			$event_type->events = array();
			foreach( $get_event as $event ){
				$draws = $this->Admin_feed_view_model->get_race_event($event->id);
				$event->draws = array();
				foreach($draws as $draw){
					$numbers = $this->Admin_feed_view_model->get_race_selections($draw->id);
					$draw->numbers = $numbers;
					//var_dump($draw);
					array_push($event->draws,$draw);
				}
				array_push($event_type->events,$event);
			}
			array_push($data['get_events'],$event_type);
		}

		//var_dump($data);

		$render = $this->load->view('races_table', $data,null,true);



		/*

		$this->load->model('Admin_feed_view_model');

		$data = array();
		$data['get_meetings'] = $this->Admin_feed_view_model->get_race_game_info($data_input['id']);

		//var_dump($data['get_meetings']);

		$data['get_events'] = array();
		foreach( $data['get_meetings'] as $meeting ){
			$events = $this->Admin_feed_view_model->get_race_event($meeting->id);
			//var_dump($events);

			foreach($events as $event){
				$selections = $this->Admin_feed_view_model->get_race_selections($event->id);
				$event->selections = $selections;
				//var_dump($draw);
				array_push($data['get_events'],$event);
			}
		}

		$render = $this->load->view('races_table', $data,null,true);

		*/
	}


}

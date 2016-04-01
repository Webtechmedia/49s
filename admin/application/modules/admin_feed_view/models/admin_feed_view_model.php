<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_feed_view_model extends CI_Model {

	public function get_49_games_dates($year = 0, $month = 0)
	{
		
		$this->db->_protect_identifiers=false;
		$this->db->select('t_event_type.*');
		$this->db->select("DATE_FORMAT(t_event_type.date, '%Y-%m'  ) as date " , false );
		$this->db->where('t_event_type.country','UK');
		if($year > 0 && $month > 0){
			$this->db->where("DATE_FORMAT(t_event_type.date, '%Y-%m'  ) = '" . $year . "-" . $month . "' " , null, false );
		}
		//$this->db->where('t_event_type.name','event');
		$this->db->where('t_event_type.category','NB');
		$this->db->where('t_event_type.source','sportsData');
		$this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
		$this->db->group_by("DATE_FORMAT(t_event_type.date, '%Y%m'  )",true);
		$this->db->from('t_event_type');
		$this->db->limit(10);
		$this->db->order_by('t_event_type.id','desc');
		$query = $this->db->get();
		$result = $query->result();
	//	var_dump($this->db->last_query());
		
		return $result;
	}

	public function get_lucky_games_dates($year = 0, $month = 0)
	{
		$this->db->_protect_identifiers=false;
		$this->db->select('t_event_type.*');
		$this->db->select("DATE_FORMAT(t_event_type.date, '%Y-%m'  ) as date " , false );
		if($year > 0 && $month > 0){
			$this->db->where("DATE_FORMAT(t_event_type.date, '%Y-%m'  ) = '" . $year . "-" . $month . "' " , null, false );
		}
		$this->db->where('t_event_type.country','IE');
		$this->db->where('t_event_type.category','NB');
		$this->db->where('t_event_type.source','sportsData');
		$this->db->group_by("DATE_FORMAT(t_event_type.date, '%Y%m'  )",true);
		$this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
		$this->db->from('t_event_type');
		$this->db->limit(10);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
	
		return $query->result();
	}

	public function delete_number_game($id){
		$this->db->where('id',$id);
		$this->db->delete('t_number_event');
	}

	public function delete_race_game($id){
		$this->db->where('id',$id);
		$this->db->delete('t_events');
	}
	
	public function update_form_number_games(){
		if( $this->input->post() ){

			$draws = $this->input->post('draw',array());
			foreach($draws as $key => $draw){
				//$this->db->set('id_id',$draw['id_id']);
				$this->db->set('number',$draw['number']);
				//$this->db->set('bonusnumber',$draw['bonusnumber']);
				$this->db->where('id',$key);
				$this->db->update('t_drawn');
				//var_dump($key);
				//var_dump($draw);
			}
		}
	}

	public function update_form_race_games(){
		if( $this->input->post() ){
			//var_dump( $this->input->post() );

			if($this->input->post('save','') != ''){
				$draws = $this->input->post('racew',array());
				foreach($draws as $key => $draw){
					$this->db->set('runner_number',$draw['runner_number']);
					$this->db->set('position',$draw['position']);
					$this->db->set('sp',$draw['sp']);
					$this->db->set('name',$draw['name']);
					$this->db->where('selectionref',$key);
					$this->db->update('t_position');

					$this->db->set('name',$draw['name']);
					$this->db->where('id_id',$key);
					$this->db->update('t_selection');


					var_dump($key);
					var_dump($draw);
				}

			}
			if($this->input->post('del_race','') != ''){
				$draws = $this->input->post('racew',array());
				foreach($draws as $key => $draw){
					$this->db->where('id_id',$key);
					$this->db->from('t_selection');
					$query = $this->db->get();

					foreach($query->result() as $row){
						$this->db->where('id',$row->event_id);
						$this->db->delete('t_events');
					}
					//var_dump($key);
					//var_dump($draw);
				}

			}
			if($this->input->post('del_pos','') != ''){
				$draws = $this->input->post('racew',array());
				foreach($draws as $key => $draw){
					$this->db->where('id_id',$key);
					$this->db->delete('t_selection');
					//var_dump($key);
					//var_dump($draw);
				}
			}
		}
	}
	
	public function get_rapido_games_dates($year = 0, $month = 0, $day = 0)
	{


		$this->db->_protect_identifiers=false;
		$this->db->select('t_event_type.*');
		$this->db->select("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) as date " , false );
		if($year > 0 && $month > 0 && $day > 0){
			$this->db->where("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) = '" . $year . "-" . $month . "-" . $day . "' " , null, false );
		}
		$this->db->where('t_event_type.country','UK');
		$this->db->where('t_event_type.category','NB');
		$this->db->where('t_event_type.source','rapido');
		$this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
		$this->db->from('t_event_type');
		$this->db->group_by("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  )",true);
		$this->db->limit(10);
		$this->db->order_by('t_event_type.id','desc');
		$query = $this->db->get();
		//var_dump($this->db->last_query());

		return $query->result();
	}

	public function get_horse_race_dates($year = 0, $month = 0, $day = 0)
	{
		$this->db->_protect_identifiers=false;
		$this->db->select('t_event_type.*');
		$this->db->select("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) as date " , false );
		if($year > 0 && $month > 0 && $day > 0){
			$this->db->where("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) = '" . $year . "-" . $month . "-" . $day . "' " , null, false );
		}
		$this->db->where('t_event_type.country','VR');
		$this->db->where('t_event_type.name','event');
		$this->db->where('t_event_type.category','HR');
		$this->db->where('t_event_type.source','virtualRacing');
		$this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
		$this->db->group_by("DATE_FORMAT(t_event_type.date, '%Y%m%d'  )",true);
		$this->db->from('t_event_type');
		$this->db->limit(10);
		$this->db->order_by('t_event_type.id','desc');
		$query = $this->db->get();
		$result = $query->result();
		//var_dump($this->db->last_query());
				
		
		return $query->result();
	}

	public function get_race_selections($event_id)
	{
		$this->db->select('t_position.runner_number');
		$this->db->select('t_position.position');
		$this->db->select('t_selection.*');
		$this->db->where('t_selection.event_id',$event_id);
		$this->db->join('t_position','t_position.selectionref = t_selection.id_id');
		$this->db->from('t_selection');
		$this->db->group_by('t_selection.id_id');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_race_selection($selection_id)
	{
		$this->db->select('t_position.sp');
		$this->db->select('t_position.runner_number');
		$this->db->select('t_position.position');
		$this->db->select('t_selection.*');
		$this->db->where('t_selection.id',$selection_id);
		$this->db->join('t_position','t_position.selectionref = t_selection.id_id');
		$this->db->from('t_selection');
		$this->db->group_by('t_selection.id_id');
		$query = $this->db->get();

		//var_dump($this->db->last_query());
		return $query->result();
	}

	public function get_race_event($meeting_id)
	{
		$this->db->select('t_events.*');
		$this->db->where('meeting_id',$meeting_id);
		$this->db->from('t_events');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	public function get_dog_race_dates($year = 0, $month = 0, $day = 0)
	{
		$this->db->_protect_identifiers=false;
		$this->db->select('t_event_type.*');
		$this->db->select("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) as date " , false );
		if($year > 0 && $month > 0 && $day > 0){
			$this->db->where("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) = '" . $year . "-" . $month . "-" . $day . "' " , null, false );
		}
		$this->db->where('t_event_type.country','VR');
		//$this->db->where('t_event_type.name','event');
		$this->db->where('t_event_type.category','DG');
		$this->db->where('t_event_type.source','virtualRacing');
		$this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
		$this->db->group_by("DATE_FORMAT(t_event_type.date, '%Y%m%d'  )",true);
		$this->db->from('t_event_type');
		$this->db->limit(10);
		$this->db->order_by('t_event_type.id','desc');
		$query = $this->db->get();
		$result = $query->result();
		//var_dump($this->db->last_query());
					
		return $query->result();
	}

	public function get_events_type_from_year_month($id){
		//var_dump('wwwww');
		//$this->db->where('name','event');
		//$this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
		$this->db->where(" DATE_FORMAT(t_event_type.date, '%Y-%m'  ) = (SELECT DATE_FORMAT(t_event_type.date, '%Y-%m'  ) from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
		$this->db->where(" t_event_type.category = (SELECT t_event_type.category from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
		$this->db->where(" t_event_type.country = (SELECT t_event_type.country from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
		$this->db->where(" t_event_type.source = (SELECT t_event_type.source from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);

		$this->db->where("( t_event_type.name = 'numbers_game' OR  t_event_type.name = 'event'  ) ",null,false);

		$this->db->from('t_event_type');
		$this->db->order_by('t_event_type.date','desc');
		$query = $this->db->get();

		$result = $query->result();
		//var_dump($this->db->last_query());
		return $result;
	}

	public function get_events_type_from_year_month_day($id){
		//var_dump('wwwww');
		//$this->db->where('name','event');
		//$this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
		$this->db->where(" DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) = (SELECT DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
		$this->db->where(" t_event_type.category = (SELECT t_event_type.category from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
		$this->db->where(" t_event_type.country = (SELECT t_event_type.country from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
		$this->db->where(" t_event_type.source = (SELECT t_event_type.source from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);

		$this->db->where("( t_event_type.name = 'numbers_game' OR  t_event_type.name = 'event'  ) ",null,false);

		$this->db->from('t_event_type');
		$this->db->order_by('t_event_type.date','desc');
		$query = $this->db->get();

		$result = $query->result();
		//var_dump($this->db->last_query());
		return $result;
	}

	public function get_number_game_info($event_type_id)
	{
		$this->db->where('event_id',$event_type_id);
		$this->db->from('t_numbers');
		$query = $this->db->get();
	
		return $query->result();
	}

	public function get_race_game_info($event_type_id)
	{
		$this->db->where('event_type_id',$event_type_id);
		$this->db->from('t_meeting');
		$query = $this->db->get();
	
		return $query->result();
	}
	
	public function get_number_game_numbers($number_id)
	{
	
		$this->db->where('number_id',$number_id);
		$this->db->from('t_number_event');
		$query = $this->db->get();
	
		return $query->result();
	}

	public function get_number_game_drawn($draw_id)
	{
	
		$this->db->where('number_event_id',$draw_id);
		$this->db->from('t_drawn');
		$this->db->order_by('bonusnumber');
		$query = $this->db->get();
	
		return $query->result();
	}
	
} 
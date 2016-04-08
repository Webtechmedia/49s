<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Games extends MX_Controller
{

    public function index()
    {
        $this->load->model('JsonOutput');
        $this->JsonOutput->setBody('Unsupported method.');
        $this->JsonOutput->server_obj->success = false;
        $this->JsonOutput->execute();
    }

	public function get_testcache() {
		$this->load->model('Num_games_model');

		$val = $this->Num_games_model->cache_test();

		die($val);
	}

    public function get_previous(){
    	header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    	$this->load->model('JsonOutput');
    	$this->load->model('Num_games_model');

    	$json_input = trim(file_get_contents('php://input'));
    	$_POST = json_decode($json_input,true);

    	$this->form_validation->set_rules('game', 'game type', 'trim|required|max_length[70]');
    	$this->form_validation->set_rules('date', 'game date', 'trim|required|max_length[70]');

    	if ($this->form_validation->run() == TRUE){

    		$day_results = $this->Num_games_model->get_game_result_by_date($this->input->post('game'),$this->input->post('date'));

    		$game_results = array();

			foreach($day_results as $result){

				$game_results[$result->num]['draw_time'] = $result->time;
				$game_results[$result->num]['event_id'] = $result->id_id;


				// 0 - do not show results , 1 - show
				if($result->status=="M" || $result->status=="P" || $result->status=="V" || $result->status=="C"){
					$game_results[$result->num]['status'] = 0;
				}else{
					$game_results[$result->num]['status'] = 1;
				}

				$game_results[$result->num]['date'] = $result->date;

				if($this->input->post('game') == '49'){
					if ($result->num==1){
						$game_results[$result->num]['draw_name'] = "Lunchtime draw";
					} elseif($result->num==2) {
						$game_results[$result->num]['draw_name'] = "Teatime draw";
					}elseif($result->num==3){
						$game_results[$result->num]['draw_name'] = "3rd draw";
					}else{
						$game_results[$result->num]['draw_name'] = $result->num."th draw";
					}
				}
				if($this->input->post('game') == 'il'){
					if ($result->num == 1){
						$game_results[$result->num]['draw_name'] = "Main draw";
					} else if($result->num == 2) {
						$game_results[$result->num]['draw_name'] = "2nd draw";
					} else if($result->num == 3) {
						$game_results[$result->num]['draw_name'] = "3rd draw";
					}
				}
				if($this->input->post('game') == 'ra'){
					$game_results[$result->num]['draw_name'] =  "Draw " . $result->num ;
				}

				if($result->bonusnumber!='Y'){
					$game_results[$result->num]['results']['numbers'][] = $result->number;
				}
				if($result->bonusnumber=='Y'){
					$game_results[$result->num]['results']['booster'] = $result->number;
				}
				$game_results[$result->num]['results']['actual_draw_time'] = $result->offtime;

			}

			//flatten objects array
			$draws = array();
			foreach($game_results as $draw){
				$draws[]=$draw;
			}


			// next scheduled event predictions only for current date
			if($this->input->post('date') == date("Y-m-d")){

				if($this->input->post('game') == '49'){
					if( count($draws) == 1 || count($draws) == 0 ){
						$predicted_next_draw=$this->Num_games_model->get_game_next_date($this->input->post('game'), $this->input->post('date'));
						$nextEvent = new stdClass();
						
						
							if(!empty($predicted_next_draw->num)){
								if ($predicted_next_draw->num==1){
									$nextEvent->draw_name = "Lunchtime draw";
								} elseif($predicted_next_draw->num==2) {
									$nextEvent->draw_name = "Teatime draw";
								}elseif($predicted_next_draw->num==3){
									$nextEvent->draw_name = "3rd draw";
								}else{
									$nextEvent->draw_name = $predicted_next_draw->num."th draw";
								}
								if(!empty($predicted_next_draw->status) && $predicted_next_draw->status=="C"){
									$nextEvent->status = '0';
									$nextEvent->draw_name = "Next draw";
								}else{
									$nextEvent->status = '1';
								}
								
								
								$nextEvent->draw_time = $predicted_next_draw->draw_time;
								$nextEvent->event_id = $predicted_next_draw->event_id;
								$nextEvent->results = array();
								$nextEvent->date = $this->input->post('date');
								array_push($draws, $nextEvent);
							}
						 
						
					}
				}
				if($this->input->post('game') == 'il'){
					if( count($draws) == 1 || count($draws) == 0 ){
						$predicted_next_draw=$this->Num_games_model->get_game_next_date($this->input->post('game'), $this->input->post('date'));
						$nextEvent = new stdClass();
						if(!empty($predicted_next_draw->num)){
							if ($predicted_next_draw->num == 1){
								$nextEvent->draw_name = "Main draw";
							} else if($predicted_next_draw->num == 2) {
								$nextEvent->draw_name = "2nd Draw";
							} else if($predicted_next_draw->num == 3) {
								$nextEvent->draw_name = "3rd Draw";
							}
							$nextEvent->draw_time = $predicted_next_draw->draw_time;
							$nextEvent->event_id = $predicted_next_draw->event_id;
							$nextEvent->results = array();
							$nextEvent->date = $this->input->post('date');
							array_push($draws, $nextEvent);
						}
					}
				}
			}



    		$this->JsonOutput->setBody($draws);
    	} else {
    		$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
    		$this->JsonOutput->server_obj->error_msg_array = validation_errors();
    		$this->JsonOutput->server_obj->success = false;
    	}
    	$this->JsonOutput->execute();
    }






















    public function get_homepage_results(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('JsonOutput');
        $this->load->model('Num_games_model');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $this->form_validation->set_rules('game_type', 'game type', 'trim|required|max_length[70]');

        $number_of_balls = 3;

        if ($this->form_validation->run() == TRUE) {

            $body = new stdClass();

            $body->previous_draw_range = new stdClass();

            $body->draws = array();

            $draws_array = array();

            $game_type = $this->input->post('game_type','');

            $body_array = array();

            if($game_type == '49' || $game_type == 'il' || $game_type == 'ra' ){

            	$oldest=explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'asc')->date);
            	$newest=explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'desc')->date);

            	$body->previous_draw_range->oldest_inclusive = $oldest[0];
            	$body->previous_draw_range->newest_inclusive = $newest[0];
            	$todays_date = strtotime(date("Y-m-d"));
            	$newest_date = strtotime($body->previous_draw_range->newest_inclusive);
            	if ($todays_date < $newest_date) {
            		$body->previous_draw_range->newest_inclusive = date("Y-m-d");
            	}

                $date = $body->previous_draw_range->newest_inclusive;

                $games_results = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type',''),$date);

                $iii=0;
                while(count($games_results) == 0){
                    $date = date ("Y-m-d", strtotime("-1 day", strtotime($date)));
                    $games_results = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type',''), $date);
                    if($iii>9999){ break; }
                    $iii++;
                }
             

                //$body->previous_draw_range->newest_inclusive=$date;
                $body->previous_draw_range->newest_inclusive=date("Y-m-d");

                foreach($games_results as &$row){
                    $row->results = new stdClass();

                    if($this->input->post('game_type','')=='ra'){
                    	$draws = $this->Num_games_model->get_game_result_for_date_rapido($this->input->post('game_type',''),$date,$row->event_id);
                    }else{
                    	$draws = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type',''),$date,$row->event_id);
                    }

                    $numbers = array();
                    $booster = 0;
                    foreach($draws as $draw){

                        //var_dump($draw);
                        $row->results->actual_draw_time = $draw->offtime;

                        if($game_type == '49'){


                        	if ($draw->num == 1){
                        		$row->draw_name =  "Lunchtime draw";
                        	} else if($draw->num == 2) {
                        		$row->draw_name =  "Teatime draw";
                        	} else if($draw->num == 3) {
                        		$row->draw_name =  "3rd Draw";
                        	}else{
                        		$row->draw_name =  $draw->num."th Draw";
                        	}
                        }
                        if($game_type == 'ra'){
                            $row->draw_name =  "Draw " . $draw->num ;
                        }
                        if($game_type == 'il'){
                            if ($draw->num == 1){
                                $row->draw_name = "Main draw";
                            } else if($draw->num == 2) {
                                $row->draw_name = "2nd draw";
                            } else if($draw->num == 3) {
                                $row->draw_name = "3rd draw";
                            }
                        }

                        if($draw->bonusnumber == 'Y'){
                            $booster = $draw->number;
                        } else {
                            array_push($numbers,$draw->number);
                        }
                        // 0 - do not show results , 1 - show
                        if($draw->status=="M" || $draw->status=="P" || $draw->status=="V" || $draw->status=="C"){
                         	$row->status = 0;
                        }else{
                         	$row->status = 1;
                        }
                   }

                    $row->results->numbers = $numbers;
                    $row->results->booster = $booster;

                    array_push($draws_array, $row);
                }
                if( count($draws_array) == 1 ){
                    $rowww = new stdClass();

                    $new = $this->Num_games_model->get_game_next_date('49', $date);

                    if(isset($new->draw_time)){
                        $rowww->draw_time = $new->draw_time;
                        $rowww->event_id = $new->event_id;

                        if($game_type == '49'){
                        	if ($draw->num == 1){
                        		$rowww->draw_name = "Lunchtime draw";
                        	} else if($draw->num == 2) {
                        		$rowww->draw_name = "Teatime draw";
                        	} else if($draw->num == 3) {
                        		$rowww->draw_name = "3rd draw";
                        	} else{
                        		$rowww->draw_name = $draw->num."th draw";
                        	}
                        }

                        if(!empty($draw->status) && $draw->status=="A"){
                        	$rowww->status = '0';
                        	$rowww->draw_name = "Next draw";
                        }else{
                        	$rowww->status = '1';
                        }
                        
                        if($game_type == 'ra'){
                            $rowww->draw_name =  "Draw " . $draw->num ;
                        }
                        if($game_type == 'il'){
                            if ($draw->num == 1){
                                $rowww->draw_name = "Main draw";
                            } else if($draw->num == 2) {
                                $rowww->draw_name = "2nd draw";
                            } else if($draw->num == 3) {
                                $rowww->draw_name = "3rd draw";
                            }
                        }

                    } else {
                        $rowww->draw_time = 'No scheduled events today';
                        $rowww->event_id = 0;
                    }

                    $rowww->results = null;
                    array_push($draws_array, $rowww);
                    array_push($games_results, $rowww);
                }

                $body->draws = $draws_array;

                $latest_results_date=explode(" ", $this->Num_games_model->get_games_date_with_results($this->input->post('game_type', ''), 'desc')->date);

                $body->date = $latest_results_date[0];
                $body->draws = $games_results;

                
                
                
                
                
                
                
                
                
                $number_of_balls = 10;
                $body->hot_cold = new stdClass();
                	 
                
                	$hottest10=$this->Num_games_model->get_hot_cold_numbers('desc', $number_of_balls, $this->input->post('game_type'));
                	//get totals for numbers
                	foreach ($hottest10 as &$hottest){
                		$hottest->total = $this->Num_games_model->get_ball_total_draw( $this->input->post('game_type'),$hottest->number);
                	}
                	$this->sort_hottest_by_times_and_total($hottest10,array("times","total"));
                	//remove unnecessary numbers
                $body->hot_cold->hot = array_slice($hottest10, 0, 3);
                
                	$coldest10=$this->Num_games_model->get_hot_cold_numbers('asc', $number_of_balls, $this->input->post('game_type'));
                	//get totals for numbers
                	foreach ($coldest10 as &$coldest){
                		$coldest->total = $this->Num_games_model->get_ball_total_draw( $this->input->post('game_type'),$coldest->number);
                	}
                	$this->sort_coldest_by_times_and_total($coldest10,array("times","total"));
                	//remove unnecessary numbers
                $body->hot_cold->cold = array_slice($coldest10, 0, 3);
                
                
                
                
                
                
                
             
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            } else {

                if($game_type == 'vhr'  ) {
                    $game_type = 'hr';
                }
                if($game_type == 'vdr'  ) {
                    $game_type = 'dg';
                }
                if($game_type == 'vgr'  ) {
                    $game_type = 'dg';
                }

                //set oldest and newest draw date

               $oldest_results=$this->Num_games_model->get_games_date_vhr_vgr($game_type, 'desc');
               $newest_results=$this->Num_games_model->get_games_date_vhr_vgr($game_type, 'asc');
                
               $oldest_race=$oldest_results[0];
               $newest_race=$newest_results[0];
               
               $body->previous_draw_range->oldest_inclusive =  $oldest_race->date;
               $body->previous_draw_range->newest_inclusive =  date("Y-m-d");
                
                
                
                $todays_date = strtotime(date("Y-m-d"));
                $newest_date = strtotime($body->previous_draw_range->newest_inclusive);
                if ($todays_date < $newest_date) {
                	$body->previous_draw_range->newest_inclusive = date("Y-m-d");
                }




                $daterange_from = $body->previous_draw_range->newest_inclusive ;
                $daterange_to = $body->previous_draw_range->newest_inclusive ;

               	$locations = $this->Num_games_model->get_race_locations($game_type, $daterange_from, $daterange_to);

               	$iii = 0;
               	while(count($locations) == 0){
               		$daterange_from = date ("Y-m-d", strtotime("-1 day", strtotime($daterange_from)));
               		$daterange_to = date ("Y-m-d", strtotime("-1 day", strtotime($daterange_to))) ;
               		$locations = $this->Num_games_model->get_race_locations($game_type,$daterange_from,$daterange_to);
               		
               		$iii++;
               		if ($iii > 9999) {
               			break;
               		}
               	}
           



                foreach($locations as $location){
                    $location_obj = new stdClass();

                    $correct_location_name='';
                    if($location->name=='SprintValley' || $location->name=='SPRINTVALLEY'){

                    	$correct_location_name='SPRINT VALLEY';
                    }else{
                    	$correct_location_name=$location->name;
                    }

                    $location_obj->location = $correct_location_name;

                    $location_obj->races = array();

                    $races = $this->Num_games_model->get_race_by_location($game_type, $daterange_from, $daterange_to, $location->name);
                    foreach($races as &$race){

                    	if($game_type=='hr'){
                    		$race->positions = $this->Num_games_model->get_positions_from_race_hr($race->event_id);
                    	}else{
                    		$race->positions = $this->Num_games_model->get_positions_from_race_dg($race->event_id);
                    	}

                    	if ($race->status=="M" || $race->status=="X" || $race->status=="V" || $race->status=="A"){
                    		$race->status = 0;
                    	}else{
                    		$race->status = 1;
                    	}

                        if($race->name=='SprintValley' || $location->name=='SPRINTVALLEY'){
                        	$race->name='SPRINT VALLEY';
                        }
                    }
                    $location_obj->races = $races;

                    array_push($body_array, $location_obj);

                }
                $body->locations = $body_array;


            }
            
            $this->JsonOutput->setBody( $body );
            //$this->
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }

















    public function get_previous_results(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('JsonOutput');
        $this->load->model('Num_games_model');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $this->form_validation->set_rules('game_type', 'game type', 'trim|required|max_length[70]');
        $this->form_validation->set_rules('date', 'date', 'trim|required|max_length[70]');

        $number_of_balls = 3;

        if ($this->form_validation->run() == TRUE) {

            $date = $this->input->post('date','');
            $data_input = array();

            $new_date = explode('-',$date);

            $data_input['day'] = $new_date[2];
            $data_input['month'] = $new_date[1];
            $data_input['year'] = $new_date[0];




            $body = new stdClass();
            $body->draws = array();
            $body->previous_draw_range = new stdClass();

            $body_array = array();
            $draw_body = new stdClass();

            $locations = array();

            $game_type = $this->input->post('game_type','');

            $number_of_days_in_month=cal_days_in_month(CAL_GREGORIAN,$data_input['month'],$data_input['year']);

            if($game_type == '49' || $game_type == 'il' || $game_type == 'ra' ){

            	$newest_date = explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'asc')->date);
            	$oldest_date = explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'desc')->date);

            	$body->previous_draw_range->oldest_inclusive = $newest_date[0];
            	$body->previous_draw_range->newest_inclusive = $oldest_date[0];

            	$todays_date = strtotime(date("Y-m-d"));
            	$newest_date = strtotime($body->previous_draw_range->newest_inclusive);
            	if ($todays_date < $newest_date) {
            		$body->previous_draw_range->newest_inclusive = date("Y-m-d");
            	}

                for($i = 1 ; $i <= $number_of_days_in_month; $i++) {

					$draw_body = new stdClass();
                	$draw_body->date = $data_input['year'] . '-' . $data_input['month'] . '-' . (($i < 10) ? ('0' . $i) : $i);
                	$draw_body->draws = array();
                	//for current month only till todays date
                	if(strtotime($data_input['year'].'-'.$data_input['month'].'-'.$i) <= $todays_date ){

                		$draws_array = array();

                		// get results for date
                		$games_results = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type', ''), $draw_body->date);

                		foreach ($games_results as &$row) {

                			$row->results = new stdClass();
                			$draws = array();

                			if($this->input->post('game_type','')=='ra'){
                				$draws = $this->Num_games_model->get_game_result_for_date_rapido($this->input->post('game_type',''),$draw_body->date,$row->event_id);
                			
                			}else{
                				$draws = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type',''),$draw_body->date,$row->event_id);
                			}

                			$numbers = array();
                			$booster = 0;

                			foreach ($draws as $draw) {
                				$row->results->actual_draw_time = $draw->offtime;
                				if($game_type == '49'){

                					if ($draw->num==1){
                						$row->draw_name = "Lunchtime draw";
                					} elseif($draw->num==2) {
                						$row->draw_name = "Teatime draw";
                					}elseif($draw->num==3){
                						$row->draw_name = "3rd Draw";
                					}else{
                						$row->draw_name = $draw->num."th draw";
                					}
                				}
                				if($game_type == 'ra'){
                					$row->draw_name = "Draw " . $draw->num ;
                				}
                				if($game_type == 'il'){
                					if ($draw->num == 1){
                						$row->draw_name = "Main draw";
                					} else if($draw->num == 2) {
                						$row->draw_name = "2nd draw";
                					} else if($draw->num == 3) {
                						$row->draw_name = "3rd draw";
                					}else{
                						$row->draw_name = $draw->num."th draw";
                					}
                				}
                				if ($draw->bonusnumber == 'Y') {
                					$booster = $draw->number;
                				} else {
                					array_push($numbers, $draw->number);
                				}

                				if($draw->status=="M" || $draw->status=="X" || $draw->status=="V" || $draw->status=="A"){
                					$row->status = 0;
                				}else{
                					$row->status = 1;
                				}


                			}

                			$row->results->numbers = $numbers;
                			$row->results->booster = $booster;
                			array_push($draws_array, $row);
                			$draw_body->draws = $draws_array;
                		}
                		$rowww = new stdClass();
						//scheduled event predictions
                		if($draw_body->date == date("Y-m-d")){

                			if(count($draws_array)==0 || count($draws_array)==1){

                				$predicted_event = new stdClass();
                				if($game_type == '49'){
                					$new = $this->Num_games_model->get_game_next_date('49', $draw_body->date);
                				}
                				if($game_type == 'il'){
                					$new = $this->Num_games_model->get_game_next_date('il', $draw_body->date);
                				}
                				if(isset($new->draw_time)){

                					$predicted_event->draw_time = $new->draw_time;
                					$predicted_event->event_id = $new->event_id;
                					$predicted_event->results = null;

                					if($game_type == '49'){
                						if ($new->num == 1){
                							$predicted_event->draw_name = "Lunchtime draw";
                						} else if($new->num == 2) {
                							$predicted_event->draw_name = "Teatime draw";
                						} else if($new->num == 3) {
                							$predicted_event->draw_name = "3rd Draw";
                						}else{
                							$predicted_event->draw_name = $new->num."th Draw";
                						}
                					
                					}
                					if(!empty($new->status) && $new->status=="A"){
                						$predicted_event->status = '0';
                						$predicted_event->draw_name = 'Next Draw';
                					}else{
                						$predicted_event->status = '1';
                					}

                					if($game_type == 'il'){
                						if ($draw->num == 1){
                							$rowww->draw_name = "Main draw";
                						} else if($draw->num == 2) {
                							$rowww->draw_name = "2nd Draw";
                						} else if($draw->num == 3) {
                							$rowww->draw_name = "3rd Draw";
                						}
                					}

                				}


                				if(is_object($predicted_event) && property_exists($predicted_event, "draw_time")){

                					$draw_body->draws[] = $predicted_event;
                				}

                			}
                		}

                		array_push($body->draws, $draw_body);

                	}else{
                		$draw_body->date = $data_input['year'] . '-' . $data_input['month'] . '-' . (($i < 10) ? ('0' . $i) : $i);

                		$draw_body->draws = array();

                		array_push($body->draws, $draw_body);
                	}
                }

            } else {
                if($game_type === 'vhr'  ) {
                    $game_type = 'hr';
                }
                if($game_type === 'vdr'  ) {
                    $game_type = 'dg';
                }
                if($game_type === 'vgr'  ) {
                    $game_type = 'dg';
                }



                $daterange_from = $data_input['year'] . '-' . $data_input['month'] . '-' . $data_input['day'] ;
                $daterange_to = $data_input['year'] . '-' . $data_input['month'] . '-' . $data_input['day'] ;

    
 
                $body->previous_draw_range->oldest_inclusive = $this->Num_games_model->get_oldest_race_date($game_type); 
                $body->previous_draw_range->newest_inclusive = date("Y-m-d");
                
                

                $locations = $this->Num_games_model->get_race_locations($game_type, $daterange_from, $daterange_to);


                foreach($locations as $location){
                    $location_obj = new stdClass();

                    $correct_location_name='';
                    if($location->name=='SprintValley' ||  $location->name=='SPRINTVALLEY'  ){

                    	$correct_location_name='SPRINT VALLEY';
                    }else{
                    	$correct_location_name=$location->name;
                    }

                    $location_obj->location = $correct_location_name;

                    $location_obj->races = array();

                    $races = $this->Num_games_model->get_race_by_location($game_type, $daterange_from, $daterange_to, $location->name);

                    foreach($races as &$race){

                    	if ($race->status=="M" || $race->status=="X" || $race->status=="V" || $race->status=="A"){
                    		$race->status = 0;
                    	}else{
                    		$race->status = 1;
                    	}

						if($game_type=='hr'){
							$race->positions = $this->Num_games_model->get_positions_from_race_hr($race->event_id);
						}else{
							$race->positions = $this->Num_games_model->get_positions_from_race_dg($race->event_id);
						}

                        if($race->name=='SprintValley' ||  $location->name=='SPRINTVALLEY' ){
                        	$race->name='SPRINT VALLEY';
                        }
                    }

                    $location_obj->races = $races;
                    array_push($body_array, $location_obj);
                }
                $body->locations = $body_array;
            }

            $this->JsonOutput->setBody( $body );
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }














    public function get_next_game(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('JsonOutput');
        $this->load->model('Num_games_model');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $this->form_validation->set_rules('date', 'date', 'trim|required|max_length[70]');

        if ($this->form_validation->run() == TRUE) {

            $date = $this->input->post('date','');
            $data_input = array();

            $new_date = explode('-',$date);

            $data_input['day'] = $new_date[2];
            $data_input['month'] = $new_date[1];
            $data_input['year'] = $new_date[0];

            $body = new stdClass();

            $game_type = $this->input->post('game_type','');

            $body->next_game_row_49s = $this->Num_games_model->get_game_next_date('49', $date);
            if(isset($body->next_game_row_49s->draw_time)){
                $body->next_game_49s = date("g:ia", strtotime($body->next_game_row_49s->draw_time));
            } else {
                //tommorow
                $tommorow=date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                $body->next_game_row_49s = $this->Num_games_model->get_game_next_date('49',$tommorow);
                if(isset($body->next_game_row_49s->draw_time)){
                	$body->next_game_row_49s = $body->next_game_row_49s->draw_time;
                	$body->next_game_row_49s = 'Tomorrow at '.date("g:ia", strtotime($body->next_game_row_49s->draw_time));
                } else {
                	$body->next_game_49s = 'No scheduled events today';
                }
            }

            $body->next_game_row_ra = $this->Num_games_model->get_game_next_date('ra', $date);

            if(isset($body->next_game_row_ra->draw_time)){
                $body->next_game_ra = date("g:ia", strtotime($body->next_game_row_ra->draw_time));

            } else {
                //tommorow
                $tommorow=date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                $body->next_game_ra = $this->Num_games_model->get_game_next_date('ra',$tommorow);
                if(isset($body->next_game_row_ra->draw_time)){
                	$body->next_game_ra = $body->next_game_row_ra->draw_time;
                	$body->next_game_ra = date('l', strtotime($tommorow)).' at '.date("g:ia", strtotime($body->next_game_row_ra->draw_time));
                } else {
                	$body->next_game_ra = 'No scheduled events today';
                }
            }

            $body->next_game_row_ilb = $this->Num_games_model->get_game_next_date('il', $date);
            if(isset($body->next_game_row_ilb->draw_time)){
            	//today
                $body->next_game_ilb = date("g:ia", strtotime($body->next_game_row_ilb->draw_time));
            } else {
            	//tommorow
				$tommorow=date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            	$body->next_game_row_ilb = $this->Num_games_model->get_game_next_date('il',$tommorow);
            	if(isset($body->next_game_row_ilb->draw_time)){
            		$body->next_game_ilb = $body->next_game_row_ilb->draw_time;
            		$body->next_game_ilb = date('l', strtotime($tommorow)).' at '.date("g:ia", strtotime($body->next_game_row_ilb->draw_time));
            	} else {
					//day after tommorow
					$dayAfterTommorow=date ("Y-m-d", strtotime("+2 day", strtotime($date)));
            		$body->next_game_row_ilb = $this->Num_games_model->get_game_next_date('il', $dayAfterTommorow);
            		if(isset($body->next_game_row_ilb->draw_time)){
            			$body->next_game_ilb = date('l', strtotime($dayAfterTommorow)).' at '.date("g:ia", strtotime($body->next_game_row_ilb->draw_time));
            		} else {
            			//two days after tommorow
            			$twoAfterTommorow=date ("Y-m-d", strtotime("+3 day", strtotime($date)));
            			$body->next_game_row_ilb = $this->Num_games_model->get_game_next_date('il', $twoAfterTommorow);
            			if(isset($body->next_game_row_ilb->draw_time)){
            				$body->next_game_ilb = date('l', strtotime($twoAfterTommorow)).' at '.date("g:ia", strtotime($body->next_game_row_ilb->draw_time));
            			} else {
            				//three days after tommorow
            				$body->next_game_ilb = 'No scheduled events today';
            			}
            		}
            	}
            }

            unset($body->next_game_row_49s);
            unset($body->next_game_row_ra);
            unset($body->next_game_row_ilb);

            $body->next_game_row_vgr = $this->Num_games_model->get_race_next_date('dg', $date);
            if(isset($body->next_game_row_vgr->draw_time)){
                $body->next_game_vgr = date("g:ia", strtotime($body->next_game_row_vgr->draw_time));
            } else {
            	//day after tommorow
            	$dayAfterTommorow=date ("Y-m-d", strtotime("+2 day", strtotime($date)));
            	$body->next_game_row_vgr = $this->Num_games_model->get_game_next_date('dg', $dayAfterTommorow);
            	if(isset($body->next_game_row_vgr->draw_time)){
            		$body->next_game_vgr = date('l', strtotime($dayAfterTommorow)).' at '.date("g:ia", strtotime($body->next_game_row_vgr->draw_time));
            	} else {
            		//two days after tommorow
            		$twoAfterTommorow=date ("Y-m-d", strtotime("+3 day", strtotime($date)));
            		$body->next_game_row_vgr = $this->Num_games_model->get_game_next_date('dg', $twoAfterTommorow);
            		if(isset($body->next_game_row_vgr->draw_time)){
            			$body->next_game_vgr = date('l', strtotime($twoAfterTommorow)).' at '.date("g:ia", strtotime($body->next_game_row_vgr->draw_time));
            		} else {
            			//three days after tommorow
            			$twoAfterTommorow=date ("Y-m-d", strtotime("+4 day", strtotime($date)));
            			$body->next_game_row_vgr = $this->Num_games_model->get_game_next_date('dg', $twoAfterTommorow);
            			if(isset($body->next_game_row_vgr->draw_time)){
            				$body->next_game_vgr = date('l', strtotime($twoAfterTommorow)).' at '.date("g:ia", strtotime($body->next_game_row_vgr->draw_time));
            			} else {
            				//three days after tommorow
            				$body->next_game_vgr = 'No scheduled events today';
            			}
            		}
            	}
            }

            $body->next_game_row_vhr = $this->Num_games_model->get_race_next_date('hr', $date);

            if(isset($body->next_game_row_vhr->draw_time)){
                $body->next_game_vhr = date("g:ia", strtotime($body->next_game_row_vhr->draw_time));
            } else {
            	//tommorow
            	$tommorow=date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            	$body->next_game_vhr = $this->Num_games_model->get_game_next_date('hr',$tommorow);
            	if(isset($body->next_game_row_vhr->draw_time)){
            		$body->next_game_vhr = 'Tomorrow at '.date("g:ia", strtotime($body->next_game_row_vhr->draw_time));
            	} else {
            		$body->next_game_vhr = 'No scheduled events today';
            	}
            }

            unset($body->next_game_row_vgr);
            unset($body->next_game_row_vhr);

            $this->JsonOutput->setBody( $body );
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }

    
    
    public function get_hot_cold_balls(){
    	header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    	$this->load->model('JsonOutput');
    	$this->load->model('Num_games_model');
    
    	$json_input = trim(file_get_contents('php://input'));
    	$_POST = json_decode($json_input,true);
    
    	$this->form_validation->set_rules('game_type', 'game type', 'trim|required|max_length[70]');
    
    	$number_of_balls = 10;
    
    	if ($this->form_validation->run() == TRUE) {
    		    $body = new stdClass();
    
    		    $hottest10=$this->Num_games_model->get_hot_cold_numbers('desc', $number_of_balls, $this->input->post('game_type'));
    		    //get totals for numbers
    		    foreach ($hottest10 as &$hottest){
    			    $hottest->total = $this->Num_games_model->get_ball_total_draw( $this->input->post('game_type'),$hottest->number);
    		    }
	    	    $this->sort_hottest_by_times_and_total($hottest10,array("times","total"));
	    	    //remove unnecessary numbers 
    		    $body->hot = array_slice($hottest10, 0, 3);
    		    
    		    $coldest10=$this->Num_games_model->get_hot_cold_numbers('asc', $number_of_balls, $this->input->post('game_type'));
    		    //get totals for numbers
    		    foreach ($coldest10 as &$coldest){
    			    $coldest->total = $this->Num_games_model->get_ball_total_draw( $this->input->post('game_type'),$coldest->number);
    		    }
    		    $this->sort_coldest_by_times_and_total($coldest10,array("times","total"));
    		    //remove unnecessary numbers
    		    $body->cold = array_slice($coldest10, 0, 3);
    		$this->JsonOutput->setBody( $body );
    	} else {
    		$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
    		$this->JsonOutput->server_obj->error_msg_array = validation_errors();
    		$this->JsonOutput->server_obj->success = false;
    	}
    
    	$this->JsonOutput->execute();
    
    }
    
    public function sort_hottest_by_times_and_total(&$hottest10, $props)
    {
    	usort($hottest10, function($a, $b) use ($props) {
    		if($a->$props[0] == $b->$props[0])
    			return $a->$props[1] < $b->$props[1] ? 1 : -1;
    		return $a->$props[0] < $b->$props[0] ? 1 : -1;
    	});
    }
    public function sort_coldest_by_times_and_total(&$coldest10, $props)
    {
    	usort($coldest10, function($a, $b) use ($props) {
    		if($a->$props[0] == $b->$props[0])
    			return $a->$props[1] > $b->$props[1] ? 1 : -1;
    		return $a->$props[0] > $b->$props[0] ? 1 : -1;
    	});
    }
    
    
    
    

    public function get_balls_statistics(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('JsonOutput');
        $this->load->model('Num_games_model');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $this->form_validation->set_rules('game_type', 'game type', 'trim|required|max_length[70]');

        $number_of_balls = 3;

        if ($this->form_validation->run() == TRUE) {

            $body = new stdClass();

            $body->statistic = $this->Num_games_model->get_games_statistic($this->input->post('game_type',''),'');
 
            $body->first_draw = $this->Num_games_model->get_games_date($this->input->post('game_type',''),'asc');
            $body->last_draw = $this->Num_games_model->get_games_date($this->input->post('game_type',''),'desc');
            $body->total = $this->Num_games_model->get_games_total($this->input->post('game_type',''),'desc');

            $this->JsonOutput->setBody( $body );
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }

    public function get_assets(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('JsonOutput');
        $this->load->model('Num_games_model');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $this->form_validation->set_rules('game_type', 'game type', 'trim|required|max_length[70]');

        $number_of_balls = 3;

        if ($this->form_validation->run() == TRUE) {
            $body = new stdClass();
            $body->hot = array();
            $this->JsonOutput->setBody( $body );
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }






    public function get_last_game_result(){
    	header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('Num_games_model');
        $this->load->model('Email_action');
        $this->load->model('JsonOutput');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $this->form_validation->set_rules('game_type', 'game_type', 'trim|required|max_length[70]');
        $this->form_validation->set_rules('date', 'date', 'trim|required|max_length[70]');

        if ($this->form_validation->run() == TRUE){

            $game_type = $this->input->post('game_type');
            $date = $this->input->post('date','');

            $data_input = array();
            if($date == '') {
            	$date_parts = explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'desc'));
                $date =  $date_parts[0];
            }


            $date_explode = explode('-',$date);

            $data_input['day'] = $date_explode[2];
            $data_input['month'] = $date_explode[1];
            $data_input['year'] = $date_explode[0];
            $data_input['game_type'] = $game_type;

            if($game_type == '49' || $game_type == 'RA' || $game_type == 'IL'){

                $data = array();
                $id = 0;

                if(strlen($data_input['month']) == 1){
                    $data_input['month'] = '0' .$data_input['month'];
                }

                if(strlen($data_input['day']) == 1){
                    $data_input['day'] = '0' .$data_input['day'];
                }

                $dates = array();
                if($data_input['game_type'] == 'RA'){
                    $dates = $this->Num_games_model->get_rapido_games_dates($data_input['year'],$data_input['month'],$data_input['day']);

                } else if($data_input['game_type'] == 'IL'){
                    $dates = $this->Num_games_model->get_lucky_games_dates($data_input['year'],$data_input['month']);

                } else if($data_input['game_type'] == '49'){
                    $dates = $this->Num_games_model->get_49_games_dates($data_input['year'],$data_input['month']);

                }

                foreach($dates as $date){
                    $id = $date->id;
                }

                if($data_input['game_type'] == 'RA'){
                    $event_types = $this->Num_games_model->get_events_type_from_year_month_day($id);
                } else {
                    $event_types = $this->Num_games_model->get_events_type_from_year_month($id);
                }

                $data['get_events'] = array();
                foreach($event_types as $event_type){
                    $get_event = $this->Num_games_model->get_number_game_info($event_type->id);
                    $event_type->events = array();
                    foreach( $get_event as $event ){
                        $draws = $this->Num_games_model->get_number_game_numbers($event->id);
                        $event->draws = array();
                        foreach($draws as $draw){
                            $numbers = $this->Num_games_model->get_number_game_drawn($draw->id);
                            $draw->numbers = $numbers;
                            //var_dump($draw);
                            array_push($event->draws,$draw);
                        }
                        array_push($event_type->events,$event);
                    }
                    array_push($data['get_events'],$event_type);
                }
                $this->JsonOutput->setBody( $data['get_events'] );
            }
            if($game_type == 'VH' || $game_type == 'VD'){

                $data = array();
                $id = 0;

                if(strlen($data_input['month']) == 1){
                    $data_input['month'] = '0' .$data_input['month'];
                }

                if(strlen($data_input['day']) == 1){
                    $data_input['day'] = '0' .$data_input['day'];
                }

                $dates = array();
                if($data_input['game_type'] == 'VD'){
                    $dates = $this->Num_games_model->get_dog_race_dates($data_input['year'],$data_input['month'],$data_input['day']);

                } else if($data_input['game_type'] == 'VH'){
                    $dates = $this->Num_games_model->get_horse_race_dates($data_input['year'],$data_input['month'],$data_input['day']);
                }

                foreach($dates as $date){
                    $id = $date->id;
                }

                $data = array();
                $event_types = $this->Num_games_model->get_events_type_from_year_month_day($id);
                $data['get_events'] = array();
                foreach($event_types as $event_type){
                    $get_event = $this->Num_games_model->get_race_game_info($event_type->id);
                    $event_type->events = array();
                    foreach( $get_event as $event ){
                        $draws = $this->Num_games_model->get_race_event($event->id);
                        $event->draws = array();
                        foreach($draws as $draw){
                            $numbers = $this->Num_games_model->get_race_selections($draw->id);
                            $draw->numbers = $numbers;
                            array_push($event->draws,$draw);
                        }
                        array_push($event_type->events,$event);
                    }
                    array_push($data['get_events'],$event_type);
                }
                $this->JsonOutput->setBody( $data['get_events'] );
            }
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }
        $this->JsonOutput->execute();
    }








}

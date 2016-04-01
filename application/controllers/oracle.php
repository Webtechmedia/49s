<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Oracle extends MX_Controller
{

	private function printCombination($arr, $n, $r)
	{
		$data = array($r);
	 	return $this->combinationUtil($arr, $data, 0, $n-1, 0, $r)  ;

	}

	private function combinationUtil($arr, $data, $start, $end, $index, $r)
	{
		if($index == $r)
		{
			$final_array = array();
			for($j=0; $j<$r; $j++){
				array_push($final_array, $data[$j]);
			}
			return $final_array;
		}

		$norm_array = array();
		for ($i=$start; $i<=$end && $end-$i+1 >= $r-$index; $i++)
		{
			$data[$index] = $arr[$i];
			array_push($norm_array, $this->combinationUtil($arr, $data, $i+1, $end, $index+1, $r));
		}
		return $norm_array;
	}


	private function combinations_main($numbers_array, $fromDate, $toDate, $gametype = 'ilb'){

		$final_array = array();
		$arr = $numbers_array;
		$n = count($arr)/1;


		$r = 1;
		$final_array = $this->printCombination($arr, $n, $r);
		if(count($numbers_array) > 1){
			$r = 2;
			$ttt  =  $this->printCombination($arr, $n, $r);
			$this->clear_second_level($final_array,$ttt);
		}
		if(count($numbers_array) > 2) {
			$r = 3;
			$tttt = $this->printCombination($arr, $n, $r);
			$this->clear_third_level($final_array, $tttt);
		}
		if(count($numbers_array) > 3) {
			$r = 4;
			$tttt = $this->printCombination($arr, $n, $r);
			$this->clear_fourth_level($final_array, $tttt);
		}
		if(count($numbers_array) > 4) {
			$r = 5;
			$tttt = $this->printCombination($arr, $n, $r);
			$this->clear_fifth_level($final_array, $tttt);
		}

		$array_with_results = array();

		foreach($final_array as $result){
			$row = new stdClass();
			$row->numbers = $result;
			$count = 0;
			if($gametype == '49'){
				foreach($this->Num_games_model->get_oracle_49s(
					$result,
					$fromDate,
					$toDate,
					$this->input->post("teatime",true),
					$this->input->post("lunchtime",true),
					true
				) as $roww){
					$count = $count + $roww->times;
				}
			} else {
				foreach($this->Num_games_model->get_oracle_ilb(
					$result,
					$fromDate,
					$toDate,
					$this->input->post("main_draw",true),
					$this->input->post("second_draw",true),
					$this->input->post("third_draw",true),
					true
				) as $roww){
					$count = $count + $roww->times;
				}
			}
			$row->count = $count;
			array_push($array_with_results, $row);
		}

		return $array_with_results;
	}

	private function clear_second_level(&$final_array,$ttt){
		foreach($ttt as $tt){
			foreach($tt as $t){
				array_push($final_array,$t);
			}
		}
	}

	private function clear_third_level(&$final_array,$tttt){
		foreach($tttt as $ttt){
			foreach($ttt as $tt){
				foreach($tt as $t){
					array_push($final_array,$t);
				}
			}
		}
	}

	private function clear_fourth_level(&$final_array,$ttttt){
		foreach($ttttt as $tttt){
			foreach($tttt as $ttt){
				foreach($ttt as $tt){
					foreach($tt as $t){
						array_push($final_array,$t);
					}
				}
			}
		}
	}

	private function clear_fifth_level(&$final_array,$tttttt){
		foreach($tttttt as $ttttt){
			foreach($ttttt as $tttt){
				foreach($tttt as $ttt){
					foreach($ttt as $tt){
						foreach($tt as $t){
							array_push($final_array,$t);
						}
					}
				}
			}
		}
	}

	public function index()
	{
		$this->load->model('JsonOutput');
		$this->JsonOutput->setBody('Unsupported method.');
		$this->JsonOutput->server_obj->success = false;
		$this->JsonOutput->execute();
	}

	private function countRep($n,$r){
		$result = ($this->countSilnia($n))/($this->countSilnia($n -$r) * $this->countSilnia($r));
		return $result;
	}

	private function countSilnia($n){

		$silnia = 1;
		for ($i=1; $i<=$n; $i++) {
			$silnia *= $i;
		}
		//print ("$n! = $silnia");
		return $silnia;

	}

	private function get_combinations($num){
		$combinations = count($num);
		$combinationResult = 0;
		for($i=0;$i<$combinations;$i++){
			$combinationResult = $combinationResult + $this->countRep($combinations,$i);
		}
		return $combinationResult;

	}

	public function oracle_49s(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);


		$this->form_validation->set_rules('numbers[]', 'Selected Balls', 'required');
		//$this->form_validation->set_rules('from', '49s From Date', 'trim|required');
		//$this->form_validation->set_rules('to', '49s To Date', 'trim|required');
		//$this->form_validation->set_rules('quickSelect49', '49s Quick Select', 'trim|required');
		//$this->form_validation->set_rules('lunchtimeDraw49', 'Lunchtime Draw', 'trim|required');
		//$this->form_validation->set_rules('teatimeDraw49', 'Teatime Draw', 'trim|required');

		if ($this->form_validation->run() == TRUE){

			$fromDate = implode('-', array_reverse(explode('/', $this->input->post("from",""))));
			$toDate = implode('-', array_reverse(explode('/', $this->input->post("to",""))));

			if( ($dateType = $this->input->post("quickSelect","")) != "" ){
				if($dateType == "last_week"){
					$fromDate = date('Y-m-d',strtotime('last week'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_month"){
					$fromDate = date('Y-m-d',strtotime('last month'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_year"){
					$fromDate = date('Y-m-d',strtotime('last year'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "since_began"){
					$fromDate = date('Y-m-d',strtotime('1980-12-22'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
			}

			$body = new stdClass();
			$hit_times = 0;

			$body->combinations = $this->combinations_main($this->input->post("numbers",array()), $fromDate, $toDate, '49' );
			foreach($this->Num_games_model->get_oracle_49s(
				$this->input->post("numbers",array()),
				$fromDate,
				$toDate,
				$this->input->post("teatime",false),
				$this->input->post("lunchtime",false),
				true
			) as $row){
				$hit_times = $hit_times + $row->times;
			}
			$body->numbers_draws = $hit_times;
			$body->total_combination = $this->get_combinations(  $this->input->post("numbers",array())  );
			$body->total_draws = count($this->Num_games_model->get_oracle_49s(
				array(),
				$fromDate,
				$toDate,
				$this->input->post("teatime",false),
				$this->input->post("lunchtime",false)
			));
			$body->numbers = $this->Num_games_model->get_oracle_49s(
				$this->input->post("numbers",array()),
				$fromDate,
				$toDate,
				$this->input->post("teatime",false),
				$this->input->post("lunchtime",false)
			);


			$this->JsonOutput->setBody($body );

		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();

	}

	public function get_names(){
 
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);

		

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('game_type', 'Game type', 'required');

		if ($this->form_validation->run() == TRUE){

			$body = new stdClass();

			$game_type = $this->input->post('game_type','');
			if($game_type == 'vhr'  ) {
				$game_type = 'hr';
			}
			if($game_type == 'vdr'  ) {
				$game_type = 'dg';
			}
			if($game_type == 'vgr'  ) {
				$game_type = 'dg';
			}
            
            $body->names = $this->Num_games_model->get_oracle_names($this->input->post('name'), $game_type);
            $this->JsonOutput->setBody($body);
/*
			$allnames=$this->Num_games_model->get_oracle_names($this->input->post("name"), $game_type);

			function check_names($var)
			{
				
				if (strncasecmp($var->name,$_POST['name'],strlen($_POST['name']))==0) {
					return  true;
				}else{
				 	return false;
				}
			}
			 
			$filteredNames = array_filter($allnames,"check_names");
		 	$limitedNames= array_slice($filteredNames, 0, 10);
	
		 	function cmp($a, $b)
		 	{
		 		return strcmp($a->name, $b->name);
		 	}
		 	
		 	usort($limitedNames, "cmp");

			$body->names =$limitedNames;
			
			$this->JsonOutput->setBody($body );
*/
		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();

	}

	public function oracle_ILB(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);


		$this->form_validation->set_rules('numbers[]', 'Selected Balls', 'required');
		//$this->form_validation->set_rules('from', '49s From Date', 'trim|required');
		//$this->form_validation->set_rules('to', '49s To Date', 'trim|required');
		//$this->form_validation->set_rules('quickSelect49', '49s Quick Select', 'trim|required');
		//$this->form_validation->set_rules('lunchtimeDraw49', 'Lunchtime Draw', 'trim|required');
		//$this->form_validation->set_rules('teatimeDraw49', 'Teatime Draw', 'trim|required');

		if ($this->form_validation->run() == TRUE){


			$fromDate = implode('-', array_reverse(explode('/', $this->input->post("from",""))));
			$toDate = implode('-', array_reverse(explode('/', $this->input->post("to",""))));

			if( ($dateType = $this->input->post("quickSelect","")) != "" ){
				if($dateType == "last_week"){
					$fromDate = date('Y-m-d',strtotime('last week'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_month"){
					$fromDate = date('Y-m-d',strtotime('last month'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_year"){
					$fromDate = date('Y-m-d',strtotime('last year'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "since_began"){
					$fromDate = date('Y-m-d',strtotime('1980-12-22'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
			}

			$body = new stdClass();
			$hit_times = 0;

			$body->combinations = $this->combinations_main($this->input->post("numbers",array()), $fromDate, $toDate, 'ilb' );
			foreach($this->Num_games_model->get_oracle_ilb(
				$this->input->post("numbers",array()),
				$fromDate,
				$toDate,
				$this->input->post("main_draw",false),
				$this->input->post("second_draw",false),
				$this->input->post("third_draw",false),
				true
			) as $row){
				$hit_times = $hit_times + $row->times;
			}
			$body->numbers_draws = $hit_times;
			$body->total_combination = $this->get_combinations(  $this->input->post("numbers",array())  );
			$body->total_draws = count($this->Num_games_model->get_oracle_ilb(
				array(),
				$fromDate,
				$toDate,
				$this->input->post("main_draw",false),
				$this->input->post("second_draw",false),
				$this->input->post("third_draw",false)
			));
			$body->numbers = $this->Num_games_model->get_oracle_ilb(
				$this->input->post("numbers",array()),
				$fromDate,
				$toDate,
				$this->input->post("main_draw",false),
				$this->input->post("second_draw",false),
				$this->input->post("third_draw",false)
			);


			$this->JsonOutput->setBody($body );

		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();

	}

	public function oracle_rapido(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);


		$this->form_validation->set_rules('numbers[]', 'Selected Balls', 'required');
		//$this->form_validation->set_rules('from', '49s From Date', 'trim|required');
		//$this->form_validation->set_rules('to', '49s To Date', 'trim|required');
		//$this->form_validation->set_rules('quickSelect49', '49s Quick Select', 'trim|required');
		//$this->form_validation->set_rules('lunchtimeDraw49', 'Lunchtime Draw', 'trim|required');
		//$this->form_validation->set_rules('teatimeDraw49', 'Teatime Draw', 'trim|required');

		if ($this->form_validation->run() == TRUE){


			$fromDate = implode('-', array_reverse(explode('/', $this->input->post("from",""))));
			$toDate = implode('-', array_reverse(explode('/', $this->input->post("to",""))));

			if( ($dateType = $this->input->post("quickSelect","")) != "" ){
				if($dateType == "last_week"){
					$fromDate = date('Y-m-d',strtotime('last week'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_month"){
					$fromDate = date('Y-m-d',strtotime('last month'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_year"){
					$fromDate = date('Y-m-d',strtotime('last year'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "since_began"){
					$fromDate = date('Y-m-d',strtotime('1980-12-22'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
			}

			$body = new stdClass();
			$hit_times = 0;

			foreach($this->Num_games_model->get_oracle_rapido(
				$this->input->post("numbers",array()),
				$fromDate,
				$toDate,
				$this->input->post("heads",false),
				$this->input->post("tails",false),
				$this->input->post("level",false),
				true
			) as $row){
				$hit_times = $hit_times + $row->times;
			}
			$body->numbers_draws = $hit_times;
			$body->total_combination = $this->get_combinations(  $this->input->post("numbers",array())  );
			$body->total_draws = count($this->Num_games_model->get_oracle_rapido(
				array(),
				$fromDate,
				$toDate,
				$this->input->post("heads",false),
				$this->input->post("tails",false),
				$this->input->post("level",false)
			));
			$body->numbers = $this->Num_games_model->get_oracle_rapido(
				$this->input->post("numbers",array()),
				$fromDate,
				$toDate,
				$this->input->post("heads",false),
				$this->input->post("tails",false),
				$this->input->post("level",false)
			);


			$this->JsonOutput->setBody($body );

		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();

	}


public function oracle_vhr(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);


		$this->form_validation->set_rules('name', 'Name needed', 'required');
		//$this->form_validation->set_rules('from', '49s From Date', 'trim|required');
		//$this->form_validation->set_rules('to', '49s To Date', 'trim|required');
		//$this->form_validation->set_rules('quickSelect49', '49s Quick Select', 'trim|required');
		//$this->form_validation->set_rules('lunchtimeDraw49', 'Lunchtime Draw', 'trim|required');
		//$this->form_validation->set_rules('teatimeDraw49', 'Teatime Draw', 'trim|required');

		if ($this->form_validation->run() == TRUE){


			$fromDate = implode('-', array_reverse(explode('/', $this->input->post("from",""))));
			$toDate = implode('-', array_reverse(explode('/', $this->input->post("to",""))));

			if( ($dateType = $this->input->post("quickSelect","")) != "" ){
				if($dateType == "last_week"){
					$fromDate = date('Y-m-d',strtotime('last week'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_month"){
					$fromDate = date('Y-m-d',strtotime('last month'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_year"){
					$fromDate = date('Y-m-d',strtotime('last year'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "since_began"){
					$fromDate = date('Y-m-d',strtotime('1980-12-22'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
			}

			//echo $fromDate;
			//echo $toDate;

			$body = new stdClass();

			//$body->last_race = new stdClass();
			//$body->last_race->location = "";
			//$body->last_race->date = "1999-12-22";
			//$body->last_race->position = 1;
			//$body->last_race->odds = 1;
			$body->name = $this->input->post("name");
			$body->last_race = $this->Num_games_model->get_oracle_vr($this->input->post("name"), $fromDate, $toDate, 'hr' , true);
			$body->places = $this->Num_games_model->get_total_places_by('hr',$this->input->post("name",""), $fromDate, $toDate );

			$total_races_records=$this->Num_games_model->get_total_races_by('hr',$this->input->post("name",""), $fromDate, $toDate );
			$total_races_count=0;
			foreach($total_races_records as $total_races_record){
				$total_races_count=$total_races_count+$total_races_record->times;
			}
			$body->total_races = $total_races_count;
			$body->races = $this->Num_games_model->get_oracle_vr($this->input->post("name"), $fromDate, $toDate, 'hr');

			$this->JsonOutput->setBody($body );

		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();

	}


	public function oracle_vgr(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		$this->load->model('JsonOutput');
		$this->load->model('Num_games_model');

		$json_input = trim(file_get_contents('php://input'));
		$_POST = json_decode($json_input,true);


		$this->form_validation->set_rules('name', 'Name needed', 'required');
		//$this->form_validation->set_rules('from', '49s From Date', 'trim|required');
		//$this->form_validation->set_rules('to', '49s To Date', 'trim|required');
		//$this->form_validation->set_rules('quickSelect49', '49s Quick Select', 'trim|required');
		//$this->form_validation->set_rules('lunchtimeDraw49', 'Lunchtime Draw', 'trim|required');
		//$this->form_validation->set_rules('teatimeDraw49', 'Teatime Draw', 'trim|required');

		if ($this->form_validation->run() == TRUE){


			$fromDate = implode('-', array_reverse(explode('/', $this->input->post("from",""))));
			$toDate = implode('-', array_reverse(explode('/', $this->input->post("to",""))));

			if( ($dateType = $this->input->post("quickSelect","")) != "" ){
				if($dateType == "last_week"){
					$fromDate = date('Y-m-d',strtotime('last week'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_month"){
					$fromDate = date('Y-m-d',strtotime('last month'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "last_year"){
					$fromDate = date('Y-m-d',strtotime('last year'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
				if($dateType == "since_began"){
					$fromDate = date('Y-m-d',strtotime('1980-12-22'));
					$toDate = date('Y-m-d',strtotime('now'));

					//var_dump($fromDate);
					//var_dump($toDate);
				}
			}

			$body = new stdClass();

			//$body->last_race = new stdClass();
			//$body->last_race->location = "";
			//$body->last_race->date = "1999-12-22";
			//$body->last_race->position = 1;
			$body->name = $this->input->post("name");
			$body->last_race = $this->Num_games_model->get_oracle_vr($this->input->post("name"),  $fromDate, $toDate, 'dg' , true);
			$body->places = $this->Num_games_model->get_total_places_by('dg',$this->input->post("name",""), $fromDate, $toDate );



			$total_races_records=$this->Num_games_model->get_total_races_by('dg',$this->input->post("name",""), $fromDate, $toDate );
			$total_races_count=0;
			foreach($total_races_records as $total_races_record){
				$total_races_count=$total_races_count+$total_races_record->times;
			}
			$body->total_races = $total_races_count;


			$body->races = $this->Num_games_model->get_oracle_vr($this->input->post("name"),  $fromDate, $toDate, 'dg');

			$this->JsonOutput->setBody($body );

		} else {
			$this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
			$this->JsonOutput->server_obj->error_msg_array = validation_errors();
			$this->JsonOutput->server_obj->success = false;
		}


		$this->JsonOutput->execute();

	}




}






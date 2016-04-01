<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Img extends MX_Controller
{

    public function get_image_urls(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('JsonOutput');
        $this->load->model('Num_games_model');

        //$json_input = trim(file_get_contents('php://input'));
        //$_POST = json_decode($json_input,true);

        //$this->form_validation->set_rules('game', 'game type', 'trim|required|max_length[70]');
        //$this->form_validation->set_rules('date', 'game type', 'trim|required|max_length[70]');

        //if ($this->form_validation->run() == TRUE){

        $body = new stdClass();
        $body->home = new stdClass();
        $body->s49 = new stdClass();
        $body->il = new stdClass();
        $body->rapido = new stdClass();
        $body->vhr = new stdClass();
        $body->vgr = new stdClass();
        $body->promo = new stdClass();

        $body->home->home = $this->Num_games_model->get_asset('is_home');
        $body->home->oracle = $this->Num_games_model->get_asset('is_oracle');
        $body->home->bet_here = $this->Num_games_model->get_asset('is_bet_here');
        $body->home->responsible = $this->Num_games_model->get_asset('is_responsible');

        $body->s49->latest = $this->Num_games_model->get_asset('is_49s_last');
        $body->s49->previous = $this->Num_games_model->get_asset('is_49s_prev');
        $body->s49->hot_cold = $this->Num_games_model->get_asset('is_49s_h_c');
        $body->s49->lucky_dip = $this->Num_games_model->get_asset('is_49s_lucky_dip');
        $body->s49->syndicates = $this->Num_games_model->get_asset('is_49s_syndicates');
        $body->s49->winners = $this->Num_games_model->get_asset('is_49s_winner');
        $body->s49->how_to_play = $this->Num_games_model->get_asset('is_49s_how_to_play');
        $body->s49->rules = $this->Num_games_model->get_asset('is_49s_rule');

        $body->il->latest = $this->Num_games_model->get_asset('is_ilb_last');
        $body->il->previous = $this->Num_games_model->get_asset('is_ilb_prev');
        $body->il->hot_cold = $this->Num_games_model->get_asset('is_ilb_h_c');
        $body->il->lucky_dip = $this->Num_games_model->get_asset('is_ilb_lucky_dip');
        $body->il->syndicates = $this->Num_games_model->get_asset('is_ilb_syndicates');
        $body->il->how_to_play = $this->Num_games_model->get_asset('is_ilb_how_to_play');
        $body->il->rules = $this->Num_games_model->get_asset('is_ilb_rule');

        $body->vhr->latest = $this->Num_games_model->get_asset('is_vhr_last');
        $body->vhr->previous = $this->Num_games_model->get_asset('is_vhr_prev');
        $body->vhr->how_to_play = $this->Num_games_model->get_asset('is_vhr_how_to_play');
        $body->vhr->rules = $this->Num_games_model->get_asset('is_vhr_rule');

        $body->vgr->latest = $this->Num_games_model->get_asset('is_vdr_last');
        $body->vgr->previous = $this->Num_games_model->get_asset('is_vdr_prev');
        $body->vgr->how_to_play = $this->Num_games_model->get_asset('is_vdr_how_to_play');
        $body->vgr->rules = $this->Num_games_model->get_asset('is_vdr_rule');

        $body->rapido->latest = $this->Num_games_model->get_asset('is_rapido_last');
        $body->rapido->previous = $this->Num_games_model->get_asset('is_rapido_prev');
        $body->rapido->how_to_play = $this->Num_games_model->get_asset('is_how_to_play');
        $body->rapido->rules = $this->Num_games_model->get_asset('is_rapido_rule');

        $body->promo->is_promo_check_numbers = $this->Num_games_model->get_asset('is_promo_check_numbers');
        $body->promo->is_promo_49s_lucky_dip = $this->Num_games_model->get_asset('is_promo_49s_lucky_dip');
        $body->promo->is_promo_ilb_lucky_dip = $this->Num_games_model->get_asset('is_promo_ilb_lucky_dip');
        $body->promo->is_promo_bet_here = $this->Num_games_model->get_asset('is_promo_bet_here');
        $body->promo->is_promo_download = $this->Num_games_model->get_asset('is_promo_download');
        $body->promo->is_promo_statistics = $this->Num_games_model->get_asset('is_promo_statistics');
        $body->promo->is_promo_syndicate = $this->Num_games_model->get_asset('is_promo_syndicate');
        $body->promo->is_promo_49s_how = $this->Num_games_model->get_asset('is_promo_49s_how');
        $body->promo->is_promo_ilb_how = $this->Num_games_model->get_asset('is_promo_ilb_how');
        $body->promo->is_promo_vhr_how = $this->Num_games_model->get_asset('is_promo_vhr_how');
        $body->promo->is_promo_ra_how = $this->Num_games_model->get_asset('is_promo_ra_how');
        $body->promo->is_promo_vdr_how = $this->Num_games_model->get_asset('is_promo_vdr_how');
        $body->promo->is_promo_49s_have = $this->Num_games_model->get_asset('is_promo_49s_have');
        $body->promo->is_promo_ilb_have = $this->Num_games_model->get_asset('is_promo_ilb_have');
        $body->promo->is_promo_vhr_have = $this->Num_games_model->get_asset('is_promo_vhr_have');
        $body->promo->is_promo_ra_have = $this->Num_games_model->get_asset('is_promo_ra_have');
        $body->promo->is_promo_vdr_have = $this->Num_games_model->get_asset('is_promo_vdr_have');

        $body->promo->is_promo_home = $this->Num_games_model->get_asset('is_promo_home');
        $body->promo->is_promo_49_latest = $this->Num_games_model->get_asset('is_promo_49_latest');
        $body->promo->is_promo_ilb_latest = $this->Num_games_model->get_asset('is_promo_ilb_latest');
        $body->promo->is_promo_vhr_latest = $this->Num_games_model->get_asset('is_promo_vhr_latest');
        $body->promo->is_promo_vgr_latest = $this->Num_games_model->get_asset('is_promo_vgr_latest');
        $body->promo->is_promo_rapido_latest = $this->Num_games_model->get_asset('is_promo_rapido_latest');
        $body->promo->is_mobile = $this->Num_games_model->get_asset('is_mobile');

        $body->promo->is_how_to_play_bgr_49s = $this->Num_games_model->get_asset('is_how_to_play_bgr_49s');
        $body->promo->is_lucky_dip_bgr_49s = $this->Num_games_model->get_asset('is_lucky_dip_bgr_49s');
        $body->promo->is_how_to_play_bgr_ilb = $this->Num_games_model->get_asset('is_how_to_play_bgr_ilb');
        $body->promo->is_lucky_dip_bgr_ilb = $this->Num_games_model->get_asset('is_lucky_dip_bgr_ilb');
        $body->promo->is_how_to_play_bgr_ra = $this->Num_games_model->get_asset('is_how_to_play_bgr_ra');
        $body->promo->is_lucky_dip_bgr_ra = $this->Num_games_model->get_asset('is_lucky_dip_bgr_ra');
        $body->promo->is_how_to_play_bgr_vhr = $this->Num_games_model->get_asset('is_how_to_play_bgr_vhr');
        $body->promo->is_lucky_dip_bgr_vhr = $this->Num_games_model->get_asset('is_lucky_dip_bgr_vhr');
        $body->promo->is_how_to_play_bgr_vgr = $this->Num_games_model->get_asset('is_how_to_play_bgr_vgr');
        $body->promo->is_lucky_dip_bgr_vgr = $this->Num_games_model->get_asset('is_lucky_dip_bgr_vgr');

        $this->JsonOutput->setBody($body );

        //} else {
        //    $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
        //    $this->JsonOutput->server_obj->error_msg_array = validation_errors();
        //    $this->JsonOutput->server_obj->success = false;
        //}


        $this->JsonOutput->execute();

    }

    public function get_mobile_image_urls(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model('JsonOutput');
        $this->load->model('Num_games_model');

        //$json_input = trim(file_get_contents('php://input'));
        //$_POST = json_decode($json_input,true);

        //$this->form_validation->set_rules('game', 'game type', 'trim|required|max_length[70]');
        //$this->form_validation->set_rules('date', 'game type', 'trim|required|max_length[70]');

        //if ($this->form_validation->run() == TRUE){

        $body = new stdClass();
        $body->home = new stdClass();
        $body->s49 = new stdClass();
        $body->il = new stdClass();
        $body->rapido = new stdClass();
        $body->vhr = new stdClass();
        $body->vgr = new stdClass();
        $body->promo = new stdClass();

        $body->home->home = $this->Num_games_model->get_mobile_asset('is_home');
        $body->home->oracle = $this->Num_games_model->get_mobile_asset('is_oracle');
        $body->home->bet_here = $this->Num_games_model->get_mobile_asset('is_bet_here');
        $body->home->responsible = $this->Num_games_model->get_mobile_asset('is_responsible');

        $body->s49->latest = $this->Num_games_model->get_mobile_asset('is_49s_last');
        $body->s49->previous = $this->Num_games_model->get_mobile_asset('is_49s_prev');
        $body->s49->hot_cold = $this->Num_games_model->get_mobile_asset('is_49s_h_c');
        $body->s49->lucky_dip = $this->Num_games_model->get_mobile_asset('is_49s_lucky_dip');
        $body->s49->syndicates = $this->Num_games_model->get_mobile_asset('is_49s_syndicates');
        $body->s49->winners = $this->Num_games_model->get_mobile_asset('is_49s_winner');
        $body->s49->how_to_play = $this->Num_games_model->get_mobile_asset('is_49s_how_to_play');
        $body->s49->rules = $this->Num_games_model->get_mobile_asset('is_49s_rule');

        $body->il->latest = $this->Num_games_model->get_mobile_asset('is_ilb_last');
        $body->il->previous = $this->Num_games_model->get_mobile_asset('is_ilb_prev');
        $body->il->hot_cold = $this->Num_games_model->get_mobile_asset('is_ilb_h_c');
        $body->il->lucky_dip = $this->Num_games_model->get_mobile_asset('is_ilb_lucky_dip');
        $body->il->syndicates = $this->Num_games_model->get_mobile_asset('is_ilb_syndicates');
        $body->il->how_to_play = $this->Num_games_model->get_mobile_asset('is_ilb_how_to_play');
        $body->il->rules = $this->Num_games_model->get_mobile_asset('is_ilb_rule');

        $body->vhr->latest = $this->Num_games_model->get_mobile_asset('is_vhr_last');
        $body->vhr->previous = $this->Num_games_model->get_mobile_asset('is_vhr_prev');
        $body->vhr->how_to_play = $this->Num_games_model->get_mobile_asset('is_vhr_how_to_play');
        $body->vhr->rules = $this->Num_games_model->get_mobile_asset('is_vhr_rule');

        $body->vgr->latest = $this->Num_games_model->get_mobile_asset('is_vdr_last');
        $body->vgr->previous = $this->Num_games_model->get_mobile_asset('is_vdr_prev');
        $body->vgr->how_to_play = $this->Num_games_model->get_mobile_asset('is_vdr_how_to_play');
        $body->vgr->rules = $this->Num_games_model->get_mobile_asset('is_vdr_rule');

        $body->rapido->latest = $this->Num_games_model->get_mobile_asset('is_rapido_last');
        $body->rapido->previous = $this->Num_games_model->get_mobile_asset('is_rapido_prev');
        $body->rapido->how_to_play = $this->Num_games_model->get_mobile_asset('is_how_to_play');
        $body->rapido->rules = $this->Num_games_model->get_mobile_asset('is_rapido_rule');

        $body->promo->is_promo_check_numbers = $this->Num_games_model->get_mobile_asset('is_promo_check_numbers');
        $body->promo->is_promo_49s_lucky_dip = $this->Num_games_model->get_mobile_asset('is_promo_49s_lucky_dip');
        $body->promo->is_promo_ilb_lucky_dip = $this->Num_games_model->get_mobile_asset('is_promo_ilb_lucky_dip');
        $body->promo->is_promo_bet_here = $this->Num_games_model->get_mobile_asset('is_promo_bet_here');
        $body->promo->is_promo_download = $this->Num_games_model->get_mobile_asset('is_promo_download');
        $body->promo->is_promo_statistics = $this->Num_games_model->get_mobile_asset('is_promo_statistics');
        $body->promo->is_promo_syndicate = $this->Num_games_model->get_mobile_asset('is_promo_syndicate');
        $body->promo->is_promo_49s_how = $this->Num_games_model->get_mobile_asset('is_promo_49s_how');
        $body->promo->is_promo_ilb_how = $this->Num_games_model->get_mobile_asset('is_promo_ilb_how');
        $body->promo->is_promo_vhr_how = $this->Num_games_model->get_mobile_asset('is_promo_vhr_how');
        $body->promo->is_promo_ra_how = $this->Num_games_model->get_mobile_asset('is_promo_ra_how');
        $body->promo->is_promo_vdr_how = $this->Num_games_model->get_mobile_asset('is_promo_vdr_how');
        $body->promo->is_promo_49s_have = $this->Num_games_model->get_mobile_asset('is_promo_49s_have');
        $body->promo->is_promo_ilb_have = $this->Num_games_model->get_mobile_asset('is_promo_ilb_have');
        $body->promo->is_promo_vhr_have = $this->Num_games_model->get_mobile_asset('is_promo_vhr_have');
        $body->promo->is_promo_ra_have = $this->Num_games_model->get_mobile_asset('is_promo_ra_have');
        $body->promo->is_promo_vdr_have = $this->Num_games_model->get_mobile_asset('is_promo_vdr_have');

        $body->promo->is_promo_home = $this->Num_games_model->get_mobile_asset('is_promo_home');
        $body->promo->is_promo_49_latest = $this->Num_games_model->get_mobile_asset('is_promo_49_latest');
        $body->promo->is_promo_ilb_latest = $this->Num_games_model->get_mobile_asset('is_promo_ilb_latest');
        $body->promo->is_promo_vhr_latest = $this->Num_games_model->get_mobile_asset('is_promo_vhr_latest');
        $body->promo->is_promo_vgr_latest = $this->Num_games_model->get_mobile_asset('is_promo_vgr_latest');
        $body->promo->is_promo_rapido_latest = $this->Num_games_model->get_mobile_asset('is_promo_rapido_latest');
        $body->promo->is_mobile = $this->Num_games_model->get_mobile_asset('is_mobile');

        $body->promo->is_how_to_play_bgr_49s = $this->Num_games_model->get_mobile_asset('is_how_to_play_bgr_49s');
        $body->promo->is_lucky_dip_bgr_49s = $this->Num_games_model->get_mobile_asset('is_lucky_dip_bgr_49s');
        $body->promo->is_how_to_play_bgr_ilb = $this->Num_games_model->get_mobile_asset('is_how_to_play_bgr_ilb');
        $body->promo->is_lucky_dip_bgr_ilb = $this->Num_games_model->get_mobile_asset('is_lucky_dip_bgr_ilb');
        $body->promo->is_how_to_play_bgr_ra = $this->Num_games_model->get_mobile_asset('is_how_to_play_bgr_ra');
        $body->promo->is_lucky_dip_bgr_ra = $this->Num_games_model->get_mobile_asset('is_lucky_dip_bgr_ra');
        $body->promo->is_how_to_play_bgr_vhr = $this->Num_games_model->get_mobile_asset('is_how_to_play_bgr_vhr');
        $body->promo->is_lucky_dip_bgr_vhr = $this->Num_games_model->get_mobile_asset('is_lucky_dip_bgr_vhr');
        $body->promo->is_how_to_play_bgr_vgr = $this->Num_games_model->get_mobile_asset('is_how_to_play_bgr_vgr');
        $body->promo->is_lucky_dip_bgr_vgr = $this->Num_games_model->get_mobile_asset('is_lucky_dip_bgr_vgr');

        $this->JsonOutput->setBody($body );

        //} else {
        //    $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing parameters';
        //    $this->JsonOutput->server_obj->error_msg_array = validation_errors();
        //    $this->JsonOutput->server_obj->success = false;
        //}


        $this->JsonOutput->execute();

    }
/*
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


            if($game_type == '49' || $game_type == 'il' || $game_type == 'ra' ){

                $body->previous_draw_range->oldest_inclusive = explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type',''),'asc')->date)[0];
                $body->previous_draw_range->newest_inclusive = explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type',''),'desc')->date)[0];

                $date = $body->previous_draw_range->newest_inclusive;

                $games_results = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type',''),$date);
                foreach($games_results as &$row){
                    $row->results = new stdClass();
                    $draws = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type',''),$date,$row->event_id);
                    $numbers = array();
                    $booster = 0;
                    foreach($draws as $draw){
                        if($draw->bonusnumber == 'Y'){
                            $booster = $draw->number;
                        } else {
                            array_push($numbers,$draw->number);
                        }
                    }

                    $row->results->numbers = $numbers;
                    $row->results->booster = $booster;

                    array_push($draws_array, $row);
                }
                $body->draws = $draws_array;
            } else {
                if($game_type === 'vhr'  ) {
                    $game_type = 'hr';
                }
                if($game_type === 'vdr'  ) {
                    $game_type = 'dg';
                }

                $body->previous_draw_range->oldest_inclusive = explode(" ", $this->Num_games_model->get_race_date($game_type,'asc')->date)[0];
                $body->previous_draw_range->newest_inclusive = explode(" ", $this->Num_games_model->get_race_date($game_type,'desc')->date)[0];

                $date = $body->previous_draw_range->newest_inclusive;

                $games_results = $this->Num_games_model->get_race_result_for_date($game_type,$date);

                foreach($games_results as &$row){
                    $results = array();

                    $draws = $this->Num_games_model->get_race_result_for_date($game_type,$date,$row->event_id);

                    foreach($draws as $dd){
                        $row->location = $dd->location;
                        $row->race_time = $dd->race_time;
                        $row->fc = $dd->fc;
                        $row->tc = $dd->tc;
                        $result_row = new stdClass();
                        //var_dump($dd);
                        $result_row->name = $dd->racer;
                        $result_row->pos = $dd->num;
                        $result_row->number = $dd->num;
                        $result_row->odds = $dd->dec;

                        array_push($results, $result_row);
                    }

                    $row->results = $results;
                    //$row->results->ddd = $draws;
                    array_push($draws_array, $row);
                }

                $body->draws = $draws_array;
            }




            $body->date = $body->previous_draw_range->newest_inclusive;
            $body->draws = $games_results;

            $body->hot_cold = new stdClass();
            $body->hot_cold->hot = $this->Num_games_model->get_hot_cold_numbers('desc', $number_of_balls, $this->input->post('game_type',''));
            $body->hot_cold->cold = $this->Num_games_model->get_hot_cold_numbers('asc', $number_of_balls, $this->input->post('game_type',''));

            $this->JsonOutput->setBody( $body );
            //$this->
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }
*/
    /*
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

            $data_input['day'] = explode('-',$date)[2];
            $data_input['month'] = explode('-',$date)[1];
            $data_input['year'] = explode('-',$date)[0];

            $body = new stdClass();
            $body->draws = array();
            $body->previous_draw_range = new stdClass();

            $body_array = array();
            $draw_body = new stdClass();

            $locations = array();

            $game_type = $this->input->post('game_type','');

            $d=cal_days_in_month(CAL_GREGORIAN,$data_input['month'],$data_input['year']);

//            $daterange_from = $data_input['year'] . '-' . $data_input['month'] . '-' . '01' ;
//            $daterange_to = $data_input['year'] . '-' . $data_input['month'] . '-' . $d ;
            $daterange_from = $data_input['year'] . '-' . $data_input['month'] . '-' . $data_input['day'] ;
            $daterange_to = $data_input['year'] . '-' . $data_input['month'] . '-' . $data_input['day'] ;

            if($game_type == '49' || $game_type == 'il' || $game_type == 'ra' ){

                for($i = 1 ; $i <= $d; $i++) {
                    $draw_body = new stdClass();
                    $draw_body->date = $data_input['year'] . '-' . $data_input['month'] . '-' . (($i < 10) ? ('0' . $i) : $i);
                    $draws_array = array();

                    if (!isset($body->previous_draw_range->oldest_inclusive)) {
                        //var_dump("wwww");
                        $body->previous_draw_range->oldest_inclusive = explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'asc')->date)[0];
                        $body->previous_draw_range->newest_inclusive = explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'desc')->date)[0];
                    }
                    $games_results = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type', ''), $draw_body->date);
                    foreach ($games_results as &$row) {
                        $row->results = new stdClass();
                        $draws = $this->Num_games_model->get_game_result_for_date($this->input->post('game_type', ''), $draw_body->date, $row->event_id);
                        $numbers = array();
                        $booster = 0;
                        foreach ($draws as $draw) {
                            if ($draw->bonusnumber == 'Y') {
                                $booster = $draw->number;
                            } else {
                                array_push($numbers, $draw->number);
                            }
                        }
                        //$row->results->ddd = $draws;
                        $row->results->numbers = $numbers;
                        $row->results->booster = $booster;

                        array_push($draws_array, $row);
                    }
                    $draw_body->draws = $draws_array;
                    array_push($body_array, $draw_body);
                }
                $body->draws = $body_array;
            } else {
                if($game_type === 'vhr'  ) {
                    $game_type = 'hr';
                }
                if($game_type === 'vdr'  ) {
                    $game_type = 'dg';
                }
                if (!isset($body->previous_draw_range->oldest_inclusive)) {
                    //var_dump("wwww");
                    $body->previous_draw_range->oldest_inclusive = explode(" ", $this->Num_games_model->get_race_date($game_type, 'asc')->date)[0];
                    $body->previous_draw_range->newest_inclusive = explode(" ", $this->Num_games_model->get_race_date($game_type, 'desc')->date)[0];
                }

                $locations = $this->Num_games_model->get_race_locations($game_type, $daterange_from, $daterange_to);

                foreach($locations as $location){
                    $location_obj = new stdClass();
                    $location_obj->location = $location->name;
                    $location_obj->races = array();

                    $races = $this->Num_games_model->get_race_by_location($game_type, $daterange_from, $daterange_to, $location->name);
                    foreach($races as &$race){
                        $race->positions = $this->Num_games_model->get_positions_from_race($race->event_id);
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
*/
    public function get_hot_cold_balls(){
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

            $body->hot = $this->Num_games_model->get_hot_cold_numbers('desc', $number_of_balls, $this->input->post('game_type',''));
            $body->cold = $this->Num_games_model->get_hot_cold_numbers('asc', $number_of_balls, $this->input->post('game_type',''));

            $this->JsonOutput->setBody( $body );
            //$this->
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

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

            //$body->hot = $this->Num_games_model->get_hot_cold_numbers('desc', $number_of_balls, $this->input->post('game_type',''));
            //$body->cold = $this->Num_games_model->get_hot_cold_numbers('asc', $number_of_balls, $this->input->post('game_type',''));
            $body->statistic = $this->Num_games_model->get_games_statistic($this->input->post('game_type',''),'');
            $body->first_draw = $this->Num_games_model->get_games_date($this->input->post('game_type',''),'asc');
            $body->last_draw = $this->Num_games_model->get_games_date($this->input->post('game_type',''),'desc');
            $body->total = $this->Num_games_model->get_games_total($this->input->post('game_type',''),'desc');

            $this->JsonOutput->setBody( $body );
            //$this->
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

            //$body->hot = $this->Num_games_model->get_hot_cold_numbers('desc', $number_of_balls, $this->input->post('game_type',''));
            //$body->cold = $this->Num_games_model->get_hot_cold_numbers('asc', $number_of_balls, $this->input->post('game_type',''));
            //$body->statistic = $this->Num_games_model->get_games_statistic($this->input->post('game_type',''),'');
            //$body->first_draw = $this->Num_games_model->get_games_date($this->input->post('game_type',''),'asc');
            //$body->last_draw = $this->Num_games_model->get_games_date($this->input->post('game_type',''),'desc');
            //$body->total = $this->Num_games_model->get_games_total($this->input->post('game_type',''),'desc');

            $this->JsonOutput->setBody( $body );
            //$this->
        } else {
            $this->JsonOutput->server_obj->error_msg = 'Incorrect or missing credentials';
            $this->JsonOutput->server_obj->error_msg_array = validation_errors();
            $this->JsonOutput->server_obj->success = false;
        }

        $this->JsonOutput->execute();

    }
/*
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
                $date =  explode(" ", $this->Num_games_model->get_games_date($this->input->post('game_type', ''), 'desc'))[0];
            }

            $data_input['day'] = explode('-',$date)[2];
            $data_input['month'] = explode('-',$date)[1];
            $data_input['year'] = explode('-',$date)[0];
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



                //var_dump($data_input);
                foreach($dates as $date){
                    $id = $date->id;
                }

                if($data_input['game_type'] == 'RA'){
                    $event_types = $this->Num_games_model->get_events_type_from_year_month_day($id);
                } else {
                    $event_types = $this->Num_games_model->get_events_type_from_year_month($id);
                }
                //

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



                //var_dump($data_input);
                foreach($dates as $date){
                    $id = $date->id;
                }

                $data = array();

                $event_types = $this->Num_games_model->get_events_type_from_year_month_day($id);
                //

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
                            //var_dump($draw);
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

*/


}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploads_model extends CI_Model {

    var $allow_rec_number_home = 5;
    var $allow_rec_number_oracle = 5;
    var $allow_rec_number_Bet = 5;
    var $allow_rec_number_Responsible = 5;

    var $allow_rec_number_49s_Last = 5;
    var $allow_rec_number_49s_Prev = 5;
    var $allow_rec_number_49s_H_C = 5;
    var $allow_rec_number_49s_Lucky_Dip = 5;
    var $allow_rec_number_49s_syndicates = 5;
    var $allow_rec_number_49s_winner = 5;
    var $allow_rec_number_49s_How_to_Play = 5;
    var $allow_rec_number_49s_Rule = 5;

    var $allow_rec_number_ILB_Last = 5;
    var $allow_rec_number_ILB_prev_results = 5;
    var $allow_rec_number_ILB_H_C = 5;
    var $allow_rec_number_ILB_Lucky_Dip = 5;
    var $allow_rec_number_ILB_syndicates = 5;
    var $allow_rec_number_ILB_How_to_Play = 5;
    var $allow_rec_number_ILB_Rule = 5;

    var $allow_rec_number_VHR_Last = 5;
    var $allow_rec_number_VHR_prev = 5;
    var $allow_rec_number_VHR_How_to_Play = 5;
    var $allow_rec_number_VHR_Rule = 5;

    var $allow_rec_number_VGR_Last = 5;
    var $allow_rec_number_VGR_prev = 5;
    var $allow_rec_number_VGR_How_to_Play = 5;
    var $allow_rec_number_VGR_Rule = 5;

    var $allow_rec_number_Rapido_Last = 5;
    var $allow_rec_number_Rapido_prev = 5;
    var $allow_rec_number_Rapido_How_to_Play = 5;
    var $allow_rec_number_Rapido_Rule = 5;

    var $allow_rec_number_promo_check_numbers = 3;
    var $allow_rec_number_promo_49s_lucky_dip = 3;
    var $allow_rec_number_promo_ilb_lucky_dip = 3;
    var $allow_rec_number_promo_bet_here = 3;
    var $allow_rec_number_promo_statistics = 3;
    var $allow_rec_number_promo_syndicate = 3;
    var $allow_rec_number_promo_49s_how = 3;
    var $allow_rec_number_promo_ilb_how = 3;
    var $allow_rec_number_promo_vhr_how = 3;
    var $allow_rec_number_promo_ra_how = 3;
    var $allow_rec_number_promo_vdr_how = 3;
    var $allow_rec_number_promo_49s_have = 3;
    var $allow_rec_number_promo_ilb_have = 3;
    var $allow_rec_number_promo_vhr_have = 3;
    var $allow_rec_number_promo_ra_have = 3;
    var $allow_rec_number_promo_vdr_have = 3;

    var $allow_rec_number_promo_home = 3;
    var $allow_rec_number_promo_49_latest = 3;
    var $allow_rec_number_promo_ilb_latest = 3;
    var $allow_rec_number_promo_vhr_latest = 3;
    var $allow_rec_number_promo_vgr_latest = 3;
    var $allow_rec_number_promo_rapido_latest = 3;
    var $allow_rec_number_mobile = 3;

    var $allow_rec_number_is_how_to_play_bgr_49s = 5;
    var $allow_rec_number_is_lucky_dip_bgr_49s = 5;
    var $allow_rec_number_is_how_to_play_bgr_ilb = 5;
    var $allow_rec_number_is_lucky_dip_bgr_ilb = 5;
    var $allow_rec_number_is_how_to_play_bgr_ra = 5;
    var $allow_rec_number_is_lucky_dip_bgr_ra = 5;
    var $allow_rec_number_is_how_to_play_bgr_vhr = 5;
    var $allow_rec_number_is_lucky_dip_bgr_vhr = 5;
    var $allow_rec_number_is_how_to_play_bgr_vgr = 5;
    var $allow_rec_number_is_lucky_dip_bgr_vgr = 5;






    var $allow_rec_number_home_video = 1;
    var $allow_rec_number_oracle_video = 1;
    var $allow_rec_number_Bet_video = 1;
    var $allow_rec_number_Responsible_video = 1;

    var $allow_rec_number_49s_Last_video = 1;
    var $allow_rec_number_49s_Prev_video = 1;
    var $allow_rec_number_49s_H_C_video = 1;
    var $allow_rec_number_49s_Lucky_Dip_video = 1;
    var $allow_rec_number_49s_syndicates_video = 1;
    var $allow_rec_number_49s_winner_video = 1;
    var $allow_rec_number_49s_How_to_Play_video = 1;
    var $allow_rec_number_49s_Rule_video = 1;

    var $allow_rec_number_ILB_Last_video = 1;
    var $allow_rec_number_ILB_prev_results_video = 1;
    var $allow_rec_number_ILB_H_C_video = 1;
    var $allow_rec_number_ILB_Lucky_Dip_video = 1;
    var $allow_rec_number_ILB_syndicates_video = 1;
    var $allow_rec_number_ILB_How_to_Play_video = 1;
    var $allow_rec_number_ILB_Rule_video = 1;

    var $allow_rec_number_VHR_Last_video = 1;
    var $allow_rec_number_VHR_prev_video = 1;
    var $allow_rec_number_VHR_How_to_Play_video = 1;
    var $allow_rec_number_VHR_Rule_video = 1;

    var $allow_rec_number_VGR_Last_video = 1;
    var $allow_rec_number_VGR_prev_video = 1;
    var $allow_rec_number_VGR_How_to_Play_video = 1;
    var $allow_rec_number_VGR_Rule_video = 1;

    var $allow_rec_number_Rapido_Last_video = 1;
    var $allow_rec_number_Rapido_prev_video = 1;
    var $allow_rec_number_Rapido_How_to_Play_video = 1;
    var $allow_rec_number_Rapido_Rule_video = 1;

    var $allow_rec_number_promo_check_numbers_video = 1;
    var $allow_rec_number_promo_49s_lucky_dip_video = 1;
    var $allow_rec_number_promo_ilb_lucky_dip_video = 1;
    var $allow_rec_number_promo_bet_here_video = 1;
    var $allow_rec_number_promo_statistics_video = 1;
    var $allow_rec_number_promo_syndicate_video = 1;
    var $allow_rec_number_promo_49s_how_video = 1;
    var $allow_rec_number_promo_ilb_how_video = 1;
    var $allow_rec_number_promo_vhr_how_video = 1;
    var $allow_rec_number_promo_ra_how_video = 1;
    var $allow_rec_number_promo_vdr_how_video = 1;
    var $allow_rec_number_promo_49s_have_video = 1;
    var $allow_rec_number_promo_ilb_have_video = 1;
    var $allow_rec_number_promo_vhr_have_video = 1;
    var $allow_rec_number_promo_ra_have_video = 1;
    var $allow_rec_number_promo_vdr_have_video = 1;

    var $allow_rec_number_promo_home_video = 1;
    var $allow_rec_number_promo_49_latest_video = 1;
    var $allow_rec_number_promo_ilb_latest_video = 1;
    var $allow_rec_number_promo_vhr_latest_video = 1;
    var $allow_rec_number_promo_vgr_latest_video = 1;
    var $allow_rec_number_promo_rapido_latest_video = 1;
    var $allow_rec_number_mobile_video = 1;

    var $allow_rec_number_is_how_to_play_bgr_49s_video = 1;
    var $allow_rec_number_is_lucky_dip_bgr_49s_video = 1;
    var $allow_rec_number_is_how_to_play_bgr_ilb_video = 1;
    var $allow_rec_number_is_lucky_dip_bgr_ilb_video = 1;
    var $allow_rec_number_is_how_to_play_bgr_ra_video = 1;
    var $allow_rec_number_is_lucky_dip_bgr_ra_video = 1;
    var $allow_rec_number_is_how_to_play_bgr_vhr_video = 1;
    var $allow_rec_number_is_lucky_dip_bgr_vhr_video = 1;
    var $allow_rec_number_is_how_to_play_bgr_vgr_video = 1;
    var $allow_rec_number_is_lucky_dip_bgr_vgr_video = 1;


    function object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->object_to_array($value);
            }
            return $result;
        }
        return $data;
    }

    function is_reach_limit($type,$check_video = false){
        $limit = 0;
        $limit_video = 0;
        if($type == 'is_home'){
            $this->db->where('is_home',1);
            $limit = $this->allow_rec_number_home;
            $limit_video = $this->allow_rec_number_home_video;
        }
        if($type == 'is_oracle'){
            $this->db->where('is_oracle',1);
            $limit = $this->allow_rec_number_oracle;
            $limit_video = $this->allow_rec_number_oracle_video;
        }
        if($type == 'is_bet_here'){
            $this->db->where('is_bet_here',1);
            $limit = $this->allow_rec_number_Bet;
            $limit_video = $this->allow_rec_number_Bet_video;
        }
        if($type == 'is_responsible'){
            $this->db->where('is_responsible',1);
            $limit = $this->allow_rec_number_Responsible;
            $limit_video = $this->allow_rec_number_Responsible_video;
        }
        if($type == 'is_49s_last'){
            $this->db->where('is_49s_last',1);
            $limit = $this->allow_rec_number_49s_Last;
            $limit_video = $this->allow_rec_number_49s_Last_video;
        }
        if($type == 'is_49s_prev'){
            $this->db->where('is_49s_prev',1);
            $limit = $this->allow_rec_number_49s_Prev;
            $limit_video = $this->allow_rec_number_49s_Prev_video;
        }
        if($type == 'is_49s_h_c'){
            $this->db->where('is_49s_h_c',1);
            $limit = $this->allow_rec_number_49s_H_C;
            $limit_video = $this->allow_rec_number_49s_H_C_video;
        }
        if($type == 'is_49s_lucky_dip'){
            $this->db->where('is_49s_lucky_dip',1);
            $limit = $this->allow_rec_number_49s_Lucky_Dip;
            $limit_video = $this->allow_rec_number_49s_Lucky_Dip_video;
        }
        if($type == 'is_49s_syndicates'){
            $this->db->where('is_49s_syndicates',1);
            $limit = $this->allow_rec_number_49s_syndicates;
            $limit_video = $this->allow_rec_number_49s_syndicates_video;
        }
        if($type == 'is_49s_winner'){
            $this->db->where('is_49s_winner',1);
            $limit = $this->allow_rec_number_49s_winner;
            $limit_video = $this->allow_rec_number_49s_winner_video;
        }
        if($type == 'is_49s_how_to_play'){
            $this->db->where('is_49s_how_to_play',1);
            $limit = $this->allow_rec_number_49s_How_to_Play;
            $limit_video = $this->allow_rec_number_49s_How_to_Play_video;
        }
        if($type == 'is_49s_rule'){
            $this->db->where('is_49s_rule',1);
            $limit = $this->allow_rec_number_49s_Rule;
            $limit_video = $this->allow_rec_number_49s_Rule_video;
        }
        if($type == 'is_ilb_last'){
            $this->db->where('is_ilb_last',1);
            $limit = $this->allow_rec_number_ILB_Last;
            $limit_video = $this->allow_rec_number_ILB_Last_video;
        }
        if($type == 'is_ilb_prev'){
            $this->db->where('is_ilb_prev',1);
            $limit = $this->allow_rec_number_ILB_prev_results;
            $limit_video = $this->allow_rec_number_ILB_prev_results_video;
        }
        if($type == 'is_ilb_h_c'){
            $this->db->where('is_ilb_h_c',1);
            $limit = $this->allow_rec_number_ILB_H_C;
            $limit_video = $this->allow_rec_number_ILB_H_C_video;
        }
        if($type == 'is_ilb_lucky_dip'){
            $this->db->where('is_ilb_lucky_dip',1);
            $limit = $this->allow_rec_number_ILB_Lucky_Dip;
            $limit_video = $this->allow_rec_number_ILB_Lucky_Dip_video;
        }
        if($type == 'is_ilb_syndicates'){
            $this->db->where('is_ilb_syndicates',1);
            $limit = $this->allow_rec_number_ILB_syndicates;
            $limit_video = $this->allow_rec_number_ILB_syndicates_video;
        }
        if($type == 'is_ilb_how_to_play'){
            $this->db->where('is_ilb_how_to_play',1);
            $limit = $this->allow_rec_number_ILB_How_to_Play;
            $limit_video = $this->allow_rec_number_ILB_How_to_Play_video;
        }
        if($type == 'is_ilb_rule'){
            $this->db->where('is_ilb_rule',1);
            $limit = $this->allow_rec_number_ILB_Rule;
            $limit_video = $this->allow_rec_number_ILB_Rule_video;
        }
        if($type == 'is_vhr_last'){
            $this->db->where('is_vhr_last',1);
            $limit = $this->allow_rec_number_VHR_Last;
            $limit_video = $this->allow_rec_number_VHR_Last_video;
        }
        if($type == 'is_vhr_prev'){
            $this->db->where('is_vhr_prev',1);
            $limit = $this->allow_rec_number_VHR_prev;
            $limit_video = $this->allow_rec_number_VHR_prev_video;
        }
        if($type == 'is_vhr_how_to_play'){
            $this->db->where('is_vhr_how_to_play',1);
            $limit = $this->allow_rec_number_VHR_How_to_Play;
            $limit_video = $this->allow_rec_number_VHR_How_to_Play_video;
        }
        if($type == 'is_vhr_rule'){
            $this->db->where('is_vhr_rule',1);
            $limit = $this->allow_rec_number_VHR_Rule;
            $limit_video = $this->allow_rec_number_VHR_Rule_video;
        }
        if($type == 'is_vdr_last'){
            $this->db->where('is_vdr_last',1);
            $limit = $this->allow_rec_number_VGR_Last;
            $limit_video = $this->allow_rec_number_VGR_Last_video;
        }
        if($type == 'is_vdr_prev'){
            $this->db->where('is_vdr_prev',1);
            $limit = $this->allow_rec_number_VGR_prev;
            $limit_video = $this->allow_rec_number_VGR_prev_video;
        }
        if($type == 'is_vdr_how_to_play'){
            $this->db->where('is_vdr_how_to_play',1);
            $limit = $this->allow_rec_number_VGR_How_to_Play;
            $limit_video = $this->allow_rec_number_VGR_How_to_Play_video;
        }
        if($type == 'is_vdr_rule'){
            $this->db->where('is_vdr_rule',1);
            $limit = $this->allow_rec_number_VGR_Rule;
            $limit_video = $this->allow_rec_number_VGR_Rule_video;
        }
        if($type == 'is_rapido_last'){
            $this->db->where('is_rapido_last',1);
            $limit = $this->allow_rec_number_Rapido_Last;
            $limit_video = $this->allow_rec_number_Rapido_Last_video;
        }
        if($type == 'is_rapido_prev'){
            $this->db->where('is_rapido_prev',1);
            $limit = $this->allow_rec_number_Rapido_prev;
            $limit_video = $this->allow_rec_number_Rapido_prev_video;
        }
        if($type == 'is_how_to_play'){
            $this->db->where('is_how_to_play',1);
            $limit = $this->allow_rec_number_Rapido_How_to_Play;
            $limit_video = $this->allow_rec_number_Rapido_How_to_Play_video;
        }
        if($type == 'is_rapido_rule'){
            $this->db->where('is_rapido_rule',1);
            $limit = $this->allow_rec_number_Rapido_Rule;
            $limit_video = $this->allow_rec_number_Rapido_Rule_video;
        }


        if($type == 'is_promo_check_numbers'){
            $this->db->where('is_promo_check_numbers',1);
            $limit = $this->allow_rec_number_promo_check_numbers;
            $limit_video = $this->allow_rec_number_promo_check_numbers_video;
        }
        if($type == 'is_promo_49s_lucky_dip'){
            $this->db->where('is_promo_49s_lucky_dip',1);
            $limit = $this->allow_rec_number_promo_49s_lucky_dip;
            $limit_video = $this->allow_rec_number_promo_49s_lucky_dip_video;
        }
        if($type == 'is_promo_ilb_lucky_dip'){
            $this->db->where('is_promo_ilb_lucky_dip',1);
            $limit = $this->allow_rec_number_promo_ilb_lucky_dip;
            $limit_video = $this->allow_rec_number_promo_ilb_lucky_dip_video;
        }
        if($type == 'is_promo_bet_here'){
            $this->db->where('is_promo_bet_here',1);
            $limit = $this->allow_rec_number_promo_bet_here;
            $limit_video = $this->allow_rec_number_promo_bet_here_video;
        }
        if($type == 'is_promo_download'){
            $this->db->where('is_promo_download',1);
            $limit = $this->allow_rec_number_promo_download;
            $limit_video = $this->allow_rec_number_promo_download_video;
        }
        if($type == 'is_promo_statistics'){
            $this->db->where('is_promo_statistics',1);
            $limit = $this->allow_rec_number_promo_statistics;
            $limit_video = $this->allow_rec_number_promo_statistics_video;
        }
        if($type == 'is_promo_syndicate'){
            $this->db->where('is_promo_syndicate',1);
            $limit = $this->allow_rec_number_promo_syndicate;
            $limit_video = $this->allow_rec_number_promo_syndicate_video;
        }


        if($type == 'is_promo_49s_how'){
            $this->db->where('is_promo_49s_how',1);
            $limit = $this->allow_rec_number_promo_49s_how;
            $limit_video = $this->allow_rec_number_promo_49s_how_video;
        }
        if($type == 'is_promo_ilb_how'){
            $this->db->where('is_promo_ilb_how',1);
            $limit = $this->allow_rec_number_promo_ilb_how;
            $limit_video = $this->allow_rec_number_promo_ilb_how_video;
        }
        if($type == 'is_promo_vhr_how'){
            $this->db->where('is_promo_vhr_how',1);
            $limit = $this->allow_rec_number_promo_vhr_how;
            $limit_video = $this->allow_rec_number_promo_vhr_how_video;
        }
        if($type == 'is_promo_ra_how'){
            $this->db->where('is_promo_ra_how',1);
            $limit = $this->allow_rec_number_promo_ra_how;
            $limit_video = $this->allow_rec_number_promo_ra_how_video;
        }
        if($type == 'is_promo_vdr_how'){
            $this->db->where('is_promo_vdr_how',1);
            $limit = $this->allow_rec_number_promo_vdr_how;
            $limit_video = $this->allow_rec_number_promo_vdr_how_video;
        }


        if($type == 'is_promo_49s_have'){
            $this->db->where('is_promo_49s_have',1);
            $limit = $this->allow_rec_number_promo_49s_have;
            $limit_video = $this->allow_rec_number_promo_49s_have_video;
        }
        if($type == 'is_promo_ilb_have'){
            $this->db->where('is_promo_ilb_have',1);
            $limit = $this->allow_rec_number_promo_ilb_have;
            $limit_video = $this->allow_rec_number_promo_ilb_have_video;
        }
        if($type == 'is_promo_vhr_have'){
            $this->db->where('is_promo_vhr_have',1);
            $limit = $this->allow_rec_number_promo_vhr_have;
            $limit_video = $this->allow_rec_number_promo_vhr_have_video;
        }
        if($type == 'is_promo_ra_have'){
            $this->db->where('is_promo_ra_have',1);
            $limit = $this->allow_rec_number_promo_ra_have;
            $limit_video = $this->allow_rec_number_promo_ra_have_video;
        }
        if($type == 'is_promo_vdr_have'){
            $this->db->where('is_promo_vdr_have',1);
            $limit = $this->allow_rec_number_Rapido_How_to_Play;
            $limit_video = $this->allow_rec_number_Rapido_How_to_Play_video;
        }


        if($type == 'is_promo_home'){
            $this->db->where('is_promo_home',1);
            $limit = $this->allow_rec_number_promo_home;
            $limit_video = $this->allow_rec_number_promo_home_video;
        }
        if($type == 'is_promo_49_latest'){
            $this->db->where('is_promo_49_latest',1);
            $limit = $this->allow_rec_number_promo_49_latest;
            $limit_video = $this->allow_rec_number_promo_49_latest_video;
        }
        if($type == 'is_promo_ilb_latest'){
            $this->db->where('is_promo_ilb_latest',1);
            $limit = $this->allow_rec_number_promo_ilb_latest;
            $limit_video = $this->allow_rec_number_promo_ilb_latest_video;
        }
        if($type == 'is_promo_vhr_latest'){
            $this->db->where('is_promo_vhr_latest',1);
            $limit = $this->allow_rec_number_promo_vhr_latest;
            $limit_video = $this->allow_rec_number_promo_vhr_latest_video;
        }
        if($type == 'is_promo_vgr_latest'){
            $this->db->where('is_promo_vgr_latest',1);
            $limit = $this->allow_rec_number_promo_vgr_latest;
            $limit_video = $this->allow_rec_number_promo_vgr_latest_video;
        }
        if($type == 'is_promo_rapido_latest'){
            $this->db->where('is_promo_rapido_latest',1);
            $limit = $this->allow_rec_number_promo_rapido_latest;
            $limit_video = $this->allow_rec_number_promo_rapido_latest_video;
        }

        if($type == 'is_mobile'){
            $this->db->where('is_mobile',1);
            $limit = $this->allow_rec_number_mobile;
            $limit_video = $this->allow_rec_number_mobile_video;
        }

        if($type == 'is_how_to_play_bgr_49s'){
            $this->db->where('is_how_to_play_bgr_49s',1);
            $limit = $this->allow_rec_number_is_how_to_play_bgr_49s;
            $limit_video = $this->allow_rec_number_is_how_to_play_bgr_49s_video;
        }
        if($type == 'is_lucky_dip_bgr_49s'){
            $this->db->where('is_lucky_dip_bgr_49s',1);
            $limit = $this->allow_rec_number_is_lucky_dip_bgr_49s;
            $limit_video = $this->allow_rec_number_is_lucky_dip_bgr_49s_video;
        }

        if($type == 'is_how_to_play_bgr_ilb'){
            $this->db->where('is_how_to_play_bgr_ilb',1);
            $limit = $this->allow_rec_number_is_how_to_play_bgr_ilb;
            $limit_video = $this->allow_rec_number_is_how_to_play_bgr_ilb_video;
        }
        if($type == 'is_lucky_dip_bgr_ilb'){
            $this->db->where('is_lucky_dip_bgr_ilb',1);
            $limit = $this->allow_rec_number_is_lucky_dip_bgr_ilb;
            $limit_video = $this->allow_rec_number_is_lucky_dip_bgr_ilb_video;
        }

        if($type == 'is_how_to_play_bgr_ra'){
            $this->db->where('is_how_to_play_bgr_ra',1);
            $limit = $this->allow_rec_number_is_how_to_play_bgr_ra;
            $limit_video = $this->allow_rec_number_is_how_to_play_bgr_ra_video;
        }
        if($type == 'is_lucky_dip_bgr_ra'){
            $this->db->where('is_lucky_dip_bgr_ra',1);
            $limit = $this->allow_rec_number_is_lucky_dip_bgr_ra;
            $limit_video = $this->allow_rec_number_is_lucky_dip_bgr_ra_video;
        }

        if($type == 'is_how_to_play_bgr_vhr'){
            $this->db->where('is_how_to_play_bgr_vhr',1);
            $limit = $this->allow_rec_number_is_how_to_play_bgr_vhr;
            $limit_video = $this->allow_rec_number_is_how_to_play_bgr_vhr_video;
        }
        if($type == 'is_lucky_dip_bgr_vhr'){
            $this->db->where('is_lucky_dip_bgr_vhr',1);
            $limit = $this->allow_rec_number_is_lucky_dip_bgr_vhr;
            $limit_video = $this->allow_rec_number_is_lucky_dip_bgr_vhr_video;
        }

        if($type == 'is_how_to_play_bgr_vgr'){
            $this->db->where('is_how_to_play_bgr_vgr',1);
            $limit = $this->allow_rec_number_is_how_to_play_bgr_vgr;
            $limit_video = $this->allow_rec_number_is_how_to_play_bgr_vgr_video;
        }
        if($type == 'is_lucky_dip_bgr_vgr'){
            $this->db->where('is_lucky_dip_bgr_vgr',1);
            $limit = $this->allow_rec_number_is_lucky_dip_bgr_vgr;
            $limit_video = $this->allow_rec_number_is_lucky_dip_bgr_vgr_video;
        }


        if($check_video){
            $this->db->where('url_path_main !=','0');
        }

        $this->db->from('t_uploads');
        $query = $this->db->get();

        //var_dump($limit);
        //var_dump(count($query->result()));

        $count = count($query->result());

        if($check_video){
            if($count >= $limit_video){
                return true;
            } else {
                return false;
            }
        } else {
            if($count >= $limit ){
                return true;
            } else {
                return false;
            }
        }

    }

    function save_in_db($type,$url,$overlay_text,$id){
        $this->db->set('overlay_text',$overlay_text);
        $this->db->set('url',$url);

        if($this->session->userdata('video_upload_temp') != ''){
            $this->db->set('url_path_main',$this->session->userdata('video_upload_temp'));
        }
        if($this->session->userdata('image_upload_temp') != ''){
            $this->db->set('url_path_thumb',$this->session->userdata('image_upload_temp'));
        }

        if($type == 'is_home'){
            $this->db->set('is_home',1);
        } else {
            $this->db->set('is_home',0);
        }
        if($type == 'is_oracle'){
            $this->db->set('is_oracle',1);
        } else {
            $this->db->set('is_oracle',0);
        }
        if($type == 'is_bet_here'){
            $this->db->set('is_bet_here',1);
        } else {
            $this->db->set('is_bet_here',0);
        }
        if($type == 'is_responsible'){
            $this->db->set('is_responsible',1);
        } else {
            $this->db->set('is_responsible',0);
        }
        if($type == 'is_49s_last'){
            $this->db->set('is_49s_last',1);
        } else {
            $this->db->set('is_49s_last',0);
        }
        if($type == 'is_49s_prev'){
            $this->db->set('is_49s_prev',1);
        } else {
            $this->db->set('is_49s_prev',0);
        }
        if($type == 'is_49s_h_c'){
            $this->db->set('is_49s_h_c',1);
        } else {
            $this->db->set('is_49s_h_c',0);
        }
        if($type == 'is_49s_lucky_dip'){
            $this->db->set('is_49s_lucky_dip',1);
        } else {
            $this->db->set('is_49s_lucky_dip',0);
        }
        if($type == 'is_49s_syndicates'){
            $this->db->set('is_49s_syndicates',1);
        } else {
            $this->db->set('is_49s_syndicates',0);
        }
        if($type == 'is_49s_winner'){
            $this->db->set('is_49s_winner',1);
        } else {
            $this->db->set('is_49s_winner',0);
        }
        if($type == 'is_49s_how_to_play'){
            $this->db->set('is_49s_how_to_play',1);
        } else {
            $this->db->set('is_49s_how_to_play',0);
        }
        if($type == 'is_49s_rule'){
            $this->db->set('is_49s_rule',1);
        } else {
            $this->db->set('is_49s_rule',0);
        }
        if($type == 'is_ilb_last'){
            $this->db->set('is_ilb_last',1);
        } else {
            $this->db->set('is_ilb_last',0);
        }
        if($type == 'is_ilb_prev'){
            $this->db->set('is_ilb_prev',1);
        } else {
            $this->db->set('is_ilb_prev',0);
        }
        if($type == 'is_ilb_h_c'){
            $this->db->set('is_ilb_h_c',1);
        } else {
            $this->db->set('is_ilb_h_c',0);
        }
        if($type == 'is_ilb_lucky_dip'){
            $this->db->set('is_ilb_lucky_dip',1);
        } else {
            $this->db->set('is_ilb_lucky_dip',0);
        }
        if($type == 'is_ilb_syndicates'){
            $this->db->set('is_ilb_syndicates',1);
        } else {
            $this->db->set('is_ilb_syndicates',0);
        }
        if($type == 'is_ilb_how_to_play'){
            $this->db->set('is_ilb_how_to_play',1);
        } else {
            $this->db->set('is_ilb_how_to_play',0);
        }
        if($type == 'is_ilb_rule'){
            $this->db->set('is_ilb_rule',1);
        } else {
            $this->db->set('is_ilb_rule',0);
        }
        if($type == 'is_vhr_last'){
            $this->db->set('is_vhr_last',1);
        } else {
            $this->db->set('is_vhr_last',0);
        }
        if($type == 'is_vhr_prev'){
            $this->db->set('is_vhr_prev',1);
        } else {
            $this->db->set('is_vhr_prev',0);
        }
        if($type == 'is_vhr_how_to_play'){
            $this->db->set('is_vhr_how_to_play',1);
        } else {
            $this->db->set('is_vhr_how_to_play',0);
        }
        if($type == 'is_vhr_rule'){
            $this->db->set('is_vhr_rule',1);
        } else {
            $this->db->set('is_vhr_rule',0);
        }
        if($type == 'is_vdr_last'){
            $this->db->set('is_vdr_last',1);
        } else {
            $this->db->set('is_vdr_last',0);
        }
        if($type == 'is_vdr_prev'){
            $this->db->set('is_vdr_prev',1);
        } else {
            $this->db->set('is_vdr_prev',0);
        }
        if($type == 'is_vdr_how_to_play'){
            $this->db->set('is_vdr_how_to_play',1);
        } else {
            $this->db->set('is_vdr_how_to_play',0);
        }
        if($type == 'is_vdr_rule'){
            $this->db->set('is_vdr_rule',1);
        } else {
            $this->db->set('is_vdr_rule',0);
        }
        if($type == 'is_rapido_last'){
            $this->db->set('is_rapido_last',1);
        } else {
            $this->db->set('is_rapido_last',0);
        }
        if($type == 'is_rapido_prev'){
            $this->db->set('is_rapido_prev',1);
        } else {
            $this->db->set('is_rapido_prev',0);
        }
        if($type == 'is_how_to_play'){
            $this->db->set('is_how_to_play',1);
        } else {
            $this->db->set('is_how_to_play',0);
        }
        if($type == 'is_rapido_rule'){
            $this->db->set('is_rapido_rule',1);
        } else {
            $this->db->set('is_rapido_rule',0);
        }

        //var_dump($type);


        if($type == 'is_promo_check_numbers'){
            $this->db->set('is_promo_check_numbers',1);
        } else {
            $this->db->set('is_promo_check_numbers',0);
        }
        if($type == 'is_promo_49s_lucky_dip'){
            $this->db->set('is_promo_49s_lucky_dip',1);
        } else {
            $this->db->set('is_promo_49s_lucky_dip',0);
        }
        if($type == 'is_promo_ilb_lucky_dip'){
            $this->db->set('is_promo_ilb_lucky_dip',1);
        } else {
            $this->db->set('is_promo_ilb_lucky_dip',0);
        }
        if($type == 'is_promo_bet_here'){
            $this->db->set('is_promo_bet_here',1);
        } else {
            $this->db->set('is_promo_bet_here',0);
        }
        if($type == 'is_promo_download'){
            $this->db->set('is_promo_download',1);
        } else {
            $this->db->set('is_promo_download',0);
        }
        if($type == 'is_promo_statistics'){
            $this->db->set('is_promo_statistics',1);
        } else {
            $this->db->set('is_promo_statistics',0);
        }
        if($type == 'is_promo_syndicate'){
            $this->db->set('is_promo_syndicate',1);
        } else {
            $this->db->set('is_promo_syndicate',0);
        }


        if($type == 'is_promo_49s_how'){
            $this->db->set('is_promo_49s_how',1);
        } else {
            $this->db->set('is_promo_49s_how',0);
        }
        if($type == 'is_promo_ilb_how'){
            $this->db->set('is_promo_ilb_how',1);
        } else {
            $this->db->set('is_promo_ilb_how',0);
        }
        if($type == 'is_promo_vhr_how'){
            $this->db->set('is_promo_vhr_how',1);
        } else {
            $this->db->set('is_promo_vhr_how',0);
        }
        if($type == 'is_promo_ra_how'){
            $this->db->set('is_promo_ra_how',1);
        } else {
            $this->db->set('is_promo_ra_how',0);
        }
        if($type == 'is_promo_vdr_how'){
            $this->db->set('is_promo_vdr_how',1);
        } else {
            $this->db->set('is_promo_vdr_how',0);
        }


        if($type == 'is_promo_49s_have'){
            $this->db->set('is_promo_49s_have',1);
        } else {
            $this->db->set('is_promo_49s_have',0);
        }
        if($type == 'is_promo_ilb_have'){
            $this->db->set('is_promo_ilb_have',1);
        } else {
            $this->db->set('is_promo_ilb_have',0);
        }
        if($type == 'is_promo_vhr_have'){
            $this->db->set('is_promo_vhr_have',1);
        } else {
            $this->db->set('is_promo_vhr_have',0);
        }
        if($type == 'is_promo_ra_have'){
            $this->db->set('is_promo_ra_have',1);
        } else {
            $this->db->set('is_promo_ra_have',0);
        }
        if($type == 'is_promo_vdr_have'){
            $this->db->set('is_promo_vdr_have',1);
        } else {
            $this->db->set('is_promo_vdr_have',0);
        }


        if($type == 'is_promo_home'){
            $this->db->set('is_promo_home',1);
        } else {
            $this->db->set('is_promo_home',0);
        }
        if($type == 'is_promo_49_latest'){
            $this->db->set('is_promo_49_latest',1);
        } else {
            $this->db->set('is_promo_49_latest',0);
        }
        if($type == 'is_promo_ilb_latest'){
            $this->db->set('is_promo_ilb_latest',1);
        } else {
            $this->db->set('is_promo_ilb_latest',0);
        }
        if($type == 'is_promo_vhr_latest'){
            $this->db->set('is_promo_vhr_latest',1);
        } else {
            $this->db->set('is_promo_vhr_latest',0);
        }
        if($type == 'is_promo_vgr_latest'){
            $this->db->set('is_promo_vgr_latest',1);
        } else {
            $this->db->set('is_promo_vgr_latest',0);
        }
        if($type == 'is_promo_rapido_latest'){
            $this->db->set('is_promo_rapido_latest',1);
        } else {
            $this->db->set('is_promo_rapido_latest',0);
        }

        if($type == 'is_mobile'){
            $this->db->set('is_mobile',1);
        } else {
            $this->db->set('is_mobile',0);
        }


        if($type == 'is_how_to_play_bgr_49s'){
            $this->db->set('is_how_to_play_bgr_49s',1);
        } else {
            $this->db->set('is_how_to_play_bgr_49s',0);
        }
        if($type == 'is_lucky_dip_bgr_49s'){
            $this->db->set('is_lucky_dip_bgr_49s',1);
        } else {
            $this->db->set('is_lucky_dip_bgr_49s',0);
        }

        if($type == 'is_how_to_play_bgr_ilb'){
            $this->db->set('is_how_to_play_bgr_ilb',1);
        } else {
            $this->db->set('is_how_to_play_bgr_ilb',0);
        }
        if($type == 'is_lucky_dip_bgr_ilb'){
            $this->db->set('is_lucky_dip_bgr_ilb',1);
        } else {
            $this->db->set('is_lucky_dip_bgr_ilb',0);
        }

        if($type == 'is_how_to_play_bgr_ra'){
            $this->db->set('is_how_to_play_bgr_ra',1);
        } else {
            $this->db->set('is_how_to_play_bgr_ra',0);
        }
        if($type == 'is_lucky_dip_bgr_ra'){
            $this->db->set('is_lucky_dip_bgr_ra',1);
        } else {
            $this->db->set('is_lucky_dip_bgr_ra',0);
        }

        if($type == 'is_how_to_play_bgr_vhr'){
            $this->db->set('is_how_to_play_bgr_vhr',1);
        } else {
            $this->db->set('is_how_to_play_bgr_vhr',0);
        }
        if($type == 'is_lucky_dip_bgr_vhr'){
            $this->db->set('is_lucky_dip_bgr_vhr',1);
        } else {
            $this->db->set('is_lucky_dip_bgr_vhr',0);
        }

        if($type == 'is_how_to_play_bgr_vgr'){
            $this->db->set('is_how_to_play_bgr_vgr',1);
        } else {
            $this->db->set('is_how_to_play_bgr_vgr',0);
        }
        if($type == 'is_lucky_dip_bgr_vgr'){
            $this->db->set('is_lucky_dip_bgr_vgr',1);
        } else {
            $this->db->set('is_lucky_dip_bgr_vgr',0);
        }


        //var_dump($type);


        if($id == 0){
            $this->db->insert('t_uploads');
            return $this->db->insert_id();
        } else {
            $this->db->where('id',$id);
            $this->db->update('t_uploads');
            return $id;
        }


        $this->session->unset_userdata('video_upload_temp');
        $this->session->unset_userdata('image_upload_temp');

    }

    public function getUpload($id){
        $this->db->where('id',$id);
        $query = $this->db->get('t_uploads');

        $this->session->set_userdata('video_upload_temp', $query->row('url_path_main'));
        $this->session->set_userdata('image_upload_temp', $query->row('url_path_thumb'));

        return $query->row();
    }

    public function getAllUploads(){
        $query = $this->db->get('t_uploads');
        return $query->result();
    }
}
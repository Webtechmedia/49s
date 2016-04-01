<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {


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

    public function get_draw_times_49(){
        $this->db->from('draw_time');
        $query = $this->db->get();
       	
        
        
        
        
        return $query->result();

    }

    public function get_report_for_dog_and_horse($race_type,$date_from,$date_to,$addon_where){

    	$this->db->select('t_meeting.date as date');
    	$this->db->select('t_events.time as time');
    	$this->db->select("t_meeting.name as track");
    	$this->db->select("t_selection.name as runner_name");
    	$this->db->select("t_selection.num as runner_number");
    	$this->db->select("t_position.sp as odds");
    	$this->db->select("t_position.position as finish_place");
    	$this->db->select("t_position.fav as favourite_or_second_favourite");
    	$this->db->select('(select t_racebet.amount from t_racebet where (t_racebet.bettype like "%T%" or t_racebet.bettype like "%M%") and t_racebet.event_id = t_events.id  limit 1 ) as t_c_amount');
    	$this->db->select('(select t_racebet.amount from t_racebet where (t_racebet.bettype like "%F%" or t_racebet.bettype like "%K%") and t_racebet.event_id = t_events.id  limit 1 ) as f_c_amount');
    	$this->db->from('t_event_type');
    	$this->db->join('t_meeting','t_meeting.event_type_id = t_event_type.id');
    	$this->db->join('t_events','t_events.meeting_id = t_meeting.id');
    	$this->db->join('t_result','t_result.event_id = t_events.id');
    	$this->db->join('t_position','t_position.result_id = t_result.id');
    	$this->db->join('t_selection','t_events.id = t_selection.event_id and t_position.name = t_selection.name');
    	$this->db->where('t_event_type.category',$race_type);
    	$this->db->where("t_event_type.date between '" . $date_from . "' and '" . $date_to . "' ");
    	if($addon_where!=''){
    		$this->db->where($addon_where);
    	}
    	$this->db->group_by('t_selection.name,t_event_type.date');
    	$this->db->order_by('t_meeting.date , t_events.time , t_position.position','asc');

    	$query = $this->db->get();

        return $query->result();
    }

	public function get_users_statistic()
	{
        $this->db->select('(select count(U_Id) from members ) as total_users', false);
        $this->db->select('(select count(U_Id) from members where U_Country = "GB" or U_Country = "UK" ) as total_valid_for_contest_users', false);
        $this->db->select('(select count(U_Id) from members where U_Plays49s = 1 ) as total_play_49', false);
        $this->db->select('(select count(U_Id)*100 / (select count(U_Id) from members) from members where U_Plays49s = 1 ) as total_play_49_percentage', false);
        $this->db->select('(select count(U_Id) from members where U_PlaysILB = 1 ) as total_play_ilb', false);
        $this->db->select('(select count(U_Id)*100 / (select count(U_Id) from members) from members where U_PlaysILB = 1 ) as total_play_ilb_percentage', false);
        $this->db->select('(select count(U_Id) from members where U_PlaysRapido = 1 ) as total_play_ra', false);
        $this->db->select('(select count(U_Id)*100 / (select count(U_Id) from members) from members where U_PlaysRapido = 1 ) as total_play_ra_percentage', false);
        $this->db->select('(select count(U_Id) from members where U_PlaysVHR = 1 ) as total_play_vh', false);
        $this->db->select('(select count(U_Id)*100 / (select count(U_Id) from members) from members where U_PlaysVHR = 1 ) as total_play_vh_percentage', false);
        $this->db->select('(select count(U_Id) from members where U_PlaysVGR = 1 ) as total_play_vd', false);
        $this->db->select('(select count(U_Id)*100 / (select count(U_Id) from members) from members where U_PlaysVGR = 1 ) as total_play_vd_percentage', false);
        $this->db->select('(select count(U_Id) from members where U_Gender = "F" ) as total_male', false);
        $this->db->select('(select count(U_Id) from members where U_Gender = "M" ) as total_female', false);
        $this->db->select('(select count(U_Id) from members where U_Age between 18 and 29 ) as age_18_29', false);
        $this->db->select('(select count(U_Id) from members where U_Age between 30 and 39 ) as age_30_39', false);
        $this->db->select('(select count(U_Id) from members where U_Age between 40 and 49 ) as age_40_49', false);
        $this->db->select('(select count(U_Id) from members where U_Age between 50 and 59 ) as age_50_59', false);
        $this->db->select('(select count(U_Id) from members where U_Age between 60 and 69 ) as age_60_69', false);
        $this->db->select('(select count(U_Id) from members where U_Age between 70 and 79 ) as age_70_79', false);
        $this->db->select('(select count(U_Id) from members where U_Age >= 80 ) as age_80', false);
        $this->db->select('(select U_Age from members group by U_Age order by (count(U_Age)) desc limit 1 ) as common_age', false);
        $this->db->select('(select AVG(U_Age) from members  ) as avg_age', false);
       // $this->db->select('(select count(U_IsSubscribed)*100 / (select count(U_IsSubscribed) from members) from members where U_IsSubscribed = 1 ) as total_subscibtion_percentage', false);
		$query = $this->db->get();

		return $query->row();
	}
public function get_miss()
	{
       $this->db->select('*');
		$this->db->from('miss_smiley');
       // $this->db->select('(select count(U_IsSubscribed)*100 / (select count(U_IsSubscribed) from members) from members where U_IsSubscribed = 1 ) as total_subscibtion_percentage', false);
		$query = $this->db->get();

		return $query->result();
	}
public function get_miss_spread()
	{
      $this->db->select('shop_name As "Shop Name",shop_number As "Shop Number",s_m_full_name As "Shop Manager",a_m_full_name As "Area Manager",email_address As "Email",shop_address As "Shop - 1st Line Address",shop_address2 As "Shop - Town",shop_address3 As "Shop - County",postcode As "Shop - Postcode",iospackage As "IOS Package",androidpackage As "Android Package",shop_phone As "Shop phone"');
		$this->db->from('miss_smiley');
       // $this->db->select('(select count(U_IsSubscribed)*100 / (select count(U_IsSubscribed) from members) from members where U_IsSubscribed = 1 ) as total_subscibtion_percentage', false);
		$query = $this->db->get();

		return $query->result();
	}
	public function get_number_events_between_dates($game_type,$date_from,$date_to){
		
		$this->db->select('t_event_type.date', false);
		$this->db->select('t_number_event.offtime', false);
		$this->db->select('t_number_event.num', false);
		$this->db->select('t_number_event.status', false);
		$this->db->select('t_number_event.id', false);
		$this->db->from('t_event_type');
		$this->db->join('t_numbers','t_numbers.event_id = t_event_type.id');
		$this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
		$this->db->where("t_event_type.date between '" . $date_from . "' and '" . $date_to . "' ");
		$this->db->where('t_event_type.category','NB');
		$this->db->where('t_numbers.code',$game_type);						   
		$this->db->order_by('t_event_type.date,t_number_event.offtime,t_number_event.num','asc');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	
	
	public function get_draw_numbers($event_id){
		$this->db->select('number');
		$this->db->from('t_drawn');
		$this->db->where('number_event_id',$event_id);
		$this->db->where('bonusnumber','N');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_bunus_draw_number($event_id){
		$this->db->select('number');
		$this->db->from('t_drawn');
		$this->db->where('number_event_id',$event_id);
		$this->db->where('bonusnumber','Y');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	public function get_race_events_number_between_dates($game_type,$date_from,$date_to){
	
	 	$sql=" 
		SELECT 
    		distinct(tbl.name), 
			count(tbl.name) as races,
			tbl.date
		FROM
    		(SELECT 
        		t_event_type.date, t_meeting.name
    		FROM
        		t_event_type
    		JOIN t_meeting ON t_meeting.event_type_id = t_event_type.id
    		JOIN t_events ON t_events.meeting_id = t_meeting.id
    		JOIN t_result ON t_result.event_id = t_events.id
    		join t_position ON t_position.result_id = t_result.id
    		WHERE
        		t_event_type.category = '".$game_type."'
            		and t_event_type.date between '" . $date_from . "' and '" . $date_to . "'
    		GROUP BY t_event_type.date , t_events.time
    		ORDER by t_event_type.date , t_meeting.name)tbl
		GROUP BY tbl.date,tbl.name  
		ORDER BY tbl.date,tbl.name asc
		 ";

        $query = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
	}
	
	public function get_rapido_events_number_between_dates($game_type,$date_from,$date_to){
	
	
		$sql=" 
		SELECT 
    		count(tbl.date) as draws,
			tbl.date
		FROM
    		(SELECT 
        		t_event_type.date,
        		    t_number_event.num,
        		    t_number_event.offtime
    		FROM
        		t_event_type
    		JOIN t_numbers ON t_numbers.event_id = t_event_type.id
    		JOIN t_number_event ON t_number_event.number_id = t_numbers.id
    		JOIN t_drawn ON t_drawn.number_event_id = t_number_event.id
    		WHERE
        		t_event_type.category = 'NB'
            		and t_numbers.code = '".$game_type."'
            		and t_event_type.date between '" . $date_from . "' and '" . $date_to . "'
    		GROUP BY t_event_type.date , t_number_event.time)tbl
		GROUP BY tbl.date
		";

        $query = $this->db->query($sql);
        $result = $query->result();
        
        return $result;

	}
	
	
}








<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Num_games_model extends CI_Model
{

    private static $xcache = null;

    var $cache = null;
 
    public function __construct()
    {

        //we make sure we have only one instance of memcached per request
        if(!self::$xcache) {
            self::$xcache = new Memcached();

            //set options
            self::$xcache->setOptions(array(
                Memcached::OPT_CLIENT_MODE=>true,
                Memcached::DYNAMIC_CLIENT_MODE=>true,
                Memcached::OPT_TCP_NODELAY => true,
                Memcached::OPT_BINARY_PROTOCOL => true));

            //add servers
            $server_endpoint = "fourtynines-cache2.efdy84.0001.euw1.cache.amazonaws.com";
            $server_endpoint2 = "fourtynines-cache2.efdy84.0002.euw1.cache.amazonaws.com";
            $server_endpoint3 = "fourtynines-cache2.efdy84.0003.euw1.cache.amazonaws.com";
            $server_port = 11211;
            self::$xcache->addServer($server_endpoint, $server_port);
            //self::$xcache->addServer($server_endpoint2, $server_port);
            //self::$xcache->addServer($server_endpoint3, $server_port);
        }

        //get a per model reference to Memcached
        $this->cache = self::$xcache;

        parent::__construct();
    }
    /*public function __destruct()
    {
        if($this->cache != null) { $this->cache->quit(); }
        parent::__destruct();
    }*/

    public function cache_test() {
        $game_type = 1;
        $key = "abcdefg{$game_type}";
        $value = $this->cache->get($key);
        if(!$value) {
            $this->cache->set($key,time(),2);
        }

        $value = $this->cache->get($key);
        return '['.$value.']';
    }

    public function get_asset($field,$random = false){
        $memcache_key = "get_asset_{$field}_{$random}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->select('url_path_thumb as image_url',false);
        $this->db->select('IF(url_path_main = "0","",url_path_main) as video_url',false);
        $this->db->select('url');
        $this->db->select('overlay_text');
        $this->db->where($field,1);
        if($random){
            $this->db->order_by('RAND()',false);
            $this->db->limit(3);
        }
        $this->db->from('t_uploads');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_mobile_asset($field,$random = false){
        $memcache_key = "get_mobile_asset_{$field}_{$random}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->select('url_path_thumb as image_url',false);// remove ./ from  begining of path and create full path
        $this->db->select('IF(url_path_main = "0","",url_path_main) as video_url',false);
        $this->db->select('url');
        $this->db->select('overlay_text');
        $this->db->where($field,1);
        if($random){
            $this->db->order_by('RAND()',false);
            $this->db->limit(3);
        }
        $this->db->from('t_uploads_mobile');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_presenters(){
        $memcache_key = "get_presenters";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->select('main_img as main_img_full', false);
        $this->db->select('main_video as main_video_full', false);
        $this->db->select('thumb_img as thumb_img_full', false);
        $this->db->select('t_presenters.*');
        $this->db->from('t_presenters');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_winners($field){
        $memcache_key = "get_winners";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->where($field,1);
        $this->db->from('t_winners');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_49_games_dates($year = 0, $month = 0)
    {
        $memcache_key = "49_dates_" . $year . "." . $month;
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
            $this->db->_protect_identifiers=false;
            $this->db->select('t_event_type.*');
            $this->db->select("DATE_FORMAT(t_event_type.date, '%Y-%m'  ) as date " , false );
            $this->db->where('t_event_type.country','UK');
            if($year > 0 && $month > 0){
                $this->db->where("DATE_FORMAT(t_event_type.date, '%Y-%m'  ) = '" . $year . "-" . $month . "' " , null, false );
            }
    
            $this->db->where('t_event_type.category','NB');
            $this->db->where('t_event_type.source','sportsData');
            $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
            $this->db->group_by("DATE_FORMAT(t_event_type.date, '%Y%m'  )",true);
            $this->db->from('t_event_type');
            $this->db->limit(10);
            $this->db->order_by('t_event_type.id','desc');
            $query = $this->db->get();
            $result = $query->result();
            $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    
    
    
    
    
   
    public function get_ball_total_draw($game_type,$number){
   
        $memcache_key = "get_ball_total_draw_{$game_type}_{$number}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
    	$this->db->select('count(*) as total');
    	$this->db->from('t_numbers');
    	$this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
    	$this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');   	

    	$this->db->where('t_numbers.code',$game_type);
    	$this->db->where('t_drawn.number',$number);

    	$result =  $this->db->get()->row()->total;
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }
    
    
    public function get_hot_cold_numbers($order_type, $num_of_records, $game_type){
        $memcache_key = $game_type . '_hot_cold_' . $order_type;
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
            $this->db->select('t_drawn.number');
            $this->db->select("count(*) as times " , false );
            $this->db->where('t_event_type.category','NB');
            $this->db->where('t_numbers.code',$game_type);
            $this->db->where('t_event_type.date >=',date('Y-m-d', strtotime("-4 week")));
            $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
            $this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
            $this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
            $this->db->group_by("t_drawn.number");
            $this->db->from('t_event_type');
            $this->db->limit($num_of_records);
            $this->db->order_by('count(t_drawn.number) ' . $order_type . ' ' ,null,false);
            $query = $this->db->get();
            $result = $query->result();
            $this->cache->set($memcache_key, $result, 300);
        }

        return $result;

    }

    public function get_games_statistic($game_type, $ball_type){
        $memcache_key = "get_games_statistic_{$game_type}_{$ball_type}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {

        $sql="select number , max(main) as main, max(bonus) as bonus, (max(main) + max(bonus)) number_total from (
            (SELECT t_drawn.number, count(*) as main, 0 as bonus FROM t_event_type
			left join t_numbers on t_numbers.event_id = t_event_type.id
			left join t_number_event on t_number_event.number_id = t_numbers.id
			left join t_drawn on t_drawn.number_event_id = t_number_event.id
			where
			 t_event_type.category= 'NB'
			 AND t_numbers.code= '" . $game_type . "' ";

        if($game_type=='49'){
        	$sql.=" and  t_drawn.number between 1 and 49 ";
        }
        if($game_type=='il'){
        	$sql.=" and  t_drawn.number between 1 and 47 ";
        }
        if($game_type=='ra'){
        	$sql.=" and  t_drawn.number between 1 and 80 ";
        }

		$sql.=" and t_drawn.bonusnumber = 'N'
		group by  t_drawn.number
		 order by t_drawn.number
		)
		union all
		        (
		            SELECT t_drawn.number, 0 as main, count(*) as bonus FROM t_event_type
			left join t_numbers on t_numbers.event_id = t_event_type.id
			left join t_number_event on t_number_event.number_id = t_numbers.id
			left join t_drawn on t_drawn.number_event_id = t_number_event.id
			where
			 t_event_type.category= 'NB'
			 AND t_numbers.code= '" . $game_type . "'";

        if($game_type=='49'){
        	$sql.=" and  t_drawn.number between 1 and 49 ";
        }
        if($game_type=='il'){
        	$sql.=" and  t_drawn.number between 1 and 47 ";
        }
        if($game_type=='ra'){
        	$sql.=" and  t_drawn.number between 1 and 80 ";
        }

		$sql.="
			 and t_drawn.bonusnumber = 'Y'
			group by  t_drawn.number
			 order by t_drawn.number
			) ) as t
			group by number";



        $query = $this->db->query($sql);
        $result = $query->result();
            $this->cache->set($memcache_key, $result, 300);
        }

        return $result;

    }

    public function get_oracle_49s(
        $numbers,
        $from,
        $to,
        $teatime,
        $lunchtime,
        $compination_in_draw = false
    ){

        if(!$compination_in_draw){
            $this->db->select('t_drawn.number');
            $this->db->select('(sum(case when t_drawn.bonusnumber = "N" THEN 1 else 0 end)) as main',false);
            $this->db->select('(sum(case when t_drawn.bonusnumber = "Y" THEN 1 else 0 end)) as bonus',false);
            $this->db->select('count(t_drawn.number)as number_total',false);
        } else {
            $this->db->select('(SELECT
                    (CASE
                            WHEN COUNT(*) = '. count($numbers) .' THEN 1
                            ELSE 0
                        END) AS count
                FROM
                    t_drawn
                WHERE
                    `t_drawn`.`number_event_id` = `t_number_event`.`id`
                    AND `t_drawn`.`number` IN ( '. implode(", ", $numbers) . ' )) AS times',false);
        }

        //$this->db->where('t_event_type.category','NB');
        $this->db->where('t_numbers.code','49');

        $where = " ";
        if($teatime == true && $lunchtime == true){
            // do nothing
        } else {
        	if($lunchtime){
        		$where = $where .'( t_number_event.num = 1 )';
        	}
            if($teatime){
                $where = $where .'( t_number_event.num > 1  )';
            }
            $this->db->where($where,null,false);
        }


        if($compination_in_draw == false) {
            if(count($numbers) > 0){
                $this->db->where_in('t_drawn.number',$numbers);
            }
        }

        $this->db->where('t_numbers.date between "'.$from .'" and "' . $to . '" ',null, false);
        $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
        $this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
        if(!$compination_in_draw){
            $this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
            $this->db->group_by('t_drawn.number');
        } else {
            $this->db->group_by('t_number_event.id');
        }
        $this->db->from('t_event_type');

        $query = $this->db->get();
        $result = $query->result();

        return $result;

    }

    public function get_oracle_ilb(
        $numbers,
        $from,
        $to,
        $first,
        $second,
        $third,
        $compination_in_draw = false
    ){
        if(!$compination_in_draw){
            $this->db->select('t_drawn.number');
            $this->db->select('(sum(case when t_drawn.bonusnumber = "N" THEN 1 else 0 end)) as main',false);
            $this->db->select('(sum(case when t_drawn.bonusnumber = "Y" THEN 1 else 0 end)) as bonus',false);
            $this->db->select('count(t_drawn.number)as number_total',false);
        } else {
            $this->db->select('(SELECT
                    (CASE
                            WHEN COUNT(*) = '. count($numbers) .' THEN 1
                            ELSE 0
                        END) AS count
                FROM
                    t_drawn
                WHERE
                    `t_drawn`.`number_event_id` = `t_number_event`.`id`
                    AND `t_drawn`.`number` IN ( '. implode(", ", $numbers) . ' )) AS times',false);
        }

        $this->db->where('t_numbers.code','il');

        $where = " ";


        if($first || $second || $third){
        	$where .= " ( ";
        	if($first){
        		$where .= ' t_number_event.num = 1 ';
        	}
        	if($second){
        		if($first){$where .=' or ';}
        		$where .= ' t_number_event.num = 2 ';
        	}
        	if($third){
        		if($first || $second){$where .=' or ';}
        		$where .= ' t_number_event.num = 3 ';
        	}
        	$where .= " ) ";
        }



        $this->db->where($where, null, false);


        if($compination_in_draw == false) {
            if(count($numbers) > 0){
                $this->db->where_in('t_drawn.number',$numbers);
            }
        }

        $this->db->where('t_numbers.date between "'.$from .'" and "' . $to . '" ',null, false);
        $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
        $this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
        $this->db->from('t_event_type');
        if(!$compination_in_draw){
            $this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
            $this->db->group_by('t_drawn.number');
        } else {
            $this->db->group_by('t_number_event.id');
        }

        $query = $this->db->get();
        //$result = $query->result();
        $result = $query->result();
        //var_dump($this->db->last_query());

        return $result;

    }


    public function get_oracle_rapido(
        $numbers,
        $from,
        $to,
        $head,
        $tail,
        $level,
        $compination_in_draw = false
    ){

        if(!$compination_in_draw){
            $this->db->select('t_drawn.number');
            $this->db->select('count(t_drawn.number)as number_total',false);
        } else {
            $this->db->select('(SELECT
                    (CASE
                            WHEN COUNT(*) = '. count($numbers) .' THEN 1
                            ELSE 0
                        END) AS count
                FROM
                    t_drawn
                WHERE
                    `t_drawn`.`number_event_id` = `t_number_event`.`id`
                    AND `t_drawn`.`number` IN ( '. implode(", ", $numbers) . ' )) AS times',false);
        }

        $this->db->where('t_numbers.code','ra');

        $where = "(";

        if($head){
            $where = $where .' (SELECT count(id)from t_drawn where `t_drawn`.`number_event_id` = `t_number_event`.`id` and `t_drawn`.`number` >= 40 )  < 10 ';
        }
        if($level){
            if($where != "("){
                $where = $where .' or ';
            }
            $where = $where .' (SELECT count(id)from t_drawn where `t_drawn`.`number_event_id` = `t_number_event`.`id` and `t_drawn`.`number` >= 40 )  = 10 ';
        }
        if($tail){
            if($where != "("){
                $where = $where .' or ';
            }
            $where = $where .' (SELECT count(id)from t_drawn where `t_drawn`.`number_event_id` = `t_number_event`.`id` and `t_drawn`.`number` >= 40 )  > 10 ';
        }

        if($where != "("){
            $where = $where .' ) ';
            $this->db->where($where, null, false);
        }


        if($compination_in_draw == false) {
            if(count($numbers) > 0){
                $this->db->where_in('t_drawn.number',$numbers);
            }
        }
        $this->db->where('t_numbers.date between "'.$from .'" and "' . $to . '" ',null, false);
        $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
        $this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
        $this->db->from('t_event_type');
        if(!$compination_in_draw){
            $this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
            $this->db->group_by('t_drawn.number');
        } else {
            $this->db->group_by('t_number_event.id');
        }

        $query = $this->db->get();
        $result = $query->result();


        return $result;

    }

    public function get_competitions(){
        $this->db->where('status',1);
        $this->db->from('competitions');
        $query = $this->db->get();
        return $query->result();
    }

    public function enter_competitions($email, $competition){
        $this->db->where('members.U_Email',$email);
        $this->db->from('members');
        $query = $this->db->get();
        if(isset($query->row()->U_Id)){

            $this->db->where('user_id', $query->row()->U_Id);
            $this->db->where('competition_id', $competition);
            $this->db->from('competitions_to_users');
            $query2 = $this->db->get();
            if(count($query2->result()) > 0){
                return true;
            } else {
                $this->db->set('user_id', $query->row()->U_Id);
                $this->db->set('competition_id', $competition);
                $this->db->insert('competitions_to_users');
                return true;
            }

        } else {
            return false;
        }
    }

    public function check_if_email_valid($email){
        $this->db->where('members.U_Email',$email);
        $this->db->from('members');
        $query = $this->db->get();
        if(count($query->result()) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function check_email($email){
        $this->db->where('competitions.status',1);
        $this->db->where('members.U_Email',$email);
        $this->db->from('competitions');
        $this->db->join('competitions_to_users','competitions_to_users.competition_id = competitions.id');
        $this->db->join('members','competitions_to_users.user_id = members.U_Id');
        $query = $this->db->get();
        if(count($query->result()) > 0){
            return true;
        } else {
            return false;
        }

    }

    public function get_oracle_names( $name, $game_type )
    {
        $gt = $this->db->escape_str($game_type);
        $name = $this->db->escape_str($name);
        
        $sql = "SELECT name FROM oracle_names_typeahead
                 WHERE category = '$gt' AND name LIKE '%$name%'
                 ORDER BY name ASC";

		/*$sql = "SELECT distinct t_selection.name from t_selection
		join t_events on t_selection.event_id=t_events.id 
		join t_meeting on t_events.meeting_id = t_meeting.id
		join t_event_type on t_meeting.event_type_id=t_event_type.id
		where t_event_type.category='$gt' AND t_selection.name LIKE '$name%'";*/

        $query = $this->db->query($sql);
        return $query->result();
    }

  	public function get_total_races_by($game_type, $name, $fromDate, $toDate){


        $this->db->select('count(t_selection.name) as times,t_position.position',false);
        $this->db->like('t_selection.name',$name);
        $this->db->where('t_event_type.category',$game_type);
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->from('t_event_type');
        $this->db->join('t_price','t_selection.id = t_price.selection_id','left');
        $this->db->join('t_position','t_selection.id_id = t_position.selectionref','left');
        $this->db->where('t_meeting.date between "' . $fromDate . '" and "' . $toDate . '" ',null,false);
        $this->db->where('t_position.position IS NOT NULL', null, false);
        $this->db->group_by('t_position.position');

        $query = $this->db->get();

        return $query->result();
    }



   public function get_total_places_by($game_type, $name, $fromDate, $toDate){


        $this->db->select('count(t_selection.name) as times,t_position.position',false);
        $this->db->like('t_selection.name',$name);
        $this->db->where('t_event_type.category',$game_type);
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->from('t_event_type');
        $this->db->join('t_price','t_selection.id = t_price.selection_id','left');
        $this->db->join('t_position','t_selection.id_id = t_position.selectionref','left');
        $this->db->where('t_meeting.date between "' . $fromDate . '" and "' . $toDate . '" ',null,false);
        $this->db->where('t_position.position IS NOT NULL', null, false);
        $this->db->group_by('t_position.position');

        $query = $this->db->get();
        return $query->result();

    }




    public function get_oracle_vr($name, $from, $to, $game_type, $latest = false){

        $this->db->select('t_selection.name');
        $this->db->select('t_price.dec');
        $this->db->select('t_position.fav as fav',false);
        $this->db->select('t_position.position');
        $this->db->select('t_price.fract');
        $this->db->select('t_meeting.name as location',false);
        $this->db->select('t_meeting.date as date',false);
        $this->db->select('t_events.time as time',false);
        $this->db->select('t_selection.name as racer',false);
        $this->db->select('t_selection.num as runner_number',false);
        $this->db->where('t_event_type.category',$game_type);
        $this->db->where('t_selection.name',$name);
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->join('t_price','t_selection.id = t_price.selection_id','left');
        $this->db->join('t_position','t_selection.id_id = t_position.selectionref','left');
        $this->db->from('t_event_type');
        $this->db->where('t_meeting.date between "' . $from . '" and "' . $to . '" ',null,false);
        $this->db->where('t_position.id IS NOT NULL', null);


        $this->db->group_by('t_meeting.date,t_events.time');
        if($latest){

        	$this->db->order_by('t_meeting.date','desc');
        	$this->db->limit(1);
        }else{
        	$this->db->order_by('t_meeting.date,t_events.time,t_position.position','asc');
        }
        $query = $this->db->get();

        if($latest){
        	return $query->row();
        } else {
        	return $query->result();
        }





    }

    public function get_games_date($game_type,$order){

    	$this->db->select('date');
    	$this->db->from('t_numbers');
    	$this->db->where('code',$game_type);
    	$this->db->order_by('date ' . $order . ' ');
    	$this->db->limit(1);
        $query = $this->db->get();
        $result = $query->result();
        $result = $query->row();
        return $result;
    }
    public function get_games_date_with_results($game_type,$order){

    	$this->db->select('date');
    	$this->db->from('t_numbers');
    	$this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
    	$this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
    	$this->db->where('code',$game_type);
    	$this->db->order_by('date ' . $order . ' ');
    	$this->db->limit(1);
    	$query = $this->db->get();
    	$result = $query->result();
    	$result = $query->row();
    	return $result;
    }

    public function get_games_date_vhr_vgr($game_type,$order){

    	if($order=='asc'){

    		$sql="SELECT
				    max(t_event_type.date) as date
				FROM
				    t_event_type
				        join
				    t_meeting ON t_meeting.event_type_id = t_event_type.id
				        join
				    t_events ON t_meeting.id = t_events.meeting_id
				        join
				    t_result ON t_events.id = t_result.event_id

				where t_event_type.category='".$game_type."' and settlingstatus not in ('V','','null')";
    	}else{

    		$sql="SELECT
				    min(t_event_type.date) as date
				FROM
				    t_event_type
				        join
				    t_meeting ON t_meeting.event_type_id = t_event_type.id
				        join
				    t_events ON t_meeting.id = t_events.meeting_id
				        join
				    t_result ON t_events.id = t_result.event_id

				where t_event_type.category='".$game_type."'   ";
    	}

    	$query = $this->db->query($sql);
    	$result = $query->result();
    	return $result;
    }

    public function get_games_total($game_type,$order){

        $this->db->select('count(*) as counter',false);
        $this->db->where('t_event_type.category','NB');
        $this->db->where('t_numbers.code',$game_type);
        $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
        $this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
        $this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
        $this->db->from('t_event_type');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_faq(){
        $query  = $this->db->get('t_faq');
        return $query->result();
    }

    public function get_shareholders(){

        /*$this->db->select('concat("http://'.$_SERVER['HTTP_HOST'].'/admin/",substring(img, 3, length(img))) as img',false);// remove ./ from  begining of path and create full path*/
        $this->db->select('img');
        $this->db->select('id');
        $this->db->select('link');
        $this->db->select('provider');

        $this->db->limit(3);
        $this->db->order_by('id','desc');
        $query  = $this->db->get('t_shareholders');
        return $query->result();
    }

    public function get_shareholders_mobile(){

        /*$this->db->select('concat("http://'.$_SERVER['HTTP_HOST'].'/admin/",substring(img, 3, length(img))) as img',false);// remove ./ from  begining of path and create full path*/
        $this->db->select('img');
        $this->db->select('id');
        $this->db->select('link');
        $this->db->select('provider');

        $this->db->limit(3);
        $this->db->order_by('id','desc');
        $query  = $this->db->get('t_shareholders_mobile');
        return $query->result();
    }

    public function get_alert(){
    	/*$this->db->select('concat("http://'.$_SERVER['HTTP_HOST'].'/admin/",substring(img, 3, length(img))) as img',false);// remove ./ from  begining of path and create full path*/
        $this->db->select('img');
    	$this->db->select('id');
    	$this->db->select('link');
    	$this->db->from('t_alert');
    	$this->db->limit(1);
    	$this->db->order_by('id','desc');
    	$query  = $this->db->get();
    	return $query->row();
    }

    public function get_game_result_by_date($game_type,$date){
        $memcache_key = "{$game_type}_result_{$date}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {


    	$this->db->select('t_event_type.date');
    	$this->db->select('t_numbers.code');
    	$this->db->select('t_number_event.num');
    	$this->db->select('t_number_event.time');
    	$this->db->select('t_number_event.offtime');
    	$this->db->select('t_number_event.status');
    	$this->db->select('t_drawn.number');
    	$this->db->select('t_drawn.order');
    	$this->db->select('t_drawn.bonusnumber');
    	$this->db->select('t_number_event.id_id');

    	$this->db->from('t_event_type');

    	$this->db->join('t_numbers','t_numbers.event_id = t_event_type.id');
    	$this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
        $this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
    	/*
         * DISABLED - THE LEFT JOIN CAUSES BLANK / EXTRANEOUS ROWS OCCASIONALLY.
         * NOT SURE WHY YOU'D NEED TO DO A LEFT JOIN ANYWAY ....
        if( strtotime($date) < strtotime(date("Y-m-d"))){
    		$this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id', 'left');
    	}else{
    		$this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
    	}*/
    	$this->db->where('t_event_type.date',$date);
    	$this->db->where('t_event_type.category','NB');
    	$this->db->where('t_numbers.code',$game_type);

    	$this->db->order_by('t_number_event.num,t_drawn.order','asc');

    	//do not cache last day
    	if( strtotime($date) < strtotime(date("Y-m-d", strtotime('-3 days')))){
    		$this->db->cache_on();
    	}else{
    		$this->db->cache_off();
    	}
    	$query = $this->db->get();
    	$result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }

    	return $result;
    }

    public function get_game_result_for_date($game_type,$date,$group_balls_for = 0){
        $memcache_key = "{$game_type}_result_{$date}_group_for_{$group_balls_for}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {

        if($group_balls_for == 0){
            $this->db->select('t_number_event.time as draw_time',false);
            //$this->db->select('t_number_event.id_id as event_id',false);
            $this->db->select('t_number_event.id as event_id',false);
            $this->db->select('t_number_event.status as status');
            //$this->db->order_by('time','asc');
            $this->db->order_by('t_number_event.num','asc');

        } else {
            $this->db->select('t_number_event.*',false);
            $this->db->select('t_event_type.*',false);
            $this->db->select('t_numbers.*');
            $this->db->select('t_drawn.*');
            $this->db->select('t_number_event.status as status');

            $this->db->order_by('t_drawn.order');
            $this->db->order_by('t_number_event.num','asc');

        }
        $this->db->where('t_event_type.category','NB');
        $this->db->where('t_numbers.code',$game_type);
        $this->db->where('t_numbers.date',$date);

        $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
        $this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
        if( strtotime($date) < strtotime(date("Y-m-d"))){
        	$this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id', 'left');
        }else{
        	$this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id');
        }

        $this->db->from('t_event_type');
        if($group_balls_for == 0){
            $this->db->group_by('t_number_event.id');
            //$this->db->group_by('t_numbers.event_id,t_number_event.id_id');
        } else {
            $this->db->where('t_number_event.id',$group_balls_for);
        }
        //do not cache last day
     	if( strtotime($date) < strtotime(date("Y-m-d", strtotime('-3 days')))){
    		$this->db->cache_on();
    	}else{
    		$this->db->cache_off();
    	}
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_game_result_for_date_rapido($game_type,$date,$group_balls_for = 0){
        $memcache_key = "{$game_type}_rapido_result_{$date}_group_balls_for_{$group_balls_for}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
    	
    	if( strtotime($date) < strtotime(date("Y-m-d"))){
    		$sql = "select
				    t_number_event.*,
				    t_event_type.*,
				    t_numbers.*,
				    t_drawn.*,
    				t_number_event.status as status
				from
				    t_event_type
				        join
				    t_numbers ON (t_event_type.id = t_numbers.event_id)
				        join
				    t_number_event ON (t_number_event.number_id = t_numbers.id)
				        left join
				    t_drawn ON (t_drawn.number_event_id = t_number_event.id)
				where
				    t_event_type.category = 'NB'
				        and t_numbers.code = '".$game_type."'
				        and t_numbers.date = '".$date."'
				        and t_number_event.id = '".$group_balls_for."'
				order by t_drawn.order , t_number_event.num";
    	}else{
    		$sql = "select
				    t_number_event.*,
				    t_event_type.*,
				    t_numbers.*,
				    t_drawn.*,
    				t_number_event.status as status
				from
				    t_event_type
				        join
				    t_numbers ON (t_event_type.id = t_numbers.event_id)
				        join
				    t_number_event ON (t_number_event.number_id = t_numbers.id)
				        join
				    t_drawn ON (t_drawn.number_event_id = t_number_event.id)
				where
				    t_event_type.category = 'NB'
				        and t_numbers.code = '".$game_type."'
				        and t_numbers.date = '".$date."'
				        and t_number_event.id = '".$group_balls_for."'
				order by t_drawn.order , t_number_event.num";
    		
    	}
    	
    	if( strtotime($date) < strtotime(date("Y-m-d", strtotime('-3 days')))){
    		$this->db->cache_on();
    	}else{
    		$this->db->cache_off();
    	}

    	$query = $this->db->query($sql);
    	$result =  $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }




    public function get_game_next_date($game_type,$date){
        $memcache_key = "{$game_type}_get_next_date_{$date}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {

        $this->db->select('t_number_event.time as draw_time',false);
        $this->db->select('t_number_event.id_id as event_id',false);
        $this->db->select('t_number_event.num',false);
        $this->db->where('t_event_type.category','NB');
        $this->db->where('t_numbers.code',$game_type);
        $this->db->where('t_numbers.date',$date);
        $this->db->where('t_number_event.offtime','');
        $this->db->where('t_number_event.status !=','C');
        $this->db->where('t_number_event.status !=','V');
        $this->db->join('t_numbers','t_event_type.id = t_numbers.event_id');
        $this->db->join('t_number_event','t_number_event.number_id = t_numbers.id');
        $this->db->join('t_drawn','t_drawn.number_event_id = t_number_event.id','left');
        $this->db->order_by('draw_time','asc');
        $this->db->from('t_event_type');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }
/*
    public function get_race_date($game_type,$order){
        $this->db->select('concat(t_event_type.date, " ", t_events.time) as date',false);
        $this->db->where('t_event_type.category',$game_type);
        $this->db->where('t_events.time >', date("H:i:s", strtotime('+1 hour')) );
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->from('t_event_type');
        $this->db->order_by('t_event_type.date ' . $order . ' ' ,null,false);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    */
    public function get_oldest_race_date($game_type){
    
        $memcache_key = "{$game_type}_oldest_race_date";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
    	$this->db->select('t_event_type.date');
    	$this->db->from('t_event_type');
    	$this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
    	$this->db->join('t_events','t_events.meeting_id = t_meeting.id');
    	$this->db->join('t_result','t_result.event_id = t_events.id');
    	$this->db->join('t_position','t_position.result_id = t_result.id');
    	$this->db->where('t_event_type.category',$game_type);
    	$this->db->order_by('t_event_type.date', 'asc');
    	$this->db->limit(1);
    	$query = $this->db->get();
    	$result = $query->row('date');
        $this->cache->set($memcache_key, $result, 86400);
        }
        return $result;
     
    }
    

    public function get_positions_from_race_hr($event_id){
        $memcache_key = "race_hr_positions_{$event_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->select('t_selection.name');
        $this->db->select('t_price.dec');
        $this->db->select('t_position.fav as fav');
        $this->db->select('t_position.position');
        $this->db->select('t_price.fract');
        $this->db->select('t_selection.name as racer',false);
        $this->db->select('t_selection.num as runner_number',false);
        $this->db->where('t_events.id',$event_id);
        $this->db->where( "t_position.position BETWEEN 1 AND 4", NULL, FALSE );
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->join('t_price','t_selection.id = t_price.selection_id','left');
        $this->db->join('t_position','t_selection.id_id = t_position.selectionref','left');
        $this->db->from('t_event_type');
        $this->db->group_by('t_selection.name');
        $this->db->order_by('t_meeting.date,t_events.time,t_position.position','asc');
        $query = $this->db->get();
        $result =  $query->result();
        }
        return $result;
    }


    public function get_positions_from_race_dg($event_id){
        $memcache_key = "race_dg_positions_{$event_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {

    	$sql = 'SELECT
			t_position.id,
			t_position.position,
			t_position.sp as fract,
			t_position.fav as fav,
			t_events.time,
			t_position.name,
			t_selection.num as runner_number
		FROM
			t_event_type
				JOIN
			t_meeting ON (t_event_type.id = t_meeting.event_type_id)
				JOIN
			t_events ON (t_events.meeting_id = t_meeting.id)
				JOIN
			t_result ON (t_events.id = t_result.event_id)
				JOIN
			t_position ON (t_result.id = t_position.result_id)
				JOIN
			t_selection ON (t_events.id = t_selection.event_id and t_position.name = t_selection.name)
		WHERE
			t_events.id = "'.$event_id.'"
				AND t_position.position BETWEEN 1 AND 4
		GROUP BY t_selection.name
		ORDER BY t_meeting.date , t_events.time , t_position.position asc;';
    	$query = $this->db->query($sql);
    	$result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }



    public function get_race_by_location($game_type, $date_from, $date_to, $location){
        $memcache_key = "{$game_type}_race_by_locations_{$date_from}_{$date_to}_{$location}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {

        $this->db->select('t_meeting.date as race_date',false);
        $this->db->select('t_events.time as race_time',false);
        $this->db->select('t_events.id_id as event_id',false);
        $this->db->select('t_events.status as status',false);
        $this->db->select('(select t_racebet.amount from t_racebet where (t_racebet.bettype like "%T%" or t_racebet.bettype like "%M%") and t_racebet.event_id = t_events.id  limit 1 ) as tc',false);
        $this->db->select('(select t_racebet.amount from t_racebet where (t_racebet.bettype like "%F%" or t_racebet.bettype like "%K%") and t_racebet.event_id = t_events.id  limit 1 ) as fc',false);
        $this->db->select('t_meeting.name',false);
        $this->db->select('t_events.id as event_id',false);
        $this->db->where('t_event_type.category',$game_type);
        $this->db->where( "t_meeting.date BETWEEN '$date_from' AND '$date_to'", NULL, FALSE );
        $this->db->where( "t_meeting.name",$location);
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->join('t_price','t_selection.id = t_price.selection_id','left');
        $this->db->join('t_position','t_selection.id_id = t_position.selectionref');
        $this->db->from('t_event_type');
        $this->db->group_by('t_events.id');
        $this->db->order_by('t_events.time','asc');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_race_locations($game_type, $date_from, $date_to){
        $memcache_key = "{$game_type}_race_locations_{$date_from}_{$date_to}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->select('t_events.time as draw_time',false);
        $this->db->select('t_events.id_id as event_id',false);
        $this->db->select('t_meeting.name',false);
        $this->db->where('t_event_type.category',$game_type);
        $this->db->where( "t_meeting.date BETWEEN '$date_from' AND '$date_to'", NULL, FALSE );
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->join('t_price','t_selection.id = t_price.selection_id','left');
        $this->db->join('t_position','t_selection.id_id = t_position.selectionref');
        $this->db->from('t_event_type');
        $this->db->group_by('t_meeting.name');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_race_result_for_date($game_type,$date,$group_race_for = 0){
        $memcache_key = "{$game_type}_race_results_{$date}_{$group_race_for}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {

        if($group_race_for == 0){
            $this->db->select('t_events.time as draw_time',false);
            $this->db->select('t_events.id_id as event_id',false);
        } else {
            $this->db->select('t_meeting.name as location',false);
            $this->db->select('t_events.time as race_time',false);
            $this->db->select('t_events.*');
            $this->db->select('t_selection.*');
            $this->db->select('t_price.dec');
            $this->db->select('t_price.fract');
            $this->db->select('"" as fav',false);
            $this->db->select('t_selection.name as racer',false);
            $this->db->select('(select t_racebet.amount from t_racebet where t_racebet.bettype like "%T%" and t_racebet.event_id = t_events.id  limit 1 ) as tc',false);
            $this->db->select('(select t_racebet.amount from t_racebet where t_racebet.bettype like "%F%" and t_racebet.event_id = t_events.id  limit 1 ) as fc',false);
        }
        $this->db->where('t_event_type.category',$game_type);
        $this->db->where('t_meeting.date',$date);
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->join('t_events','t_events.meeting_id = t_meeting.id');
        $this->db->join('t_selection','t_selection.event_id = t_events.id');
        $this->db->join('t_price','t_selection.id = t_price.selection_id','left');
        $this->db->from('t_event_type');
        if($group_race_for == 0){
            $this->db->group_by('t_events.id_id');
        } else {
            $this->db->where('t_events.id_id',$group_race_for);
        }
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_race_next_date($game_type,$date){
        $memcache_key = "{$game_type}_get_racce_next_date_{$date}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $sql = "select
				    t_events.time as draw_time
				from
				    t_event_type
				        join
				    t_meeting ON (t_event_type.id = t_meeting.event_type_id)
				        join
				    t_events ON (t_events.meeting_id = t_meeting.id)
				        join
				    t_selection ON (t_selection.event_id = t_events.id)
				        join
				    t_price ON (t_selection.id = t_price.selection_id)
				where
				    t_event_type.category = '".$game_type."'
				        and t_meeting.date = '".$date."'
						and t_events.time > '".date("H:i:s", strtotime('+1 hour'))."'
				group by t_events.id_id
				order by t_events.time
				limit 1;";

        $query = $this->db->query($sql);
        $result = $query->row();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_horse_race_dates($year = 0, $month = 0, $day = 0)
    {
        $memcache_key = "get_horce_race_dates_{$year}{$month}{$day}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
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
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_race_selections($event_id)
    {
        $memcache_key = "get_race_selections_{$event_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->select('t_position.runner_number');
        $this->db->select('t_position.position');
        $this->db->select('t_selection.*');
        $this->db->where('t_selection.event_id',$event_id);
        $this->db->join('t_position','t_position.selectionref = t_selection.id_id');
        $this->db->from('t_selection');
        $this->db->group_by('t_selection.id_id');
        $query = $this->db->get();

        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_lucky_games_dates($year = 0, $month = 0)
    {
        $memcache_key = "get_lucky_games_dates{$year}{$month}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
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

        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_race_selection($selection_id)
    {
        $memcache_key = "get_race_selection_{$selection_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
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
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_race_event($meeting_id)
    {
        $memcache_key = "get_race_event_{$meeting_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->select('t_events.*');
        $this->db->where('meeting_id',$meeting_id);
        $this->db->from('t_events');
        $query = $this->db->get();

        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_dog_race_dates($year = 0, $month = 0, $day = 0)
    {
        $memcache_key = "get_dog_race_dates_{$year}{$month}{$day}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->_protect_identifiers=false;
        $this->db->select('t_event_type.*');
        $this->db->select("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) as date " , false );
        if($year > 0 && $month > 0 && $day > 0){
            $this->db->where("DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) = '" . $year . "-" . $month . "-" . $day . "' " , null, false );
        }
        $this->db->where('t_event_type.country','VR');
        $this->db->where('t_event_type.category','DG');
        $this->db->where('t_event_type.source','virtualRacing');
        $this->db->join('t_meeting','t_event_type.id = t_meeting.event_type_id');
        $this->db->group_by("DATE_FORMAT(t_event_type.date, '%Y%m%d'  )",true);
        $this->db->from('t_event_type');
        $this->db->limit(10);
        $this->db->order_by('t_event_type.id','desc');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_events_type_from_year_month_day($id){
        $memcache_key = "get_events_type_from_year_month_day_{$id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->where(" DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) = (SELECT DATE_FORMAT(t_event_type.date, '%Y-%m-%d'  ) from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where(" t_event_type.category = (SELECT t_event_type.category from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where(" t_event_type.country = (SELECT t_event_type.country from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where(" t_event_type.source = (SELECT t_event_type.source from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where("( t_event_type.name = 'numbers_game' OR  t_event_type.name = 'event'  ) ",null,false);
        $this->db->from('t_event_type');
        $this->db->order_by('t_event_type.date','desc');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_rapido_games_dates($year = 0, $month = 0, $day = 0)
    {
        $memcache_key = "get_rapido_games_dates_{$year}{$month}{$day}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
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
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_number_game_numbers($number_id)
    {
        $memcache_key = "get_number_game_numbers{$number_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->where('number_id',$number_id);
        $this->db->from('t_number_event');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_number_game_drawn($draw_id)
    {
        $memcache_key = "get_number_game_drawn_{$draw_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->where('number_event_id',$draw_id);
        $this->db->from('t_drawn');
        $this->db->order_by('bonusnumber');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_number_game_info($event_type_id)
    {
        $memcache_key = "get_number_game_info_{$event_type_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->where('event_id',$event_type_id);
        $this->db->from('t_numbers');
        $query = $this->db->get();

        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_race_game_info($event_type_id)
    {
        $memcache_key = "get_race_game_info_{$event_type_id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->where('event_type_id',$event_type_id);
        $this->db->from('t_meeting');
        $query = $this->db->get();

        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function save_feedback(
        $downloadApp,
        $email,
        $improvement,
        $listClear,
        $listEnjoyable,
        $listInfo,
        $listInteresting,
        $listLayout,
        $listUseful,
        $looking,
        $name,
        $rate49sLD,
        $rateFount,
        $rateILBLD,
        $rateLayout,
        $rateNew,
        $rateOld,
        $suggestions,
        $twitter

    )
    {
        $this->db->set('downloadApp',$downloadApp);
        $this->db->set('email',$email);
        $this->db->set('improvement',$improvement);
        $this->db->set('listClear',$listClear);
        $this->db->set('listEnjoyable',$listEnjoyable);
        $this->db->set('listInfo',$listInfo);
        $this->db->set('listInteresting',$listInteresting);
        $this->db->set('listLayout',$listLayout);
        $this->db->set('listUseful',$listUseful);
        $this->db->set('looking',$looking);
        $this->db->set('name',$name);
        $this->db->set('rate49sLD',$rate49sLD);
        $this->db->set('rateFount',$rateFount);
        $this->db->set('rateILBLD',$rateILBLD);
        $this->db->set('rateLayout',$rateLayout);
        $this->db->set('rateNew',$rateNew);
        $this->db->set('rateOld',$rateOld);
        $this->db->set('suggestions',$suggestions);
        $this->db->set('twitter',$twitter);
        $this->db->insert('t_feedback');
        return true;
    }
	
	
	public function save_misssmiley(
        $shopname,
        $shopnumber,
		$emailaddress,
        $managername,
        $areamanager,
        $shopaddress1,
		$shopaddress2,
		$shopaddress3,
		$postcode,
        $shopphone,
		$package

    )
    {
        $this->db->set('shop_name',$shopname);
        $this->db->set('shop_number',$shopnumber);
		$this->db->set('email_address',$emailaddress);
        $this->db->set('s_m_full_name',$managername);
        $this->db->set('a_m_full_name',$areamanager);
        $this->db->set('shop_address',$shopaddress1);
		$this->db->set('shop_address2',$shopaddress2);
		$this->db->set('shop_address3',$shopaddress3);
		$this->db->set('postcode',$postcode);
        $this->db->set('shop_phone',$shopphone);
		if($package == 'ios'){
			$this->db->set('iospackage','Yes');
			}
		if($package == 'android'){
			$this->db->set('androidpackage','Yes');
			}
        $this->db->insert('miss_smiley');
        return true;
    }


public function getshopname()
    {
		//$this->db->distinct();
        //$this->db->select('B_CompanyName')->from('bookmakers');
 
 //$query = $this->db->query("SELECT Distinct B_CompanyName FROM `bookmakers`");
 $query = $this->db->query("SELECT * FROM (SELECT a.B_CompanyName FROM `bookmakers` a WHERE a.B_Id in (20711,20712,20713,20714,20715,20716) ORDER BY a.B_Id) DUMMY_ALIAS1 UNION ALL SELECT * FROM (Select '------------------------------------------------' As B_CompanyName) DUMMY_ALIAS3 UNION ALL SELECT * FROM (SELECT Distinct b.B_CompanyName FROM `bookmakers` b ORDER BY b.B_CompanyName) DUMMY_ALIAS2");
        
		
		//$query = $this->db->get();
 
        return $query->result();
    }
    public function get_events_type_from_year_month($id){
        $memcache_key = "get_events_type_from_year_month_{$id}";
        $result = $this->cache->get($memcache_key);
        if( !$result || empty($result) )
        {
        $this->db->where(" DATE_FORMAT(t_event_type.date, '%Y-%m'  ) = (SELECT DATE_FORMAT(t_event_type.date, '%Y-%m'  ) from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where(" t_event_type.category = (SELECT t_event_type.category from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where(" t_event_type.country = (SELECT t_event_type.country from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where(" t_event_type.source = (SELECT t_event_type.source from  t_event_type   where t_event_type.id = " . $this->db->escape_str($id) . "   ) ",null,false);
        $this->db->where("( t_event_type.name = 'numbers_game' OR  t_event_type.name = 'event'  ) ",null,false);
        $this->db->from('t_event_type');
        $this->db->order_by('t_event_type.date','desc');
        $query = $this->db->get();
        $result = $query->result();
        $this->cache->set($memcache_key, $result, 300);
        }
        return $result;
    }

    public function get_latest($game_type){
        return array();
    }

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploads_model extends CI_Model {

    var $allow_records = 999;

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

    function is_reach_limit($type){

        $limit = $this->allow_records;

        $this->db->from('t_faq');
        $query = $this->db->get();

        //var_dump($limit);
        //var_dump(count($query->result()));

        if(count($query->result()) >= $limit){
            return true;
        } else {
            return false;
        }

    }

    function save_in_db($question,$answer){
        $this->db->set('question',$question);
        $this->db->set('answer',$answer);

        $this->db->insert('t_faq');


        return $this->db->insert_id();
    }

    public function getAllUploads(){
        $query = $this->db->get('t_faq');
        return $query->result();
    }
} 
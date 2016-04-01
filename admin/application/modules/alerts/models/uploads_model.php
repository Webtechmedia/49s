<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploads_model extends CI_Model {

    var $allow_records = 1;

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

        $this->db->from('t_alert');
        $query = $this->db->get();

        //var_dump($limit);
        //var_dump(count($query->result()));

        if(count($query->result()) >= $limit){
            return true;
        } else {
            return false;
        }

    }

    function save_in_db($url){
        $this->db->set('img',$this->session->userdata('image_upload_tempp'));
        $this->db->set('link',$url);

        $this->db->insert('t_alert');


        $this->session->unset_userdata('image_upload_tempp');

        return $this->db->insert_id();
    }

    public function getAllUploads(){
        $query = $this->db->get('t_alert');
        return $query->result();
    }
} 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploads_model extends CI_Model {

    var $allow_records = 3;

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

        $this->db->from('t_shareholders_mobile');
        $query = $this->db->get();

        //var_dump($limit);
        //var_dump(count($query->result()));

        if(count($query->result()) >= $limit){
            return true;
        } else {
            return false;
        }

    }

    function save_in_db($url,$provider,$id){
        if($this->session->userdata('image_upload_temppp') != ''){
            $this->db->set('img',$this->session->userdata('image_upload_temppp'));
        }
        $this->db->set('link',$url);
        $this->db->set('provider',$provider);

        if($id == 0){
            $this->db->insert('t_shareholders_mobile');
        } else {
            $this->db->where('id',$id);
            $this->db->update('t_shareholders_mobile');
        }


        $this->session->unset_userdata('image_upload_temppp');

        return $this->db->insert_id();
    }

    public function getAllUploads(){
        $query = $this->db->get('t_shareholders_mobile');
        return $query->result();
    }

    public function getRecord($id){
        $this->db->where('id',$id);
        $query = $this->db->get('t_shareholders_mobile');
        return $query->row();
    }
}
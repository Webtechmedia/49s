<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presenters_model extends CI_Model {

	public function insertNewpresenter($data)
	{
		$record = array(
			'header' 	=> $data['title'],
			'content' => $data['content'],
			'caption' => $data['caption'],
			'main_img' 	=> $data['image_path'],
			//'W_Game'	=> $data['game'],
			$data['game']	=> '1',
			'main_img'	=> $this->session->userdata('image_upload_temp_pr'),
			'thumb_img'	=> $this->session->userdata('image_upload_temp2_pr'),
			'main_video'	=> $this->session->userdata('video_upload_temp_pr'),
			'default'	=> isset($data['default']) ? $data['default'] : 0,
		);

		$this->db->insert('t_presenters', $record);

		$this->session->unset_userdata('video_upload_temp_pr');
		$this->session->unset_userdata('image_upload_temp_pr');
		$this->session->unset_userdata('image_upload_temp2_pr');

	}
	public function get_presenters(){

		$this->db->select('*');
		$this->db->from('t_presenters');
		$query = $this->db->get();
		return $query->result();

	}
	public function getpresenter($winner_id){

		$this->db->select('*');
		$this->db->from('t_presenters');
		$this->db->where('id',$winner_id);
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->row();
	}

	public function updatepresenter($winner_id,$data){


 		//reset all default prezenters to non default
		if( isset( $data['default'] ) ) {
			$this->db->set('default', 0);
			$this->db->update('t_presenters' );

		}

		if($data['image_path']!=''){
			$record = array(
					'header' 	=> $data['title'],
					'content' => $data['content'],
					'caption' => $data['caption'],
					'main_img' 	=> $data['image_path'],
					//'W_Game'	=> $data['game'],
					$data['game']	=> '1',
					'default'	=> isset($data['default']) ? $data['default'] : 0,
			);
		}else{
			$record = array(
					'header' 	=> $data['title'],
					'content' => $data['content'],
					'caption' => $data['caption'],
					//'main_img' 	=> $data['image_path'],
					//'W_Game'	=> $data['game'],
					$data['game']	=> '1',
					'default'	=> isset($data['default']) ? $data['default'] : 0,
			);
		}



		if( $this->session->userdata('image_upload_temp_pr') != '' ){
			$record['main_img'] = $this->session->userdata('image_upload_temp_pr');
		}
		if( $this->session->userdata('image_upload_temp2_pr') != '' ){
			$record['thumb_img'] = $this->session->userdata('image_upload_temp2_pr');
		}
		if( $this->session->userdata('video_upload_temp_pr') != '' ){
			$record['main_video'] = $this->session->userdata('video_upload_temp_pr');

		}
		$this->db->where('id',$winner_id);
		$this->db->update('t_presenters', $record);

		$this->session->unset_userdata('video_upload_temp_pr');
		$this->session->unset_userdata('image_upload_temp_pr');
		$this->session->unset_userdata('image_upload_temp2_pr');


	}

	public function delete_presenter($winner_id){
		$this->db->where('id', $winner_id);
		$this->db->delete('t_presenters');
	}


}











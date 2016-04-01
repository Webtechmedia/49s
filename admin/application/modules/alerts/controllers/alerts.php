<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Alerts extends CI_Controller
{

	function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Alerts';
		$this->load->model('Uploads_model');

		$data['records'] = $this->Uploads_model->getAllUploads();

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'alerts/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function save_image_video()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}

		$this->load->model('JsonOutput');
		$this->load->model('Uploads_model');
		if($this->session->userdata('image_upload_tempp') || $this->session->userdata('video_upload_temp') ){


			if(!$this->Uploads_model->is_reach_limit($this->input->post('type'))){
				$updated = $this->Uploads_model->save_in_db($this->input->post('url'));
				$this->JsonOutput->server_obj->success= true ;
				$this->JsonOutput->server_obj->user_msg = '';
				$this->JsonOutput->server_obj->error_msg = '';
				$this->JsonOutput->setBody = '';
				$this->JsonOutput->execute();
			} else {
				$this->JsonOutput->server_obj->success= false ;
				$this->JsonOutput->server_obj->user_msg = '';
				$this->JsonOutput->server_obj->error_msg = 'Too many assets for that type';
				$this->JsonOutput->setBody = '';
				$this->JsonOutput->execute();
			}
		}
	}

	function remove_content($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}

		$this->db->where('id',$id);
		$this->db->delete('t_alert');
		redirect(base_url('alerts'));

	}

	function prepare_image()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}

		$this->load->model('JsonOutput');

		$filename = './uploads_assets/';

		if (!file_exists($filename)) {
			mkdir($filename, 0777,true);
		} else {

		}

		$config['upload_path'] = $filename;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '100000';
		$config['max_width']  = '102400';
		$config['max_height']  = '34100';
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("image"))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->JsonOutput->server_obj->success = false ;
			$this->JsonOutput->server_obj->user_msg = '';
			$this->JsonOutput->server_obj->error_msg = $error;
			$this->JsonOutput->setBody('');
			$this->JsonOutput->execute();

		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$file_path =  $config['upload_path'] . $data['upload_data']['file_name'];
			$this->session->set_userdata('image_upload_tempp',$file_path);

			$this->JsonOutput->server_obj->success = true  ;
			$this->JsonOutput->server_obj->user_msg = '';
			$this->JsonOutput->server_obj->error_msg = '';
			$this->JsonOutput->setBody(base_url($file_path));
			$this->JsonOutput->execute();

		}
	}



}

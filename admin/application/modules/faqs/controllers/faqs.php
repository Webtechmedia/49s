<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends CI_Controller
{

	function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'FAQ';
		$this->load->model('Uploads_model');


		$data['records'] = $this->Uploads_model->getAllUploads();


		//$this->load->model('members_model');

		//$data['members'] = $this->members_model->getMembers($sortfield='U_Id', $order='asc',$per_page,$offset,$member_search);
		//$data['total_results'] =$this->members_model->get_row_count($member_search);


		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'faqs/content',$data);
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
		//if (!$this->tank_auth->is_logged_in()) {
		//    $this->Hack_try->report_url_request();
		//    $encoded_uri = preg_replace('"/"', '-', $this->uri->uri_string());
		//    redirect('/auth/login/'.$encoded_uri);
		//} else {
		$this->load->model('JsonOutput');
		$this->load->model('Uploads_model');


			if(!$this->Uploads_model->is_reach_limit($this->input->post('type'))){
				//var_dump('www');
				$updated = $this->Uploads_model->save_in_db($this->input->post('question'),$this->input->post('answer'));
				//if($updated > 0){
				$this->JsonOutput->server_obj->success= true ;
				$this->JsonOutput->server_obj->user_msg = '';
				$this->JsonOutput->server_obj->error_msg = '';
				$this->JsonOutput->setBody = '';
				$this->JsonOutput->execute();
				//} else {
				//    $this->JsonOutput->server_obj->success= false ;
				//    $this->JsonOutput->server_obj->user_msg = '';
				//    $this->JsonOutput->server_obj->error_msg = 'There is something wrong';
				//    $this->JsonOutput->setBody = '';
				//    $this->JsonOutput->execute();

				//}

			} else {
				$this->JsonOutput->server_obj->success= false ;
				$this->JsonOutput->server_obj->user_msg = '';
				$this->JsonOutput->server_obj->error_msg = 'Too many assets for that type';
				$this->JsonOutput->setBody = '';
				$this->JsonOutput->execute();
			}

	}

	function remove_content($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		//if (!$this->tank_auth->is_logged_in()) {
		//    $this->Hack_try->report_url_request();
		//    $encoded_uri = preg_replace('"/"', '-', $this->uri->uri_string());
		//    redirect('/auth/login/'.$encoded_uri);
		//} else {

		$this->db->where('id',$id);
		$this->db->delete('t_faq');
		redirect(base_url('faqs'));

		//}

	}



}

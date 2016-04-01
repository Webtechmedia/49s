<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Presenters extends CI_Controller
{


	public function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}

		$data['title'] = 'Presenters';

		$this->load->model('Presenters_model');
		$data['winners']=$this->Presenters_model->get_presenters();

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'presenters/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	public function addnewpresenter(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Add New Presenter';
		$this->template->add_js('js/tiny_mce/tiny_mce.js');
		$this->template->add_js('js/my_tiny_mce.js');
		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'presenters/addwinner',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();

	}


	function prepare_image()
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

		$filename = './uploads_assets/';

		if (!file_exists($filename)) {
			mkdir($filename, 0777,true);
		} else {

		}

		$config['upload_path'] = $filename;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '100000';
		$config['max_width']  = '31100';
		$config['max_height']  = '35900';
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("image_file"))
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
			$this->session->set_userdata('image_upload_temp_pr',$file_path);

			$this->JsonOutput->server_obj->success = true  ;
			$this->JsonOutput->server_obj->user_msg = '';
			$this->JsonOutput->server_obj->error_msg = '';
			$this->JsonOutput->setBody(base_url($file_path));
			$this->JsonOutput->execute();

		}



		//}
	}

	function prepare_image2()
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

		$filename = './uploads_assets/';

		if (!file_exists($filename)) {
			mkdir($filename, 0777,true);
		} else {

		}

		$config['upload_path'] = $filename;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '100000';
		$config['max_width']  = '31100';
		$config['max_height']  = '18900';
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("image_file2"))
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
			$this->session->set_userdata('image_upload_temp2_pr',$file_path);

			$this->JsonOutput->server_obj->success = true  ;
			$this->JsonOutput->server_obj->user_msg = '';
			$this->JsonOutput->server_obj->error_msg = '';
			$this->JsonOutput->setBody(base_url($file_path));
			$this->JsonOutput->execute();

		}



		//}
	}

	function prepare_video()
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

		$filename = './uploads_assets/';

		if (!file_exists($filename)) {
			mkdir($filename, 0777,true);
		} else {

		}


		$config['upload_path'] = $filename;
		$config['allowed_types'] = 'mp4';
		$config['max_size']	= '20000000';
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("video_file"))
		{
			//var_dump($this->upload->data());

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
			$this->session->set_userdata('video_upload_temp_pr',$file_path);

			$this->JsonOutput->server_obj->success = true  ;
			$this->JsonOutput->server_obj->user_msg = '';
			$this->JsonOutput->server_obj->error_msg = '';
			$this->JsonOutput->setBody(base_url($file_path));
			$this->JsonOutput->execute();

		}


		//}
	}

	public function insertNewpresenter(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->library('form_validation');


		//$this->form_validation->set_rules('admin_image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		//$this->form_validation->set_rules('image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		$this->form_validation->set_rules('title', 'Winners Title', 'trim|required|max_length[250]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|xss_clean');
		//$this->form_validation->set_rules('game', 'Game', 'trim|required|is_natural|xss_clean');


		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addnewpresenter();
		}
		else
		{
			$this->load->model('presenters_model');
			$this->presenters_model->insertNewpresenter($this->input->post());


			$this->session->set_flashdata('message', 'Presenter Added.');
			redirect('presenters/index');
		}
	}

	public function edit($winner_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('presenters_model');
		$data['winner']=$this->presenters_model->getpresenter($winner_id);

		$data['title'] = 'Add New Presenter';
		$this->template->add_js('js/tiny_mce/tiny_mce.js');
		$this->template->add_js('js/my_tiny_mce.js');
		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'presenters/editwinner',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	public function updatepresenter($winner_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->library('form_validation');


		$this->form_validation->set_rules('admin_image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		$this->form_validation->set_rules('image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		$this->form_validation->set_rules('title', 'Winners Title', 'trim|required|max_length[250]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|xss_clean');
		$this->form_validation->set_rules('default', 'Default', 'trim|xss_clean');
		//$this->form_validation->set_rules('game', 'Game', 'trim|required|is_natural|xss_clean');


		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($winner_id);
		}
		else
		{
			$this->load->model('presenters_model');
			$this->presenters_model->updatepresenter($winner_id,$this->input->post());
			$this->session->set_flashdata('message', 'Winner Updated.');
			redirect('presenters/index');
		}
	}
	public function deletepresenters($winner_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('presenters_model');
		$this->presenters_model->delete_presenter($winner_id);
		$this->session->set_flashdata('message', 'Presenters Deleted.');
		redirect('presenters/index');
	}

}

















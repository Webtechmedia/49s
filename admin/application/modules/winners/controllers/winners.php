<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Winners extends CI_Controller
{


	public function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}

		$data['title'] = 'Winners';

		$this->load->model('winners_model');
		$data['winners']=$this->winners_model->get_winners();

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'winners/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	public function addnewwinner(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Add New Winner';
		$this->template->add_js('js/tiny_mce/tiny_mce.js');
		$this->template->add_js('js/my_tiny_mce.js');
		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'winners/addwinner',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();

	}
	public function insertNewWinner(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->library('form_validation');


		$this->form_validation->set_rules('admin_image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		$this->form_validation->set_rules('image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		$this->form_validation->set_rules('title', 'Winners Title', 'trim|required|max_length[250]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|xss_clean');
		//$this->form_validation->set_rules('game', 'Game', 'trim|required|is_natural|xss_clean');


		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addnewwinner();
		}
		else
		{
			$this->load->model('winners_model');
			$this->winners_model->insertNewWinner($this->input->post());
			$this->session->set_flashdata('message', 'Winner Added.');
			redirect('winners/index');
		}
	}

	public function edit($winner_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('winners_model');
		$data['winner']=$this->winners_model->getWinner($winner_id);

		$data['title'] = 'Add New Winner';
		$this->template->add_js('js/tiny_mce/tiny_mce.js');
		$this->template->add_js('js/my_tiny_mce.js');
		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'winners/editwinner',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	public function updateWinner($winner_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->library('form_validation');


		$this->form_validation->set_rules('admin_image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		$this->form_validation->set_rules('image_path', 'Image Path', 'trim|max_length[300]|xss_clean');
		$this->form_validation->set_rules('title', 'Winners Title', 'trim|required|max_length[250]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|xss_clean');
		//$this->form_validation->set_rules('game', 'Game', 'trim|required|is_natural|xss_clean');


		$this->template->add_js('js/uploader.js');
		$this->template->add_js('js/jquery.form.min.js');

		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($winner_id);
		}
		else
		{
			$this->load->model('winners_model');
			$this->winners_model->updateWinner($winner_id,$this->input->post());
			$this->session->set_flashdata('message', 'Winner Updated.');
			redirect('winners/index');
		}
	}
	public function deleteWinner($winner_id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('winners_model');
		$this->winners_model->deleteWinner($winner_id);
		$this->session->set_flashdata('message', 'Winner Deleted.');
		redirect('winners/index');
	}

}

















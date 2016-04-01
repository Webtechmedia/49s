<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function index()
	{
		 if(!$this->tank_auth->is_logged_in()){
		 	redirect('auth/logout');
		 }

		$data['title'] = 'Dashboard';


		//$this->template->add_css('css/main.css');
		//$this->template->add_js('js/jquery.js');
		$this->load->model('dashboard_model');

		$data['members']=$this->dashboard_model->getLatestMembers();

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'dashboard/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	public function deleteMember(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->model('dashboard_model');
		if (is_numeric ($this->uri->segment(3)))  {
			$removeUser =$this->dashboard_model->removeMember($this->uri->segment(3));
			if($removeUser){
				$this->session->set_flashdata('message', 'Member deleted');
				redirect('/dashboard/');
			}else{
				$this->session->set_flashdata('error_message', 'Problem with member deletion !!!');
				redirect('/dashboard/');
			}
			$this->index();
		} else {
			$this->session->set_flashdata('error_message', 'Incorrect member id!!!');
			redirect('/dashboard/');
		}
	}
}

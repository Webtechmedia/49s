<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Aws\S3\S3Client;

class Shareholders extends CI_Controller
{

	function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Shareholders';
		$this->load->model('Uploads_model');


		$data['records'] = $this->Uploads_model->getAllUploads();

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'shareholders/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function change($id = 0)
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Shareholders';
		$this->load->model('Uploads_model');


		if($id > 0){
			$data['rec'] = $this->Uploads_model->getRecord($id);
		}

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'shareholders/add_edit',$data);
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


			if(!$this->Uploads_model->is_reach_limit($this->input->post('type')) || $this->input->post('id',0) > 0){
				$updated = $this->Uploads_model->save_in_db($this->input->post('url'),$this->input->post('provider'),$this->input->post('id',0));
                $this->session->unset_userdata('image_upload_temppp');
				
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



	function remove_content($id){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
        
        $this->db->where('id', $id);
        $query = $this->db->get('t_shareholders');
        $row = $query->row();

        //If this is an S3-stored resource, delete it from S3.

        if(strpos($row->url_path_thumb,0,4) == 'http')
        {
            $client = S3Client::factory();
            $client->deleteObjects([
                'Bucket' => '49suploadsassets',
                'Objects' => [
                    ['Key' => str_replace('https://49suploadsassets.s3.amazonaws.com/', '', $row->url_path_thumb)]
                ]
            ]);
        }

		$this->db->where('id',$id);
		$this->db->delete('t_shareholders');
		redirect(base_url('shareholders'));
	}

	function prepare_image()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
        
		$this->load->model('JsonOutput');

		$tempFile = $_FILES['image'];

        $client = S3Client::factory();
        $result = $client->putObject([
            'ACL' => 'public-read',
            'Bucket' => '49suploadsassets',
            'SourceFile' => $tempFile['tmp_name'],
            'ContentLength' => $tempFile['size'],
            'ContentType' => $tempFile['type'],
            'Key' => $tempFile['name']
        ]);

        if(!$result)
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
            $this->session->set_userdata('image_upload_temppp', $result['ObjectURL']);

			$this->JsonOutput->server_obj->success = true  ;
			$this->JsonOutput->server_obj->user_msg = '';
			$this->JsonOutput->server_obj->error_msg = '';
			$this->JsonOutput->setBody($result['ObjectURL']);
			$this->JsonOutput->execute();

		}
	}

}

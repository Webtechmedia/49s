<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Aws\S3\S3Client;

class Uploads extends CI_Controller
{

	function index()
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Uploads';

        $this->load->model('Uploads_model');

        $data['records'] = $this->Uploads_model->getAllUploads();


		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'uploads_main',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}


    function change($id=0)
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
        $data['title'] = 'Uploads';

        $this->load->model('Uploads_model');

        if($id > 0){
            $data['rec'] = $this->Uploads_model->getUpload($id);
        }


        $this->template->write_view('head', 'common/head',$data);
        $this->template->write_view('header', 'common/header',$data);
        $this->template->write_view('content', 'edit',$data);
        $this->template->write_view('footer', 'common/footer',$data);

        $this->template->set_master_template('templates/one_column_layout');
        $this->template->render();
    }

    function remove_content($id){
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}

            $this->db->where('id', $id);
            $query = $this->db->get('t_uploads');
            $row = $query->row();

            //If this is an S3-stored resource, delete it from S3.

            if(strpos($row->url_path_thumb,0,4) == 'http')
            {
                $client = S3Client::factory();
                $client->deleteObjects([
                    'Bucket' => '49suploadsassets',
                    'Objects' => [
                        ['Key' => str_replace('http://assets.49s.co.uk/', '', $row->url_path_thumb)]
                    ]
                ]);
            }

            $this->db->where('id',$id);
            $this->db->delete('t_uploads');
            redirect(base_url('uploads'));

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
        } else
        {
                    $this->session->set_userdata('image_upload_temp', $result['ObjectURL']);
                    $this->JsonOutput->server_obj->success = true  ;
                    $this->JsonOutput->server_obj->user_msg = '';
                    $this->JsonOutput->server_obj->error_msg = '';
                    $this->JsonOutput->setBody(str_replace('https://49suploadsassets.s3.amazonaws.com','http://assets.49s.co.uk',$result['ObjectURL']));
                    $this->JsonOutput->execute();
        }

    }

    function prepare_video()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}

        $this->load->model('JsonOutput');

        $tempFile = $_FILES['video'];

        $client = S3Client::factory();
        $result = $client->putObject([
            'ACL' => 'public-read',
            'Bucket' => '49suploadsassets',
            'SourceFile' => $tempFile['tmp_name'],
            'ContentLength' => $tempFile['size'],
            'ContentType' => $tempFile['type'],
            'Key' => $tempFile['name']
        ]);

        if (!$result)
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

            $this->session->set_userdata('video_upload_temp', $result['ObjectURL']);

            $this->JsonOutput->server_obj->success = true  ;
            $this->JsonOutput->server_obj->user_msg = '';
            $this->JsonOutput->server_obj->error_msg = '';
            $this->JsonOutput->setBody(str_replace('https://49suploadsassets.s3.amazonaws.com','http://assets.49s.co.uk',$result['ObjectURL']));
            $this->JsonOutput->execute();

        }


        //}
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
                    $check_video = false;

                   // var_dump(  $this->input->post() );

                   // var_dump(print_r($this->session->userdata));


                    if(strlen($this->session->userdata('video_upload_temp') ) > 6 ){
                        $check_video = true;
                    }


                    if(!$this->Uploads_model->is_reach_limit($this->input->post('type'),$check_video)   || $this->input->post('id',0) > 0 ){
                        //var_dump('www');
                        $updated = $this->Uploads_model->save_in_db($this->input->post('type'),$this->input->post('url',''),$this->input->post('overlay_textet',''),$this->input->post('id',0));
                        $this->session->unset_userdata('image_upload_temp');
                        $this->session->unset_userdata('video_upload_temp');
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





        //}
    }


    function do_upload()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['encrypt_name']  = true;
        $config['remove_spaces']  = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $data);
        }
    }


}

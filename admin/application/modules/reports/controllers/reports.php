<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Aws\S3\S3Client;

class Reports extends CI_Controller
{
    private $client;

    function __construct()
    {
        $this->client = S3Client::factory();
        $this->client->registerStreamWrapper();
        parent::__construct();
    }

    function index()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
        $data['title'] = 'Reports';


        $this->template->write_view('head', 'common/head',$data);
        $this->template->write_view('header', 'common/header',$data);
        $this->template->write_view('content', 'reports/content',$data);
        $this->template->write_view('footer', 'common/footer',$data);

        $this->template->set_master_template('templates/one_column_layout');
        $this->template->render();
    }

    function users()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');

        $data['title'] = 'Reports';
        $data['user_statistics'] = $this->Reports_model->get_users_statistic();

        $this->load->view('reports/user_statistic',$data);

    }


    function horse()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');

        $data['title'] = 'Reports';
        $data['user_statistics'] = $this->Reports_model->get_users_statistic();

        $this->load->view('reports/horse_statistic',$data);

    }

    function horse_statistic_data()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');
        $this->load->library('form_validation');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $data = array();

        $this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
        $this->form_validation->set_rules('to', 'to', 'required|min_length[7]');

        if ($this->form_validation->run() == TRUE) {
        	
            $addon_where = '';

            if( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'true' ){
                //all true
            	$addon_where='(t_meeting.name = "Portman Park" OR t_meeting.name = "Sprintvalley" OR t_meeting.name = "Steepledowns")';
            } elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'false' ){
                //all false
            	$addon_where = 't_meeting.name != "Portman Park" AND t_meeting.name != "Sprintvalley" AND t_meeting.name != "Steepledowns"';
            }elseif( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'false' ){
                //first true
            	$addon_where = 't_meeting.name = "Portman Park"';
            }elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'false' ){
                //second true
            	$addon_where = 't_meeting.name = "Sprintvalley"';
            }elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'true' ){
                //third true
            	$addon_where = 't_meeting.name = "Steepledowns"';
            }elseif( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'false' ){
                //first and second true
            	$addon_where = '(t_meeting.name = "Portman Park" OR t_meeting.name = "Sprintvalley")';
            }elseif( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'true' ){
                //first and third true
            	$addon_where = '(t_meeting.name = "Portman Park" OR t_meeting.name = "Steepledowns")';
            }elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'true' ){
                //second and third true
            	$addon_where = '(t_meeting.name = "Sprintvalley" OR t_meeting.name = "Steepledowns")';
            }else {
                $addon_where = '';
            }

           

            
            
            
            $race_type = 'HR';
            $date_from = $this->input->post('from');
            $date_from = DateTime::createFromFormat('Y-m-d', $date_from);
            $date_from = $date_from->format('Y-m-d');

            $date_to = $this->input->post('to');
            $date_to = DateTime::createFromFormat('Y-m-d', $date_to);
            $date_to = $date_to->format('Y-m-d');


            $data['data_report'] = $this->Reports_model->get_report_for_dog_and_horse($race_type,$date_from,$date_to,$addon_where);
            //var_dump($data['data_report']);
        } else {
            $val_errors = validation_errors();
            if($val_errors != ''){
                $data['please_correct_errors'] = validation_errors();
            }
        }
        $data['title'] = 'Reports';
        $data['user_statistics'] = $this->Reports_model->get_users_statistic();

        $this->load->view('reports/horse_statistic_data',$data);
    }

    function dog()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');

        $data['title'] = 'Reports';
        $data['user_statistics'] = $this->Reports_model->get_users_statistic();

        $this->load->view('reports/dog_statistic',$data);

    }


    function dog_statistic_data()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');
        $this->load->library('form_validation');

        $json_input = trim(file_get_contents('php://input'));
        $_POST = json_decode($json_input,true);

        $data = array();

        $this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
        $this->form_validation->set_rules('to', 'to', 'required|min_length[7]');

        if ($this->form_validation->run() == TRUE) {

            $addon_where = '';

            if( $this->input->post('brush','false') == 'true' && $this->input->post('mill','false') == 'true' ){
                $addon_where = '(t_meeting.name like "Brushwood"  OR t_meeting.name like "Millersfield")';
            } elseif($this->input->post('brush','false') == 'true' && $this->input->post('mill','false') == 'false') {
                $addon_where = 't_meeting.name like "Brushwood"';
            } elseif($this->input->post('brush','false') == 'false' && $this->input->post('mill','false') == 'true'){
            	$addon_where = 't_meeting.name like "Millersfield"';
            }else{
            	$addon_where = 't_meeting.name not like "Brushwood"  AND t_meeting.name not like "Millersfield"';
            }

            $race_type = 'DG';
            $date_from = $this->input->post('from');
            $date_from = DateTime::createFromFormat('Y-m-d', $date_from);
            $date_from = $date_from->format('Y-m-d');

            $date_to = $this->input->post('to');
            $date_to = DateTime::createFromFormat('Y-m-d', $date_to);
            $date_to = $date_to->format('Y-m-d');

            $data['data_report'] = $this->Reports_model->get_report_for_dog_and_horse($race_type,$date_from,$date_to,$addon_where);
          
        } else {
            $val_errors = validation_errors();
            if($val_errors != ''){
                $data['please_correct_errors'] = validation_errors();
            }
        }
        //$data['title'] = 'Reports';
        //$data['user_statistics'] = $this->Reports_model->get_users_statistic();

        $this->load->view('reports/dog_statistic_data',$data);
    }

    function users_download()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');
        $data['table'] = $this->Reports_model->object_to_array($this->Reports_model->get_users_statistic());

        //var_dump($data);

        function cleanData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        // file name for download
        $filename = "website_data_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data as $row) {
            if(!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }
            array_walk($row, 'cleanData');
            echo implode("\t", array_values($row)) . "\n";
        }


    }
function miss_download()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');
        $data['table'] = $this->Reports_model->object_to_array($this->Reports_model->get_miss_spread());

      //  var_dump($data['table']);

        function cleanData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        // file name for download
        $filename = "website_data_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data['table'] as $row) {
            if(!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }
			
            array_walk($row, 'cleanData');
            $value = implode("\t", array_values($row)) . "\n";
        	echo strval($value);
		}


    }
    function vgr_race_download()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');
        $this->load->library('form_validation');
 
        $data = array();
        
        
        $data = array();
        
        $this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
        $this->form_validation->set_rules('to', 'to', 'required|min_length[7]');
        
        if ($this->form_validation->run() == TRUE) {
        
        	$addon_where = '';
        
        	if( $this->input->post('brush','false') == 'true' && $this->input->post('mill','false') == 'true' ){
        		$addon_where = '(t_meeting.name like "Brushwood"  OR t_meeting.name like "Millersfield")';
        	} elseif($this->input->post('brush','false') == 'true' && $this->input->post('mill','false') == 'false') {
        		$addon_where = 't_meeting.name like "Brushwood"';
        	} elseif($this->input->post('brush','false') == 'false' && $this->input->post('mill','false') == 'true'){
        		$addon_where = 't_meeting.name like "Millersfield"';
        	}else{
        		$addon_where = 't_meeting.name not like "Brushwood"  AND t_meeting.name not like "Millersfield"';
        	}
        
        	$race_type = 'DG';
        	$date_from = $this->input->post('from');
        	$date_from = DateTime::createFromFormat('Y-m-d', $date_from);
        	$date_from = $date_from->format('Y-m-d');
        
        	$date_to = $this->input->post('to');
        	$date_to = DateTime::createFromFormat('Y-m-d', $date_to);
        	$date_to = $date_to->format('Y-m-d');
        
        	$data['table'] = $this->Reports_model->get_report_for_dog_and_horse($race_type,$date_from,$date_to,$addon_where);
        
        	$this->load->library('excel');
        	//activate worksheet number 1
        	$this->excel->setActiveSheetIndex(0);
        	//name the worksheet
        	$this->excel->getActiveSheet()->setTitle('VGR statistics.');
        	//set cell A1 content with some text
        	
        	$row_index = 2;
        	
        	$this->excel->getActiveSheet()->setCellValue('A'.($row_index-1), 'Date');
        	$this->excel->getActiveSheet()->setCellValue('B'.($row_index-1), 'Time');
        	$this->excel->getActiveSheet()->setCellValue('C'.($row_index-1), 'Track');
        	$this->excel->getActiveSheet()->setCellValue('D'.($row_index-1), 'Runner name');
        	$this->excel->getActiveSheet()->setCellValue('E'.($row_index-1), 'Runner number');
        	$this->excel->getActiveSheet()->setCellValue('F'.($row_index-1), 'Odds');
        	$this->excel->getActiveSheet()->setCellValue('G'.($row_index-1), 'Finish place');
        	$this->excel->getActiveSheet()->setCellValue('H'.($row_index-1), 'Favourite');
        	$this->excel->getActiveSheet()->setCellValue('I'.($row_index-1), 'F/C Amount');
        	$this->excel->getActiveSheet()->setCellValue('J'.($row_index-1), 'T/C Amount');
         
        	foreach($data['table'] as $row){
        		$this->excel->getActiveSheet()->setCellValue('A'.$row_index, $row->date);
        		$this->excel->getActiveSheet()->setCellValue('B'.$row_index, $row->time);
        		$this->excel->getActiveSheet()->setCellValue('C'.$row_index, $row->track);
        		$this->excel->getActiveSheet()->setCellValue('D'.$row_index, $row->runner_name);
        		$this->excel->getActiveSheet()->setCellValue('E'.$row_index, $row->runner_number);
        		$this->excel->getActiveSheet()->setCellValue('F'.$row_index, $row->odds);
        		$this->excel->getActiveSheet()->setCellValue('G'.$row_index, $row->finish_place);
        	
        		$this->excel->getActiveSheet()->setCellValue('H'.$row_index, $row->favourite_or_second_favourite);
        		$this->excel->getActiveSheet()->setCellValue('I'.$row_index, $row->f_c_amount);
        		$this->excel->getActiveSheet()->setCellValue('J'.$row_index, $row->t_c_amount);
        		$row_index++;
        	}

        	$filename='raports.xls'; 
        	header('Content-Type: application/vnd.ms-excel'); //mime type
        	header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        	header('Cache-Control: max-age=0'); 

        	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        	//$objWriter->save('./uploads_assets/raports.xls');
                $objWriter->save('s3://49suploadsassets/reports.xls');
                $this->client->putObjectAcl([
                   'ACL' => 'public-read',
                   'Bucket' => '49suploadsassets',
                   'Key' => 'reports.xls']);
        	 
        	//echo "./uploads_assets/raports.xls";
                echo 'https://s3-eu-west-1.amazonaws.com/49suploadsassets/reports.xls';
        	
        } else {
        	var_dump( validation_errors()  );
        }
    }

    function vhr_race_download()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$this->load->model('Reports_model');
    	$this->load->library('form_validation');
    
    	$data = array();
    
    
    	$data = array();
    
    	$this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
    	$this->form_validation->set_rules('to', 'to', 'required|min_length[7]');
    
    	if ($this->form_validation->run() == TRUE) {
    
            $addon_where = '';

            if( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'true' ){
                //all true
            	$addon_where='(t_meeting.name = "Portman Park" OR t_meeting.name = "Sprintvalley" OR t_meeting.name = "Steepledowns")';
            } elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'false' ){
                //all false
            	$addon_where = 't_meeting.name != "Portman Park" AND t_meeting.name != "Sprintvalley" AND t_meeting.name != "Steepledowns"';
            }elseif( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'false' ){
                //first true
            	$addon_where = 't_meeting.name = "Portman Park"';
            }elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'false' ){
                //second true
            	$addon_where = 't_meeting.name = "Sprintvalley"';
            }elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'true' ){
                //third true
            	$addon_where = 't_meeting.name = "Steepledowns"';
            }elseif( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'false' ){
                //first and second true
            	$addon_where = '(t_meeting.name = "Portman Park" OR t_meeting.name = "Sprintvalley")';
            }elseif( $this->input->post('portman_park','false') == 'true' && $this->input->post('sprintvalley','false') == 'false' &&$this->input->post('steepledowns','false') == 'true' ){
                //first and third true
            	$addon_where = '(t_meeting.name = "Portman Park" OR t_meeting.name = "Steepledowns")';
            }elseif( $this->input->post('portman_park','false') == 'false' && $this->input->post('sprintvalley','false') == 'true' &&$this->input->post('steepledowns','false') == 'true' ){
                //second and third true
            	$addon_where = '(t_meeting.name = "Sprintvalley" OR t_meeting.name = "Steepledowns")';
            }else {
                $addon_where = '';
            }

            $race_type = 'HR';
            $date_from = $this->input->post('from');
            $date_from = DateTime::createFromFormat('Y-m-d', $date_from);
            $date_from = $date_from->format('Y-m-d');

            $date_to = $this->input->post('to');
            $date_to = DateTime::createFromFormat('Y-m-d', $date_to);
            $date_to = $date_to->format('Y-m-d');

            $data['table'] = $this->Reports_model->get_report_for_dog_and_horse($race_type,$date_from,$date_to,$addon_where);
    
    		$this->load->library('excel');
    		//activate worksheet number 1
    		$this->excel->setActiveSheetIndex(0);
    		//name the worksheet
    		$this->excel->getActiveSheet()->setTitle('VGR statistics.');
    		//set cell A1 content with some text
    		 
    		$row_index = 2;
    		 
    		$this->excel->getActiveSheet()->setCellValue('A'.($row_index-1), 'Date');
    		$this->excel->getActiveSheet()->setCellValue('B'.($row_index-1), 'Time');
    		$this->excel->getActiveSheet()->setCellValue('C'.($row_index-1), 'Track');
    		$this->excel->getActiveSheet()->setCellValue('D'.($row_index-1), 'Runner name');
    		$this->excel->getActiveSheet()->setCellValue('E'.($row_index-1), 'Runner number');
    		$this->excel->getActiveSheet()->setCellValue('F'.($row_index-1), 'Odds');
    		$this->excel->getActiveSheet()->setCellValue('G'.($row_index-1), 'Finish place');
    		$this->excel->getActiveSheet()->setCellValue('H'.($row_index-1), 'Favourite');
    		$this->excel->getActiveSheet()->setCellValue('I'.($row_index-1), 'F/C Amount');
    		$this->excel->getActiveSheet()->setCellValue('J'.($row_index-1), 'T/C Amount');
    		 
    		foreach($data['table'] as $row){
    			$this->excel->getActiveSheet()->setCellValue('A'.$row_index, $row->date);
    			$this->excel->getActiveSheet()->setCellValue('B'.$row_index, $row->time);
    			$this->excel->getActiveSheet()->setCellValue('C'.$row_index, $row->track);
    			$this->excel->getActiveSheet()->setCellValue('D'.$row_index, $row->runner_name);
    			$this->excel->getActiveSheet()->setCellValue('E'.$row_index, $row->runner_number);
    			$this->excel->getActiveSheet()->setCellValue('F'.$row_index, $row->odds);
    			$this->excel->getActiveSheet()->setCellValue('G'.$row_index, $row->finish_place);
    			 
    			$this->excel->getActiveSheet()->setCellValue('H'.$row_index, $row->favourite_or_second_favourite);
    			$this->excel->getActiveSheet()->setCellValue('I'.$row_index, $row->f_c_amount);
    			$this->excel->getActiveSheet()->setCellValue('J'.$row_index, $row->t_c_amount);
    			$row_index++;
    		}
    
    		$filename='raports.xls';
    		header('Content-Type: application/vnd.ms-excel'); 
    		header('Content-Disposition: attachment;filename="'.$filename.'"');
    		header('Cache-Control: max-age=0');
    
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//$objWriter->save('./uploads_assets/raports.xls');
                $objWriter->save('s3://49suploadsassets/reports.xls');
                $this->client->putObjectAcl([
                   'ACL' => 'public-read',
                   'Bucket' => '49suploadsassets',
                   'Key' => 'reports.xls']);

                //echo "./uploads_assets/raports.xls";
                echo 'https://s3-eu-west-1.amazonaws.com/49suploadsassets/reports.xls';
    		 
    	} else {
    		var_dump( validation_errors()  );
    	}
    }
    
    


    function draw_daily()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	 
    	$this->load->view('reports/daily_draw_statistic');
    
    }


    function get_daily_statistic_data()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$this->load->model('Reports_model');
    	$this->load->library('form_validation');
    	
    	
    	$json_input = trim(file_get_contents('php://input'));
    	$_POST = json_decode($json_input,true);
    	
    	$data = array();
    	
    	$this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
    	$this->form_validation->set_rules('to', 'to', 'required|min_length[7]');
     
    	if ($this->form_validation->run() == TRUE) {
    		
    		$game_type = $this->input->post('game_type');
    		$date_from = $this->input->post('from');
    		$date_from = DateTime::createFromFormat('Y-m-d', $date_from);
    		$date_from = $date_from->format('Y-m-d');
    		
    		$date_to = $this->input->post('to');
    		$date_to = DateTime::createFromFormat('Y-m-d', $date_to);
    		$date_to = $date_to->format('Y-m-d');
    		
    		
    		 
			
    		
    		$results_calendar=$this->prepare_calendar($date_from,$date_to);
    		
    		
    		
    	 
    		
    		
    		
    		
    		
    		
    		
    		echo '<table class="table table-striped table-bordered table-condensed table-hover">
    				<thead>
						<tr>
                        	<th>Date</th>
                        	<th>MILLERSFIELD</th>
                        	<th>BRUSHWOOD</th>
                        	<th>VGR Total</th>
                        	<th>PORTMAN PARK</th>
                        	<th>STEEPLEDOWNS</th>
                        	<th>SPRINT VALLEY</th>
                        	<th>VHR Total</th>
                        	<th>Rapido</th>
                    	</tr>
					</thead>
					<tbody>
    		';
    		
    		
    		
    		
    		
    		
    		
    		$processedDate=0;
    		
    		$portsmanParkWeekly = 0;
    		$steepledownsWeekly = 0;
    		$sprintValleyWeekly = 0;
    		$millersfieldWeekly = 0;
    	 	$bruchwoodWeekly = 0;
    		$rapidoWeekly = 0;
    		$vhrTotalWeekly = 0;
    	 	$vgrTotalWeekly = 0;
    	 	
    	 	$portsmanParkMonthly = 0;
    		$steepledownsMonthly = 0;
    		$sprintValleyMonthly = 0;
    		$millersfieldMonthly = 0;
    	 	$bruchwoodMonthly = 0;
    		$rapidoMonthly = 0;
    		$vhrTotalMonthly = 0;
    	 	$vgrTotalMonthly = 0;
    	 	
    	 	$portsmanParkYearTotal = 0;
    		$steepledownsYearTotal = 0;
    		$sprintValleyYearTotal = 0;
    		$millersfieldYearTotal = 0;
    	 	$bruchwoodYearTotal = 0;
    		$rapidoYearTotal = 0;
    		$vhrYearTotal = 0;
    	 	$vgrYearTotal = 0;	
    	 	
    	 	$portsmanParkGrandTotal = 0;
    		$steepledownsGrandTotal = 0;
    		$sprintValleyGrandTotal = 0;
    		$millersfieldGrandTotal = 0;
    	 	$bruchwoodGrandTotal = 0;
    		$rapidoGrandTotal = 0;
    		$vhrGrandTotal = 0;
    	 	$vgrGrandTotal = 0;	
    	 				
    		foreach($results_calendar as $yearKey => $yearValue){
    		
    			foreach ($yearValue as $monthKey => $monthValue){
    				
    				foreach ($monthValue as $dayKey =>$dayValue){
    				
    				 	$processedDate=$yearKey.'-'.$monthKey.'-'.sprintf('%02d', $dayKey);
    				 	
    					$vhr_events_number = $this->Reports_model->get_race_events_number_between_dates('HR',$processedDate,$processedDate);
    					$portsmanPark = 0;
    					$steepledowns = 0;
    					$sprintValley = 0;
    					$vhrTotal = 0;
    					if(!empty($vhr_events_number)){
    						foreach ($vhr_events_number as $result){
    							if($result->name=='Portman Park'){ $portsmanPark=$result->races; }
    							if($result->name=='SprintValley' || $result->name=='Sprint Valley'){ $sprintValley = $result->races; }
    							if($result->name=='Steepledowns'){ $steepledowns=$result->races; }
    							$vhrTotal = $portsmanPark+$sprintValley+$steepledowns;
    						}
    					} 
    				
 						$vgr_events_number = $this->Reports_model->get_race_events_number_between_dates('DG',$processedDate,$processedDate);
    	 				$millersfield = 0;
    	 				$bruchwood = 0;
    	 				$vgrTotal = 0;
    	 				if(!empty($vgr_events_number)){
    						foreach ($vgr_events_number as $result){
    							if($result->name=='Millersfield'){ $millersfield=$result->races; }
    							if($result->name=='Brushwood'){ $bruchwood=$result->races; }
    							$vgrTotal = $millersfield+$bruchwood;
    						}
    					} 
    	 
    					$rapido_events_number = $this->Reports_model->get_rapido_events_number_between_dates('ra',$processedDate,$processedDate);
    				 	$rapido = 0;
    				 	if(!empty($rapido_events_number)){
    						$rapido = $rapido_events_number[0]->draws;
    					} 
    				
    					echo '<tr><td>'.$processedDate.'</td><td>'.$millersfield.'</td><td>'.$bruchwood.'</td><td>'.$vgrTotal.'</td><td>'.$portsmanPark.'</td><td>'.$steepledowns.'</td><td>'.$sprintValley.'</td><td>'.$vhrTotal.'</td><td>'.$rapido.'</td></tr>';
    				
    					$portsmanParkWeekly = $portsmanParkWeekly+$portsmanPark;
    					$steepledownsWeekly = $steepledownsWeekly+$steepledowns;
    					$sprintValleyWeekly = $sprintValleyWeekly+$sprintValley;
    					$vhrTotalWeekly = $portsmanParkWeekly+$steepledownsWeekly+$sprintValleyWeekly;
    					$millersfieldWeekly = $millersfieldWeekly+$millersfield;
    	 				$bruchwoodWeekly = $bruchwoodWeekly+$bruchwood;
    	 				$vgrTotalWeekly = $millersfieldWeekly+$bruchwoodWeekly;
    					$rapidoWeekly = $rapidoWeekly+$rapido;
    				
						$portsmanParkMonthly = $portsmanParkMonthly+$portsmanPark;
    					$steepledownsMonthly = $steepledownsMonthly+$steepledowns;
    					$sprintValleyMonthly = $sprintValleyMonthly+$sprintValley;
    					$millersfieldMonthly = $millersfieldMonthly+$millersfield;
    	 				$bruchwoodMonthly = $bruchwoodMonthly+$bruchwood;
    					$rapidoMonthly = $rapidoMonthly+$rapido;
    					$vhrTotalMonthly = $portsmanParkMonthly+$steepledownsMonthly+$sprintValleyMonthly;
    	 				$vgrTotalMonthly = $bruchwoodMonthly+$millersfieldMonthly;	
    				
    					$portsmanParkYearTotal = $portsmanParkYearTotal+$portsmanPark;
    					$steepledownsYearTotal = $steepledownsYearTotal+$steepledowns;
    					$sprintValleyYearTotal = $sprintValleyYearTotal+$sprintValley;
    					$millersfieldYearTotal = $millersfieldYearTotal+$millersfield;
    	 				$bruchwoodYearTotal = $bruchwoodYearTotal+$bruchwood;
    					$rapidoYearTotal = $rapidoYearTotal+$rapido;
    					$vhrYearTotal = $portsmanParkYearTotal+$steepledownsYearTotal+$sprintValleyYearTotal;
    	 				$vgrYearTotal = $bruchwoodYearTotal+$millersfieldYearTotal;	
    	 				
    	 				$portsmanParkGrandTotal =  $portsmanParkGrandTotal+$portsmanPark;
    					$steepledownsGrandTotal =  $steepledownsGrandTotal+$steepledowns;
    					$sprintValleyGrandTotal =  $sprintValleyGrandTotal+$sprintValley;
    					$millersfieldGrandTotal =  $millersfieldGrandTotal+$millersfield;
    	 				$bruchwoodGrandTotal =  $bruchwoodGrandTotal+$bruchwood;
    					$rapidoGrandTotal =  $rapidoGrandTotal+$rapido;
    					$vhrGrandTotal =  $portsmanParkGrandTotal+$steepledownsGrandTotal+$sprintValleyGrandTotal;
    	 				$vgrGrandTotal =  $millersfieldGrandTotal+$bruchwoodGrandTotal;
    				
    				
    					if($dayValue=='Sat'){
							echo '<tr class="danger"><th>Week Total<br/><small>(end of Sat)</small></th><th>'.$millersfieldWeekly.'</th><th>'.$bruchwoodWeekly.'</th><th>'.$vgrTotalWeekly.'</th><th>'.$portsmanParkWeekly.'</th><th>'.$steepledownsWeekly.'</th><th>'.$sprintValleyWeekly.'</th><th>'.$vhrTotalWeekly.'</th><th>'.$rapidoWeekly.'</th></tr>';
   							$portsmanParkWeekly = 0;
    						$steepledownsWeekly = 0;
    						$sprintValleyWeekly = 0;
    						$vhrTotalWeekly=0;
    						$millersfieldWeekly = 0;
    	 					$bruchwoodWeekly = 0;
    	 					$vgrTotalWeekly =0;
    						$rapidoWeekly = 0;
						}
						

						
						
    				}
    				
    			 	//check if end of the month
    			 	if($processedDate == date("Y-m-t", strtotime($processedDate))){
    					echo '<tr class="info"><th>Month Total</th><th>'.$millersfieldMonthly.'</th><th>'.$bruchwoodMonthly.'</th><th>'.$vgrTotalMonthly.'</th><th>'.$portsmanParkMonthly.'</th><th>'.$steepledownsMonthly.'</th><th>'.$sprintValleyMonthly.'</th><th>'.$vhrTotalMonthly.'</th><th>'.$rapidoMonthly.'</th></tr>';
    			 		$portsmanParkMonthly = 0;
    					$steepledownsMonthly = 0;
    					$sprintValleyMonthly = 0;
    					$millersfieldMonthly = 0;
    	 				$bruchwoodMonthly = 0;
    					$rapidoMonthly = 0;
    					$vhrTotalMonthly = 0;
    	 				$vgrTotalMonthly = 0;	
    			 	}
    			
    			}
    	
    	
    			//check if last day of the year
    			$dateParts=explode('-',$processedDate);
    			
    			if($dateParts[1]=='12' && $dateParts[2]=='31'){
    	
    		    	echo '<tr class="success"><th>Year Total</th><th>'.$millersfieldYearTotal.'</th><th>'.$bruchwoodYearTotal.'</th><th>'.$vgrYearTotal.'</th><th>'.$portsmanParkYearTotal.'</th><th>'.$steepledownsYearTotal.'</th><th>'.$sprintValleyYearTotal.'</th><th>'.$vhrYearTotal.'</th><th>'.$rapidoYearTotal.'</th></tr>';
    		    	$portsmanParkYearTotal = 0;
    				$steepledownsYearTotal = 0;
    				$sprintValleyYearTotal = 0;
    				$millersfieldYearTotal = 0;
    	 			$bruchwoodYearTotal = 0;
    				$rapidoYearTotal = 0;
    				$vhrYearTotal = 0;
    	 			$vgrYearTotal = 0;	
    			}

    		
    		}
    		
    		
   		    echo '<tr class=" " style="background-color:#d9b38c"><th>Grand Total</th><th>'.$millersfieldGrandTotal.'</th><th>'.$bruchwoodGrandTotal.'</th><th>'.$vgrGrandTotal.'</th><th>'.$portsmanParkGrandTotal.'</th><th>'.$steepledownsGrandTotal.'</th><th>'.$sprintValleyGrandTotal.'</th><th>'.$vhrGrandTotal.'</th><th>'.$rapidoGrandTotal.'</th></tr>';
    		
    		$portsmanParkGrandTotal = 0;
    		$steepledownsGrandTotal = 0;
    		$sprintValleyGrandTotal = 0;
    		$millersfieldGrandTotal = 0;
    	 	$bruchwoodGrandTotal = 0;
    		$rapidoGrandTotal = 0;
    		$vhrGrandTotal = 0;
    	 	$vgrGrandTotal = 0;	
    		
    		echo '
    			</tbody>
    		</table>';
    		
    		
    		$this->load->view('reports/daily_statistic_view',$data);
    		 
    	}else {
    		var_dump( validation_errors()  );
    	}
    	 
    }
    
    private function prepare_calendar($start_date,$end_date){
    
    	$begin = new DateTime( $start_date );
    	$end = new DateTime( $end_date);
    	$end->add(new DateInterval('P1D')); //Add 1 day to include the end date as a day
    	$interval = new DateInterval('P1D'); 
    	$period = new DatePeriod($begin, $interval, $end);
   	 	$aResult = array();

    	foreach ( $period as $dt )
    	{
    	    $aResult[$dt->format('Y')][$dt->format('m')][$dt->format('j')] = $dt->format('D');
    	}

    	return $aResult;
    
    }




    public function daily_download(){
    	
      	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$this->load->model('Reports_model');
    	$this->load->library('form_validation');
    
    	$data = array();
   
    	$this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
    	$this->form_validation->set_rules('to', 'to', 'required|min_length[7]');
     
    	if ($this->form_validation->run() == TRUE) {
    
           $data['table']=array();
           $row = new stdClass();

           
            $date_from = $this->input->post('from');
            $date_from = DateTime::createFromFormat('Y-m-d', $date_from);
            $date_from = $date_from->format('Y-m-d');

            $date_to = $this->input->post('to');
            $date_to = DateTime::createFromFormat('Y-m-d', $date_to);
            $date_to = $date_to->format('Y-m-d');

        
    		$results_calendar=$this->prepare_calendar($date_from,$date_to);
    		
    		$processedDate=0;
    		
    		$portsmanParkWeekly = 0;
    		$steepledownsWeekly = 0;
    		$sprintValleyWeekly = 0;
    		$millersfieldWeekly = 0;
    	 	$bruchwoodWeekly = 0;
    		$rapidoWeekly = 0;
    		$vhrTotalWeekly = 0;
    	 	$vgrTotalWeekly = 0;
    	 	
    	 	$portsmanParkMonthly = 0;
    		$steepledownsMonthly = 0;
    		$sprintValleyMonthly = 0;
    		$millersfieldMonthly = 0;
    	 	$bruchwoodMonthly = 0;
    		$rapidoMonthly = 0;
    		$vhrTotalMonthly = 0;
    	 	$vgrTotalMonthly = 0;
    	 	
    	 	$portsmanParkYearTotal = 0;
    		$steepledownsYearTotal = 0;
    		$sprintValleyYearTotal = 0;
    		$millersfieldYearTotal = 0;
    	 	$bruchwoodYearTotal = 0;
    		$rapidoYearTotal = 0;
    		$vhrYearTotal = 0;
    	 	$vgrYearTotal = 0;	
    	 	
    	 	$portsmanParkGrandTotal = 0;
    		$steepledownsGrandTotal = 0;
    		$sprintValleyGrandTotal = 0;
    		$millersfieldGrandTotal = 0;
    	 	$bruchwoodGrandTotal = 0;
    		$rapidoGrandTotal = 0;
    		$vhrGrandTotal = 0;
    	 	$vgrGrandTotal = 0;	
    	 				
    		foreach($results_calendar as $yearKey => $yearValue){
    		
    			foreach ($yearValue as $monthKey => $monthValue){
    				
    				foreach ($monthValue as $dayKey =>$dayValue){
    				
    				 	$processedDate=$yearKey.'-'.$monthKey.'-'.sprintf('%02d', $dayKey);
    				 	
    					$vhr_events_number = $this->Reports_model->get_race_events_number_between_dates('HR',$processedDate,$processedDate);
    					$portsmanPark = 0;
    					$steepledowns = 0;
    					$sprintValley = 0;
    					$vhrTotal = 0;
    					if(!empty($vhr_events_number)){
    						foreach ($vhr_events_number as $result){
    							if($result->name=='Portman Park'){ $portsmanPark=$result->races; }
    							if($result->name=='SprintValley' || $result->name=='Sprint Valley'){ $sprintValley = $result->races; }
    							if($result->name=='Steepledowns'){ $steepledowns=$result->races; }
    							$vhrTotal = $portsmanPark+$sprintValley+$steepledowns;
    						}
    					} 
    				
 						$vgr_events_number = $this->Reports_model->get_race_events_number_between_dates('DG',$processedDate,$processedDate);
    	 				$millersfield = 0;
    	 				$bruchwood = 0;
    	 				$vgrTotal = 0;
    	 				if(!empty($vgr_events_number)){
    						foreach ($vgr_events_number as $result){
    							if($result->name=='Millersfield'){ $millersfield=$result->races; }
    							if($result->name=='Brushwood'){ $bruchwood=$result->races; }
    							$vgrTotal = $millersfield+$bruchwood;
    						}
    					} 
    	 
    					$rapido_events_number = $this->Reports_model->get_rapido_events_number_between_dates('ra',$processedDate,$processedDate);
    				 	$rapido = 0;
    				 	if(!empty($rapido_events_number)){
    						$rapido = $rapido_events_number[0]->draws;
    					} 
    				
    				
    					$row->date = $processedDate;
    					$row->millersfield = $millersfield;
    					$row->bruchwood = $bruchwood;
    					$row->vgrtotal = $vgrTotal;
    					$row->portmanpark = $portsmanPark;
    					$row->steepledowns = $steepledowns;
    					$row->sprintvalley = $sprintValley;
    					$row->vhrtotal = $vhrTotal;
    					$row->rapido = $rapido;
    					$data['table'][]=$row;
    					
    					unset($row);
    			  
    					$portsmanParkWeekly = $portsmanParkWeekly+$portsmanPark;
    					$steepledownsWeekly = $steepledownsWeekly+$steepledowns;
    					$sprintValleyWeekly = $sprintValleyWeekly+$sprintValley;
    					$vhrTotalWeekly = $portsmanParkWeekly+$steepledownsWeekly+$sprintValleyWeekly;
    					$millersfieldWeekly = $millersfieldWeekly+$millersfield;
    	 				$bruchwoodWeekly = $bruchwoodWeekly+$bruchwood;
    	 				$vgrTotalWeekly = $millersfieldWeekly+$bruchwoodWeekly;
    					$rapidoWeekly = $rapidoWeekly+$rapido;
    				
						$portsmanParkMonthly = $portsmanParkMonthly+$portsmanPark;
    					$steepledownsMonthly = $steepledownsMonthly+$steepledowns;
    					$sprintValleyMonthly = $sprintValleyMonthly+$sprintValley;
    					$millersfieldMonthly = $millersfieldMonthly+$millersfield;
    	 				$bruchwoodMonthly = $bruchwoodMonthly+$bruchwood;
    					$rapidoMonthly = $rapidoMonthly+$rapido;
    					$vhrTotalMonthly = $portsmanParkMonthly+$steepledownsMonthly+$sprintValleyMonthly;
    	 				$vgrTotalMonthly = $bruchwoodMonthly+$millersfieldMonthly;	
    				
    					$portsmanParkYearTotal = $portsmanParkYearTotal+$portsmanPark;
    					$steepledownsYearTotal = $steepledownsYearTotal+$steepledowns;
    					$sprintValleyYearTotal = $sprintValleyYearTotal+$sprintValley;
    					$millersfieldYearTotal = $millersfieldYearTotal+$millersfield;
    	 				$bruchwoodYearTotal = $bruchwoodYearTotal+$bruchwood;
    					$rapidoYearTotal = $rapidoYearTotal+$rapido;
    					$vhrYearTotal = $portsmanParkYearTotal+$steepledownsYearTotal+$sprintValleyYearTotal;
    	 				$vgrYearTotal = $bruchwoodYearTotal+$millersfieldYearTotal;	
    	 				
    	 				$portsmanParkGrandTotal =  $portsmanParkGrandTotal+$portsmanPark;
    					$steepledownsGrandTotal =  $steepledownsGrandTotal+$steepledowns;
    					$sprintValleyGrandTotal =  $sprintValleyGrandTotal+$sprintValley;
    					$millersfieldGrandTotal =  $millersfieldGrandTotal+$millersfield;
    	 				$bruchwoodGrandTotal =  $bruchwoodGrandTotal+$bruchwood;
    					$rapidoGrandTotal =  $rapidoGrandTotal+$rapido;
    					$vhrGrandTotal =  $portsmanParkGrandTotal+$steepledownsGrandTotal+$sprintValleyGrandTotal;
    	 				$vgrGrandTotal =  $millersfieldGrandTotal+$bruchwoodGrandTotal;
    				
    				
    					if($dayValue=='Sat'){
    					
    						$row->date = 'Week Total';
    						$row->millersfield = $millersfieldWeekly;
    						$row->bruchwood = $bruchwoodWeekly;
    						$row->vgrtotal = $vgrTotalWeekly;
    						$row->portmanpark = $portsmanParkWeekly;
    						$row->steepledowns = $steepledownsWeekly;
    						$row->sprintvalley = $sprintValleyWeekly;
    						$row->vhrtotal = $vhrTotalWeekly;
    						$row->rapido = $rapidoWeekly;
    						$data['table'][]=$row;
    					
    						unset($row);
    					
   							$portsmanParkWeekly = 0;
    						$steepledownsWeekly = 0;
    						$sprintValleyWeekly = 0;
    						$vhrTotalWeekly=0;
    						$millersfieldWeekly = 0;
    	 					$bruchwoodWeekly = 0;
    	 					$vgrTotalWeekly =0;
    						$rapidoWeekly = 0;
						}
						

						
						
    				}
    				
    			 	//check if end of the month
    			 	if($processedDate == date("Y-m-t", strtotime($processedDate))){
    			 	
    			 	
    			 	    $row->date = 'Month Total';
    					$row->millersfield = $millersfieldMonthly;
    					$row->bruchwood = $bruchwoodMonthly;
    					$row->vgrtotal = $vgrTotalMonthly;
    					$row->portmanpark = $portsmanParkMonthly;
    					$row->steepledowns = $steepledownsMonthly;
    					$row->sprintvalley = $sprintValleyMonthly;
    					$row->vhrtotal = $vhrTotalMonthly;
    					$row->rapido = $rapidoMonthly;
    					$data['table'][]=$row;
    					
    					unset($row);
    			 	
    			 		$portsmanParkMonthly = 0;
    					$steepledownsMonthly = 0;
    					$sprintValleyMonthly = 0;
    					$millersfieldMonthly = 0;
    	 				$bruchwoodMonthly = 0;
    					$rapidoMonthly = 0;
    					$vhrTotalMonthly = 0;
    	 				$vgrTotalMonthly = 0;	
    			 	}
    			
    			}
    	
    	
    			//check if last day of the year
    			$dateParts=explode('-',$processedDate);
    			
    			if($dateParts[1]=='12' && $dateParts[2]=='31'){
    	
    	    		$row->date = 'Year Total';
    				$row->millersfield = $millersfieldYearTotal;
    				$row->bruchwood = $bruchwoodYearTotal;
    				$row->vgrtotal = $vgrYearTotal;
    				$row->portmanpark = $portsmanParkYearTotal;
    				$row->steepledowns = $steepledownsYearTotal;
    				$row->sprintvalley = $sprintValleyYearTotal;
    				$row->vhrtotal = $vhrYearTotal;
    				$row->rapido = $rapidoYearTotal;
    				$data['table'][]=$row;
    					
    				unset($row);
    			 	
    		    	$portsmanParkYearTotal = 0;
    				$steepledownsYearTotal = 0;
    				$sprintValleyYearTotal = 0;
    				$millersfieldYearTotal = 0;
    	 			$bruchwoodYearTotal = 0;
    				$rapidoYearTotal = 0;
    				$vhrYearTotal = 0;
    	 			$vgrYearTotal = 0;	
    			}

    		
    		}
    		
    	    $row->date = 'Grand Total';
    		$row->millersfield = $millersfieldGrandTotal;
    		$row->bruchwood = $bruchwoodGrandTotal;
    		$row->vgrtotal = $vgrGrandTotal;
    		$row->portmanpark = $portsmanParkGrandTotal;
    		$row->steepledowns = $steepledownsGrandTotal;
    		$row->sprintvalley = $sprintValleyGrandTotal;
    		$row->vhrtotal = $vhrGrandTotal;
    		$row->rapido = $rapidoGrandTotal;
    		$data['table'][]=$row;
    					
    		unset($row);
    		
    		$portsmanParkGrandTotal = 0;
    		$steepledownsGrandTotal = 0;
    		$sprintValleyGrandTotal = 0;
    		$millersfieldGrandTotal = 0;
    	 	$bruchwoodGrandTotal = 0;
    		$rapidoGrandTotal = 0;
    		$vhrGrandTotal = 0;
    	 	$vgrGrandTotal = 0;	
    		
    	  
    		$this->load->library('excel');
    		//activate worksheet number 1
    		$this->excel->setActiveSheetIndex(0);
    		//name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Daily Statistics.');
    		//set cell A1 content with some text
    		 
    		$row_index = 2;
    		
    		$this->excel->getActiveSheet()->setCellValue('A'.($row_index-1), 'Date');
    		$this->excel->getActiveSheet()->setCellValue('B'.($row_index-1), 'MILLERSFIELD');
    		$this->excel->getActiveSheet()->setCellValue('C'.($row_index-1), 'BRUSHWOOD');
    		$this->excel->getActiveSheet()->setCellValue('D'.($row_index-1), 'VGR Total');
    		$this->excel->getActiveSheet()->setCellValue('E'.($row_index-1), 'PORTMAN PARK');
    		$this->excel->getActiveSheet()->setCellValue('F'.($row_index-1), 'STEEPLEDOWNS');
    		$this->excel->getActiveSheet()->setCellValue('G'.($row_index-1), 'SPRINT VALLEY');
    		$this->excel->getActiveSheet()->setCellValue('H'.($row_index-1), 'VHR Total');
    		$this->excel->getActiveSheet()->setCellValue('I'.($row_index-1), 'Rapido');
    		 
    		foreach($data['table'] as $row){
    			$this->excel->getActiveSheet()->setCellValue('A'.$row_index, $row->date);
    			$this->excel->getActiveSheet()->setCellValue('B'.$row_index, $row->millersfield);
    			$this->excel->getActiveSheet()->setCellValue('C'.$row_index, $row->bruchwood); 
    			$this->excel->getActiveSheet()->setCellValue('D'.$row_index, $row->vgrtotal);
    			$this->excel->getActiveSheet()->setCellValue('E'.$row_index, $row->portmanpark); 
    			$this->excel->getActiveSheet()->setCellValue('F'.$row_index, $row->steepledowns); 
    			$this->excel->getActiveSheet()->setCellValue('G'.$row_index, $row->sprintvalley); 
    		 	$this->excel->getActiveSheet()->setCellValue('H'.$row_index, $row->vhrtotal); 
    		 	$this->excel->getActiveSheet()->setCellValue('I'.$row_index, $row->rapido); 
    			 
    			if($row->date=='Week Total'){
    				$this->excel->getActiveSheet()->getStyle('A'.$row_index.':I'.$row_index)->getFill()
							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
							->getStartColor()->setRGB('FFE8E5'); 
    			}
    			if($row->date=='Month Total'){
    				$this->excel->getActiveSheet()->getStyle('A'.$row_index.':I'.$row_index)->getFill()
							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
							->getStartColor()->setRGB('d9edf7'); 
    			}
    		    if($row->date=='Year Total'){
    				$this->excel->getActiveSheet()->getStyle('A'.$row_index.':I'.$row_index)->getFill()
							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
							->getStartColor()->setRGB('dff0d8'); 
    			}
    		    if($row->date=='Grand Total'){
    				$this->excel->getActiveSheet()->getStyle('A'.$row_index.':I'.$row_index)->getFill()
							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
							->getStartColor()->setRGB('d9b38c'); 
    			}
    			 
    			 
    			$row_index++;
    		}
    
    		$filename='daily_raports.xls';
    		header('Content-Type: application/vnd.ms-excel'); 
    		header('Content-Disposition: attachment;filename="'.$filename.'"');
    		header('Cache-Control: max-age=0');
    
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//$objWriter->save('./uploads_assets/raports.xls');
                $objWriter->save('s3://49suploadsassets/reports.xls');
                $this->client->putObjectAcl([
                   'ACL' => 'public-read',
                   'Bucket' => '49suploadsassets',
                   'Key' => 'reports.xls']);

                //echo "./uploads_assets/raports.xls";
                echo 'https://s3-eu-west-1.amazonaws.com/49suploadsassets/reports.xls';
    		 
    	} else {
    		var_dump( validation_errors()  );
    	}
    	
    	
    }








    function draw_49()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$data['game_type']='49';
    	$this->load->view('reports/daily_draw_statistic',$data);
    
    }
    
    function draw_ILB()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$data['game_type']='il';
    	$this->load->view('reports/number_draw_statistic',$data);
    }
    
    function draw_rapido()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$data['game_type']='ra';
    	$this->load->view('reports/number_draw_statistic',$data);
    
    }
	function miss()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
        $this->load->model('Reports_model');

        $data['title'] = 'Reports';
        $data['miss_statistics'] = $this->Reports_model->get_miss();
		//print_r($data);

        $this->load->view('reports/miss_statistic',$data);

    }
    

    function get_numbers_statistic_data()
    {
    	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$this->load->model('Reports_model');
    	$this->load->library('form_validation');
    	
    	
    	$json_input = trim(file_get_contents('php://input'));
    	$_POST = json_decode($json_input,true);
    	
    	$data = array();
    	
    	$this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
    	$this->form_validation->set_rules('to', 'to', 'required|min_length[7]');
    	$this->form_validation->set_rules('game_type', 'game_type', 'required|min_length[2]');
    	if ($this->form_validation->run() == TRUE) {
    		
    		$game_type = $this->input->post('game_type');
    		$date_from = $this->input->post('from');
    		$date_from = DateTime::createFromFormat('Y-m-d', $date_from);
    		$date_from = $date_from->format('Y-m-d');
    		
    		$date_to = $this->input->post('to');
    		$date_to = DateTime::createFromFormat('Y-m-d', $date_to);
    		$date_to = $date_to->format('Y-m-d');
    		
    		
    		if($game_type=='49'){
    			$data['events'] = $this->Reports_model->get_number_events_between_dates($game_type,$date_from,$date_to);
    			$data['type'] = '49';
    			
    			foreach ($data['events'] as &$event){
    				$numbers_line='';
    				$numbers = $this->Reports_model->get_draw_numbers($event->id);
    				foreach($numbers as $number){
    					$numbers_line.=$number->number.',';
    				}
    				$event->numbers=trim($numbers_line, ",");
    				
    				$bonusnumbers = $this->Reports_model->get_bunus_draw_number($event->id);
    				foreach($bonusnumbers as $bonusnumber){
    					$event->bonus=$bonusnumber->number;
    				}
    			}
    			
    			$this->load->view('reports/number_games_statistic_view',$data);
    		}
    		if($game_type=='il'){
    			
    			$data['events'] = $this->Reports_model->get_number_events_between_dates($game_type,$date_from,$date_to);
    			$data['type'] = 'il';
    			 
    			foreach ($data['events'] as &$event){
    				$numbers_line='';
    				$numbers = $this->Reports_model->get_draw_numbers($event->id);
    				foreach($numbers as $number){
    					$numbers_line.=$number->number.',';
    				}
    				$event->numbers=trim($numbers_line, ",");
    			
    				$bonusnumbers = $this->Reports_model->get_bunus_draw_number($event->id);
    				foreach($bonusnumbers as $bonusnumber){
    					$event->bonus=$bonusnumber->number;
    				}
    			}
    			
    			
    			$this->load->view('reports/number_games_statistic_view',$data);
    		}
    		if($game_type=='ra'){
    			
    			$data['events'] = $this->Reports_model->get_number_events_between_dates($game_type,$date_from,$date_to);
    			$data['type'] = 'ra';
    			 
    			foreach ($data['events'] as &$event){
    				$numbers_line='';
    				$numbers = $this->Reports_model->get_draw_numbers($event->id);
    				foreach($numbers as $number){
    					$numbers_line.=$number->number.',';
    				}
    				$event->numbers=trim($numbers_line, ",");
    			}
    			
    			$this->load->view('reports/number_games_statistic_view',$data);
    		}
    		
    		
    		
    	}else {
    		var_dump( validation_errors()  );
    	}
    	 
    }
    
    
    public function draws_download(){
    	
      	if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
    		$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
    		redirect('/');
    	}
    	$this->load->model('Reports_model');
    	$this->load->library('form_validation');
    
    	$data = array();
    
    
    	$data = array();
    
    	$this->form_validation->set_rules('from', 'from', 'required|min_length[7]');
    	$this->form_validation->set_rules('to', 'to', 'required|min_length[7]');
    	$this->form_validation->set_rules('game_type', 'game_type', 'required|min_length[2]');
    	if ($this->form_validation->run() == TRUE) {
    
           

            $game_type = $this->input->post('game_type');
            $date_from = $this->input->post('from');
            $date_from = DateTime::createFromFormat('Y-m-d', $date_from);
            $date_from = $date_from->format('Y-m-d');

            $date_to = $this->input->post('to');
            $date_to = DateTime::createFromFormat('Y-m-d', $date_to);
            $date_to = $date_to->format('Y-m-d');

            if($game_type=='49'){
            	$data['events'] = $this->Reports_model->get_number_events_between_dates($game_type,$date_from,$date_to);
            	
            	foreach ($data['events'] as &$event){
            		$numbers_line='';
            		$numbers = $this->Reports_model->get_draw_numbers($event->id);
            		foreach($numbers as $number){
            			$numbers_line.=$number->number.',';
            		}
            		$event->numbers=trim($numbers_line, ",");
            
            		$bonusnumbers = $this->Reports_model->get_bunus_draw_number($event->id);
            		foreach($bonusnumbers as $bonusnumber){
            			$event->bonus=$bonusnumber->number;
            		}
            	}
            }
            if($game_type=='il'){
            	$data['events'] = $this->Reports_model->get_number_events_between_dates($game_type,$date_from,$date_to);
            	 
            	foreach ($data['events'] as &$event){
            		$numbers_line='';
            		$numbers = $this->Reports_model->get_draw_numbers($event->id);
            		foreach($numbers as $number){
            			$numbers_line.=$number->number.',';
            		}
            		$event->numbers=trim($numbers_line, ",");
            
            		$bonusnumbers = $this->Reports_model->get_bunus_draw_number($event->id);
            		foreach($bonusnumbers as $bonusnumber){
            			$event->bonus=$bonusnumber->number;
            		}
            	}
            }
            if($game_type=='ra'){
            	$data['events'] = $this->Reports_model->get_number_events_between_dates($game_type,$date_from,$date_to);
            
            	foreach ($data['events'] as &$event){
            		$numbers_line='';
            		$numbers = $this->Reports_model->get_draw_numbers($event->id);
            		foreach($numbers as $number){
            			$numbers_line.=$number->number.',';
            		}
            		$event->numbers=trim($numbers_line, ",");
            	}
            }
            
            $data['table'] = $data['events'];
            
    		$this->load->library('excel');
    		//activate worksheet number 1
    		$this->excel->setActiveSheetIndex(0);
    		//name the worksheet
    		$this->excel->getActiveSheet()->setTitle('Number Game Statistics.');
    		//set cell A1 content with some text
    		 
    		$row_index = 2;
    		 
    		$this->excel->getActiveSheet()->setCellValue('A'.($row_index-1), 'Date');
    		$this->excel->getActiveSheet()->setCellValue('B'.($row_index-1), 'Off Time');
    		$this->excel->getActiveSheet()->setCellValue('C'.($row_index-1), 'Draw');
    		$this->excel->getActiveSheet()->setCellValue('D'.($row_index-1), 'Numbers');
    		if($game_type!='ra'){
    			$this->excel->getActiveSheet()->setCellValue('E'.($row_index-1), 'Bonus');
    		}
    		 
    		foreach($data['table'] as $row){
    			$this->excel->getActiveSheet()->setCellValue('A'.$row_index, $row->date);
    			$this->excel->getActiveSheet()->setCellValue('B'.$row_index, $row->offtime);
    			
    			if($game_type=='49'){
    				if($row->num==1){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'LUNCHTIME DRAW'); }  
    				if($row->num==2){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'TEATIME DRAW'); }  
    			  	if($row->num==3){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, '3RD DRAW'); }  
    			  	if($row->num==4){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, '4TH DRAW'); }  
    			}
    			
    			if($game_type=='il'){
    			 	if($row->num==1){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'MAIN DRAW'); }  
    			 	if($row->num==2){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, '2ND DRAW'); }  
    			  	if($row->num==3){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, '3RD DRAW'); }   
    			  	if($row->num==4){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, '4RD DRAW'); }   
    			 	if($row->num==5){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, '5RD DRAW'); }   
    			 	if($row->num==6){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, '6RD DRAW'); }   
    			} 
    			if($game_type=='ra'){
    				if($row->num==1){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 1'); }  
    			  	if($row->num==2){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 2'); }  
    			  	if($row->num==3){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 3'); }  
    			  	if($row->num==4){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 4'); } 
    			 	if($row->num==5){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 5'); }  
    			  	if($row->num==6){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 6'); }  
    				if($row->num==7){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 7'); } 
    			  	if($row->num==8){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 8'); }  
    			  	if($row->num==9){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 9'); }  
    			  	if($row->num==10){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 10'); }  
    			  	if($row->num==11){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 11'); }  
    			  	if($row->num==12){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 12'); }  
    			 	if($row->num==13){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 13'); } 
    			 	if($row->num==14){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 14'); }  
    			   	if($row->num==15){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 15'); }  
    			  	if($row->num==16){ $this->excel->getActiveSheet()->setCellValue('C'.$row_index, 'DRAW 16'); }  
    			}
    			
    			
    			
    			
    			
    			$this->excel->getActiveSheet()->setCellValue('D'.$row_index, $row->numbers); 
    			if($game_type!='ra'){
    				if(isset($row->bonus)){$this->excel->getActiveSheet()->setCellValue('E'.$row_index, $row->bonus);};
    			}
    			 
    			$row_index++;
    		}
    
    		$filename='number_raports.xls';
    		header('Content-Type: application/vnd.ms-excel'); 
    		header('Content-Disposition: attachment;filename="'.$filename.'"');
    		header('Cache-Control: max-age=0');
    
    		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//$objWriter->save('./uploads_assets/raports.xls');
                $objWriter->save('s3://49suploadsassets/number_reports.xls');
                $this->client->putObjectAcl([
                   'ACL' => 'public-read',
                   'Bucket' => '49suploadsassets',
                   'Key' => 'number_reports.xls']);

                //echo "./uploads_assets/raports.xls";
                echo 'https://s3-eu-west-1.amazonaws.com/49suploadsassets/number_reports.xls';
    		 
    	} else {
    		var_dump( validation_errors()  );
    	}
    	
    	
    }
    
    
    
}

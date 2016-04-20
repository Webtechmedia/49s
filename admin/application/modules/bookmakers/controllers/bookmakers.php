<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bookmakers extends CI_Controller
{


	public function index($offset=0)
	{
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}

		$data['title'] = 'Bookmakers';
		$data['offset'] = $offset;
		$per_page=($this->session->userdata('bookmaker_delimiter') == '' ? 50 : $this->session->userdata('bookmaker_delimiter'));
		$bookmaker_search=($this->session->userdata('bookmakers_search') == '' ? '' : $this->session->userdata('bookmakers_search'));
		$sortfield=($this->session->userdata('sortfield') == '' ? 'B_Id' : $this->session->userdata('sortfield'));
		$order=($this->session->userdata('order') == '' ? 'asc' : $this->session->userdata('order'));

		$this->load->model('bookmakers_model');
		//$companyName=($this->session->userdata('company_name') == '' ? '0' : $this->session->userdata('company_name'));

		$data['bookmakers']=$this->bookmakers_model->get_bookmakers($sortfield, $order,$per_page,$offset,$bookmaker_search);
		$data['total_results'] =$this->bookmakers_model->get_row_count($bookmaker_search);

		if($sortfield=='B_Reference' && $order=='asc'){
			$data['reference_sort']='<a href="'.base_url('bookmakers/setSort/B_Reference/desc').'" >Reference <span class="caret" ></span></a>';
		}elseif($sortfield=='B_Reference' && $order=='desc'){
			$data['reference_sort']='<a href="'.base_url('bookmakers/setSort/B_Reference/asc').'" >Reference  <span class="order dropup"><span class="caret" ></span></span></a>';
		}else {
			$data['reference_sort']='<a href="'.base_url('bookmakers/setSort/B_Reference/asc').'" >Reference </a>';
		}

		if($sortfield=='B_CompanyName' && $order=='asc'){
			$data['company_name_sort']='<a href="'.base_url('bookmakers/setSort/B_CompanyName/desc').'" >Company Name <span class="caret"></span></a>';
		}elseif($sortfield=='B_CompanyName' && $order=='desc'){
			$data['company_name_sort']='<a href="'.base_url('bookmakers/setSort/B_CompanyName/asc').'" >Company Name <span class="order dropup"><span class="caret"></span></span></a>';
		}else {
			$data['company_name_sort']='<a href="'.base_url('bookmakers/setSort/B_CompanyName/asc').'" >Company Name</a>';
		}

		if($sortfield=='B_Address1' && $order=='asc'){
			$data['address1_sort']='<a href="'.base_url('bookmakers/setSort/B_Address1/desc').'" >Address 1 <span class="caret"></span></a>';
		}elseif($sortfield=='B_Address1' && $order=='desc'){
			$data['address1_sort']='<a href="'.base_url('bookmakers/setSort/B_Address1/asc').'" >Address 1 <span class="order dropup"><span class="caret"></span></span></a>';
		}else {
			$data['address1_sort']='<a href="'.base_url('bookmakers/setSort/B_Address1/asc').'" >Address 1</a>';
		}

		if($sortfield=='B_Address2' && $order=='asc'){
			$data['address2_sort']='<a href="'.base_url('bookmakers/setSort/B_Address2/desc').'" >Address 2 <span class="caret"></span></a>';
		}elseif($sortfield=='B_Address2' && $order=='desc'){
			$data['address2_sort']='<a href="'.base_url('bookmakers/setSort/B_Address2/asc').'" >Address 2 <span class="order dropup"><span class="caret"></span></span></a>';
		}else {
			$data['address2_sort']='<a href="'.base_url('bookmakers/setSort/B_Address2/asc').'" >Address 2</a>';
		}

		if($sortfield=='B_Address3' && $order=='asc'){
			$data['address3_sort']='<a href="'.base_url('bookmakers/setSort/B_Address3/desc').'" >Address 3 <span class="caret"></span></a>';
		}elseif($sortfield=='B_Address3' && $order=='desc'){
			$data['address3_sort']='<a href="'.base_url('bookmakers/setSort/B_Address3/asc').'" >Address 3 <span class="order dropup"><span class="caret"></span></span></a>';
		}else {
			$data['address3_sort']='<a href="'.base_url('bookmakers/setSort/B_Address3/asc').'" >Address 3</a>';
		}

		if($sortfield=='B_Postcode' && $order=='asc'){
			$data['postcode_sort']='<a href="'.base_url('bookmakers/setSort/B_Postcode/desc').'" >Postcode <span class="caret"></span></a>';
		}elseif($sortfield=='B_Postcode' && $order=='desc'){
			$data['postcode_sort']='<a href="'.base_url('bookmakers/setSort/B_Postcode/asc').'" >Postcode <span class="order dropup"><span class="caret"></span></span></a>';
		}else {
			$data['postcode_sort']='<a href="'.base_url('bookmakers/setSort/B_Postcode/asc').'" >Postcode</a>';
		}

		if($sortfield=='B_CountryCode' && $order=='asc'){
			$data['country_code_sort']='<a href="'.base_url('bookmakers/setSort/B_CountryCode/desc').'" >Country Code <span class="caret"></span></a>';
		}elseif($sortfield=='B_CountryCode' && $order=='desc'){
			$data['country_code_sort']='<a href="'.base_url('bookmakers/setSort/B_CountryCode/asc').'" >Country Code <span class="order dropup"><span class="caret"></span></span></a>';
		}else {
			$data['country_code_sort']='<a href="'.base_url('bookmakers/setSort/B_CountryCode/asc').'" >Country Code</a>';
		}

		$this->load->library('pagination');

		$config['base_url'] = base_url('bookmakers/index/');
		$config['total_rows'] = $data['total_results'];
		$config['uri_segment'] = 3;
		$config['per_page'] = $per_page;
		$config['num_links'] = 2;
		$config['display_pages'] = TRUE;
		$config['constant_num_links'] = TRUE;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_open_disabled'] = "<li class='disabled'>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_open_disabled'] = "<li class='disabled'>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_open_disabled'] = "<li class='disabled'>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_open_disabled'] = "<li class='disabled'>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'bookmakers/content',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	public function import(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Bookmakers Import';



		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'bookmakers/import',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	public function do_upload(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Bookmakers Import';

		//$config['upload_path'] = './../incomming/bookmakers/';
		// Relative path seems to be not working
		$config['upload_path'] = '/var/www/html/admin/uploads_assets/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '2000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{

			$this->session->set_flashdata('error_message', $this->upload->display_errors());
			redirect('bookmakers/index');
		}
		else
		{
			$uploaded_file = array('upload_data' => $this->upload->data());
		 	$this->processfile($uploaded_file['upload_data']['full_path']);
			$this->session->set_flashdata('message', 'File has been imported');
			redirect('bookmakers/index');
		}
	}

	public function processfile($file_path){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Bookmakers Import';

 		$this->load->model('bookmakers_model');
 		$this->bookmakers_model->set_remove_flag();

		//load our new PHPExcel library
		$this->load->library('excel');
		$reader= PHPExcel_IOFactory::createReader('Excel5');
		$reader->setReadDataOnly(true);
		$excel=$reader->load($file_path);

		$sheetCount = $excel->getSheetCount();

		for($i=0;$i<$sheetCount;$i++){
			$sheet=$excel->setActiveSheetIndex($i);
			$db_row=array();
			foreach($sheet->getRowIterator() as $r){
			 	if(1 == $r->getRowIndex ()) continue;//skip first row
	      		foreach($r->getCellIterator() as $c){
	      			$db_row[]=$c->getValue();
	      		}
				$this->bookmakers_model->addBookmaker($i,$db_row);
				$db_row = array();
		 	}
		}

		$this->bookmakers_model->remove_flagged();
		$this->bookmakers_model->setCountryCodesToUK();
		$this->bookmakers_model->setNullStringAsNull();
	}

	public function setCompanyName(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->session->set_userdata('company_name', $this->input->post('company_name'));
		$this->index();
	}

	public function setDelimiter(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->session->set_userdata('bookmaker_delimiter', $this->input->post('bookmaker_delimiter'));
		$this->index();
	}

	public function setSearch(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->session->set_userdata('bookmakers_search', $this->input->post('bookmakers_search'));
		$this->index();
	}
	public function setSort($fieldname,$order){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->session->set_userdata('sortfield', $fieldname);
		$this->session->set_userdata('order', $order);
		redirect('bookmakers/index');
	}
	public function deleteBookmaker($bookmaker_id,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
 		$this->load->model('bookmakers_model');
 		$this->bookmakers_model->delete_bookmaker($bookmaker_id);
		redirect('bookmakers/index/'.$offset);
	}


	public function addnew(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Add New Bookmaker';

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'bookmakers/addnewform',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}
	public function insertNewBookmaker(){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('reference', 'Reference', 'trim|required|max_length[12]|xss_clean');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('address_2', 'Address 2', 'trim|max_length[100]|xss_clean');
		$this->form_validation->set_rules('address_3', 'Address 3', 'trim|max_length[100]|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|max_length[10]|xss_clean');
		$this->form_validation->set_rules('country_code', 'Country Code', 'trim|required|max_length[2]|xss_clean');


		if ($this->form_validation->run() == FALSE)
		{
			$this->addnew();
		}
		else
		{
			$this->load->model('bookmakers_model');
			$this->bookmakers_model->insertNewBookmaker($this->input->post());
			$this->session->set_flashdata('message', 'Bookmaker Added.');
			redirect('bookmakers/index');
		}
	}


	public function edit($bookmakerid,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$data['title'] = 'Edit Bookmaker';
		$this->load->model('bookmakers_model');
		$data['bookmaker'] = $this->bookmakers_model->getBookmaker($bookmakerid);
		$data['bookmakerid'] = $bookmakerid;
		$data['offset'] = $offset;

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'bookmakers/editform',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	public function updateBookmaker($bookmakerId,$offset){
		if(!$this->tank_auth->is_logged_in() || $this->tank_auth->is_role('admin')!=1){
			$this->session->set_flashdata('error_message', 'You do not have privilages to access this section. ');
			redirect('/');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('reference', 'Reference', 'trim|required|max_length[12]|xss_clean');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('address_2', 'Address 2', 'trim|max_length[100]|xss_clean');
		$this->form_validation->set_rules('address_3', 'Address 3', 'trim|max_length[100]|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim|max_length[10]|xss_clean');
		$this->form_validation->set_rules('country_code', 'Country Code', 'trim|required|max_length[2]|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($bookmakerId,$offset);
		}
		else
		{
			$this->load->model('bookmakers_model');
			$this->bookmakers_model->updateBookmaker($bookmakerId,$this->input->post());
			$this->session->set_flashdata('message', 'Bookmaker Updated.');
			redirect('bookmakers/index/'.$offset);
		}
	}



}









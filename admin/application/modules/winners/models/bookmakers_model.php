<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmakers_model extends CI_Model {


	public function truncate_bookmakers(){
		$this->db->truncate('bookmakers');
	}

	public function addBookmaker($data)
	{
		$record = array(
			'B_Id'			=> '',
			'B_Reference' 	=> $data[0],
			'B_CompanyName' => $data[1],
			'B_Address1' 	=> $data[2],
			'B_Address2' 	=> $data[3],
			'B_Address3' 	=> $data[4],
			'B_Postcode' 	=> $data[5],
			'B_CountryCode' => $data[6],
		);
		$this->db->insert('bookmakers', $record);
	}
	public function get_bookmakers($companyName,$sortfield, $order,$per_page,$offset,$search){

		$this->db->select('*');
		$this->db->from('bookmakers');
		if($search!=''){
			$this->db->where("(`B_Reference` LIKE '%$search%' OR  `B_CompanyName` LIKE '%$search%' OR `B_Address1` LIKE '%$search%' OR `B_Address2` LIKE '%$search%' OR `B_Address3` LIKE '%$search%')");
		}

		if($companyName=='coral'){
			$this->db->where("(`B_CompanyName` LIKE 'CORAL%')");
		}
		if($companyName=='done'){
			$this->db->where("(`B_CompanyName` LIKE 'Done Brothers Cash Betting%')");
		}
		if($companyName=='independant'){
			$this->db->where("B_CompanyName NOT LIKE 'CORAL%'");
			$this->db->where("B_CompanyName NOT LIKE 'Done Brothers Cash Betting%'");
			$this->db->where("B_CompanyName NOT LIKE 'Ladbrokes Limited%'");
			$this->db->where("B_CompanyName NOT LIKE 'Paddy Power%'");
			$this->db->where("B_CompanyName NOT LIKE 'Tote Bookmakers%'");
			$this->db->where("B_CompanyName NOT LIKE 'William Hill%'");
		}
		if($companyName=='ladbrokes'){
			$this->db->where("(`B_CompanyName` LIKE 'Ladbrokes Limited%')");
		}
		if($companyName=='paddypower'){
			$this->db->where("(`B_CompanyName` LIKE 'Paddy Power%')");
		}
		if($companyName=='tote'){
			$this->db->where("(`B_CompanyName` LIKE 'Tote Bookmakers%')");
		}
		if($companyName=='williamhill'){
			$this->db->where("(`B_CompanyName` LIKE 'William Hill%')");
		}

		$this->db->order_by($sortfield, $order);
		$this->db->limit($per_page,$offset);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_row_count($companyName,$search){
		$this->db->select('*');
		$this->db->from('bookmakers');

		if($search!=''){
			$this->db->where("(`B_Reference` LIKE '%$search%' OR  `B_CompanyName` LIKE '%$search%' OR `B_Address1` LIKE '%$search%' OR `B_Address2` LIKE '%$search%' OR `B_Address3` LIKE '%$search%')");
		}

		if($companyName=='coral'){
			$this->db->where("(`B_CompanyName` LIKE 'CORAL%')");
		}
		if($companyName=='done'){
			$this->db->where("(`B_CompanyName` LIKE 'Done Brothers Cash Betting%')");
		}
		if($companyName=='independant'){
			$this->db->where("B_CompanyName NOT LIKE 'CORAL%'");
			$this->db->where("B_CompanyName NOT LIKE 'Done Brothers Cash Betting%'");
			$this->db->where("B_CompanyName NOT LIKE 'Ladbrokes Limited%'");
			$this->db->where("B_CompanyName NOT LIKE 'Paddy Power%'");
			$this->db->where("B_CompanyName NOT LIKE 'Tote Bookmakers%'");
			$this->db->where("B_CompanyName NOT LIKE 'William Hill%'");
		}
		if($companyName=='ladbrokes'){
			$this->db->where("(`B_CompanyName` LIKE 'Ladbrokes Limited%')");
		}
		if($companyName=='paddypower'){
			$this->db->where("(`B_CompanyName` LIKE 'Paddy Power%')");
		}
		if($companyName=='tote'){
			$this->db->where("(`B_CompanyName` LIKE 'Tote Bookmakers%')");
		}
		if($companyName=='williamhill'){
			$this->db->where("(`B_CompanyName` LIKE 'William Hill%')");
		}

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function delete_bookmaker($bookmaker_id){
		$this->db->where('B_Id', $bookmaker_id);
		$this->db->delete('bookmakers');
	}

	public function insertNewBookmaker($data){

		$this->db->set('B_Reference', $data['reference']);
		$this->db->set('B_CompanyName', $data['company_name']);
		$this->db->set('B_Address1', $data['address_1']);
		$this->db->set('B_Address2', $data['address_2']);
		$this->db->set('B_Address3', $data['address_3']);
		$this->db->set('B_Postcode', $data['postcode']);
		$this->db->set('B_CountryCode', $data['country_code']);

		$this->db->insert('bookmakers');

	}

	public function getBookmaker($bookmakerid){

		$this->db->select('*');
		$this->db->where('B_Id',$bookmakerid);
		$this->db->from('bookmakers');
		$this->db->limit('1');
		$query=$this->db->get();
		return $query->result();
	}

	public function updateBookmaker($bookmakerId,$data){

		$this->db->set('B_Reference', $data['reference']);
		$this->db->set('B_CompanyName', $data['company_name']);
		$this->db->set('B_Address1', $data['address_1']);
		$this->db->set('B_Address2', $data['address_2']);
		$this->db->set('B_Address3', $data['address_3']);
		$this->db->set('B_Postcode', $data['postcode']);
		$this->db->set('B_CountryCode', $data['country_code']);
		$this->db->where('B_Id',$bookmakerId);
		$this->db->update('bookmakers');

	}



}











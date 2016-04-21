<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmakers_model extends CI_Model {

	public function set_remove_flag(){
		$this->db->query("UPDATE bookmakers SET B_to_remove = 1");
	}

	public function remove_flagged(){
		//remove fllagged as 1 but not custom inserts
		$this->db->where('B_to_remove', 1);
		$this->db->where('B_Reference !=', 'custom');
		$this->db->delete('bookmakers');
	}
	public function setCountryCodesToUK(){

		$this->db->query("UPDATE bookmakers SET B_CountryCode = 'UK'");

	}
	
	public function setNullStringAsNull(){
	
		$this->db->query("UPDATE bookmakers SET B_Address1 = NULL where B_Address1 ='NULL'");
		$this->db->query("UPDATE bookmakers SET B_Address2 = NULL where B_Address2 ='NULL'");
		$this->db->query("UPDATE bookmakers SET B_Address3 = NULL where B_Address3 ='NULL'");
	}
	
	
	public function addBookmaker($sheet_number,$data)
	{

		$this->db->select('B_Id');
		$this->db->from('bookmakers');
		$this->db->where("B_Reference",$data[0]);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$data = array(
					'B_to_remove' => 0
			);
			$this->db->where('B_Id', $query->row()->B_Id);
			$this->db->update('bookmakers', $data);

		} else {
			$record = array(
					'B_Id'			=> '',
					'B_SheetNumber' => $sheet_number,
					'B_Reference' 	=> $data[0],
					'B_CompanyName' => $data[1],
					'B_Address1' 	=> $data[2],
					'B_Address2' 	=> $data[3],
					'B_Address3' 	=> $data[4],
					'B_Postcode' 	=> $data[5],
					'B_CountryCode' => $data[6],
					'B_to_remove'	=> 0
			);
			$this->db->insert('bookmakers', $record);
		}
	}
	public function get_bookmakers($sortfield, $order,$per_page,$offset,$search){

		$this->db->select('*');
		$this->db->from('bookmakers');
		if($search!=''){
			$this->db->where("(`B_CompanyName` LIKE '%$search%' OR `B_Address1` LIKE '%$search%' OR `B_Address2` LIKE '%$search%' OR `B_Address3` LIKE '%$search%')");
		}

		//$this->db->where("B_SheetNumber", $companyName);

		$this->db->order_by($sortfield, $order);
		$this->db->limit($per_page,$offset);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_row_count($search){
		$this->db->select('*');
		$this->db->from('bookmakers');

		if($search!=''){
			$this->db->where("(`B_CompanyName` LIKE '%$search%' OR `B_Address1` LIKE '%$search%' OR `B_Address2` LIKE '%$search%' OR `B_Address3` LIKE '%$search%')");
		}

		//$this->db->where("B_SheetNumber", $companyName);

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
		$this->db->set('B_SheetNumber', $data['sheet_number']);
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

  public function get_all() {
    $this->db->select('*');
    $this->db->from('bookmakers');
    $this->db->where('B_Lat IS NULL');

    $query = $this->db->get();

    return $query->result();
  }

	public function get_geo() {
		foreach($this->get_all()  as $row){
			if($row->B_Lat == null){


				$fullurl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $row->B_Address1 . ",+" . $row->B_Address2 . ",+" . $row->B_Address3 . ",+" . $row->B_Postcode . ",+" . $row->B_CountryCode . "&key=AIzaSyAjYa60H5ot0DRDVbERYZsuJNrjzv9FRKs&sensor=true";
				$fullurl = str_replace(" ", "+",$fullurl);

				echo $row->B_CompanyName.' - '.$fullurl.'<br/>';

				try{
					$string = file_get_contents($fullurl); // get json content
					$json_a = json_decode($string, true); //json decoder


					if($json_a['status']=='OVER_QUERY_LIMIT'){
						exit('OVER_QUERY_LIMIT');
					}



					if(!is_null($json_a['results'])){
						foreach($json_a['results'] as $result){
							if( isset($result['geometry']['location']) ){
								$this->db->set('B_Lat',$result['geometry']['location']['lat']);
								$this->db->set('B_Long',$result['geometry']['location']['lng']);
								$this->db->set('B_api_url',$fullurl);
								$this->db->where('B_Id',$row->B_Id);
								$this->db->update('bookmakers');
							} else {
								$this->db->set('B_Lat','');
								$this->db->set('B_Long','');
								$this->db->set('B_api_url',$fullurl);
								$this->db->where('B_Id',$row->B_Id);
								$this->db->update('bookmakers');
							}
							break;
						}
					}else{
						$this->db->set('B_Lat','');
						$this->db->set('B_Long','');
						$this->db->set('B_api_url',$fullurl);
						$this->db->where('B_Id',$row->B_Id);
						$this->db->update('bookmakers');
					}


				} catch(Exception $ex ){

				}
				usleep(100000);

			}
		}
	}
}











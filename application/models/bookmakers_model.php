<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bookmakers_model extends CI_Model
{

	public function get_all()
	{

		$this->db->select('*');
		$this->db->from('bookmakers');
		$this->db->where('B_Lat IS NULL');
	
		$query = $this->db->get();

		return $query->result();
	}

    public function get_address_geo($search){
        $return = new stdClass();
        $return->lat = 0;
        $return->long = 0;
		$status = 1;
        $this->db->where('search_term',$search);
        //$this->db->where('status',1);
        $this->db->from('t_location_search_lookup');
        $query = $this->db->get();
        foreach($query->result() as $row){
            $return->lat = $row->lat;
            $return->long = $row->long;
            $status= $row->status;
        }
        
        if($return->lat == 0 && $return->long == 0 && $status == 1 ){
            $places = explode(",", $this->input->post('address'));
            $return = $this->get_geo_from_postcode_prefix( isset($places[0]) ? $places[0] : '' , isset($places[1]) ? $places[1] : '' );
        }
        return $return;
    }

    public function get_geo_from_postcode_prefix($postcode,$place){
        //http://maps.google.com/maps/api/geocode/json?components=country:GB|postal_code_prefix:bs5&address=bs5,+UK&sensor=false
        $return = new stdClass();
        $return->lat = 0;
        $return->long = 0;







        $fullurl = '';
        if($postcode != '' && $place == ''){
            //$fullurl = "https://maps.google.com/maps/api/geocode/json?components=country:GB|postal_code_prefix:" . $postcode . "&address=" . $postcode . ",+UK&sensor=false";
        	$fullurl = "https://maps.google.com/maps/api/geocode/json?components=country:GB&address=" . $postcode . "&sensor=false&key=AIzaSyDNvVaZ8Ol0ip7JJsEC7m7SOL3cjP35spI";
        }
        if($postcode == '' && $place != ''){
            $fullurl = "https://maps.google.com/maps/api/geocode/json?components=country:GB&address=" . $place . ",+UK&sensor=false&key=AIzaSyDNvVaZ8Ol0ip7JJsEC7m7SOL3cjP35spI";
        }
        if($postcode != '' && $place != ''){
            //$fullurl = "https://maps.google.com/maps/api/geocode/json?components=country:GB|postal_code_prefix:" . $postcode . "&address=" . $place . ",+UK&sensor=false";
        	$fullurl = "https://maps.google.com/maps/api/geocode/json?components=country:GB&address=" . $place . "&sensor=false&key=AIzaSyDNvVaZ8Ol0ip7JJsEC7m7SOL3cjP35spI";
        }

        $fullurl = str_replace(" ", "+",$fullurl);
        try{
            $string = file_get_contents($fullurl); // get json content
            $json_a = json_decode($string, true); //json decoder
            
            
            
            if(!is_null($json_a)){
                foreach($json_a['results'] as $result){
                	
                	
                	
                	
                	
                	if(count($result['address_components'])>1){
                		// if location can be trusted

                		if( isset($result['geometry']['location']) ){
                			$this->db->set('lat',$result['geometry']['location']['lat']);
                			$this->db->set('long',$result['geometry']['location']['lng']);
                			$this->db->set('search_term',$postcode . ',' . $place);
                			$this->db->set('url_used',$fullurl);
                			$this->db->set('status',1);
                			$this->db->insert('t_location_search_lookup');
                		
                			$return->lat = $result['geometry']['location']['lat'];
                			$return->long = $result['geometry']['location']['lng'];
                		
                		}  
                		
                	}else{
                		// if location not exact
                		if( isset($result['geometry']['location']) ){
                			$this->db->set('lat',0);
                			$this->db->set('long',0);
                			$this->db->set('search_term',$postcode . ',' . $place);
                			$this->db->set('url_used',$fullurl);
                			$this->db->set('status',0);
                			$this->db->insert('t_location_search_lookup');
                		
                			$return->lat = 0;
                			$return->long = 0;
                		
                		}
                	}

                }

                if($json_a['status'] != 'OK' && $json_a['status'] != 'ZERO_RESULTS'){
                    //var_dump($json_a);
                    //exit(1);
                }

            }

        } catch(Exception $ex ){

        }
        return $return;
    }

    public function get_geo_from_postcode(){
        //http://maps.google.com/maps/api/geocode/json?components=country:GB|postal_code:bs&sensor=false
    }

public function get_geo() {
		foreach($this->get_all()  as $row){
			if($row->B_Lat == null){


				$fullurl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $row->B_Address1 . ",+" . $row->B_Address2 . ",+" . $row->B_Address3 . ",+" . $row->B_Postcode . ",+" . $row->B_CountryCode . "&key=AIzaSyAjYa60H5ot0DRDVbERYZsuJNrjzv9FRKs&sensor=true";
				$fullurl = str_replace(" ", "+",$fullurl);

				//echo $row->B_CompanyName.' - '.$fullurl.'<br/>';

				try{
					$string = file_get_contents($fullurl); // get json content
					$json_a = json_decode($string, true); //json decoder


					if($json_a['status']=='OVER_QUERY_LIMIT'){
						echo "Could not retrieve geolocation for ". $row->B_CompanyName . " - " .  $row->B_Postcode . "<br>"
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

/* End of file users.php */
/* Location: ./application/models/auth/users.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lucky_number_model extends CI_Model {

	public function parse($filename)
	{
		$this->parseXml($filename);
		
	}
	
	private function parseXml($filename){
		$this->load->helper('file');
		$xmlString = read_file( $filename );
		//var_dump($xmlString);
		$xml=simplexml_load_string($xmlString);
		$country = '';
		$category = '';
		if($xml != null){

		$root_attributes=$xml->attributes();
		
		//var_dump($xml);
		
		$country = $root_attributes['country'];
		$category = $root_attributes['category'];
		
		$event_type_id = $this->insertEventType($root_attributes);
		}		
		if($country == "IE" && $category == "NB" ){
			foreach($xml->numbers_game as $numbers){
				$numbers_attributes=$numbers->attributes();

				//var_dump($numbers);
				$numbers_id = $this->insertNumbers($numbers_attributes,$event_type_id);
				if(isset($numbers->numbers_event)){
					foreach($numbers->numbers_event as $numbers_event){
						//var_dump($numbers_event);
						$event_attributes=$numbers_event->attributes();
						$event_id = $this->insertNumbersEvent($event_attributes,$numbers_id);
						if( isset($numbers_event->drawn) ){
							foreach($numbers_event->drawn as $drawn){
								//var_dump($drawn);
								
								$selection_attributes=$drawn->attributes();
								$selection_id = $this->insertDrawn($selection_attributes,$event_id);
								
							}	
						}
					}
				}
			}
		}
		unset($xml);
		gc_collect_cycles();

	}
		
	private function insertDrawn($attributes,$event_id){
		$id = $this->isDrawnExist($attributes,$event_id);
		//var_dump($attributes);
		$this->db->set('bonusnumber',trim($attributes['bonusNumber']));
		$this->db->set('id_id',trim($attributes['id']));
		$this->db->set('number',trim($attributes['number']));
		$this->db->set('order',trim($attributes['order']));
		$this->db->set('number_event_id',$event_id);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_drawn');
		} else {
			$this->db->insert('t_drawn');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}
	
	private function isDrawnExist($attributes,$event_id){
		$this->db->where('id_id', trim($attributes['id']));
		$this->db->where('number_event_id',$event_id);
		$this->db->from('t_drawn');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}
	
	private function insertNumbers($attributes,$event_type_id){
		$id = $this->isNumbersExist($attributes,$event_type_id);
	
		$this->db->set('bonusnumber',trim($attributes['bonusNumber']));
		$this->db->set('code',trim($attributes['code']));
		$this->db->set('country',trim($attributes['country']));
		$this->db->set('date',trim($attributes['date']));
		$this->db->set('maxima',trim($attributes['maxima']));
		$this->db->set('minima',trim($attributes['minima']));
		$this->db->set('resultPlaces',trim($attributes['resultPlaces']));
		$this->db->set('status',trim($attributes['status']));
		$this->db->set('id_id',trim($attributes['id']));
		$this->db->set('event_id',$event_type_id);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_numbers');
		} else {
			$this->db->insert('t_numbers');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}
	
	private function isNumbersExist($attributes,$event_type_id){
		$this->db->where('code', trim($attributes['code']));
		$this->db->where('country', trim($attributes['country']));
		$this->db->where('id_id', trim($attributes['id']));
		$this->db->where('date', trim($attributes['date']));
		$this->db->where('event_id', $event_type_id);
	
		$this->db->from('t_numbers');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}
	
	private function isNumbersEventExist($attributes,$numbers_id){
		$this->db->where('number_id', $numbers_id);
		$this->db->where('time', trim($attributes['time']));
		$this->db->where('id_id', trim($attributes['id']));
		$this->db->from('t_number_event');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}
	
	private function insertNumbersEvent($attributes,$numbers_id){
		$id = $this->isNumbersEventExist($attributes,$numbers_id);
	
		$this->db->set('id_id',trim($attributes['id']));
		$this->db->set('message',trim($attributes['timestamp']));
		$this->db->set('num',trim($attributes['num']));
		$this->db->set('offtime',trim($attributes['offtime']));
		$this->db->set('status',trim($attributes['status']));
		$this->db->set('time',trim($attributes['time']));
		$this->db->set('number_id',trim($numbers_id));
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_number_event');
		} else {
			$this->db->insert('t_number_event');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}
	
	private function insertEventType($attributes){
		$id = $this->isEventTypeExist($attributes);
	
		$this->db->set('source',trim($attributes['source']));
		$this->db->set('country',trim($attributes['country']));
		$this->db->set('category',trim($attributes['category']));
		$this->db->set('version',trim($attributes['version']));
		$this->db->set('date',trim($attributes['date']));
		$this->db->set('timestamp',trim($attributes['timestamp']));
		$this->db->set('expiry',trim($attributes['expiry']));
		$this->db->set('route',trim($attributes['route']));
		$this->db->set('type',trim($attributes['type']));
		$this->db->set('id_id',trim($attributes['id']));
		$this->db->set('mnem',trim($attributes['mnem']));
		$this->db->set('book',trim($attributes['book']));
		$this->db->set('name',trim($attributes['name']));
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_event_type');
		} else {
			$this->db->set('id_id',trim($attributes['id']));
			$this->db->insert('t_event_type');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}
	
	
	private function isEventTypeExist($attributes){
		$this->db->where('source', trim($attributes['source']));
		$this->db->where('country', trim($attributes['country']));
		$this->db->where('category', trim($attributes['category']));
		$this->db->where('timestamp', trim($attributes['timestamp']));
		$this->db->from('t_event_type');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}
	
} 

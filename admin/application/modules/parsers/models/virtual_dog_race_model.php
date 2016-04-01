<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Virtual_dog_race_model extends CI_Model {

	public function parse($filename)
	{
		$this->parseXml($filename);

	}

	private function parseXml($filename){
		$this->load->helper('file');
		$xmlString = read_file( $filename );
		$root_attributes=null;
		$xmlString = str_replace('<!-- event master document -->','',$xmlString);
		$xmlString = str_replace('<?xml version="1.0" encoding="UTF-8"?>','',$xmlString);
		$xml=null;
		$xml=simplexml_load_string($xmlString);
		$country = '';
		$category = '';
		//var_dump($xml);
		if($xml != null){
			$root_attributes=null;
			$xmlattributes=$xml->attributes();
			if( $xmlattributes['id'] != null){
				$root_attributes=$xml->attributes();
			} else {
				//var_dump($xml->attributes());
			}

			$country = $root_attributes['country'];
			$category = $root_attributes['category'];

			if($root_attributes != null){
				$event_type_id = $this->insertEventType($root_attributes);
			} else {
				//	var_dump($xml->attributes());
			}
		} else {
			//var_dump($xmlString);
			//var_dump($category);
		}

		if($country == "VR" && $category == "DG" && $root_attributes != null ){
			foreach($xml->meeting as $meeting){
				$meeting_attributes=$meeting->attributes();

				//var_dump($meeting_attributes);
				$meeting_id = $this->insertMeeting($meeting_attributes,$event_type_id);

				if(isset($meeting->event)){
					foreach($meeting->event as $event){
						//var_dump($event);

						$event_attributes=$event->attributes();
						$event_id = $this->insertEvent($event_attributes,$meeting_id);
						if( isset($event->selection) ){
							foreach($event->selection as $selection){

								$selection_attributes=$selection->attributes();
								//var_dump($event_id);
								//var_dump($selection_attributes);
								$selection_id = $this->insertSelection($selection_attributes,$event_id);
								if( isset($selection->price) ){
									foreach($selection->price as $price){
										//var_dump($selection);

										$price_attributes=$selection->attributes();
										$this->insertprice($price_attributes,$selection_id);

									}
								}
							}
						}
						if( isset($event->result) ){
							foreach($event->result as $result){
								//var_dump($result);

								$result_attributes=$result->attributes();
								$result_id = $this->insertResult($result_attributes,$event_id);
								if( isset($result->position) ){
									foreach($result->position as $position){
										//var_dump($selection);

										$position_attributes=$position->attributes();
										$this->insertPosition($position_attributes,$result_id);

									}
								}
							}
						}
						if( isset($event->racebet) ){
							foreach($event->racebet as $racebet){
								//var_dump($result);

								$racebet_attributes=$racebet->attributes();
								$racebet_id = $this->insertRaceBet($racebet_attributes,$event_id);
								/*if( isset($racebet->betplace) ){
									foreach($racebet->betplace as $betplace){
										//var_dump($selection);

										$betplace_attributes=$betplace->attributes();
										$this->insertBetPlace($betplace_attributes,$racebet_id);

									}
								}*/
							}
						}

					}
				}
			}
		}

		unset($xml);
		gc_collect_cycles();

	}

	private function insertMeeting($attributes,$event_type_id){
		$id = $this->isMeetingExist($attributes,$event_type_id);

		$this->db->set('id_id',trim($attributes['id']));
		$this->db->set('name',trim($attributes['name']));
		$this->db->set('code',trim($attributes['code']));
		$this->db->set('country',trim($attributes['country']));
		$this->db->set('date',trim($attributes['date']));
		$this->db->set('sportcode',trim($attributes['sportcode']));
		$this->db->set('subcode',trim($attributes['subcode']));
		$this->db->set('status',trim($attributes['status']));
		$this->db->set('coverageCode',trim($attributes['coverageCode']));
		$this->db->set('event_type_id',trim($event_type_id));
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_meeting');
		} else {
			$this->db->insert('t_meeting');
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
		$this->db->set('mnem',trim($attributes['mnem']));
		$this->db->set('book',trim($attributes['book']));
		$this->db->set('name',trim($attributes['name']));
		$this->db->set('id_id',trim($attributes['id']));
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_event_type');
		} else {
			$this->db->insert('t_event_type');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}

	private function insertPrice($attributes,$selection_id){
		$id = $this->isPriceExist($attributes,$selection_id);

		$this->db->set('id_id',trim($attributes['id']));
		$this->db->set('dec',trim($attributes['dec']));
		$this->db->set('fract',trim($attributes['fract']));
		$this->db->set('mktnum',trim($attributes['mktnum']));
		$this->db->set('mkttype',trim($attributes['mkttype']));
		$this->db->set('time',trim($attributes['time']));
		$this->db->set('timestamp',trim($attributes['timestamp']));
		$this->db->set('selection_id',trim($selection_id));
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_price');
		} else {
			$this->db->insert('t_price');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}

	private function insertSelection($attributes,$event_id){
		$id = $this->isSelectionExist($attributes,$event_id);

		$this->db->set('name',trim($attributes['name']));
		$this->db->set('num',trim($attributes['num']));
		$this->db->set('drawn',$attributes['drawn']);
		$this->db->set('status',trim($attributes['status']));
		$this->db->set('event_id',trim($event_id));
		$this->db->set('id_id',$attributes['id']);

		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_selection');
		} else {
			$this->db->insert('t_selection');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}

	private function insertEvent($attributes,$meeting_id){
		$id = $this->isEventExist($attributes,$meeting_id);

		$this->db->set('name',trim($attributes['name']));
		$this->db->set('num',trim($attributes['num']));
		$this->db->set('time',trim($attributes['time']));
		$this->db->set('status',trim($attributes['status']));
		$this->db->set('meeting_id',trim($meeting_id));
		$this->db->set('id_id',$attributes['id']);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_events');
		} else {
			$this->db->insert('t_events');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}

	private function isMeetingExist($attributes,$event_type_id){
		$this->db->where('code', trim($attributes['code']));
		$this->db->where('name', trim($attributes['name']));
		$this->db->where('subcode', trim($attributes['subcode']));
		$this->db->where('date', trim($attributes['date']));
		$this->db->where('event_type_id', $event_type_id);
		$this->db->from('t_meeting');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}

	private function insertPosition($attributes,$result_id){
		$id = $this->isPositionExist($attributes,$result_id);

		$this->db->set('name',trim($attributes['name']));
		$this->db->set('num',trim($attributes['num']));
		$this->db->set('photo',trim($attributes['photo']));
		$this->db->set('position',trim($attributes['position']));
		$this->db->set('runner_number',trim($attributes['runnernumber']));
		$this->db->set('selectionref',trim($attributes['selectionref']));
		$this->db->set('sp',trim($attributes['sp']));
		$this->db->set('fav',trim($attributes['fav']));
		$this->db->set('result_id', $result_id);
		$this->db->set('id_id',$attributes['id']);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_position');
		} else {
			$this->db->insert('t_position');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}

	private function isPositionExist($attributes,$result_id){
		$this->db->where('id_id', trim($attributes['id']));
		$this->db->where('result_id', $result_id);
		$this->db->from('t_position');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}

	private function insertResult($attributes,$event_id){
		$id = $this->isResultExist($attributes,$event_id);

		$this->db->set('message',trim($attributes['message']));
		$this->db->set('nonrunners',$attributes['nonrunners']);
		$this->db->set('ran',trim($attributes['ran']));
		$this->db->set('settlingstatus',trim($attributes['settlingstatus']));
		$this->db->set('statuscode',trim($attributes['statuscode']));
		$this->db->set('weighedin',trim($attributes['weighedIn']));
		$this->db->set('event_id',trim($event_id));
		$this->db->set('id_id',$attributes['id']);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_result');
		} else {
			$this->db->insert('t_result');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}

	private function isResultExist($attributes,$event_id){
		$this->db->where('id_id', trim($attributes['id']));
		$this->db->where('event_id', $event_id);
		$this->db->from('t_result');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}

	private function insertRaceBet($attributes,$event_id){
		$id = $this->isRaceBetExist($attributes,$event_id);

		$this->db->set('amount',trim($attributes['amount']));
		$this->db->set('bettype',trim($attributes['bettype']));
		$this->db->set('instance',trim($attributes['instance']));
		$this->db->set('event_id',trim($event_id));
		$this->db->set('id_id',$attributes['id']);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_racebet');
		} else {
			$this->db->insert('t_racebet');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}

	private function isRaceBetExist($attributes,$event_id){
		$this->db->where('id_id', trim($attributes['id']));
		$this->db->where('event_id', $event_id);
		$this->db->from('t_racebet');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}
/*
	private function insertBetPlace($attributes,$racebet_id){
		$id = $this->isBetPlaceExist($attributes,$racebet_id);

		$this->db->set('amount',trim($attributes['amount']));
		$this->db->set('position',trim($attributes['position']));
		$this->db->set('selectionid',trim($attributes['selectionid']));
		$this->db->set('racebet_id',trim($racebet_id));
		$this->db->set('id_id',$attributes['id']);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('t_betplace');
		} else {
			$this->db->insert('t_betplace');
			$id = $this->db->insert_id() ;
		}
		return $id;
	}
*/
	private function isBetPlaceExist($attributes,$racebet_id){
		$this->db->where('id_id', trim($attributes['id']));
		$this->db->where('racebet_id', $racebet_id);
		$this->db->from('t_betplace');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}

	private function isEventTypeExist($attributes){
		$this->db->where('id_id',trim($attributes['id']));
		$this->db->from('t_event_type');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		//var_dump($id);
		return $id;
	}

	private function isPriceExist($attributes,$selection_id){
		$this->db->where('id_id', $attributes['id']);
		$this->db->where('selection_id', $selection_id);
		$this->db->from('t_price');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}

	private function isEventExist($attributes,$meeting_id){
		$this->db->where('id_id',trim($attributes['id']));
		$this->db->where('name',trim($attributes['name']));
		$this->db->where('num',$attributes['num']);
		$this->db->where('time',trim($attributes['time']));
		$this->db->where('meeting_id',trim($meeting_id));
		$this->db->from('t_events');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}

	private function isSelectionExist($attributes,$event_id){
		$this->db->where('id_id', $attributes['id']);
		$this->db->where('event_id', $event_id);
		$this->db->from('t_selection');
		$query = $this->db->get();
		$id = 0;
		foreach($query->result() as $row){
			$id = $row->id;
		}
		return $id;
	}


}

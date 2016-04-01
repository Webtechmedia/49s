<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parsers_model extends CI_Model {

	private function mainDirectory(){
		return "./../sis/messages/Masters/";
	}

	public function parse()
	{
		$directories = $this->getDirectories();
		//var_dump($directories);
		foreach($directories as $directoryDateKey => $directoryDate){
            //var_dump(count($directoryDate));

            if(count($directoryDate) == 0){
                //var_dump($this->mainDirectory() . $directoryDateKey );
                rmdir ($this->mainDirectory() . $directoryDateKey );
            }
            foreach($directoryDate as $directorySportKey => $directorySport){
				//var_dump(count($directorySport));
				if(count($directorySport) == 0){
					//var_dump($this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey);
					
					echo 'Remove - '.$this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey. PHP_EOL;
					
					rmdir ($this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey);
				}
				foreach($directorySport as $xmlFileKey => $xmlFile){
                    //var_dump('1');
                    //var_dump($directoryDateKey);
                    //var_dump('2');
                    //var_dump($directorySportKey);
                    //var_dump('3');
                    //var_dump($xmlFile);
                    //var_dump('============');

                    if(!is_array($xmlFile)){

                    $full_path = $this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey . "/" . $xmlFile;
					if (strpos($xmlFile, '.xml') !== FALSE && strpos($xmlFile, '.xmls')  === FALSE ){
						// found xml
						if (strpos($xmlFile, 'VRDG') !== FALSE){
							echo $directoryDateKey.' - found - VGR file'. PHP_EOL;
							//echo 'Found it';
                            //$start_date = new DateTime();
                            $this->parseVirtualDogRace( $this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey . "/" . $xmlFile );
                            //$since_start = $start_date->diff(new DateTime());
                            //echo $since_start->days.' days total<br>';
                            //echo $since_start->y.' years<br>';
                            //echo $since_start->m.' months<br>';
                            //echo $since_start->d.' days<br>';
                            //echo $since_start->h.' hours<br>';
                            //echo $since_start->i.' minutes<br>';
                            //echo $since_start->s.' seconds<br>';
						} else if (strpos($xmlFile, 'VRHR') !== FALSE){
							echo $directoryDateKey.' - found - VHR file'. PHP_EOL;
							// found "virdual horse race"
							//echo 'Found it';
                            //$start_date = new DateTime();
                            $this->parseVirtualHorseRace( $this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey . "/" . $xmlFile );
                            //$since_start = $start_date->diff(new DateTime());
                            //echo '<br>' . $since_start->days.' days total<br>';
                            //echo $since_start->y.' years<br>';
                            //echo $since_start->m.' months<br>';
                            //echo $since_start->d.' days<br>';
                            //echo $since_start->h.' hours<br>';
                            //echo $since_start->i.' minutes<br>';
                            //echo $since_start->s.' seconds<br>';
						} else if (strpos($xmlFile, 'UK49') !== FALSE){
							echo $directoryDateKey.' - found - 49 file'. PHP_EOL;
							// found "uk 49"
							//echo 'Found it';
                            //$start_date = new DateTime();
                            $this->parseUK49( $this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey . "/" . $xmlFile );
                            //$since_start = $start_date->diff(new DateTime());
                            //echo '<br>' . $since_start->days.' days total<br>';
                            //echo $since_start->y.' years<br>';
                            //echo $since_start->m.' months<br>';
                            //echo $since_start->d.' days<br>';
                            //echo $since_start->h.' hours<br>';
                            //echo $since_start->i.' minutes<br>';
                            //echo $since_start->s.' seconds<br>';
						} else if (strpos($xmlFile, 'IEILNG') !== FALSE){
							echo $directoryDateKey.' - found - ILB file'. PHP_EOL;
							// found "luckynumber"
							//echo 'Found it';
							$this->parseLuckyNumber( $this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey . "/" . $xmlFile );
						} else if (strpos($xmlFile, 'UKRANG') !== FALSE){
							echo $directoryDateKey.' - found - RAPIDO file'. PHP_EOL;
							// found "rapido"
							//echo 'Found it';
							$this->parseRapido( $this->mainDirectory() . $directoryDateKey . "/" . $directorySportKey . "/" . $xmlFile );
						} else {
							// not xml
							var_dump($xmlFile);
						}
						//var_dump($xmlFile);

						try {
							if (!file_exists('./../parsed/Masters/' . $directoryDateKey . "/" . $directorySportKey . "/")) {
								$www = mkdir('./../parsed/Masters/' . $directoryDateKey . "/" . $directorySportKey . "/" , 0777, true);
							}
						} catch (Exception $e) {
							//echo 'Caught exception: ',  $e->getMessage(), "\n";
						}

                        try {
                            $date_dir = new DateTime($directoryDateKey) ;
                            $date_now = new DateTime('-2 days');
                            $interval = $date_now->diff($date_dir);
                            //echo "interval " . $interval->format('%R');
                            if($date_now > $date_dir  ){
                            //if( $interval->format('%R') == '-' ){
                                $move_resultt = rename( $full_path , str_replace("sis/messages", "parsed", $full_path) );
                                if(!$move_resultt){
                                    echo (str_replace("sis/messages", "parsed", $full_path));
                                    //die;
                                }
                            }

                        } catch (Exception $e) {
                            //echo 'Caught exception: ',  $e->getMessage(), "\n";
                        }

					} else {
						// not xml

					}
                    }

                }
				//var_dump($directoryDateKey . '   ' . $directorySportKey );
			}
		}
	}

	private function getDirectories(){
		$this->load->helper('directory');

		$map = directory_map( $this->mainDirectory() );
		//var_dump($map);
		return $map;
	}

	private function parseVirtualDogRace($filename){
		$this->load->model('Virtual_dog_race_model');

		$this->Virtual_dog_race_model->parse($filename);
	}

	private function parseVirtualHorseRace($filename){
		$this->load->model('Virtual_horse_race_model');

		$this->Virtual_horse_race_model->parse($filename);
	}

	private function parseUK49($filename){
		$this->load->model('UK_49_model');

		$this->UK_49_model->parse($filename);
	}

	private function parseLuckyNumber($filename){
		$this->load->model('Lucky_number_model');

		$this->Lucky_number_model->parse($filename);
	}

	private function parseRapido($filename){
		$this->load->model('Rapido_model');

		$this->Rapido_model->parse($filename);
	}


}

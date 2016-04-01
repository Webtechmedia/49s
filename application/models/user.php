<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'libraries/password.php');
class User extends CI_Model
{

	public function login($email,$password)
	{
		$password = $this->encode($password);

		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('U_Email',$email);
		$this->db->where('U_Password',$password);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0){

			$this->session->sess_destroy();
			$this->session->sess_create();

			$date = date_create();
			$timestamp = date_timestamp_get($date);
			$serialized_token = $timestamp . '#' . $email;
			$encrypt_token = base64_encode( $this->encrypt($serialized_token,$this->code(),$this->iv(),8) );

			$this->session->set_userdata('logged_in',$encrypt_token);

			return $query->result();
		}else{
			return false;
		}

	}

	public function register($data){

		$this->session->sess_destroy();
		$this->session->sess_create();



		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('U_Email',$data['email']);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0){
			$this->session->sess_destroy();
			$this->session->sess_create();

			$this->session->set_flashdata('message', 'You have been registered earlier.');
			redirect(base_url('/'), 'location');
		}else{


			$this->db->set('U_FirstName',$data['name']);
			$this->db->set('U_Surname',$data['surname']);
			$this->db->set('U_Email',$data['email']);
			$this->db->set('U_Postcode',$data['postcode']);
			$this->db->set('U_Age',$data['age']);
			$this->db->set('U_Gender',$data['gender']);
			$this->db->set('U_Plays49s',$data['49s'] ? 1 : 0);
			$this->db->set('U_PlaysILB',$data['irish'] ? 1 : 0);
			$this->db->set('U_PlaysVHR',$data['vhr']? 1 : 0);
			$this->db->set('U_PlaysVGR',$data['vgr']? 1 : 0);
			$this->db->set('U_PlaysRapido',$data['rapido']);
			$this->db->set('U_SendPromotions',$data['conditions']? 1 : 0);
			$this->db->set('U_Address1',$data['address1']);
			$this->db->set('U_Address2',$data['address2']);
			$this->db->set('U_Town',$data['town']);
			$this->db->set('U_County',$data['county']);
			$this->db->set('U_Country',$data['country']);
			$this->db->set('U_Competitions',$data['conditions']? 1 : 0);
			$this->db->set('U_IsSubscribed',$data['conditions']? 1 : 0);

			$this->db->insert('49s_Users');

		}
	}






	public function is_logged($token){
		if(!empty($token)){
			$user_token = $this->decrypt(base64_decode($token),$this->code(),$this->iv(),8);
			$user_token_parts = explode("#", $user_token);
		}
		if($this->session->userdata('logged_in')!=''){
			$session_token = $this->decrypt(base64_decode($this->session->userdata('logged_in')),$this->code(),$this->iv(),8);
			$session_token_parts = explode("#", $session_token);
		}
 		if(isset($user_token_parts[1]) && isset($session_token_parts[1]) && $user_token_parts[1]==$session_token_parts[1]){
 			return true;
		}else{
			return false;
		}
	}

	private function encode($password){
		$hash = password_hash($password, PASSWORD_BCRYPT, array("salt" =>"kjdvfis7ft6she862hsl29" ,"cost" => 10));
		return $hash;
	}

	private function encrypt($text,$key,$iv,$bit_check) {
		try {
			$text_num =str_split($text,$bit_check);
			$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
			for ($i=0;$i<$text_num; $i++) {
				$text = $text . chr($text_num);
			}
			$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
			mcrypt_generic_init($cipher, $key, $iv);
			$decrypted = mcrypt_generic($cipher,$text);
			mcrypt_generic_deinit($cipher);
			return base64_encode($decrypted);
		} catch (Exception $e) {
			return 'Caught exception: ' .  $e->getMessage() . "\n";
		}

	}

	public function decrypt($encrypted_text,$key,$iv,$bit_check){
		$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
		mcrypt_generic_init($cipher, $key, $iv);
		$decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
		mcrypt_generic_deinit($cipher);
		$last_char=substr($decrypted,-1);
		for($i=0;$i<$bit_check-1; $i++){
			if(chr($i)==$last_char){
				$decrypted=substr($decrypted,0,strlen($decrypted)-$i);
				break;
			}
		}
		return $decrypted;
	}

	public function code(){
		return "E4HD9h4DhS23DYfhHemkS3Nf";
	}

	public function iv(){
		return "fYfhHeDm";
	}


}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */
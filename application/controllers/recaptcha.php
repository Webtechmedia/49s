<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recaptcha extends MX_Controller
{

	public function index()
	{
		show_404('page');
	}


	public function validate(){

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$json_input = trim(file_get_contents('php://input'));
			$_POST = json_decode($json_input,true);

			$params = array();
			$params['secret'] = '6LchGA0TAAAAAMKmKUVCqs0IVEAhN8XJlscV4Pn2'; 
			
			 
			if (!empty($_POST) && isset($_POST['g-recaptcha-response'])) {
				$params['response'] = urlencode($_POST['g-recaptcha-response']);
			}
			$params['remoteip'] = $_SERVER['REMOTE_ADDR'];

			$params_string = http_build_query($params);
			$requestURL = 'https://www.google.com/recaptcha/api/siteverify?' . $params_string;

			// Get cURL resource
			$curl = curl_init();

			// Set some options
			curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $requestURL,
			));

			// Send the request
			$response = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);

			$response = @json_decode($response, true);

			if ($response["success"] == true) {

				echo 'success';
			} else {

				echo 'failed';
			}
		} else {
			// get request.
		}

	}




}









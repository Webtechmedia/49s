<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Server_obj extends CI_Model
{
	public $success = true;
	public $error_msg = "";
	public $error_msg_array = array();
	public $error_code = 0;
	public $user_msg = "";

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */
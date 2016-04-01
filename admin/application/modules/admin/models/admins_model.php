<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins_model extends CI_Model {
	public function getAdmins()
	{

		$this->db->select('u.id,first_name,last_name,username,email,role,activated,last_login');
		$this->db->from('users u');
		$this->db->join('roles r', 'u.role_id = r.id');
		$query = $this->db->get();

		return $query->result();
	}
}
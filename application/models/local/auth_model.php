<?php
class Auth_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function login($username,$password) {
		$this->db->select('id, username, pw,lastlogin');
		$this->db->from('users');
		$this->db->where('username = ' . "'" . $username . "'");
		$this->db->where('password = ' . "'" . MD5($password) . "'");
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() ==1) {
			return $query->result_array();
		}
		else {
			return false;
		}
	}
}
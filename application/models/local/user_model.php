<?php

class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function register() {
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['email'] = $this->input->post('mail');
	}

	function getUserByEmail($mail) {

	}

	function getUserByUsername($user) {

	}
}
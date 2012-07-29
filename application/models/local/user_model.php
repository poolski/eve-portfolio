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

	function addCharToAccount($data) {
		$tableData = array(
				'characterID' => $data['characterID'],
				'userid' => $data['userid'],
				'vcode' => $data['vcode'],
				'name' => $data['name'],
				'owner' => $data['owner']
		);
		if(!$this->characterExists($data['characterID'])) {
			$this->db->insert('characters', $tableData);
			if($this->db->_error_message()) {
				return false;
			}
			else {
				return true;
			}
		}
		else {
			return false;
		}
	}

	public function listAccountCharacters() {
		$query = $this->db->get('characters');
		if($query->num_rows()>0) {
			return $query->result_array();
		}
		else {
			return false;
		}
	}

	private function characterExists($charID) {
		$query = $this->db->get_where('characters',array('characterID'=>$charID));
		if(count($query->result())>0) {
			return true;
		}
		else {
			return false;
		}
	}
}
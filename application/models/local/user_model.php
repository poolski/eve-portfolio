<?php

class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function register() {
		$data['username'] = $this->security->xss_clean($this->input->post('username'));
		$data['pw'] = MD5($this->security->xss_clean($this->input->post('password')));
		$data['email'] = $this->security->xss_clean($this->input->post('email'));

		// Does this email already exist?
		$mailExists = $this->getUserByEmail($data['email']);
		// Does this username already exist
		$nameExists = $this->getUserByUsername($data['username']);

		if($mailExists) {
			return -1;
		}
		if($nameExists) {
			return -2;
		}
		else {
			$this->db->insert('users', $data);
			if($this->db->_error_message()) {
				return false;
			}
			else {
				return true;
			}
		}
	}

	private function getUserByEmail($mail) {
		$result = $this->db->get_where('users',array('email'=>$email));
		if($result->num_rows() == 0) {
			return false;
		}
		else {
			return true;
		}
	}

	private function getUserByUsername($user) {
		$result = $this->db->get_where('users',array('username'=>$user));
		if($result->num_rows() == 0) {
			return false;
		}
		else {
			return true;
		}
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

	public function deleteCharacter($characterID){
		$owner = $this->session->userdata('id');
		$query = $this->db->delete('characters',array('characterID'=>$characterID,'owner'=>$owner));
		if($query->num_rows()==0) {
			return false;
		}
		else {
			return true;
		}
	}

	public function listAccountCharacters() {
		$owner = $this->session->userdata('id');
		$query = $this->db->get_where('characters',array('owner'=>$owner));
		if($query->num_rows()>0) {
			return $query->result_array();
		}
		else {
			return false;
		}
	}

	private function characterExists($characterID) {
		$query = $this->db->get_where('characters',array('characterID'=>$characterID));
		if(count($query->result())>0) {
			return true;
		}
		else {
			return false;
		}
	}
}
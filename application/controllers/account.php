<?php
class Account extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('eveapi/account_model');
		$this->load->model('eveapi/character_model');
		$this->load->model('local/user_model');
		$this->load->model('local/login_model');
		$this->login_model->check_isvalidated();
	}
	public function index() {
		$data['title'] = "Your characters";
		if($this->session->flashdata('msg')=="") {
			$data['msg'] = NULL;
		}
		else {
			$data['msg'] = $this->session->flashdata('msg');
		}
		$data['alert_class'] = "alert-notice";
		//$result = $this->account_model->characters();
		$result = $this->user_model->listAccountCharacters();
		$characters = array();
		foreach($result as $char) {
			if(is_array($char) && array_key_exists('name', $char)) {
				$balance = $this->character_model->accountBalance($char['characterID']);
				$characters[] = array("name" => $char['name'],"characterID" => $char['characterID'],
					"balance" => number_format($balance['attributes']['balance']));
			}
		}
		$data['characters'] = $characters;
		$this->load->view('templates/header',$data);
		$this->load->view('account/list_registered_characters',$data);
		$this->load->view('templates/footer');
	}
	public function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }    
}
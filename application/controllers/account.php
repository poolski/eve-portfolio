<?php
class Account extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('eveapi/account_model');
		$this->load->model('eveapi/character_model');
	}
	public function index() {
		$data['title'] = "Your characters";
		$result = $this->account_model->characters();
		$characters = array();
		foreach($result as $char) {
			if(is_array($char) && array_key_exists('name', $char)) {
				$balance = $this->character_model->accountBalance($char['characterID']);
				$characters[] = array("name" => $char['name'],"characterID" => $char['characterID'],"corporationName" => $char['corporationName'],
					"balance" => number_format($balance['attributes']['balance']));
			}
		}
		//$data['characters'] = $this->account_model->characters();
		$data['characters'] = $characters;
		$this->load->view('templates/header',$data);
		$this->load->view('account/list',$data);
		$this->load->view('templates/footer');
	}
}
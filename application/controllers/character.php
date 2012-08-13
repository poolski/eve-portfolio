<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Character extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('eveapi/character_model');
		$this->load->model('eveapi/account_model');
		$this->load->model('evecentral/market_model');
		$this->load->model('local/login_model');
		$this->login_model->check_isvalidated();
	}
	
	public function index($msg = NULL) {
		if($msg) {
			$this->session->set_flashdata('msg',$msg);
		}
		else {
			$this->session->set_flashdata('msg','How about specifying a character, dick?');
		}
		redirect(base_url());
	}

	public function detail($characterID = NULL) {
		if(!$characterID) {
			$this->index('You\'ll be wanting to choose a character!');
		}
		else {
			$items = array();
			$itemsWithCounts = array();
			$assets = $this->character_model->listAssets($characterID);
			$attribs = $this->character_model->characterSheet($characterID);
			$marketOrders = $this->character_model->marketOrders($characterID);
			$portraitURL = $this->character_model->characterPortraitURL($characterID);
			if(!$assets) {
				$this->index('That character either doesn\'t belong to this API key or you\'re a liar');
			}
			else {
				$data['assets'] = $assets;
				$data['attribs'] = $attribs;
				$data['marketOrders'] = $marketOrders;
				$data['portraitURL'] = $portraitURL;
				$data['title'] = $this->character_model->characterName($characterID);
				$this->load->view('templates/header',$data);
				$this->load->view('character/index',$data);
				$this->load->view('templates/footer');
			}
		}
	}

	// This function is used for testing shit. It doesn't get called in regular use. It's called in 
	// /character/assets/xxxxxxxxx and nowhere else. 
	public function assets($characterID = NULL) {
		if(!$characterID) {
			$this->index('Quit being a douche and hacking other peoples\' characters, you faggot');
		}
		$data['title'] = $this->character_model->characterName($characterID)."'s assets";
		$items = array();
		$itemsWithCounts = array();
		$result = $this->character_model->listAssets($characterID);
		if(!$result) {
			$this->index('That character either doesn\'t belong to this API key or you\'re a liar');
		}
		else {
			$data['title'] = $this->character_model->characterName($characterID);
			$data['assets'] = $result;
			$this->load->view('templates/header',$data);
			$this->load->view('character/assets',$data);
			$this->load->view('templates/footer');
		}
	}

	private function filterByLocation($assets, $location = 60003760) {

	}
}
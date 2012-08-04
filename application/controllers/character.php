<?php 
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
			$result = $this->character_model->listAssets($characterID);
			$attribs = $this->character_model->characterSheet($characterID);
			if(!$result) {
				$this->index('That character either doesn\'t belong to this API key or you\'re a liar');
			}
			else {
				foreach ($result as $item) {
	            	$items[] = $item;
		        }
		        $itemsWithCounts = $this->character_model->stack($items);
		        //var_dump($itemsWithCounts);
				//$data['characters'] = $this->account_model->characters();
				$data['assets'] = $itemsWithCounts;
				$data['attribs'] = $attribs;
				$data['title'] = $this->character_model->characterName($characterID);
				$this->load->view('templates/header',$data);
				$this->load->view('character/index',$data);
				$this->load->view('templates/footer');
			}
		}
	}

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
			foreach ($result as $item) {
	            $items[] = $item;
	        }
	        $itemsWithCounts = $this->character_model->stack($items);
	        //var_dump($itemsWithCounts);
			//$data['characters'] = $this->account_model->characters();
			$data['assets'] = $itemsWithCounts;
			$this->load->view('templates/header',$data);
			$this->load->view('character/assets',$data);
			$this->load->view('templates/footer');
		}
	}

	private function filterByLocation($assets, $location = 60003760) {

	}
}
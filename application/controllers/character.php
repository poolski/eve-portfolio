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

	public function assets($characterID = NULL) {
		if(!$characterID) {
			$this->index('Quit being a douche and hacking other peoples\' characters, you faggot');
		}
		$data['title'] = $this->character_model->characterName($characterID)."'s assets";
		$items = array();
		$result = $this->character_model->listAssets($characterID);
		if(array_key_exists('error', $result)) {
			$this->index('That character either doesn\'t belong to this API key or you\'re a liar');
		}
		else {
			foreach ($this->search($result, 'typeID') as $item) {
	            $items[] = $this->market_model->getItemName($item['typeID']);
	        }
			//$data['characters'] = $this->account_model->characters();
			$data['assets'] = $items;
			$this->load->view('templates/header',$data);
			$this->load->view('character/assets',$data);
			$this->load->view('templates/footer');
		}
	}
	private function search($array, $key) {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]))
                $results[] = $array;

            foreach ($array as $subarray)
                $results = array_merge($results, $this->search($subarray, $key));
        }

        return $results;
    }
}
<?php 
class Character extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('eveapi/character_model');
		$this->load->model('eveapi/account_model');
		$this->load->model('evecentral/market_model');
	}
	public function assets($characterID) {
		$data['title'] = "Assets for: ".$characterID;
		$items = array();
		$result = $this->character_model->listAssets($characterID);
		foreach ($this->search($result, 'typeID') as $item) {
            $items[] = $this->market_model->getItemName($item['typeID']);
        }
		//$data['characters'] = $this->account_model->characters();
		$data['assets'] = $items;
		$this->load->view('templates/header',$data);
		$this->load->view('character/assets',$data);
		$this->load->view('templates/footer');
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
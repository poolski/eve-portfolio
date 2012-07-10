<?php
include("ecapi.php");
include("eveapi.php");

class App {
	var $account;
	var $character;
	var $market;

	var $id;
	var $vcode;
	var $charID;
	function App($id,$vcode) {
		$this->account = new Account($id, $vcode);
		$this->character = new Character($id, $vcode);
		$this->market = new market();
		$this->id = $id;
		$this->vcode = $vcode;
		// Change this to be pulled from an actual account query later
		$this->charID = 630723329;
	}
	function getAssetPrices() {
		$assets = $this->character->assetList();
		$array = $this->character->process($assets)->result->rowset;
		foreach($array->children() as $rows) {
			print_r(array_search('60003760',$rows));
		}
		//print_r($array->result->rowset);
		//$this->market->get_price($itemID);
	}
	function search($array, $key, $value)
	{
		$results = array();

		if (is_array($array))
		{
			if (isset($array[$key]) && $array[$key] == $value)
				$results[] = $array;

			foreach ($array as $subarray)
				$results = array_merge($results, search($subarray, $key, $value));
		}

		return $results;
	}
	function listCharacters() {
		$data = $this->account->characters();
		$expires = $this->account->getExpiry($data);
		$chars = $data->result->rowset;
		foreach ($chars->row as $char => $values) {
			print_r($values->attributes());
		}
		
	}
	function selectCharacter($charID) {
		
	}
}
$app = new App("210429", "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");
$app->listCharacters();
?>
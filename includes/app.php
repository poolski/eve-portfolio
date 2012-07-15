<?php
include("ecapi.php");
include("eveapi.php");
include("includes/utils.php");
include("configs/config.php");
include_once("includes/mysql.php");

class App {
	var $account;
	var $character;
	var $market;
	var $db;
	var $id;
	var $vcode;
	var $charID;
	function App($id,$vcode) {
		$this->db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
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
		$items = array();
		$prices = array();
		foreach($this->search($assets, 'typeID') as $item) {
			//echo($i.": ".$item['itemID']."<br>");
			$items[] = $item['typeID'];
		}
		$results = $this->market->get_price($items);
		foreach($results as $item) {
			//$item['name'] = $this->getItemName($item['typeID']);
			//$prices[] = $item;
		}
		return $results;
	}
	/*
	 * @param $item is a flat array of items
	*/
	function getSinglePrice($item) {
		$u = new Util();
		$result = $this->market->get_price($item);
		$result[0]['name'] = $u->getItemName($item[0]);
		return $result;
	}
	function search($array, $key)
	{
		$results = array();

		if (is_array($array))
		{
			if (isset($array[$key]))
				$results[] = $array;

			foreach ($array as $subarray)
				$results = array_merge($results, $this->search($subarray, $key));
		}

		return $results;
	}
	function listCharacters() {
		$data = $this->account->characters();
		$expires = $this->account->getExpiry($data);
		$chars = $data['result']['rowset']['value'];
		$ret = array();
		foreach ($chars as $char) {
			foreach($char as $toon) {
				$ret[] = $toon['attributes'];
			}
		}
		return $ret;
	}
	function selectCharacter($charID) {

	}
	function getItemName($itemID) {
		$u = new Util();
		return $u->getItemName($itemID);
	}
}

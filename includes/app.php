<?php
include("ecapi.php");
include("eveapi.php");
include("models/utils.php");
include("configs/config.php");
include("includes/mysql.php");

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
		$items = array();
		$prices = array();
		$i = 0;
		foreach($this->search($assets, 'typeID') as $item) {
			//echo($i.": ".$item['itemID']."<br>");
			$items[] = $item['typeID'];
		}
		foreach ($items as $item) {
			//echo($item."<br>");
			$prices[] = $this->market->get_price(array($item));
		}
		return $prices;
	}
	function getSinglePrice($item) {
		$prices = array();
		$prices[] = $this->market->get_price(array($item));
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
}
$app = new App("210429", "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");

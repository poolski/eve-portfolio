<?php
class Market_model extends CI_Model {

public function __construct() {
	parent::__construct();
}

function getItemPrices($itemID) {
		$results = array();
		$ids = '';
		if(count($itemID) > 1) {
			foreach ($itemID as $item) {
				$ids .= "&typeid=".$item;
			}
		}
		else {
			$ids = "typeid=".$itemID[0];
		}
		$request = $ids . "&usesystem=30000142";
		$results = $this->call("marketstat",$request);
		$xml = simplexml_load_string($results);
		$typeresults = $xml -> marketstat -> type;
		$prices = array();
                $prices[0] = date("Y-m-d H:i:s");
		foreach ($typeresults as $item) {
			$id = $item -> attributes();
			$buy = $item -> buy -> max;
			$sell = $item -> sell -> min;
			$margin = round(100-(float)$buy/(float)$sell*100,2);
			$prices[] = array("typeID" => (int)$id, "name" => "", "buy" => number_format((float)$buy,2),"sell" => number_format((float)$sell,2), "margin" => $margin);
		}
		return $prices;
	}
}
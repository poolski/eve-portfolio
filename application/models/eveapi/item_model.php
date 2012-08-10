<?php
class Item_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	function getItemName($itemID) {
		$query = $this->db->get_where('typeIDs',array("typeID"=>$itemID));
		$result = $query->result_array();
		return $result[0]['itemName'];
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
		$prices['timestamp'] = date("Y-m-d H:i:s");
		foreach ($typeresults as $item) {
			$id = $item -> attributes();
			$buy = $item -> buy -> max;
			$sell = $item -> sell -> min;
			$margin = round(100-(float)$buy/(float)$sell*100,2);
			$prices[] = array("typeID" => (int)$id, "name" => "", "buy" => number_format((float)$buy,2),"sell" => number_format((float)$sell,2), "margin" => $margin);
		}
		return $prices;
	}

	public function checkTimestamp($itemID) {
		$now = date("Y-m-d H:i:s");
		$nowTime = strtotime($now);
		$limitTime = $nowTime - 1800;
		print_r($nowTime);
		echo("<br>");
		print_r($limitTime);
		//$query = $this->db->get_where('prices',array('typeID' => $itemID));
		//$result = $query->result_array();

	}

	private function getPriceFromDB($itemID) {
		
	}
}
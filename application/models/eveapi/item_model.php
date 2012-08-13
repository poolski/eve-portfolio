<?php
class Item_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('api');
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
		$results = $this->api->call("ecapi",null,"marketstat",$request);
		$xml = simplexml_load_string($results);
		$typeresults = $xml -> marketstat -> type;
		$prices = array();
		$prices['timestamp'] = date("Y-m-d H:i:s");
		foreach ($typeresults as $item) {
			$id = $item -> attributes();
			$buy = $item -> buy -> max;
			$sell = $item -> sell -> min;
			$margin = round(100-(float)$buy/(float)$sell*100,2);
			$prices[] = array("buy" => number_format((float)$buy,2),"sell" => number_format((float)$sell,2), "margin" => $margin);
		}
		return $prices;
	}

	public function checkTimestamp($itemID) {
		$sql = "SELECT * FROM prices WHERE `lastSync` > (NOW() - INTERVAL 30 MINUTE) AND `typeID` = $itemID";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result;
		}
		else {
			return false;
		}
	}

	private function getPriceFromDB($itemID) {

	}

	private function addPriceRecord($itemID) {

	}
}
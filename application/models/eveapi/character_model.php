<?php 
class Character_model extends CI_Model {
	var $keyID = "210429";
	var $vCode = "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw";
	public function __construct() {
		parent::__construct();
		$this->load->library('api');
		
		# TODO: load keyID and vCode from user session/DB
	}
	private function getApiDetails($characterID) {
		$query = $this->db->get_where('characters',array('characterID'=>$characterID));
		if($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result[0];
		}
		else {
			return false;
		}
	}
	// This one needs to be made more flexible so it pulls API details first from session (for initial adds)
	// and then from DB for standard listing. 
	public function accountBalance($characterID) {
		$args = array("keyID"=>$this->keyID,"vCode"=>$this->vCode,"characterID"=>$characterID);
		$ret = $this->api->call("eveapi","char","AccountBalance",$args);
		return $ret['result']['rowset']['value']['row'];
	}

	public function listAssets($characterID) {
		$api = $this->getApiDetails($characterID);
		if($api) {
			$args = array("keyID"=>$api['userid'],"vCode"=>$api['vcode'],"characterID"=>$characterID);
			$result = $this->api->call("eveapi","char","AssetList",$args);
			if(!array_key_exists('error', $result)) {
				$result = $this->api->search($result,'typeID');
				return $result;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	/* 
	 * Create 'stacks' of items as associative arrays based on typeID, combining multiple
	 * items of the same type into a single group, while still remaining individual.
	 */ 
	private function stack($items) {
		$result = array();
		foreach($items as $item) {
			if(array_key_exists($item['typeID'], $result)) {
				$result[$item['typeID']][] = $item;
			}
			else {
				$result[$item['typeID']] = $item;
			}
		}
		return $result;
	}

	private function stackTotal($stack) {
		$count = 0;
		foreach($stack as $items) {
			// If there is just one stack of items
			if(count($items) == 1) {
				$count = $items[0]['quantity'];
			}
			else if(count($items) > 1) {
				foreach($items as $item) {
					$count += $item['quantity'];
				}
			}
		}
		return $count;
	}
	public function characterSheet($characterID) {
		$args = array("keyID"=>$this->keyID,"vCode"=>$this->vCode,"characterID"=>$characterID);
		$result = $this->api->call("eveapi","char","CharacterSheet",$args);
		if($result) {
			if(!array_key_exists('error', $result)) {
					return $result;
				}
				else {
					return false;
				}
			}
		else {
			return false;
		}
	}

	public function characterName($characterID) {
		$charData = $this->getApiDetails($characterID);
		if($charData) {
			return $charData['name'];
		}
		else {
			$result = $this->character_model->characterSheet($characterID);
			return $result['result']['name'];
		}
	}
}
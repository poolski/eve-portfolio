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

	public function characterSheet($characterID) {
		$args = array("keyID"=>$this->keyID,"vCode"=>$this->vCode,"characterID"=>$characterID);
		return $this->api->call("eveapi","char","CharacterSheet",$args);
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
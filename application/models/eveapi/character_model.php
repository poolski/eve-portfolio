<?php 
class Character_model extends CI_Model {
	var $keyID = "210429";
	var $vCode = "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw";

	public function __construct() {
		parent::__construct();
		$this->load->library('api');
		# TODO: load keyID and vCode from user session/DB
	}
	public function accountBalance($characterID) {
		$args = array("keyID"=>$this->keyID,"vCode"=>$this->vCode,"characterID"=>$characterID);
		$ret = $this->api->call("eveapi","char","AccountBalance",$args);
		return $ret['result']['rowset']['value']['row'];
	}

	public function listAssets($characterID) {
		$args = array("keyID"=>$this->keyID,"vCode"=>$this->vCode,"characterID"=>$characterID);
		return $this->api->call("eveapi","char","AssetList",$args);
	}
}
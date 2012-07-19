<?php 
class Account_model extends CI_MODEL {
	
	function __construct() {
		parent::__construct();
		$this->load->library('api');
	}
	public function characters() {
		$args = array("keyID"=>210429,"vCode"=>"TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");
		$result = $this->api->call("eveapi","account", "Characters", $args);
		$ret = array();
		$timestamp = $result['cachedUntil'];
        if (isset($result['result'])) {
            $data = $result['result']['rowset']['value'];
            $ret[0] = $timestamp;
            foreach ($data['row'] as $dataItem) {
                if (isset($dataItem['attributes'])) {
                    $ret[] = $dataItem['attributes'];
                } else {
                    $ret[] = $dataItem;
                }
            }
        } else {
            $ret = $result;
        }
		return $ret;
	}
}
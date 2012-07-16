<?php
include_once("includes/shared.php");
class EVEAPI {
    var $shared;
	function EVEAPI($id,$vcode) {
		$this->host = "api.eveonline.com";
		$this->port = "443";
		$this->id = $id;
		$this->vcode = $vcode;
                $this->shared = new shared();
	}
	/* Calls the function on the EVE API
	 * @param namespace: choose which function group you're calling
	 * @param function: which function do you want to call?
	 * @param args: an array of arguments as key=>value named pairs
	 * @return a SimpleXML object built from the resulting XML.
	 */
	function call($namespace,$function,$args) {
		$fp = fsockopen("ssl://". $this->host , 443, $errno, $errstr, 30);
		if (!$fp) {
			echo "$errstr ($errno)<br />\n";
		} else {
			$arguments = "";
			foreach($args as $k => $v) {
				$arguments .= "&".$k."=".$v;
			}
			$out = "GET /".$namespace."/".$function.".xml.aspx?".$arguments." HTTP/1.1\r\n";
			$out .= "Host: " . $this->host . "\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$ret = '';
			while (!feof($fp)) {
				$ret.= fgets($fp, 128);
			}
			fclose($fp);
			$pattern="/^.*?(\<\?xml)/s";
			return $this->process($ret = substr(preg_replace($pattern,'<?xml',$ret),0,-6));
		}
	}
	private function process($xml) {
		$ret = $this->shared->xmlToArray(simplexml_load_string($xml));
		return $ret['eveapi'];
	}
	function getExpiry($object) {
		return $object['cachedUntil'];
	}
}
class Account extends EVEAPI {
	function Account($id, $vcode) {
		parent::EVEAPI($id, $vcode);
	}
	function characters() {
		$args = array("keyID"=>$this->id,"vCode"=>$this->vcode);
		return $this->call("account", "Characters", $args);
	}
	function selectCharacter($charID) {
		// Set cookie to hold character ID
	}
}

class Character extends EVEAPI {
	function Character($id, $vcode) {
		parent::EVEAPI($id, $vcode);
		$this->characterID = 630723329;
	}

	function assetList() {
		$args = array("keyID"=>$this->id,"vCode"=>$this->vcode,"characterID"=>$this->characterID);
		$result = $this->call("char","AssetList",$args);
		return $result;
	}
}

class Wallet extends EVEAPI {
    var $characterID;
    function __construct($id,$vcode,$char) {
        parent::EVEAPI($id, $vcode);
        $this->characterID = $char;
    }
    
    function getAccountBalance() {
        $args = array("keyID"=>$this->id,"vCode"=>$this->vcode,"characterID"=>$this->characterID);
        $result = $this->call("char","AccountBalance",$args);
        return $result;
    }
}
<?php
class EVEAPI {
	function EVEAPI($id,$vcode) {
		$this->host = "api.eveonline.com";
		$this->port = "443";
		$this->id = $id;
		$this->vcode = $vcode;
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
	function process($xml) {
		return simplexml_load_string($xml);
	}
	function getExpiry($object) {
		return $object->cachedUntil;
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
}

class Character extends EVEAPI {
	function Character($id, $vcode) {
		parent::EVEAPI($id, $vcode);
		$this->characterID = 630723329;
	}

	function assetList() {
		$args = array("keyID"=>$this->id,"vCode"=>$this->vcode,"characterID"=>$this->characterID);
		return $this->call("char","AssetList",$args);
	}
}
?>
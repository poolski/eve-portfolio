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
	private function process($xml) {
		$ret = $this->xmlToArray(simplexml_load_string($xml));
		return $ret['eveapi'];
	}
	function getExpiry($object) {
		return $object['cachedUntil'];
	}
	/*
	 * Convert a SimpleXML object into an array (last resort).
	*
	* @access public
	* @param object $xml
	* @param boolean $root - Should we append the root node into the array
	* @return array
	*/
	private function xmlToArray($xml, $root = true) {
		if (!$xml->children()) {
			return (string)$xml;
		}
	
		$array = array();
		foreach ($xml->children() as $element => $node) {
			$totalElement = count($xml->{$element});
	
			if (!isset($array[$element])) {
				$array[$element] = "";
			}
	
			// Has attributes
			if ($attributes = $node->attributes()) {
				$data = array(
						'attributes' => array(),
						'value' => (count($node) > 0) ? $this->xmlToArray($node, false) : (string)$node
						// 'value' => (string)$node (old code)
				);
	
				foreach ($attributes as $attr => $value) {
					$data['attributes'][$attr] = (string)$value;
				}
	
				if ($totalElement > 1) {
					$array[$element][] = $data;
				} else {
					$array[$element] = $data;
				}
	
				// Just a value
			} else {
				if ($totalElement > 1) {
					$array[$element][] = $this->xmlToArray($node, false);
				} else {
					$array[$element] = $this->xmlToArray($node, false);
				}
			}
		}
	
		if ($root) {
			return array($xml->getName() => $array);
		} else {
			return $array;
		}
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
		$assets = array();
		return $result;
	}
}
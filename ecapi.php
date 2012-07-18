<?php
class xmlrpc{
	function xmlrpc() {
		$this->host = "api.eve-central.com";
		$this->port = 80;
		$this->basespace = "/api";
	}

	function call($method,$args) {
		$fp = fsockopen("api.eve-central.com", 80, $errno, $errstr, 30);
		if (!$fp) {
			echo "$errstr ($errno)<br />\n";
		} else {
			$out = "GET /api/".$method."?".$args." HTTP/1.1\r\n";
			$out .= "Host: " . $this->host . "\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$ret = '';
			while (!feof($fp)) {
				$ret.= fgets($fp, 128);
			}
			fclose($fp);
			$pattern="/^.*?(\<\?xml)/s";
			return $ret = preg_replace($pattern,'<?xml',$ret);
		}
	}
}

class market extends xmlrpc {
	var $namespace;
	function market() {
		parent::xmlrpc();
	}
	function get_price($itemID) {
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
?>
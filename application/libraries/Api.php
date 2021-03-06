<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class API {
	/* Calls the function on the EVE API
	 * @param namespace: choose which function group you're calling
	 * @param function: which function do you want to call?
	 * @param args: an array of arguments as key=>value named pairs
	 * @return a SimpleXML object built from the resulting XML.
	 */
	function call($dest,$namespace="char",$function,$args) {
		switch ($dest) {
			case "eveapi":
				return $this->callEveApi($namespace,$function,$args);
				break;
			case "ecapi":
				return $this->callEveCentralApi($function,$args);
				break;
		}
	}

	private function callEveApi($namespace,$function,$args) {
		$fp = fsockopen("ssl://api.eveonline.com", 443, $errno, $errstr, 30);
		if (!$fp) {
			echo "$errstr ($errno)<br />\n";
		} else {
			$arguments = "";
			foreach($args as $k => $v) {
				$arguments .= "&".$k."=".$v;
			}
			$out = "GET /".$namespace."/".$function.".xml.aspx?".$arguments." HTTP/1.1\r\n";
			$out .= "Host: api.eveonline.com\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$ret = '';
			while (!feof($fp)) {
				$ret.= fgets($fp, 128);
			}
			fclose($fp);
			$result = $this->process("eveapi",$ret);
			if(array_key_exists('error', $result)) {
				$data['error'] = $result['error']['value'];
				return $data;
			}
			else {
				return $result;
			}
		}
	}

	private function callEveCentralApi($function,$args) {
		$fp = fsockopen("api.eve-central.com", 80, $errno, $errstr, 30);
		if (!$fp) {
			echo "$errstr ($errno)<br />\n";
		} else {
			$out = "GET /api/".$function."?".$args." HTTP/1.1\r\n";
			$out .= "Host: api.eve-central.com\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$ret = '';
			while (!feof($fp)) {
				$ret.= fgets($fp, 128);
			}
			fclose($fp);
			$pattern="/^.*?(\<\?xml)/s";
			return $this->process("ecapi",$ret);
		}
	}

	private function process($source,$result) {
		if($source == "eveapi") {
			$pattern="/^.*?(\<\?xml)/s";
			$tmp = preg_replace($pattern,'<?xml',$result);
			$rawXML = strstr($tmp,"</eveapi>",true)."</eveapi>";
			$ret = $this->xmlToArray(simplexml_load_string($rawXML));
			return $ret['eveapi'];
			//return $this->standardise($ret['eveapi']);
		}
		else if($source == "ecapi") {
			$pattern="/^.*?(\<\?xml)/s";
			return preg_replace($pattern,'<?xml',$result);
		}
	}

	private function xmlToArray($xml, $root = true) {
        if (!$xml->children()) {
            return (string) $xml;
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
                    'value' => (count($node) > 0) ? $this->xmlToArray($node, false) : (string) $node
                        // 'value' => (string)$node (old code)
                );

                foreach ($attributes as $attr => $value) {
                    $data['attributes'][$attr] = (string) $value;
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

    private function standardise($result) {
        $timestamp = $result['cachedUntil'];
        //$data = $result['result']['rowset']['value']['row'];
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
        //$ret[] = $data;
        return $ret;
    }

    public function search($array, $key) {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]))
                $results[] = $array;

            foreach ($array as $subarray)
                $results = array_merge($results, $this->search($subarray, $key));
        }

        return $results;
    }
}
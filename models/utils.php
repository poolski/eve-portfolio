<?php 
class Util {
	/*
	* Convert a SimpleXML object into an array (last resort).
	*
	* @access public
	* @param object $xml
	* @param boolean $root - Should we append the root node into the array
	* @return array
	*/
	function xmlToArray($xml, $root = true) {
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

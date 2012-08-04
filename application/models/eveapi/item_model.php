<?php
class Item_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	function getItemName($itemID) {
		$query = $this->db->get_where('typeIDs',array("typeID"=>$itemID));
		$result = $query->result_array();
		return $result[0]['itemName'];
	}
}
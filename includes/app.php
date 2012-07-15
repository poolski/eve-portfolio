<?php

include("ecapi.php");
include("eveapi.php");
include("includes/utils.php");
include("configs/config.php");
include_once("includes/mysql.php");

class App {

    var $account;
    var $character;
    var $wallet;
    var $market;
    var $db;
    var $id;
    var $vcode;
    var $charID;

    function App($id, $vcode) {
        $this->charID = 630723329;
        $this->account = new Account($id, $vcode);
        $this->character = new Character($id, $vcode);
        $this->wallet = new Wallet($id, $vcode, $this->charID);
        $this->market = new market();
        $this->id = $id;
        $this->db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $this->db->connect();
        $this->vcode = $vcode;
        // Change this to be pulled from an actual account query later
    }

    function getAssetPrices() {
        $assets = $this->character->assetList();
        $items = array();
        $prices = array();
        foreach ($this->search($assets, 'typeID') as $item) {
            //echo($i.": ".$item['itemID']."<br>");
            $items[] = $item['typeID'];
        }
        $results = $this->market->get_price($items);
        foreach ($results as $item) {
            $name = $this->getItemName(array($item['typeID']));
            $item['name'] = $name;
            $prices[$item['typeID']] = $item;
        }
        return $prices;
    }

    /*
     * @param $item is a flat array of items
     */

    function getSinglePrice($item) {
        $u = new Util();
        $result = $this->market->get_price($item);
        $result[0]['name'] = $u->getItemName($item[0]);
        return $result;
    }

    function search($array, $key) {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]))
                $results[] = $array;

            foreach ($array as $subarray)
                $results = array_merge($results, $this->search($subarray, $key));
        }

        return $results;
    }

    function listCharacters() {
        $data = $this->account->characters();
        $expires = $this->account->getExpiry($data);
        $chars = $data['result']['rowset']['value'];
        $ret = array();
        foreach ($chars as $char) {
            foreach ($char as $toon) {
                $ret[] = $toon['attributes'];
            }
        }
        return $ret;
    }

    function selectCharacter($charID) {
        
    }

    /*
     * @param $typeID as array of typeIDs, even if there's just one. 
     */

    function getItemName($typeID) {
        //$this->db = Database::obtain();
        $sql = "SELECT * FROM items WHERE typeID in (";

        foreach ($typeID as $item) {
            $sql .= $item . ",";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ")";
        $result = $this->db->fetch_array($this->db->escape($sql));
        return $result[0]['itemName'];
    }

    function getBalance() {
        $result = $this->wallet->getAccountBalance();
        $timestamp = $result['cachedUntil'];
        $data = $result['result']['rowset']['value']['row']['attributes'];
        $ret = array($timestamp);
        foreach($data as $dataItem) {
            $ret[] = $dataItem;
        }
        return $ret;
    }

}

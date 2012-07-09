<?php
include("ecapi.php");
include("eveapi.php");

$acc = new Account("210429", "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");
print_r($acc->characters());
$char = new Character("210429", "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");
print_r($char->assetList());
$market = new market();
$items = array(35,36,37,43);

//print_r($market->get_price($items));
?>
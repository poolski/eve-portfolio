<?php
include("app.php");

$app = new App("210429", "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");
$char = new Character("210429", "TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");
$items = array(35,36,37,43);

print_r($app->getAssetPrices());
?>
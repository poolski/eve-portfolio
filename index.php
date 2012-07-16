<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include("includes/app.php");

$app = new App(UID, VCODE);
$items = array("35", "36", "37", "43");
//var_dump($app->getItemName(array(35)));

//($app->getSinglePrice(array(35)));

//$prices = $app->getAssetPrices();
echo('<table width="600" cellpadding=5 cellspacing=2 border=0>');
echo('<tr style="text-align:left;"><th>Item</th><th>Buy Price</th><th>Sell Price</th><th>Margin</th></tr>');
foreach($prices as $item) {
    echo("<tr>");
    echo("<td>".$item['name']."</td><td>".$item['buy']."</td><td>".$item['sell']."</td><td>".$item['margin']."</td></tr>");
}
echo("</table>");

print_r($app->getBalance());
print_r($app->listCharacters());
?>
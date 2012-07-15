<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

include("includes/app.php");

$app = new App(UID, VCODE);
$char = new Character(UID, VCODE);
$items = array("35","36","37","43");
var_dump($app->getItemName(35));

//($app->getSinglePrice(array(35)));

var_dump($app->getAssetPrices());
//print_r($app->listCharacters());

?>
<?php
include("models/app.php");

$app = new App(UID, VCODE);
$char = new Character(UID, VCODE);
$items = array(35,36,37,43);

//print_r($app->getAssetPrices());
print_r($app->listCharacters());

?>
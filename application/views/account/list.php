<?php foreach ($characters as $char): ?>
    <?php if(is_array($char) && array_key_exists('name', $char)) {?>
    <div id="main">
    	<a href="character/assets/<?php echo($char['characterID']);?>"><h2><?php echo($char['name']); ?></h2></a>
        <p><?php echo("ID: ".$char['characterID']."<br>Corporation: ".$char['corporationName']."<br>Wallet balance: ".$char['balance']." ISK");?></p>
    </div>
    <?php }?>
<?php endforeach ?>
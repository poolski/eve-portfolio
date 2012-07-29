<?php foreach ($characters as $char): ?>
    <?php if(is_array($char) && array_key_exists('name', $char)) {?>
    	<a href="<?php echo base_url();?>character/assets/<?php echo($char['characterID']);?>"><h2><?php echo($char['name']); ?></h2></a>
        <p>
        	<?php echo("ID: ".$char['characterID']."<br>Wallet balance: ".$char['balance']." ISK");?>
        </p>
    <?php }?>
<?php endforeach ?>
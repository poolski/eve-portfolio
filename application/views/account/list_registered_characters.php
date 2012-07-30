<?php foreach ($characters as $char): ?>
    <?php if(is_array($char) && array_key_exists('name', $char)) {?>
    	<a href="<?php echo base_url();?>character/detail/<?php echo($char['characterID']);?>"><h2><?php echo($char['name']); ?></h2></a>
        <p>
        	<?php echo("Wallet balance: ".$char['balance']." ISK");?>
        </p>
    <?php }?>
<?php endforeach ?>
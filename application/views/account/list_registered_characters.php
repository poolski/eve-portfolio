<?php foreach ($characters as $char): ?>
    <?php if(is_array($char) && array_key_exists('name', $char)) {?>
    	<a href="<?php echo base_url();?>character/detail/<?php echo($char['characterID']);?>"><p><?php echo($char['name']); ?></p></a>
    <?php }?>
<?php endforeach ?>
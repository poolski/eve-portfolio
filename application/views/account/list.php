<?php 
foreach ($characters as $char): ?>
    <?php if(is_array($char) && array_key_exists('name', $char)) {?>
    	<?php echo form_open('add/process'); echo form_hidden('charID', $char['characterID']);?>
    	<h2>
    		<button class="btn">
    			<i class="icon-plus"></i> &nbsp;<?php echo($char['name']); ?>
    		</button>
    	</h2>
        <p>
        	<?php echo("Corporation: ".$char['corporationName']."<br>Wallet balance: ".$char['balance']." ISK");?>
        </p>
        
    <?php echo form_close();
}
endforeach;
?>
<a href="<?php echo(base_url("add/new_api"));?>" class="btn btn-warning">Use another API key</a>
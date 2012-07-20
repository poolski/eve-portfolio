<div id="main">
	<a href="<?php echo base_url();?>"><h2>Go back...</h2></a>
<ul>
<?php foreach ($assets as $item): ?>
    <li><?php echo("ID: ".$item[0]['typeID'].", Name: ".$item[0]['itemName']);?></li>
<?php endforeach ?>
</div>
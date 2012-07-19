<div id="main">
	<a href="<?php echo base_url();?>"><h2>Go back...</h2></a>
<ul>
<?php foreach ($assets as $item): ?>
    <li><?php echo("ID: ".$item."<br>");?></li>
<?php endforeach ?>
</div>
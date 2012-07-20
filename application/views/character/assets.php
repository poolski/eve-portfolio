<div id="main">
<ul>
<?php foreach ($assets as $item): ?>
    <li><?php echo("ID: ".$item[0]['typeID'].", Name: ".$item[0]['itemName']);?></li>
<?php endforeach ?>
</ul>
</div>
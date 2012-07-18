<?php foreach ($characters as $char): ?>
    <?php if(is_array($char) && array_key_exists('name', $char)) {?>
    <h2><?php echo($char['name']); ?></h2>
    <div id="main">
        <p><?php echo("ID: ".$char['characterID']."<br>Corporation: ".$char['corporationName']);?></p>
    </div>
    <?php }?>
<?php endforeach ?>
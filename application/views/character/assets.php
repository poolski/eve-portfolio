<blockquote>
	<p>Please note that only assets in Jita 4-4 Caldari Navy Assembly Plant <strong><a href="#" rel="tooltip" data-original-title="As in: IN YOUR HANGAR AND NOT IN A CONTAINER">in your item hangar</a></strong> will be displayed.<br>
	Also, any items in giant secure containers and hangars will not be shown.</p>
	<small>Functionality to do this will be added later</small>
</blockquote>
<div class="accordion" id="accordion0">
<?php $i = 0; $n = 0; foreach($assets as $stack) { 
  if(count($stack) == 4) { ?>
    <div class="accordion-group">
      <div class="accordion-heading">
        <span class="accordion-toggle" href="#">
          <?php echo($stack['name']." x ".$stack['total']);?>
          <div class="pull-right"><small><?php echo("B: ".$stack['prices'][0]['buy'].", S:".$stack['prices'][0]['sell'].", M: ".$stack['prices'][0]['margin']."%");?></small></div>
        </span>
      </div>
      <div class="accordion-body in">
      </div>
      </div><?php
  }
  else if(count($stack) > 4) { ?>
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo($n);?>">
          <?php echo($stack['name']." x ".$stack['total']." (multiple stacks)");?>
          <div class="pull-right"><small>B: 00.00, S: 00.00, %: 00.00</small></div>
        </a>
      </div>
      <div id="collapse<?php echo($n);?>" class="accordion-body collapse">
      <?php foreach($stack as $item) { if(is_array($item)) {?>
        <div class="accordion-inner">
          <?php echo($item['typeID']." - ".$stack['name']." x ".$item['quantity']); $n++;?>
        </div>
      <?php } } ?>
      </div>
    </div>
    <?php
  }
  $i++;
} ?>
</div>
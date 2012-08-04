<blockquote>
	<p>Please note that only assets in Jita 4-4 Caldari Navy Assembly Plant <strong><a href="#" rel="tooltip" data-original-title="As in: IN YOUR HANGAR AND NOT IN A CONTAINER">in your item hangar</a></strong> will be displayed.</p>
	<p>Also, any items in giant secure containers and hangars will not be shown.</p>
	<small>Functionality to do this will be added later</small>
</blockquote>
<?php foreach($assets as $item) { 

?>
<div class="span11"><?php var_dump($item);?></div>
<?php } ?>
<table class="table table-striped table-condensed table-bordered">
	<thead>
    <tr>
    	<th></th>
      	<th>ItemID</th>
      	<th>Name</th>
      	<th>Quantity</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0; foreach ($assets as $item): ?>
    <tr>
    	<?php echo("<td width='30px' style='text-align:center;'>".$i."</td><td>".$item[0]['typeID'].
    				"</td><td>".$item['name']."</td><td>".$item['total']."</td>");?>
    </tr>
    <?php $i++; endforeach ?>
	</tbody>
</table>

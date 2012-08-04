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
    	<?php echo("<td width='30px' style='text-align:center;'>".$i."</td><td colspan='3'>".var_dump($item)."</td>");?>
    	<?php //echo("<td width='30px' style='text-align:center;'>".$i."</td><td>".$item[0]['typeID'].
    				//"</td><td>".$item['name']."</td><td>".$item['total']."</td>");?>
    </tr>
<?php $i++; endforeach ?>
	</tbody>
</table>

<div id="main">
<table class="table table-striped table-condensed span4">
	<thead>
    	<tr>
      		<th>ItemID</th>
      		<th>Quantity</th>
    	</tr>
  	</thead>
  	<tbody>
<?php foreach ($assets as $item): ?>
    <tr><?php echo("<td>".$item[0]['typeID']."</td><td>".$item['total']."</td>");?></tr>
<?php endforeach ?>
	</tbody>
</table>
</div>
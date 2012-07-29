<div id="main">
<table class="table table-striped table-condensed">
	<thead>
    	<tr>
      		<th>ItemID</th>
      		<th>Name</th>
    	</tr>
  	</thead>
  	<tbody>
<?php foreach ($assets as $item): ?>
    <tr><?php echo("<td>".$item[0]['typeID']."</td><td>".$item[0]['itemName']."</td>");?></tr>
<?php endforeach ?>
	</tbody>
</table>
</div>
<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Character Sheet</a></li>
    <li><a href="#tab2" data-toggle="tab">Assets</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
    	<table class="table table-bordered span6">
    		<tbody>
    			<tr><td width="100px"><strong>Race</strong></td><td><?php echo $attribs['result']['race'];?></td></tr>
    			<tr><td width="100px"><strong>Gender</strong></td><td><?php echo $attribs['result']['gender'];?></td></tr>
    			<tr><td width="100px"><strong>Corp</strong></td><td><?php echo $attribs['result']['corporationName'];?></td></tr>
    			<tr><td width="100px"><strong>Wallet Balance</strong></td><td><?php echo number_format($attribs['result']['balance']);?> ISK</td></tr>
    		</tbody>
    	</table>
    </div>
    <div class="tab-pane" id="tab2">
      <table class="span6 table table-striped table-condensed table-bordered">
		<thead>
	    	<tr>
	      		<th>ItemID</th>
	      		<th>Name</th>
	    	</tr>
	  	</thead>
	  	<tbody>
		<?php foreach ($assets as $item): ?>
	    	<tr><?php echo("<td>".$item['typeID']."</td><td>".$item['itemName']."</td>");?></tr>
		<?php endforeach ?>
		</tbody>
	</table>
    </div>
  </div>
</div>
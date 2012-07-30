<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Character Sheet</a></li>
    <li><a href="#tab2" data-toggle="tab">Assets</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
    	<table class="table table-bordered">
    		<tbody>
    			<tr><td width="60px"><strong>Race</strong></td><td><?php echo $attribs['result']['race'];?></td></tr>
    			<tr><td width="60px"><strong>Gender</strong></td><td><?php echo $attribs['result']['gender'];?></td></tr>
    			<tr><td width="60px"><strong>Corp</strong></td><td><?php echo $attribs['result']['corporationName'];?></td></tr>
    			<tr><td width="60px"><strong>Wallet Balance</strong></td><td><?php echo number_format($attribs['result']['balance']);?> ISK</td></tr>
    		</tbody>
    	</table>
    </div>
    <div class="tab-pane" id="tab2">
      <table class="table table-striped table-condensed table-bordered">
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
  </div>
</div>
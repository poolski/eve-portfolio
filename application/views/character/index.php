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
      <blockquote>
        <p>Please note that only assets in Jita 4-4 Caldari Navy Assembly Plant <strong><a href="#" rel="tooltip" title="As in: IN YOUR HANGAR AND NOT IN A CONTAINER">in your item hangar</a></strong> will be displayed.</p>
        <p>Also, any items in giant secure containers and hangars will not be shown.</p>
        <small>Functionality to do this will be added later</small>
      </blockquote>
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
    </div>
  </div>
</div>
  <ul class="nav nav-tabs" id="#tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Character Sheet</a></li>
    <li><a href="#tab2" data-toggle="tab">Assets</a></li>
    <li><a href="#tab3" data-toggle="tab">Orders</a></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
    	<table class="table table-bordered">
    		<tbody>
    			<tr>
            <td width="100px"><strong>Race</strong></td><td><?php echo $attribs['result']['race'];?></td>
            <td rowspan="4" style="padding:0;"><img src="<?php echo $portraitURL;?>"/></td>
          </tr>
    			<tr><td width="100px"><strong>Gender</strong></td><td><?php echo $attribs['result']['gender'];?></td></tr>
    			<tr><td width="100px"><strong>Corp</strong></td><td><?php echo $attribs['result']['corporationName'];?></td></tr>
    			<tr><td width="100px"><strong>Wallet Balance</strong></td><td><?php echo number_format($attribs['result']['balance']);?> ISK</td></tr>
    		</tbody>
    	</table>
    </div>
    <div class="tab-pane" id="tab2">
      <?php $this->view('character/assets');?>
    </div>
    <div class="tab-pane" id="tab3"> 
      <?php $this->view('character/orders');?>
    </div>
  </div>
<script>
  $(function () {
    $('#tabs a:last').tab('show');
  })
</script>
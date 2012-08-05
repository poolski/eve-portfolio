<?php 
if($marketOrders['result']['rowset']['value']=="") {?>
<div class="alert alert-info">No orders currently up, looks like!</div>
<?php } 
else {
	print_r($marketOrders);
}
?>
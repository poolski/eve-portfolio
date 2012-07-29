<?php 
$userid = array(
            	'id'       		=> 'userid',
            	'name'			=> 'userid',
            	'placeholder' 	=> 'User ID',
            );
$vcode = array( 
				'id'			=> 'vcode',
				'name'			=> 'vcode',
				'placeholder'	=> 'vCode',
				'class'   		=> 'input-xlarge',
				);
echo form_open('add/process');
echo (form_input($userid)."<br>");
echo (form_input($vcode)."<br>");
echo form_submit("go","Check this API");
echo form_close();
?>
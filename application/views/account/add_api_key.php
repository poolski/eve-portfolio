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
$button = array(
				'name' 			=> 'go',
				'class'			=> 'btn btn-large btn-warning',
				'value'			=> 'Check this API',
				'type'			=> 'submit'
			);
echo form_open('add/process');
echo (form_input($userid)."<br>");
echo (form_input($vcode)."<br>");
echo (form_input($button));
echo form_close();
?>
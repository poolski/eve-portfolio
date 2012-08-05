<div class="hero-unit">
	<h1>Log in</h1>
	<p>Enter username, password, mash butan</p>
	<?php if(isset($loginmsg)) { ?>
      <div class="row">
        <div class="span4">
          <?php echo ('<div class="alert '.$alert_class.'">
          <a class="close" data-dismiss="alert">x</a>'.$loginmsg.'</div>');?>
        </div>
      </div>
    <?php } ?>
  	<div id="login_form">
        <form action="<?php echo base_url();?>account/process" method="post" name="process">
            <input placeholder="Your username" type="text" name='username' id='username'/><br />
            <input placeholder="Your password" type="password" name="password" id='password'/><br />
            <button class="btn-large btn" type="Submit" value="Login">Butan</button>
        </form>
    </div>
    </p>
</div>

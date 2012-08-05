<div class="hero-unit">
	<h1>Wanna register? Ok!</h1>
	<p>Need a username, a password and your email address.</p>
  <small>I don't give a flying fuck about password security. If you get hacked you can fuck yourself.</small>
  <p></p>
	<?php if(isset($loginmsg)) { ?>
      <div class="row">
        <div class="span4">
          <?php echo ('<div class="alert '.$alert_class.'">
          <a class="close" data-dismiss="alert">x</a>'.$loginmsg.'</div>');?>
        </div>
      </div>
    <?php } ?>
  	<div id="login_form">
        <form action="<?php echo base_url();?>account/do_register" method="post" name="process">
            <input placeholder="Your username" type="text" name='username' id='username'/>
            <input placeholder="you@example.com" type="email" name="email" id='email'/><br />
            <input placeholder="Your password" type="password" name="password" id='password'/>
            <input placeholder="Your password. Again." type="password" name="password2" id='password2'/><br />
            <button class="btn-large btn" type="Submit" value="Login">Butan</button>
        </form>
    </div>
    </p>
</div>

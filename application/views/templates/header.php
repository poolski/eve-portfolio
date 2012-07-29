<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title ?></title>
	<?php 
	echo(link_tag('static/css/bootstrap.css')); 
  echo(link_tag('static/css/default.css')); 
	echo(link_tag('static/css/bootstrap-responsive.css')); 
	?>
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="<?php echo base_url();?>">EVE-Portfolio</a>
        <?php if($this->session->userdata('validated')) {?>
        <ul class="nav pull-right">
          <div class="btn-group">
            <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
              <i class="icon-user icon-white"></i>
              <?php echo($this->session->userdata('username'));?> - Manage
              <b class="icon-chevron-down icon-white"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url();?>account">My Characters</a></li>
              <li><a href="<?php echo base_url();?>add">Add a character</a></li>
              <li><di</li>
              <li><a href="<?php echo base_url();?>account/logout">Log out</a></li>
            </ul>
          </div>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>

	<div class="container">
    <?php //echo set_breadcrumb(); ?>
    <!-- Masthead
      ================================================== -->
      <header class="jumbotron subhead" id="overview">
        <h1><?php echo $title ?></h1>        
      </header>
      <div class="row">
        <div class="span4">
          <?php if(isset($msg)) echo ('<div class="alert '.$alert_class.'">
          <a class="close" data-dismiss="alert">x</a>'.$msg.'</div>');?>
        </div>
      </div>
		
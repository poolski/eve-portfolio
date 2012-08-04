<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(isset($title)) { echo $title; }?></title>
	<?php 
	echo(link_tag('static/css/bootstrap.css')); 
  echo(link_tag('static/css/default.css')); 
	echo(link_tag('static/css/bootstrap-responsive.css')); 
  echo(link_tag('static/css/prettify.css'));
	?>
</head>
<body onload="prettyPrint()">
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="<?php echo base_url();?>">EVE-Portfolio</a>
        <!--Load the logged in header if the user is authenticated -->
        <?php 
          if($this->session->userdata('validated') && isset($characters)) { $this->view('templates/logged_in_header',$characters); } 
          else { $this->view('templates/logged_in_header'); }
        ?>
      </div>
    </div>
  </div>

	<div class="container">
    <?php //echo set_breadcrumb(); ?>
    <!-- Masthead
      ================================================== -->
      <?php if(isset($title)) { ?>
      <header class="jumbotron subhead" id="overview">
        <h1><?php echo $title; ?></h1>        
      </header>
      <?php } 
      if(isset($msg)) { ?>
      <div class="row">
        <div class="span6">
          <?php echo ('<div class="alert '.$alert_class.'">
          <a class="close" data-dismiss="alert">x</a>'.$msg.'</div>');?>
        </div>
      </div>
      <?php }?>
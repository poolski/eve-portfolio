<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php if(isset($title)) { echo $title; }?></title>
  <?php 
  echo(link_tag('static/css/bootstrap.css')); 
  echo(link_tag('static/css/prettify.css'));
  ?>
  <style>
  body {
    padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
  }
  p.footer{
    text-align: right;
    font-size: 11px;
    border-top: 1px solid #D0D0D0;
    line-height: 32px;
    padding: 0 10px 0 10px;
    margin: 20px 0 0 0;
  }

  p {
    margin: 12px 15px 12px 15px;
  }
  </style>  
  <?php
  echo(link_tag('static/css/bootstrap-responsive.css')); 
  ?>
</head>
<body onload="prettify()">
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
        <!-- Button that shows up once the navbar collapses -->
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="<?php echo base_url();?>">EVE-Portfolio</a>
        <!--Load the logged in header if the user is authenticated -->
        <?php 
        if($this->session->userdata('validated')) { 
          $this->view('templates/logged_in_header'); 
          if($this->session->userdata('type') == "admin") {
            $this->view('templates/admin_header');
          }
        }
        ?>
      </div>
    </div>
  </div>
  <div class="container">
    <?php if(isset($title)) { ?>
    <div class="page-header"><h1><?php echo $title; ?></h1></div>
    <?php } 
    if(isset($msg)) { ?>
    <div class="row">
      <div class="span6">
        <?php echo ('<div class="alert '.$alert_class.'">
        <a class="close" data-dismiss="alert">x</a>'.$msg.'</div>');?>
      </div>
    </div>
    <?php }?>
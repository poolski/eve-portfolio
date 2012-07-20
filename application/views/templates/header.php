<html>
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
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="<?php echo base_url();?>">EVE-Portfolio</a>
        <div class="nav-collapse">
         	<ul class="nav">
           	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url();?>"></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>

	<div class="container">
    <!-- Masthead
      ================================================== -->
      <header class="jumbotron subhead" id="overview">
        <h1><?php echo $title ?></h1>        
      </header>
		
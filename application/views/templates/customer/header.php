<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">


	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-default">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url(); ?>">Silicon</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class=""><a href="<?php echo base_url().'customer/postAdd'; ?>">Post Your Add <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Contact</a></li>
	        
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Search</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	      
	      <?php 
	      

				if($this->session->userdata('is_logged_in')){ ?>
					<li>
					<a href="<?php echo base_url()."customer/userInfo"; ?>">
					<?php echo $this->session->userdata('firstName'); ?>
					</a>

					<a href="<?php echo base_url().'index.php/customer/logout' ?>">Logout</a></li>
				<?php  }else{ ?>
					<li><a href="<?php echo base_url().'index.php/customer/login' ?>">Login</a></li>
				<?php
				}
	
	       ?>
	        
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
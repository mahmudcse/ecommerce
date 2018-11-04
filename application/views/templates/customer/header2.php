<!DOCTYPE html>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo base_url(); ?>assets/home/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url(); ?>assets/home/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="<?php echo base_url(); ?>assets/home/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="<?php echo base_url(); ?>assets/home/js/jquery-1.12.4.js"></script>

<script src="<?php echo base_url(); ?>assets/home/js/jquery-ui-1.12.1.js"></script>
<script src="<?php echo base_url(); ?>assets/home/js/bootstrap-3.3.7.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
<body>

<!-- Before product load -->

<!-- header -->
	<div class="agileits_header">
		<div class="w3l_offers">
			<a href="<?php echo base_url().'customer/postAdd'; ?>">Add Your Product</a>
		</div>
		
		<div class="w3l_search">
			<?php echo form_open('customer/searchedText'); ?>
				<input type="text" name="searchedText" placeholder="Search a product..." onfocus="this.value = '';" required="">
				<input type="submit" value="">
			<?php echo form_close(); ?>
		</div>

		<div class="product_list_header">  
			<a href="<?php echo base_url('customer/myCart'); ?>">
			<span id="cartCounter">
				
			
				Cart

				<?php 
						$this->db->where('sessionId', $this->input->cookie('not_logged_in_user'));
						$carts = $this->db->get('cart')->result_array();
						echo " (".count($carts).")";
				 ?>
			 </span>
			 </a>
		</div>

		<div class="w3l_header_right">
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
					<div class="mega-dropdown-menu">
						<div class="w3ls_vegetables">
							<ul class="dropdown-menu drp-mnu">
								
								<?php if($this->session->userdata('is_logged_in')){ ?>
								<li><a href="<?php echo base_url()."customer/userInfo"; ?>"><?php echo $this->session->userdata('firstName'); ?></a></li>
								<li><a href="<?php echo base_url().'customer/logout' ?>">Logout</a></li> 
								<?php }else{ ?>

								<li><a href="<?php echo base_url().'customer/login' ?>">Login</a></li> 
								<li><a href="">Sign Up</a></li>

								<?php } ?>
							</ul>
						</div>                  
					</div>	
				</li>
			</ul>
		</div>
		<div class="w3l_header_right1">
			<h2><a href="mail.html"><?php echo $this->session->userdata('firstName'); ?></a></h2>
		</div>
		<div class="clearfix"> </div>
	</div>
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left">
				<h1><a href="<?php echo base_url(); ?>"><span>Grocery</span> Store</a></h1>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="special_items">
					<li><a href="<?php echo base_url('customer/manageproduct'); ?>">My Products</a><i>/</i></li>
					<li><a href="<?php echo base_url('customer/myorders'); ?>">My Orders</a><i>/</i></li>
					<li><a href="products.html">Best Deals</a><i>/</i></li>
					<?php if($this->session->userdata('is_logged_in')): ?>		
							
						<li>
							<a href="<?php echo base_url('customer/wishList'); ?>">
								Wish List
							</a>
						</li>		
					<?php endif; ?>
				</ul>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+0123) 234 567</li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.html">Home</a><span>|</span></li>
				<li>Branded Foods</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <!-- Collect the nav links, forms, and other content for toggling -->
				<!-- <?php //include 'templateMenu.php'; ?> -->
				<?php include 'accordionMenu.php'; ?>

			</nav>
		</div>

		<div class="w3l_banner_nav_right">

		
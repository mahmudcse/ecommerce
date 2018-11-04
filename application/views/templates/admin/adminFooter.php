<div class="clearfix"> </div>
</div>
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="<?php echo base_url(); ?>assets/admin/index.html"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
		        <li><a href="#"><i class="fa fa-cogs"></i><span>Manage Business</span><span class="fa fa-angle-right" style="float: right"></span></a>
		        	
		          <ul>
		            <li><a href="<?php echo base_url(); ?>admin/customers">Customers</a></li>
		            <li><a href="<?php echo base_url('admin/orders'); ?>">Orders</a></li>
		            <li><a href="<?php echo base_url('admin/products'); ?>">Products</a></li>	            
		            <li><a href="<?php echo base_url('admin/payments'); ?>">Payments</a></li>	            
		            <li><a href="<?php echo base_url('admin/transactionNo'); ?>">Transaction Numbers</a></li>	            
		          </ul>
		        </li>

		        <li><a href="<?php echo base_url('admin/events') ?>"><i class="fa fa-cogs"></i><span>Manage Events</span><span class="fa fa-angle-right" style="float: right"></span></a>
		        </li>


		        <li id="menu-comunicacao" ><a href="#"><i class="fa fa-book nav_icon"></i><span>Manage Menu</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul id="menu-comunicacao-sub" >
		            <li id="menu-mensagens" style="width: 100%" ><a href="<?php echo base_url('admin/manageCategory'); ?>">Category</a>		              
		            </li>
		            <li id="menu-arquivos" ><a href="<?php echo base_url('admin/manageSubCat'); ?>">Subcategory</a></li>
		            <li id="menu-arquivos" ><a href="<?php echo base_url('admin/manageSpecificCat'); ?>">Specific Category</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="<?php echo base_url('assets/admin/') ?>js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url('assets/admin/') ?>/js/scripts.js"></script>
		<!--//scrolling js-->
<script src="<?php echo base_url('assets/admin/') ?>/js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>                     
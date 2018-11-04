
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">


	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>



<div class="container">

  <ul class="nav nav-tabs">
    <li class="
		<?php 
			if(isset($activeTab)){
	    		if($activeTab == 'userInfo'){
	    			echo "active";
	    		}
	    	}
		 ?>
    ">

    	<!-- <a data-toggle="tab" href="#userInfo">User Information</a> -->
    	<a data-toggle="" href="<?php echo base_url().'customer/userInfo'; ?>">User Information</a>

    </li>

    <li class="<?php 
    	if(isset($activeTab)){
    		if($activeTab == 'changePassword'){
    			echo "active";
    		}
    	}
     ?>">
    	<a data-toggle="tab" href="#changePassword">Change Password</a>
    </li>
    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
  </ul>

  <div class="tab-content">
    <div id="userInfo" class="tab-pane fade in
		<?php 
			if(isset($activeTab)){
	    		if($activeTab == 'userInfo'){
	    			echo "active";
	    		}
	    	}
		 ?>
    ">
      


 <!-- Edit account starts here      -->


	<style>
	  
	  .has-error{
	    color: red;
	  }
	  #flashdata{
	  	color: #E81123;
	  }
	</style>

	

	<div class="col-md-4 col-md-offset-4">
		<h5 id="flashdata">
			<?php 
				echo $this->session->flashdata('updateMsg');
			 ?>
		</h5>
		
	    <h3>Update Information</h3><br>
	</div>

	
	<?php include 'updateForm.php'; ?>
	

	 <br><br><br>



 <!-- Edit account closed here      -->
      
    </div>
	    <div id="changePassword" class="tab-pane fade in
			<?php 
		    	if(isset($activeTab)){
		    		if($activeTab == 'changePassword'){
		    			echo "active";
		    		}
		    	}
		     ?>
	    ">
	      <div class="col-md-4 col-md-offset-4">
			<h5 id="flashdata">
				<?php 
					echo $this->session->flashdata('updateMsg');
				 ?>
			</h5>
			
		    <h3>Change Password</h3><br>
		</div>
<!-- change password form starts -->

		<?php 
			include 'changePasswordForm.php';
		 ?>



<!-- change password form ends here		 -->
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>
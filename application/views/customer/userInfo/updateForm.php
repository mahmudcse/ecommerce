

<?php echo form_open('customer/updateInfoValidation'); ?>

	<div class="col-md-4 col-md-offset-4">
		<h5 id="flashdata">
			<?php 
				echo $this->session->flashdata('updateMsg');
			 ?>
		</h5>
		
	    <h3>Update Information</h3><br>
	</div>

		<div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('firstName'); ?>
		</div>


	  <div class="form-group col-md-4 col-md-offset-4">
	    <label for="email">First Name:</label><span class="has-error">  *</span>
	    <input type="text" name="firstName" 

	    	value="<?php 
	    			if(isset($firstName)){
	    				echo $firstName; 
	    			}else{
	    				echo set_value('firstName', '0');
	    			}
	    		?>" 

	    class="form-control" id="firstName"> 
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('lastName'); ?>
	  </div>

	  <div class="form-group col-md-4 col-md-offset-4">
	    <label for="email">Last Name:</label><span class="has-error">  *</span>
	    <input type="text" name="lastName" 

	    	value="<?php 
	    			if(isset($lastName)){
	    				echo $lastName; 
	    			}else{
	    				echo set_value('lastName', '0');
	    			}
	    		?>" 

	    class="form-control" id="lastName">
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('username'); ?>
		</div>

	  <div class="form-group col-md-4 col-md-offset-4">
	    <label for="email">Username:</label><span class="has-error">  *</span>
	    <input type="text" name="username" 

	    	value="<?php 
	    			if(isset($username)){
	    				echo $username; 
	    			}else{
	    				echo set_value('username', '0');
	    			}
	    		?>" 

	    class="form-control" id="username">
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('mobile'); ?>
		</div>

	  <div class="form-group col-md-4 col-md-offset-4">
	    <label for="mobile">Mobile:</label><span class="has-error">  *</span>
	    <input type="text" name="mobile" 

	    	value="<?php 
	    			if(isset($mobile)){
	    				echo $mobile; 
	    			}else{
	    				echo set_value('mobile', '0');
	    			}
	    		?>"  

	    class="form-control" id="mobile">
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('presentAddress'); ?>
	  </div>

	  <div class="form-group col-md-4 col-md-offset-4">
	    <label for="mobile">Present Address:</label>
	    <textarea name="presentAddress" value="" class="form-control" id="presentAddress">
	    	<?php 
	    			if(isset($presentAddress)){
	    				echo $presentAddress; 
	    			}else{
	    				echo set_value('presentAddress', '0');
	    			}
	    		?>
	    </textarea>
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('permanentAddress'); ?>
	  </div>

	  <div class="form-group col-md-4 col-md-offset-4">
	    <label for="mobile">Permanent Address:</label>
	    <textarea name="permanentAddress" class="form-control" id="permanentAddress">
	    	<?php 
	    			if(isset($permanentAddress)){
	    				echo $permanentAddress; 
	    			}else{
	    				echo set_value('permanentAddress', '0');
	    			}
	    		?>
	    </textarea>
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('subscriptionType'); ?>
	  </div>
	  <div class="form-group col-md-4 col-md-offset-4">
	    <label for="email">User Type:</label><span class="has-error">  *</span><br>

	    <input type="radio" name="subscriptionType" 
	    	value="1" 
	    		<?php 
	    			if(isset($subscriptionType)){
	    				if($subscriptionType == 1)
	    					echo "checked"; 
	    			}else{
	    				echo  set_radio('subscriptionType', '1');
	    			}
	    		
	    		?>> Buyer

	    <br><input type="radio" name="subscriptionType" value="2"

	    	<?php 
    			if(isset($subscriptionType)){
    				if($subscriptionType == 2)
    					echo "checked"; 
    			}else{
    				echo  set_radio('subscriptionType', '2');
    			} 
	    	

	    	?>> Single Seller

	    <br><input type="radio" name="subscriptionType" 

	    	value="3" 
	    		<?php 
	    			if(isset($subscriptionType)){
	    				if($subscriptionType == 3)
	    					echo "checked"; 
	    			}else{
	    				echo  set_radio('subscriptionType', '3');
	    			} 
	    		 

	    		?>
	    > Company Seller
	  </div>


	  <div class="form-group col-md-4 col-md-offset-4">
	    <input type="submit" class="btn btn-primary" name="submit" value="Update">
	  </div>
	 <?php echo form_close(); ?>
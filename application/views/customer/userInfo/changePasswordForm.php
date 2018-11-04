<?php echo form_open('customer/changePasswordValidation'); ?>

	<div class="col-md-4 col-md-offset-4 has-error">
		<?php 
			if(isset($success)){
				echo $success;
			}

		 ?>
	</div>

		<div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('curPassword'); ?>
		</div>


	  <div class="form-group col-md-4 col-md-offset-4">

	    <label for="email">Current Password:</label><span class="has-error">  *</span>
	    <input type="password" name="curPassword" value="<?php echo $this->input->post('curPassword'); ?>" class="form-control" id="curPassword"> 
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('newPassword'); ?>
		</div>


	  <div class="form-group col-md-4 col-md-offset-4">

	    <label for="email">New Password:</label><span class="has-error">  *</span>
	    <input type="password" name="newPassword" value="<?php echo $this->input->post('newPassword'); ?>" class="form-control" id="newPassword"> 
	  </div>

	  <div class="col-md-4 col-md-offset-4 has-error">
			<?php echo form_error('conPassword'); ?>
		</div>


	  <div class="form-group col-md-4 col-md-offset-4">

	    <label for="email">New Password:</label><span class="has-error">  *</span>
	    <input type="password" name="conPassword" value="<?php echo $this->input->post('conPassword'); ?>" class="form-control" id="conPassword"> 
	  </div>

	  <div class="form-group col-md-4 col-md-offset-4">
	    <input type="submit" class="btn btn-primary" name="submit" value="Change Password">
	  </div>



<?php echo form_close(); ?>
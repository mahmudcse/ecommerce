

  <div class="col-md-4 col-md-offset-4">
    <h3>Set new password</h3>
  </div>


<?php echo form_open('customer/new_password_validation'); ?>
	
	<input type="hidden" name="key" value="<?php if(isset($key)){ echo $key; }else{ echo $this->input->post('key'); }; ?>">
	
	<div class="col-md-4 col-md-offset-4">
		<?php echo form_error('password'); ?>
	</div>
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="pwd">Password:</label>
    <input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="pwd">
  </div>

	<div class="col-md-4 col-md-offset-4">
		<?php echo form_error('cpassword'); ?>
	</div>
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="cpassword">Confirm Password:</label>
    <input type="password" name="cpassword" class="form-control" id="cpassword">
  </div>

  <div class="form-group col-md-4 col-md-offset-4">
    <input type="submit" class="btn btn-success" name="submit" value="Reset Password">
  </div>
 <?php echo form_close(); ?>


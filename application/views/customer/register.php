<style>
  
  .has-error{
    color: red;
  }
</style>


<div class="col-md-4 col-md-offset-4">
    <h3>Create Account</h3><br>
</div>


<?php echo form_open('customer/signup_validation'); ?>

	<div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('firstName'); ?>
	</div>

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="email">First Name:</label><span class="has-error">  *</span>
    <input type="text" name="firstName" value="<?php echo $this->input->post('firstName'); ?>" class="form-control" id="firstName" required> 
  </div>

  <div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('lastName'); ?>
	</div>

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="email">Last Name:</label><span class="has-error">  *</span>
    <input type="text" name="lastName" value="<?php echo $this->input->post('lastName'); ?>" class="form-control" id="lastName" required>
  </div>

  <div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('username'); ?>
	</div>

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="email">User Name:</label><span class="has-error">  *</span>
    <input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control" id="username" required>
  </div>

	<div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('email'); ?>
	</div>

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="email">Email address:</label><span class="has-error">  *</span>
    <input type="email" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email">
  </div>

	<div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('password'); ?>
	</div>
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="pwd">Password:</label><span class="has-error">  *</span>
    <input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="pwd">
  </div>

	<div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('cpassword'); ?>
	</div>
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="pwd">Confirm Password:</label><span class="has-error">  *</span>
    <input type="password" name="cpassword" class="form-control" id="pwd">
  </div>

  <div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('mobile'); ?>
	</div>

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="mobile">Mobile:</label><span class="has-error">  *</span>
    <input type="text" name="mobile" value="<?php echo $this->input->post('mobile'); ?>" class="form-control" id="mobile" required>
  </div>

  <div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('presentAddress'); ?>
  </div>

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="mobile">Present Address:</label>
    <textarea name="presentAddress" value="<?php echo $this->input->post('presentAddress'); ?>" class="form-control" id="presentAddress">
    </textarea>
  </div>

  <div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('permanentAddress'); ?>
  </div>

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="mobile">Permanent Address:</label>
    <textarea name="permanentAddress" value="<?php echo $this->input->post('permanentAddress'); ?>" class="form-control" id="permanentAddress">
    </textarea>
  </div>

  <div class="col-md-4 col-md-offset-4 has-error">
		<?php echo form_error('subscriptionType'); ?>
  </div>
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="email">User Type:</label><span class="has-error">  *</span><br>
    <input type="radio" name="subscriptionType" value="1" <?php if($this->input->post('subscriptionType') == 1) echo "checked"; ?>> Buyer
    <br><input type="radio" name="subscriptionType" value="2" <?php if($this->input->post('subscriptionType') == 2) echo "checked"; ?>> Single Seller
    <br><input type="radio" name="subscriptionType" value="3" <?php if($this->input->post('subscriptionType') == 3) echo "checked"; ?>> Company Seller
  </div>


  <div class="form-group col-md-4 col-md-offset-4">
    <input type="submit" class="btn btn-success" name="submit" value="Sign Up">
  </div>
 <?php echo form_close(); ?>


 
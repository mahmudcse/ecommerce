<style>
  .has-error{
    color: red;
  }
</style>


  <div class="input-group col-md-4 col-md-offset-4">
    <h3>Forgot password</h3>
  </div>


 <?php echo form_open('customer/forgot_password_validation'); ?>

  
  <div class="input-group col-md-4 col-md-offset-4 has-error">
    <?php echo form_error('email'); ?>
  </div>
  <div class="input-group col-md-4 col-md-offset-4">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
  </div>
  <br>

  <div class="form-group col-md-4 col-md-offset-4">
    <input type="submit" class="btn btn-success" name="submit" value="Recover Password">
  </div>
  
<?php echo form_close(); ?>
<style>
  .has-error{
    color: red;
  }
  #fbicon img {
    height: 71px;
    width: 178px;
    margin-left: -13px;
}
</style>



  <div class="input-group col-md-4 col-md-offset-4">
    <h3>Login</h3>
  </div>

  <?php echo form_open('customer/login_validation'); ?>

  
  <div class="input-group col-md-4 col-md-offset-4 has-error">
    <?php echo form_error('email'); ?>
  </div>
  <div class="input-group col-md-4 col-md-offset-4">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
  </div>

  <div class="input-group col-md-4 col-md-offset-4 has-error">
    <?php echo form_error('password'); ?>
  </div>
  <div class="input-group col-md-4 col-md-offset-4">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <br>
  <div class="btn-group col-md-offset-4">
    <input type="submit" class="btn btn-primary" value="Login"> <span class="col-md-4 col-md-offset-4"><a href="<?php echo base_url('customer/forgot_password'); ?>">Forgot Password</a></span>
  </div>
  <br><br>
  <div class="btn-group col-md-offset-4">
    <a href="<?php echo base_url('index.php/customer/signup'); ?>">Create a new account</a>
  </div>
<!-- </form> -->
<?php echo form_close(); ?>

  <div class="btn-group col-md-offset-4">
    <span id="fbicon">
        <?php

            if(!empty($authUrl)) {
                echo '<a href="'.$authUrl.'"><img src="'.base_url().'assets/images/flogin.png" alt=""/></a>';
            }else{
              redirect('customer/login');
            ?>
            <div class="wrapper">
                <h1>Facebook Profile Details </h1>

                <div class="welcome_txt">Welcome <b><?php echo $userData['firstName']; ?></b></div>
                <div class="fb_box">
                    <p><b>Logout from <a href="<?php echo $logoutUrl; ?>">Facebook</a></b></p>
                </div>
            </div>
            <?php } ?>

    </span>
    <br><br><br>
  </div>

 
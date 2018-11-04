

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <?php echo form_open('customer/confirm_order_validation'); ?>

    <?php if(validation_errors()): ?>
      <div class="alert alert-danger">
        <?php echo validation_errors(); ?>
      </div>
    <?php endif; ?>

      <div class="accordion">
            
            <h3>Name</h3>
            <div class="form-group">
              <?php if($this->session->userdata('is_logged_in')): ?>
                  <input type="checkbox" name="auth_user_name_ordered" 

                  value="<?php 
                            $userId = $this->session->userdata('componentId');
                            $firstName = $this->db->get_where('users', array('componentId' => $userId))->row()->firstName;
                            $lastName = $this->db->get_where('users', array('componentId' => $userId))->row()->lastName;
                            $name = $firstName." ".$lastName;
                            echo $name;
                         ?>"
                  <?php echo set_checkbox('auth_user_name_ordered', $name); ?>

                  > <span> As in Profile</span>
                  <br>
                  Or
                  <br>
              <?php endif ?>
                <label class="control-label">First Name</label>
                <input type="text" class="form-control" name="firstName" placeholder="John" value="<?php echo set_value('firstName'); ?>">
                
                <label class="control-label">Last Name</label>
                <input type="text" class="form-control" name="lastName" placeholder="Doe" value="<?php echo set_value('lastName'); ?>">
            </div>


            <h3>eMail</h3>
            <div class="form-group">
              <?php if($this->session->userdata('is_logged_in')): ?>
                  <input type="checkbox" name="auth_user_email_ordered" 

                  value="<?php echo $this->session->userdata('email'); ?>"
                  <?php echo set_checkbox('auth_user_email_ordered', $this->session->userdata('email')); ?>

                  > <span> As in Profile</span>
                  <br>
                  Or
              <?php endif ?>
                <input type="email" class="form-control" name="email_ordered" placeholder="example@domain.com" value="<?php echo set_value('email_ordered'); ?>">
            </div>
            
            <h3>Mobile</h3>
            <div class="form-group">
              <?php if($this->session->userdata('is_logged_in')): ?>
                  <input type="checkbox" name="auth_user_mobile_ordered" 

                  value="<?php 
                            $userId = $this->session->userdata('componentId');
                            $user_mobile = $this->db->get_where('users', array('componentId' => $userId))->row()->mobile;
                            echo $user_mobile;
                         ?>"
                  <?php echo set_checkbox('auth_user_mobile_ordered', $user_mobile); ?>

                  > <span> As in Profile</span>
                  <br>
                  Or
              <?php endif ?>
                <input type="text" class="form-control" name="mobile_ordered" placeholder="0171116xxxx" value="<?php echo set_value('mobile_ordered'); ?>">
            </div>

            <h3>Address</h3>
            <div class="form-group">
              <?php if($this->session->userdata('is_logged_in')): ?>
                  <input type="checkbox" name="auth_user_address_ordered" 
                    value="<?php 
                            $user_present_address = $this->db->get_where('users', array('componentId' => $userId))->row()->presentAddress;
                            echo $user_present_address;
                          ?>"  
                    <?php echo set_checkbox('auth_user_address_ordered', $user_present_address); ?>
                  > 

                  <span> As in Profile</span>
                  <br>
                  Or
              <?php endif ?>
              <textarea name="shipping_address" class="form-control"><?php echo set_value('shipping_address'); ?></textarea>
            </div>

            <h3>Order Summery</h3>
            <?php include 'orderSummery.php'; ?>

            <h3>Payment Method</h3>
            <div class="form-group">
              <?php foreach($paymentMethods as $key => $method): ?>
                  <input type="radio" name="payment_method" value="<?php echo $method['componentId']; ?>" 
                    <?php 
                        echo set_radio('payment_method', $method['componentId']);
                     ?>
                  > <?php 
                  echo $method['name']; 

                  if(isset($paymentMethods[$key+1])){
                    echo "<br>";
                  }

                  ?>
              <?php endforeach; ?>

            </div>
      </div>
      <div form-group>
        <input type="submit" name="submit" value="Confirm" class="btn btn-success">
      </div>
      <?php echo form_close(); ?>
  </div>
</div>
<script>
  $( function() {
    $( ".accordion" ).accordion({
      collapsible: true,
      heightStyle: "content"
    });
  });

</script>
 
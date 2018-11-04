<!DOCTYPE html>
<html>
    <?php include 'adminLoginCss.php'; ?>

    <style>
      .has-error{
        color: red;
      }
    </style>
<body>

    <div id="clickToLogin" class="col-md-offset-5">
        <h5 class="has-error">
          <?php echo form_error('uname'); ?>
        </h5>
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
    </div>



<div id="id01" class="modal">

<?php echo form_open('admin/loginValidation', array('class' => 'modal-content animate')); ?>
  <!-- <form class="modal-content animate" action="/action_page.php"> -->
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="Avatar" class="avatar" width="100" height="100">
    </div>

    <div class="container">

      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <!-- <input type="submit" name="submit" value="Login"> -->

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
<?php echo form_close(); ?>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>

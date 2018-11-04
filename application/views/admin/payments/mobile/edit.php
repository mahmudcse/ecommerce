
 <div class="row">
 	<div class="col-md-12">
 		<div class="col-md-6 col-md-offset-3 form-group">
 			<label>Edit <?php echo $payment[0]['name'] ?> Info</label>

 			<?php echo form_open('admin/paymentModify'); ?>
 			<input type="hidden" name="paymentId" value="<?php echo $paymentId; ?>">
 			<textarea name="rules" class="form-control"><?php echo $payment[0]['Rules']; ?></textarea>
 			<input type="submit" name="submit" value="Submit" class="btn btn-default btn-sm">
 			<?php echo form_close(); ?>

 		</div>
 	</div>
 </div>
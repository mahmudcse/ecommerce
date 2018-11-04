<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h3>Payment Rule</h3>
			<p><?php echo $rules; ?></p>
		</div>
		<br><br><br>
		<div class="col-md-12 form-group">
			<div class="col-md-4 col-md-offset-3">
				<p>Please pay tk.<?php echo $total[0]['price']; ?> and submit the transaction number.</p>
				<label>Transaction No</label>
				<?php echo form_open('customer/saveTransaction'); ?>
					<input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
					<input type="text" class="form-control" name="transactionNo" value="<?php echo $total[0]['transaction_no']; ?>">
					<input type="submit" name="submit" value="Submit" class="btn btn-default">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
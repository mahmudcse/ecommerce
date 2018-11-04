<div class="row">
		<div class="col-md-12">
			<?php echo form_open('customer/myorders'); ?>
			<div class="col-md-3 form-group">
				<label for="searchedText" class="control-label">Searched Text</label>
				<input type="text" class="form-control" name="searchedText" value="<?php echo $searchedText; ?>">
			</div>
			<div class="col-md-3 form-group">
				<label class="control-label">&nbsp;</label><br>
				<input type="submit" name="submit" class="btn btn-default btn-sm" value="Submit">
			</div>
			<?php echo form_close(); ?>
			<div class="col-md-3">
				<label>&nbsp;</label>
				<p><?php echo $this->pagination->create_links(); ?></p>
			</div>
		</div>
	<div class="col-md-10 col-md-offset-1">
		<table class="table table-hover table-responsive">
			<caption>My Orders</caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Order Id</th>
					<th>Placement Date</th>
					<th>Payment Method</th>
					<th>Pay Now</th>
					<th>Payment Status</th>
					<th>Order Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php if(isset($my_orders)): foreach ($my_orders as $key => $order): ?>
				<tr id="<?php echo $order['componentId']; ?>">
					<td><?php echo $key+1; ?></td>
					<td><?php echo $order['componentId']; ?></td>
					<td>
						<?php 
							$date = date_create($order['createDate']);
							echo date_format($date,"d F Y (H:i:s)");
						?>
						
					</td>
					<td><?php echo $order['name']; ?></td>
					<td>
						<!-- <?php //if($order['name'] == 'Paypal'): ?>
							<a href="<?php //echo base_url('customer/buy/'.$order['componentId']); ?>" title="">								
								<img src="<?php //echo base_url('assets/images/paypal.png') ?>" alt="" width="150" height="60">
							</a>
						<?php //endif; ?> -->

							<a href="<?php echo base_url('customer/buyWithBkash/'.$order['componentId'].'/'.$order['payment_methodId']); ?>" title="">								
								<?php echo $order['name']; ?>
							</a>
					 	
					 </td>
					<td><?php echo $order['status']; ?></td>
					<td><?php echo $order['shipping_status']; ?></td>
					<td>
						<a href="<?php echo base_url('customer/order_details/').$order['componentId'] ?>" class="btn btn-info btn-sm" title="" target="_blank">Details</a>
						<a href="javascript:;" id="<?php echo $order['componentId']; ?>" class="btn btn-danger btn-sm clearOrder">Clear</a>
					</td>
				</tr>
			<?php endforeach; endif;?>
			</tbody>
		</table>
	</div>
</div>



<script>
	$(document).on('click', '.clearOrder', function(event) {
		event.preventDefault();
		var orderId = $(this).attr('id');
		var url = "<?php echo base_url('customer/removeOrder/') ?>"+orderId;
		$('table tr#'+orderId).fadeOut();
		$.ajax({
			url: url
		});
	});
</script>
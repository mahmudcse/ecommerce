<br><br><br>
<br><br><br>
<div class="row">
	<div class="col-md-12">
		<?php echo form_open('admin/orders'); ?>
		<div class="form-group col-md-3">
			<label>Order Id</label>
			<input type="text" name="orderId" value="<?php echo $orderId; ?>" class="form-control">
		</div>
		<div class="form-group col-md-2">
			<label>Customer Name</label>
			<input type="text" name="customerName" value="<?php echo $customerName; ?>" class="form-control">
		</div>
		<div class="form-group col-md-2">
			<label>Order Statuses</label>
			<select name="orderStatus" class="form-control">
				<option value="all" <?php if($orderStatus == 'all') echo "Selected"; ?>>All</option>
			<?php foreach($orderStatuses as $order): ?>
				
				<option value="<?php echo $order['componentId'] ?>"
					<?php if($order['componentId'] == $orderStatus) echo "selected"; ?>
					>
					
					<?php echo $order['status'] ?>
						
				</option>
			<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group col-md-2">
			<label>Transaction</label>
			<select name="transaction" class="form-control">
				<option value="all" <?php if($transaction == 'all') echo "selected"; ?>>All</option>

				<option value="1" <?php if($transaction == '1') echo "selected"; ?>>Empty</option>
				<option value="2" <?php if($transaction == '2') echo "selected"; ?>>Not Empty</option>
			
			</select>
		</div>

		<div class="form-group col-md-2">
			<label>Payment Statuses</label>
			<select name="paymentstatus" class="form-control">
				<option value="all" <?php if($paymentstatus == 'all') echo "selected"; ?>>All</option>

				<option value="1" <?php if($paymentstatus == '1') echo "selected"; ?>>Paid</option>
				<option value="2" <?php if($paymentstatus == '2') echo "selected"; ?>>Not Paid</option>
			
			</select>
		</div>
		<div class="form-group col-md-1">
			<label>&nbsp;</label>
			<input type="submit" class="btn btn-default" value="Filter" class="form-control">
		</div>
		<?php echo form_close(); ?>
		<div class="form-group col-md-4 pull-right">
			<p><?php echo $this->pagination->create_links(); ?></p>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<caption>Orders</caption>
			<thead>
				<tr>
					<th>Order Id</th>
					<th>Amount</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Placement Date</th>
					<th>Payment Method</th>
					<th>Transaction Number</th>
					<th>Payment status</th>
					<th>Order status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php if(isset($orders)): foreach($orders as $key => $order): ?>
				<tr id="<?php echo $order['componentId']; ?>">
					<td><?php echo $order['componentId']; ?></td>
					<td><?php echo $order['total']; ?></td>
					<td><?php echo $order['firstName'].' '.$order['lastName']; ?></td>
					<td><?php echo $order['mobile']; ?></td>
					<td><?php echo $order['createDate']; ?></td>
					<td><?php echo $order['name']; ?></td>
					<td><?php echo $order['transaction_no']; ?></td>
					<td>
						<select name="paymentStatus" orderId="<?php echo $order['componentId'] ?>" id="paymentStatus" class="form-control paymentStatus">
							<?php if(isset($paymentStatuses)): foreach($paymentStatuses as $pstatus): ?>
								<option value="<?php echo $pstatus['componentId']; ?>" 
										<?php if($pstatus['componentId'] == $order['pstatusId']) echo "selected"; ?>
									><?php echo $pstatus['status']; ?></option>
							<?php endforeach; endif; ?>
						</select>
					</td>
					<td>
						<select name="orderStatus" orderId="<?php echo $order['componentId'] ?>" class="form-control orderStatus">
						<?php if(isset($orderStatuses)): foreach($orderStatuses as $ostatus): ?>
							<option value="<?php echo $ostatus['componentId']; ?>" 
										<?php if($ostatus['componentId'] == $order['shippingStatus']) echo "selected"; ?>><?php echo $ostatus['status'] ?></option>
						<?php endforeach; endif; ?>
						</select>
					</td>
					<td>
						<a href="javascript:;" id="<?php echo $order['componentId']; ?>" class="btn btn-danger btn-sm removeOrder">Remove</a>
						<a href="<?php echo base_url('admin/orderDetails/'.$order['componentId']) ?>" class="btn btn-info btn-sm" target="_blank">Details</a>
					</td>
				</tr>
			    <?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).on('change', '.paymentStatus', function(){
         var paymentStatus = $(this).val();
         var orderId = $(this).attr('orderId');
         var url = "<?php echo base_url('admin/changePaymentStatus/') ?>"+paymentStatus+'/'+orderId;
         if(confirm('Sure to change shipping status?')){
         	$.ajax({
         		url: url,
         		async: false,
         		dataType: 'json',
         		success: function(data){
         			if(data == true){
         				alert('Status updated successfully');
         			}
         		},
         		error: function(){
         			alert('Wrong');
         		}
         	});
         }
	});
	$(document).on('change', '.orderStatus', function(){
         var orderStatus = $(this).val();
         var orderId = $(this).attr('orderId');
         var url = "<?php echo base_url('admin/changeShippingStatus/') ?>"+orderStatus+'/'+orderId;
         if(confirm('Sure to change shipping status?')){
         	$.ajax({
         		url: url,
         		async: false,
         		dataType: 'json',
         		success: function(data){
         			if(data == true){
         				alert('Status updated successfully');
         			}
         		},
         		error: function(){
         			alert('Wrong');
         		}
         	});
         }
	});
	$(document).on('click', '.removeOrder', function(){
		var orderId = $(this).attr('id');
		var url = "<?php echo base_url('admin/removeOrder/') ?>"+orderId;
		if(confirm('Sure to delete?')){
			$.ajax({
				url: url,
				async: false,
				dataType: 'json',
				success: function(data){
					$('tbody tr#'+orderId).fadeOut();
					alert('Order Removed successfully.');
				},
				error: function(){
					alert('Something went wrong');
				}
			});
		}
	});
	
</script>
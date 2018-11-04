<div class="row">
	<div class="col-md-12">
		<table class="table table-responsive table-hover">
			<caption>Order Details</caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Brand</th>
					<th>Model</th>
					<th>Image</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			<?php foreach($order_details as $Key=>$order): ?>
				<tr>
					<td><?php echo $Key+1; ?></td>
					<td><?php echo $order['brandName']; ?></td>
					<td><?php echo $order['model']; ?></td>
					<td>
						
						<img src="<?php echo base_url().$order['image'] ?>" class="img-thumbnail" width="100" height="100" alt="<?php echo $order['model'] ?>">
						
					</td>
					<td><?php echo $order['quantity']; ?></td>
					<td><?php echo $order['price']; ?></td>
					<td>
						<a href="<?php echo base_url('customer/productDetails/').$order['productId'] ?>" class="btn btn-info" target="_blank">View Product</a>
					</td>
				</tr>
			<?php endforeach; ?>

			</tbody>
		</table>
	</div>
</div>
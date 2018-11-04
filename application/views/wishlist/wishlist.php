

<table class="table table-hover table-responsive">
	<thead>
		<tr>
			<th>#</th>
			<th>Brand</th>
			<th>Model</th>
			<th>Image</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

	<?php 

	if(count($wishList) < 1){
		echo '<tr>
			<td colspan="6" align="center">WishList Empty</td>
		</tr>';
	}

	foreach ($wishList as $key => $wish): ?>
		<tr id="<?php echo $wish['wishId']; ?>">
			<td><?php echo ($key+1); ?></td>
			<td><?php echo $wish['brandName']; ?></td>
			<td><?php echo $wish['model']; ?></td>
			<td>
				<img src="<?php echo base_url().$wish['image']; ?>" class="img-thumbnail" width="100" height="100">
			</td>
			<td><?php echo $wish['price']; ?></td>
			<td>
				<a href="javascript:;" class="btn btn-danger" wishId="<?php echo $wish['wishId']; ?>">Remove</a>

				<a href="javascript:;" class="btn btn-success" 

				<?php if($wish['cartId'] == null): ?>
					productId="<?php echo $wish['productId']; ?>"
					>Add to cart</a>
				<?php else: ?>

				>In Cart</a>
			<?php endif; ?>

				<a href="<?php echo base_url('customer/productDetails/').$wish['productId']; ?>" class="btn btn-info" target="_blank">Details</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<script>
	$('tbody').on('click', '.btn-danger', function(){
		var wishId = $(this).attr('wishId');
		var url = "<?php echo base_url('customer/deletewish'); ?>";
		$('tbody tr#'+wishId).fadeOut();

		$.ajax({
			method: 'POST',
			url: url,
			data: {wishId: wishId}

		});

	});

	$('tbody').on('click', '.btn-success', function(){
		var productId = $(this).attr('productId');

		
		$(this).removeAttr('productId');
		if(productId == null){
			return false;
		}
		$(this).text('Added to cart');
		var url = "<?php echo base_url('customer/addToCart'); ?>";

		


		$.ajax({
			method: 'POST',
			url: url,
			data: {productId: productId},
			dataType: 'json',
			success: function(response){
				//alert(response);
				$('#cartCounter').text(response);

			},
			error: function(){
				alert('Failed to add');
			}
		});
	})
</script>
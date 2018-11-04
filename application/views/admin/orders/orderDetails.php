

<div class="row">
	<div class="col-md-12">
		<table class="table table-hover table-bordered table-responsive">
			<caption>Order Details</caption>
			<thead>
				<tr>
					<th>Brand</th>
					<th>Model</th>
					<th>Quantity</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($detailedOrder)): foreach($detailedOrder as $order): ?>
				<tr id="<?php echo $order['componentId']; ?>">
					<td><?php echo $order['brandName']; ?></td>
					<td><?php echo $order['model']; ?></td>
					<td>
						<input type="text" detailId = "<?php echo $order['componentId']; ?>" value="<?php echo $order['quantity']; ?>" class="form-control quantity">
					</td>
					<td>
						<a href="javascript:;" id="<?php echo $order['componentId']; ?>" class="btn btn-danger btn-sm remove">Remove</a>
					</td>
				</tr>
			<?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).on('click', '.remove', function(){
		var detailId = $(this).attr('id');
		var url = "<?php echo base_url('admin/removeOrderRow/') ?>"+detailId;
		if(confirm('Sure to delete?')){
			$.ajax({
				url: url,
				async: false,
				dataType: 'json',
				success: function(data){
					if(data == true){
						$('tbody tr#'+detailId).fadeOut();
					}
				},
				error: function(){
					alert('Something went wrong');
				}
			});
		}
	});
	$(document).on('change', '.quantity', function(){
		var detailId = $(this).attr('detailId');
		var selector = $(this);
		
		if(confirm('Sure to Update?')){
			var quantity = $('.quantity').val();
			var url = "<?php echo base_url('admin/changeQuantity/') ?>"+quantity+'/'+detailId;
			$.ajax({
				url: url,
				async: false,
				dataType: 'json',
				success: function(data){
					if(data == true){
						alert('Updated successfully!');
					}
				},
				errro: function(){
					alert('Something went wrong');
				}
			});
		}else{
			var url = "<?php echo base_url('admin/previousQuantity/') ?>"+detailId;
			$.ajax({
				url: url,
				async: false,
				dataType: 'json',
				success: function(data){
					selector.val(data);
				},
				errro: function(){
					alert('Something went wrong');
				}
			});
		}
	});
</script>
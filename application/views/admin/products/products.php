<br><br><br>
<br><br><br>
<div class="row">
	<div class="col-md-12">
		<?php echo form_open('admin/products'); ?>
		<div class="col-md-3 form-group">
			<label for="" class="control-label">Search</label>
			<input type="text" class="form-control" name="productName" value="<?php echo $productName; ?>">
		</div>
		<div class="col-md-3 form-group">
			<label for="" class="control-label">User</label>
			<input type="text" class="form-control" name="user" value="<?php echo $user; ?>">
		</div>
		<div class="col-md-3 form-group">
			<label for="" class="control-label">Status</label>
			<select class="form-control" name="status">
				<option value="all" <?php if($status == 'all') echo "selected"; ?>>All</option>
				<option value="1" <?php if($status == 1) echo "selected"; ?>>Active</option>
				<option value="2" <?php if($status == 2) echo "selected"; ?>>In Active</option>
			</select>
		</div>

		<div class="col-md-3 form-group">
			<label for="" class="control-label">Hot/Not</label>
			<select class="form-control" name="hot">
				<option value="all" <?php if($hot == 'all') echo "selected"; ?>>All</option>
				<option value="1" <?php if($hot == 1) echo "selected"; ?>>Hot</option>
				<option value="2" <?php if($hot == 2) echo "selected"; ?>>Not</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-1 form-group pull-left">
			<label for="">&nbsp;</label>
			<input type="submit" name="Search" value="Search" class="btn btn-default btn-sm">
		</div>
		<?php echo form_close(); ?>
		<div class="col-md-3 pull-right">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>

		
	

	<div class="col-md-12">
		<table class="table table-responsive table-bordered">
			<caption>Products</caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Product</th>
					<th>Add event</th>
					<th>User</th>
					<th>Mobile</th>
					<th>Status</th>
					<th>Hot/Not</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if($products): ?>
					<?php foreach($products as $product): ?>
				<tr id="<?php echo $product['componentId']; ?>">
					<td><?php echo ++$count_from; ?></td>
					<td><?php echo $product['brandName'].' '. $product['model']; ?></td>
					<td>
						<input type="text" name="addEvent" id="<?php echo $product['componentId']; ?>" class="addEvent form-control" value="" placeholder="Add event">
					</td>
					<td><?php echo $product['firstName'].' '. $product['lastName']; ?></td>
					<td><?php echo $product['mobile']; ?></td>
					<td>
						<select name="status" id="<?php echo $product['componentId']; ?>" class="form-control status"> 
							<option value="1" <?php if($product['status'] == 1) echo "selected"; ?>>Active</option>
							<option value="2" <?php if($product['status'] == 2) echo "selected"; ?>>In Active</option>
						</select>
					</td>
					<td>
						<select name="hot" id="<?php echo $product['componentId']; ?>" class="form-control hot"> 
							<option value="1" <?php if($product['hot'] == 1) echo "selected"; ?>>Hot</option>
							<option value="2" <?php if($product['hot'] == 2) echo "selected"; ?>>Not</option>
						</select>
					</td>
					<td>
						<a href="javascript:;" id="<?php echo $product['componentId']; ?>" class="btn btn-danger btn-sm delete">Delete</a>
					</td>
				</tr>
			<?php endforeach; 
			endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script>

	var event = <?php echo $events ?>;

	//console.log($(this).attr(id));

	data = $.map(event, function(i){
		return {
			label: i.name,
			value: i.componentId
		}
	});

	var options = {
	    source: data,
	    minLength: 1,
	    select: function( event, ui ) {
	    	var eventId = ui.item.value;
	    	var productId = $(this).attr('id');
	    	if(confirm('Add product to ' + ui.item.label)){
	    		var url = "<?php echo base_url('admin/addProductToEvent/') ?>"+productId + '/' + eventId;
	    		$.ajax({
	    			url: url,
	    			dataType: 'json',
	    			async: false,
	    			success: function(data){
	    				if(data == true){
	    					alert('Successfully added to event');
	    				}else if(data.productExists){
	    					alert('Product already in event');
	    				}
	    			},
	    			error: function(){
	    				alert('Something went wrong');
	    			}
	    		});
	    	}
		    $(this).val('');
		    return false;
	    }
	};
	

	$(function(){
		$('.addEvent').autocomplete(options);
	});
	$(document).on('click', '.delete', function(){
		var productId = $(this).attr('id');
		var url = "<?php echo base_url('admin/deleteProduct/') ?>"+productId;
		if(confirm('Sure to delete?')){
			$.ajax({
				url: url,
				async: false,
				dataType: 'json',
				success: function(data){
					if(data == true){
						$('tbody tr#'+productId).fadeOut();
					}
				},
				error: function(){

				}
			});
		}
	});
	$(document).on('change', '.status', function(){		
         var status = $(this).val();
         var productId = $(this).attr('id');
         var url = "<?php echo base_url('admin/changeStatus/'); ?>"+productId+'/'+status;
         if(confirm('Sure to change status?')){
         	$.ajax({
         		url: url,
         		async: false,
         		dataType: 'json',
         		success: function(data){
         			if(data == true){
         				alert('Status have been changed successfully!');
         			}else{
         				alert('Not changed')
         			}
         		},
         		error: function(){
         			alert('Something wrong!');
         		}
         	});
         }
	});

	$(document).on('change', '.hot', function(){		
         var hot = $(this).val();
         var productId = $(this).attr('id');
         var url = "<?php echo base_url('admin/changehot/'); ?>"+productId+'/'+hot;
         if(confirm('Sure to change status?')){
         	$.ajax({
         		url: url,
         		async: false,
         		dataType: 'json',
         		success: function(data){
         			if(data == true){
         				alert('Status have been changed successfully!');
         			}else{
         				alert('Not changed')
         			}
         		},
         		error: function(){
         			alert('Something wrong!');
         		}
         	});
         }
	});
</script>
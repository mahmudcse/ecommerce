<br><br><br>
<br><br><br>
<div class="row">
	<div class="col-md-12">
		<?php echo form_open('admin/customers'); ?>
		<div class="form-group col-md-3">
			<label>Search</label>
			<input type="text" name="NME" value="<?php echo $NME; ?>" class="form-control">
		</div>

		<div class="form-group col-md-3">
			<label>User Condition</label>
			<select name="condition" class="form-control">
				<option value="all" <?php if($condition == 'all') echo "Selected"; ?>>All</option>
				<option value="1" <?php if($condition == 1) echo "Selected"; ?>>Blocked</option>
				<option value="2" <?php if($condition == 2) echo "Selected"; ?>>Un Blocked</option>
			
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
					<th>Customer Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Condtion</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php if(isset($customers)): foreach($customers as $key => $customer): ?>
				<tr id="<?php echo $customer['componentId']; ?>">
					<td><?php echo $customer['firstName'].' '.$customer['lastName']; ?></td>
					<td><?php echo $customer['mobile']; ?></td>
					<td><?php echo $customer['email']; ?></td>
					<td>
						<select name="condition" customerId="<?php echo $customer['componentId'] ?>" class="form-control condition">
							
								<option value="1" <?php if($customer['status'] == 1) echo "selected"; ?>>Un Blocked</option>
								<option value="2" <?php if($customer['status'] == 2) echo "selected"; ?>>Blocked</option>
									
						</select>
					</td>
					<td>
						<a href="javascript:;" id="<?php echo $customer['componentId']; ?>" class="btn btn-danger btn-sm removeCustomer">Delete</a>
					</td>
				</tr>
			    <?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).on('change', '.condition', function(){
         var condition = $(this).val();
         var customerId = $(this).attr('customerId');
         var url = "<?php echo base_url('admin/changeCustomerCondition/') ?>"+condition+'/'+customerId;

         if(confirm('Sure to change user status?')){
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
	
	$(document).on('click', '.removeCustomer', function(){
		var customerId = $(this).attr('id');
		var url = "<?php echo base_url('admin/removeCustomer/') ?>"+customerId;

		if(confirm('Sure to delete?')){
			$.ajax({
				url: url,
				async: false,
				dataType: 'json',
				success: function(data){
					if(data == true){
						$('tbody tr#'+customerId).fadeOut();
						alert('Customer Removed successfully.');
					}else{
						alert('Could not be deleted!');
					}
				},
				error: function(){
					alert('Something went wrong');
				}
			});
		}
	});
	
</script>
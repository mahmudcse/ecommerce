
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 col-md-offset-4">
				<h4>Post Your Add</h4>
				<br><br>
			</div>
		</div>
	</div>
	<?php echo form_open('customer/categories'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<div class="col-md-2 col-md-offset-2">
					<label class="control-label">Category</label>
					<select class="form-control" name="category" id="category">
						<option value="">Select</option>
						<?php 
							foreach ($cats as $row) { ?>
								<option value="<?php echo $row['componentId']; ?>"><?php echo $row['catName']; ?></option>
							<?php 
							}

						 ?>
					</select>
				</div>
				<div class="col-md-2 col-md-offset-1">
					<label class="control-label">Sub Category</label>
					<select class="form-control" id="subCat" name="subCat">
						<option value="">Select Category First</option>
					</select>
				</div>

				<div class="col-md-2 col-md-offset-1">
					<label class="control-label">Specific Category</label>
					<select class="form-control" id="specificCat" name="specificCat">
						<option value="">Select subcategory first</option>
					</select>
				</div>

				<div class="col-md-2">
					<label class="control-label"></label><br>
					<input type="submit" class="btn btn-success" name="submit" value="Go">
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>

<script>

	$('#category').on('change', function(){
		var catId = $('#category').val();
		$.ajax({
			type: 'ajax',
			method: 'get',
			async: false,
			url: '<?php echo base_url() ?>customer/getSubcat',
			data: {catId:catId},
			dataType: 'json',
			success: function(response){
				var subCat = '';
				subCat += '<option value="">Select</option>';
				var i;
				for(i = 0; i<response.length; i++){
					subCat += '<option value="'+response[i].componentId+'">'+response[i].subCatName+'</option>';
				}
				$('#subCat').html(subCat);
			},
			error: function(){
				alert('Failed to retrieve');
			}


		});
	});

	$('#subCat').on('change', function(){
		var subCatId = $('#subCat').val();
		$.ajax({
			type: 'ajax',
			method: 'get',
			async: false,
			url: '<?php echo base_url() ?>customer/getSpecificCat',
			data: {subCatId: subCatId},
			dataType: 'json',
			success: function(response){
				var specificCat = '';
				specificCat += '<option value="">Select</option>';
				var i;
				for(i=0; i<response.length; i++){
					specificCat += '<option value="'+response[i].componentId+'">'+response[i].specificCatName+'</option>';
				}

				$('#specificCat').html(specificCat);

			},
			error: function(){
				alert('Failed to retrieve');
			}
		});
	});

	$('#specificCat').on('change', function(){

	});
</script>

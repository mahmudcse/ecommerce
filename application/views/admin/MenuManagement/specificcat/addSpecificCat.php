<div class="col-md-offset-3">
	<h4>Add Sub Category</h4>

	<?php echo form_open('admin/addSpecificCat'); ?>
		
		<div class="form-group">
				<div class="col-md-2">
					<label class="control-label">Category</label>
					<select class="form-control" name="catId" id="SpecificCatId">
						<option value="">Select</option>
						<?php 
							foreach ($cats as $row) { ?>
								<option value="<?php echo $row['componentId']; ?>"><?php echo $row['catName']; ?></option>
							<?php 
							}

						 ?>
					</select>
				</div>
				<div class="col-md-2">
					<label class="control-label">Sub Category</label>
					<select class="form-control" name="subCatId" id="subCatDropDown">
						
					</select>
				</div>
			</div>
			
			<div class="col-md-2 col-md-offset-2">
				<input type="text" name="specificCatName" required><br><br>
				<input type="submit" class="btn btn-success" name="submit" value="Add">
			</div>
			
	<?php echo form_close(); ?>
</div>

<script>
	$('.form-group').on('change', '#SpecificCatId',function(){
		var catId = $('#SpecificCatId').val();
		url = "<?php echo base_url('admin/getSubCatByCatId'); ?>";
		$.ajax({
			type: 'ajax',
			method: 'get',
			async: false,
			url: url,
			data:{catId: catId},
			dataType: 'json',
			success: function(response){
				var options = '';
				options += '<option value="">Select</option>';

				var i;
				for(i=0; i<response.length; i++){
					options += '<option value="'+response[i].componentId+'">'+response[i].subCatName+'</option>';
				}
				$('#subCatDropDown').html(options);
			},
			error: function(){
				alert('Could not fetch subcategory');
			}
		});

	});
</script>
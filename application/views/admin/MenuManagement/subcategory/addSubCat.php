<div class="col-md-offset-3">
	<h4>Add Sub Category</h4>

	<?php echo form_open('admin/addSubCat'); ?>
		
		<div class="form-group">
				<div class="col-md-2">
					<label class="control-label">Category</label>
					<select class="form-control" name="catId" id="catId">
						<?php 
							foreach ($cats as $row) { ?>
								<option value="<?php echo $row['componentId']; ?>"><?php echo $row['catName']; ?></option>
							<?php 
							}

						 ?>
					</select>
				</div>
			</div>
			
			<div class="col-md-2 col-md-offset-2">
				<input type="text" name="subCat" required><br><br>
				<input type="submit" class="btn btn-success" name="submit" value="Add">
			</div>
			
	<?php echo form_close(); ?>
</div>
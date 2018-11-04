<div class="col-md-offset-3">
	<h4>Add Category</h4>

	<?php echo form_open('admin/addCat'); ?>
		
		<input type="text" name="cat" required>
		<input type="submit" class="btn btn-success" name="submit" value="Add">

	<?php echo form_close(); ?>
</div>
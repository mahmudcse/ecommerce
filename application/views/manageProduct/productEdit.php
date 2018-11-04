<h4>Product Edit</h4>

<!-- <?php 
	echo "<pre>";
	print_r($products);
	echo "</pre>";

 ?> -->

 <style>
	.has-error{
		color: #FA1818;
	}

</style>


<br><br>

<?php echo form_open_multipart('customer/editProductValidation'); ?>
	
	<input type="hidden" name="productId" class="form-control" 
  		value="<?php 
  				if(isset($products[0]['productId'])){
  					echo $products[0]['productId'];
  				}else{
  					echo set_value('productId', ''); 
  				}
  				
	  	?>">

	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('brandName'); ?>
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Brand Name:</label>
	  <input type="text" name="brandName" class="form-control" 
  		value="<?php 
  				if(isset($products[0]['brandName'])){
  					echo $products[0]['brandName'];
  				}else{
  					echo set_value('brandName', ''); 
  				}
  				
	  	?>">
	</div>

	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('model'); ?>
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Model:</label>
	  <input type="text" name="model" class="form-control" 
	  	value="<?php 
	  			if(isset($products[0]['model'])){
  					echo $products[0]['model'];
  				}else{
  					echo set_value('model', ''); 
  				} 
	  	?>">
	</div>


	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('price'); ?>
	</div>
	
	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Price:</label>
	  <input type="text" name="price" class="form-control" 
	  	value="<?php 
		  			if(isset($products[0]['price'])){
	  					echo $products[0]['price'];
	  				}else{
	  					echo set_value('price', ''); 
	  				} 
	  		?>">
	</div>

	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('keyFeatures'); ?>
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Key Fetures:</label>
	  <input type="text" name="keyFeatures" class="form-control" 
	  		value="<?php 
	  					if(isset($products[0]['keyFeatures'])){
		  					echo $products[0]['keyFeatures'];
		  				}else{
		  					echo set_value('keyFeatures', ''); 
		  				} 
	  			?>">
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
		<span class="has-error">
			<?php echo form_error('myimage'); ?>
		</span>
	    <label>Upload Image:</label><br>
	    <a href="javascript:;" id="addMore" >Add More</a><br><br>

	    <div id="fileinput">
	    	<input type="file" name="myimage[]">
	    </div>
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
	  <input type="submit" class="btn btn-success" name="submit" value="Edit Product">
	</div>

<?php echo form_close(); ?>

<div class="form-group">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Image</td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $image) { ?>
				<tr id="<?php echo $image['imageId']; ?>">
					<td><img src="<?php echo base_url().$image['image']; ?>" class="img-thumbnail" width="140" height="100"></td>
				    <td>
				    	<!-- <?php echo form_open('customer/deleteImage'); ?>
				    		<input type="hidden" name="imageId" value="<?php echo $image['imageId']; ?>">
				    		<input type="submit" class="btn btn-danger" name="delete" value="Delete">
				    	<?php echo form_close(); ?> -->
						<a href="javascript:;" value="<?php echo $image['imageId']; ?>" class="btn btn-danger deleteImage">Delete</a>

				    </td>
				</tr> 
			<?php } ?>
			  
		</tbody>
	</table>
</div>
		<div hidden id="blankfile">
	    	<input type="file" name="myimage[]">
	    </div>

<script>
	$('.deleteImage').on('click', function(){

		if(confirm('Sure To Delete?')){
			var imageId = $(this).attr('value');
			var url = "<?php echo base_url('customer/deleteImage'); ?>";
			$.ajax({
				type: 'ajax',
				method: 'POST',
				async: false,
				url: url,
				data: {imageId: imageId},
				dataType: 'json',
				success: function(respose){
					$('tbody tr#'+imageId).fadeOut();
				},
				error: function(){
					alert('Error');
				}
			});
		}else{
			return false;
		}
	});

	$('#addMore').on('click', function(){
		var input = $('#blankfile').html();

		$('#fileinput input:first').before(input);
	})
</script>
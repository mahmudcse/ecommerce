<style>
	.has-error{
		color: #FA1818;
	}

</style>


<br><br>
<div class="form-group col-md-offset-2 col-md-5">
  <label>
  <?php 

  	if(isset($productOptions['catName']))
  		echo $productOptions['catName'];

  	if(isset($productOptions['subCatName']))
  		echo " -> ".$productOptions['subCatName'];

  	if(isset($productOptions['specificCatName']))
  		echo " -> ".$productOptions['specificCatName'];
  ?>
  	
  </label>
  <a href="<?php echo base_url('customer/postAdd'); ?>" class="btn btn-success col-md-offset-1">Change</a>
</div>

<?php echo form_open_multipart('customer/addProductValidation'); ?>

	<input type="hidden" name="category" 
	value="<?php 
		if(isset($productOptions['category'])){
			echo $productOptions['category']; 
		}else{
			echo set_value('category', '');
		}
		
	?>">

	<input type="hidden" name="subCat" 
		value="<?php 
			if(isset($productOptions['subCat'])){
				echo $productOptions['subCat']; 
			}else{
				echo set_value('subCat', '');
			}

		?>">
	<input type="hidden" name="specificCat" 

		value="<?php
			if(isset($productOptions['specificCat'])){
				echo $productOptions['specificCat']; 
			}else{
				echo set_value('specificCat', '');
			}
		 	
		 ?>">


	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('brandName'); ?>
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Brand Name:</label>
	  <input type="text" name="brandName" class="form-control" 
  		value="<?php 
  				echo set_value('brandName', ''); 
	  	?>">
	</div>

	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('model'); ?>
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Model:</label>
	  <input type="text" name="model" class="form-control" 
	  	value="<?php 
	  		
	  			echo set_value('model', ''); 
	  	?>">
	</div>


	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('price'); ?>
	</div>
	
	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Price:</label>
	  <input type="text" name="price" class="form-control" 
	  	value="<?php 
	  			
	  				echo set_value('price', ''); 
	  		?>">
	</div>

	<div class="form-group col-md-offset-2 col-md-5 has-error">
		<?php echo form_error('keyFeatures'); ?>
	</div>

	<div class="form-group col-md-offset-2 col-md-5">
	  <label for="usr">Key Fetures:</label>
	  <input type="text" name="keyFeatures" class="form-control" 
	  		value="<?php 
	  				
	  					echo set_value('keyFeatures', ''); 
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
	  <input type="submit" class="btn btn-success" name="submit" value="Add Product">
	</div>



<?php echo form_close(); ?>
		<div hidden id="blankfile">
	    	<input type="file" name="myimage[]">
	    </div>

<script>
	$('#addMore').on('click', function(){
		var input = $('#blankfile').html();

		$('#fileinput input:first').before(input);
	})
</script>
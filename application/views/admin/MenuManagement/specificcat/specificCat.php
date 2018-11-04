

<style>
	.has-error{
		color: red;
	}
</style>


<br>
<div class="has-error">
	<?php echo $this->session->flashdata('flash_message'); ?>
</div>
	<div class="form-group">
		<div class="col-md-2">
			<label class="control-label">Filter by Category</label>
			<select class="form-control" name="catId" id="catId">
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
			<label class="control-label">Filter by Subcategory</label>
			<select class="form-control" name="subCatId" id="subCatId">
				
			</select>
		</div>
	</div>
	<br><br><br>

 <div>
 	<table class="table">
 		<thead>
 			<tr>
 				<td>#</td>
 				<td>Name</td>
 				<td>Action</td>
 			</tr>
 		</thead>
 		<tbody id="specificCatList">
 			<?php foreach ($specificCats as $key => $specificCat): ?>
 				<tr id="<?php echo $specificCat['componentId']; ?>">
	 				<td><?php echo $key+1; ?></td>
	 				<td><?php echo $specificCat['specificCatName']; ?></td>
	 				<td>
	 					<a href="javascript:;" class="btn btn-info btnEdit" id="<?php echo $specificCat['componentId']; ?>">Edit</a>
	 					<a href="javascript:;" id="<?php echo $specificCat['componentId']; ?>" class="btn btn-danger btnDelete">Delete</a>
	 				</td>
	 			</tr>
 			<?php endforeach ?>
 		</tbody>
 	</table>
	

	<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Update Specific Category</h4>
	        <h5 id="error" class="has-error">
	        	
	        </h5>
	      </div>
	      <div class="modal-body">

	        <form id="myForm" method="post" class="form-group">

				<input type="hidden" name="specificCatId" value="">
	        	<label>Specific Category</label>
	        	<input class="form-control" type="text" name="specificCatName">

	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button id="btnSave" type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
 </div>


 <script>

 $('.form-group').on('change', '#catId', function(){
 	var catId = $('#catId').val();
 	url = "<?php echo base_url('admin/getSubCatByCatId'); ?>";

 	$.ajax({
 		type: 'ajax',
 		method: 'get',
 		url: url,
 		async: false,
 		data: {catId: catId},
 		dataType: 'json',
 		success: function(response){
 			var options = '';
 			options += '<option value="">Select</option>';
 			var i;
 			for(i=0; i<response.length; i++){
 				options += '<option value="'+response[i].componentId+'">'+response[i].subCatName+'</option>';		
 			}

 			$('#subCatId').html(options);
 		},
 		error: function(){
 			alert('Error Fetching Data');
 		}
 	});
 });

 $('.form-group').on('change', '#subCatId', function(){

 	var subCatId = $('#subCatId').val();

 	url = "<?php echo base_url('admin/getSpecificCatsBySubCatId'); ?>";

 	$.ajax({
 		type: 'ajax',
 		method: 'get',
 		url: url,
 		async: false,
 		data: {subCatId: subCatId},
 		dataType: 'json',
 		success: function(response){
 			var tdata='';
 			var i;
 			for(i=0; i<response.length; i++){
 				tdata += '<tr id="'+response[i].componentId+'" >'+
 							'<td>'+(i+1)+'</td>'+
 							'<td>'+response[i].specificCatName+'</td>'+
 							'<td>'+
 								'<a href="javascript:;" id="'+response[i].componentId+'" class="btn btn-info btnEdit">Edit</a> '+
 								'<a href="javascript:;" id="'+response[i].componentId+'" class="btn btn-danger btnDelete">Delete</a>'+
 							'</td>'+
 						'</tr>';
 			}

 			$('#specificCatList').html(tdata);
 		},
 		error: function(){
 			alert('Failed');
 		}
 	});
 });



 
$('#btnSave').on('click', function(){
	//$('#myModal').modal('hide');
	var specificCatId   = $('input[name = specificCatId]').val();
	var specificCatName = $('input[name = specificCatName]').val();
	
	if(specificCatName == ''){
		$('#error').html('Name could not be empty');
		return false;
	}

	var url = "<?php echo base_url('admin/updateSpecificCat'); ?>";

	$.ajax({
		type: 'ajax',
		method: 'post',
		async: false,
		url: url,
		data: {specificCatId: specificCatId, specificCatName: specificCatName},
		dataType: 'json',
		success: function(resopnse){
			$('#myModal').modal('hide');
			location.reload();
		},
		error: function(){
			alert('Could Not update Data');
		}
	});
});

 $('#specificCatList').on('click', '.btnEdit' ,function(){
 	$('#myModal').modal('show');

 	var specificCatId = $(this).attr('id');
 	var url = "<?php echo base_url('admin/getSpecificCat'); ?>";

 	$.ajax({
 		type: 'ajax',
 		method: 'get',
 		async: false,
 		url: url,
 		data: {specificCatId: specificCatId},
 		dataType: 'json',
 		success: function(response){
 			$('input[name = specificCatId]').val(response['componentId']);
 			$('input[name = specificCatName').val(response['specificCatName']);
 		},
 		error: function(){
 			alert('Could not load Category');
 		}
 	});
 });


 	$('#specificCatList').on('click', '.btnDelete', function(){

 		var specificCatId = $(this).attr('id');
 		var url = "<?php echo base_url('admin/deleteSpecificCat'); ?>";


 		if(confirm('Sure To Delete?')){
 			$.ajax({
	 			type: 'ajax',
	 			method: 'POST',
	 			async: false,
	 			url: url,
	 			data: {specificCatId: specificCatId},
	 			dataType: 'json',
	 			success: function(response){
	 				$('tbody tr#'+specificCatId).fadeOut();
	 			},
	 			error: function(){
	 				alert('Failed');
	 			}
	 		});
 		}else{
 			return false;
 		}
 		
 		//$('tbody tr#'+catId).fadeOut();
 	});
 </script>


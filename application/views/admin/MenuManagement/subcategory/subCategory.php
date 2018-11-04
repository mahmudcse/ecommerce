

<style>
	.has-error{
		color: red;
	}
</style>


<br>

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
	</div><br><br><br>

 <div>
 	<table class="table">
 		<thead>
 			<tr>
 				<td>#</td>
 				<td>Name</td>
 				<td>Action</td>
 			</tr>
 		</thead>
 		<tbody id="subCatList">
 			<?php foreach ($subCats as $key => $subCat): ?>
 				<tr id="<?php echo $subCat['componentId']; ?>">
	 				<td><?php echo $key+1; ?></td>
	 				<td><?php echo $subCat['subCatName']; ?></td>
	 				<td>
	 					<a href="javascript:;" class="btn btn-info btnEdit" id="<?php echo $subCat['componentId']; ?>">Edit</a>
	 					<a href="javascript:;" id="<?php echo $subCat['componentId']; ?>" class="btn btn-danger btnDelete">Delete</a>
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
	        <h4 class="modal-title">Update Category</h4>
	        <h5 id="error" class="has-error">
	        	
	        </h5>
	      </div>
	      <div class="modal-body">

	        <form id="myForm" method="post" class="form-group">

				<input type="hidden" name="subCatId" value="">
	        	<label>Sub Category</label>
	        	<input class="form-control" type="text" name="subCat">

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

 $('#catId').on('change', function(){
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
 			var tdata='';
 			var i;
 			for(i=0; i<response.length; i++){
 				tdata += '<tr id="'+response[i].componentId+'" >'+
 							'<td>'+(i+1)+'</td>'+
 							'<td>'+response[i].subCatName+'</td>'+
 							'<td>'+
 								'<a href="javascript:;" id="'+response[i].componentId+'" class="btn btn-info btnEdit">Edit</a> '+
 								'<a href="javascript:;" id="'+response[i].componentId+'" class="btn btn-danger btnDelete">Delete</a>'+
 							'</td>'+
 						'</tr>';
 			}

 			$('#subCatList').html(tdata);
 		},
 		error: function(){
 			alert('Failed');
 		}
 	});

 });

$('#btnSave').on('click', function(){
	//$('#myModal').modal('hide');
	var subCatId   = $('input[name = subCatId]').val();
	var subCat = $('input[name = subCat]').val();
	
	if(subCat == ''){
		$('#error').html('Sub Category could not be empty');
		return false;
	}

	var url = "<?php echo base_url('admin/updateSubCat'); ?>";

	$.ajax({
		type: 'ajax',
		method: 'post',
		async: false,
		url: url,
		data: {subCatId: subCatId, subCat: subCat},
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

 $('#subCatList').on('click', '.btnEdit' ,function(){
 	$('#myModal').modal('show');

 	var subCatId = $(this).attr('id');
 	var url = "<?php echo base_url('admin/getSubCat'); ?>";

 	$.ajax({
 		type: 'ajax',
 		method: 'get',
 		async: false,
 		url: url,
 		data: {subCatId: subCatId},
 		dataType: 'json',
 		success: function(response){
 			$('input[name = subCatId]').val(response['componentId']);
 			$('input[name = subCat').val(response['subCatName']);
 		},
 		error: function(){
 			alert('Could not load Category');
 		}
 	});
 });


 	$('#subCatList').on('click', '.btnDelete', function(){

 		var subCatId = $(this).attr('id');
 		var url = "<?php echo base_url('admin/deleteSubCat'); ?>";

 		if(confirm('Sure To Delete?')){
 			$.ajax({
	 			type: 'ajax',
	 			method: 'POST',
	 			async: false,
	 			url: url,
	 			data: {subCatId, subCatId},
	 			dataType: 'json',
	 			success: function(response){
	 				$('tbody tr#'+subCatId).fadeOut();
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



<br>

 <div>
 	<table class="table">
 		<thead>
 			<tr>
 				<td>#</td>
 				<td>Name</td>
 				<td>Action</td>
 			</tr>
 		</thead>
 		<tbody>

 			<?php foreach ($categories as $key => $category): ?>
 				<tr id="<?php echo $category['componentId']; ?>">
	 				<td><?php echo $key+1; ?></td>
	 				<td><?php echo $category['catName']; ?></td>
	 				<td>
	 					<a href="javascript:;" class="btn btn-info btnEdit" id="<?php echo $category['componentId']; ?>">Edit</a>
	 					<a href="javascript:;" id="<?php echo $category['componentId']; ?>" class="btn btn-danger btnDelete">Delete</a>
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
	      </div>
	      <div class="modal-body">

	        <form id="myForm" method="post" class="form-group">

				<input type="hidden" name="catId" value="">
	        	<label>Category</label>
	        	<input class="form-control" type="text" name="category">

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

$('#btnSave').on('click', function(){
	//$('#myModal').modal('hide');
	var catId   = $('input[name = catId]').val();
	var catName = $('input[name = category]').val();

	var url = "<?php echo base_url('admin/updateCat'); ?>";

	$.ajax({
		type: 'ajax',
		method: 'post',
		async: false,
		url: url,
		data: {catId: catId, catName: catName},
		dataType: 'json',
		success: function(resopnse){
			$('#myModal').modal('hide');
			location.reload();
		},
		error: function(){
			alert(1);
		}
	});
});

 $('.btnEdit').on('click', function(){
 	$('#myModal').modal('show');

 	var catId = $(this).attr('id');
 	var url = "<?php echo base_url('admin/getCat'); ?>";

 	$.ajax({
 		type: 'ajax',
 		method: 'get',
 		async: false,
 		url: url,
 		data: {catId, catId},
 		dataType: 'json',
 		success: function(response){
 			$('input[name = catId]').val(response['componentId']);
 			$('input[name = category').val(response['catName']);
 		},
 		error: function(){
 			alert('Could not load Category');
 		}
 	});
 });

 	$('.btnDelete').on('click', function(){
 		var catId = $(this).attr('id');
 		var url = "<?php echo base_url('admin/deleteCat'); ?>";

 		if(confirm('Sure To Delete?')){
 			$.ajax({
	 			type: 'ajax',
	 			method: 'POST',
	 			async: false,
	 			url: url,
	 			data: {catId, catId},
	 			dataType: 'json',
	 			success: function(response){
	 				$('tbody tr#'+catId).fadeOut();
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


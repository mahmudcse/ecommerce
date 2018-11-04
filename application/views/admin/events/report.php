
<style>
	th, td{
		text-align: center;
	}
</style>



<div class="form-w3layouts">
	<div class="row">
		
		<div class="col-lg-12">
		<?php echo form_open('admin/events'); ?>
			<div class="col-lg-3 pull-left form-group">
				<label for="name">Event Name</label>
				<input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>">
			</div>
			<div class="col-lg-3 pull-left form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control">
					<option value="all" <?php echo set_select('status', 'all'); ?> >All</option>
					<option value="1" <?php echo set_select('status', 1); ?> >Active</option>
					<option value="2" <?php echo set_select('status', 2); ?> >Inactive</option>
				</select>
			</div>

			<div class="col-lg-3 form-group pull-left">
				<input type="submit" class="btn btn-default" value="Submit" class="form-control">
			</div>

		<?php echo form_close(); ?>
		<div class="col-lg-12">
			<div class="col-lg-4 pull-right">
				<p><?php echo $this->pagination->create_links(); ?></p>
			</div>
		</div>
			<table class="table table-hover table-bordered">
				<caption>Events</caption>
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Caption</th>
						<th>status</th>
						<th>Manage Products</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 

				if(isset($events)):
				foreach($events as $key => $event): ?>

					<tr id="<?php echo $event['componentId']; ?>">
						<td>
							<?php echo ++$count_from; ?>
						</td>
						<td>
							<?php echo $event['name']; ?>
						</td>
						<td>
							<?php echo $event['caption']; ?>
						</td>
						<td>
							<?php if($event['status'] == 1){ ?>
								Active
							<?php }else{ ?>
								Inactive
							<?php } ?>
						</td>
						<td>
							<a href="<?php echo base_url('admin/manageEventProducts/'.$event['componentId']) ?>" class="btn btn-default btn-sm">Click Here</a>
						</td>
						<td>
							<a href="<?php echo base_url('admin/eventEdit/').$event['componentId'] ?>" class="btn btn-info btn-sm">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a href="javascript:;" id="<?php echo $event['componentId']; ?>" class="btn btn-danger btn-sm delete"><span><i class="fa fa-trash" aria-hidden="true"></i></span></a>

						</td>
					</tr>
					

				<?php endforeach; ?>
			<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.delete', function(e){
         e.preventDefault();
         var id = $(this).attr('id');
        
        if(confirm('Sure to delete')){
        	var url = '<?php echo base_url('admin/eventDelete/') ?>'+id;
	         $.ajax({
	             url: url,
	             dataType: 'json',
	             success: function(data){
	                 if(data){
	                 	$('tbody tr#'+id).fadeOut();
	                 }
	             },
	             error: function(){
	             	alert('Error');
	             }
	         });
        }

         
	});
</script>
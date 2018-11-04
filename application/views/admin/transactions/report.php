
<style>
	th, td{
		text-align: center;
	}
</style>



<div class="form-w3layouts">
	<div class="row">
		
		<div class="col-lg-12">
		<?php echo form_open('admin/transactionNo'); ?>
			<div class="col-lg-3 pull-left form-group">
				<label for="name">Transaction No</label>
				<input type="text" name="transactionNo" id="name" class="form-control" value="<?php echo $transactionNo; ?>">
			</div>
			<div class="col-lg-3 pull-left form-group">
				<label for="name">Used or Not</label>
				<select name="used" class="form-control">
					<option value="all" <?php echo set_select('used', 'all'); ?> >All</option>
					<option value="1" <?php echo set_select('used', 1); ?> >Used</option>
					<option value="2" <?php echo set_select('used', 2); ?> >Not used</option>
				</select>
			</div>

			<div class="col-lg-3 pull-left form-group">
				<label for="name">Date From</label>
				<input type="text" name="dateFrom" id="name" class="form-control date" value="<?php echo $dateFrom; ?>">
			</div>

			<div class="col-lg-3 pull-left form-group">
				<label for="name">Date To</label>
				<input type="text" name="dateTo" id="name" class="form-control date" value="<?php echo $dateTo; ?>">
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
				<caption>Transaction Numbers</caption>
				<thead>
					<tr>
						<th>#</th>
						<th>Transaction No</th>
						<th>Bank</th>
						<th>Amount</th>
						<th>Date</th>
						<th>Used Or Not</th>
						<th>OrderId</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 

				if(isset($transactions)):
				foreach($transactions as $key => $transaction): ?>

					<tr id="<?php echo $transaction['componentId']; ?>">
						<td>
							<?php echo ++$count_from; ?>
						</td>
						<td>
							<?php echo $transaction['transaction_no']; ?>
						</td>
						<td>
							<?php echo $transaction['bank']; ?>
						</td>
						<td>
							<?php echo $transaction['amount']; ?>
						</td>
						<td>
							<?php echo $transaction['updated_at']; ?>
						</td>
						<td>
							<?php if($transaction['used'] == 1){ ?>
								Used
							<?php }else{ ?>
								Not Used
							<?php } ?>
						</td>
						<td>
							<?php echo $transaction['orderId']; ?>
						</td>
						<td>
							<a href="<?php echo base_url('admin/transactionEdit/').$transaction['componentId'] ?>" class="btn btn-info btn-sm">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a href="javascript:;" id="<?php echo $transaction['componentId']; ?>" class="btn btn-danger btn-sm delete"><span><i class="fa fa-trash" aria-hidden="true"></i></span></a>

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
        	var url = '<?php echo base_url('admin/transactionDelete/') ?>'+id;
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
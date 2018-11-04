 <div class="row">
 	<div class="col-md-12">
 		<table class="table table-responsive table-bordered">
 			<caption>Payment System</caption>
 			<thead>
 				<tr>
 					<th>#</th>
 					<th>Name</th>
 					<th>Rules</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 			<?php foreach($payments as $key => $payment): ?>
 				<tr>
 					<td><?php echo $key+1; ?></td>
 					<td><?php echo $payment['name']; ?></td>
 					<td><?php echo $payment['Rules']; ?></td>
 					<td>
 						<a href="<?php echo base_url('admin/paymentEdit/'.$payment['componentId']) ?>" class="btn btn-info btn-sm">Edit</a>
 					</td>
 				</tr>
 			<?php endforeach; ?>
 			</tbody>
 		</table>
 	</div>
 </div>
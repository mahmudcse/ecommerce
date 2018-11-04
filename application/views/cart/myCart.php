
<table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>#</th>
			<th>Brand</th>
			<th>Model</th>
			<th>Image</th>
			<th>Quantity</th>
			<th>Price (Tk.)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($carts as $key => $cart): ?>
		<tr id="<?php echo $cart['cartId']; ?>">
			<td><?php echo ($key+1); ?></td>
			<td><?php echo $cart['brandName']; ?></td>
			<td><?php echo $cart['model']; ?></td>
			<td>
				<img src="<?php echo base_url().$cart['image']; ?>" class="img-thumbnail" width="100" height="100">
			</td>
			<td>
				<div class="col-lg-2">
                                        <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-info btn-number" id="<?php echo $cart['cartId']; ?>"  data-type="minus" data-field="">
                                          <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>

                                    <!-- <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100"> -->

                                    <input type="text" id="quantity" value="<?php echo $cart['quantity']; ?>" name="quantity[]" class=" input-number" min="<?php echo $cart['price']; ?>" readonly>

                                    <span class="input-group-btn">
                                        <button type="button" id="<?php echo $cart['cartId']; ?>" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
                        </div>
			</td>
			<td class="<?php echo $cart['cartId']; ?> rowPrice"><?php echo $cart['price']*$cart['quantity']; ?></td>
			<td>
				<a href="<?php echo base_url(); ?>customer/productDetails/<?php echo $cart['productId']; ?>" class="btn btn-info" id="<?php echo $cart['cartId']; ?>" target="_blank">View</a>

				<a href="javascript:;" class="btn btn-danger" id="<?php echo $cart['cartId']; ?>">Remove</a>
			</td>
		</tr>
	<?php endforeach; ?>
		<tr>
			<td colspan="5" align="center">Total Amount: </td>
			<td id="totalAmount">
				<!-- <?php
				//if(!empty($totalCartAmount)){
					//echo $totalCartAmount->cartPrice;
				//}
				
				?> -->
				
			</td>
			<td>
				<a href="<?php echo base_url(); ?>customer/order" class="btn btn-success">Order Now</a>
			</td>
		</tr>
	</tbody>
</table>

<script>

$(document).ready(function(){
	totalAmount();
});

	function totalAmount(){
			var sum = 0;
		    $('.rowPrice').each(function(){
		    	sum += parseInt($(this).text(), 10);
	    	
	    });
	    $('#totalAmount').text(sum);
	}


	$('tbody').on('click', '.btn-danger', function(){
		var CartId = $(this).attr('id');
		var url = "<?php echo base_url('customer/removeFromCart'); ?>";

		$.ajax({
			type: 'ajax',
			method: 'POST',
			url: url,
			data: {CartId: CartId},
			dataType: 'json',
			success: function(response){
				$('#cartCounter').text(response);
				$('tbody tr#'+CartId).fadeOut('fast', 'linear');
				$('tbody tr#'+CartId).remove();
				//totalAmount();

				var sum = 0;
		        $('.rowPrice').each(function(){
		        	sum += parseInt($(this).text(), 10);
		        	
		        });
		        $('#totalAmount').text(sum);
			},
			error: function(){
				alert("Failed to remove from cart");
			}
		});


		$('tbody tr#'+id).fadeOut();
	});


	var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();

        


        var rowId = $(this).attr('id');
        var inputValue = parseInt($('tbody tr#'+rowId+' input').attr('value'));
        var incrementedValue = inputValue + 1;



        $('tbody tr#'+rowId+' input').attr('value', incrementedValue);

        var specificPrice = $('td.'+rowId).text();
        var specificPrice = parseInt($('tbody tr#'+rowId+' input').attr('min'));
        var incrementedPrice = incrementedValue * specificPrice;
        $('td.'+rowId).text(incrementedPrice);
        //totalAmount();

        var sum = 0;
        $('.rowPrice').each(function(){
        	sum += parseInt($(this).text(), 10);
        	
        });
        $('#totalAmount').text(sum);


		var url = "<?php echo base_url('customer/updateCart'); ?>";
        $.ajax({
        	method: 'POST',
        	url: url,
        	data: {cartId: rowId, quantity: incrementedValue}
        
        });

    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        

        var rowId = $(this).attr('id');
        var inputValue = parseInt($('tbody tr#'+rowId+' input').attr('value'));

        if(inputValue>1){
        		var decrementedValue = inputValue - 1;
            	$('tbody tr#'+rowId+' input').attr('value', decrementedValue);
            	var specificPrice = $('td.'+rowId).text();
		        var specificPrice = parseInt($('tbody tr#'+rowId+' input').attr('min'));
		        var decrementedPrice = decrementedValue * specificPrice;
		        $('td.'+rowId).text(decrementedPrice);

		        //totalAmount();
		        var sum = 0;
		        $('.rowPrice').each(function(){
		        	sum += parseInt($(this).text(), 10);
		        	
		        });
		        $('#totalAmount').text(sum);



		        var url = "<?php echo base_url('customer/updateCart'); ?>";
		        $.ajax({
		        	method: 'POST',
		        	url: url,
		        	data: {cartId: rowId, quantity: decrementedValue}
		        });




		        // var totalAmount = $('#totalAmount').text();
		        // var totalAmount = parseInt(totalAmount);
         }  
    });
</script>
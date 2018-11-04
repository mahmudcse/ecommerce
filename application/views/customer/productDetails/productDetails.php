<div class="w3l_banner_nav_right">
			<div class="agileinfo_single">
				<h5><?php echo $productDetails['brandName']." ".$productDetails['model']; ?></h5>
				<div class="col-md-4 agileinfo_single_left">
					<img id="example" src="<?php echo base_url().$productDetails['image']; ?>" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-8 agileinfo_single_right">
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5" class="rating">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4" class="rating">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked class="rating">
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2" class="rating">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1" class="rating">
							<label for="rating1">1</label>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>Description :</h4>
						<p><?php echo $productDetails['keyFeatures']; ?></p>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4><?php echo "Tk. ".$productDetails['price']; ?></h4>

						</div>
						<div class="snipcart-details agileinfo_single_right_details" id="addToCartDiv">
								<fieldset>
								<form id="CartAddForm" action="javascript:;">
									<input type="hidden" name="sessionId" value="<?php echo session_id(); ?>">
									<input type="hidden" name="productId" value="<?php echo $productDetails['productId']; ?>">
									<?php 
										if($productExists > 0){ ?>
											<input type="submit" name="submit" value="In Cart" class="button" />
										<?php  }else{ ?>
												<input type="submit" name="submit" value="Add to cart" class="button" id="addToCart" />
										<?php }
									 ?>

									  <?php 
											if($this->session->userdata('is_logged_in')): ?>
												
											<input style="background-color: #ededed; color: #000;" type="submit"
						
												<?php 
													if($existsInWishlist < 1){ ?> 
													
														name="<?php echo $productDetails['productId']; ?>"
														value="Add wishlist" 
													<?php }else{ ?> 
														value="Wished"
														<?php } ?> 
												 
												class="button addToWishlist" 
											/>
										<?php endif; ?>
									

								</form>

								</fieldset>
						</div>
					</div>
					<br><br>
					<?php if($this->session->userdata('is_logged_in')): ?>
					<p>Your Rating</p>
					<br>
					<div class="rating1">
						<span class="starRating">

						<?php foreach($giveRating as $key => $rating): ?>

							<input id="rating<?php echo ($key+1); ?>" type="radio" name="rating" value="<?php echo $rating['rate']; ?>" class="rating">
							<label for="rating<?php echo ($key+1); ?>">
								<?php echo ($key+1); ?>
							</label>

						<?php endforeach ?>

						</span>
					</div>
				<?php endif; ?>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"></div>

		<script>
			$('.addToWishlist').mouseover(function(){
				$(this).css("background-color", "orange")
			});
			$('.addToWishlist').mouseleave(function(){
				$(this).css("background-color", "#ededed");
			});
			$('.addToWishlist').click(function(){
				var productId = $(this).attr('name');
				if(productId == null){
					return false;
				}
				var url = "<?php echo base_url('customer/addToWishlist'); ?>";
				$(this).attr('value', 'Added');
				$(this).removeClass('addToWishlist');
				$(this).removeAttr('name');
				$.ajax({
					method: 'POST',
					url: url,
					data: {productId: productId}
				});
			});


			$(document).on('click', '.rating', function(){
				var rate = $(this).attr('value');
				console.log(rate);
			});

			$('#addToCartDiv').on('click', '#addToCart', function(){
				var values = $('#CartAddForm').serialize();
				var url    = "<?php echo base_url('customer/addToCart'); ?>";

				$(this).attr('value', 'Added');
				$(this).removeAttr('id');

				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: values,
					dataType: 'json',
					async: false,
					success: function(response){
						$('#cartCounter').text(response);
						//$('#CartAddForm input:last').attr('value', 'Added');
						//$('#CartAddForm input:last').removeAttr('id');
					},
					error: function(){
						alert('Can not add to cart');
					}
				});
			});
		</script>

			<div class="w3ls_w3l_banner_nav_right_grid">
				<h3><?php 
					if(isset($pageHeading)){
						echo $pageHeading; 
					}
				?></h3>

				<div class="row">
					<div class="col-md-12">
						<div class="col-md-4 pull-right">
							<?php echo $this->pagination->create_links(); ?>
						</div>
						<?php echo form_open('customer/searchedText'); ?>
						<div class="col-md-2 form-group">
							<label>Sort</label>
							<select name="sort" class="form-control">
								<option value="nosort" <?php if($sort == 'nosort') echo "selected"; ?>>Default Sort</option>
								<option value="namea" <?php if($sort == 'namea') echo "selected"; ?>>Name (A-Z)</option>
								<option value="namez" <?php if($sort == 'namez') echo "selected"; ?>>Name (Z-A</option>
								<option value="pricel" <?php if($sort == 'pricel') echo "selected"; ?>>Price (Low-High)</option>
								<option value="priceh" <?php if($sort == 'priceh') echo "selected"; ?>>Price (High-Low)</option>
								<option value="datea" <?php if($sort == 'datea') echo "selected"; ?>>New - Old</option>
								<option value="dated" <?php if($sort == 'dated') echo "selected"; ?>>Old - New</option>
								<option value="rated" <?php if($sort == 'rated') echo "selected"; ?>>Rating (High-Low)</option>
								<option value="ratea" <?php if($sort == 'ratea') echo "selected"; ?>>Rating (Low-High)</option>
							</select>
						</div>
						<div class="col-md-2 form-group">
							<label>Brand</label>
							<select name="brand" class="form-control">
								<option value="all" <?php if($slBrand == 'all') echo "selected"; ?>>All Brands</option>
							<?php if(isset($brands)): foreach($brands as $brand): ?>
								<option value="<?php echo $brand['brandName'] ?>" <?php if($slBrand == $brand['brandName']) echo "selected"; ?>><?php echo $brand['brandName'] ?></option>
							<?php endforeach; endif; ?>
							</select>
						</div>
						<div class="col-md-3 form-group">
							<label>Price Range ( <span id="range"></span> )</label>
							<br>
							<br>
							<p id="slider"></p>
							<input type="hidden" name="min" value="" id="min">
							<input type="hidden" name="max" value="" id="max">
						</div>

						<div class="col-md-1 form-group">
							<input type="submit" class="btn btn-default" value="Filter">
						</div>

						<?php echo form_close(); ?>
					</div>
				</div>
				
				
				
				<div class="w3ls_w3l_banner_nav_right_grid1" id="productHolder">

	
			<?php $count = 1; ?>
			<?php
			if(!empty($products)):
			foreach ($products as $product): ?>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="<?php echo base_url(); ?>assets/home/images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="<?php echo base_url('customer/productDetails/').$product['componentId']; ?>"><img src="<?php echo base_url().$product['image']; ?>" alt=" " class="img-responsive" /></a>
											<p><?php echo $product['brandName'].' ('.$product['model'].')'; ?></p>
											<h4><?php echo 'Tk. '.$product['price']; ?></h4>
										</div>
										<div class="snipcart-details">
											<form action="javascript:;" method="post" class="formCartHome">
												<fieldset>


												<input type="submit"

												<?php 
														if(empty($product['cartId'])){ ?> 
															name="<?php echo $product['componentId']; ?>"
															value="Add to cart" 
														<?php }else{ ?> 
															value="In cart"
															<?php } ?> 
													 
													class="button addToCartHome" 
												/>

												<?php

												if($this->session->userdata('is_logged_in')): ?>
														
													<input style="background-color: #ededed; color: #000;" type="submit"
								
												<?php 

												if(empty($product['wishlistId'])){ ?> 

												name="<?php echo $product['componentId']; ?>"
												value="Add to wishlist" 
												<?php }else{ ?> 
																value="Wished"
																<?php } ?> 
														 
														class="button addToWishlist" 
													/>
												<?php endif; ?>

												</fieldset>
											</form>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>

					<?php if($count % 4 == 0){ ?>
							
							<div class="clearfix"> </div>
							<br><br>
						<?php } ?>
						<?php $count++; ?>

			<?php endforeach; ?>
		<?php else: ?>
			<?php echo "Empty"; ?>
		<?php endif; ?>

					<div class="clearfix"> </div>
				</div>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<div class="clearfix"> </div>
				</div>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<div class="clearfix"> </div>
				</div>
			</div>

			<script>
				$(document).ready(function(){
					$('#slider').slider({
						range: true,
						min: 10,
						max: 100000,
						values: ["<?php echo $priceFrom ?>", "<?php echo $priceTo ?>"],
						step: 10,
						slide: function(event, ui){
							$('#range').html(ui.values[0] + ' To ' + ui.values[1]);
							$('#min').val(ui.values[0]);
							$('#max').val(ui.values[1]);
						}
					});
					$('#range').html($('#slider').slider('values', 0) + ' To ' + $('#slider').slider('values', 1));
					$('#min').val($('#slider').slider('values', 0));
					$('#max').val($('#slider').slider('values', 1));
				});

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

				$('.addToCartHome').click(function(){


					var productId = $(this).attr('name');
					if(productId == null){
						return false;
					}
					var url = "<?php echo base_url('customer/addToCart'); ?>";

					$(this).attr('value', 'Added');
					$(this).removeAttr('name');
					$(this).removeClass('addToCartHome');
					
					$.ajax({
						type: 'ajax',
						method: 'POST',
						url: url,
						data: {productId: productId},
						async: false,
						dataType: 'json',
						success: function(response){
							$('#cartCounter').text(response);
						}
						
					});
				})
			</script>
		
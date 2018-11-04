<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav nav_1"> 
			<?php $cats = $this->db->get('category')->result_array(); ?>
			<?php foreach ($cats as $cat) { ?>

					<?php $subCats = $this->db->get_where('subcategory', array('catId' => $cat['componentId']))->result_array(); ?>

						<li class="
							<?php if(count($subCats) > 0){ 
								echo "dropdown";
							 } ?>
						">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">		<?php echo $cat['catName']; ?>

								<?php if(count($subCats) > 0){ ?>
										<span class="caret"></span>
										</a>
										<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
											<div class="w3ls_vegetables">
												<ul>
									<?php } ?>
								

							
									<?php foreach ($subCats as $subCat) { ?>
											<?php $specificCats = $this->db->get_where('specificcat', array('subcatId' => $subCat['componentId']))->result_array(); ?>
										
										<li class="
												<?php if(count($specificCats) > 0){ 
													echo "dropdown";
												 } ?>

										">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $subCat['subCatName']; ?>

											

											<?php if(count($specificCats) > 0){ ?>
												<span class="caret"></span>
												</a>
												<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
													<div class="w3ls_vegetables">
														<ul>
											<?php } ?>

											
													
													<?php foreach ($specificCats as $specificCat) { ?>

														<li>
															<a href="frozen.html"><?php echo $specificCat['specificCatName'] ; ?></a>
														</li>
													<?php } ?>

													<?php if(count($specificCats) > 0){ ?>
															</ul>
														</div>                  
													</div>	
													<?php } ?>
													
										</li>
										<br>

									<?php } ?>

									<?php if(count($subCats) > 0){ ?>
											</ul>
										</div> 
									</div>	
									<?php } ?>
									
								                 
							
						</li>

			<?php } ?>


						<!-- <li><a href="products.html">Branded Foods</a></li> -->
						
						
					</ul> 
				 </div><!-- /.navbar-collapse -->
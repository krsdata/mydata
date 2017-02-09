		
		<?php //if(isset($_GET['price']) && $_GET['price']=='ASC')?>

			<aside class="sidebar_aside aside_one">
				<h3 class="aside_head margin_top_0">Sort By Title</h3>
				<select name="" class="form-control margin_bottom_20" onchange="sort_by_product(this);">
					<option value="<?php echo current_url();?>">None</option>
					<option value="<?php echo current_url();?>?title=ASC" <?php if(isset($_GET['title']) && $_GET['title']=='ASC' ) echo "selected"; ?>> Ascending</option>
					<option value="<?php echo current_url();?>?title=DESC" <?php if(isset($_GET['title']) && $_GET['title']=='DESC' ) echo "selected"; ?>> Descending</option>
                </select>
			</aside>

			<?php $popular_products_right = popular_products(); 
				if($popular_products_right) 
					{ ?>
						<aside class="sidebar_aside aside_one">
							<h3 class="aside_head margin_top_0">Popular Products</h3>
							<div class="row">
							<?php 
							foreach ($popular_products_right as $ppr) 
							{	
								if(!empty($ppr->active_image) && file_exists('./assets/uploads/product/thumb/'.$ppr->active_image))
		                        {
		                            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$ppr->active_image;
		                        }
		                        else if(!empty($ppr->first_image) && file_exists('./assets/uploads/product/thumb/'.$ppr->first_image))
		                        {
		                            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$ppr->first_image;
		                        }
		                        else
		                        {
		                            $image = FRONTEND_THEME_URL_NEW.'images/product_1.png';
		                        }
	                        	?>
	                        	<?php $price = ''; 
	                                if($ppr->type == 'Simple')
	                                {
	                                   $price = $ppr->price;
	                                }
	                                else
	                                {
	                                    $price = variation_price($ppr->id);
	                                }
	                            ?>
								
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="row">
										<div class="col-xs-4 col-sm-4 col-md-4 nopadding_right blog_img_contain text-center"><img src="<?php echo $image; ?>" class="product_blog_image"></div>
										<div class="col-xs-8 col-sm-8 col-md-8">
											<p class="aside_post_head"><a href="<?php echo base_url('product/view/'.$ppr->slug)?>"><?php if(!empty($ppr->title)) echo $ppr->title;?></a></p>
											<div class="aside_post_detail"><p class="post_categorie"><?php //if(!empty($ppr->price)) echo '$'.$ppr->price; ?> <?php if(!empty($price)) echo '$'.$price; ?></p></div>
										</div>
									</div>
								</div>						

							<?php 
							}
							?>
							</div>
						</aside>
				<?php } ?>
			<?php $recent_products_right = recent_products(); 
		      	if($recent_products_right) 
		      	{ ?>
					<aside class="sidebar_aside aside_two">
						<h3 class="aside_head margin_top_0">Recent Products</h3>
						<div class="row">
					<?php 
		      		foreach ($recent_products_right as $rpr) 
		      		{	
                        if(!empty($rpr->active_image) && file_exists('./assets/uploads/product/thumb/'.$rpr->active_image))
                        {
                            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$rpr->active_image;
                        }
                        else if(!empty($rpr->first_image) && file_exists('./assets/uploads/product/thumb/'.$rpr->first_image))
                        {
                            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$rpr->first_image;
                        }
                        else
                        {
                            $image = FRONTEND_THEME_URL_NEW.'images/product_1.png';
                        }
                        ?>
                        	<?php $price = ''; 
                                if($rpr->type == 'Simple')
                                {
                                   $price = $rpr->price;
                                }
                                else
                                {
                                    $price = variation_price($rpr->id);
                                }
                            ?>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="row">
									<div class="col-xs-4 col-sm-4 col-md-4 nopadding_right blog_img_contain text-center"><img src="<?php echo $image; ?>" class="product_blog_image"></div>
									<div class="col-xs-8 col-sm-8 col-md-8">
										<p class="aside_post_head"><a href="<?php echo base_url('product/view/'.$rpr->slug)?>"><?php if(!empty($rpr->title)) echo $rpr->title;?></a></p>
										<div class="aside_post_detail"><p class="post_categorie"><?php //if(!empty($rpr->price)) echo '$'.$rpr->price; ?><?php if(!empty($price)) echo '$'.$price; ?></p></div>									
									</div>
								</div>
							</div>						
		      		<?php }
			      	?>
						</div>                   
					</aside>
			<?php } ?>
			<?php $products_category_right = products_category(); 
		      	if($products_category_right) 
		      	{
			    ?>
				<aside class="sidebar_aside aside_three">
					<h3 class="aside_head margin_top_0">Categories</h3>
					<ul class="padding_cutter">
					<?php foreach ($products_category_right as $pcr) { ?>
						<?php if(!empty($pcr->category_slug)&&!empty($pcr->category_name)) { ?>
							<li><a href="<?php echo base_url('product/category/'.$pcr->category_slug);?>"><i class="fa fa-angle-right"></i><?php  echo $pcr->category_name; ?></a></li>
						<?php } ?>

					<?php }?>
					</ul>
				</aside>

			<?php } ?>				
<script type="text/javascript">
function sort_by_product(e)
{
	window.location.href = e.value;
	//alert(e.value);
}
</script>
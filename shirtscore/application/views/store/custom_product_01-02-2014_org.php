
<div class="container">
	<div class="row" style="/* margin-left: 10% */">
		  <div id="home_btn" class="span2 home" style="margin-left: 50px;"><a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a></div>
	      <div id="dude_text" class=" span7 flavor_text">Dude, that's a real sweet-up nice one!</div>
	      <div id="cart_btn" class=" span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>
     </div>

	<div class="clearfloat"></div>
	<div class="row-fluid prodcontent">
		<hr color="3b5998" />
		<div class="span11 dashcontent">
			<div class="row-fluid dashbox">
				<!-- /////////// -->
				<!-- <div class="design_title span12" align="left">Ride a Buffalo and Be Content</div> -->
				<!-- <div class="clearfloat"></div> make it cooment -->
				<!-- <div class="design_author span12">by <a href="#">720•PIXL</a></div> -->
				<!-- /////////// -->
				<div class="span3 prodbox" id="main_image">
				      <img src="<?php echo base_url().'assets/uploads/test/temp/'.$product['product_image']; ?>">
				      <img src="<?php echo base_url().'assets/uploads/test/temp/'.$product['back_image']; ?>">
				      <!-- <img  src="<?php //echo base_url() ?>assets/front_theme/img/product_single_lg.png"> -->
				</div>
  
   			   <hr class="span8" color="#CCCCCC"><br>

			   <div class="minicontainer row-fluid span8" >  	
				    <?php echo form_open("store/add_to_cart_custom/".$product['custom_product'] , $arrayName = array('id' => 'cart_product'));?> <!-- Form Open -->
					 	<?php /*
					  	<div class="span5" style="float:left">
					  		<?php $col=0; if ($colors): ?>
							  	<h1 style="font-size:15px">Select a color:</h1>
					        	<?php foreach ($colors as $row): ?>
									<a href="javascript:void(0);" title=""><div id="col_<?php echo $row->id;  ?>" class="color_select" style=" float:left; margin-left:5px; background-color:<?php echo $row->color_code; ?>;" title="White"></div></a>
									<?php $col++; ?>
							  	<?php endforeach ?>
					        <?php else: ?>
					        <!-- <h1 style="font-size:15px">No other colors:</h1> -->
					        <!-- <div id="col_0" class="color_select" style=" float:left; margin-left:5px; background-color: #ffffff;" title="White"></div> -->
					        <?php endif ?>
					        <input id="this_color" name="color_id" type="hidden" value="0">
					        <input id="color_count" name="color_count" type="hidden" value="<?php echo $col; ?>">
					   	</div>
						*/ ?> 
					   	<div id="sizes_div" class="span7 row-fluid" style="float:left;">

					   		<?php if ($sizes): ?>

						   		<h1 style="font-size:15px">Select quantity for a size:</h1>

						   		<?php foreach ($sizes as $row1): ?>
						   			<div class="span2">
						   				<label class="span12" style="text-align:center;"><?php echo $row1->size_name; ?></label>
							   			<input class="span12 product-sizes" name="sizes_<?php echo $row1->id; ?>" type="text" value = "">
						   			</div>
								<?php endforeach ?>
					        	<input id="this_size_id" name="size_id" type="hidden" value="0">
					        	<input id="this_size_name" name="size_name" type="hidden" value="0">

					        <?php endif ?>

							<!-- <a href="#" style="display:none;">View sizing Chart</a> -->

					   	</div>  
				 	<?php echo form_close(); ?> <!-- Form close -->
			   </div>

			  <!-- <input name="product_id" type="hidden" value="<?php //echo $product->id; ?>"> -->
			  <div class="minicontainer row-fluid span8" > 
				  <div class="span4" style="float:left" >
				  		<h1 style="font-size:15px"><?php echo $product['product_title']; ?></h1><!--<span style="font-size:18px; color:red; text-decoration:line-through;">$22.95</span>-->
				  </div>
				  <div class="span4" style="float:left" >
					  <h2><span style="font-size:18px; color:#3B5998;">Price</span>: <?php echo money_symbol();?><?php echo number_format($product['price'] , 2); ?></h2>
				  </div>
			  	  <div style="float:right" class="span4 cart_add"><a id="add_to_cart" href="javascript:void(0);"><i class="icon-shopping-cart"></i> Add to Cart</a></div>
			 </div>
			<!-- /////////// -->
			<!--   <div class="description span12">
				  <h3>720•PIXL says...</h3>
				  <p>"This design was inspired by the great buffalo rider of YouTube lore. Never liked that bike anyway..."<br><br>This comfy unisex t-shirt is super sweet and made from 100% preshrunk 6.1 oz. Cotton. Sports-gray shirts are 90/10 Cotton/Polyester and dark-gray is 50/50. Available in unisex sizes Small, Medium, Large, XL, 2XL, 3XL and 4XL. Color/size availability may vary.</p>
			  </div> -->
			<!-- /////////// -->
			  <div class="clearfloat"></div><br>

			</div>
		</div>

 		<div id="fb_portion" class="span11 dashcontent">
		   <div class="dashbox_0">
				<div class="row-fluid">
					
					<div class="span12">
						<h3 style="margin-left:20px;">Here is some cool stuff</h3>
						<div class="row" style="margin-left:20px">
						<?php if($latest_design): $i=1; foreach ($latest_design as $row): ?>
						<div style="float:left; margin-left:20px; margin-top:15px" class="">
							<a href="<?php echo base_url() ?>store/design_your_own/<?php echo $row->slug; ?>"><img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image; ?>" style="width:120px; height:120px"></a><br>
							<div style="float:left; width:32%;">
		                        <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
		                        <div class="fb-like" data-href="<?php echo base_url() ?>store/create_my_design/<?php echo $row->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
		                    </div>
							<!-- <img src="<?php //echo base_url() ?>assets/front_theme/img/fb_like.png" style="margin-top:10px"> -->
						</div>
						<?php if ($i%8==0): ?>							
							</div>
							<div class="row" style="margin-left:20px">
						<?php endif; ?>							
						<?php $i++; endforeach; endif; ?>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<style type="text/css" media="screen">
	.description{
				margin-top: 25px;
	}

	.cart_add a{
		margin: 8px 0 0 !important;
	}

	.col_img{
				float:left; 
				margin-top:15px; 
				padding:2px;
				border: medium solid #222222;
				margin-right: 5px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var color_count = $('#color_count').val();
	    if (color_count = 1)
	    {
	        $('.color_select').trigger('click');
	    };
		if($(window).width() <= 320)
			$(".fb-comments").attr('data-width', '280');
	});
</script>


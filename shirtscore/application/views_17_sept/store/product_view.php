	 <?php if (!empty($product->main_image)): ?>
       <?php 
            $prod_img  = getimagesize(base_url().'assets/uploads/products/'.$product->main_image);
            $rest_para = json_decode($product->restricted_para);
            // print_r($rest_para);
            // die();
       ?>
     <?php endif ?>
     <?php if (!empty($design_image)): ?>
       <?php 
            $dsn_img  = getimagesize(base_url().'assets/uploads/designs/temp/'.$design_image);
       ?>
     <?php endif ?>
    <style type="text/css">
      .product-img{
          width: <?php echo $prod_img[0]."px"; ?>;
          height: <?php echo $prod_img[1]."px"; ?>;
          background-image:url(<?php echo base_url().'assets/uploads/products/'.$product->main_image; ?>);
          background-repeat: no-repeat;
          /*background-position: <?php echo $prod_img[0]."px"; ?> <?php echo $prod_img[1]."px"; ?>;*/
      }
	  .create-btn {
		    color: #5876B5;
		    margin-left: 30%;
		    margin-top: 3%;
		    width: 29% !important;
		}
      #draggable { width: <?php echo $dsn_img[0]."px"; ?>; height: <?php echo $dsn_img[1]."px"; ?>; }
      /*#draggable { width: 100px; ?>; height: 100px; }*/
	  #draggable img { cursor: move; }
	  .ui-widget-content {
	        height: <?php  echo $rest_para->height."px"; ?>;
	        left: <?php echo $rest_para->left."px"; ?>;
	        position: relative;
	        top: <?php echo $rest_para->top."px" ?>;
	        width: <?php echo $rest_para->width."px" ?>;
	        background: none !important;
	        border: 1px dashed #D9FE86;
	  }
    </style>

<div class="container">

	<div class="row" style="/* margin-left: 10% */">

		  <div id="home_btn" class=" span2 home" style="margin-left: 50px;"><a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a></div>

	      <div id="dude_text" class=" span7 flavor_text">Dude, that's a real sweet-up nice one!</div>

	      <div id="cart_btn" class=" span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>

     </div>



	<div class="clearfloat"></div>

	<div class="row-fluid prodcontent">

		<hr color="3b5998" />

		<div class="span11 dashcontent">

			<div class="row-fluid dashbox">
				<?php
				 if ($design_info) {
				 	$design_info01 = array();
					foreach ($design_info as $key => $value) {
						$design_info01 = $value;
						break;
					}
					// print_r($design_info01['']); die();
				} ?>				
				<!-- /////////// -->

				<div class="design_title span12" align="left"><?php if($design_info01['design_title'] !=""){ echo $design_info01['design_title']; } ?> <!--Ride a Buffalo and Be Content --> </div>

				<!-- <div class="clearfloat"></div> -->

				<div class="design_author span12">by <a href="#"><?php if(!empty($design_info01['artist'])){echo $design_info01['artist'];} ?>  <!--720•PIXL--></a></div>

				<div class="fb-like span11" align="right"><a href="#"><img  src="<?php echo base_url() ?>assets/front_theme/img/like.jpg" width="75px"></a></div>

				<div class="span4 prodbox" id="main_image">

				   	  <?php  

				   	  	if ($this->session->userdata('current_design')) {

					   		$current_design = $this->session->userdata('current_design');

					   		$design = base_url().'assets/uploads/designs/merged/'.$current_design['design'];

					   		$design_id=$current_design['design_id'];

					   	}else{

					   		$design = base_url().'assets/uploads/products/'.$product->main_image;

					   		$design_id=0;

					   	}

				   	  ?>

				   	  <?php if (!empty($product->restricted_para)): ?>
				   	  	<div id="containment-wrapper" class="span12">
					       <div id="photo" class="product-img span12">
					        <!-- <img id="photo" src="orange.png"> -->
					          <div id="area" class="draggable ui-widget-content">
					            <img id="draggable" src="<?php echo base_url().'assets/uploads/designs/thumbnail/'.$design_image; ?>">
					            <!-- <p id="draggable" class="ui-widget-header">I'm contained within my parent</p> -->
					          </div>
					       </div>
					       <?php echo form_open_multipart(current_url(),array('id'=>'create_image')); ?>
						        <input type="hidden" id="org_x" name="org_x" value="<?php echo $rest_para->left; ?>" />
						        <input type="hidden" id="org_y" name="org_y" value="<?php echo $rest_para->top; ?>" />
						        <input type="hidden" id="x" name="x" value="" />
						        <input type="hidden" id="y" name="y" value="" />
						        <input type="submit" class="btn-large create-btn" name="make_image" value="Complete" />
						   <?php echo form_close(); ?>
					  	</div>
					  <?php else: ?>
				      <img src="<?php echo $design; ?>">
					  <?php endif; ?>

				      <!-- <img  src="<?php //echo base_url() ?>assets/front_theme/img/product_single_lg.png"> -->

				</div>

  

			   <div class="minicontainer span7" align="left">

			   		<h1 style="font-size:15px">Other Totally Awesome Products</h1>

				   		 <!-- Carousel

				    ================================================== -->

				    <div id="myCarousel" class="carousel slide">

					      <ol class="carousel-indicators">

						      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

						      <li data-target="#myCarousel" data-slide-to="1"></li>

						      <li data-target="#myCarousel" data-slide-to="2"></li>

					      </ol>

					      <div class="carousel-inner">

					      	<?php

					      		  $per_slide = 4;

					      		  $items = (int) (count($other_products)/$per_slide);

					      		  $is_more = count($other_products) % $per_slide;



					      		  if ($is_more != 0)

					      		  	$items++;



					      		  // echo "<br>Count = ".count($other_products);

					      		  // echo "<br>Items = ".$items;

					      		  // die();

					      		  $start=0; $end = 0;

					      		  for ($j=1; $j <= $items; $j++)

					      		  {

						      		  if ($j==1)

						      		  	$class = 'active';

						      		  else

						      		  	$class = '';

					      	?>

								      <div class="item <?php echo $class; ?>">

								        	<!-- products -->

								          	<div style="margin-left:15%;">

					      	<?php

						      		  $end = $start + $per_slide;

						      		  for ($k = $start; $k < $end; $k++) {

						      		  	if (isset($other_products[$k])):

						      	?>

										   		<div style="float:left; margin-left:5px">

										   			<a href="<?php echo base_url() ?>store/create_product_design/<?php echo $design_id.'/'.$other_products[$k]->id; ?>" title="Other Products">

										   			<img  src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $other_products[$k]->main_image; ?>"></a><br>

										   			<!-- <a href="#"> -->

										   				<div style="text-align: center; padding:2px;">

										   					<?php echo $other_products[$k]->regular_name; ?>

										   				</div>

										   			<!-- </a> -->

										   		</div>

							<?php

										 endif;

									  }

									  $start = $k;

							?>

										   	</div> 

								     		<!-- products -->

								        </div>

					        <?php } ?>

					      </div>



				      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>

				      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>

				    </div><!-- /.carousel -->  

			   </div>

   			   <hr class="span7" color="#CCCCCC"><br>



			   <div class="minicontainer row-fluid span7">  	

				    <?php echo form_open("store/add_to_cart/".$product->id , $arrayName = array('id' => 'cart_product'));?> <!-- Form Open -->

					  	<div class="span5" style="float:left">

					  		<?php $col=0; if ($colors): ?>

							  	<h1 style="font-size:15px">Select a color:</h1>

					        	<?php foreach ($colors as $row): ?>

									<a href="javascript:void(0);" title=""><div id="col_<?php echo $row->id;  ?>" class="color_select" style=" float:left; margin-left:5px; background-color:<?php echo $row->color_code; ?>;" title="White"></div></a>
									<?php $col++; ?>

							  	<?php endforeach ?>

					        <?php else: ?>

					       <!--  <h1 style="font-size:15px">No other colors:</h1>

					        <div id="col_0" class="color_select" style=" float:left; margin-left:5px; background-color: #ffffff;" title="White"></div> -->

					        <?php endif ?>

					        <input id="this_color" name="color_id" type="hidden" value="0">

					        <input id="color_count" name="color_count" type="hidden" value="<?php echo $col; ?>">

					   	</div>



					   	<div id="sizes_div" class="span7 row-fluid" style="float:left;">

					   		<?php if ($sizes): ?>

						   		<h1 style="font-size:15px">Select a size:</h1>

						   		<?php foreach ($sizes as $row1): ?>
						   			<div class="span2">
						   				<label class="span12" style="text-align:center;"><?php echo $row1->size_name; ?></label>
							   			<input class="span12 product-sizes" name="sizes_<?php echo $row1->id; ?>" type="text" value = "">
						   			</div>
								<?php endforeach ?>
					        	<input id="this_size_id" name="size_id" type="hidden" value="0">
					        	<input id="this_size_name" name="size_name" type="hidden" value="0">

					        <?php endif ?>

							<a href="#" style="display:none;">View sizing Chart</a>

					   	</div>  

				 	<?php echo form_close(); ?> <!-- Form close -->

			   </div>



			  <!-- <input name="product_id" type="hidden" value="<?php //echo $product->id; ?>"> -->

			  <div class="minicontainer row-fluid span7" style="float:right"> 

				  <div class="span4" style="float:left" >

				  		<h1 style="font-size:15px"><?php echo $product->regular_name; ?></h1><!--<span style="font-size:18px; color:red; text-decoration:line-through;">$22.95</span>-->

				  </div>		

					  <?php 

					  		$product_price = $product->price;

					  		if ($this->session->userdata('design_info')) {

								$design_info = $this->session->userdata('design_info');

								$product_price += $design_info[$product->id]['design_price'];

							} 

					  ?>

				  <div class="span4" style="float:left" >

					  <h2><span style="font-size:18px; color:#3B5998;">Price</span>: <?php echo money_symbol();?><?php echo number_format($product_price , 2); ?></h2>

				  </div>

			  	  <div style="float:right" class="span4 cart_add"><a id="add_to_cart" href="javascript:void(0);"><i class="icon-shopping-cart"></i> Add to Cart</a></div>

			 </div>

			  <!-- ////////////////////////////////////////////// -->

			  <div class="span4" id="colored_imgs">

			  		<?php if (isset($col_img)): ?>
				  		<?php if ($col_img): ?>
				  			<?php foreach ($col_img as $row2): ?>

						   		<div class="col_img">

									<a href="javascript:void(0)" onclick="extra_image(<?php echo $row2->id; ?>);" class="extra_image" data-imgid="<?php echo $row2->id; ?>" title=""><img src="<?php echo base_url() ?>assets/uploads/color_img/<?php echo $row2->image_name; ?>" style="width:50px; height:50px"></a><br>

									<span style="padding: 5px;"><?php echo $row2->view; ?></span>

								</div>

							<?php endforeach ?>
				  		<?php endif ?>
			  		<?php endif ?>

					<!-- <div style="float:left; margin-top:15px" class="">

						<img src="<?php //echo base_url() ?>assets/front_theme/img/city_of_marmot.png" style="width:50px; height:50px"><br>

					</div>



					<div style="float:left; margin-top:15px" class="">

						<img src="<?php //echo base_url() ?>assets/front_theme/img/city_of_marmot.png" style="width:50px; height:50px"><br>

					</div>



					<div style="float:left; margin-top:15px" class="">

						<img src="<?php //echo base_url() ?>assets/front_theme/img/city_of_marmot.png" style="width:50px; height:50px"><br>

					</div>



					<div style="float:left; margin-top:15px" class="">

						<img src="<?php //echo base_url() ?>assets/front_theme/img/city_of_marmot.png" style="width:50px; height:50px"><br>

					</div> -->

				</div>

				<br><br><br>

			  <!-- ////////////////////////////////////////////// -->

			  <div class="description span12">

				  <h3><?php if(!empty($design_info01['artist'])){echo $design_info01['artist'];} ?> says...</h3>

				  <p>"<?php if(!empty($design_info01['desc'])){echo $design_info01['desc'];}else{echo "This is an awesome design...";} ?>" <!--This design was inspired by the great buffalo rider of YouTube lore. Never liked that bike anyway..."<br><br>This comfy unisex t-shirt is super sweet and made from 100% preshrunk 6.1 oz. Cotton. Sports-gray shirts are 90/10 Cotton/Polyester and dark-gray is 50/50. Available in unisex sizes Small, Medium, Large, XL, 2XL, 3XL and 4XL. Color/size availability may vary.--></p>

			  </div>

			  <div class="clearfloat"></div><br>



				<!-- /////////// -->

			</div>

		</div>



 		<div id="fb_portion" class="span11 dashcontent">

		   <div class="dashbox_0">

				<div class="row-fluid">

					<div class="span5" >

						<div class="fb-comments" data-href="<?php echo current_url() ?>" data-width="450"></div>

				   		<!-- <img src="<?php //echo base_url() ?>assets/front_theme/img/fbcomment.png"> -->

					</div>

					<div class="span7">

						<h3 style="margin-left:3%;">Here is some cool stuff</h3>

						<div class="row" style="margin-left:0%;">

						<?php if($latest_design): $i=1; foreach ($latest_design as $row): ?>

						<div style="float:left; margin-left:3%; margin-top:2%" class="">

							<a href="<?php echo base_url() ?>store/create_product_design/<?php echo $row->id; ?>"><img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image; ?>" style="width:120px; height:120px"></a><br>

							<!-- <img src="<?php // echo base_url() ?>assets/front_theme/img/fb_like.png" style="margin-top:10px"> -->
							<div style="margin-left:20%; width:32%;">
		                        <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
		                        <div class="fb-like" data-href="<?php echo base_url() ?>store/create_my_design/<?php echo $row->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
		                    </div>

						</div>						

						<?php if ($i%4==0): ?>							

							</div>

							<div class="row" style="margin-left:0%;">						

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



	.col_img{

				float:left; 

				margin-top:15px; 

				padding:2px;

				border: medium solid #222222;

				margin-right: 5px;

	}

</style>

<script type="text/javascript">
	// jQuery(document).ready(function() {


 //            });
	$(document).ready(function(){
	     var color_count = $('#color_count').val();
	     if (color_count = 1)
	     {
	        $('.color_select').trigger('click');
	     };
		if($(window).width() <= 320)

			$(".fb-comments").attr('data-width', '280');



		$('.product-sizes').on('change keydown', function() {
            // $(this).val()
            var val = $(this).val();
            if (val != "") {
              $( ".product-sizes" ).each(function() {
                $(this).val('');
              });
              // alert(val);
              $(this).val(val);
              var name = $(this).attr('name');
              $('#this_size_name').val(name);
              var id = name.split("_");
              $('#this_size_id').val(id[1]);
            };
          });

		var counts = 0;
	    $( "#draggable" ).draggable({
	          containment: "parent",
	          drag: function() {
	            var p = $( "#draggable" );
	            var position = p.position();
	            // $("#log").text( "left: " + position.left + ", top: " + position.top );
	            $( "#x" ).val(position.left);
	            $( "#y" ).val(position.top);
	          },
	    });

	    $('#create_image').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: "<?php echo base_url().'store/ajax_image_merged'; ?>",
            data: $('#create_image').serialize(),
            success: function (resp) {
            	$('#containment-wrapper').html(resp);
              // alert(resp);
            }
          });
          return false;
        });

	});

</script>
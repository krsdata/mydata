<section id="page_content" class="single_product_content">
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="page_head">Products</h1>
            </div>
        </div>
        <div class="row border_bottom margin_top_40">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php  echo msg_alert_frontend(); ?>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5">
                <div id='carousel-custom' class='carousel slide sproduct_slider' data-ride='carousel'>
                    <div class='carousel-outer'>
                        <div class='carousel-inner'>
                            <?php if(!empty($images)) { ?>
                                    <?php $active='active'; foreach ($images as $img) { ?>
                                        <?php if(!empty($img->image) && file_exists('./assets/uploads/product/'.$img->image)) { ?>
                                            <div class='item <?php echo $active; ?>' style="background-image:url('<?php echo BACKEND_THEME_URL.'assets/uploads/product/'.$img->image; ?>');">
                                                <!-- <img src='<?php // echo BACKEND_THEME_URL.'assets/uploads/product/'.$img->image; ?>' alt='' /> -->
                                            </div>
                                        <?php } ?>
                                    <?php $active=''; }?>
                            <?php } else { ?>
                            <div class='item active' style="background-image:url('<?php echo FRONTEND_THEME_URL_NEW; ?>images/no_image.jpg');">
                                <!-- <img src='<?php // echo FRONTEND_THEME_URL_NEW; ?>images/no_image.jpg' alt='' /> -->
                            </div>
                            <?php } ?>
                        </div>
                        <?php if(!empty($images) && count($images)>1) { ?>   
                                <!-- sag sol -->
                                <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                                     <span class='glyphicon glyphicon-chevron-left'></span>
                                </a>
                                <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                                     <span class='glyphicon glyphicon-chevron-right'></span>
                                </a>
                        <?php }?>
                    </div>
            
                    <!-- thumb -->
                    <ol class='carousel-indicators mCustomScrollbar meartlab'>
                        <?php if(!empty($images)) { ?>
                            <?php $active='active'; $i=0; foreach ($images as $img) { ?>
                                <?php if(!empty($img->image) && file_exists('./assets/uploads/product/'.$img->image)) { ?>
                                    <li data-target='#carousel-custom' data-slide-to='<?php echo $i;?>' class='<?php echo $active; ?>'><img src='<?php echo BACKEND_THEME_URL.'assets/uploads/product/'.$img->image; ?>' alt='' /></li>
                                <?php $i++; } ?>
                            <?php $active=''; } ?>
                        <?php } else {?>
                        <li data-target='#carousel-custom' data-slide-to='0' class='active'><img src='<?php echo FRONTEND_THEME_URL_NEW; ?>images/no_image.jpg' alt='' /></li>
                        <?php } ?>
                    </ol>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-7 col-md-7">
                <h2 class="section_heading "><?php if(!empty($detail->title)) echo $detail->title; ?></h2>
                <div class="section_text"><?php if(!empty($detail->short_description)) echo $detail->short_description; ?></div>
                <ul class="sproduct_social nopadding_left margin_top_30">
                    <li>
                    	<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>

                    	<!-- <a href="#"><i class="fa fa-facebook"></i>share on facebook</a> -->
                    	<div class="fb-share-button" data-href="<?php echo current_url();?>" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
                    </li>
                    <li>
                    	<a href="https://twitter.com/share" class="twitter-share-button" data-size="" data-show-count="false">
                    	</a>
                    	<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </li>
                    <li>
                    	<!-- Place this tag in your head or just before your close body tag. -->
						<script src="https://apis.google.com/js/platform.js" async defer></script>

						<!-- Place this tag where you want the share button to render. -->
						<!-- <div class="g-plus" data-action="share"></div> --> 
                    	<a href="#" class="g-plus" data-action="share" data-show-count="false"></a>
                    	<!-- <g:plus action="share"></g:plus> -->
                    </li>
                </ul>
                <!-- <a class="twitter-share-button"
				  href="https://twitter.com/intent/tweet">
				Tweet</a> -->
				<!-- <a href="https://twitter.com/share" class="twitter-share-button" data-size="large" data-text="Text" data-via="Lash U Lashes" data-lang="en" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script> -->
                <div class="sproduct_info_box margin_top_30">
                    <div class="row section_text"><!-- row1 -->
                        <?php 
                            $product_available = 1;
                            if($detail->type!='Simple') { ?>
                            <?php if(!empty($detail->attributes)) { ?>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-info" id="product_price_message_li">
                                    </div>
                                    <?php   $attributes_array = json_decode($detail->attributes);
                                            $attributes_array_count = count($attributes_array); 
                                            if($attributes_array_count>0) 
                                            { 
                                                $variation_list = variation_list_array($detail->id,$detail->attributes); ?>
                                                <?php if($variation_list[1]) { ?>
                                                    <?php for ($k=0; $k < $attributes_array_count ; $k++) {  ?>
                                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                                            <?php if(isset($variation_list[1][$attributes_array[$k]])) 
                                                            {?>
                                                                <label for=""><?php echo ucfirst($variation_list[1][$attributes_array[$k]]->attribute); ?></label>
                                                            <?php }?>
                                                                <select id="attri_<?php echo $attributes_array[$k]; ?>" class="form-control"  onchange = 'product_price(<?php echo $attributes_array[$k]; ?>);' argu='<?php //echo $detail->attributes; ?>'<?php if($k>0)  echo 'disabled="disabled"'; ?>>
                                                                    <option value="">-- Options --</option>
                                                                    <?php if(isset($variation_list[0][$attributes_array[$k]])) { ?>
                                                                        <?php foreach ($variation_list[0][$attributes_array[$k]] as $varr) { ?>
                                                                            <option value="<?php echo $varr->id; ?>"><?php echo $varr->name; ?></option>
                                                                        <?php }?>
                                                                    <?php } ?> 
                                                                </select>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { $product_available=0;?>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 text-info" id="product_price_message_li">This product currently not available in stock.</div>
                                                <?php } ?>
                                            <?php } else { $product_available=0;?>
                                                <div class="col-xs-12 col-sm-12 col-md-12  text-info" id="product_price_message_li">This product currently not available in stock.</div>
                                            <?php } ?>
                            <?php } else { $product_available=0; ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-info" id="product_price_message_li">This product currently not available in stock.</div>
                            <?php } ?>
                                        <!-- <div class="partition_row margin_top_40"></div> -->
                        <?php } else {  ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-info" id="product_price_message_li"></div>
                        <?php }?>
                    </div>
                    <?php if($product_available) { ?>
                    <ul class="margin_top_30 section_text">
                        <?php if($detail->type=='Simple') 
                            { ?>
                            <li>Price: <?php if(!empty($detail->price)) echo '$'.$detail->price; ?></li>
                            <input type="hidden" name="price" id="product_price_input" value="<?php if(!empty($detail->price)) echo $detail->price; ?>">
                        <?php }  
                            else 
                            { ?>
                            <input type="hidden" name="price" id="product_price_input" value="">
                            <input type="hidden" name="price" id="product_variation_input" value="">
                            <li id="product_price_li">Price: ---</li>
                        <?php } ?>

                        <li>


                            <input type="number" name="quantity" value="1" min="1" max="999" id="product_quantity_input" >
                            </li>
                        <li><a class="btn" onclick="add_to_cart()" >add to cart</a></li>
                        <li><a class="btn" onclick="add_to_favorites()">add to favorites</a></li>
                        <li>
                           <!-- review button start -->
                                <!--  <a class="btn" onclick="open_review_model()" >Write a review</a> -->
                           <!-- review button end -->
                        </li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="row margin_top_30 border_bottom">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php if(!empty($detail->description)) { ?>
                    <h2 class="section_heading">Product Discription</h2>
                    <div class="section_text"><?php  echo $detail->description; ?></div>
                <?php } ?>
            </div>
        </div>

        <!-- Best selling product slider --> 
        <?php if(!empty($best_product)) { ?>
            <div class="margin_top_30">
                <div class="row">
                    <div class="col-xs-12 col-sm-9 col-md-9">
                        <h2 class="section_heading margin_top_0 margin_bottom_0">FEATURED Products</h2>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <!-- Controls -->
                        <div class="controls pull-right hidden-xs0">
                            <?php if(count($best_product)>1) {  ?>
                                <a class="left fa fa-chevron-left btn rsliderbtn crsl-previous" href="#carousel-example" data-slide="prev"></a>
                                <a class="right fa fa-chevron-right btn rsliderbtn crsl-next" href="#carousel-example" data-slide="next"></a>
                            <?php } ?>                     
                        </div>
                    </div>
                </div>

                <div class="row best_selling_products padding_bottom_30 margin_top_30 border_bottom">
                    <?php foreach ($best_product as $row_best) { ?>                                                
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="col-item">
                                <a href="<?php echo base_url('product/view/'.$row_best->slug)?>">
                                    <?php 
                                        if(!empty($row_best->active_image) && file_exists('./assets/uploads/product/thumb/'.$row_best->active_image))
                                        {
                                            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$row_best->active_image;
                                        }
                                        else if(!empty($row_best->first_image) && file_exists('./assets/uploads/product/thumb/'.$row_best->first_image))
                                        {
                                            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$row_best->first_image;
                                        }
                                        else
                                        {
                                            $image = FRONTEND_THEME_URL_NEW.'images/product_1.png';
                                        }
                                    ?>
                                    <!-- <img src="<?php // echo $image; ?>" class="selling_product_img img-responsive" alt="a" /> -->
                                    <div class="selling_product_img" style="background-image:url('<?php echo $image; ?>');"></div>
                                </a>
                                <?php $price = ''; 
                                    if($row_best->type == 'Simple')
                                    {
                                       $price = $row_best->price;
                                    }
                                    else
                                    {
                                        $price = variation_price($row_best->id);
                                    }
                                ?>
                                <div class="sproduct_info text-center margin_top_10">
                                    <div class="price">
                                        <p class="product_name margin_bottom_0">
                                            <?php //if(!empty($row_best->title)) echo $row_best->title; ?>
                                            <?php if(!empty($row_best->title)) echo word_limiter($row_best->title,2); ?>
                                        </p>
                                        <p class="product_price"><?php if(!empty($price)) {echo '$'.$price; } else echo "&nbsp;"; ?></p>
                                        <div class="hover_star ">
                                            <div id="best_avg_rating_<?php echo $row_best->id;?>" class="avg_star_inline"></div>
                                            <?php if(!empty($row_best->avg_rating)) { ?>
                                                <script type="text/javascript">
                                                        MyRating('best_avg_rating_<?php echo $row_best->id;?>',<?php echo $row_best->avg_rating; ?>);
                                                </script>
                                            <?php } else { ?>
                                                <script type="text/javascript">
                                                        MyRating('best_avg_rating_<?php echo $row_best->id;?>',0);
                                                </script>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="sproduct_info_btn">
                                        <a href="<?php echo base_url('cart/add/'.$row_best->slug)?>">Add to cart</a>
                                        <a href="<?php echo base_url('product/view/'.$row_best->slug)?>">More details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if(!empty($product_rating0)) { ?>
            <?php 
                $average_rating = 0;
                $j=0;
                foreach ($product_rating as $value_rating) 
                {
                    $j++;
                    $average_rating = $average_rating + $value_rating->rating;
                    
                }
                if($j>0)
                {
                    $average_rating = $average_rating/$j;
                    $average_rating = number_format($average_rating,1);
                }
                else
                {
                    $average_rating ='';
                }


            ?>
            <!-- REVIEW and rating section start -->
            <div class="row review_row border_bottom margin_top_30">
                <h2 class="section_heading">Review of lash u lashes <?php if(!empty($detail->title)) echo $detail->title; ?></h2>
                <div class="col-xs-2 col-sm-2 col-md-2 text-center">
                    <div class="star_rating_container margin_top_20">
                        <i class="fa fa-star star_yellow"></i>    
                        <p class="star_rating_text margin_cutter"><?php if(!empty($average_rating)) echo $average_rating; ?></p>
                    </div>
                    <p class="section_text_small">Average Rating Based on 5 ratings</p>
                </div>
            </div>
            <div class="row sproduct_row6 border_bottom margin_top_30">
                <h2 class="section_heading margin_bottom_40">Top reviews</h2>
                <?php  foreach ($product_rating as $row_rating) {
                ?>
                    <div class="row margin_bottom_20">
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="hover_star">
                                        <div id="user_rating_<?php echo $row_rating->rating_id;?>"></div>
                               <?php if(!empty($row_rating->rating)) { ?>
                                        <script type="text/javascript">
                                                MyRating('user_rating_<?php echo $row_rating->rating_id;?>',<?php echo $row_rating->rating; ?>);
                                        </script>
                                <?php } else  { ?>
                                        <script type="text/javascript">
                                                MyRating('user_rating_<?php echo $row_rating->rating_id;?>',0);
                                        </script>
                                <?php } ?>
                            </div>                    
                            <p class="section_text margin_cutter"><?php if(!empty($row_rating->first_name)) echo $row_rating->first_name; if(!empty($row_rating->last_name)) echo $row_rating->last_name;  ?></p>
                            <p class="section_text"><?php echo date('M d, Y',strtotime($row_rating->created)); ?></p>                
                        </div>
                        <div class="col-xs-12 col-sm-10 col-md-10">
                            <!-- <p class="section_text">Awesome! Product</p> -->
                            <p class="section_text_small"><?php if(!empty($row_rating->review)) echo $row_rating->review; ?></p>
                        </div>
                    </div>
                <?php } ?>                                      
            </div> 
            <!-- REVIEW and rating section end  http://testweb3.iecworld.com/jsdemo/js/lq_js_point/ --> 
        <?php } ?>    
    </div>
</section>
<?php if(empty($detail->attributes)) $detail->attributes = '[]';?>
<script>
    var product_id         = <?php echo $detail->id; ?>;
    var product_attributes = <?php echo $detail->attributes; ?>;
    var product_attributes_lendth = product_attributes.length;
    
    function product_price(id)
    {
        var argument = product_attributes;
        var product_id = <?php echo $detail->id; ?>;
        var argument_length =  argument.length;
        var input_value = [];
        var flag = 1;
        var position = 0;
        for (i = 0; i < argument_length; i++) 
        {
          if(argument[i] == id)
          {
            position = i;
            break;
          }
        }

        if(argument[argument_length-1] == id)
        {
            for (i = 0; i < argument_length; i++) 
            {
              input_value[i] = $("#attri_"+argument[i]).val();
            }
            //console.log(input_value);
            for (i = 0; i < argument_length; i++) 
            {
              if(input_value[i] == null || input_value[i] ==''|| input_value[i] =='undefined')
                flag =0;

            }
            if(flag ==1)
            {
                $.post('<?php echo base_url("product/product_price"); ?>',{ id:product_id,argument:argument,value:input_value},
                        function(data) 
                        {
                            if(data.status == 1)
                            {
                                $("#product_price_message_li").html("");
                                $("#product_price_li").html('Price : $'+data.price);
                                $("#product_price_input").val(data.price);
                                $("#product_variation_input").val(data.variation_id);
                                $("#product_quantity_input").val(1);
                            }
                            else
                            {
                                $("#product_price_message_li").html("<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>This variation currently not available in stock.</div>");
                                /*$("#product_price_li").html('Price :...');
                                $("#product_price_input").val('');
                                $("#product_variation_input").val('');
                                $("#product_quantity_input").val(1);*/
                                empty_product_value(position);
                            }
                        });
            }
            else
            {
                $("#product_price_message_li").html("<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>Please Select Product Variations</div>");
                /*$("#product_price_li").html('Price :...');
                $("#product_price_input").val('');
                $("#product_variation_input").val('');
                $("#product_quantity_input").val(1);*/
                empty_product_value(position);

            }
        }
        else
        {
            var selected_attr_id = $("#attri_"+id).val();
            var selected_attr_array_id = [];
            if(selected_attr_id.length<1)
            {
                empty_product_value(position);
            }
            else
            {
                if(position < (argument_length-1))
                {
                    empty_product_value(position);
                }
                if(argument_length>1)
                {
                    for (i = 0; i <= position; i++) 
                    {
                      selected_attr_array_id.push($("#attri_"+argument[i]).val());
                    }
                }
                //alert(selected_attr_array_id);

                $.post('<?php echo base_url("product/attribute_options"); ?>',{product_id:product_id,attr_id:id,variation_ids:selected_attr_array_id,position:position},
                function(data) 
                {
                    $("#attri_"+argument[eval(position+1)]).html(data);
                    $("#attri_"+argument[eval(position+1)]).removeAttr('disabled');
                });
            }



        }
    }

    function empty_product_value(position)
    {
        for (i = eval(position+1); i < product_attributes_lendth; i++) 
        {
          $("#attri_"+product_attributes[i]).html('<option value="">--Select--</option>');
          $("#attri_"+product_attributes[i]).attr('disabled', 'disabled');
        }
        $("#product_price_li").html('Price :...');
        $("#product_price_input").val('');
        $("#product_variation_input").val('');
        $("#product_quantity_input").val(1);
    }

    function add_to_cart()
    {
        var product_id  = <?php echo $detail->id; ?>;
        var type        = '<?php echo $detail->type; ?>';
        var price       = $("#product_price_input").val();
        var quantity    = $("#product_quantity_input").val();
        //var variation   = $("#product_variation_input").val();
        
        if(price==null||price==''||price=='undefined'||quantity==null||quantity==''||quantity=='undefined'||quantity<1||quantity>999)
        {
            //stop cart action
            if(quantity<1)
            {
                $("#product_price_message_li").html("<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>Please Select Quantity Equal One or Greater.</div>");
            }
            else if(quantity>999)
            {
                $("#product_price_message_li").html("<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>Please Select Quantity Equal 999 or Lesser.</div>");
            }
            else
            {
                $("#product_price_message_li").html("<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-info-circle'></i>Please Select Product Variations</div>");
            }
        }
        else
        {            
            if(type == 'Simple')
            {
                $.post('<?php echo base_url("cart/add_to_cart"); ?>',{ id:product_id,type:type,price:price,quantity:quantity},
                    function(data) 
                    {
                        if(data.status)
                        {
                            window.location = "<?php echo base_url('cart');?>";
                        }
                        else
                        {
                            $("#product_price_message_li").html(data.message);
                        }

                    });
            }
            else
            {
                var variation           = $("#product_variation_input").val();
                var detail_attributes   = <?php echo $detail->attributes; ?>;
                var variation_length    = <?php echo $detail->attributes; ?>;

                variation_length = variation_length.length;
                if(variation==null||variation==''||variation=='undefined')
                {
                     //stop cart action
                }
                else
                {
                    $.post('<?php echo base_url("cart/add_to_cart"); ?>',{ id:product_id,type:type,price:price,quantity:quantity,variation:variation,variation_length:variation_length},
                    function(data) 
                    {
                        if(data.status)
                        {
                            window.location = "<?php echo base_url('cart');?>";
                        }
                        else
                        {
                            $("#product_price_message_li").html(data.message);
                        }

                    });
                }
            }
        }

    }

    function open_review_model()
    {   
        
        var user_id = '<?php echo  user_id(); ?>';
        var product_id= <?php echo $detail->id; ?>;      
        $.post('<?php echo base_url("product/check_review"); ?>',{ product_id:product_id},
                function(data) 
                {
                    if(data.status == 0)
                    {
                        $("#product_price_message_li").html('<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-info-circle"></i>Please login or sign-up to add review. <a class="form_carot" href=" <?php echo base_url();?>website/login">Login</a> </div>');
                    }
                    else if(data.status == 1)
                    {
                        $("#product_price_message_li").html('<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-info-circle"></i>You have already given review for this item.</div>');
                    }
                    else if(data.status == 2)
                    {
                        $("#review").val('');
                        $('#star_rating').raty();
                        //$("input[name='score']").val('');

                        $("#star_rating_error").html('');
                        $("#review_error").html('');
                        $("#review_rating_model").modal();                            
                    }
                    else
                    {

                    }
                });

    }
</script>


<!-- start product review and rating model -->

<div class="modal fade" id="review_rating_model" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Write A Review</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">               
                    <div class="form-group">
                        <div class="review_text-message"> 
                            <div class="section_text_small top_buffer_5">
                                <strong>Please do not include:</strong> HTML, references to other retailers, pricing, personal information, any profane, inflammatory or copyrighted comments, or any copied content.
                            </div>
                            <textarea id="review" name="review" row="4" class="form-control" required></textarea>
                            <p class="form_carot section_text_small margin_cutter" id="review_error"></p>
                            <p class="section_text_small margin_cutter">(Please make sure your review contains at least 100 characters.)</p>
                        </div>
                    </div>                                    
                    <div class="form-group top_buffer_30">
                        <label for="rating">Your Rating <span class="form_carot">*</span></label>
                        <!-- <p class="hover_star"><i class="fa fa-star star_yellow"></i><i class="fa fa-star star_yellow"></i><i class="fa fa-star star_yellow"></i><i class="fa fa-star star_yellow"></i><i class="fa fa-star"></i></p> -->
                        <div id="star_rating"></div>
                        <p class="section_text_small margin_cutter">(Click to rate on scale of 1-5) </p>
                        <p class="form_carot section_text_small margin_cutter" id="star_rating_error"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn_pink" onclick="add_review();">Submit</button>                    
            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- end product review and rating model -->
<script type="text/javascript">
    function add_review()
    {
        var product_id= <?php echo $detail->id; ?>;      
        var review  = $("#review").val();
        var score = $("#star_rating input").val();
        //var score   = $('input[name="score"]').val();
        if(review==''||review==null||review=='undefined' || score==''||score==null||score=='undefined'||review.length<100)
        {
            if(score==''||score==null||score=='undefined')
            {
                $("#star_rating_error").html('The rating field is required');
            }
            else
            {
                $("#star_rating_error").html('');
            }
            if(review==''||review==null||review=='undefined')
            {
                $("#review").focus();                
                $("#review_error").html('The message field is required');
            }
            else if(review.length<100)
            {
                $("#review_error").html('Please enter at least 100 characters.');
            }
            else
            {
               $("#review_error").html(''); 
            }
        }
        else
        {
            
            $.post('<?php echo base_url("product/add_review"); ?>',{ product_id:product_id,review:review,score:score},
                    function(data) 
                    {   
                        if(data.status == 0)
                        {
                            $("#product_price_message_li").html('<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-info-circle"></i>You have already given review for this item.</div>');                            
                        }
                        else if(data.status == 1)
                        {
                            $("#product_price_message_li").html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-check-circle"></i>Your review has been saved successfully.</div>');
                        }
                        else
                        {
                            $("#product_price_message_li").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i>There is some error please try again after some time.</div>');
                        }

                        $("#review_rating_model").modal('hide');


                    });
        }
    }

    function add_to_favorites()
    {           
        var product_id= <?php echo $detail->id; ?>;      
        $.post('<?php echo base_url("product/add_to_favorites"); ?>',{ product_id:product_id},
                function(data) 
                {
                    if(data.status == 0)
                    {
                        $("#product_price_message_li").html('<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-info-circle"></i>Please login or sign-up to add on favorites. <a class="form_carot" href=" <?php echo base_url();?>website/login">Login</a> </div>');
                    }
                    else if(data.status == 1)
                    {
                        $("#product_price_message_li").html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-check-circle"></i>You has already added this product on favorites list. <a class="form_carot" href=" <?php echo base_url();?>website/my_favorites">View All</a></div>');
                    }
                    else if(data.status == 2)
                    {
                        $("#product_price_message_li").html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-check-circle"></i>Products is successfully added on your favorites list.<a class="form_carot" href=" <?php echo base_url();?>website/my_favorites">View All</a></div>');
                    }
                    else
                    {
                         $("#product_price_message_li").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i>There is some error please try again later.</div>');
                    }
                });

    }
</script>
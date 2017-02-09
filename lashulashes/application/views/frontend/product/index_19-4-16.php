<section id="page_content" class="">
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="page_head">Products</h1>
            </div>
        </div>
        <div class="row product_row2 margin_top_40">
            <div class="col-xs-12 col-sm-9 col-md-9">
            <?php  echo msg_alert_frontend(); ?>
                <div id="error_message"></div>
                <div class="row">
                    <?php if(!empty($products)) { ?>
                        <?php foreach ($products as $row) { ?>
                            <div class="col-xs-12 col-sm-3 col-md-4 margin_bottom_30">  
                                <div class="pro_contain text-center">
                                    <div class="pro_main">
                                            <?php 
                                                if(!empty($row->active_image) && file_exists('./assets/uploads/product/thumb/'.$row->active_image))
                                                {
                                                    $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$row->active_image;
                                                }
                                                else if(!empty($row->first_image) && file_exists('./assets/uploads/product/thumb/'.$row->first_image))
                                                {
                                                    $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$row->first_image;
                                                }
                                                else
                                                {
                                                    $image = FRONTEND_THEME_URL_NEW.'images/product_1.png';
                                                }
                                            ?>
                                        <div class="img_container" style="background-image:url('<?php echo $image; ?>');">

                                            <!-- <img src="<?php // echo $image; ?>"> -->
                                        </div>
                                        <div class="pro_info">
                                            <h3 class="product_name"><?php if(!empty($row->title)) echo word_limiter($row->title,2); ?></h3>
                                            <p class="product_price"><?php if(!empty($row->price)) echo '$'.$row->price; ?></p> 
                                        </div>
                                    </div>
                                    <div class="pro_hover">
                                        <div class="pro_hover_wrapper">
                                            <h3 class="product_name margin_bottom_0 margin_top_0"><?php if(!empty($row->title)) echo word_limiter($row->title,2); ?></h3>
                                            <p class="product_price"><?php if(!empty($row->price)) echo '$'.$row->price; ?></p>
                                            <p class="hover-discription"><?php if(!empty($row->short_description)) echo character_limiter(strip_tags($row->short_description),90); ?></p>
                                            <div class="hover_star margin_bottom_40">
                                                <div class="hover_star ">
                                                    <div id="product_avg_rating_<?php echo $row->id;?>" class="avg_star_inline"></div>
                                                    <?php if(!empty($row->avg_rating)) { ?>
                                                        <script type="text/javascript">
                                                                MyRating('product_avg_rating_<?php echo $row->id;?>',<?php echo $row->avg_rating; ?>);
                                                        </script>
                                                    <?php } else { ?>
                                                        <script type="text/javascript">
                                                                MyRating('product_avg_rating_<?php echo $row->id;?>',0);
                                                        </script>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <div class="hover_links">
                                                <div><a href="<?php echo base_url('cart/add/'.$row->slug);?>" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fa fa-cart-plus"></i></a></div>
                                                <div><a href="<?php echo base_url('product/view/'.$row->slug);?>" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-eye"></i></a></div>
                                                <div><a onclick="add_to_favorites(<?php echo $row->id; ?>)" data-toggle="tooltip" data-placement="top" title="Add to Favorites" style="cursor: pointer;"><i class="fa fa-heart-o"></i></a></div>
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <?php echo $pagination; ?>
                            </div>
                        <?php } else { ?>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <h3>No Product Found</h3>
                            </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 upper_pro_sidebar">
                <?php $this->load->view("frontend/product/right_bar"); ?> 
            </div>                                                                                                  
        </div>
        <?php if(!empty($best_product)) { ?>
            <div class="margin_top_20 margin_bottom_20">
                <div class="row">
                    <div class="col-xs-12 col-sm-9 col-md-9">
                        <h2 class="section_heading margin_top_0 margin_bottom_0"> FEATURED Products</h2>
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

                <div class="row best_selling_products margin_bottom_0 margin_top_30">
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
                                    <!-- <img src="<?php // echo $image; ?>" class="selling_product_img img-responsive" alt="" /> -->
                                    <div class="selling_product_img" style="background-image:url('<?php echo $image; ?>');"></div>
                                </a>
                                <div class="sproduct_info text-center margin_top_10">
                                    <div class="price">
                                        <p class="product_name margin_bottom_0"><?php if(!empty($row_best->title)) echo $row_best->title; ?></p>
                                        <p class="product_price"><?php if(!empty($row_best->price)) {echo '$'.$row_best->price; } else echo "&nbsp;"; ?></p>
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
    </div>
</section>
<script type="text/javascript">
    
    function add_to_favorites(product_id)
    {               
        $.post('<?php echo base_url("product/add_to_favorites"); ?>',{ product_id:product_id},
                function(data) 
                {
                    if(data.status == 0)
                    {
                        $("#error_message").html('<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-info-circle"></i>Please login or sign-up to add on favorites. <a class="form_carot" href=" <?php echo base_url();?>website/login">Login</a> </div>');
                    }
                    else if(data.status == 1)
                    {
                        $("#error_message").html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-check-circle"></i>You has already added this product on favorites list. <a class="form_carot" href=" <?php echo base_url();?>website/my_favorites">View All</a></div>');
                    }
                    else if(data.status == 2)
                    {
                        $("#error_message").html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-check-circle"></i>Products is successfully add on your favorites list.<a class="form_carot" href=" <?php echo base_url();?>website/my_favorites">View All</a></div>');
                    }
                    else
                    {
                         $("#error_message").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i>There is some error please try again later.</div>');
                    }
                });

    }
</script>

                
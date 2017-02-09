<?php $footer_segment = $this->uri->segment(1);
?>
    <!-- Site Footer -->
    <footer id="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 footer_col footer_col_one">
                    <h2 class="footer_col_head">About Us</h2>

                    <p class="footer_section_text"><?php $site_about = get_option(11); ?>
                        <?php if($site_about) { echo character_limiter($site_about,150); }?>
                    <a href="<?php echo base_url('about-us'); ?>" class="footer_section_link0"><b>Read More</b></a></p>
                </div>
                <div class="col-xs-4 col-sm-3 col-md-3 footer_col footer_col_two">
                    <h2 class="footer_col_head">Products</h2>
                    <ul class="padding_0 margin_bottom_0">
                        <?php $products_category_list = products_category(); ?>
                        <?php if($products_category_list) { ?>
                            <?php foreach ($products_category_list as $pcl) { ?>
                                <?php if(!empty($pcl->category_slug) && !empty($pcl->category_name)) { ?>
                                    <li><a href="<?php echo base_url('product/category/'.$pcl->category_slug);?>"><?php  echo $pcl->category_name; ?></a></li>                                        
                                <?php } ?>
                            <?php }?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-xs-4 col-sm-3 col-md-3 footer_col footer_col_three">
                    <h2 class="footer_col_head">Membership</h2>
                    <ul class="padding_0 margin_bottom_0">
                        <?php $membership_category_list = membership_category(); ?>
                            <?php if($membership_category_list) { ?>
                                <?php foreach ($membership_category_list as $key => $mcl) { ?>
                                    <?php if(!empty($mcl->title_slug) && !empty($mcl->title)) { ?>
                                        <li><a href="<?php echo base_url('membership/detail/'.$mcl->title_slug.'/#'.($key+1));?>"><?php  echo $mcl->title; ?></a></li>
                                    <?php } ?>
                                <?php }?>
                            <?php } ?>                            
                    </ul>
                </div>
                <div class="col-xs-4 col-sm-3 col-md-3 footer_col footer_col_four">
                    <h2 class="footer_col_head">Get Social</h2>
                    <ul class="padding_0 margin_bottom_0">
                        <?php $site_fb = get_option(6); ?>
                        <?php if($site_fb) {?>
                        <li><a href="<?php echo $site_fb; ?>" target="_blank"><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/social/facebook_icon.png" alt="facebook" title="Facebook" /></a></li>
                        <?php } ?>
                        <?php $site_tw = get_option(5); ?>
                        <?php if($site_tw) {?>
                        <li><a href="<?php echo $site_tw; ?>" target="_blank" ><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/social/twitter_icon.png" alt="twitter" title="Twitter" /></a></li>
                        <?php } ?>
                        <?php $site_go = get_option(7); ?>
                        <?php if($site_go) {?>
                        <li><a href="<?php echo $site_go; ?>" target="_blank" ><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/social/googleplus_icon.png" alt="googleplus" title="Google Plus" /></a></li>
                        <?php } ?>
                        <?php $site_pi = get_option(4); ?>
                        <?php if($site_pi) {?>
                        <li><a href="<?php echo $site_pi; ?>" target="_blank" ><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/social/pint_icon.png" title="Pinterest" ></a></li>
                        <?php } ?>
                        <?php $site_insta = get_option(8); ?>
                        <?php if($site_insta) {?>
                        <li><a href="<?php echo $site_insta; ?>" target="_blank" ><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/social/instagram_icon.png" alt="instagram" title="instagram" /></a></li>
                        <?php } ?>
                        <?php $site_fli = get_option(9); ?>
                        <?php if($site_fli) {?>
                        <li><a href="<?php echo $site_fli; ?>" target="_blank" ><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/social/flickr_icon.png" alt="flickr" title="flickr"/></a></li>
                        <?php } ?>
                        <?php $site_pi = get_option(10); ?>
                        <?php if($site_pi) {?>
                        <li><a href="<?php echo $site_pi; ?>" target="_blank" ><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/social/vimeo_icon.png" alt="vimeo" title="vimeo" /></a></li>
                        <?php } ?>
                        
                    </ul>           
                </div>
            </div>
        </div>
    </footer>

    <footer id="footer_bottom" class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p class="footer_bottom_para margin_cutter col-xs-6 col-sm-6 col-md-6 "><label class="pull-left">All Rights Reserved | Copyright &copy; Lash U Lashes 2016</label></p>
                    <p class="footer_bottom_para margin_cutter col-xs-6 col-sm-6 col-md-6"><label class="pull-right">Design and Developed by <a href="http://www.chapter247.com/" target="_blank"><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/home/c247Logo.png" width="117"></a></label></p>
                </div>
            </div>  
        </div>

        <div class="to_top"><i class="fa fa-angle-up"></i></div>

    </footer>
    <!-- End Site Footer -->


</div>

    <!-- SCRIPTS -->
    <script type="text/javascript">
        var my_base_url = "<?php echo base_url();?>";
    </script>
    <!-- <script type="text/javascript" src="<?php //echo FRONTEND_THEME_URL_NEW; ?>js/jquery.min.js"></script> -->
    <!-- Jquery Library Call -->
    <script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>js/jquery-migrate-1.2.1.min.js"></script> <!-- Jquery migrate library -->
    <script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap Library Call -->
    <script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>js/modernizr.js"></script>
    
    <script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>js/jquery.fancybox.js"></script><!-- gallery page, fancyBox main --> 
    <script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/slick/slick.min.js"></script><!-- product page (best selling product) slider js-->       
    <!--<script type="text/javascript" src="<?php //echo FRONTEND_THEME_URL_NEW; ?>vendor/swipe-box/js/jquery.swipebox.min.js"></script> SWIPE BOX -->
    
    <script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- header menu -->
   
    
    <script type="text/javascript">
            $(document).ready(function() {

                 
                window.setTimeout(function() {
                    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 10000);
                 

                /*
                * review page rating 
                */

                //* review page rating 
                $('#star_rating').raty();       
              
                //*  Simple image gallery. Uses default settings            
                $('.fancybox').fancybox();

                //*  Different effects                    

                // Change title type, overlay closing speed
                $(".fancybox-effects-a").fancybox({
                    helpers: {
                        title : {
                            type : 'outside'
                        },
                        overlay : {
                            speedOut : 0
                        }
                    }
                });

                // Disable opening and closing animations, change title type
                $(".fancybox-effects-b").fancybox({
                    openEffect  : 'none',
                    closeEffect : 'none',
                    helpers : {
                        title : {
                            type : 'over'
                        }
                    }
                });

                // Set custom style, close if clicked, change title type and overlay color
                $(".fancybox-effects-c").fancybox({
                    wrapCSS    : 'fancybox-custom',
                    closeClick : true,
                    openEffect : 'none',
                    helpers : {
                        title : {
                            type : 'inside'
                        },
                        overlay : {
                            css : {
                                'background' : 'rgba(238,238,238,0.85)'
                            }
                        }
                    }
                });

                // Remove padding, set opening and closing animations, close if clicked and disable overlay
                $(".fancybox-effects-d").fancybox({
                    padding: 0,
                    openEffect : 'elastic',
                    openSpeed  : 150,
                    closeEffect : 'elastic',
                    closeSpeed  : 150,
                    closeClick : true,
                    helpers : {
                        overlay : null
                    }
                });

                //*  Button helper. Disable animations, hide close button, change title type and content
                $('.fancybox-buttons').fancybox({
                    openEffect  : 'none',
                    closeEffect : 'none',
                    prevEffect : 'none',
                    nextEffect : 'none',
                    closeBtn  : false,
                    helpers : {
                        title : {
                            type : 'inside'
                        },
                        buttons : {}
                    },

                    afterLoad : function() {
                        this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
                    }
                });

                //*  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
                $('.fancybox-thumbs').fancybox({
                    prevEffect : 'none',
                    nextEffect : 'none',
                    closeBtn  : false,
                    arrows    : false,
                    nextClick : true,
                    helpers : {
                        thumbs : {
                            width  : 50,
                            height : 50
                        }
                    }
                });
                
                // *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
                $('.fancybox-media')
                    .attr('rel', 'media-gallery')
                    .fancybox({
                        openEffect : 'none',
                        closeEffect : 'none',
                        prevEffect : 'none',
                        nextEffect : 'none',
                        arrows : false,
                        helpers : {
                            media : {},
                            buttons : {}
                        }
                });

                //*  Open manually
                $("#fancybox-manual-a").click(function() {
                    $.fancybox.open('1_b.jpg');
                });

                $("#fancybox-manual-b").click(function() {
                    $.fancybox.open({
                        href : 'iframe.html',
                        type : 'iframe',
                        padding : 5
                    });
                });

                $("#fancybox-manual-c").click(function() {
                    $.fancybox.open([
                        {
                            href : '1_b.jpg',
                            title : 'My title'
                        }, {
                            href : '2_b.jpg',
                            title : '2nd title'
                        }, {
                            href : '3_b.jpg'
                        }
                    ], {
                        helpers : {
                            thumbs : {
                                width: 75,
                                height: 50
                            }
                        }
                    });
                });


                /*
                *   product page, Best Selling Products slider
                */
                $('.best_selling_products').slick({
                  dots: false,
                  infinite: true,
                  speed: 300,
                  slidesToShow: 4,
                  slidesToScroll: 1,
                  prevArrow: '.crsl-previous', 
                  nextArrow: '.crsl-next',        
                  responsive: [
                    {
                      breakpoint: 1024,
                      settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
                      }
                    },
                    {
                      breakpoint: 767,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: false             
                      }
                    },
                    {
                      breakpoint: 480,
                      settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false             
                      }
                    }
                  ]
                });

                $("#change_state").change(function(event) 
                {
                    var state_id = this.value;
                    $.post('<?php echo base_url("website/get_aus_cities")?>/'+state_id, function(data) 
                    {
                      $("#change_city").html(data);
                    });
                });

                $("#change_state2").change(function(event) 
                {
                    var state_id = this.value;
                    $.post('<?php echo base_url("website/get_aus_cities")?>/'+state_id, function(data) 
                    {
                      $("#change_city2").html(data);
                    });
                });

                $(":input").inputmask();
                
                var contact_page_height = $(".contact_content").innerHeight();
                $('#map').css({"height" : contact_page_height});

                var charity_pill_height = $(".charity_wrapper .nav.nav-pills").outerHeight();
                $('.charity_wrapper .tab-content .tab-pane').outerHeight(charity_pill_height);

                /**/

            });
    </script>
</body>
</html>

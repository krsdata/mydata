
<html lang="en">
<head>
<!-- Basic Page Needs -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Lash U Lashes</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Shinra">
<link rel="icon" type="image/png" href="<?php echo FRONTEND_THEME_URL_NEW; ?>images/favicon.png">
<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS -->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/reset.css" rel="stylesheet" type="text/css"><!-- Reset All -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"><!-- BOOTSTRAP GRID -->
<!-- <link href="<?php //echo FRONTEND_THEME_URL_NEW; ?>vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"> --><!-- BOOTSTRAP THEME -->
<!-- <link href="<?php //echo FRONTEND_THEME_URL_NEW; ?>vendor/swipe-box/css/swipebox.min.css" media="screen" rel="stylesheet" type="text/css"> --><!-- SWIPE BOX -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/animate.min.css" rel="stylesheet" type="text/css"><!-- Animations -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"><!-- Font Awesome -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/swiper/css/swiper.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/jquery.fancybox.css?v=2.1.5" media="screen" /><!--gallery page, fancy bax css-->
<!-- main CSS -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/style.css" rel="stylesheet" type="text/css"><!-- PRIMARY STYLESHEET -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/style_client.css" rel="stylesheet" type="text/css"><!-- PRIMARY STYLESHEET -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/response.css" rel="stylesheet" type="text/css">

<!-- <link href="<?php //echo FRONTEND_THEME_URL_NEW; ?>css/custom.css" rel="stylesheet" type="text/css"> --><!-- CUSTOM STYLESHEET FOR STYLING -->
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="/css/ie.css" media="screen" /><![endif]-->
<!--[if gte IE 9]><style type="text/css">body:after{filter: none;}</style><![endif]-->
<!-- Color Style -->
<link href="<?php echo FRONTEND_THEME_URL_NEW; ?>css/color.css" rel="stylesheet" type="text/css"><!-- CUSTOM STYLESHEET FOR STYLING -->
<script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>js/jquery.min.js"></script> <!-- Jquery Library Call -->
<script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>js/isotope.pkgd.js"></script> <!-- SWIPER -->
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/slick/slick.css"/><!-- product page (best selling product) slider -->
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/slick/slick-theme.css"/><!-- product page (best selling product) slider -->
<link href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/calendar/css/style-personal.css"/>
<!-- home page slider -->

<style type="text/css" media="print">
    @page { 
        size: landscape;
    }
    body { 
        writing-mode: lr-tb;
    }
    .shipping_cut {
        page-break-before: always;
    }
</style>
<script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>vendor/swiper/js/swiper.js"></script>
<script type="text/javascript" src="<?php echo BACKEND_THEME_URL; ?>assets/global/plugins/jquery-inputmask/inputmask/jquery.inputmask.js"></script>
</head>

<body class="body">

<!-- <div class="top-head-warp"> -->

    <header class="header">
		<div class="user_area">

	        <ul class="">
                    <li><a href="<?php echo base_url('cart');?>"><i class="fa fa-shopping-cart"><div class="icon_buzz"><?php echo $this->cart->total_items();?></div></i> Cart</a></li>
                <?php if(user_logged_in()) { ?>

                    <li><a href="<?php echo base_url('website/logout');?>"><i class="fa fa-sign-out"></i> Log-out</a></li>
                    <li><a href="<?php echo base_url('website/profile');?>"><i class="fa fa-user"></i> Profile</a></li>

                <?php } else if(distributor_logged_in()) { ?>

                    <li><a href="<?php echo base_url('distributor/logout');?>"><i class="fa fa-sign-out"></i> Log-out</a></li>
                    <li><a href="<?php echo base_url('distributor/profile');?>"><i class="fa fa-user"></i> Profile</a></li>

                <?php } else { ?>

                    <li><a href="<?php echo base_url('website/login');?>"><i class="fa fa-user"></i> Login</a></li>
                    <li><a href="<?php echo base_url('website/registration');?>"><i class="fa fa-thumbs-up"></i> Sign-up</a></li>                 
                <?php } ?> 
            </ul>
		</div>

	    <div class="site_header">
	        <div class="logo_xs visible-xs visible-sm">
                <a href="<?php echo base_url();?>"><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/logo.png"></a>
            </div>
	        <div class="main-menu-wrapper">
	            <nav class="navigation">
	                <ul class="sf-menu margin_bottom_0">
	                    <li>
                            <!-- <a href="<?php //echo base_url('product')?>">Products</a> -->
	                        <a href="javascript:void(0);">Products</a>
                            <div class="nav_back"></div>
                            <ul class="dropdown">
                                <?php $products_category_list = products_category(); ?>
                                <?php if($products_category_list) { ?>
                                    <?php foreach ($products_category_list as $pcl) { ?>
                                        <?php if(!empty($pcl->category_slug) && !empty($pcl->category_name)) { ?>
                                            <li><a href="<?php echo base_url('product/category/'.$pcl->category_slug);?>"><?php  echo $pcl->category_name; ?></a></li>
                                        <?php } ?>
                                    <?php }?>
                                <?php } ?>
                                <li><a href="<?php echo base_url('product')?>">All</a></li>
                            </ul>
	                    </li>
	                    <li>
                            <!-- <a href="<?php //echo base_url('training/view');?>">Training</a> -->
	                        <a href="javascript:void(0);">Training</a>
                            <div class="nav_back"></div>
                            <ul class="dropdown">
                                <li><a href="<?php echo base_url('training/view/BRONZE#1'); ?>">BRONZE Classic Lashes</a></li>
                                <li><a href="<?php echo base_url('training/view/SILVER#2'); ?>">SILVER Master Class</a></li>
                                <li><a href="<?php echo base_url('training/view/GOLD#3'); ?>">GOLD 3D Russian</a></li>
                                <li><a href="<?php echo base_url('training/view/PINK#4'); ?>">PINK Accreditation</a></li>
                                <!-- <li><a href="<?php //echo base_url('training/calendar');?>">Training Courses</a></li> -->
                            </ul>
	                    </li>
	                    <li>
                            <!-- <a href="<?php //echo base_url('membership')?>">Membership</a> -->
	                    	<a href="javascript:void(0);">Membership</a>
                            <div class="nav_back"></div>
                            <ul class="dropdown">
                                <?php $membership_category_list = membership_category(); $m=1;?>
                                <?php if($membership_category_list) { ?>
                                    <?php foreach ($membership_category_list as $mcl) { ?>
                                        <?php if(!empty($mcl->title_slug) && !empty($mcl->title)) { ?>
                                            <li><a href="<?php echo base_url('membership/detail/'.$mcl->title_slug.'/#'.$m);?>"><?php  echo $mcl->title; ?></a></li>
                                        <?php $m++; } ?>
                                    <?php }?>
                                <?php } ?>
                            </ul>
	                    </li>
	                    <li class="nav_logo">
	                        <div class="logo visible-md visible-lg">
                                <a href="<?php echo base_url();?>"><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/logo.png"></a>
                            </div>
	                    </li>
	                    <li>
                            <!-- <a href="#">Salon Service</a> -->
	                        <a href="javascript:void(0);">Salon Service</a>                       
                            <div class="nav_back"></div>
                            <ul class="dropdown right">
                                <?php $service_category_list = service_category(); ?>
                                    <?php if($service_category_list) { ?>
                                        <?php foreach ($service_category_list as $scl) { ?>
                                            <?php if(!empty($scl->post_title) && !empty($scl->post_slug)) { ?>
                                                <li><a href="<?php echo base_url('service/index/'.$scl->post_slug);?>"><?php  echo $scl->post_title; ?></a></li>
                                            <?php } ?>
                                        <?php }?>
                                    <?php } ?>
                                <li><a href="<?php echo base_url('service/booking');?>">Book Salon Service</a></li>
                                <!-- <li><a href="#">Calendar</a></li> -->
                                <li><a href="<?php echo base_url('training/calendar');?>">Training Calendar</a></li>
                            </ul>
	                    </li>
	                    <li>
                            <!-- <a href="#">More</a> -->
	                        <a href="javascript:void(0);">More</a>
                            <div class="nav_back"></div>
                            <ul class="dropdown right">
                                <li><a href="<?php echo base_url('about-us');?>">About Us</a></li>
                                <li><a href="<?php echo base_url('faq');?>">FAQ</a></li>
                                <li><a href="<?php echo base_url('blog');?>">Media</a></li>
                                <!-- <li><a href="http://205.134.251.196/~examin8/CI/lashulashes/news">News</a></li> -->
                                <li><a href="<?php echo base_url('testimonials');?>">Testimonials</a></li>
                                <li><a href="<?php echo base_url('gallery');?>">Gallery</a></li>
                                <li><a href="<?php echo base_url('contact');?>">Contact Us</a></li>
                            </ul>
	                    </li>
	                    <li class="rightway">
	                    	<a target="_blank" href="http://www.rightwayprogram.com.au/trainer-assessor/industry-professional-development-partners#lash"><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/home/rightway.png"></a>
	                    </li>
	                </ul>
	            </nav>
	        </div>
	        <a href="#" class="menu-toggle visible-xs visible-sm"><i class="fa fa-bars"></i></a>
	        
	    </div>

	    <script>

            function show_menu(){
                if($(window).width() > 991){
                                    
                    $(".sf-menu li").on("click",function(){

                        if($(this).find('.nav_back').hasClass('menu_down'))
                        {
                            $(".sf-menu li .nav_back").removeClass('menu_down');
                            $(".sf-menu li .dropdown").removeClass('menu_list_down');
                        }else{
                            $(".sf-menu li .nav_back").removeClass('menu_down');
                            $(this).find('.nav_back').toggleClass('menu_down');
                            $(".sf-menu li .dropdown").removeClass('menu_list_down');
                            $(this).find('.dropdown').toggleClass('menu_list_down');
                        }
                    });
                }else{
                    $(".sf-menu li .nav_back").removeClass('menu_down');
                    $(".sf-menu li .dropdown").removeClass('menu_list_down');
                    $(".sf-menu li").off();
                }
            }

            $(document).ready(function(){
                //$(".sf-menu li").off();
                show_menu();
                $('.main-container').click(function(){
                    $(".sf-menu li .nav_back").removeClass('menu_down');
                    $(".sf-menu li .dropdown").removeClass('menu_list_down');
                });

	            $(".menu-toggle").mousedown(function(){
                    $(".main-menu-wrapper").slideToggle();
                	return false;
	            });
	            
	            $(window).resize(function(){
                    
                    show_menu();
	                if($(".menu-toggle").hasClass("opened")){
	                    $(".main-menu-wrapper").css("display","block");
	                } else {
	                    $(".menu-toggle").css("display","none");
	                }
	                if ($(window).width() > 991){
	                    $(".main-menu-wrapper").css("display","block");
                    }
                    else {
                        $(".main-menu-wrapper").css("display","none");
	                }
	            });
	            
	            if ($(window).width() > 991){
	                    $(".main-menu-wrapper").css("display","block");
                } else {
                    $(".main-menu-wrapper").css("display","none");
                }
	            
	            var url_temp = "";
	            
	            $(".sf-menu > li > a").on("touchend", function(event) {
		            event.preventDefault();
		            if ( url_temp==$(this).attr("href") ) {
			            url_temp = "";
			            window.location.href = $(this).attr("href");
		            }
		            url_temp = $(this).attr("href");
				});
	           
	        });
	   

/*
            $(window).load(function(){
                var menu_width = $('.sf-menu').outerWidth();
                $('.sf-menu .dropdown').css({'width':menu_width});

                $('.sf-menu li').click(function(){
                    var aa = $(this).find('.dropdown').outerHeight();
                    if($(this).find('.dropdown').hasClass('menu_list_down')){
                        console.log('dasfadsf');
                        $(this).find('.menu_down').css({'height':aa});
                    } else {
                        $(this).find('.menu_down').css({'height':'0'});
                    }


                });


            });

*/

        </script>
        <!-- #header menu -->

	</header>

    <script type="text/javascript">
            var my_base_url = "<?php echo base_url();?>";
    </script>
    <script type="text/javascript" src="<?php echo FRONTEND_THEME_URL_NEW; ?>raty/jquery.raty.js"></script><!-- review page, star rating -->
    <script type="text/javascript">
             
            function MyRating(id,star)
            {
                   
                    $('#'+id).raty({
                        halfShow    :  true,
                        readOnly    :  true,
                        score       :  star,
                        round : { down: .25, full: .6, up: .76 }
                    });
                    //$('#user_rating_1 input').val(star);
            }
    </script>
<!-- </div> -->
<div class="main-container">


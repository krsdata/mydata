<?php $uri_segment = $this->uri->segment(2); ?>
<!DOCTYPE html>
<html class="sidebar_default  no-js" lang="en">
<head>
<meta charset="utf-8">
<title>shirtscore | SuperAdmin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- <link rel="shortcut icon" href="<?php //echo THEME_URL ?>css/images/favicon.png"> -->
<!-- Le styles -->
<link href="<?php echo THEME_URL ?>css/twitter/bootstrap.css" rel="stylesheet">
<link href="<?php echo THEME_URL ?>css/base.css" rel="stylesheet">
<link href="<?php echo THEME_URL ?>css/twitter/responsive.css" rel="stylesheet">
<link href="<?php echo THEME_URL ?>css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
<!-- For Selector -->
<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL ?>css/imgareaselect-default.css" />
<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 

    
<!-- For Selector -->
<style type="text/css">
   [class^="icon-"], [class*=" icon-"] {
          background-image: none !important;
        }
</style>
<script src="<?php echo THEME_URL ?>js/jquery.js" type="text/javascript"> </script> 
<script src="<?php echo THEME_URL ?>js/plugins/modernizr.custom.32549.js"></script>
<!-- For Selector -->
<script src="<?php echo THEME_URL ?>js/jquery-1.8.3.min.js"></script>
<script src="<?php echo THEME_URL ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo THEME_URL ?>js/plugins/jquery.imgareaselect.pack.js"></script>

<!-- For Selector -->

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
</head>

<body>
<!--<div id="loading"><img src="<?php echo THEME_URL ?>img/ajax-loader.gif"></div>-->
<div id="responsive_part">
  <div class="logo"> <a href="index.html"><span>Start</span><span class="icon"></span></a> </div>
  <ul class="nav responsive">
    <li>
      <button class="btn responsive_menu icon_item" data-toggle="collapse" data-target=".overview"> <i class="icon-reorder"></i> </button>
    </li>
  </ul>
</div>
<!-- Responsive part -->

<div id="sidebar" class="">
  <div class="scrollbar">
    <div class="track">
      <div class="thumb">
        <div class="end"></div>
      </div>
    </div>
  </div>
  <div class="viewport ">
    <div class="overview collapse">
      <div class="search row-fluid container">
        <br>
        
      </div>
      <ul id="sidebar_menu" class="navbar nav nav-list container full">
        <?php if( $uri_segment=='' ||  $uri_segment=='index' ) $active_class='active'; else $active_class='';  ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_4"> <a class="dashboard " href="<?php echo base_url() ?>superadmin"><img src="<?php echo THEME_URL ?>img/menu_icons/dashboard.png"><span>Dashboard</span></a> </li>


        
        <?php if($uri_segment==='store_admins' || $uri_segment==='pending_stores'  || $uri_segment==='store_setting'  || $uri_segment==='add_store_admin' || $uri_segment==='stores' || $uri_segment==='edit_store_admin'|| $uri_segment=='approved_stores' ||$uri_segment=='store_detail'  || $uri_segment=='admin_details' || $uri_segment=='emailtostore_admin'  || $uri_segment==='add_Store' || $uri_segment==='edit_store'){ $active_class='active'; $open_class='in'; }else{ $active_class=''; $open_class='';  } ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1"> <img src="<?php echo THEME_URL ?>img/menu_icons/users.png"><span>Manage Stores</span></a>
          <ul id="collapse1" class="accordion-body collapse <?php echo $open_class; ?>">
            <li><a href="<?php echo base_url()."superadmin/store_admins"?>">Store Admins</a></li>
            <li><a href="<?php echo base_url()."superadmin/add_store_admin"?>">Add Store Admin</a></li>           
            <li><a href="<?php echo base_url()."superadmin/approved_stores"?>">Approved Stores</a></li>
            <li><a href="<?php echo base_url()."superadmin/pending_stores"?>">Pending Stores</a></li>
            <li><a href="<?php echo base_url()."superadmin/add_Store"?>">Add Stores</a></li>  
            <li><a href="<?php echo base_url()."superadmin/store_setting"?>">Store Setting</a></li>
               
          </ul>
        </li>


        <?php if( $uri_segment=='design_seller' || $uri_segment==='edit_design_seller') 
        { $active_class='active'; $open_class='in'; }
        else {$active_class=''; $open_class='';} ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"  data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse22"><img src="<?php echo THEME_URL ?>img/menu_icons/widgets.png"><span>Design seller</span></a> 
            <ul id="collapse22" class="accordion-body collapse <?php echo $open_class; ?>">
              <li><a href="<?php echo base_url() ?>superadmin/design_seller">Design Seller</a></li>
              </ul>
        </li>

        <?php if( $uri_segment=='best_seller' || $uri_segment==='add_edit_best_seller') 
        { $active_class='active'; $open_class='in'; }
        else {$active_class=''; $open_class='';} ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"  data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2221"><img src="<?php echo THEME_URL ?>img/menu_icons/widgets.png"><span>Best seller</span></a> 
            <ul id="collapse2221" class="accordion-body collapse <?php echo $open_class; ?>">
              <li><a href="<?php echo base_url() ?>superadmin/best_seller">Best Seller</a></li>
               <li><a href="<?php echo base_url() ?>superadmin/add_edit_best_seller">Add Best Seller</a></li>
              </ul>
        </li>

        <?php if( $uri_segment=='user_pay_request' || $uri_segment==='paypal_users' || $uri_segment=='user_pay_request_bank' || $uri_segment==='user_pay_request_cheque' || $uri_segment==='user_pay_request_approve') 
        { $active_class='active'; $open_class='in'; }
        else {$active_class=''; $open_class='';} ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"  data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse22233"><img src="<?php echo THEME_URL ?>img/menu_icons/others.png"><span>Commission Requests</span></a> 
            <ul id="collapse22233" class="accordion-body collapse <?php echo $open_class; ?>">
               <li><a href="<?php echo base_url().'superadmin/user_pay_request'; ?>">Pending Requests</a></li>   
               <li><a href="<?php echo base_url().'superadmin/user_pay_request_approve'; ?>">Commissions Paid</a></li>     
              </ul>
        </li>


        <?php if( $uri_segment=='products' || $uri_segment=='colors' || $uri_segment=='edit_size' || $uri_segment=='edit_group' || $uri_segment=='product_info' || $uri_segment=='edit_product'|| $uri_segment=='add_product' || $uri_segment=='sizes' || $uri_segment=='add_size' || $uri_segment=='product_group' || $uri_segment=='add_group'   ) {$active_class='active'; $open_class='in';} else {$active_class=''; $open_class='';} ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"  data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2"><img src="<?php echo THEME_URL ?>img/menu_icons/widgets.png"><span>Products</span></a> 
            <ul id="collapse2" class="accordion-body collapse <?php echo $open_class; ?>">
              <li><a href="<?php echo base_url() ?>superadmin/products">Products</a></li>                      
              <li><a href="<?php echo base_url().'superadmin/add_product'; ?>">Add Products</a></li>                      
              <li><a href="<?php echo base_url().'superadmin/sizes'; ?>">Sizes</a></li>                 
              <li><a href="<?php echo base_url().'superadmin/add_size'; ?>">Add sizes</a></li>                                    
              <li><a href="<?php echo base_url().'superadmin/product_group'; ?>">Product Groups</a></li>
              <li><a href="<?php echo base_url().'superadmin/add_group'; ?>">Add Groups</a></li> 
                                   
             </ul>
        </li>

         <?php if( $uri_segment=='designs' || $uri_segment=='edit_category' || $uri_segment=='add_category' || $uri_segment=='categories' || $uri_segment=='add_design' || $uri_segment=='edit_design' || $uri_segment=='product_designs'  ) {$active_class='active'; $open_class='in';} else {$active_class=''; $open_class='';} ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"  data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse3"><img src="<?php echo THEME_URL ?>img/menu_icons/widgets.png"><span>Manage Design</span></a> 
            <ul id="collapse3" class="accordion-body collapse <?php echo $open_class; ?>">
              <li><a href="<?php echo base_url() ?>superadmin/designs">Design</a></li>                      
              <li><a href="<?php echo base_url().'superadmin/add_design'; ?>">Add Design</a></li>
               <li><a href="<?php echo base_url().'superadmin/categories'; ?>">Categories</a></li>
              <li><a href="<?php echo base_url().'superadmin/add_category'; ?>">Add Category</a></li>
              <?php /*<li><a href="<?php echo base_url() ?>superadmin/design_categories">Design Category</a></li>                      
              <li><a href="<?php echo base_url().'superadmin/add_design_category'; ?>">Add Design Category</a></li>                                                                                                  
              <li><a href="<?php echo base_url().'superadmin/product_designs'; ?>">Add Design To Product</a></li> */?>
                                                                                                               
             </ul>
        </li>

          <?php if( $uri_segment=='order_info' || $uri_segment=='orders' || $uri_segment=='old_orders ' || $uri_segment=='new_orders' || $uri_segment=='order_notes' ) { $active_class='active'; $open_class='in';} else {$active_class=''; $open_class='';}  ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"  data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse4"><img src="<?php echo THEME_URL ?>img/menu_icons/others.png"><span>All Orders</span></a>
            <ul id="collapse4" class="accordion-body collapse <?php echo $open_class; ?>">
              <li><a href="<?php echo base_url() ?>superadmin/orders/0/1">In Queue</a></li>
              <li><a href="<?php echo base_url() ?>superadmin/orders/0/2">In Production</a></li>
              <li><a href="<?php echo base_url() ?>superadmin/orders/0/3">Production Complete</a></li>
              <li><a href="<?php echo base_url() ?>superadmin/orders/0/null">All Orders</a></li>
              <!-- <li><a href="<?php echo base_url()?>superadmin/new_orders">Orders</a><li> -->
              <!-- <li><a href="<?php // echo base_url()?>superadmin/old_orders">Old Order</a><li> -->
            </ul>
        </li>
        
        <?php if( $uri_segment=='coupons' || $uri_segment=='add_coupon' || $uri_segment=='edit_coupon' ) { $active_class='active'; $open_class='in';} else {$active_class=''; $open_class='';}  ?>    
          <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"   data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse5" ><img src="<?php echo THEME_URL ?>img/menu_icons/forms.png"><span>Manage Coupons</span></a> 
            <ul id="collapse5" class="accordion-body collapse <?php echo $open_class; ?>">
              <li><a href="<?php echo base_url().'superadmin/coupons'; ?>">Coupons</a></li>         
               <li><a href="<?php echo base_url().'superadmin/add_coupon'; ?>">Add Coupon</a></li>
            </ul>
          </li>

          <?php if( $uri_segment=='supports' || $uri_segment=='faqs' || $uri_segment=='add_faq' || $uri_segment=='edit_faq' || $uri_segment=='supports_reply'|| $uri_segment=='customer_service' || $uri_segment=='add_customer_services' || $uri_segment=='edit_customer_services' || $uri_segment=='message_center' || $uri_segment=='messages' || $uri_segment=='message_info') { $active_class='active'; $open_class='in';} else {$active_class=''; $open_class='';}  ?>    
              <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"   data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse6" ><img src="<?php echo THEME_URL ?>img/menu_icons/tables.png"><span>Supports</span></a> 
                <ul id="collapse6" class="accordion-body collapse <?php echo $open_class; ?>">
                  <li><a href="<?php echo base_url().'superadmin/supports'; ?>">Supports</a></li>
                  <li><a href="<?php echo base_url().'superadmin/message_center'; ?>">Messages</a></li>
                  <li><a href="<?php echo base_url().'superadmin/messages'; ?>">Send Message</a></li>
                  <li><a href="<?php echo base_url().'superadmin/customer_service'; ?>">Customer Service</a></li>
                  <li><a href="<?php echo base_url().'superadmin/faqs'; ?>">FAQ's</a></li>                      
                  <li><a href="<?php echo base_url().'superadmin/add_faq'; ?>">Add FAQ</a></li>                      
                 </ul>
               </li>
           <?php if( $uri_segment=='pages' || $uri_segment=='add_page' || $uri_segment=='edit_page' || $uri_segment=='slider_settings' || $uri_segment=='add_slider_content' || $uri_segment=='edit_slider_content' || $uri_segment=='page_content' ) { $active_class='active'; $open_class='in';} else {$active_class=''; $open_class='';}  ?>    
              <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed"   data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse7" ><img src="<?php echo THEME_URL ?>img/menu_icons/forms.png"><span>Manage contents</span></a> 
                <ul id="collapse7" class="accordion-body collapse <?php echo $open_class; ?>">
                  <li><a href="<?php echo base_url().'superadmin/pages'; ?>">Pages</a></li>         
                   <li><a href="<?php echo base_url().'superadmin/add_page'; ?>">Add Pages</a></li> 
                   <li><a href="<?php echo base_url().'superadmin/slider_settings'; ?>">Slides</a></li>         
                   <li><a href="<?php echo base_url().'superadmin/add_slider_content'; ?>">Add slides</a></li>
                   <!-- <li><a href="<?php // echo base_url().'superadmin/page_content/tc'; ?>">Terms & Condition</a></li>         
                   <li><a href="<?php //echo base_url().'superadmin/page_content/pp'; ?>">Private Policy</a></li> -->
                   <!-- <li><a href="<?php // echo base_url().'superadmin/form_fields'; ?>">From Fields</a></li> 
                   <li><a href="<?php // echo base_url().'superadmin/form_field_add_new'; ?>">Add Form Fields</a></li> 
                   <li><a href="<?php // echo base_url().'superadmin/forms'; ?>">Forms</a></li> 
                   <li><a href="<?php // echo base_url().'superadmin/form_add_new'; ?>">Add Form</a></li> --> 
                </ul>
               </li>
      </ul>
      <div class="menu_states row-fluid container ">
        <h2 class="pull-left">Menu Settings</h2>
        <div class="options pull-right">
          <button id="menu_state_1" class="color_4" rel="tooltip" data-state ="sidebar_icons" data-placement="top" data-original-title="Icon Menu">1</button>
          <button id="menu_state_2" class="color_4 active" rel="tooltip" data-state ="sidebar_default" data-placement="top" data-original-title="Fixed Menu">2</button>
          <button id="menu_state_3" class="color_4" rel="tooltip" data-placement="top" data-state ="sidebar_hover" data-original-title="Floating on Hover Menu">3</button>
        </div>
      </div>
      <!-- End sidebar_box --> 

    </div>
  </div>
</div>
<div id="main">
  <div class="container">
    
    <div class="header row-fluid">
      <div class="logo"> <img src="<?php echo base_url() ?>assets/theme/img/logo.png " width="25%"><!-- <a href="<?php echo base_url() ?>superadmin"><span>Start</span><span class="icon"></span> --></a> </div>
      <div class="top_right">
        <ul class="nav nav_menu">
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="<?php echo base_url('superadmin') ?>">
            <div class="title"><span class="name">superadmin<?php //$admin_info= $this->session->userdata('admin_info'); echo  $admin_info['fname']." ".$admin_info['lname'];?></span></div>


            <span class="icon"><img src="<?php echo THEME_URL ?>img/user.png"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <!-- <li><a href="<?php //echo base_url().'admin/view_profile/'.; ?>"><i class=" icon-user"></i>View Profile</a></li> -->
              <li><a href="<?php echo base_url().'superadmin/profile/'; ?>"><i class=" icon-user"></i> Update Profile</a></li>
              <li><a href="<?php echo base_url().'superadmin/change_password/'; ?>"><i class=" icon-cog"></i>Update Password</a></li>
              <li><a href="<?php echo base_url()."superadmin/logout"?>"><i class=" icon-unlock"></i>Log Out</a></li>
             <!--  <li><a href="search.html"><i class=" icon-flag"></i>Help</a></li> -->
            </ul>
          </li>
        </ul>
      </div>
      <!-- End top-right --> 
    </div>
<?php  msg_alert() ?>

<?php $uri_segment = $this->uri->segment(2); ?>
<!DOCTYPE html>
<html class="sidebar_default  no-js" lang="en">
<head>
<meta charset="utf-8">
<title>ShirtScore | Customer Service Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- <link rel="shortcut icon" href="<?php //echo THEME_URL ?>css/images/favicon.png"> -->
<!-- Le styles -->
<link href="<?php echo THEME_URL ?>css/twitter/bootstrap.css" rel="stylesheet">
<link href="<?php echo THEME_URL ?>css/base.css" rel="stylesheet">
<link href="<?php echo THEME_URL ?>css/twitter/responsive.css" rel="stylesheet">
<link href="<?php echo THEME_URL ?>css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
<style type="text/css">
   [class^="icon-"], [class*=" icon-"] {
          background-image: none !important;
        }
</style>
<script src="<?php echo THEME_URL ?>js/jquery.js" type="text/javascript"> </script> 
<script src="<?php echo THEME_URL ?>js/plugins/modernizr.custom.32549.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
<!-- share strip on homepage -->
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
        <script type="text/javascript">stLight.options({publisher: "a6d59bb4-0e0a-4b6c-88f1-720509e46891", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
var options={ "publisher": "a6d59bb4-0e0a-4b6c-88f1-720509e46891", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "pinterest", "stumbleupon", "tumblr"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>
</head>

<body>
<div id="loading"><img src="<?php echo THEME_URL ?>img/ajax-loader.gif"></div>
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
        <h2>Customer Service Panel</h2>
      </div>
      <ul id="sidebar_menu" class="navbar nav nav-list container full">
        <?php if( $uri_segment=='' ||  $uri_segment=='index' ) $active_class='active'; else $active_class='';  ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_4"> <a class="dashboard " href="<?php echo base_url() ?>customer_service"><img src="<?php echo THEME_URL ?>img/menu_icons/dashboard.png"><span>Dashboard</span></a> </li>
        <?php /* if($uri_segment==='store_admins' || $uri_segment==='pending_stores'  || $uri_segment==='store_setting'  || $uri_segment==='add_store_admin' || $uri_segment==='stores' || $uri_segment==='edit_store_admin'|| $uri_segment=='approved_stores' ||$uri_segment=='store_detail'  || $uri_segment=='admin_details' || $uri_segment=='emailtostore_admin'  || $uri_segment==='add_Store' || $uri_segment==='edit_store'){ $active_class='active'; }else{ $active_class='';  } ?> 
        <li class="accordion-group <?php echo $active_class; ?> color_7"> <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1"> <img src="<?php echo THEME_URL ?>img/menu_icons/users.png"><span>Manage Stores</span></a>
          <ul id="collapse1" class="accordion-body collapse">
            <li><a href="#">Store Admins</a></li>
            <li><a href="#">Add Store Admin</a></li>           
            <li><a href="#">Approved Stores</a></li>
            <li><a href="#">Pending Stores</a></li>
            <li><a href="#">Add Stores</a></li>  
            <li><a href="#">Store Setting</a></li>  
          </ul>
        </li> */ ?>
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
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <div class="title"><span class="name">Customer Service<?php //$admin_info= $this->session->userdata('admin_info'); echo  $admin_info['fname']." ".$admin_info['lname'];?></span></div>


            <span class="icon"><img src="<?php echo THEME_URL ?>img/user.png"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <!-- <li><a href="<?php //echo base_url().'admin/view_profile/'.; ?>"><i class=" icon-user"></i>View Profile</a></li> -->
              <li><a href="<?php echo base_url().'customer_service/profile/'; ?>"><i class=" icon-user"></i> Update Profile</a></li>
              <li><a href="<?php echo base_url().'customer_service/change_password/'; ?>"><i class=" icon-cog"></i>Update Password</a></li>
              <li><a href="<?php echo base_url()."customer_service/logout"?>"><i class=" icon-unlock"></i>Log Out</a></li>
             <!--  <li><a href="search.html"><i class=" icon-flag"></i>Help</a></li> -->
            </ul>
          </li>
        </ul>
      </div>
      <!-- End top-right --> 
    </div>


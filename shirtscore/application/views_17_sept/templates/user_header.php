<!DOCTYPE html >
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ShirtScore - Like it. Share it. Wear it.</title>
<!-- <link href="assets/css/ss_style.css" rel="stylesheet" type="text/css" />
<link href="assets/css/font.css" rel="stylesheet" type="text/css" />
<link href="assets/css/font_unhinted.css" rel="stylesheet" type="text/css" />
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.css" rel="
stylesheet"> -->
    <link href="<?php echo base_url() ?>assets/front_theme/css/font.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/front_theme/css/font_unhinted.css" rel="stylesheet" type="text/css" />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front_theme/css/custom-style.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap-colorpicker.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front_theme/css/datepicker.css" rel="stylesheet">
    <style type="text/css" media="screen">
        .input-error p{
          color: red;
       }
       .noJS{
          background-color: #8bc53f;
          border: 1px solid #8bc53f;
          /*border-radius: 5px;*/
       }
       .dashbox {
          margin-left: 2% !important;
          width: 94% !important;
      }
       .hero_dash{
          background: none repeat scroll 0 0 #EDF0F5;
          height: auto !important;
          width: auto !important;
       }
       [class^="icon-"], [class*=" icon-"] {
          background-image: none !important;
        }

        #coolMenu,
        #coolMenu ul {
          list-style: none;
          margin-left: 4px;
        }
        #coolMenu {
          float: left;
        }
        #coolMenu > li {
          float: left;
        }
        #coolMenu li a {
          display: block;
          height: 2em;
          line-height: 2em;
          /*padding: 0 1.5em;*/
          font-size: 14px;
          text-decoration: none;
        }
        #coolMenu ul {
          position: absolute;
          display: none;
          z-index: 999;
        }

        ul.noJS li {
            float: none !important;
        }

        #coolMenu li:hover ul.noJS {
          display: block;
          width:12%;
          border-top-left-radius: 0px !important;
          border-top-right-radius: 0px !important;
          border-bottom-right-radius: 5px !important;
          border-bottom-left-radius: 5px !important;
        }

        /*#coolMenu li ul.noJS li:hover a{
          border-top-left-radius: 5px !important;
          border-top-right-radius: 5px !important;
          border-bottom-right-radius: 5px !important;
          border-bottom-left-radius: 5px !important;
        }*/

        .menu{
          width:150px;
        }

        ul.dashnav a, ul.dashnav a:visited{
          padding: 6px;
          /*border-radius: none;*/
          border-top-left-radius: 5px !important;
          border-top-right-radius: 5px !important;
          border-bottom-right-radius: 0px !important;
          border-bottom-left-radius: 0px !important;
        }
        @media (max-width: 480px){
          #coolMenu li:hover ul.noJS {
            display: none;
          }
          #coolMenu li ul.noJS {
            display: none;
            width:80% !important;
            position: relative;
            border: none;
            background: none;
          }
          #coolMenu li a {
            padding: 0.5em;
          }
          ul.dashnav li {
              min-width: 175px !important;
          }
        }
       /* ul.noJS li:hover, ul.nosJS li:focus{
          width:18%;
        }*/
    </style>

    <script src="<?php echo base_url() ?>assets/front_theme/js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          if($(window).width() <= 480)
          {        
            $('.m_menu').on('click',function() {
              var id = $(this).attr('idno');
              $('#'+id).slideToggle("slow");
              // $('#'+id).show(500);
            });
          }
        });
    </script>
    <!-- share strip on homepage -->
    <?php if(!customer_login_in()){?>
                <?php if(!is_storeadmin()){?>
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
        <script type="text/javascript">stLight.options({publisher: "a6d59bb4-0e0a-4b6c-88f1-720509e46891", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    <script>
    var options={ "publisher": "a6d59bb4-0e0a-4b6c-88f1-720509e46891", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "pinterest", "stumbleupon", "tumblr"]}};
    var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
    </script>
  <?php } } ?>
<!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } 
ul.nav a { zoom: 1; }  
</style>
<![endif]-->
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>


<body onload="MM_preloadImages('<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png')">
   <!-- NAVBAR================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
     <div class="container"><!-- /.container1 -->
        <div class="navbar header">
          <div class="navbar"  style=" margin-bottom: 0;">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" style=" position: relative;top: 20px;">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>           
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-
            collapse.collapse. -->
             <a class="brand" href="<?php echo base_url() ?>">
              <img src="<?php echo base_url() ?>assets/front_theme/img/ss_logo.png" alt="ShirtScore" width="275px" height="64px" style="display:inline; float:none;position: relative;top: -10px;" />
            </a>

            <div id="main_menu" class="nav-collapse collapse">
              <ul class="nav" style="top: 0px"> 
                <li><a href="<?php echo base_url()?>">Home</a></li>            
                <li><a href="<?php echo base_url()?>store/design_your_own">Design A Shirt</a></li>
                <!-- <li><a href="<?php //echo base_url() ?>store/open_store">Sell Your Designs</a></li> -->
               <!--  <li><a href="<?php //echo base_url('store/designs');?>">Choose Design</a></li>-->
              
                <!-- <li><a href="<?php //echo base_url();?>store/available_products">Products</a></li> -->
               <li> 
                   <?php if(customer_login_in()){?>
                      <a href="<?php echo base_url() ?>store/open_store">Open A Store</a>
                   <?php }else{ ?>
                      <a href="<?php echo base_url() ?>store/signup">Sign Up Here</a>
                   <?php } ?>
                </li> 

                <li><a href="<?php echo base_url() ?>user/faq">How It Works</a></li>

                <?php if(customer_login_in()){?>
                <?php if(!is_storeadmin()){?>
                 <li><a href="<?php echo base_url() ?>user/need_help">Help?</a></li>  
                 <?php } else {?>
                <li><a href="<?php echo base_url() ?>storeadmin/need_help">Help?</a></li>      
                <?php } } else { ?>
                <li><a href="<?php echo base_url() ?>store/need_help">Help?</a></li>
                <?php }?>
                <li>
                  <div class="fb-logo">
                    <a style="padding-top:6px;" target="_blank" id="fcbook" href="http://facebook.com"><img src="<?php echo base_url().'assets/front_theme/img/fb.png'?>"></a>
                  </div>
                </li>
              </ul>

            </div><!--/.nav-collapse -->

          </div><!-- /.navbar-inner -->

        </div><!-- /.navbar -->

            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->

           <div class="hero_dash">

            <div class="cart"><a href="<?php echo base_url() ?>user/logout"><i class="icon-signout"></i> Logout</a></div>

           
            <?php $customer_info = customer_info(); ?>
            <div class="dashdetails">&nbsp;<br /><h2>Your Account Dashboard</h2>
            Member E-mail: <?php echo $customer_info['email']; ?><br />
            Account Created: <?php echo $customer_info['created']; ?><br /><br />
            <!-- Account ID: <?php // echo $customer_info['id']; ?><br /> -->
            </div>
          </div>
          
          <div style="margin-bottom:4%; margin-left:1%;">
              <ul id="coolMenu" class="dashnav">
                <li><a class="menu" href="<?php echo base_url()?>user/dashboard"><i class="icon-dashboard"></i> My Dashboard</a></li>
               
               <li><a href="javascript:void(0);" idno="div_2" class="m_menu menu"><i class="icon-picture"></i> Manage Designs </a>
                  <ul id="div_2" class="noJS">
                    <li><a href="<?php echo base_url() ?>user/dashboard_designs"> Designs </a></li>
                    <li><a href="<?php echo base_url() ?>user/add_design"> Add Design </a></li>
                  </ul>
                </li>

                 <li><a class="menu" href="<?php echo base_url() ?>user/sales_report"><i class="icon-bar-chart"></i> Sales Reports </a></li>

               <li><a class="menu" href="<?php echo base_url()?>store/open_store"><i class="icon-home"></i> Open A Store</a></li>

                

                <li><a href="javascript:void(0);" idno="div_4" class="m_menu menu"><i class="icon-user"></i> My Account </a>
                  <ul id="div_4" class="noJS">
                    <li><a href="<?php echo base_url() ?>user/user_profile"> My Profile </a></li>
                    <li><a href="<?php echo base_url() ?>user/user_payee_profile">  Account Info </a></li>
                    <li><a class="menu" href="<?php echo base_url() ?>user/orders"> My Purchase</a></li>
                  </ul>
                </li>

                <li><a href="javascript:void(0);" idno="div_3" class="m_menu menu"><i class="icon-question-sign"></i> Supports </a>
                  <ul id="div_3" class="noJS">
                  <li><a href="<?php echo base_url() ?>user/need_help"> Need help </a></li>
                    <li><a href="<?php echo base_url() ?>user/supports"> My Queries </a></li>
                    <li><a href="<?php echo base_url() ?>user/messages"> Messages </a></li>
                  </ul>
                </li>

              </ul>

            </div>

          <div class="clearfloat"></div>     

            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-

            collapse.collapse. -->
            <!-- fcbook -->
            <style type="text/css">
              ul.nav li a:focus#fcbook ,ul.nav li a:hover#fcbook {
                background: none !important;
              }
              @media (max-width: 360px){
                ul.nav li a:hover#fcbook img{
                  max-width: 80% !important;
                }
              }
            </style>
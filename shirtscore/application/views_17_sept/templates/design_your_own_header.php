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

       .hero_dash{

          background: none repeat scroll 0 0 #EDF0F5;

          height: auto !important;

          width: auto !important;

       }

       [class^="icon-"], [class*=" icon-"] {

          background-image: none !important;

        }

    </style>



    <script src="<?php echo base_url() ?>assets/front_theme/js/jquery.js"></script>
    <!-- share strip on homepage -->
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
        <script type="text/javascript">stLight.options({publisher: "a6d59bb4-0e0a-4b6c-88f1-720509e46891", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
var options={ "publisher": "a6d59bb4-0e0a-4b6c-88f1-720509e46891", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "pinterest", "stumbleupon", "tumblr"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>

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



   <!-- NAVBAR

    ================================================== -->

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

             <a class="brand" href="<?php echo base_url()?>">

              <img src="<?php echo base_url() ?>assets/front_theme/img/ss_logo.png" alt="ShirtScore" width="275px" height="64px" style="display:inline; float:none;position: relative;top: -10px;" />

             </a>

             <div class="cart"><a style="margin-top:25px;" href="<?php echo base_url() ?>storeadmin/logout"><i class="icon-signout"></i> Logout</a></div>

             <?php if(storeadmin_login_in()){

                  $store = get_store_info(storeadmin_id());

             ?>

                   <!--  <div class="home" style="margin-top:25px;">

                      <a target="_blank" href="<?php //echo base_url()."shop/".$store->store_link; ?>"><i class="icon-home"></i> See Store</a>

                    </div> -->
                   <!--  <div class="home" style="margin-top:25px;">
                      <a target="_blank" href="<?php //echo base_url()?>"><i class="icon-home"></i> Main Site</a>
                    </div> -->

            <?php } ?>

            <!-- <span style="text-align:center">Welcome</span> -->

            <div id="main_menu" class="nav-collapse collapse">

              

              <ul class="nav" style="top: 0px; float: right;  margin-right: 5%;">               

                <!-- <li><a href="#">Design A Shirt</a></li>

                <li><a href="#">Sell Your Designs</a></li> -->

                <li><a href="<?php echo base_url() ?>storeadmin/admin_profile">My Profile</a></li>

                <!-- <li><a href="<?php //echo base_url() ?>storeadmin/change_password">Update Password</a></li> -->

                <!-- <li><a href="#">Help?</a></li>             -->

          

              </ul>

            </div><!-- /.nav-collapse -->

          </div><!-- /.navbar-inner -->

        </div><!-- /.navbar -->

            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->

            <!-- <div class="hero_dash">

            <?php //$customer_info = customer_info(); ?>

            <div class="dashdetails">&nbsp;<br /><h2>Your Account Dashboard</h2>

            Member E-mail: <?php //echo $customer_info['email']; ?><br />

            Account Created: <?php //echo $customer_info['created']; ?><br />

            Account ID: <?php //echo $customer_info['id']; ?><br />

            <br />-->

            </div>



          </div> 

         <div class="container">

          <div class="clearfloat"></div>

          <div class="prodcontent"></div>

          <!-- <hr color="3b5998" /> -->

  <div class="row-fluid">

    <div class="span12">

    
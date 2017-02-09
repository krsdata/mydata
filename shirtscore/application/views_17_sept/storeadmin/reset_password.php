<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
 <style type="text/css">

      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 50px 450px;
        background-color: #FFFFFF;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
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
             <a class="brand" href="#">
              <img src="<?php echo base_url() ?>assets/front_theme/img/ss_logo.png" alt="ShirtScore" width="275px" height="64px" style="display:inline; float:none;position: relative;top: -10px;" />
            </a>


            <div id="main_menu" class="nav-collapse collapse">
              <ul class="nav" style="top: 0px">               
                <li><a href="#">Design A Shirt</a></li>
                <li><a href="#">Sell Your Designs</a></li>
                <li><a href="<?php echo base_url() ?>store/signup">Open A Store</a></li>
                <li><a href="<?php echo base_url() ?>user/faq">How It Works</a></li>
                <li><a href="#">Help?</a></li>            
          
              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
<div style="width:900px; min-height:100px; margin:50px 100px; padding:10px 20px; background-color:#FFFFFF; ">
    <h2>You can reset your password here</h2>       
        <?php echo form_open(current_url()); ?>
        <div class="login_details">
 <?php if($this->session->flashdata('email')): ?>
      <div class="confirm-alert" style="text-align:center"><?php echo $this->session->flashdata('email'); ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
    <div class="error-alert" style="text-align:center"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>
         Password<span style="color:red" ><?php echo form_error('password') ?> </span><br />
          <input class="span5" type="password" name="password"><br />
             
         Confirm Password<span style="color:red" ><?php echo form_error('c_password') ?> </span><br />
          <input class="span5" type="password" name="c_password" ><br />
                <input type="submit" name="submit" value="Submit">
                 </div>
<?php echo form_close()?>






</div>
  </div>







<div class="footer">
        <a href="index.html">Home</a> &bull;
      <a href="faq.html">FAQ</a> &bull;
      <a href="support.html">Support</a><br />
      Copyright &copy; 2013 <a href="index.html">ShirtScore.com</a> &bull;
      All rights reserved<br />
    <!-- end .footer --></div>
</div>
</body>
<script src="<?php echo base_url() ?>assets/front_theme/js/jquery.js"></script>
   
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-transition.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-alert.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-modal.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-dropdown.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-tab.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-tooltip.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-popover.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-button.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-collapse.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-carousel.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-typeahead.js"></script>
</html>

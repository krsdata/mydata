<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ShirtScore - Like it. Share it. Wear it.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url() ?>assets/front_theme/css/font.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/front_theme/css/font_unhinted.css" rel="stylesheet" type="text/css" />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front_theme/css/custom-style.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo THEME_URL ?>css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
    <style type="text/css" media="screen">
       [class^="icon-"], [class*=" icon-"] {
          background-image: none !important;
        }
        .its-colored{
         /* border: 3px inset white;*/
        } 
        .current{
          color: #8BC53F;
        }
        .active-category{
          float: left;
          padding:0 5px 0 35px;
          font-family:Novecentowide-Normal;
          list-style: none;
          border-radius: 15px;
          background:url("<?php echo base_url() ?>assets/front_theme/img/nav_dot.png") left no-repeat #fff;
        }

         .input-error p{
          color: red;
       }
    </style>
  
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]--> 
    <script>
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

    <script src="<?php echo base_url() ?>assets/front_theme/js/jquery.js"></script>
    <script src="<?php echo THEME_URL ?>js/jquery-ui.js"></script>
  </head>
  
  <body onload="MM_preloadImages('<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png')">
  
  <?php if ($this->uri->segment(2)!='design_your_own'): ?>  
 
   <!-- Fb Like Button -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=578966452159790";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 
  <!-- Fb share Button -->
 
<?php endif ?>
    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container whole-page"><!-- /.container1 -->
        <div class="navbar header">
          <div class="navbar"  style=" margin-bottom: 0;">
             <a id="header_logo" class="brand" href="<?php echo base_url() ?>store">
                <img src="<?php echo base_url() ?>assets/front_theme/img/ss_logo.png" alt="ShirtScore" style="display:inline; float:none; position: relative; top: 5px; left: 15px;" />
             </a>
            <div id="main_menu" class="nav-collapse collapse" style="float: right; margin-left: 2%;">
              <ul class="nav" style="top: 0px;">
              </ul>
            </div><!--/.nav-collapse -->
            
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
         
          <div class="row" style="/*margin-left:10%;*/">
          </div>
      </div> <!-- /.container1 -->
    </div><!-- /.navbar-wrapper -->

    <style type="text/css">
      ul.nav li a:focus#fcbook ,ul.nav li a:hover#fcbook {
        background: none !important;
      } 
      ul.nav li .fb-logo a#fcbook {
        padding: 10px 9px 0 !important;
      }
      .cart-detail{
        padding-left: 2% !important;
      }
      .header-links{
        padding-left: 40% !important;
      }
      .home a{
        margin: 0 !important;
      }
      .fb-logo {
         float: right;
         margin: 0 !important;
      }
      
      #main_menu ul.nav a, ul.nav a:visited{
          padding: 30px 9px 0 !important;
      }

      #header_logo{
          width:18%;  padding: 0px ! important;
      }

      @media (max-width: 480px){
        .fb-logo {
          margin: 0 !important;
        }
        ul.nav li .fb-logo a#fcbook {
          padding: 10px 9px 0 !important;
        }
        /*.nav {
          top: 40px !important;
        }
        #main_menu {
          height: auto !important;
        }*/
        #header_logo{
          width:77% !important;
          padding-bottom: 22px ! important; 
        } 

        #header_side_button{
          margin-left: 35% !important;
        }
        #header_side_button {
          float: left;
          margin-left: 4%;
          margin-top: 0;
        }
      }
    </style>
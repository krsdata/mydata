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
       .inputfieldforquantity{
        margin: 0px 5px 0px 5px;
        width: 48px;
        border-radius: 0px!important;
        height: 16px!important;
        line-height: 17px!important;
        text-align: center;
        }
        .quantityname{
        font-size: 14px;
        text-align: center;
        text-transform: uppercase;
        color: rgb(107, 89, 33);
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
     <?php if(!customer_login_in()){?>
                      <?php if(!is_storeadmin()){?>
    <!-- share strip on homepage -->
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
        <script type="text/javascript">stLight.options({publisher: "a6d59bb4-0e0a-4b6c-88f1-720509e46891", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    <script>
    var options={ "publisher": "a6d59bb4-0e0a-4b6c-88f1-720509e46891", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "pinterest", "stumbleupon", "tumblr"]}};
    var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
    </script>
  <?php } } ?>

<?php if ($this->uri->segment(1)=='wear_it'): ?>
    
  <!--<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="<?php //echo base_url() ?>assets/front_theme/js/jquery.tinycarousel.js"></script>

  <script type="text/javascript">
    $(document).ready(function()
    {
      $('#slider1').tinycarousel();
    });
  </script>-->
  <link href="<?php echo base_url() ?>assets/front_theme/bxslider/jquery.bxslider.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo base_url() ?>assets/front_theme/bxslider/jquery.bxslider.min.js"></script>
  
<script type="text/Javascript">
$(document).ready(function(){
  $('.bxslider').bxSlider({
    minSlides: 4,
    maxSlides: 4,
    // slideMargin: 10,
    slideWidth: 140,
    hideControlOnEnd: true,
    moveSlides: 4,
    pager: false,
  
       
  });
  
});
</script>
  <?php else: ?>
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/front_theme/css/tinycarousel.css" type="text/css" media="screen"/>
  <?php endif; ?>

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

<link href="<?php echo base_url() ?>assets/front_theme/bxslider/jquery.bxslider.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo base_url() ?>assets/front_theme/bxslider/jquery.bxslider.min.js"></script>
  
<script type="text/Javascript">
$(document).ready(function(){
  $('.bxslider').bxSlider({
  auto:false,
    minSlides: 4,
    maxSlides: 4,
    slideWidth: 190,
    moveSlides: 1,
  });
  
});
</script>
    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container whole-page"><!-- /.container1 -->
        <div class="navbar header">
          <div class="navbar"  style=" margin-bottom: 0;">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" style=" position: relative;top: 20px;right: 20px;">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-
            collapse.collapse. -->
             <a id="header_logo" class="brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/front_theme/img/ss_logo.png" alt="ShirtScore" style="display:inline; float:none; position: relative; top: 5px; left: 15px;" />
             </a>
             <?php 
                  if ($this->session->userdata('my_store')) {
                    $store = $this->session->userdata('my_store');
                    $link = $store->store_link;
                    $home_url = 'shop/'.$link;
                  }else
                    $home_url = 'store';
             ?>
          
            <div id="main_menu" class="nav-collapse collapse" style="float: right; margin-left: 2%;">
              <ul class="nav" style="top: 0px;">   
               <li><a href="<?php echo base_url()?>">Home</a></li>             
                <li><a href="<?php echo base_url()?>store/design_your_own">Design A Shirt</a></li>
                <?php 
                    if ($this->session->userdata('my_store')) {
                ?>
                      <!--  <li>
                          <a href="<?php // echo base_url() ?>store/my_products">Store Products</a>
                       </li> -->
                <?php
                    }
                 ?>
                <?php if(customer_login_in()){?>
                      <?php if(!is_storeadmin()){?>
                      
                      <?php } ?>
                   <?php }else{ ?>
                    <li>
                      <a href="<?php echo base_url() ?>store/signup">Sell Your Designs</a>
                    </li>
                   <?php } ?>
<!--<li><a href="<?php //echo base_url('store/designs');?>">Choose Design</a></li> -->
                      <li>
                        <a href="<?php echo base_url() ?>store/signup">Open A Store</a>
                      </li>
               <!--  <li><a href="<?php //echo base_url();?>store/available_products">Products</a></li> -->
                 <!--   <?php if(customer_login_in()){?>
                      <?php if(!is_storeadmin()){?>
                      <li>
                        <a href="<?php echo base_url() ?>store/open_store">Open A Store</a>
                      </li>
                      <?php } ?>
                   <?php }else{ ?>
                    <li>
                      <a href="<?php echo base_url() ?>store/signup">Sign Up Here</a>
                    </li>
                   <?php } ?> -->
                
                <li><a href="<?php echo base_url() ?>store/faq">How It Works</a></li>
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
                    <a href="https://www.facebook.com/shirtscore" title="facebook"  target="_blank" >
                      <img src="<?php echo base_url().'assets/front_theme/img/fb.png'?>">
                    </a>
                  </div>
                  <div class="fb-logo">
                    <a href="https://plus.google.com/u/0/b/100414791359307516073/100414791359307516073/about" title="Google Plus" target="_blank" >
                      <img src="<?php echo base_url().'assets/front_theme/img/gplus.png'?>">
                    </a>
                  </div>
                  <div class="fb-logo">
                    <a href="http://www.pinterest.com/shirtscore/" title="Pinterest"  target="_blank" >
                      <img src="<?php echo base_url().'assets/front_theme/img/pin.png'?>">
                    </a>
                  </div>
                   <div class="fb-logo">
                    <a href="https://twitter.com/ShirtScore" title="twitter"  target="_blank" >
                      <img src="<?php echo base_url().'assets/front_theme/img/tweet.png'?>">
                    </a>
                  </div>
                </li>
                <?php /* if(customer_login_in() && !is_storeadmin()){?>
                <li><a href="<?php echo base_url() ?>user/user_profile">Manage Profile</a></li>
                <?php } */ ?>
              </ul>
            </div><!--/.nav-collapse -->
            
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
         
          <div class="row" style="/*margin-left:10%;*/">
            <div class="span6">
                <?php if(is_storeadmin()){?>
                    
                     <div class="home" id="header_side_button" style="float:left;margin-left:4%;">
                        <a href="<?php echo base_url() ?>storeadmin/logout"><i class="icon-signout"></i> Logout</a>
                      </div>
                      <div class="home" id="header_side_button" style="float:left;margin-left:4%;">
                        <a href="<?php echo base_url()."storeadmin"; ?>"><i class="icon-user"></i>My Dashboard </a>
                      </div>

                <?php }elseif(!customer_login_in()){?>
                      <div class="home" id="header_side_button" style="float:left;margin-left:4%;">
                        <a href="<?php echo base_url()."store/login"; ?>">Login</a>
                      </div>

                 <?php }else{?>
                      <div class="home" id="header_side_button" style="float:left;margin-left:4%;">
                        <a href="<?php echo base_url() ?>store/logout"><i class="icon-signout"></i> Logout</a>
                      </div>
                      <div class="home" id="header_side_button" style="float:left;margin-left:4%;">
                        <a href="<?php echo base_url()."user"; ?>"><i class="icon-user"></i>  My Dashboard </a>
                      </div>
                 <?php } ?>

                  <?php if($this->uri->segment(1)!='shop')if($this->session->userdata('my_store')){
                        $my_store = $this->session->userdata('my_store');
                        $data['store_info'] = $my_store;
                        ?>
                        <div class="home" style="float:none;margin-left:4%;">
                        <br><br>
                        <a href="<?php echo base_url().'shop/'.$my_store->store_link;?>"> <i class="icon-arrow-left"></i>
                        Back to <?php echo $my_store->store_name?> </a>
                        </div>
                        <?php }?>

            </div>

            <div class="span2" style="margin-bottom: 10px; float:right;">
                <?php
                  $a_start = '';
                  $a_end = '';
                  if ($this->cart->total_items() > 0) {
                    $a_start = '<a href="'.base_url().'store/cart">';
                    $a_end = '</a>';
                  }
                ?>
                <?php echo $a_start; ?> <div style="color:#3B5998;"><?php echo $this->cart->total_items(); ?> items in your cart.</div> <?php echo $a_end; ?>
                <div style="color:#3B5998;">TOTAL: <strong style="color:#8BC53F"><?php echo money_symbol();?><?php echo number_format($this->cart->total(),2); ?></strong>
                  <i class="icon-shopping-cart"></i>
                </div>
                <?php if ($this->cart->total_items() > 0) { ?>
                  <div style="color:#3B5998"> <a href="<?php echo base_url() ?>store/empty_cart" title="">Remove All <i class="icon-remove"></i></a></div>
               <?php } ?>
            </div>
     
        </div>
      </div> <!-- /.container1 -->
    </div><!-- /.navbar-wrapper -->

    <style type="text/css">
      ul.nav li a:focus#fcbook ,ul.nav li a:hover#fcbook {
        background: none !important;
      } 
      ul.nav li .fb-logo a#fcbook {
        padding: 5px 5px 0 !important;
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
         float: left;
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

    <script>
   
  // This is called with the results from from FB.getLoginStatus().
  // function statusChangeCallback(response) {
 
  //   // The response object is returned with a status field that lets the
  //   // app know the current login status of the person.
  //   // Full docs on the response object can be found in the documentation
  //   // for FB.getLoginStatus().
  //   if (response.status === 'connected') {
  //     // Logged into your app and Facebook.
      
  //     testAPI();
  //   } else if (response.status === 'not_authorized') {
  //     // The person is logged into Facebook, but not your app.
  //     document.getElementById('status').innerHTML = 'Please log ' +
  //       'into this app.';
  //   } else {
  //     // The person is not logged into Facebook, so we're not sure if
  //     // they are logged into this app or not.
  //     document.getElementById('status').innerHTML = 'Please log ' +
  //       'into Facebook.';
  //   }
  // }

  // // This function is called when someone finishes with the Login
  // // Button.  See the onlogin handler attached to it in the sample
  // // code below.
  // function checkLoginState() {
  //   FB.getLoginStatus(function(response) {
  //     statusChangeCallback(response);
  //   });
  // }

  // window.fbAsyncInit = function() {
  // FB.init({
  //   appId      : '<?php echo FB_APP_ID; ?>',//'708124962573515',
  //   cookie     : true,  // enable cookies to allow the server to access 
  //                       // the session
  //   xfbml      : true,  // parse social plugins on this page
  //   version    : 'v2.0' // use version 2.0
  // });

 

  // FB.getLoginStatus(function(response) {
  //   statusChangeCallback(response);
  // });

  // };

  // // Load the SDK asynchronously
  // (function(d, s, id) {
  //   var js, fjs = d.getElementsByTagName(s)[0];
  //   if (d.getElementById(id)) return;
  //   js = d.createElement(s); js.id = id;
  //   js.src = "//connect.facebook.net/en_US/sdk.js";
  //   fjs.parentNode.insertBefore(js, fjs);
  // }(document, 'script', 'facebook-jssdk'));

  // // Here we run a very simple test of the Graph API after login is
  // // successful.  See statusChangeCallback() for when this call is made.
  // function testAPI() {
  //   console.log('Welcome!  Fetching your information.... ');
  //   FB.api('/me', function(response) {
  //     console.log(response);
  //     // alert(response.first_name);
  //     //  alert(response.last_name);
  //     //   alert(response.email);

  //      document.getElementById('firstname').value =response.first_name;
  //      document.getElementById('lastname').value =response.last_name;
     
  //      document.getElementById('email').value =response.email;
  //     // document.getElementById('status').innerHTML ='';
     
  //   });
  // }
</script>
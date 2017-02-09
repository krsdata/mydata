<script>
  $(function(){
    $('#facebook-signup').on('click', function(){
      $(".fb_iframe_widget").trigger( "click" );
    });
  });
</script>
<div class="container">
       <div class="row" style="/* margin-left: 10% */">
          <div id="home_btn" class="span2 home" style="margin-left: 50px;"><!--<a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a>--></div>
          <div id="dude_text" class="span7 flavor_text">Turn your designs into cash!</div>
          <?php /* <div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div> */ ?>
        </div>
        <div class="clearfloat"></div>
         <!--  <div style="padding: 10px 0;">
          <center class="steps"><img src="<?php echo base_url() ?>assets/images/step1.png?>" alt=""></center>
              <hr color="#CCCCCC"/> 
          </div> -->
          <div class="dashcontent">
            <div class="dashbox">
               <?php if($this->session->flashdata('error_msg')){ ?>
                  <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
                  </div>
               <?php } ?>
              <div class="home" style="float:right !important; margin-top:0px !important; display:none;"><a href="<?php echo base_url().'store/login' ?>"><i class="icon-user"></i>Login</a></div>
              <div><img src="<?php echo base_url() ?>assets/front_theme/img/sell-design.png"/></div>
             <!--  <div><h2 align="center">Sign up with your Facebook account<br />so you can share your design!</h2></div> -->
              <div align="center">
               <!--  <div class="fb-login-button">
                 Login with FACEBOOK
                </div> -->
         <span style="display:none"><fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button></span>
         <a href="javascript:void(0)"><img src="<?php echo base_url() ?>assets/front_theme/img/facebook_connect.jpg" height="30px" id="facebook-signup"/></a>
               <!-- <a href="<?php //echo base_url()?>store/login_with_facebook"><img src="<?php //echo base_url() ?>assets/front_theme/img/facebook_connect.jpg" height="30px"/></a> -->
                <!-- <a href="javascript:void(0)"   title=""><img src="<?php // echo base_url() ?>assets/front_theme/img/fb_login_icon.gif"></a> -->
                or
                <a id="continue_man_btn" href="<?php echo base_url() ?>store/signup_form" class="btn" title="">Continue Manually...</a> <!-- <input type="button" value="Continue Manually..." /> -->
              </div>
            </div>
          </div>
          <div>
            <br /><br /><h4 align="center">Your design could be featured right here.</i></h4><br />
            <span class="blue_arrow"><h4><span style="margin-left:30%"><i class="icon-arrow-down1"></i></span><span style="margin-left:18%"><i class="icon-arrow-down1"></i></span><span style="margin-left:18%"><i class="icon-arrow-down1"></i></span></h4></span>

        <div style="margin-left:9%">
              <?php if($latest_design): $i = 1; foreach ($latest_design as $row): ?>
                  <div class="designlft">
                <div class="designbox">
                      <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>">
                    <!-- <img src="<?php // echo base_url() ?>assets/uploads/designs/<?php // echo $row->design_image ?>"  /> -->
                    <img title="<?php echo $row->design_title; ?>" id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug; ?>" dname="<?php echo $row->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" />
                  </a>
                </div>
                <div class="likesharewear">
                    <?php ?>
                    <div style="float:left; width:35%;margin-top: -10px;">
                        <?php get_facebook_likes(base_url().'wear_it/'.$row->id,$row->slug); //update facebook like count of design per ?>
                        <div class="fb-like" data-href="<?php echo base_url() ?>store/fblike/<?php echo $row->id; ?>" data-width="450" data-layout="button_count"></div>
                    </div> 
                    <div class="shareit">
                      <a onclick="fbshare(<?php echo $row->id; ?>);" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                    </div>
                    <!-- <div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php // echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div> -->
                    <div class="wearit "> <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" style="margin-top:-25px" alt="Wear it!" name="WearIt1" width="80" height="37" border="0" id="WearIt1" /></a></div>
                </div>
              </div>
              <?php $i++; endforeach; endif; ?>
              <!-- <div class="designlftFoot">
                  <div class="designboxFoot"></div>
                  <div class="likesharewear">
                    <div style="display:none;" class="fb_likebtn"><img src="<?php // echo base_url() ?>assets/front_theme/img/fb_like.png" /></div>
                    <div class="wearit"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php // echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php // echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" border="0" id="WearIt1" /></a></div>
                  </div>
              </div>
              <div class="designlftFoot">
                <div class="designboxFoot"></div>
                  <div class="likesharewear">
                    <div  style="float:left; padding-right:85px; display:none;">
                      <img src="<?php // echo base_url() ?>assets/front_theme/img/fb_like.png" />
                    </div>
                    <div class="wearit">
                      <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt2','','<?php // echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php // echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt2" border="0" id="WearIt2" /></a>
                    </div>
                </div>
              </div> -->
    </div>
</div>

<style type="text/css">
  
.wearit {
    float: right;
    margin-top: 10px;
    width: 55px;
}
  div.fb-login-button.fb_iframe_widget span{
    vertical-align: top !important;
  }
    .steps{
   padding: 15px;
  border-top: 1px dashed rgb(49, 141, 68);
  border-bottom: 1px dashed rgb(49, 141, 68);
  }
</style>
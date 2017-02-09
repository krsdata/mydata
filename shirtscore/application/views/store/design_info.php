
<div class="container">
      <!-- <div class="hero_single"><div class="home"><a href="index.html"><i class="icon-home"></i> Home</a></div><div class="cart"><a href="cart.html"><i class="icon-shopping-cart"></i> Cart</a></div>
      </div> -->
      <div class="clearfloat"></div>
      <div class="prodcontent">
      </div>
      <hr color="3b5998" />
      <div class="dashcontent">
          <div class="dashbox row-fluid">
              <div class="row-fluid span12">
                    <div class="design_title span12 " align="left" style="margin-left:3%;"> Title: <?php if($design->design_title !=""){ echo $design->design_title; } ?></div>
                    <div class="design_author span12" align="left"> By : <?php if(!empty($design->artist)){echo $design->artist;} ?></div>
                    <div class="span12 row-fluid">
                        <!---->
                        <div class="span4">
                            <div class="description span10">
                              <p>"<?php if(!empty($design->desc)){echo $design->desc;}else{echo "This is an awesome design...";} ?>" </p>
                            </div>
                        </div>
                        <div class="span8 row-fluid">
                            <div class="likesharewear span12 row-fluid">
                                <div class="like span4" style="float:left;">
                                    <?php get_facebook_likes(base_url().'store/create_my_design/'.$design->id,$design->id); //update facebook like count of design per ?>
                                    <div class="fb-like" data-href="<?php echo base_url() ?>store/create_my_design/<?php echo $design->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
                                </div>
                                <?php $i=123; ?>
                                <div class="shareit span4">
                                    <a class="shareit-at-signup" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                                    <!-- <a title="share on facebook" href="javascript:fbshare(<?php // echo $design->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>  -->
                                  </div>
                                <div class="wearit span4"> <a href="<?php echo base_url().'store/design_your_own/'.$design->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="60" height="37" border="0" id="WearIt1" /></a></div>
                            </div>
                            <div class="span12">
                                <a href="<?php echo base_url().'store/design_your_own/'.$design->slug; ?>">
                                  <img id="facebook_share<?php echo $i; ?>" slug="<?php echo $design->slug; ?>" dname="<?php echo $design->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $design->design_image; ?>" />
                                  <!-- <img src="<?php //echo base_url() ?>assets/uploads/designs/<?php // echo $design->design_image ?>"  /> -->
                                </a>
                            </div>
                        </div>
                        <!---->
                    </div>
                </div>
                <br><br>
          </div>
      </div>
      <div class="clearfloat"></div>

      <style type="text/css">
         .row-fluid [class*="span"]{
          margin-left: 0 !important;
        }

        .designlft {
          margin-left: 0;
          margin-top: 0;
          /*width: 270px;*/
        }

        .likeit, .wearit , .shareit{
          text-align: center !important;
        }

       .wearit {
              float: right !important;
              /*margin-top: 5px !important;*/
              /*width: 50px !important;*/
        }

        .description p{
              font-size: 15px !important;
        }

        .shareit {
            float: left !important;
            font-size: 14px !important;
            /*margin-top: 3% !important;*/
            /*padding: 2% 0 0 0% !important;*/
        }

         @media (max-width: 320px){
            .likesharewear{
              margin-left: 0;
              padding: 2%;
              width: 96%;
            }

            .wearit{
              float: right !important;
              margin-top: 5px !important;
              /*width: 50px !important;*/
              /*margin-left: 0;*/
            }

            .row-fluid{
              text-align: center;
            }
            .designlft{
              width: 110% !important;
            }
        }

      </style>

      <script type="text/javascript">
        function fbshare(id){   
            window.open ("http://www.facebook.com/share.php?u=<?php echo current_url() ?>","Facebook_Share","menubar=1,resizable=1,width=900,height=500"); 
        }
      </script>
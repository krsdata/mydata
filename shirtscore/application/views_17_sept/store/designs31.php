
    <div class="container">
          <?php if($cat != "-" && !empty($cat)): ?>
                <div class="row-fluid custom-head hero_cat">
                    <div class="span12 banner-box">
                        <?php if(isset($cat_info->category_banner)): ?>
                          <img style="width:100%;" src="<?php echo base_url() ?>assets/uploads/category/<?php echo $cat_info->category_banner; ?>" alt="">
                        <?php else: ?>

                        <?php endif ?>
                    </div><!-- span6 -->
                </div><!-- row-fluid -->
          <?php else: ?>
            <?php $this->load->view('store/slider'); ?>
          <?php endif ?>
          <?php $this->load->view('store/sub_nav_bar'); ?>  

    <div class="row">
      <div class="span3">
          <div class="row">
            <div class="span12">
                <div class="sidebar_home_button" style="position: relative;left:10px;"> <img  width="190" src="<?php echo base_url() ?>assets/front_theme/img/swag.png" /> </div>
            </div><!-- span12 -->       
          </div><!-- row -->

         <div class="row">
          <div class="span12">
             <ul class="sidebar1">
                <?php if(isset($cat)): ?>
                    <li><a <?php if($cat == '-'){echo 'class="active-category"';}?> href="<?php echo base_url().home_url(); ?>">All</a></li>
                    <?php foreach ($design_category as $category): ?>                
                      <li><a <?php if($cat == $category->slug){echo 'class="active-category"';}?> href="<?php echo base_url() ?>store/designs/<?php echo $sort.'/'.$category->slug.'/'.$keyword; ?>"><?php echo $category->category_name; ?></a></li>
                    <?php endforeach ?>
                <?php endif ?>
             </ul> 
          </div><!-- span12 -->
        </div><!-- row -->

      </div><!-- span3 -->
      <div class="span9" style="margin-left:5px;">
          <div class="row">     
          <?php if($designs){ $i=0; foreach ($designs as $row){ ?>
             <div class="designlft">
                <div class="designbox">
                  <a href="<?php echo base_url().'store/design_info/'.$row->slug; ?>">
                    <!-- <img src="<?php // echo base_url() ?>assets/uploads/designs/<?php // echo $row->design_image ?>"  /> -->
                    <img title="<?php echo $row->design_title; ?>" id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug; ?>" dname="<?php echo $row->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" />
                  </a>
                </div>
                <div class="likesharewear">
                    <?php ?>
                    <div style="float:left; width:32%;">
                        <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
                        <div class="fb-like" data-href="<?php echo base_url() ?>store/create_my_design/<?php echo $row->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
                    </div> <?php ?>
                    <div class="shareit">
                      <a class="shareit-at-signup" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                    </div>
                    <!-- <div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php // echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div> -->
                    <div class="wearit"> <a href="<?php echo base_url().'store/design_your_own/'.$row->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="80" height="37" border="0" id="WearIt1" /></a></div>
                </div>
              </div>
          <?php $i++; } }else{ ?>   
              <div class="span9" style="text-align:center;">
                  No Designs Found
              </div>
          <?php } ?>
          </div><!--row-fluid -->

      </div><!-- span9 offset1 -->
    </div><!-- row-fluid -->
    <?php if(isset($pagination)): ?>
      <div class="boxtopper">
         <?php echo $pagination; ?>      
      </div>
    <?php endif; ?>

    <script type="text/javascript">
      function fbshare(id){   
          window.open ("http://www.facebook.com/share.php?u=<?php echo current_url() ?>","Facebook_Share","menubar=1,resizable=1,width=900,height=500"); 
      }
    </script>

    <style type="text/css">
      .wearit {
          float: right !important;
          margin-top: 2px !important;
          width: 50px !important;
      }

      .shareit {
          float: left !important;
          font-size: 14px !important;
          margin-top: 3% !important;
          padding: 2% 0 0 7% !important;
      }

      .hero_cat {
          background: url("<?php  echo base_url() ?>assets/front_theme/img/cat_bg.jpg") no-repeat  bottom rgba(0, 0, 0, 0);
          background-size: cover;
          border-bottom: 2px solid #3B5998;
          border-top: 2px solid #3B5998;
          /*height: 166px;*/
          width: 100%;
         
      }

      img#WearIt1{
        max-width: 120% !important;
      }

      .carousel-control {
          display: none !important;
      }

      @media (max-width: 320px){
        .likesharewear{
          margin-left: 65px;
          padding: 2%;
          width: 37%;
        }

        img#WearIt1{
          max-width: 100% !important;
        }

        .wearit{
          margin-left: 0;
        }

        .designbox {
          margin-left: 23px !important;
          margin-top: 20px !important;
        }
      }

      .current{
        font-size: 16px;
        padding:5px;
      }

    </style>
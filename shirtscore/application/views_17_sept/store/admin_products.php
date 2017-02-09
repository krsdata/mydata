
    <div class="container">
    <div class="row-fluid custom-head">
      <div class="span6 banner-box">
          <img src="<?php echo base_url() ?>assets/uploads/store/<?php echo $store_info->store_banner; ?>" alt="">
      </div><!-- span6 -->     
      <div class="span6 store-text">
        <h1><?php echo $store_info->store_name; ?></h1><br>
        <p><?php echo $store_info->store_description; ?></p>
      </div><!-- span6 -->
    </div><!-- row-fluid -->     

    <?php $this->load->view('store/prod_nav_bar'); ?>  

    <div class="row-fluid">
      <div class="span3" style="padding-left:3%">

        <div class="row">
          <div class="span12">
            <div id="sidebar_home_button" class="home sidebar_home_button" style="margin-left: 20px;">
              <a href="#"><i class="icon-home"></i> Home</a> <div id="fb-root"></div>
            </div>
          </div><!-- span12 -->       
        </div><!-- row -->

         <div class="row">
          <div class="span12">
              <div class="sidebar_home_button" style="position: relative;left:10px;"><img  width="190" src="<?php echo base_url() ?>assets/front_theme/img/swag.png" /></div>
          </div><!-- span12 -->       
        </div><!-- row -->

         <div class="row">
          <div class="span12">
             <ul class="sidebar1">
                <li><a <?php if(empty($_GET['category'])){echo 'class="active-category"';}?> href="<?php echo base_url(); ?>store/my_products">All</a></li>
              <?php foreach ($design_category as $category): ?>                
                <li><a <?php if(!empty($_GET['category']) && trim($_GET['category']) == $category->slug){echo 'class="active-category"';}?> href="<?php echo base_url() ?>store/my_products/0/?category=<?php echo $category->slug; ?>"><?php echo $category->category_name; ?></a></li>
              <?php endforeach ?>              
            </ul> 
          </div><!-- span12 -->       
        </div><!-- row -->        
         

      </div><!-- span2 -->
      <div class="span9" style="margin-left:5px;">
          <div class="row">     
          <?php if($products){ foreach ($products as $row){ ?>
             <div class="designlft">
                <div class="designbox">
                  <a href="<?php echo base_url().'store/store_product/'.$row->id; ?>">
                    <img src="<?php echo base_url() ?>assets/uploads/custom_prod_img/<?php echo $row->main_image ?>"  />
                  </a>
                </div>
                <div class="likesharewear">
                    <?php /* ?><!--
                    <div style="float:left; padding-right:20px;">
                        <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
                        <div class="fb-like" data-href="<?php echo base_url() ?>store/create_my_design/<?php echo $row->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
                    </div>
                    -->*/?>
                    <div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div>
                    <div class="wearit"> <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="75" height="37" border="0" id="WearIt1" /></a></div>
                </div>
              </div>
          <?php } }else{ ?>   
              <div class="span12" style="text-align:center;">
                  No Products Found
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

    <?php 
          if (!empty($store_info->header_color))
            $header_color = $store_info->header_color;
          else
            $header_color = '#EEEEEE';

          // if (!empty($store_info->font_style))
          //   $font_style = $store_info->font_style;
          // else
          //   $font_style = 'Verdana';

          if (!empty($store_info->font_color))
            $font_color = $store_info->font_color;
          else
            $font_color = '#8BC53F';

     ?>
    <script type="text/javascript">
      function fbshare(id){
          window.open ("http://www.facebook.com/share.php?u=<?php echo base_url() ?>store/fbshare/"+id,"Facebook_Share","menubar=1,resizable=1,width=900,height=500");
      }
    </script>
    <style type="text/css">

      .banner-box img{
        max-width: 100%;
        max-height: 300px;
      }
      .store-text p{
        color: #3B5998;
      }
      .custom-head .span6 h1{
        width: 100%;
        color: <?php echo $font_color; ?>;
        font-family: 'Verdana';
      }

      .custom-head{
        margin-top: 2%;
        background-color: #edf0f5;;
      }

      .custom-head .banner-box{
        padding: 2%;
      }
      .custom-head .store-text{
        padding: 2%;
      }

    </style>

    <style type="text/css">
      @media (max-width: 320px){
        .likesharewear{
          margin-left: 75px;
        }

        .wearit{
          margin-left: 0;
        }
      }
    </style>
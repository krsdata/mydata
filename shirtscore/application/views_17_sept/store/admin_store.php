

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

    <?php $this->load->view('store/sub_nav_bar'); ?>  

    <div class="row-fluid">

      <div class="span3" style="padding-left:3%">



        <div class="row">

          <div class="span12">


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

             <?php if(isset($cat)): ?>
              <?php if(!empty($design_category))
                  { 
                    ?>
                    <li><a <?php if($cat == '-'){echo 'class="active-category"';}?> href="<?php echo base_url().home_url(); ?>">All</a></li>
                    <?php foreach ($design_category as $category): ?>

                  <li><a <?php if($cat == $category->slug){echo 'class="active-category"';}?> href="<?php echo base_url() ?>store/designs/<?php echo $sort.'/'.$category->slug.'/'.$keyword; ?>"><?php echo $category->category_name; ?></a></li>

                  <?php endforeach; } ?>

              <?php endif ?>               

            </ul> 

          </div><!-- span12 -->       

        </div><!-- row -->        

         



      </div><!-- span2 -->

      <div class="span9" style="margin-left:5px;">

          <div class="row">     

          <?php if($designs){ $i=0; foreach ($designs as $row){ ?>

             <div class="designlft">

                <div class="designbox">

                  <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>">
                    <img id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug; ?>" dname="<?php echo $row->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" />
                    <!-- <img src="<?php // echo base_url() ?>assets/uploads/designs/<?php // echo $row->design_image ?>"  /> -->

                  </a>

                </div>

                <div class="likesharewear">
                    <?php ?>
                    <div style="float:left; width:32%;">
                        <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
                        <div class="fb-like" data-href="<?php echo base_url() ?>store/fblike/<?php echo $row->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
                    </div>
                    <?php ?>
                    <div class="shareit">
                      <a onclick="fbshare(<?php echo $row->id; ?>);" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                    </div>
                    <!-- <div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php // echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div> -->

                    <div class="wearit"> <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="75" height="37" border="0" id="WearIt1" /></a></div>
                </div>

              </div>

          <?php $i++; } }else{ ?>   

              <div class="span12" style="text-align:center;">

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

          window.open ("http://www.facebook.com/share.php?u=<?php echo base_url() ?>","Facebook_Share","menubar=1,resizable=1,width=900,height=500");

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
        color: #3F5177;
        font-family: 'Verdana';
        font-size: 22px;
        text-transform: capitalize;
      }

      .custom-head{
        margin-top: 2%;
        background-color: #edf0f5;
      }

      .custom-head .banner-box{
        padding: 2%;

      }

      .custom-head .store-text{

        padding: 2%;

      }
    </style>



    <style type="text/css">
      .wearit {
          float: right !important;
          margin-top: 5px !important;
          width: 50px !important;
      }

      .shareit {
          float: left !important;
          font-size: 14px !important;
          margin-top: 3% !important;
          padding: 2% 0 0 7% !important;
      }

      @media (max-width: 320px){
        .likesharewear{
          margin-left: 0;
          padding: 2%;
          width: 96%;
        }

        .wearit{
          margin-left: 0;
        }
      }
      .current{
        font-size: 16px;
        padding:5px;
      }
    </style>
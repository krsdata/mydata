<script>
  $(document).ready(function(){
    $('.bx-wrapper').css('max-width','780px');

  });
</script>
<style>
  .bx-wrapper img {
display: inline-block;
}

.bx-wrapper ul li {
margin-left: 12px;
line-height: 193px;

}
.bx-wrapper .bx-next {
    
    right: -40px !important;
}
.bx-wrapper .bx-prev {
    
    left: -40px !important;
}
</style>

     <div class="container">
          <?php //if($cat != "-" && !empty($cat)): ?>
                <!-- <div class="row-fluid custom-head hero_cat">
                    <div class="span12 banner-box">
                        <?php if(isset($cat_info->category_banner)): ?>
                          <img style="width:100%;max-height:250px" src="<?php echo base_url() ?>assets/uploads/category/<?php echo $cat_info->category_banner; ?>" alt="">
                        <?php else: ?>

                        <?php endif ?>
                    </div>
                </div>-->
          <?php //else: ?>
            <?php $this->load->view('store/slider'); ?>
          <?php //endif ?>
          <?php $this->load->view('store/sub_nav_bar'); ?> 
         <!--  <div class="row">
            <div class="span12">
            </div> span12 -->       
          <!--</div> row --> 

    <div class="row">
      <div class="span3">

         <div class="row">
          <div class="span12">
            <div class="sidebar_home_button" style="position: relative;left:5px;"> 
              <img  width="300" src="<?php echo base_url() ?>assets/front_theme/img/swag.png" /> 
            </div>
          <ul class="sidebar1">
                <?php if(isset($cat)): ?>
                    <!--<li><a <?php //if($cat == '-'){echo 'class="active-category"';}?> href="<?php// echo base_url().home_url(); ?>">All</a></li>-->
                    <?php foreach ($design_category as $category): ?>                
                      <li><a <?php if($cat == $category->slug){echo 'class="active-category"';}?> href="<?php echo base_url() ?>store/designs/<?php echo $sort.'/'.$category->slug; ?>" style="width:76%"><?php echo $category->category_name; ?></a></li>
                      <!-- .'/'.$keyword -->
                    <?php endforeach ?>
                <?php endif ?>
             </ul> 
          </div><!-- span12 -->
        </div><!-- row -->

      </div><!-- span3 -->
      <div class="span9" style="margin-left:5px;">
          <div class="row"> 

        <!-- crosoul slider -->
         <?php  if(!empty($best_sell)){ ?>
         
                <h3 align="center" style="color:#3b5998">BEST SELLERS</h3>
                <?php $best_sell_count = count($best_sell);
                
                if($best_sell_count>4){ ?>
 
                <ul class="bxslider">
               <?php
                foreach($best_sell as $sell){ ?>
                  <li><a href="<?php echo $sell->best_sell_link; ?>" title="<?php echo $sell->best_sell_title; ?>"><img src="<?php echo base_url(str_replace('./','',$sell->thumb_image));?>"/></a></li>
                  <?php } ?>
                 
                </ul>
       
                  
             <?php  } else{ ?>
               <div class="span10"> 
                <ul>
               <?php
                foreach($best_sell as $sell){ ?>
                  <li style="float: left; list-style: none outside none;  margin-left:50px; width:150px"><a href="<?php echo $sell->best_sell_link; ?>" title="<?php echo $sell->best_sell_title; ?>"><img src="<?php echo base_url(str_replace('./','',$sell->thumb_image));?>"/></a></li>
                  <?php } ?>
                 
                </ul>
              </div>



             <?php } ?>
                
              
          
            <?php } ?>  
           <!-- crosoul slider -->


          <?php if($designs){ $i=0; foreach ($designs as $row){ ?>
             <div class="designlft">
                <div class="designbox" style="background-image:url('<?php echo base_url() ?>assets/front_theme/img/background.jpg'); ">
                      <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>">
                    <!-- <img src="<?php // echo base_url() ?>assets/uploads/designs/<?php // echo $row->design_image ?>"  /> -->
                    <img style="background-image:url('<?php echo base_url() ?>assets/front_theme/img/background.jpg'); " title="<?php echo $row->design_title; ?>" id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug; ?>" dname="<?php echo $row->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" />
                  </a>
                </div>
                <div class="likesharewear">
                    <?php ?>
                    <div style="float:left; width:32%;">

                        <?php get_facebook_likes(base_url().'store/fblike/'.$row->id,$row->slug); //update facebook like count of design per ?>
                   
              
                       
                        <div class="fb-like" data-href="<?php echo base_url().'store/fblike/'.$row->id; ?>" data-width="450" data-layout="button_count"></div>
                    </div> 
                    <div class="shareit">
                      <a onclick="fbshare(<?php echo $row->id; ?>);" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                    </div>
                    <!-- <div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php // echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div> -->
                    <div class="wearit"> <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="80" height="37" border="0" id="WearIt1" /></a></div>
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
      // function fbshare(id){   
      //     window.open ("http://www.facebook.com/share.php?u=<?php echo current_url() ?>","Facebook_Share","menubar=1,resizable=1,width=900,height=500"); 
      // }
    </script>

    <style type="text/css">
      .wearit {
          float: right !important;
          margin-top: 7px !important;
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

      #footer_div a{
        text-decoration: underline;
      }


.likesharewear {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    height: 45px;
    margin-left: 15px;
    margin-top: 5px;
    width: 232px;
    }

    </style>
    <script>

<?php if($this->uri->segment(2)=='designs'): ?>
function Scrolldown() {
window.scroll(0,570); 
}

window.onload = Scrolldown;
<?php endif; ?>

</script>


<div class="row-fluid">
<div class="span1"></div>
<div style="color:#3B5998; text-transform:uppercase;text-align:center" id="footer_div" class="span10">
  <br>

    <center>
  <h4>Design, sell and purchase custom shirts, hoodies and apparel!</h4>
</center> 

<p ><a href="<?php echo base_url() ?>">ShirtScore.com</a> is your graphic designer platform for buying, selling and creating custom t-shirts, clothing and custom hooded sweatshirts. You can use our custom <a href="<?php echo base_url() ?>store/design_your_own">shirt design tool</a> and make your own custom products personalized with your photos, graphics and text. Create one of a kind <a href="<?php echo base_url() ?>store/designs/most-liked/fun/-">funny t-shirts</a>, company apparel, team gear on our unique products.</p>

<p>For bulk orders and screen printing orders please <a href="<?php echo base_url() ?>store/need_help">contact us</a> for a free quote. Because we do such high volume its tough to beat our bulk order pricing. Bulk screen printing and embroidery orders start at 24 pieces but the more you buy the more you save! </p>

<p>You can upload your own custom designs and <a href="<?php echo base_url() ?>store/signup">begin selling</a> your custom designs on our site. You will receive a commission for every sale that includes your custom design or graphic. You can also sell your custom T-shirts through our storefront or create your own personal online store that only offers your cool creations, graphic designs, names, teams or other logos. Sign up for a a free <a href="<?php echo base_url() ?>store/signup">T-shirt shop</a> with ShirtScore!</p>

<p>Check out our <a href="<?php echo base_url() ?>store/designs">Top Rated</a> shirt designs here and purchase crazy cool printed apparel for everyone in your family. Remember our custom designed products make a great gift so <a href="<?php echo base_url() ?>store/designs/most-liked/fun/-">start shopping</a>!</p>
</div>
<div class="span1"></div>
</div>
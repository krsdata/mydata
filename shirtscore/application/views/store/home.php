
    <div class="container">

     
      <?php $this->load->view('store/slider'); ?>

      <?php $this->load->view('store/sub_nav_bar'); ?>


    <div class="row-fluid">
      <div class="span3">
        <div class="row">
          <div class="span12">
            <div class="home">
              <a href="#"><i class="icon-home"></i> Home</a> <div id="fb-root"></div>
            </div>
          </div><!-- span12 -->       
        </div><!-- row -->

         <div class="row">
          <div class="span12">
              <div class="" style="position: relative;left:10px;"><img  width="190" src="<?php echo base_url() ?>assets/front_theme/img/swag.png" /></div>
          </div><!-- span12 -->       
        </div><!-- row -->

         <div class="row">
          <div class="span12">
             <ul class="sidebar1">
                <li><a <?php if(empty($cat_id)){echo 'class="active-category"';}?> href="<?php echo base_url().home_url(); ?>">All</a></li>
              <?php foreach ($design_category as $category): ?>                
                <li><a <?php if($cat_id == $category->id){echo 'class="active-category"';}?> href="<?php echo base_url() ?>store/store_designs/<?php echo $category->id; ?>/0"><?php echo $category->category_name; ?></a></li>
              <?php endforeach ?>
                <!--<li><a href="geek.html">Geek</a></li>
                <li><a href="political.html">Political</a></li>
                <li><a href="religious.html">Religious</a></li>
                <li><a href="ninja.html">Ninja</a></li>
                <li><a href="dark_side.html">Dark&nbsp;Side</a></li>
                <li><a href="animals.html">Animals</a></li>
                <li><a href="nature.html">Nature</a></li>
                <li><a href="sports.html">Sports</a></li>
                <li><a href="destinations.html">Destinations</a></li>
                <li><a href="naughty.html">Naughty</a></li>
                <li><a href="vampire.html">Vampire</a></li>
                <li><a href="zombie.html">Zombie</a></li>
                <li><a href="kids.html">Kids</a></li>
                <li><a href="single.html">Single</a></li>
                <li><a href="love.html">Love</a></li>
                <li><a href="holiday.html">Holiday</a></li>-->
            </ul> 
          </div><!-- span12 -->       
        </div><!-- row -->        
      </div><!-- span2 -->

      <div id="products" class="span9 offset1">

          <?php if($designs){ foreach ($designs as $row){ ?>
           <div class="row-fluid">     
             <div class="designlft">
              <div class="designbox">
                <a href="<?php echo base_url().'store/create_product_design/'.$row->id; ?>">
                  <img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image ?>"  />
                </a>
              </div>
              <div class="likesharewear">
                <div style="float:left; padding-right:20px;">
                  <!-- fb like -->
                  <!-- <div class="fb-like" data-href="http://localhost/shirtscore/store" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div> -->
                  <!-- fb like -->
                  <img src="<?php echo base_url() ?>assets/front_theme/img/fb_like.png" /></div><div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div></a></div>
                <div class="wearit">
                <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)">
                <img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="75" height="37" border="0" id="WearIt1" />
                </a>
                </div></div>
            </div>
          <?php } }else{ ?>   
            No Designs Found    
          <?php } ?>

        </div><!--row-fluid -->

    <?php if(isset($pagination)): ?>
      <div class="boxtopper">
         <?php echo $pagination; ?>
        <!--  <span class="pagination"><a href="#"><i class="icon-double-angle-left"></i></a>&nbsp;&nbsp;<a href="#">prev</a>&nbsp;&nbsp;<a href="#">first</a>&nbsp;&nbsp;<a href="#">1</a>&nbsp;&nbsp;<a href="#">2</a>&nbsp;&nbsp;<a href="#">3</a>&nbsp;&nbsp;<a href="#">4</a>&nbsp;&nbsp;<a href="#">5</a>&nbsp;&nbsp;<a href="#">last</a>&nbsp;&nbsp;<a href="#">next</a>&nbsp;&nbsp;<a href="#"><i class="icon-double-angle-right"></i></a></span> -->
         <!-- <span class="pagination"><a href="#">prev</a>&nbsp;&nbsp;<a href="#">first</a>&nbsp;&nbsp;<a href="#">1</a>&nbsp;&nbsp;<a href="#">2</a>&nbsp;&nbsp;<a href="#">3</a>&nbsp;&nbsp;<a href="#">4</a>&nbsp;&nbsp;<a href="#">5</a>&nbsp;&nbsp;<a href="#">last</a>&nbsp;&nbsp;<a href="#">next</a></span> -->
      </div>
    <?php endif; ?>



      </div><!-- span9 offset1 -->
    </div><!-- row-fluid -->

    <script type="text/javascript">
      function fbshare(id){   
          window.open ("http://www.facebook.com/share.php?u=<?php echo base_url() ?>store/fbshare/"+id,"Facebook_Share","menubar=1,resizable=1,width=900,height=500"); 
      }
    </script>

    <style type="text/css">
      .current{
        font-size: 16px;
        padding:5px;
      }
    </style>
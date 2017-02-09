
    <div class="container">
      <?php $this->load->view('store/sub_nav_bar1'); ?>
     <!--  <div class="boxtopper product-title">
         Products
      </div> -->
    <div class="row-fluid">
      <div class="span3">
          <div class="row">
            <div class="span12">
                <div class="sidebar_home_button" style="position: relative;left:40px;"> <img  width="190" src="<?php echo base_url() ?>assets/front_theme/img/swag.png" /> </div>
            </div><!-- span12 -->       
          </div><!-- row -->

         <div class="row">
          <div class="span12">
             <ul class="sidebar1">
               <?php if(isset($cat)): ?>
                    <li><a <?php if($cat == '-'){echo 'class="active-category"';}?> href="<?php echo base_url().'store/available_products'; ?>">All</a></li>
                    <?php foreach ($design_category as $category): ?>                
                      <li><a <?php if($cat == $category->slug){echo 'class="active-category"';}?> href="<?php echo base_url() ?>store/available_products/<?php echo $sort.'/'.$category->slug.'/'.$keyword; ?>"><?php echo $category->category_name; ?></a></li>
                    <?php endforeach ?>
                <?php endif ?>
             </ul> 
          </div><!-- span12 -->
        </div><!-- row -->

      </div><!-- span3 -->

      <div class="span8 row-fluid" style="width:70.812%;">
          <div class="prod-box span12 row-fluid" style="margin-left:3%;">
          <?php if($products){ $i=0; foreach ($products as $row){ ?>
              <?php if ($i%3 == 0): ?>
                </div>
                <div class="prod-box span12 row-fluid" style="margin-left:3%;">
              <?php endif; ?>
              <div class="designlft row-fluid span4">
                  <div class="designbox span10" style="margin-left:8%;">
                    <a href="<?php  echo base_url().'store/product_info/'.$row->slug; ?>">
                      <img style="margin-left:2%;" title="<?php echo $row->regular_name; ?>" id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug; ?>" dname="<?php echo $row->regular_name; ?>" src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->main_image; ?>" />
                    </a>
                  </div>
                  <div class="span10 prod-title">
                    <?php echo $row->regular_name; ?>
                  </div>
              </div>
          <?php $i++; } ?>
          <!-- <div class="designlft row-fluid span3">
              <div class="designbox span10" style="margin-left:8%;">
                <a href="#">
                  <img style="margin-left:2%;" title="Green Tshirt 123" id="facebook_share0" slug="green-tshirt-123" dname="Green Tshirt 123" src="http://localhost/SS_23_NOV_2013_Server/assets/uploads/products/thumbnail/1f_green.png" />
                </a>
              </div>
          </div> -->
          <?php }else{ ?>   
              <div class="span9" style="text-align:center;">
                  No Products Found
              </div>
          <?php } ?>
          </div><!--row-fluid -->
      </div><!-- span11 -->


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
      .prod-box {
        margin: 0 !important
      }
      
      .carousel-control {
          display: none !important;
      }

      .prod-title {
        text-align:center;
        margin-top: 5%;
        color: #3B5998;
        font-family: Novecentowide-Normal;
        font-size: 16px;
      }

      .product-title {
        text-align:center;
        color: #8BC53F;
        font-family: Novecentowide-Normal;
        font-size: 28px;
      }

      ul.sidebar1{
          margin-left: 30px;
      }
      .row{
        margin-left: 0;
      }
    </style>

 
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
        <div class="span12 row-fluid">
            <!---->
             <div class="span6 row-fluid">
                <div class="span12 row-fluid" id="colored_imgs">
                  <div class="span12" style="text-align:center;">
                      <img id="facebook_share" slug="<?php echo $product->slug; ?>" dname="<?php echo $product->regular_name; ?>" src="<?php echo base_url() ?>assets/uploads/products/<?php echo $product->main_image; ?>" />
                      <!-- <img src="<?php //echo base_url() ?>assets/uploads/designs/<?php // echo $design->design_image ?>"  /> -->
                  </div>
                 <?php if(!empty($product->back_image)): ?>
                  <div class="span12" style="text-align:center;">
                      <img src="<?php echo base_url() ?>assets/uploads/products/<?php echo $product->back_image; ?>" />
                      <!-- <img src="<?php //echo base_url() ?>assets/uploads/designs/<?php // echo $design->design_image ?>"  /> -->
                  </div>
                 <?php endif; ?>
                </div>
                <div class="likesharewear span10 row-fluid">
                    <div class="shareit span6">
                        <a class="shareit-at-product" title="share on facebook" ids="facebook_share" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="design_title span12 " style="margin-left:3%;"><?php if($product->regular_name !=""){ echo $product->regular_name; } ?></div>
                <div class="description span10">
                  <p>"<?php if(!empty($product->desc)){echo $product->desc;}else{echo "This is an awesome product...";} ?>" </p>
                </div>
                <div class="design_title span12"> Price : $<?php if(!empty($product->price)){echo $product->price;} ?></div>
                <!-- color selection -->               

              <?php echo form_open_multipart(base_url().'store/add_cart/'.$product->id,array('id'=>'select_product')); ?>
                <div class="row-fluid">
                  <div class="span6">
                  <?php $col=0; if ($colors): ?>
                    <h1 style="font-size:15px">Select a color</h1>
                    <?php foreach ($colors as $row): ?>
                      <a href="javascript:void(0);"><div id="col_<?php echo $row->id;  ?>" class="color_select" style=" float:left; margin-left:5px; background-color:<?php echo $row->color_code; ?>;" title="White"></div></a>
                    <?php $col++; endforeach; ?>
                  <?php endif; ?>
                  </div> <!-- span6 -->

                  
              </div> <!-- row -->
              <div class="row-fluid"> 

               <div class="span12">               
                    <div id="sizes_div">
                <?php if ($sizes): ?>
                  <h1 style="font-size:15px">Select quantity for a size</h1>
                    <?php foreach ($sizes as $row1): ?>
                    <div class="span2">
                      <label class="span12" style="text-align:center;"><?php echo $row1->size_name; ?></label>
                      <input class="span12 product-sizes " name="sizes_<?php echo $row1->id; ?>" type="text" value = "">
                    </div>
                <?php endforeach ?>                
                  <?php endif ?>

              </div>
                 </div>
                 <div class="span12">  
                 <input id="this_color" name="this_color" type="hidden" value="">
                    <input type="submit" name="" value="Add to cart" class="btn btn-primary" onclick="return validate_cart();">
                 </div>
                </div> <!-- row -->
                  <?php echo form_close(); ?>
                <!-- color selection -->
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

/*  .likeit, .wearit , .shareit{
    text-align: center !important;
  }*/
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
      font-size: 16px !important;
      /*margin-top: 3% !important;*/
      /*padding: 2% 0 0 0% !important;*/
  }
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $( ".color_select" ).each(function( index ) {
      if ( index == 0 )
        $(this).trigger('click');
      else
        return false;
    });
  });

  jQuery('#wear-it').click(function() {
    $('#select_product').submit();
  });
</script>

<script>


function validate_cart () {

  var valid_flag=false;  
  $('.product-sizes').each(function(index, el) {    
    if(valid_flag== false && el.value==''){       
       valid_flag = false;       
    }else{
        valid_flag=true;
    }
  });

  if(valid_flag==false){
    alert('Select quantity for a size.');
    return false;
  }

}
</script>
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
                  <div class="span6" style="text-align:center;">
                   <img src="<?php echo base_url('assets/uploads/test/temp/'.$product->main_image); ?>">
                    
                  </div>
                
                 <?php if(!empty($product->back_image)): ?>
                  <div class="span6" style="text-align:center;">
                      <img src="<?php echo base_url('assets/uploads/test/temp/'. $product->back_image) ?>" />                 
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
                  <p>"<?php if(!empty($product->desc)){echo $product->desc;}else{ echo "This is an awesome product...";} ?>" </p>
                </div>
                <div class="design_title span12"> Price : <?php echo money_symbol();?><?php echo number_format($product->price , 2); ?></div>
                <!-- color selection -->               

              <?php //echo form_open_multipart(base_url().'store/add_cart/'.$product->id,array('id'=>'select_product')); ?>
              <?php echo form_open("store/add_to_cart_custom/".$product->id , $arrayName = array('id' => 'cart_product'));?> <!-- Form Open -->
                <div class="row-fluid">
                  <div class="span6">
                 
                 <!-- color -->
                  </div> <!-- span6 -->

                  
              </div> <!-- row -->
              <div class="row-fluid"> 

               <div class="span12">               
                    <div id="sizes_div">



                      <?php if ($sizes): ?>

                  <h1 style="font-size:15px">Select quantity for a size:</h1>

                  <?php foreach ($sizes as $row1): ?>
                    <div class="span2">
                      <label class="span12" style="text-align:center;"><?php echo $row1->size_name; ?></label>
                      <input class="span12 product-sizes" name="sizes_<?php echo $row1->id; ?>" type="text" value = "">
                    </div>
                <?php endforeach ?>
                    <input id="this_size_id" name="size_id" type="hidden" value="0">
                    <input id="this_size_name" name="size_name" type="hidden" value="0">

                  <?php endif ?>
              

              </div>
                 </div>
                 <div class="span12">  
                 <input id="this_color" name="this_color" type="hidden" value="">
                    <input type="submit" name="" value="Add to cart" class="btn btn-large btn-primary" onclick="return validate_cart();">
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



    <div id="fb_portion" class="row-fluid  dashcontent">
       <div class="dashbox_0">
        <div class="row-fluid">
          
          <div class="span12">
            <h3 style="margin-left:20px;">Here is some cool stuff</h3>
            <div class="row" style="margin-left:20px">
            <?php if($latest_design): $i=1; foreach ($latest_design as $row): ?>
            <div style="float:left; margin-left:20px; margin-top:15px" class="">
              <a href="<?php echo base_url() ?>store/design_your_own/<?php echo $row->slug; ?>"><img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image; ?>" style="width:120px; height:120px"></a><br>
              <div style="float:left; width:32%;">
                            <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
                            <div class="fb-like" data-href="<?php echo base_url() ?>store/create_my_design/<?php echo $row->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
                        </div>
              <!-- <img src="<?php //echo base_url() ?>assets/front_theme/img/fb_like.png" style="margin-top:10px"> -->
            </div>
            <?php if ($i%8==0): ?>              
              </div>
              <div class="row" style="margin-left:20px">
            <?php endif; ?>             
            <?php $i++; endforeach; endif; ?>           
            </div>
          </div>
        </div>
      </div>
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
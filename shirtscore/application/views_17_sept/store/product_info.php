<div class="container">
<!-- <div class="hero_single"><div class="home"><a href="index.html"><i class="icon-home"></i> Home</a></div><div class="cart"><a href="cart.html"><i class="icon-shopping-cart"></i> Cart</a></div>
</div> -->
<div class="clearfloat"></div>
<div class="prodcontent">
</div>
<hr color="3b5998" />
<div class="dashbox  dashcontent">
  <div class=" row-fluid">
    <div class="row-fluid span12">
      <div class="span12 row-fluid">
        <!---->
        <div class="span6 row-fluid">
          <div class="span12 row-fluid" id="colored_imgs">
                  <!-- <div class="span12" style="text-align:center;">
                  <!-- <img id="facebook_share" slug="<?php echo $product->slug; ?>" dname="<?php echo $product->regular_name; ?>" src="<?php echo base_url() ?>assets/uploads/products/<?php echo $product->main_image; ?>" /> -->
                  <!-- <img src="<?php //echo base_url() ?>assets/uploads/designs/<?php // echo $design->design_image ?>"  /> -->
                 <!--  </div>
                 <?php if(!empty($product->back_image)): ?>
                  <div class="span12" style="text-align:center;">
                    <img src="<?php echo base_url() ?>assets/uploads/products/<?php echo $product->back_image; ?>" /> -->
                    <!-- <img src="<?php //echo base_url() ?>assets/uploads/designs/<?php // echo $design->design_image ?>"  /> -->
                  <!-- 
                <?php endif; ?></div>  -->
              </div>

              <div class="likesharewear span10 row-fluid">
                <div class="shareit span6">
                  <a onclick="fbshare_product(<?php echo $product->id; ?>);" title="share on facebook" ids="facebook_share" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                </div>
              </div>
            </div>
            <div class="span6">
              <?php echo form_open_multipart(base_url().'store/add_cart/'.$product->id,array('id'=>'select_product')); ?>
              <div class="design_title span8">
                <?php if($product->regular_name !=""){ echo $product->regular_name; } ?>
              </div>
              <div class="span3">
                <a href="<?php echo base_url('store/designs')?>" style="color: #ffffff;" class="btn btn-small btn-primary pull-right pull-right" >Add a design</a>
              </div>
              <div class="description span11">
               <?php if(!empty($product->desc)){echo $product->desc;}else{echo "This is an awesome product...";} ?>
             </div>

             <div class="span12">
              <?php $col=0; if ($colors): ?>                    
              <label class="labelclass">More Color To Pick</label>
              <?php foreach ($colors as $row): ?>
                <a href="javascript:void(0);"><div id="col_<?php echo $row->id;  ?>" class="color_select" style=" float:left; margin-left:5px; background-color:<?php echo $row->color_code; ?>;"  title="<?php echo $row->color_name;?>"></div></a>
                <?php $col++; endforeach; ?>                   
              <?php endif; ?>
            </div> 

            <div class="span12 "> 
             <div class="span12" id="sizes_div">
              <?php if ($sizes): ?>
                <label class="labelclass">Select quantity for a size</label>

                <table>
                  <tr>
                    <?php foreach ($sizes as $row1): ?>
                     <td>
                      <label class="quantityname"><?php echo $row1->size_name; ?> </label>
                      <label class="quantityname">$<?php
                        $price_product=get_size_details($product->id,$row1->id);
                        echo number_format($price_product->price,2);?></label>
                        <input class="inputfieldforquantity" min="1"  name="sizes_<?php echo $row1->id; ?>" type="number" value = "" placeholder="Qty">
                      </td>
                    <?php endforeach ?> 
                  </tr>
                </table>               
              <?php endif ?>
            </div>
          </div>

          <div class="span12"> 
           <input id="this_color" name="this_color" type="hidden" value="">
           <input type="submit" name="" id="image-button" data-original-title="Please select size of product then proceed." value="Add to cart" class="btn btn-primary btn-large pull-right" onclick="return validate_cart();">
         </div>

         <?php echo form_close(); ?>
         <!-- color selection -->
       </div>
     </div>

   </div>
   <br><br>
 </div>
</div>
<div class="dashbox dashcontent">

  <div class="">
    <h3 style="margin-left:20px;">Here is some cool stuff</h3>
    <div class="row" >
      <?php if($latest_design): $i=1; foreach ($latest_design as $row): ?>
        <div  class="span2" style="text-align: center;">
        <div style="text-align: center;width: 170px;height: 170px;background-image:url('<?php echo base_url() ?>assets/front_theme/img/background.jpg');text-align: center;margin-left: 15px;margin-top: 15px;vertical-align: middle;
          line-height: 160px;">
          <a href="<?php echo base_url() ?>wear_it/<?php echo $row->slug; ?>" >
          <img  src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" style="max-height: 150px;max-width: 150px;"></a><br></div>
          <div style="text-align: center;">
            <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
            <div class="fb-like" data-href="<?php echo base_url() ?>wear_it/<?php echo $row->slug ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false" style="padding:10px;"></div>
          </div>

        </div>
        <?php if ($i%10==0): ?>              
        </div>
        <div class="row" style="margin-left:20px">
        <?php endif; ?>             
        <?php $i++; endforeach; endif; ?>           
      </div>
    </div>

  </div>
  <div class="clearfloat"></div>

  <script>
    function get_size_details(size_ids) {
 //alert(size_ids);
 product_id  = jQuery('#product_id').val();
 if(size_ids!='' &&  product_id!='') {
  $.ajax({
   type: "POST",
   url: "<?php echo base_url('store/get_size_detail')?>",
           data: {product_id:product_id,size_ids:size_ids}, // serializes the form's elements.
           success: function(data)
           {
            if(data!='') {
              jQuery('#price_int').html(data);
            }
      } // if ajax function
    });
} }
</script>

<style type="text/css">
 .row-fluid [class*="span"]{
  margin-left: 0 !important;
}
.adddesgin{
  font-size: 16px;
  padding: 5px 8px;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  color: #ffffff;
  background-color: #006dcc;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
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
  font-size: 16px !important;
  /*margin-top: 3% !important;*/
  /*padding: 2% 0 0 0% !important;*/
}

.labelclass{
  color: rgba(46, 76, 153, 0.77);
  line-height: 7px;
  margin-top: 20px;
  font-size: 12px;
  font-weight: 700;
  padding: 3px;
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
    jQuery('#wear-it').click(function() {
      $('#select_product').submit();
    });
    jQuery(".plus").click(function()
    {
     var currentVal = parseInt(jQuery(".qty").val());
     if (!currentVal || currentVal=="" || currentVal == "NaN") currentVal = 0;
     jQuery(".qty").val(currentVal + 1);
   });

    jQuery(".minus").click(function()
    {
     var currentVal = parseInt(jQuery(".qty").val());
     if (currentVal == "NaN") currentVal = 0;
     if (currentVal > 1)
     {
       jQuery(".qty").val(currentVal - 1);
     }
   });
    jQuery('#image-button').tooltip();
  });
</script>
<script>
  function validate_cart () {

   var valid_flag=false;  
   $('.inputfieldforquantity').each(function(index, el) {    
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

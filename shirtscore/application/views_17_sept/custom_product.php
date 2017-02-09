<div class="container">
<!-- <div class="hero_single"><div class="home"><a href="index.html"><i class="icon-home"></i> Home</a></div><div class="cart"><a href="cart.html"><i class="icon-shopping-cart"></i> Cart</a></div>
</div> -->
<div class="clearfloat"></div>
<div class="prodcontent">
</div>
<hr color="3b5998" />
<div class="dashbox  dashcontent">
    <div class="row-fluid">
        <div class="row-fluid span12">
        <div class="span12 row-fluid">
            <!---->
             <div class="span6 row-fluid">
                <div class="span12 row-fluid" id="colored_imgs">
                  <div class="span6" style="text-align:center;">
                   <img src="<?php echo base_url('assets/uploads/test/temp/'.$product->main_image); ?>">
                  </div>
                 <?php //print_r($product);
                  if(!empty($product->back_image)): ?>
                  <div class="span6" style="text-align:center;">
                  </div>
                 <?php endif; ?>
                </div>
                
            </div>
            <div class="span6">
                <div class="design_title span12 " style="margin-left:3%;"><?php if($product->regular_name !=""){ echo $product->regular_name; } ?></div>
                <div class="description span10">
                  <p>"<?php if(!empty($product->desc)){echo $product->desc;}else{ echo "This is an awesome product...";} ?>" </p>
                </div>
              
              <?php echo form_open("store/add_to_cart_custom/".$product->id , $arrayName = array('id' => 'cart_product'));?> <!-- Form Open -->
                <div class="row-fluid">
                  <div class="span6">
                  </div> <!-- span6 -->
              </div>
              <div class="row-fluid"> 

                <div class="span4"> 
                    <div id="sizes_div">
                    <input type="hidden" id="product_id" value="<?php echo $product->id?>" name="product_id" />
                <?php if ($sizes): ?>
                  <label  class="labelclass">Choose your size</label>
                   <select name="size_id" id='size' class="span8" onchange="get_size_detail_cus(this.value)">
                    <option value="">Select Size</option>
                    <?php foreach ($sizes as $row1): ?>
                    <option value="<?php echo $row1->id;?>"><?php echo $row1->size_name; ?></option>}
                    <?php endforeach ?> 
                   </select>
                   <br><span style="height:2px;font-size:12px;color:#FF0000" id="size_errror"></span>
                  <?php endif ?>
              </div>
               <div class="span5"> 
            <label class="labelclass">Qunatity</label>
             <span class="input-qty">
              <input class="qty span4 product-sizes" type="text" value="1" name="qty" type="text" min="1" value="1"> 
              <input type="button" value="+" class="plus" /><input type="button" value="-" class="minus" />          
             </div>

              </div>
              <div class="span12"> 
               <input id="this_color" name="this_color" type="hidden" value="">
                  <div class="design_title span4"> Price : $<?php if(!empty($product->price)){?>
                  <span id="price_int"> <?php echo number_format($product->price , 2); ?> </span><?php } ?></div> 
                 <input id="this_color" name="this_color" type="hidden" value="">
                    <input type="submit" name="" id="image-button" data-original-title="Please select size of product then proceed." value="Add to cart" class="btn btn-primary btn-large pull-right" onclick="return validate_cart();">
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


 <div class="dashbox dashcontent">
          
          <div class="">
            <h3 style="margin-left:20px;">Here is some cool stuff</h3>
            <div class="row" >
            <?php if($latest_design): $i=1; foreach ($latest_design as $row): ?>
            <div  class="span2">
              <a href="<?php echo base_url() ?>store/design_your_own/<?php echo $row->slug; ?>"><img class="span2" src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image; ?>" style="width:150px; height:150px"></a><br>
              <div style="text-align: center;">
              <?php get_facebook_likes(base_url().'store/create_my_design/'.$row->id,$row->id); //update facebook like count of design per ?>
              <div class="fb-like" data-href="<?php echo base_url() ?>store/create_my_design/<?php echo $row->id ?>" data-width="450" data-layout="button_count" data-show-faces="true" data-send="false"></div>
          </div>
            
            </div>
            <?php if ($i%8==0): ?>              
              </div>
              <div class="row" style="margin-left:20px">
            <?php endif; ?>             
            <?php $i++; endforeach; endif; ?>           
            </div>
          </div>

    </div>
<div class="clearfloat"></div>

<style type="text/css">
  
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

<script>
function get_size_detail_cus(size_ids) {
 //alert(size_ids);
  product_id  = jQuery('#product_id').val();
/*  alert(product_id);
  alert(size_ids);*/
  if(size_ids!='' &&  product_id!='') {
  $.ajax({
           type: "POST",
           url: "<?php echo base_url('store/get_size_detail_cus')?>",
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
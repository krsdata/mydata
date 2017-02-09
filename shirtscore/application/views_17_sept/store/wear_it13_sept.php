<?php $restricted_para=$single_product->restricted_para;?>
<?php $area=json_decode($restricted_para);
      $segment= $this->uri->segment(2)?>
 <style>
    .bx-wrapper .bx-prev{
      background:url(<?php echo base_url() ?>assets/front_theme/img/left_arrow.png) no-repeat scroll 0  rgba(0, 0, 0, 0);
      left:-25px;
    }

    .bx-wrapper .bx-next{
      background:url(<?php echo base_url() ?>assets/front_theme/img/right_arrow.png) no-repeat scroll 0  rgba(0, 0, 0, 0);
     right:-35px;
    }
    .bx-wrapper .bx-controls-direction a{
      height:50px;
    
    }

    .bx-wrapper .bx-next:hover{
      background-position: 0px;
    }
    .bx-wrapper .bx-prev:hover{
      background-position: 0px;
    }

     

 </style>    
<div class="container">

    <div class="row-fluid">
        <div class="span4">
             <div  id="color_select_multi" >
              <!--  <?php list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/'.$single_product->main_image);
              $w_f=($width)/2.5;
              $h_f=($height)/1.50;
                ?>  -->
                 <!-- <img class="lazy" data-src="<?php echo base_url() ?>assets/uploads/products/<?php echo $single_product->main_image; ?>" src="<?php echo base_url() ?>assets/images/design-submit.gif" alt="Lazy Image"> -->

              <!--  <img style="max-height:80px; max-width:80px;position: relative; left:<?php echo $w_f ?>px; top:<?php echo $h_f?>px; z-index: 1;"  src="<?php echo base_url() ?>assets/uploads/products/<?php echo $single_product->main_image; ?>"> 

              <img  src="<?php echo base_url() ?>assets/images/design-submit.gif" class="lazy" data-src="<?php echo base_url() ?>assets/uploads/products/<?php echo $single_product->main_image; ?>" /> -->
                </div>
          </div>
       
          <div class="span8">
               <!-- crosoul slider -->
               <?php if($products){  $w_f1=0;$h_f1=0; ?>
              <!-- <div id="slider1"> -->
               <h4>More Available Products</h4>
                  <!-- <a class="buttons prev" href="#"><img src="<?php //echo base_url() ?>assets/front_theme/img/left_arrow.png" /></a> --><!-- &#60; -->
                  <!-- <div class="viewport" id="scroll" style="width:633px; height:165px"> -->
                <ul class="bxslider">
                   <?php
                    foreach($products as $row){ ?>
                      <li>  <?php list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/thumbnail/'.$row->main_image);
                          $w_f1=($width)/4.14;
                          $h_f1=($height)/3.98;
                            ?>
                           <a href="<?php  echo base_url().'wear_it/'. $segment.'/'.$row->id; ?>">
                            <div style="min-height:18px">
                           
                            <img style="<?php if($row->position=='left')
                                    echo 'left:-15px;';
                                  if($row->position=='right')
                                    echo 'left:15px;';  ?>max-width:30px;max-height:30px;position: relative; top:<?php echo $h_f1?>px; z-index: 1;margin: 0px auto;" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $design->design_image; ?>"/>
                              </div>
                              <img style="height:140px;" title="<?php echo $row->regular_name;?>" src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->main_image; ?>" />
                        </a></li>
                      <?php } ?>
                     
                    </ul>
                  <!-- </div> -->
                  <!-- <a class="buttons next" href="#"><img src="<?php //echo base_url() ?>assets/front_theme/img/right_arrow.png" /></a> --><!-- &#62; -->
               <!--  </div>  -->
                <?php } ?>  
               <!-- crosoul slider -->



            <!-- <div id="scroll" style="width:700px;overflow-y:hidden;overflow-x:scroll; height:165px">
            <ul>
               <?php// if($products){  $w_f1=0;$h_f1=0; foreach ($products as $row){ ?>
                    <li>
                       <?php //list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/thumbnail/'.$row->main_image);
                          //$w_f1=($width)/4.14;
                          //$h_f1=($height)/3.98;
                            ?>
                          
                            <a href="<?php  //echo base_url().'wear_it/'. $segment.'/'.$row->id; ?>">
                            <div style="min-height:18px">
                           
                            <img style=" <?php //if($row->position=='left')
                                  //  echo 'left:-15px;';
                   //if($row->position=='right')
                                    //echo 'left:18px;';  ?>max-width:30px;max-height:30px;position: relative; top:<?php// echo $h_f1?>px; z-index: 1;margin: 0px auto;" src="<?php //echo base_url() ?>assets/uploads/designs/thumbnail/<?php //echo $design->design_image; ?>"/>
                              </div>
                              <img style="height:140px;" title="<?php //echo $row->regular_name;?>" src="<?php //echo base_url() ?>assets/uploads/products/thumbnail/<?php //echo $row->main_image; ?>" />
                        </a>
                      </li>
              <?php //}  } ?>
              </ul>
              </div> -->
          </div>
            <div class="span8" >
               <?php echo form_open_multipart(base_url().'store/create_product_design_multi/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>
                <div class="row-fluid">
                                       
                  <div class="span12">
                  <?php $col=0; if ($colors): ?>  <br>                  
                      <label class="labelclass">More Color To Pick</label>
                      <?php foreach ($colors as $row): ?>
                     <a href="javascript:void(0);">
                     <div id="col_<?php echo $row->id;  ?>" class="color_select_multi" style=" float:left; margin-left:5px; background-color:<?php echo $row->color_code; ?>;" title="<?php echo $row->color_name; ?>">
                     </div></a>
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
                      $price_product=get_size_details($single_product->id,$row1->id);
                       echo number_format($price_product->price + $design->price,2);?></label>
                      <input class="inputfieldforquantity" min="0"  name="sizes_<?php echo $row1->id; ?>" type="number" value = "" placeholder="Qty">
                    </td>
                <?php endforeach ?> 
                 </tr>
                  </table>               
                  <?php endif ?>
              </div>
              </div>
                             

                    <div class="design_title span12">       
                       <input id="this_color_multi" name="this_color" type="hidden" value="">
                      <input type="submit" name="" id="image-button" data-original-title="Please select size of product then proceed." value="Add to cart" class="btn btn-primary btn-large pull-right" onclick="return validate_cart();">
                    </div>
                 </div>
                  <?php echo form_close(); ?>
            </div>
          </div>
          <!-- second row fluid start  -->
          
           <div class="row-fluid" style="padding:12px;">
              <div class="greenheading"><h4><?php echo $design->design_title;?></h4></div>
                <div class="fontsizesmall"><h5>By&nbsp;<?php echo $design->artist;?></h5></div>
               <div class="greenheading"><b><?php echo $single_product->regular_name;?></b></div>
               <div class="greenheading"><b>Product description :</b></div>
               <div class="fontsizesmall">
               <?php if(!empty($single_product->desc)){echo $single_product->desc;}
               else{echo "This is an awesome product...";} ?></div>
            </div>

             <!-- second row fluid end -->

          <div class="row-fluid" style="padding:12px;">
            <div class="span5">
                 <?php if(!empty($design->design_video)): ?>
                  <h4 style="color:#3b5998">Special Message</h4>
                  <?php if($design->design_video_type=='1'): ?><a class="fancybox-media1" href="<?php echo $design->design_video; ?>"> <?php echo get_youtube_thumbnail($design->design_video);?> </a><br><br> 
                      <?php else: ?>
                       <div id="vertical"></div> <br><br>
                      <?php endif; ?>
                    <div class="fontsizesmall">Find out more about this design by the artist.</div><br>
                 
                 <?php else : ?>
                  <div class="greenheading"><b>Comments</b></div><br>
                  <div class="fb-comments" data-href="<?php echo current_url() ?>" data-width="450" data-numposts="5" data-colorscheme="light"></div>
                  <?php endif; ?>
            </div>
            <div class="span7">
              <div class="greenheading"><b>More Cool Designs <a href="<?php echo base_url('store/designs')?>">( View All)</a></b></div><br>
                 <ul>
                  <?php if($latest_design): $i = 1; foreach ($latest_design as $row): ?>
                    <li class="span4" style="text-align: center;">
                     <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>">
                            <img id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug;?>" name="<?php echo $row->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" style="wi" class="imagesize"/></a>
                        <div class="likesharewear">
                              <div style="float:left; width:32%;">
                                  <?php get_facebook_likes(base_url().'wear_it/'.$row->id,$row->slug); //update facebook like count of design per ?>
                                  <div class="fb-like" data-href="<?php echo base_url() ?>store/fblike/<?php echo $row->id;?>" data-width="375" data-layout="button_count" data-show-faces="true" data-send="false"></div>
                              </div> 

                              <div class="shareit">
                                <a onclick="fbshare(<?php echo $row->id; ?>);" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>share it</div> </a>
                              </div>
                              <!-- <div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php // echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div> -->
                              <div class="wearit"> <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="50" height="37" border="0" id="WearIt1" /></a></div>
                      </div>
                      
                        </li>
                    <?php $i++; endforeach; endif; ?>
                    </ul>
                    <?php if(!empty($design->design_video)): ?>
                    <div style="clear:both"></div>
                          <div class="greenheading"><b>Comments</b></div><br>
                      <div style="padding-right:20px">
                           <div class="fb-comments" data-href="<?php echo current_url() ?>" data-width="550" data-numposts="5" data-colorscheme="light">
                           </div>
                      </div>
                    <?php endif; ?>
            </div>
        </div>
      </div>
      </div>

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
        var old_price= '<?php echo $design->price; ?>';
        jQuery('#price_int').html((parseFloat(data)+parseFloat(old_price)));
       // jQuery('#total_size_stock').val(max_size_qty);
        }
      } // if ajax function
         });
  } }
</script>

      <style type="text/css">
   .row-fluid [class*="span"]{
    margin-left: 0 !important;
  }

 .wearit {
        float: left !important;
        margin-top: 7px !important;
        width: 40px;
  }
  .imagesize{
    max-height: 70px;
    max-width: 120px;
  }
  .description p{
        font-size: 15px !important;
  }
  .shareit {
      float: left !important;
      font-size: 10px !important;
      padding: 8px;
      margin-left:0px
      /*margin-top: 3% !important;*/
      /*padding: 2% 0 0 0% !important;*/
  }

  .likesharewear {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    height: 45px;
    margin-left: 0px;
    margin-top: 16px;
    width: 232px;
}
  .color_select_multi {
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    float: left;
    height: 20px;
    margin: 5px;
    width: 20px;
}
#scroll {
overflow:auto;
/*box-shadow:0 0 5px #E1e1e1;*/
}

#scroll ul {
float:left;
margin-right:-999em;
white-space:nowrap;
list-style:none;
}
#scroll li {
margin:1px; margin-top: -5px;
text-align:center;
float:left;
display:inline;  line-height: 9px;          
}
#scroll img {
border:0;
display:block;
}
#scroll center {
    margin-top: 5px; font-size: 13px; 
}
.greenheading{
  color: #3B5998;
    text-transform: capitalize;
    font-size: 14px;
}
.pricebox{
 border: 1px solid #D6DDD6;
margin: 0;
padding: 10px;
background: rgb(230, 228, 228);
}
.fontsizesmall{
  font-size: 12px;
  margin-bottom: 20px;
}

/* Tiny Carousel */
#slider1 { height: 1%; margin: 30px 0 0; overflow:hidden; position: relative; padding: 0 24px 10px;   }
#slider1 .viewport { height: 190px; overflow: hidden; position: relative; /*background-color: #fff*/; }
#slider1 .buttons {
   /* background:#ccc ;#C01313
    border-radius: 35px;*/
    display: block;
    position: absolute;
    top: 50%;
    left: 0%;
    width: 30px;
    height: 35px;
    color: #000;
    font-weight: bold;
    text-align: center;
    line-height: 35px;
    text-decoration: none;
    font-size: 45px;
    z-index: 5
}
#slider1 .next {
    right: -11px;
    left: auto;
    top: 50%;
  
}
#slider1 .buttons:hover{
    color: #ccc;
 /*background: #8bc43f;*/
}
#slider1 .disable { visibility: hidden; }
#slider1 .overview { list-style: none; position: absolute; padding: 0; margin: 0; width: 175px; left: 0 top: 0; }
#slider1 .overview li{ float: left; margin: 0 20px 0 0; padding: 1px; height: 121px;}


</style>
<script type="text/javascript">
  $(document).ready(function(){
    $( ".color_select_multi" ).each(function( index ) {
      if ( index == 0 )
        $(this).trigger('click');
      else
        return false;
    });
 jQuery('#wear-it').click(function() {
    $('#select_product').submit();
  });
  jQuery('#image-button').tooltip();
  });
</script>

<script>
 jQuery('.color_select_multi').click(function() {
      var col = jQuery(this).attr('id');
      var col = col.split("_");
      if (col[1] != 0)
      {
        jQuery.ajax({
              type: "POST",
              data: { action: 'get_content',},
              url: "<?php echo base_url() ?>store/ajax_col_imgs_multi/"+col[1]+"/<?php echo $segment?>",
              success: function(res){
                // alert(res);
                var obj = jQuery.parseJSON(res);
                if(obj.result ==='success')
                {
                   jQuery('#color_select_multi').html(obj.imgs);
                }
                else
                {
                  jQuery('#color_select_multi').html(obj.msg);
                }
              }
        });

        jQuery("#this_color_multi").val(col[1]);
        jQuery('.color_select_multi').removeClass('its-colored');
        jQuery(this).addClass('its-colored');
      };
  });
</script>

<script>


function validate_cart () {

var size   =  jQuery('#size').val();
    
     if(jQuery('#inputfieldforquantity').val()=='' || jQuery('#inputfieldforquantity').val()<=0 )
    {
    alert('Select valid quantity');
      return false;
    }
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


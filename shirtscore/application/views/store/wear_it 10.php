<?php $restricted_para=$single_product->restricted_para;?>
<?php $area=json_decode($restricted_para);
      $segment= $this->uri->segment(2)?>
<div class="container">
    <div class="span12">
      <div class="span4">
      	<center>
      	 <div class="row-fluid">
             <div class="span12 row-fluid" id="color_select_multi" >
             <?php list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/'.$single_product->main_image);
              $w_f=($width)/1.52;
              $h_f=($height)/1.50;
                ?>
               <img style="max-height:80px; max-width:80px;position: absolute; left:<?php echo $w_f ?>px; top:<?php echo $h_f?>px; z-index: 1;" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $design->design_image; ?>" /> 

              <img style="" src="<?php echo base_url() ?>assets/uploads/products/<?php echo $single_product->main_image; ?>" />
                </div>
            </div>

  
		<br>
		<h5><?php echo $single_product->regular_name;?></h5>
        <p>"<?php if(!empty($single_product->desc)){echo $single_product->desc;}else{echo "This is an awesome product...";} ?>" </p></center>

      	</div>
        
      	<div class="span7">
      	<div style="height:350px;overflow-y:scroll;overflow-:hidden;visibility:visible;position:fix">
      	   <div class="row"> <?php if($products){  $w_f1=0;$h_f1=0; foreach ($products as $row){ ?>
                <div class="span3">
                 
                   <?php list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/thumbnail/'.$row->main_image);
                      $w_f1=($width)/2.34;
                      $h_f1=($height)/1.76;
                        ?>
                       <div>
                        <a href="<?php  echo base_url().'wear_it/'. $segment.'/'.$row->id; ?>">
                        <img style="max-height:40px; max-width:45px;position: relative; left:<?php echo $w_f1 ?>px; top:<?php echo $h_f1?>px; z-index: 1;" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $design->design_image; ?>"/>
                          
                          <img title="<?php echo $row->regular_name;?>" src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->main_image; ?>" /></div>
                        <br><center><?php echo $row->regular_name; ?></center>
                    </a>
                  </div>
          <?php }  } ?>
          </div>
          </div>
          	<div class="span8">
          		<?php ?>
          		 <?php echo form_open_multipart(base_url().'store/add_cart/'.$single_product->id,array('id'=>'select_product')); ?>
                <div class="row-fluid">
                  <div class="span6">
                  <?php $col=0; if ($colors): ?>
                    <h1 style="font-size:15px">Select a color</h1>
                    <?php foreach ($colors as $row): ?>
                      <a href="javascript:void(0);"><div id="col_<?php echo $row->id;  ?>" class="color_select_multi" style=" float:left; margin-left:5px; background-color:<?php echo $row->color_code; ?>;" title="White"></div></a>
                    <?php $col++; endforeach; ?>
                  <?php endif; ?>
                  </div> 
                            
                <div class="span11" id="sizes_div">
                <?php if ($sizes): ?>
                  <h1 style="font-size:15px">Select quantity for a size</h1>
                    <?php foreach ($sizes as $row1): ?>
                    <div class="span3">
                      <label class="span5" style="text-align:center;"><?php echo $row1->size_name; ?></label>
                      <input class="span4 product-sizes " name="sizes_<?php echo $row1->id; ?>" type="number" value = "">
                    </div>
                <?php endforeach ?>                
                  <?php endif ?>
              </div>
                <div class="design_title row span3"> Price : $<?php if(!empty($single_product->price)){echo $single_product->price + $design->price;;} ?></div>

                 <div class="span2">  
                 <input id="this_color_multi" name="this_color" type="hidden" value="">
                    <input type="submit" name="" value="Add to cart" class="btn btn-primary btn-large pull-right" onclick="return validate_cart();">
                 </div>
                </div> <!-- row -->
                  <?php echo form_close(); ?>

          	</div>
          </div>

      </div>

      </div>

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
  .color_select_multi {
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    float: left;
    height: 20px;
    margin: 5px;
    width: 20px;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $( ".color_select_multi" ).each(function( index ) {
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
   

    <div id="main_container">
      <div class="row-fluid ">

        <div class="span12">

        
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Edit Parameters </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->
        <div class="content">
  				  <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid','id'=>'edit_product')); ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field"> Color
                    <span class="help-block"><?php echo form_error('color'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" data-color="<?php if(isset($colors->color_code)){echo $colors->color_code;}  ?>" data-color-format="hex" id="colorpicker3">
                    <input type="text"   name="color" value="<?php if(isset($colors->color_code)){echo $colors->color_code;} ?>" placeholder="color">
                    <span class="add-on"><i style="<?php if(isset($colors->color_code)){echo $colors->color_code;} ?>; "></i></span> </div>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Color Name
                  <span class="help-block"><?php echo form_error('color_name'); ?></span>
                </label>
                  <div class="controls span5">
                    <input type="text" class="row-fluid" name="color_name" value="<?php if(isset($colors->color_name)){echo $colors->color_name;} ?>" placeholder="Color Name">
                  </div>
                </div>

                <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Front Image
                    <span class="help-block"><?php echo form_error('front');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="front" name="front" style="opacity:1 !important"><br>
                   <?php if (!empty($colors->main_image)): ?>
                   <div class="row-fluid image_priview">  
                      <img src="<?php echo base_url().'assets/uploads/color_img/thumbnail/'.$colors->main_image; ?>">
                   </div> 
                   <?php endif; ?>
                  </div>
                </div>

              <!--   <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Left Image
                    <span class="help-block"><?php //echo form_error('left');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="left" name="left" style="opacity:1 !important"><br>
                   <div class="row-fluid image_priview">  </div> 
                  </div>
                </div> -->

                <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Back Image
                    <span class="help-block"><?php echo form_error('back');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="back" name="back" style="opacity:1 !important"><br>
                   <?php if (!empty($colors->back_image)): ?>
                   <div class="row-fluid image_priview">  
                      <img src="<?php echo base_url().'assets/uploads/color_img/thumbnail/'.$colors->back_image; ?>">
                   </div> 
                   <?php endif; ?>
                  </div>
                </div>

                <!-- <input id="userfile_1" type="file" name="userfile" class="">            -->
                <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Submit</button>                    
                  </div>
                </div>      
            <?php echo form_close(); ?>
            <!-- End row-fluid --> 
          </div>
          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
    </div>  

    <style type="text/css">
  #uniform-userfile_1 .filename, #uniform-userfile_1 .action{
    display: none !important; 
  }

  .uploader input{
    opacity: 1 !important;

  }
</style>

<script type="text/javascript">
  
  $('#userfile_1').removeAttr('size');
  $(document).ready(function(){
    $('#add_image_div').hide();
  });

  $('.remove_image').click(function(){
    var img_id = $(this).attr('id');
    // alert(img_id);
    $('#sp'+img_id).html('<img src="<?php echo THEME_URL ?>img/ajax-loader.gif">')
    $.ajax({
    type: "POST",    
     url: "<?php echo base_url().'storeadmin/remove_product_images/' ?>"+img_id,
    success: function(res){
      if(res !=''){
        $('#sp'+img_id).hide();
        $('input[ids='+img_id+']').val('');
      }
    }
    });
  });
</script>
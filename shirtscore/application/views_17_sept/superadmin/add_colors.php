<div id="main_container">
      <div class="row-fluid ">     	
        <div class="span12">
        
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Add Parameters </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid','id'=>'add_product')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Add Color
                  <span class="help-block"><?php echo form_error('color'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" data-color="#4a8cf7" data-color-format="hex" id="colorpicker3">
                    <input type="text"   name="color" value="<?php echo set_value('color'); ?>" placeholder="color">
                    <span class="add-on"><i style="#4a8cf7; "></i></span> </div>
                  </div>
                </div>  

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Color Name
                  <span class="help-block"><?php echo form_error('color_name'); ?></span>
                </label>
                  <div class="controls span5">
                    <input type="text" class="row-fluid" name="color_name" value="<?php echo set_value('color_name'); ?>" placeholder="Color Name">
                  </div>
                </div>


                <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Front Image
                    <span class="help-block"><?php echo form_error('front');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="front" name="front" style="opacity:1 !important"><br>
                   <div class="row-fluid image_priview">  </div> 
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
                   <div class="row-fluid image_priview">  </div> 
                  </div>
                </div>

                <!-- <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Right Image
                    <span class="help-block"><?php //echo form_error('right');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="right" name="right" style="opacity:1 !important"><br>
                   <div class="row-fluid image_priview">  </div> 
                  </div>
                </div> -->
                <!-- <input id="userfile_1" type="file" name="userfile" class="">            -->
                <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Submit</button>                    
                  </div>
                </div>                
            <?php echo form_close(); ?>
            </div>
             <!--  -->
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
</script>

    <div id="main_container">
      <div class="row-fluid ">      

        <div class="span12">

        
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-picture"></i> <span> Edit Slider Content </span> </h4>
            </div>
              <div class="content">
                <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>

                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="with-placeholder">Image</label>
                      <div class="controls span9">
                          <?php echo form_error('img_deleted'); ?>
                          <span id="img" class="slider-img">
                            <?php if(!empty($slider_content->image)): ?>
                            <div class="row-fluid">
                              <div><img class="span12" src="<?php echo base_url() ?>assets/uploads/slider_images/<?php echo $slider_content->image; ?>"></div>
                              <div class="pull-right"><br><a href="javascript:void(0)" onclick="remove_slider_image(<?php echo $slider_content->id; ?>)" id="remove_image"><span class="btn btn-danger" >Remove</span></a></div>
                            </div>
                            <?php endif; ?>
                          </span>
                      </div>
                    </div>

                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="normal-field">Slider Image
                        <span class="help-block"><?php echo form_error('slider_image'); ?></span>
                      </label>
                      <div class="controls span9">
                        <input type="file" name="slider_image" class="spa1n6 fileinput">
                        <input type="hidden" name="img_deleted" id="img_deleted" value="<?php if(set_value('img_deleted')){echo set_value('img_deleted');}else{echo "0";} ?>">
                      </div>
                    </div>

                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="with-placeholder">Caption
                        <span class="help-block"><?php echo form_error('caption'); ?></span>
                      </label>
                      <div class="controls span9">
                        <textarea name="caption" rows="5" class="row-fluid"><?php if(set_value('caption')){ echo set_value('caption'); }elseif(!empty($slider_content->caption)){ echo $slider_content->caption; } ?></textarea>
                      </div>
                    </div>

                    <div class="form-actions row-fluid">
                    <div class="span3 visible-desktop"></div>
                      <div class="span7 ">
                        <button type="submit" id="save_slide" class="btn btn-primary">Save</button>                    
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
        .slider-img img{
          width:10%;
        }


      </style>
      <script type="text/javascript">
          function remove_slider_image (id) {

            if(confirm('Are you sure want to remove?')){
              $('#img').html('');
              $('#img_deleted').val('0');
              $.ajax({
                      type: 'POST',            
                      url: '<?php echo base_url() ?>superadmin/remove_slider_image/'+id,
                      success: function(data){
                          $('#img').hide();
                          $('#img_deleted').val('1');
                    }
              });
            }
          }
      </script>
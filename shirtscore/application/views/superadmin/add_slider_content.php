
    <div id="main_container">
      <div class="row-fluid ">      

        <div class="span12">

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-picture"></i> <span> Add Slider Content </span> </h4>
            </div>
              <div class="content">
                <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>
                    
                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="normal-field">Slider Image
                        <span class="help-block"><?php echo form_error('slider_image'); ?></span>
                      </label>
                      <div class="controls span9">
                        <input type="file" name="slider_image" class="spa1n6 fileinput">
                      </div>
                    </div>

                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="with-placeholder">Caption
                        <span class="help-block"><?php echo form_error('caption'); ?></span>
                      </label>
                      <div class="controls span9">
                        <textarea name="caption" rows="5" class="row-fluid"><?php echo set_value('caption'); ?></textarea>
                      </div>
                    </div>      
                    <div class="form-actions row-fluid">
                    <div class="span3 visible-desktop"></div>
                      <div class="span7 ">
                        <button type="submit" class="btn btn-primary">Save</button>                    
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
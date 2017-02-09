<div id="main_container">
    <div class="row-fluid ">     	
       <div class="span12">
       

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-picture"></i> <span><?php if(!empty($best_sell)){ ?> Edit Design <?php }else{ ?> Add Design <?php } ?></span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
             

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Title
                    <span class="help-block"><?php echo form_error('best_sell_title'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" id="title" class="row-fluid" name="best_sell_title" value="<?php if(!empty($best_sell->best_sell_title)) echo $best_sell->best_sell_title; else echo set_value('best_sell_title'); ?>" placeholder="Design Title">
                  </div>
                </div>

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Link
                    <span class="help-block"><?php echo form_error('best_sell_link'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" id="best_sell_link" class="row-fluid" name="best_sell_link" value="<?php if(!empty($best_sell->best_sell_link)) echo $best_sell->best_sell_link; else echo base_url().set_value('best_sell_link'); ?>" placeholder="Design Link">
                  </div>
                </div>
            
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Image
                    <span class="help-block"><?php echo form_error('best_sell_image'); ?></span>
                  </label>
                  <div class="controls span9">
                  <?php if(!empty($best_sell->thumb_image)){ ?><img src="<?php echo base_url(str_replace('./','',$best_sell->thumb_image));?>"><?php } ?>
                    <input type="file" name="best_sell_image" class="spa1n6 fileinput">
                  </div>
                </div>

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
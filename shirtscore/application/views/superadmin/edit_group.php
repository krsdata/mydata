
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

        
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Edit Group </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Group Name
                  <span class="help-block"><?php echo form_error('group_name'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="group_name" value="<?php if(!empty($product_group->group_name)) echo $product_group->group_name; ?>" placeholder="Group Name">
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
  <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Add Design Price </span> </h4>
            </div>
            <!-- End .title -->
 
        <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Price <?php echo money_symbol() ?>
                  <span class="help-block"><?php echo form_error('price'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="price" value="" placeholder="Design Price">
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
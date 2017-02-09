  <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

	
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-certificate"></i> <span> Set Commission details </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">

              

  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Commission Per Item &nbsp;&nbsp;<?php money_symbol(); ?> 
                  <span class="help-block"><?php echo form_error('comm_per_product'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="comm_per_product" value="<?php echo $commission->commission_price;?>" placeholder="commission">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Paypal Fee &nbsp;&nbsp;<?php money_symbol(); ?>
                  <span class="help-block"><?php echo form_error('paypal_fee'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="paypal_fee" value="<?php echo $commission->paypal_fee;?>" placeholder="Paypal Fee">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Mailed Check Fee &nbsp;&nbsp;<?php money_symbol(); ?> 
                    <span class="help-block"><?php echo form_error('mailed_check_fee'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="mailed_check_fee" value="<?php echo $commission->mailed_check_fee;?>" placeholder="Mailed Check Fee">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Max no. of designs at signup &nbsp;&nbsp; 
                    <span class="help-block"><?php echo form_error('max_design'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="max_design" value="<?php echo $commission->max_design;?>" placeholder="Mailed Check Fee">
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
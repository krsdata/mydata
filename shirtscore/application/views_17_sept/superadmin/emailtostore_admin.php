
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

        

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-envelope"></i> <span> Email to
               Store Admin </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Email To
                  <span class="help-block"><?php echo form_error('email'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" readonly="readonly" value="<?php echo $admin->email; ?>" class="row-fluid" name="email" placeholder="Email">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Subject
                  <span class="help-block"><?php echo form_error('subject'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('subject'); ?>" class="row-fluid" name="subject" placeholder="Subject">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Message
                  <span class="help-block"><?php echo form_error('message'); ?></span>
                </label>
                  <div class="controls span9">
                    <textarea class="row-fluid" name="message" placeholder="Message" rows="10"><?php echo set_value('message'); ?></textarea>
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
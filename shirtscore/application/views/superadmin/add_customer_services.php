
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

      
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user-md"></i> <span> Add Customer Service </span> </h4>
            </div>
            <!-- End .title -->
            <!--  -->
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">First Name
                  <span class="help-block"><?php echo form_error('firstname'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="firstname" value="<?php echo set_value('firstname'); ?>" placeholder="First Name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Last Name 
                  	<span class="help-block"><?php echo form_error('lastname'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="lastname" value="<?php  echo set_value('lastname'); ?>" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Email
                  <span class="help-block"><?php echo form_error('email'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('email'); ?>" class="row-fluid" name="email" placeholder="Email">
                  </div>
                </div>
                  <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Mobile 
                    <span class="help-block"><?php echo form_error('phone'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Mobile no.">
                  </div>
                </div>     
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Password
                  <span class="help-block"><?php echo form_error('password'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="password" value="<?php echo set_value('password'); ?>" class="row-fluid" name="password" placeholder="password">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Confirm Password
                    <span class="help-block"><?php echo form_error('cpassword'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="password" value="<?php echo set_value('cpassword'); ?>" class="row-fluid" name="cpassword" placeholder="confirm password">
                  </div>
                </div>

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Address
                    <span class="help-block"><?php echo form_error('address'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="address" rows="5" class="row-fluid"><?php echo set_value('address'); ?></textarea>
                    <!-- <input type="text" class="row-fluid" name="address" placeholder="Address"> -->
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">City
                  <span class="help-block"><?php echo form_error('city'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('city'); ?>" class="row-fluid" name="city" placeholder="City">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">State
                  <span class="help-block"><?php echo form_error('state'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('state'); ?>" class="row-fluid" name="state" placeholder="state">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Zip Code
                  <span class="help-block"><?php echo form_error('zip'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="zip" value="<?php echo set_value('zip'); ?>" placeholder="Zip Code">
                  </div>
                </div>                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Choose Country
                   <span class="help-block"><?php echo form_error('country'); ?></span>
               </label>
                  <div class="controls span9">
                    <select name="country" data-placeholder="Choose Country" class="chzn-select">
                      <option value="">Choose Country</option>
                     <?php $country = get_country_array(); ?>
                      <?php foreach ($country as $key => $value): ?>                  
                      <option value="<?php echo $key ?>" <?php echo set_select('country', $key); ?> ><?php echo $value ?></option>
                      <?php endforeach ?>
                    </select>
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

    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

        	<?php if($this->session->flashdata('success_msg')){ ?>
		    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
			</div>
			<?php } ?>
			<br>

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Profile </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">First Name
                  <span class="help-block"><?php echo form_error('fname'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="fname" value="<?php if(!empty($profile->firstname)) echo $profile->firstname; else  echo set_value('fname'); ?>" placeholder="First Name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Last Name 
                  	<span class="help-block"><?php echo form_error('lname'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="lname" value="<?php if(!empty($profile->lastname)) echo $profile->lastname; else echo set_value('lname'); ?>" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">E-mail 
                    <span class="help-block"><?php echo form_error('email'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="email" value="<?php if(!empty($profile->email)) echo $profile->email; else echo set_value('email'); ?>" placeholder="E-mail">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Mobile 
                    <span class="help-block"><?php echo form_error('mobile'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="mobile" value="<?php if(!empty($profile->mobile)) echo $profile->mobile; else echo set_value('lname'); ?>" placeholder="Mobile no.">
                  </div>
                </div>               
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Addess
                  	<span class="help-block"><?php echo form_error('address'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="address" rows="5" class="row-fluid"><?php if(!empty($profile->address)) echo $profile->address; else echo set_value('address'); ?></textarea>
                    <!-- <input type="text" class="row-fluid" name="address" placeholder="Address"> -->
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">City
                  <span class="help-block"><?php echo form_error('city'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php if(!empty($profile->city)) echo $profile->city; else echo set_value('city'); ?>" class="row-fluid" name="city" placeholder="City">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">State
                  <span class="help-block"><?php echo form_error('state'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php if(!empty($profile->state)) echo $profile->state; else echo set_value('state'); ?>" class="row-fluid" name="state" placeholder="state">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Zip Code
                  <span class="help-block"><?php echo form_error('zip'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="zip" value="<?php if(!empty($profile->zip)) echo $profile->zip; else echo set_value('zip'); ?>" placeholder="Zip Code">
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
                      <option value="<?php echo $key ?>" <?php if($profile->country){ if($profile->country === $key) echo 'selected="selected"'; }?> ><?php echo $value ?></option>
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
<div class="dashcontent" style="margin:0px;">

    <div class="dashbox" style="min-height:340px">

      <div class="clearfloat"></div>

      <div class="dashcontent">

        <div class="dashbox">

    <div id="main_container">

      <?php if($this->session->flashdata('success_msg')){ ?>

		    <div class="alert alert-success">

				<button type="button" class="close" data-dismiss="alert">&times;</button>

				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>

			</div>

			<?php } ?>

            <div class="title">

              <h4> <i class=" icon-user"></i> <span> Profile </span> </h4>

            </div>

            <!-- End .title -->

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

                  <label class="control-label span3" for="hint-field">Phone 

                    <span class="help-block"><?php echo form_error('mobile'); ?></span> 

                  </label>

                  <div class="controls span9">

                    <input type="text" class="row-fluid" name="mobile" value="<?php if(!empty($profile->mobile)) echo $profile->mobile; else echo set_value('lname'); ?>" placeholder="Phone no.">

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

                  <span class="help-block"><?php if(form_error('zip')){echo"<div class='error'>Valid Zip code is required.</div>";} ?></span>

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

                <div class="form-row control-group row-fluid">

                  <label class="control-label span3" for="with-placeholder">                    

                  </label>

                  <div class="controls span9">

                    <button type="submit" class="btn">Submit</button>                    

                  </div>

                </div> 

            <?php echo form_close(); ?>



             </div>

      </div>      

    </div>

  </div>



  <style type="text/css">

  .help-block{

    color: red;

  }

</style>

          
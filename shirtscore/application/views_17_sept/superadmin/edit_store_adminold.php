
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Edit store </span> </h4>
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
                    <input type="text"  class="row-fluid" name="firstname" value="<?php if(!empty($store_admin->firstname)) echo $store_admin->firstname; ?>" placeholder="First Name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Last Name 
                  	<span class="help-block"><?php echo form_error('lastname'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="lastname" value="<?php if(!empty($store_admin->lastname)) echo $store_admin->lastname; ?>" placeholder="Last Name">
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
                    <input type="text" class="row-fluid" name="phone" value="<?php if(!empty($store_admin->mobile)) echo $store_admin->mobile; ?>" placeholder="Mobile no.">
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

    <script type="text/javascript">
  $('#remove_image').click(function(){    
    $('#img').html('');
    $.ajax({
            type: 'POST',            
            url: '<?php echo base_url() ?>superadmin/remove_image/<?php echo $store->id; ?>',
            success: function(data){
                $('#img').hide();
            }
            
        });


  });
</script>
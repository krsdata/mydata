
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

        

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user-md"></i> <span> Edit Design Seller </span> </h4>
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
                    <input type="text"  class="row-fluid" name="firstname" value="<?php if(!empty($design_seller->firstname)) echo $design_seller->firstname; ?>" placeholder="First Name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Last Name 
                    <span class="help-block"><?php echo form_error('lastname'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="lastname" value="<?php if(!empty($design_seller->lastname)) echo $design_seller->lastname; ?>" placeholder="Last Name">
                  </div>
                </div> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Email
                    <span class="help-block"><?php echo form_error('email'); ?></span>
                  </label>
                  <div class="controls span9">
                        <span id="email_field"><input  type="text" class="row-fluid" name="email" value="<?php if(!empty($design_seller->email)) echo $design_seller->email; ?>" placeholder="Email"></span>
                  </div>
                </div>
                <?php /*
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Password
                    <span class="help-block"><?php echo form_error('password'); ?></span>
                  </label>
                  <div class="controls span9">
                    <span id="password_field"><input  type="password"  class="row-fluid" name="password" placeholder="Password"></span>
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
                */  ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Mobile 
                    <span class="help-block"><?php echo form_error('mobile'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="mobile" value="<?php if(!empty($design_seller->mobile)) echo $design_seller->mobile; ?>" placeholder="Mobile no.">
                  </div>
                </div>

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Address
                    <span class="help-block"><?php echo form_error('address'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="address" rows="5" class="row-fluid"><?php if(!empty($design_seller->address)) echo $design_seller->address; else echo set_value('address'); ?></textarea>
                    <!-- <input type="text" class="row-fluid" name="address" placeholder="Address"> -->
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">City
                  <span class="help-block"><?php echo form_error('city'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php if(!empty($design_seller->city)) echo $design_seller->city; else echo set_value('city'); ?>" class="row-fluid" name="city" placeholder="City">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">State
                  <span class="help-block"><?php echo form_error('state'); ?></span>
                </label>
                  <div class="controls span9">

                  <select name="state"  class="form-control" id="default-select">
                          <option value="">Select State</option>
                           <?php if(!empty($state))foreach ($state as $row): ?>
                       <option <?php if($row->state == $design_seller->state ){echo "selected='selected'";} ?> value="<?php echo $row->state; ?>"> <?php echo $row->state; ?></option>
                      <?php endforeach ?>
                    </select>

                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Zip Code
                  <span class="help-block"><?php echo form_error('zip'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="zip" value="<?php if(!empty($design_seller->zip)) echo $design_seller->zip; else echo set_value('zip'); ?>" placeholder="Zip Code">
                  </div>
                </div>                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Choose Country
                   <span class="help-block"><?php echo form_error('country'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" class="form-control" name="country" readonly="" value="USA">
                    <?php echo form_error('country'); ?>
                  </div>
                </div>

                <div class="form-actions row-fluid">
                  <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Submit</button>                    
                  </div>
                </div>
            <?php echo form_close(); ?>

             <div class="form-row control-group row-fluid">
                  <label class="control-label span6" for="with-tooltip"><b>Account Details</b>
                </label>
                </div>  
                <?php if($pay_info){?> 
                <b>Last Update : 
                <?php if($pay_info->payee_type==1)
                echo"Direct Bank Transfer";
                if($pay_info->payee_type==2)
                echo"Paypal email";
              if($pay_info->payee_type==3)
                echo"Cheque via Mail";
               if($pay_info->payee_type==0)
                echo"No account detail submitted by user.";?>
                </b><br><br>
                 <?php if($pay_info->payee_type!=0){?>
                <h2>Direct Bank Transfer</h2>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Bank name
                </label>
                  <div class="controls span9">
                    <?php echo $pay_info->bank_name;?>
                  </div>
                </div> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Account holder
                </label>
                  <div class="controls span9">
                    <?php echo $pay_info->acc_holder;?>
                  </div>
                </div> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Account no.
                </label>
                  <div class="controls span9">
                    <?php echo $pay_info->acc_no;?>
                  </div>
                </div> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Account type
                </label>
                  <div class="controls span9">
                    <?php $info=$pay_info->acc_type;
                    if($info==1)
                      {
                        echo"Saving";
                        }
                        else{
                        echo"Checking";
                          }?> Account
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Routing no.
                </label>
                  <div class="controls span9">
                    <?php echo $pay_info->routing_no;?>
                  </div>
                </div>
                <h2>Paypal</h2>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Paypal email
                </label>
                  <div class="controls span9">
                    <?php echo $pay_info->paypal_email;?>
                  </div>
                </div>
                 <h2>Cheque via Mail</h2>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Full Name
                </label>
                  <div class="controls span9">
                    <?php echo $pay_info->full_name;?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Address
                </label>
                  <div class="controls span9">
                    <?php echo $pay_info->address.' '.$pay_info->city.' '.$pay_info->state.' '.$pay_info->country.' '.$pay_info->zip_code;?>
                  </div>
                </div>
               
                
                <?php }} else{?>

                  <div class="form-row control-group row-fluid">
                  <label class="control-label span8" for="with-tooltip"><b>No Account information fill by user Yet.</b>
                </label></div>
                <?php }?>    

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
  // $('#remove_image').click(function(){    
  //   $('#img').html('');
  //   $.ajax({
  //           type: 'POST',            
  //           url: '<?php //echo base_url() ?>superadmin/remove_image/<?php //echo $store->id; ?>',
  //           success: function(data){
  //               $('#img').hide();
  //           }
            
  //       });


  // });
</script>
 <script type="text/javascript">
    // $(document).ready(function(){
    //   // alert("here");
    //   $('#email_field').hide();

    // });
    // $('#change').click(function(){
    //   $('#email_field').show();
    //   $('#mail').hide();
    // });
    // $(document).ready(function(){
    //   // alert("here");
    //   $('#password_field').hide();

    // });
    // $('#change1').click(function(){
    //   $('#password_field').show();
    //   $('#password').hide();
    // });  
</script>
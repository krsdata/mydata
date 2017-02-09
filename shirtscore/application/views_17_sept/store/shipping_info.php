<div class="container">

	<div class="clearfloat"></div>

	<span class="span12">


		<div class="dashbox">  
    <?php //print_r($_POST); ?>    
			<?php echo form_open(SECURE_SITE_URL.'store/checkout'); ?>
       <div class="row-fluid">
         
         <div class="span6">
       <div class="dashcontent"><h2>BILLING ADDRESS</h2></div>
                <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">First Name</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="billing_name"  value="<?php if (customer_login_in())echo $user_info->firstname; else echo set_value('billing_name');?>">
                        <?php echo form_error('billing_name'); ?> 
                     </div>
                  </div>                                    
               </div>
                <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Last Name</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="billing_last_name" value="<?php if (customer_login_in())echo $user_info->lastname;else echo set_value('billing_last_name'); ?>">
                        <?php echo form_error('billing_last_name'); ?> 
                     </div>
                  </div>                                    
               </div>
               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-12 control-label">E-mail Address <br>
                     </label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="email" value="<?php if (customer_login_in())echo $user_info->email; else echo set_value('email');?>"> <?php echo form_error('email'); ?> 
                     </div>
                  </div>                                    
               </div>
               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-4 control-label">Confirm e-mail address</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="confirm_email" value="<?php if (customer_login_in())echo $user_info->email; else echo set_value('confirm_email');?>">
                       <?php echo form_error('confirm_email'); ?> 
                     </div>
                  </div>                                    
               </div>
               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-4 control-label">Phone Number</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control " name="mobile" value="<?php if (customer_login_in())echo $user_info->mobile; else echo set_value('mobile');?>">
                         <?php if(form_error('mobile')){echo"<div class='error'>Valid mobile number is required.</div>";} ?> 
                     </div>
                  </div>                                    
               </div>
               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Billing Address</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control"  name="billing_address" 
                        value="<?php if (customer_login_in())echo $user_info->address; 
                        else echo set_value('billing_address');?>" />
                       <?php echo form_error('billing_address'); ?>
                     </div>
                  </div>                                    
               </div>

               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">City</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="city" value="<?php if (customer_login_in())echo $user_info->city; else echo set_value('city');?>" > <?php echo form_error('city'); ?> 
                     </div>
                  </div>                                    
               </div>
               
               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">State</label>
                     <div class="col-md-4">
                      <select name="state"  class="form-control" id="default-select">
                          <option value="">Select State</option>
                           <?php if(!empty($state))foreach ($state as $row): ?>
                       <option <?php if (customer_login_in())
                       {if($row->code == $user_info->state){echo "selected='selected'";}} ?> value="<?php echo $row->code; ?>"> <?php echo $row->state; ?></option>
                          <?php endforeach ?>
                        </select>
                        <?php echo form_error('state'); ?> 
                     </div>
                  </div>                                    
               </div>


               <div class="form-body span5">
               <div class="form-group">
                 <label class="col-md-3 control-label">Country</label>
                 <div class="col-md-4">
                   <input type="text" class="form-control" name="country" readonly="" value="USA">
                       </div>
               </div></div>
               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Zip Code </label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="zip_code" value="<?php if (customer_login_in())echo $user_info->zip; else echo set_value('zip_code');?>" /> 
          <?php if(form_error('zip_code')){echo"<div class='error'>Valid Zip code is required.</div>";} ?>

                     </div>
                  </div>                                    
               </div>
               </div>
                <div class="span6">
               <div class="dashcontent"><h2>SHIPPING ADDRESS</h2> 
              </div>
               <div class="row-fluid">
                  <strong> <input type="checkbox" class="what_adrs" <?php if(!empty($_POST['ship_to_billing'])) { echo 'checked="checked"'; }?>name="ship_to_billing">  Ship to different address?</strong>
               <br> 
               </div> 
          <div id="other_info" class="row" style="<?php 
          if(!empty($_POST['ship_to_billing'])) {
          ?> display: block;<?php } else{?>display: none;<?php } ?>">
              <div class=""></div>
              <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Recipient's First Name</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="recipient_name"  value="<?php if (customer_login_in())echo $user_info->firstname; else echo set_value('recipient_name');?>">
                        <?php echo form_error('recipient_name'); ?>
                     </div>
                  </div>                                    
               </div>

               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Recipient's Last Name</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="recipient_last_name"  value="<?php if (customer_login_in())echo $user_info->lastname; else echo set_value('recipient_last_name');?>">
                        <?php echo form_error('recipient_last_name'); ?> 
                     </div>
                  </div>                                    
               </div>
              
               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Delivery Address</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control"  name="delivery_address" value="<?php if (customer_login_in())echo $user_info->address; else echo set_value('delivery_address');?>" />
                        <?php echo form_error('delivery_address'); ?> 
                     </div>
                  </div>                                    
               </div>

               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">City</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="shipping_city2" value="<?php if (customer_login_in())echo $user_info->city; else echo set_value('shipping_city2');?>" > <?php echo form_error('shipping_city2'); ?> 
                     </div>
                  </div>                                    
               </div>
               <div class="form-body span5">
                 <label class="col-md-3 control-label">State</label>
                  <select name="shipping_state2"  class="form-control" id="default-select">
                    <option value="" selected="">Select State</option>
                    <?php 
                    if(!empty($state)){
                     // print_r($state);
                    foreach ($state as $row): ?>

                    <option  <?php if (customer_login_in())
                       {if($row->state == $user_info->state){echo "selected='selected'";}} ?> value="<?php echo $row->state; ?>"> <?php echo $row->state; ?></option>
                    <?php endforeach ?>
                    <?php } ?>
                  </select>
                  <?php echo form_error('shipping_state2'); ?> 
                </div>
               

               <div class="form-body span5">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Zip Code </label>
                     <div class="col-md-4">
                        <input type="text" class="form-control" name="shipping_zip2" value="<?php if (customer_login_in())echo $user_info->zip; else echo set_value('shipping_zip2');?>" /> 
          <?php if(form_error('shipping_zip2')){echo"<div class='error'>Valid Zip code is required.</div>";} ?>

                     </div>
                  </div>                                    
               </div>

               <div class="form-body span5">
               <div class="form-group">
                 <label class="col-md-3 control-label">Country</label>
                 <div class="col-md-4">
                   <input type="text" class="form-control" name="country" readonly="" value="USA">
                       </div>
               </div></div>
           </div>
                 <div class="form-body">
                <div class="form-group">
                     <input type="radio" class="form-control" name="shipping_days" checked="" value="0">
                      <small>Normal Shipping(up to 5 days)</small>
                    <br>
                     <input type="radio" class="form-control" name="shipping_days" value="1">
                     <small>Express Shipping(1 day rush)</small><br>
                </div>
               </div>
               <div class="form-body">
                  <div class="form-group">
                     
                     <div class="col-md-4">
                        <input type="checkbox" class="form-control" name="is_gift" <?php if(!empty($_POST['is_gift'])) { echo 'checked="checked"'; }?>>
                        <i class="icon-gift icon-large"></i>
                        <span> Is this a gift ?  </label>
                     </div>
                  </div>                                    
               </div>
                <div class="form-group">
                     <div class="col-md-12">
                     <label class="col-md-3 control-label">Order Note </label>
                      <textarea name="say_something" class="span10" placeholder="Say something">
                        <?php 
                        if(!empty($_POST['say_something'])) {
                        echo set_value('say_something');
                        }?>
                      </textarea>
                     </div>
                  </div> 
               <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                       <button  id="help_submit" type="submit" class="btn btn-success btn-large" name="continue" value="Continue">Continue</button>
                    </div>
                 </div>
               </div>
               
       </div>
			<?php echo form_close(); ?>
		</div>

</span></div>

<style type="text/css">
		.rht-item{
			text-align: right !important;
		}

	</style>
	<script type="text/javascript">
		jQuery('.update_cart').on('click', function() {
        	error = false;
            jQuery(".qauntity" ).each(function( index ) {
            	if (jQuery(this).val() < 1)
            	{
            		error = true;
            		return false;
            	};
            });
        	if (error)
        	{
        		alert('Quantity for any item cannot be zero');
        		return false;
        	}else{
        		return true;
        	};

          });

	</script>
  <script type="text/javascript">
  jQuery(document).ready(function(){
    if(jQuery(window).width() <= 320)
      jQuery("#paypal_btn").attr('align', 'left');

    jQuery('.what_adrs').on('change',function(){
      var val = jQuery(this).val();
      
        jQuery('#other_info').slideToggle();
     
      // alert(val);
    });
  });
</script>
	<div class="dashcontent">
		<?php if($this->session->flashdata('success_msg')){ ?>
		    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>

			</div>
			<?php } ?>

		<div class="dashbox">
	<div class="dashbox">
		<div class="dashicon">
			&nbsp;<i class="icon-envelope"></i>&nbsp;
		</div>
		<div class="row-fluid">
   		
			
	
		<?php echo form_open(current_url(),array('class'=>'form-horizontal')); ?>
			<h3>Payee Information</h3>
			In order to receive payment for your sales, you must have earned $25 in total sales commissions. Direct deposits are sent every other month. Direct deposits are sent by the 15th day of the following payment months: January, March, May, July, September, and November.<br /><br />
			<?php echo form_open(current_url()); ?>
			      <select name="payee_method"  class="form-control" style="width: initial;">
                    <option value="">Choose Commission Receive Method</option>
                    <option <?php if(!empty($user->payee_type)){
                    if($user->payee_type==1){echo "selected='selected'";}} ?> value="1"> 
                    Direct Bank Transfer
                    </option>
                    <option <?php if(!empty($user->payee_type)){
                    if($user->payee_type==2){echo "selected='selected'";}} ?> value="2">
                    Paypal 
                    </option>
                    <option <?php if(!empty($user->payee_type)){
                    if($user->payee_type==3){echo "selected='selected'";}} ?> value="3"> 
                    Cheque via mail
                    </option>  		 	                      		 
                    </select>
					<input type="hidden" name="payee_type" value="0" >
					<input class=" btn update_cart btn-success" type="submit" name="payee" value="Update Commission Receive Method" />
					<br /><br /> 
					<?php echo form_close(); ?><br />

			<div class="span12">
       		 <div class="well clearfix">
       		

       		<ul class="nav nav-tabs">
			  <li <?php 
			  	if(empty($_POST['payee_type'])){ echo 'class="active"';}
			  	else{
			  if($_POST['payee_type']==1){?> class="active"<?php }}?>

			  ><a href="#Direct" data-toggle="tab" >Direct Bank Transfer</a></li>
			  <li <?php if(!empty($_POST['payee_type']) && $_POST['payee_type']==2){?> class="active"<?php } ?>><a href="#Paypal" data-toggle="tab">Paypal</a></li>
			  <li <?php if(!empty($_POST['payee_type']) && $_POST['payee_type']==3){?> class="active"<?php } ?>><a href="#Cheque" data-toggle="tab">Cheque via mail</a></li>
			</ul>

				<div class="tab-content">
				<div id="Direct" 	
				<?php 
				if(empty($_POST['payee_type'])) { echo'class="tab-pane active"'; }
				else{						
					 if($_POST['payee_type']==1)
					 	{ echo'class="tab-pane active"'; }
					 else
						 { echo'class="tab-pane"'; } }?>>

				<?php echo form_open(current_url(),array('class'=>'form-horizontal')); ?> 
					<strong>Bank Name</strong> <br /><input class="span8" type="text" name="bank_name" size="50" value="<?php if(!empty($user->bank_name)){echo $user->bank_name;} else{ echo set_value('bank_name'); }?>" />
					<span class="input-error"><?php echo form_error('bank_name'); ?></span>
					<br /><br />

					<strong>Account Holder Name</strong> <br /><input class="span8" type="text" name="acc_holder" value="<?php if(!empty($user->acc_holder)){echo $user->acc_holder;} else{ echo set_value('acc_holder'); } ?>" size="50" />
					<span class="input-error"><?php echo form_error('acc_holder'); ?></span>
					<br /><br />

					<strong>Account Number</strong> <br />
					<input class="span8" type="text" name="acc_no" size="50" value="<?php if(!empty($user->acc_no)){echo $user->acc_no;} else{ echo set_value('acc_no'); }?>" />
					<span class="input-error"><?php echo form_error('acc_no'); ?></span>
					<br /><br />

					<strong>Account Type</strong> <br />
					<input name="acc_type" value="1" <?php if(!empty($user->acc_type)){if($user->acc_type == 1){echo"checked";}} ?> type="radio" /> Savings  &nbsp;&nbsp;
					<input name="acc_type" value="2" <?php if(!empty($user->acc_type)){if($user->acc_type == 2){echo"checked";}} ?> type="radio" /> Checking 
					<span class="input-error"><?php echo form_error('acc_type'); ?></span>
					<br /><br />

					<strong>Routing Number</strong> <br />
					<input class="span8" type="text" name="routing_no" value="<?php if(!empty($user->routing_no)){echo $user->routing_no;} else{ echo set_value('routing_no'); }?>" size="50" />
					<span class="input-error"><?php echo form_error('routing_no'); ?></span>
					<br />
					<input type="hidden" name="payee_type" value="1" >
					<br><input class=" btn update_cart btn-success" type="submit" name="payee" value="Update Account Details" />
					<br /><br />
					<?php echo form_close(); ?>
				</div>

				<div id="Paypal" <?php if(!empty($_POST['payee_type']) && $_POST['payee_type']==2){?> class="tab-pane active"<?php }else{ echo 'class="tab-pane"'; } ?>>
				<?php echo form_open(current_url()); ?>	
					<br /><strong>Paypal email</strong> <br /><input class="span8" type="text" name="paypal_email" size="50" value="<?php if(!empty($user->paypal_email)){echo $user->paypal_email;} else{ echo set_value('paypal_email'); }?>" />
					<span class="input-error"><?php echo form_error('paypal_email'); ?></span>
					<br />
					<input type="hidden" name="payee_type" value="2" >
					<br><input class=" btn update_cart btn-success" type="submit" name="payee" value="Update Paypal Details" />
					<br /><br /> 
					<?php echo form_close(); ?>
				</div>

				<div id="Cheque" <?php if(!empty($_POST['payee_type']) && $_POST['payee_type']==3){?> class="tab-pane active"<?php }else{ echo 'class="tab-pane"'; }?>>
				<?php echo form_open(current_url(),array('class'=>'form-horizontal')); ?>					
					<strong>Full Name</strong> <br/><input name="name" class="span8" type="text" value="<?php if(!empty($user->full_name)){echo $user->full_name;} else{ echo set_value('name'); } ?>" /> 
					<?php echo form_error('name') ?>
					<br><br />

					<strong>Address</strong><br/><textarea name="address" rows="1" class="row-fluid span8"><?php if(!empty($user->address)) echo $user->address; else echo set_value('address'); ?></textarea><?php echo form_error('address'); ?><br/><br />

					<strong>City</strong><br/><input name="city" type="text" class="span8"  value="<?php if(!empty($user->city)){echo $user->city;}  else{ echo set_value('city'); }?>" /><?php echo form_error('city'); ?><br/><br />

					<strong>State</strong><br/>
			    	<select name="state"  class="form-control" id="default-select">
                          <option value="">Select State</option>
                           <?php if(!empty($state))foreach ($state as $row): ?>
                       
                       <option <?php if(!empty($user->state)){if($row->state == $user->state ){echo "selected='selected'";}} ?> value="<?php echo $row->state; ?>"> <?php echo $row->state; ?></option>

                      <?php endforeach ?>
                    </select>
                	<?php echo form_error('state'); ?><br/><br />

                	<strong>Country</strong>  <br/>
					<input type="text" class="form-control" name="country" readonly="" value="USA">
					<?php echo form_error('country'); ?><br/><br />

					<strong>Zip Code</strong><br/><input class="span4" name="zip" type="text"  value="<?php if(!empty($user->zip_code)){echo $user->zip_code;} else{ echo set_value('zip'); } ?>" /> <?php if(form_error('zip')){echo"<div class='error'>Valid Zip code is required.</div>";} ?><br/><br />


					<input type="hidden" name="payee_type" value="3" >
					<input class=" btn update_cart btn-success" type="submit" name="payee" value="Update Cheque Details"/>
					
					<br /><br />
					<?php echo form_close(); ?>
				</div></div>
			
			</div></div>
			<hr color="3b5998" />
	</div>
</div>
</div>
</div>



<script>
$(document).ready(function () {
 $('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
})

</script>

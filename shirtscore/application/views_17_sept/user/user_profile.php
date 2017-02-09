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
   		<div class="span12">
		<?php echo form_open(current_url(),array('class'=>'form-horizontal')); ?>
			<h2>My Profile</h2>
			<hr color="#ccc" />
			<h3>Contact Information</h3>
			We will use this information to keep you informed about your ShirtScore store.<br /><br />
			<div class="span12">
       		 <div class="well clearfix">
			
         <div class="span6">
        </div>
         <div class="span6">
        </div>

			<div class="span5">
				<strong>First Name</strong> <br/><input name="firstname" class="span8" type="text" value="<?php if(!empty($user->firstname)){echo $user->firstname;} ?>" /> 
				<?php echo form_error('firstname') ?><br/><br/>

			</div>			
			<div class="span5">
				<strong>Last Name</strong><br/>
				<input  name="lastname" type="text" class="span8"  value="<?php if(!empty($user->lastname)){echo $user->lastname;} ?>" />
				<?php echo form_error('lastname'); ?><br/><br/>
			</div>			
				
			<div class="span5">
				<strong>Email Address</strong><br/>
				<input class="span8" name="email" type="text" size="50" value="<?php if(!empty($user->email)){echo $user->email;}?>" /><?php echo form_error('email'); ?><br/><br/>
			</div>
				
			<div class="span5">
					<strong>Phone Number</strong><br /><input name="mobile" type="text" class="span8"  value="<?php if(!empty($user->mobile)){echo $user->mobile;} ?>" /><?php echo form_error('mobile'); ?><br/><br/>
			</div>

			<div class="span5">
			   <strong>Address</strong><br/><textarea name="address" rows="1" class="row-fluid span8"><?php if(!empty($user->address)) echo $user->address; else echo set_value('address'); ?></textarea><?php echo form_error('address'); ?><br/><br/>
			</div>

			<div class="span5">
			       <strong>City</strong><br/><input name="city" type="text" class="span8"  value="<?php if(!empty($user->city)){echo $user->city;} ?>" /><?php echo form_error('city'); ?><br/><br/>
			</div>

			<div class="span5">
			    <strong>State</strong><br/><input class="span8" name="state" type="text"  value="<?php if(!empty($user->state)){echo $user->state;} ?>" /><?php echo form_error('state'); ?><br/><br/>
			</div>

			

			<div class="span5">
					<strong>Country</strong>  <br/>

					<select name="country" data-placeholder="Choose Country" class="chzn-select">
					<option value="">Choose Country</option>
					<?php $country = get_country_array(); ?>
					<?php foreach ($country as $key => $value): ?>                  
					<option value="<?php echo $key ?>" <?php if($user->country){ if($user->country === $key) echo 'selected="selected"'; }?> ><?php echo $value ?></option>
					<?php endforeach ?>
					</select><?php echo form_error('country'); ?><br/><br/>

        	</div>
        	<div class="span10">
				<strong>Zip Code</strong><br/><input class="span4" name="zip" type="text"  value="<?php if(!empty($user->zip)){echo $user->zip;} ?>" /><?php if(form_error('zip')){echo"<div class='error'>Valid Zip code is required.</div>";} ?><br/><br/>
			</div>
			<div class="span10">
				<strong>Change Password</strong><br/>
				(at least 6 characters)<br /><br/>
			</div>
			<div class="span5">
				
				<strong>Old Password</strong> <br><input class="span8" name="old_pass" type="password"  value="" /><br/><br/></div>
			<div class="span5">	
			<strong>New Password</strong><br>
			
			<input class="span8" name="new_pass" type="password"  value="" />
			<?php echo form_error('old_pass')."".form_error('new_pass'); ?><br/><br/>
			</div>
			<div class="span5">
			<input type="submit" name="profile" value="Update Profile" class=" btn btn-success"/>
			</div>
			</div>
			<hr color="#ccc" />
		<?php echo form_close(); ?>
		
	</div>

</div>

</div>
</div>


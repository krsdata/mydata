<section id="page_content" class="register_content">
	<div class="container containBackWhite top_buffer_60 bottom_buffer_60">
		<div class="row pageHeadRow">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<p class="pageHead">Sign-up</p>
			</div>
		</div>
		<div class="row rowContent">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<p class="section_heading">Get the latest news in your inbox</p>
				<form role="form" action="<?php echo base_url('website/registration');?>" method="post" name="register_form">
			  		<div class="form-group">
			    		<label for="fname">First Name <span class="form_carot">*</span></label>
			    		<input type="text" class="form-control" id="fname" name="fname">
			  		</div>
			  		<div class="form-group">
			    		<label for="lname">Last Name <span class="form_carot">*</span></label>
			    		<input type="text" class="form-control" id="lname" name="lname">
			  		</div>	
			  		<div class="form-group">
			    		<label for="abn">ABN <span class="form_carot">*</span></label>
			    		<input type="text" class="form-control" id="abn" name="abn">
			  		</div>			  				 			  		 		
			  		<div class="form-group">
			    		<label for="email">Email address <span class="form_carot">*</span></label>
			    		<input type="email" class="form-control" id="email" name="email">
			  		</div>
			  		<div class="form-group">
			    		<label for="pwd">Password <span class="form_carot">*</span></label>
			    		<input type="password" class="form-control" id="pwd" name="pwd">
			  		</div>
			  		<div class="form-group">
			    		<label for="cpwd">Confirm Password <span class="form_carot">*</span></label>
			    		<input type="password" class="form-control" id="cpwd" name="cpwd">
			  		</div>				  		
				    <div class="checkbox">
				        <label><input type="checkbox" name="check_term">I accepts all <a href="terms.php" target="_blank">Term & Conditions</a></label>
				    </div>			  				  				  		
			  		<button type="submit" class="btn btn_pink pull-right">Create new Account <i class="fa fa-angle-right"></i></button>
				</form>				
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
			
			</div>			
		</div>	
	</div>
</section>



<?php //echo form_open(); ?> 
	<!-- <div class="form-body">
		<div class="form-group">
			<label class="col-md-3 control-label">First  Name</label>
			<div class="col-md-9">
				<input value="" name="first_name" type="text" placeholder="Enter Firsts Name" class="form-control">
			    <?php //echo form_error('first_name'); ?> 
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Last  Name</label>
			<div class="col-md-9">
				<input value="" name="last_name" type="text" placeholder="Enter Last Name" class="form-control">
			    <?php //echo form_error('last_name'); ?> 
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Email</label>
			<div class="col-md-9">
				<input value="" name="email" type="text" placeholder="Enter Email" class="form-control">
			    <?php //echo form_error('email'); ?> 
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Password</label>
			<div class="col-md-9">
				<input value="" name="password" type="password" placeholder="Enter Tag Name" class="form-control">
			    <?php //echo form_error('password'); ?> 
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Retype Password</label>
			<div class="col-md-9">
				<input value="" name="retypepassword" type="password" placeholder="Enter Retype Password" class="form-control">
			    <?php //echo form_error('retypepassword'); ?> 
			</div>
		</div>
		
	   									
		
	</div>
	<div class="form-actions">
		<div class="row">
			<div class="col-md-offset-3 col-md-9">
			<input class="btn green" type="submit" name="submit" value="submit">
			 
			</div>
		</div>
	</div> -->
<?php //echo form_close(); ?>
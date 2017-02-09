<section id="page_content" class="login_content">
	<div class="container containBackWhite top_buffer_60 bottom_buffer_60">
		<div class="row pageHeadRow">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<p class="pageHead">Distributor Login</p>
			</div>
		</div>
		<div class="row rowContent">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<p class="section_heading">Login to your account</p>
				<?php  echo msg_alert_frontend(); ?>
				<form role="form" action="<?php echo base_url('distributor/login')?>" method="post" name="login_form" class="top_buffer_20 login_form">
			  		<div class="form-group">
			    		<label for="email">Email address <span class="form_carot">*</span></label>
			    		<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
			    		<?php echo form_error('email')?>
			  		</div>
			  		<div class="form-group">
			    		<label for="pwd">Password <span class="form_carot">*</span></label>
			    		<input type="password" class="form-control" id="pwd" name="pwd">
			    		<?php echo form_error('pwd')?>
			  		</div>
			  		<button type="submit" class="btn btn_pink">Submit</button>
			  		<a href="<?php echo base_url('distributor/forget_password')?>" class="pull-right forgot_pw_link"><i>Forgot Password</i></a>
				</form>				
			</div>
			<!-- <div class="col-xs-12 col-sm-6 col-md-6">
				<p class="section_heading">Sign-up Now!</p>
				<p class="section_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi blandit 
				velit eu suscipit rutrum. Mauris elementum vitae felis nec dapibus. Suspendisse rhoncus tellus 
				nibh. Fusce id nulla risus.</p>
				<p class="top_buffer_20"><a href="<?php //echo base_url('website/registration')?>" class="btn btn_pink">Sign-up <i class="fa fa-angle-right"></i></a></p>
			</div> -->			
		</div>	
	</div>
</section>

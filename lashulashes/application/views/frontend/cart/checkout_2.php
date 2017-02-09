<section id="page_content" class="bilship_content">
	<div class="container">
		<div class="row bilship_row1 margin_top_40">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<p class="page_head margin_cutter">Contact Detail</p>
			</div>
		</div>
		<?php  echo msg_alert_frontend(); ?>
		<form role="form" action="" method="post" name="bilship_form">
			<div class="bilship_row2 row_gap">
				<div class="row">
					<div class="col-md-6">								  		
				  		<div class="form-group">
				    		<label for="firs_tname">First Name <label class="form_carot">*</label></label>
				    		<input type="text" placeholder="First Name*" class="form-control b_input_change" id="first_name" name="first_name" value="<?php if(!empty($user_detail->first_name)) { echo $user_detail->first_name; } else { echo set_value('first_name');} ?>" >
				    		<?php echo form_error('first_name'); ?>
				  		</div>
				  	</div>
				  	<div class="col-md-6">
				  		<div class="form-group">
				    		<label for="last_name">Last Name <label class="form_carot">*</label></label>
				    		<input type="text" placeholder="Last Name*" class="form-control b_input_change" id="last_name" name="last_name" value="<?php if(!empty($user_detail->last_name)) { echo $user_detail->last_name; } else { echo set_value('last_name'); } ?>" >
				    		<?php echo form_error('last_name'); ?>
				  		</div>
				  	</div>
				</div>
				<div class="row">
				  	<div class="col-md-6">
				  		<div class="form-group">
				    		<label for="email">Email address <label class="form_carot">*</label></label>
				    		<input type="email" placeholder="Email Address*" class="form-control b_input_change" id="email" name="email" value="<?php if(!empty($user_detail->email)) { echo $user_detail->email; } else { echo set_value('email'); } ?>">
				    		<?php echo form_error('email'); ?>
				  		</div>
				  	</div>
				  	<div class="col-md-6">
				  		<div class="form-group">
				  			<label for="contact">Contact Number <label class="form_carot">*</label></label>
				  			<input type="text" data-inputmask="'mask': '9999999999'"  placeholder="Contact Number*" class="form-control b_input_change" id="contact" name="contact" value="<?php if(!empty($user_detail->mobile)) { echo $user_detail->mobile; } else { echo set_value('contact'); } ?>">
				  			<!-- <p class="section_text_small">Example: (333) 333-3333</p> -->
				  			<?php echo form_error('contact'); ?>
				  		</div>
				  	</div>	
				</div>		
			</div>
			<div class="row bilship_row2 row_gap">
				<div class="col-md-12">
					<button type="submit" class="btn btn_pink pull-right">Next</button>
				</div>
			</div>
		</form>	
	</div>
</section>
<script>
        window.onload = function() {
                $("form").bind("keypress", function(e) {
                    if (e.keyCode == 13) {
                        return false;
                    }
                });
            }
</script>
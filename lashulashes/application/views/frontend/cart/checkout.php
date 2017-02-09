<section id="page_content" class="bilship_content">
	<div class="container">
		<div class="row bilship_row1 margin_top_40">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<p class="page_head margin_cutter">Billing & Shipping</p>
			</div>
		</div>
		<div class="row margin_top_40" id="error_message">
		<?php  echo msg_alert_frontend(); ?>
		</div>
		<form role="form" action="<?php echo base_url('cart/checkout')?>" method="post" name="bilship_form">
			<!-- <p class="section_text">Your billing address must match the address associated with the credit card you use</p> -->
			<div class="row bilship_row2 row_gap">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<h3 class="section_heading margin_top_0">Billing Address</h3>
			  		
			  		<div class="form-group">
			    		<label for="firs_tname">First Name <span class="form_carot">*</span></label>
			    		<input type="text" class="form-control b_input_change" id="first_name" name="first_name" value="<?php if(!empty($user_detail->first_name)) { echo $user_detail->first_name; } else { echo set_value('first_name');} ?>" >
			    		<?php echo form_error('first_name'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="last_name">Last Name <span class="form_carot">*</span></label>
			    		<input type="type" class="form-control b_input_change" id="last_name" name="last_name" value="<?php if(!empty($user_detail->last_name)) { echo $user_detail->last_name; } else { echo set_value('last_name'); } ?>" >
			    		<?php echo form_error('last_name'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="email">Email address</label>
			    		<input type="email" class="form-control b_input_change" disabled id="email" name="email" value="<?php if(!empty($user_detail->email)) { echo $user_detail->email; } else { echo set_value('email'); } ?>">
			    		<?php echo form_error('email'); ?>
			  		</div>
			  		<div class="form-group">
			  			<label for="address">Address <span class="form_carot">*</span></label>
			  			<input type="text" class="form-control b_input_change" id="address" name="address" value="<?php if(!empty($user_detail->address)) { echo $user_detail->address; } else { echo set_value('address'); } ?>" >
			  			<?php echo form_error('address'); ?>
			  		</div>
			  		
			  		<div class="form-group">
			  			<label for="zip">Postal Code <span class="form_carot">*</span></label>
			  			<input type="text" data-inputmask="'mask': '9999'"  class="form-control b_input_change" id="zip" name="zip" value="<?php if(!empty($user_detail->zip)) { echo $user_detail->zip; } else { echo set_value('zip'); } ?>">
			  			<?php echo form_error('zip'); ?>
			  		</div>
			  	
			  		<div class="form-group">
						<label for="state">State<samll class="form_carot">*</samll></label>
						<?php $aus_state = get_aus_states(); ?>
						<select name="state" class="form-control b_input_change" id="state">
							<option value="">Select State</option>
							<?php if($aus_state) 
								{?>
								<?php foreach ($aus_state as $aus_state_row) { ?>
									<option value="<?php echo $aus_state_row->state_code;?>" <?php if($user_detail->state == $aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
								<?php } ?>
							<?php } ?>
						</select>
					    <?php echo form_error('state'); ?> 									
					</div>
			  		<div class="form-group">
			  			<label for="city">City <span class="form_carot">*</span></label>
			  			<input type="text" class="form-control b_input_change" id="change_city" name="city" value="<?php if(!empty($user_detail->city)) { echo $user_detail->city; } else { echo set_value('city'); } ?>">
			  			<?php echo form_error('city'); ?>
			  		</div>			
			  		
			  		<div class="form-group">
			  			<label for="mobile">Phone No. <span class="form_carot">*</span></label>
			  			<input type="text" data-inputmask="'mask': '9999999999'"  class="form-control b_input_change" id="mobile" name="mobile" value="<?php if(!empty($user_detail->mobile)) { echo $user_detail->mobile; } else { echo set_value('mobile'); } ?>">
			  			<!-- <p class="section_text_small">Example: (333) 333-3333</p> -->
			  			<?php echo form_error('mobile'); ?>
			  		</div>
					<div class="checkbox">
				        <label><input type="checkbox" style="display: block;" name='shipping' value="1" <?php if($user_detail->shipping || isset($_POST['shipping'])) echo 'checked';?> id="use_billing_address">Use Billing Information for Shipping Address</label>
				    </div>	
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<h3 class="section_heading margin_top_0">Shipping Address</h3>
			  		<div class="form-group">
			    		<label for="s_firs_tname">First Name <span class="form_carot">*</span></label>
			    		<input type="text" class="form-control s_input_change" id="s_first_name" name="s_first_name" value="<?php if(!empty($user_detail->s_first_name)) { echo $user_detail->s_first_name; } else { echo set_value('s_first_name');} ?>" >
			    		<?php echo form_error('s_first_name'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="s_last_name">Last Name <span class="form_carot">*</span></label>
			    		<input type="type" class="form-control s_input_change" id="s_last_name" name="s_last_name" value="<?php if(!empty($user_detail->s_last_name)) { echo $user_detail->s_last_name; } else { echo set_value('s_last_name'); } ?>" >
			    		<?php echo form_error('s_last_name'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="s_email">Email address <span class="form_carot">*</span></label>
			    		<input type="email" class="form-control s_input_change" id="s_email" name="s_email" value="<?php if(!empty($user_detail->s_email)) { echo $user_detail->s_email; } else { echo set_value('s_email'); } ?>">
			    		<?php echo form_error('s_email'); ?>
			  		</div>
			  		<div class="form-group">
			  			<label for="s_address">Address <span class="form_carot">*</span></label>
			  			<input type="text" class="form-control s_input_change" id="s_address" name="s_address" value="<?php if(!empty($user_detail->s_address)) { echo $user_detail->s_address; } else { echo set_value('s_address'); } ?>" >
			  			<?php echo form_error('s_address'); ?>
			  		</div>
			  		<div class="form-group">
			  			<label for="s_zip">Postal Code <span class="form_carot">*</span></label>
			  			<input type="text" data-inputmask="'mask': '9999'"  class="form-control s_input_change" id="s_zip" name="s_zip" value="<?php if(!empty($user_detail->s_zip)) { echo $user_detail->s_zip; } else { echo set_value('s_zip'); } ?>">
			  			<?php echo form_error('s_zip'); ?>
			  		</div>
			  
			  		<div class="form-group">
						<label for="s_state">State<samll class="form_carot">*</samll></label>
						<?php $aus_state = get_aus_states(); ?>
						<select name="s_state" class="form-control s_input_change" id="state2">
							<option value="">Select State</option>
							<?php if($aus_state) 
								{?>
								<?php foreach ($aus_state as $aus_state_row) { ?>
									<option value="<?php echo $aus_state_row->state_code;?>" <?php if(!empty($user_detail->s_state) && $user_detail->s_state == $aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
								<?php } ?>
							<?php } ?>
						</select>
					    <?php echo form_error('s_state'); ?> 									
					</div>

			  		<div class="form-group">
			  			<label for="s_city">City <span class="form_carot">*</span></label>
			  			<input type="text" class="form-control s_input_change" id="change_city2" name="s_city" value="<?php if(!empty($user_detail->s_city)) { echo $user_detail->s_city; } else { echo set_value('s_city'); } ?>">
			  			<?php echo form_error('s_city'); ?>
			  		</div>

			  		<div class="form-group">
			  			<label for="s_mobile">Phone No. <span class="form_carot">*</span></label>
			  			<input type="text" data-inputmask="'mask':'9999999999'"  class="form-control s_input_change" id="s_mobile" name="s_mobile" value="<?php if(!empty($user_detail->s_mobile)) { echo $user_detail->s_mobile; } else { echo set_value('s_mobile'); } ?>">
			  			<!-- <p class="section_text_small">Example: (333) 333-3333</p> -->
			  			<?php echo form_error('s_mobile'); ?>
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
	
	$("#use_billing_address").click(function(event) {
		
		var chk = 0;
		if($(this).prop("checked") == true)
		{
            chk = 1;
        }
        if(chk)
        {
        	$("#s_first_name").val($("#first_name").val());
        	$("#s_last_name").val($("#last_name").val());
        	$("#s_email").val($("#email").val());
        	$("#s_address").val($("#address").val());
        	$("#s_zip").val($("#zip").val());
        	$("#s_mobile").val($("#mobile").val());

        	var temp_state = $("#state").val();
        	$("#state2 option[value='"+temp_state+"']").prop('selected', true);

            $("#change_city2").val($("#change_city").val());

        	$("#use_billing_address").prop("checked", true);

        }
        else
        {	
        	$("#s_first_name").val('');
        	$("#s_last_name").val('');
        	$("#s_email").val('');
        	$("#s_address").val('');
        	$("#state2").val('');
        	$("#change_city2").val('');
        	$("#s_zip").val('');
        	$("#s_mobile").val('');

        }
	});

	$('.s_input_change, .b_input_change').change(function(event) {
		$("#use_billing_address").prop("checked","");
	});

</script>
<script>
        window.onload = function() {
                $("form").bind("keypress", function(e) {
                    if (e.keyCode == 13) {
                        return false;
                    }
                });
            }
</script>

<script type="text/javascript">

	$("#zip").keyup( function(){
		var post = $("#zip").val(); 
		post = post.replace(/_/g,'');
		if(post.length==4)
		{
			$.post('<?php echo base_url("./website/validate_postcode"); ?>',
					{code:post},
					function(data){
						//alert(data.status);
						if(data.status)
						{
							$("#change_city").val(data.city);
							$("#state option[value='"+data.state+"']").prop('selected', true);
						}
						else
						{
							$("#zip").val('');

							var message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i> Please enter valid Postal Code. </div>';
							$("#error_message").html(message);
						}
					});
		}
	});

	$("#s_zip").keyup( function(){
		var post = $("#s_zip").val(); 
		post = post.replace(/_/g,'');
		if(post.length==4)
		{
			$.post('<?php echo base_url("./website/validate_postcode"); ?>',
					{code:post},
					function(data){
						//alert(data.status);
						if(data.status)
						{
							$("#change_city2").val(data.city);
							$("#state2 option[value='"+data.state+"']").prop('selected', true);
						}
						else
						{
							$("#s_zip").val('');

							var message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i> Please enter valid Postal Code. </div>';
							$("#error_message").html(message);
						}
					});
		}
	});

</script>
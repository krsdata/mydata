<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">				
			
			<div class="clearfix">
			</div>
		
            <div class="row">
  			
           	<div class="col-md-12 ">
                 
                 <?php if($this->session->flashdata('message')){ ?>
                <div class="note note-success">						<p>
							 <?php echo $this->session->flashdata('message');  ?>
						</p>
					</div>
                   <?php } ?> 

					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>
								Add User
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<h3>Billing Address</h3><hr>
									  		
									  		<div class="form-group">
									    		<label for="firs_tname" class="col-md-3 control-label">First Name <span class="error">*</span></label>
									    		<div class="col-md-9">
										    		<input type="text" class="form-control b_input_change" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>" placeholder="Enter First Name" >
										    		<?php echo form_error('first_name'); ?>
										    	</div>
									  		</div>
									  		<div class="form-group">
									    		<label class="col-md-3 control-label"  for="last_name">Last Name <span class="error">*</span></label>
									    		<div class="col-md-9">
									    			<input type="type" class="form-control b_input_change" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>" placeholder="Enter Last Name">
									    			<?php echo form_error('last_name'); ?>
									    		</div>
									  		</div>
									  		<div class="form-group">
									    		<label class="col-md-3 control-label"  for="email">Email address <span class="error">*</span></label>
												<div class="col-md-9">
										    		<input type="email" class="form-control b_input_change" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter User Email">
										    		<?php echo form_error('email'); ?>
												</div>
									  		</div>
									  		<div class="form-group">
									  			<label class="col-md-3 control-label" for="address">Address <span class="error">*</span></label>
									  			<div class="col-md-9">
										  			<input type="text" class="form-control b_input_change" id="address" name="address" value="<?php echo set_value('address'); ?>" placeholder="Enter User Address">
										  			<?php echo form_error('address'); ?>
										  		</div>
									  		</div>
									  		<div class="form-group">
												<label class="col-md-3 control-label" for="state">State<samll class="error">*</samll></label>
												<div class="col-md-9">
													<?php $aus_state = get_aus_states(); ?>
													<select name="state" class="form-control b_input_change" id="change_state">
														<option value="">Select State</option>
														<?php if($aus_state) 
															{?>
															<?php foreach ($aus_state as $aus_state_row) { ?>
																<option value="<?php echo $aus_state_row->state_code;?>" <?php if(set_value('state') == $aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
															<?php } ?>
														<?php } ?>
													</select>
												    <?php echo form_error('state'); ?> 
												</div>								
											</div>
									  		<div class="form-group">
												<label class="col-md-3 control-label" for="city">City<span class="error">*</span></label>
												<div class="col-md-9">
													<?php $aus_cities = get_aus_cities(set_value('state')); ?>
													<select name="city" class="form-control b_input_change" id="change_city">
														<option value="">Select City</option>
														<?php foreach ($aus_cities as $aus_cities_row) { ?>
															<option value="<?php echo $aus_cities_row->city_name;?>" <?php if(set_value('city') ==$aus_cities_row->city_name) echo "selected"; ?> ><?php echo $aus_cities_row->city_name;?></option>
														<?php }?>
													</select>
												    <?php echo form_error('city'); ?>
												</div>
											</div>
									  		<div class="form-group">
									  			<label  class="col-md-3 control-label" for="zip">Postal Code <span class="error">*</span></label>
									  			<div class="col-md-9">
										  			<input data-inputmask="'mask':'9999'" type="text" class="form-control b_input_change" id="zip" name="zip" value="<?php echo set_value('zip'); ?>" placeholder="Enter Postal Code">
										  			<?php echo form_error('zip'); ?>
										  		</div>
									  		</div>
									  		<div class="form-group">
									  			<label class="col-md-3 control-label" for="mobile">Phone No. <span class="error">*</span></label>
									  			<div class="col-md-9">
										  			<input data-inputmask="'mask':'9999999999'" type="text" class="form-control b_input_change" id="mobile" name="mobile" value="<?php echo set_value('mobile'); ?>" placeholder="Enter Phone Number">
										  			<?php echo form_error('mobile'); ?>
										  		</div>
									  		</div>
									  		<div class="form-group">
												<div class="col-md-12">
											        <input type="checkbox" name='shipping' value="1" <?php if(set_value('shipping')) echo 'checked';?> id="use_billing_address"><label>Use Billing Information for Shipping Address</label>
											    </div>
											</div>
											
										</div>
										<div class="col-md-6">
											<h3>Shipping Address</h3><hr>
									  		<div class="form-group">
									    		<label class="col-md-3 control-label" for="s_firs_tname">First Name <span class="error">*</span></label>
									    		<div class="col-md-9">
										    		<input type="text" class="form-control s_input_change" id="s_first_name" name="s_first_name" value="<?php echo set_value('s_first_name'); ?>" placeholder="Enter First Name" >
										    		<?php echo form_error('s_first_name'); ?>
										    	</div>
									  		</div>
									  		<div class="form-group">
									    		<label class="col-md-3 control-label"  for="s_last_name">Last Name <span class="error">*</span></label>
									    		<div class="col-md-9">
										    		<input type="type" class="form-control s_input_change" id="s_last_name" name="s_last_name" value="<?php echo set_value('s_last_name'); ?>" placeholder="Enter Last Name">
										    		<?php echo form_error('s_last_name'); ?>
										    	</div>
									  		</div>
									  		<div class="form-group">
									    		<label class="col-md-3 control-label" for="s_email">Email address <span class="error">*</span></label>
									    		<div class="col-md-9">
										    		<input type="email" class="form-control s_input_change" id="s_email" name="s_email" value="<?php echo set_value('s_email'); ?>" placeholder="Enter Email">
										    		<?php echo form_error('s_email'); ?>
										    	</div>
									  		</div>
									  		<div class="form-group">
									  			<label class="col-md-3 control-label" for="s_address">Address <span class="error">*</span></label>
									  			<div class="col-md-9">
										  			<input type="text" class="form-control s_input_change" id="s_address" name="s_address" value="<?php echo set_value('s_address'); ?>" placeholder="Enter Shipping Address">
										  			<?php echo form_error('s_address'); ?>
										  		</div>
									  		</div>
									  		<div class="form-group">
												<label  class="col-md-3 control-label" for="s_state">State<samll class="error">*</samll></label>
												<div class="col-md-9">
													<?php $aus_state = get_aus_states(); ?>
													<select name="s_state" class="form-control s_input_change" id="change_state2">
														<option value="">Select State</option>
														<?php if($aus_state) 
															{?>
															<?php foreach ($aus_state as $aus_state_row) { ?>
																<option value="<?php echo $aus_state_row->state_code;?>" <?php if(set_value('s_state') == $aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
															<?php } ?>
														<?php } ?>
													</select>
												    <?php echo form_error('s_state'); ?>
												</div>									
											</div>

									  		<div class="form-group">
												<label class="col-md-3 control-label" for="city">City<span class="error">*</span></label>
												<div class="col-md-9">
													<?php $aus_cities = get_aus_cities(set_value('s_state')); ?>
													<select name="s_city" class="form-control s_input_change" id="change_city2">
														<option value="">Select City</option>
														<?php foreach ($aus_cities as $aus_cities_row) { ?>
															<option value="<?php echo $aus_cities_row->city_name;?>" <?php if(set_value('s_city') ==$aus_cities_row->city_name) echo "selected"; ?> ><?php echo $aus_cities_row->city_name;?></option>
														<?php }?>
													</select>
												    <?php echo form_error('s_city'); ?>
												</div>
											</div>

									  		<div class="form-group">
									  			<label class="col-md-3 control-label" for="s_zip">Postal Code <span class="error">*</span></label>
									  			<div class="col-md-9">
											  			<input data-inputmask="'mask':'9999'" type="text" class="form-control s_input_change" id="s_zip" name="s_zip" value="<?php echo set_value('s_zip'); ?>" placeholder="Enter Postal Code">
											  			<?php echo form_error('s_zip'); ?>
											  	</div>
									  		</div>

									  		<div class="form-group">
									  			<label class="col-md-3 control-label" for="s_mobile">Phone No. <span class="error">*</span></label>
									  			<div class="col-md-9">
										  			<input data-inputmask="'mask':'9999999999'" type="text" class="form-control s_input_change" id="s_mobile" name="s_mobile" value="<?php echo set_value('s_mobile'); ?>" placeholder="Enter Phone Number">
										  			<!-- <p class="section_text_small">Example: (333) 333-3333</p> -->
										  			<?php echo form_error('s_mobile'); ?>
										  		</div>
									  		</div>
										</div>			
									</div>
									<hr>
									<div class="row">
										
										<div class="form-group">
											<label class="col-md-2 control-label">Password<samll class="error">*</samll></label>
											<div class="col-md-6">
												<input value="" name="password" type="password" placeholder="Enter User password" class="form-control">
											    <?php echo form_error('password'); ?> 
											</div>
										</div>
									</div>							

									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										<input class="btn green" type="submit" name="add_and_new" value="Save">
										<a href="<?php echo base_url(); ?>backend/users/index"> <button class="btn default" type="button">Cancel</button></a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
					
					
				</div>





	       </div>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
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
        	//$("#change_city2").val($("#city").val());
        	//$("#change_state2").val($("#state").val());
        	$("#s_zip").val($("#zip").val());
        	//$("#s_county").val($("#county").val());
        	$("#s_mobile").val($("#mobile").val());

        	var temp_state = $("#change_state").val();
        	var temp_city = $("#change_city").val();
        	//$("#change_state2 option[value='"+temp_state+"']").prop('selected', true).trigger( "change" );

        	$("#change_state2 option[value='"+temp_state+"']").prop('selected', true);

            $("#change_city2").html($("#change_city").html());
            $("#change_city2 option[value='"+temp_city+"']").prop('selected', true);

        	$("#use_billing_address").prop("checked", true);

        }
        else
        {	
        	$("#s_first_name").val('');
        	$("#s_last_name").val('');
        	$("#s_email").val('');
        	$("#s_address").val('');
        	$("#change_state2").val('');
        	$("#change_city2").html('<option value="">Select City</option>');
        	$("#s_zip").val('');
        	//$("#s_county").val('');
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

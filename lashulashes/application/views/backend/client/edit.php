<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">				
		<div class="clearfix">
		</div>
	
        <div class="row">
            <div class="col-md-12 ">
                 
	        	<div id="error_message">
	        		<?php  echo msg_alert_backend(); ?>
	        	</div>
	        	<!-- BEGIN SAMPLE FORM PORTLET-->
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-edit"></i>
							Edit Distributor
						</div>
						
					</div>
					<div class="portlet-body form">
						<ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Detail</a></li>
						    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Products</a></li>
						</ul>
						<form  method="post" action="" class="form-horizontal">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
										<div class="form-body">
											<div class="form-group">
												<label class="col-md-3 control-label">Distributor Type<samll class="error">*</samll></label>
												<div class="col-md-9">
													<select name="cliend_kind" class="form-control">
														<option value="">Select Distributor Type</option>
														<option value="1" <?php if($update[0]->cliend_kind==1) echo "selected"; ?>>Wholesale Distributor</option>
														<option value="2" <?php if($update[0]->cliend_kind==2) echo "selected"; ?>>Education Centre</option>
														<option value="3" <?php if($update[0]->cliend_kind==3) echo "selected"; ?>>OEM</option>
													</select>
												    <?php echo form_error('cliend_kind'); ?> 
												</div>										
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Name<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->title; }  else  echo set_value('title');?>" name="title" type="text" placeholder="Enter Name" class="form-control">
												    <?php echo form_error('title'); ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Contact Person <samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->user_name; }  else  echo set_value('user_name');?>" name="user_name" type="text" placeholder="Enter Contact Person Name" class="form-control">
												    <?php echo form_error('user_name'); ?> 
												</div>
											</div>
										 
										 	<div class="form-group">
												<label class="col-md-3 control-label">Paypal <samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->paypal; }  else  echo set_value('paypal');?>" name="paypal" type="text" placeholder="Enter Paypal Id" class="form-control">
												    <?php echo form_error('paypal'); ?> 
												</div>
											</div>

				                          	<div class="form-group">
												<label class="col-md-3 control-label">Email<samll class="error	">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->email; }  else  echo set_value('email');?>" name="email" type="text" placeholder="Enter Distributor Email" class="form-control">
												    <?php echo form_error('email'); ?> 
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Alternate Email<samll class="error"></samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->email_2; }  else  echo set_value('email_2');?>" name="email_2" type="text" placeholder="Enter Alternate Email" class="form-control">
												    <?php echo form_error('email_2'); ?> 
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Address<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->address; }  else  echo set_value('address');?>" name="address" type="text" placeholder="Enter Distributor Address" class="form-control">
												    <?php echo form_error('address'); ?> 
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Postal Code<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input data-inputmask="'mask':'9999'" value="<?php if(isset($update)) { echo $update[0]->zip; }  else  echo set_value('zip');?>" name="zip" id="zip" type="text" placeholder="Enter Postal Code" class="form-control">
												    <?php echo form_error('zip'); ?> 
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">State<samll class="error">*</samll></label>
												<?php $aus_state = get_aus_states(); ?>
												<div class="col-md-9">
													<select name="state" class="form-control" id="state">
														<option value="">Select State</option>
														<?php if($aus_state) 
															{?>
															<?php foreach ($aus_state as $aus_state_row) { ?>
																<option value="<?php echo $aus_state_row->state_code;?>" <?php if($update[0]->state == $aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
															<?php } ?>
														<?php } ?>
													</select>
												    <?php echo form_error('state'); ?> 
												</div>										
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">City<samll class="error">*</samll></label>
												<div class="col-md-9">
													
													<input type="text" name="city" class="form-control" id="change_city" value="<?php if(isset($update)) { echo $update[0]->city; }  else echo set_value('city');?>">
												    <?php echo form_error('city'); ?> 
												</div>
											</div> 


											<div class="form-group">
												<label class="col-md-3 control-label">Contact Number<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input data-inputmask="'mask':'9999999999'" value="<?php if(isset($update)) { echo $update[0]->mobile; }  else echo set_value('mobile');?>" name="mobile" type="text" placeholder="Enter Distributor Contact Number" class="form-control">
												    <?php echo form_error('mobile'); ?> 
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Alternate Contact Number<samll class="error"></samll></label>
												<div class="col-md-9">
													<input data-inputmask="'mask':'9999999999'" value="<?php if(isset($update)) { echo $update[0]->mobile_2; }  else echo set_value('mobile_2');?>" name="mobile_2" type="text" placeholder="Enter Alternate Contact Number" class="form-control">
												    <?php echo form_error('mobile_2'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Charity Paypal<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->charity_paypal; }  else echo set_value('charity_paypal');?>" name="charity_paypal" type="text" placeholder="Enter Charity Paypal Address" class="form-control">
												    <?php echo form_error('charity_paypal'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Charity %<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->charity_percentage; }  else echo set_value('charity_percentage');?>" name="charity_percentage" type="text" placeholder="Enter Charity Percentage" class="form-control" onkeyup="input_numeric(this);">
												    <?php echo form_error('charity_percentage'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">State Manager Paypal<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->state_paypal; }  else echo set_value('state_paypal');?>" name="state_paypal" type="text" placeholder="Enter State Paypal Address" class="form-control">
												    <?php echo form_error('state_paypal'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">State Manager %<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->state_percentage; }  else echo set_value('state_percentage');?>" name="state_percentage" type="text" placeholder="Enter State Manager Percentage" class="form-control" onkeyup="input_numeric(this);" >
												    <?php echo form_error('state_percentage'); ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Lash U Lashes %<samll class="error">*</samll></label>
												<div class="col-md-9">
													<input value="<?php if(isset($update)) { echo $update[0]->lash_percentage; }  else echo set_value('lash_percentage');?>" name="lash_percentage" type="text" placeholder="Enter Lash U Lashes Percentage" class="form-control" onkeyup="input_numeric(this);">
												    <?php echo form_error('lash_percentage'); ?>
												</div>
											</div>

										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
												<input class="btn green" type="submit" name="detail" value="Update Detail">
												<a href="<?php echo base_url('backend/client/index/'.$offset); ?>"> <button class="btn default" type="button">Cancel</button></a>
												</div>
											</div>
										</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="profile">
									<!-- <form  method="post" action="" class="form-horizontal"> -->
									<div class="form-body">
									   <div class="form-group">
									        <label class="col-md-2 control-label">Select Products</label>
									        <div class="col-md-8">
									        	<select multiple="multiple" class="form-control" id="multiSelect" name="products_array[]">
									        	<?php if(!empty($products)) { ?>
									        		<?php 
									        			$my_products = json_decode($update[0]->my_products); 
									        			if(!is_array($my_products)) $my_products = array();

									        		?>
									                <?php foreach ($products as $products_row) { ?>
														<option value='<?php echo $products_row->id; ?>' <?php if(in_array($products_row->id, $my_products)) echo 'selected';?>><?php echo $products_row->title; ?></option>
									                <?php }?>
												<?php } ?>
												</select>										  
									        </div>
									        <div class="col-md-3">
									        	<span class="text-muted"></span>
									        </div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
											<input class="btn green" type="submit" name="product" value="Update Product">
											<a href="<?php echo base_url('backend/client/index/'.$offset); ?>"> <button class="btn default" type="button">Cancel</button></a>
											</div>
										</div>
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
<script type="text/javascript">

	$("#zip").keyup( function(){
		var post = $("#zip").val(); 
		post = post.replace(/_/g,'');
		if(post.length==4)
		{
			$.post('<?php echo base_url("./backend/users/validate_postcode"); ?>',
					{code:post},
					function(data){
						//alert(data.status);
						if(data.status){
							$("#change_city").val(data.city);
							$("#state option[value='"+data.state+"']").prop('selected', true);
						}else{
							$("#zip").val('');
							$("html, body").animate({ scrollTop: 0 }, "slow");
							var message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i> Please enter valid Postal Code. </div>';
							$("#error_message").html(message);
						}
					});
		}
	});

</script>
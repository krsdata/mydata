	<div class="page-content-wrapper">
		<div class="page-content">				
			
			<div class="clearfix">
			</div>
		
            <div class="row">
  
           <div class="col-md-12 ">
                 
                 
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>
								 Add Location
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">

									<div class="form-group">
										<label class="col-md-3 control-label">Category<small class="error">*</small></label>
										<div class="col-md-9">
										  
                                            <select name="type" class="form-control">
                                            	    <option value="" >Select Category</option>
													<option value="H" <?php if(isset($_POST['type'])) {if($_POST['type']== 'H' ){?> selected="selected" <?php }}?> >Wholesale Store</option>
													<option value="E" <?php if(isset($_POST['type'])) {if($_POST['type']== 'E' ){?> selected="selected" <?php }}?> >Education Centre</option>
																			
											</select>
											<?php echo form_error('type'); ?>											
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Location<small class="error">*</small></label>
										<div class="col-md-9">
										  
                                            <select name="location" class="form-control">
                                            	<option value="" >Select location</option>
										        <option value="VIC" <?php if(isset($_POST['location'])) {if($_POST['location']== 'VIC' ){?> selected="selected" <?php }}?> >VIC</option>
												<option value="NSW" <?php if(isset($_POST['location'])) {if($_POST['location']== 'NSW' ){?> selected="selected" <?php }}?> >NSW</option>
												<option value="QLD" <?php if(isset($_POST['location'])) {if($_POST['location']== 'QLD' ){?> selected="selected" <?php }}?> >QLD</option>
												<option value="SA" <?php if(isset($_POST['location'])) {if($_POST['location']== 'SA' ){?> selected="selected" <?php }}?> >SA</option>	
											</select>
											<?php echo form_error('location'); ?>											
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Name<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php echo set_value('name');?>" name="name" type="text" placeholder="Enter name" class="form-control">
										    <?php echo form_error('name'); ?> 
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Contact No.<small class="error">*</small></label>
										<div class="col-md-9">
											<input data-inputmask="'mask':'9999999999'" value="<?php echo set_value('mobile');?>" name="mobile" type="text" placeholder="Enter contact number" class="form-control">
										    <?php echo form_error('mobile'); ?> 
										</div>
									</div>

                                         
                                    <div class="form-group">
					                     <label class="col-md-3 control-label">Adderss<small class="error">*</small></label>
					                     <div class="col-md-9">
					                     	<input value="<?php echo set_value('address');?>" name="address" type="text" placeholder="Enter address" class="form-control">
					                       <!-- <textarea  class="tinymce_edittor0 form-control" cols="100" rows="4" name="address"><?php //echo set_value('address'); ?></textarea> -->
					                       <?php echo form_error('address'); ?>
					                     </div>
				                    </div>

				                    <div class="form-group">
										<label class="col-md-3 control-label">Postal Code<small class="error">*</small></label>
										<div class="col-md-9">
											<input data-inputmask="'mask':'9999'" value="<?php echo set_value('zip');?>" name="zip" id="zip" type="text" placeholder="Enter postal code" class="form-control">
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
														<option value="<?php echo $aus_state_row->state_code;?>" <?php if(set_value('state')==$aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
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
											<input type="text" name="city" class="form-control" id="change_city" value="<?php echo set_value('city');?>">		
										    <?php echo form_error('city'); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Country<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php if(set_value('country')) { echo set_value('country'); } else { echo "Australia"; }?>" name="country" type="text" placeholder="Enter country" class="form-control">
										    <?php echo form_error('country'); ?> 
										</div>
									</div>
                                  

                                    <div class="form-group">
										<label class="col-md-3 control-label">Status</label>
										<div class="col-md-9">
                                            <select name="status" class="form-control">
												<option value="1" <?php if(isset($_POST['status'])){if($_POST['status']==1){?> selected="selected" <?php }}?> >Active</option>
												<option value="0" <?php if(isset($_POST['status'])){if($_POST['status']==0){?> selected="selected" <?php }}?>>Inactive</option>												
											</select>											
										</div>
									</div>
                                    
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										
										<input class="btn green" type="submit" name="add_and_new" value="Save">
										 
										<a href="<?php echo base_url(); ?>backend/contacts/index"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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
<!-- END CONTAINER-->


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

</script>
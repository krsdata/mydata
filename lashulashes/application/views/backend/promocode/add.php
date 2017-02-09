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
								 Add Promo Code
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action=""  class="form-horizontal">
								<div class="form-body">
								    <div class="form-group" style="display:none;">
										<label class="col-md-3 control-label"> Applied On </label>
										<div class="col-md-3">
											<?php  
											    if(isset($_POST['applied_on']))
											    {
											    	$applied_on = $_POST['applied_on'];
											    }
											    else
											    {
											    	$applied_on = array();
											    }

											?>
											<ul class="list-inline">
											  	<li>
											  		<input value="1" <?php //if(in_array(1,$applied_on)) echo "checked"; ?> name="applied_on[]" type="checkbox" checked > Products 
											  	</li>
											  	<li>
											  		<input value="2" <?php //if(in_array(2,$applied_on)) echo "checked"; ?> name="applied_on[]" type="checkbox"> Services 
											  	</li>
											</ul>
										    <?php echo form_error('applied_on[]'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Code<small class="error">*</small></label>
										<div class="col-md-3">
											<input value="<?php echo set_value('code');?>" name="code" type="text" placeholder="Enter Code" class="form-control">
										    <?php echo form_error('code'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Start Date<small class="error">*</small></label>
										<div class="col-md-3">
											<div class="input-group">
												<input value="<?php echo set_value('start_date'); ?>" name="start_date" type="text" placeholder="Start Date" class="form-control start_datepicker date_icon_view" data-date-format="dd-mm-yyyy" src="" aria-describedby="date_icon" readonly >
												<span class="input-group-addon start_date_icon_click" id="date_icon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
											<?php echo form_error('start_date'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">End Date<small class="error">*</small></label>
										<div class="col-md-3">
											<div class="input-group">
												<input value="<?php echo set_value('end_date'); ?>" name="end_date" type="text" placeholder="End Date" class="form-control end_datepicker date_icon_view" data-date-format="dd-mm-yyyy" src="" aria-describedby="end_date_icon" readonly >
												<span class="input-group-addon end_date_icon_click" id="end_date_icon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
											<?php echo form_error('end_date'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mininum Amount<small class="error">*</small></label>
										<div class="col-md-3">
											<input value="<?php echo set_value('min_amount');?>" name="min_amount" type="text" placeholder="Enter Amount" class="form-control">
										    <?php echo form_error('min_amount'); ?> 
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Discount<small class="error">*</small></label>
										<div class="col-md-3">
											<!-- <input value="<?php //echo set_value('min_amount');?>" name="min_amount" type="text" placeholder="Enter Name" class="form-control">
											<select>
												<option value="1"><i class="fa fa-usd" aria-hidden="true"></i></option>
												<option value="2"><i class="fa fa-percent" aria-hidden="true"></i></option>
											</select> -->
											<div class="input-group">
												<input value="<?php echo set_value('discount');?>" name="discount" type="text" placeholder="Enter Discount" class="form-control">
												<span class="input-group-addon" >
													<select name="discount_type" style="font-family:'FontAwesome', Arial;">
														<option value="1">&#x24;</option>
														<option value="2">&#x25;</option>
													</select>
												</span>
										    </div>
										    <?php echo form_error('discount'); ?> 
										</div>
									</div>



                                    <div class="form-group">
										<label class="col-md-3 control-label">Status</label>
										<div class="col-md-3">
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
											<a href="<?php echo base_url(); ?>backend/promocode/index"> <button  class="btn default" type="button">Cancel</button></a>
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


 
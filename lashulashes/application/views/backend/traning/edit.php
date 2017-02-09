<div class="page-content-wrapper">
	<div class="page-content">				
		<div class="clearfix"></div>
        <div class="row">
           	<div class="col-md-12 ">                 
				<!-- BEGIN SAMPLE FORM PORTLET-->
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-plus"></i>
							 Edit Training
						</div>
					</div>
					<div class="portlet-body form">
						<form  method="post" action=""  class="form-horizontal">
							<div class="form-body">
								
							 	<div class="form-group">
									<label class="col-md-3 control-label">Category<small class="error">*</small></label>
									<div class="col-md-9">
										<select name="category"  class="form-control">
											<option value="">Select Category</option>
											<?php if(!empty($category)) { ?>
												<?php foreach ($category as $category_row) { ?>
													<option value="<?php echo $category_row->id;?>" <?php if(isset($update)) { if($update[0]->category_id==$category_row->id) { echo "selected"; } }?>><?php echo $category_row->name;?></option>									
												<?php } ?>
											<?php } ?>
										</select>
									    <?php echo form_error('category'); ?> 
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Title<small class="error">*</small></label>
									<div class="col-md-9">
										<input type="text" name="title" value="<?php if(isset($update)) { echo $update[0]->title; }  ?>" class="form-control" placeholder="Enter Training Title"/>
										<?php echo form_error('title'); ?> 
									</div>
								</div>

							 	<div class="form-group">
									<label class="col-md-3 control-label">Short Description<small class="error">*</small></label>
									<div class="col-md-9">
										<textarea name="description" class="form-control" placeholder="Enter Training Description"><?php if(isset($update)) { echo $update[0]->description; }  ?></textarea>
									    <?php echo form_error('description'); ?> 
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Training Fee<small class="error">*</small></label>
									<div class="col-md-9">
										<input type="text" name="fee" value="<?php if(isset($update)) { echo $update[0]->fees; }  ?>" class="form-control" placeholder="Enter Training Fee"/>
										<?php echo form_error('fee'); ?> 
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Timings<small class="error">*</small></label>
									<div class="col-md-9">
										<input type="text" name="timing" value="<?php if(isset($update)) { echo $update[0]->timing; }  ?>" class="form-control" placeholder="11 AM to 2 PM"/>
										<?php echo form_error('timing'); ?> 
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Start Date<small class="error">*</small></label>
									<div class="col-md-3">
										<div class="input-group">
											<input value="<?php if(isset($update)) { echo date('d M Y',strtotime($update[0]->start_date)); }  ?>" name="start_date" type="text" placeholder="Select Training Start Date" class="form-control start_datepicker date_icon_view" data-date-format="dd-mm-yyyy" src="" aria-describedby="date_icon" readonly >
											<span class="input-group-addon start_date_icon_click" id="date_icon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
						                </div>
										<?php echo form_error('start_date'); ?> 
									</div>
									<label class="col-md-2 control-label">End Date<small class="error">*</small></label>
									<div class="col-md-3">
										<div class="input-group">
											<input value="<?php if(isset($update)) { echo date('d M Y',strtotime($update[0]->end_date)); }  ?>" name="end_date" type="text" placeholder="Select Training End Date" class="form-control end_datepicker date_icon_view" data-date-format="dd-mm-yyyy" src="" aria-describedby="end_date_icon" readonly >
											<span class="input-group-addon end_date_icon_click" id="end_date_icon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
						                </div>
										<?php echo form_error('end_date'); ?> 
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Maximum seats<small class="error">*</small></label>
									<div class="col-md-9">
										<input type="text" name="participant" value="<?php if(isset($update)) { echo $update[0]->participant; }  ?>" class="form-control" placeholder="Enter maximum allotted seats"/>
										<?php echo form_error('participant'); ?> 
									</div>
								</div>
								

								<div class="form-group">
									<label class="col-md-3 control-label">Location<small class="error">*</small></label>
									<div class="col-md-9">
										<select name="state"  class="form-control">
											<option value="">Select State</option>
											<?php if(!empty($aus_state)) { ?>
												<?php foreach ($aus_state as $aus_state_row) { ?>
													<option value="<?php echo $aus_state_row->state_code;?>" <?php if(isset($update)) {  if( $update[0]->state==$aus_state_row->state_code) { echo "selected"; } } ?>><?php echo $aus_state_row->state_code;?></option>									
												<?php } ?>
											<?php } ?>
										</select>
									    <?php echo form_error('state'); ?> 
									</div>
								</div>

                                <div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-9">
                                        <select name="status" class="form-control">
											<option value="1" <?php if(isset($update)){if($update[0]->status==1){?> selected="selected" <?php }}?> >Active</option>
											<option value="0" <?php if(isset($update)){if($update[0]->status==0){?> selected="selected" <?php }}?>>Inactive</option>											
										</select>										
									</div>
								</div>

							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">									
										<input class="btn green" type="submit" name="add_and_new" value="Update">	 
										<a href="<?php echo base_url('backend/trainings/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>                                 
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
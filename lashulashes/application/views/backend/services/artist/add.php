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
							 Add Artist
						</div>	
					</div>
					<div class="portlet-body form">
						<form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-body"> 

								<div class="form-group">
									<label class="col-md-2 control-label">Name<small class="error">*</small></label>
									<div class="col-md-5">
										<input  value="<?php echo set_value('name');?>" name="name" type="text" placeholder="Artist name" class="form-control">
									    <?php echo form_error('name'); ?> 
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">Working Days<small class="error">*</small></label>
									<div class="col-md-10">
										<section class="row">
											<div class="col-md-6">
												<div class="col-md-12 cal_time_col">
													<div class="cal_time_outer">
														<ul>
															<li>Sunday</li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeStart1');?>" type="text" name="timeStart1" class="timeStart time24" placeholder="09:00">
				  											</li>
															<li> - To - </li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd1');?>" type="text" name="timeEnd1" class="timeEnd time24" placeholder="17:00" >
		  													</li>
														</ul>
														<?php echo form_error('timeStart1'); ?> 
														<?php echo form_error('timeEnd1'); ?> 
													</div>
												</div>
												<div class="col-md-12 cal_time_col">
													<div class="cal_time_outer">
														<ul>
															<li>Monday</li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeStart2');?>" type="text" name="timeStart2" class="timeStart time24" placeholder="09:00">
				  											</li>
															<li> - To - </li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd2');?>" type="text" name="timeEnd2" class="timeEnd time24" placeholder="17:00" >
		  													</li>
														</ul>
														<?php echo form_error('timeStart2'); ?> 
														<?php echo form_error('timeEnd2'); ?> 
													</div>
												</div>
												<div class="col-md-12 cal_time_col">
													<div class="cal_time_outer">
														<ul>
															<li>Tuesday</li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeStart3');?>" type="text" name="timeStart3" class="timeStart time24" placeholder="09:00">
				  											</li>
															<li> - To - </li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd3');?>" type="text" name="timeEnd3" class="timeEnd time24" placeholder="17:00" >
		  													</li>
														</ul>
														<?php echo form_error('timeStart3'); ?> 
														<?php echo form_error('timeEnd3'); ?> 
													</div>
												</div>
												<div class="col-md-12 cal_time_col">
													<div class="cal_time_outer">
														<ul>
															<li>Wednesday</li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeStart4');?>" type="text" name="timeStart4" class="timeStart time24" placeholder="09:00">
				  											</li>
															<li> - To - </li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd4');?>" type="text" name="timeEnd4" class="timeEnd time24" placeholder="17:00" >
		  													</li>
														</ul>
														<?php echo form_error('timeStart4'); ?> 
														<?php echo form_error('timeEnd4'); ?> 
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="col-md-12 cal_time_col">
													<div class="cal_time_outer">
														<ul>
															<li>Thursday</li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeStart5');?>" type="text" name="timeStart5" class="timeStart time24" placeholder="09:00">
				  											</li>
															<li> - To - </li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd5');?>" type="text" name="timeEnd5" class="timeEnd time24" placeholder="17:00" >
		  													</li>
														</ul>
														<?php echo form_error('timeStart5'); ?> 
														<?php echo form_error('timeEnd5'); ?> 
													</div>
												</div>
												<div class="col-md-12 cal_time_col">
													<div class="cal_time_outer">
														<ul>
															<li>Friday</li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeStart6');?>" type="text" name="timeStart6" class="timeStart time24" placeholder="09:00">
				  											</li>
															<li> - To - </li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd6');?>" type="text" name="timeEnd6" class="timeEnd time24" placeholder="17:00" >
		  													</li>
														</ul>
														<?php echo form_error('timeStart6'); ?> 
														<?php echo form_error('timeEnd6'); ?> 
													</div>
												</div>
												<div class="col-md-12 cal_time_col">
													<div class="cal_time_outer">
														<ul>
															<li>Saturday</li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd7');?>" type="text" name="timeStart7" class="timeStart time24" placeholder="09:00">
				  											</li>
															<li> - To - </li>
															<li>
					  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					  											<input value="<?php echo set_value('timeEnd7');?>" type="text" name="timeEnd7" class="timeEnd time24" placeholder="17:00" >
		  													</li>
														</ul>
														<?php echo form_error('timeStart7'); ?> 
														<?php echo form_error('timeEnd7'); ?> 
													</div>
												</div>
											</div>
										</section>									
									</div>
								</div>

								<div class="form-group">
				                    <label class="col-md-2 control-label">Short Description<small class="error">*</small></label>
				                    <div class="col-md-9">
				                       <textarea  class="form-control" cols="100"  maxlength="400" rows="5" name="description" onkeyup="max_text_count(this);"><?php echo set_value('description'); ?></textarea>
				                       <?php echo form_error('description'); ?>
				                       <label class="text-info" id="text_count_msg">Maximum 400 character are allowed.</label>
				                    </div>
				                </div>
                                  
                                <div class="form-group">
									<label class="col-md-2 control-label">Image<small class="error">*</small></label>
									<div class="col-md-9">
										<input value="" name="service_image" type="file"  >
										<?php echo form_error('service_image'); ?>
										<label class="text-info"> ( Image size atleast 400 x 400 pixels and maximum 600 x 600 pixels. And maximum file size is 2MB. )</label>
									</div>
								</div>

                                <div class="form-group">
									<label class="col-md-2 control-label">Status</label>
									<div class="col-md-2">
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
										<a href="<?php echo base_url(); ?>backend/services/artist"> <button  class="btn default" type="button">Cancel</button></a>
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


 
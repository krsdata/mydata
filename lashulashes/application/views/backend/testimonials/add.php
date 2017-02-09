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
								 Add Testimonial
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" enctype="multipart/form-data" class="form-horizontal">
								<div class="form-body">
									
									<div class="form-group">
										<label class="col-md-3 control-label">Name<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php   echo set_value('client_name'); ?>" name="client_name" type="text" placeholder="Enter Name" class="form-control">
										    <?php echo form_error('client_name'); ?> 
										</div>
									</div>

                                     <div class="form-group">
										<label class="col-md-3 control-label">Location<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php  echo set_value('location'); ?>" name="location" type="text" placeholder="Enter Location" class="form-control">
										    <?php echo form_error('location'); ?> 
										</div>
									</div>
									
								   
								    <div class="form-group">
					                     <label class="col-md-3 control-label">Feedback<small class="error">*</small></label>
					                     <div class="col-md-9">
					                       <textarea  class="tinymce_edittor0 form-control" cols="100"  maxlength="900" rows="10" name="feedback" onkeyup="max_text_count(this);"><?php echo set_value('feedback'); ?></textarea>
					                       <?php echo form_error('feedback'); ?>
					                       <label class="text-info" id="text_count_msg">Maximum 900 character are allowed.</label>
					                     </div>
					                 </div>

                                  
                                    <div class="form-group">
										<label class="col-md-3 control-label">Photo<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="" name="features_image" type="file"  >
											<?php echo form_error('features_image'); ?>
											<label class="text-info"> ( Image size atleast 300 x 300 pixels and maximum 500 x 500 pixels. And maximum file size is 2MB. )</label>
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
										 
										<a href="<?php echo base_url(); ?>backend/testimonials/index"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
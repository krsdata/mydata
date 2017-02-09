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
							 Add Service
						</div>	
					</div>
					<div class="portlet-body form">
						<form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-body"> 

								<div class="form-group">
									<label class="col-md-3 control-label">Title<small class="error">*</small></label>
									<div class="col-md-4">
										<input  value="<?php echo set_value('name');?>" name="name" type="text" placeholder="Enter title" class="form-control">
									    <?php echo form_error('name'); ?> 
									</div>
								</div>
								<div class="form-group">
				                    <label class="col-md-3 control-label">Short Description<small class="error">*</small></label>
				                    <div class="col-md-9">
				                       <textarea  class="form-control" cols="100"  maxlength="400" rows="5" name="detail" onkeyup="max_text_count(this);"><?php echo set_value('detail'); ?></textarea>
				                       <?php echo form_error('detail'); ?>
				                       <label class="text-info" id="text_count_msg">Maximum 400 character are allowed.</label>
				                    </div>
				                </div>
                                  
                                <div class="form-group">
									<label class="col-md-3 control-label">Image<small class="error">*</small></label>
									<div class="col-md-9">
										<input value="" name="service_image" type="file"  >
										<?php echo form_error('service_image'); ?>
										<label class="text-info"> ( Image size atleast 400 x 400 pixels and maximum 600 x 600 pixels. And maximum file size is 2MB. )</label>
									</div>
								</div>

                                <div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-4">
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
									 
									<a href="<?php echo base_url(); ?>backend/services/categories"> <button  class="btn default" type="button">Cancel</button></a>

                                 
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


 
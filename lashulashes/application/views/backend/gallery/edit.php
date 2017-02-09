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
								<i class="fa fa-pencil-square-o"></i>
								 Edit gallery
							</div>
							
						</div>
						<div class="portlet-body form">
							<form enctype="multipart/form-data" method="post" action=""   class="form-horizontal">
								<div class="form-body">
									
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Title</label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->gallery_title; }  ?>" name="gallery_title" type="text" placeholder="Enter title" class="form-control">
										    <?php echo form_error('gallery_title'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Image</label>
										<div class="col-md-9">
											<input value="" name="features_image" type="file">
										    <?php echo form_error('features_image'); ?> 
										    <span> <img width="100" src="<?php echo base_url().$update[0]->gallery_image ?>"> </span>
										    <label class="text-info"> (  Image size at least 350 x 235 pixels And maximum file size is 2MB. For better gallery view please follow the related ratios and select 780 x 525 pixels image. )</label>
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
										
										<input class="btn green" type="submit" name="add_and_new" value="Save">
										 
										<a href="<?php echo base_url('backend/gallery/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
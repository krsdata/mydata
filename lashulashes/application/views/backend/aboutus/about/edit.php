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
								 Edit About
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" enctype="multipart/form-data" class="form-horizontal">
								<div class="form-body">
									
									<div class="form-group">
										<label class="col-md-3 control-label">Title<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->title; } else {  echo set_value('title'); } ?>" name="title" type="text" placeholder="Enter title" class="form-control">
										    <?php echo form_error('title'); ?> 
										</div>
									</div>								
								   
								    <div class="form-group">
				                     <label class="col-md-3 control-label">Content<small class="error">*</small></label>
				                     <div class="col-md-9">
				                       <textarea  class="tinymce_edittor form-control" cols="100" rows="10" name="content"><?php if(isset($update[0])) { echo $update[0]->content; } else { echo set_value('content'); }?></textarea>
				                       <?php echo form_error('content'); ?>
				                     </div>
				                  </div>
				                  <div class="form-group">
						                <label class="col-md-3 control-label form-label"> </label>
										<div class="col-md-9">                                       
											<?php if(!empty($update[0]->thumb) && file_exists($update[0]->thumb)) { ?> 
											    <img src="<?php echo base_url($update[0]->thumb); ?>" width="100">
											<?php }?>                                
										</div>
				           			</div>
                                  
                                  <div class="form-group">
										<label class="col-md-3 control-label">Photo</label>
										<div class="col-md-9">
											<input value="" name="features_image" type="file"  >
											<?php echo form_error('features_image'); ?>
											<label class="text-info"> ( Image size atleast 300 x 300 pixels and maximum 1024 x 786 pixels. And maximum file size is 2MB. )</label>
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
											<a href="<?php echo base_url('backend/about/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>                                     
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


 
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
								 Edit page
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Title</label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->post_title; }  ?><?php echo set_value('post_title');?>" name="post_title" type="text" placeholder="Enter title" class="form-control">
										    <?php echo form_error('post_title'); ?> 
										</div>
									</div>

									<!-- <div class="form-group">
										<label class="col-md-3 control-label">Slug</label>
										<div class="col-md-9">
											<input  value="{{title_slug | slugify}}<?php //if(isset($update)) { echo $update[0]->post_slug; }  ?><?php //echo set_value('post_slug');?>" name="post_slug" type="text" placeholder="Enter slug" class="form-control">
										    <?php //echo form_error('post_slug'); ?> 
										</div>
									
									</div> -->
								   	 
                                         
                                    <div class="form-group">
					                     <label class="col-md-3 control-label">Content</label>
					                     <div class="col-md-9">
					                       <textarea  class="tinymce_edittor form-control" cols="100" rows="12" name="post_content"><?php if(isset($update[0])) { echo $update[0]->post_content; } echo set_value('post_content'); ?></textarea><?php echo form_error('post_content'); ?>
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
										 
										<a href="<?php echo base_url('backend/pages/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
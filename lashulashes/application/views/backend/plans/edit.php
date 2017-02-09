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
								 Edit plan
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
								<div class="form-body">
									

									<div class="form-group">
										<label class="col-md-3 control-label">Title<small class="error">*</small></label>
										<div class="col-md-9">
											<input  value="<?php if(isset($update)) { echo $update[0]->title; } else { echo set_value('title'); } ?>" name="title" type="text" placeholder="Enter title" class="form-control">
										    <?php echo form_error('title'); ?> 
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Duration (in month)<small class="error">*</small></label>
										<div class="col-md-9">
											<input  value="<?php if(isset($update)) { echo $update[0]->duration; } else { echo set_value('duration'); } ?>" name="duration" type="text" placeholder="Enter duration" class="form-control">
										    <?php echo form_error('duration'); ?> 
										</div>									
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Amount<small class="error">*</small></label>
										<div class="col-md-9">
											<input  value="<?php if(isset($update)) { echo $update[0]->amount; } else { echo set_value('amount'); }?>" name="amount" type="text" placeholder="Enter amount" class="form-control">
										    <?php echo form_error('amount'); ?> 
										</div>
									
									</div> 

                                    <div class="form-group">
					                     <label class="col-md-3 control-label">Description<small class="error">*</small>	</label>
					                     <div class="col-md-9">
					                       <textarea  class="tinymce_edittor form-control" cols="100" rows="12" name="description"><?php if(isset($update)) { echo $update[0]->description; } else { echo set_value('description'); } ?></textarea><?php echo form_error('description'); ?>
					                     </div>
					                </div>

					                <div class="form-group">
						                <label class="col-md-3 control-label form-label"> </label>
										<div class="col-md-9">                                       
											<?php if(!empty($update[0]->image) && file_exists($update[0]->image)) { ?> 
											    <img src="<?php echo base_url($update[0]->image); ?>" width="100">
											<?php }?>                                
										</div>
				           			</div>  

                                    <div class="form-group">
						                <label class="col-md-3 control-label form-label">Image</label>
										<div class="col-md-9">                                       
											<input type="file" name="features_image" style="border:none;"> 
											<?php echo form_error('features_image'); ?> 
											<label class="text-info"> ( Image size atleast 700 x 500 pixels. And maximum file size is 2MB. )</label>                              
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
										 
										<a href="<?php echo base_url('backend/plans/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
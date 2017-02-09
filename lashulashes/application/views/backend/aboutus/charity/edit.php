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
								 Edit Testimonial
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" enctype="multipart/form-data" class="form-horizontal">
								<div class="form-body">
									
									<div class="form-group">
										<label class="col-md-3 control-label">Title<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->title; } else {  echo set_value('title'); } ?>" name="title" type="text" placeholder="Enter Event Title" class="form-control">
										    <?php echo form_error('title'); ?> 
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Short Content<small class="error">*</small></label>
										<div class="col-md-9">
										<textarea name="short_content" placeholder="About Event" class="form-control"><?php if(isset($update)) { echo $update[0]->short_content; } else { echo set_value('short_content'); }  ?></textarea>
										    <?php echo form_error('short_content'); ?> 
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
										<label class="col-md-3 control-label">Event Date<small class="error">*</small></label>
										<div class="col-md-3">
											<div class="input-group">
												<input value="<?php if(isset($update)) { echo date('d M Y',strtotime($update[0]->date)); } else { echo set_value('date'); }  ?>" name="date" type="text" placeholder="Select Event date" class="form-control datepicker date_icon_view" ata-date-format="mm/dd/yyyy" src="" aria-describedby="date_icon">
												<span class="input-group-addon date_icon_click" id="date_icon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
											<?php echo form_error('date'); ?> 
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
										 
										<a href="<?php echo base_url('backend/about/charity/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
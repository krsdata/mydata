<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">				
			
			<div class="clearfix">
			</div>
		
            <div class="row">
  
           <div class="col-md-12 ">
                 
                 <?php if($this->session->flashdata('message')){ ?>
                <div class="note note-success">						<p>
							 <?php echo $this->session->flashdata('message');  ?>
						</p>
					</div>
                   <?php } ?> 

					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil-square-o"></i>
								Edit Email Templete
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Template Name</label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->template_name; }  ?><?php echo set_value('template_name');?>" name="template_name" type="text" placeholder="Enter Template Name" class="form-control">
										    <?php echo form_error('template_name'); ?> 
										</div>
									</div>
									

									<div class="form-group">
										<label class="col-md-3 control-label">Template Subject</label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->template_subject; }  ?><?php echo set_value('template_subject');?>" name="template_subject" type="text" placeholder="Enter Template Subject" class="form-control">
										    <?php echo form_error('template_subject'); ?> 
										</div>
									</div>
								   		
                                    <div class="form-group">
				                     <label class="col-md-3 control-label">Template Body</label>
				                     <div class="col-md-9">
				                       <textarea  class="tinymce_edittor form-control" cols="100" rows="10" name="template_body"><?php if(isset($update[0])) { echo $update[0]->template_body; } echo set_value('template_body'); ?></textarea><?php echo form_error('template_body'); ?>
				                     </div>
				                  </div>

                                  
                                  <div class="form-group">
										<label class="col-md-3 control-label">Template Subject Admin</label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->template_subject_admin; }  ?><?php echo set_value('template_name');?>" name="template_subject_admin" type="text" placeholder="Enter Template Subject Admin" class="form-control">
										    <?php echo form_error('template_subject_admin'); ?> 
										</div>
									</div>
								   		
                                     
                                      <div class="form-group">
				                     <label class="col-md-3 control-label">Template Body Admin</label>
				                     <div class="col-md-9">
				                       <textarea  class="tinymce_edittor form-control" cols="100" rows="10" name="template_body_admin"><?php if(isset($update[0])) { echo $update[0]->template_body_admin; } echo set_value('template_body_admin'); ?></textarea><?php echo form_error('template_body_admin'); ?>
				                     </div>
				                  </div>


									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">									
										 <input class="btn green" type="submit" name="add_and_new" value="Update">
										 
										<a href="<?php echo base_url(); ?>backend/email_templates/index"> <button class="btn default" type="button">Cancel</button></a>
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
<!-- END CONTAINER -->
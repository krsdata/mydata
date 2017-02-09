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
								 Edit Faq
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Category<small class="error">*</small></label>
										<div class="col-md-9">
										  
                                            <select name="type" class="form-control">
                                            	<option value="" >Select faq type</option>
										        <?php $faq_array = faq_types();?>
										        <?php if(!empty($faq_array)) { ?>
										            <?php foreach ($faq_array as $key => $value) { ?>
													<option value="<?php echo $key; ?>" <?php if($key== $update[0]->type ){?> selected="selected" <?php }?> ><?php echo $value; ?></option>
										            <?php }?>
												<?php } ?>							
											</select>
											<?php echo form_error('type'); ?>											
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Question<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php if(isset($update)) { echo $update[0]->question; }  ?><?php echo set_value('question');?>" name="question" type="text" placeholder="Enter question" class="form-control">
										    <?php echo form_error('question'); ?> 
										</div>
									</div>

									
								   	 
                                         
                                     <div class="form-group">
					                     <label class="col-md-3 control-label">Answer<small class="error">*</small></label>
					                     <div class="col-md-9">
					                       <textarea  class="tinymce_edittor form-control" cols="100" rows="12" name="answer"><?php if(isset($update[0])) { echo $update[0]->answer; } echo set_value('answer'); ?></textarea><?php echo form_error('answer'); ?>
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
										 
										<a href="<?php echo base_url('backend/faqs/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
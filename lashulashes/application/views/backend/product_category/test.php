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
								 Add category
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action=""  class="form-horizontal">
								<div class="form-body main_content">
									

                                  
                 <div class="form-group">
                <label class="form-label col-md-3 control-label">Answer </label> <a href="javascript:;" class="label label-success label-mini"  id="add_field_button">Add More Fields</a>            
                           
                 
                   <div class="col-md-9">
                 
                      <input class="form-control" placeholder='Answer'  type="text" name="answer[]"> 
                   
                   </div>
               
                 <?php echo form_error('correct_answer[]'); ?>
                
  
              </div>

     

				</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										
										<input class="btn green" type="submit" name="add_and_new" value="Save">
										 
										<a href="<?php echo base_url(); ?>backend/blogs/index"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
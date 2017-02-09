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
							 Message
						</div>
					</div>
					<div class="portlet-body form">
						
						<div class="col-md-12 well">
							<p>
								<?php 
									if(!empty($update[0]->first_name))
									{
										echo "<b>Name : </b>".$update[0]->first_name."<br>";
									}
									if(!empty($update[0]->email))
									{	
										echo "<b>Email : </b>".$update[0]->email."<br>";

									}
									if(!empty($update[0]->mobile))
									{
										echo "<b>mobile : </b>".$update[0]->mobile."<br>";
									}
									if(!empty($update[0]->message))
									{
										echo "<b>Message : </b>".$update[0]->message."<br>";
									}
								?>		
							</p>
						</div>
						<!-- <form  method="post" action="" class="form-horizontal">
							<div class="form-body">
								<?php //if(isset($update[0]) && !empty($update[0]->type)) {?>
								   <div class="form-group">
				                     <label class="col-md-3 control-label">Category</label>
				                     <div class="col-md-9">
				                        <label class="form-control"><?php //if(isset($update[0])) { echo $update[0]->type; } ?> </label>
				                     </div>
				                  </div>
				                <?php //} ?>
				                <?php //if(isset($update[0]) && !empty($update[0]->location)) {?>
						                  <div class="form-group">
						                     <label class="col-md-3 control-label">Location</label>
						                     <div class="col-md-9">
						                        <label class="form-control"><?php //if(isset($update[0])) { echo $update[0]->location; } ?> </label>
						                     </div>
						                  </div>
						        <?php //} ?>
						        <?php //if(isset($update[0]) && !empty($update[0]->store_name)) {?>
					                  <div class="form-group">
					                     <label class="col-md-3 control-label">Store Name</label>
					                     <div class="col-md-9">
					                        <label class="form-control"><?php //if(isset($update[0])) { echo $update[0]->store_name; } ?> </label>
					                     </div>
					                  </div>
					            <?php //} ?>
					            
								<div class="form-group">
								 <label class="col-md-3 control-label">Message</label>
								 <div class="col-md-9">
								    <label class="form-control" style="height:100%"><?php //if(isset($update[0])) { echo $update[0]->message; } ?> </label>
								 </div>
								</div>	  

								<div class="form-group">
								 <label class="col-md-3 control-label">Content</label>
								 <div class="col-md-9">
								   <textarea  class="tinymce_edittor form-control" cols="100" rows="12" name="reply_message"><?php //if(isset($update[0])) { echo $update[0]->reply_message; } echo set_value('reply_message'); ?></textarea><?php //echo form_error('reply_message'); ?>
								 </div>
								</div> 
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
									
									<input class="btn green" type="submit" name="add_and_new" value="Send">
									 
									<a href="<?php //echo base_url(); ?>backend/supports/index"> <button  class="btn default" type="button">Cancel</button></a>

	                             
									</div>
								</div>
							</div>
						</form> -->
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


 
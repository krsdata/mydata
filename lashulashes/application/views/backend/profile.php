<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">				
			
			<div class="clearfix">
			</div>
		
            <div class="row">
  
           <div class="col-md-12 ">
                 
               <?php  echo msg_alert_backend(); ?>

					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil-square-o"></i>
								 <?php echo $boxtitle['add']; ?>
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">First Name</label>
										<div class="col-md-9">
											<input value="<?php  if(isset($update[0]->first_name)) { echo $update[0]->first_name;  } ?>" name="first_name" type="text" placeholder="Enter First Name" class="form-control">
										    <?php echo form_error('first_name'); ?> 
										</div>
									</div>
									
								   
								   <div class="form-group">
										<label class="col-md-3 control-label">Last Name</label>
										<div class="col-md-9">
											<input value="<?php  if(isset($update[0]->last_name)){ echo $update[0]->last_name;  } ?>"  name="last_name" type="text" placeholder="Enter Last name" class="form-control">
										     <?php echo form_error('last_name'); ?>   
										</div>
									</div>
									

									<div class="form-group">
										<label class="col-md-3 control-label">Email</label>
										<div class="col-md-9">
											<input value="<?php  if(isset($update[0]->email)){ echo $update[0]->email;  } ?>"  name="email" type="text" placeholder="Enter Email" class="form-control">
										    <?php echo form_error('email'); ?> 
										</div>
									</div>
									
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										<input class="btn green" type="submit" name="save" value="Save">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
	       </div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="clearfix"></div>	
            <div class="row">  
           		<div class="col-md-12 ">
                <?php  echo msg_alert_backend(); ?>
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-lock"></i>
								 <?php echo $boxtitle['add']; ?>
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Old Password</label>
										<div class="col-md-9">
											<input name="oldpassword" type="password" placeholder="Enter old password" class="form-control">
										    <?php echo form_error('oldpassword'); ?> 
										</div>
									</div>
									
								   
								   <div class="form-group">
										<label class="col-md-3 control-label">New Password</label>
										<div class="col-md-9">
											<input name="newpassword" type="password" placeholder="Enter new password" class="form-control">
										     <?php echo form_error('newpassword'); ?>   
										</div>
									</div>
									

									<div class="form-group">
										<label class="col-md-3 control-label">Retype password</label>
										<div class="col-md-9">
											<input name="retypepassword" type="password" placeholder="Enter retype password" class="form-control">
										    <?php echo form_error('retypepassword'); ?> 
										</div>
									</div>
									
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										<input class="btn green" type="submit" name="changepass" value="Submit">
										<a href="<?php echo base_url(); ?>backend/superadmin" >	<button class="btn default" type="button">Cancel</button></a>
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
</div>
<!-- END CONTAINER -->
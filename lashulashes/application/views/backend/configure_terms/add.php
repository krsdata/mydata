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
								 Add <?php echo $attribute; ?>
							</div>
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" class="form-horizontal">
								<div class="form-body">
									<?php if(!isset($_POST['nameadd'])) { ?>
										<div class="form-group">
											<label class="col-md-2 control-label">Name</label>
											<div class="col-md-8">
												<input value="<?php echo set_value('name');?>" name="nameadd[]" type="text" placeholder="Name" class="form-control">
											    <?php echo form_error('name'); ?> 
											</div>
											<div class="col-md-1" onclick="addMoreRows(this.form);"> 
												<a class="btn btn-success">More</a>
										    </div>
										</div>
									<?php } else { ?>
										<?php 
											$input = $_POST['nameadd']; 
											//print_r($input);
										?>
										<?php $i=0;
											foreach ($input as $key => $value) 
											{
												if($key == 0)
												{ ?>
													<div class="form-group">
														<label class="col-md-2 control-label">Name</label>
														<div class="col-md-8">
															<input value="<?php echo $value;?>" name="nameadd[]" type="text" placeholder="Name" class="form-control">
														    <?php if(empty($value)) echo form_error('nameadd[]'); ?> 
														</div>
														<div class="col-md-1" onclick="addMoreRows(this.form);"> 
															<a class="btn btn-success">More</a>
													    </div>
													</div>
												<?php }
												else
												{ ?>
													<div id="rowCount<?php echo $key; ?>" class="form-group">
														<label class="col-md-2 control-label">Name</label>
														<div class="col-md-8">
															<input placeholder="Name" value="<?php echo $value;?>" name="nameadd[]" type="text" class="form-control" />
															<?php if(empty($value)) echo form_error('nameadd[]'); ?> 
														</div>
														<div class="col-md-1"> 
															<a href="javascript:void(0);" onclick="removeRow(<?php echo $key; ?>);"><i class="fa fa-times"></i></a>
														</div>
													</div>
												<?php }
											}
										?>

									<?php } ?>

									<div id="addedRows">
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										
										<input class="btn green" type="submit" name="add_and_new" value="Save">
										 
										<a href="<?php echo base_url(); ?>backend/configure_terms/index/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
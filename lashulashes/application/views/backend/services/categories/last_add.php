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
							<b><?php if(!empty($category_name)) echo ucwords($category_name); ?> </b>
							<i class="fa fa-plus"></i>
							 <label>[Add Sub Category]</label>
						</div>	
					</div>
					<div class="portlet-body form">
						<form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-body"> 
								<div class="form-group">
									<label class="col-md-3 control-label">Title<small class="error">*</small></label>
									<div class="col-md-4">
										<input  value="<?php echo set_value('name');?>" name="name" type="text" placeholder="Enter title" class="form-control">
									    <?php echo form_error('name'); ?>
									    <input type="hidden" name="parent_id" value="<?php echo $parent_id;?>">
									</div>
								</div>
								
                                <div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-4">
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
									 
									<a href="<?php echo base_url('backend/services/last_categories/'.$parent_id); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                 
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


 
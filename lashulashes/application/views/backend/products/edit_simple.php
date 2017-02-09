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
								Edit product
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  ng-controller="MyControllerone" method="post" action="" enctype="multipart/form-data" class="form-horizontal">
								<div class="form-body">
								
								 <div class="form-group">
										<label class="col-md-3 control-label">Category</label>
										<div class="col-md-9">
                                            <select name="category_id" class="form-control">
												 <?php for($c=0;$c<count($category);$c++){ ?>
												 <option value="<?php echo $category[$c]->id; ?>"> <?php echo $category[$c]->category_name; ?></option>
												 <?php } ?>
											</select>
											
										</div>
									</div>                            

									  <div class="form-group">
										<label  class="col-md-3 control-label">Type</label>
										<div class="col-md-9">
                                            <select  class="form-control">
                                              	<option value="" > <?php if(isset($update)){ echo $update[0]->type; } ?></option>
											</select>
											
										</div>
									</div>

  
                                 

									<div class="form-group">
										<label class="col-md-3 control-label">Title</label>
										<div class="col-md-9">
											<input ng-modelq="slug_title" value="<?php if(isset($update)){ echo $update[0]->title; } echo set_value('title');?>" name="title" type="text" placeholder="Enter Title" class="form-control">
										    <?php echo form_error('title'); ?> 
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Slug</label>
										<div class="col-md-9">
											<input  value="{{slug_title | slugify}}<?php echo set_value('slug'); if(isset($update)){ echo $update[0]->slug; } ?>" name="slug" type="text" placeholder="Enter Slug" class="form-control">
										    <?php echo form_error('slug'); ?> 
										</div>
									</div>
 
                                         
                                      <div class="form-group">
				                     <label class="col-md-3 control-label">Description</label>
				                     <div class="col-md-9">
				                       <textarea  class="tinymce_edittor form-control" cols="100" rows="12" name="description"><?php  echo set_value('description'); if(isset($update)){ echo $update[0]->description; } ?></textarea>
				                       <?php echo form_error('description'); ?>
				                     </div>
				                  </div>
                                  
                                  <div class="form-group">
										<label class="col-md-3 control-label">Price</label>
										<div class="col-md-9">
											<input  value="<?php if(isset($update)){ echo $update[0]->price; } echo set_value('price');?>" name="price" type="text" placeholder="Enter price" class="form-control">
										    <?php echo form_error('price'); ?> 
										</div>
									</div>
                                   

                                   <div class="form-group">
										<label class="col-md-3 control-label">Status</label>
										<div class="col-md-9">
                                            <select name="status" class="form-control">
												<option value="1"  <?php if(isset($update)) { if($update[0]->status==1) { echo 'selected="selected"'; } }  if(isset($_POST['status'])){if($_POST['status']==1){?> selected="selected" <?php }}?> >Active</option>
												<option value="0" <?php if(isset($update)) { if($update[0]->status==0) { echo 'selected="selected"'; } }  if(isset($_POST['status'])){if($_POST['status']==0){?> selected="selected" <?php }}?>>inactive</option>
												
											</select>
											
										</div>
									</div>
	

                                 
                                    

								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										
										<input class="btn green" type="submit" name="add_and_new" value="Save">
										 
										<a href="<?php echo base_url(); ?>backend/products/index"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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


 
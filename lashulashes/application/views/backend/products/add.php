	<div class="page-content-wrapper">
		<div class="page-content">				
			<?php //print_r(set_value('title'))?>
			<div class="clearfix">
			</div>
		
            <div class="row">
  
                <div class="col-md-12 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>
								 Add product
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  ng-controller="MyControllerone" method="post" action="" enctype="multipart/form-data" class="form-horizontal">
								<div class="form-body">
								    <div class="form-group">
										<label class="col-md-3 control-label">Category<samll class="error">*</samll></label>
										<div class="col-md-9">
                                            <select name="category_id" class="form-control">
												 <?php for($c=0;$c<count($category);$c++){ ?>
												 <option value="<?php echo $category[$c]->id; ?>"> <?php echo $category[$c]->category_name; ?></option>
												 <?php } ?>
											</select>
											
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Title<samll class="error">*</samll></label>
										<div class="col-md-9">
											<input ng-model="slug_title" value="<?php echo set_value('title');?>" name="title" type="text" placeholder="Enter Title" class="form-control">
										    <?php echo form_error('title'); ?> 
										</div>
									</div>                            
									
									<div class="form-group">
										<label  class="col-md-3 control-label">Type<samll class="error">*</samll></label>
										<div class="col-md-9">
                                            <select name="type" class="form-control" id="product_type">
                                                
                                                <?php for($t=0;$t<count($type);$t++) { ?>
													<option value="<?php echo $type[$t]->type; ?>" <?php if(isset($_POST['type'])){ if($_POST['type']==$type[$t]->type){ echo 'selected="selected"'; }}  ?> > <?php echo $type[$t]->type; ?></option>
														

												 <?php  } ?>
											</select>
											
										</div>
									</div>
									<?php $style_type = ''; if(set_value('type')) { if(set_value('type') !="Simple") { $style_type ="style='display:none;'"; }}?>

									<div class="form-group" id="price" <?php echo $style_type; ?>>
										<label class="col-md-3 control-label">Price<samll class="error">*</samll></label>
										<div class="col-md-9">
											<input  value="<?php echo set_value('price');?>" name="price" type="text" placeholder="Enter price" class="form-control" onkeyup="input_grater_then_one(this);">
										    <?php echo form_error('price'); ?> 
										</div>
									</div>
									<div class="form-group" id="bar_code" <?php echo $style_type; ?> >
										<label class="col-md-3 control-label">Bar Code<samll class="error">*</samll></label>
										<div class="col-md-9">
											<input  value="<?php echo set_value('bar_code');?>" name="bar_code" type="text" placeholder="Enter bar code" class="form-control">
										    <?php echo form_error('bar_code'); ?> 
										</div>
									</div>                            
									
									<div class="form-group">
					                     <label class="col-md-3 control-label">Short Description<samll class="error">*</samll></label>
					                     <div class="col-md-9">
					                       <textarea  class="tinymce_edittor form-control" cols="100" rows="8" name="short_description"><?php  echo set_value('short_description'); ?></textarea>
					                       <?php echo form_error('short_description'); ?>
					                     </div>
					                </div>     
                                    <div class="form-group">
					                     <label class="col-md-3 control-label">Description<samll class="error"></samll></label>
					                     <div class="col-md-9">
					                       <textarea  class="tinymce_edittor form-control" cols="100" rows="15" name="description"><?php  echo set_value('description'); ?></textarea>
					                       <?php echo form_error('description'); ?>
					                     </div>
					                </div>
                                    
									<!-- POPULAR PRODUCTS -->
									<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-9">
											<div class="col-md-4">
												<div class="input-group">
													<span class="input-group-addon" style="text-align:left;     padding-top: 0px;">
														<input  value="1" name="popular" type="checkbox" > 
														<label class=" control-label"> POPULAR </label>
													</span>
												</div>
										    </div>
										
										     <div class="col-md-4">
										     	<div class="input-group">
													<span class="input-group-addon" style="text-align:left;     padding-top: 0px;"> 
														<input  value="1" name="recent" type="checkbox" checked class="form-control0"> 
														<label class=" control-label">RECENT</label>
													</span>
												</div>
										     </div>

										     <div class="col-md-4">
										     	<div class="input-group">
													<span class="input-group-addon" style="text-align:left;     padding-top: 0px;"> 
														<input  value="1" name="best" type="checkbox"  class="form-control0"> 
														<label class=" control-label">FEATURED </label>
													</span>
												</div>
										     </div>
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

<script type="text/javascript">
	
	$('#product_type').change(function(e){ 

		var type = this.value;
		if(type === 'Simple')
		{
			$('#price').show('slow');
			$('#bar_code').show('slow');
		}
		else
		{
			$('#price').hide('slow');
			$('#bar_code').hide('slow');

		}

	});

</script>

 
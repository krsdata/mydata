<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/tag/jquery.tag-editor.css">


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
								 Add Media
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action="" enctype="multipart/form-data" class="form-horizontal">
								<div class="form-body">																
								    <div class="form-group">
										<label class="col-md-3 control-label">Category<small class="error">*</small></label>
										<div class="col-md-9">
	                                        <select name="blog_category" class="form-control">
												 <option value="">Select Category</option>
										         <?php if(!empty($category)) { ?>
												 		<?php foreach ($category as $value) { ?>				
												          <option value="<?php echo $value->category_slug; ?>" <?php if(isset($_POST['blog_category'])){if($_POST['blog_category'] == $value->category_slug){?> selected="selected" <?php }}?> > <?php echo $value->category_name; ?></option>
												 		<?php }?>
												 <?php } ?>
											</select>
											<?php echo form_error('blog_category'); ?>  
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="col-md-3 control-label">Tag<small class="error">*</small></label>
										<div class="col-md-9">
	                                        <select name="blog_tagid" class="form-control">
	                                             <option value="">Select</option>
	                                            <?php //for($t=0;$t<count($tag);$t++) { ?>
												<option value="<?php //echo $tag[$t]->tag_slug; ?>"  > <?php //echo $tag[$t]->tag_name; ?></option>
												 <?php  //} ?>
											</select>
											<?php //echo form_error('blog_tagid'); ?>
										</div>
									</div> -->
									<div class="form-group">
										<label class="col-md-3 control-label">Tags<small class="error">*</small></label>
										<div class="col-md-9">
											<textarea id="tag_demo" name="blog_tagid" class="form-control"><?php echo set_value('blog_tagid'); ?></textarea>
											<?php echo form_error('blog_tagid'); ?>
										</div>										
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Title<small class="error">*</small></label>
										<div class="col-md-9">
											<input value="<?php echo set_value('blog_title');?>" name="blog_title" type="text" placeholder="Enter Title" class="form-control" maxlength="50" size="50">
											<label class="text-info"> ( Maximum 50 characters are allowed. )</label>
										    <?php echo form_error('blog_title'); ?> 
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="col-md-3 control-label">Slug</label>
										<div class="col-md-9">
											<input  value="{{title_slug | slugify}} <?php //echo set_value('blog_slug');?>" name="blog_slug" type="text" placeholder="Enter Slug" class="form-control">
										    <?php //echo form_error('blog_slug'); ?> 
										</div>
									</div> -->                                       
	                                <div class="form-group">
					                     <label class="col-md-3 control-label">Content<small class="error">*</small></label>
					                     <div class="col-md-9">
					                       <textarea  class="tinymce_edittor form-control" rows="6" name="blog_description"><?php  echo set_value('blog_description'); ?></textarea>
					                       <?php echo form_error('blog_description'); ?>
					                     </div>
					                </div>
					                <div class="form-group">
										<label class="col-md-3 control-label">Image Style<small class="error">*</small></label>
										<div class="col-md-9">
	                                        <select name="blog_style" class="form-control">
												 <option value="">Select View Style</option>
												 <?php $blog_image_sizes = blog_image_sizes(); ?>
										         <?php if(!empty($blog_image_sizes)) { ?>
												 		<?php foreach ($blog_image_sizes as $key => $value) { ?>
												          <option value="<?php echo $key; ?>" <?php if(isset($_POST['blog_style'])) { if($_POST['blog_style']==$key) { ?> selected="selected" <?php } } ?> > <?php echo $value; ?></option>
												 		<?php } ?>
												 <?php } ?>
											</select>
											<?php echo form_error('blog_style'); ?>
										</div>
									</div>                                                               
	                                <div class="form-group">
						                <label class="col-md-3 control-label form-label">Image<small class="error">*</small></label>
										<div class="col-md-9">                                       
											<input type="file" name="features_image" style="border:none;"> 
											<?php echo form_error('features_image'); ?>                                 
											<label class="text-info"> ( Image size atleast 500 x 500 pixels and maximum 700 x 700 pixels. And maximum file size is 2MB. )</label>
										</div>
					           		</div>
					           		<div class="form-group">
										<label class="col-md-3 control-label">Date<small class="error">*</small></label>
										<div class="col-md-3">
											<div class="input-group">
												<input value="<?php echo set_value('blog_created'); ?>" name="blog_created" type="text" placeholder="Select Event date" class="form-control datepicker date_icon_view" ata-date-format="mm/dd/yyyy" src="" aria-describedby="date_icon">
												<span class="input-group-addon date_icon_click" id="date_icon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
											<?php echo form_error('blog_created'); ?> 
										</div>
									</div>
	                                <div class="form-group">
										<label class="col-md-3 control-label">Status</label>
										<div class="col-md-9">
	                                        <select name="blog_status" class="form-control">
												<option value="1" <?php if(isset($_POST['blog_status'])){if($_POST['blog_status']==1){?> selected="selected" <?php }}?> >Active</option>
												<option value="0" <?php if(isset($_POST['blog_status'])){if($_POST['blog_status']==0){?> selected="selected" <?php }}?>>Inactive</option>												
											</select>									
										</div>
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
<!-- </div> -->
<!-- END CONTAINER-->
<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script> -->
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/tag/jquery.caret.min.js"></script>
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/tag/jquery.tag-editor.min.js"></script>
<script type="text/javascript">
	 $(function() {
	 		var tagList = <?php echo $blog_tag_list; ?>;
            $('#tag_demo').tagEditor({
                placeholder: 'Enter Media Tags ...',
                autocomplete: { source: tagList, delay: 250, html: true, position: { collision: 'flip' } }
            });
        });
</script>
 
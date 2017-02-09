	<?php if($this->uri->segment(5)=='detete'){ $tabactive="active"; $tabactive1=""; }else{ $tabactive=""; $tabactive1="active"; } ?>
<div class="page-content-wrapper">
	<div class="page-content">				
		
		<div class="clearfix"></div>
	
        <div class="row">
  
            <div class="col-md-12">                 
				<!-- BEGIN SAMPLE FORM PORTLET-->
				<div class="portlet box green product-add-warp">
					<div class="portlet-title">
					    <div>
						    <ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="<?php echo $tabactive1; ?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">
									<div class="caption">
										<i class="fa fa-pencil-square-o"></i>
										 Edit product
									</div>
									</a>
								</li>
                                <li class="<?php echo $tabactive; ?>" role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
									<div class="caption">
										<i class="fa fa-pencil-square-o"></i>
										Edit Image
									</div>
									</a>
	                            </li>
                            </ul>							
						</div>	
						<div class="clearfix"></div>
                 	</div>
                 
                    <div class="tab-content portlet-body">
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class=" form">
								<form  ng-controller="MyController" method="post" action="" enctype="multipart/form-data" class="form-horizontal">
									<div class="form-body">
									    <div class="form-group">
											<label class="col-md-3 control-label">Category</label>
											<div class="col-md-9">
						                        <select name="category_id" class="form-control">
													 <?php for($c=0;$c<count($category);$c++){ ?>
													 		<option value="<?php echo $category[$c]->id; ?>" <?php if(isset($update)){ if($update[0]->category_id==$category[$c]->id) { echo 'selected="selected"'; } } ?> > <?php echo $category[$c]->category_name; ?></option>
													 <?php } ?>
												</select>
											</div>
										</div>			
						                <div class="form-group">
											<label class="col-md-3 control-label">Title</label>
											<div class="col-md-9">
												<input ng-modelw="slug_title" value="<?php if(isset($update)) { echo $update[0]->title; } echo set_value('title');?>" name="title" type="text" placeholder="Enter Title" class="form-control">
											    <?php echo form_error('title'); ?> 
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label">Slug</label>
											<div class="col-md-9">
												<input  value="{{slug_title | slugify}}<?php if(isset($update)) { echo $update[0]->slug; } echo set_value('slug');?>" name="slug" type="text" placeholder="Enter Slug" class="form-control">
											    <?php echo form_error('slug'); ?> 
											</div>
										</div>
											<!--
						                <?php //if(isset($update)) { 
						                	//if($update[0]->type=="Simple") { ?>
											    <div class="form-group">
													<label class="col-md-3 control-label">Type</label>
													<div class="col-md-9">
						                                <select  name="type" class="form-control">
						                                    <option value="Simple">Simple</option>
														</select>
														
													</div>
												</div>
						                    <?php //} else {  ?>
						                        <div class="form-group">
													<label class="col-md-3 control-label">Type</label>
													<div class="col-md-7">
						                                <select name="type" class="form-control">
						                                   <option  value="Variation">Variation</option>
														</select>
													
													</div>
													<div class="col-md-2" > 
						                                <a href="#draggable" data-toggle="modal" class="btn default"> Add variation  </a>
													</div>
												</div> 
						                <?php  //} }  ?>  -->  
						                <div class="form-group">
											<label  class="col-md-3 control-label">Type</label>
											<div class="col-md-7">
						                        <select name="type" class="form-control" id="type">
						                            		<option value="">Select Variation Type</option> 
						                            <?php for($t=0;$t<count($type);$t++) { ?>
															
															<?php if($type[$t]->type=='Variation') { ?>
																<optgroup label="<?php echo $type[$t]->type; ?>">
																	<?php for($y=0;$y<count($variation);$y++) { ?>
																       <option value="<?php echo $variation[$y]->attribute; ?>" <?php  if($update[0]->type == $variation[$y]->attribute){ echo 'selected="selected"'; }  ?> > <?php echo $variation[$y]->attribute; ?></option>
																    <?php } ?>
																</optgroup>
															<?php } else { ?>
																	<option value="<?php echo $type[$t]->type; ?>" <?php if($update[0]->type==$type[$t]->type){ echo 'selected="selected"'; }  ?> > <?php echo $type[$t]->type; ?></option>
															<?php } ?>

													 <?php  } ?>
												</select>
												
											</div>

											<div class="col-md-2">
											   <?php if($update[0]->type!="Simple") { ?>
											        <a href="#draggable" data-toggle="modal" class="btn default"> Add variation  </a>
											   <?php }?>
											</div>
										</div> 
						                <!--   
						                 <div  class="form-group">
											<label class="col-md-3 control-label">Attribute</label>
											<div class="col-md-7">
						                        <select ng-model="attribute" ng-change="GetAttribute(this)" name="attribute" class="form-control">
						                            <?php //for($a=0;$a<count($attribute);$a++) { ?>
													<option value="<?php //echo $attribute[$a]->id; ?>"> <?php //echo $attribute[$a]->attribute; ?></option>
													 <?php  //} ?>
												</select>
												
											</div>
											<div class="col-md-2" > 
						                        	<a href="#draggable" data-toggle="modal" class="btn default">Add variation</a>
											</div>
										</div>
						                -->
						                <div ng-repeat="result in data" >                                   	
						                    <div class="form-group">
												<label class="col-md-3 control-label">{{result.name}}</label>
												<div class="col-md-9">
													<input  value="{{result.name}}" name="attribute[]" type="text" placeholder="Enter Title" class="form-control">
												    <?php echo form_error('title'); ?> 
												</div>
											 </div>          
						                </div>

						                <div class="form-group">
											 <label class="col-md-3 control-label">Description</label>
											 <div class="col-md-9">
											   <textarea  class="tinymce_edittor form-control" cols="100" rows="12" name="description"><?php if(isset($update)) { echo $update[0]->description; } echo set_value('description'); ?></textarea>
											   <?php echo form_error('description'); ?>
											 </div>
										</div>
						              
						                <div  class="form-group">
											<label class="col-md-3 control-label">Price</label>
											<div class="col-md-9">
												<input  value="<?php if(isset($update)) { echo $update[0]->price; }   echo set_value('price');?>" name="price" type="text" placeholder="Enter price" class="form-control">
											    <?php echo form_error('price'); ?> 
											</div>
										</div>
						                 
						                <div class="form-group">
											<label class="col-md-3 control-label">Status</label>
											<div class="col-md-9">
						                        <select name="status" class="form-control">
													<option value="1" <?php if(isset($update)){if($update[0]->status==1){?> selected="selected" <?php }}?> >Active</option>
													<option value="0" <?php if(isset($update)){if($update[0]->status==0){?> selected="selected" <?php }}?>>inactive</option>
													
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
                        <div role="tabpanel" class="tab-pane" id="profile">

                            <div class="table-responsive">

								<table class="table table-bordered table-hover">

									<thead>

										<tr>
											<th width="5%">#</th>
											<th width="85%">Image</th>								
											<th width="10%">Actions</th>
										</tr>

									</thead>

									<tbody>
											<?php if (!empty($update_image)):
				                               
												  $i = 0; foreach ($update_image as $row) { $i++;
													?>

													<tr>

														<td><?php echo $i . "."; ?></td>
				                                         
														<td><img width="200px" src="<?php echo base_url().'/assets/uploads/product/'. $row->image; ?>">
														</td>
														<td>
				                                       		<a href="<?php echo base_url('backend/products/deleteimage/'.$row->id.'/'.$row->product_id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>
														</td>

													</tr>

											<?php } ?><?php else: ?>

													<tr>
														<th colspan="7">
															<center>No product Image Found.</center>
														</th>
													</tr>
											<?php endif; ?>
									</tbody>

								</table>

								<div class="text-right">

									<?php if (!empty($pagination)) echo $pagination; ?>

								</div>

							</div>

	                    	<div id="mulitplefileuploader">Upload</div>

							<div id="status"></div>
	                    </div>
               		</div>
             	</div> 
			</div>
				<!-- END SAMPLE FORM PORTLET-->				
				
		</div>
    </div>
</div>

</div>
<!-- END CONTAINER-->
<script type="text/javascript">
$(document).ready(function()
{
    $('#type').change(function(event) {
			if(confirm('Are you sour to change variation ?'))
			{
					alert(this.value);
			}
			else
			{
				alert('no');
			}
	});
	
});
</script>

<div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add variation</h4>
          </div>
          <div class="modal-body">                    
              <div class="portlet-body form">
                  <form  method="post" action="<?php echo base_url('backend/products/addvariation/'.$this->uri->segment(4).''); ?>" class="form-horizontal">
                      <div class="form-body">
                          <div class="control-group">
                            <label class="control-label">Variation Key</label>
                            <div class="controls">
                              <input type="text" name="LessionViewOneSentence0" id="LessionViewOneSentence0" class="input-xlarge" value="" />
                            <div class="form_error" style="display:none" id="error_viewone_sentence0">Variation Key field required</div>
                            </div>
                          </div>
                          <div class="control-group">
                              <label class="control-label">Variation value</label>
                              <div class="controls">
                                <input type="text" name="LessionViewOneOtherSentence0" id="LessionViewOneOtherSentence0" class="input-xlarge" value="" />
                              <div class="form_error" style="display:none" id="error_viewone_other0">Variation value field required</div>
                              </div>
                              <input type="hidden"  value="1" id="count_view_one" name="count_view_one" style="width:20%"/>
                          </div>                                                           
                          <div class="control-group" id="imageAdd2" style="margin-left: 6px; margin-top: 8px;">                            
                              <span class="content"  onClick="addmorecontentviewone()" id="add0"><h3>Add More Content</h3><img src="<?php echo base_url()?>assets/admin/layout/img/Add_add.png"/></span>
                          </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn default" data-dismiss="modal">Close</button>
                          <button onclick="return validation()" type="submit" class="btn blue">Save</button>
                      </div>
                  </form>
              </div>     
          </div>
        </div>
        <!-- /.modal-content
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade draggable-modal" id="draggableupdate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add variation</h4>
              </div>
              <div class="modal-body">
              
                    <div class="portlet-body form">
                        <form  method="post" action="<?php echo base_url('backend/products/addvariation/'.$this->uri->segment(4).''); ?>" class="form-horizontal">
                            <div class="form-body">                                                                          
                                  <div class="control-group">
                                      <label class="control-label">Variation Key</label>
                                      <div class="controls">
                                        <input type="text" name="LessionViewOneSentence0" id="LessionViewOneSentence0" class="input-xlarge" value="" />
                                      <div class="form_error" style="display:none" id="error_viewone_sentence0">Variation Key field required</div>
                                      </div>
                                  </div>

                                  <div class="control-group">
                                      <label class="control-label">Variation value</label>
                                      <div class="controls">
                                        <input type="text" name="LessionViewOneOtherSentence0" id="LessionViewOneOtherSentence0" class="input-xlarge" value="" />
                                      <div class="form_error" style="display:none" id="error_viewone_other0">Variation value field required</div>
                                      </div>
                                      <input type="hidden"  value="1" id="count_view_one" name="count_view_one" style="width:20%"/>
                                  </div>                                   
                                                                                                
                                  <div class="control-group" id="imageAdd2" style="margin-left: 6px; margin-top: 8px;">                                    
                                      <span class="content"  onClick="addmorecontentviewone()" id="add0"><h3>Add More Content</h3><img src="<?php echo base_url()?>assets/admin/layout/img/Add_add.png"/></span>
                                  </div>                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn default" data-dismiss="modal">Close</button>
                              <button onclick="return validation()" type="submit" class="btn blue">Save</button>
                            </div>
                        </form>
                    </div>     
              </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 
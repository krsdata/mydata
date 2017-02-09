<?php 
	$tab1=$tab2=$tab3=$tab4=$tab5='';
	if($tab=='home')
	{
		$tab1='active';
	}
	else if($tab=='attributes')
	{
		$tab2='active';
	}
	else if($tab=='variation')
	{
		$tab3='active';
	}
	else if($tab=='profile')
	{
		$tab4='active';
	}
	else if($tab == 'distributor')
	{
		$tab5='active';
	}
	else
	{
		$tab1='active';
	}
	//echo $tab1.'-'.$tab; die();
?>


	<div class="page-content-wrapper">
		<div class="page-content">				
			
			<div class="clearfix">
			</div>
		
            	<div class="row">
  
	                <div class="col-md-12">
	                	<div id="my_top_cantiner"><?php echo msg_alert_backend(); ?> </div>               
						<!-- BEGIN SAMPLE FORM PORTLET-->
						<div class="portlet box green product-add-warp">
						    
							<div class="portlet-title">
							    <!-- <div> -->
								    <ul class="nav nav-tabs pull-left" role="tablist">
										<li  role="presentation" class="<?php echo $tab1; ?>">
											<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
												<div class="caption">
													<i class="fa fa-plus"></i>
													 Details
												</div>
											</a>
										</li>
										<?php if(isset($update)) { if($update[0]->type!="Simple") { ?>
										<li role="presentation" class="<?php echo $tab2; ?>">
											<a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">
												<div class="caption">
													<i class="fa fa-plus"></i>
													 Attributes
												</div>
											</a>
										</li>
										<?php } }?>
										<?php if(isset($update)) { if(!empty($update[0]->attributes) && $variation_status) { ?>
										<li role="presentation" class="<?php echo $tab3; ?>">
											<a href="#variation" aria-controls="variation" role="tab" data-toggle="tab">
												<div class="caption">
													<i class="fa fa-plus"></i>
													Variation
												</div>
											</a>
										</li>
										<?php } }?>
		                                <li  role="presentation" class="<?php echo $tab4; ?>">
			                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
												<div class="caption">
													<i class="fa fa-plus"></i>
													 Image
												</div>
											</a>
		                                </li>
		                                <li  role="presentation" class="<?php echo $tab5; ?>">
			                                <a href="#distributor" aria-controls="distributor" role="tab" data-toggle="tab">
												<div class="caption">
													<i class="fa fa-plus"></i>
													 Distributors
												</div>
											</a>
		                                </li>
		                            </ul>							
								<!-- </div> -->	
								<!-- <div class="clearfix"></div> -->
	                     	</div>
	                     	<?php //echo validation_errors(); ?>
	                        <div class="tab-content portlet-body">

	    						<div role="tabpanel" class="tab-pane <?php echo $tab1; ?>" id="home">
									<div class="form">
										<form  ng-controller="MyController" method="post" action="" enctype="multipart/form-data" class="form-horizontal">
											<div class="form-body">
											    <div class="form-group">
													<label class="col-md-3 control-label">Category<samll class="error">*</samll></label>
													<div class="col-md-9">
			                                            <select name="category_id" class="form-control">
															 <?php for($c=0;$c<count($category);$c++){ ?>
															 <option value="<?php echo $category[$c]->id; ?>" <?php if(isset($update)){ if($update[0]->category_id==$category[$c]->id) { echo 'selected="selected"'; } } ?> > <?php echo $category[$c]->category_name; ?></option>
															 <?php } ?>
														</select>
														
													</div>
												</div>
												 <div class="form-group">
													<label class="col-md-3 control-label">Title<samll class="error">*</samll></label>
													<div class="col-md-9">
														<input value="<?php if(isset($update)) { echo $update[0]->title; } else  { echo set_value('title'); }?>" name="title" type="text" placeholder="Enter Title" class="form-control">
													    <?php echo form_error('title'); ?> 
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label">Type<samll class="error">*</samll></label>
													<div class="col-md-9">
			                                            <select  name="type" class="form-control" id="product_type">
			                                                <option value="Simple" <?php if(set_value('type')) { if(set_value('type')=="Simple") echo "selected"; } else { if($update[0]->type=="Simple") echo "selected"; } ?> >Simple</option>
				                                            <option  value="Variation" <?php if(set_value('type')) { if(set_value('type')=="Variation") echo "selected"; } else { if($update[0]->type=="Variation") echo "selected"; } ?>>Variation</option>
														</select>
													</div>
												</div>
												<?php $style_type = ''; if(set_value('type')) {  if(set_value('type') !="Simple") { $style_type ="style='display:none;'"; } } else { if(isset($update)) { if($update[0]->type !="Simple") { $style_type ="style='display:none;'"; }} }?>
												<div  class="form-group" id="price" <?php echo $style_type; ?> >
													<label class="col-md-3 control-label">Price<samll class="error">*</samll></label>
													<div class="col-md-9">
														<input  value="<?php if(isset($update)) { if(!empty($update[0]->price)) echo $update[0]->price; } else {   echo set_value('price'); } ?>" name="price" type="text" placeholder="Enter price" class="form-control" onkeyup="input_grater_then_one(this);">
													    <?php echo form_error('price'); ?> 
													</div>
												</div>
												<div  class="form-group" id="bar_code" <?php echo $style_type; ?> >
													<label class="col-md-3 control-label">Bar Code<samll class="error">*</samll></label>
													<div class="col-md-9">
														<input  value="<?php if(isset($update)) { echo $update[0]->bar_code; } else {   echo set_value('bar_code'); } ?>" name="bar_code" type="text" placeholder="Enter bar code" class="form-control" >
													    <?php echo form_error('bar_code'); ?> 
													</div>
												</div>	
												<div class="form-group">
													 <label class="col-md-3 control-label">Short Description<samll class="error">*</samll></label>
													 <div class="col-md-9">
													   <textarea  class="tinymce_edittor form-control" cols="100" rows="8" name="short_description"><?php if(isset($update)) { echo $update[0]->short_description; } else { echo set_value('short_description'); } ?></textarea>
													   <?php echo form_error('short_description'); ?>
													 </div>
												</div>       
												<div class="form-group">
													 <label class="col-md-3 control-label">Description<samll class="error">*</samll></label>
													 <div class="col-md-9">
													   <textarea  class="tinymce_edittor form-control" cols="100" rows="15" name="description"><?php if(isset($update)) { echo $update[0]->description; } else { echo set_value('description'); } ?></textarea>
													   <?php echo form_error('description'); ?>
													 </div>
												</div>
			                                  
			                                  	
												<div class="form-group">

													<label class="col-md-3 control-label"></label>
													<div class="col-md-9">
														<div class="row">	
															<div class="col-xs-12 col-sm-4 col-md-4">
																 <div class="input-group">
															      	<span class="input-group-addon" style="text-align:left;">
															       		<input  value="1" name="popular" type="checkbox" <?php if(isset($update)) { if($update[0]->popular) echo"checked"; }?> > 
																		<label class="control-label"> POPULAR  </label>
															      	</span>
															    </div>															
														  	</div> 
														
														    <div class="col-xs-12 col-sm-4 col-md-4">
														     	<div class="input-group">
															      	<span class="input-group-addon" style="text-align:left;">
															       		<input  value="1" name="recent" type="checkbox" <?php if(isset($update)) { if($update[0]->recent) echo"checked"; }?> class="form-control0"> 
																		<label class=" control-label">RECENT </label>
															      	</span>	   
															    </div>
															</div>

														    <div class="col-xs-12 col-sm-4 col-md-4"> 
														     	<div class="input-group">
															      	<span class="input-group-addon" style="text-align:left;">
															       		<input  value="1" name="best" type="checkbox" <?php if(isset($update)) { if($update[0]->best) echo"checked"; }?> class="form-control0">
																		<label class=" control-label">FEATURED  </label>
															      	</span>		 
															    </div>
														    </div>
														</div>
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
													 
													<a href="<?php echo base_url('backend/products/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>

			                                     
													</div>
												</div>
											</div>
										</form>
									</div>                       
	                            </div>

	                            <div role="tabpanel" class="tab-pane <?php echo $tab2; ?>" id="attributes">
									<div class="form">
										<form  ng-controller="MyController" method="post" action="<?php echo base_url('backend/products/add_attributes/'.$product_id.'/'.$offset)?>" class="form-horizontal" onsubmit="return variation_submit()">
											<div class="form-body">
											    <div class="form-group">
													<label class="col-md-3 control-label">Select Attribute</label>
													<div class="col-md-9">
														<?php if(count($all_attribute)>0) { 
																if(!empty($update[0]->attributes)) $attributes =json_decode($update[0]->attributes);
																else $attributes =array();
															?>
															<?php foreach ($all_attribute as $row) { ?>
																<?php if($row->count > 0) { ?>
																	<div class="col-md-6">
																			<input type="checkbox" name="attributes[]" value="<?php echo $row->id;?>" <?php if(in_array($row->id, $attributes)) echo "checked"; ?> > &nbsp; <?php echo $row->attribute;?>
																	</div>
																<?php } ?>
															<?php }?>
																<div class="clearfix"></div>
														<?php } ?> 
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
													
													    <input class="btn green" type="submit" name="add_attribute" value="Save Attributes">
													    <a href="<?php echo base_url('backend/products/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>		                                     
													</div>
												</div>
											</div>
										</form>
									</div>                       
	                            </div>

	                            <div role="tabpanel" class="tab-pane <?php echo $tab3; ?>" id="variation">
									<div class="form">
										<form  ng-controller="MyController" method="post" action="<?php echo base_url('backend/products/save_variations/'.$product_id.'/'.$offset);?>" class="form-horizontal" onsubmit="return variation_check()" >
											<div class="form-body">
												<div class="form-group">
													<!-- <label class="col-md-12 control-label0">Select Variation</label> -->
													<div class="col-md-12">
														<span class="btn green control-span0" id="variation_add">Add more</span>
													</div>
												</div>
											    <div class="form-group">
													
													<div class="col-md-12" id="all_variation_rows">
														<?php if(count($all_variation)>0) { ?>

															<?php if(count($variation)>0) { $vc=0; ?>
															    
																<?php foreach ($variation as $key) { ?>
																		<?php
																		$variation_key = json_decode($key->variation_key);
																		$variation_key_count = count($variation_key);
																		$attribute_keys  = json_decode($key->attribute_key);
																		$attribute_count = count($attribute_keys);
																		?>
																	<div class="form-group" id="variation_row_<?php echo $vc ?>">
																		<div class="col-md-2">
																			Bar Code
																			<input type="text"  required="" name="bar_code_<?php echo $key->id; ?>" value="<?php if(!empty($key->bar_code)) echo $key->bar_code; ?>" class="form-control" placeholder="Enter bar code">
																		</div>
																		<?php for ($ac=0; $ac < $attribute_count; $ac++) { ?> 
																			<div class="col-md-2">
																				<?php echo ucwords(strtolower(attribute_name($attribute_keys[$ac]))); ?>
																				<select name="var_<?php echo $ac;?>_<?php echo $key->id;?>" class="form-control kkk" required="">
																					<?php foreach ($all_variation as $row) { ?>
																						<?php if($row->attribute_id==$attribute_keys[$ac]) { ?>
																						<option value="<?php echo $row->id;?>" <?php if($variation_key_count>$ac && $row->id ==$variation_key[$ac]) echo "selected"; ?>><?php echo $row->name; ?></option>
																						<?php } ?>
																					<?php } ?>
																				</select>
																			</div>
																		<?php } ?>
																			<div class="col-md-1">
																				<?php echo ucwords(strtolower('PRICE')); ?>
																				<input type="text"  required="" name="price_<?php echo $key->id; ?>" value="<?php if(!empty($key->attribute_value)) echo $key->attribute_value; ?>" class="form-control" placeholder="Enter price" onkeyup="input_grater_then_one(this);">
																			</div>
																			<div class="col-md-1 pull-right">
																			  <?php if($vc>0) { ?>
																			     <label onclick="remove_variarion(<?php echo $key->id;?>,<?php echo $vc;?>);" class="text-danger" style ="cursor: pointer">remove</label>
																			  <?php } ?>
																			</div>
																			<div class="clearfix"></div>
																			<hr>
																	</div>
																	 <?php $vc++;?>
																<?php } ?>
															<?php } ?>

														<?php } ?> 
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
													
													    <input class="btn green" type="submit" name="add_attribute" value="Save Variation">
													    <a href="<?php echo base_url('backend/products/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>		                                     
													</div>
												</div>
											</div>
										</form>
									</div>                       
	                            </div>

	                            <div role="tabpanel" class="tab-pane <?php echo $tab5; ?>" id="distributor">
									<div class="form">
										<form  ng-controller="MyController" method="post" action="<?php echo base_url('backend/products/save_distributor/'.$product_id.'/'.$offset);?>" class="form-horizontal" onsubmit="return variation_check()" >
											<div class="form-body">
											    <div class="form-group">
													
													<label class="col-md-2 control-label">Select Distributor</label>
											        <div class="col-md-8">
											        	<select multiple="multiple" class="form-control" id="multiSelect" name="distributor_array[]">
											        	<?php if(!empty($distributor)) { ?>
											                <?php foreach ($distributor as $distributor_row) { ?>
												        		<?php 
												        			$my_products = json_decode($distributor_row->my_products); 
												        			if(!is_array($my_products)) $my_products = array();
												        		?>
																<option value='<?php echo $distributor_row->id; ?>' <?php if(in_array($update[0]->id, $my_products)) echo 'selected';?>><?php echo $distributor_row->title; ?></option>
											                <?php }?>
														<?php } ?>
														</select>										  
											        </div>
											        <div class="col-md-3">
											        	<span class="text-muted"></span>
											        </div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
													    <input class="btn green" type="submit" name="add_attribute" value="Update Distributors">
													    <a href="<?php echo base_url('backend/products/index/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>		                                     
													</div>
												</div>
											</div>
										</form>
									</div> 
	                            </div>
	                       
								<div role="tabpanel" class="tab-pane <?php echo $tab4; ?>" id="profile">
									<?php 
										if (!empty($update_image)) 
										{ 
											if(count($update_image)>=6) 
											{ 
												$image_button_style="style='display:none;'" ;
											}  
											else 
											{ 
												$image_button_style=''; 
											} 
										} 
										else 
										{
											$image_button_style='';
										} 

										$upload_image_count = 6;
										if (!empty($update_image))
										{
											$currentUploaded_image_count = count($update_image);
											if($currentUploaded_image_count>=6)
											{
												$upload_image_count = 0;
											}
											else
											{
												$upload_image_count = 6-$currentUploaded_image_count;
											}
										}




										?>
									<div <?php echo $image_button_style;?>>
										<div id="mulitplefileuploader" >
											<label class="btn green">Select Image</label>
										</div>
										<div id="upload_status">
											<label class="text-info">( Image needs to be at least 450 x 400 pixels and maximum 900 x 800 pixels. and now you can add only <?php echo $upload_image_count ?> image.)</label>
										</div>
									</div>
									<div class="table-responsive">

										<table class="table table-bordered table-hover">

											<thead>

												<tr>
													<th width="5%">#</th>
													<th width="75%">Image</th>
													<th width="10%">Front Image</th>								
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
																<td><input type="radio" value="<?php echo $row->id.'_'.$row->product_id; ?>" name="image_radio" <?php if($row->active) echo "checked";?> >
																</td>
																<td>
						                                       		<a href="<?php echo base_url('backend/products/deleteimage/'.$row->id.'/'.$row->product_id.'/'.$offset) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>
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
									<!-- <div id="mulitplefileuploader"><label class="btn green">Select Image</label></div> -->

									<a href="<?php echo base_url('backend/products/index/'.$offset); ?>" class="btn default">Cancel</a>

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
</div>
<!-- END CONTAINER-->
<script type="text/javascript">
	
$('#variation_add').click(function(event) {
	var html = $('#variation_row_0').html();
	//$('#all_variation_rows').append(html);
	var productid = <?php echo $product_id; ?>;
	var attri     = '<?php echo $update[0]->attributes; ?>';
	$.post('<?php echo base_url("backend/products/add_more_variation"); ?>/',{ id:productid,attr:attri},
			 function(data) {
			        /*if(data=='TRUE'){
			        	bootbox.alert("Deleted Successfully");
			        	window.location.hash = '#tab_description';
			        	location.reload();
			        } */
			        $('#all_variation_rows').append(data);
			    });
});

$( "input[name='image_radio']" ).change(function(event) 
{
	$.post('<?php echo base_url("backend/products/change_active_image"); ?>',{ id:this.value},
			 function(data) {
			    
		    });
});

</script>
<script>

	function remove_variarion(id,row)
	{
		if(confirm('Are you sure to delete variarion ?'))
		{
			$.post('<?php echo base_url("backend/products/remove_more_variation"); ?>',{ id:id},
				function(data) {
				        if(data)
				        {
				        	$('#variation_row_'+row).remove();
				        	var divCount = $("#all_variation_rows > div").length;

				        	for (var i = 1; i <= divCount; i++) 
							{
								var k = i-1;
								$("#all_variation_rows > div:nth-child("+i+")").attr('id','variation_row_'+k+'');
							}
				        }
			    });
		}
	}

	function variation_submit()
	{
		//alert('check');
		if(confirm('Are you sure to save attributes. And remove all previous variations of it if any. '))
		{
			 return true;
		}
		else
		{
			 return false;
		}
	}

	function variation_check()
	{
		var flag = 1;
		var testArray = [];
		var barArray = [];
		var divCount = $("#all_variation_rows > div").length;
		for (var i = 0; i < divCount; i++) 
		{
			var subDivCount= $("#variation_row_"+i+"> div").length;
			subDivCount = subDivCount-3;
		
			var tempList='';
			for (var j = 2; j <= subDivCount; j++) 
			{
				if(j==1)
				{
					tempList = $("#variation_row_"+i+" div:nth-child("+j+") select option:selected").val();
				}
				else
				{
					tempList = tempList+'_'+$("#variation_row_"+i+" div:nth-child("+j+") select option:selected").val();
				}

			};
			if($.inArray(tempList,testArray)>-1)
			{
				flag=0;
			}
			else
			{
				testArray.push(tempList);
			}


			var tempList2 ='';
			tempList2 = $("#variation_row_"+i+" div:nth-child(1) input").val();

			if($.inArray(tempList2,barArray)>-1)
			{
				flag=0;
			}
			else
			{
				barArray.push(tempList2);
			}




		};
		if(flag==1)
		{
			return true;
		}
		else
		{	
			var html = '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i> Please remove duplicate entries.</div>';
			$("#my_top_cantiner").html(html);

			return false;
		}
	}

</script>
<!-- return false; -->
<script>
		window.onload = function() {
		        $("form").bind("keypress", function(e) {
		            if (e.keyCode == 13) {
		                return false;
		            }
		        });
		    }
</script>

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

	/*$(document).ready(function() {
    	var type = $('#product_type').val();
		if(type === 'Simple')
		{
			//alert(type);
			$('#price').show();
			$('#bar_code').show();
		}
		else
		{
			//alert(type);
			$('#price').hide();
			$('#bar_code').hide();

		}
	});*/

</script>
<?php 
$upload_image_count = 6;
if (!empty($update_image))
{
	$currentUploaded_image_count = count($update_image);
	if($currentUploaded_image_count>=6)
	{
		$upload_image_count = 0;
	}
	else
	{
		$upload_image_count = 6-$currentUploaded_image_count;
	}
}

 ?>
<script>
  $(document).ready(function()
  {
      var SEGMENT = '<?php echo $this->uri->segment(4); ?>';
      var SEGMENT6 = '<?php echo $this->uri->segment(6); ?>';
      var upload_image_count = <?php echo $upload_image_count; ?>;
      if(SEGMENT6.length<1)
        SEGMENT6 = 0;
      //alert(SEGMENT6);
      var result = '';
      var count = 1;
      var settings = 
      {
        url: BASEURL+"backend/products/upload/"+SEGMENT,
        method: "POST",
        allowedTypes:"jpg,png,gif,jpeg",
        fileName: "myfile",
        maxFileCount: upload_image_count,
        multiple: true,
        onSuccess:function(files,data,xhr)
        {
          //$("#status").html("<font color='green'>Upload is success</font>");
          var obj = JSON.parse(data);
          result  = result +'<p>'+count+' ) '+files+'</p>';
          result  = result + obj[files]+'<hr>';
          count++;
          //alert(obj[files]);
          //$("#upload_status").append(obj);
          $(".upload-statusbar").remove();
        },
        afterUploadAll:function()
        {          
            //$("#upload_status").html(result);
            $.post('<?php echo base_url("backend/products/reload_image_page"); ?>',{ html:result},
             function(data) {
                if(data)
                {
                  //http://localhost/lashulashes/backend/products/add_one/24/home/1
                  var url = "<?php echo base_url('backend/products/add_one')?>/"+SEGMENT+'/profile/'+SEGMENT6;
                 //window.location.hash = '#/profile';
                 //location.reload();
                 window.location.assign(url);
                }
              });
            result='';
            count= 1;
            //alert("all images uploaded!!");
            //location.reload(); 
        },
        onError: function(files,status,errMsg)
        {   
          $("#status").html("<font color='red'>Upload is Failed</font>");
        }
      }

      $("#mulitplefileuploader").uploadFile(settings);

  });
</script>
<?php 
//$tabSegment = $this->uri->segment(5);
$tabSegment = $tab;
$tab0=$tab1=$tab2=$tab3 = '';
$workinTimes = array();
$services = array();
$servicesCount  = 0;

if($tabSegment)
{
	if($tabSegment == 0)
		$tab0 = 'active';
	if($tabSegment == 1)
		$tab1 = 'active';
	if($tabSegment == 2)
		$tab2 = 'active';
	if($tabSegment == 3)
		$tab3 = 'active';

}
else
{
	$tab0 = 'active';
}

if(!empty($detail->timing))
{	
	$detail->timing  = json_decode($detail->timing);
	if(is_array($detail->timing) && !empty($detail->timing))
	{
		$workinTimes = $detail->timing;
	}
}

if(!empty($detail->services))
{	
	$services  = (array) json_decode($detail->services);
	$servicesCount = count($services);
}

?>

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
						<ul class="nav nav-tabs pull-left artistTab0" role="tablist">
							<li  role="presentation" class="<?php echo $tab0; ?>">
								<a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">
									<div class="caption">
										<i class="fa fa-plus"></i>
										<span> Detail</span>
									</div>
								</a>
							</li>
							<li  role="presentation" class="<?php echo $tab1; ?>">
								<a href="#workingDay" aria-controls="workingDay" role="tab" data-toggle="tab">
									<div class="caption">
										<i class="fa fa-plus"></i>
										<span> Working Days</span>
									</div>
								</a>
							</li>
							<li role="presentation" class="<?php echo $tab2; ?>">
								<a href="#services" aria-controls="services" role="tab" data-toggle="tab">
									<div class="caption">
										<i class="fa fa-plus"></i>
										<span> Services</span>
									</div>
								</a>
							</li>
							<li role="presentation" class="<?php echo $tab3; ?>">
								<a href="#offs" aria-controls="offs" role="tab" data-toggle="tab">
									<div class="caption">
										<i class="fa fa-plus"></i>
										<span> Off</span>
									</div>
								</a>
							</li>	
                        </ul>	
					</div>

					<div class=" portlet-body form">
						<div class="form-body"> 
							<form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
								<div class="tab-content">
		                 			<div role="tabpanel" class="tab-pane <?php echo $tab0; ?>" id="detail">
									    <div class="form-group">
										    <div class="col-md-12">

										    	<div class="form-group">
													<label class="col-md-2 control-label">Name<small class="error">*</small></label>
													<div class="col-md-4">
														<input  value="<?php if(!empty($detail->name)) echo $detail->name;?>" name="name" type="text" placeholder="Artist name" class="form-control">
													    <?php echo form_error('name'); ?> 
													</div>
												</div>

												<div class="form-group">
								                    <label class="col-md-2 control-label">Short Description<small class="error">*</small></label>
								                    <div class="col-md-9">
								                       <textarea  class="form-control" cols="100"  maxlength="400" rows="5" name="description" onkeyup="max_text_count(this);"><?php if(!empty($detail->detail)) echo $detail->detail;?></textarea>
								                       <?php echo form_error('description'); ?>
								                       <label class="text-info" id="text_count_msg">Maximum 400 character are allowed.</label>
								                    </div>
								                </div>
				                                  
				                                <div class="form-group">
													<label class="col-md-2 control-label">Image<small class="error">*</small></label>
													<div class="col-md-9">
														<input value="" name="service_image" type="file"  >
														<?php echo form_error('service_image'); ?>
														<label class="text-info"> ( Image size atleast 400 x 400 pixels and maximum 600 x 600 pixels. And maximum file size is 2MB. )</label>
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-2 control-label">Status</label>
													<div class="col-md-4">
												        <select name="status" class="form-control">
															<option value="1" <?php if($detail->status==1){?> selected="selected" <?php }?> >Active</option>
															<option value="0" <?php if($detail->status==0){?> selected="selected" <?php }?>>Inactive</option>												
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label"> </label>
													<div class="col-md-4">
														<input class="btn green" type="submit" name="detail" value="Update">
														<a href="<?php echo base_url(); ?>backend/services/artist"> <button  class="btn default" type="button">Cancel</button></a>
													</div>
												</div>
										    </div>
									    </div>
									</div>

		    						<div role="tabpanel" class="tab-pane <?php echo $tab1; ?>" id="workingDay">
									    <div class="form-group">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer">
																<ul>
																	<li>Sunday</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[0][0])) echo $workinTimes[0][0];?>" type="text" name="timeStart1" class="timeStart time24" placeholder="09:00">
						  											</li>
																	<li> - To - </li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[0][1])) echo $workinTimes[0][1];?>" type="text" name="timeEnd1" class="timeEnd time24" placeholder="17:00" >
				  													</li>
																</ul>
																<?php echo form_error('timeStart1'); ?> 
																<?php echo form_error('timeEnd1'); ?> 
															</div>
														</div>
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer">
																<ul>
																	<li>Monday</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[1][0])) echo $workinTimes[1][0];?>" type="text" name="timeStart2" class="timeStart time24" placeholder="09:00">
						  											</li>
																	<li> - To - </li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[1][1])) echo $workinTimes[1][1];?>" type="text" name="timeEnd2" class="timeEnd time24" placeholder="17:00" >
				  													</li>
																</ul>
																<?php echo form_error('timeStart2'); ?> 
																<?php echo form_error('timeEnd2'); ?> 
															</div>
														</div>
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer">
																<ul>
																	<li>Tuesday</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[2][0])) echo $workinTimes[2][0];?>" type="text" name="timeStart3" class="timeStart time24" placeholder="09:00">
						  											</li>
																	<li> - To - </li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[2][1])) echo $workinTimes[2][1];?>" type="text" name="timeEnd3" class="timeEnd time24" placeholder="17:00" >
				  													</li>
																</ul>
																<?php echo form_error('timeStart3'); ?> 
																<?php echo form_error('timeEnd3'); ?> 
															</div>
														</div>
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer">
																<ul>
																	<li>Wednesday</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[3][0])) echo $workinTimes[3][0];?>" type="text" name="timeStart4" class="timeStart time24" placeholder="09:00">
						  											</li>
																	<li> - To - </li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[3][1])) echo $workinTimes[3][1];?>" type="text" name="timeEnd4" class="timeEnd time24" placeholder="17:00" >
				  													</li>
																</ul>
																<?php echo form_error('timeStart4'); ?> 
																<?php echo form_error('timeEnd4'); ?> 
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer">
																<ul>
																	<li>Thursday</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[4][0])) echo $workinTimes[4][0];?>" type="text" name="timeStart5" class="timeStart time24" placeholder="09:00">
						  											</li>
																	<li> - To - </li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[4][1])) echo $workinTimes[4][1];?>" type="text" name="timeEnd5" class="timeEnd time24" placeholder="17:00" >
				  													</li>
																</ul>
																<?php echo form_error('timeStart5'); ?> 
																<?php echo form_error('timeEnd5'); ?> 
															</div>
														</div>
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer">
																<ul>
																	<li>Friday</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[5][0])) echo $workinTimes[5][0];?>" type="text" name="timeStart6" class="timeStart time24" placeholder="09:00">
						  											</li>
																	<li> - To - </li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[5][1])) echo $workinTimes[5][1];?>" type="text" name="timeEnd6" class="timeEnd time24" placeholder="17:00" >
				  													</li>
																</ul>
																<?php echo form_error('timeStart6'); ?> 
																<?php echo form_error('timeEnd6'); ?> 
															</div>
														</div>
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer ">
																<ul>
																	<li>Saturday</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[6][0])) echo $workinTimes[6][0];?>" type="text" name="timeStart7" class="timeStart time24" placeholder="09:00">
						  											</li>
																	<li>- To -</li>
																	<li>
							  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							  											<input value="<?php if(isset($workinTimes[6][1])) echo $workinTimes[6][1];?>" type="text" name="timeEnd7" class="timeEnd time24" placeholder="17:00" >
				  													</li>
																</ul>
																<?php echo form_error('timeStart7'); ?> 
																<?php echo form_error('timeEnd7'); ?> 
															</div>
														</div>
														<div class="col-md-12 cal_time_col">
															<div class="cal_time_outer0 ">
																<input class="btn green" type="submit" name="workingDays" value="Update Working Days">
															</div>
														</div>
													</div>
												</div>							
											</div>
										</div>
		                            </div>

		                            <div role="tabpanel" class="tab-pane <?php echo $tab2; ?>" id="services">
									    <div class="form-group">
									    	<div class="col-md-12">
									    		
												<?php if(!empty($categoryLevel1)){ ?>
													<?php
														foreach ($categoryLevel1 as $key1 => $value1) 
															{ ?>
																<?php 
																if(in_array($value1->id, $categoryLevel2_index)) 
																{ ?>
																	<?php foreach ($categoryLevel2 as $key2 => $value2) 
																	{ ?>
																		<?php if(in_array($value2->id, $categoryLevel3_index) && $value2->parent_id ==$value1->id) { ?>
																			<div class="col-md-12 cal_time_col">
																				<label><b><?php echo $value1->name; ?></b></label>
																				<label><b> - <?php echo $value2->name; ?></b></label>
																				<div class="cal_time_outer">
																				<?php foreach ($categoryLevel3 as $key3 => $value3) 
																				{ 
																					if($value3->parent_id == $value2->id) { ?>
																						<ul>
																							<li><?php echo $value3->name; ?></li>
																							<li>
													  											<span class="artistAddOn"><i class="fa fa-usd" aria-hidden="true"></i></span>
													  											<input value="<?php if($servicesCount > 0 && isset($services['categoryPrice_'.$value3->id]) && !empty($services['categoryPrice_'.$value3->id])) { echo $services['categoryPrice_'.$value3->id]; } else echo "x";?>" type="text" name="categoryPrice_<?php echo $value3->id;?>" class="" placeholder="Price">
												  											</li>
																							<li>
													  											<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
													  											<input value="<?php if($servicesCount > 0 && isset($services['categoryTime_'.$value3->id]) && !empty($services['categoryTime_'.$value3->id])) { echo $services['categoryTime_'.$value3->id]; } else echo "0000";?>" type="text" name=" categoryTime_<?php echo $value3->id;?>" class=" time24 maskTime24" placeholder="Timing" >
										  													</li>
										  													<?php 
										  														echo form_error('categoryPrice_'.$value3->id);
										  														echo form_error('categoryTime_'.$value3->id);
										  													?>
																						</ul>
																					<?php } ?>
																				<?php } ?>
																				</div>
																			</div>
																		<?php } ?>
																	<?php }?>
																<?php } else { ?>
																	<?php if(in_array($value1->id, $categoryLevel3_index)) { ?>
																		<div class="col-md-12 cal_time_col">
																			<label> <b><?php echo $value1->name; ?></b></label>
																			<div class="cal_time_outer">
																			<?php foreach ($categoryLevel3 as $key3 => $value3) 
																			{ 
																				if($value3->parent_id == $value1->id) { ?>
																					<ul>
																						<li><?php echo $value3->name; ?></li>
																						<li>
																							<span class="artistAddOn"><i class="fa fa-usd" aria-hidden="true"></i></span>
												  											<input value="<?php if($servicesCount > 0 && isset($services['categoryPrice_'.$value3->id]) && !empty($services['categoryPrice_'.$value3->id])) { echo $services['categoryPrice_'.$value3->id]; } else echo "x";?>" type="text" name="categoryPrice_<?php echo $value3->id;?>" placeholder="Price">
											  											</li>
																						<li>
																							<span class="artistAddOn"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
												  											<input value="<?php if($servicesCount > 0 && isset($services['categoryTime_'.$value3->id]) && !empty($services['categoryTime_'.$value3->id])) { echo $services['categoryTime_'.$value3->id]; } else echo "0000";?>" type="text" name="categoryTime_<?php echo $value3->id;?>" class="time24 maskTime24" placeholder="Timing" >
									  													</li>
									  													<?php 
									  														echo form_error('categoryPrice_'.$value3->id);
									  														echo form_error('categoryTime_'.$value3->id);
									  													?>
																					</ul>
																				<?php } ?>
																			<?php } ?>
																			</div>
																		</div>
																	<?php } ?>
																<?php } ?>
														<?php }
													?>
													<div class="col-md-12 cal_time_col">
														<div class="cal_time_outer0 ">
															<input class="btn green" type="submit" name="services" value="Update">
														</div>
													</div>
												<?php } ?>								
											</div>
									    </div>
									</div>

									<div role="tabpanel" class="tab-pane <?php echo $tab3; ?>" id="offs">
									    <div class="form-group">
										    <div class="col-md-12">
										    	<div class="col-md-12">
										    		<div class="table-responsive">
										    			<div class="col-md-12" style="padding: 0px 0px 10px !important;">
															<label id="offModalButton" class="col-md-2 btn green"> 
																<i class="fa fa-plus-square" aria-hidden="true" ></i> <b>Add Leave</b>
															</label>
															<!-- Modal -->
															<div class="modal bs-example-modal-sm0 fade" id="offModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
															  <div class="modal-dialog modal-sm0" role="document">
															    <div class="modal-content">
															        <div class="modal-header">
																        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																        <h4 class="modal-title" id="myModalLabel"><b>Add Leave</b></h4>
															        </div>
															        <div class="modal-body">
															      		<div class="row">
															      			<div class="col-md-12">
															      				<div class="form-group">
																			    	<div class="col-md-2"><label>Date<small class="error">*</small> :</label></div>
																			    	<div class="col-md-4"><input type="text" class="form-control datepicker_tomorrow" name="off_date" id="off_date" placeholder="Select Date" readonly="" style="cursor: inherit;"></div>
																			    </div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<div class="col-md-2"><label>Type<small class="error">*</small> :</label></div>
																					<div class="col-md-4">
																						<div class="input-group">
																							<span class="input-group-addon">
																								<input type="radio" name="off_type" value="1" checked="" onclick="offtiming(1)">
																							</span>
																							<label class="form-control" placeholder="Username">Full Day</label>
																						</div>
																					</div>	
																					<div class="col-md-5">
																						<div class="input-group">
																							<span class="input-group-addon"><input type="radio" name="off_type" value="2" onclick="offtiming(2)"></span>
																							<label class="form-control" placeholder="Username" aria-describedby="basic-addon1">Specific time Interval</label>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row" style="display:none;" id="offTimingDiv">
																			<div class="col-md-12">
																				<div class="form-group">
																					<div class="col-md-2"><label>Time <small class="error">*</small> :</label></div>
																					<div class="col-md-10">
																						<div class="row">
																							<div class="col-md-4">
																								<div class="input-group">
																								  <span class="input-group-addon">From</span>
																								  <input type="text" id="startOffTime" class="form-control maskTime24 time24" placeholder="09:00">
																								</div>
																							</div>
																							<div class="col-md-4">
																								<div class="input-group">
																								  <span class="input-group-addon">To</span>
																								  <input type="text" id="endOffTime" class="form-control maskTime24 time24" placeholder="17:00">
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row" id="offModelError">
																			<div class="col-md-12">
																				<div class="form-group">
																					<span class="error col-md-12"></span>
																				</div>
																			</div>
																		</div>
															        </div>	
															      	<div class="modal-footer">
															        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															        	<button type="button" id="addOffButton" class="btn btn-primary">Submit</button>
															      	</div>
															    </div>
															  </div>
															</div>
															<!-- #Modal -->
															
														</div>
														<table class="table table-bordered table-hover">
															<thead>
																<tr>
																	<th width="5%">#</th>
																	<th width="15%">Date</th></th>
																	<th width="15%">Type</th> 
																	<th width="40%">Detail</th> 
																	<th width="15%">Created </th> 
																	<th width="5%">Actions</th>
																</tr>
															</thead>
															<tbody>
																<?php
																if(!empty($artist_offs))
																{
																	$i = 0; 
																	foreach ($artist_offs as $artist_offs_row) { $i++;
																	?>
																	<tr>
																		<td><?php echo $i."."; ?></td>
																		<td><?php echo date('d M Y',strtotime($artist_offs_row->date)); ?></td>
																		<td><?php echo ($artist_offs_row->off_type == 1) ? "Full Day" :"Specific time Interval"; ?></td>
								                                        <td>
								                                        	<?php
								                                        		$tempMessage = substr($artist_offs_row->time_from, 0,2).":".substr($artist_offs_row->time_from, 2) ." To ".substr($artist_offs_row->time_to, 0,2).":".substr($artist_offs_row->time_to, 2);

								                                        		echo ($artist_offs_row->off_type == 1) ? "--" :$tempMessage;
								                                        	?>
								                                        </td>
																		<td><?php echo date('d M Y', strtotime($artist_offs_row->created)); ?>
																		</td>
																		<td>
																			<a href="<?php echo base_url('backend/services/artist_off_delete/'.$artist_offs_row->artist_id.'/'.$artist_offs_row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>
																		</td>
																	</tr>

																	<?php } ?>
																<?php } else { ?>
																	<tr>
																		<th colspan="7">
																			<center>No Leave Found.</center>
																		</th>
																	</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
										    	</div>
										    </div>
									    </div>
									</div>
								</div>
							</form>
	                    </div>
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




<script type="text/javascript">
		function offtiming(tid)
		{
			if(tid==1)
			{
				$("#offTimingDiv").hide();
			}
			else
			{
				$("#offTimingDiv").show();
			}
		}
</script>
<script>
		window.onload = function() {
		        $("form").bind("keypress", function(e) {
		            if (e.keyCode == 13) {
		                return false;
		            }
		        });
		    }

		$(document).ready(function($){

			$("#offModalButton").click(function(event) {
				/* Act on the event */
				$("#off_date").val('');
				$("#startOffTime").val('');
				$("#endOffTime").val('');
				$("input[name='off_type'][value='1']").attr('checked',true);
				$("#offTimingDiv").hide();
				$("#offModelError .error").html('');
				$("#offModal").modal('show');
			});

			$("#addOffButton").click(function(event) {
				/* Act on the event */
				var offDate 		= $("#off_date").val();
					offDate  		= offDate.replace(/ /g,'-');
				var offType 		= $("input[name='off_type']:checked").val();
				var startOffTime 	= $("#startOffTime").val();
					startOffTime  	= startOffTime.replace(/_/g,'');
				var endOffTime 		= $("#endOffTime").val();
					endOffTime  	= endOffTime.replace(/_/g,'');
				var flag =1;

				if(offType==1)
				{
					if(!offDate.length>0)
					{
						flag = 0;
						$("#offModelError .error").html('Please enter all required fields.');
					}
				}
				else
				{
					if(startOffTime.length < 5 || endOffTime.length < 5 || !offDate.length>0)
					{
						flag = 0;
						$("#offModelError .error").html('Please enter all required fields.');
					}
					else
					{
						startOffTime  = startOffTime.replace(":","");
						endOffTime    = endOffTime.replace(":","");
						if(eval(startOffTime) >= eval(endOffTime))
						{
							flag = 0;
							$("#offModelError .error").html('Please enter valid time Interval.');
						}
					}
				}
				
				if(flag == 1)
				{
					if(offType == 1)
					{
						$.post("<?php echo base_url('backend/services/add_fullDay_leave')?>", { id:'<?php echo $id?>', offDate : offDate }, 
							function(data) {
								if(data.status == 1)
								{
									$("#offModal").modal('hide');
									location.assign("<?php echo base_url('backend/services/artist_edit/'.$id.'/3');?>");
								}
								else
								{
									$("#offModelError .error").html(data.msg);
								}
						});
					}
					else
					{
						startOffTime  = startOffTime.replace(":","");
						endOffTime    = endOffTime.replace(":","");

						$.post("<?php echo base_url('backend/services/add_time_leave')?>", { id:'<?php echo $id?>', offDate : offDate, startOffTime : startOffTime, endOffTime : endOffTime }, 
							function(data) {

								if(data.status == 1)
								{
									$("#offModal").modal('hide');
									location.assign("<?php echo base_url('backend/services/artist_edit/'.$id.'/3');?>");
								}
								else
								{
									$("#offModelError .error").html(data.msg);
								}
						});

					}
				}

			});





		});
</script>


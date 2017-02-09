	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="clearfix">
			</div>
			 
			<div class="row">
				<div class="col-md-12">
					 <?php  echo msg_alert_backend(); ?>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
									<i class="fa fa-list"></i> Promo Codes <a href="<?php echo base_url('backend/promocode/add') ?>" class="btn btn-xs yellow">Add Promo Code <i class="icon-plus"></i> </a>
							</div>							
						</div>
						<div class="portlet-body">

							<div class="table-responsive">

								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th width="5%">#</th>
											<th width="10%">Code</th>
											<!-- <th width="20%">Applied On</th> -->
											<th width="25%">Range</th>
											<th width="5%">Min Amount</th> 
											<th width="5%">Discount</th> 
											<th width="5%">Status</th> 
											<th width="10%">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($values))
										    {                                
											   $i = $offset; 
											   foreach ($values as $row) 
											   	{ $i++;	?>
													<tr>
														<td><?php echo $i."."; ?></td>
														<td>
															<a href="<?php echo base_url('backend/promocode/edit/'. $row->id )?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit ">
																<?php echo $row->code; ?>
															</a>
														</td>
														<!-- <td>
															<?php
																$applied_on = json_decode($row->applied_on);
																if(is_array($applied_on))
																{
																	if(in_array('1',$applied_on))
																		echo "Products";
																	if(in_array('2',$applied_on))
																		echo ",Services";
																}
															?>
														</td> -->
														<td>
															<?php
																echo date('d M Y',strtotime($row->start_date)). ' To '.date('d M Y',strtotime($row->end_date)); 
															?>
														</td>
														<td>
															<?php
																if(!empty($row->min_amount)) 
																	echo "$".$row->min_amount;
															?>
														</td>
														<td>
															<?php
																if(!empty($row->discount))
																{
																	if($row->discount_type==1)
																	echo "$".$row->discount;		
																	if($row->discount_type==2)
																	echo $row->discount."%";
																}
															?>
														</td>
				                                        <td>
				                                        	<?php if($row->status){ ?> 
				                                        		<a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/promocode/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>">
				                                        			<span  class="btn btn-xs green">
				                                        				<i class="fa fa-check-circle "></i>
				                                        			</span>
				                                        		</a> 
				                                        	<?php  } else {  ?>  
				                                        		<a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/promocode/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>">
				                                        			<span class="btn btn-xs red">
				                                        				<i class="fa fa-times-circle"></i>
				                                        			</span>
				                                        		</a>  
				                                        	<?php } ?> 
				                                        </td> 
														<td>
															<a href="<?php echo base_url('backend/promocode/edit/' . $row->id .'/'.$offset) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit ">
																<i class="icon-pencil"></i>
															</a> 
															<a href="<?php echo base_url('backend/promocode/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" >
																<i class="icon-trash "></i>
															</a>
															
														</td>

													</tr>
											    <?php } 
											}
											else 
											{ ?>
												<tr>
													<th colspan="7">
														<center>No promocode Found.</center>
													</th>
												</tr>

										<?php } ?>
									</tbody>
								</table>
								<div class="text-right">
									<?php if (!empty($pagination)) echo $pagination; ?>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER
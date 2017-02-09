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
									<i class="fa fa-list"></i> Memberships <a href="<?php echo base_url('backend/membership/discount_add') ?>" class="btn btn-xs yellow">Add Membership <i class="icon-plus"></i> </a>
							</div>							
						</div>
						<div class="portlet-body">
							
							<div class="table-responsive">

								<div class="col-md-12 well">
									<form action="<?php echo base_url('backend/membership/discount_list'); ?>" method="get" accept-charset="utf-8">
										<!-- <div class="form-group"> -->
											<div class="col-md-4">
												<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter user or email or plan title or discount code ..">
											</div>
										<!-- </div> -->
										<!-- <div class="form-group col-md-6"> -->
											<input type="submit" class="btn btn-primary" value="search">
											<a href="<?php echo base_url('backend/membership/discount_list/0'); ?>" class="btn btn-danger"> Reset </a>
										<!-- </div> -->
									</form>
								</div>
								<table class="table table-bordered table-hover">
									
									<thead>
										<tr>
											<th width="5%">#</th>
											<th width="10%">Plan</th>
											<th width="15%">Code</th>
											<th width="20%">User</th>
											<th width="20%">Email</th>
											<th width="20%">Range</th>
											<th width="10%">Action</th> 
										</tr>
									</thead>
									<tbody>
										<?php 
											if(!empty($discountList))
										    {                                
											   $i = $offset; 
											   foreach ($discountList as $row) 
											   	{ $i++;	?>
													<tr>
														<td><?php echo $i."."; ?></td>
														<td>
															
																<?php echo $row->plan_name; ?>
														</td>
														<td>
															
																<?php echo $row->discount_code; ?>
														</td>
														<td>
															<?php echo $row->name; ?>
														</td>
														<td>
															<?php echo $row->email; ?>
														</td>
														<td>
															<?php
																echo date('d M Y',strtotime($row->start_date)). ' To '.date('d M Y',strtotime($row->end_date)); 
															?>
														</td>
														 <!-- <td>
				                                        	<?php if($row->is_used){ ?> 
				                                        		    <span  class="btn btn-xs green">
				                                        				<i class="fa fa-check-circle "></i>
				                                        			</span>
				                                        	<?php  } else {  ?>  
				                                        			<span class="btn btn-xs red">
				                                        				<i class="fa fa-times-circle"></i>
				                                        			</span>
				                                        	<?php } ?> 
				                                        </td> -->
				                                        <td>
				                                        	<a href="<?php echo base_url('backend/membership/discount_edit/'.$row->id.'/'.$offset ) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="icon-pencil"></i></a>
				                                        	<a href="<?php echo base_url('backend/membership/discount_delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" title="Remove" onclick="return confirm('Are you sure want to delete?');"><i class="icon-trash "></i></a>
				                                        </td>
													</tr>
											    <?php } 
											}
											else 
											{ ?>
												<tr>
													<th colspan="7">
														<center>No Discount Code Found.</center>
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
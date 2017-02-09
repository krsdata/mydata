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
									<i class="fa fa-list"></i> Membership Order List 
							</div>							
						</div>
						<div class="portlet-body">
							
							<div class="table-responsive">

								<div class="col-md-12 well">
									<form action="<?php echo base_url('backend/membership/membership_order_list'); ?>" method="get" accept-charset="utf-8">
										<!-- <div class="form-group"> -->
											<div class="col-md-4">
												<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter plan title or order id or name or email ..">
											</div>
										<!-- </div> -->
										<!-- <div class="form-group col-md-6"> -->
											<input type="submit" class="btn btn-primary" value="search">
											<a href="<?php echo base_url('backend/membership/membership_order_list/0'); ?>" class="btn btn-danger"> Reset </a>
										<!-- </div> -->
									</form>
								</div>
								<table class="table table-bordered table-hover">
									
									<thead>
										<tr>
											<th width="5%">#</th>
											<th width="10%">Order Id</th>
											<th width="15%">Name</th>
											<th width="15%">Email Address</th>
											<th width="15%">Contact</th>
											<th width="15%">Plan</th>
											<th width="10%">Amount</th>
											<th width="15%">Date</th> 
										</tr>
									</thead>
									<tbody>
										<?php 
											if(!empty($orders))
										    {                                
											   $i = $offset; 
											   foreach ($orders as $row) 
											   	{ $i++;	?>
													<tr>
														<td><?php echo $i."."; ?></td>
														<td>
															
																<?php echo $row->membership_order_id; ?>
														</td>
														<td>
															
																<?php echo $row->user_name; ?>
														</td>
														<td>
															
																<?php echo $row->email_address; ?>
														</td>
														<td>
															
																<?php echo $row->phone; ?>
														</td>
														<td>
															<?php echo $row->plan_name_title; ?>
														</td>
														<td>
															<?php echo $row->plan_amount; ?>
														</td>
														<td>
															<?php
																echo date('d M Y H:i:s',strtotime($row->order_date)); 
															?>
														</td>
														
													</tr>
											    <?php } 
											}
											else 
											{ ?>
												<tr>
													<th colspan="8">
														<center>No Membership Order Found.</center>
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
<!-- BEGIN CONTENT -->
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
								<i class="fa fa-client fa-lg"></i> Distributors List <a href="<?php echo base_url('backend/client/add') ?>" class="btn btn-xs yellow">Add New Distributor <i class="icon-plus"></i> </a>
						</div>
						
					</div>
					<div class="portlet-body">
						<div class="table-responsive">
							<div class="col-md-12 well">
								<form action="" method="get" accept-charset="utf-8">
									<!-- <div class="form-group"> -->
										<div class="col-md-4">
											<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter name or email to search distributor">
										</div>
									<!-- </div> -->
									<!-- <div class="form-group col-md-6"> -->
										<input type="submit" class="btn btn-primary" value="search">
										<a href="<?php echo base_url('backend/client'); ?>" class="btn btn-danger"> Reset </a>
									<!-- </div> -->
								</form>
							</div>

							<table class="table table-bordered table-hover">

								<thead>

									<tr>
										<th width="3%">#</th>
										<th width="12%">Distributor Type</th>
										<th width="25%">Name</th>
										<th width="20%">Email</th>
										<th width="5%">State</th>
										<th width="10%">Created </th>
										<th width="5%">Status</th>
										<th width="15%">Actions</th>
									</tr>

								</thead>

								<tbody>
								    <?php if (!empty($client)):

										$i = $offset; foreach ($client as $row) { $i++;

										?>

										<tr>
											<td><?php echo $i . "."; ?></td>
											<td>
												<?php
												    if($row->cliend_kind==1) 
												    echo "Wholesale Distributor";
												    if($row->cliend_kind==2) 
													echo "Education Centre";
												    if($row->cliend_kind==3) 
													echo "OEM";
												?>
											</td>

											<td>
												<a href="<?php echo base_url( 'backend/client/edit/' . $row->id )?>" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit ">
													<?php if(!empty($row->title)) echo $row->title; ?>
												</a>
											</td>

											<td><?php if(!empty($row->email)) echo $row->email; ?></td>
											<td><?php if(!empty($row->state)) echo $row->state; ?></td>

											<td><?php echo date('d M Y', strtotime($row->created_at)); ?></td>
											<td>
												<?php if($row->status){ ?> <a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/client/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> <?php  }else{  ?>  <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/client/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  <?php } ?> 
											</td>
											<td>
												<?php if($row->status){ ?>
													<a href="<?php echo base_url('backend/client/view_user/'.$row->id);?>" target="_new" class="btn btn-warning btn-xs" data-original-title="Login as distributor"><i class="fa fa-sign-in" aria-hidden="true" ></i></a>
												<?php } ?>
												<a href="<?php echo base_url('backend/client/edit/' . $row->id.'/'.$offset) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="icon-pencil"></i></a>
		                                      
												<a href="<?php echo base_url('backend/client/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>
												 	

											</td>

										</tr>

										<?php } ?><?php else: ?>

										<tr>
											<th colspan="8">
												<center>No Distributor Found.</center>
											</th>
										</tr>

									<?php endif; ?>

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
<!-- END CONTAINER -->
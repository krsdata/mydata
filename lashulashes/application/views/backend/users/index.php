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
									<i class="fa fa-users fa-lg"></i> Users List 
									<!-- <a href="<?php //echo base_url('backend/users/add') ?>" class="btn btn-xs yellow">Add New User <i class="icon-plus"></i> </a> -->
							</div>
							
						</div>


			<div class="portlet-body">

				<div class="table-responsive">
					<div class="col-md-12 well">
						<form action="<?php echo base_url('backend/users/index'); ?>" method="get" accept-charset="utf-8">
							<!-- <div class="form-group"> -->
								<div class="col-md-4">
									<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter first name or email to search user">
								</div>
							<!-- </div> -->
							<!-- <div class="form-group col-md-6"> -->
								<input type="submit" class="btn btn-primary" value="search">
								<a href="<?php echo base_url('backend/users/index'); ?>" class="btn btn-danger"> Reset </a>
							<!-- </div> -->
						</form>
					</div>

					<table class="table table-bordered table-hover">

						<thead>

							<tr>

								<th width="5%">#</th>

								<th width="40%">Name</th>

								<th width="20%">Email</th>

								<th width="12%">Created </th>
								<th width="5%">Status</th>

								<th width="15%">Actions</th>

							</tr>

						</thead>

						<tbody>

							<?php

							if (!empty($users)):

								$i = 0; foreach ($users as $row) { $i++;

									?>

									<tr>

										<td><?php echo $i . "."; ?></td>

										<td>
											<a href="<?php echo base_url( 'backend/users/edit/' . $row->id )?>" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit ">
												<?php if(!empty($row->first_name)) echo ucwords($row->first_name); if(!empty($row->last_name)) echo ' '.ucwords($row->last_name); ?>
											</a>
										</td>

										<td><?php if(!empty($row->email)) echo $row->email; ?></td>

										<td><?php echo date('d M Y', strtotime($row->created_at)); ?></td>
										<td>
											<?php if($row->status){ ?> <a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/users/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> <?php  }else{  ?>  <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/users/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  <?php } ?> 
										</td>
										<td>

											<?php if($row->status){ ?>
												<a href="<?php echo base_url('backend/users/view_user/'.$row->id);?>" target="_new" class="btn btn-warning btn-xs" data-original-title="Login as user"><i class="fa fa-sign-in" aria-hidden="true" ></i></a>
											<?php } ?>
											
											<a href="<?php echo base_url('backend/users/edit/' . $row->id ) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="icon-pencil"></i></a>
                                          
											<a href="<?php echo base_url('backend/users/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" >
												<i class="icon-trash "></i></a>
											 	

											</td>

										</tr>

										<?php } ?><?php else: ?>

										<tr>

											<th colspan="7">

												<center>No Users Found.</center>

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
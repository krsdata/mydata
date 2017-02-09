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
								<i class="fa fa-list"></i>Training List <a href="<?php echo base_url('backend/trainings/add') ?>" class="btn btn-xs yellow">Add Training <i class="icon-plus"></i> </a>
						</div>
					</div>
					<div class="portlet-body">

						<div class="table-responsive">
							<div class="col-md-12 well">
								<form action="<?php echo base_url('backend/trainings/index'); ?>" method="get" accept-charset="utf-8">
									<!-- <div class="form-group"> -->
										<div class="col-md-4">
											<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter title to search trainings">
										</div>
									<!-- </div> -->
									<!-- <div class="form-group col-md-6"> -->
										<input type="submit" class="btn btn-primary" value="search">
										<a href="<?php echo base_url('backend/trainings/index'); ?>" class="btn btn-danger"> Reset </a>
									<!-- </div> -->
								</form>
							</div>
							<table class="table table-bordered table-hover">

								<thead>
									<tr>
										<th width="5%">#</th>
										<th width="15%">Training Category</th>
										<th width="40%">Title</th>
										<th width="10%">Fee</th>
										<th width="15%">Training Date </th> 
										<th width="5%">Status</th> 
										<th width="10%">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($traning)):		                            
										$i = $offset; foreach ($traning as $row) { $i++;

											?>
											<tr>
												<td><?php echo $i . "."; ?></td>		                                         
												<td>
													<a href="<?php echo base_url( 'backend/trainings/edit/' . $row->id .'/'.$offset)?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><?php echo $row->name; ?></a>
												</td>
												<td><?php if(!empty($row->title)) echo $row->title; ?></td>
												<td><?php echo '$'.$row->fees; ?></td>
												<td>
													<?php echo date('d M Y',strtotime($row->start_date)); ?>
													<?php echo " To ".date('d M Y',strtotime($row->end_date)); ?>
												</td>
		                                        <td>										        
		                                        	<?php if($row->status){ ?> <a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/trainings/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> <?php  }else{  ?>  <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/trainings/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  <?php } ?> 
		                                        </td>
												<td>
													<a href="<?php echo base_url('backend/trainings/edit/' . $row->id .'/'.$offset) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="icon-pencil"></i></a> 
		                                          
													<a href="<?php echo base_url('backend/trainings/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>
												</td>
											</tr>

											<?php } ?><?php else: ?>

											<tr>
												<th colspan="7">
													<center>No Training Found.</center>
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
<!-- END CONTAINER
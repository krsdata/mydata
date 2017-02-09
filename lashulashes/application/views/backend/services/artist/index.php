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
									<i class="fa fa-list"></i> Artist <a href="<?php echo base_url('backend/services/artist_add') ?>" class="btn btn-xs yellow">Add new <i class="icon-plus"></i> </a> 
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th width="5%">#</th>
											<th width="30%">Name</th></th>
											<th width="15%">Image</th></th>
											<th width="15%">Created </th> 
											<th width="5%">Status</th> 
											<th width="10%">Actions</th>
										</tr>
									</thead>
									<tbody>

										<?php

										if (!empty($artist)):
			                               
											$i = 0; foreach ($artist as $row) { $i++;

												?>

												<tr>

													<td><?php echo $i . "."; ?></td>

													<td><a href="<?php echo base_url( 'backend/services/artist_edit/'.$row->id )?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><?php echo $row->name; ?></a></td>

													<td>
														<?php if(!empty($row->image) && file_exists($row->image)){ ?>
															<img src="<?php echo base_url($row->image); ?>" width="100">
														<?php }?>
														
													</td>

													<td><?php echo date('d M Y', strtotime($row->created)); ?></td>
			                                        <td>										        
			                                        	<?php if($row->status){ ?> <a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/services/artist_status/'.$row->id.'/'.$row->status; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> <?php  }else{  ?>  <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/services/artist_status/'.$row->id.'/'.$row->status; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  <?php } ?> </td>
													<td>

													   <a href="<?php echo base_url('backend/services/artist_edit/' . $row->id) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="icon-pencil"></i></a>
														<a href="<?php echo base_url('backend/services/artist_delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>
													</td>

												</tr>

												<?php } ?><?php else: ?>

												<tr>

													<th colspan="7">

														<center>No artist Found.</center>

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
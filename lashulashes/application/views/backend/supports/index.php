<!--BEGIN CONTENT -->
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
									<i class="fa fa-list"></i> Supports 
							</div>
							
						</div>


			<div class="portlet-body">

				<div class="table-responsive">

					<table class="table table-bordered table-hover">

						<thead>

							<tr>

								<th width="5%">#</th>

								<th width="15%">Name</th>

								 <th width="15%">Email</th>
								 <th width="15%">Mobile</th>

								<th width="20%">Created </th>
								<!-- <th width="20%">Replied </th>  -->

								<th width="10%">Actions</th>

							</tr>

						</thead>

						<tbody>

							<?php

							if (!empty($news)):
                                $offset=0;
								$i = 0; foreach ($news as $row) { $i++;

									?>

									<tr>

										<td><?php echo $i . "."; ?></td>

										<td><a href="<?php echo base_url('backend/supports/edit/'. $row->id )?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" View "><?php echo $row->first_name." ".$row->last_name; ?></a></td>

										<td><?php echo $row->email; ?></td>
										<td><?php if(!empty($row->mobile))echo $row->mobile; ?></td>

										<td><?php echo date('d M Y', strtotime($row->created_at)); ?></td>
										
										<!-- <td><?php //if(strtotime($row->created_at) < strtotime($row->updated_at)) { echo date('Y-m-d', strtotime($row->updated_at)); } else { echo "...";} ?></td> -->

										<td>
											<a href="<?php echo base_url('backend/supports/edit/' . $row->id ) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title="View"><i class="icon-eye"></i></a>
                                          
											<a href="<?php echo base_url('backend/supports/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');"><i class="icon-trash "></i></a>
										</td>

										</tr>

										<?php } ?><?php else: ?>

										<tr>

											<th colspan="7">

												<center>No Supports Found.</center>

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
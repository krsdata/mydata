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
									<i class="fa fa-list"></i> Attributes <a href="<?php echo base_url('backend/attributes/add') ?>" class="btn btn-xs yellow">Add Attribute <i class="icon-plus"></i> </a>
							</div>
							
						</div>


			<div class="portlet-body">

				<div class="table-responsive">

					<table class="table table-bordered table-hover">

						<thead>

							<tr>

								<th width="5%">#</th>

								<th width="40%">Name</th>

								

								<th width="20%">Created </th> 
                                 <th width="5%">Status</th> 
								<th width="15%">Actions</th>

							</tr>

						</thead>

						<tbody>

							<?php

							if (!empty($values)):
                                
								$i = $offset; foreach ($values as $row) { $i++;

									?>

									<tr>

										<td><?php echo $i . "."; ?></td>
                                         
										<td><a href="<?php echo base_url( 'backend/attributes/edit/' . $row->id )?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><?php echo $row->attribute; ?></a></td>
										

										<td><?php echo date('d M Y',strtotime($row->created_at)); ?></td>
                                        <td><?php if($row->status){ ?> <a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/attributes/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> <?php  }else{  ?>  <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/attributes/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  <?php } ?> </td> 
										<td>
                                       
											<a href="<?php echo base_url('backend/attributes/edit/' . $row->id .'/'.$offset) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit ">

												<i class="icon-pencil"></i>

											</a> 
                                          
											<a href="<?php echo base_url('backend/attributes/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" >

												<i class="icon-trash "></i></a>
                                                 
		                                          
												<a href="<?php echo base_url('backend/configure_terms/index/'.$row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Add Variations">

												<i class="icon-plus"></i></a>
											</td>

										</tr>

										<?php } ?><?php else: ?>

										<tr>

											<th colspan="7">

												<center>No Attributes Found.</center>

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
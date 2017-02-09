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
									<i class="fa fa-envelope-o"></i> Email Templates <!-- <a href="<?php //echo base_url('backend/email_templates/add') ?>" class="btn btn-xs yellow">Add New Email Template <i class="icon-plus"></i> </a> -->
							</div>
							
						</div>


			<div class="portlet-body">

				<div class="table-responsive">

					<table class="table table-bordered table-hover">

						<thead>

							<tr>

								<th width="5%">#</th>

								<th width="35%">Template name</th>

								<th width="30%">Subject</th>

								<th width="20%">Created </th>

								<th width="10%">Actions</th>

							</tr>

						</thead>

						<tbody>

							<?php

							if (!empty($templates)):

								$i = 0; foreach ($templates as $row) { $i++;

									?>

									<tr>

										<td><?php echo $i . "."; ?></td>

										<td><a href="<?php echo base_url( 'backend/email_templates/edit/' . $row->id )?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><?php echo $row->template_name; ?></a></td>

										<td ><?php echo substr($row->template_subject, 0, 50); ?></td>

										<td><?php echo date('d M Y', strtotime($row->created_at)); ?></td>

										<td>

										<a href="<?php echo base_url('backend/email_templates/edit/' . $row->id ) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit ">

												<i class="icon-pencil"></i>

											</a>
                                          <?php if($row->template_level==0) { ?>
											<a href="<?php echo base_url('backend/email_templates/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" >
												<i class="icon-trash "></i></a>
											 <?php } ?>	

											</td>

										</tr>

										<?php } ?><?php else: ?>

										<tr>

											<th colspan="7">

												<center>No Email Template Found.</center>

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
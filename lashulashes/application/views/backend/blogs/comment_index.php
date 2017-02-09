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
									<i class="fa fa-list"></i> Blog Comments
							</div>
							<div class="caption pull-right ">
									<a href="<?php echo base_url('backend/blogs/');?>" style="color:#fff;"><i class="fa fa-arrow-left"></i> Back </a>
							</div>
						</div>


						<div class="portlet-body">

							<div class="table-responsive">

								<table class="table table-bordered table-hover">

									<thead>

										<tr>

											<th width="5%">#</th>

											<th width="20%">User Name</th>

											<th width="55%">Comment</th>
											<th width="10%">Date</th>
											<th width="5%">Status</th>

											<th width="5%">Action </th> 

										</tr>

									</thead>
									<tbody>

										<?php

										if (!empty($news)):
			                                
											$i = $offset; foreach ($news as $row) { $i++;

												?>

												<tr>
														<td><?php echo $i . "."; ?></td>
				                                         
														<td>
															<?php if(!empty($row->first_name))echo $row->first_name; if(!empty($row->last_name)) echo ' '.$row->last_name; ?>
														</td>
														
														<td><?php if(!empty($row->comment)) echo $row->comment; ?></td>

														<td><?php echo date('d M Y',strtotime($row->created)); ?></td>
				                                         <td>
				                                            <?php if($row->status){ ?> 
				                                            	<a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/blogs/comment_status/'.$row->id.'/'.$row->blog_id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> 
				                                            <?php  }else{  ?> 
				                                            	 <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/blogs/comment_status/'.$row->id.'/'.$row->blog_id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  
				                                            <?php } ?> 
				                                        </td>
														<td>
															<a href="<?php echo base_url('backend/blogs/comment_delete/'.$row->blog_id.'/'.$row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>

													     </td>
												</tr>

												<?php } ?><?php else: ?>

												<tr>

													<th colspan="7">

														<center>No Blog Comments Found.</center>

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
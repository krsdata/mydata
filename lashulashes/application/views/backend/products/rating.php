	<div  ng-Controller="Mylist" class="page-content-wrapper">
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
									<i class="fa fa-list"></i> Product Review And Rating 
							</div>							
						</div>

						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th width="5%">#</th>
											<th width="10%">User Name</th>
											<th width="55%">Review</th>
											<th width="8%">Rating</th>
											<th width="12%">Date</th>
											<th width="5%">Status</th>
											<th width="5%">Actions</th>
										</tr>
									</thead>
									<tbody>
									    <?php if (!empty($products)):
										   $i = $offset; foreach ($products as $row) { $i++;
											?>
											<tr>
												<td><?php echo $i . "."; ?></td>                                        
												<td><?php echo $row->first_name.' '.$row->last_name; ?></a>
												</td>
												<td><?php  echo $row->review; ?></td>
												<td><span class="btn-info"> &nbsp; <i class="fa fa-star-half-o"> <?php echo number_format($row->rating,1);?> </i> &nbsp;</span></td>

												<td><?php echo date('Y-m-d',strtotime($row->created)); ?></td>
			                                    <td>										        
			                                     	<?php if($row->status){ ?> 
			                                     		<a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/products/rating_status/'.$row->rating_id.'/'.$row->product_id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> 
			                                     	<?php  }else{  ?>  
			                                     		<a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/products/rating_status/'.$row->rating_id.'/'.$row->product_id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a> 
			                                     	<?php } ?> </td>  
												<td>
													<a href="<?php echo base_url('backend/products/rating_delete/' . $row->rating_id.'/'. $row->product_id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" title="Remove" onclick="return confirm('Are you sure want to delete?');"><i class="icon-trash "></i></a>
												</td>

											</tr>

											<?php } ?><?php else: ?>

											<tr>
												<th colspan="7">
													<center>No rating Found.</center>
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
     
			<div class="modal fade draggable-modal" id="variationview" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h4 class="modal-title">variation</h4>
                    </div>
                    <div class="modal-body">
                     
                      <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                      <thead>
                      
                      <tr>
                      <th width="50%">Key</th>
                      <th width="50%">Value</th>
                       </tr>
                       <tr  ng-repeat="results in variationdata">
                         <td>{{ results.attribute_key }}</td>
                         <td>{{ results.attribute_value }}</td>
                       </tr>
                       </thead>
                       </table>
                       </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
        	</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER
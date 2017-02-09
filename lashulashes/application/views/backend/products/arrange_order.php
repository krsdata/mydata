	<div  ng-Controller="Mylist" class="page-content-wrapper">
		<div class="page-content">
					
			
			<div class="clearfix">
			</div>
			 
			 <div class="row">
				<div class="col-md-12">
					 <?php  echo msg_alert_backend(); ?>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<form method="post">
					<div class="portlet box green">
							<div class="portlet-title">
								<div class="caption">
									<span><i class="fa fa-list"></i> Arrange Orders</span>
								</div>	
								<div class="caption pull-right">
										<input type="submit" value="Update" class="btn btn-md yellow"/>
										<a href="<?php echo base_url('backend/products')?>" class="btn btn-danger">Cancel</a>
								</div>					
							</div>

							<div class="portlet-body">
								<div class="table-responsive">
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th width="5%">S.No.</th>
													<th width="5%">Order</th>
													<th width="30%">Title</th>
													<th width="10%">Type</th>
													<th width="10%">Price</th>
													<th width="20%">Created </th>
												</tr>
											</thead>
											<tbody>
											    <?php if (!empty($products)):
												   $i = 0; foreach ($products as $row) { $i++;
													?>
													<tr>
														<td><?php echo $i . "."; ?></td>                                        
														<td>
															<input type="text" name="order_<?php echo $row->id?>" value="<?php echo $row->order;?>">
															<?php echo form_error('order_'.$row->id); ?> 
														</td>                                        
														<td><?php echo $row->title; ?></td>
														<td><?php  echo $row->type; ?></td>
														<td>
															<?php $price = ''; 
								                                if($row->type == 'Simple')
								                                {
								                                   $price = $row->price;
								                                }
								                                else
								                                {
								                                    $price = variation_price($row->id);
								                                }
								                            ?>
															<?php if(empty($price)) { echo "--"; } else { echo '$'.$price; } ?>
														</td>

														<td>
															<?php echo date('d M Y',strtotime($row->created_at)); ?>
														</td>


													</tr>

													<?php } ?><?php else: ?>

													<tr>
														<th colspan="7">
															<center>No products Found.</center>
														</th>
													</tr>
												<?php endif; ?>
											</tbody>
										</table>
									<div class="text-right">
										<input type="submit" value="Update" class="btn btn-md yellow">
										<a href="<?php echo base_url('backend/products')?>" class="btn btn-danger">Cancel</a>
									</div>
								</div>
							</div>
					</div>
					</form>
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
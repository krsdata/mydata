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
								<span><i class="fa fa-list"></i> Products <a href="<?php echo base_url('backend/products/add') ?>" class="btn btn-xs yellow">Add product <i class="icon-plus"></i> </a></span>
							</div>							
							<div class="caption pull-right">
								<span class="">
									<a href="<?php echo base_url('backend/products/arrange_orders') ?>" class="btn yellow">Arrange Order
									<i class="fa fa-list-ol" aria-hidden="true"></i>
								    </a>
								</span>
							</div>
						</div>

						<div class="portlet-body">
							<div class="table-responsive">
								<div class="col-md-12 well">
									<form action="<?php echo base_url('backend/products/index'); ?>" method="get" accept-charset="utf-8">
										<!-- <div class="form-group"> -->
											<div class="col-md-4">
												<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter product title to search product..">
											</div>
										<!-- </div> -->
										<!-- <div class="form-group col-md-6"> -->
											<input type="submit" class="btn btn-primary" value="search">
											<a href="<?php echo base_url('backend/products/index/0'); ?>" class="btn btn-danger"> Reset </a>
										<!-- </div> -->
									</form>
								</div>
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th width="5%">S.No.</th>
											<th width="5%">Order</th>
											<th width="30%">Title</th>
											<th width="10%">Type</th>
											<th width="10%">Price</th>
											<th width="20%">Created </th>
											<!-- <th width="10%">Rating</th> -->
											<th width="5%">Status</th>
											<th width="10%">Actions</th>
										</tr>
									</thead>
									<tbody>
									    <?php if (!empty($products)):
										   $i = $offset; foreach ($products as $row) { $i++;
											?>
											<tr>
												<td><?php echo $i . "."; ?></td>                                        
												<td><?php echo $row->order; ?></td>                                        
												<td><a href="<?php echo base_url( 'backend/products/add_one/'.$row->id.'/home'.'/'.$offset)?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><?php echo $row->title; ?></a>
												</td>
												<td> <!-- <?php //if($row->type=='Variation'){  ?>                                    
												   <a ng-click="variation('<?php //echo $row->id; ?>')" href="#variationview" data-toggle="modal">
											       <?php //echo $row->type; ?> </a>
											       <?php //} else{  echo $row->type;  } ?> -->
											       <?php  echo $row->type; ?>
											 	</td>
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

												<td><?php echo date('d M Y',strtotime($row->created_at)); ?></td>
			                                    <!-- ratin col start -->
			                                    <!-- <td><span class="btn-info"> &nbsp; <i class="fa fa-star-half-o"> <?php //echo number_format($row->avg_rating,1);?> </i> &nbsp;</span></td> -->
			                                    <!-- rating col end -->
			                                    <td>										        
			                                     	<?php if($row->status){ ?> <a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/products/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> <?php  }else{  ?>  <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/products/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  <?php } ?> </td>  
												<td>
													<a href="<?php echo base_url('backend/products/add_one/'.$row->id.'/home'.'/'.$offset ) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" title=" Edit "><i class="icon-pencil"></i></a> 
			                                     
													<a href="<?php echo base_url('backend/products/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" title="Remove" onclick="return confirm('Are you sure want to delete?');"><i class="icon-trash "></i></a>
													<!-- rating action strat  -->
													<!-- <a href="<?php //echo base_url('backend/products/rating/'. $row->id) ?>" class="btn btn-info btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" title="Review And Rating"><i class="fa fa-star-half-o"> <?php //if(!empty($row->new_rating)) echo $row->new_rating; else echo "0";?></i></a>-->
													<!-- rating section end  -->
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
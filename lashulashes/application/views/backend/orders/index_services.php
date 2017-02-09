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
							<i class="fa fa-list"></i> Booked Services List
						</div>							
					</div>
					<div class="portlet-body">
						<div class="table-responsive">
							<div class="col-md-12 well">
								<form action="<?php echo base_url('backend/orders/services'); ?>" method="get" accept-charset="utf-8">
									<!-- <div class="form-group"> -->
										<div class="col-md-4">
											<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter order id or email to search booking">
										</div>
									<!-- </div> -->
									<!-- <div class="form-group col-md-6"> -->
										<input type="submit" class="btn btn-primary" value="search">
										<a href="<?php echo base_url('backend/orders/services'); ?>" class="btn btn-danger"> Reset </a>
									<!-- </div> -->
								</form>
							</div>
							<table class="table table-bordered favorite_table">
						        <thead>
						          	<tr>
						          		<th width="4%">#</th>
							            <th width="15%">Order Id</th>
							            <th width="40%">Contact Detail</th>
							            <th width="10%">Order Date</th>
							            <th width="8%">Total</th>
							            <!-- <th width="10%">Payment Type</th> -->
							            <th width="15%">Payment Status</th>
							     		<th>Action</th>
							        </tr>
						        </thead>
						        <tbody>
						        	<?php if(!empty($order_detail)) {  $i=$offset;?>
						        		<?php foreach ($order_detail as $value) { $i++; ?>
									        <tr>
									        	<td><?php  echo $i.'.';?></td>
										        <td><?php  if(!empty($value->registration_id)) echo $value->registration_id;?></td>
										        <td>
										        	<?php 
											        	if(!empty($value->first_name))
											        	echo ucwords($value->first_name);
											        	if(!empty($value->last_name))
											        	{
											        		echo ' '.ucwords($value->last_name);
											        	}
											        	if(!empty($value->email))
											        	{
											        		echo "<br>";
											        		echo $value->email;
											        	}
											        	if(!empty($value->contact))
											        	{
											        		echo "<br>";
											        		echo $value->contact;
											        	}	
											        ?>
										        </td>
										        <td><?php  echo date('d M Y',strtotime($value->created));?></td>
										        <td>$<?php echo $value->grand_total;?></td>
										        <!-- <td><?php  //echo ucfirst($value->payment_type);?></td> -->
										        <td><?php  echo $value->payment_status; ?></td>
										        <td>
										        <a data-toggle="modal" data-target="#gridSystemModal_<?php echo $i; ?>" class="btn_pink"  data-toggle="tooltip" data-placement="right" title="Order Detail"><i class="fa fa-eye"></i></a>
										        <div class="modal fade"  id="gridSystemModal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
													<div class="modal-dialog" role="document" id="print_<?php echo $i;?>">
													    <div class="modal-content" >
													      	<div class="modal-header portlet-title">
														        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														        <h4 class="modal-title" id="gridSystemModalLabel">Booking Detail</h4>
													      	</div>
													      	<div class="modal-body">
														        <div class="row">
														          	<div class="col-md-12">
																		<?php 
																		if(!empty($value->first_name))
																		{
																			echo "<label><b>First Name </b>:</label>
																			<label>".$value->first_name."</label><br>";
																		}
																		if(!empty($value->last_name))
																		{
															       			echo "<label><b>Last Name </b>:</label>
															       			<label>".$value->last_name."</label><br>";
															       		}
															       		if(!empty($value->email))
																		{
																			echo "<label><b>Email </b>:</label>
																			<label>".$value->email."</label><br>";
																		}
																		if(!empty($value->contact))
																		{
															       			echo "<label><b>Contact </b>:</label>
															       			<label>".$value->contact."</label><br>";
															       		}
															       		?>
														       		</div>
														       		
														        </div>

														        <div class="row">        
																<hr>
																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<!-- <p class="section_heading">Shopping Cart</p> -->
																		<div class="table-responsive">
																			<table class="table-bordered width_100">
																			    <thead>
																			        <tr>
																			            <td width="50%" align="center"><b>Item</b></td>
																			            <td width="15%" align="center"><b>Service</b></td>
																			            <td width="15%" align="center"><b>Booking</b></td>
																			            <td width="20%" align="center"><b>Total</b></td>
																			        </tr>
																			    </thead>
																			    <tbody>
																			    	<?php $order_order_detail = json_decode($value->order_detail) ; ?>
																			    	<?php if(!empty($order_order_detail)) { ?>
																				        <?php foreach ($order_order_detail as $items): ?>
																		                <tr>
																		                    <td>
																		                    	<label class="date"><b>Treatment Type : </b> <?php if(isset($items->service_name)&&!empty($items->service_name)){ echo $items->service_name.' - '; } ?><?php echo $items->name; ?></label>
																		                    	<label class="date"><b>Artist : </b> <?php echo $items->artist_name; ?></label>
																								<p class="font11 " style="padding-left: 15px;">
																									Date : <?php echo $items->date; ?><br>
																									<?php  ?>
																									Time : <?php echo $items->timeSlot; ?><br>
																									
																								</p>
																		                    </td>
																		                    <td align="center" style="vertical-align: middle;">
																		                    	<?php echo $items->qty; ?>
																		                    </td>
																		                    <td align="right" style="vertical-align: middle;">
																		                    	<?php echo '$'.$this->cart->format_number($items->price); ?>
																		                    </td>
																		                    <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items->subtotal); ?>
																		                    </td>
																		                </tr>
																				        <?php endforeach; ?>
																				        <tr>
																				        	<td colspan="3" align="right"> <b>Total :</b></td>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
																				        </tr>
																				        <?php if($value->tax >0) {?>
																				        <tr>
																				        	<td colspan="3" align="right"> <b>(+)GST (Goods & Services Tax) :</b></td>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
																				        </tr>
																				        <?php }?>
																				        <?php if($value->discount>0) {?>
																				        <tr>
																				        	<td colspan="3" align="right"> <b>(-)Discount :</b></td>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->discount); ?></td>
																				        </tr>
																				        <?php }?>
																				        <tr>
																				        	<td colspan="3" align="right"> <b>Grand Total :</b></td>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->grand_total); ?></td>
																				        </tr>
																				    <?php } else { ?>
																					    <tr>
																					    	<td colspan="4" align="center"> <b>Detail Not Found.</b></td>
																					    </tr>
																				    <?php } ?>
																			    </tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button> -->
																<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
																<!-- <button type="button" class="btn btn-primary" onclick="printContent('print_<?php //echo $i;?>');"><i class="fa fa-print"> Print </i></button> -->
																<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"> Close </i></button>
															</div>
													    </div><!-- /.modal-content -->
													</div><!-- /.modal-dialog -->
												</div><!-- /.modal -->
										        <!-- end detail model section-->
										        </td>
									        </tr>
									        
						        		<?php }?>
							        <?php } else { ?>
							        			<tr>
							        				<td colspan="7">
									                        <b>Booked services not fount. </b>
							        				</td>
							        			</tr>
							        <?php } ?>
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

<script>
	function printContent(el){

		$("#"+el).parent().modal('hide');

		setTimeout(function()
		{ 
			var restorepage = document.body.innerHTML;
			var title = document.title;
			document.title='Order Dteail';
			$(".modal-footer").html('');

			$('.product_thumb').css('width', '100%');
			$('.table-bordered').css('width', '100%');
			$('.product_thumb:nth-child(1)').css({
				'width': '30%',
				'float': 'left',
				'display': 'inline'
			});
			$('.product_thumb:nth-child(2)').css({
				'width': '65%',
				'float': 'right',
				'display': 'inline'
			});
			$('.product_thumb:nth-child(2)').append('<div style="clear:both"></div>');
			var printcontent = $("#"+el).html();

			document.body.innerHTML = printcontent;
			window.print();
			document.title = title;
			document.body.innerHTML = restorepage;
			Layout.init(); 
			
		}, 500);
		//window.location.reload();
	}
</script>
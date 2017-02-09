	<div class="page-content-wrapper">
		<div class="page-content">
					
			
			<div class="clearfix">
			</div>
			 
			<div class="row">
				<div class="col-md-12">
					 <?php  echo msg_alert_backend(); ?>
					 <div id="my_alert_message"></div>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
									<i class="fa fa-list"></i> Products Ordered List
							</div>							
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<div class="col-md-12 well">
									<form action="<?php echo base_url('backend/orders/index'); ?>" method="get" accept-charset="utf-8">
										<!-- <div class="form-group"> -->
											<div class="col-md-4">
												<input type="text" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" name="search" placeholder="Enter order id to search order">
											</div>
										<!-- </div> -->
										<!-- <div class="form-group col-md-6"> -->
											<input type="submit" class="btn btn-primary" value="search">
											<a href="<?php echo base_url('backend/orders/index/0'); ?>" class="btn btn-danger"> Reset </a>
										<!-- </div> -->
									</form>
								</div>
								<table class="table table-bordered favorite_table">
							        <thead>
							          	<tr>
							          		<th>#</th>
								            <th>Order Id</th>
								            <th>Contact Detail</th>
								            <th>Order Date</th>
								            <th>Total</th>
								            <!-- <th>Payment Type</th> -->
								            <th>Distributor Name</th>
								            <!-- <th>Status</th> -->
								     		<th>Action</th>
								        </tr>
							        </thead>
							        <tbody>
							        	<?php if(!empty($order_detail)) {  $i=$offset;?>
							        		<?php foreach ($order_detail as $value) { $i++; ?>
										        <tr>
										        	<td><?php  echo $i.'.';?></td>
											        <td><?php  if($value->unique_order_id){ echo $value->unique_order_id; }else{ echo $value->order_id; } ?></td>
											        <td>
											        	<?php  
											        		if(!empty($value->user_name)) echo ucwords($value->user_name);
											        		if(!empty($value->user_email))
												        	{
												        		echo "<br>";
												        		echo $value->user_email;
												        	}
												        	if(!empty($value->user_phone))
												        	{
												        		echo "<br>";
												        		echo $value->user_phone;
												        	}	
											        	?>
											        </td>
											        <td><?php  echo date('d M Y',strtotime($value->created));?></td>
											        <td>$<?php  echo $value->grand_total;?></td>
											        <!-- <td><?php  //echo ucfirst($value->payment_type);?></td> -->
											        <td><?php if(!empty($value->distributor_name)) echo $value->distributor_name; ?></td>
											        <!-- <td><?php //if($value->status == 0 ) echo "Pending"; ?></td> -->
											        <td>
											        	<a href="javascript:;" data-toggle="modal" data-target="#gridSystemModal_<?php echo $i; ?>" class="btn btn-info btn-xs" title="Order Detail"><i class="fa fa-eye"></i></a>
											        	<a href="javascript:;" data-toggle="tooltip" title="Forward Email" onclick="send_mail('<?php echo $value->order_id;?>')" class="btn btn-success btn-xs"><i class="fa fa-share"></i></a>
											        	<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#gridSystemModal_<?php //echo $i; ?>"> Launch demo modal </button> -->
											        	<!-- detail model section -->
											        <?php $order_user_detail = json_decode($value->user_detail); ?>
											        <div class="modal fade"  id="gridSystemModal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
														<div class="modal-dialog" role="document" id="<?php echo 'print_'.$i;?>">
														    <div class="modal-content">
														      	<div class="modal-header portlet-title">
															        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															        <h4 class="modal-title" id="gridSystemModalLabel">Order Detail</h4>
														      	</div>
														      	<div class="modal-body">

														      		<div class="row popup_add_info">
														      			<div class="col-xs-12 col-sm-4 col-md-4">
														      				<div class="popup_add_col">
																				<h5 class="margin_top_0">Order Details</h5>
																				<div class="popup_address_wrp">
																					<p><span>Order Id : <?php if($value->unique_order_id) { echo $value->unique_order_id; }else{ echo $value->order_id; } ?></span></p>
																					<!-- <span>Order Status : <?php //if($value->status == 0 ) echo "Pending"; ?></span><br> -->
																					<p><span>Date : <?php echo date('d M Y h:i:s',strtotime($value->created)); ?></span></p>
																					<p><span>Amount :<?php echo '$'.$this->cart->format_number($value->grand_total); ?></p>
																					<?php if($value->coupon_code!=''){ ?>
																					<p><span><?php echo str_replace('-', ':', $value->coupon_code); ?></p>
																					<?php } ?>
																				</div>
																			</div>
														      			</div>
														      			<div class="col-xs-12 col-sm-4 col-md-4">
																			<div class="popup_add_col">
															      				<h5 class="margin_top_0">Billing Address</h5>
																				<div class="popup_address_wrp">
																					<p><?php  if(!empty($order_user_detail->first_name)) {  echo ucfirst($order_user_detail->first_name); }  ?></p>
																					<p><?php  if(!empty($order_user_detail->last_name)) {  echo ' '.ucfirst($order_user_detail->last_name); }  ?></p>
																					<p><?php  if(!empty($order_user_detail->address)) {  echo $order_user_detail->address; }  ?></p>
																					<p><?php  if(!empty($order_user_detail->city)) {  echo $order_user_detail->city; }  ?></p>
																					<p><?php  if(!empty($order_user_detail->state)) {  echo $order_user_detail->state; }  ?></p>
																					<p><?php  if(!empty($order_user_detail->zip)) {  echo $order_user_detail->zip; } ?></p>
																					<p><?php  if(!empty($order_user_detail->county)) {  echo $order_user_detail->county; }  ?></p>
																					<p class="word_wrap"><?php  if(!empty($order_user_detail->email)) {  echo 'Email : <br>'. $order_user_detail->email; }  ?></p>
																					<p class="word_wrap"><?php  if(!empty($order_user_detail->mobile)) {  echo 'Phone No. : <br>'. $order_user_detail->mobile; }  ?></p>
																				</div>
																			</div>														      				
														      			</div>
														      			<div class="col-xs-12 col-sm-4 col-md-4">
														      				<div class="popup_add_col">
																				<h5 class="margin_top_0">Shipping Address</h5>
																				<div class="popup_address_wrp">
																					<p><?php  if(!empty($order_user_detail->s_first_name)) {  echo ucfirst($order_user_detail->s_first_name); }  ?></p>
																					<p><?php  if(!empty($order_user_detail->s_last_name)) {  echo ' '.ucfirst($order_user_detail->s_last_name); }  ?></p>
																					<p><?php  if(!empty($order_user_detail->s_address)) {  echo $order_user_detail->s_address; } ?></p>
																					<p><?php  if(!empty($order_user_detail->s_city)) {  echo $order_user_detail->s_city; }  ?></p>
																					<p><?php  if(!empty($order_user_detail->s_state)) {  echo $order_user_detail->s_state; }  ?></p>
																					<p><?php  if(!empty($order_user_detail->s_zip)) {  echo $order_user_detail->s_zip; } ?></p>
																					<p><?php  if(!empty($order_user_detail->s_county)) {  echo $order_user_detail->s_county; }  ?></p>
																					<p class="word_wrap"><?php  if(!empty($order_user_detail->s_email)) {  echo 'Email : <br>'. $order_user_detail->s_email; }  ?></p>
																					<p class="word_wrap"><?php  if(!empty($order_user_detail->s_mobile)) {  echo 'Phone No. : <br>'. $order_user_detail->s_mobile; }  ?></p>
																				</div>
																			</div>
														      			</div>
														      		</div>

															        <div class="row">        
																		<div class="col-xs-12 col-sm-12 col-md-12">
																			<h5 class="margin_top_0"><hr><b>Shopping Cart</b></h5>
																			<!-- <p class="section_heading">Shopping Cart</p> -->
																			<div class="table-responsive">
																				<table class="table-bordered">
																				    <thead>
																				        <tr>
																				            <td width="60%" align="center"><b>Item</b></td>
																				            <td width="10%" align="center"><b>Qty</b></td>
																				            <td width="10%" align="center"><b>Price</b></td>
																				            <?php if($value->membership_discount_array!=''){ ?>
																				            	<td width="20%" align="center"><b>Subtotal</b></td>
																				            	<td width="20%" align="center"><b>(-)Discount</b></td>
																				            	<td width="20%" align="center"><b>Final</b></td>
																				            <?php }else{ ?>
																				            	<td width="20%" align="center"><b>Total</b></td>
																				            <?php }?>
																				            
																				        </tr>
																				    </thead>
																				    <tbody>
																				    	<?php 
																				    	$membership_discount_array = json_decode($value->membership_discount_array,TRUE);
																				    	$order_order_detail = json_decode($value->order_detail) ; ?>
																				        <?php foreach ($order_order_detail as $items): ?>
																		                <tr>
																		                    <td>
																		                        <div class="product_thumb">
																		                        	<table width="100%">
																		                        		<!-- <tr>
																		                        			<th width="30%"></th>
																		                        			<th width="70%"></th>
																		                        		</tr> -->
																		                        		<tr>
																				                            <td class="col-md-4">
																				                                <span>
																				                                	<?php
																					                                if(!empty($items->image)) 
																					                                {
																					                                	$temp_image = explode('/assets/',$items->image);
																					                                	//print_r($temp_image);
																					                                	if(file_exists('./assets/'.end($temp_image)))
																					                                	 {
																							                                echo "<img src='".$items->image."' width='100%'>";
																							                             } 
																							                             else 
																							                                echo "<img src='".base_url('./assets/frontend/images/product_1.png')."' width='100%'>";
																					                                } 
																					                                else 
																							                           echo "<img src='".base_url('./assets/frontend/images/product_1.png')."' width='100%'>";
																					                                ?>
																				                                </span>
																				                            </td>
																				                            <td class="col-md-8">
																				                                
																				                                NAME : <?php echo $items->name; ?><br>
																				                                <?php if($items->type!='Simple') 
																				                                {
																				                                    $variation_detail_array = json_decode($items->variation_detail);
																				                                    if(count($variation_detail_array[0])== $items->variation_length )
																				                                    {
																				                                            for ($m=0; $m < $items->variation_length ; $m++) 
																				                                            { 
																				                                                echo $variation_detail_array[0][$m][1] .' : ' .$variation_detail_array[1][$m][1].'<br>';
																				                                            }
																				                                    }

																				                                } ?>
																				                            </td>
																		                            	</tr>
																		                            </table>
																		                        </div>
																		                    </td>
																		                    <td align="center" style="vertical-align: middle;">
																		                    	<?php echo $items->qty; ?>
																		                    </td>
																		                    <td align="right" style="vertical-align: middle;">
																		                    	<?php echo '$'.$this->cart->format_number($items->price); ?>
																		                    </td>
																		                    <?php if($value->membership_discount_array!=''){ ?>
																		                    	 <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items->subtotal); ?>
																			                    </td>
																			                     <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($membership_discount_array[$items->id]); ?>
																			                    </td>
																			                     <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items->subtotal-$membership_discount_array[$items->id]); ?>
																			                    </td>
																		                    <?php }else{ ?>
																			                    <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items->subtotal); ?>
																			                    </td>
																		                    <?php }?>
																		                </tr>
																				        <?php endforeach; ?>
																				        <tr>
																				        	<td colspan="3" align="right"> <b>Total :</b></td>
																				        	<?php if($value->membership_discount_array!=''){ ?>
																				        		<td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
																				        		<td align="right"> <?php echo '$'.$this->cart->format_number($value->discount*(-1)); ?></td>
																				        		<td align="right"> <?php echo '$'.$this->cart->format_number($value->total+$value->discount); ?></td>
																				        	<?php }else{ ?>
																				        		<td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
																				        	 <?php }?>
																				        </tr>
																				        <tr>
																					        <?php if($value->membership_discount_array!=''){ ?>
																					        	<td colspan="5" align="right"> <b>(+)Shipping :</b></td>
																					        <?php }else{ ?>
																					        	<td colspan="3" align="right"> <b>(+)Shipping :</b></td>
																					        <?php }?>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->shipping); ?></td>
																				        </tr>
																				        <tr>
																				        	<?php if($value->membership_discount_array!=''){ ?>
																				        		<td colspan="5" align="right"> <b>(+)GST (Goods & Services Tax) :</b></td>
																				        	<?php }else{ ?>
																				        		<td colspan="3" align="right"> <b>(+)GST (Goods & Services Tax) :</b></td>
																				        	<?php }?>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
																				        </tr>
																				        <tr>
																				        	<?php if($value->membership_discount_array!=''){ ?>
																				        		<td colspan="5" align="right"> <b>(-)Discount :</b></td>
																				        	<?php }else{ ?>
																				        		<td colspan="3" align="right"> <b>(-)Discount :</b></td>
																				        	<?php }?>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->discount*(-1)); ?></td>
																				        </tr>
																				        <tr>
																				        	<?php if($value->membership_discount_array!=''){ ?>
																				        		<td colspan="5" align="right"> <b>Grand Total :</b></td>
																				        	<?php }else{ ?>
																				        		<td colspan="3" align="right"> <b>Grand Total :</b></td>
																				        	<?php }?>
																				        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->grand_total); ?></td>
																				        </tr>
																				    </tbody>
																				</table>
																			</div>
																		</div>
																	</div>
																	<div class="shipping_cut"></div>
																	<?php if($value->distributor_id !=1) { ?>
																		<div class="row">
																			<div class="col-xs-12 col-sm-12 col-md-12">
																				<h5 class="margin_top_0"><hr><b>Payment Detail</b></h5>
																				<!-- <p class="section_heading">Shopping Cart</p> -->
																				<div class="table-responsive">
																					<table class="table-bordered" style="width: 100%;">
																						<thead>
																					        <tr>
																					            <td width="30%" align="center"><b>Name</b></td>
																					            <td width="40%" align="center"><b>Paypal</b></td>
																					            <td width="13%" align="center"><b>Amount</b></td>
																					            <td width="17%" align="center"><b>Status</b></td>
																					        </tr>
																					    </thead>
																					    <tbody>
																					    	<?php if(!empty($value->distribution_detail)) { 
																					    		$distribution_detail = json_decode($value->distribution_detail);

																					    		?>
																						    	<tr>
																						    		<td>Distributor</td>
																						    		<td><?php if(!empty($distribution_detail->distributor)) echo $distribution_detail->distributor->paypal; ?></td>
																						    		<td align="center"><?php if(!empty($distribution_detail->distributor)) echo '$'.	number_format($distribution_detail->distributor->amount,2); ?></td>
																						    		<td align="center" >
																						    			<?php 
																						    			if(!empty($distribution_detail->distributor))
																						    			{
																						    				if($distribution_detail->distributor->status == 'ok')
																						    					echo "Success";
																						    				else
																						    					echo "Failed";

																						    			}
																						    			?>
																						    		</td>
																						    	</tr>
																						    	<tr>
																						    		<td>Charity</td>
																						    		<td><?php if(!empty($distribution_detail->charity)) echo  $distribution_detail->charity->paypal; ?></td>
																						    		<td align="center" ><?php if(!empty($distribution_detail->charity)) echo  '$'.number_format($distribution_detail->charity->amount,2); ?></td>
																						    		<td align="center"><?php 
																						    			if(!empty($distribution_detail->charity)) 
																						    			{
																						    				if($distribution_detail->charity->status == 'ok')
																						    					echo "Success";
																						    				else
																						    					echo "Failed";
																						    			}
																						    			?>
																						    		</td>
																						    	</tr>
																						    	<tr>
																						    		<td>State Manager</td>
																						    		<td><?php if(!empty($distribution_detail->state)) echo  $distribution_detail->state->paypal; ?></td>
																						    		<td align="center" ><?php if(!empty($distribution_detail->state)) echo  '$'.number_format($distribution_detail->state->amount,2); ?></td>
																						    		<td align="center">
																						    			<?php 
																						    			if(!empty($distribution_detail->state)) 
																						    				if($distribution_detail->state->status == 'ok')
																						    					echo "Success";
																						    				else
																						    					echo "Failed";

																						    			?>
																						    		</td>
																						    	</tr>
																						    	<tr>
																						    		<td>Lash U Lashes</td>
																						    		<td>---</td>
																						    		<td align="center" ><?php if(!empty($value->lashulashes)) echo  '$'.number_format($value->lashulashes,2); ?></td>
																						    		<td align="center"> Success	</td>
																						    	</tr>
																						    <?php } else { ?>
																						    	<tr>
																						    		<td colspan="4" align="center"> <b> No Information Found </b> </td>
																						    	</tr>
																						    <?php } ?>
																					    </tbody>
																					</table>
																					<!-- <pre>
																						<?php //print_r(json_decode($value->distribution_detail));?>
																					</pre> -->
																				</div>
																			</div>
																		</div>
																	<?php } ?>

																	<div class="row ">
																		<div class="col-xs-12 col-sm-12 col-md-12">
																				<!-- <b><hr ></b> -->
																				<h5 class="margin_top_0"><hr><b>Shipping Address</b></h5>
																				<p>
																					<?php  if(!empty($order_user_detail->s_first_name)) {  echo ucfirst($order_user_detail->s_first_name); }  ?>
																					<?php  if(!empty($order_user_detail->s_last_name)) {  echo ' '.ucfirst($order_user_detail->s_last_name); }  ?><br>
																					<?php  if(!empty($order_user_detail->s_address)) {  echo $order_user_detail->s_address; } ?><br>
																					<?php  if(!empty($order_user_detail->s_city)) {  echo $order_user_detail->s_city; }  ?>
																					<?php  if(!empty($order_user_detail->s_state)) {  echo $order_user_detail->s_state; }  ?>
																					<?php  if(!empty($order_user_detail->s_zip)) {  echo $order_user_detail->s_zip; } ?>
																					<?php  if(!empty($order_user_detail->s_county)) {  echo $order_user_detail->s_county; }  ?>
																					<?php  if(!empty($order_user_detail->s_email)) {  echo '<br> Email : '. $order_user_detail->s_email; }  ?>
																					<?php  if(!empty($order_user_detail->s_mobile)) {  echo '<br> Phone No. : '. $order_user_detail->s_mobile; }  ?>
																				</p>
																       		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-primary" onclick="printContent('print_<?php echo $i;?>');"><i class="fa fa-print"> Print </i></button>
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
										                        <b>Order list is empty. </b>
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
			//alert(title);
			document.title='Order Dteail';
			$(".modal-footer").html('');

			$('.product_thumb').css('width', '100%');
			$('.table-bordered').css('width', '100%');
			$('.product_thumb:nth-child(1)').css({
				'width': '30%',
				'padding':'10px',
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
			//alert(window.url);
			window.print();
			document.title = title;
			document.body.innerHTML = restorepage;
			Layout.init();
			$('.tooltip.fade.top.in').remove();
			$('a').tooltip();
			
		}, 500);
	}
</script>

<script type="text/javascript">
	function send_mail(order_id)
	{
		if(confirm('Are you sure to forward order email ?'))
		{
			$.post('<?php echo base_url("backend/orders/send_mail/")?>',{order_id:order_id}, function(data) 
			{
				$("#my_alert_message").html(data.msg);
				/*optional stuff to do after success */
			});	
		}

	}
</script>

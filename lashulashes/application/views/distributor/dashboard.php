
<?php 
	$tab1 = $tab2 =  $tab3 = $tab4 = $tab5 = $tab6 = '';
	$segment =  $this->uri->segment(2);
	if($segment=='' || $segment=='profile')
	{
		$tab1='active';
	}
	else if($segment=='password')
	{
		$tab2='active';
	}
	else if($segment=='order_detail')
	{
		$tab4='active';
	}
	else if($segment=='update_detail')
	{
		$tab5 = 'active';
	}
	else if($segment=='my_favorites')
	{
		$tab6 = 'active';
	}
	else
	{
		$tab1='active';
	}
?>

<section id="page_content" class="dashboard_content">
	<div class="container">
		<div class="row text-center">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="page_head">Dashboard</h1>
            </div>
        </div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 margin_top_40"><?php echo msg_alert_frontend(); ?></div>
			<div class="col-xs-12 col-sm-3 col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li class="<?php echo $tab1; ?>"><a href="#Dashboard" data-toggle="pill">Dashboard</a></li>
					<li class="<?php echo $tab4; ?>"><a href="<?php echo base_url('distributor/order_detail');?>" >Order Summary</a></li>
					<li class="<?php echo $tab2; ?>"><a href="#change_password" data-toggle="pill">Change Password</a></li>
					<li class=""><a href="<?php echo base_url('distributor/logout');?>">Log-out</a></li>
				</ul>
			</div>
			<div class="tab-content col-xs-12 col-sm-9 col-md-9">

			    <div class="row tab-pane <?php echo $tab1; ?>" id="Dashboard">
			       <div class="tab_section col-xs-12 col-sm-12 col-md-12">
			       		<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-3 text-center" style="display: none;">
				       			
				       			<form action="<?php echo base_url('distributor/dashboard_image') ?>" method="post" enctype="multipart/form-data">
				       				<div class="profile_img_container">
					       				<div class="user_image_wrapper">
					       					<img src="<?php if(!empty($user_detail->image) && file_exists($user_detail->image)) { echo base_url($user_detail->image); } else { echo base_url('assets/frontend/images/user_image.jpg'); } ?>" alt="Login User Photo" width="100%" />
					       				</div>
					       				<div class="upload_wrapper">
						       				<a type="button" value="Change image" id="fakeBrowse" onclick="HandleBrowseClick();"> <i class="fa fa-pencil"></i> Change image</a>
						       				<input type="file" id="browse" name="fileupload" style="display: none" onchange="this.form.submit()"/>
											<label class="text-info">(Image size atlest 150x150 pixel and maximum 200x200 pixel.)</label>
										</div>
									</div>
				       			</form>
				       		</div>
			       			<script type="text/javascript">
			       				function HandleBrowseClick()
								{
								    var fileinput = document.getElementById("browse");
								    fileinput.click();
								}
			       			</script>
				       		<div class="col-xs-12 col-sm-9 col-md-9">
				       			<h2 class="margin_top_0"><?php if(!empty($user_detail->title)) echo $user_detail->title; ?></h2>
				       			<p class="user_detail margin_top_20"><i class="fa fa-envelope"></i> <?php  if(!empty($user_detail->email)) { echo $user_detail->email; }?></p>
				       			<p class="user_detail"><i class="fa fa-paypal" aria-hidden="true"></i> <?php  if(!empty($user_detail->paypal)) {  echo $user_detail->paypal; }?></p>
				       			<p class="user_detail"><i class="fa fa-phone"></i> <?php  if(!empty($user_detail->mobile)) {  echo $user_detail->mobile; }  ?></p>

				       		</div>
			       		</div>

			       		<div class="row margin_top_20">
							<div class="col-xs-12 col-sm-12 col-md-12 pull-right">
								<h3 class="margin_top_0">Billing Address</h3>
								<p>	
									<?php $b_flag=0;?>
									<?php  if(!empty($user_detail->address)) {  echo $user_detail->address; } else { $b_flag=1; } ?><br>
									<?php  if(!empty($user_detail->city)) {  echo $user_detail->city; } else { $b_flag=1; } ?>
									<?php  if(!empty($user_detail->state)) {  echo $user_detail->state; } else { $b_flag=1; } ?>
									<?php  if(!empty($user_detail->zip)) {  echo $user_detail->zip; } else { $b_flag=1; }?>
									<?php  //if(!empty($user_detail->county)) {  echo $user_detail->county; } else { $b_flag=1; } ?>
								</p>
								<?php if($b_flag) { ?>
								<p class="text-info">Please complete billing address.</p>
								<?php } ?>      			
				       		</div>

			       		</div>
			       </div>			       
			    </div>

			    <!-- change password  start-->
			    <div class="row tab-pane <?php echo $tab2; ?>" id="change_password">
			    	<div class="tab_section col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<form role="form" action="<?php echo base_url('distributor/password')?>" method="post" name="change_password_form">
							  		<div class="form-group">
							    		<label for="opwd">Old Password <span class="form_carot">*</span></label>
							    		<input type="password" class="form-control" id="pwd" name="pwd" placeholder="">
							    		<?php echo form_error('pwd')?>
							  		</div>
							  		<div class="form-group">
							    		<label for="npwd">New Password <span class="form_carot">*</span></label>
							    		<input type="password" class="form-control" id="npwd" name="npwd" placeholder="">
							    		<?php echo form_error('npwd')?>
							  		</div>
							  		<div class="form-group">
							    		<label for="cpwd">Confirm Password <span class="form_carot">*</span></label>
							    		<input type="password" class="form-control" id="cnpwd" name="cnpwd" placeholder="">
							    		<?php echo form_error('cnpwd')?>
							  		</div>
							  		<button type="submit" class="btn btn_pink">Update</button>			  		
								</form>			
							</div>
						</div>
					</div>
				</div>
				<!-- change password end -->


			    <!-- Order summary start -->
			    <div class="row tab-pane <?php echo $tab4; ?>" id="order_summary">
					<div class="tab_section col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered favorite_table">
								        <thead>
								          	<tr>
								          		<th width="4%">#</th>
									            <th width="10%">Order Id</th>
									            <th width="10%">Total</th>
									            <!-- <th>Payment Type</th> -->
									            <th width="15%">Distributor Amount</th>
									            <th width="15%">Order Date</th>
									            <!-- <th width="15%">Status</th> -->
									     		<th width="15%">Action</th>
									        </tr>
								        </thead>
								        <tbody>
								        	<?php if(!empty($order_detail)) {  $i=$offset;?>
								        		<?php foreach ($order_detail as $value) { $i++; ?>
											        <tr>
											        	<td><?php  echo $i.'.';?></td>
												        <td><?php  echo $value->order_id;?></td>
												        <td>$<?php  echo $value->grand_total;?></td>
												        <!-- <td><?php  //echo ucfirst($value->payment_type);?></td> -->
												        <td>
												        	<?php if(!empty($value->distribution_detail)) 
												        	{ 
																$distribution_detail = json_decode($value->distribution_detail); 
																if(!empty($distribution_detail->distributor))
																	{ 
																		echo '$'.number_format($distribution_detail->distributor->amount,2);
																	}
																	else
																	{
																		echo "---";
																	}
															} else {
																echo "---";
															} ?>
												        </td>
												        <td><?php  echo date('d M ,Y',strtotime($value->created));?></td>
												        <!-- <td><?php //if($value->status == 0 ) echo "Pending"; ?></td> -->
												        <td>
												        	<a data-toggle="modal" data-target="#gridSystemModal_<?php echo $i; ?>" class="btn_pink"  data-toggle="tooltip" data-placement="right" title="Order Detail"><i class="fa fa-eye"></i></a>
												        	<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#gridSystemModal_<?php //echo $i; ?>"> Launch demo modal </button> -->

												        	<!-- detail model section -->
													        <?php $order_user_detail = json_decode($value->user_detail); ?>
													        <div class="modal fade"  id="gridSystemModal_<?php echo $i; ?>" tabindex="-1" role="dialog"  aria-labelledby="gridSystemModalLabel">
																<div class="modal-dialog" role="document" id="<?php echo 'print_'.$i;?>">
																    <div class="modal-content">
																      	<div class="modal-header">
																	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	        <h4 class="modal-title" id="gridSystemModalLabel">Order Detail</h4>
																      	</div>
																      	<div class="modal-body">
																	        <div class="col-md-12 table-responsive">
																	        	<table width="100%">
																	        	<tr> 
																	        		<th width="35%"><b><h5 class="margin_top_0">Billing Address <hr></b></h5></th>
																	        		<th width="35%"><b><h5 class="margin_top_0">Shipping Address<hr></b></h5></th>
																	        		<th width="30%"><b><h5 class="margin_top_0">Order Details<hr></b></h5></th>
																	        	</tr>
																	        	<tr>
																		          	<td class="col-md-4">
																						<p>	
																							<?php  if(!empty($order_user_detail->first_name)) {  echo ucfirst($order_user_detail->first_name); }  ?>
																							<?php  if(!empty($order_user_detail->last_name)) {  echo ' '.ucfirst($order_user_detail->last_name); }  ?><br>

																							<?php  if(!empty($order_user_detail->address)) {  echo $order_user_detail->address; }  ?><br>
																							<?php  if(!empty($order_user_detail->city)) {  echo $order_user_detail->city; }  ?>
																							<?php  if(!empty($order_user_detail->state)) {  echo $order_user_detail->state; }  ?>
																							<?php  if(!empty($order_user_detail->zip)) {  echo $order_user_detail->zip; } ?>
																							<?php  /*if(!empty($order_user_detail->county)) {  echo $order_user_detail->county; } */ ?>
																							<?php  if(!empty($order_user_detail->email)) {  echo '<br><br> Email : <br>'. $order_user_detail->email; }  ?>
																							<?php  if(!empty($order_user_detail->mobile)) {  echo '<br> Phone No. : <br>'. $order_user_detail->mobile; }  ?>
																						</p>
																		       		</td>
																		       		<td class="col-md-4">
																						<p>
																							<?php  if(!empty($order_user_detail->s_first_name)) {  echo ucfirst($order_user_detail->s_first_name); }  ?>
																							<?php  if(!empty($order_user_detail->s_last_name)) {  echo ' '.ucfirst($order_user_detail->s_last_name); }  ?><br>
																							<?php  if(!empty($order_user_detail->s_address)) {  echo $order_user_detail->s_address; } ?><br>
																							<?php  if(!empty($order_user_detail->s_city)) {  echo $order_user_detail->s_city; }  ?>
																							<?php  if(!empty($order_user_detail->s_state)) {  echo $order_user_detail->s_state; }  ?>
																							<?php  if(!empty($order_user_detail->s_zip)) {  echo $order_user_detail->s_zip; } ?>
																							<?php  /*if(!empty($order_user_detail->s_county)) {  echo $order_user_detail->s_county; }*/  ?>
																							<?php  if(!empty($order_user_detail->s_email)) {  echo '<br><br> Email : <br>'. $order_user_detail->s_email; }  ?>
																							<?php  if(!empty($order_user_detail->s_mobile)) {  echo '<br> Phone No. : <br>'. $order_user_detail->s_mobile; }  ?>
																						</p>
																		       		</td>
																		       		<td class="col-md-4">
																		       			<p>	
																							<span>Order Id : <?php echo $value->order_id; ?></span><br>
																							<!-- <span>Order Status : <?php //if($value->status == 0 ) echo "Pending"; ?></span><br> -->
																							<span>Date : <?php echo date('d, M Y h:i:s',strtotime($value->created)); ?></span>	<br>
																							<span>Amount :<?php echo '$'.$this->cart->format_number($value->grand_total); ?>							
																		       			</p>
																		       		</td>
																		       	</tr>
																		       </table>
																	        </div>

																	        <div class="row">        
																				<div class="col-xs-12 col-sm-12 col-md-12">
																					<h5 class="margin_top_0"><hr>Shopping Cart<hr></h5>
																					<!-- <p class="section_heading">Shopping Cart</p> -->
																					<div class="table-responsive">
																						<table class="tabel0 table-bordered">
																						    <thead>
																						        <tr>
																						            <td width="60%" align="center"><b>Item</b></td>
																						            <td width="10%" align="center"><b>Qty</b></td>
																						            <td width="10%" align="center"><b>Price</b></td>
																						            <td width="20%" align="center"><b>Total</b></td>
																						        </tr>
																						    </thead>
																						    <tbody>
																						    	<?php $order_order_detail = json_decode($value->order_detail) ; ?>
																						        <?php foreach ($order_order_detail as $items): ?>
																				                <tr>
																				                    <td>
																				                        <div class="product_thumb">
																				                            <table width="100%">
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
																				                    <td align="center" style="vertical-align: middle;">
																				                    	<?php echo '$'.$this->cart->format_number($items->price); ?>
																				                    </td>
																				                    <td align="right" style="vertical-align: middle; padding: 5px;">$<?php echo $this->cart->format_number($items->subtotal); ?>
																				                    </td>
																				                </tr>
																						        <?php endforeach; ?>
																						        <tr>
																						        	<td colspan="3" align="right" style="vertical-align: middle; padding: 5px;"> <b>Total :</b></td>
																						        	<td align="right" style="vertical-align: middle; padding: 5px;"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
																						        </tr>
																						        <tr>
																						        	<td colspan="3" align="right" style="vertical-align: middle; padding: 5px;"> <b>(+)Shipping :</b></td>
																						        	<td align="right" style="vertical-align: middle; padding: 5px;"> <?php echo '$'.$this->cart->format_number($value->shipping); ?></td>
																						        </tr>
																						        <tr>
																						        	<td colspan="3" align="right" style="vertical-align: middle; padding: 5px;"> <b>(+)GST (Goods & Services Tax) :</b></td>
																						        	<td align="right" style="vertical-align: middle; padding: 5px;"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
																						        </tr>
																						        <tr>
																						        	<td colspan="3" align="right" style="vertical-align: middle; padding: 5px;"> <b>(-)Discount :</b></td>
																						        	<td align="right" style="vertical-align: middle; padding: 5px;"> <?php echo '$'.$this->cart->format_number($value->discount); ?></td>
																						        </tr>
																						        <tr>
																						        	<td colspan="3" align="right" style="vertical-align: middle; padding: 5px;"> <b>Grand Total :</b></td>
																						        	<td align="right" style="vertical-align: middle; padding: 5px;"> <?php echo '$'.$this->cart->format_number($value->grand_total); ?></td>
																						        </tr>
																						    </tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																			<div class="shipping_cut"></div>
																			<div class="col-xs-12 col-sm-12 col-md-12">
																					<h5 class="margin_top_0"><hr>Shipping Address<hr></h5>
																				<p>
																					<?php  if(!empty($order_user_detail->s_first_name)) {  echo ucfirst($order_user_detail->s_first_name); }  ?>
																					<?php  if(!empty($order_user_detail->s_last_name)) {  echo ' '.ucfirst($order_user_detail->s_last_name); }  ?><br>
																					<?php  if(!empty($order_user_detail->s_address)) {  echo $order_user_detail->s_address; } ?><br>
																					<?php  if(!empty($order_user_detail->s_city)) {  echo $order_user_detail->s_city; }  ?>
																					<?php  if(!empty($order_user_detail->s_state)) {  echo $order_user_detail->s_state; }  ?>
																					<?php  if(!empty($order_user_detail->s_zip)) {  echo $order_user_detail->s_zip; } ?>
																					<?php  /*if(!empty($order_user_detail->s_county)) {  echo $order_user_detail->s_county; }*/  ?>
																					<?php  if(!empty($order_user_detail->s_email)) {  echo '<br> Email : '. $order_user_detail->s_email; }  ?>
																					<?php  if(!empty($order_user_detail->s_mobile)) {  echo '<br> Phone No. : '. $order_user_detail->s_mobile; }  ?>
																				</p>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-success0" onclick="printContent('print_<?php echo $i;?>');"><i class="fa fa-print"> Print </i></button>
																			<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
																		<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
							        			
							        				</td>
							        			</tr>
									        <?php } ?>
								        </tbody>
							      	</table>
								</div>
								<div>
									<?php if(!empty($pagination)) echo $pagination;?>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- Order summary end -->



			</div><!-- tab content -->
		</div>
	</div>

</section>

<script>
	$('a').tooltip();
	$("#use_billing_address").click(function(event) {
		
		var chk = 0;
		if($(this).prop("checked") == true)
		{
            chk = 1;
        }
        if(chk)
        {
        	$("#s_first_name").val($("#first_name").val());
        	$("#s_last_name").val($("#last_name").val());
        	$("#s_email").val($("#email").val());
        	$("#s_address").val($("#address").val());
        	//$("#change_city2").val($("#city").val());
        	//$("#change_state2").val($("#state").val());
        	$("#s_zip").val($("#zip").val());
        	//$("#s_county").val($("#county").val());
        	$("#s_mobile").val($("#mobile").val());

        	var temp_state = $("#change_state").val();
        	var temp_city = $("#change_city").val();
        	//$("#change_state2 option[value='"+temp_state+"']").prop('selected', true).trigger( "change" );
        	$("#change_state2 option[value='"+temp_state+"']").prop('selected', true);

        	$("#change_city2").html($("#change_city").html());
        	$("#change_city2 option[value='"+temp_city+"']").prop('selected', true);
            
        	$("#use_billing_address").prop("checked", true);

        }
        else
        {	
        	$("#s_first_name").val('');
        	$("#s_last_name").val('');
        	$("#s_email").val('');
        	$("#s_address").val('');
        	$("#change_state2").val('');
        	$("#change_city2").html('<option value="">Select City</option>');
        	$("#s_zip").val('');
        	//$("#s_county").val('');
        	$("#s_mobile").val('');

        }
	});
	$('.s_input_change, .b_input_change').change(function(event) {
		$("#use_billing_address").prop("checked","");
	});
</script>

<script>
	function printContent(el){
		
		// $("#"+el)('hide');

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
				//'width': '30%',
				'padding':'10px',
				'float': 'left',
				'display': 'inline'
			});
			$('.product_thumb:nth-child(2)').css({
				//'width': '65%',
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
			//Layout.init();
			$('.tooltip.fade.top.in').remove();
			$('a').tooltip();
			
		}, 500);
	}
</script>
<?php 
	$tab1 = $tab2 =  $tab3 = $tab4 = $tab5 = $tab6 = $tab7 = $tab8 = '';
	$segment =  $this->uri->segment(2);
	if($segment=='' || $segment=='profile'){
		$tab1='active';
	}else if($segment=='password'){
		$tab2='active';
	}else if($segment=='order_detail'){
		$tab4='active';
	}else if($segment=='update_detail'){
		$tab5 = 'active';
	}else if($segment=='my_favorites'){
		$tab6 = 'active';
	}else if($segment=='membership'){
		$tab3 = 'active';
	}else if($segment=='services'){
		$tab7 = 'active';
	}else if($segment=='training'){
		$tab8 = 'active';
	}else{
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
			<div class="col-xs-12 col-sm-12 col-md-12 margin_top_40" id="error_message" ><?php echo msg_alert_frontend(); ?></div>
			<div class="col-xs-12 col-sm-3 col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li class="<?php echo $tab1; ?>"><a href="#Dashboard" data-toggle="pill">Dashboard</a></li>
					<li class="<?php echo $tab3; ?>"><a href="#membership" data-toggle="pill">Membership</a></li>
					<li class="<?php echo $tab6; ?>"><a href="<?php echo base_url('website/my_favorites');?>">My Favorites</a></li>
					<li class="<?php echo $tab7; ?>"><a href="<?php echo base_url('website/services');?>" >Booked Services</a></li>
					<li class="<?php echo $tab8; ?>"><a href="<?php echo base_url('website/training');?>" >Booked Training</a></li>
					<li class="<?php echo $tab4; ?>"><a href="<?php echo base_url('website/order_detail');?>" >Order Summary</a></li>
					<li class="<?php echo $tab5; ?>"><a href="#update_address" data-toggle="pill">Edit Profile</a></li>
					<li class="<?php echo $tab2; ?>"><a href="#change_password" data-toggle="pill">Change Password</a></li>
				</ul>
			</div>
			<div class="tab-content col-xs-12 col-sm-9 col-md-9">

			    <div class="row tab-pane <?php echo $tab1; ?>" id="Dashboard">
			       <div class="tab_section col-xs-12 col-sm-12 col-md-12">
			       		<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-3 text-center">
				       			
				       			<form action="<?php echo base_url('website/dashboard_image') ?>" method="post" enctype="multipart/form-data">
				       				<div class="profile_img_container">
					       				<div class="user_image_wrapper">
					       					<img src="<?php if(!empty($user_detail->image) && file_exists($user_detail->image)) { echo base_url($user_detail->image); } else { echo base_url('assets/frontend/images/user_image.jpg'); } ?>" alt="Login User Photo" width="100%" />
					       				</div>
					       				<div class="upload_wrapper">
						       				<a type="button" value="Change image" id="fakeBrowse" onclick="HandleBrowseClick();"> <i class="fa fa-pencil"></i> Change image</a>
						       				<input type="file" id="browse" name="fileupload" style="display: none" onchange="this.form.submit()"/>
											<label class="text-info">(Image size atleast 150x150 pixel and maximum 200x200 pixel.)</label>
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
				       			<h2 class="margin_top_0"><?php if(!empty($user_detail->first_name)) echo $user_detail->first_name; if(!empty($user_detail->last_name)) echo ' '.$user_detail->last_name; ?></h2>
				       			<p class="user_detail margin_top_20"><i class="fa fa-envelope"></i> <?php  if(!empty($user_detail->email)) { echo $user_detail->email; } else { echo '<span class="text-info">Add email address</span>'; }?></p>
				       			<p class="user_detail"><i class="fa fa-phone"></i> <?php  if(!empty($user_detail->mobile)) {  echo $user_detail->mobile; } else { echo '<span class="text-info">Add mobile number</span>'; } ?></p>
				       		</div>
			       		</div>

			       		<div class="row margin_top_20">
							<div class="col-xs-12 col-sm-6 col-md-6">
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

				       		<div class="col-xs-12 col-sm-6 col-md-6">
								<h3 class="margin_top_0">Shipping Address</h3>
								<p>
									<?php $s_flag=0;?>
									<?php if($user_detail->shipping) { ?>
										<?php  if(!empty($user_detail->address)) {  echo $user_detail->address; } else { $s_flag=1; } ?><br>
										<?php  if(!empty($user_detail->city)) {  echo $user_detail->city; } else { $s_flag=1; } ?>
										<?php  if(!empty($user_detail->state)) {  echo $user_detail->state; } else { $s_flag=1; } ?>
										<?php  if(!empty($user_detail->zip)) {  echo $user_detail->zip; } else { $s_flag=1; }?>
										<?php  /*if(!empty($user_detail->county)) {  echo $user_detail->county; } else { $s_flag=1; }*/ ?>
									<?php } else { ?>
										<?php  if(!empty($user_detail->s_address)) {  echo $user_detail->s_address; } else { $s_flag=1; } ?><br>
										<?php  if(!empty($user_detail->s_city)) {  echo $user_detail->s_city; } else { $s_flag=1; } ?>
										<?php  if(!empty($user_detail->s_state)) {  echo $user_detail->s_state; } else { $s_flag=1; } ?>
										<?php  if(!empty($user_detail->s_zip)) {  echo $user_detail->s_zip; } else { $s_flag=1; }?>
										<?php  /*if(!empty($user_detail->s_county)) {  echo $user_detail->s_county; } else { $s_flag=1; }*/ ?>
									<?php } ?>
								</p>
								<?php if($s_flag) { ?>
								<p class="text-info">Please complete shipping address.</p>
								<?php } ?>  
								<a href="<?php echo base_url('website/update_detail'); ?>" class="edit_link"><i class="fa fa-pencil-square-o"> Edit</i></a>  
				       		</div>
			       		</div>

				       	<!-- </div> -->
			       		
			       </div>			       
			    </div>

			    <!-- change password  start-->
			    <div class="row tab-pane <?php echo $tab2; ?>" id="change_password">
			    	<div class="tab_section col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<form role="form" action="<?php echo base_url('website/password')?>" method="post" name="change_password_form">
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

				<!-- Membership detail  strat -->
			    <div class="row tab-pane <?php echo $tab3; ?>" id="membership">
			    	<div class="tab_section col-xs-12 col-sm-12 col-md-12">
			    		
			    		<div class="row margin_top_20">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<h3 class="margin_top_0">Membership Plan Detail</h3>
								<?php if($membership_detail){ ?>
									<h4 class="margin_top_0"><?php echo $membership_detail->plan_name;?></h4>
									<p>Valid from <?php echo date('d M ,Y',strtotime($membership_detail->start_date));?> to <?php echo date('d M ,Y',strtotime($membership_detail->end_date));?>. </p>
				       			<?php }else{ ?>
				       				<p>No Membership Plan!</p>
				       			<?php } ?>
				       		</div>
			       		</div>
			       		
			    		 <!-- <div class="row">
				    		<div class="col-xs-12 col-sm-12 col-md-12">
				    			<p class="section_text">

						        </p>
						        <form role="form" action="<?php echo base_url('website/membership')?>" method="post" name="change_password_form">
							  		<div class="form-group">
							    		<label for="cpwd">Discount Code <span class="form_carot">*</span></label>
							    		<input type="text" class="form-control" id="discount_code" name="discount_code" placeholder="">
							    		<?php echo form_error('discount_code')?>
							  		</div>
							  		<button type="submit" class="btn btn_pink">Update</button>			  		
								</form>		
						    </div>		    			
			    		</div> -->
			    	</div>
			    </div>
			    <!-- Membership detail end -->

			    <!-- Order summary start -->
			    <div class="row tab-pane <?php echo $tab4; ?>" id="order_summary">
					<div class="tab_section col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered favorite_table">
								        <thead>
								          	<tr>
								          		<th>#</th>
									            <th>Order Id</th>
									            <th>Order Date</th>
									            <th>Total</th>
									            <!-- <th>Payment Type</th> -->
									            <!-- <th>Status</th> -->
									     		<th>Action</th>
									        </tr>
								        </thead>
								        <tbody>
								        	<?php if(!empty($order_detail)) {  $i=$offset;?>
								        		<?php foreach ($order_detail as $value) { $i++; ?>
											        <tr>
											        	<td><?php  echo $i.'.';?></td>
												        <td><?php  if($value->unique_order_id!=''){ echo $value->unique_order_id; }else { echo $value->order_id; } ?></td>
												        <td><?php  echo date('d M ,Y',strtotime($value->created));?></td>
												        <td>$<?php  echo $value->grand_total;?></td>
												        <!-- <td><?php  //echo ucfirst($value->payment_type);?></td> -->
												        <!-- <td><?php //if($value->status == 0 ) echo "Pending"; ?></td> -->
												        <td>
												        	<a data-toggle="modal" data-target="#gridSystemModal_<?php echo $i; ?>" class="btn_pink"  data-toggle="tooltip" data-placement="right" title="Order Detail"><i class="fa fa-eye"></i></a>
												        	<!-- detail model section -->
													        <?php $order_user_detail = json_decode($value->user_detail); ?>
													        <div class="modal fade"  id="gridSystemModal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
																<div class="modal-dialog" role="document">
																    <div class="modal-content">
																      	<div class="modal-header">
																	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	        <h4 class="modal-title" id="gridSystemModalLabel">Order Detail</h4>
																      	</div>
																      	<div class="modal-body">
																	        <div class="row">
																	          	<div class="col-md-4">
																					<h5 class="margin_top_0">Billing Address <hr></h5>
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
																	       		</div>
																	       		<div class="col-md-4">
																					<h5 class="margin_top_0">Shipping Address<hr></h5>
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
																	       		</div>
																	       		<div class="col-md-4">
																	       			<h5 class="margin_top_0">Order Details<hr></h5>
																	       			<p>	
																						<span>Order Id : <?php if($value->unique_order_id!=''){ echo $value->unique_order_id; }else { echo $value->order_id; } ?></span><br>
																						<!-- <span>Order Status : <?php //if($value->status == 0 ) echo "Pending"; ?></span><br> -->
																						<span>Date : <?php echo date('d, M Y h:i:s',strtotime($value->created)); ?></span>	<br>
																						<span>Amount :<?php echo '$'.$this->cart->format_number($value->grand_total); ?></span>	<br>
																						<?php if($value->coupon_code!=''){ ?>
																						<span><?php echo str_replace("-", ':', $value->coupon_code); ?></span>	
																						<?php } ?>						
																	       			</p>
																	       		</div>
																	        </div>

																	        <div class="row">        
																				<div class="col-xs-12 col-sm-12 col-md-12">
																					<h5 class="margin_top_0"><hr>Shopping Cart<hr></h5>
																					<!-- <p class="section_heading">Shopping Cart</p> -->
																					<div class="table-responsive">
																						<table class="tabel table-bordered">
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
																						            <?php } ?>
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
																				                            <div class="col-md-3">
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
																				                            </div>
																				                            <div class="col-md-9">
																				                                <br>
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
																				                            </div>
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
																				                    <?php } ?>
																				                </tr>
																						        <?php endforeach; ?>
																						        <tr>
																						        	<td colspan="3" align="right"> <b>Total :</b></td>
																						        	<?php if($value->membership_discount_array!=''){ ?>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->discount*-1); ?></td>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->total+$value->discount); ?></td>
																						        	<?php }else { ?>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
																						        	<?php } ?>
																						        </tr>
																						        <tr>
																						        	<?php if($value->membership_discount_array!=''){ ?>
																						        		<td colspan="5" align="right"> <b>(+)Shipping :</b></td>
																						        	<?php }else { ?>
																						        		<td colspan="3" align="right"> <b>(+)Shipping :</b></td>
																						        	<?php } ?>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->shipping); ?></td>
																						        </tr>
																						        <tr>
																						        	<?php if($value->membership_discount_array!=''){ ?>
																						        		<td colspan="5" align="right"> <b>(+)GST (Goods & Services Tax) :</b></td>
																						        	<?php }else { ?>
																						        		<td colspan="3" align="right"> <b>(+)GST (Goods & Services Tax) :</b></td>
																						        	<?php } ?>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
																						        </tr>
																						        <tr>
																						        	<?php if($value->membership_discount_array!=''){ ?>
																						        		<td colspan="5" align="right"> <b>(-)Discount :</b></td>
																						        	<?php }else { ?>
																						        		<td colspan="3" align="right"> <b>(-)Discount :</b></td>
																						        	<?php } ?>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->discount); ?></td>
																						        </tr>
																						        <tr>
																						        	<?php if($value->membership_discount_array!=''){ ?>
																						        		<td colspan="5" align="right"> <b>Grand Total :</b></td>
																						        	<?php }else { ?>
																						        		<td colspan="3" align="right"> <b>Grand Total :</b></td>
																						        	<?php } ?>
																						        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->grand_total); ?></td>
																						        </tr>
																						    </tbody>
																						</table>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="modal-footer">
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
									        					<div class="alert alert-info">
											                        Order list is empty. To buy products <a href="<?php echo base_url('product')?>" class="form_carot">Click here..</a>
											                    </div>
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
				<!-- #Order summary end -->


				<!-- services summary start -->
			    <div class="row tab-pane <?php echo $tab7; ?>" id="services_summary">
					<div class="tab_section col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered favorite_table">
								        <thead>
								          	<tr>
								          		<th>#</th>
									            <th>Order Id</th>
									            <th>Order Date</th>
									            <th>Total</th>
									            <!-- <th>Payment Type</th> -->
									            <!-- <th>Status</th> -->
									     		<th>Action</th>
									        </tr>
								        </thead>
								        <tbody>
								        	<?php if(!empty($services_detail)) {  $i=$offset;?>
								        		<?php foreach ($services_detail as $value) { $i++; ?>
											        <tr>
											        	<td><?php  echo $i.'.';?></td>
												        <td><?php  if($value->registration_id!=''){ echo $value->registration_id; }else { echo $value->booking_id; } ?></td>
												        <td><?php  echo date('d M ,Y',strtotime($value->created));?></td>
												        <td>$<?php  echo $value->grand_total;?></td>
												        <!-- <td><?php  //echo ucfirst($value->payment_type);?></td> -->
												        <!-- <td><?php //if($value->status == 0 ) echo "Pending"; ?></td> -->
												        <td>
												        	<a data-toggle="modal" data-target="#servicesModal_<?php echo $i; ?>" class="btn_pink"  data-toggle="tooltip" data-placement="right" title="Booking Detail"><i class="fa fa-eye"></i></a>
												        	<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#gridSystemModal_<?php //echo $i; ?>"> Launch demo modal </button> -->

												        	<!-- detail model section -->
													        <?php $order_user_detail = json_decode($value->order_detail); ?>
													        <div class="modal fade"  id="servicesModal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
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
																						<table class="table-bordered" style="width:100%">
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
																					                    	<p>
																					                    		<label class="date"><b>Treatment Type : </b> <?php if(isset($items->service_name)&&!empty($items->service_name)){ echo $items->service_name.' - '; } ?><?php echo $items->name; ?></label><br>
																					                    		<label class="date"><b>Artist : </b> <?php echo $items->artist_name; ?></label><br>
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
									        					<div class="alert alert-info">
											                        Booking list is empty. To book Sevices <a href="<?php echo base_url('service/booking')?>" class="form_carot">Click here..</a>
											                    </div>
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
				<!-- #services summary end -->

				<!-- training summary start -->
			    <div class="row tab-pane <?php echo $tab8; ?>" id="training_summary">
					<div class="tab_section col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered favorite_table">
								        <thead>
								          	<tr>
								          		<th>#</th>
									            <th>Order Id</th>
									            <th>Order Date</th>
									            <th>Total</th>
									            <!-- <th>Payment Type</th> -->
									            <!-- <th>Status</th> -->
									     		<th>Action</th>
									        </tr>
								        </thead>
								        <tbody>
								        	<?php if(!empty($training_detail)) {  $i=$offset;?>
								        		<?php foreach ($training_detail as $value) { $i++; ?>
											        <tr>
											        	<td><?php  echo $i.'.';?></td>
												        <td><?php  if($value->registration_id!=''){ echo $value->registration_id; }else { echo $value->booking_id; } ?></td>
												        <td><?php  echo date('d M ,Y',strtotime($value->created));?></td>
												        <td>$<?php  echo $value->grand_total;?></td>
												        <!-- <td><?php  //echo ucfirst($value->payment_type);?></td> -->
												        <!-- <td><?php //if($value->status == 0 ) echo "Pending"; ?></td> -->
												        <td>
												        	<a data-toggle="modal" data-target="#trainingModal_<?php echo $i; ?>" class="btn_pink"  data-toggle="tooltip" data-placement="right" title="Booking Detail"><i class="fa fa-eye"></i></a>
												        	<!-- detail model section -->
													        <?php $order_user_detail = json_decode($value->order_detail); ?>
													        <div class="modal fade"  id="trainingModal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
																<div class="modal-dialog" role="document" id="print_<?php echo $i;?>">
																    <div class="modal-content">
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
																					<!-- <h5 class="margin_top_0"><hr>Shopping Cart<hr></h5> -->
																					<!-- <p class="section_heading">Shopping Cart</p> -->
																					<div class="table-responsive">
																						<table class="table-bordered" style="width:100%">
																						    <thead>
																						        <tr>
																						            <td width="60%" align="center"><b>Training</b></td>
																						            <td width="10%" align="center"><b>Booking</b></td>
																						            <td width="10%" align="center"><b>Price</b></td>
																						            <td width="20%" align="center"><b>Total</b></td>
																						        </tr>
																						    </thead>
																						    <tbody>
																						    	<?php $order_order_detail = json_decode($value->order_detail) ; ?>
																						    	<?php //print_r($order_order_detail);?>
																							    <?php if(!empty($order_order_detail)) { ?>
																							        <?php foreach ($order_order_detail as $items): ?>
																					                <tr>
																					                    <td>
										                                                                    <label class="date"><b>Title : </b> <?php echo $items->name; ?></label>
										                                                                    <p style="padding-left: 15px;" class="font_11">
										                                                                        <?php echo date('d-M-Y',strtotime($items->start_date)); ?> To <?php echo date('d-M-Y',strtotime($items->end_date)); ?><br>
										                                                                        <?php echo $items->timing; ?><br>
										                                                                        Category : <?php echo $items->category_name; ?><br>
										                                                                        Location : <?php echo $items->state; ?>
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
																							        <?php if($value->tax > 0) {?>
																							        <tr>
																							        	<td colspan="3" align="right"> <b>(+)GST (Goods & Services Tax) :</b></td>
																							        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
																							        </tr>
																							        <?php } ?>
																							        <?php if($value->discount > 0) {?>
																							        <tr>
																							        	<td colspan="3" align="right"> <b>(-)Discount :</b></td>
																							        	<td align="right"> <?php echo '$'.$this->cart->format_number($value->discount); ?></td>
																							        </tr>
																							       	<?php } ?>
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
									        					<div class="alert alert-info">
											                        Booking list is empty. To book Training <a href="<?php echo base_url('training')?>" class="form_carot">Click here..</a>
											                    </div>
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
				<!-- #training summary end -->

				<!-- Update user address start -->
			    <div class="row tab-pane <?php echo $tab5; ?>" id="update_address">
					<div class="tab_section col-xs-12 col-sm-12 col-md-12">

			    	<div class="row">
			    		
						<div class="col-xs-12 col-sm-12 col-md-12">
							<form role="form" action="<?php echo base_url('website/update_detail')?>" method="post" name="bilship_form">
								<p class="section_text">Your billing address must match the address associated with the credit card you use</p>
								<div class="row bilship_row2">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<h3 class="section_heading margin_top_0">Billing Address</h3>
								  		
								  		<div class="form-group">
								    		<label for="firs_tname">First Name <span class="form_carot">*</span></label>
								    		<input type="text" class="form-control b_input_change" id="first_name" name="first_name" value="<?php if(!empty($user_detail->first_name)) { echo $user_detail->first_name; } else { echo set_value('first_name');} ?>" >
								    		<?php echo form_error('first_name'); ?>
								  		</div>
								  		<div class="form-group">
								    		<label for="last_name">Last Name <span class="form_carot">*</span></label>
								    		<input type="type" class="form-control b_input_change" id="last_name" name="last_name" value="<?php if(!empty($user_detail->last_name)) { echo $user_detail->last_name; } else { echo set_value('last_name'); } ?>" >
								    		<?php echo form_error('last_name'); ?>
								  		</div>
								  		<div class="form-group">
								    		<label for="email">Email address</label>
								    		<input type="email" class="form-control b_input_change" disabled id="email" name="email" value="<?php if(!empty($user_detail->email)) { echo $user_detail->email; } else { echo set_value('email'); } ?>">
								    		<?php echo form_error('email'); ?>
								  		</div>
								  		<div class="form-group">
								  			<label for="address">Address <span class="form_carot">*</span></label>
								  			<input type="text" class="form-control b_input_change" id="address" name="address" value="<?php if(!empty($user_detail->address)) { echo $user_detail->address; } else { echo set_value('address'); } ?>" >
								  			<?php echo form_error('address'); ?>
								  		</div>
								  		
								  		<div class="form-group">
								  			<label for="zip">Postal Code <span class="form_carot">*</span></label>
								  			<input type="text" data-inputmask="'mask': '9999'" class="form-control b_input_change" id="zip" name="zip" value="<?php if(!empty($user_detail->zip)) { echo $user_detail->zip; } else { echo set_value('zip'); } ?>">
								  			<?php echo form_error('zip'); ?>
								  		</div>

								  		<div class="form-group">
											<label for="state">State<samll class="form_carot">*</samll></label>
											<?php $aus_state = get_aus_states(); ?>
											<select name="state" class="form-control b_input_change" id="state">
												<option value="">Select State</option>
												<?php if($aus_state) 
													{?>
													<?php foreach ($aus_state as $aus_state_row) { ?>
														<option value="<?php echo $aus_state_row->state_code;?>" <?php if($user_detail->state == $aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
													<?php } ?>
												<?php } ?>
											</select>
										    <?php echo form_error('state'); ?> 								
										</div>
								  		<div class="form-group">
											<label for="city">City<span class="form_carot">*</span></label>
										
											<input type="text" name="city" class="form-control b_input_change" id="change_city" value="<?php if(!empty($user_detail->city)) echo $user_detail->city; ?>">
										    <?php echo form_error('city'); ?>
										</div> 
								  		<div class="form-group">
								  			<label for="mobile">Phone No. <span class="form_carot">*</span></label>
								  			<input type="text" data-inputmask="'mask': '9999999999'" class="form-control b_input_change" id="mobile" name="mobile" value="<?php if(!empty($user_detail->mobile)) { echo $user_detail->mobile; } else { echo set_value('mobile'); } ?>">
								  			<?php echo form_error('mobile'); ?>
								  		</div>
										<div class="checkbox">
									        <label><input type="checkbox"  name='shipping' value="1" <?php if($user_detail->shipping || isset($_POST['shipping'])) echo 'checked';?> id="use_billing_address" style="display:block;" >Use Billing Information for Shipping Address</label>
									    </div>	
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<h3 class="section_heading margin_top_0">Shipping Address</h3>
								  		<div class="form-group">
								    		<label for="s_firs_tname">First Name <span class="form_carot">*</span></label>
								    		<input type="text" class="form-control s_input_change" id="s_first_name" name="s_first_name" value="<?php if(!empty($user_detail->s_first_name)) { echo $user_detail->s_first_name; } else { echo set_value('s_first_name');} ?>" >
								    		<?php echo form_error('s_first_name'); ?>
								  		</div>
								  		<div class="form-group">
								    		<label for="s_last_name">Last Name <span class="form_carot">*</span></label>
								    		<input type="type" class="form-control s_input_change" id="s_last_name" name="s_last_name" value="<?php if(!empty($user_detail->s_last_name)) { echo $user_detail->s_last_name; } else { echo set_value('s_last_name'); } ?>" >
								    		<?php echo form_error('s_last_name'); ?>
								  		</div>
								  		<div class="form-group">
								    		<label for="s_email">Email address <span class="form_carot">*</span></label>
								    		<input type="email" class="form-control s_input_change" id="s_email" name="s_email" value="<?php if(!empty($user_detail->s_email)) { echo $user_detail->s_email; } else { echo set_value('s_email'); } ?>">
								    		<?php echo form_error('s_email'); ?>
								  		</div>
								  		<div class="form-group">
								  			<label for="s_address">Address <span class="form_carot">*</span></label>
								  			<input type="text" class="form-control s_input_change" id="s_address" name="s_address" value="<?php if(!empty($user_detail->s_address)) { echo $user_detail->s_address; } else { echo set_value('s_address'); } ?>" >
								  			<?php echo form_error('s_address'); ?>
								  		</div>
								  		
								  		<div class="form-group">
								  			<label for="s_zip">Postal Code <span class="form_carot">*</span></label>
								  			<input type="text" data-inputmask="'mask': '9999'" class="form-control s_input_change" id="s_zip" name="s_zip" value="<?php if(!empty($user_detail->s_zip)) { echo $user_detail->s_zip; } else { echo set_value('s_zip'); } ?>">
								  			<?php echo form_error('s_zip'); ?>
								  		</div>
								  		
								  		<div class="form-group">
											<label for="s_state">State<samll class="form_carot">*</samll></label>
											<?php $aus_state = get_aus_states(); ?>
											<select name="s_state" class="form-control s_input_change" id="state2">
												<option value="">Select State</option>
												<?php if($aus_state) 
													{?>
													<?php foreach ($aus_state as $aus_state_row) { ?>
														<option value="<?php echo $aus_state_row->state_code;?>" <?php if(!empty($user_detail->s_state) && $user_detail->s_state == $aus_state_row->state_code) echo "selected"; ?>><?php echo $aus_state_row->state_code;?></option>
													<?php } ?>
												<?php } ?>
											</select>
										    <?php echo form_error('s_state'); ?> 									
										</div>
								  		<div class="form-group">
								  			<label for="s_city">City <span class="form_carot">*</span></label>
								  			<input type="text" class="form-control s_input_change" id="change_city2" name="s_city" value="<?php if(!empty($user_detail->s_city)) { echo $user_detail->s_city; } else { echo set_value('s_city'); } ?>">
								  			<?php echo form_error('s_city'); ?>
								  		</div>

								  		<div class="form-group">
								  			<label for="s_mobile">Phone No. <span class="form_carot">*</span></label>
								  			<input type="text" data-inputmask="'mask': '9999999999'" class="form-control s_input_change" id="s_mobile" name="s_mobile" value="<?php if(!empty($user_detail->s_mobile)) { echo $user_detail->s_mobile; } else { echo set_value('s_mobile'); } ?>">
								  			<!-- <p class="section_text_small">Example: (333) 333-3333</p> -->
								  			<?php echo form_error('s_mobile'); ?>
								  		</div>
									</div>			
								</div>
								<div class="row bilship_row2">
									<div class="col-md-12">
										<button type="submit" class="btn btn_pink pull-right">update</button>
									</div>
								</div>
							</form>	
						</div>

			    	</div>


			    	</div>
				</div>
				<!-- Update user address end -->

				<!-- My favorites list -->
			    <div class="row tab-pane <?php echo $tab6; ?>" id="order_summary">
					<div class="tab_section col-xs-12 col-sm-12 col-md-12">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered favorite_table">
								        <thead>
								          	<tr>
								          		<th width="5%">#</th>
									            <th width="80%">Product Detail</th>
									            <th width="15%">Action</th>
									        </tr>
								        </thead>
								        <tbody>
								        	<?php if(!empty($favorites)) {  $i=$offset;?>
								        		<?php foreach ($favorites as $value) { $i++; ?>
											        <tr>
											        	<td><?php  echo $i.'.';?></td>
												        <td>
												        	<?php 
				                                                if(!empty($value->active_image) && file_exists('./assets/uploads/product/thumb/'.$value->active_image))
				                                                {
				                                                    $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$value->active_image;
				                                                }
				                                                else if(!empty($value->first_image) && file_exists('./assets/uploads/product/thumb/'.$value->first_image))
				                                                {
				                                                    $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$value->first_image;
				                                                }
				                                                else
				                                                {
				                                                    $image = FRONTEND_THEME_URL_NEW.'images/product_1.png';
				                                                }
				                                            ?>
												        	
												        	<div class="product_thumb">
	                                                            <table width="100%">
	                                                            	<tr>
	                                                            		<td style=""><span class="">
	                                                            			<img src="<?php echo $image;?>" width="100%"></span>
	                                                            		</td>
	                                                            		<td style="">
	                                                            			<span class="" style="">
				                                                                <b> <?php  if(!empty($value->title)) echo ucfirst($value->title);?></b>
				                                                                <p><?php if(!empty($value->short_description)) echo word_limiter(strip_tags($value->short_description),50); ?></p>
	                                                            			</span>
	                                                            		</td>
	                                                            	</tr>
	                                                            </table>
	                                                            <div class="clerfix"></div>
	                                                        </div>
												        </td>
												        
												        <td>
												        	<a href="<?php echo base_url('product/view/'.$value->slug);?>" class="btn_pink" title="View Product"><i class="fa fa-eye"></i></a>
												        	<a onclick="return confirm('Are you sure want to remove?');" href="<?php echo base_url('website/remove_favorites/'.$value->fav_id);?>" class="btn_pink" title="Remove from favorites"><i class="fa fa-trash"></i></a>					
												        </td>
											        </tr>											        
								        		<?php }?>
									        <?php } else { ?>
								        			<tr>
								        				<td colspan="3">
								        					<div class="alert alert-info">
										                        Favorites list is empty. To view products <a href="<?php echo base_url('product')?>" class="form_carot">Click here..</a>
										                    </div>
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
				<!-- My favorites list -->


			</div><!-- tab content -->
		</div>
	</div>

</section>

<script>
	
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
        	$("#s_zip").val($("#zip").val());
        	$("#s_mobile").val($("#mobile").val());

        	var temp_state = $("#state").val();
        	$("#state2 option[value='"+temp_state+"']").prop('selected', true);

        	$("#change_city2").val($("#change_city").val());            
        	$("#use_billing_address").prop("checked", true);

        }
        else
        {	
        	$("#s_first_name").val('');
        	$("#s_last_name").val('');
        	$("#s_email").val('');
        	$("#s_address").val('');
        	$("#state2").val('');
        	$("#change_city2").val('');
        	$("#s_zip").val('');
        	$("#s_mobile").val('');

        }
	});
	$('.s_input_change, .b_input_change').change(function(event) {
		$("#use_billing_address").prop("checked","");
	});
</script>

<script type="text/javascript">

	$("#zip").keyup( function(){
		var post = $("#zip").val(); 
		post = post.replace(/_/g,'');
		if(post.length==4)
		{
			$.post('<?php echo base_url("./website/validate_postcode"); ?>',
					{code:post},
					function(data){
						//alert(data.status);
						if(data.status)
						{
							$("#change_city").val(data.city);
							$("#state option[value='"+data.state+"']").prop('selected', true);
						}
						else
						{
							$("#zip").val('');

							var message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i> Please enter valid Postal Code. </div>';
							$("#error_message").html(message);
						}
					});
		}
	});

	$("#s_zip").keyup( function(){
		var post = $("#s_zip").val(); 
		post = post.replace(/_/g,'');
		if(post.length==4)
		{
			$.post('<?php echo base_url("./website/validate_postcode"); ?>',
					{code:post},
					function(data){
						//alert(data.status);
						if(data.status)
						{
							$("#change_city2").val(data.city);
							$("#state2 option[value='"+data.state+"']").prop('selected', true);
						}
						else
						{
							$("#s_zip").val('');

							var message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-times-circle-o"></i> Please enter valid Postal Code. </div>';
							$("#error_message").html(message);
						}
					});
		}
	});

</script>
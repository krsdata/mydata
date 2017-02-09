<div class="container">

	<div class="clearfloat"></div>
		<span class="span7">
			<div class="dashcontent">
		<div class="dashbox">
			<?php echo form_open(base_url().'store/update_to_cart/'); ?>
			<h2>Shopping Cart</h2>
			<table id="cart_item_tblacdfsfd" class="table table-hover" border="0">
              <?php if ($this->cart->total_items() != 0){ ?>
				  <tr style="font-weight:600">
				    <td style="text-align:center;"  width="60%">Cart Item</td>
				    <td width="20%">Quantity</td>
				    <td style="text-align:center;" width="20%">Sub-total</td>
				  </tr>
	              <?php foreach ($this->cart->contents() as $items){ ?>
					  <tr>
					  		<?php
					  			$path = base_url().'assets/uploads/test/thumbnail/';
					  		?>
						    <td>
						    <span class="span4 text-center"><b><?php echo $items['name'];?></b></span> <br>
						    <?php if($items['options']['Product_Simple']==TRUE)
						    {
					    	if(!empty($items['options']['Images'])){?>
					    	<img class="span1" src="<?php echo $items['options']['Path'].$items['options']['Images'];?>" />
						    	<?php }
						    }
						    else{
						    if(!empty($items['options']['Images'])){?>
						    	<img class="span1" src="<?php echo $path.$items['options']['Images']; ?>" />
						    	<?php }
						    	} ?>
						    <?php if($items['options']['Product_Simple']==TRUE)
						    {
					    	if(!empty($items['options']['Images'])){?>
					    	<img class="span1" src="<?php echo $items['options']['Path'].$items['options']['Back_Images'];?>" />
						    	<?php }
						    }
						    else{
						    	if(!empty($items['options']['Back_Images'])){?>
						    	<img class="span1" src="<?php echo $path.$items['options']['Back_Images'] ?>"/>
						    	<?php } }?>
						    </td>
						    <td>
						    	<?php echo $items['qty'];?>
						    	</td>
						    
						    <td class="rht-item"><?php echo money_symbol();?><?php 
							    	$price = $items['price'] * $items['qty']; 
							    	echo number_format($price ,2);
						    	?>
						    </td>
					  </tr>
	              <?php } ?>
				  <tr style="font-weight:600">
				    <td class="rht-item" colspan="2">Gross Total:</td>
				    <td class="rht-item" colspan="1"><?php echo money_symbol();?><?php echo number_format($this->cart->total(),2); ?></td>
				    <td></td>
				  </tr>
				  <?php
	                     $label = '';
	                     if ($this->session->userdata('discount')) {
	                           $discount = $this->session->userdata('discount');
	                           $display = '';
	                           $label = 'Discount Allowed';
	                        }
	                     else
	                     {
	                        $discount = '';
	                        $display = 'display:none;';
	                        $label = 'Error';
	                     }
	              ?>
				  <tr style="font-weight:600; <?php echo $display;?>" id="if_discount_td" >
				  	<td class="rht-item" colspan="2"><?php echo $label; ?>:</td>
				  	<td class="rht-item" colspan="1">
				  		<span id="discount_td"><?php echo money_symbol();?>
				  		<?php 
						  	if(!empty($discount)){
						  		echo ($discount['dis_amount']);
						  	?>
						  		<a id="cancel-dis" href="<?php echo base_url() ?>store/cancel_discount"> &nbsp;&nbsp;[Remove]</a> 
						<?php } ?>
				  		</span>
				  	</td>
				  	<td></td>
                  </tr>
                  <?php  
                   		if(!empty($discount)){
                   			$total_amount=($this->cart->total()-$discount['dis_amount']);
                   			$discount_amount=$discount['dis_amount'];
                   		}else{
                   			$total_amount=$this->cart->total();
                   			$discount_amount=0;
                   		}
                        $grand_total=array(
                            'gross_amount'=> $this->cart->total(),
                            'total_amount'=> $total_amount,
                            'discount'    => $discount_amount
                            );
                        $this->session->set_userdata('grand_total',$grand_total);
                        $grandtotal=$this->session->userdata('grand_total');
                   ?>

				  <?php if(empty($discount)){ ?>
				  <tr style="font-weight:600">
				  	<td class="rht-item" colspan="1">Discount Coupon Code:</td>
				  	<td class="rht-item" colspan="2"><span><input placeholder="Coupon code for discount" tag="td" type="text" class="span2 coupon_code" id="coupon_code1" /></span><a class="chg_coupon_code1" href="javascript:void(0);"> &nbsp;&nbsp;[Apply]</a> <br><br>
				    </td>
				    <td></td>
                  </tr>
                  <?php } ?>

                  <tr style="font-weight:600">
				    <td class="rht-item" colspan="1">Grand Total:

				    </td>
				    <td class="rht-item" colspan="2"><?php echo money_symbol();?><?php echo number_format($total_amount,2); ?>
				    </td></tr>
				   
              <?php } else{?>
              	  <tr style="font-weight:600">
				    <td colspan="3"> <div style="text-align:center; font-size:16px;">There are no items in this cart</div> </td>
				  </tr>
			  <?php } ?>
		    </table>
		 <?php echo form_close(); ?>
		</div>
		<!-- end resposive part -->

	</div>

		</span>

	<span class="span4"><?php if (!customer_login_in()): ?>
		<div class="dashbox">
			<div class="dashcontent"><h2>Delivery Details</h2></div>
			<?php echo form_open(base_url().'store/checkout'); ?>
			<div class="form-body">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Recipient Name</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span3" name="recipient_name" name="recipient_name" value="<?php echo set_value('recipient_name'); ?>">
                        <span style="color:red"><?php echo form_error('recipient_name'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               <div class="form-body">
                  <div class="form-group">
                     <label class="col-md-12 control-label">E-mail Address (Your order confirmation will be sent to this e-mail address)</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span3" name="email" value="<?php echo set_value('email'); ?>"> <span style="color:red"><?php echo form_error('email'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               <div class="form-body">
                  <div class="form-group">
                     <label class="col-md-4 control-label">Confirm e-mail address</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span3" name="confirm_email" value="<?php echo set_value('confirm_email'); ?>"> 
                        <span style="color:red"><?php echo form_error('confirm_email'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               <div class="form-body">
                  <div class="form-group">
                     <label class="col-md-4 control-label">Phone Number</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span2" name="mobile" value="<?php echo set_value('mobile'); ?>">
                         <span style="color:red"><?php echo form_error('mobile'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               <div class="form-body">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Delivery Address</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span3"  name="delivery_address" value="<?php echo set_value('delivery_address'); ?>">
                        <span style="color:red"><?php echo form_error('delivery_address'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               <div class="form-body">
                  <div class="form-group">
                     <label class="col-md-3 control-label">City</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span3" name="city" value="<?php echo set_value('city'); ?>"> <span style="color:red"><?php echo form_error('city'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               <div class="form-body">
                  <div class="form-group">
                     <label class="col-md-3 control-label">State</label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span3" name="state" value="<?php echo set_value('state'); ?>">
                        <span style="color:red"><?php echo form_error('state'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               <div class="form-group">
                       <label class="col-md-3 control-label">Country</label>
                       <div class="col-md-4">
                         <select name="country"  class="form-control select2me select2-offscreen span3" id="default-select">
                         <?php $country = get_country_array(); ?>
                          <option value="">Select Country</option>
                           <?php foreach ($country as $code => $name): ?>
              				 <option <?php if($code == set_value('country') ){echo "selected='selected'";} ?> value="<?php echo $code; ?>"> <?php echo $name; ?></option>                
                          <?php endforeach ?>
                         
                        </select>
                       </div>
                    </div>
               <div class="form-body">
                  <div class="form-group">
                     <label class="col-md-3 control-label">Zip Code </label>
                     <div class="col-md-4">
                        <input type="text" class="form-control span2" name="zip_code" value="<?php echo set_value('zip_code'); ?>"> <span style="color:red"><?php echo form_error('zip_code'); ?> </span>
                     </div>
                  </div>                                    
               </div>
               
               <div class="dashcontent"><h2>Shipping Methode</h2></div>
               <div class="form-body">

               <div class="form-group">
               <label class="col-md-3 control-label">Normal Shipping(up to 5 days)  </label>
                     <div class="col-md-4">
                        <input type="radio" class="form-control" name="shipping_days" checked="" value="0">
                     </div>

                     <label class="col-md-3 control-label">Express Shipping(1 day rush)  </label>
                     <div class="col-md-4">
                        <input type="radio" class="form-control" name="shipping_days" value="1">
                     </div>
                  </div>

                <div class="form-group">
                     <label class="col-md-3 control-label">Is this a gift ?  </label>
                     <div class="col-md-4">
                        <input type="checkbox" class="form-control" name="is_gift" value="1">
                        <i class="icon-gift icon-large"></i>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-md-3 control-label">Is this a gift ?  </label>
                     <div class="col-md-4">
                        <input type="checkbox" class="form-control" name="is_gift" value="1">
                        <i class="icon-gift icon-large"></i>
                     </div>
                  </div>                                    
               </div>
               <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                       <button  id="help_submit" type="submit" class="btn btn-success btn-large" name="continue" value="Continue">Continue</button>
                    </div>
                 </div>

			<?php echo form_close(); ?>
		</div>
	<?php else:?>
		<?php echo form_open(base_url().'store/checkout'); ?>
		<div class="dashcontent">
		<div class="dashbox">
			Is this a gift? 
			<input name="is_gift" type="checkbox" value="1" /> <i class="icon-gift icon-large"></i><br /><br />
			<input type="submit" class="btn" name="continue" value="Continue" />
			</div></div>
		<?php echo form_close(); ?>
	<?php endif ?>

</span>

<style type="text/css">
		.rht-item{
			text-align: right !important;
		}

	</style>
	<script type="text/javascript">
		jQuery('.update_cart').on('click', function() {
        	error = false;
            jQuery(".qauntity" ).each(function( index ) {
            	if (jQuery(this).val() < 1)
            	{
            		error = true;
            		return false;
            	};
            });
        	if (error)
        	{
        		alert('Quantity for any item cannot be zero');
        		return false;
        	}else{
        		return true;
        	};

          });

	</script>
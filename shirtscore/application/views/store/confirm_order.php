
<div class="container">

     <?php if($this->session->flashdata('error_msg')){ ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
        </div>
      <?php } ?>
	<div class="row" style="/* margin-left: 10% */">
        <!--<div id="home_btn" class="span2 home" style="margin-left: 50px;"><a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a></div>
         <div id="dude_text" class="span7 flavor_text">Psst... wanna make some money</div> -->
        <div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>
      </div>

    <div class="clearfloat"></div>
	<div class="prodcontent"></div>
	<hr color="3b5998"/>
	<div class="dashcontent">
	<div class="dashcontent"><h2>Confirm Your Order </h2></div>
		<div class="dashbox">
			<?php echo form_open(SECURE_SITE_URL.'store/update_to_cart/'); ?>
			<table id="cart_item_tbl" class="table table-hover" border="0">
			  
              <?php if ($this->cart->total_items() != 0){ ?>
				  <tr style="font-weight:600">
				    <td style="text-align:center;"  width="42%">Cart Item</td>
				    <td width="15%">Price</td>
				    <td width="20%">Quantity</td>
				    <td width="10%">Size</td>
				    <td style="text-align:center;" width="10%">Sub-total</td>
				  </tr>
				  
	              <?php foreach ($this->cart->contents() as $items){ ?>
					  <tr>
						    <?php
					  			$path = base_url().'assets/uploads/test/thumbnail/';
					  		?>
						    <td>
						    <span class="span4 text-center"><b><?php echo $items['name'];?></b></span> <br>
						    <span class="span1"></span>
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
						    	<?php echo money_symbol();?><?php echo number_format($items['price'] ,2);?> each
						    </td>
						    <td>
						    	<?php echo $items['options']['Size']; ?>
						    </td>
						    <td>
						    	<?php echo $items['qty'];?>
						    </td>
						    <td><?php echo money_symbol();?><?php 
							    	$price = $items['price'] * $items['qty']; 
							    	echo number_format($price ,2);
						    	?>
						    </td>
					  </tr>
	              <?php } ?>
	              <?php $amounts = $this->session->userdata('grand_total') ?>
				  <tr>
				    <td class="rht-item" colspan="3" align="right"><b>Total Cost:</b></td>
				    <td class="rht-item" colspan="2"  align="right"><b><?php echo money_symbol();?><?php echo number_format($amounts['gross_amount'],2); ?></b></td>
				  </tr> 

				   <tr>
				    <td class="rht-item" colspan="3" align="right"><b>Discount:</b></td>
				    <td class="rht-item" colspan="2"  align="right"><b><?php echo money_symbol();?><?php echo number_format($amounts['discount'],2); ?></b></td>
				  </tr>

				  <tr>
				    <td class="rht-item" colspan="3" align="right"><b>Shipping & Handling:</b></td>
				    <td class="rht-item" colspan="2"  align="right"><b><?php echo money_symbol();?><?php echo number_format($amounts['shipping_handling'],2); ?></b></td>
				  </tr>
				  
				  <tr style="font-weight:600">
				    <td class="rht-item" colspan="3" align="right"><b>Grand Total:</b></td>
				    <td class="rht-item" colspan="2"  align="right"><b><?php echo money_symbol();?><?php echo number_format($amounts['total_amount'],2); ?></b></td>
				  </tr>

				  
              <?php }else{?>
              	  <tr style="font-weight:600">
				    <td colspan="5"> <div style="text-align:center; font-size:16px;">There are no items in this cart</div> </td>
				  </tr>
			  <?php } ?>
		    </table>
		 <?php echo form_close(); ?>
		</div>

		<!-- end resposive part -->

	<div>
		<br />

		<?php $paymentMethod = $this->session->userdata('paymentMethod'); ?>

		<div style="float:right; margin-top:-20px;">
			<?php if($paymentMethod == 'stripe'){ ?>
				<a href="<?php echo SECURE_SITE_URL ?>store/stripe_pay" title="Pay">
					<img src="<?php echo base_url() ?>assets/images/PayByCard.png" width="150" alt="Pay Now">
				</a>
			<?php }else{ ?>

			<?php $cart_user_info = $this->session->userdata('cart_user_info'); ?>
			<form style="margin-top:20px;" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="rm" value="2">
			<input type="hidden" name="cbt" value="Return to Shirt Score">
			<input type="hidden" name="invoice" value="<?php echo rand('111111111', '999999999') ?>">
			<input type="hidden" name="business" value="vinita.chapter247-facilitator@gmail.com">
			<input type="hidden" name="return" value="<?php echo base_url(); ?>store/paypal_success" />
			<input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>store/payment_status" />
			<input type="hidden" name="email" value="<?php echo $cart_user_info['email'] ?>">
			<input type="hidden" name="first_name" value="<?php echo $cart_user_info['recipient_name'] ?>">
			<!-- <input type="hidden" name="address_override" value="1">
			<input type="hidden" name="address1" value="JANE ROE 200 E MAIN ST PHOENIX AZ 85123 USA"> -->
 			<!-- <input type="hidden" name="address2" value="Apt 5"> -->
			<?php
			$i = 1;
			$final_cart = $this->cart->contents();
			foreach($final_cart as $value) {
			?>
			<input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $value['name']; ?>" />
			<input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $value['price']; ?>"/>
			<input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $value['qty'] ?>"/>
			<?php $i++; } ?>

			<!-- <input type="hidden" name="shipping" value="5" /> -->
			<input type="hidden" name="shipping_1" value="4.95" />
			<input type="hidden" name="discount_amount_cart" value="<?php echo $amounts['discount']; ?>" />
			<!-- <input type="hidden" name="handling" value="5" /> -->

			<input type="image" name="submit" border="0" 
			        src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" 
			        alt="PayPal - The safer, easier way to pay online"> 
			    <img alt="" border="0" width="1" height="1" 
			        src="https://www.paypal.com/en_US/i/scr/pixel.gif" > 
			</form>

			<?php 
			// ss.business@shirtsscorre.com
			// 123456789

			// ss.buyer@shirtsscore.com
			// 123456789
			?>

			<?php } ?>
		</div>
	</div>

	

	</div>

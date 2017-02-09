
<div class="container">

     <?php if($this->session->flashdata('error_msg')){ ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
        </div>
     <?php } ?>
	<div class="row" style="/* margin-left: 10% */">
       <div id="home_btn" class="span2 home" style="margin-left: 50px;"><!-- <a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a> --></div> 
      <div id="dude_text" class="span7 flavor_text">You are awesome.. </div>
      	<?php /*<div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div> */ ?>
    </div>

    <div class="clearfloat"></div>
	<div class="prodcontent"></div>
	<hr color="3b5998" />
	<div class="dashcontent">
		<div class="dashbox">
			<?php echo form_open(base_url().'store/update_to_cart/'); ?>
			<h2>Shopping Cart</h2>
			<table id="cart_item_tblacdfsfd" class="table table-hover" border="0">
              <?php if ($this->cart->total_items() != 0){ ?>
				  <tr style="font-weight:600">
				    <td style="text-align:center;"  width="42%">Cart Item</td>
				    <td  width="15%">Price</td>
				    <td   width="20%">Quantity</td>
				    <td  width="10%">Size</td>
				    <td style="text-align:center;" width="10%">Sub-total</td>
				    <td  width="3%"></td>
				    
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
						    	<?php echo money_symbol();?><?php echo number_format($items['price'] ,2);?> 
						    	</td>
						    <td>
						    	<input  type="hidden" name="rowid[]" value="<?php echo $items['rowid'] ?>">
						    	<input id = "qty_<?php echo $items['rowid'];?>" class="qauntity span1 " min="1" type="number" name="qty[]" value="<?php echo $items['qty'];?>"> 
						    	
						    	<!-- <a class="qty_edit" qty="qty_<?php echo $items['rowid'];?>" href="javascript:void(0);">[change]</a> -->
						    	<br>
						    	<input class="btn-info btn update_cart btn-small" type="submit" name="update" value="Update">
						    	</td>
						    <td>
						    	<?php echo $items['options']['Size']; ?>
						    </td>
						    <td class="rht-item"><?php echo money_symbol();?><?php 
							    	$price = $items['price'] * $items['qty']; 
							    	echo number_format($price ,2);
						    	?>
						    	
						    </td>
						    <td><a class="btn btn-danger btn-small" href="<?php echo base_url() ?>store/remove_to_cart/<?php echo $items['rowid'] ?>">X</a></td>
						    
						    
						    
					  </tr>
	              <?php } ?>
				  <tr style="font-weight:600">
				    <td class="rht-item" colspan="3">Gross Total:</td>
				    <td class="rht-item" colspan="2"><?php echo money_symbol();?><?php echo number_format($this->cart->total(),2); ?></td>
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
				  	<td class="rht-item" colspan="3"><?php echo $label; ?>:</td>
				  	<td class="rht-item" colspan="2">
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
				  	<td class="rht-item" colspan="3">Discount Coupon Code:</td>
				  	<td class="rht-item" colspan="2"><span><input placeholder="Coupon code for discount" tag="td" type="text" class="span3 coupon_code" id="coupon_code1" /></span><a class="chg_coupon_code1" href="javascript:void(0);"> &nbsp;&nbsp;[Apply]</a> <br><br>
				    </td>
				    <td></td>
                  </tr>
                  <?php } ?>

                  <tr style="font-weight:600">
				    <td class="rht-item" colspan="3">Grand Total:

				    </td>
				    <td class="rht-item" colspan="2"><?php echo money_symbol();?><?php echo number_format($total_amount,2); ?>
				    </td></tr>
				    <tr><td colspan="2"></td>
				    <td colspan="3" class="rht-item">
				    <a class="btn btn-success btn-large" href="<?php echo base_url() ?>">Continue Shopping</a>
				    <a href="<?php echo SECURE_SITE_URL?>store/shipping_info" class="btn btn-success btn-large">Checkout</a></td>
				    <td></td>

				  </tr>

				  
              <?php } else{?>
              	  <tr style="font-weight:600">
				    <td colspan="6"> <div style="text-align:center; font-size:16px;">There are no items in this cart.&nbsp;&nbsp;<a class="btn btn-success btn-large" href="<?php echo base_url() ?>">Start Shopping Now</a></div> </td>
				  </tr>
				  <tr style="font-weight:600">
				    <td colspan="6">  </td>
				  </tr>
			  <?php } ?>
		    </table>
		 <?php echo form_close(); ?>
		</div>
		<!-- end resposive part -->

	</div>

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
        		alert('Quantity for any item cannot be less than 1');
        		return false;
        	}else{
        		return true;
        	};

          });

	</script>
<?php $cart_user_info = $this->session->userdata('cart_user_info'); ?>
<div class="container">
<div class="dashcontent">           
  <div class="dashbox">
  <h5>Shipping and handling has been calculated:</h5>
  <?php 
  $amounts = $this->session->userdata('grand_total');
  $amounts['shipping_handling'] = 4.95;
  $amounts['total_amount'] = ($this->cart->total() - $amounts['discount']) + 4.95;
     ?>
      <table class="table ">
        <tr>
          <td colspan="2">Order Cost:</td>
          <td><?php echo money_symbol();?><?php echo number_format($amounts['gross_amount'] ,2); ?></td>
        </tr>
        <tr>
          <td colspan="2">Discount:</td>
          <td><?php echo money_symbol();?><?php echo number_format($amounts['discount'] ,2); ?></td>
        </tr>
        <tr>
          <td colspan="2">Shipping & Handling:</td>
          <td><?php echo money_symbol();?><?php echo number_format($amounts['shipping_handling'] ,2); ?></td>
        </tr>
        <tr>
          <td colspan="2">Total:</td>
          <td><?php echo money_symbol();?><?php echo number_format($amounts['total_amount'], 2); ?></td>
        </tr>
     </table>
     <?php  
      /*  $this->session->set_userdata('grand_total','');
        $this->session->unset_userdata('grand_total');
        $this->session->set_userdata('grand_total',$amounts);*/
     ?>
<!-- </div> -->
<div><p><a href="<?php echo SECURE_SITE_URL.'store/cart'; ?>"><i class="icon-circle-arrow-left"></i> Change my order <!--   or delivery address --></a></p></div>
<div class="row-fluid">
   
    <!--
      <div id="billig_info" class="login_details span6">
          <h3>PayPal Members</h3>
    <div id="paypal_btn"><a href="<?php echo base_url().'store/paypal_pay' ?>"><img src="https://www.paypalobjects.com/webstatic/mktg/merchant/images/express-checkout-hero.png" width="150px" border="0" alt="PayPal"></a></div>
      </div>
	-->

      <div class="login_details span8">
          <!-- <span style="color:red;">*</span>Card Type<br /> <select name="CardType"></select><br /> -->

	<?php	
	if (isset($_GET['e'])) {
		
		echo '<div class="alert alert-danger">The following error occured: <strong>' . urldecode($_GET['e']) . '</strong></div>';
		
	}	
	?>

    <h3>Credit Card Payment</h3>
      This is a secure page. Please make sure the details match those on file with your card provider.<br />
      (<span style="color:red;">*</span> required field)<br />
      <?php 
	  /* echo form_open(base_url().'store/stripe_form',array('id' => 'stripeForm')); */ 
	  echo form_open(base_url().'store/payment');
	  ?>
          <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="normal-field"><span style="color:red;">*</span>Card Number</label>
            <div class="controls span9">
              <!-- <span style="color:red;">*</span>Card Number<br /> <input type="text" class="card-number" size="50" /><br /> -->
              <input name="card-number" type="text" class="card-number span6"/>
            </div>
          </div>

          <div class="form-row control-group row-fluid">
              <label class="control-label span3" for="default-select"><span style="color:red;">*</span>Expiration Month</label>
              <div class="controls span9">
                  <select name="card-expiry-month" class="card-expiry-month chzn-select">
                      <option value="1">January</option>
                      <option value="2">February</option>
                      <option value="3">March</option>
                      <option value="4">April</option>
                      <option value="5">May</option>
                      <option value="6">June</option>
                      <option value="7">July</option>
                      <option value="8">August</option>
                      <option value="9">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                  </select>
              </div>
          </div>
          <!-- <input type="text" maxlength="4" class='card-expiry-month' /> -->

           <div class="form-row control-group row-fluid">
              <label class="control-label span3" for="default-select"><span style="color:red;">*</span>Expiration Year</label>
              <div class="controls span9">
                  <select name="card-expiry-year" class='card-expiry-year'>
                    <?php for($i=0;$i<=30;$i++){ ?>
                    <option><?php echo date('Y',strtotime('+ '.$i.' Years')) ?></option>
                    <?php } ?>
                  </select>
              </div>
          </div>
          <!-- <input type="text" maxlength="4" class='card-expiry-year' /> -->

          <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="normal-field"><span style="color:red;">*</span>CVV Number (3 digit number on the back of Visa and MasterCards)</label>
            <div class="controls span9">
              <input name="card-cvc" type="text" maxlength="4" class='card-cvc span6' />
            </div>
          </div>
         
          <!-- <div class="form-actions row-fluid">
          <div class="span3 visible-desktop"></div>
            <div class="span7 "> -->
               <input type="submit" class="btn btn-success" value="Submit Payment" />                   
            <!-- </div>
          </div> -->
         
      </div>
      <?php echo form_close(); ?>
<div class="clearfloat"></div>
<hr color="#CCCCCC" />
<div class="dashbox">
    
    <hr color="#CCCCCC" />
      <h3>Refund Policy</h3>  
      <p>We guarantee all our products against manufacturer defects and any errors in the customization of your order that differ from the information you submit to us at the time of your order. If we determine that a products is defective or we have made an error, we will replace your order at no charge. (Inquiries must be made within 14 days of receiving product.) All orders are custom made at the time the order was submitted and therefore we do not take returns, exchanges, or cancellations. Please be sure you select correct sizes, colors, and designs before final purchase. ShirtScore.com attempts to be as accurate as possible with product descriptions, colors, and images. We do not warrant the color or sizes as they vary from our suppliers.</p>
</div>
</div>
</div>


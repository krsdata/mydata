
<section id="page_content" class="payment_content">
	<div class="container">
		<div class="row payment_row1">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<p class="page_head margin_cutter">payment</p>
			</div>
		</div>
        <div class="row cart_row3 row_gap">
            <?php  echo msg_alert_frontend(); ?>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Detail</td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php if(!empty($detail->title)) echo ucfirst($detail->title);?> Membership</td>
                                    <td>$<?php if(!empty($detail->amount)) echo $detail->amount; else echo "0"; ?></td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>Total : </strong></td>
                                    <td>
                                    	<strong>$<?php if(!empty($detail->amount)) echo $detail->amount; else echo "0"; ?></strong>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>                                               
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="<?php echo base_url('membership/pay_paypal/'.$detail->title_slug);?>" id="paypal_express_checkout" name="paypal_express_checkout" class="btn paypal-btn" value=""></a>
                    </div>
                </div>
                <div class="row top_buffer_40">
               <!--  <div class="col-xs-12 col-sm-12 col-md-12">
                     <p class="section_heading">Card Payment</p> -->

                    <!-- <form action="" method="post" name="card_payment_form">
                      <div class="form-group">
                        <label for="card_number">Card Number <span class="form_carot">*</span></label>
                        <input type="tel" autocomplete="off" size="19" class="form-control" id="card_number" placeholder="---- ---- ---- ----">
                      </div>
                      <div class="form-group">
                        <label for="expiration">Expiration (mm/yyyy) <span class="form_carot">*</span></label>
                        <input type="tel" class="form-control" id="expiration" placeholder="-- / --" size="7" name="expiry" autocomplete="off">
                      </div>

                      <div class="form-group">
                        <label for="cvc">CSV Number (3 digit number on the back of Visa and MasterCards) <span class="form_carot">*</span></label>
                        <input type="tel" placeholder="---" size="4" name="cvc" id="cvc" class="cvc form-control" autocomplete="off">
                      </div>
                      <button type="submit" class="btn btn_pink pull-right">Place Order</button>
                    </form> -->
                  <!--  <form action="<?php echo base_url('membership/pay_stripe/'.$detail->title_slug);?>" method="POST" id="payment-form" name="card_payment_form">
                        <span class="payment-errors form_carot col-md-12" id="payment-error"></span>

                        <div class="form-row0 form-group">
                            <label for="card_number" class="col-md-12">
                              <span>Card Number<spam class="form_carot">*</spam></span>
                              <input type="text" id="card_number" name="card_number" maxlength="19" data-stripe="number" class="form-control" placeholder="---- ---- ---- ----" required/>
                            </label>
                        </div>


                        <div class="form-row0 form-group">
                            <label class="col-md-4">
                                <span>Expiration (MM)<spam class="form_carot">*</spam></span>
                                
                                <input type="text" maxlength="2" size="2" name="exp_month" data-stripe="exp-month" class="form-control" placeholder="MM" required/>
                            </label>
                            <label class="col-md-5">
                                <span>Expiration (YYYY)<spam class="form_carot">*</spam></span>
                                <input type="text" maxlength="4" size="4" name="exp_year" data-stripe="exp-year" class="form-control" placeholder="YYYY" required/>
                            </label>
                        </div>
                        <div class="form-row0 form-group">
                            <label class="col-md-3">
                              <span>CVC<spam class="form_carot">*</spam></span>
                              <input type="text" size="4" data-stripe="cvc" name="cvc" class="form-control" placeholder="---" required/>
                            </label>
                        </div>
                        <div class="col-md-12">
                        <input type="hidden" name="amount" value="<?php if(!empty($detail->amount)) echo $detail->amount; ?>">
                        <hr>
                        </div>
                        <button type="submit" class="btn btn_pink pull-right" id="stripe_button">Submit Payment</button>
                    </form> 
                </div> -->
                </div>
            </div>
        </div>
	</div>
</section>
<script src="<?php echo FRONTEND_THEME_URL_NEW; ?>js/jquery.creditCardValidator.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script type="text/javascript">
  // This identifies your website in the createToken call below
  Stripe.setPublishableKey('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
  // ...

jQuery(function($) {
  $('#payment-form').submit(function(event) {
    var $form = $(this);

    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);

    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });
});

function stripeResponseHandler(status, response) 
{
    var $form = $('#payment-form');

    if (response.error) 
    {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('button').prop('disabled', false);
    } 
    else 
    {
        // response contains id and card, which contains additional card details
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and submit
        $form.get(0).submit();
    }
}
</script>

<script>
    $(function() {
        $('#card_number').validateCreditCard(function(result) {
            // $('.payment-errors').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
            //          + '<br>Valid: ' + result.valid
            //          + '<br>Length valid: ' + result.length_valid
            //          + '<br>Luhn valid: ' + result.luhn_valid);
                   if(result.valid)
                   {
                        $('#stripe_button').prop('disabled', false);
                        $('.payment-errors').html('Card type: ' +  result.card_type.name);
                   }
                   else
                   {
                       $('#stripe_button').prop('disabled', true);
                       $('.payment-errors').html('');
                   }

        });
    });
</script>
<?php 
    if($this->session->userdata('purchase_type'))
    {
        $purchase_type = $this->session->userdata('purchase_type');
    }
    else
    {
        $purchase_type ='';
    }
    //'product'
    //'services'
?>

<section id="page_content" class="payment_content">
	<div class="container">
		<div class="row payment_row1 margin_top_40">
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<p class="page_head margin_cutter">Select Distributor</p>
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
                                    <th width="50%">Billing Address</th>
                                    <th width="50%">Shipping Adderss</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($users)) { ?>
                                <tr>
                                    <!-- Billing address -->
                                    <td>
                                        <p>
                                            <span>
                                                <?php if(!empty($users->first_name)) echo $users->first_name; if(!empty($users->last_name)) echo " ".$users->last_name;  ?>
                                            </span>
                                        </p>
                                        <p>
                                            <span> 
                                                <?php if(!empty($users->address)) echo $users->address; ?><br>
                                                <?php if(!empty($users->city)) echo $users->city; ?>
                                                <?php if(!empty($users->zip)) echo " - ".$users->zip; ?>
                                                <?php if(!empty($users->state)) echo ", ".$users->state; ?>
                                            </span>
                                        </p>
                                        <p>
                                            <span>
                                                <?php if(!empty($users->email)) echo "Email - ".$users->email; ?>
                                            </span>
                                        </p>
                                        <p>
                                            <span>
                                                <?php if(!empty($users->mobile)) echo "Phone No - ".$users->mobile; ?>
                                            </span>
                                        </p>    
                                        
                                    </td>
                                    <!-- Shipping address -->
                                    <td>
                                        <p>
                                            <span>
                                                <?php if(!empty($users->s_first_name)) echo $users->s_first_name; if(!empty($users->s_last_name)) echo " ".$users->s_last_name;  ?>
                                            </span>
                                        </p>
                                        <p>
                                            <span> 
                                                <?php if(!empty($users->s_address)) echo $users->s_address; ?><br>
                                                <?php if(!empty($users->s_city)) echo $users->s_city; ?>
                                                <?php if(!empty($users->s_zip)) echo " - ".$users->s_zip; ?>
                                                <?php if(!empty($users->s_state)) echo ", ".$users->s_state; ?>
                                            </span>
                                        </p>
                                        <p>
                                            <span>
                                                <?php if(!empty($users->s_email)) echo "Email - ".$users->s_email; ?>
                                            </span>
                                        </p>
                                        <p>
                                            <span>
                                                <?php if(!empty($users->s_mobile)) echo "Phone No - ".$users->s_mobile; ?>
                                            </span>
                                        </p>    

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--  -->                                              
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="row">
                    <div class="table-responsive col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="100%">Distributors</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($users)) { ?>
                                <form action="<?php echo base_url('cart/payment');?>" method="post">
                                    <tr>
                                        <!-- Billing address -->
                                        <td>
                                            <div class="form-group"> 
                                                <select name="distributor_id" class="form-control">
                                                    <?php if(!empty($distributors)) 
                                                    {
                                                        foreach ($distributors as $distributor_row) 
                                                        {
                                                            echo "<option value='".$distributor_row->id."'>".ucfirst($distributor_row->title)." [ ".number_format(($distributor_row->max_distance/1000),1)." Km.]</option>";
                                                        }
                                                        ?>
                                                    <?php } else { ?>
                                                        <option value="1">Lash U Lashes</option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 
                                            <button type="submit" class="btn btn_pink pull-right">Next</button>
                                        </td>
                                    </tr>
                                </form>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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
                //$('#stripe_button').prop('disabled', false);
                $('.payment-errors').html('Card type: ' +  result.card_type.name);
           }
           else
           {
               //$('#stripe_button').prop('disabled', true);
               $('.payment-errors').html('');
           }

        });
    });
</script>
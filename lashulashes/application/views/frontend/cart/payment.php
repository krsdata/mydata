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
				<p class="page_head margin_cutter">payment</p>
			</div>
		</div>
        <div class="row cart_row3 row_gap">
            <?php  echo msg_alert_frontend(); ?>
            <?php 
                if(isset($promocode_message)&&!empty($promocode_message)){ ?>
                <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-times-circle-o"></i>
                    <!-- <strong>Error :</strong> <br> --> <?php echo $promocode_message; ?>
                </div>
            <?php    }

            ?>


             <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>$<?php echo $this->cart->format_number($total); ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $discount_total=0; ?>
                                    <?php if(isset($membership_discount)&&!empty($membership_discount)){ 
                                        $discount_total = $membership_discount;
                                        ?>
                                    <tr>
                                        <td>Membership Discount</td>
                                        <td> (-) $<?php echo $this->cart->format_number($membership_discount); ?></td>
                                    </tr> 
                                    <?php } ?>
                                    <?php if(isset($coupon_discount)&&!empty($coupon_discount)){
                                                $discount_total = $coupon_discount;
                                     ?>
                                    <tr>
                                        <td>Coupon Discount</td>
                                        <td> (-) $<?php echo $this->cart->format_number($coupon_discount); ?></td>
                                    </tr> 
                                    <?php } ?>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td> (+) $<?php echo $this->cart->format_number($shipping); ?></td>
                                    </tr>
                                    <tr>
                                        <td>GST (Goods & Services Tax)</td>
                                        <td> (+) $<?php echo $this->cart->format_number($gst); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td><strong>$<?php echo $this->cart->format_number($total + $gst + $shipping -($discount_total)); ?></strong></td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="row">
                            <div class="promo_code_container">
                                <div class="promo_code_pop">
                                    <p class="">Promocode Coupon!</p>
                                      <form action="" name="promocode_form" method="post" class="top_buffer_30"> 
                                        <input type="text" name="" placeholder="Enter your Promocode">
                                        <input type="submit" value="Apply" class="">
                                      </form> 
                                </div>
                            </div>                     
                        </div>   -->                            
                    </div>   

                    <?php if(isset($membership_discount)&&!empty($membership_discount)){ ?>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td><?php 
                                            $discountArr = $this->session->userdata('discount_amount_array');
                                            if($purchase_type=='product') {
                                                echo 'Item';
                                            }
                                            if($purchase_type=='services')
                                            {
                                                echo 'Services';
                                            }
                                            if($purchase_type=='training')
                                            {
                                                echo 'Training';
                                            }
                                            ?></td>
                                        <td>Quantity</td>
                                        <td>Price</td>
                                        <td>Total</td>
                                        <?php if($purchase_type=='product' && count($discountArr)>0) { ?>
                                        <td>Discount</td>
                                        <td>Final</td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php $i = 1;

                                            
                                            //print_r($item_discount);die;
                                     ?>
                                    <?php foreach ($this->cart->contents() as $items): ?>
                                            <input type="hidden" name="<?php echo $i.'[rowid]'; ?>" value="<?php echo $items['rowid']; ?>">
                                            <tr>
                                                <td>
                                                    <div class="product_thumb">
                                                        <?php if($purchase_type=='product') { ?>
                                                            <span><img src="<?php echo $items['image'];?>"></span>
                                                            <span>
                                                                
                                                                Name : <?php echo $items['name']; ?><br>
                                                                <?php if($items['type']!='Simple') 
                                                                {
                                                                    $variation_detail_array = json_decode($items['variation_detail']);
                                                                    if(count($variation_detail_array[0])== $items['variation_length'] )
                                                                    {
                                                                        for ($m=0; $m < $items['variation_length'] ; $m++) 
                                                                        { 
                                                                            echo $variation_detail_array[0][$m][1] .' : ' .$variation_detail_array[1][$m][1].'<br>';
                                                                        }
                                                                    }

                                                                } ?>
                                                            </span>
                                                        <?php } else if($purchase_type=='services') { ?>
                                                            <p>
                                                                Treatment Type : <?php echo $items['name']; ?><br>
                                                                Date : <?php echo $items['date']; ?><br>
                                                                <?php $time_id = get_services_time_name($items['time_id']); ?>
                                                                <?php if($time_id) { ?>
                                                                    Time : <?php echo $time_id->timing; ?><br>
                                                                <?php } ?>

                                                            </p>
                                                        <?php } else if($purchase_type=='training') { ?>
                                                            <div style="padding-left: 15px;">
                                                                <h2 class="date">Title : <?php echo $items['name']; ?></h2>
                                                                <p style="padding-left: 15px; font-size: 14px;">
                                                                    <?php echo date('d-M-Y',strtotime($items['start_date'])); ?> To <?php echo date('d-M-Y',strtotime($items['end_date'])); ?><br>
                                                                    <?php echo $items['timing']; ?><br>
                                                                    Category : <?php echo $items['category_name']; ?><br>
                                                                    Location : <?php echo $items['state']; ?>
                                                                </p>
                                                            </div>
                                                        <?php } ?>
                                                        <!-- <div class="clerfix"></div> -->
                                                    </div>
                                                </td>
                                                <td align="center" style="vertical-align: middle;">
                                                        <label> <?php echo $items['qty']; ?> </label>
                                                </td>
                                                <td align="center" style="vertical-align: middle;" ><?php echo '$'.$this->cart->format_number($items['price']); ?></td>
                                                <?php $item_subtotal = $items['price']*$items['qty'];
                                                        //$item_discount = $item_subtotal - $item_discount[$items['id']];
                                                 ?>
                                                <td align="center" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items['subtotal']); ?>
                                                </td>

                                                <?php if($purchase_type=='product' && count($discountArr)>0) { ?>
                                                <td align="center" style="vertical-align: middle;">$<?php echo $this->cart->format_number($discountArr[$items['id']]); ?></td>
                                                <td align="center" style="vertical-align: middle;">$<?php echo $this->cart->format_number(($item_subtotal - $discountArr[$items['id']])); ?>

                                                </td>
                                                <?php } ?>
                                            </tr>

                                    <?php $i++; ?>

                                    <?php endforeach; ?>

                                    
                                     <tr>
                                        <td colspan="3"><strong>Subtotal</strong></td>
                                        <td><strong>$<?php echo $this->cart->format_number($total); ?></strong></td>
                                        <?php if($purchase_type=='product' && count($discountArr)>0) { ?>
                                        <td><strong>$<?php echo $this->cart->format_number($discount_total); ?></strong></td>
                                        <td><strong>$<?php echo $this->cart->format_number($total - $discount_total); ?></strong></td>
                                        <?php  } ?>
                                    </tr>

                                    
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>

            <div class="col-xs-12 col-sm-4 col-md-4" align="center">
                <?php 
                        if($purchase_type == 'product') { ?>
                <div class="row">
                    <div class="promo_code_container">
                        <div class="promo_code_pop">
                            <p class="">Promocode Coupon!</p>
                            <form action="" name="promocode_form" method="post" class="top_buffer_30" id="promocode_form">
                                <input type="text" name="promocode" placeholder="Enter your Promocode">
                                <input type="submit" value="Apply" class="" >
                            </form> 
                        </div>
                    </div>                     
                </div>  
                <?php  } ?>
                <div class="row top_buffer_40">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php 
                        if($purchase_type == 'product') { ?>
                            <a href="<?php echo base_url('cart/pay_paypal');?>" id="paypal_express_checkout" name="paypal_express_checkout" class="btn paypal-btn" value=""></a>
                        <?php  }
                        if($purchase_type == 'training') { ?>
                            <a href="<?php echo base_url('training/pay_paypal');?>" id="paypal_express_checkout" name="paypal_express_checkout" class="btn paypal-btn" value=""></a>
                        <?php  }
                        if($purchase_type == 'services') { ?>
                            <a href="<?php echo base_url('service/pay_paypal');?>" id="paypal_express_checkout" name="paypal_express_checkout" class="btn paypal-btn" value=""></a>
                        <?php  } ?>
                    </div>
                </div>
                <div class="row top_buffer_40">
                   <!--  <div class="col-xs-12 col-sm-12 col-md-12">
                        <p class="section_heading">Card Payment</p>
                        <?php 
                        //if($purchase_type == 'product') { ?>
                            <form action="<?php //echo base_url('cart/pay_stripe/');?>" method="POST" id="payment-form" name="card_payment_form">
                        <?php  //}
                        //if($purchase_type == 'training') { ?>
                            <form action="<?php //echo base_url('training/pay_stripe/');?>" method="POST" id="payment-form" name="card_payment_form">
                        <?php  //}
                        //if($purchase_type == 'services') { ?>
                            <form action="<?php //echo base_url('service/pay_stripe/');?>" method="POST" id="payment-form" name="card_payment_form">
                        <?php // } else { ?>
                        <form action="#" method="POST" id="payment-form" name="card_payment_form">
                           <?php //}?>  
                            <label class="payment-errors form_carot col-md-12" id="payment-error"></label>

                            <div class="form-row0 form-group">
                                <label for="card_number" class="col-md-12">
                                  <label>Card Number<spam class="form_carot">*</spam></label>
                                  <input type="text" id="card_number" name="card_number" maxlength="19" data-stripe="number" class="form-control" placeholder="---- ---- ---- ----" required/>
                                </label>
                            </div>


                            <div class="form-row0 form-group">
                                <label class="col-md-4">
                                    <label>Expiration (MM)<spam class="form_carot">*</spam></label>
                                    
                                    <input type="text" maxlength="2" size="2" name="exp_month" data-stripe="exp-month" class="form-control" placeholder="MM" required/>
                                </label>
                                <label class="col-md-5">
                                    <label>Expiration (YYYY)<spam class="form_carot">*</spam></label>
                                    <input type="text" maxlength="4" size="4" name="exp_year" data-stripe="exp-year" class="form-control" placeholder="YYYY" required/>
                                </label>
                            </div>
                            <div class="form-row0 form-group">
                                <label class="col-md-3">
                                  <label>CVC<spam class="form_carot">*</spam></label>
                                  <input type="text" size="4" maxlength="4" data-stripe="cvc" name="cvc" class="form-control" placeholder="---" required/>
                                </label>
                            </div>
                            <div class="col-md-12">
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

    $( "#promocode_form" ).submit(function( event ) {
      //alert( "Handler for .submit() called." );
      <?php if(isset($discount_type) && $discount_type == 1){?>

      event.preventDefault();
      <?php  } ?>
    });
</script>
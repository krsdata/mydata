<?php $cart_user_info = $this->session->userdata('cart_user_info'); ?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="cbt" value="Return to Shirt Score">
<input type="hidden" name="invoice" value="<?php echo rand('111111111', '999999999') ?>">
<input type="hidden" name="business" value="ss.business@shirtsscorre.com">
<input type="hidden" name="return" value="<?php echo base_url(); ?>store/paypal_success" />
<input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>store/payment_status" />
<input type="hidden" name="email" value="<?php echo $cart_user_info['email'] ?>">
<input type="hidden" name="first_name" value="<?php echo $cart_user_info['recipient_name'] ?>">
<?php 
$i = 1;
$final_cart = $this->cart->contents();
foreach($final_cart as $value) {
?>
<input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $value['name']; ?>" />
<input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $value['price']; ?>"/>
<input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $value['qty'] ?>"/>
<?php $i++; } ?>
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
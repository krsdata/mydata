<link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/pdf.css" rel="stylesheet" type="text/css"/>
<style>
.colored-box {
border: 1px solid #000000;
height: 20px;
left: 15px;
position: relative;
width: 20px;
}
</style> 
<table cellpadding="10" cellspacing="10" class="table4">
<tbody>
<tr>
<td colspan="2">
<a class="brand" href="<?php echo base_url()?>">
<img src="<?php echo base_url() ?>assets/front_theme/img/ss_logo2.png" alt="ShirtScore"  />
</a>
</td></tr>
<tr><td>
<div class="h4">10019 E Knox Ave.Spokane Valley,WA
<br>99206</div>
<div class="h5">Customer Service : support@shirtscore.com</div>
</td>
<td style="text-align: right;" class="h5">
<?php if(!empty($order_user_info->recipient_name)) echo $order_user_info->recipient_name; ?>
<br>
<?php if(!empty($order_user_info->billing_address)) echo $order_user_info->billing_address.' '.$order_user_info->city.' '.$order_user_info->state.' '.$order_user_info->country.' '.$order_user_info->zip_code; ?><br>
<?php if(!empty($order_user_info->email)) echo $order_user_info->email; ?><br>
<?php if(!empty($order_user_info->phone)) echo $order_user_info->phone; ?>
</td>
</tr>
<tr>
<td class="h1">Thank you for your Purchase !</td>
<td class="h1"  style="text-align: right;">Order <?php echo "#".$order_user_info->order_id;?></td>

</tr>
</tbody>
</table>

<table class="table5">
<tr>
<td class="head">Product</td>
<td  class="head">Design</td>
<td  class="head" width="30%">Description</td>
<td  class="head" width="6%">Qty</td>
<td  class="head" width="8%">Cost</td></tr>

<?php 
if (!empty($order_info)){ ?>
<?php $ii=1; 
$total_qty=0;
foreach ($order_info as $row){                     
$cart_detail = json_decode($row->cart_detail);
//print_r($cart_detail);
?>
<tr>
<td>
<div class="row">
<img style="width:100px !important; float:left;" src="<?php echo $cart_detail->options->Path; if(!empty($cart_detail->options->Images)) echo $cart_detail->options->Images ; ?>">
<img style="width:100px !important; float:left;" src="<?php echo $cart_detail->options->Path; if(!empty($cart_detail->options->Back_Images)) echo $cart_detail->options->Back_Images ; ?>">
</div>
</td>
<td> <?php if($get_design_id=get_design_id($row->order_id,$row->product_id))
{

foreach ($get_design_id as $key ) {
$des_img=get_design_image($key->design_id);
//print_r($des_img);
if($des_img){?>
<img style="width:70px !important; float:left;" src="<?php echo base_url()?>assets/uploads/designs/thumbnail/<?php echo $des_img->design_image; ?>">
<?php }
else{
echo"No Image Found";
}

}

} ?>
<?php 
if(!empty($cart_detail->options->Product_id)) 
$custom_uplaod_img=get_custom_uplaod_img_from_product($cart_detail->options->Product_id); 

if(!empty($custom_uplaod_img)){
$texts=unserialize($custom_uplaod_img->texts);


if(!empty($texts) && is_array($texts)){                                                
echo '<div id="showtext'.$ii.'" style="display:block; text-align:center;">';
foreach ($texts as $row2) {
echo '<strong>Text</strong>'." : ".$row2['text']; 
echo "<br>";
echo '<strong>Text Size</strong>'." : ".$row2['textSize'];
echo "<br>";
echo '<strong>Font</strong>'." : ".$row2['font'];
echo "<br>";
echo '<strong>Color</strong>'." : ".$row2['color'];

}
echo '</div>';
}

if($custom_uplaod_img->is_custom_uploaded){ 

if(!empty($custom_uplaod_img->front_upload_image)){
echo '<img align="middle" style="width:70px !important; float:left;" src="'.base_url('assets/uploads/test/custom_uploads/'.$custom_uplaod_img->front_upload_image).'" title="">';
}
echo '<br>';
if(!empty($custom_uplaod_img->back_upload_image)){
echo '
<img align="middle" style="width:70px !important; float:left;" src="'.base_url('assets/uploads/test/custom_uploads/'.$custom_uplaod_img->back_upload_image).'" title="">';
}

echo '</div>';

}
} ?>

</td>
<td><?php echo $cart_detail->name; ?><br>
<?php if($get_design_id=get_design_id($row->order_id,$row->product_id))
{
foreach ($get_design_id as $key ) {
$des_img=get_design_image($key->design_id);
if($des_img)
{ echo'<b>Design</b> '. $des_img->design_title.'<br>'; 
}
}
} ?>
<b>Size : <?php echo $cart_detail->options->Size ?></b><br>

<?php money_symbol(); ?><?php echo $row->price ?> each<br>

<table  border="0" cellspacing="0" cellspacing="0" style="height:60px;width: 220px;float: left;padding: 100px;"><tr>
<td width="15%"><b>Color:</b></td>
<td class="colored-box" style="background-color:<?php echo $cart_detail->options->Color_code ?>;"></td>
<td><?php $color_name = get_color_id($cart_detail->options->Color_id); 
echo $color_name->color_name; ?></td></tr></table>
</td>
<td><?php echo $qty=$row->quantity;
$total_qty=$qty + $total_qty; ?></td>                 
<td align="right"><?php money_symbol(); ?><?php echo $row->subtotal ?></td>
</tr>              
<?php $ii++; }  ?> 
<tr><td  class="head" colspan="5"></td></tr>
<tr><td></td>
<td>
<b>Package by</b>
<div class="box"></div>
</td><td colspan="3">
<table class="table tablebottom" align="right">
<tr><td>Sub Total (<?php echo $total_qty;?>) :  </td> 
<td><?php money_symbol();
echo $order_user_info->gross_amount?></td></tr>

<?php if ($order_user_info->discount != 0) { ?>
<tr><td>Discount : </td>
<td style="color:red">-<?php money_symbol();?><?php echo $order_user_info->discount ?></td></tr>
<?php } ?>

<tr><td>Shipping & handling : </td>
<td><?php money_symbol();
echo $order_user_info->tax_amount ?></td></tr>
<tr><td>Total :</td>
<td><?php money_symbol();
echo $order_user_info->total_amount ?></td></tr>
</table></td>
</tr>
<tr><td  class="head" colspan="5"></td></tr>
<?php }else{ ?>
<td colspan="4">Nothing found</td>
<?php } ?>
</table>            

<table cellpadding="10" cellspacing="10" class="table4">
<tbody>
<tr>
<td class="h7">
<span class="h4">Protect your Purchase</span>
<span class="h5">(washing instructions)</span><br>
To ensure the quality of your purchse there may be a sheen and odd texture on printed garments.<br> These are water soluble and will wash out in one wash cycle.<br>
Machine wash garments inside out on cold .tumble dry on low.<br><br>
<span class="h4" style="color:red"><b>Refund Policy : </b></span><br>
We guarantee all our products against manufactures defects and any errors in the customizaton of your order that differ from the information you submit to us at the time of your order .if we determine that a porduct is defective or we have made an error ,we will replace your order at no charge (inquiries must be mdae
within 14 days of receiving product).all orders are custom made at the time the order was submitted and therefore we do not take returns, exchanges or cancellations .please be sure you select correct sizes colors and designs before final purchase shirtscore attempts to be as accurate as possible with
product descriptions, colors and images .we do not warrant the color or sizes as they vary from our suppliers.  </span>

</td>
</tr>
</tbody>
</table>

<pagebreak />

<link href="<?php echo base_url() ?>assets/pdfclient.css" rel="stylesheet" type="text/css"/>


<table class="table4" border="0" cellspacing="0" cellspacing="0">
<tr class="headerorder">
<td align="left" style="background: #3b5998;   color: white;
font-size: 40px;
font-weight: bolder;
text-transform: uppercase;        
line-height: 60px;">
Shirt Score Order</td>
<td align="right"><img align="right" src="<?php echo base_url('assets/barcode').'/'.$order_user_info->order_id.'.jpg'?>"  alt="">
</td></tr>
</table>

<table class="table4 " style="width:100%!important;">

<tr><td width="70%">
<span class="h5" >ShirtScore.com</span><br>
<span class="h4">Merchandise Order: <?php echo "#".$order_user_info->order_id;?></span><br>

<?php 
if (!empty($order_info)){ ?>
<?php $ii=1; 
$total_qty=0;
foreach ($order_info as $row){                     
$qty=$row->quantity;
$total_qty=$qty + $total_qty;}?>
<span class="h4">TOTAL ITEM:</span>       
<span class="h1"><?php echo $total_qty; }?></span>


</td>
<td  class="h5">
<?php if(!empty($order_user_info->recipient_name)) echo $order_user_info->recipient_name; ?>
<br>
<?php if(!empty($order_user_info->billing_address)) echo $order_user_info->billing_address.' '.$order_user_info->city.'<br> '.$order_user_info->state.' '.$order_user_info->country.' '.$order_user_info->zip_code; ?><br>
<?php if(!empty($order_user_info->email)) echo $order_user_info->email; ?>

</td>
</tr>

</table>

<table class="table table-bordered"  border="0" cellspacing="0" cellspacing="0">
<tr style="border: 1px solid #ddd;padding:5px">
<th width="90%">Description</th>
<th width="10%">Cost</th></tr>

<?php 
if (!empty($order_info)){ ?>
<?php $ii=1; 
$total_qty=0;
foreach ($order_info as $row){                     
$cart_detail = json_decode($row->cart_detail);
?>
<tr style="border: 1px solid #ddd;padding:5px">
<td width="90%" style="border: 1px solid #ddd;">
<table  border="0" cellspacing="0" cellspacing="0" ><tr><td>
<img style="width:180px !important;" src="<?php echo $cart_detail->options->Path; if(!empty($cart_detail->options->Images)) echo $cart_detail->options->Images ; ?>">
<img style="width:180px !important;" src="<?php echo $cart_detail->options->Path; if(!empty($cart_detail->options->Back_Images)) echo $cart_detail->options->Back_Images ; ?>">
</td>
<td>
<table  border="0" cellspacing="0" cellspacing="0" style="min-width: 220px;float: left;border: 1px solid rgb(162, 157, 157);padding: 10px;">
<tr style="border: 1px solid #ddd;padding:5px"><td>
<span class="h5">Quantity : </span>
<span class="h1"><?php echo $qty=$row->quantity;
$total_qty=$qty + $total_qty; ?></span><br>

<span class="h5">Item : </span>
<span class="h4"><?php echo $cart_detail->name; ?></span><br>
<?php if($get_design_id=get_design_id($row->order_id,$row->product_id))
{
foreach ($get_design_id as $key ) {
$des_img=get_design_image($key->design_id);
if($des_img)
{ echo'<span class="h5">Design : </span> <span class="h4">'. $des_img->design_title.'</span><br>'; 
}
}
} ?>
<span class="h5">Size : </span>
<span class="h1"><?php echo $cart_detail->options->Size ?></span><br>
<table  border="0" cellspacing="0" cellspacing="0" style="width: 220px;"><tr>
<td width="12%"><b>Color:</b></td>
<td width="12%" class="colored-box" style="background-color:<?php echo $cart_detail->options->Color_code ?>;"></td>
<td><?php $color_name = get_color_id($cart_detail->options->Color_id); 
echo $color_name->color_name; ?></td></tr></table>
</td></tr>
</table>
</td></tr></table></td>                 
<td style="border: 1px solid #ddd;"><?php money_symbol(); ?><?php echo $row->subtotal ?></td>
</tr>              
<?php $ii++; }  ?> 

<tr>
<td style="text-align:right;border: 1px solid #ddd;padding:5px">Total Quantity </td> 
<td style="border: 1px solid #ddd;padding:5px"><span class="h1"><?php echo $total_qty;?></span></td></tr>

<tr>
<td style="text-align:right;border: 1px solid #ddd;padding:5px">Sub Total</td> 
<td style="border: 1px solid #ddd;padding:5px"><?php money_symbol();
echo $order_user_info->gross_amount?></td></tr>

<?php if ($order_user_info->discount != 0) { ?>
<tr><td style="text-align:right;border: 1px solid #ddd;padding:5px">Discount </td> 
<td style="border: 1px solid #ddd;color:red;padding:5px"><?php money_symbol(); ?><?php echo $order_user_info->discount ?></td></tr>
<?php } ?>

<tr><td style="text-align:right;border: 1px solid #ddd;padding:5px">Shipping & handling</td>
<td style="border: 1px solid #ddd;padding:5px"><?php money_symbol();
echo $order_user_info->tax_amount ?></td></tr>
<tr><td style="text-align:right;border: 1px solid #ddd;padding:5px">Total Cost</td>
<td style="border: 1px solid #ddd;padding:5px"><?php money_symbol();
echo $order_user_info->total_amount ?></td></tr>

<?php }else{ ?>
<tr>
<td colspan="2">Nothing found</td></tr>
<?php } ?>
</table>     
     


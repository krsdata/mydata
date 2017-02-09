<link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/pdfclient.css" rel="stylesheet" type="text/css"/>
  <style>
        .colored-box {
border: 1px solid #000000;
height: 20px;
left: 15px;
position: relative;
width: 20px;
}
</style>
   <table class="tabletop" style="border: 4px solid #8bc53f;"><tr style="border: 4px solid #8bc53f;"><td>
  	 <table class="table4" border="0" cellspacing="0" cellspacing="0">
   		<tr class="headerorder">
   			<td align="left" style="background: #3b5998;     
        color: white;
        font-size: 40px;
        font-weight: bolder;
        text-transform: uppercase;        
        line-height: 60px;">
   			Shirt Score Order</td>
   			<td align="right"><img align="right" src="<?php echo base_url('assets/barcode').'/'.$order_user_info->order_id.'.jpg'?>"  alt="">
             </td></tr>
     </table>
        
             <table class="table4 ">
   			
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

    <table class="table table-bordered" style="width:800px;"  border="0" cellspacing="0" cellspacing="0">
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
			          <tr><td>
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
			          <td></td></tr></table>
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
	      <td colspan="2">Nothing found</td>
	    <?php } ?>
   </table>     
   </td>
   </tr>
   </table>       


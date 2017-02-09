<div class="container">
<div class="dashcontent">
	<div class="dashbox">
		<h2>Order Tracking</h2><br><br>
    <?php if(!empty($order_user_info)){ 
    ?>
     <h4>Buyer Info</h4><br>

     <div style="font-size:14px; color:#3B5998">
          <strong>Name of reciepent:</strong> &nbsp;&nbsp;<span class="input-error"> <?php if(!empty($order_user_info->recipient_name)) echo $order_user_info->recipient_name; ?></span>
     </div>
     <br />

     <div style="font-size:14px; color:#3B5998">
          <strong>Email:</strong> &nbsp;&nbsp;<span class="input-error"><?php if(!empty($order_user_info->email)) echo $order_user_info->email ?></span>
     </div>
     <br />

     <div style="font-size:14px; color:#3B5998">
          <strong>Address:</strong> &nbsp;&nbsp;<span class="input-error"><?php if(!empty($order_user_info->delivery_address)) echo $order_user_info->delivery_address.' '.$order_user_info->shipping_city2.' '.$order_user_info->shipping_state2.' '.$order_user_info->country.' '.$order_user_info->shipping_zip2 ?></span>
     </div>

       <?php if(!empty($order_user_info->is_gift)){?>
       <br />
      <div style="font-size:14px; color:#3B5998">
          <strong> Is this a gift ? </strong> &nbsp;&nbsp;<span class="input-error">
            <?php $gift='';
                    $gift=$order_user_info->is_gift; 
                   if($gift==0)
                    echo"No";
                  else
                    echo"Yes";?>
     </div>
     <?php } ?>

     <?php  if(!empty($order_user_info->say_something)){?>
     <br />
      <div style="font-size:14px; color:#3B5998">
          <strong>Order Note </strong> &nbsp;&nbsp;<span class="input-error">
            <?php echo $order_user_info->say_something;?>
          </span>
     </div>
     <?php } ?>

     <br /><br />



     <h4>Order Info</h4><br>
     <div style="font-size:14px; color:#3B5998">
          <strong>Order Id:</strong> &nbsp;&nbsp;<span class="input-error"><?php if(!empty($order_user_info->order_id)) echo "#".$order_user_info->order_id ?></span>
     </div>
     <br />

     <div style="font-size:14px; color:#3B5998">
          <strong>Gross Amount:</strong> &nbsp;&nbsp;<span class="input-error"> <?php if(!empty($order_user_info->gross_amount))  ?> <?php echo money_symbol();?> <?php echo number_format($order_user_info->gross_amount, 2); ?></span>
     </div>
     <br />  

     <?php if ($order_user_info->discount != 0) { ?>
     <div style="font-size:14px; color:#3B5998">
          <strong>Discount Amount: </strong> &nbsp;&nbsp;<span class="input-error"> <?php if(!empty($order_user_info->discount)) echo "-"; ?> <?php echo money_symbol();?><?php echo number_format($order_user_info->discount, 2); ?></span>
     </div>
     <br /> 
     <?php } ?>

     <div style="font-size:14px; color:#3B5998">
          <strong>Tax Amount:</strong> &nbsp;&nbsp;<span class="input-error"> <?php if(!empty($order_user_info->tax_amount)) ?> <?php echo money_symbol();?> <?php echo number_format($order_user_info->tax_amount, 2); ?></span>
     </div>
     <br />

     <div style="font-size:14px; color:#3B5998">
          <strong>Total Amount:</strong> &nbsp;&nbsp;<span class="input-error"><?php if(!empty($order_user_info->total_amount)) ?> <?php echo money_symbol();?> <?php echo number_format($order_user_info->total_amount, 2); ?></span>
     </div>
     <br />

     <div style="font-size:14px; color:#3B5998">
          <strong>Payment Method:</strong> &nbsp;&nbsp;<span class="input-error"><?php if(!empty($order_user_info->payment_method)) echo $order_user_info->payment_method ?></span>
     </div>
     <br />

     <div style="font-size:14px; color:#3B5998">
          <strong>Payment Status:</strong> &nbsp;&nbsp;<span class="input-error"><?php if(!empty($order_user_info->payment_status)) echo $order_user_info->payment_status ?></span>
     </div>
     <br />

     <div style="font-size:14px; color:#3B5998">
          <strong>Order Status:</strong> &nbsp;&nbsp;<span class="input-error"><?php if(!empty($order_user_info->order_status)) echo fetch_order_status($order_user_info->order_status) ?></span>
     </div>
     <br />

     <br />


    <h4>Order Items</h4>
		<table class="table">
          <thead>
            <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>size</th>
                  <th>Color</th>
                  <th>Quantity</th>
                  <th>Total</th>
            </tr>
          </thead>
          <tbody>
           <?php if (!empty($order_info)){ ?>
                <?php $i=1; foreach ($order_info as $row){
                        $cart_detail = json_decode($row->cart_detail)
                     ?>
                        <tr>
                         <td><?php echo $i; ?></td>
                          <td style="width:400px;"><img style="width:200px !important; float: left;" src="<?php if(isset($cart_detail->options->Path)){echo $cart_detail->options->Path;}else{echo $path;}  if(!empty($cart_detail->options->Images)) echo $cart_detail->options->Images ; ?>"> <img style="width:200px !important; float: left;" src="<?php if(isset($cart_detail->options->Path)){echo $cart_detail->options->Path;}else{echo $path;}  if(!empty($cart_detail->options->Back_Images)) echo $cart_detail->options->Back_Images ; ?>"> </td>
                          <td><?php echo $cart_detail->name; ?></td>
                          <td> <?php echo money_symbol();?><?php echo number_format($row->price, 2); ?></td>
                          <td><?php echo $cart_detail->options->Size ?></td>
                          <td>
                           <?php  if(!empty($cart_detail->options->Color_code)): ?>
                            <div style="background-color:<?php echo $cart_detail->options->Color_code ?>;" class="colored-box"></div>
                            <?php else:?>
                            No Color.
                          <?php endif ?>
                          </td>                                                      
                          <td><?php echo $row->quantity ?></td>                                                      
                          <td><?php echo money_symbol();?><?php echo number_format($row->subtotal, 2) ?></td>
                      </tr>
                <?php $i++; }  ?> 
                <tr>
                  <td colspan="7" style="text-align:left !important">Gross Total </td>
                  <td><?php echo money_symbol();?><?php echo number_format($order_user_info->gross_amount, 2); ?></td>
                </tr>
                <?php if ($order_user_info->discount != 0) { ?>
                <tr>
                  <td colspan="7" style="text-align:left !important">Discount Amount: </td>
                  <td> - <?php echo money_symbol();?> <?php echo number_format($order_user_info->discount, 2) ?></td>
                </tr>
               <?php } ?>
                <tr>
                  <td colspan="7" style="text-align:left !important">Tax </td>
                  <td><?php echo money_symbol();?><?php echo number_format($order_user_info->tax_amount, 2) ?></td>
                </tr>                
                <tr>
                  <td colspan="7" style="text-align:left !important">Total Amount </td>
                  <td><?php echo money_symbol();?><?php echo number_format($order_user_info->total_amount, 2) ?></td>
                </tr>
                <?php }else{ ?>  
                  <td colspan="5">Nothing found</td>
                <?php } ?>  
          </tbody>
        </table>
        <?php //if($pagination){echo $pagination;} ?>
 </div>
 <?php } else{
  echo"No Such Order Found.";
  } ?>
</div>
<style type="text/css" media="screen">
	
  .table thead th, .table tbody td{
     text-align: center !important;
  }

  .designboxFoot span{
		color:green;
	}

	.coversation{
		padding: 15px;
	}

	.designboxFoot{
		border-radius: 5px 5px 5px 5px;
    padding: 10px;
		height: 100px;
		float: left;
		background: none repeat scroll 0 0 #FFFFFF;
	}
	 .color-white{
      padding-left: 10px;
      background-color:#ffffff !important;
      border-radius:5px;
      padding: 15px;
   }
  .colored-box{
      border: 1px solid #000000;
      height: 20px;
      left: 40px;
      position: relative;
      width: 20px;
  }
   .msg_top{
    padding:10px;
    color:#808080
   }
</style>
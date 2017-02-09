<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Lash U Lashes</title>

<style type="text/css">

    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #5D6975;
      text-decoration: underline;
    }

    body {
      position: relative;
      width: 21cm; 
      margin: 0 auto; 
      color: #001028;
      background: #FFFFFF; 
      font-family: "Chivo",sans-serif;
      font-size: 14px; 
      border: 1px solid rgba(91, 122, 179, 0.45);
      padding-top: 10px;
     
    }

    header {
      width: 100%;
      background-color: #F58AC6;
    }

    #logo {
      text-align: center;
      margin-bottom: 5px;
    }

    #logo img {
      width: 90px;
    }

    h1 {

      font-size: 2.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 5px 0;/*
      background: url(<?php echo FRONTEND_THEME_URL_NEW; ?>images/nav-bg.jpg);*/
    }

    #project {
      float: left;
    }

    #project span {
      color: #5D6975;
      text-align: right;
      width: 52px;
      margin-right: 10px;
      display: inline-block;
      font-size: 0.8em;
    }

    #company {
      float: right;
      text-align: right;
    }

 /*   #project div,*/
    #company div {
      white-space: nowrap;        
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 0px;
    }

    table tr:nth-child(2n-1) td {
      /*background: #F5F5F5;*/
    }

    table th,
    table td {
      /*text-align: center;*/
      vertical-align: top;
      border-bottom: 1px solid rgba(91, 122, 179, 0.45);
    }

    table th {
    padding: 5px 5px;
    color: #BF0506;
    border-bottom: 1px solid #225C8D;
    white-space: nowrap;
    font-weight: bold !important;
    text-transform: uppercase;
    }

    table .service,
    table .desc {
      text-align: left;
    }

    table td {
      padding: 10px;
      /*text-align:right;*/
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.2em;
    }

    table td.grand {
      border-top: 1px solid #5D6975;
    }

    #notices .notice {
      color: #5D6975;
      font-size: 1.2em;
    }

    .footer {
      color: #FFFFFF;
      width: 100%;
      height:auto;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 1px;
      text-align: center;
    }

    /*.footer img
    {
      width :35px;
    }*/

    ul 
    {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #F58AC6;
        text-align: center;
    }

    li 
    {
        display: inline-block;
        vertical-align: middle;
        /*padding: 15px 0;*/
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li img
    {
      padding-right: 5px;
      padding-left: 5px;
    }

</style>
</head>
<body style="border: 1px solid rgba(91, 122, 179, 0.45); width:650px;">
    <header class="clearfix" >
      <ul>
        <li style="padding-top: 15px;"><img src="<?php echo FRONTEND_THEME_URL_NEW; ?>images/logo.png" style="width: 150px;" alt="logo"></li>
      </ul>
      <ul>
        <li style="padding: 15px 0;"><a href="<?php echo base_url('product');?>" style="color: #FFF; padding: 0px 10px; font-size: 15px; text-decoration: none; font-weight: 400; border-right: 1px solid rgba(255, 255, 255, 0.4);" target="_blank">Product</a></li>
        <li style="padding: 15px 0;"><a href="<?php echo base_url('training'); ?>" style="color: #FFF; padding: 0px 10px; font-size: 15px; text-decoration: none; font-weight: 400; border-right: 1px solid rgba(255, 255, 255, 0.4);" target="_blank">Training </a></li>
        <li style="padding: 15px 0;"><a href="<?php echo base_url('membership'); ?>" style="color: #FFF; padding: 0px 10px; font-size: 15px; text-decoration: none; font-weight: 400;  border-right: 1px solid rgba(255, 255, 255, 0.4);" target="_blank">Membership</a></li>
        <li style="padding: 15px 0;"><a href="<?php echo base_url('service/booking'); ?>" style="color: #FFF; padding: 0px 10px; font-size: 15px; text-decoration: none; font-weight: 400; border-right: 1px solid rgba(255, 255, 255, 0.4);" target="_blank">Salon Service</a></li>
        <li style="padding: 15px 0;"><a href="<?php echo base_url('testimonials'); ?>" style="color: #FFF; padding: 0px 10px; font-size: 15px; text-decoration: none; font-weight: 400;  border-right: 1px solid rgba(255, 255, 255, 0.4);" target="_blank"> Testimonials</a></li>
        <li style="padding: 15px 0;"><a href="<?php echo base_url('faq'); ?>" style="color: #FFF; padding: 0px 10px; font-size: 15px; text-decoration: none; font-weight: 400; " target="_blank">FAQ</a></li>
    
      </ul>
    </header>
    <main>
      <div id="project" style="min-height: 230px; width:100%">
        <div style="font-size:14px;">
          <div style="padding: 1%;"><?php if(!empty($message)) echo $message; ?></div>
          <?php if(!empty($type) && ($type == 'training')) { ?>
            <?php if(!empty($value)) { ?>
            <div>
              <table >
                  <thead>
                      <tr style="border-top:1px solid #B5C3DD">
                          <td width="50%" align="left" style="border-right:1px solid #B5C3DD"><b>Training</b></td>
                          <td width="15%" align="center" style="border-right:1px solid #B5C3DD"><b>Booking</b></td>
                          <td width="15%" align="center" style="border-right:1px solid #B5C3DD"><b>Price</b></td>
                          <td width="20%" align="center"><b>Total</b></td>
                      </tr>
                  </thead>
                  <tbody>
                    
                      <?php $order_order_detail = json_decode($value->order_detail) ; ?>
                      <?php if(!empty($order_order_detail)) { ?>
                          <?php foreach ($order_order_detail as $items): ?>
                              <tr>
                                  <td align="left" style="border-right:1px solid #B5C3DD;">
                                    <label><b>Title : </b><?php echo $items->name; ?></label>
                                    <p style="margin: 0px;">
                                        <?php echo date('d-M-Y',strtotime($items->start_date)); ?> To <?php echo date('d-M-Y',strtotime($items->end_date)); ?><br>
                                        <?php echo $items->timing; ?><br>
                                        Category : <?php echo $items->category_name; ?><br>
                                        Location : <?php echo $items->state; ?>
                                    </p>
                                  </td>
                                  <td align="center" style="vertical-align: middle; border-right:1px solid #B5C3DD;">
                                    <?php echo $items->qty; ?>
                                  </td>
                                  <td align="right" style="vertical-align: middle; border-right:1px solid #B5C3DD">
                                    <?php echo '$'.$this->cart->format_number($items->price); ?>
                                  </td>
                                  <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items->subtotal); ?>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                          <tr>
                            <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>Total :</b></td>
                            <td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
                          </tr>
                          <?php if($value->tax >0) {?>
                          <tr>
                            <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>(+)GST (Goods & Services Tax) :</b></td>
                            <td align="right"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
                          </tr>
                          <?php }?>
                          <?php if($value->discount>0) {?>
                          <tr>
                            <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>(-)Discount :</b></td>
                            <td align="right"> <?php echo '$'.$this->cart->format_number($value->discount); ?></td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>Grand Total :</b></td>
                            <td align="right"> <?php echo '$'.$this->cart->format_number($value->grand_total); ?></td>
                          </tr>
                      <?php } else { ?>
                        <tr>
                          <td colspan="4" align="center"> <b>Detail Not Found.</b></td>
                        </tr>
                      <?php } ?>
                  
                  </tbody>
              </table>
            </div>
            <?php } ?>
          <?php } if(!empty($type) && ($type == 'service'))  { ?>
            <?php if(!empty($value)) { ?>
                <div >
                  <table >
                      <thead>
                          <tr style="border-top:1px solid #B5C3DD">
                              <td width="50%" align="left" style="border-right:1px solid #B5C3DD"><b>Service</b></td>
                              <td width="15%" align="center" style="border-right:1px solid #B5C3DD"><b>Booking</b></td>
                              <td width="15%" align="center" style="border-right:1px solid #B5C3DD"><b>Price</b></td>
                              <td width="20%" align="center"><b>Total</b></td>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $order_order_detail = json_decode($value->order_detail) ; ?>
                        <?php if(!empty($order_order_detail)) { ?>
                            <?php foreach ($order_order_detail as $items): ?>
                                <tr>
                                    <td align="left" style="border-right:1px solid #B5C3DD;">
                                      <label><b>Treatment Type : </b> <?php echo $items->name; ?></label>
                                      <p style="margin: 0px;">
                                        Date : <?php echo $items->date; ?><br>
                                        <?php $time_id = get_services_time_name($items->time_id); ?>
                                        <?php if($time_id) { ?>
                                        Time : <?php echo $time_id->timing; ?><br>
                                        <?php } ?>
                                      </p>
                                    </td>
                                    <td align="center" style="vertical-align: middle; border-right:1px solid #B5C3DD;">
                                      <?php echo $items->qty; ?>
                                    </td>
                                    <td align="right" style="vertical-align: middle; border-right:1px solid #B5C3DD">
                                      <?php echo '$'.$this->cart->format_number($items->price); ?>
                                    </td>
                                    <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items->subtotal); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                              <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>Total :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
                            </tr>
                            <?php if($value->tax >0) {?>
                            <tr>
                              <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>(+)GST (Goods & Services Tax) :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
                            </tr>
                            <?php }?>
                            <?php if($value->discount>0) {?>
                            <tr>
                              <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>(-)Discount :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->discount); ?></td>
                            </tr>
                            <?php }?>
                            <tr>
                              <td colspan="3" align="right" style="border-right:1px solid #B5C3DD"> <b>Grand Total :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->grand_total); ?></td>
                            </tr>
                        <?php } else { ?>
                          <tr>
                            <td colspan="4" align="center"> <b>Detail Not Found.</b></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                  </table>
                </div>
            <?php } ?>

          <?php } if(!empty($type) && ($type == 'product')) { ?>
            <?php if(!empty($value)) { ?>
              <?php $order_user_detail = json_decode($value->user_detail); ?>
                <div style="padding-left: 1%;">
                    <div style="width:32%; padding: 2px; float:left;">
                      <h5>Billing Address <hr></h5>
                      <p> 
                        <?php  if(!empty($order_user_detail->first_name)) {  echo  ucfirst($order_user_detail->first_name); } ?>
                        <?php  if(!empty($order_user_detail->last_name)) {  echo '  '.ucfirst($order_user_detail->last_name); } ?><br>
                        <?php  if(!empty($order_user_detail->address)) {  echo $order_user_detail->address; }  ?><br>
                        <?php  if(!empty($order_user_detail->city)) {  echo $order_user_detail->city; }  ?>
                        <?php  if(!empty($order_user_detail->state)) {  echo  $order_user_detail->state; }  ?>
                        <?php  if(!empty($order_user_detail->zip)) {  echo  $order_user_detail->zip; } ?>
                        <?php  if(!empty($order_user_detail->email)) {  echo '<br><br> Email : <br>'. $order_user_detail->email; }  ?>
                        <?php  if(!empty($order_user_detail->mobile)) {  echo '<br> Phone No. : <br>'. $order_user_detail->mobile; }  ?>
                      </p>
                    </div>
                    <div style="width:32%; padding: 2px; float:left;">
                      <h5>Shipping Address<hr></h5>
                      <p>
                        <?php  if(!empty($order_user_detail->s_first_name)) {  echo ucfirst($order_user_detail->s_first_name); }  ?>
                        <?php  if(!empty($order_user_detail->s_last_name)) {  echo ' '.ucfirst($order_user_detail->s_last_name); }  ?><br>
                        <?php  if(!empty($order_user_detail->s_address)) {  echo $order_user_detail->s_address; } ?><br>
                        <?php  if(!empty($order_user_detail->s_city)) {  echo $order_user_detail->s_city; }  ?>
                        <?php  if(!empty($order_user_detail->s_state)) {  echo $order_user_detail->s_state; }  ?>
                        <?php  if(!empty($order_user_detail->s_zip)) {  echo $order_user_detail->s_zip; } ?>
                        <?php  if(!empty($order_user_detail->s_email)) {  echo '<br><br> Email : <br>'. $order_user_detail->s_email; }  ?>
                        <?php  if(!empty($order_user_detail->s_mobile)) {  echo '<br> Phone No. : <br>'. $order_user_detail->s_mobile; }  ?>
                      </p>
                    </div>
                    <div style="width:32%; padding: 2px; float:left;">
                        <h5>Order Details<hr></h5>
                        <p> 
                          Order Id : <?php echo $value->order_id; ?><br>
                          Order Status : <?php if($value->status == 0 ) echo "Pending"; ?><br>
                          Date : <?php echo date('d, M Y h:i:s',strtotime($value->created)); ?>  <br>
                          Amount :<?php echo '$'.$this->cart->format_number($value->grand_total); ?>              
                        </p>
                    </div>
                    <div style="clear:both"></div>
                </div>       
                <div>
                    <hr><b style="padding-left: 4%;">Order Detail - </b><hr>
                    <!-- <p class="section_heading">Shopping Cart</p> -->
                    <div style="width:100%">
                      <table>
                        <thead>
                            <tr style="border-top: 1px solid #B5C3DD;">
                                <td width="60%" align="center" style="border-right: 1px solid #B5C3DD;"><b>Item</b></td>
                                <td width="10%" align="center" style="border-right: 1px solid #B5C3DD;"><b>Qty</b></td>
                                <td width="12%" align="center" style="border-right: 1px solid #B5C3DD;"><b>Price</b></td>
                                <td width="18%" align="center"><b>Total</b></td>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $order_order_detail = json_decode($value->order_detail) ; ?>
                            <?php foreach ($order_order_detail as $items): ?>
                                <tr>
                                    <td style="border-right: 1px solid #B5C3DD;">
                                        <div>
                                            <div style="width:30%; float:left;">
                                                <span>
                                                    <?php 
                                                    $image_headers = @get_headers($items->image); 
                                                    if($image_headers[0] != 'HTTP/1.1 404 Not Found') { ?>
                                                    <img src="<?php echo $items->image;?>" width="100%">
                                                    <?php } else { ?>
                                                    &nbsp;
                                                    <?php }?>
                                                </span>
                                            </div>
                                            <div style="width:70%;  float:left;">
                                                <br>
                                                <b>Name :</b> <?php echo $items->name; ?><br>
                                                <?php if($items->type!='Simple') 
                                                {
                                                    $variation_detail_array = json_decode($items->variation_detail);
                                                    if(count($variation_detail_array[0])== $items->variation_length )
                                                    {
                                                            for ($m=0; $m < $items->variation_length ; $m++) 
                                                            { 
                                                                echo ucfirst($variation_detail_array[0][$m][1]).' : ' .$variation_detail_array[1][$m][1].'<br>';
                                                            }
                                                    }

                                                } ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td align="center" style="vertical-align: middle; border-right: 1px solid #B5C3DD;">
                                      <?php echo $items->qty; ?>
                                    </td>
                                    <td align="right" style="vertical-align: middle; border-right: 1px solid #B5C3DD;">
                                      <?php echo '$'.$this->cart->format_number($items->price); ?>
                                    </td>
                                    <td align="right" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items->subtotal); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                              <td colspan="3" align="right" style="border-right: 1px solid #B5C3DD;"> <b>Total :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->total); ?></td>
                            </tr>
                            <?php if($value->tax>0) { ?>
                            <tr>
                              <td colspan="3" align="right" style="border-right: 1px solid #B5C3DD;"> <b>(+)GST (Goods & Services Tax) :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->tax); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($value->shipping>0) { ?>
                            <tr>
                              <td colspan="3" align="right" style="border-right: 1px solid #B5C3DD;"> <b>(+)Shipping :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->shipping); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($value->discount>0) { ?>
                            <tr>
                              <td colspan="3" align="right" style="border-right: 1px solid #B5C3DD;"> <b>(-)Discount :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->discount); ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                              <td colspan="3" align="right" style="border-right: 1px solid #B5C3DD;"> <b>Grand Total :</b></td>
                              <td align="right"> <?php echo '$'.$this->cart->format_number($value->grand_total); ?></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                </div>         
              <?php }?>
            <?php } ?>     
        </div>
        
      <br>
      <br>
      </div>

    </main>
    <div style="clear:both"></div>
    <div class="footer" style="text-align: center; background:#F58AC6; padding: 1px;">
      <p style="font-size:13px;"> Connect With Us </p>
      <a href="#" target="_blank"><img src="<?php echo base_url(); ?>assets/frontend/images/social/twitter_icon.png" style="width :35px;"></a>
      <a href="#" target="_blank"><img src="<?php echo base_url(); ?>assets/frontend/images/social/facebook_icon.png" style="width :35px;"></a>
      <a href="#" target="_blank"><img src="<?php echo base_url(); ?>assets/frontend/images/social/instagram_icon.png" style="width :35px;"></a>
       <br/>
      <p style="font-size:13px;">All Rights Reserved | Copyright © Lash U Lashes 2016</p>
    </div>
  </body>
</html>
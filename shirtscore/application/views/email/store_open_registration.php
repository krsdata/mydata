<html>
<body style="padding:0; margin:0; background-color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:14px;">
  <div style="width:960px; background-color:#edf0f5;">
    <div style="height:64px; padding:0; margin:0; background-color:#f5f5f5;">
          <a href="<?php echo base_url()?>"><img alt="Shirtscore" border="0" src="<?php echo base_url()?>assets/images/emails/topbar.jpg" style="margin:0; padding:0;"></a>
    </div>        
        <div style="background-color:#ffffff; border-top:2px solid #a6b4d0; border-bottom:2px solid #a6b4d0; color:#3a5a98; text-align:center; font-size:24px; font-weight:bold; line-height:42px; padding-top:20px; padding-bottom:25px;">        
            HEY <?php echo $fname." ".$lname; ?>,<br>
            YOUR STORE REQUEST HAS BEEN RECEIVED<br>
            AND IS PENDING APPROVAL
        </div>
    <table cellpadding="0" cellspacing="0" border="0" style="width:960px;">
          <tbody>
              <tr>
                  <td style="padding-top:40px; padding-bottom:40px; padding-left:40px;" align="center">
                        <a title="Your Awesome Design!" href="<?php echo base_url()?>store/design_your_own"><img alt="Your Awesome Design!" width="250" src="<?php echo base_url()?>assets/images/emails/shirt3.png" border="0"></a>                                             
                    </td>
                    <td style="padding-top:20px; padding-right:20px; padding-bottom:20px; padding-left:60px;" width="530">
                      <div style="line-height:24px; font-size:14px;">
                            <strong>How to log in:</strong><br>
                            Username (email): <?php echo $email; ?><br>
                            Login URL: <a title="Login URL" href="<?php echo base_url()?>store/login"><?php echo base_url()?>store/login</a><br><br>
                            Store Name: <?php echo $store_name; ?><br>
                            Store URL: <a title="<?php echo base_url()?>shop/<?php echo $store_link; ?>" href="<?php echo base_url()?>shop/<?php echo $store_link; ?>"><?php echo base_url()?>shop/<?php echo $store_link; ?></a>
            </div>                            
                        <div style="line-height:24px; padding-top:20px; font-size:14px;">
                            <strong>UPLOAD DESIGNS WHILE YOU WAIT.</strong><br>
                            You receive $5.05 for every shirt sold with your design.<br>
                            Stock your store with fresh artwork. Be creative and show off your skills.<br>
                            So, what are you waiting for? <a title="Get Started" href="<?php echo base_url()?>store/design_your_own">Get started.</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>        
    <div style="background-color:#f5f5f5; border-top:1px solid #e7e6e7; border-bottom:2px solid #e2e3e5; text-align:center; margin-top:20px; background-image:url(<?php echo base_url()?>assets/images/emails/bottombar.jpg); height:65px;">        
         <div style="padding:22px;">
              <a title="Home" style="font-size: 13px;color:#757575; text-decoration:none;" href="<?php echo base_url()?>">HOME</a>  |  <a title="FAQ" style="font-size: 13px;color:#757575; text-decoration:none;" href="<?php echo base_url()?>store/faq">FAQ</a>  |  <a title="Support" style="font-size: 13px;color:#757575; text-decoration:none;" href="<?php echo base_url()?>store/need_help">SUPPORT</a>  |  <a title="Order Tracking" style="font-size: 13px;color:#757575; text-decoration:none;" href="<?php echo base_url()?>store/order_info">ORDER TRACKING</a>  |  <a title="Policies" style="font-size: 13px;color:#757575; text-decoration:none;" href="<?php echo base_url()?>store/pages/privacy-policy">POLICIES</a>  |  <a title="Unsubscribe" style="font-size: 13px;color:#757575; text-decoration:none;" href="<?php echo base_url()?>">UNSUBSCRIBE</a>
            </div>             
        </div>        
        &nbsp;<br>&nbsp;
  </div>
</body>
</html>

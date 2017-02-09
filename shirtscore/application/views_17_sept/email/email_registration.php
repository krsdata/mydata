<html>
<body style="padding:0; margin:0; background-color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:14px;">
  <div style="width:960px; background-color:#edf0f5;">
    <div style="height:64px; padding:0; margin:0; background-color:#f5f5f5;">
          <a href="<?php echo base_url()?>"><img alt="Shirtscore" border="0" src="<?php echo base_url()?>assets/images/emails/topbar.jpg" style="margin:0; padding:0;"></a>
    </div>        
        <div style="background-color:#ffffff; border-top:2px solid #a6b4d0; border-bottom:2px solid #a6b4d0; color:#3a5a98; text-align:center; font-size:24px; font-weight:bold; line-height:42px; padding-top:20px; padding-bottom:25px;">        
            WELCOME <?php echo $fname." ".$lname; ?>,<br>
            THANK YOU FOR SIGNING UP!<br>
            YOU CAN LOGIN WITH THE FOLLOWING CREDENTIALS:        
        </div>
    <table cellpadding="0" cellspacing="0" border="0" style="width:960px;">
          <tbody>
              <tr>
                  <td style="padding-top:40px; padding-bottom:40px; padding-left:60px;">                    
                      <div style="line-height:24px; font-size:14px;">
                            <strong>How to log in:</strong><br>
                            Username (email): <?php echo $email; ?><br>
                            Login URL: <a title="Login URL" href="<?php echo base_url('store/login')?>"><?php echo base_url('store/login')?></a>
            </div>                            
                        <div style="line-height:24px; padding-top:40px; font-size:14px;">                            
                            <strong>CREATE A STORE AND START MAKING SOME MONEY!</strong><br>
                            You receive <strong>$5.05</strong> for every shirt sold with your design.<br>
                            Create your own with our <a href="<?php echo base_url()?>store/design_your_own">Custom Design Tool</a>,<br>
                            or show off your skills as an artist and upload your own!<br>
                            Are you ready to get paid? <a title="Get Started!" href="<?php echo base_url()?>storeadmin/add_design">Get started!</a>
                        </div>                        
                    </td>
                    <td style="padding:20px;" align="center" width="430">                     
                        <a title="Get Your Shirt On!" href="<?php echo base_url()?>store/design_your_own"><img alt="Get Your Shirt On!" width="250" src="<?php echo base_url()?>assets/images/emails/shirt.png" border="0"></a>                        
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

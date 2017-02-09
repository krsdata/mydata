<div class="container">
       <div class="row" style="/* margin-left: 10% */">
        <div id="home_btn" class="span2 home" style="margin-left: 50px;"><!-- <a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a> --></div>
        <div id="dude_text" class="span7 flavor_text">Psst... wanna make some money</div>
        <div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>
      </div>
        <div class="clearfloat"></div>
          <div style="padding: 10px 0;">
              <hr color="#CCCCCC"/> 
          </div>
          <div class="dashcontent">          	
			       <div class="dashbox">
                <div>
                  <div style="float:left">
                  <?php  
                  if ($this->session->userdata('first_product')) {
                    $a = $this->session->userdata('first_product');
                    $path = $a['path'].$a['image'];
                  }else
                    $path = base_url().'assets/uploads/color_img/product_single_lg1.png';

                  ?>
                  <img id="purchased_image" src="<?php echo $path?>" style="height:250px">
                  <input type="hidden" id="product_name" value="<?php echo $a['title']; ?>" >
                  </div>
                  <div style="height:250px; text-align:center">
                  <h1>Before you Wear it... SHARE IT</h1>
                  <img src="<?php echo base_url() ?>assets/front_theme/img/fb.png"> <a href="#" id="share_it0" style="font-size:24.5px">Share it on Facebook</a>
                  </div>
                </div>
                <h2 id="your_order_info_div">Your Order Information</h2>
                <h3>Order reference number: <?php echo $order_id; ?></h3>
                Please quote this number if you make any inquiries regarding your order.<br /><br />
                <hr color="#CCCCCC" />
                <h2>Payment receipt</h2>
                A receipt is available through the link below. It will show your tracking information as soon as that becomes available, so save this link so you can check back on it: <a href="<?php echo base_url()."store/order_tracking/".$order_id; ?>"><?php echo base_url()."store/order_tracking/".$order_id; ?></a><br /><br /> <!-- <a href="#">https://www.shirtscore.com/receipt...</a> -->
                <hr color="#CCCCCC" />
                <h2>Changing your order and other inquiries</h2>
                If you need to correct something or modify your order in any way, or for any other questions, contact us via the <a href="<?php echo base_url()."store/need_help"; ?>">support page</a>,<br />or call <strong>(509) 340-2505</strong>.<br /><br />
                <a href="<?php echo base_url()  ?>store/custom_gear" class="btn">Continue >></a>
                <hr color="#CCCCCC" />
                <h3>Refund Policy</h3>
                <p align="justify">We guarantee all our products against manufacturer defects and any errors in the customization of your order that differ from the information you submit to us at the time of your order. If we determine that a products is defective or we have made an error, we will replace your order at no charge. (Inquiries must be made within 14 days of receiving product.) All orders are custom made at the time the order was submitted and therefore we do not take returns, exchanges, or cancellations. Please be sure you select correct sizes, colors, and designs before final purchase. ShirtScore.com attempts to be as accurate as possible with product descriptions, colors, and images. We do not warrant the color or sizes as they vary from our suppliers.</p>
                </div></div>
                <div style="display:none;"><br /><br />
                <h4 align="center">Don't stop, amigo! ... <em>buy more!&nbsp;&nbsp;Hurry up!&nbsp;&nbsp;Right now!</em></h4>
                </div>

                  <div class="span12" >
              <?php if($latest_design): $i = 1; foreach ($latest_design as $row): ?>
                  
                    <div class="image_main_div" >
                      <img id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug; ?>" name="<?php echo $row->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" class="image_size"/>
                    
                    <div class="likesharewear">
                        <div  style="float:left; padding-right:85px; display:none;">
                          <img src="<?php echo base_url() ?>assets/front_theme/img/fb_like.png" />
                        </div>
                        <div class="shareit">
                          <a class="" onclick="fbshare(<?php echo $row->id;?>)" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div>
                        <div class="wearit">
                          <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" width="60" height="37" border="0" id="WearIt1" /></a>
                        </div></div></div>
                    
                  
              <?php $i++; endforeach; endif; ?>
    </div>

                </div>
<style type="text/css">
.image_main_div{
 height: 300px;
float: left;
padding: 5px;
}
.image_size
{
padding: 20px;
  max-height: 200px;
}
</style>
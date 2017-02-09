<?php
   if ($this->session->userdata('first_product')) {
      $a = $this->session->userdata('first_product');
      $path = $a['path'].$a['image'];
   }else
      $path = base_url().'assets/uploads/color_img/product_single_lg1.png';

?>
<div class="container">
 
<!-- <div class="hero_single"><div class="home"><a href="index.html"><i class="icon-home"></i> Home</a></div><div class="cart"><a href="cart.html"><i class="icon-shopping-cart"></i> Cart</a></div>
</div> -->
<div class="clearfloat"></div>
<div class="prodcontent">
</div>
<hr color="3b5998" />
<div class="dashcontent">
<div class="dashbox">
	<div>
      <div style="float:left">
      <img src="<?php echo $path ?>" style="height:250px">
      </div>
      <div style="height:250px; text-align:center">
      <h1>Create And Sell Custom Gear!</h1><br><br>
      <div style="float:left; width:20%">
      <img src="<?php echo base_url() ?>assets/front_theme/img/upload_d.png" style="width:100px">
      	<p><h4 style="font-size:15px;"> 1. Upload Your Design</h4></p>
      </div>
      <div style="float:left; width:20%">
      <img src="<?php echo base_url() ?>assets/front_theme/img/fb.png" style="width:100px">
      	<p><h4 style="font-size:15px;">2. Share On Facebook</h4></p>
      </div>
      <div style="float:left; width:21%">
      <img src="<?php echo base_url() ?>assets/front_theme/img/money.png" style="width:100px">
      	<p><h4 style="font-size:15px;">3. Earn $ for each sale</h4></p>
      </div>
      </div>
    </div>
    <hr>
    <div><br>
    	<p><h4 id="your_order_info_div">1. Signup To Upload Your Design</h4></p>
    	<p>Artwork must be submitted in jpeg or png format and must be high resolution. Our preferred format is an editable vector file.</p>
    	<!-- <a data-toggle="modal" href="#myModal" class="btn">Upload</a> -->
    	<a href="<?php echo base_url() ?>store/signup" class="btn">Signup</a>
    </div> 
<hr>
<div class="dashicon">
<i style="width:15px;hieght:15px;" class="icon-info-sign"></i>
</div>
<h2>How It Works</h2>
<h3>Earn $ for every item you sell!</h3>
Create your account, upload your designs and earn a minimum of $2.02 and up to $5.05 for 

every product sold with your design! We produce every product, provide customer service and 

we ship directly to the purchasers. We do the work and you make money!
<hr color="3b5998" />
<div class="dashicon">
&nbsp;<i  class="icon-question-sign"></i>&nbsp;
</div>
<h2>Frequently Asked Questions</h2>
<?php foreach ($faq as  $value) {?>
<h3><?php echo $value->question;?></h3>
<p><?php echo $value->answer;?> </p><br />

<?php } ?>
</div>
</div>
<div class="clearfloat"></div>

 
  <?php /* ?>

  <!-- Modal -->
  <!-- <div style="font-size:12px; color:#656260;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">You must read and agree the folowing guideline to continue</h4>
        </div>
        <div class="modal-body">        
			<h3>Guidelines and Restrictions for uploading designs</h3>
			<p><strong>You must read and agree to the following guidelines to continue.</strong></p>
			<p>You may not upload or sell merchandise using any image described below, unless you own the image and/or have a license or authorization to use such image. For more information please review the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
			<p><strong>NO UNOFFICIAL DESIGNS PERMITTED</strong> You can not use the names or images of people, celebrities, musicians, athletes, professional sports teams, trademarked logos, etc. without permission. <a href="#">Learn more...</a></p>
			<p><strong>NO TRADEMARK USE OF NAMES/LOGOS OF COMPANIES OR ORGANIZATIONS</strong> e.g., Microsoft, Pepsi, Green Peace. <a href="#">Learn more...</a></p>
			<p><strong>NO DOWNLOADED INTERNET CONTENT, IMAGES, GRAPHICS OR DESIGNS ARE PERMITTED WITHOUT AUTHORIZATION</strong> <a href="#">Learn more...</a></p>
			<p><input type="checkbox" id="cust_chk" onchange="return custom_gear();" required="required" /> I declare that I have the right to use, market, distribute and sell the content I am uploading. I also declare that the content I am uploading complies with the Guidelines and Restrictions (above) as well as Shirtscore.com <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p> 
        </div>
        <div class="modal-footer">
          <button onclick="window.location='<?php echo base_url() ?>store/add_design'" id="cont_btn" style="color:white" disabled="disabled" class="btn btn-success">Continue</button>         
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <script type="text/javascript">
  	function custom_gear() {
  		if($('#cust_chk').prop('checked')){
  			$('#cont_btn').removeAttr('disabled');
  		}else{
  			$('#cont_btn').attr('disabled','disabled');
  		}
  	}
  </script>

  <?php */ ?>

<div class="container">
 
<!-- <div class="hero_single"><div class="home"><a href="index.html"><i class="icon-home"></i> Home</a></div><div class="cart"><a href="cart.html"><i class="icon-shopping-cart"></i> Cart</a></div>
</div> -->
<div class="clearfloat"></div>
<div class="prodcontent">
</div>
<hr color="3b5998" />
<div class="dashcontent">
<div class="dashbox">
<div class="dashicon">
<i style="width:15px;hieght:15px;" class="icon-info-sign"></i>
</div>
<h2>How It Works</h2>
<h5>Earn $ for every item you sell!</h5>
Create your account, upload your designs and earn a minimum of $2.02 and up to $5.05 for 

every product sold with your design! We produce every product, provide customer service and 

we ship directly to the purchasers. We do the work and you make money!
<hr color="3b5998" />
<div class="dashicon">
&nbsp;<i  class="icon-question-sign"></i>&nbsp;
</div>
<h2>Frequently Asked Questions</h2>
<?php foreach ($faq as  $value) {?>
<h6><?php echo $value->question;?></h6>
<p><?php echo $value->answer;?> </p><br />

<?php } ?>
</div>
</div>
<div class="clearfloat"></div>
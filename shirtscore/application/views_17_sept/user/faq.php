
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
<h3><a href="#">Earn $ for every item you sell!</a></h3>
Upload your custom artwork, create an account and earn money for each product sold with your design! We do all the work, production, customer service and we ship directly to the purchaser. We do the work and make extra cash!
<hr color="3b5998" />
<div class="dashicon">
&nbsp;<i  class="icon-question-sign"></i>&nbsp;
</div>

<h2>Frequently Asked Questions</h2>
<?php foreach ($faq as  $value) {?>
<h3><a href="#"><?php echo $value->question;?></a></h3>
<p><?php echo $value->answer;?> </p><br />

<?php } ?>
</div>
</div>
<div class="clearfloat"></div>
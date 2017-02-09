<div class="container">
       <div class="row" style="/* margin-left: 10% */">
        <div id="home_btn" class="span2 home" style="margin-left: 50px;"><!-- <a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a>--></div> 
        <div id="dude_text" class="span7 flavor_text">Psst... wanna make some money</div>
        <div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>
      </div>
        <div class="clearfloat"></div>
          <div style="padding: 10px 0;">
              <hr color="#CCCCCC"/> 
          </div>
          <div class="dashcontent">           
             <div class="dashbox">
                <h2>Sign Up Process Completed</h2>
                <?php if($this->session->flashdata('success_msg')){ ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Info :</strong><br><?php echo $this->session->flashdata('success_msg'); ?>
                  </div>
                <?php } ?>
                <h3>Thanks for Signing Up!</h3>
                
                  <p>Login to your account to track sales, edit your account, check messages and add new designs.</p><br /><br />

                <hr color="#CCCCCC" />
                <h2>Info :</h2>

                  <p>We Have sent you an email with your login details and Login URL, please check your email.<p>

                <br /><br /> <!-- <a href="#">https://www.shirtscore.com/receipt...</a> -->
                <hr color="#CCCCCC" />
              </div>
          </div>
</div>

<style type="text/css" media="screen">
  .dashcontent{
     font-size: 14px !important;
  }
</style>
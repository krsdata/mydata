<section id="page_content" class="fpassword_content">
  <div class="container containBackWhite top_buffer_60 bottom_buffer_60">
    <div class="row pageHeadRow">
      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <p class="pageHead">Forgot Password?</p>
      </div>
    </div>
    <div class="row rowContent">
      <?php  echo msg_alert_frontend(); ?>
      <div class="col-xs-12 col-sm-6 col-md-6">
        <p class="section_heading">Enter Your Registerd Email ID</p>
        <form role="form" action="<?php echo base_url('distributor/forget_password')?>" method="post" name="fpassword_form">
            <div class="form-group">
              <label for="email">Email address <span class="form_carot">*</span></label>
              <input type="email" class="form-control" id="email" name="email">
              <?php echo form_error('email')?>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn_pink">Submit <i class="fa fa-angle-right"></i></button><br><br>
            <a href="<?php echo base_url('distributor/login')?>" class="pull-left forgot_pw_link"><i>Login</i></a>
            </div>
        </form>       
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
        
      </div>      
    </div>
  </div>
</section>
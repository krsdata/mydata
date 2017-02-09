<section id="page_content" class="fpassword_content">
  <div class="container containBackWhite top_buffer_60 bottom_buffer_60">
    <div class="row pageHeadRow">
      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <p class="pageHead">Enter New Password</p>
      </div>
    </div>
    <div class="row rowContent">
      <?php  echo msg_alert_frontend(); ?>
      <div class="col-xs-12 col-sm-6 col-md-6">
        <p class="section_heading">Update your password</p>
        <form role="form" action="<?php echo base_url('distributor/change_password')?>" method="post" name="cpassword_form">
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php if(!empty($user_id)) { echo $user_id; } else { echo set_value('user_id');} ?>">
            <div class="form-group">
              <label for="npwd">New Password <span class="form_carot">*</span></label>
              <input type="password" class="form-control" id="npwd" name="npwd">
              <?php echo form_error('npwd')?>
            </div>
            <div class="form-group">
              <label for="cnpwd">Re-Enter New Password <span class="form_carot">*</span></label>
              <input type="password" class="form-control" id="cnpwd" name="cnpwd">
              <?php echo form_error('cnpwd')?>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn_pink">Submit <i class="fa fa-angle-right"></i></button>
            </div>
        </form>       
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
        
      </div>      
    </div>
  </div>
</section>
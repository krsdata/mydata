<div class="container">
      <div class="row" style="/* margin-left: 10% */">
        <div id="home_btn" class="span2 home" style="margin-left: 50px;"><!-- <a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a>--></div> 
        <div id="dude_text" class="span7 flavor_text"><a href="<?php echo base_url() ?>store/signup">Turn your designs into cash!</a></div>
        <!-- <div id="cart_btn" class="span2 cart"><a href="<?php //echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div> -->
      </div>
        <div class="clearfloat"></div>
          <div style="padding: 10px 0;">
              <hr color="#CCCCCC"/> 
          </div>
          <div class="dashcontent">
			<div class="dashbox"><h2> Login </h2> 

				<?php echo form_open(current_url()); ?>
				<div class="login_details">
          
          <?php if($this->session->flashdata('error_msg')){ ?>
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
            </div>
          <?php } ?>
          <?php if($this->session->flashdata('success_msg')){ ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Info :</strong><br><?php echo $this->session->flashdata('success_msg'); ?>
            </div>
          <?php } ?> 

					Email <span style="color:red" ><?php echo form_error('username') ?> </span><br />
					<input class="span5" type="text" name="username" value="<?php echo set_value('username'); ?>"><br />
					
					<span>Password <span style="color:red" ><?php echo form_error('password') ?> </span></span><br />
					<input class="span5" type="password" name="password" /><br />
          <div class="ques-link">
            <a href="<?php echo base_url() ?>recover_password/forget_password" title="Get New Password...?"> Forgot Password...<i class="icon-question-sign"></i> </a>
            &nbsp;&nbsp;&nbsp;
            <a href="<?php echo base_url() ?>store/signup" title="SignUp Now...?"> New Here...<i class="icon-question-sign"></i> </a>
          </div>
          <br />
          <input id="help_submit" type="submit" class="btn btn-success" value="Login" /><br>
				</div>
				<?php echo form_close(); ?>
			</div>
		 </div>


<style type="text/css" media="screen">
  .ques-link{
    color: #3B5998;
    font-size: 12px;
  }
</style>
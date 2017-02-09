<div class="container">

<div class="dashcontent">           
      <div class="dashbox"><h2>You can reset your password here</h2>       
        <?php echo form_open(current_url()); ?>
        <div class="login_details">
 <?php if($this->session->flashdata('email')): ?>
      <div class="confirm-alert" style="text-align:center"><?php echo $this->session->flashdata('email'); ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
    <div class="error-alert" style="text-align:center"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>
         Password<span style="color:red" ><?php echo form_error('password') ?> </span><br />
          <input class="span5" type="password" name="password"><br />
             
         Confirm Password<span style="color:red" ><?php echo form_error('c_password') ?> </span><br />
          <input class="span5" type="password" name="c_password" ><br />
                <input type="submit" name="submit" value="Submit"  class="btn-success btn">
                 </div>
<?php echo form_close()?>
      </div>
     </div>


</div>
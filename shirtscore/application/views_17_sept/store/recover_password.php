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
         Email Address<span style="color:red" ><?php echo form_error('artist') ?> </span><br />
          <input class="span5" type="text" name="email" value="<?php echo set_value('email'); ?>"><br />
          <span style="color:red;"><?php echo form_error('email'); ?></span>
                <input class="btn-success btn" type="submit" name="submit" value="Submit">
                 </div>
<?php echo form_close()?>
      </div>
     </div>



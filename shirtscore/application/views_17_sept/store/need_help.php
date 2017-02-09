<div class="container">

<div class="dashcontent">           
      <div class="dashbox"><h2>Ask for help</h2>
        <?php if($this->session->flashdata('success_msg')){ ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Info :</strong><br><?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php } ?> 
        <?php echo form_open_multipart(current_url()); ?>
        <div class="login_details">
          Name <br />
          <input class="span5" type="text" name="name" value="<?php echo set_value('name'); ?>"><br />
          <span style="color:red" ><?php echo form_error('name') ?> </span><br />
          Email <br />
          <input class="span5" type="text" name="email" value="<?php echo set_value('email'); ?>" /><br />
          <span style="color:red"><?php echo form_error('email'); ?></span> <br />
          Subject <br />
          <input class="span5" type="text" name="subject" value="<?php echo set_value('subject'); ?>" /><br />
          <span style="color:red"><?php echo form_error('subject'); ?></span> <br />
          <span>Question</span><br />
          <textarea class="span5" name="question"><?php echo set_value('question'); ?></textarea><br>
          <span style="color:red"><?php echo form_error('question'); ?> </span><br />
          <input type="submit" class="btn-success btn" value="Send" />
        </div>
        <?php echo form_close(); ?>
      </div>
     </div>
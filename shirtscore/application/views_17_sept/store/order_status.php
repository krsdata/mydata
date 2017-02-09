<div class="container">
    <div class="dashcontent">           
        <div class="dashbox">
          <h2>Track Your Order Here</h2>
               <?php //if($this->session->flashdata('error_msg')){ ?>
                 <!--  <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error :</strong><br><?php //echo $this->session->flashdata('error_msg'); ?>
                  </div> -->
              <?php //} ?>
              <?php msg_alert(); ?>
              <?php echo form_open(current_url(),array('class'=>'form-horizontal row-fluid')); ?>
              <hr color="#ccc" />
              <div class="login_details">
                   <strong>Email Address  :</strong><br />
                  <span style="color:red"><?php echo form_error('email'); ?> </span>
                  <input type="text" name="email" class="span3" value="<?php echo set_value('email'); ?>" /> <br /><br />

                  <strong>Order Id  :</strong><br />
                  <span style="color:red"><?php echo form_error('order_id'); ?> </span>
                  <input type="text" name="order_id" class="span3" value="<?php echo set_value('order_id'); ?>" /> <br /><br />
                 
                  <input id="help_submit" type="submit" name="search" value="Search" class="btn-success btn update_cart"/>
              </div>
              <?php echo form_close(); ?>
             
             <?php if (isset($order_status)): ?>
             <div style="text-align: center;">
                <h2>Your Order status : <span style="color:#3B5998"><?php echo strtoupper(fetch_order_status($order_status)); ?></span></h2>
             </div>
             <?php endif ?>
        </div>
    </div>

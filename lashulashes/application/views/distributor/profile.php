<?php 
  $prfile_segment = $this->uri->segment(2);
?>
<section id="page_content" class="login_content0">
  <div class="container ">
      <div class="row bilship_row1">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <p class="page_head margin_cutter">My Profile</p>
        </div>
      </div>
      <?php  echo msg_alert_frontend(); ?>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php if($prfile_segment=='profile') echo 'active';?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Account Details</a></li>
        <li role="presentation" class="<?php if($prfile_segment=='password') echo 'active';?>"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Change Password</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php if($prfile_segment=='profile') echo 'active';?>" id="home">
              <form role="form" action="<?php echo base_url('distributor/profile')?>" method="post" name="bilship_form"> 
                <div class="row bilship_row2 row_gap">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                          <p class="section_heading margin_cutter">Billing Address</p>
                          <p class="section_text_small bottom_buffer_20">Your billing address must match the address associated with the credit card you use</p>                      
                          <div class="form-group">
                            <label for="firstname">First Name <span class="form_carot">*</span></label>
                            <input type="type" class="form-control" id="firstname">
                          </div>
                          <div class="form-group">
                            <label for="lastname">Last Name <span class="form_carot">*</span></label>
                            <input type="type" class="form-control" id="lastname">
                          </div>
                          <div class="form-group">
                            <label for="Email">Email address <span class="form_carot">*</span></label>
                            <input type="email" class="form-control" id="Email" disabled="disabled">
                          </div>
                          <div class="form-group">
                            <label for="address1">Address 1 <span class="form_carot">*</span></label>
                            <input type="text" class="form-control" id="address1">
                          </div>
                          <div class="form-group">
                            <label for="address2">Address 2 </label>
                            <input type="text" class="form-control" id="address2">
                          </div>
                          <div class="form-group">
                            <label for="city">City <span class="form_carot">*</span></label>
                            <input type="text" class="form-control" id="city">
                          </div>
                          <div class="form-group">
                            <label for="state">State </label>
                            <input type="text" class="form-control" id="state">
                          </div>  
                          <div class="form-group">
                            <label for="state">State </label>
                            <select name="country" id="country" class="form-control">
                              <option value="" label="Select country..." selected="selected">Select country ... </option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="zipcode">Postal Code <span class="form_carot">*</span></label>
                            <input type="text" class="form-control" id="zipcode">
                          </div>
                          <div class="form-group">
                            <label for="phone">Phone No.</label>
                            <input type="text" class="form-control" id="phone">
                            <p class="section_text_small">Example: (333) 333-3333</p>
                          </div>
                          <div class="checkbox">
                              <label><input type="checkbox">Use Billing Information for Shipping Address</label>
                          </div>  
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                          <p class="section_heading">Shipping Address</p>

                          <div class="form-group">
                            <label for="firstname">First Name <span class="form_carot">*</span></label>
                            <input type="type" class="form-control" id="firstname">
                          </div>
                          <div class="form-group">
                            <label for="lastname">Last Name <span class="form_carot">*</span></label>
                            <input type="type" class="form-control" id="lastname">
                          </div>
                          <div class="form-group">
                            <label for="Email">Email address <span class="form_carot">*</span></label>
                            <input type="email" class="form-control" id="Email">
                          </div>
                          <div class="form-group">
                            <label for="address1">Address 1 <span class="form_carot">*</span></label>
                            <input type="text" class="form-control" id="address1">
                          </div>
                          <div class="form-group">
                            <label for="address2">Address 2 </label>
                            <input type="text" class="form-control" id="address2">
                          </div>
                          <div class="form-group">
                            <label for="city">City <span class="form_carot">*</span></label>
                            <input type="text" class="form-control" id="city">
                          </div>
                          <div class="form-group">
                            <label for="state">State </label>
                            <input type="text" class="form-control" id="state">
                          </div>  

                          <div class="form-group">
                              <label for="state">State </label>
                              <select name="country" id="country" class="form-control">
                                    <option value="" label="Select country..." selected="selected">Select country ... </option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="zipcode">Postal Code<span class="form_carot">*</span></label>
                            <input type="text" class="form-control" id="zipcode">
                          </div>
                          <div class="form-group">
                            <label for="phone">Phone No.</label>
                            <input type="text" class="form-control" id="phone">
                            <p class="section_text_small">Example: (333) 333-3333</p>               
                          </div>
                    </div>      
                </div>
                <div class="row bilship_row2 row_gap">
                  <button type="submit" class="btn btn_pink pull-right">Update</button>
                </div>
              </form>
        </div>
        <div role="tabpanel" class="tab-pane <?php if($prfile_segment=='password') echo 'active';?>" id="profile">
              <form role="form" action="<?php echo base_url('distributor/password')?>" method="post" name="pass_form"> 
                <div class="row bilship_row2 row_gap">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <p class="section_heading margin_cutter">Change Password</p>
                    <p class="section_text_small bottom_buffer_20">Your billing address must match the address associated with the credit card you use</p>
                        <div class="form-group">
                          <label for="pwd">Current Password <span class="form_carot">*</span></label>
                          <input type="password" class="form-control" id="pwd" name="pwd">
                          <?php echo form_error('pwd')?>
                        </div>
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
                        <div class="row bilship_row2 row_gap">
                          <button type="submit" class="btn btn_pink pull-right">Update Password</button>
                        </div>
                  </div>      
                </div>
              </form>          
        </div>
      </div>
  </div>
</section>
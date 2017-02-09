
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

        	<?php if($this->session->flashdata('success_msg')){ ?>
		    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
			</div>
			<?php } ?>

      <?php if($this->session->flashdata('error_msg')){ ?>
        <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
      </div>
      <?php } ?>
			<br>

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Change Password </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Old Password
                  <span class="help-block"><?php echo form_error('old_pass'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="password"  class="row-fluid" name="old_pass" placeholder="old password">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">New Password 
                  	<span class="help-block"><?php echo form_error('password'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="password" class="row-fluid" name="password"  placeholder="New Password">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Confirm Password 
                    <span class="help-block"><?php echo form_error('c_pass'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="password" class="row-fluid" name="c_pass" placeholder="Confirm Password">
                  </div>
                </div>               
               
                <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Submit</button>                    
                  </div>
                </div>
            <?php echo form_close(); ?>
            </div>
             <!--  -->

            <!-- End row-fluid --> 
          </div>
          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
    </div>  
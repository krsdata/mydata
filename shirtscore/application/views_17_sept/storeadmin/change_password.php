<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">
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
            <div class="title">
              <h4><span> Update Password </span> </h4>
            </div>
            <!-- End .title -->
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
               
            <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="with-placeholder">                    
            </label>
            <div class="controls span9">
              <button type="submit" class="btn">Submit</button>                    
            </div>
          </div> 
            <?php echo form_close(); ?>
            </div>
      </div>      
    </div>
  </div>
  <style type="text/css">
  .help-block{
    color: red;
  }
</style>
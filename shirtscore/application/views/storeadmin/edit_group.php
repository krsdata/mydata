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
			         
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Edit Group </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Group Name
                  <span class="help-block"><?php echo form_error('group_name'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="group_name" value="<?php echo $product_group->group_name; ?>" placeholder="Group Name">
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
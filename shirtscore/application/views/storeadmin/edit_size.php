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
              <h4><span> Edit Size </span> </h4>
            </div>
            <!-- End .title -->
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Size Name
                  <span class="help-block"><?php echo form_error('size_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php if(!empty($size->size_name)) echo $size->size_name; ?>" class="row-fluid" name="size_name" placeholder="Size Name">
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
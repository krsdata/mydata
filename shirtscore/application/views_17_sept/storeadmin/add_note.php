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
              <h4><span> Add Note </span> </h4>
            </div>
            <!-- End .title -->
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Title
                  <span class="help-block"><?php echo form_error('title'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="title" value="<?php echo set_value('title'); ?>" placeholder="Note Title">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="editor1">NOTE
                  	<span class="help-block"><?php echo form_error('note'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea  id="editor1" name="note" rows="10" class="row-fluid"><?php echo set_value('note'); ?></textarea>                    
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
          
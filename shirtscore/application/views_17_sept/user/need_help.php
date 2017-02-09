<div class="dashcontent" style="margin:0px;">
  <style type="text/css" media="screen">
    .help-block {
    color: #FF0000;
}
  </style>
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
              <h2>Add Query</h2>
            </div>
            <!-- End .title -->
          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
               <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Name
                  <span class="help-block"><?php echo form_error('name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" readonly ='readonly' value="<?php echo $info->firstname.' '.$info->lastname ?>" class="row-fluid" >
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Email
                  <span class="help-block"><?php echo form_error('name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" readonly ='readonly' value="<?php echo $info->email; ?>" class="row-fluid">                    
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Subject
                  <span class="help-block"><?php echo form_error('subject'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('subject'); ?>" class="row-fluid" name="subject" placeholder="subject">
                  </div>
                </div>             
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Question
                    <span class="help-block"><?php echo form_error('question'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="question" rows="5" class="row-fluid"><?php echo set_value('question'); ?></textarea>
                    <!-- <input type="text" class="row-fluid" name="store_description" placeholder="Address"> -->
                  </div>
                </div>      
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9">
                    <button type="submit" class="btn btn-success">Submit</button>                    
                  </div>
                </div> 
            <?php echo form_close(); ?>
           </div>
      </div>      
    </div>
  </div>
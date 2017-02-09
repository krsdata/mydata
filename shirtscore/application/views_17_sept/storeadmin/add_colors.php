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

          <h4><span> Add Colors </span></h4>

          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid','id'=>'add_product')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Add Color
                  <span class="help-block"><?php echo form_error('color'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" id="color" data-color="rgb(255, 146, 180)" data-color-format="hex">
                    <input type="text" name="color" class="span5" value="">
                    <span class="add-on" ><i style="background-color: rgb(255, 146, 180)"></i></span>
                    </div>
                  </div>
                </div>  

                <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Front Image
                    <span class="help-block"><?php echo form_error('front');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="front" name="front" style="opacity:1 !important"><br>
                   <div class="row-fluid image_priview">  </div> 
                  </div>
                </div>

                <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Left Image
                    <span class="help-block"><?php echo form_error('left');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="left" name="left" style="opacity:1 !important"><br>
                   <div class="row-fluid image_priview">  </div> 
                  </div>
                </div>

                <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Back Image
                    <span class="help-block"><?php echo form_error('back');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="back" name="back" style="opacity:1 !important"><br>
                   <div class="row-fluid image_priview">  </div> 
                  </div>
                </div>

                <div  class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Right Image
                    <span class="help-block"><?php echo form_error('right');?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" id="right" name="right" style="opacity:1 !important"><br>
                   <div class="row-fluid image_priview">  </div> 
                  </div>
                </div>
                <!-- <input id="userfile_1" type="file" name="userfile" class="">            -->
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
  #uniform-userfile_1 .filename, #uniform-userfile_1 .action{
    display: none !important; 
  }

  .uploader input{
    opacity: 1 !important;

  }
</style>
<script type="text/javascript">
  $('#userfile_1').removeAttr('size');
  $(document).ready(function(){
    $('#add_image_div').hide();
  });
</script>
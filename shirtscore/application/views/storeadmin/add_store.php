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
              <h4><span> Add store </span></h4>
            </div>

            <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Store Banner
                    <span class="help-block"><?php echo form_error('userfile'); ?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" name="userfile">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Store Name
                    <span class="help-block"><?php echo form_error('store_name'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('store_name'); ?>" class="row-fluid" name="store_name" placeholder="Store name" autocomplete="off">
                  </div>
                </div>
                
               <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="hint-field">Store Link <span class="help-block"><?php echo form_error('store_link'); ?></span> </label>
                    <div class="input-prepend controls span9">
                      <span class=" add-on"><?php echo base_url() ?>shop/</span>
                      <input class="" id="" type="text" name="store_link" value="<?php echo set_value('store_link'); ?>" placeholder="Store Link" autocomplete="off">
                    </div>                   
                 </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Store Description
                    <span class="help-block"><?php echo form_error('store_description'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="store_description" id="desc" rows="5" class="row-fluid"><?php echo set_value('store_description'); ?></textarea><br>
                    <span id="counter"></span>
                    <!-- <input type="text" class="row-fluid" name="store_description" placeholder="Address"> -->
                  </div>
                </div>

               <!-- <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Header Color
                  <span class="help-block"><?php echo form_error('color'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" id="header_color" data-color="rgb(255, 146, 180)" data-color-format="hex">
                    <input type="text" name="header_color" class="span12" value="">
                    <span class="add-on" ><i style="background-color: rgb(255, 146, 180)"></i></span>
                    </div>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Text Color
                  <span class="help-block"><?php echo form_error('color'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" id="font_color" data-color="rgb(255, 146, 180)" data-color-format="hex">
                    <input type="text" name="font_color" class="span12" value="">
                    <span class="add-on" ><i style="background-color: rgb(255, 146, 180)"></i></span>
                    </div>
                  </div>
                </div> -->

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
<script>
jQuery(document).ready(function($) {
  jQuery('input[name="store_name"]').on('keyup change',function(){
    var store_name=$.trim(jQuery(this).val().toLowerCase());
    var desired = store_name.replace(/[^a-zA-Z0-9\s-]/gi, '').replace(/[^a-zA-Z0-9-]/gi, '-');
    jQuery('input[name="store_link"]').val(desired);
  });

  function count(){
      var txtVal = $('#desc').val();
      var chars = txtVal.length;
      if (chars >= 300)
      {
        txtVal = txtVal.substring(0,300);
        $('#desc').val(txtVal);
        var chars = txtVal.length;
      };
      var words = txtVal.trim().replace(/\s+/gi, ' ').split(' ').length;
      if(chars===0){words=0;}
      $('#counter').html('<br>'+words+' words and '+ chars +' characters');
  }
  
  count();

  $('#desc').on('keyup propertychange paste', function(){
      count();
  });

});
</script>
<style type="text/css">
  .help-block{
    color: red;
  }
</style>
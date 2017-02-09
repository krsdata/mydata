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
              <h4><span> Edit Parameters </span> </h4>
           </div>

           <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid','id'=>'add_product')); ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Add Color
                  <span class="help-block"><?php echo form_error('color'); ?></span>
                </label>
                  <div class="controls span9">
                    <div class="input-append color" data-color="<?php echo $colors['color']->color_code;  ?>" data-color-format="hex" id="colorpicker3">
                    <input type="text"   name="color" value="<?php echo $colors['color']->color_code; ?>" placeholder="color">
                    <span class="add-on"><i style="#4a8cf7; "></i></span> </div>
                  </div>
                </div>

                <!-- <div  class="form-row control-group row-fluid">
                <label class="control-label span3" for="search-input">Images                  
                </label> -->
                  <?php   
                  $imgs = array();
                  $k=0; ?>
                  <div class="controls span9">          
                    <?php if(!empty($colors['images'])) foreach ($colors['images'] as $row): ?>
                      <?php $imgs[$row->view] = $row->view; $k++; ?>
                      <div class="form-row control-group row-fluid">
                          <label class="control-label span3" for="search-input"><?php echo $row->view; ?> Image
                            <span class="help-block"><?php echo form_error($row->view);?></span>
                          </label>
                          <div class="controls span9">
                           <input type="file" id="<?php echo $row->view;?>" name="<?php echo $row->view;?>" style="opacity:1 !important"><br>
                           <div class="row-fluid image_priview">  </div> 
                          </div>
                      </div>
                        <div class="form-row control-group row-fluid">
                          <label class="control-label span3" for="search-input"> </label>
                          <div class="controls span9">
                          <span class="img_thumb" id="sp<?php echo $row->id; ?>">
                            <img src="<?php echo  base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->image_name; ?>"><a href="javascript:void(0)" class="remove_image btn" id="<?php echo $row->id; ?>" style="vertical-align: top;" ><i class="icon-remove"></i></a>
                          </span>
                          </div>
                      </div>
                      <input type="hidden" ids="<?php echo $row->id; ?>" name="<?php echo $row->view.'1';?>" value="<?php echo $row->image_name;?>">
                    <?php endforeach ?>

                    <?php if($k < 4): ?>
                         <?php if(!element('front', $imgs)): ?>
                               <div  class="form-row control-group row-fluid">
                                <label class="control-label span3" for="search-input">front Image
                                  <span class="help-block"><?php echo form_error('front');?></span>
                                </label>
                                <div class="controls span9">
                                 <input type="file" id="front" name="front" style="opacity:1 !important"><br>
                                 <input type="hidden" name="front1" value="">
                                 <div class="row-fluid image_priview">  </div> 
                                </div>
                              </div>
                          <?php endif ?>

                          <?php if(!element('left', $imgs)): ?>
                               <div  class="form-row control-group row-fluid">
                                <label class="control-label span3" for="search-input">left Image
                                  <span class="help-block"><?php echo form_error('left');?></span>
                                </label>
                                <div class="controls span9">
                                 <input type="file" id="left" name="left" style="opacity:1 !important"><br>
                                 <input type="hidden" name="left1" value="">
                                 <div class="row-fluid image_priview">  </div> 
                                </div>
                              </div>
                          <?php endif ?>
                          <?php if(!element('back', $imgs)): ?>
                              <div  class="form-row control-group row-fluid">
                                <label class="control-label span3" for="search-input">back Image
                                  <span class="help-block"><?php echo form_error('back');?></span>
                                </label>
                                <div class="controls span9">
                                 <input type="file" id="back" name="back" style="opacity:1 !important"><br>
                                 <input type="hidden" name="back1" value="">
                                 <div class="row-fluid image_priview">  </div> 
                                </div>
                              </div>
                          <?php endif ?>
                          <?php if(!element('right', $imgs)): ?>
                               <div  class="form-row control-group row-fluid">
                                <label class="control-label span3" for="search-input">right Image
                                  <span class="help-block"><?php echo form_error('right');?></span>
                                </label>
                                <div class="controls span9">
                                 <input type="file" id="right" name="right" style="opacity:1 !important"><br>
                                 <input type="hidden" name="right1" value="">
                                 <div class="row-fluid image_priview">  </div> 
                                </div>
                              </div>
                          <?php endif ?>

                    <?php endif ?>
                  </div>
                <!-- </div> -->


                <!-- <input id="userfile_1" type="file" name="userfile" class="">            -->
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9" style="margin-left:22%" >
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

  $('.remove_image').click(function(){
    var img_id = $(this).attr('id');
    // alert(img_id);
    $('#sp'+img_id).html('<img src="<?php echo THEME_URL ?>img/ajax-loader.gif">')
    $.ajax({
    type: "POST",    
     url: "<?php echo base_url().'storeadmin/remove_product_images/' ?>"+img_id,
    success: function(res){
      if(res !=''){
        $('#sp'+img_id).hide();
        $('input[ids='+img_id+']').val('');
      }
    }
    });
  });
</script>
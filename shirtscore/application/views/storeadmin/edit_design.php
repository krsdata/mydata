<!-- <div class="container"> -->
    <div class="dashcontent">           
        <div class="dashbox">
        
             <?php echo form_open_multipart(current_url(),array("id" => "add_design_form"),array('class'=>'form-horizontal')); ?>
              <hr color="#ccc" />
              <div class="well clearfix">
              <h2>Edit Design </h2>
              
                  <div class="row-fluid">
                   <div class="span3">
                      <img style="float:left; margin:5px 25px 120px 0;" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $design->design_image; ?>" /> </br></br></br></br>
                   </div>
                   <div class="span6">
                    <strong>Add design to your stores</strong><br />
                    <small><b>To select more than one store press and hold control key while selecting stores.<br>
                    If you select "None" it will not appear in any of your approved store.</b></small><br /><br />
                    <span style="color:red" ><?php echo form_error('store_id[]') ?> </span>              
                      <select name="store_id[]" multiple="multiple" class="span10" style="height:130px;">
                          <option value="not_store"  <?php if($countstore->count ==0){ echo'selected="selected"';}?>>None</option>
                        <?php foreach ($stores as $key): ?>              
                          <option value="<?php echo $key->id ?>"<?php if(get_selected_design_store($stores_id, $key->id)==TRUE) echo "selected='selected'"; ?>><?php echo $key->store_name; ?></option>
                        <?php endforeach ?>
                      </select><br><br>
                      <strong>The Artist</strong><br />
                      <span style="color:red"><?php echo form_error('artist'); ?> </span>
                      <input class="span10" type="text" name="artist" value="<?php echo $design->artist; ?>" /> <br /><br />
                      <strong>Design Title</strong><br />
                      <span style="color:red"><?php echo form_error('design_title'); ?> </span>
                      <input class="span10" type="text" id="title" name="design_title" value="<?php echo $design->design_title; ?>" /><br /><br />
                      <strong>Design Slug</strong><br />
                      <span style="color:red"><?php echo form_error('slug'); ?> </span>
                      <input class="span10" readonly="readonly" type="text" id="slug" name="slug" value="<?php echo $design->slug; ?>" /><br /><br /> 
                        
                     <strong>Design video url</strong>&nbsp;&nbsp;&nbsp;
                      <input type="radio" name="design_video_type" id="video_url" value="1" <?php if($design->design_video_type=='1'  || $_POST['design_video_type']=='1') echo 'checked="checked"'; ?>/>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                   <strong>Upload your video about design</strong>&nbsp;&nbsp;&nbsp;
                   <input type="radio" name="design_video_type" id="video_upload" value="2" <?php if($design->design_video_type=='2'  || $_POST['design_video_type']=='2') echo 'checked="checked"'; ?>/><br /><br />

                  <span class="design_video" <?php if($design->design_video_type == '1'  || $_POST['design_video_type']=='1'): echo 'style="display:block"'; else: echo 'style="display:none"'; endif; ?>>
                  <?php if ($design->design_video_type == '1'): ?>
                      <strong>Design Video</strong><br />
                      <a class="fancybox-media1" href="<?php echo $design->design_video ?>"> <?php echo get_youtube_thumbnail($design->design_video);?></a><br /><br /> 
                      <?php endif ?>

                      <strong>Update Design Video URL:</strong><br />
                      <span style="color:red"><?php echo form_error('design_video'); ?> </span>
                       <input type="text" class="span10" name="design_video" placeholder="design video url i.e youtube, vimeo" value="<?php if($design->design_video_type == '1'): echo $design->design_video; else: echo set_value('design_video'); endif; ?>"/><br /><br />
                  </span>
                  <span class="upload_video" <?php if($design->design_video_type=='2'  || $_POST['design_video_type']=='2') echo 'style="display:block"'; else echo 'style="display:none"'; ?>>

                     <?php if ($design->design_video_type=='2'): ?>
                          <strong>Uploaded Video</strong><br /><br />
                          <div id="vertical"></div><br /><br /> 
                       <?php endif; ?>

                      <strong>Upload your video about design</strong>(optional)<br />
                      <span style="color:red"><?php echo form_error('upload_video'); ?> </span>
                      <input class="span5 input-opacity" type="file" name="upload_video"/><br />
                      (upload video file type i.e  .mp4, .flv | Max file size: 9MB)<br /><br />
                  </span>

                      <strong>Description</strong><br />
                      (Tell buyers more about your design. Method used, history of concept, etc.)<br />
                      <span style="color:red"><?php echo form_error('description'); ?> </span>
                      <textarea class="span10" name="description"><?php if(set_value('description') != '')echo set_value('description');else echo $design->description;?></textarea><br /><br />
                      <!--  <strong>Design_image:</strong><br/>

                      <input class="span10" type="file" name="designfile" >
                      <input class="span10" type="hidden" id="img_size_error" name="img_size_error" value="<?php echo strip_tags(form_error('designfile')); ?>" >
                      <br/><br />-->
                      <strong>Categories:</strong><br />
                     <!--  <?php echo $design->category;
                      $data=unserialize($design->category);
                      print_r($data);?> -->
                      <div class="controls span12">
                          <div class="row-fluid">
                            <?php $c_no = 1; ?>
                            <?php foreach ($category as $row): ?>
                              <?php if($c_no == 5): ?>
                                </div>
                                <div class="row-fluid">
                                  <?php $c_no = 1; ?>
                              <?php endif ?>
                              <div class="span3"><input type="checkbox" name="category[]" value="<?php echo $row->id; ?>" <?php $i=0; $data=unserialize($design->category);
                              if(in_array($row->id, $data)) echo"checked";
                                ?> > 
                          <?php echo ucfirst($row->category_name); ?></div>
                            <?php $c_no++; ?>
                            <?php endforeach ?>
                          </div>

                      <span style="color:red"><?php echo form_error('category'); ?> </span>
                      <br/><br/>
                      <input class="btn-success btn update_cart" type="submit" id="edit_design" name="submit" value="Update Design" />
                        <img id="loader_image" src="<?php echo base_url() ?>assets/images/design-submit.gif" style="display:none;position: fixed;top: 20%;opacity: 0.3;">
                   </div>
                  </div>
              </div>
              <?php echo form_close(); ?>
        </div>
    </div>
</div>

 <script type="text/javascript">
    $(document).ready(function () {
       $("#add_design_form").submit(function() {
      $("#loader_image").show();
    });
      $("#title,#slug").on('change keyup blur',function(){
        var stringToReplace = $(this).val().toLowerCase();
        stringToReplace = $.trim(stringToReplace);
        var desired = stringToReplace.replace(/[^a-zA-Z0-9\s-]/gi, '');
        desired = desired.replace(/[^a-zA-Z0-9-]/gi, '-');
        $('#slug').val(desired);
      });

       $('.upload_video').find('input[name="upload_video"]').css('opacity','40');

           $('#video_url').click(function(){
            $('.upload_video').hide();
            $('.design_video').show();
          });
          $('#video_upload').click(function(){
            $('.upload_video').find('.uploader').css('display','block');
            $('.upload_video').find('input').css('opacity','40');
            $('.upload_video').find('.filename,.action').css('display','none');
            $('.upload_video').show();
            $('.design_video').hide();
          });
    });
</script>
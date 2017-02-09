<div id="main_container">
    <div class="row-fluid ">      
       <div class="span12">
      
      
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-picture"></i> <span>Edit Design</span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
      <div class="content">
          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">The Artist
                  <span class="help-block"><?php echo form_error('artist'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="artist" value="<?php if(!empty($designs->artist)) echo $designs->artist; ?>" placeholder="Artist">
                  </div>
                </div>  
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Title
                  <span class="help-block"><?php echo form_error('design_title'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" id="title" class="row-fluid" name="design_title" value="<?php if(!empty($designs->design_title)) echo $designs->design_title; ?>" placeholder="Title">
                  </div>
                </div>   

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Slug
                    <span class="help-block"><?php echo form_error('slug'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" id="slug" class="row-fluid" name="slug" value="<?php if(!empty($designs->slug)) echo $designs->slug; else echo set_value('slug'); ?>" placeholder="Product Slug">
                  </div>
                </div>

                <?php if($designs->status != 0){?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Price
                    <span class="help-block"><?php echo form_error('price'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="price" value="<?php if(!empty($designs->price)) echo $designs->price; ?>" placeholder="Design Price i.e 25.24">
                  </div>
                </div>   
                <?php }?>
                 
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design

                  <span class="help-block"><?php echo $this->session->flashdata('image_error');?></span>
                </label>
                  <div class="controls span9">
                    <input type="file" name="userfile" class="spa1n6 fileinput">                   
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">
                  <span class="help-block"></span>
                </label>
                  <div class="controls span9">                    
                    <?php if(!empty($designs->design_image)): ?>
                    <img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $designs->design_image; ?>">
                  <?php endif; ?>
                  </div>  
                </div> 



              <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Design Video url</label>
                  <label class="control-label span1" for="hint-field"><input type="radio" class="span2" name="design_video_type" id="video_url" value="1" <?php if($designs->design_video_type=='1'  || $_POST['design_video_type']=='1') echo 'checked="checked"'; ?>/></label>
                  <label class="control-label span2" for="hint-field">Upload Design Video</label>
                  <label class="control-label span1" for="hint-field"><input type="radio" class="span2" name="design_video_type" id="video_upload" value="2" <?php if($designs->design_video_type=='2'  || $_POST['design_video_type']=='2') echo 'checked="checked"'; ?>/></label>
              </div>

          <div class="design_video" <?php if($designs->design_video_type == '1'  || $_POST['design_video_type']=='1'): echo 'style="display:block"'; else: echo 'style="display:none"'; endif; ?>>   
                  <?php if ($designs->design_video_type == '1'): ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Video
                    <span class="help-block"></span>
                  </label>
                  <div class="controls span9"> 
                   <a class="fancybox-media1" href="<?php echo $designs->design_video ?>"> <?php echo get_youtube_thumbnail($designs->design_video);?> </a>
                  </div>  
                </div> 
                  <?php endif ?>
               

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Update Design Video URL</label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" rows="5" name="design_video" placeholder="design video url i.e youtube" value="<?php if($designs->design_video_type == '1'): echo $designs->design_video; else: echo set_value('design_video'); endif; ?>"/>
                  </div>
                </div>
          </div>
          <div class="upload_video" <?php if($designs->design_video_type=='2' || $_POST['design_video_type']=='2') echo 'style="display:block"'; else echo 'style="display:none"'; ?>>
                  <?php if ($designs->design_video_type=='2'): ?>
                <div class="form-row control-group row-fluid" <?php if($designs->design_video_type=='2') echo 'style="display:block"'; ?>>
                 <label class="control-label span3" for="hint-field">Upload Design Video</label>
                  <div class="controls span9">
                    
                   <div id="vertical"></div>
                  </div>
                </div>
                  <?php endif; ?>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Upload your video about design(optional)<span class="help-block"><?php echo form_error('upload_video'); ?></span></label>
                  <div class="controls span9">
                    <input type="file" name="upload_video" class="input-opacity"/><br/><br/>
                    (upload file type: .flv, mp4 | max file size: 9MB)
                  </div>
                </div>
              </div>
               
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Description
                    <span class="help-block"><?php echo form_error('description'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <textarea type="text" class="row-fluid" rows="5" name="description" ><?php if(!empty($designs->description)) echo $designs->description; ?></textarea>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="normal-field">Categories
                       <br><small>You can select max 3 category.</small>
                       <span class="help-block"><?php echo form_error('category'); ?></span>
                    </label>
                    <div class="controls span9">
                          <div class="row-fluid">
                          <?php $c_no = 1; ?>
                          <?php if(!empty($designs->category)){
                            $cat_arr = unserialize($designs->category);
                           foreach ($design_category as $row): ?>
                            <?php if($c_no == 5): ?>
                              </div>
                              <div class="row-fluid">
                                <?php $c_no = 1; ?>
                            <?php endif ?>
                              <div class="span3"><input type="checkbox"  class="row-fluid" name="category[]" value="<?php echo $row->id; ?>" <?php if(in_array($row->id, $cat_arr)) echo "checked='checked'"; ?> > <?php echo ucfirst($row->category_name); ?></div>
                            <?php $c_no++; ?>
                          <?php endforeach?>
                          <?php }?>
                        </div>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="normal-field">Show on editor
                    </label>
                    <div class="controls span9">
                              <div class="row-fluid">
                              <div class="span3">
                              <input type="checkbox"  class="row-fluid" name="show_on_editor" 
                              <?php if($designs->show_on_editor)
                              echo"checked";?> value="1" ></div>
                        </div>
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

    <style type="text/css">
      div .checker{
        margin-top: 0px !important;
      }
      .input-opacity{
        opacity:40!important;
      }
    </style>

     <script type="text/javascript">
        $(document).ready(function () {
      
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
<div id="main_container">
    <div class="row-fluid ">     	
        <div class="span12">
       
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Add Page </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Page Name
                  <span class="help-block"><?php echo form_error('page_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('page_name'); ?>" id="title" class="row-fluid" name="page_name" placeholder="Page Name">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3">Page URL <span class="help-block"><?php echo form_error('slug'); ?></span> </label>
                  <div class="controls span9 ">
                      <span style="max-width:100%; width:auto;" class="add-on"><?php echo base_url() ?>store/pages/</span>
                      <input class="span4" id='slug' type="text" name="slug" value="<?php echo set_value('slug'); ?>" placeholder="">

                  </div>
                </div>


                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Sub Heading
                  <span class="help-block"><?php echo form_error('sub_header1'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('sub_header1'); ?>" class="row-fluid" name="sub_header1" placeholder="sub heading">
                  </div>
                </div>
              
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="editor1">Page Body
                  	<span class="help-block"><?php echo form_error('body'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea  id="" name="body" rows="10" class="tinymce_edittor"><?php echo set_value('body'); ?></textarea>                    
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

    <script type="text/javascript">
        $(document).ready(function () {
          $("#title,#slug").on('change keyup blur',function(){
            var stringToReplace = $(this).val().toLowerCase();
            stringToReplace = $.trim(stringToReplace);
            var desired = stringToReplace.replace(/[^a-zA-Z0-9\s-]/gi, '');
            desired = desired.replace(/[^a-zA-Z0-9-]/gi, '-');
            // desired = desired.replace(/[(+-|-+)]/gi, '-');
            $('#slug').val(desired);
          });
        });
    </script>
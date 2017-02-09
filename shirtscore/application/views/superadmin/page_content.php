
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

      

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span><?php echo $content->title; ?></span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="editor1">Page Content
                    <span class="help-block"><?php echo form_error('content'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea id="editor1" name="content" rows="12" class="row-fluid"><?php if(!empty($content->content)) echo $content->content; ?></textarea>                    
                  </div>
                </div>      
                <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Edit</button>                    
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
  $('#remove_image').click(function(){    
    $('#img').html('');
    $('#img').hide();
    // $.ajax({
    //         type: 'POST',            
    //         url: '<?php echo base_url() ?>superadmin/remove_page_image/<?php echo $pages->id; ?>',
    //         success: function(data){
    //             $('#img').hide();
    //         }
            
    //     });
  });
</script>
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
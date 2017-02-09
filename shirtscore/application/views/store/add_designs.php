<div class="container">
    <div class="dashcontent"> 
      <?php //echo validation_errors(); ?>         
      <div class="dashbox"><h2>Add new design</h2>
          <?php if($this->session->flashdata('error_msg')){ ?>
              <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
              </div>
          <?php } ?>
          <?php if(isset($success_msg)){ ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Success :</strong><br><?php echo $success_msg; ?>
              </div>
          <?php } ?>
          <?php echo form_open_multipart(base_url().'store/add_more_designs', array('id' => 'add-more-design')); ?>
          <div class="login_details">
                The Artist <span style="color:red" id="artist-error"></span><br />
                <input class="span5" type="text" id="artist" name="artist" value="<?php echo set_value('artist'); ?>"><br />
                Design Title <span style="color:red" id="design_title-error" ></span> <br />
                <input class="span5" type="text" id="design_title" name="design_title" value="<?php echo set_value('design_title'); ?>" /><br /> 
                Design Slug <span style="color:red" id="slug-error" ></span> <br />
                <input class="span5" type="text" id="slug" name="design_slug" value="<?php echo set_value('design_slug'); ?>" /><br />
                <span>Description <span style="color:red" id="description-error" ></span></span></span><br />
                <textarea class="span5" id="description" name="description"><?php echo set_value('description'); ?></textarea><br>
                <span>Category <span style="color:red" id="category-error"></span></span><br />
                <?php foreach ($category as $row): ?>
                    <input type="checkbox" class="categories" name="category[]" value="<?php echo $row->id; ?>"> <?php echo $row->category_name ?>
                <?php endforeach ?> <br />
          </div>
      </div>
    </div>
    <div class="clearfloat"></div>
    <div class="dashcontent">
        <div class="dashbox">
          <div class="dashicon">
          &nbsp;<i class="icon-upload-alt"></i>&nbsp;
          </div>
          <h2>Upload a Design</h2>
          <hr color="#ccc" />
          <h3>Guidelines and Restrictions for uploading designs</h3>
          <p><strong>You must read and agree to the following guidelines to continue.</strong></p>
          <p>You may not upload or sell merchandise using any image described below, unless you own the image and/or have a license or authorization to use such image. For more information please review the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
          <p><strong>NO UNOFFICIAL DESIGNS PERMITTED</strong> You can not use the names or images of people, celebrities, musicians, athletes, professional sports teams, trademarked logos, etc. without permission. <a href="#">Learn more...</a></p>
          <p><strong>NO TRADEMARK USE OF NAMES/LOGOS OF COMPANIES OR ORGANIZATIONS</strong> e.g., Microsoft, Pepsi, Green Peace. <a href="#">Learn more...</a></p>
          <p><strong>NO DOWNLOADED INTERNET CONTENT, IMAGES, GRAPHICS OR DESIGNS ARE PERMITTED WITHOUT AUTHORIZATION</strong> <a href="#">Learn more...</a></p>
          <p><input type="checkbox" id="i-declare" /> <span style="color:red" id="declare-error"></span><br>
           I declare that I have the right to use, market, distribute and sell the content I am uploading. I also declare that the content I am uploading complies with the Guidelines and Restrictions (above) as well as Shirtscore.com <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
           Choose Design image:<span style="color:red"><?php echo form_error('designfile'); ?></span><br />
           <input type="file" id="my_design" name="designfile" ><br><br>
           <input type="hidden" id="img_size_error" name="img_size_error" value="<?php echo strip_tags(form_error('designfile')); ?>" >
           <input type="submit" class="btn submit-form" name="save" id="add_design" value="Save" />
           <input type="hidden" name="design_count" value="<?php echo $design_count; ?>" />
           <?php $info = commission_info(); ?>
           <?php if($design_count <= $info->max_design): ?>
             <input type="submit" class="btn submit-form" name="add_more" id="add_more" value="Add More" />
           <?php endif; ?>
        </div>
    </div>
    <?php echo form_close(); ?>

    <!-- This is my store description..... -->

    <script type="text/javascript">//declare-error
      jQuery(document).ready(function() {
          // jQuery('#declare-error').hide();
          jQuery('.submit-form').click(function(){
              return check_validate();
          });
          function check_validate() {
              var valid = true;
              var error = '';
              var artist = jQuery('#artist').val();
              var design_title = jQuery('#design_title').val();
              var design_slug = jQuery('#slug').val();
              var description = jQuery('#description').val();
              var is_checked = jQuery("#i-declare").is(":checked");
              var categories = jQuery(".categories:checked").length;

              if (categories == 0)
              {
                valid = false;
                jQuery('#category-error').html(' * Select atleast 1 category.');
              }else{
                  if (categories > 3)
                  {
                    valid = false;
                    jQuery('#category-error').html(' * Select upto 3 categories only.');
                  }else
                      jQuery('#category-error').html('');
              }


              if (!is_checked)
              {
                valid = false;
                jQuery('#declare-error').html(' * Decalaration required.');
                // jQuery('#declare-error').show();
              }else
                  jQuery('#declare-error').html(''); 

              if (artist == '')
              {
                valid = false;
                jQuery('#artist-error').html(' * Required.');
              }else
                  jQuery('#artist-error').html(''); 

              if (design_title == '')
              {
                valid = false;
                jQuery('#design_title-error').html(' * Required.');
              }else
                  jQuery('#design_title-error').html('');

              if (design_slug == '')
              {
                valid = false;
                jQuery('#slug-error').html(' * Required.');
              }else{
                $.post(
                  "<?php echo base_url() ?>superadmin/ajax_check_slug/"+design_slug,       
                  function (data){
                    var obj = jQuery.parseJSON(data);
                      if(obj.status)
                        jQuery('#slug-error').html('');
                      else
                        jQuery('#slug-error').html(obj.msg);
                    }
                );
              }

              if (description == '')
              {
                valid = false;
                jQuery('#description-error').html(' * Required.');
              }else
                  jQuery('#description-error').html('');

              return valid; //valid;    
          }
      });
    </script>

     <script type="text/javascript">
        $(document).ready(function () {
          $("#design_title,#slug").on('change keyup blur',function(){
            var stringToReplace = $(this).val().toLowerCase();
            stringToReplace = $.trim(stringToReplace);
            var desired = stringToReplace.replace(/[^a-zA-Z0-9\s-]/gi, '');
            desired = desired.replace(/[^a-zA-Z0-9-]/gi, '-');
            $('#slug').val(desired);
          });
        });
    </script>
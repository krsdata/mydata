
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Edit category </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">category Name
                    <span class="help-block"><?php echo form_error('category'); ?></span>
                	</label>
                  <div class="controls span9">
                    <input type="text" id="title" class="row-fluid" name="category" value="<?php if(!empty($design_categories->category_name)) echo $design_categories->category_name; ?>" placeholder="Group Name">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Category Slug
                    <span class="help-block"><?php echo form_error('slug'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" id="slug" class="row-fluid" name="slug" value="<?php if(set_value('slug')){echo set_value('slug');}elseif(!empty($design_categories->slug)){echo $design_categories->slug;} ?>" placeholder="Category Slug">
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
          $('#slug').val(desired);
        });
      });
    </script>
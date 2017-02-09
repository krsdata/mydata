
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Edit Category </span> </h4>
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
                    <input type="text"  class="row-fluid" id="title" name="category" value="<?php if(!empty($categories->category_name)) echo ucfirst($categories->category_name); ?>" placeholder="Group Name">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Category Slug
                    <span class="help-block"><?php echo form_error('slug'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="slug" id="slug" value="<?php if(set_value('slug')){echo set_value('slug');}elseif(!empty($categories->slug)){echo $categories->slug;} ?>" placeholder="Category Slug">
                  </div>
                </div>

              <!--   <div class="form-row control-group row-fluid">
                   <label class="control-label span3" for="normal-field">Category Header
                        <span class="help-block"><?php echo form_error('userfile'); ?></span>
                   </label>
                   <?php if(!empty($categories->category_banner)): ?>
                    <div  class="controls span9" id="new_img" style="display:none;">
                        <input type="file" name="userfile" class="fileinput">
                    </div>   
                    <div class="controls span9" id="img">
                        <a style="float:right; color: #FFFFFF;" id="remove_img" href="javascript:void(0);"><span><i class="icon-edit"></i> Change </span></a><br>
                        <img src="<?php echo base_url().'/assets/uploads/category/'.$categories->category_banner; ?>">
                    </div>
                   <?php else: ?>
                      <div  class="controls span9">
                        <input type="file" name="userfile" class="fileinput">
                      </div> 
                   <?php endif ?>
                      <input type="file" name="userfile" class="fileinput"> -->
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

            jQuery("#remove_img").click(function() {
                jQuery("#img").hide(500);
                jQuery("#new_img").show(500);
                jQuery(".uploader").show(500);
            });
        });
    </script>
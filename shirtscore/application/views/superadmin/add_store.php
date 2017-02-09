
  
    <div id="main_container">
      <div class="row-fluid ">      

        <div class="span12">

       
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-home"></i> <span> Add store </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->
  <div class="content">
          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Select Admin
                    <span class="help-block"><?php echo form_error('admin_id'); ?></span>
                  </label>
                  <div class="controls span9">
                    <select name="admin_id" class="chzn-select">
                      <option value="">Select Admin</option>                     
                      <?php foreach ($store_admin as $row): ?>                  
                      <option value="<?php echo $row->id ?>" <?php if(set_value('admin_id') == $row->id){ echo 'selected="selected"';} ?> ><?php echo ucfirst($row->firstname)." ".ucfirst($row->lastname); ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Store Banner
                    <span class="help-block"><?php echo form_error('userfile'); ?></span>
                  </label>
                  <div class="controls span9">
                     <input type="file" name="userfile" class="fileinput">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Store Name
                    <span class="help-block"><?php echo form_error('store_name'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" id="title" value="<?php echo set_value('store_name'); ?>" class="row-fluid" name="store_name" placeholder="Store Name">
                  </div>
                </div>

                 <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="hint-field">Store Link 
                      <span class="help-block"><?php echo form_error('store_link'); ?></span> 
                    </label>
                    <div class="controls span9">
                      <input type="text" class="row-fluid" id="slug" name="store_link" value="<?php echo set_value('store_link'); ?>" placeholder="Store Link ">
                    </div>
                 </div>
                        
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Store Description
                    <span class="help-block"><?php echo form_error('store_description'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea id="desc" name="store_description" rows="5" class="row-fluid"><?php echo set_value('store_description'); ?></textarea> <br>
                     <span id="counter"></span>
                    <!-- <input type="text" class="row-fluid" name="store_description" placeholder="Address"> -->
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
    <!-- // <script type="text/javascript"> -->
   <!--  //   $(document).ready(function($)
    //   {
    //   }); -->
    <!-- // </script> -->

     <script type="text/javascript">
        $(document).ready(function () {
          $("#title,#slug").on('change keyup blur',function(){
            var stringToReplace = $(this).val().toLowerCase();
            stringToReplace = $.trim(stringToReplace);
            var desired = stringToReplace.replace(/[^a-zA-Z0-9\s-]/gi, '');
            desired = desired.replace(/[^a-zA-Z0-9-]/gi, '-');
            $('#slug').val(desired);
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
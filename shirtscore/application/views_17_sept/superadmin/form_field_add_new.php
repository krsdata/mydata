
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Add Form Field </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid','id'=>'build_form')); ?>             
                
              
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Field Label
                  <span class="help-block"><?php echo form_error('field_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('field_name'); ?>" class="row-fluid" name="field_name" placeholder="Field Label">
                  </div>
                </div>
                 <?php $type_array = field_array(); ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Field Type
                  <span class="help-block"><?php echo form_error('form_name'); ?></span>
                </label>
                  <div class="controls span9">
                   <select name="field_type">
                      <option value="" >Select Field Type</option>
                      <?php 
                      foreach ($type_array as $key => $value) 
                      {
                      ?>
                        <option class="f-type" value="<?php echo $key; ?>" <?php if(set_value('field_type') != '' && set_value('field_type') == $key){echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                 <?php
                $display = 'style="display:none;"';
                // echo "f-type = ".set_value('field_type');
                  if (set_value('field_type') == 5)
                  {
                     $display = 'style="display:block;"';
                  }
                ?>                                        
                <div class="form-row control-group row-fluid" id="sel-optn" <?php echo $display ?>>
                  <label class="control-label span3" for="with-placeholder">
                  	<span class="help-block"><?php echo form_error('field_type'); ?></span>
                  </label>
                  <div class="controls span9">                   
                    <input type="text" class="row-fluid" name="option" value="<?php echo set_value('option'); ?>" placeholder="Please enter options for select box seperated by ','(comma).">
                  </div>
                </div>    

                 <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="">Attributes
                      <span class="help-block"><?php echo form_error('attr_name') ?><br><?php echo form_error('attr_value') ?></span>
                    </label>
                    <div class="controls span9" style="margin-left:-2%">
                        <div class="controls span3" id="attr_name">

                           <label class="control-label" style="text-align:left !important" for="">Name</label>                 
                           <input class="row-fluid" type="text" name="attr_name[]" value=""><br>

                        </div>

                        <div class="controls span3" id="attr_value">

                           <label class="control-label" style="text-align:left !important" for="">Value</label>                 
                           <input class="row-fluid" type="text" name="attr_value[]" value="">
                        </div>
                    </div>
                  </div>
                     <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                   
                  </label>
                    <div class="controls span9">                    
                        <a id="add_more" class="row-fluid" href="javascript:void(0);" title="">(+) Add More</a>
                        <a style="display:none" id="remove_btn" class="row-fluid" href="javascript:void(0);" title="">(-) Remove</a>
                    </div>
                  </div>    
                
                    <?php //echo form_error('attr_name') ?>
                    <?php //echo form_error('attr_value') ?>
                  
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
        var count = $("#count").val();

          if (count > 0)
          {
             $("#remove_btn").attr("style","display:inline-block");
          };

          $("#add_more").click(function() {
              count++;
              var id = $(this).attr('id');
              /* add options */
              var newText1 = $(document.createElement('input')).attr({"class":"row-fluid", "name":'attr_name[]',"id":'name'+count,"type":"text","style":"margin-top:10px"});
              var newText2 = $(document.createElement('input')).attr({"class":"row-fluid", "name":'attr_value[]',"id":'value'+count,"type":"text", "style":"margin-top:10px"});
              newText1.appendTo("#attr_name");
              newText2.appendTo("#attr_value");
              // console.log(count);
              if (count > 0)
              {
                 $("#remove_btn").attr("style","display:inline-block");
              };

              $('#count').val(count);

          });
                           
            $("#remove_btn").on('click',function ()
            {
                var count = $("#count").val();
    
                //counter--;
                $("#name" + count).remove();
                $("#value" + count).remove();
                // $(this).remove();
                count--;

                if (count == 0)
                {
                    $("#remove_btn").attr("style","display:none");
                };

                $('#count').val(count);
           });

            $(".fld_slct").on('click',function ()
            {
              var id = $(this).attr('id');

              var value = $(this).val();

              var check = $(this).is(':checked');
              
              var req = 0;
              if (check)
              {

                $("#field_box" + id).val('get_field('+value+');');

              }
              else
              {
                $("#field_box" + id).val('');                
              }

            });

            
            $('.req').on('click',function ()
            {
              var id = $(this).attr('ids');
              var value = $('#' + id).is(':checked');
              if (!value) 
              {
                var id = $(this).attr('checked',false);
                $(this).val(0);
                alert('Please Select a field');
              }
              else
              {

                $("#field_box" + id).val('get_field('+id+');');

                $(this).val(1);
              }
            });
           
            
            $('.f-type').on('click',function ()
            {
              
              var val = $(this).val();

              if(val == 5)
              {
                
                $('#sel-optn').show();

              }
              else
              {
                $('#sel-optn').hide();
              }
              
            });
    </script>
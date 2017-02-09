
    <div id="main_container">
      <div class="row-fluid ">      

        <div class="span12">

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Add Form </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid','id'=>'build_form')); ?>             
                
              
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Form Name
                  <span class="help-block"><?php echo form_error('form_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  value="<?php echo $forms->form_name ?>" class="row-fluid" name="form_name" placeholder="Form name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Form Action
                  <span class="help-block"><?php echo form_error('form_action'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"value="<?php echo $forms->form_action ?>" class="row-fluid" name="form_action" placeholder="Form Action">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input"></label>
                  <div class="controls span9">
                    <table id="datatable_example" class="responsive table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="75%">Choose Field</th>
                      <th width="25%">Field Required?</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $selected = unserialize($forms->fields);
                    $sel_fields = array();
                    $sel_req = array();

                    if (!empty($selected))
                    {
                      foreach ($selected as $key => $value)
                      {
                        $sel_fields[$key] = 'checked="checked"';
                        $sel_req[$key] = $value;
                        
                      }
                    }
                    if ($fields): ?>
                      <?php $i=1; $k=0; $value=0;
                      foreach ($fields as $row): ?>
                        <tr>
                          <td><input class="fld_slct" id="<?php echo $i; ?>" type="checkbox" name="fields[]" value="<?php echo $row->id; ?>" <?php if(!empty($sel_fields) && element($row->id, $sel_fields)){echo 'checked="checked"';} ?> > <?php echo $row->field_name; ?></td>
                          <td><input type="checkbox" name="required[]" class="req" ids="<?php echo $i; ?>" <?php if(!empty($sel_req) && isset($sel_req[$row->id])){if($sel_req[$row->id] == 1){echo 'checked="checked"'; $value=1;}} ?> value="<?php echo $value;?>"></td>
                        </tr>
                        <tr>
                          <td width="75%"></td>
                          <td width="25%"><?php echo form_error('fields') ?></td>
                        </tr>
                      <?php $k++; $i++; endforeach ?>
                     <?php else:?>
                        <tr class="error">
                          <td  width="75%">&nbsp;</td>
                          <td width="25" >No Fields available for use. Please create more</td>
                        </tr>
                        <tr>
                          <td width="75%"></td>
                          <td width="25%"><?php echo form_error('fields') ?></td>
                        </tr>
                    <?php endif; ?>
                  </tbody>
                  </table>
                 </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Form Content
                    <span class="help-block"><?php echo form_error('store_description'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="form_content" id="" rows="5" class="row-fluid">
                      <?php
                      if (!empty($forms->form_content))
                        {
                          echo htmlentities($forms->form_content);
                        }
                      else
                      {
                        ?>
                        <p>
                          Label (required)
                          Field 
                        </p>
                        <p>
                          Label (required)
                          Field
                        </p> 
                        <?php
                      }
                      ?>
                     </textarea>
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

    <script type="text/javascript">
    $(document).ready(function() {  
    $('input[name="fields[]"]').change(function(){
     
      $.post('<?php echo base_url()?>superadmin/build_form/', $('#build_form').serialize(), function(data ) {
         // alert(data);        
         $('textarea[name="form_content"]').html(data);
      });
    });
});
    </script>
    
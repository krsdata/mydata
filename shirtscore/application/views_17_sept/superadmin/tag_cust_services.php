
  
    <div id="main_container">
      <div class="row-fluid ">      

        <div class="span12">

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Tag Customer Service </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->
  <div class="content">
          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Select Customer service
                    <span class="help-block"><?php echo form_error('cust_service_id'); ?></span>
                  </label>
                  <div class="controls span9">
                    <select name="cust_service_id" class="chzn-select">
                      <option value="">Customer Service</option>                     
                      <?php foreach ($cust_services as $row): ?>                  
                      <option value="<?php echo $row->id ?>" <?php if(set_value('cust_service_id') == $row->id){ echo 'selected="selected"';} ?> ><?php echo ucfirst($row->firstname)." ".ucfirst($row->lastname); ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input"> Excerpt
                    <span class="help-block"><?php echo form_error('excerpt'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" value="<?php echo set_value('excerpt'); ?>" class="row-fluid" name="excerpt" placeholder="Excerpt">
                  </div>
                </div>
                        
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder"> Description
                    <span class="help-block"><?php echo form_error('description'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="description" rows="5" class="row-fluid"><?php echo set_value('description'); ?></textarea>
                    <!-- <input type="text" class="row-fluid" name="store_description" placeholder="Address"> -->
                  </div>
                </div>      
                <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <input type="hidden" name="support_ids" value='<?php echo json_encode($queries); ?>'>
                    <input type="submit" name="add_tag" value="Add Tag" class="btn btn-primary">                    
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
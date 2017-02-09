 <div id="main_container">    
 

    
    <div class="row" style="margin-bottom:10px">
    </div>

        <?php echo form_open(base_url().'superadmin/order_messages', array('class'=>'form-horizontal row-fluid')); ?> 
         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Messages </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
                <br>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span2" for="country-input">Subject
                    <span class="help-block"><?php echo form_error('sub'); ?></span>
                  </label>
                  <div class="controls span6">
                    <input type="text" value="<?php echo set_value('sub'); ?>" class="row-fluid" name="sub" placeholder="Subject">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span2" for="country-input">Message
                    <span class="help-block"><?php echo form_error('message'); ?></span>
                  </label>
                  <div class="controls span6">
                    <textarea class="row-fluid" name="message" rows="10"><?php echo set_value('message'); ?></textarea>
                  </div>
                </div>

                <div class="row-fluid">
                  <div class="span2">
                    <input type="hidden" name="buyers_ids" value='<?php echo json_encode($buyers_ids); ?>'>
                    <input type="submit" name="send" value="Send" class="btn btn-primary">
                  </div>
                </div>
           <!--  <div class="row">
               <input type="submit" value="Send" class="btn btn-info" style="background-color:#333333;">
            </div> -->
            </div>
            <!-- End row-fluid --> 
            <?php echo form_close(); ?> 
          </div>
          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
    </div>  
    <style type="text/css">
    #datatable_example tbody tr td a{
      color: white;
    }
    </style>
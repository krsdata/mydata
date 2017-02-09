
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Add Coupon </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Coupon Name
                  <span class="help-block"><?php echo form_error('name'); ?></span>
                </label>
                  <div class="controls span3">
                    <input type="text"  class="row-fluid" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Coupon Code
                  <span class="help-block"><?php echo form_error('coupon_code'); ?></span>
                </label>
                  <div class="controls span3">
                    <input type="text"  class="row-fluid" name="coupon_code" value="<?php echo set_value('coupon_code'); ?>" placeholder="Coupon Code">
                  </div>
                </div>    

                 <div class="form-row control-group row-fluid">
                  <input id="currentDate" name="currentDate" type="hidden" value="<?php echo date('m-d-Y'); ?>">
                  <label class="control-label span3" for="normal-field">Start Date
                    <span class="help-block"><?php echo form_error('start_date'); ?></span>
                  </label>
                  <div class="controls span3">
                    <div class="input-append date" id="datepicker" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="d-m-yyyy">
                      <input class="span10" readonly='readonly' id="start_c_date" name="start_date" size="16" type="text" value="<?php echo date('d-m-Y'); ?>">
                      <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <!-- <input type="text" id="start_date" name="start_date" value="<?php // echo date('m/d/Y'); ?>" readonly='readonly'  class="row-fluid"> -->
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">End Date
                    <span class="help-block"><?php echo form_error('end_date'); ?></span>
                  </label>
                  <div class="controls span3">
                    <div class="input-append date" id="datepicker2" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="d-m-yyyy">
                      <input class="span10" readonly='readonly' id="end_c_date" name="end_date" size="16" type="text" value="<?php echo date('d-m-Y'); ?>">
                      <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <!-- <input type="text" id="end_date" name="end_date" value="<?php //echo date('m/d/Y'); ?>" readonly='readonly'  class="row-fluid"> -->
                  </div>
                </div>
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Amount Type
                  <span class="help-block"><?php echo form_error('type'); ?></span>
                </label>
                  <div class="controls span3">
                    <select class="chzn-select" name="type">
                      <option value="">Please Select</option>
                      <option <?php echo set_select('type', '1'); ?> value="1">Percent</option>
                      <option <?php echo set_select('type', '2'); ?> value="2">Amount</option>
                    </select>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Amount <?php //echo money_symbol(); ?>
                  <span class="help-block"><?php echo form_error('amount'); ?></span>
                </label>
                  <div class="controls span3">
                    <input type="text" id="amount" name="amount" value="<?php echo set_value('amount') ?>"  class="row-fluid">
                  </div>
                </div>

                <?php
                    $sgl="";
                    $mlt="";
                    $display="display:none;";
                    if (set_value('discount_use')) {
                      if(set_value('discount_use') == 1)
                        $sgl="selected = selected";
                      elseif (set_value('discount_use') == 2) {
                        $mlt="selected = selected";
                        $display = "display:block;";
                      }

                      
                    }
                ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Discount Use
                    <span class="help-block"><?php echo form_error('discount_use'); ?></span>
                  </label>
                  <div class="controls span3">
                    <select id="use-type" class="chzn-select" name="discount_use">
                      <option value="">Please Select</option>
                      <option <?php echo $sgl; ?> value="1">Single Use</option>
                      <option <?php echo $mlt; ?> value="2">Multi Use</option>
                    </select>
                  </div>
                </div>
                <div id="max_use" class="form-row control-group row-fluid" style="<?php echo $display; ?>">
                  <label class="control-label span3" for="normal-field">Max No. Of Use
                    <span class="help-block"><?php echo form_error('max_use'); ?></span>
                  </label>
                  <div class="controls span3">
                    <input type="text" name="max_use" value="<?php echo set_value('max_use') ?>"  class="row-fluid">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9">
                    <button type="submit" class="btn">Submit</button>                    
                  </div>
                </div>             

               <!--  <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Submit</button>                    
                  </div>
                </div> -->
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
    $('#use-type').change(function () {
      var type = $(this).val();
      if (type == '2'){
        $('#max_use').show();
      }else{
        $('#max_use').hide();
      };
      
    });
 });
</script>
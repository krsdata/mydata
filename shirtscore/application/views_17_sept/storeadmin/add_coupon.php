<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">

        	<?php if($this->session->flashdata('success_msg')){ ?>
		    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
			</div>
			<?php } ?>
            <div class="title">
              <h4><span> Add Coupon </span> </h4>
            </div>
            <!-- End .title -->
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid','id'=>'add_product')); ?> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Coupon Name
                  <span class="help-block"><?php echo form_error('name'); ?></span>
                </label>
                  <div class="controls span3">
                    <input type="text"  class="row-fluid" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name">
                  </div>
                </div>  

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Start Date
                  <span class="help-block"><?php echo form_error('start_date'); ?></span>
                </label>
                  <div class="controls span3">
                    <div class="input-append date" id="datepicker" data-date="<?php echo date('m-d-Y'); ?>" data-date-format="mm-dd-yyyy">
                    <input class="span10" readonly='readonly' name="start_date" size="16" type="text" value="<?php echo date('m-d-Y'); ?>">
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
                     <div class="input-append date" id="datepicker2" data-date="<?php echo date('m-d-Y'); ?>" data-date-format="mm-dd-yyyy">
                    <input class="span10" readonly='readonly' name="end_date" size="16" type="text" value="<?php echo date('m-d-Y'); ?>">
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
                      <option value="1">Percent</option>
                      <option value="2">Amount</option>
                    </select>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Amount <?php echo money_symbol(); ?>
                  <span class="help-block"><?php echo form_error('amount'); ?></span>
                </label>
                  <div class="controls span3">
                    <input type="text" id="amount" name="amount" value="<?php echo set_value('amount') ?>"  class="row-fluid">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Discount Use
                    <span class="help-block"><?php echo form_error('discount_use'); ?></span>
                  </label>
                  <div class="controls span3">
                    <select class="chzn-select" name="discount_use">
                      <option value="">Please Select</option>
                      <option value="1">Single Use</option>
                      <option value="2">Multi Use</option>
                    </select>
                  </div>
                </div>


                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9">
                    <button type="submit" class="btn">Submit</button>                    
                  </div>
                </div>             
            <?php echo form_close(); ?>
             </div>
      </div>      
    </div>
  </div>
  <style type="text/css">
  .help-block{
    color: red;
  }
</style>

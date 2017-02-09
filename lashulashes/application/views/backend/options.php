    <div class="page-content-wrapper">
        <div class="page-content">

            <div class="clearfix">
            </div>
            <div class="row">
            
              <div class="col-md-12 ">
                  <?php echo msg_alert_backend(); ?>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                        <i class="fa fa-gear"></i>Option Settings </div>
                              <div class="tools">
                        <a href="" class="collapse">
                        </a></div>
                    </div>

                    <div class="portlet-body form">
                        <form action="<?php echo base_url('backend/optionsettings/index'); ?>" method="post" class ="form-horizontal"> 
                              <?php //echo form_open(base_url('backend/optionsettings/index'), array('class' => 'form-horizontal')); ?>
                              <div class="form-body">
                                        <input type="hidden" name="abc" value="123" placeholder="">
                                        <?php //echo validation_errors(); ?>

                                           <div class="form-body">
                                                <?php if (!empty($options)): ?>

                                                      <?php foreach ($options as $row): ?>
                                                        <div class="form-group">
                                                         <label class="col-md-3 control-label"><?php echo $row->option_name ?><span class="error">*</span></label>
                                                         <div class="col-md-8">
                                                            <?php if($row->id==11) { ?>
                                                                  <textarea name="<?php echo trim($row->option_name) ?>" placeholder="Enter short about us" class="form-control" rows="5"><?php echo $row->option_value?></textarea>
                                                            <?php }else{ ?>
                                                            <input type="text" name="<?php echo trim($row->option_name) ?>" placeholder="<?php echo $row->option_name ?>" class="form-control"  value="<?php echo $row->option_value?>">
                                                            <?php } ?>
                                                            <?php echo form_error(trim($row->option_name)); ?>
                                                         </div>
                                                      </div>
                                                      <?php endforeach ?>
                                                <?php endif ?>
                                           </div>
                              </div> <!--form-body -->
                              <div class="form-actions">
                                <button type="submit" class="btn green">Update</button>
                              </div>
                        </form>
                   </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

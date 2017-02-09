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
              <h4><span>Coupon Details </span> </h4>
            </div>
            <!-- End .title -->
				  <?php if($coupon){ ?>
           <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Code                 
                </label>
                  <div class="controls span9">
                   <?php if(!empty($coupon->code)) echo $coupon->code ?>
                  </div>
              </div>
              <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Coupon Name                 
              	</label>
                  <div class="controls span9">
                   <?php if(!empty($coupon->name)) echo $coupon->name ?>
                  </div>
              </div>
              <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Start Date                 
                </label>
                  <div class="controls span9">
                   <?php if(!empty($coupon->start_date)) echo date('m/d/Y', strtotime($coupon->start_date)); ?>
                  </div>
              </div>
              <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">End Date 
                </label>
                  <div class="controls span9">
                   <?php if(!empty($coupon->end_date)) echo date('m/d/Y', strtotime($coupon->end_date)); ?>
                  </div>
              </div>
              <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Amount                 
                </label>
                  <div class="controls span9">
              <?php if ($coupon->reduction_type == 1): ?>                
                   <?php if(!empty($coupon->reduction_amount)) echo $coupon->reduction_amount."%"; ?>
                 <?php else: ?>
                 <?php if(!empty($coupon->reduction_amount)) echo "$".$coupon->reduction_amount; ?>
              <?php endif; ?>
                  </div>
              </div>
               <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Status                 
                </label>
                  <div class="controls span9">
              <?php if ($coupon->status == 1): ?>                
                   <?php echo 'Enabled'; ?>
                 <?php else: ?>
                 <?php echo "Disabled"; ?>
              <?php endif; ?>
                  </div>
              </div>
          <?php }else{ ?>
			

                <div class="form-row control-group row-fluid">                 
                  <div class="controls span9">
 					<label class="control-label span9"> NO Coupon Found.	</label>
                  </div>
                </div> 
				<?php } ?>
        </div>
      </div>      
    </div>
  </div>
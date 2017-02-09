   <div id="main_container">
      <div class="row-fluid ">      

        <div class="span12">

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class="icon-reorder"></i> <span> Coupon Details </span> </h4>
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
             <!--  -->

            <!-- End row-fluid --> 
          </div>
          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
    </div>

    <style type="text/css">
      .form-row{
        padding-left:5%;
        padding-top:1%;
      }
    </style>
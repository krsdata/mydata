   <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class="icon-reorder"></i> <span> View Note </span> </h4>
            </div>
            <!-- End .title -->    
				  <div class="content">
  				  <?php if($order_note){ ?>
             <div class="form-row control-group row-fluid">
                 <label class="control-label span3" for="normal-field">Title
                 </label>
                 <div class="controls span9">
                   <?php if(!empty($order_note->title)) echo $order_note->title; ?>
                 </div>
              </div>

              <div class="form-row control-group row-fluid">
                 <label class="control-label span3" for="normal-field">Note 
                 </label>
                 <div class="controls span9">
                   <?php if(!empty($order_note->note)) echo $order_note->note; ?>
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
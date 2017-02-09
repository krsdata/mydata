   <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class="icon-reorder"></i> <span>Message Detail </span> </h4>
            </div>
            <!-- End .title -->
				 <!--  -->          
				    <div class="content">
                  <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="normal-field">Sent to                
                    </label>
                      <div class="controls span9">
                       <?php if(!empty($msg->name)) echo $msg->name; ?>
                      </div>
                  </div>
                  <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="normal-field">Sent at                 
                    </label>
                      <div class="controls span9">
                       <?php if(!empty($msg->email)) echo $msg->email; ?>
                      </div>
                  </div>
                  <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="normal-field">Subject                 
                    </label>
                      <div class="controls span9">
                       <?php if(!empty($msg->subject)) echo $msg->subject; ?>
                      </div>
                  </div>
                  <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="normal-field">Message                 
                    </label>
                      <div class="controls span9">
                       <?php if(!empty($msg->message)) echo $msg->message; ?>
                      </div>
                  </div>

                  <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="normal-field">Sent On                 
                    </label>
                      <div class="controls span9">
                       <?php if(!empty($msg->created)) echo $msg->created; ?>
                      </div>
                  </div>
            </div>
            <!--  -->
            <!-- End row-fluid --> 
          </div>
          </div>
          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
    </div>
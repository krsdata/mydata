     <?php if (!empty($product->main_image)): ?>
        <?php 
            $main_image  = getimagesize(base_url().'assets/uploads/products/'.$product->main_image);
        ?>
     <?php endif ?>
     <?php if (!empty($product->back_image)): ?>
       <?php 
            $back_image  = getimagesize(base_url().'assets/uploads/products/'.$product->back_image);
       ?>
     <?php endif ?>
        <style type="text/css">
          #photo{
              width: <?php echo $main_image[0]."px"; ?>;
              height: <?php echo $main_image[1]."px"; ?>;
              background-image:url(<?php echo base_url().'assets/uploads/products/'.$product->main_image; ?>);
          }

          #photo1{
              width: <?php echo $back_image[0]."px"; ?>;
              height: <?php echo $back_image[1]."px"; ?>;
              background-image:url(<?php echo base_url().'assets/uploads/products/'.$product->back_image; ?>);
          }
       </style>

    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-money"></i> <span> Select Printed Area </span> </h4>
            </div>
            <!-- End .title -->
           <!--  -->          
            <div class="content">
      				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>
                    <?php echo validation_errors(); ?>

                    <!-- Add restriction -->
                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="search-input">Select main image area</label>
                      <div class="controls span9">
                          <div id="containment-wrapper">
                              <div id="photo" class="product-img">
                              </div>
                          </div>
                          <input type="hidden" id="f_top" name="f_top" value="0" />
                          <input type="hidden" id="f_left" name="f_left" value="0" />
                          <input type="hidden" id="f_width" name="f_width" value="0" />
                          <input type="hidden" id="f_height" name="f_height" value="0" />
                      </div>
                    </div>

                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="search-input">Select back image area</label>
                      <div class="controls span9">
                          <div id="containment-wrapper1">
                              <div id="photo1" class="product-img">
                              </div>
                          </div>
                          <input type="hidden" id="b_top" name="b_top" value="0" />
                          <input type="hidden" id="b_left" name="b_left" value="0" />
                          <input type="hidden" id="b_width" name="b_width" value="0" />
                          <input type="hidden" id="b_height" name="b_height" value="0" />
                      </div>
                    </div>
                    <!-- Add restriction -->

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
        $(document).ready(function () {

            $('#photo').imgAreaSelect({ maxWidth: 295, maxHeight: 425, handles: true, onSelectEnd: function (img, selection) {
                      var x1 = selection.x1;
                      var y1 = selection.y1;
                      var x2 = selection.x2;
                      var y2 = selection.y2;
                      var h = y2 - y1;
                      var w = x2 - x1;
                      // $("#log").text( "X1: " + x1 + ", Y1: " + y1 + "X2: " + x2 + ", Y2: " + y2 + " <br> Widht = " + w + "Height " + h  );
                      $( "#f_left" ).val(x1);
                      $( "#f_top" ).val(y1);
                      $( "#f_width" ).val(w);
                      $( "#f_height" ).val(h);
                  } 
            });

            $('#photo1').imgAreaSelect({ maxWidth: 295, maxHeight: 425, handles: true, onSelectEnd: function (img, selection) {
                      var x1 = selection.x1;
                      var y1 = selection.y1;
                      var x2 = selection.x2;
                      var y2 = selection.y2;
                      var h = y2 - y1;
                      var w = x2 - x1;
                      // $("#log").text( "X1: " + x1 + ", Y1: " + y1 + "X2: " + x2 + ", Y2: " + y2 + " <br> Widht = " + w + "Height " + h  );
                      $( "#b_left" ).val(x1);
                      $( "#b_top" ).val(y1);
                      $( "#b_width" ).val(w);
                      $( "#b_height" ).val(h);
                  } 
            });
        });
    </script>
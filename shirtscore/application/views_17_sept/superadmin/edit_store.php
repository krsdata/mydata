
    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

    

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Edit store </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">

  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                <div class="form-row control-group row-fluid">
                
                <?php if($called != 'pending_stores') { ?>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Select Admin
                   <span class="help-block"><?php echo form_error('admin_id'); ?></span>
                  </label>
                  <div class="controls span9"><a class="btn btn-info"  href="<?php echo base_url().'superadmin/admin_details/'.$store->user_id;?>" target="_blank"><?php echo $store->firstname.' '.$store->lastname; ?></a>
                   
                  </div>
                </div>

                <?php } ?>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Store Banner
                    <span class="help-block"><?php echo form_error('userfile'); ?></span>
                  </label>
                  <div class="controls span9">
                     <input type="file" name="userfile" class="fileinput">
                  </div>
                </div>

               <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Banner Image</label>
                  <div class="controls span9">
                    <span id="img">
                      <?php if(!empty($store->store_banner)): ?>      
                      <img src="<?php echo base_url() ?>assets/uploads/store/<?php echo $store->store_banner; ?>">
                      <!-- <a href="javascript:void(0)" id="remove_image"><span style="float:right; color:red" >Remove</span></a> -->
                      <?php endif; ?>
                    
                    </span>
                  </div>
               </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Store Name
                  <span class="help-block"><?php echo form_error('store_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" id="title" value="<?php if(!empty($store)) echo $store->store_name; ?>" class="row-fluid" name="store_name" placeholder="store_name">
                  </div>
                </div> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Store Link
                    <span class="help-block"><?php echo form_error('store_link'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" id="slug" class="row-fluid" name="store_link" value="<?php if(!empty($store->store_link)) echo $store->store_link; ?>" placeholder="Store Link ">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Store Description
                  	<span class="help-block"><?php echo form_error('store_description'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea name="store_description" id="desc" rows="5" class="row-fluid"><?php if(!empty($store)) echo $store->store_description; ?></textarea> <br>
                    <span id="counter"></span>
                    <!-- <input type="text" class="row-fluid" name="store_description" placeholder="Address"> -->
                  </div>
                </div>      
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
      $('#remove_image').click(function(){    
        $('#img').html('');
        $('#img').hide();
        // $.ajax({
        //         type: 'POST',            
        //         url: '<?php echo base_url() ?>superadmin/remove_image/<?php echo $store->id; ?>',
        //         success: function(data){
        //             $('#img').hide();
        //         }
                
        //     });


      });
</script>
 <script type="text/javascript">
      $(document).ready(function($)
      {
        $("#upload-banner").click(function () {
          $(".uploader").attr("style", "display: block");
          $(".checker").attr("style", "display: block");
          $("#banner-id").attr("style", "opacity: 1;");
          $("#i_declare").attr("style", "opacity: 1;");
        });

         $("#i_declare").click(function(){
            var status = $(this).attr("checked") ? "checked" : false;

            if(status){
              $("span").addClass("checked");
              $("#i_declare").prop("checked", true);
              $("#banner-id").attr("disabled", false);
            }
            else{
              $("span").removeClass("checked");
              $("#i_declare").prop("checked", false);
              $("#banner-id").attr("disabled", "disabled");
            }
         });
      });
    </script>
     <script type="text/javascript">
        $(document).ready(function () {
          $("#title,#slug").on('change keyup blur',function(){
            var stringToReplace = $(this).val().toLowerCase();
            stringToReplace = $.trim(stringToReplace);
            var desired = stringToReplace.replace(/[^a-zA-Z0-9\s-]/gi, '');
            desired = desired.replace(/[^a-zA-Z0-9-]/gi, '-');
            $('#slug').val(desired);
          });

          function count(){
              var txtVal = $('#desc').val();
              var chars = txtVal.length;
              if (chars >= 300)
              {
                txtVal = txtVal.substring(0,300);
                $('#desc').val(txtVal);
                var chars = txtVal.length;
              };
              var words = txtVal.trim().replace(/\s+/gi, ' ').split(' ').length;
              if(chars===0){words=0;}
              $('#counter').html('<br>'+words+' words and '+ chars +' characters');
          }
          
          count();

          $('#desc').on('keyup propertychange paste', function(){
              count();
          });
          
        });
    </script>
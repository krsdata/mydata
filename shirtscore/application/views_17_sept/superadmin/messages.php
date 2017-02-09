 <div id="main_container">    
        
    
    <div class="row" style="margin-bottom:10px">
    </div>
        <?php echo form_open(current_url(), array('class'=>'form-horizontal row-fluid')); ?> 

         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Messages </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
                <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                  <thead>
                    <tr>
                      <th class="no_sort"><input type="checkbox" value="1" name="all_admins" id="check_all"></th>
                      <th>First name</th>     
                      <th>Last name</th> 
                      <th>User Role</th>     
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if($store_admins){ $i = $offset; foreach($store_admins as $row){ ?> 
                  <tr>
                  <td><input type="checkbox" name="admin_id[]" value="<?php echo  $row->id;?>" class="check_1"></td>
                  <td><?php echo ucfirst($row->firstname) ?></td>
                  <td><?php echo ucfirst($row->lastname) ?></td>
                  <td><?php if($row->is_storeadmin == 1) echo 'Store admin'; else echo 'User';   ?></td>
                  <td><a class="btn" href="<?php echo base_url() ?>superadmin/emailtostore_admin/<?php echo $row->id ?>"><?php echo $row->email; ?></a></td>
                </tr>
                    
                <?php $i++; } } else { ?>
                <tr>
                  <td colspan="7" style="text-align: center;font-style: italic;"><h3>No Records found yet</h3></td>
                </tr>
                <?php } ?>  
              
                  </tbody>
                </table>
                <br>
                <div class="row-fluid ">           
                  <div class="span12">
                    <div class="pagination pull-right ">
                     <?php echo $pagination; ?>
                    </div >
                  </div>
                </div>
                <br>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span2" for="country-input">Subject
                    <span class="help-block"><?php echo form_error('subject'); ?></span>
                  </label>
                  <div class="controls span6">
                    <input type="text" value="<?php echo set_value('subject'); ?>" class="row-fluid" name="subject" placeholder="Subject">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span2" for="country-input">Message
                    <span class="help-block"><?php echo form_error('message'); ?></span>
                  </label>
                  <div class="controls span6">
                    <textarea class="row-fluid" name="message" placeholder="Message" rows="10"><?php echo set_value('message'); ?></textarea>
                  </div>
                </div>
                  
                <div class="row-fluid">
                  <div class="span2">
                    <button id="send" type="submit" class="btn btn-primary">Send</button>                    
                  </div>
                </div>
           <!--  <div class="row">
               <input type="submit" value="Send" class="btn btn-info" style="background-color:#333333;">
            </div> -->
            <?php echo form_close(); ?> 

            </div>
            <!-- End row-fluid --> 
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

    <script type="text/javascript">
        $("#check_all").change(function(){
          var status = $(this).attr("checked") ? "checked" : false;
          if(status)
          {
           $('.checker span').addClass("checked");
           $('.check_1').attr("checked",true);
          }
          else
          {
           $('.checker span').removeClass("checked");
           $('.check_1').attr("checked",false);
          }
        });

         $("#send").click(function(e){
          var count_check = 0;
          $(".check_1" ).each(function( index ) {
            var status = $(this).attr("checked") ? "checked" : false;
            if(status)
              count_check++;
          });

          if(count_check > 0){
            return true;
          }else{
            alert('Please Select to whom you want to send message.');
            return false;
          }
        });
    </script>
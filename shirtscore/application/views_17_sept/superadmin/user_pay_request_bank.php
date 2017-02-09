 <div id="main_container"> 
    <div class="row" style="margin-bottom:10px">
         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Payment To Direct Bank Transfer Users</span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <?php echo form_open(base_url().'superadmin/pay_to_users_cheque_bank/1'); ?>
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th style="vertical-align: top;">#</th>
                    <th style="vertical-align: top;">User</th> 
                    <th style="vertical-align: top;width:35%">
                    Account Number<br>
                    Account Holder<br>
                    Bank Name<br>
                    Account Type<br>
                    Routing Number<br>
                    </th>    
                    <th style="vertical-align: top;">Balance Amount<br> Requested</th>
                    <th style="vertical-align: top;">Commission <br>Earned</th>      
                    <th style="vertical-align: top;">Requested On</th>
                    <th style="vertical-align: top;">Pay to all <br><br><input type="checkbox" name="check_all" id="check_all" ></th>
                  </tr>
                </thead>
                <tbody>
                <?php if($pay_request){ $i = $offset; foreach($pay_request as $row){ ?> 
                <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row->firstname.' '.$row->lastname ?></td>
                <td>
                 <?php echo  $row->acc_no?><br>
                 <?php echo  $row->acc_holder?><br>
                 <?php echo  $row->bank_name?><br>
                 <?php $info=$row->acc_type;
                    if($info==1)
                      {
                        echo"Saving";
                        }
                        else{
                        echo"Checking";
                          }?> Account<br>
                  <?php echo  $row->routing_no?>
                </td>
               
               
                <td>$<?php echo number_format($row->unpaid_com, 2); ?></td>
                <td>$<?php echo number_format($row->total_paid_com, 2); ?></td>
                <td>
                  <?php echo $row->request_date; ?>
                </td>
                <td>
                  <?php if ($row->pay_status == 0){ ?>
                      <div class="btn-group">
                          <input type="checkbox" class="all_user" name="user_id[]" value="<?php echo $row->userid; ?>" >
                          <!-- <a href="<?php //echo base_url().'superadmin/pay_to_user/'.$row->userid; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Pay Commission"> Pay </a> -->
                      </div>
                      <?php }else{ ?>
                        Paid
                      <?php } ?>        
                </td>     
              </tr>
                <?php $i++; } ?>
                <?php  } else { ?>
                <tr>
                  <td colspan="7" style="text-align: center;font-style: italic;"><h3>No Requests found.</h3></td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
              <br><br>
              <div class="row-fluid ">
                <div class="span3">
                  <button id="pay_now" type="submit" class="btn">Mark as Paid</button>
                </div>
             <?php echo form_close(); ?>
                <div class="span9">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
              </div>

               <div class="row-fluid" style="margin:1%">
              <h2>Export Orders</h2><br>
              <?php echo form_open(base_url().'export/export_bank'); ?>
             <!--  <input type="hidden" name="type" value="superadmin">
              <span style="margin-left:5%" class="inline radio"><input type="radio" name="export_file_format" value="csv">CSV</span>
              <span class="inline radio" style="margin-left:1%"><input type="radio" name="export_file_format" value="excel">Excel</span> -->
              <span class="inline radio" style="margin-left:1%"><input type="radio" name="export_file_format" checked="checked" value="pdf">PDF</span>
              <br><br>
              <span style="margin-left:5%;"><input type="submit" value="Export" class="btn-info btn">
              <?php echo form_close(); ?>
            </div> 

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
    .th{
      
    }
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#check_all").change(function(){
                var status = $(this).prop("checked") ? true : false;
                // alert(status);
                if(status){
                  $("div.checker span").addClass("checked");
                  $(".all_user").prop("checked", true);
                }
                else{
                  $("div.checker span").removeClass("checked");
                  $(".all_user").prop("checked", false);
                }
            });

            $("#pay_now").click(function(e){
              var count_check = 0;
              $(".all_user" ).each(function( index ) {
                var status = $(this).attr("checked") ? "checked" : false;
                if(status)
                  count_check++;
              });

              if(count_check > 0){
                return true;
              }else{
                alert('Select at least one user to proceed.');
                return false;
              }
            });
        });
    </script>


 <div id="main_container">    
      

    
    <div class="row" style="margin-bottom:10px">
         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user"></i> <span>Commission Pay Requests </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
               <tr>
               <td colspan="6">
               <div class="controls span9">
               Filter by Payments Modes :  
                <a href="<?php echo base_url().'superadmin/paypal_users'; ?>" class="btn btn-small btn-info" rel="tooltip" data-placement="top" data-original-title="Pay With Paypal">Paypal</a>
                <a href="<?php echo base_url().'superadmin/user_pay_request_bank'; ?>" class="btn btn-small btn-info" rel="tooltip" data-placement="top" data-original-title="Pay using Direct bank Transfer">Direct Bank Transfer</a>
                <a href="<?php echo base_url().'superadmin/user_pay_request_cheque'; ?>" class="btn btn-small btn-info" rel="tooltip" data-placement="top" data-original-title="Pay using cheque">Cheque</a>
               </div>
               </td>
               </tr>
                
                  <tr>
                    <th>#</th>
                    <th>User</th>      
                    <th>Balance Amount <br> Requested</th>
                    <th>Commissions <br> Released</th>      
                     <th>Payment Method</th> 
                    <th>Requested On</th>
                  </tr>
                 
                <?php if($pay_request){ $i = $offset; foreach($pay_request as $row){ ?> 
                <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->firstname.' '.$row->lastname ?></td>
          <!-- <td><a href="<?php //echo base_url() ?>superadmin/emailtostore_admin/<?php //echo $row->userid ?>"><?php //echo $row->email; ?></a></td> -->
          <td><?php money_symbol(); ?><?php echo number_format($row->unpaid_com, 2); ?></td>
          <td><?php money_symbol(); ?><?php echo number_format($row->total_paid_com, 2); ?></td>
          <!-- <td><?php //echo date('m/d/Y', strtotime($row->created)); ?></td>  -->
          <td>
            <?php 
                if($row->payee_type==0)
                  echo"No Account Detail";
                if($row->payee_type==1)
                  echo"Direct Bank Transfer";
                if($row->payee_type==2)
                  echo"Paypal email";
                if($row->payee_type==3)
                  echo"Cheque via mail";
                ?>
          </td>
          <td>
            <?php echo $row->request_date; ?>
          </td>  
        </tr>
        <div>
        <?php $i++; } ?>
        
        <?php } else { ?>
          <tr>
            <td colspan="6" style="text-align: center;font-style: italic;"><h3>No Requests found.</h3></td>
          </tr>
          <?php } ?>
              </table>
              <div class="row-fluid ">
                           
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
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
    </style>
 <div id="main_container">    
      

    
    <div class="row" style="margin-bottom:10px">
         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user"></i> <span>Commission Paid  </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User</th>      
                    <th>Userid</th>   
                    <th>Last Commission<br>Released</th>
                    <th>Total Commission <br>Released</th>      
                     <th>Commission Released<br>Method</th> 
                    <th>Released On</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($pay_request){ $i = $offset; foreach($pay_request as $row){ ?> 
                <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->firstname.' '.$row->lastname ?></td>
          <td><?php echo $row->id?></td>
          <!-- <td><a href="<?php //echo base_url() ?>superadmin/emailtostore_admin/<?php //echo $row->userid ?>"><?php //echo $row->email; ?></a></td> -->
          <td><?php money_symbol(); ?><?php echo number_format($row->last_paid_com, 2); ?></td>
          <td><?php money_symbol(); ?><?php echo number_format($row->total_paid_com, 2); ?></td>
          <!-- <td><?php //echo date('m/d/Y', strtotime($row->created)); ?></td>  -->
          <td>
            <?php 
                if($row->payment_method==0)
                  echo"No Account Detail";
                if($row->payment_method==1)
                  echo"Direct Bank Transfer";
                if($row->payment_method==2)
                  echo"Paypal email";
                if($row->payment_method==3)
                  echo"Cheque via mail";
                ?>
          </td>
          <td>
            <?php echo $row->payment_date; ?>
          </td>  
        </tr>
        <div>
        <?php $i++; } } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;font-style: italic;"><h3>No Requests found.</h3></td>
          </tr>
          <?php } ?>  
            
                </tbody>
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
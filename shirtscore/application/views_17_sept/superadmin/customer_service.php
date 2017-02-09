 <div id="main_container">    
    

    
    <div class="row" style="margin-bottom:10px">
          <?php echo form_open(current_url(), array('class'=>'form-horizontal row-fluid')); ?>
          <div class="row">
             <input type="text" style="border:1px solid" id="search" name="fname" value="<?php echo $fname; ?>" placeholder="First Name" >
             <input type="text" style="border:1px solid" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name" >
          </div> <br>
          <div class="row-fluid">
            <input type="text" class="span5" style="border:1px solid" name="email" value="<?php echo $email; ?>" placeholder=" Email Address" >
          </div><br>
          <div class="row-fluid">
            <input type="text" class="span5" style="border:1px solid" name="user_id" value="<?php echo $user_id; ?>" placeholder=" Customer Service ID" >
          </div> <br>
          <div class="row">
             <input type="submit" value="Search" class="btn" style="background-color:#333333;">
          </div>
              <?php echo form_close(); ?>   
        </div>

         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user-md"></i> <span> Customer Services </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th class="no_sort"> #</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Controls</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($cust_service){ $i = $offset; foreach($cust_service as $row){ ?> 
                <tr>
          <td><?php echo $i ?></td>
          <td><a class="btn" href="#"><?php echo ucfirst($row->firstname) ?></a></td>
          <td><a class="btn" href="#"><?php echo ucfirst($row->lastname) ?></a></td>
          <td><a class="btn" href="#"><?php echo $row->email; ?></a></td>
          <td>
            <?php if ($row->banned == 1){ ?>
            <a href="<?php echo base_url().'superadmin/change_status_customer_service/'.$row->id.'/0'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Unblock"><i class="icon-unlock"></i></a>
            <!-- <a href="<?php //echo base_url().'superadmin/block_store_admins/'.$row->id.'/0'; ?>" title="unblock"><span class="label label-info">unblock</span></a> -->
            <?php }else{ ?>
            <a href="<?php echo base_url().'superadmin/change_status_customer_service/'.$row->id.'/1'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Block"><i class="icon-lock"></i></a>           
            <?php } ?>
          <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
            
          <!-- </td> -->    
          <td>
            <div class="btn-group"> 
              <a href="<?php echo base_url() ?>superadmin/edit_customer_services/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-edit"></i></a>
            </div>
          <!-- </td>
          <td> -->
            <div class="btn-group"> 
            <a href="<?php echo base_url() ?>superadmin/delete_customer_services/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a>
            </div>
          </td>
        </tr>
          <?php $i++; } ?>
         <?php } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;font-style: italic;"><h3>No Records found yet</h3></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="7">
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <a href="<?php echo base_url().'superadmin/add_customer_services'; ?>" class="btn btn-large" rel="tooltip" data-placement="top" data-original-title="Add New"><i class="icon-plus"></i>&nbsp;Add Customer Services</a>
            </td>
          </tr>
            
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
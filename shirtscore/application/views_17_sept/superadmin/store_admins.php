 <div id="main_container">    
   

    
    <div class="row" style="margin-bottom:10px">
          <?php echo form_open(base_url().'superadmin/store_admins', array('class'=>'form-horizontal row-fluid')); ?>
          <div class="row">
             <input type="text" style="border:1px solid" value="<?php if(!empty($fname)) echo $fname; ?>" id="search" name="fname" placeholder="First Name" >
             <input type="text" style="border:1px solid" value="<?php if(!empty($lname)) echo $lname; ?>" name="lname" placeholder="Last Name" >
          </div> <br>
          <div class="row-fluid">
            <input type="text" class="span5" value="<?php  if(!empty($email)) echo $email; ?>" style="border:1px solid" name="email" placeholder=" Email Address" >
          </div><br>
          <!-- <div class="row-fluid">
            <input type="text" class="span5" style="border:1px solid" name="phone" placeholder=" Phone Number" >
          </div> <br> -->
          <div class="row-fluid">
            <input type="text" class="span5" value="<?php  if(!empty($user_id)) echo $user_id; ?>" style="border:1px solid" name="user_id" placeholder=" Storeadmin ID" >
          </div> <br>
          <div class="row">
             <input type="submit" value="Search" class="btn" style="background-color:#333333;">
          </div>
              <?php echo form_close(); ?>   
        </div>

         <div class="row" >
            <?php if($this->session->flashdata('error_msg')){ ?>
          <span class="span12 alert alert-error" ><?php echo $this->session->flashdata('error_msg'); ?></span>
          
        <?php  } ?>
        </div>

         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user-md"></i> <span> Store Admins </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th class="no_sort"> #</th>
                    <th>First name</th>     
                    <th>Last name</th>      
                    <th>Store User ID</th>
                    <!-- <th>Email</th> -->
                    <th>Commission Earned</th>      
                    <!-- <th>Created</th> -->
                    <th>Login</th>
                    <th>Control</th>      
                   <!--  <th>Edit</th>
                    <th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php if($store_admins){ $i = $offset; foreach($store_admins as $row){ ?> 
                <tr>
          <td><?php echo $i ?></td>
          <td><a class="btn" href="<?php echo base_url() ?>superadmin/admin_details/<?php echo $row->id ?>"><?php echo ucfirst($row->firstname) ?></a></td>
          <td><a class="btn" href="<?php echo base_url() ?>superadmin/admin_details/<?php echo $row->id ?>"><?php echo ucfirst($row->lastname) ?></a></td>
          <td># <?php echo $row->id; ?></td>
          <!-- <td><a class="btn" href="<?php // echo base_url() ?>superadmin/emailtostore_admin/<?php // echo $row->id ?>"><?php // echo $row->email; ?></a></td> -->
          <td style="text-align:center;"><?php money_symbol(); ?><?php echo number_format(my_commission($row->id), 2); ?></td>
          <!-- <td><?php //echo date('m/d/Y', strtotime($row->created)); ?></td>  -->
          <td><a class="btn btn-info" href="<?php echo base_url() ?>superadmin/login_as_storeadmin/<?php echo $row->id; ?>" target="_blank">Login</a></td>        
          <td>
            <?php if ($row->banned == 1){ ?>
            <a href="<?php echo base_url().'superadmin/block_store_admins/'.$row->id.'/0'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="unblock Admin"><i class="icon-unlock"></i></a>
            <!-- <a href="<?php //echo base_url().'superadmin/block_store_admins/'.$row->id.'/0'; ?>" title="unblock"><span class="label label-info">unblock</span></a> -->
            <?php }else{ ?>
            <a href="<?php echo base_url().'superadmin/block_store_admins/'.$row->id.'/1'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Block Admin"><i class="icon-lock"></i></a>           
            <?php } ?>        
            
          <!-- </td>     
          <td> -->
            <div class="btn-group"> 
              <a href="<?php echo base_url() ?>superadmin/edit_store_admin/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Store Admin"><i class="icon-edit"></i></a>
            </div>
          <!-- </td>
          <td> -->
            <div class="btn-group"> 
            <a href="<?php echo base_url() ?>superadmin/delete_store_admin/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Store Admin"><i class="icon-remove"></i></a>
            </div>
          </td>
        </tr>
          <?php $i++; } ?>
        <tr>
          <td colspan="7">
            <a href="<?php echo base_url().'superadmin/messages'; ?>" class="btn btn-large" rel="tooltip" data-placement="top" data-original-title="Messages"><i class="icon-envelope"></i>&nbsp;Messages</a>
          </td>
        </tr>
         <?php } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;font-style: italic;"><h3>No store admin records found yet.</h3></td>
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
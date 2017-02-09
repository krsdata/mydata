<div id="main_container">
  
		<div class="row" style="margin-bottom:10px">
          <?php echo form_open(base_url().'superadmin/pending_stores', array('class'=>'form-horizontal row-fluid')); ?>
          <div class="row">
             <input type="text" class="span5" style="border:1px solid" id="search" name="storename" value="<?php echo $storename; ?>" placeholder="Store Name" >            
          </div> <br>
          <div class="row">
             <input type="text" class="span5" style="border:1px solid"  name="storeid" value="<?php echo $storeid; ?>" placeholder="Store ID" >            
          </div> <br>
         <!--  <div class="row">
             <input type="text" class="span5" style="border:1px solid"  name="store_email" placeholder="Store Email" >            
          </div> <br>  -->         
          <div class="row">
             <input type="submit" value="Search" class="btn" style="background-color:#333333;">
          </div>
              <?php echo form_close(); ?>		
        </div>

      <div class="row-fluid ">
          <div class="box paint color_0">       	
            <div class="title">
              <h4> <i class=" icon-home"></i> <span>Pending Stores </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <!-- <th class="no_sort"> # </th>
                  	<th>Name</th>
          					<th>Price</th>
          					<th>Quantity</th>
          					<th>Date</th>
                    <th class="ms no_sort "> Actions </th> -->

                    <!-- <th>S.no</th> -->
                    <th class="no_sort"> #ID </th>
          					<th>Store name</th>			
          					<th>Created</th>
                    		<th>Status</th>
                    		<th>Created By</th>
          					<th>Edit</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($stores){ $i = $offset; foreach($stores as $row){ ?>	
                <tr>
          					<td><?php echo $row->id ?></td>
          					<td><a class="btn" href="<?php echo base_url().'superadmin/store_detail/'.$row->id; ?>"><?php echo ucfirst($row->store_name) ?></a></td>
          					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
          					<td>
          						<?php if ($row->status == 0){ ?>
          						<a class="btn btn-danger" href="<?php echo base_url().'superadmin/approve_store/'.$row->id.'/'.$row->user_id; ?>" title="click to approve">Pending</a>
          						<?php }else echo "<span>Approved</span>" ?>	
          					</td>
                    		<td><a class="btn btn-info"  href="<?php echo base_url().'superadmin/admin_details/'.$row->user_id;?>" target="_blank"><?php echo $row->firstname.' '.$row->lastname; ?></a></td> 
          					
                    <?php /* ?>
          					<td>
          						<?php if ($row->is_blocked == 1){ ?>
          						<a  href="<?php echo base_url().'superadmin/suspend_store/'.$row->id.'/0/pending_stores'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="unblock Store" ><i class="icon-unlock"></i></a>
          						<?php }else{ ?>
          						<a href="<?php echo base_url().'superadmin/suspend_store/'.$row->id.'/1/pending_stores' ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="block Store"><i class="icon-lock"></i></a>
          						<?php } ?>
          					</td>
                    <?php */ ?>
          					<td>
          						<div class="btn-group"> 
          						<a href="<?php echo base_url() ?>superadmin/edit_store/<?php echo $row->id.'/pending_stores'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Store"><i class="icon-edit"></i></a>
          					</div>
          					</td>
          					<td>
          						<div class="btn-group"> 
          						<a href="<?php echo base_url() ?>superadmin/delete_store/<?php echo $row->id.'/pending_stores'; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Store"><i class="icon-remove"></i></a>
          						</div>
          					</td>
          				</tr>
                    <?php $i++; } } else { ?>
          					<tr>
          						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Stores found yet</h3></td>
          					</tr>
          					<?php } ?>
                </tbody>
              </table>
              <br>
              <div class="row-fluid ">
                <div class="span6">
                   <?php if($incomplete_stores): ?>
                      <a href="<?php echo base_url().'superadmin/incomplete_store'; ?>" class="btn btn-large" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i>&nbsp;Delete Incomplete Sign Up</a>
                   <?php endif; ?>
                </div> 

                <div class="span6">
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
      .btn{
        color: #ffffff !important;
      }
    </style>
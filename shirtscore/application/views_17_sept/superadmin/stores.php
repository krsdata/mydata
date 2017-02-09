

    <div id="main_container">
      <div class="row-fluid ">     	

        	

          <div class="box paint color_0">       	


            <div class="title">

              <h4> <i class=" icon-user"></i> <span> Stores </span> </h4>
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
                    <th class="no_sort"> # </th>
					<th>Store name</th>			
					<th>Created</th>
					<th>Status</th>			
					<th>Control</th>			
					<th>Edit</th>
					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($stores){ $i = 1; foreach($stores as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
					<td><?php echo $row->store_name ?></td>
					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
					<td>
						<?php if ($row->status == 0){ ?>
							<a class="btn btn-danger" href="<?php echo base_url().'superadmin/approved_store/'.$row->id; ?>" title="click to approve">Pending</a>
						<?php }else echo "<span>Approved</span>" ?>	
					</td>
					<td>
						<?php if ($row->is_blocked == 1){ ?>
						<a  href="<?php echo base_url().'superadmin/suspend_store/'.$row->id.'/0'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Unblock Store" ><i class="icon-unlock"></i></a>
						<?php }else{ ?>
						<a href="<?php echo base_url().'superadmin/suspend_store/'.$row->id.'/1' ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Block Store"><i class="icon-lock"></i></a>
						<?php } ?>				
						
					</td>
					<td>
						<div class="btn-group">
							<a href="<?php echo base_url() ?>superadmin/edit_store/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Store"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
							<a href="<?php echo base_url() ?>superadmin/delete_store/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Store"><i class="icon-remove"></i></a>
						</div>
					</td>
				</tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="6" style="text-align: center;font-style: italic;"><h3>No Stores found yet</h3></td>
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
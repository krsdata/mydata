

    <div id="main_container">
      <div class="row-fluid ">     	

   
          <div class="btn">
            <a href="<?php echo base_url().'superadmin/add_note/'.$order_id; ?>" title="">Add Note</a>
          </div>
          <br><br>
          <div class="box paint color_0">       	
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Order Notes </span></h4>
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
          <th>Created</th>            
					<th>Updated</th>						
          <th>View</th>
					<th>Edit</th>
					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($order_notes){ $i = $offset; foreach($order_notes as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
          <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
					<td><?php echo date('m/d/Y', strtotime($row->updated)); ?></td>
					<td>
            <div class="btn-group"> 
            <a href="<?php echo base_url() ?>superadmin/view_note/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Order Note"><i class="icon-eye-open"></i></a>
          </div>
          </td>
          <td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/edit_note/<?php echo $row->id; ?>/<?php echo $row->order_id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Order Note"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/delete_note/<?php echo $row->id; ?>/<?php echo $row->order_id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Order Note"><i class="icon-remove"></i></a>
						</div>
					</td>
				</tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="6" style="text-align: center;font-style: italic;"><h3>No Order Notes found yet</h3></td>
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
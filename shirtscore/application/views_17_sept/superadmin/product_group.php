    <div id="main_container">
      <div class="row-fluid ">     	
          <div class="box paint color_0">       	
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Product Groups 
              <a href="<?php echo base_url() ?>superadmin/add_group/" class="btn btn-info btn-mini" >Add Product groups</a>
              </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($product_group){ $i = $offset; foreach($product_group as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
					<td><?php echo $row->group_name ?></td>					
					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>													
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/edit_group/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit group"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/delete_group/<?php echo $row->id; ?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete group"><i class="icon-remove"></i></a>
						</div>
					</td>
				</tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No group found yet</h3></td>
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
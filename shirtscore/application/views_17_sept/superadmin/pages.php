

    <div id="main_container">
      <div class="row-fluid ">     	

        
          <div class="box paint color_0">       	


            <div class="title">

              <h4> <i class=" icon-user"></i> <span> Pages </span> <a class="btn btn-info btn-mini" href="<?php echo base_url().'superadmin/add_page' ?>" title="Add New Page">Add New Page</a>  </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                   
                    <th class="no_sort"> # </th>
          					<th>Page name</th>			
                    <th>URL</th>      
          					<th>Status</th>			
          					<th>Created</th>						
          					<th>Edit</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($pages){ $i = $offset; foreach($pages as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
					<td><?php echo $row->page_name ?></td>
					<td><?php echo $row->page_url ?></td>
          <td>
            <?php if ($row->status == 1){ ?>
            <a  href="<?php echo base_url().'superadmin/change_page_status/'.$row->id.'/0'; ?>"  rel="tooltip" data-placement="top" data-original-title="Unpblish" ><span class='btn btn-success'>Published</span></a>
            <?php }else{ ?>
            <a href="<?php echo base_url().'superadmin/change_page_status/'.$row->id.'/1' ?>"  rel="tooltip" data-placement="top" data-original-title="Publish"><span class="btn btn-success btn-danger">Unpublished</span></a>
            <?php } ?>        
            
          </td>
					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/edit_page/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Page"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/delete_page/<?php echo $row->id; ?>" onclick="return confirm('are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Page"><i class="icon-remove"></i></a>
						</div>
					</td>
				</tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="6" style="text-align: center;font-style: italic;"><h3>No Pages found yet</h3></td>
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
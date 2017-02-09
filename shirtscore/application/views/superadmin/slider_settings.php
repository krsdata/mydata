

    <div id="main_container">
      <div class="row-fluid ">     	

       

          <div class="box paint color_0">       	


            <div class="title">
              <h4> <i class=" icon-picture"></i> <span> Slider Settings </span>  <a class="btn btn-info btn-mini" href="<?php echo base_url().'superadmin/add_slider_content' ?>" title="Add New Slide">Add New Slide</a> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                  
                  <th class="no_sort"> # </th>
        					<th>Image</th>
        					<th>Status</th>
        					<th>Created</th>
        					<th>Edit</th>
        					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($slider){ $i = 1; foreach($slider as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
					<td style="width:40%;"><img style="width:90%;" src="<?php echo base_url() ?>assets/uploads/slider_images/<?php echo $row->image; ?>"></td>
					<td>
						<?php if ($row->status == 0){ ?>
						<a class="btn btn-danger" href="<?php echo base_url().'superadmin/slide_status/1/'.$row->id; ?>" title="click to Activate">Deactive</a>
						<?php }else{ ?>
						<a class="btn btn-success" href="<?php echo base_url().'superadmin/slide_status/0/'.$row->id; ?>" title="click to Dactivate">Active</a>
						<?php } ?>	
					</td>
					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>			
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/edit_slider_content/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Slide"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>superadmin/delete_slider_content/<?php echo $row->id; ?>" onclick="return confirm('are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Slide"><i class="icon-remove"></i></a>
						</div>
					</td>
				</tr>
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="6" style="text-align: center;font-style: italic;"><h3>No Records found yet.</h3></td>
					</tr>
					<?php } ?>	
						
                </tbody>
              </table>
              <br><br>
              <div class="row-fluid ">
              	<div class="span6">
                  
                </div>

                <div class="span6">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
              </div> 
              <!-- <div class="row-fluid ">
                
              </div> -->
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
    a.btn-success{
    	background-color: #2E8A2E !important;
    }

    .table a {
      color: #FFF !important;
      text-decoration: none;
    }

    </style>
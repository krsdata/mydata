    <div id="main_container">
      <div class="row-fluid ">  
          <div class="box paint color_0">       	
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Colors 
             <a href="<?php echo base_url() ?>superadmin/add_color/<?php echo $product_id ?>" class="btn btn-info btn-mini" >Add Colors</a>
              </span>
              </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>          					
          					<!-- <th>Image</th>			 -->
                    <th>Colors</th>
          					<th>Edit</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($color){ $i = 1; foreach($color as $row){ ?>	
                <tr>
        					<td><?php echo $i ?></td>
        					<td><div class="color_select" style=" float:left; margin-left:5px; background-color:<?php echo $row->color_code; ?>;"></div>

                    <img src="<?php echo base_url().'assets/uploads/color_img/thumbnail/'.$row->main_image; ?>">
                    <?php if (!empty($row->back_image)): ?>
                      <img src="<?php echo base_url().'assets/uploads/color_img/thumbnail/'.$row->back_image; ?>">
                   <?php endif; ?>
                  </td>	
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>superadmin/edit_color/<?php echo $product_id.'/'.$row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit parameters"><i class="icon-edit"></i></a>
      					</div>
      					</td>
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>superadmin/delete_colors/<?php echo $product_id.'/'.$row->id; ?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete parameters"><i class="icon-remove"></i></a>
      						</div>
      					</td>
				      </tr>
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Color found yet</h3></td>
					</tr>
					<?php } ?>	
						
                </tbody>
              </table>
              <div class="row-fluid ">
               
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php //echo $pagination; ?>
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
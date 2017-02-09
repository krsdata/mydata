

    <div id="main_container">
      <div class="row-fluid ">     	

      

          <div class="box paint color_0">       	


            <div class="title">

              <h4> <i class=" icon-user"></i> <span> Product's Designs</span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>
                    <th>Product Image</th>
          					<th>Product Name</th>
                    <th colspan="2" style="text-align:center; ">Design Actions</th>	          					
                  </tr>
                </thead>
                <tbody>
                <?php if($products){ $i = 1; foreach($products as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
          <td>
            <?php if (!empty($row->main_image)): ?>            
            <img src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->main_image; ?>">
            <?php endif ?>
          </td>
					<td><a href="<?php echo base_url() ?>superadmin/product_info/<?php echo $row->id ?>"><?php echo $row->regular_name ?></a></td>											
					<td style="text-align:center">
						<div class="btn-group"> 
						  <a href="<?php echo base_url() ?>superadmin/select_design/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Add Design"><i class="icon-plus"></i></a>
					  </div>
					</td>

          <td style="text-align:center">
            <div class="btn-group"> 
              <a href="<?php echo base_url() ?>superadmin/delete_product_design/<?php echo $row->id; ?>"  class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Design"><i class="icon-remove"></i></a>
            </div>
          </td>					
				</tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Products found yet</h3></td>
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
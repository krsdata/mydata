 <div id="main_container">    
         <div class="row-fluid ">       
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-user-md"></i> <span>Best seller </span> &nbsp;&nbsp;&nbsp; <?php $product = get_best_selling_product(); if($product->status=='0'){ ?><a href="<?php echo base_url().'superadmin/update_best_selling/'.$product->status ?>" class="btn btn-success"  onclick="return confirm('do you want to Show product?');">Show Best Selling Product on Home page</a><?php }else if($product->status=='1'){ ?><a href="<?php echo base_url().'superadmin/update_best_selling/'.$product->status ?>" class="btn btn-info" onclick="return confirm('do you want to Hide product?');">Hide Best Selling Product on Home page</a> <?php } ?> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th class="no_sort"> #</th>
                    <th>Design Title</th>     
                    <th>Design Link</th>      
                    <th>Design Image</th>
                    <th>Action</th>      
                  </tr>
                </thead>
                <tbody>
                <?php if($best_seller){ $i = $offset; foreach($best_seller as $row){ ?> 
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo ucfirst($row->best_sell_title) ?></td>
                  <td><?php echo $row->best_sell_link ?></td>
                  <td><?php if(!empty($row->thumb_image)){ ?><img src="<?php echo base_url(str_replace('./','',$row->thumb_image));?>"><?php } ?></td>
                 
                  <td>  <div class="btn-group"> 
                      <a href="<?php echo base_url() ?>superadmin/add_edit_best_seller/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Best Seller Design"><i class="icon-edit"></i></a>
                    </div>
                  <!-- </td>
                  <td> -->
                    <div class="btn-group"> 
                    <a href="<?php echo base_url() ?>superadmin/delete_best_seller/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Best Seller Design"><i class="icon-remove"></i></a>
                    </div>
                  </td>
                </tr>
          <?php $i++; } ?>
        
         <?php } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;font-style: italic;"><h3>No Best Selling Design Found yet.</h3></td>
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
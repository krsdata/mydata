    <div id="main_container">
      <div class="row-fluid ">      
          <div class="box paint color_0">         
            <div class="title">
              <h4> <i class=" icon-comments"></i> <span> Coupons 
               <a href="<?php echo base_url() ?>superadmin/add_coupon/" class="btn btn-info btn-mini" >Add Coupon</a>
               </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
             <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>                    
                    <!-- <th>Image</th>      -->
                    <th>Coupon Code</th>                       
                    <th>Name</th>
                    <th>Status</th>                    
                    <th>Control</th>                    
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($coupons){ $i = $offset; foreach($coupons as $row){ ?> 
                <tr>
                  <td><?php echo $i ?></td>
                  <td><a href="<?php echo base_url() ?>superadmin/view_coupon/<?php echo $row->id; ?>"><?php echo $row->code; ?></a></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php if($row->status == 1) echo "Live"; else echo "Disabled"; ?></td>                                    
                  <td>
                  <div class="btn-group">
                  <?php if ($row->status == 1){ $val=0; ?>            
                  <a href="<?php echo base_url() ?>superadmin/change_coupon_status/<?php echo $val.'/'.$row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" title="Disable Coupon"><i class="icon-lock"></i></a>
                  <?php } else{ $val = 1; ?>
                  <a href="<?php echo base_url() ?>superadmin/change_coupon_status/<?php echo $val.'/'.$row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" title="Enable Coupon"><i class="icon-unlock"></i></a>
                  <?php } ?>
                  </div>
                  </td>
                 <td>
                    <div class="btn-group"> 
                     <a href="<?php echo base_url() ?>superadmin/edit_coupon/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Coupon"><i class="icon-edit"></i></a>
                    </div>
                 </td>
                <td>
                  <div class="btn-group"> 
                  <a href="<?php echo base_url() ?>superadmin/delete_coupon/<?php echo $row->id; ?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Coupon"><i class="icon-trash"></i></a>
                  </div>
                </td>
              </tr>
                  
                  <?php $i++; } } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;font-style: italic;"><h3>No Coupons found yet</h3></td>
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
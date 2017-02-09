<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">
        <?php if($this->session->flashdata('success_msg')){ ?>
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
      </div>
      <?php } ?>
      <?php if($this->session->flashdata('error_msg')){ ?>
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
    </div>
    <?php } ?>  
            <div class="title">
              <h4><span> Coupons </span></h4>
            </div>
            <!-- End .title -->
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>          					
          					<!-- <th>Image</th>			 -->
                    <th>Coupon Code</th>                       
                    <th>Name</th>
                    <th>Status</th>                    
                    <th>Control</th>                    
          					<th>Edit</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($coupons){ $i = 1; foreach($coupons as $row){ ?>	
                <tr>
        					<td><?php echo $i ?></td>
                  <td><a href="<?php echo base_url() ?>storeadmin/view_coupon/<?php echo $row->id; ?>"><?php echo $row->code; ?></a></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php if($row->status == 1) echo "Live"; else echo "Disabled"; ?></td>        					                  
                  <td>
                  <div class="btn-group">
                  <?php if ($row->status == 1){ $val=0; ?>            
                  <a href="<?php echo base_url() ?>storeadmin/change_coupon_status/<?php echo $val.'/'.$row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" title="Disable Coupon"><i class="icon-lock"></i></a>
                  <?php } else{ $val = 1; ?>
                  <a href="<?php echo base_url() ?>storeadmin/change_coupon_status/<?php echo $val.'/'.$row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" title="Enable Coupon"><i class="icon-unlock"></i></a>
                  <?php } ?>
                  </div>
                  </td>
      					 <td>
      						  <div class="btn-group"> 
      						   <a href="<?php echo base_url() ?>storeadmin/edit_coupon/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Coupon"><i class="icon-edit"></i></a>
      					    </div>
      					 </td>
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>storeadmin/delete_coupon/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Coupon"><i class="icon-trash"></i></a>
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
                <div class="span12">
                  <div class="pagination">
                   <?php echo $pagination; ?>
                  </div >
                </div>
              </div>
      </div>      
    </div>
  </div>
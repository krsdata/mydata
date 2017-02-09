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
              <h4><span> Users </span> </h4>
            </div>
            <!-- End .title -->
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr class="cell-content">
                    <!-- <th class="no_sort"> # </th>
                  	<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Date</th>
                    <th class="ms no_sort "> Actions </th> -->

                    <!-- <th>S.no</th> -->
                    <th class="no_sort"> # </th>
					<th>First name</th>			
					<th>Last name</th>			
					<th>View Purchases</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($users){ $i = 1; foreach($users as $row){ ?>	
                <tr class="cell-content">
					<td><?php echo $i ?></td>
					<td><a href="<?php echo base_url() ?>storeadmin/user_details/<?php echo $row->id ?>"><?php echo $row->firstname ?></a></td>
					<td><a href="<?php echo base_url() ?>storeadmin/user_details/<?php echo $row->id ?>"><?php echo $row->lastname ?></a></td>
					<td><a href="<?php echo base_url() ?>storeadmin/user_purcahses/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Purchases"><i class="icon-eye-open"></i></a></td>					
					<!-- <td>
						<?php //if ($row->banned == 1){ ?>
						<a href="<?php //echo base_url().'storeadmin/block_user/'.$row->id.'/0'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" title="Unblock User"><i class="icon-unlock"></i></a>						
						<?php //}else{ ?>
						<a href="<?php //echo base_url().'storeadmin/block_user/'.$row->id.'/1'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" title="Block User"><i class="icon-lock"></i></a>												
						<?php //} ?>						
					</td>			
					<td>
						<div class="btn-group"> 
						<a href="<?php //echo base_url() ?>storeadmin/edit_user/<?php //echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit User"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php //echo base_url() ?>storeadmin/delete_user/<?php //echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete User"><i class="icon-remove"></i></a>
						</div>
					</td> -->
				</tr>
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Users found yet</h3></td>
					</tr>
					<?php } ?>	
						
                </tbody>
              </table>
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
            </div>
      </div>      
    </div>
  </div>

  <style type="text/css">
  .cell-content th{
  	text-align: center;
  }

  .cell-content td{
  	text-align: center;
  }

  </style>
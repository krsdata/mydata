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
              <h4><span> Products Categories </span> </h4>
            </div>
            <!-- End .title -->
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
                <?php if($product_categories){ $i = 1; foreach($product_categories as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
					<td><?php echo $row->category_name ?></td>					
					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>													
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>storeadmin/edit_product_category/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>storeadmin/delete_product_category/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a>
						</div>
					</td>
				</tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Category found yet</h3></td>
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
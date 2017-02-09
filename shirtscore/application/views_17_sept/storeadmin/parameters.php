  <div id="main_container">  

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

    <div class="row" style="margin-bottom:10px"><a href="<?php echo base_url() ?>storeadmin/add_parameters/<?php echo $product_id ?>" class="btn" style="float:right; background-color:#333333;">Add Parameter</a></div>           
          

      <div class="row-fluid ">  
          <div class="box paint color_0">       	


            <div class="title">

              <h4> <i class=" icon-user"></i> <span> Parameters </span></h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>
          					<th>Size</th>					
          					<th>Price</th>
          					<th>weight</th>			
          					<th>Edit</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($parameters){ $i = 1; foreach($parameters as $row){ ?>	
                <tr>
        					<td><?php echo $i ?></td>
        					<td><?php echo $row->size; ?></td>					
                  <td>$<?php echo $row->price; ?></td>          
        					<td><?php echo $row->weight; ?></td>					        					
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>storeadmin/edit_parameters/<?php echo $product_id.'/'.$row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit parameters"><i class="icon-edit"></i></a>
      					</div>
      					</td>
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>storeadmin/delete_parameters/<?php echo $product_id.'/'.$row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete parameters"><i class="icon-remove"></i></a>
      						</div>
      					</td>
				      </tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Parameters found yet</h3></td>
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
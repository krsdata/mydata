<div id="main_container">
    

        <div class="row" style="margin-bottom:10px">          
      <div class="row-fluid ">  
          <div class="box paint color_0">       	


            <div class="title">

              <h4><i class="icon-user"></i><span> Form Fields </span></h4>
                
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>          					
          					<!-- <th>Image</th>			 -->
                    <th>Name</th>                       
                    <th>Type</th>
                    <th>Created</th>                    
                    <th>Edit</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($fields){ $i = 1; foreach($fields as $row){ ?>	
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row->field_name?></td>
                  <td><?php echo get_f_type($row->field_type); ?></td>
                  <td><?php echo $row->created ?></td>  					                                   
      					 <td>
      						  <div class="btn-group"> 
      						   <a href="<?php echo base_url() ?>superadmin/form_field_edit/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Fields"><i class="icon-edit"></i></a>
                    </div>
      					 </td>
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>superadmin/form_field_delete/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Fields"><i class="icon-remove"></i></a>
      						</div>
      					</td>
				      </tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>Nothing found</h3></td>
					</tr>
					<?php } ?>	
						
                </tbody>
              </table>
              <div class="row-fluid "><br>
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
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
   
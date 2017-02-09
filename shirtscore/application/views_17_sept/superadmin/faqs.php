<div id="main_container">
  <div class="row-fluid ">     	        
  
          <div class="box paint color_0">       	


            <div class="title">

              <h4> <i class=" icon-question-sign"></i> <span> FAQ's </span>  <a class="btn btn-info btn-mini" href="<?php echo base_url().'superadmin/add_faq' ?>" title="Add New FAQ">Add New FAQ</a>  </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                
                    <th class="no_sort"> # </th>
          					<th>Question</th>			
          					<th>Answer</th>			
          					<th>Created</th>						
          					<th>Edit</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($faqs){ $i = $offset; foreach($faqs as $row){ ?>	
                <tr>
        					<td><?php echo $i ?></td>
        					<td><?php echo word_limiter($row->question, 4) ?></td>
        					<td><?php echo word_limiter($row->answer, 4); ?></td>
        					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
        					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>superadmin/edit_faq/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-edit"></i></a>
      					</div>
      					</td>
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>superadmin/delete_faq/<?php echo $row->id; ?>" onclick="return confirm('are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a>
      						</div>
      					</td>
			         </tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="6" style="text-align: center;font-style: italic;"><h3>Nothing found yet</h3></td>
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
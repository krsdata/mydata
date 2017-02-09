
    <div id="main_container">
      <div class="row-fluid ">
        	

          <div class="box paint color_0">       	

            <div class="title">

              <h4> <i class=" icon-comments"></i> <span> Messages <a href="<?php echo base_url().'superadmin/messages'; ?>" class="btn btn-info btn-mini" rel="tooltip" data-placement="top" data-original-title="Messages"><i class="icon-envelope"></i>&nbsp; Send Messages</a></span> </h4>

            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th class="no_sort"> # </th>
                    <th>Sent to</th>
          					<th>Subject</th>
                    <th>Created</th>
          					<th>See Message</th>
          					<th>Delete</th>					
                  </tr>
                </thead>
                <tbody>
                <?php if($messages){ $i = $offset; ?>
                <?php foreach($messages as $row){ ?>
               	<tr>
                  <td><?php echo $i ?></td>
        					<td><?php echo $row->name ?></td>
        					<td><?php echo word_limiter($row->subject, 3); ?></td>
        					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
                  <td><a href="<?php echo base_url() ?>superadmin/message_info/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="See Message"><i class="icon-eye-open"></i></a></td>
        					<td><a href="<?php echo base_url() ?>superadmin/delete_message/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a></td>
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
    <style type="text/css">
    #datatable_example tbody tr td a{
    	color: white;
    }
    </style>
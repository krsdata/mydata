
    <div id="main_container">
      <div class="row-fluid ">     	

        	

          <div class="box paint color_0">       	

            <div class="title">

              <h4> <i class=" icon-comments"></i> <span> Supports </span> </h4>

            </div>
            <!-- End .title -->
            <div class="content top">
              <?php echo form_open(base_url().'superadmin/tag_cust_services'); ?>
              <table id="datatable_example" class="responsive table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="5%"><input type="checkbox" name="check_all" id="check_all"></th>
                    <th width="5%"> # </th>
          					<!-- <th width="30%">Subject</th>   -->							
          					<th width="10%">Token no.</th>
          					<th width="10%">Created</th>
                    <th width="10%">Status</th>
          					<th width="8%">Tag</th>
                    <th width="8%">Reply</th>
          					<th width="8%">Delete</th>					
                  </tr>
                </thead>
                <tbody>
                <?php if($supports){ $i = $offset; ?>
                <?php foreach($supports as $row){ ?>
               	<tr>
                  <td><input type="checkbox" name="check[]" value="<?php echo $row->id;?>" class="check_1"></td>
        					<td><?php echo $i ?></td>
        					<!-- <td><?php //echo character_limiter($row->subject, 15); ?></td> -->
        					<td>#<?php echo $row->token; ?></td>
        					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
        					<td>
        						<?php if ($row->superadmin_replied == 1){ ?>
                    <span class='btn btn-success'>Answered</span>
                    <?php }else { ?> 
        						<span class="btn btn-success btn-danger">Pending</span>
                    <?php } ?>	
        					</td>
                  <td>
                    <?php if ($row->tag_status == 0){ ?>
                    <span class="btn btn-success btn-danger">Untagged</span>
                    <?php }else { ?> 
                    <span class='btn btn-success' rel="tooltip" data-placement="top" data-original-title="Click To Untag"><a href="<?php echo base_url() ?>superadmin/untag_status/<?php echo $row->id ?>">Tagged</a></span> 
                    <?php } ?>  
                  </td>
        					<td><a href="<?php echo base_url() ?>superadmin/supports_reply/<?php echo $row->id.'/'.$row->admin_id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Reply" ><i class="icon-comments"></i></a></td>
        					<td><a href="<?php echo base_url() ?>superadmin/delete_support/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a></td>
        				  </tr>                 
                    <?php $i++; } } else { ?>
        					<tr>
        						<td colspan="9" style="text-align: center;font-style: italic;"><h3>Nothing found yet</h3></td>
        					</tr>
        					<?php } ?>
                  <?php if($supports){ ?>
                  <tr>
                    <td colspan="">&nbsp;</td>
                    <td colspan="8"><input type="submit" name="tag" id="tag" value="Tag" class="btn-info btn" rel="tooltip" data-placement="top" data-original-title="Select query/queries and tag customer service." ></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php echo form_close(); ?>
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
    <script type="text/javascript">
      $("#check_all").change(function(){
          var status = $(this).attr("checked") ? "checked" : false;
          if(status)
          {
           $('.checker span').addClass("checked");
           $('.check_1').attr("checked",true);
          }
          else
          {
           $('.checker span').removeClass("checked");
           $('.check_1').attr("checked",false);
          }
      });

      $("#tag").click(function(e){
          var count_check = 0;
          $(".check_1" ).each(function( index ) {
            var status = $(this).attr("checked") ? "checked" : false;
            if(status)
              count_check++;
          });

          if(count_check > 0){
            return true;
          }else{
            alert('Please select query/queries for tagging.');
            return false;
          }
        });
    </script>
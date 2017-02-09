
    <div id="main_container">
      <div class="row-fluid ">
        	<?php if($this->session->flashdata('success_msg')){ ?>
		    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
			</div>
			<?php } ?>

			<?php if($this->session->flashdata('error_msg')){ ?>
	    <div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
		</div>
		<?php } ?>
			<br>
          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-comments"></i> <span> Tagged Queries </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <?php echo form_open(base_url().'customer_service/tag_cust_services'); ?>
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <!-- <th><input type="checkbox" name="check_all" id="check_all"></th> -->
                    <th class="no_sort"> # </th>
          					<th>Subject</th>
          					<th>Token no.</th>
          					<th>Created</th>
                    <th>Status</th>
          					<th>Tag</th>
          					<th>Reply</th>
          					<!-- <th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php if($supports){ $i = 1; ?>
                <?php foreach($supports as $row){ ?>
               	<tr>
                  <?php  /* <td><input type="checkbox" name="check[]" value="<?php echo $row->id;?>" class="check_1"></td> */?>
        					<td><?php echo $i ?></td>
        					<td><?php echo word_limiter($row->subject, 3); ?></td>
        					<td><?php echo $row->token; ?></td>
        					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
        					<td>
        						<?php if ($row->cust_service_replied == 1){ ?>
                    <span class='btn btn-success'>Answered</span>
                    <?php }else { ?> 
        						<span class="btn btn-success btn-danger">Pending</span>
                    <?php } ?>	
        					</td>
                  <td>
                    <?php if ($row->tag_status == 0){ ?>
                    <span class="btn btn-success btn-danger">Untagged</span>
                    <?php }else { ?>
                    <span class='btn btn-success'>Tagged</span>
                    <?php } ?>
                  </td>
        					<td><a href="<?php echo base_url() ?>customer_service/supports_reply/<?php echo $row->id.'/'.$row->admin_id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Reply" ><i class="icon-comments"></i></a></td>
        					<!-- <td><a href="<?php // echo base_url() ?>customer_service/delete_support/<?php // echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a></td> -->
        				  </tr>                 
                    <?php $i++; } } else { ?>
        					<tr>
        						<td colspan="7" style="text-align: center;font-style: italic;"><h3>Nothing found yet</h3></td>
        					</tr>
        					<?php } ?>
                  <?php /* if($supports){ ?>
                  <tr>
                    <td colspan="">&nbsp;</td>
                    <td colspan="6"><input type="submit" name="tag" id="tag" value="Tag" class="btn-info btn" rel="tooltip" data-placement="top" data-original-title="Select query/queries and tag customer service." ></td>
                  </tr>
                  <?php } */ ?>
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
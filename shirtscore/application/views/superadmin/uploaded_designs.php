<div id="main_container">
 

        <div class="row" style="margin-bottom:10px">
          <?php echo form_open(current_url(), array('class'=>'form-horizontal row-fluid')); ?>  
                <input type="text" style="border:1px solid"  name="design_id" placeholder="Design ID" ><br><br>
                <input type="text" style="border:1px solid" id="search" name="artist" placeholder="Artist Name" ><br><br>
                <input type="text" style="border:1px solid" name="keyword" placeholder="keyword" ><br><br>
                <input type="submit" value="Search" class="btn" style="background-color:#333333;"></div>
                <?php echo form_close(); ?>
      <div class="row-fluid ">  
          <div class="box paint color_0">

            <div class="title">
              <h4><i class="icon-picture"></i><span> Design </span></h4>
                
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                 
                    <th class="no_sort">#</th>          					
          					<th>Image</th>			
                    <th>Design id</th>                       
                    <th>Title</th>                       
                    <th>Artist</th>                       
                    <th>Date</th>                             
                    <th>edit</th>
          					<th>Delete</th>
  
                  </tr>
                </thead>
                <tbody>
                  <?php if($designs){ $i = 1; foreach($designs as $row){ ?>	
                  <tr>
                      <td><?php echo $i ?></td>
                      <td>
                        <?php if (!empty($row->design_image)): ?>            
                          <img src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>">
                        <?php endif ?>
                      </td>
                      <td><?php echo $row->id ?></td>
                      <td><?php echo $row->design_title; ?></td>
                      <td><?php echo $row->artist ?></td>
                      <td><?php echo date('m/d/y', strtotime($row->created)); ?></td>
                      <td>
                        <div class="btn-group"> 
                          <a href="<?php echo base_url() ?>superadmin/edit_design/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-edit"></i></a>
                        </div>
                      </td>      					 
            					<td>
            						<div class="btn-group"> 
            						  <a href="<?php echo base_url() ?>superadmin/delete_design/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a>
            						</div>
            					</td>
  				        </tr>
                   	<?php $i++; } } else { ?>
        					<tr>
        						<td colspan="8" style="text-align: center;font-style: italic;"><h3>No design found</h3></td>
        					</tr>
        					<?php } ?>
                </tbody>
              </table>
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
      $('#search').change(function(){
          $('#search_form').submit();
      });
    </script>
    <script type="text/javascript">
      $("#check_all").change(function(){
        var status = $(this).attr("checked") ? "checked" : false;

        if(status)
         $("span").addClass("checked");
        else
         $("span").removeClass("checked");
      });
    </script>
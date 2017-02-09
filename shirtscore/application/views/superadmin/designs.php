<div id="main_container">  
        <div class="row" style="margin-bottom:10px">
          <?php echo form_open(base_url().'superadmin/designs', array('class'=>'form-horizontal row-fluid')); ?>  
                <input type="text" style="border:1px solid"  name="design_id" value="<?php echo "$design_id"; ?>" placeholder="Design ID" >
                <input type="text" style="border:1px solid" id="search" name="artist" value="<?php echo "$artist"; ?>" placeholder="Artist Name" >
                <input type="text" style="border:1px solid" name="keyword" value="<?php echo "$keyword"; ?>" placeholder="Title" >
                 <select name="design_status">
                  <option value="2" <?php if($set_status==2){   echo"selected='selected'"; }   ?>>All Design</option>
                  <option value="3" <?php if($set_status==3){  echo"selected='selected'";}   ?>>Pending</option>
                  <option value="1" <?php if($set_status==1){   echo"selected='selected'";}  ?>>Approved</option>
                </select>
               
            <input type="submit" value="Search" class="btn" style="background-color:#333333;"></div>
        <?php echo form_close(); ?>
      <div class="row-fluid ">  
          <div class="box paint color_0">       	

            <div class="title">

              <h4><i class="icon-picture"></i><span> Design 
               <a href="<?php echo base_url() ?>superadmin/add_design/" class="btn btn-info btn-mini" >Add Design</a>
               </span>
               </h4>
                
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                 
                    <th class="no_sort">#</th>          					
          					<!-- <th>Image</th>			 -->
                    <th>Design Image</th> 
                    <th>ID</th>                       
                    <th>Title</th>                       
                    <th>Artist</th>                       
                    <th>Date</th> 
                    <th>Price</th>
                    <th>Status</th>
                    <th>Download</th>
                    <th>edit</th>
          					<th>Delete</th>
  
                  </tr>
                </thead>
                <tbody>
                <?php if($designs){ $i = $offset; foreach($designs as $row){ ?>	
                <tr>                 
                  <td><?php echo $i ?></td>
                  <td><img style="width:70px;height:70px;" src="<?php echo base_url()?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" ></td>
                  <td><?php echo $row->id; ?></td>
                  <td><?php echo $row->design_title; ?></td>
                  <td><?php echo $row->artist ?></td>
                  <td><?php echo date('m/d/y', strtotime($row->created)); ?></td>
                  <td><?php if($row->price == 0.00 ){?>
                      <span>NA</span>
                      <?php }else{?>
                      <sapne><?php echo '$'.$row->price; ?></span>
                      <?php }?>
                  </td>
                  <td>
                    <?php if ($row->status == 0){ ?>
                          <?php if($row->price == 0.00){?>
                           <a class="btn btn-info" href="<?php echo base_url().'superadmin/design_price/'.$row->id .'/'.($offset - 1); ?>" title="click to add Price">add price</a>
                          <?php }else{ ?>
                           <a class="btn btn-danger" href="<?php echo base_url().'superadmin/approved_design/'.$row->id .'/'.($offset - 1); ?>" title="click to approve">Pending</a>
                          <?php }?>
                    <?php }else echo "<span>Approved</span>" ?> 
                  </td>

                  <td>
                     <div class="btn-group"> 
                        <a href="<?php echo base_url() ?>superadmin/download_design/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Download"><i class="icon-download"></i></a>
                     </div>
                  </td>

                  <td>
                     <div class="btn-group"> 
                        <a href="<?php echo base_url() ?>superadmin/edit_design/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-edit"></i></a>
                     </div>
                  </td>      					 
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>superadmin/delete_design/<?php echo $row->id; ?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a>
      						</div>
      					</td>
				      </tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="10" style="text-align: center;font-style: italic;"><h3>No design found</h3></td>
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
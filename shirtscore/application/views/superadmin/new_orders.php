<div id="main_container">
  

        <div class="row" style="margin-bottom:10px">
          <?php echo form_open('superadmin/new_orders', array('class'=>'form-horizontal row-fluid')); ?>  
                <input type="text" style="border:1px solid" id="search" name="search" placeholder="order id" >
                <input type="text" style="border:1px solid" id="search_email" name="search_email" placeholder="Email" >
                <input type="text" style="border:1px solid" id="search_name" name="search_name" placeholder="name" >
                
                <br><br>
                <input type="submit" value="Search" class="btn" style="background-color:#333333;"></div>
                <?php echo form_close(); ?>
      <div class="row-fluid ">  
          <div class="box paint color_0">       	


            <div class="title">

              <h4><i class="icon-shopping-cart"></i><span> Orders </span></h4>
                
            </div>
            <!-- End .title -->
            <div class="content top">
               <?php echo form_open(base_url().'superadmin/delete_orders'); ?>
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th><input type="checkbox" name="check_all" id="check_all"></th>
                    <th class="no_sort"> # </th>          					
          					<!-- <th>Image</th>			 -->
                    <th>Order id</th>
                    <th>Notes</th>                       
                    <th>Date</th>
                    <th>Status</th>                    
                    <th>Action</th>
          					<th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($orders){ $i = $offset; foreach($orders as $row){ ?>	
                <tr>
                 <td><input type="checkbox" name="check[]" value="<?php echo  $row->order_id;?>" class="check_1"></td>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row->order_id ?></td>
                  <td><div class="btn-group"> 
                  <a href="<?php echo base_url() ?>superadmin/order_notes/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Add Order Note"><i class="icon-tag"></i></a>
                  </div></td>
        					<td><?php echo date('m/d/Y', strtotime($row->created)) ?></td>
                  <td><?php echo(fetch_order_status($row->order_status)) ?></td>

      					 <td>
      						  <div class="btn-group"> 
                
                     <a href="<?php echo base_url() ?>superadmin/order_info/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Order"><i class="icon-eye-open"></i></a>
                     </a>
                     
              

                     <!-- <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/6'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Approve Order"><i class="icon-ok-circle"></i></a>
                     <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/7'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Decline Order"><i class="icon-minus-sign"></i></a>
                     <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/8'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Block Order"><i class="icon-ban-circle"></i></a> -->
      					    </div>
      					 </td>
      					<td>
      						<div class="btn-group"> 
      						<a href="<?php echo base_url() ?>superadmin/delete_orders/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn" rel="tooltip" data-placement="top" data-original-title="Delete Order">Delete</a>
      						</div>
      					</td>
				      </tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="8" style="text-align: center;font-style: italic;"><h3>No Order found</h3></td>
					</tr>
					<?php } ?>	
           <tr>
            <td colspan="8"><input type="submit" onclick="return confirm('are you sure?');" value="Delete" class="btn-info btn"></td>
          </tr>
						
                </tbody>
              </table>

              <?php echo form_close(); ?>
              <div class="row-fluid "><br>
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
              </div>
            </div>
            <!-- End row-fluid --> 
            <div class="row-fluid" style="margin:1%">
              <h2>Export Orders</h2><br>
              <?php echo form_open(base_url().'export/export_orders'); ?>
              <input type="hidden" name="type" value="superadmin">
              <?php /*><span>From - <input type="text" id="start_date" name="from_date" value="<?php echo date('m/d/Y', strtotime('-1 day', strtotime(date('m/d/Y')))); ?>"></span><span style="margin-left:1%">To - <input type="text" id="end_date" value="<?php echo date('m/d/Y'); ?>" name="to_date"></span><br> */ ?>

              <div class="form-row control-group row-fluid">
                  <input id="currentDate" name="currentDate" type="hidden" value="<?php echo date('m-d-Y'); ?>">
                  <label class="control-label span1" for="normal-field"> To -
                    <span class="help-block"><?php echo form_error('start_date'); ?></span>
                  </label>
                  <div class="controls span2">
                    <div class="input-append date" id="datepicker" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="d-m-yyyy">
                      <input class="span10" readonly='readonly' id="start_c_date" name="from_date" size="16" type="text" value="<?php echo date('d-m-Y'); ?>">
                      <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <!-- <input type="text" id="start_date" name="start_date" value="<?php // echo date('m/d/Y'); ?>" readonly='readonly'  class="row-fluid"> -->
                  </div>

                  <label class="control-label span1" for="normal-field"> From -
                    <span class="help-block"><?php echo form_error('end_date'); ?></span>
                  </label>
                  <div class="controls span2">
                    <div class="input-append date" id="datepicker2" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="d-m-yyyy">
                      <input class="span10" readonly='readonly' id="end_c_date" name="to_date" size="16" type="text" value="<?php echo date('d-m-Y'); ?>">
                      <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <!-- <input type="text" id="end_date" name="end_date" value="<?php //echo date('m/d/Y'); ?>" readonly='readonly'  class="row-fluid"> -->
                  </div>
              </div>

              <span style="margin-left:5%" class="inline radio"><input type="radio" name="export_file_format" value="csv">CSV</span>
              <span class="inline radio" style="margin-left:1%"><input type="radio" name="export_file_format" value="excel">Excel</span>
              <span class="inline radio" style="margin-left:1%"><input type="radio" name="export_file_format" checked="checked" value="pdf">PDF</span>
              <br><br>
              <span style="margin-left:5%;"><input type="submit" value="Export" class="btn-info btn">
              </div>
              <?php echo form_close(); ?>
            </div>
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
           $("div.checker span").addClass("checked");
          else
           $("div.checker span").removeClass("checked");
        });
    </script>
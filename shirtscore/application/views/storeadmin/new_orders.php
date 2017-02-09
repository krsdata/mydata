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
        <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
      </div>
    <?php } ?>  

          <?php echo form_open(current_url(), array('class'=>'form-horizontal row-fluid')); ?>  
                <input type="text" style="border:1px solid" id="search" name="search" placeholder="order id" >
                <input type="text" style="border:1px solid" id="search_email" name="search_email" placeholder="Email" >
                <input type="text" style="border:1px solid" id="search_name" name="search_name" placeholder="name" >
                
                <br><br>
                <input type="submit" value="Search" class="btn" ></div>
                <?php echo form_close(); ?>
            <div class="title">
              <h4><i class="icon-user"></i><span> Orders </span></h4>
            </div>
            <!-- End .title -->
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
          					<!-- <th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php if($orders){ $i = 1; foreach($orders as $row){ ?>	
                <tr>
                  <td><input type="checkbox" name="check_1" class="check_1"></td>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row->order_id ?></td>
                  <td><div class="btn-group"> 
                  <a href="<?php echo base_url() ?>storeadmin/order_notes/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Add Order Note"><i class="icon-tag"></i></a>
                  </div></td>
        					<td><?php echo date('m/d/Y', strtotime($row->created)) ?></td>
                  <td><?php echo(fetch_order_status($row->order_status)) ?></td>

      					 <td>
      						  <div class="btn-group"> 
                
                     <a href="<?php echo base_url() ?>storeadmin/order_info/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Order"><i class="icon-eye-open"></i></a>
                     </a>
                     
              

                     <!-- <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/6'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Approve Order"><i class="icon-ok-circle"></i></a>
                     <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/7'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Decline Order"><i class="icon-minus-sign"></i></a>
                     <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/8'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Block Order"><i class="icon-ban-circle"></i></a> -->
      					    </div>
      					 </td>
      					<!-- <td>
      						<div class="btn-group"> 
      						<a href="<?php //echo base_url() ?>superadmin/delete_orders/<?php //echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Order"><i class="icon-remove"></i></a>
      						</div>
      					</td> -->
				      </tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Order found</h3></td>
					</tr>
					<?php } ?>	
						
                </tbody>
              </table>              
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
            <!-- End row-fluid --> 
            <div class="row-fluid" style="margin:1%">
              <h2>Export Orders</h2><br>
              <?php echo form_open(base_url().'export/export_orders'); ?>
              <input type="hidden" name="type" value="storeadmin">
              <span>From -<div class="input-append date" id="datepicker" data-date="<?php echo date('m-d-Y'); ?>" data-date-format="mm-dd-yyyy">
                    <input class="span10" readonly='readonly' name="from_date" size="16" type="text" value="<?php echo date('m-d-Y'); ?>">
                    <span class="add-on"><i class="icon-th"></i></span>
                    </div>To -  <div class="input-append date" id="datepicker2" data-date="<?php echo date('m-d-Y'); ?>" data-date-format="mm-dd-yyyy">
                    <input class="span10" readonly='readonly' name="to_date" size="16" type="text" value="<?php echo date('m-d-Y'); ?>">
                    <span class="add-on"><i class="icon-th"></i></span>
                    </div>
</span><br>
                <!--  <input type="text" id="start_date" name="from_date" value="<?php echo date('m/d/Y', strtotime('-1 day', strtotime(date('m/d/Y')))); ?>"></span><span style="margin-left:1%">To - <input type="text" id="end_date" value="<?php echo date('m/d/Y'); ?>" name="to_date"></span><br> -->
              <span style="margin-left:5%" class="inline radio"><input type="radio" name="export_file_format" value="csv">CSV</span>
              <span class="inline radio" style="margin-left:1%"><input type="radio" name="export_file_format" value="excel">Excel</span>
              <span class="inline radio" style="margin-left:1%"><input type="radio" name="export_file_format" checked="checked" value="pdf">PDF</span>
              <br><br>
              <span style="margin-left:5%;"><input type="submit" value="Export" class="btn-info btn">
              </div>
              <?php echo form_close(); ?>
           
    </div>
      </div>      
    </div>
  </div>
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
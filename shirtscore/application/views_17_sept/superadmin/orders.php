<div id="main_container">
  <?php //} ?>
  <?php if($this->session->flashdata('select')){ ?>
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error :</strong><br><?php echo $this->session->flashdata('select'); ?>
  </div>
  <?php } ?>
  <?php if($this->session->flashdata('error_msg')){ ?>
  <div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
  </div>
  <?php } ?>
  <div class="row" style="margin-bottom:10px">
    <?php echo form_open(current_url(), array('class'=>'form-horizontal row-fluid')); ?>  
    <input type="text" style="border:1px solid" id="search" value="<?php echo $search ?>" name="search" placeholder="order id" >
    <input type="text" style="border:1px solid" id="search_email" value="<?php echo $search_email ?>" name="search_email" placeholder="Email" ><br><br>
    <input type="text" style="border:1px solid" id="search_name" value="<?php echo $search_name ?>" name="search_name" placeholder="name" >
    <input type="text" style="border:1px solid" id="search_number" value="<?php echo $search_number ?>" name="search_number" placeholder="Telephone Number">  <br><br>
    <div class="input-append date" id="searchdatepicker" data-date="<?php echo  date('d-m-Y'); ?>" data-date-format="d-m-yyyy">
      <input class="span10" style="border:1px solid" readonly='readonly' value="<?php echo $search_order_date ?>" name="search_order_date" size="23" type="text" value="" placeholder="Created Date">
      <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <input id="currentDate" name="currentDate" type="hidden" value="<?php echo date('m-d-Y'); ?>">
    <select name="status">
      <option value="null" <?php if($set_status=="null"){   echo"selected='selected'"; }?>>All Orders</option>
      <option value="1" <?php if($set_status==1){  echo"selected='selected'";}   ?>>In Queue</option>
      <option value="2" <?php if($set_status==2){   echo"selected='selected'";}  ?>>In Production</option>
      <option value="3" <?php if($set_status==3){   echo"selected='selected'";}  ?>>Production Complete</option>
    </select>
    <input type="submit" value="Search" class="btn" style="background-color:#333333;">
    <?php echo form_close(); ?>
  </div>
  <div class="row-fluid ">  
    <div class="box paint color_0">         
      <div class="title">
       
        <h4><i class="icon-shopping-cart"></i><span> Orders </span></h4>
        
      </div>
      <!-- End .title -->
      <div class="content top">
        <?php echo form_open(base_url().'superadmin/multi_ops'); ?>
        <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
         
          <thead>
            <tr>
              <th><input type="checkbox" name="check_all" id="check_all"></th>                    
              <th class="no_sort">#</th>                    
              <!-- <th>Image</th>      -->
              <th>Order id</th>                       
              <th>Date</th>
              <th>Status</th>                    
              <th>Action</th>
              
              <th>Delete</th>
              <!-- <th>Delete</th> -->
              
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="7">
                <?php $status = order_status_array(); ?>
                <select name="order_status">
                  <option value="">Select Status</option>
                  <?php $selected = 'selected="selected"';
                  foreach ($status as $key => $value){
                    ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                  </select>
                  <input type="submit" name="changestatus" value="Change Order Status" class="btn-info btn">
                  <input type="submit" name="order_download" value="Download Selected Order" class="btn-info btn">
                  <input type="submit" name="delete" onclick="return confirm('are you sure?');" value="Delete" class="btn-info btn">
                  <input type="submit" name="message" value="Message" class="btn-info btn">
                </td></tr>
                <?php if($orders){ $i = $offset; foreach($orders as $row){ ?> 
                <tr>
                  <input type="hidden" name="type" value="superadmin">
                  <td><input type="checkbox" name="check[]" value="<?php echo  $row->order_id;?>" class="check_1"></td>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row->order_id ?></td>
                  <td><?php if(!empty($row->order_created)) echo date('m/d/Y', strtotime($row->order_created)); else echo date('m/d/Y', strtotime($row->created)); ?></td>
                  <td><?php echo(fetch_order_status($row->order_status)) ?></td>
                  <td>
                    <div class="btn-group"> 
                     <?php  if(!empty($row->order_id1)){?>
                     <a href="<?php echo base_url() ?>superadmin/order_info/<?php echo $row->order_id1 ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Order"><i class="icon-eye-open"></i></a>
                   </a>
                   <?php }else{?>
                   <a href="<?php echo base_url() ?>superadmin/order_info/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Order"><i class="icon-eye-open"></i></a>
                   <?php }?>
                   
                     <!-- <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/6'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Approve Order"><i class="icon-ok-circle"></i></a>
                     <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/7'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Decline Order"><i class="icon-minus-sign"></i></a>
                     <a href="<?php //echo base_url() ?>superadmin/orders_status/<?php //echo $row->id.'/7'; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Block Order"><i class="icon-ban-circle"></i></a> -->
                   </div>
                 </td>
                 
                 <td>
                  <a href="<?php echo base_url() ?>superadmin/delete_orders/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn" rel="tooltip" data-placement="top" data-original-title="Delete Order">Delete</a>
                </td>
              </tr>
              
              <?php $i++; } } else { ?>
              <tr>
                <td colspan="7" style="text-align: center;font-style: italic;"><h3>No orders found</h3></td>
              </tr>
              <?php } ?>  
              
              
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
</script>

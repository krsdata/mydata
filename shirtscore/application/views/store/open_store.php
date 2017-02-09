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
            

            <?php if(!empty($stores))
          {?>
            <h2>Pending Stores</h2>
            <table id="datatable_example" class="responsive table table-striped" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                  
                    <th class="no_sort"> # </th>
          <th>Store name</th>     
          <th>Created</th>
          <th>Status</th>     
         
                  </tr>
                </thead>
                <tbody>

                <?php if($stores){ $i = 1; foreach($stores as $row){ ?> 
                <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->store_name ?></td>
          <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
          <td>
            <?php if ($row->status == 0){ ?>
              Pending
            <?php }elseif ($row->is_blocked == 1){ echo "<span>Blocked</span>" ?>
          <?php }else echo "<span>Approved</span>" ?> 
          </td>
        </tr>
                  <?php $i++; } } else { ?>
          <tr>
            <td colspan="6" style="text-align: center;font-style: italic;"><h3>No Stores found yet</h3></td>
          </tr>
          <?php } ?>  
                </tbody>
              </table>
            <?php }?>

            <br><br>

            <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                <div class="well clearfix">
                <div class="title">
              <h2> Add store </h2>
            </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Store Banner
                    
                  </label>
                  <div class="controls span9">
                   <input type="file" name="userfile">
                   <span class="help-block"><?php echo form_error('userfile'); ?></span>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Store Name
                  </label>
                  <div class="controls span6">
                    <input type="text" value="<?php echo set_value('store_name'); ?>" class="row-fluid" name="store_name" placeholder="Store name" autocomplete="off">
                     <span class="help-block"><?php echo form_error('store_name'); ?></span>
                  </div>
                </div>
                
               <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="hint-field">Store Link 

                     </label>
                    <div class="input-prepend controls span9">
                      <span class=" add-on"><?php echo base_url() ?>shop/</span>

                      <input class="" id="" type="text" name="store_link" value="<?php echo set_value('store_link'); ?>" placeholder="Store Link" autocomplete="off">
                    
                    </div>
                    <span class="help-block"><?php echo form_error('store_link'); ?></span>                   
                 </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Store Description
                   
                  </label>
                  <div class="controls span9">
                    <textarea name="store_description" id="desc" rows="5" class="row-fluid"><?php echo set_value('store_description'); ?></textarea><br>
                    <span id="counter"></span>
                     <span class="help-block"><?php echo form_error('store_description'); ?></span>
                    <!-- <input type="text" class="row-fluid" name="store_description" placeholder="Address"> -->
                  </div>
                </div>

                <!-- <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Header Color
                  
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" id="header_color" data-color="rgb(255, 146, 180)" data-color-format="hex">
                    <input type="text" name="header_color"  class="span12" value="">
                    <span class="add-on" ><i style="background-color: rgb(255, 146, 180)"></i></span>
                    <span class="help-block"><?php echo form_error('header_color'); ?></span>
                    </div>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Text Color
                  
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" id="font_color" data-color="rgb(255, 146, 180)" data-color-format="hex">
                    <input type="text" name="font_color" class="span12" value="">
                    <span class="add-on" ><i style="background-color: rgb(255, 146, 180)"></i></span>
                    <span class="help-block"><?php echo form_error('font_color'); ?></span>
                    </div>
                  </div>
                </div> -->

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9">
                    <button type="submit" class="btn-success btn update_cart">Open a store</button>                    
                  </div>
                </div>        
                </div>
            <?php echo form_close(); ?>

        </div>
      </div>      
    </div>
</div>    
<script>
jQuery(document).ready(function($) {
  jQuery('input[name="store_name"]').on('keyup change',function(){
    var store_name=$.trim(jQuery(this).val().toLowerCase());
    var desired = store_name.replace(/[^a-zA-Z0-9\s-]/gi, '').replace(/[^a-zA-Z0-9-]/gi, '-');
    jQuery('input[name="store_link"]').val(desired);
  });

  function count(){
      var txtVal = $('#desc').val();
      var chars = txtVal.length;
      if (chars >= 300)
      {
        txtVal = txtVal.substring(0,300);
        $('#desc').val(txtVal);
        var chars = txtVal.length;
      };
      var words = txtVal.trim().replace(/\s+/gi, ' ').split(' ').length;
      if(chars===0){words=0;}
      $('#counter').html('<br>'+words+' words and '+ chars +' characters');
  }
  
  count();

  $('#desc').on('keyup propertychange paste', function(){
      count();
  });

});
</script>
<style type="text/css">
  .help-block{
    color: red;
  }
</style>
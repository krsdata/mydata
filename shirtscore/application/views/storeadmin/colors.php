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
          <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
        </div>
        <?php } ?>
        <div class="row" ><a href="<?php echo base_url() ?>storeadmin/add_color/<?php echo $product_id ?>" class="btn" style="float:right;">Add Colors</a></div>
        <h4><span> Colors </span></h4>
         <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>                    
                    <!-- <th>Image</th>      -->
                    <th>Colors</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($color){ $i = 1; foreach($color as $row){ ?> 
                <tr>
                  <td><?php echo $i ?></td>
                  <!-- <td>NA</td>           -->
                  <td><div style="height:20px; width:20px; border:1px solid black; background-color:<?php echo $row->color_code; ?>;"></div></td>                                                       
                <td>
                  <div class="btn-group"> 
                  <a href="<?php echo base_url() ?>storeadmin/edit_color/<?php echo $product_id.'/'.$row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit parameters"><i class="icon-edit"></i></a>
                </div>
                </td>
                <td>
                  <div class="btn-group"> 
                  <a href="<?php echo base_url() ?>storeadmin/delete_colors/<?php echo $product_id.'/'.$row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete parameters"><i class="icon-remove"></i></a>
                  </div>
                </td>
              </tr>
                  
                  <?php $i++; } } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;font-style: italic;"><h3>No Color found yet</h3></td>
          </tr>
          <?php } ?>  
            
                </tbody>
              </table>

            <div class="span12">
              <div class="pagination pull-right ">
                  <?php //echo $pagination; ?>
               </div >
            </div>          
        </div>
      </div>      
    </div>
  </div> 
<div class="dashcontent">
	<div class="dashbox">
		<h2>Store</h2>
    <a href="<?php echo base_url() ?>user/add_store/">Add Store</a>
     <?php if($this->session->flashdata('error_msg')){ ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
        </div>
      <?php } ?>
      <?php if($this->session->flashdata('success_msg')){ ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info :</strong><br><?php echo $this->session->flashdata('success_msg'); ?>
        </div>
      <?php } ?>

		<table class="table">
          <thead>
            <tr>
            <th class="no_sort"> # </th>
          <th>Store name</th>     
          <th>Created</th>
          <th>Status</th>     
          <!-- <th>Control</th> -->     
          <th>Edit</th>
          <th>Delete</th>


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
              
          <td>
            <div class="btn-group"> 
            <a href="<?php echo base_url() ?>user/edit_store/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Store"><i class="icon-edit"></i></a>
          </div>
          </td>
          <td>
            <div class="btn-group"> 
            <a href="<?php echo base_url() ?>user/delete_store/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Store"><i class="icon-remove"></i></a>
            </div>
          </td>
        </tr>
                  
                  <?php $i++; } } else { ?>
          <tr>
            <td colspan="6" style="text-align: center;font-style: italic;"><h3>No Stores found yet</h3></td>
          </tr>
          <?php } ?>  
            
          </tbody>
        </table>
        <?php if($pagination){echo $pagination;} ?>
 </div>
</div>
<style type="text/css" media="screen">
	.designboxFoot span{
		color:green;
	}
	.coversation{
		padding: 15px;
	}
	.designboxFoot{
		border-radius: 5px 5px 5px 5px;
    	padding: 10px;
		height: 100px;
		float: left;
		background: none repeat scroll 0 0 #FFFFFF;
	}
	 .color-white{
    padding-left: 10px;
     background-color:#ffffff !important;
      border-radius:5px;
      padding: 15px;
   }
   .msg_top{
    padding:10px;
    color:#808080
   }
</style>
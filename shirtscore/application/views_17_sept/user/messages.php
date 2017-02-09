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
          <div class="title">
            <h4><span> My Messages </span> </h4>
            </div>
            <!-- End .title -->            
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr class="query">
                    <th class="no_sort"> # </th>
                    <th> Status </th>
          					<th>Sent to</th>
                    <th>Subject</th>
                    <th>Received</th>
                    <th>View</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($messages){ $i = 1; foreach($messages as $row){
                $class='error';  
                if ($row->status == 1)
                  $class='success';
                ?>

                <tr class="query <?php echo $class ?>">
        					<td><?php echo $i ?></td>
                  <td class="">
                    <?php if ($row->status == 1){ ?>
                      <span >Read</span>
                    <?php }else { ?> 
                      <span >Unread</span>
                    <?php } ?>
                  </td>
                  <td><?php echo $row->name ?></td>
                  <td><?php echo word_limiter($row->subject, 3); ?></td>
                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
                  <td><a href="<?php echo base_url() ?>user/read_message/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="See Message"><i class="icon-eye-open"></i></a></td>
                  <td><a href="<?php echo base_url() ?>user/delete_message/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-remove"></i></a></td>
        			  </tr>                  
           <?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Messages found yet</h3></td>
					</tr>
					<?php } ?>					
            </tbody>
              </table>              
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
            </div>
      </div>      
    </div>
  </div>

  <style type="text/css">
    .query td,.query th{
    text-align:center;
   }
  </style>
<div class="page-content-wrapper">
		<div class="page-content">
			<div class="clearfix">
			</div>			 
			 <div class="row">
				<div class="col-md-12">
					 <?php  echo msg_alert_backend(); ?>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
									<i class="fa fa-list"></i> About Us <a href="<?php echo base_url('backend/about/add') ?>" class="btn btn-xs yellow">Add About <i class="icon-plus"></i> </a>
							</div>							
						</div>
			<div class="portlet-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th width="40%">Title</th>
								<th width="20%">Image</th>
                               	<th width="10%">Status</th> 
								<th width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($about)):                               
								$i = $offset; foreach ($about as $row) { $i++;
									?>
									<tr>
										<td><?php echo $i . "."; ?></td>                                       
										<td><a href="<?php echo base_url( 'backend/about/edit/'.$row->id.'/'.$offset)?>"class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><?php echo $row->title; ?></a></td>
										<td><?php if(!empty($row->thumb) && file_exists($row->thumb)) { ?>	<img src="<?php echo base_url($row->thumb); ?>" width="100px"><?php } ?></td>
										<td><?php if($row->status){ ?> <a data-toggle="tooltip" data-placement="left" title="Active" href="<?php echo base_url().'backend/about/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs green"><i class="fa fa-check-circle "></i></span></a> <?php  }else{  ?>  <a data-toggle="tooltip" data-placement="left" title="InActive" href="<?php echo base_url().'backend/about/status/'.$row->id.'/'.$row->status.'/'.$offset; ?>"><span  class="btn btn-xs red"><i class="fa fa-times-circle"></i></span></a>  <?php } ?> </td>
										<td>
											<a href="<?php echo base_url('backend/about/edit/'.$row->id.'/'.$offset ) ?>" class="btn btn-success btn-xs" rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="icon-pencil"></i></a> 
                                  			<a href="<?php echo base_url('backend/about/delete/'.$row->id) ?>" class="btn btn-danger btn-xs" rel="tooltip" rel="tooltip" data-placement="bottom" data-original-title="Remove" onclick="return confirm('Are you sure want to delete?');" ><i class="icon-trash "></i></a>
                                     	</td>

									</tr>
										<?php } ?><?php else: ?>
									<tr>
										<th colspan="7">
											<center>No About Us Found.</center>
										</th>

									</tr>
									<?php endif; ?>
								</tbody>
							</table>
							<div class="text-right">
								<?php if (!empty($pagination)) echo $pagination; ?>
							</div>
						</div>
					</div>
				 </div>
					<!-- END SAMPLE TABLE PORTLET-->	
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CONTAINER
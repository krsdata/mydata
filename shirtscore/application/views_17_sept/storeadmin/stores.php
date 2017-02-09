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



              <h4> <!-- <i class=" icon-user"></i> --> <span> Stores </span> </h4>

            </div>



		<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">

                <thead>

                  <tr>                  

                    <th class="no_sort"> # </th>

					<th>Store name</th>			

					<th>Created</th>

					<th>Status</th>			

					<th>Visit Store</th> 			

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
						<a href="<?php echo base_url() ?>shop/<?php echo $row->store_link; ?>" target="_blank" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="view Store"><i class="icon-eye-open"></i> </a>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>storeadmin/edit_store/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit Store"><i class="icon-edit"></i></a>
					</div>
					</td>
					<td>
						<div class="btn-group"> 
						<a href="<?php echo base_url() ?>storeadmin/delete_store/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Store"><i class="icon-trash"></i></a>
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



              <div class="span12">

                  <div class="pagination">

                   <?php echo $pagination; ?>

                  </div >

                </div>         

        </div>       

      </div>     

    </div>

  </div>
<div class="span12">
<div id="content-area">	
      <h1>Supports</h1>
      <br><br>  

    <?php if($this->session->flashdata('success_msg')){ ?>
	    <div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
		</div>
	<?php } ?>

	<?php if($this->session->flashdata('error_msg')){ ?>
	    <div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Success :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
		</div>
	<?php } ?>	
	<table class="table table-hover" style="border:1px solid">
		<tr>
			<th>S.no</th>
			<th>Subject</th>			
			<th>Token no.</th>			
			<th>Created</th>
			<th>Status</th>						
			<th>Reply</th>
			<th>Delete</th>
		</tr>		
		<?php if($supports){ $i=1; foreach ($supports as $row){ ?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo word_limiter($row->subject, 3); ?></td>
			<td><?php echo $row->token; ?></td>
			<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
			<td>
				<?php if ($row->admin_replied == 1){ ?>
				<span class="label label-important">Pending from <?php echo date('m/d/Y', strtotime($row->created)); ?></span>
				<?php }else echo "<span class='label label-success'>Answered on ".date('m/d/Y', strtotime($row->updated))."</span>" ?>	
			</td>					
			<td><a href="<?php echo base_url() ?>superadmin/supports_reply/<?php echo $row->id; ?>"><i class="icon-edit"></i></a></td>
			<td><a href="<?php echo base_url() ?>superadmin/delete_store/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');"><i class="icon-remove"></i></a></td>
		</tr>
		<?php $i++; } }else{ ?>
		<tr>
			<td colspan="6" style="text-align:center"><b>No Stores Found</b></td>
		</tr>
		<?php } ?>
	</table>
	<?php echo $pagination ?>

</div>
</div>


	 <?php if($this->session->flashdata('success_msg')){ ?>
	 <div class="dashcontent">
	<div class="dashbox">
	    <div class="alert alert-success">
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      <br>
	      <span style="font-size:13px"><?php echo $this->session->flashdata('success_msg'); ?></span>
	    </div>
	    </div>
</div>
	 <?php } ?>

	 <div class="dashcontent">
	<div class="dashbox">
		<h2>Pending Designs</h2>
		<hr color="#ccc" />

		<h3>You have (<?php echo $pendings_count; ?>) new designs pending.</h3>
		<?php if ($pending_designs): ?>
			You have <?php echo $pendings_count; ?> new <a href="<?php echo base_url() ?>user/dashboard_designs">designs</a> pending. Once your design has been approved it will be available for purchase. Most approvals occur within minutes but may take up to 48 hours. While you wait, feel free to <a href="<?php echo base_url() ?>user/add_design">upload</a> as many new designs as you like.
		<?php else:?>
			No Pending Designs Found.<a class="btn-success btn update_cart btn-large" href="<?php echo base_url() ?>user/add_design"> Upload New design </a>
		<?php endif ?>
		<br />
	</div>
</div>
<div>

		<?php if ($pending_designs): ?>
	<?php foreach ($pending_designs as $row): ?>
	  <div class="designlft" style="margin-bottom:10px; margin-left:45px">
                <div class="designbox"><img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image; ?>" /></div>
	  <div class="pending"><a href="<?php echo base_url() ?>user/edit_design/<?php echo $row->id; ?>" title="Edit Design Details"><?php echo $row->design_title; ?>&nbsp;&nbsp;<i class="icon-edit"></i></a></div>
	  </div>
  	<?php endforeach ?>
  	<?php endif ?>
  	<?php 
	  	if ($pagination_pending){?>
  		<div class="span12">
			<?php echo $pagination_pending; ?>
  		</div>
  	<?php } ?>
</div>
<div class="clearfloat"></div>
<div class="dashcontent">
	<div class="dashbox">
		<div class="dashicon">
			<a href="dashboard_upload.html" title="Upload a Design">&nbsp;<i class="icon-upload-alt"></i>&nbsp;</a>
			</div>
			<h2>My Designs</h2>
			<hr color="#ccc" />
			<h3><a href="#">You have (<?php echo $approved_count; ?>) design.</a></h3>
			<?php if (!$approved_designs): ?>
				No Pending Designs Found.
			<?php endif ?>
		</div>
	</div>
<div>
	<div>
		<?php if ($approved_designs): ?>
		<?php foreach ($approved_designs as $row1): ?>
			<div class="designlft" style="margin-bottom:10px; margin-left:45px">
                <div class="designbox"><img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row1->design_image; ?>"/></div>
			<div class="pending"><a href="<?php echo base_url() ?>user/edit_design/<?php echo $row1->id; ?>" title="Edit Design Details"><?php echo $row1->design_title; ?>&nbsp;&nbsp;<i class="icon-edit"></i></a></div>
			</div>
		<?php endforeach ?>
  		<?php endif ?>
	</div>
</div>
<?php
	if ($pagination_approved){?>
	<div class="span12">
		<?php echo $pagination_approved; ?>
	</div>
<?php } ?>
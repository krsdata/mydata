<div class="dashcontent" style="margin-top:0;">

	<div class="dashbox">
 <?php if($this->session->flashdata('error_msg')){ ?>
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
            </div>
         <?php } ?>
  <?php if($this->session->flashdata('success_msg')){ ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success:</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
         <?php } ?>

		<h2>Pending Designs</h2>

		<hr color="#ccc" />



		<h3>You have (<?php echo $pendings_count;?>) new designs pending.</h3>


		<?php if ($pending_designs): ?>

			You have <?php echo $pendings_count; ?> new designs pending. Once your design has been approved it will be available for purchase. Most approvals occur within minutes but may take up to 48 hours. While you wait, feel free to <a href="<?php echo base_url() ?>storeadmin/add_design">upload</a> as many new designs as you like.

		<?php else:?>

			No Pending Designs Found. <a class="btn-success btn update_cart btn-large" href="<?php echo base_url() ?>storeadmin/add_design"> Upload New design </a>

		<?php endif ?>

		<br />

	</div>

</div>

<div>

		<?php if ($pending_designs): ?>

	<?php foreach ($pending_designs as $row): ?>

	  <div class="designlft" style="margin-bottom:10px">
                <div class="designbox"><img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image; ?>"  /></div>

		  	<div class="pending">
		  		<a href="<?php echo base_url() ?>storeadmin/edit_design/<?php echo $row->id; ?>" title="Edit Design Details"><?php echo $row->design_title; ?>&nbsp;<i class="icon-edit"></i></a>
		  	</div>

	  </div>

  	<?php endforeach ?>

  	<?php endif ?>

</div>

<?php 

  	if ($pagination_pending){?>

		<div class="span12">

		<?php echo $pagination_pending; ?>

		</div>

<?php } ?>



<div class="clearfloat"></div>





<div class="dashcontent">

	<div class="dashbox">

		<div class="dashicon">

			<a href="<?php echo base_url().'storeadmin/add_design'; ?>" title="Upload a Design">&nbsp;<i class="icon-upload-alt"></i>&nbsp;</a>

			</div>

			<h2>My Designs</h2>

			<hr color="#ccc" />

			<h3>You have (<?php echo $approved_count;?>) design.</h3>

			<?php if (!$approved_designs): ?>

				No Approved Designs Found.

			<?php endif ?>

		</div>

	</div>

<div>

	<div>

		<?php if ($approved_designs): ?>

		<?php foreach ($approved_designs as $row1): ?>

			<div class="designlft" style="margin-bottom:10px">
                <div class="designbox">
					<a href="<?php echo base_url().'storeadmin/design_info/'.$row1->slug; ?>">
						<img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row1->design_image; ?>" />
					</a>
				</div>

				<div class="pending"><a href="<?php echo base_url() ?>storeadmin/edit_design/<?php echo $row1->id; ?>" title="Edit Design Details"><?php echo $row1->design_title; ?>&nbsp;<i class="icon-edit"></i></a>

					<div class="shareit2">
						<a title="share on facebook" href="javascript:fbshare(<?php echo $row1->id; ?>)">
							<div id="facebook_share">share it&nbsp;<i class="icon-share icon-large"></i></div>
						</a>
					</div>

				</div>

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

<style type="text/css" media="screen">

	

.shareit2 {

    /*float: right;

    position: relative;

    right: 45px;

    top: 0px;*/

    margin-top: 5px;

}

</style>



<script type="text/javascript">

function fbshare(id, slug){
	window.open ("http://www.facebook.com/share.php?u=<?php echo base_url() ?>store/fbshare/"+id,"Facebook_Share","menubar=1,resizable=1,width=900,height=500");
}

</script>



<style type="text/css">

	.designlftFoot {

		width: 255px;

		height: 335px;

	}



	.designboxFoot {

		width: 220px;

	}



	@media (max-width: 320px){

		.designlftFoot {

			width: 245px;

			height: 220px;

		}

	}

</style>
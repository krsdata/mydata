
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
			<div class="clearfloat"></div>
				    <h2>New Messages</h2>
			        <hr color="#ccc" />
			        <?php if($messages): ?>
			          <h3><a href="<?php echo base_url().'user/messages'; ?>">You have (<?php echo count($messages); ?>) new <?php if(count($messages) > 1) echo "messages"; else echo "message"; ?>.</a></h3>
			      
			        <?php else: ?>
			          <h3><a href="<?php echo base_url().'user/messages'; ?>">You have (0) new message.</a></h3>
			        <?php endif; ?>
										
				        <!---message compelete-->

					<?php $user = customer_info(); ?>
					<?php 
					
					$lastlogin =$user['last_login'];
					//echo $lastlogin;
					if($lastlogin=='0000-00-00 00:00:00') 
						{?>
						<h2>Welcome <?php if(customer_info()) {echo $user['firstname']." ".$user['lastname'];} ?> </h2>
						
						<h3><span>Thank you for joining!</span></h3>
					<?php } ?>
					<h2>Pending Designs</h2>
					<hr color="#ccc" />
					<h3><a href="<?php echo base_url() ?>user/dashboard_designs">You have (<?php echo $pendings_count; ?>) new designs pending.</a>
					<a class="btn-success btn update_cart btn-large" href="<?php echo base_url() ?>user/add_design"> Upload New design </a></h3>
					<?php if ($pending_designs): ?>
						You have <?php echo $pendings_count; ?> new <a href="<?php echo base_url() ?>user/dashboard_designs">designs</a> pending. Once your design has been approved it will be available for purchase. Most approvals occur within minutes but may take up to 48 hours. While you wait, feel free to <a href="<?php echo base_url() ?>user/add_design">upload</a> as many new designs as you like.
					<?php else:?>
						No Pending Designs Found.
					<?php endif ?>
					<br />
					<hr color="#ccc" />
					<h3><a href="<?php echo base_url('store/open_store')?>">Want to make some $$$!</a></h3>
					Open a store Upload designs and start making some $$$, or order some swag for yourself!
					

				</div>
				<div>&nbsp;</div>
			</div>
		
	
	<div class="clearfloat"></div>

	<style type="text/css">
  hr{
    border-color:#3B5998; 
    /*-moz-use-text-color: #FFFFFF !important; */
  }
</style>
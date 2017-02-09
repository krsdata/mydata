	<div class="dashcontent">
		<div class="dashbox">
			<div class="clearfloat"></div>
			<div class="dashcontent">
				<div class="dashbox">
					<div class="dashicon">
						&nbsp;<i class="icon-envelope"></i>&nbsp;
					</div>
					<h2>Messages</h2>
					<h3><a href="#">Thank you for joining!</a></h3>
					Login to your account to track sales, edit your account, check messages, and add new designs.
					<hr color="3b5998" />
					<h3><a href="<?php echo base_url() ?>user/dashboard_designs">You have (<?php if($pending_designs){echo count($pending_designs);}else{echo 0;} ?>) new designs pending.</a></h3>
					<?php if ($pending_designs): ?>
						You have <?php echo count($pending_designs); ?> new <a href="<?php echo base_url() ?>user/dashboard_designs">designs</a> pending. Once your design has been approved it will be available for purchase. Most approvals occur within minutes but may take up to 48 hours. While you wait, feel free to <a href="<?php echo base_url() ?>user/add_design">upload</a> as many new designs as you like.<br />
					<?php else:?>
						No Pending Designs Found.
					<?php endif ?>
					<hr color="3b5998" />
				</div>
			</div>
		</div>
	</div>


<?php  echo msg_alert_frontend(); ?>
<div class="membership">
	<?php if(!empty($plans)) { ?>
		<?php $i=0; foreach ($plans as $row) { $i++;?>
			<?php if(!empty($row->image) && file_exists($row->image)) { ?>
				<div class="membership_div membership_<?php echo $i; ?>">
					<?php if(!empty($row->title_slug)) { ?>
						<a href="<?php echo base_url('membership/detail/'.$row->title_slug.'/#'.$i)?>" class="membership_buy left">More info <i class="fa fa-angle-right"></i></a>
				    <?php } ?>
					<a>
						<img src="<?php echo base_url($row->image);?>">
					</a>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>

<script>

	$(function() {
		
		$(".membership_div").click(function() {
			if (!$(this).hasClass("membership_div_big"))
			{
				$(".membership_div_big").removeClass( "membership_div_big" );
			}
    	});
		
		$(".membership_div img").click(function() {
			if ($(this).parent().parent().hasClass("membership_div_big"))
			{
				$(".membership_div_big").removeClass( "membership_div_big" );
			}
			else {
				$(".membership_div_big").removeClass( "membership_div_big" );
				$(this).parent().parent().addClass( "membership_div_big" );
			}
    	}); 	
	});

	
</script>


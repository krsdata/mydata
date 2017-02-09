<section id="page_content" class="">
	<!-- team section start -->
	<style type="text/css">
		.hide_team_member_detail
		{
			display: none;
		}

	</style>
	<div class="container">
		<div class="row text-center ">
			<div class="col-xs-12 col-md-12 col-sm-12">
				<h1 class="page_head ">Testimonials</h1>
			</div>
		</div>
		<?php if(!empty($testimonials)) { ?>
		<div class="row">
			<div class="team_wrapper">
				<?php $i=0; $team_member_detail=''; 
				foreach ($testimonials as $testimonials_row) {  ?>
					<?php  $i++; ?>

						<div class="col-xs-12 col-md-6 col-sm-6 <?php echo $team_member_detail;?> team_tab team_menu_<?php echo $i; ?>" >
							<div class="member_info_wrapper">
								<h1><?php if(!empty($testimonials_row->client_name)) echo ucfirst($testimonials_row->client_name); ?></h1>
								<p class="designation"><?php if(!empty($testimonials_row->location)) echo $testimonials_row->location; ?></p>
								<div class="member_discription">
									<?php if(!empty($testimonials_row->feedback)) echo $testimonials_row->feedback; ?>							
								</div>
							</div>
						</div>
				<?php $team_member_detail='hide_team_member_detail'; } ?>	
				<?php $i=0; foreach ($testimonials as $testimonials_row) {  ?>
					<?php $i++; ?>

						<div class="col-xs-12 col-md-3 col-sm-3 team_menu" id="team_menu_<?php echo $i; ?>" style="cursor: pointer;">
							<div class="member_img_wrapper">							
								<?php if(!empty($testimonials_row->thumb) && file_exists($testimonials_row->thumb)) { ?>	
									<img src="<?php echo base_url($testimonials_row->thumb); ?>" alt="" title="" />
								<?php } else {  ?>
									<img src="<?php echo base_url('assets/frontend/images/testimonial_default.jpg'); ?>" alt="" title="" />

								<?php } ?>
								<div class="member_name_wrapper">
									<h2><?php if(!empty($testimonials_row->client_name)) echo ucfirst($testimonials_row->client_name); ?></h2>
								</div>
							</div>
						</div>
					
				<?php } ?>															
			</div>

		</div>
		<?php } else { ?>
		<h3>No Testimonials Found.</h3>
		<?php }  ?>
	</div>
	<!-- team section end -->
</section>
<script type="text/javascript">

	$(document).ready(function() {

			$(".team_menu").click(function(event) 
			{
				$(".team_tab").addClass('hide_team_member_detail');
				$("."+this.id).removeClass('hide_team_member_detail');
				
			});

			var testimonial_left_height = $(".testimonial_list.testimonial_list_left").outerHeight();
		                $('.testimonial_text_wrapper').outerHeight(testimonial_left_height);


		    var testimonial_var = $(".member_info_wrapper").offset().top - 120;
		    $(".member_img_wrapper").click(function() {
		        $('html, body').stop().animate({
		            scrollTop: testimonial_var 
		        }, 500);
		    });
	});
</script>
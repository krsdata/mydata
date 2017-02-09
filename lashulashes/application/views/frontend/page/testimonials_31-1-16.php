<section id="page_content" class="">
	<!-- <div class="container">
		<div class="row text-center margin_top_40">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<h1 class="page_head margin_bottom_0">Testimonials</h1>
			</div>
		</div>

		<div class="row">
			<?php //if(!empty($testimonials)) { ?>
			    <?php //foreach ($testimonials as $row) { ?>
					<div class="col-xs-12 col-sm-12 col-md-12 testimonial_section">						
						<div class="author_img" style="background-image:url('<?php //if(!empty($row->thumb) && file_exists($row->thumb)) { echo $row->thumb; } else { echo "assets/frontend/images/testimonial_default.jpg";} ?>');"></div>
						<div class="testimonial_container">
							<p><?php //if(!empty($row->feedback)) echo $row->feedback; ?></p>
						</div>
						<p class="author_name"><?php //if(!empty($row->client_name)) echo ucfirst($row->client_name); ?> <span> <?php //if(!empty($row->location)) echo ' , '.$row->location; ?></span></p>
					</div>
				<?php //} ?>
			<?php //} ?>
		</div>
							
	</div> -->
<div class="container">

	<div class="row text-center ">
		<div class="col-xs-12 col-md-12 col-sm-12">
			<h1 class="page_head ">Testimonials</h1>
		</div>
	</div>

	<div class="row testimonial_container margin_top_40">
		<?php if(!empty($testimonials)) { ?>
				<div class="col-xs-12 col-md-4 col-sm-4">
					<div class="testimonial_list testimonial_list_left">
						<?php 
						$i=0; $testimonial_active = 'testimonial_active';
						foreach ($testimonials as $key=>$testimonials_row) { $i++; ?>
							<?php if($i < 4) {  ?>
								<div class="testimonial_single_wrapper <?php echo $testimonial_active; ?>" id="div_<?php echo $i;?>" onclick="view_tetimonial(this);">
									<div class="author_img_wrapper">
										<div style="background-image:url('<?php if(!empty($testimonials_row->thumb) && file_exists($testimonials_row->thumb)) { echo base_url($testimonials_row->thumb); } else { echo base_url('assets/frontend/images/testimonial_default.jpg');} ?>')"></div>
									</div>					
									<div class="author_info_wrapper">
										<h2><?php if(!empty($testimonials_row->client_name)) echo ucfirst($testimonials_row->client_name); ?></h2>
										<p><?php if(!empty($testimonials_row->location)) echo $testimonials_row->location; ?></p>
									</div>
									<div style="display:none;"> 
										<?php if(!empty($testimonials_row->feedback)) echo character_limiter(strip_tags($testimonials_row->feedback),490); ?> 
									</div>					
								</div>
							<?php $testimonial_active=''; } ?>
						<?php } ?>							
					</div>
				</div>
				<div class="col-xs-12 col-md-4 col-sm-4">
					<div class="testimonial_text_wrapper">
						<span>
							
						</span>
					</div>
				</div>
				<div class="col-xs-12 col-md-4 col-sm-4">
					<div class="testimonial_list testimonial_list_right" id="">
						<?php $i=0; foreach ($testimonials as $key=>$testimonials_row) { $i++; ?>
							<?php if($i > 3) {  ?>
								<div class="testimonial_single_wrapper" id="div_<?php echo $i;?>" onclick="view_tetimonial(this);">
									<div class="author_img_wrapper">
										<div style="background-image:url('<?php if(!empty($testimonials_row->thumb) && file_exists($testimonials_row->thumb)) { echo base_url($testimonials_row->thumb); } else { echo base_url('assets/frontend/images/testimonial_default.jpg');} ?>')"></div>	
									</div>					
									<div class="author_info_wrapper">
										<h2><?php if(!empty($testimonials_row->client_name)) echo ucfirst($testimonials_row->client_name); ?></h2>
										<p><?php if(!empty($testimonials_row->location)) echo $testimonials_row->location; ?></p>
									</div>
									<div style="display:none;"> 
										<?php if(!empty($testimonials_row->feedback)) echo character_limiter( strip_tags($testimonials_row->feedback),490); ?>
									</div>					
								</div>
							<?php } ?>
						<?php } ?>							
					</div>
				</div>	
		<?php } else  { ?>
		   <div class="col-md-12"><h1>No Testimonials Found</h1></div>
		<?php }?>	
	</div>

	<div class="row testimonial_pagination">
		<div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin:50px 0;">
			<!-- paginations -->
			<?php echo $pagination; ?>
		</div>
	</div>

</div>
</section>
<script type="text/javascript">
	
	$(document).ready(function() 
	{
		var temp = $("#div_1 > div:nth-child(3)").html();

		$(".testimonial_text_wrapper span").html(temp);
		
	});

	function view_tetimonial(e)
	{
		//alert(e.id);
		//testimonial_active
		$(".testimonial_single_wrapper").removeClass('testimonial_active');
		var temp = $("#"+e.id+" > div:nth-child(3)").html();
		$(".testimonial_text_wrapper span").html(temp);
		$("#"+e.id).addClass('testimonial_active');
	}
</script>
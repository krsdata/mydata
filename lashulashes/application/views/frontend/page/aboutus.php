<section id="page_content" class="">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center title_text">
				<h1 class="page_head">ABOUT LASHULASHES </h1>
			</div>
		</div>
	</div>
	<?php 
		//$arry = array('3'=>'nit');
		//$arry = json_encode($arry);
		//$arry = '{"2":"Dinner"}';
		//print_r(json_decode($arry));
	?>
	
	<?php if(!empty($about)) {?>
			<?php //print_r($about)?>
		<div class="container">
			<?php $i=1; foreach ($about as $about_row) {  ?>

				<?php if($about_row->type == 'about') { $i++; ?>
					<?php if($i%2==0) { ?>
							<div class="row margin_top_30">
								<div class="col-xs-12 col-sm-4 col-md-4 text-center about_image">
									<?php if(!empty($about_row->image) && file_exists($about_row->image)) {?>
									<img src="<?php echo base_url($about_row->image); ?>" class="img-responsive" />
									<?php } ?>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-8 about_text">
									<h1><?php if(!empty($about_row->title)) echo $about_row->title; ?></h1>
									<?php if(!empty($about_row->content)) echo $about_row->content; ?>
								</div>
							</div>
					<?php } else { ?>
							<div class="row margin_top_30">
								<div class="col-xs-12 col-sm-8 col-md-8 about_text">
									<h1><?php if(!empty($about_row->title)) echo $about_row->title; ?></h1>
									<p><?php if(!empty($about_row->content)) echo $about_row->content; ?> 
									</p>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 text-center about_image">
									<?php if(!empty($about_row->image) && file_exists($about_row->image)) {?>
										<img src="<?php echo base_url($about_row->image); ?>" class="img-responsive">
									<?php } ?>
								</div>
							</div>
					<?php } ?>
				<?php } ?>

			<?php } ?>
		</div>

		<?php 
			//round(9.5, 0, PHP_ROUND_HALF_UP);
		    $team_count=0; 
		    $testimonial_active=''; 
		    foreach ($about as $about_row)
		    {
				if($about_row->type == 'team') 
				{
					$team_count++;
				}
			}
			if($team_count>0)
			{
				$team_count = $team_count/2;
				$team_count = round($team_count,0,PHP_ROUND_HALF_UP);
				$team_count++;
			}

		?>
		<?php if($team_count) { ?>
		<!-- team section start -->
		<div class="container team_container">
			<div class="row text-center">
				<div class="col-xs-12 col-md-12 col-sm-12">
					<h1 class="page_head">Our Team</h1>
				</div>
			</div>
			<div class="row">
				<div class="team_wrapper">
					<!-- left ssection start -->
					<div class="col-xs-12 col-md-4 col-sm-12">
						<div class="testimonial_list testimonial_list_left">
							<?php $i=0; $testimonial_active='testimonial_active'; foreach ($about as $about_row) {  ?>
								<?php if($about_row->type == 'team') { $i++; ?>
									<?php if($i < $team_count) {  ?>
										<div class="testimonial_single_wrapper <?php echo $testimonial_active; ?>" id="div_<?php echo $i;?>" onclick="view_tetimonial(this);">
											<div class="author_img_wrapper">
												<div style="background-image:url('<?php if(!empty($about_row->thumb) && file_exists($about_row->thumb)) { echo base_url($about_row->thumb); } else { echo base_url('assets/frontend/images/testimonial_default.jpg');} ?>')"></div>
											</div>					
											<div class="author_info_wrapper">
												<h2><?php if(!empty($about_row->title)) echo ucfirst($about_row->title); ?></h2>
												<p><?php if(!empty($about_row->post)) echo $about_row->post; ?></p>
											</div>
											<div style="display:none;"> 
												<?php if(!empty($about_row->content)) echo character_limiter(strip_tags($about_row->content),490); ?> 
											</div>					
										</div>
									<?php $testimonial_active=''; } ?>
								<?php } ?>	
							<?php } ?>
						</div>
					</div>
					<!-- left section end -->
					<!-- middle section start -->
					<div class="col-xs-12 col-md-4 col-sm-12">
						<div class="testimonial_text_wrapper" style="min-height:494px;">
							<span>
								
							</span>
						</div>
					</div>
					<!-- middlle section end -->
					<div class="col-xs-12 col-md-4 col-sm-12">
						<div class="testimonial_list testimonial_list_right" id="">
							<?php $i=0; $testimonial_active=''; foreach ($about as $about_row) {  ?>
								<?php if($about_row->type == 'team') { $i++; ?>
									<?php if($i >=  $team_count) {  ?>
										<div class="testimonial_single_wrapper <?php echo $testimonial_active; ?>" id="div_<?php echo $i;?>" onclick="view_tetimonial(this);">
											<div class="author_img_wrapper">
												<div style="background-image:url('<?php if(!empty($about_row->thumb) && file_exists($about_row->thumb)) { echo base_url($about_row->thumb); } else { echo base_url('assets/frontend/images/testimonial_default.jpg');} ?>')"></div>
											</div>					
											<div class="author_info_wrapper">
												<h2><?php if(!empty($about_row->title)) echo ucfirst($about_row->title); ?></h2>
												<p><?php if(!empty($about_row->post)) echo $about_row->post; ?></p>
											</div>
											<div style="display:none;"> 
												<?php if(!empty($about_row->content)) echo character_limiter(strip_tags($about_row->content),490); ?> 
											</div>					
										</div>
									<?php $testimonial_active=''; } ?>
								<?php } ?>	
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		<!-- team section end -->
		<?php } ?>
		<!-- charity section start -->
		<div class="container charity_container">
			<div class="row text-center">
				<div class="col-xs-12 col-md-12 col-sm-12">
					<h1 class="page_head">CHARITY</h1>					
				</div>
			</div>
			<div class="row charity_wrapper">

				<ul class="nav nav-pills nav-stacked col-xs-12 col-sm-5 col-md-5">
					<?php $i=0; $active_cha = 'active'; foreach ($about as $about_row) {  ?>
						<?php if($about_row->type=='charity') { $i++; ?>
							<li class="<?php echo $active_cha; ?>">
								<a href="#tab_<?php echo $i;?>" data-toggle="pill">
									<div class="charity_date_wrapper">								
										<span><?php echo date('d',strtotime($about_row->date));?></span>
										<span><?php echo date('M',strtotime($about_row->date));?></span>
										<span><?php echo date('Y',strtotime($about_row->date));?></span>
									</div>
									<div class="charity_title">
										<h2><?php if(!empty($about_row->title)) echo ucfirst($about_row->title); ?></h2>
										<p>"<?php if(!empty($about_row->short_content)) echo character_limiter($about_row->short_content,130);  ?>"</p>
									</div>
								</a>
							</li>
						<?php $active_cha=''; } ?>
					<?php } ?>

				</ul>
				<div class="tab-content col-xs-12 col-sm-7 col-md-7">
					<?php $i=0; $active_cha = 'active'; foreach ($about as $about_row) {  ?>
						<?php if($about_row->type=='charity') { $i++; ?>
						    <div class="tab-pane <?php echo $active_cha;?>" id="tab_<?php echo $i;?>">
						    	<?php if(!empty($about_row->content)) echo $about_row->content; ?>
						    </div>
						<?php $active_cha=''; } ?>
					<?php } ?>
				</div><!-- tab content -->

			</div>		
		</div>

	<?php } ?>

</section>
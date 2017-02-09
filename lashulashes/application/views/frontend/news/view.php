<section id="page_content" class="more_content">
	
	<div class="container">
		<div class="row about_row1 text-center">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<p class="page_head margin_cutter">NEWS</p>
			</div>
		</div>
		<div class="row about_row2 row_gap">
			<div class="col-xs-12 col-sm-8 col-md-9">
			    <h3><?php if($news[0]->post_title) { echo ucfirst($news[0]->post_title); } ?> </h3>
				<!-- <p class="section_text">
					<img src="<?php //if(!empty($news[0]->news_image) && file_exists($news[0]->news_image)){ echo base_url($news[0]->news_image); } else { echo base_url('assets/frontend/images/news_default3.png'); } ?>" class="blog_image" width="100%">
				</p> -->
				<p class="section_text">
				  <?php echo $news[0]->post_content; ?>
				</p>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3 blog_sidebar">
				<aside class="sidebar_aside aside_one">
					<p class="aside_head">Popular news</p>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="row">
								 <?php if(!empty($latest_news)) {

                         			 foreach($latest_news as $l_news){
					      			 ?>
										<div class="col-xs-12 col-sm-12 col-md-12">
											<p class="aside_post_head"><a href="<?php echo base_url('news/view/'.$offset.'/'.$l_news->post_slug) ?>">	<b> <?php echo character_limiter($l_news->post_title,30); ?> </b></a></p>
											<div class="aside_post_detail">
													<p class="aside_post_date"><?php echo date('M d, Y',strtotime($l_news->created_at)); ?></p>
													<p class="aside_post_date"><?php if(!empty($l_news->post_content)) echo character_limiter($l_news->post_content,50); ?></p>
											</div>
										<hr>
										</div>

								 <?php } }  ?>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>

	
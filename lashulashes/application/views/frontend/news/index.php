<section id="page_content" class="blog_content">
	<div class="container">
		<div class="row blog_row1 text-center">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<p class="page_head margin_cutter">News</p>
			</div>
		</div>
		<div class="row top_buffer_40">
			<div class="col-xs-12 col-sm-8 col-md-9">
			    <?php if (!empty($news)): ?>
 				<div class="row">
				  <?php 
				  for($i=0;$i<count($news);$i++)
                  {
                 ?>
							<!-- <div class="col-xs-12 col-sm-4 col-md-4">
								 <div class="blog_container">
									<p class="post_head"><a href="singlepost.php"><?php //echo $news[$i]->post_title; ?></a></p>
									<div class="post_detail"><p class="post_date"><?php //echo date('d M, Y',strtotime($news[$i]->created_at)); ?></p></div>
									<p class="post_description"> <?php //echo substr($news[$i]->post_content,0,400); ?>
									 <?php //if(strlen($news[$i]->post_content)>400) { ?>
									 <a href="<?php //echo base_url('news/view/'.$offset.'/'.$news[$i]->post_slug) ?>">Read More</a>
									 <?php //} ?>
									 </p>
								</div> 
							</div> -->
							<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="blog_container">
									<!-- <img src="<?php //if(!empty($news[$i]->news_thumb) && file_exists($news[$i]->news_thumb)){ echo base_url($news[$i]->news_thumb); } else { echo base_url('assets/frontend/images/news_default.png'); } ?>" class="blog_image" height="132px"> -->
									    <p class="post_head">
									        <a href="<?php if(!empty($news[$i]->post_slug)) { echo base_url('news/view/'.$offset.'/'.$news[$i]->post_slug); }?>"><?php if(!empty($news[$i]->post_title)) echo character_limiter($news[$i]->post_title,25); ?></a>
									    </p>
									<div class="post_detail">
									    <p class="post_date"><?php echo date('d M, Y',strtotime($news[$i]->created_at));?></p>
									    <!-- <p class="post_categorie">Categorie Name</p> -->
									</div>
									<p class="post_description"><?php if(!empty($news[$i]->post_content)) echo character_limiter($news[$i]->post_content,300); ?> <?php if(!empty($news[$i]->post_slug)) { ?><a href="<?php echo base_url('news/view/'.$offset.'/'.$news[$i]->post_slug);?>">Read More</a> <?php } ?>
									</p>
								</div>						
							</div>
					<?php }   ?>
					

				</div>

               <?php 
             
                 echo $pagination;
                else: ?>
                <div class="row"> No news found. </div>
                <?php endif; ?>
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
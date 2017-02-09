<!-- POP POSTS -->
<div class="row">
	<?php if(!empty($pop_blogs)) { ?>
		<div class="detail_content">
			<div class="col-xs-12 col-sm-12 col-md-12 detail_recent">POP POSTS</div>
			<div class="clearfix"></div>
			<div class="detail_smallpost">
				<a href="#">
					<div class="col-xs-6">
						<img src="images/blog/charity.jpg">
					</div>
					<div class="col-xs-6">
						<li>25 NOV '15<br>Event Title</li>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div style="margin-bottom: 10px;"></div>
	<?php } ?>
</div>
<!-- POP POSTS END-->


<!-- RECENT POSTS -->
<div class="row">
	<?php if(!empty($latest_blogs)) { ?>
		<div class="detail_content">
			<div class="col-xs-12 col-sm-12 col-md-12 detail_recent">RECENT POSTS</div>

			<?php foreach($latest_blogs as $blogs) { ?>
				<?php if(!empty($blogs->blog_slug) && !empty($blogs->blog_created) && !empty($blogs->blog_title) && !empty($blogs->blog_thumb) && file_exists($blogs->blog_thumb)) { ?>
					<div class="detail_smallpost">
						<a href="<?php echo base_url('blog/view/'.$blogs->blog_slug) ?>">
							<div class="col-xs-12 col-sm-4 col-md-4">
								<img src="<?php echo base_url().$blogs->blog_thumb; ?>">
							</div>
							<div class="col-xs-12 col-sm-8 col-md-8 small_post_text">
								<p><?php echo date('d M, Y',strtotime($blogs->blog_created)); ?></p>
								<p><?php echo $blogs->blog_title; ?></p>
							</div>
						</a>
					</div>
				<?php } ?>
			<?php } ?>		
		</div>
		<div style="margin-bottom: 10px;"></div>
	<?php  } ?>
</div>
<!-- RECENT POSTS -->


<!-- CATEGORIES -->
<div class="row">
	<?php if(!empty($category)) { ?>
		<div class="detail_content">
			<div class="col-xs-12 detail_recent">MEDIA CATEGORIES</div>
			<div class="clearfix"></div>
			<div class="col-xs-12">
				<ul class="media_categories_list">
				 	<?php foreach($category as $cat) 
				     	{ 
				     		if(!empty($cat->category_slug)&&!empty($cat->category_name)) { ?>
				     		
				     			<li>
				     				<a href="<?php echo base_url('blog?Categories='.$cat->category_slug); ?>"><?php echo $cat->category_name; ?></a>
				     			</li>
				     		
							
							<?php } ?>
					<?php }?>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div style="margin-bottom: 10px;"></div>
	<?php } ?>
</div>
<!-- CATEGORIES END  -->


<!-- TAG -->
<div class="row">
	<?php if(!empty($tags)) { ?>
		<div class="detail_content">
			<div class="col-xs-12 detail_recent">TAGS</div>
			<div class="clearfix"></div>
			<div style="margin-bottom: 20px;"></div>
			<div class="col-xs-12">
			    <?php foreach ($tags as $row_tag) { ?>
			    		<?php if(!empty($row_tag)) { ?>
							<div class="tag_cloud"><a href="<?php echo base_url('blog?Tag='.$row_tag); ?>"><?php echo  $row_tag ?></a></div>
						<?php } ?>
			    <?php }?>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php } ?>
</div>
<!-- TAG END -->

<div style="margin-bottom: 50px;"></div>

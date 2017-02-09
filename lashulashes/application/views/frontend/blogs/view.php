<div class="detail_page" id="">
	<div class="container">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<div class="detail_content">
					<div class="col-xs-12 text-center blog_title">
						<?php if(!empty($blogs->blog_title)) echo ucfirst($blogs->blog_title);?>
					</div>
					<div class="clearfix"></div>
					<div style="margin-bottom: 10px;"></div>
					<div class="col-xs-6 detail_subtitle" style="text-align:left;">
						<?php  if(!empty($blogs->blog_created)) { echo date('d M, Y',strtotime($blogs->blog_created)); }?>
					<!-- </div>
					<div class="col-xs-6 detail_subtitle" style="text-align:right;"> -->
						<?php if(!empty($blogs->category_name)) { echo '[Posatge Under - '.ucfirst($blogs->category_name).']'; }?>
						
					</div>
					<div class="clearfix"></div>
					<div class="col-xs-12 detail_subtitle">
						<?php if(!empty($blogs->blog_tag)) { ?>
							<?php foreach(explode(',', $blogs->blog_tag) as $row_tag) { ?>
							<div class="tag_cloud">
								<a href="<?php echo base_url('blog?Tag='.$row_tag); ?>" ><?php echo $row_tag; ?></a>
							</div>
							<?php } ?>

						<?php } ?>
					</div>
					<div class="clearfix"></div>
					<div style="margin-bottom: 10px;"></div>
					<div class="col-xs-12 detail_text">
						<?php //if(!empty($blogs->blog_image) && file_exists($blogs->blog_image) ) { ?>
						    <!-- <img src="<?php //echo base_url($blogs->blog_image); ?>"> -->
						<?php //} ?>
						<div style="margin-bottom: 10px;"></div>
						<?php if(!empty($blogs->blog_description)) { ?>
						<p> <?php echo $blogs->blog_description; ?></p>
						<?php } ?>
					</div>
					<div class="clearfix"></div>
					<div class="share_bar">
						<!-- <a class="share_bar_item"><i class="fa fa-share-alt" style="color: #ec008c;"></i></a>
						<a href="#" class="share_bar_item"><i class="fa fa-facebook-official"></i></a>
						<a href="#" class="share_bar_item"><i class="fa fa-flickr"></i></a>
						<a href="#" class="share_bar_item"><i class="fa fa-instagram"></i></a>
						<a href="#" class="share_bar_item"><i class="fa fa-twitter"></i></a>
						<a href="#" class="share_bar_item"><i class="fa fa-pinterest-p"></i></a> -->
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56b09386c80de471" async="async"></script>
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<div class="addthis_sharing_toolbox pull-left" ></div>
					</div>
					<div class="clearfix"></div>
					<?php if(user_logged_in()) { ?>
						<div class="detail_add_comment">
							<h2>Comments</h2>
							<div class="col-xs-3">
								<div class="comment_pic">
									<img src="<?php echo user_image();?>">
								</div>
							</div>
							<div class="col-xs-9">
								<div style="margin-bottom: 10px;"></div>
								<span class="form_carot" id="comment_error_text"></span>
								<textarea cols="6" rows="6" placeholder="Add a comments" class="comments" id="blog_comment"></textarea>
								<button type="" class="tag_cloud pull-right" onclick="submit_comment()">Add Comment</button>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php } ?>

					<?php if(!empty($comments)) { ?>
						<?php foreach ($comments as $row_comment) { ?>
							
							<div class="detail_comments_list">
								<div class="col-xs-2">
									<p><?php if(!empty($row_comment->created)) { echo date('d M, Y',strtotime($row_comment->created)); }?></p>
									<div class="comment_pic">
										<?php if(!empty($row_comment->image) && file_exists($row_comment->image))
												{
													$comment_image = base_url($row_comment->image);
												}
												else
												{
													$comment_image = base_url('assets/frontend/images/user_image.jpg');
												}
										?>
										<img src="<?php echo $comment_image; ?>">
									</div>
									<p><?php if(!empty($row_comment->first_name)) echo $row_comment->first_name; if(!empty($row_comment->last_name)) echo ' '.$row_comment->last_name; ?></p>
								</div>
								<div class="col-xs-10">
									<div class="comments_text">
										<p><?php if(!empty($row_comment->comment)) echo $row_comment->comment; ?></p>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>

						<?php } ?>
					<?php } ?>

				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3">
				<?php $this->load->view("frontend/blogs/sidebar.php");?>
			</div>
	</div>
</div>
<script>
	

	function submit_comment()
	{
		var blog_id = <?php echo $blogs->blog_id; ?>
		// alert('ok');
		var comment = $('#blog_comment').val();
		//alert(comment);
		if(comment==''||comment==null)
		{
			$('#blog_comment').focus();
            $("#comment_error_text").removeClass('text-info');
			$("#comment_error_text").addClass('form_carot');
			$("#comment_error_text").html('Please add message');
		}
		else
		{
			$.post('<?php echo base_url("blog/add_comment"); ?>',{ blog_id:blog_id,comment:comment},
                    function(data) 
                    {
                    	if(data.status == 1)
                    	{
                    		$("#comment_error_text").removeClass('form_carot');
                    		$("#comment_error_text").addClass('text-info');
                    		$("#comment_error_text").html('Comment submitted successfully.');
                    		$('#blog_comment').val('');
                    	}
                    	if(data.status == 2)
                    	{
                    		window.location = "<?php echo base_url('website/login');?>";
                    	}
                    	if(data.status == 0)
                    	{
                    		$("#comment_error_text").removeClass('text-info');
                    		$("#comment_error_text").addClass('form_carot');
                    		$("#comment_error_text").html('Please try again');
                    	}

                    });
		}
	}
</script>
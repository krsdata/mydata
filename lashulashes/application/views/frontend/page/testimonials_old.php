<style type="text/css">
	


	/* testimonials */

.testimonial_section{
	margin-top: 30px;
}

/*
.testimonial_section img{
	float: left;
	border-radius: 50%;
	width: 175px;
}
*/

.testimonial_container {
    margin-left: 200px;
	background: rgb(255, 155, 214) none repeat scroll 0% 0%;
	padding: 25px;
	color: rgb(255, 255, 255);
	font-size: 16px;
	margin-top: 10px;    
	position: relative;
	box-shadow: 2px 2px 2px #ABABAB;
}

.testimonial_container::after{
	content: "";
	position: absolute;
	top: 30%;
	left: -18px;
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 0px 0px 18px 18px;
	border-color: transparent transparent #FF9BD6;
}

.author_img{
	background-size: cover;
	background-position: center;
	float: left;
	border-radius: 50%;
	width: 175px;
	height: 175px;
}

/*
.testimonial_container p{
	text-indent: 35px;
}

.testimonial_container p::before{
	content: "";
	background-image: url('../images/testimonial/testimonial_quote.png');
	background-size: contain;
	background-position: center;
	background-repeat: no-repeat;
	width: 40px;
	height: 40px;
	opacity: 0.1;
	position: absolute;
	top:20px;
	left: 25px;
}
*/

.author_name{
    margin-left: 200px;
    font-size: 15px;
	font-weight: 600;
	margin-top: 10px;
	color: #2A2929;
}

.author_name span{
	color: #9C9C9C;
	margin-left: 5px;
}

</style>

<section id="page_content" class="">
	<div class="container">
		<div class="row text-center margin_top_40">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<h1 class="page_head margin_bottom_0">Testimonials</h1>
			</div>
		</div>

		<div class="row">
			<?php if(!empty($testimonials)) { ?>
			    <?php foreach ($testimonials as $row) { ?>
					<div class="col-xs-12 col-sm-12 col-md-12 testimonial_section">						
						<div class="author_img" style="background-image:url('<?php if(!empty($row->thumb) && file_exists($row->thumb)) { echo $row->thumb; } else { echo "assets/frontend/images/testimonial_default.jpg";} ?>');"></div>
						<div class="testimonial_container">
							<p><?php if(!empty($row->feedback)) echo $row->feedback; ?></p>
						</div>
						<p class="author_name"><?php if(!empty($row->client_name)) echo ucfirst($row->client_name); ?> <span> <?php if(!empty($row->location)) echo ' , '.$row->location; ?></span></p>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
							
	</div>
</section>
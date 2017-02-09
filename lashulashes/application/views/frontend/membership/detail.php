
<!-- <div class="membership_detail">
	<div class="container margin_top_70">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-6">
				<div class="discount_info">
					<?php //if(!empty($detail->image) && file_exists($detail->image)) { ?>
						<img src="<?php //echo base_url($detail->image);?>">
					<?php //} ?>
				</div>
			</div>				
			<div class="col-xs-12 col-sm-8 col-md-6">
				<h1 class="margin_top_0"><?php //if(!empty($detail->title)) echo $detail->title;?> Membership</h1>
				<div class="section_text"><?php //if(!empty($detail->description)) echo $detail->description;?></div>
				<h2><pink>Renewal Price $<?php //if(!empty($detail->amount)) echo $detail->amount; ?> RRP</pink></h2>
				<a href="<?php //echo base_url('membership/buy_now/'.$detail->title_slug); ?>" class="buy margin_top_30 ">Buy now</a>
			</div>
		</div>
	</div>
	<div class="silk">
		<img src="<?php //echo FRONTEND_THEME_URL_NEW; ?>images/silk.png">
	</div>
</div> -->
<div class="swiper-container membership_detail_con">
	<div class="swiper-wrapper">
		<div class="membership_detail swiper-slide" data-hash="1">
			<div class="membership_detail_back" data-swiper-parallax="-50%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_bronze_bg.png'); ?>">
			</div>
			<div class="membership_detail_back" data-swiper-parallax="150%" >
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_bronze.png'); ?>">
			</div>
			<div class="container">
				<div class="col-xs-12 lead" data-swiper-parallax="100%">
					<h1><strong>BRONZE LEVEL</strong></h1>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-6 lead membership_detail_des" data-swiper-parallax="-100%">
					<li>Email Subscription</li>
					<li>10% Off Any new product on first order</li>
					<li>Gift on your Birthday</li>
					<li>Renewal Price $55 RRP</li>
				</div>
				<div class="col-xs-6" data-swiper-parallax="50%">
					<div class="discount_info">
						<img src="<?php echo base_url('assets/frontend/images/member_ship/member_bronze.png'); ?>">
					</div>
					<a href="<?php echo base_url('membership/checkout/'.$this->uri->segment(3)); ?>" class="btn buy">Buy now</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="silk" data-swiper-parallax="-150%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/silk.png'); ?>">
			</div>
		</div>
		
		<div class="membership_detail swiper-slide" data-hash="2">
			<div class="membership_detail_back" data-swiper-parallax="-50%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_silver_bg.png'); ?>">
			</div>
			<div class="membership_detail_back" data-swiper-parallax="150%" >
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_silver.png'); ?>">
			</div>
			<div class="container">
				<div class="col-xs-12 lead" data-swiper-parallax="100%">
					<h1><strong>SILVER STATUS</strong></h1>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-6 lead membership_detail_des" data-swiper-parallax="-100%">
					<li>Email Subscription</li>
					<li>20% Off Any new product on first order</li>
					<li>Gift on your Birthday</li>
					<li>Renewal Price $88 RRP</li>
				</div>
				<div class="col-xs-6" data-swiper-parallax="50%">
					<div class="discount_info">
						<img src="<?php echo base_url('assets/frontend/images/member_ship/member_silver.png'); ?>">
					</div>
					<a href="<?php echo base_url('membership/checkout/'.$this->uri->segment(3)); ?>" class="btn buy">Buy now</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="silk" data-swiper-parallax="-150%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/silk.png'); ?>">
			</div>
		</div>
		
		<div class="membership_detail swiper-slide" data-hash="3">
			<div class="membership_detail_back" data-swiper-parallax="-50%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_gold_bg.png'); ?>">
			</div>
			<div class="membership_detail_back" data-swiper-parallax="150%" >
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_gold.png'); ?>">
			</div>
			<div class="container">
				<div class="col-xs-12 lead" data-swiper-parallax="100%">
					<h1><strong>GOLD MEMBER</strong></h1>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-6 lead membership_detail_des" data-swiper-parallax="-100%">
					<li>Email Subscription</li>
					<li>24 Hour Support Direct Access</li>
					<li>30% Off Any new product on first order</li>
					<li>Gift on your Birthday</li>
					<li>Renewal Price $110 RRP</li>
				</div>
				<div class="col-xs-6" data-swiper-parallax="50%">
					<div class="discount_info">
						<img src="<?php echo base_url('assets/frontend/images/member_ship/member_gold.png'); ?>">
					</div>
					<a href="<?php echo base_url('membership/checkout/'.$this->uri->segment(3)); ?>" class="btn buy">Buy now</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="silk" data-swiper-parallax="-150%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/silk.png'); ?>">
			</div>
		</div>
		
		<div class="membership_detail swiper-slide" data-hash="4">
			<div class="membership_detail_back" data-swiper-parallax="-50%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_platinum_bg.png'); ?>">
			</div>
			<div class="membership_detail_back" data-swiper-parallax="150%" >
				<img src="<?php echo base_url('assets/frontend/images/member_ship/background_platinum.png'); ?>">
			</div>
			<div class="container">
				<div class="col-xs-12 lead" data-swiper-parallax="100%">
					<h1><strong>PLATINUM PARTNER</strong></h1>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-6 lead membership_detail_des" data-swiper-parallax="-100%">
					<li>Email Subscription</li>
					<li>24 Hour Support Direct Access</li>
					<li>50% Off Any new product on first order</li>
					<li>Birthday Voucher $110</li>
					<li>Gift on your Birthday</li>
					<li>Free Shipping</li>
					<li>Website Ranking</li>
					<li>Emblem of Accreditation</li>
					<li>Renewal Price $220 RRP</li>
				</div>
				<div class="col-xs-6" data-swiper-parallax="50%">
					<div class="discount_info">
						<img src="<?php echo base_url('assets/frontend/images/member_ship/member_platinum.png'); ?>">
					</div>
					<a href="<?php echo base_url('membership/checkout/'.$this->uri->segment(3)); ?>" class="btn buy">Buy now</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="silk" data-swiper-parallax="-150%">
				<img src="<?php echo base_url('assets/frontend/images/member_ship/silk.png'); ?>">
			</div>
		</div>
		
	</div>
	<div class="swiper-pagination"></div>
</div>

<script>
	$(function() {
        var swiperHome = new Swiper('.swiper-container', {
	        effect: 'flip',
	        hashnav: true,
	        slidesPerView: 'auto',
	        pagination: '.swiper-pagination',
	        paginationClickable: true,
	        speed: 600,
	        parallax: true,
	        mousewheelControl: true,
	        mousewheelForceToAxis: true,
	        mousewheelReleaseOnEdges: true,
	        direction: 'vertical'
	    });
    });
</script>
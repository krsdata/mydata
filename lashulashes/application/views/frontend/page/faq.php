<?php 
    $type1=0;
    $type2=0;
    $type3=0;
    $type4=0;
if(!empty($faqs)) 
{ 
	foreach ($faqs as $value) 
	{
		if($value->type==1) $type1++;
		if($value->type==2) $type2++;
		if($value->type==3) $type3++;
		if($value->type==4) $type4++;
	}
}
?>
<section id="page_content" class="">
		
		<div class="container-fluid faq_container">

			<div class="row text-center" >
				<div class="col-xs-12 col-md-12 col-sm-12">
					<h1 class="page_head"> FAQ - DID YOUR KNOW?</h1>
				</div>
			</div>

			<div class="row margin_top_30 faq_row">
				<div class="col-xs-12 col-md-12 col-sm-12 nav_tab_col">
					<ul class="nav nav-tabs">
						<?php if($type1>0) { ?>
							<li class="active"><a data-toggle="tab" href="#tab1">Wearing Lashes</a></li>
						<?php } ?>
						<?php if($type2>0) { ?>
							<li <?php if($type1<1) echo 'class="active"'; ?> ><a data-toggle="tab" href="#tab2">Learning Lashes</a></li>
						<?php } ?>
						<?php if($type3>0) { ?>
							<li <?php if($type1<1 && $type2<1) echo 'class="active"'; ?> ><a data-toggle="tab" href="#tab3">Purchasing Lashes</a></li>
						<?php } ?>
						<?php if($type4>0) { ?>
							<li <?php if($type1<1 && $type2<1 && $type3<1) echo 'class="active"'; ?>><a data-toggle="tab" href="#tab4">Other</a></li>
						<?php } ?>
						<?php if($type1<1 && $type2<1 && $type3<1 && $type4	<1) { ?>
							<li><a><pink>No FAQ Found</pink></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-xs-12 col-md-12 col-sm-12 tab_content_col">
					<div class="tab-content">
						<?php if($type1>0) { ?>
							<div id="tab1" class="tab-pane fade in active">
								<!-- *************** -->
								<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
			                       	<?php  
			                       		$in = 'in';
			                       		$minus = '<i class="glyphicon glyphicon-minus"></i>';

			                       	foreach ($faqs as $key => $value) 
									{ ?>
										<?php if($value->type==1) { ?>
											<!-- faq ans and qus -->
					                        <div class="panel panel-default">
					                            <div class="panel-heading">
					                                <a data-toggle="collapse" data-parent="#accordion1" href="#faq-sub-<?php echo $key;?>">
					                                    <h4 class="panel-title">
					                                    	<span class=""><?php echo $minus; ?></span>
					                                        <?php if(!empty($value->question)) echo ucfirst($value->question); ?>
					                                    </h4>
					                                </a>
					                            </div>
					                            <div id="faq-sub-<?php echo $key;?>" class="panel-collapse collapse <?php echo $in; ?>">
					                                <div class="panel-body">
					                                    <?php if(!empty($value->answer)) echo ucfirst($value->answer); ?>
					                                </div>
					                            </div>
					                        </div>
					                        <!-- faq ans and qus -->
						                    <?php 
						                    	$in = '';
				                       			$minus = '<i class="glyphicon glyphicon-plus"></i>';
				                       		?>
					                    <?php } ?>
				                    <?php } ?>

								</div>
								<!-- ******************* -->
							</div>
						<?php } ?>
						<?php if($type2>0) { ?>
							<div id="tab2" class="tab-pane fade <?php if($type1<1) echo 'in active'; ?>">
								<!-- *************** -->
								<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
			                        
									<?php
										$in = 'in';
			                       		$minus = '<i class="glyphicon glyphicon-minus"></i>'; 	
			                       	foreach ($faqs as $key => $value) 
									{ ?>
										<?php if($value->type==2) { ?>
											<!-- faq ans and qus -->
					                        <div class="panel panel-default">
					                            <div class="panel-heading">
					                                <a data-toggle="collapse" data-parent="#accordion2" href="#faq-sub-<?php echo $key;?>">
					                                    <h4 class="panel-title">
					                                    	<span class=""><?php echo $minus; ?></span>
					                                        <?php if(!empty($value->question)) echo ucfirst($value->question); ?>
					                                    </h4>
					                                </a>
					                            </div>
					                            <div id="faq-sub-<?php echo $key;?>" class="panel-collapse collapse <?php echo $in; ?>">
					                                <div class="panel-body">
					                                    <?php if(!empty($value->answer)) echo ucfirst($value->answer); ?>
					                                </div>
					                            </div>
					                        </div>
					                        <!-- faq ans and qus -->
					                        <?php 
						                    	$in = '';
				                       			$minus = '<i class="glyphicon glyphicon-plus"></i>';
				                       		?>
					                    <?php } ?>
				                    <?php } ?>

								</div>
								<!-- ******************* -->
							</div>
						<?php } ?>
						<?php if($type3>0) { ?>
							<div id="tab3" class="tab-pane fade <?php if($type1<1 && $type2<1) echo 'in active'; ?>">
								<!-- *************** -->
								<div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
			                        
			                        <?php
			                        	$in = 'in';
			                       		$minus = '<i class="glyphicon glyphicon-minus"></i>';	
			                       	foreach ($faqs as $key => $value) 
									{ ?>
										<?php if($value->type==3) { ?>
											<!-- faq ans and qus -->
					                        <div class="panel panel-default">
					                            <div class="panel-heading">
					                                <a data-toggle="collapse" data-parent="#accordion3" href="#faq-sub-<?php echo $key;?>">
					                                    <h4 class="panel-title">
					                                    	<span class=""><?php echo $minus; ?></span>
					                                        <?php if(!empty($value->question)) echo ucfirst($value->question); ?>
					                                    </h4>
					                                </a>
					                            </div>
					                            <div id="faq-sub-<?php echo $key;?>" class="panel-collapse collapse <?php echo $in; ?>">
					                                <div class="panel-body">
					                                    <?php if(!empty($value->answer)) echo ucfirst($value->answer); ?>
					                                </div>
					                            </div>
					                        </div>
					                        <!-- faq ans and qus -->
					                        <?php 
						                    	$in = '';
				                       			$minus = '<i class="glyphicon glyphicon-plus"></i>';
				                       		?>
					                    <?php } ?>
				                    <?php } ?>

								</div>
								<!-- ******************* -->
							</div>
						<?php } ?>
						<?php if($type4>0) { ?>
							<div id="tab4" class="tab-pane fade <?php if($type1<1 && $type2<1 && $type3<1) echo 'in active'; ?>">
								<!-- *************** -->
								<div class="panel-group" id="accordion4" role="tablist" aria-multiselectable="true">
			                        

			                        <?php
			                        	$in = 'in';
			                       		$minus = '<i class="glyphicon glyphicon-minus"></i>'; 	
			                       	foreach ($faqs as $key=>$value) 
									{ ?>
										<?php if($value->type==4) { ?>
											<!-- faq ans and qus -->
					                        <div class="panel panel-default">
					                            <div class="panel-heading">
					                                <a data-toggle="collapse" data-parent="#accordion4" href="#faq-sub-<?php echo $key;?>">
					                                    <h4 class="panel-title">
					                                    	<span class=""><?php echo $minus; ?></span>
					                                        <?php if(!empty($value->question)) echo ucfirst($value->question); ?>
					                                    </h4>
					                                </a>
					                            </div>
					                            <div id="faq-sub-<?php echo $key;?>" class="panel-collapse collapse <?php echo $in; ?>">
					                                <div class="panel-body">
					                                    <?php if(!empty($value->answer)) echo ucfirst($value->answer); ?>
					                                </div>
					                            </div>
					                        </div>
					                        <!-- faq ans and qus -->
					                        <?php 
						                    	$in = '';
				                       			$minus = '<i class="glyphicon glyphicon-plus"></i>';
				                       		?>
					                    <?php } ?>
				                    <?php } ?>

								</div>
								<!-- ******************* -->
							</div>
						<?php } ?>			
					</div>

				</div>
			</div>
		</div>
</section>
<script>
	$(document).ready(function() {
	    $('.collapse').on('show.bs.collapse', function() {
	        var id = $(this).attr('id');
	        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
	        $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-minus"></i>');
	    });
	    $('.collapse').on('hide.bs.collapse', function() {
	        var id = $(this).attr('id');
	        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
	        $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-plus"></i>');
	    });
	});
</script>
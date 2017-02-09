	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li class="active"><?php if(!empty($page->post_title)) { echo $page->post_title;  }  ?></li>
				</ul>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
               
			<?php 
               if(!empty($page))
               {
               	 echo $page->post_content;
               }
               else{

                   }
             ?>  
		
			</div>
		</div>
	</div>
	</section>
	
<section id="page_content" class="more_content">
		<div class="container">
		<div class="row about_row1 text-center">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<p class="page_head margin_cutter">

					<?php if(!empty($page->post_title)) {
						if($page->post_slug == 'terms-condition')
						{
							 echo "Terms And Condition";
						}else {
							 echo $page->post_title;  } } ?> 
				</p>
			</div>
		</div>
		<div class="row about_row2 row_gap">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<p class="section_text">  <?php 
               if(!empty($page))
               {
               	 echo $page->post_content;
               }
               else{
                    echo "No detail found.";
                  } 
             ?>    </p>
			</div>
		</div>
	</div>
</section>

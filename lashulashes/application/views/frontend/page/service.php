<section id="page_content" class="more_content">
		<div class="container">
		<div class="row about_row1 text-center">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<p class="page_head margin_cutter"><?php if(!empty($page->post_title)) echo $page->post_title;?></p>
			</div>
		</div>
		<div class="row about_row2 row_gap">
			
			 <?php 
               if(!empty($page))
               {
               	 echo $page->post_content;
               }
               else{
                    echo "<p class='section_text'></p>";
                  } 
             ?>    
			
		</div>
	</div>
</section>

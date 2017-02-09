<div class="blog_wrapper">
	<div class="col-xs-12 text-center page_titile">
		<?php 
		 	if($_GET) 
		 	{
				echo "<h1><a href='".base_url('blog')."' style='color:#000;'> Media </a></h1>";
		 	}
		 	else
		 	{
		 		echo "<h1 class='page_head'> Media </h1>";
		 	}

		?>
	</div>
	<div class="clearfix"></div>
	<div class="col-xs-12 text-center type_filter">
        <ul id="filters">
    		<li data-filter="*" class="type <?php if(empty($get) || isset($_GET['Tag']) ) { echo 'act'; } ?>"><a href="<?php if(!empty($get) && !isset($_GET['Tag']) ) { echo base_url('blog'); } else { echo "#"; } ?>">Show All</a></li>
            <!-- <li data-filter=".social" class="type" ><a href="<?php //if(isset($_GET['Categories'])) { echo base_url('blog'); } else { echo "#"; } ?>">Social</a></li> -->
            <?php if(!empty($category)) { ?>
            	<?php foreach ($category as $cate) { ?>
                    <li data-filter="<?php if(!empty($cate->category_slug)) echo '.'.$cate->category_slug; ?>" class="type <?php if($get==$cate->category_slug && !isset($_GET['Tag'])) { echo 'act'; } ?>" ><a href="<?php if(isset($_GET['Categories'])) { echo base_url('blog').'?Categories='.$cate->category_slug; } else { echo "#"; } ?>"><?php if(!empty($cate->category_name)) echo ucfirst($cate->category_name); ?></a></li>
            	<?php } ?>
            <?php } ?>
        </ul>
	</div>
	<div class="clearfix"></div>
	<div class="blog_grid">
			<!-- blog contents added by javascript -->
	</div>
	<div class="col-xs-12 text-center">
		<button class="load_more">LOAD MORE</button>
	</div>
</div>

<script>

var offset = 0;
var get    = "<?php echo $get; ?>";
var total  = <?php echo $total_rows; ?>;
var limit  = 12;
var type   = "<?php echo $type; ?>";

var isoOptions = function()
{	
	$('#filters .type').click(function()
	{
		$('#filters .act').removeClass('act');
		$(this).addClass('act');
	});

	var $container = $('.blog_grid');
	filterValue = '*';
	
	$container.isotope({
		itemSelector: '.grid-item',
		layoutMode: 'masonry',
		filter: filterValue
	});
	
	$('#filters').on( 'click', 'li', function() 
	{
		filterValue = $(this).attr('data-filter');
		$container.isotope({ filter: filterValue });
	});
	
	$(window).resize(function () {
    	$('.blog_grid').isotope();
	});
}

function get_media()
{
	
	/*$.post('<?php echo base_url("blog/blog_list/"); ?>/'+type+'/'+get+'/'+limit+'/'+offset,*/
	$.post('<?php echo base_url("blog/blog_list/"); ?>/'+type+'/'+get+'/'+limit+'/'+offset,
            function(data) 
            {
	            var $container = $('.blog_grid');
	            if(data.status)
	            {
	            	$container.append( data.html );
	            	$container.isotope('destroy');
	            	$container.isotope( isoOptions );
	            	//alert(data);
	            	//$container.isotope('destroy');
	            	//$container.append(data);
	            	//$container.isotope();
	            	//var $container = $('.blog_grid');
	            	//$container.isotope( 'insert', data );
	            	//$container.isotope( 'addItems', data );
	            	//$container.isotope( 'addItems', data, callback )
	            	//$container.isotope('appended',data ); // appended new data

					//$('#filters li:first-child').addClass('act');
	            	//$container.isotope( 'insert', data );
	            	$('#filters').on( 'click', 'li', function() 
					{
						filterValue = $(this).attr('data-filter');
						$container.isotope({ filter: filterValue });
						$('#filters .act').removeClass('act');
					});
					//alert(get);
					if(get == 0)
					{
						$('#filters .act').removeClass('act');
						$('#filters li:first-child').addClass('act');						
					}
				}
				else
				{

					$container.append( '<div class="alert alert-info"> No Result Found.</div>' );
				}
            });
	offset++;

	if(total <= offset*limit )
	{
		$(".load_more").remove();
	}
}
$(document).ready(function() 
	    {
			get_media();
		});

$(".load_more").click(function(event) 
{
	//offset++;
	get_media();

	
});

</script>
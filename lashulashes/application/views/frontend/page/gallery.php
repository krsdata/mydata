<div class="gallery" id="gallery">
	<!-- start page title -->
	<div class="gallery_title">
		<img src="assets/frontend/images/gallery/seventh_head.png">
	</div>
	<!-- end page title -->

	<?php if(!empty($gallery)) { ?>
		<?php if(!empty($gallery[0]->gallery_image) && file_exists($gallery[0]->gallery_image)) { ?>
			<!--start  circle images  -->
			<div class="gallery_back gallery_now">
				<img id="back_photo_n" src="<?php echo base_url($gallery[0]->gallery_image); ?>">
			</div><!--  -->
			<div class="gallery_back gallery_fade">
				<img id="back_photo_f" src="<?php echo base_url($gallery[0]->gallery_image); ?>">
			</div>
			<!-- end circle images -->
			<!-- start inner circle image -->
			<div class="galler_thumb_photo">
				<div class="gallery_thumb_o gallery_now">
					<img src="<?php echo base_url($gallery[0]->gallery_image); ?>">
				</div>
				<div class="gallery_thumb_o gallery_fade">
					<img src="<?php echo base_url($gallery[0]->gallery_image); ?>">
				</div>
			</div> 
			<!-- end inner circle image -->
		<?php }?>
	<?php } else { ?>
		<h1>Coming soon</h1>
	<?php }?>
</div>

<script>
		//console.log(gallery);
		$(function() {
			var count =  <?php echo $image_count; ?>;
			//alert(count);
			var gallery = <?php echo $gallery_json;?>;
			//console.log(gallery[1]);
		
		function touchHandler(event) {
		    var touches = event.changedTouches,
		        first = touches[0],
		        type = "";
		    switch(event.type)
		    {
		        case "touchstart": type = "mousedown"; break;
		        case "touchmove":  type = "mousemove"; break;        
		        case "touchend":   type = "mouseup";   break;
		        default:           return;
		    }
		
		    // initMouseEvent(type, canBubble, cancelable, view, clickCount, 
		    //                screenX, screenY, clientX, clientY, ctrlKey, 
		    //                altKey, shiftKey, metaKey, button, relatedTarget);
		
		    var simulatedEvent = document.createEvent("MouseEvent");
		    simulatedEvent.initMouseEvent(type, true, true, window, 1, 
		                                  first.screenX, first.screenY, 
		                                  first.clientX, first.clientY, false, 
		                                  false, false, false, 0/*left*/, null);
		
		    first.target.dispatchEvent(simulatedEvent);
		    event.preventDefault();
		}

		function init() 
		{
		    document.addEventListener("touchstart", touchHandler, true);
		    document.addEventListener("touchmove", touchHandler, true);
		    document.addEventListener("touchend", touchHandler, true);
		    document.addEventListener("touchcancel", touchHandler, true);    
		}

		init();
			
		var dragging = false;
		var d_x;
		var d_y;
		showing = false;
		
		function push_image(i,flag)
		{
			var div = document.createElement('div');
			div.className = "gallery_photo";
			var x = i * 18;
			var att = document.createAttribute("angel");
			att.value = x;
			div.setAttributeNode(att);
			
			var circle_radius;
			
			if ($(window).width() >= $(window).height())
			{
				circle_radius = $("#gallery").height()/2.5;
			}
			else
			{
				circle_radius = $("#gallery").width()/2;
			}
			
			var circle_height = $(".gallery_photo").width()/3;
			var circle_width = $(".gallery_photo").width()/2;
			
			div.style.left = ($("#gallery").width()/2-circle_width) + circle_radius*(Math.cos(x * Math.PI * 2 / 360)) + "px";
			div.style.top = ($("#gallery").height()/2-circle_height) + circle_radius*(Math.sin(x * Math.PI * 2 / 360)) + "px";
			
			//div.innerHTML = "<img src='images/gallery/"+(i)+".jpg'>";
			//alert(i);
			console.log(gallery[i].gallery_image);
			div.innerHTML = "<img src='"+gallery[i].gallery_image+"' title='"+gallery[i].gallery_title+"'>";
			div.style.transform = "rotate("+((Math.random()*120+1)+300)+"deg)";
			
			if (i==0 && flag==0) {
				div.style.display = "none";
			}
			document.getElementById('gallery').appendChild(div);
		}
		for (var i = 0;i<count;i++) {
			
			push_image(i,0);

			if(eval(i+1)==count)
			{
				push_image(0,1);
			}
			
		}
		
		$('.gallery_photo > img').mousedown(function (e) {
			tar_img = $(this).attr("src");
				e.preventDefault();
			e.stopPropagation();
	    	dragging = true;
	    	showing = true;
	    	d_x = e.pageX-($(window).width()/2);
	    	d_y = (($(window).height()+70)/2)-e.pageY;
		});
		
		$(document).mousemove(function (e) {
	        if (dragging) {
		        showing = false;
				$(".gallery_photo").each(function() {
				
					var c_x = e.pageX-($(window).width()/2);
					var c_y = (($(window).height()+70)/2)-e.pageY;
					
					var d_a = Math.atan(d_x/d_y)/(Math.PI * 2 / 360);
					var c_a = Math.atan(c_x/c_y)/(Math.PI * 2 / 360);
					
					if (c_a * d_a <0) {
						c_a = c_a * -1;
					}
					
					var x = parseFloat($(this).attr("angel"));
					x = x + (c_a - d_a);
					$(this).attr("angel",x);
					
					var circle_radius;
			
					if ($(window).width() >= $(window).height())
					{
						circle_radius = $("#gallery").height()/2.5;
					}
					else
					{
						circle_radius = $("#gallery").width()/2;
					}
					
					var circle_height = $(".gallery_photo").width()/3;
					var circle_width = $(".gallery_photo").width()/2;
					
					$(this).css("left", ($("#gallery").width()/2-circle_width) + circle_radius*(Math.cos(x * Math.PI * 2 / 360)));
					$(this).css("top", ($("#gallery").height()/2-circle_height) + circle_radius*(Math.sin(x * Math.PI * 2 / 360)));
	            });
	            					
		        	d_x = e.pageX-($(window).width()/2);
		        	d_y = (($(window).height()+70)/2)-e.pageY;
	        }
		});
		
		$(window).resize(function(){
			$(".gallery_photo").each(function() {
											
				var x = parseFloat($(this).attr("angel"));
				
				var circle_radius;
		
				if ($(window).width() >= $(window).height())
				{
					circle_radius = $("#gallery").height()/2.5;
				}
				else
				{
					circle_radius = $("#gallery").width()/2;
				}
				
				var circle_height = $(".gallery_photo").width()/3;
				var circle_width = $(".gallery_photo").width()/2;
				
				$(this).css("left", ($("#gallery").width()/2-circle_width) + circle_radius*(Math.cos(x * Math.PI * 2 / 360)));
				$(this).css("top", ($("#gallery").height()/2-circle_height) + circle_radius*(Math.sin(x * Math.PI * 2 / 360)));
		    });
		});
		
		$(document).mouseup(function (e) {
	    	dragging = false;
	    	
	    	if (showing){
				$(".gallery_fade img").attr("src",tar_img);
				$(".gallery_now").removeClass("gallery_now").addClass("temp");
				$(".gallery_fade").removeClass("gallery_fade").addClass("gallery_now");
				$(".temp").removeClass("temp").addClass("gallery_fade");
				showing = false;
	    	}
	    });
		
		$(".galler_thumb_photo img").mousedown(function() {
			if ($(".galler_thumb_photo").hasClass("zoomin"))
			{
				$(".galler_thumb_photo").removeClass( "zoomin" );
			}
			else
			{
				$(".galler_thumb_photo").addClass( "zoomin" );
			}
		});
		
		$(".galler_thumb_photo img").mouseover(function() {
			$(".galler_thumb_photo").addClass( "zoomin" );
		});
		
		$(".galler_thumb_photo img").mouseout(function() {
			$(".galler_thumb_photo").removeClass( "zoomin" );
		});
	});</script>
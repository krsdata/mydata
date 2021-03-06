<section id="page_content" class="contact_content">
	<!-- <div class="contact_us"> -->
		<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9 map_page">
			<div class="map_title">Lashing the nation, one lash at a time.</div>
			<div id="map"></div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">

			<div class="text-right margin_top_10">
				<a href="<?php echo base_url('contact'); ?>" class="btn-pink">back</a>
			</div>
			<div class="marker_list_wrapper">
				<ul class="marker_list">
					
					<?php  $i=0;if(!empty($store_list)) {  ?>
						<?php foreach ($store_list as $row) {  ?>
							<li onclick="map_event(<?php echo $i; ?>)" style="cursor: pointer;">							
								<img src="<?php echo base_url('./assets/frontend/images/google_icon/map-point.png');?>" alt="" />
								<div class="marker_info">
									<h3 class="margin_top_0"><?php if(!empty($row->name)) echo $row->name;?></h3>
									<p class="margin_bottom_0">
										<?php if(!empty($row->address)) echo $row->address. ' ';?><?php if(!empty($row->city)) echo $row->city.' ';?><?php if(!empty($row->state)) echo $row->state.' ';?><?php if(!empty($row->zip)) echo $row->zip.' ';?><?php if(!empty($row->country)) echo $row->country.' ';?>
									</p>
								</div>
								
							</li>
						<?php $i++; } ?>
					<?php } ?>
				</ul>
			</div>
		</div>
	    <div class="clearfix"></div>
	<!-- </div> -->
</section>
    


<script>
	var markers = [];
	function initMap() {
		
		var styles = [
		    {
		      stylers: [
		        { saturation: -100 }
		      ]
		    }
		];
		
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -38.148628, lng: 144.358263},
			zoom: 8,
			scrollwheel: false,
			navigationControl: false,
			mapTypeControl: false,
			zoomControl: true,
			disableDefaultUI: true,
			mapTypeId: 'Styled'
		});

		if (navigator.geolocation) {
	    	navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
		        	lat: position.coords.latitude,
					lng: position.coords.longitude
		    	};
				map.setCenter(pos);
				var marker = new google.maps.Marker({
					map: map,
					draggable:false,
					position: pos,
					icon: 'http://www.robotwoods.com/dev/misc/bluecircle.png'
	    		});
				
		    });
		}
		
	    var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
		map.mapTypes.set('Styled', styledMapType);
		
		bounds = new google.maps.LatLngBounds(
			new google.maps.LatLng(-84.999999, -179.999999), 
			new google.maps.LatLng(84.999999, 179.999999));
		
		rect = new google.maps.Rectangle({
		    bounds: bounds,
		    fillColor: "#4fc1e9",
		    fillOpacity: 0.2,
		    strokeWeight: 0,
		    map: map
		});
		
		//Makers//
		
		/*var all_addresses = [
			{ address: "105 Ryrie St, Geelong 3220 VIC", name: "Lash U Lashes Head Office", phone: "1300 236 195", type: 0},
			{ address: "10 New Street, Frankston Victoria 3199 Australia", name: "Salon First", phone: "1300 725 661", type: 1},
			{ address: "112 Northgate Dr, Thomastown Victoria 3074 Australia", name: "Ezy Nails", phone: "03 9464 4466", type: 1},
			{ address: "425 Burwood Hwy, Wantirna South Vic 3152 Australia", name: "Black 2 Blonde Hair and Beauty Supplies", phone: "03 9887 3330",type: 1},
			{ address: "101 Station St Nunawading, VIC 3131 Australia", name: "Le Chat", phone: "1800 000 018",type: 1},
			{ address: "61 Coulstock St Epping, VIC 3076 Australia", name: "Risone Hair & Beauty Suppliers", phone: "03 9401 1277",type: 1},
			{ address: "42 Mcintyre Rd Sunshine North, VIC 3020 Australia", name: "Oz Nail and Beauty Supplies", phone: "03 9364 8586",type: 1},
			{ address: "8 Little Ryrie St Geelong, VIC 3220 Australia", name: "Spirit Body and Skin Care", phone: "03 5229 1673",type: 1},
			{ address: "289 High St Golden Square, VIC 3555 Australia", name: "My Hair Bendigo", phone: "03 5442 4900",type: 1},
			{ address: "345 Flinders La Melbourne, VIC 3000 Australia.", name: "Elly Lukas", phone: "03 9923 8888",type: 2},
			{ address: "Shop 2 200 Henley Beach Rd Torrensville, SA 5031 Australia", name: "One On One Nails", phone: "08 8352 7733",type: 2}
		];*/

		var all_addresses =  <?php echo $location_json ?>;
		
		var address_posi = [];
		
		function geo(success) {
			address_posi[success] = {};
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': all_addresses[success]["address"]}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					address_posi[success] = results[0].geometry.location;
					success++;
					if (success < all_addresses.length)
					{
						geo(success);
					}
					else {
						for (var i = 0; i < all_addresses.length; i++) {
							maker_address(all_addresses[i], address_posi[i], i * 200,i);
						}
					}
		        }
		    })
		}
		
		function maker_address(address_data, posi, timeout,i) {
			
			var icon = [];
			
			icon[0] = "<?php echo base_url('./assets/frontend/images/google_icon/office.png'); ?>";
			icon[1] = "<?php echo base_url('./assets/frontend/images/google_icon/sales.png'); ?>";
			icon[2] = "<?php echo base_url('./assets/frontend/images/google_icon/schools.png'); ?>";
			
			window.setTimeout(function() {
				markers[i] = new google.maps.Marker({
					map: map,
					draggable:false,
					animation: google.maps.Animation.BOUNCE,
					position: posi,
					icon: icon[address_data["type"]],
					title: address_data["name"]
	    		});
	    		
	    		setTimeout(function () {
					markers[i].setAnimation(null);
				}, 700);
		        		
	    		var content_string = "<div class='iwContent'><bold>"+address_data["name"]+"</bold><br><i class='fa fa-map-marker'></i> "+address_data["address"]+"<br><i class='fa fa-phone'></i><bold> "+address_data["phone"]+"</bold></div>";
	    		
	    		if (address_data["phone"] == "1300 236 195") {
					content_string = '<pink>'+content_string+'</pink>';
	    		}
	    		
	    		var infowindow = new google.maps.InfoWindow({
					content: content_string
				});
				
				var center = null;
				
				google.maps.event.addListener(markers[i], 'click', function() {
					infowindow.open(map,markers[i]);
					center = map.getCenter();
					map.panTo(this.position);
					map.setZoom(15);
				});
					
				google.maps.event.addListener(infowindow,'closeclick',function(){
					map.setZoom(8);
					map.panTo(center);
					center = null;
				});
					
			}, timeout);
		}
		
		google.maps.event.addDomListener(window, 'load', geo(0));
	}

	function map_event(i)
	{
		google.maps.event.trigger(markers[i], 'click');
	}
    </script>


	
	<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>

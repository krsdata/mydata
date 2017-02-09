<section id="page_content" class="contact_content">
	<div class="col-xs-12 col-sm-6 col-md-9 map_page">
		<div class="map_title">Lashing the nation, one lash at a time.</div>
		<div id="map"></div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-3">
		<div class="row margin_top_20">
        	<div class="col-xs-12 col-sm-12 col-md-12">
        	    <?php echo msg_alert_frontend(); ?>
        	</div>
            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <h4 class="widgettitle">Lorem ipsum dolor sit amet</h4>
            </div>  -->       	
			<div class="col-xs-12 col-sm-12 col-md-12">
			    <div class="dropdown contact_dropdown">
				    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Wholesale Store near you
				    <span class="caret"></span></button>
				    <ul class="dropdown-menu">
				    	<li><a href="<?php echo base_url('contact/location/H/VIC')?>">VIC</a></li>
	                    <li><a href="<?php echo base_url('contact/location/H/NSW')?>">NSW</a></li>
	                    <li><a href="<?php echo base_url('contact/location/H/QLD')?>">QLD</a></li>
	                    <li><a href="<?php echo base_url('contact/location/H/SA')?>">SA</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url('contact/location/H/ALL')?>">All</a></li>
				    </ul>
			    </div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 margin_top_10">
				<div class="dropdown contact_dropdown">
				    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Education Centre near you
				    <span class="caret"></span></button>
				    <ul class="dropdown-menu">
				      	<li><a href="<?php echo base_url('contact/location/E/VIC')?>">VIC</a></li>
	                    <li><a href="<?php echo base_url('contact/location/E/NSW')?>">NSW</a></li>
	                    <li><a href="<?php echo base_url('contact/location/E/QLD')?>">QLD</a></li>
	                    <li><a href="<?php echo base_url('contact/location/E/SA')?>">SA</a></li>
	                    <li class="divider"></li>
						<li><a href="<?php echo base_url('contact/location/E/ALL')?>">All</a></li>
				    </ul>
			    </div>
			</div>
            <div class="col-xs-12 col-sm-12 col-md-12 margin_top_20">
                <h4 class="widgettitle">Get in touch with us</h4>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <form method="post" id="contactform" name="contactform" class="contact-form clearfix" action="<?php echo current_url();?>">
                    <div class="row">
                        <div class="col-md-12">
                        	<?php if(!empty($category) && !empty($location)) { ?>
		                        <!-- <div class="form-group">
		                            <h4 class="widgettitle">
		                                <?php 
											//if('H'==$category) echo "Wholesale Store Near ".$location;
									    	//if('E'==$category) echo "Education Centre Near ".$location;
									     ?>		
		                            </h4>
		                        </div>
		                        <div class="form-group">
		                            <select name="location_name" class="form-control input-lg">
		                            		<option value=""> Select Location</option>
		                            		<?php //if(!empty($store_list)) { 
		                            			//foreach ($store_list as $store_row) { ?>
		                            				<option value="<?php //echo $store_row->name?>"> <?php //echo $store_row->name?></option>
		                            			<?php //}?>
		                            		<?php //} ?>
                                	</select>
                              	</div> -->				                    
			                <?php } ?>
                        	<div class="form-group">
                            	<input type="text" id="name" name="name"  class="form-control input-lg" placeholder="Name*" value="<?php echo set_value('name'); ?>">
                            	<?php echo form_error('name');?>
                          	</div>
						  	<div class="form-group">
                            	<input type="email" id="email" name="email"  class="form-control input-lg" placeholder="Email*" value="<?php echo set_value('email'); ?>">
                            	<?php echo form_error('email');?>
                          	</div>
						  	<div class="form-group">
                            	<input type="mobile" id="mobile" name="mobile"  class="form-control input-lg" placeholder="Phone" value="<?php echo set_value('mobile'); ?>">
                            	<?php echo form_error('mobile');?>
                        	</div>
                        </div>
                        <div class="col-md-12">
                        	<div class="form-group">
                            	<textarea cols="6" rows="5" id="comments" name="comments" class="form-control input-lg" placeholder="Message*"><?php echo set_value('comments'); ?></textarea>
                            	<?php echo form_error('comments');?>
                          	</div>
                        </div>
                        <div class="col-md-12">
                        	<input id="submit" name="submit" type="submit" class="btn btn_pink pull-right" value="Submit now!">
                        </div>
                    </div>
                </form>
            </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 margin_top_20">
		        <section class="contact-info">
		        	<?php $site_address = get_option(1); ?>
		        	<?php if($site_address) { ?>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                	<h3><i class="fa fa-map-marker"></i> Address</h3>
						<address>
						<?php echo $site_address; ?>
						</address>
	                </div>
	                <?php } ?>
	                <?php $site_email = get_option(3); ?>
                    <?php if($site_email) { ?>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                	<h3><i class="fa fa-envelope-o"></i> Email</h3>
						<p><a href="mailto:<?php echo $site_email; ?>"><?php echo $site_email; ?></a></p>
	                </div>
	                <?php } ?>
	                <?php $site_phone = get_option(2); ?>
                    <?php if($site_phone) { ?>
	                <div class="col-xs-12 col-sm-12 col-md-12">
	                    <h3><i class="fa fa-phone"></i> Call</h3>
	                    <pink><p><a href="tel:<?php echo $site_phone; ?>"><?php echo $site_phone; ?></a></p></pink>
	                </div>
	                <?php } ?>
	            </section>
	        </div>
	    </div>
	</div>
</section>
    
<script>
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
			{ address: "105 Ryrie St, Geelong 3220 VIC", name: "Lash U Lashes Head Office", phone: "1300 236 195", type: 1},
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
							maker_address(all_addresses[i], address_posi[i], i * 200);
						}
					}
		        }
		    })
		}
		
		function maker_address(address_data, posi, timeout) {
			var icon = [];
			icon[0] = "<?php echo base_url('./assets/frontend/images/google_icon/office.png'); ?>";
			icon[1] = "<?php echo base_url('./assets/frontend/images/google_icon/sales.png'); ?>";
			icon[2] = "<?php echo base_url('./assets/frontend/images/google_icon/schools.png'); ?>";
			
			window.setTimeout(function() {
				var marker = new google.maps.Marker({
					map: map,
					draggable:false,
					animation: google.maps.Animation.BOUNCE,
					position: posi,
					icon: icon[address_data["type"]],
					title: address_data["name"]
	    		});
	    		
	    		setTimeout(function () {
					marker.setAnimation(null);
				}, 700);
		        		
	    		var content_string = "<div class='iwContent'><bold>"+address_data["name"]+"</bold><br><i class='fa fa-map-marker'></i> "+address_data["address"]+"<br><i class='fa fa-phone'></i><bold> "+address_data["phone"]+"</bold></div>";
	    		
	    		if (address_data["phone"] == "1300 236 195") {
					content_string = '<pink>'+content_string+'</pink>';
	    		}
	    		
	    		var infowindow = new google.maps.InfoWindow({
					content: content_string
				});
				
				var center = null;
				
				google.maps.event.addListener(marker, 'click', function() 
				{
					infowindow.open(map,marker);
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>

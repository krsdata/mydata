<section id="page_content" class="more_content">
	<div class="container">
		<div class="row about_row1 text-center">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<p class="page_head margin_cutter">Book Salon Service</p>
			</div>
		</div>
			
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12"><br>
				<?php echo msg_alert_frontend(); ?>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row text-center service_row margin_bottom_60">
			<div class="col-xs-12 col-sm-12 col-md-12 margin_bottom_20 text-left text-uppercase padding_left_0">
				<h1>Treatment Type</h1>
			</div>
			<?php 
				if(!empty($categories))
				{
					foreach ($categories as $key => $value) 
					{ 
						if(empty($value->image) || !file_exists($value->image)) {
							$tmpImage = base_url('./assets/frontend/images/services/service_spray.jpg');
						}else{
							$tmpImage = base_url($value->image);
						}
					?>
						<div class="col-xs-12 col-sm-4 col-md-4 serviceOuter">
							<img src="<?php echo $tmpImage; ?>" class="serviceWrp" alt="" />
							<a href="#" data-toggle="modal" onclick="show_model(<?php echo $value->id.','.$value->sub.",'".$value->name."'"; ?>)">
								<div class="serviceHover">
										<div class="serviceTextWrp">
											<h4 id="categoryName_<?php echo $value->id; ?>" ><?php echo $value->name; ?></h4>
											<p><?php echo character_limiter($value->detail,130); ?></p>
											<span class="btn btn-pink">Book Now</span>
										</div>
								</div>
							</a>
						</div>
					<?php }
			    }?>														
		</div>

		<div class="row text-center service_row">
			<div class="col-xs-12 col-sm-12 col-md-12 margin_bottom_20 text-left text-uppercase padding_left_0">
				<h1>Artist</h1>
			</div>
			<?php 
				if(!empty($artistData))
				{
					foreach ($artistData as $key => $value) 
					{ 
						if(empty($value->image) || !file_exists($value->image)) {
							$tmpImage = base_url('./assets/frontend/images/services/service_spray.jpg');
						}else{
							$tmpImage = base_url($value->image);
						}
						?>	
						<div class="col-xs-12 col-sm-4 col-md-4 serviceOuter">
							<img src="<?php echo $tmpImage; ?>" class="serviceWrp" alt="" />
							<a href="#" onclick="show_artist_model(<?php echo $value->id; ?>)">
								<div class="serviceHover">
										<div class="serviceTextWrp">
											<h4 id="artist_<?php echo $value->id; ?>" ><?php echo $value->name;?></h4>
											<p><?php echo character_limiter($value->detail,130);?></p>
											<span class="btn btn-pink">Book Now</span>
										</div>
								</div>
							</a>
						</div>
				 <?php }
				}
			?>														
		</div>
	</div>

	<!-- Modal 1 -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body serviceModalBody">
						<div class="serviceBannerWrp" id="serviceBannerWrp1">
							<button type="button" class="close serviceClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div class="serviceHeading text-center">
								<h2 id="bookTreatmentName1">Service Name</h2>
								<p id="bookTreatmentDetail1"></p>
							</div>
						</div>
						<div class="serviceContent">
						
							<h3>Book Treatment</h3>
					
							<form>
								<div class="service_select">
									<div id="message1" class="serviceError"></div>
								</div>
								<div class="service_select" id="model1Div1">
									<select class="empty_time" id="artistType1" name="artistType1">
						        		<option value="">Select Category</option>
						        	</select>						
								</div>

								<div class="service_select" id="model1Div2">
									<ul id="artistName1" class="serviceUl">
										<li class="dropdown ">
											<span class="dropdown-toggle" data-toggle="dropdown" data-artid="0">Select Artist </span>
											<ul class="dropdown-menu artistDropdown">
												<li data-artid = "0">
													<div class="artist_info_wrp">
														<div class="artist_name">
															<h2>Select Artist</h2>
														</div>
													</div>
												</li>
											</ul>
										</li>
									</ul>						
								</div>	

								<div class="service_select" id="model1Div3">
									<div class="input-group serviceInput">
						        		<input value="" name="date1" id="date1"  type="text" placeholder="Select Date" class="datepicker1" ata-date-format="d M YY" src="" aria-describedby="date_icon1" readonly="">
										<label class="input-group-addon date_service_icon_click1 date_icon1" id="date_icon1">
					                        <label class="glyphicon glyphicon-calendar"></label>
					                    </label>
						        	</div>						
								</div>

								<div class="service_select" id="model1Div4">
						        	<label class="serviceButton" id="checkButton1">Check Availabilty</label>
							    </div>	

								<div class="service_select" id="model1Div5">
									<select name="services_time1" class="" id="time1" >
							        	<option value="">Select Time</option>
							        </select>						
								</div>	
								<div class="serviceSubmit" id="model1Div6">
									<input type="hidden" name="service_name1" id="service_name1" value="" />
									<button type="button" class="serviceButton" onclick="check_input(1)">Book Treatment</button>
								</div>
							</form>

						</div>
					</div>
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div> -->
				</div>
			</div>
		</div>
	<!-- #Model 1 -->

	<!-- Model 2 -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body serviceModalBody">
						<div class="serviceBannerWrp" id="serviceBannerWrp2">
							<button type="button" class="close serviceClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div class="serviceHeading text-center">
								<h2 id="bookTreatmentName2">Service Name</h2>
								<p id="bookTreatmentDetail2"></p>
							</div>
						</div>
						<div class="serviceContent">
						
							<h3>Book Treatment</h3>
					
							<form>
								<div class="service_select">
									<div id="message2" class="serviceError"></div>
								</div>
								<div class="service_select" id="model2Div1">
									<select name="subCategory2" id="subCategory2">
					        			<option value="">Select Category</option>
					        		</select>						
								</div>

								<div class="service_select" id="model2Div2">
									<select name="artistType2" id="artistType2">
					        			<option value="">Select Type</option>
					        		</select>						
								</div>	

								<div class="service_select" id="model2Div3">
									<ul id="artistName2" class="serviceUl">
										<li class="dropdown ">
											<span class="dropdown-toggle" data-toggle="dropdown" data-artid="0">Select Artist </span>
											<ul class="dropdown-menu artistDropdown">
												<li data-artid = "0">
													<div class="artist_info_wrp">
														<div class="artist_name">
															<h2>Select Artist</h2>
														</div>
													</div>
												</li>
											</ul>
										</li>
									</ul>						
								</div>

								<div class="service_select" id="model2Div4">
									<div class="input-group serviceInput">
						        		<input value="" name="date2" id="date2" type="text" placeholder="Select Date" class="form-control datepicker2" ata-date-format="d M yyyy" src="" aria-describedby="date_icon2">
										<label class="input-group-addon date_service_icon_click1 date_icon2" id="date_icon2">
					                        <label class="glyphicon glyphicon-calendar"></label>
					                    </label>
						        	</div>
						        </div>
 
								<div class="service_select" id="model2Div5">
						        	<label class="serviceButton" id="checkButton2">Check Availabilty </label>
								</div>

								<div class="service_select" id="model2Div6">
									<select name="services_time2" class="empty_time" id="time2">
					        			<option value="">Select Time</option>
					        		</select>						
								</div>	

								<div class="serviceSubmit" id="model2Div7">
									<input type="hidden" name="service_name2" id="service_name2" value="" />
									<button type="button" class="serviceButton" onclick="check_input(2)">Book Treatment</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- #Model 2 -->

	<!-- Model 3 -->
		<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body serviceModalBody">
						<div class="serviceBannerWrp" id="serviceBannerWrp3">
							<button type="button" class="close serviceClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div class="serviceHeading text-center">
								<h2 id="bookArtist">Artist Name</h2>
								<p id="bookArtistDetail"></p>
							</div>
						</div>
						<div class="serviceContent">
						
							<h3>Book Treatment</h3>
					
							<form>
								<div class="service_select">
									<div id="message3" class="serviceError"></div>
								</div>
								<div class="service_select" id="model3Div1">
									<select class="empty_time" id="serviceType3" name="serviceType3">
					        			<option value="">Select Service</option>
					        		</select>					
								</div>

								<div class="service_select" id="model3Div2">
					        		<select class="empty_time" id="artistType3" name="artistType3">
					        			<option value="">Select Category</option>
					        		</select>					
								</div>	

								<div class="service_select" id="model3Div3">
									<select class="empty_time" id="artistSubType3" name="artistSubType3">
					        			<option value="">Select Type</option>
					        		</select>
								</div>

								<div class="service_select" id="model3Div4">
									<div class="input-group serviceInput">
						        		<input value="" name="date3" id="date3"  type="text" placeholder="Select Date" class="form-control datepicker3" ata-date-format="d M YY" src="" aria-describedby="date_icon1" readonly="">
										<label class="input-group-addon date_service_icon_click1 date_icon3" id="date_icon3">
					                        <label class="glyphicon glyphicon-calendar"></label>
					                    </label>
						        	</div>
						        </div>

								<div class="service_select" id="model3Div5">
									<label class="serviceButton" id="checkButton3">Check Availabilty </label>
								</div>

								<div class="service_select" id="model3Div6">
									<select name="services_time3" id="time3" >
					        			<option value="">Select Time</option>
					        		</select>					
								</div>	

								<div class="serviceSubmit" id="model3Div7">
									<input type="hidden" value="" id="artist3" />
									<button type="button" class="serviceButton" onclick="check_input(3)">Book Artist</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- #Model 3 -->
</section>

<script type="text/javascript">
	var categoryID = '';

	function show_model(id,count,service_name)
	{

		$("#model1Div1, #model1Div2, #model1Div3, #model1Div4, #model1Div5, #model1Div6").hide();
		$("#model2Div1, #model2Div2, #model2Div3, #model2Div4, #model2Div5, #model2Div6, #model2Div7").hide();
		
		$("#message1, #message2").html('');
		
		$("#artistName1 ul").html('<li data-artid ="0"><div class="artist_info_wrp"><div class="artist_name"><h2>Select Artist</h2></div></div></li>');
		$("#artistName1 .dropdown .dropdown-toggle").html('Select Artist');
		$("#artistName1 .dropdown .dropdown-toggle").attr('data-artid',0);


		$("#artistName2 ul").html('<li data-artid ="0"><div class="artist_info_wrp"><div class="artist_name"><h2>Select Artist</h2></div></div></li>');
		$("#artistName2 .dropdown .dropdown-toggle").html('Select Artist');
		$("#artistName2 .dropdown .dropdown-toggle").attr('data-artid',0);


		$(".datepicker1,.datepicker2").val("");
		$(".datepicker1").datepicker("remove"); 
		$(".datepicker2").datepicker("remove"); 
		$( ".date_icon1,.date_icon2").unbind();

		//$(".datepicker1,.datepicker2").val("<?php //echo date('d M Y', time()+86400)?>");

		$(".input_booking1,.input_booking2").val(1);
		$("#slot1,#slot2").val(1);


		$("#artistType1,#artistType2").html("<option value=''> Select Category</option>");
		//$("#artistName1,#artistName2").html("<option value=''> Select Artist</option>");

		$("#services_time1,#services_time2").html("<option value=''> Select Time </option>");
		categoryID = id;
		if(count > 0)
		{
			$("#service_name2").val(service_name);
			$.post("<?php echo base_url('service/getSubCategory')?>/"+id, function(data) {
				if(data.count>0)
				{
					var c =$("#categoryName_"+id).html();
					$("#subCategory2").html(data.html);
					$("#model2Div2, #model2Div3, #model2Div4, #model2Div5, #model2Div6, #model2Div7").hide();
					$("#model2Div1").show();
				}
					$("#bookTreatmentName2").html($("#categoryName_"+id).html());
					$("#bookTreatmentDetail2").html(data.detail);
					$("#serviceBannerWrp2").css("background-image","url("+data.image+")");
					$("#myModal2").modal('show');
			});
		}
		else
		{
			$("#service_name1").val(service_name);
			$.post("<?php echo base_url('service/getCategoryType')?>/"+id, function(data) {
				if(data.count>0){
					$("#artistType1").html(data.html);
					$("#model1Div2, #model1Div3, #model1Div4, #model1Div5, #model1Div6").hide();
					$("#model1Div1").show();
				}
				$("#bookTreatmentName1").html($("#categoryName_"+id).html());
				$("#bookTreatmentDetail1").html(data.detail);
				$("#serviceBannerWrp1").css("background-image","url("+data.image+")");
				$("#myModal1").modal('show');
			});
		}
	}

	function show_artist_model(artistId){
		
		//$("#message1, #message2, #message3").html('');
		$("#model3Div1, #model3Div2, #model3Div3, #model3Div4, #model3Div5, #model3Div6, #model3Div7").hide();

		$("#message3").html('');

		$(".datepicker3").val("");
		
		$(".datepicker3").datepicker("remove");
		
		$(".date_icon3").unbind();

		//$(".datepicker1,.datepicker2").val("<?php //echo date('d M Y', time()+86400)?>");
		$("#serviceType3").html("<option value=''> Select Service</option>");
		$("#artistType1,#artistType2,#artistType3").html("<option value=''> Select Category</option>");
		//$("#artistName1,#artistName2").html("<option value=''> Select Artist</option>");

		$("#services_time1,#services_time2,#services_time3").html("<option value=''> Select Time </option>");

		$.post("<?php echo base_url('service/getServicesList')?>/"+artistId, function(data) {
				if(data.count>0)
				{
					$("#artist3").val(artistId);
					$("#serviceType3").html(data.html);
					$("#model3Div1").show();
				}
				$("#bookArtist").html($("#artist_"+artistId).text());
				$("#serviceBannerWrp3").css("background-image","url("+data.image+")");
				$("#bookArtistDetail").html(data.detail);
				getArtistLeaveDetails(artistId);
				$("#myModal3").modal('show');
		});

	}


	function getArtistLeaveDetails(artid){
		if(artid!=''){
			$("#time3").html('<option value="">Select Time</option>');
			$.post("<?php echo base_url('service/getArtistWeekDaysLeave')?>/"+artid, function(response) {
				res = $.parseJSON(response);
				$(".datepicker3").datepicker("remove");
				$(".datepicker3").val('');
				var dateOption = {startDate: '+1d',format: 'd M yyyy',autoclose: true, orientation: 'bottom auto'};
				if(res.Status == 1){
					if(res.leaveDays.length>0){
						dateOption.datesDisabled = res.leaveDays;
					}
					if(res.offWeekDays.length>0){
						dateOption.daysOfWeekDisabled = res.offWeekDays;
					}
				}
				$('.datepicker3').datepicker(dateOption);
				$('.datepicker3').on('changeDate', function(){ $("#model3Div6,#model3Div7").hide(); $("#message3").html('');  });
			});


			
	        $(".date_icon3").click(function(event) 
	        {
	            $('.datepicker3').datepicker('show');
	        });
		}
		
	}

	function check_input(modalType){
		var artistId		= "";
		var category_type	= "";
		var services_date	= "";
		var timeSlot 		= ""; 
		var main_category_type = '';
		var service_name = '';
		if(modalType == 1){
			artistId 		= $("#artistName1 li span").attr("data-artid");
			main_category_type	= $("#artistType1").val();
			services_date	= $("#date1").val();
			timeSlot 		= $("#time1").val();
			service_name = $("#service_name1").val();
		}else if(modalType == 2){
			artistId 		= $("#artistName2 li span").attr("data-artid");
			main_category_type	= $("#subCategory2").val();
			category_type	= $("#artistType2").val();
			services_date	= $("#date2").val();
			timeSlot 		= $("#time2").val();
			service_name    = $("#service_name2").val();
		}else if(modalType == 3){
			artistId 		= $("#artist3").val();
			main_category_type	= $("#artistType3").val();
			service_name    = $("#serviceType3 :selected").text();
			category_type	= $("#artistSubType3").val();
			services_date	= $("#date3").val();
			timeSlot 		= $("#time3").val();
			
		}
		if(artistId == '' || main_category_type == '' || services_date == '' || timeSlot == '' || (category_type == '' && modalType == 2)){
			$("#message"+modalType).html('<span class="">Please enter all fields.</span>');
		}else{
			$.post("<?php echo base_url('service/book_service'); ?>",{artistId: artistId, category_type : category_type, services_date : services_date,main_category_type:main_category_type,timeSlot:timeSlot,service_name:service_name}, function(response) {
					//location.reload();
				    location.assign("<?php echo base_url('service/checkout');?>");
			});
		}
	}

	$(document).on("click", "#artistName1 ul li", function(){	
			var artid = $(this).attr('data-artid');
			$("#artistName1 .dropdown .dropdown-toggle").html($(this).find('.artist_name').text());
			$("#artistName1 .dropdown .dropdown-toggle").attr('data-artid',artid);
			if(artid > 0)
			{
				$("#model1Div5, #model1Div6").hide();
				$("#model1Div3, #model1Div4").show();
				$("#message1").html('');
				$.post("<?php echo base_url('service/getArtistWeekDaysLeave')?>/"+artid, function(response) {
					res = $.parseJSON(response);
					$(".datepicker1").datepicker("remove");
					$(".datepicker1").val('');
					var dateOption = {startDate: '+1d',format: 'd M yyyy',autoclose: true, orientation: 'bottom auto'};
					if(res.Status == 1){
						if(res.leaveDays.length>0){
							dateOption.datesDisabled = res.leaveDays;
						}
						if(res.offWeekDays.length>0){
							dateOption.daysOfWeekDisabled = res.offWeekDays;
						}
					}
					$('.datepicker1').datepicker(dateOption);
					$('.datepicker1').on('changeDate', function(){ $("#model1Div5,#model1Div6").hide(); $("#message1").html('');});
				});


				
		        $(".date_icon1").click(function(event) 
		        {
		            $('.datepicker1').datepicker('show');
		        });
			}else {
				$("#model1Div3, #model1Div4, #model1Div5, #model1Div6").hide();
				$("#message1").html('');
			}

    });

    $(document).on("click","#artistName2 ul li", function(){	
			
			var artid = $(this).attr('data-artid');
			$("#artistName2 .dropdown .dropdown-toggle").html($(this).find('.artist_name').text());
			$("#artistName2 .dropdown .dropdown-toggle").attr('data-artid',artid);
			if(artid > 0){
				$.post("<?php echo base_url('service/getArtistWeekDaysLeave')?>/"+artid, function(response)
				{
					model2Div4
					$("#model2Div6, #model2Div7").hide();
					$("#model2Div4, #model2Div5").show();
					$("#message2").html('');
					res = $.parseJSON(response);
					$(".datepicker2").datepicker("remove");
					$(".datepicker2").val('');
					var dateOption = {startDate: '+1d',format: 'd M yyyy',autoclose: true, orientation: 'bottom auto'};
					if(res.Status == 1){
						if(res.leaveDays.length>0){
							dateOption.datesDisabled = res.leaveDays;
						}
						if(res.offWeekDays.length>0){
							dateOption.daysOfWeekDisabled = res.offWeekDays;
						}
					}
					$('.datepicker2').datepicker(dateOption);
					$('.datepicker2').on('changeDate', function(){ $("#model2Div6,#model2Div7").hide(); $("#message2").html('');  });
				});
		        $(".date_icon2").click(function(event){
		            $('.datepicker2').datepicker('show');
		        });
			}else{
				$("#model2Div4, #model2Div5, #model2Div6, #model2Div7").hide();
				$("#message2").html('');
			}

    });

	$(document).ready(function($) 
	{
		$("#serviceType3").change(function(event) {
			var id =  $("#serviceType3").val();
			//alert(id);
			var artistId 		=	$("#artist3").val();
			$.post("<?php echo base_url('service/getCategoryData')?>/"+id+"/"+artistId, function(data) {
				if(data.count>0)
				{
					$("#model3Div3, #model3Div4, #model3Div5, #model3Div6, #model3Div7").hide();
					$("#model3Div2").show();
					$("#message3").html('');

					$("#artistType3").html(data.html);
					$("#divArtistSubType3").show();
					$("#artistSubType3").html('<option value="">Select Type</option>');
					$(".datepicker3").val('');
					$("#time3").html('<option value="">Select Time</option>');
				}else{
					$("#model3Div2, #model3Div3, #model3Div4, #model3Div5, #model3Div6, #model3Div7").hide();
					$("#message3").html('');
				} 
			});

		});
		
		$("#artistType3").change(function(event){
        	var cid = $("#artistType3").val();
        	var artistId = $("#artist3").val();
        	if(cid.length>0){
	        	//$.post("<?php echo base_url('service/getCategoryType')?>/"+cid, function(data) {
	        	$.post("<?php echo base_url('service/getCategoryData')?>/"+cid+"/"+artistId, function(data)
	        	{
	        		if(data.count>0){

	        			$("#model3Div4, #model3Div5, #model3Div6, #model3Div7").hide();
						$("#model3Div3").show();
						$("#message3").html('');

		        		$("#artistSubType3").html(data.html);
						$(".datepicker3").val('');
						$("#time3").html('<option value="">Select Time</option>');
					}else{
						$("#divArtistSubType3").hide();
	        			$("#model3Div3, #model3Div6, #model3Div7").hide();
	        			$("#model3Div4, #model3Div5	").show();
	        			$("#message3").html('');

					}
				});
			}else{
				$("#model3Div3, #model3Div4, #model3Div5, #model3Div6, #model3Div7").hide();
				$("#message3").html('');
			}
        });

        $("#artistSubType3").change(function(){
        	$("#model3Div6, #model3Div7").hide();
        	$("#model3Div4, #model3Div5	").show();
        	$("#message3").html('');

        });
       
        $("#subCategory2").change(function(event) {
			var subCategory2Id =  $("#subCategory2").val();
			
			$.post("<?php echo base_url('service/getCategoryType')?>/"+subCategory2Id, function(data) {
				if(data.count>0)
				{
					$("#model2Div3, #model2Div4, #model2Div5, #model2Div6, #model2Div7").hide();
					$("#model2Div2").show();

					$("#artistType2").html(data.html);
					$("#artistName2 .dropdown .dropdown-toggle").html('Select Artist');
					$("#artistName2 .dropdown .dropdown-toggle").attr('data-artid',0);
				}else{
					$("#model2Div2, #model2Div3, #model2Div4, #model2Div5, #model2Div6").hide();
				}
				$("#message2").html('');
				$(".datepicker2").val('');
				$("#time2").html('<option value="">Select Time</option>');
			});

		});

        $("#artistType1").change(function(event){
        	var cid = $("#artistType1").val();
        	$.post("<?php echo base_url('service/getRelatedArtist')?>/"+cid, function(data) {
        		
				$("#artistName1 ul").html(data.html);

        		if(data.count >0){
	        		$("#model1Div3, #model1Div4, #model1Div5, #model1Div6").hide();
					$("#model1Div2").show();
	        		
	        		$("#artistName1 .dropdown .dropdown-toggle").html('Select Artist');
					$("#artistName1 .dropdown .dropdown-toggle").attr('data-artid',0);
				}else{
					$("#model1Div2, #model1Div3, #model1Div4, #model1Div5, #model1Div6").hide();
				}
			});
			$("#message1").html('');
			$(".datepicker1").val('');
			$("#time1").html('<option value="">Select Time</option>');
        });

        $("#artistType2").change(function(event){
        	var cid = $("#artistType2").val();
        	$.post("<?php echo base_url('service/getRelatedArtist')?>/"+cid, function(data) {
        		
				$("#artistName2 ul").html(data.html);

        		if(data.count>0){
	        		$("#model2Div4, #model2Div5, #model2Div6, #model2Div7").hide();
					$("#model2Div3").show();

	        		$("#artistName2 .dropdown .dropdown-toggle").html('Select Artist');
					$("#artistName2 .dropdown .dropdown-toggle").attr('data-artid',0);
				}else{
					$("#model2Div3, #model2Div4, #model2Div5, #model2Div6, #model2Div7").hide();
				}
			});
			$("#message2").html('');
			$(".datepicker2").val('');
			$("#time2").html('<option value="">Select Time</option>');
        });


		$("#checkButton1").click(function(event) {
			/* Act on the event */
			$("#message1").html('');
			var artistId 		=	$("#artistName1 li span").attr("data-artid");
			var category_type	= 	$("#artistType1").val();
			var services_date	=   $("#date1").val();
			if(artistId.length < 1 || category_type.length < 1 || services_date.length < 1){
				$("#message1").html('<span class="">Please enter all fields.</span>');
			}else{
				$.post("<?php echo base_url('service/getTimeSlots'); ?>",{artistId: artistId, category_type : category_type, services_date : services_date}, function(response) {
					/*optional stuff to do after success */
					res = $.parseJSON(response);
					if(res.status == 1){
						var htmlStr = '';
						$(res.data).each(function(index,value){
							if(index == 0){
								htmlStr += '<option value="">Select Time</option>';
							}
							htmlStr += '<option value="'+value+'">'+value+'</option>';
						});
						$("#time1").html(htmlStr);
						$("#model1Div5, #model1Div6").show();
						$("#message1").html('');
					}else{
						$("#message1").html('<span class="">All Slots are booked.</span>');
					}
				});
			}

		});

		$("#checkButton2").click(function(event) {
			/* Act on the event */
			var artistId 		=	$("#artistName2 li span").attr("data-artid");;
			var category_type	= 	$("#artistType2").val();
			var services_date	=   $("#date2").val();
			if(artistId.length < 1 || category_type.length < 1 || services_date.length < 1){
				$("#message2").html('<span class="">Please enter all fields.</span>');
			}else{
				$.post("<?php echo base_url('service/getTimeSlots'); ?>",{artistId: artistId, category_type : category_type, services_date : services_date}, function(response) {
					/*optional stuff to do after success */
					res = $.parseJSON(response);
					if(res.status == 1){
						var htmlStr = '';
						$(res.data).each(function(index,value){
							if(index == 0){
								htmlStr += '<option value="">Select Time</option>';
							}
							htmlStr += '<option value="'+value+'">'+value+'</option>';
						});
						$("#time2").html(htmlStr);
						$("#model2Div6, #model2Div7").show();
						$("#message2").html('');
					}else{
						$("#message2").html('<span class="">All Slots are booked.</span>');
					}
				});
			} 
		});

		$("#checkButton3").click(function(event) {
			/* Act on the event */
			var artistId 		=	$("#artist3").val();
			var category_type	= 	$("#artistType3").val();
			var divlength = $("#divArtistSubType3").html();
			if($("#artistSubType3").val()!=''){
				var category_type	= 	$("#artistSubType3").val();
			}
			var services_date	=   $("#date3").val();
			if(artistId.length < 1 || category_type.length < 1 || services_date.length < 1){
				$("#message3").html('<span class="">Please enter all fields.</span>');
			}else{
				$.post("<?php echo base_url('service/getTimeSlots'); ?>",{artistId: artistId, category_type : category_type, services_date : services_date}, function(response) {
					/*optional stuff to do after success */
					res = $.parseJSON(response);
					if(res.status == 1){
						var htmlStr = '';
						$(res.data).each(function(index,value){
							if(index == 0){
								htmlStr += '<option value="">Select Time</option>';
							}
							htmlStr += '<option value="'+value+'">'+value+'</option>';
						});
						$("#time3").html(htmlStr);
						$("#model3Div6, #model3Div7").show();
						$("#message3").html('');
					}else{
						$("#message3").html('<span class="">'+res.message+'</span>');
					}
				});
			} 
		});

	});



</script>

<script type="text/javascript">
	$(document).ready(function($) {
		$('.btn-minuse, .btn-pluss').on('click',function()
		{
			var id = this.value;
			//alert(id);
			var val = $("#slot"+id).val();
			var max = $("#slot"+id).attr('max');
			var min = $("#slot"+id).attr('min');
			//alert(max+'-'+val);
			//$(".input_booking"+id).parent().css('border', '1px solid #CCC');
			if($(this).hasClass('btn-minuse')) 
			{
				if(val>min)
				{
					$("#slot"+id).val(val-1);
					$(".input_booking"+id).val(val-1);
				}
			} 
			else if($(this).hasClass('btn-pluss'))
			{
				//alert('+');
				var temp = val;
				temp++;
				if(max >=temp)
				{
					$("#slot"+id).val(temp);
					$(".input_booking"+id).val(temp);
					//$(".input_booking"+id).val();
				}
			}
		});
	});
</script>
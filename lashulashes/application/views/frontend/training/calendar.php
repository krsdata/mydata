<?php $temp_training_array = array('bronze','silver','gold','platinum'); ?>


<section id="page_content" class="calendar_page">
	<!-- <div class="container"> -->
		<div class="container" style="height:100vh !important">
			<div class="row text-center">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<p class="page_head margin_cutter">Upcoming Courses</p>
				</div>
			</div>
			<div class="row margin_top_30">
				<div class="container" id="alert_message"><?php  echo msg_alert_frontend(); ?></div>
				<div class="training_cal0">
					<!-- <div class="row"> -->
						<div class="col-md-4 mobile_calendar">
							<div class="calendar hidden-print">
								<header>
						            <h2 class="month"></h2>
						            <a class="btn-prev " href="#" ><i class="fa fa-angle-left"></i></a>
						            <a class="btn-next " href="#"><i class="fa fa-angle-right"></i></a>
								</header>
								<br><br>
								<table>
									<thead class="event-days">
						            	<tr></tr>
			        				</thead>
									<tbody class="event-calendar">
										<tr class="1"></tr>
										<tr class="2"></tr>
										<tr class="3"></tr>
										<tr class="4"></tr>
										<tr class="5"></tr>
			        				</tbody>
			    				</table>
			    			</div>				    		
			    		</div>

						<div class="col-md-8">
							<div class="list0" id="selected_event_div" style="display:none; padding:0px 15px 0px 15px;">
								<?php if(!empty($training)) { ?>
									<?php foreach ($training as $training_row) { ?>
										
											<div style="margin-bottom: 15px;" class="row courses_list_row day-event person-list" date-day="<?php echo round(date('d',strtotime($training_row->start_date))); ?>" date-month="<?php echo round(date('m',strtotime($training_row->start_date))); ?>" date-year="<?php echo round(date('Y',strtotime($training_row->start_date))); ?>"  data-number="1" event-class="t<?php echo $training_row->category_id; ?>">
								                <a href="#" class="close_select fontawesome-remove"><!-- <i class="fa fa-times"></i> --></a>
								                <div class="col-xs-12 col-sm-8 col-md-8">
													<h2 class="date"><?php echo date('d-M-Y',strtotime($training_row->start_date)); ?> To <?php echo date('d-M-Y',strtotime($training_row->end_date)); ?><?php  if(!empty($training_row->state)) echo ',<pink> '.$training_row->state.'</pink>'; ?></h2>
													<h2 class="title <?php if($training_row->category_id<5) echo $temp_training_array[$training_row->category_id-1]; ?>"><?php  if(!empty($training_row->title)) echo $training_row->title; ?></h2>	
								                </div>
								                <div class="col-xs-12 col-sm-8 col-md-4">
													<p class="pull-right"><b><?php  if(!empty($training_row->name)) echo $training_row->name; ?></b></p>
								                </div>
								                <div class="col-xs-12 col-sm-12 col-md-12 courses_text_col">
													<p><?php  if(!empty($training_row->description)) echo $training_row->description; ?></p>
													<h2 class="title"><?php  if(!empty($training_row->timing)) echo $training_row->timing; ?></h2>
													<h2 class="date"><?php  if(!empty($training_row->fees)) echo 'Fee - $'.$training_row->fees; ?></h2>
									                <label class="check-btn">
										                <input type="checkbox" class="save" id="save" name="" value=""/>
										                <span class="<?php if($training_row->category_id<5) echo $temp_training_array[$training_row->category_id-1]; ?>" onclick="open_my_model(<?php  echo $training_row->id;?>)"> Book Now!</span>
									                </label>
								                </div>
								            </div>
							            
									<?php }?>
						        <?php } ?>										        
						        <?php //End of the day list ?>
			        		</div>
			    			<div class="person-list" style="margin-bottom: 15px;">
			        			<!-- <h1 style="text-align: center">Upcoming Courses</h1>
			        			<hr class="footer_col_head"> -->
			        			<div class="row">
			        				<!-- <form action="<?php //echo base_url('training/calendar')?>" method="post"> -->
				        				<div class="form-group col-xs-12 col-sm-3 col-md-3">
					        				<div class="input-group">
					        					<label class="height_auto0">Month</label>
					        					<select id="month" class="form-control" >
					        						<option value="">ALL</option>
					        						<?php
					        						if(!empty($month_list))
					        						{
					        							foreach ($month_list as $month_list_key => $month_list_value) { ?>
					        								<option value="<?php echo $month_list_key; ?>" <?php  if(isset($_GET['month'])) { if($_GET['month'] == $month_list_key) echo "selected";}  ?>><?php echo$month_list_value ?></option>			        					
					        							<?php }
					        						} ?>
					        					</select>
					        				</div>
					        			</div>
					        			<div class="form-group col-xs-12 col-sm-3 col-md-3">
					        				<div class="input-group">
					        					<label class="height_auto">LOCATION</label>
					        					<select id="location" class="form-control" >
					        						<option value="">ALL</option>
					        						<?php $get_aus_states = get_aus_states();
					        						if(!empty($get_aus_states))
					        						{
					        							foreach ($get_aus_states as $get_aus_states_row) { ?>
					        								<option value="<?php echo $get_aus_states_row->state_code; ?>" <?php  if(isset($_GET['location'])) { if($_GET['location']== $get_aus_states_row->state_code) echo "selected";}  ?>><?php echo $get_aus_states_row->state_code; ?></option>			        					
					        							<?php }
					        						} ?>
					        					</select>
					        				</div>
					        			</div>
					        			<div class="form-group col-xs-12 col-sm-3 col-md-3">
					        				<div class="input-group">
					        					<label class="height_auto">CATEGORY</label>
					        					<select id="category" class="form-control" >
					        						<option value="">ALL</option>
					        						<option value="BRONZE" <?php  if(isset($_GET['category'])) { if($_GET['category']== 'BRONZE') echo "selected";}  ?>>BRONZE</option>
					        						<option value="SILVER" <?php  if(isset($_GET['category'])) { if($_GET['category']== 'SILVER') echo "selected";}  ?>>SILVER</option>
					        						<option value="GOLD" <?php  if(isset($_GET['category'])) { if($_GET['category']== 'GOLD') echo "selected";}  ?>>GOLD</option>
					        						<option value="PLATINUM" <?php  if(isset($_GET['category'])) { if($_GET['category']== 'PLATINUM') echo "selected";}  ?>>PLATINUM</option>
					        					</select>
					        				</div>
					        			</div>
					        			<div class="form-group col-xs-12 col-sm-3 col-md-3">
					        				<div class="input-group">        								   
					        					<!-- <input type="submit" value="Reset" class="btn_pink reset_btn"> -->
					        					<a href="<?php echo base_url('training/calendar')?>" class="btn_pink reset_btn">Reset</a>
					        				</div>
					        			</div>
					        		<!-- </form> -->
				        		</div>
			        			<!-- <hr class="footer_col_head"> -->			        			
				        	</div>
			        			<?php if(!empty($selected_training)) { ?>
									<?php foreach ($selected_training as $training_row) { ?>
				        			<div class="person-list" style="margin-bottom: 15px;">
										<div class="row day courses_list_row" date-day="<?php echo round(date('d',strtotime($training_row->start_date))); ?>" date-month="<?php echo round(date('m',strtotime($training_row->start_date))); ?>" date-year="<?php echo round(date('Y',strtotime($training_row->start_date))); ?>"  data-number="1" event-class="t<?php echo $training_row->category_id; ?>">
							                <div class="col-xs-12 col-sm-8 col-md-8">
							                	<h2 class="date"><?php echo date('d-M-Y',strtotime($training_row->start_date)); ?> To  <?php echo date('d-M-Y',strtotime($training_row->end_date)); ?> <?php  if(!empty($training_row->state)) echo ',<pink> '.$training_row->state.'</pink>'; ?></h2>
							                	<h2 class="title <?php if($training_row->category_id<5) echo $temp_training_array[$training_row->category_id-1]; ?>"><?php  if(!empty($training_row->title)) echo $training_row->title; ?></h2>							                	
							                </div>
											<div class="col-xs-12 col-sm-4 col-md-4">
												<p class="pull-right"><b><?php if(!empty($training_row->name)) { echo ucfirst($training_row->name); } ?></b></p>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 courses_text_col">
								                <p><?php  if(!empty($training_row->description)) echo $training_row->description; ?></p>
								                <h2 class="title"><?php  if(!empty($training_row->timing)) echo $training_row->timing; ?></h2>
								                <h2 class="date"><?php  if(!empty($training_row->fees)) echo 'Fee - $'.$training_row->fees; ?></h2>
								                <label class="check-btn">
									                <input type="checkbox" class="save" id="save" name="" value=""/>
									                <span class="<?php if($training_row->category_id<5) echo $temp_training_array[$training_row->category_id-1]; ?>" onclick="open_my_model(<?php  echo $training_row->id;?>)" >Book Now!</span>
								                </label>
							                </div>
								        </div>
									</div>
									<?php } ?>
								<?php } else { 
									echo '<div class="person-list"><h3>No Upcoming Courses Found</h3></div><br>';
									} ?>
			        			
								<?php // End of the day list ?>
			    			</div>
						</div>
						<div class="col-md-4 desktop_calendar sticky">
							<div class="calendar hidden-print">
								<header>
						            <h2 class="month"></h2>
						            <a class="btn-prev " href="#" ><i class="fa fa-angle-left"></i></a>
						            <a class="btn-next " href="#"><i class="fa fa-angle-right"></i></a>
								</header>
								<br><br>
								<table>
									<thead class="event-days">
						            	<tr></tr>
			        				</thead>
									<tbody class="event-calendar">
										<tr class="1"></tr>
										<tr class="2"></tr>
										<tr class="3"></tr>
										<tr class="4"></tr>
										<tr class="5"></tr>
			        				</tbody>
			    				</table>
			    			</div>				    		
			    		</div>
					<!-- </div> -->
				</div>
			</div>
		</div>
</section>
<!-- start model section  -->

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><label aria-hidden="true">&times;</label></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <div class="modal-body" style="margin-right: 15px; margin-left: 15px;">
    	<div class="row">
    		<p id="alert_message_modal"></p>
    	</div>
    	<div class="row">
			<div class="form-group">
				<h2 class="title">Title : <label id="training-title"></label></h2>
				<p id="training-detail"></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h4>Price : <pink id="training-fee"></pink></h4>
			</div>
			<div class="col-md-6">
				<div class="form-group pull-right">
				    <h4><label for="message-text" class="control-label">Number Of Seats</label></h4>
				    <div class="input-group" style="width:130px;">
						<span class="input-group-addon" onclick="manage_quantity('m')"><i class="fa fa-minus"></i></span>
						<input type="text" class="form-control" readonly value="1" max="999" id="training-input">
						<span class="input-group-addon" onclick="manage_quantity('p');"><i class="fa fa-plus"></i></span>
					</div>
					<!-- start hidden input fields  -->
						<input type="hidden" value="0" id="training-id">
					<!-- end hidden input fields -->
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="book_training_seats()">Book Now!</button>
      </div>
    </div>
  </div>
</div>
<script>

	function open_my_model(id)
	{
			$.post('<?php echo base_url("training/check_training_detail");?>', { id:id }, function(data) {
					if(data.STATUS === 1)
					{

						$('.modal-title').text('Book '+data.msg.name+' Training');
						$('#training-title').html(data.msg.title);
						$('#training-detail').html(data.msg.description);
						$('#training-fee').html('$'+data.msg.fees);
						$('#training-id').val(id);
						$('#training-input').attr('max',data.msg.participant);
						/*if(data.msg.participant<6)
						{
							$('#training-input').val(data.msg.participant);
						}
						else
						{
							$('#training-input').val(6);
						}*/
						$('#training-input').val(1);
						$('#exampleModal').modal('show');

					}
					else
					{
						$("#alert_message").html('<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-info-circle"></i>'+data.msg+'</div>');
						//alert();
					}
				});
	}

	function manage_quantity(e)
	{
		if(e=='m')
		{
			var qty = $("#training-input").val();
			qty = qty-1;
			if(qty>0)
			$("#training-input").val(qty);	
		}
		else
		{
			var qty = $("#training-input").val();
			var max = $('#training-input').attr('max');
			qty = eval(qty)+eval(1);
			if(qty<=max)
			$("#training-input").val(qty);	
		}
		//alert(e);
	}

	function book_training_seats()
	{
		var id = $('#training-id').val();
		var qty = $("#training-input").val();
		$.post('<?php echo base_url("training/book_training_seats");?>', { id:id,qty:qty}, function(data) {
					if(data.STATUS === 1)
					{
						$('#exampleModal').modal('hide');
						window.location.reload();
					}
					else
					{
						$("#alert_message_modal").html('<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-info-circle"></i>'+data.msg+'</div>');
					}
				});
	}
</script>
<!-- end model section -->


<!-- month=2016-04 -->
<?php 
	$month = date('m');
	$month = intval($month);
	$year  = date('Y');

	 if(isset($_GET['month']))
	 {
	 	$year_month = $_GET['month'];
	 	if(!empty($year_month))
	 	{
		 	list($new_year, $new_month) = explode('-', $year_month);
		 	$new_year = intval($new_year);
		 	$new_month = intval($new_month);
		 	if($new_month > $month && $new_month < 13)
		 	{
				$month = $new_month;	
		 	}

		 	if($new_year > $year)
		 	{
				$year = $new_year;	
		 	}
		 	
	 	}
	 }

 ?>
 
<!-- <script type="text/javascript" src="<?php //echo FRONTEND_THEME_URL_NEW; ?>vendor/calendar/js/simplecalendar.js"></script>  -->
<script type="text/javascript">
	var calendar = {

	  init: function() {

	    var mon = 'Mon';
	    var tue = 'Tue';
	    var wed = 'Wed';
	    var thur = 'Thur';
	    var fri = 'Fri';
	    var sat = 'Sat';
	    var sund = 'Sun';
	    $("#selected_event_div").hide();
	    /**
	     * Get current date
	     */
	    var d = new Date();

	    var monthNumber = <?php echo $month;?>;
	    var yearNumber = <?php echo $year;?>;

	    //alert(yearNumber);
	    var strDate = yearNumber + "/" + (d.getMonth() + 1) + "/" + d.getDate();
	    var currentYearNumber = (new Date).getFullYear();
	    var currentMonthNumber = d.getMonth() + 1;
	    //var yearNumber = currentYearNumber;
	    //alert(yearNumber);
	    /**
	     * Get current month and set as '.current-month' in title
	     */
	    //var monthNumber = d.getMonth() + 1;
	    //alert(monthNumber);

	    if(yearNumber == currentYearNumber && currentMonthNumber > monthNumber)
	    {
	    	monthNumber = currentMonthNumber;
	    }

	    function GetMonthName(monthNumber) {
	      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	      return months[monthNumber - 1];
	    }

	    setMonth(monthNumber, mon, tue, wed, thur, fri, sat, sund);

	    function setMonth(monthNumber, mon, tue, wed, thur, fri, sat, sund) {
	      $('.month').text(GetMonthName(monthNumber) + ' ' + yearNumber);
	      $('.month').attr('data-month', monthNumber);
	      printDateNumber(monthNumber, mon, tue, wed, thur, fri, sat, sund);
	    }

	    $('.btn-next').on('click', function(e) {
	      var monthNumber = $('.month').attr('data-month');
	      if (monthNumber > 11) {
	        $('.month').attr('data-month', '0');
	        var monthNumber = $('.month').attr('data-month');
	        yearNumber = yearNumber + 1;
	        setMonth(parseInt(monthNumber) + 1, mon, tue, wed, thur, fri, sat, sund);
	      } else {
	        setMonth(parseInt(monthNumber) + 1, mon, tue, wed, thur, fri, sat, sund);
	      };
	      btnPrev();
	    });

	     /*btn-prev display*/
	    function btnPrev()
	    {
	      
	      $(".btn-prev").show();        
	      var monthNumber = $('.month').attr('data-month');
	      if( (monthNumber == ((new Date).getMonth()+1) ) && (yearNumber == (new Date).getFullYear()))
	      {
	        $(".btn-prev").hide();        
	      }

	    }

	    $('.btn-prev').on('click', function(e) 
	    {
	            var monthNumber = $('.month').attr('data-month');
	            if (monthNumber < 2) 
	            {
	                if((yearNumber-1) >= (new Date).getFullYear())
	                {
	                  $('.month').attr('data-month', '13');
	                  var monthNumber = $('.month').attr('data-month');
	                  yearNumber = yearNumber - 1;
	                  setMonth(parseInt(monthNumber) - 1, mon, tue, wed, thur, fri, sat, sund);
	                }
	            } 
	            else 
	            {
	              if(yearNumber == (new Date).getFullYear())
	                {
	                    if(( yearNumber >= (new Date).getFullYear())  && ( monthNumber > ((new Date).getMonth()+1)) )
	                    {
	                      //alert((new Date).getMonth());
	                        setMonth(parseInt(monthNumber) - 1, mon, tue, wed, thur, fri, sat, sund);
	                    }
	                }
	                else if(yearNumber > (new Date).getFullYear())
	                {
	                      //alert((new Date).getMonth());
	                        setMonth(parseInt(monthNumber) - 1, mon, tue, wed, thur, fri, sat, sund);
	                }
	            };
	            btnPrev();
	    });

	    /**
	     * Get all dates for current month
	     */

	    function printDateNumber(monthNumber, mon, tue, wed, thur, fri, sat, sund) {

	      $($('tbody.event-calendar tr')).each(function(index) {
	        $(this).empty();
	      });

	      $($('thead.event-days tr')).each(function(index) {
	        $(this).empty();
	      });

	      function getDaysInMonth(month, year) {
	        // Since no month has fewer than 28 days
	        var date = new Date(year, month, 1);
	        var days = [];
	        while (date.getMonth() === month) {
	          days.push(new Date(date));
	          date.setDate(date.getDate() + 1);
	        }
	        return days;
	      }

	      i = 0;

	      setDaysInOrder(mon, tue, wed, thur, fri, sat, sund);

	      function setDaysInOrder(mon, tue, wed, thur, fri, sat, sund) {
	        var monthDay = getDaysInMonth(monthNumber - 1, yearNumber)[0].toString().substring(0, 3);
	        if (monthDay === 'Mon') {
	          $('thead.event-days tr').append('<c_td>' + mon + '</c_td><c_td>' + tue + '</c_td><c_td>' + wed + '</c_td><c_td>' + thur + '</c_td><c_td>' + fri + '</c_td><c_td>' + sat + '</c_td><c_td>' + sund + '</c_td>');
	        } else if (monthDay === 'Tue') {
	          $('thead.event-days tr').append('<c_td>' + tue + '</c_td><c_td>' + wed + '</c_td><c_td>' + thur + '</c_td><c_td>' + fri + '</c_td><c_td>' + sat + '</c_td><c_td>' + sund + '</c_td><c_td>' + mon + '</c_td>');
	        } else if (monthDay === 'Wed') {
	          $('thead.event-days tr').append('<c_td>' + wed + '</c_td><c_td>' + thur + '</c_td><c_td>' + fri + '</c_td><c_td>' + sat + '</c_td><c_td>' + sund + '</c_td><c_td>' + mon + '</c_td><c_td>' + tue + '</c_td>');
	        } else if (monthDay === 'Thu') {
	          $('thead.event-days tr').append('<c_td>' + thur + '</c_td><c_td>' + fri + '</c_td><c_td>' + sat + '</c_td><c_td>' + sund + '</c_td><c_td>' + mon + '</c_td><c_td>' + tue + '</c_td><c_td>' + wed + '</c_td>');
	        } else if (monthDay === 'Fri') {
	          $('thead.event-days tr').append('<c_td>' + fri + '</c_td><c_td>' + sat + '</c_td><c_td>' + sund + '</c_td><c_td>' + mon + '</c_td><c_td>' + tue + '</c_td><c_td>' + wed + '</c_td><c_td>' + thur + '</c_td>');
	        } else if (monthDay === 'Sat') {
	          $('thead.event-days tr').append('<c_td>' + sat + '</c_td><c_td>' + sund + '</c_td><c_td>' + mon + '</c_td><c_td>' + tue + '</c_td><c_td>' + wed + '</c_td><c_td>' + thur + '</c_td><c_td>' + fri + '</c_td>');
	        } else if (monthDay === 'Sun') {
	          $('thead.event-days tr').append('<c_td>' + sund + '</c_td><c_td>' + mon + '</c_td><c_td>' + tue + '</c_td><c_td>' + wed + '</c_td><c_td>' + thur + '</c_td><c_td>' + fri + '</c_td><c_td>' + sat + '</c_td>');
	        }
	      };
	      $(getDaysInMonth(monthNumber - 1, yearNumber)).each(function(index) {
	        var index = index + 1;
	        if (index < 8) {
	          $('tbody.event-calendar tr.1').append('<c_td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '"><c_type_1></c_type_1><c_type_2></c_type_2><c_type_3></c_type_3><c_type_4></c_type_4><c_da>' + index + '</c_da></c_td>');
	        } else if (index < 15) {
	          $('tbody.event-calendar tr.2').append('<c_td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '"><c_type_1></c_type_1><c_type_2></c_type_2><c_type_3></c_type_3><c_type_4></c_type_4><c_da>' + index + '</c_da></c_td>');
	        } else if (index < 22) {
	          $('tbody.event-calendar tr.3').append('<c_td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '"><c_type_1></c_type_1><c_type_2></c_type_2><c_type_3></c_type_3><c_type_4></c_type_4><c_da>' + index + '</c_da></c_td>');
	        } else if (index < 29) {
	          $('tbody.event-calendar tr.4').append('<c_td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '"><c_type_1></c_type_1><c_type_2></c_type_2><c_type_3></c_type_3><c_type_4></c_type_4><c_da>' + index + '</c_da></c_td>');
	        } else if (index < 32) {
	          $('tbody.event-calendar tr.5').append('<c_td date-month="' + monthNumber + '" date-day="' + index + '" date-year="' + yearNumber + '"><c_type_1></c_type_1><c_type_2></c_type_2><c_type_3></c_type_3><c_type_4></c_type_4><c_da>' + index + '</c_da></c_c_td>');
	        }
	        i++;
	      });
	      var date = new Date();
	      var month = date.getMonth() + 1;
	      var thisyear = new Date().getFullYear();
	      setCurrentDay(month, thisyear);
	      setEvent();
	      displayEvent();
	      btnPrev();
	    }

	    /**
	     * Get current day and set as '.current-day'
	     */
	    function setCurrentDay(month, year) {
	      var viewMonth = $('.month').attr('data-month');
	      var eventYear = $('.event-days').attr('date-year');
	      if (parseInt(year) === yearNumber) {
	        if (parseInt(month) === parseInt(viewMonth)) {
	          $('tbody.event-calendar c_td[date-day="' + d.getDate() + '"]').addClass('current-day');
	        }
	      }
	    };

	    /**
	     * Add class '.active_td' on calendar date
	     */
	    $('tbody c_td').on('click', function(e) {

	      if ($(this).hasClass('event')) {
	        $('tbody.event-calendar c_td').removeClass('active_td');
	        $(this).addClass('active_td');
	        $("#selected_event_div").show();
	      } else {
	        $('tbody.event-calendar c_td').removeClass('active_td');
	        $("#selected_event_div").hide();
	      };
	    });

	    /**
	     * Add '.event' class to all days that has an event
	     */
	    function setEvent() {
	      $('.day-event').each(function(i) {
	        var eventMonth = $(this).attr('date-month');
	        //eventMonth = parseInt(eventMonth);
	        var eventDay = $(this).attr('date-day');
	        //eventDay = parseInt(eventDay);
	        var eventYear = $(this).attr('date-year');
	       // eventYear = parseInt(eventYear);
	        var eventClass = $(this).attr('event-class');
	        if (eventClass === undefined) eventClass = 'event';
	        else eventClass = 'event ' + eventClass;

	        if (parseInt(eventYear) === yearNumber) {
	          $('tbody.event-calendar tr c_td[date-month="' + eventMonth + '"][date-day="' + eventDay + '"]').addClass(eventClass);
	        }
	      });
	    };

	    /**
	     * Get current day on click in calendar
	     * and find day-event to display
	     */
	    function displayEvent() {

	      $('tbody.event-calendar c_td').on('click', function(e) { 

	        $('.day-event').slideUp('fast');
	        var monthEvent = $(this).attr('date-month');
	        //monthEvent = parseInt(monthEvent);
	        var dayEvent = $(this).text();
	        //dayEvent = parseInt(dayEvent);
	        //alert(dayEvent);
	        $('.day-event[date-month="'+monthEvent+'"][date-day="'+ dayEvent+'"]').slideDown('fast');

	        if ($(this).hasClass('event')) 
	      	{
		        $('tbody.event-calendar c_td').removeClass('active_td');
		        $(this).addClass('active_td');
		        $("#selected_event_div").show();
	      	} 
	      	else 
	      	{
		        $('tbody.event-calendar c_td').removeClass('active_td');
		        $("#selected_event_div").hide();
		    };
		    
	      });
	    };


	    /**
	     * Close day-event
	     */
	    $('.close_select').on('click', function(e) {
	      $(this).parent().slideUp('fast');
	    });

	  },
	};

	$(document).ready(function() {
	  calendar.init();

	  $("#month").change(function(event) { serach_result(); });

	  $("#location").change(function(event) { serach_result(); });

	  $("#category").change(function(event) { serach_result(); });

	});

function serach_result()
{
	var current_url = "<?php echo current_url(); ?>";
  	var month 		= $("#month").val();
  	var location 	= $("#location").val();
  	var category 	= $("#category").val();
  	var url_length	= current_url.length;

  	if(month.length>0)
  	{
  		if(current_url.length == url_length)
  			current_url = current_url+'?month='+month;
  		else
  			current_url = current_url+'&month='+month;
  	}

  	if(location.length>0)
  	{
  		if(current_url.length == url_length)
  			current_url = current_url+'?location='+location;
  		else
  			current_url = current_url+'&location='+location;
  	}

  	if(category.length>0)
  	{
  		if(current_url.length == url_length)
  			current_url = current_url+'?category='+category;
  		else
  			current_url = current_url+'&category='+category;
  	}


  	window.location.assign(current_url);
}



/*
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

	if ($(window).width() > 991) {
	    if (scroll >= 100) {
			$('.calendar').addClass('stick');
	    } else {
	        $('.calendar').removeClass('stick');
	    }	
	}

});
*/

$(window).on("load", function() {


var stickySidebar = $('.sticky');

if (stickySidebar.length > 0) { 
  var stickyHeight = stickySidebar.height(),
    sidebarTop = stickySidebar.offset().top;
}

// on scroll move the sidebar

$(window).scroll(function () {
  if (stickySidebar.length > 0) { 
    var scrollTop = $(window).scrollTop();
    if (sidebarTop < scrollTop) {
      stickySidebar.css('top', scrollTop - sidebarTop);
      // stop the sticky sidebar at the footer to avoid overlapping
      var sidebarBottom = stickySidebar.offset().top + stickyHeight,
          stickyStop = $('.main-content').offset().top + $('.main-content').height();
      if (stickyStop < sidebarBottom) {
        var stopPosition = $('.main-content').height() - stickyHeight;
        stickySidebar.css('top', stopPosition);
      }
    }
    else {
      stickySidebar.css('top', '0');
    } 
  }
});

$(window).resize(function () {
  if (stickySidebar.length > 0) { 
    stickyHeight = stickySidebar.height();
  }
});

});



</script>

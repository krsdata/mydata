	<div class="page-content-wrapper">
		<div class="page-content">				
			
			<div class="clearfix">
			</div>
		
            <div class="row">
           		<div class="col-md-12 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>
								 Add Membership
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" action=""  class="form-horizontal" id="discount_code_form">
								<div class="form-body">
								    <div class="form-group">
										<label class="col-md-3 control-label">Membership Plan<small class="error">*</small> </label>
										<div class="col-md-3">
											<select name="plan_id" class="form-control" id="plan_id">
												<option value="">Select Plan</option>
												 <?php for($i=0;$i<count($planList);$i++){ ?>
												 <option <?php if(isset($_POST['plan_id'])&&$_POST['plan_id'] == $planList[$i]->id){ echo ' selected="selected" ';} ?> value="<?php echo $planList[$i]->id; ?>" > <?php echo $planList[$i]->title; ?></option>
												 <?php } ?>
											</select>
										    <?php echo form_error('plan_id'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Code<small class="error">*</small></label>
										<div class="col-md-3">
											<input value="<?php echo set_value('discount_code');?>" id="discount_code" name="discount_code" type="text" placeholder="Enter Code" class="form-control">
										    <?php echo form_error('discount_code'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label"> Select User </label>
										<div class="col-md-3">
											<select name="user_id" class="form-control selectpicker" id="user_id" >
												<option value="">Select User</option>
												 <?php for($i=0;$i<count($userList);$i++){ ?>
												 <option <?php if(isset($_POST['user_id'])&&$_POST['user_id'] == $userList[$i]->id){ echo ' selected="selected" ';} ?> value="<?php echo $userList[$i]->id; ?>" > <?php echo $userList[$i]->first_name.' '.$userList[$i]->last_name.' - '.$userList[$i]->email; ?></option>
												 <?php } ?>
											</select>
										    <?php echo form_error('user_id'); ?> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Start Date<small class="error">*</small></label>
										<div class="col-md-3">
											<div class="input-group">
												<input id="start_date" value="<?php echo set_value('start_date'); ?>" name="start_date" type="text" placeholder="Start Date" class="form-control start_datepicker date_icon_view" data-date-format="dd-mm-yyyy" src="" aria-describedby="date_icon" readonly >
												<span class="input-group-addon start_date_icon_click" id="date_icon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
											<?php echo form_error('start_date'); ?> 
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">End Date</label>
										<div class="col-md-3">
												<input id="end_date" value="<?php  echo set_value('end_date');  ?>" name="end_date" type="text" placeholder="End Date" class="form-control " readonly >
												
											<?php //echo form_error('start_date'); ?> 
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="col-md-3 control-label">End Date<small class="error">*</small></label>
										<div class="col-md-3">
											<div class="input-group">
												<input value="<?php echo set_value('end_date'); ?>" name="end_date" type="text" placeholder="End Date" class="form-control end_datepicker date_icon_view" data-date-format="dd-mm-yyyy" src="" aria-describedby="end_date_icon" readonly >
												<span class="input-group-addon end_date_icon_click" id="end_date_icon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
											<?php echo form_error('end_date'); ?> 
										</div>
									</div>
									-->
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<input class="btn green" type="submit" name="add_and_new" value="Save" id="save-btn">
											<a href="<?php echo base_url(); ?>backend/membership/discount_list"> <button  class="btn default" type="button">Cancel</button></a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
	       </div>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER-->


<!-- #Modal -->
<div class="modal bs-example-modal-sm0 fade" id="confirm_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm0" role="document">
    <div class="modal-content">
        <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><b>Confirmation Box</b></h4>
        </div>
        <div class="modal-body">
      		 <span id="confirm_message"></span>
        </div>	
      	<div class="modal-footer">
        	<button type="button" id="noButton" class="btn btn-primary" >No</button>
        	<button type="button" id="yesButton" class="btn btn-primary">Yes</button>
      	</div>
    </div>
  </div>
</div>
<!-- #Modal -->







<script type="text/javascript">
$( "#start_date").change(function(){
	get_end_date();
});
$( "#plan_id").change(function(){
	get_end_date();
});
$( "#yesButton").click(function(){
	$("#confirm_box").modal('hide');
	$("#discount_code_form").submit();
});
$( "#noButton").click(function(){
	$("#confirm_box").modal('hide');
	location.reload();
});
/*$( "#discount_code_form" ).submit(function( event ) {
	alert("testing");
});*/
$("#save-btn").click(function(event){
	
	if($("#plan_id").val()!='' && $( "#start_date" ).val()!='' && $( "#user_id" ).val()!='' && $( "#discount_code" ).val()!=''){
		//event.preventDefault(); 
	  	var request = $.ajax({
			  	url: "<?php echo site_url('backend/membership/check_exist_membership'); ?>",
			  	method: "POST",
			  	data: { "plan_id" : $("#plan_id").val(),
			  		"start_date" : $("#start_date").val(),
			  		"user_id" : $("#user_id").val(),
			  		"discount_code" : $("#discount_code").val(),	 },
			 	 dataType: "json",
			  	success: function(response){
		  		if(parseInt(response.status) == 1){
		  				$("#confirm_message").html(response.message);
		  				$("#confirm_box").modal('show');
			  	}else{
			  		$("#discount_code_form").submit();
			  	}
		  	}		  
		});
		return false;
	}
	
	 
  //event.preventDefault();
});
function get_end_date() {
	//alert($("#plan_id").val());	
	if($("#plan_id").val()!='' && $( "#start_date" ).val()!=''){
	  	var request = $.ajax({
		  url: "<?php echo site_url('backend/membership/get_end_date'); ?>",
		  method: "POST",
		  data: { "plan_id" : $("#plan_id").val(),
		  		"start_date" : $("#start_date").val()	 },
		  dataType: "json",
		  success : function(response){
		  	if(response.status == 1){
		  		$( "#end_date" ).val(response.end_date);
		  	}
		  }
		});
	}
}
</script> 
<script src="<?php echo BACKEND_THEME_URL ?>assets/global/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $(document).ready(function(){
 	$('.selectpicker').selectpicker({
 		size: 5,
 		liveSearch: true 
 	});
 });
 </script> 
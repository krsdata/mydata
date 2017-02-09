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
								<i class="fa fa-pencil-square-o"></i>
								 Edit Membership
							</div>
							
						</div>
						<div class="portlet-body form">
							<form  method="post" id="discount_code_form" action="" class="form-horizontal" enctype="multipart/form-data">
								<div class="form-body">
									
									<div class="form-group">
										<label class="col-md-3 control-label">Membership Plan </label>
										<div class="col-md-3">
											<select name="plan_id" class="form-control" disabled="disabled" id="plan_id">
												<option value="">Select Plan</option>
												 <?php for($i=0;$i<count($planList);$i++){ ?>
												 <option <?php if(isset($update)){if($update[0]->plan_id==$planList[$i]->id){ echo ' selected="selected" '; } }else if(isset($_POST['plan_id'])&&$_POST['plan_id'] == $planList[$i]->id){ echo ' selected="selected" ';} ?> value="<?php echo $planList[$i]->id; ?>" > <?php echo $planList[$i]->title; ?></option>
												 <?php } ?>
											</select>
										    <?php echo form_error('plan_id'); ?> 
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Code</label>
										<div class="col-md-3">
											<input readonly value="<?php if(isset($update)){ echo $update[0]->discount_code; }else{ echo set_value('discount_code'); }?>" name="discount_code" type="text" placeholder="Enter Code" class="form-control">
										    <?php echo form_error('discount_code'); ?> 
										</div>
									</div>
									

				           			<div class="form-group">
										<label class="col-md-3 control-label">Select User</label>
										<div class="col-md-3">
											<select name="user_id" class="form-control" <?php if(isset($update)) { if($update[0]->user_id > 0 ){ echo ' disabled="disabled" '; }} ?>  id="user_id">
												<option value="">Select User</option>
												 <?php for($i=0;$i<count($userList);$i++){ ?>
												 <option <?php if(isset($update)) { if($update[0]->user_id == $userList[$i]->id){ echo ' selected="selected" '; }} else if(isset($_POST['user_id'])&&$_POST['user_id'] == $userList[$i]->id){ echo ' selected="selected" ';}  ?> value="<?php echo $userList[$i]->id; ?>" > <?php echo $userList[$i]->first_name.' '.$userList[$i]->last_name.' - '.$userList[$i]->email; ?></option>
												 <?php } ?>
											</select>
										    <?php echo form_error('user_id'); ?> 
										</div>
									</div>
                                  

                                   <div class="form-group">
										<label class="col-md-3 control-label">Start Date<small class="error">*</small></label>
										<div class="col-md-3">
											<div class="input-group">
												<input value="<?php if(isset($update)) { echo date('j M Y',strtotime($update[0]->start_date)); } else { echo set_value('start_date'); } ?>" id="start_date" name="start_date" type="text" placeholder="Start Date" class="form-control start_datepicker date_icon_view" data-date-format="dd-mm-yyyy" src="" aria-describedby="date_icon" readonly >
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
												<input id="end_date" value="<?php if(isset($update)) { echo date('j M Y',strtotime($update[0]->end_date)); } else { echo set_value('end_date'); } ?>" name="end_date" type="text" placeholder="End Date" class="form-control " readonly >
												
											<?php //echo form_error('start_date'); ?> 
										</div>
									</div>

								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
										
										<input class="btn green" type="submit" name="add_and_new" value="Update" >
										 
										<a href="<?php echo base_url('backend/membership/discount_list/'.$offset); ?>"> <button  class="btn default" type="button">Cancel</button></a>

                                     
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
<script type="text/javascript">
$( "#discount_code_form" ).submit(function( event ) {
	$("#plan_id").prop("disabled",false);
  	$("#user_id").prop("disabled",false);
  //event.preventDefault();
});
$( "#start_date").change(function(){
	get_end_date();
}
);
$( "#plan_id").change(function(){
	get_end_date();
}
);




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

 
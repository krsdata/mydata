<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">
        	<?php if($this->session->flashdata('success_msg')){ ?>
		    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
			</div>
			<?php } ?>
            <div class="title">
              <h4><span> Edit user </span></h4>
            </div>
            <!-- End .title -->
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>             
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">First Name
                  <span class="help-block"><?php echo form_error('firstname'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="firstname" value="<?php if(!empty($users->firstname)) echo $users->firstname; ?>" placeholder="First Name">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Last Name 
                  	<span class="help-block"><?php echo form_error('lastname'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="lastname" value="<?php if(!empty($users->lastname)) echo $users->lastname; ?>" placeholder="Last Name">
                  </div>
                </div> 
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Email
                  <span class="help-block"><?php echo form_error('email'); ?></span>
                </label>
                  <div class="controls span9">
                    <span id="mail"><?php echo $users->email ?><a href="javascript:void(0)" id="change" ><span class="pull-right label label-info">change</span></a></span>
                    <span id="email_field"><input  type="text" value="<?php echo set_value('email'); ?>" class="row-fluid" name="email" placeholder="Email"></span>
                  </div>
                </div>               
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Mobile 
                    <span class="help-block"><?php echo form_error('phone'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="phone" value="<?php if(!empty($users->mobile)) echo $users->mobile; ?>" placeholder="Mobile no.">
                  </div>
                </div> 
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Address 
                    <span class="help-block"><?php echo form_error('address'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <textarea type="text" class="row-fluid" rows="5" name="address" placeholder="Address"><?php if(!empty($users->address)) echo $users->address; ?></textarea>
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">City 
                    <span class="help-block"><?php echo form_error('city'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="city" value="<?php  if(!empty($users->city)) echo $users->city; ?>" placeholder="city">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Zip 
                    <span class="help-block"><?php echo form_error('zip'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="zip" value="<?php  if(!empty($users->zip)) echo $users->zip; ?>" placeholder="zip">
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">State 
                    <span class="help-block"><?php echo form_error('state'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <input type="text" class="row-fluid" name="state" value="<?php  if(!empty($users->state)) echo $users->state; ?>" placeholder="state">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Country
                   <span class="help-block"><?php echo form_error('country'); ?></span>
                  </label>
                  <div class="controls span9">
                    <select name="country" class="chzn-select">
                      <option value="">Select Country</option>   
                       <?php  $country = get_country_array(); ?>                  
                      <?php foreach ($country as $key => $row): ?>                  
                      <option value="<?php echo $key ?>" <?php if($users->country == $key) echo "selected='selected'"; ?> ><?php echo $row;?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>  
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9">
                    <button type="submit" class="btn">Submit</button>                    
                  </div>
                </div> 
            <?php echo form_close(); ?>
             </div>
      </div>      
    </div>
  </div>
<style type="text/css">
  .help-block{
    color: red;
  }
</style>
    <script type="text/javascript">
    $(document).ready(function(){
      // alert("here");
      $('#email_field').hide();

    });
    $('#change').click(function(){
      $('#email_field').show();
      $('#mail').hide();
    });  
</script>
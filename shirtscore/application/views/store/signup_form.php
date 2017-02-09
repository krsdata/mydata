  <style type="text/css">
  hr{
    border-color:#3B5998; 
    /*-moz-use-text-color: #FFFFFF !important; */
  }
  .stepstwo{
   padding: 15px;
border-top: 1px dashed rgb(49, 141, 68);
border-bottom: 1px dashed rgb(49, 141, 68);
  }
</style>
<div class="container">
       <div class="row" style="/* margin-left: 10% */">
          <div id="home_btn" class="span2 home" style="margin-left: 50px;"> <!--<a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a>--></div> 
          <div id="dude_text" class="span7 flavor_text">Turn your designs into cash!</div>
          <div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>
       </div>
        <div class="clearfloat"></div>
         <!--  <div style="padding: 10px 0;">
           <center class="stepstwo"><img src="<?php echo base_url() ?>assets/images/step2.png?>" alt=""></center>
              
          </div> -->
          <div class="dashcontent"> 
          <div class="row-fluid">   
          <div class="span12">      	
			<div class="dashbox"><h2>Create Your Account</h2>			
        <?php echo form_open(current_url(),array('class'=>'form-horizontal')); ?>
        
           <div class="well clearfix">
             <div class="span5">
            </div>
             <div class="span5">
            </div>

        <?php $userprofile = $this->session->userdata('fb_login_user_info');  ?>   

        <div class="span5">
          <strong>First Name</strong><br> 
          <input class="span8" type="text" name="firstname" value="<?php if(!empty($userprofile['firstname'])) echo $userprofile['firstname']; else echo set_value('firstname'); ?>"><?php echo form_error('firstname') ?><br/><br/>
          </div>

           <div class="span5">
          <strong>Last Name</strong><br/>
          <input class="span8" type="text" name="lastname" value="<?php if(!empty($userprofile['lastname'])) echo $userprofile['lastname']; else echo set_value('lastname'); ?>">
          <?php echo form_error('lastname'); ?><br/><br/>
           </div>      
         

          <div class="span5">
          <strong>Email Address <img src="<?php echo base_url('assets/images/icon.png'); ?>" height="10px" width="10px" title="used for logging in" /></strong><br/>
          <input class="span8" type="text" id="email" name="email" value="<?php if(!empty($userprofile['email'])) echo $userprofile['email']; else echo set_value('email'); ?>">
          <?php echo form_error('email'); ?><br/><br/>
          </div>

          <div class="span5">
           <strong>Confirm Email Address </strong><br/>
          <input class="span8" type="text" name="c_email" value="<?php if(!empty($userprofile['email'])) echo $userprofile['email']; else echo set_value('c_email'); ?>" />
          <?php echo form_error('c_email'); ?> <br/><br/>
          </div>

          <div class="span5">
         <strong>Password </strong>(at least 6 characters)<img src="<?php echo base_url('assets/images/icon.png'); ?>" height="10px" width="10px" title="used for logging in" /> <br>
          <input class="span8" type="password" name="password" value="<?php echo set_value('password'); ?>"/><?php echo form_error('password') ?><br><br/></div>

         <!--  <div class="span5">
          <strong>Phone Number</strong><br/>
          <input class="span8" type="text" name="mobile" value="<?php //echo set_value('mobile'); ?>">
          <?php //if(form_error('mobile')){echo"<div class='error'>Valid Phone number is required.</div>";} ?><br/><br/>
          </div> 


          <div class="span5">
          <strong>Address</strong><br/> 
          <input class="span8" type="text" name="address" value="<?php //echo set_value('address'); ?>">
          <?php //echo form_error('address'); ?><br/><br/>
          </div>

          <div class="span5">
          <strong>City</strong><br/>
          <input class="span8" type="text" name="city" value="<?php //echo set_value('city'); ?>">
          <?php //echo form_error('city'); ?><br/><br/>
          </div>

          <div class="span5">
          <strong>State</strong><br/>
          
          <select name="state"  class="form-control" id="default-select">
                          <option value="">Select State</option>
                           <?php //if(!empty($state))foreach ($state as $row): ?>
                       <option <?php //if($row->state == set_value('state') ){echo "selected='selected'";} ?> value="<?php //echo $row->state; ?>"> <?php //echo $row->state; ?></option>
                          <?php //endforeach ?>
           </select>

          <?php //echo form_error('state'); ?><br/><br/>
            </div>

          <div class="span5">
          <?php // $country = get_country_array(); ?>
          <strong>Country</strong>  <br/>
          <input type="text" class="form-control" name="country" readonly="" value="USA">
          <?php //echo form_error('country'); ?><br/><br/>
         </div>

          <div class="span5">
          <strong>Zip Code</strong><br/>
          <input class="span8" type="text" name="zip_code" value="<?php //echo set_value('zip_code'); ?>">
          <?php //if(form_error('zip_code')){echo"<div class='error'>Valid Zip code is required.</div>";} ?>
          <br/><br/></div>-->

          

         

          <div class="span5">
           <strong>Confirm Password</strong> <br>
					<input class="span8" type="password" name="c_password" value="<?php echo set_value('c_password'); ?>" /><?php echo form_error('c_password') ?><br><br/></div>

          <div class="span10">
        <strong>Security Question </strong><br/>
        (in case you need to reset your password)<br /><br/>
         </div>

          <div class="span5">
         
					<strong>Question</strong><br> 
					<select class="span8" name="securityquestion">
						<option value="" selected='selected'>Select Question</option>
						<option value="1" <?php if(!empty($_POST)){if($_POST['securityquestion']==1){ echo"selected='selected'";}}?>>Which is Your Favourite car 
            </option>
						<option value="2" <?php  if(!empty($_POST)){if($_POST['securityquestion']==2){ echo"selected='selected'";}}?>>What is the name of your first teacher</option>
						<option value="3" <?php  if(!empty($_POST)){if($_POST['securityquestion']==3){ echo"selected='selected'";}}?>>What is your first school name</option>
					</select><?php echo form_error('securityquestion') ?><br><br/></div>

					 <div class="span5">
           <strong>Your Answer</strong><br />

					<input class="span8" type="text" name="answer" value="<?php echo set_value('answer'); ?>" /><?php echo form_error('answer') ?><br><br/></div>
         

          <div class="span10">
          <p><input type="checkbox" style="height: 22px;width: 22px;" value="agreed" name="declare" id="i-declare" <?php if($declare != ''){echo 'checked="checked"';} ?> /> &nbsp;
           <strong>I declare that I have read  <a target="_blank" href="<?php echo base_url(); ?>store/pages/user-agreement">User Agreement</a> and <a target="_blank" href="<?php echo base_url(); ?>store/pages/privacy-policy">Privacy Policy</a>.</strong></p>
           <span style="color:red" id="declare-error"></span><br>
           </div>
           <div class="span5">
					<input id="help_submit" type="submit" value="Continue" class="btn-success btn update_cart"/>
          </div>
				</div></div>
				<?php echo form_close(); ?>
			</div>
		 </div>
          <div>
            <br /><br /><h4 align="center">Your design could be featured right here.</i></h4><br />
           <span class="blue_arrow"><h4><span style="margin-left:30%"><i class="icon-arrow-down1"></i></span><span style="margin-left:18%"><i class="icon-arrow-down1"></i></span><span style="margin-left:18%"><i class="icon-arrow-down1"></i></span></h4></span>

        <div style="margin-left:9%">
              <?php if($latest_design): $i = 1; foreach ($latest_design as $row): ?>
                   <div class="designlft">
                <div class="designbox">
                      <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>">
                    <!-- <img src="<?php // echo base_url() ?>assets/uploads/designs/<?php // echo $row->design_image ?>"  /> -->
                    <img title="<?php echo $row->design_title; ?>" id="facebook_share<?php echo $i; ?>" slug="<?php echo $row->slug; ?>" dname="<?php echo $row->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" />
                  </a>
                </div>
                <div class="likesharewear">
                    <?php ?>
                    <div style="float:left; width:35%;margin-top: -10px;">
                        <?php get_facebook_likes(base_url().'wear_it/'.$row->id,$row->slug); //update facebook like count of design per ?>
                        <div class="fb-like" data-href="<?php echo base_url() ?>store/fblike/<?php echo $row->id; ?>" data-width="450" data-layout="button_count"></div>
                    </div> 
                    <div class="shareit">
                      <a onclick="fbshare(<?php echo $row->id; ?>);" title="share on facebook" ids="facebook_share<?php echo $i; ?>" href="javascript:void(0);" ><div><i class="icon-share icon-large"></i>&nbsp;share it</div> </a>
                    </div>
                    <!-- <div class="shareit"> <a title="share on facebook" href="javascript:fbshare(<?php // echo $row->id; ?>)"><div id="facebook_share"><i class="icon-share icon-large"></i>&nbsp;share it</div> </a> </div> -->
                    <div class="wearit "> <a href="<?php echo base_url().'wear_it/'.$row->slug; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" style="margin-top:-25px" alt="Wear it!" name="WearIt1" width="80" height="37" border="0" id="WearIt1" /></a></div>
                </div>
              </div>
              <?php $i++; endforeach; endif; ?>
    </div>
</div>


    <script type="text/javascript">//declare-error
      jQuery(document).ready(function() {
          jQuery('#help_submit').click(function(){
              return check_validate();
          });
          function check_validate() {
              var error = '';
              var is_checked = jQuery("#i-declare").is(":checked");

              if (!is_checked)
              {
                alert(' * Declaration required.');
                return false;
              }
              return true; //valid;    
          }
      });
    </script>

    <style type="text/css">
    .margintop{
      margin-top: -10px;
    }
    </style>

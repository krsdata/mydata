<div class="container">
       <div class="row" style="/* margin-left: 10% */">
          <div id="home_btn" class="span2 home" style="margin-left: 50px;"><a href="<?php echo base_url().home_url(); ?>"><i class="icon-home"></i> Home</a></div>
          <div id="dude_text" class="span7 flavor_text">Psst... wanna make some money?</div>
          <div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>
        </div>
        <div class="clearfloat"></div>
          <div style="padding: 10px 0;">
              <hr color="#CCCCCC"/> 
          </div>
          <div class="dashcontent">          	
			<div class="dashbox"><h2>Please complete your profile info</h2>				
        <?php echo form_open(current_url()); ?>
        <div class="login_details">
          First Name <?php if(form_error('firstname')) echo '<span style="color:red"> *Required</span>'; ?><br />
          <input class="span5" type="text" name="firstname" value="<?php if (set_value('firstname')) { echo set_value('firstname');}else{echo $firstname;} ?>"><br />
          Last Name <?php if(form_error('lastname')) echo '<span style="color:red"> *Required</span>'; ?><br />
          <input class="span5" type="text" name="lastname" value="<?php if (set_value('lastname')) { echo set_value('lastname'); }else{echo $lastname;}?>"><br />
          Email Address (This will be your login ID) <?php if(form_error('email')) echo '<span style="color:red"> *'.form_error('email').'</span>'; ?><br />
          <input class="span5" type="text" name="email" value="<?php if (set_value('email')) { echo set_value('email'); }else{echo $email;}  ?>"><br />
          Confirm Email Address <?php if(form_error('c_email')) echo '<span style="color:red"> *'.form_error('c_email').'</span>'; ?><br />
          <input class="span5" type="text" name="c_email" value="<?php if (set_value('c_email')){ echo set_value('c_email'); }else{echo $email;} ?>" /><br />
          Address <?php if(form_error('address')) echo '<span style="color:red"> *Required</span>'; ?><br />
          <input class="span5" type="text" name="address" value="<?php echo set_value('address'); ?>"><br />
          City <?php if(form_error('city')) echo '<span style="color:red"> *Required</span>'; ?><br />
          <input class="span5" type="text" name="city" value="<?php echo set_value('city'); ?>"><br />
          State <?php if(form_error('state')) echo '<span style="color:red"> *Required</span>'; ?><br />
          <input class="span5" type="text" name="state" value="<?php echo set_value('state'); ?>"><br />

          <?php $country = get_country_array(); ?>
          Country <?php if(form_error('country')) echo '<span style="color:red"> *Required</span>'; ?><br />
          <select class="span5" name="country">
            <option value="">Select Country</option>
            <?php foreach ($country as $code => $name): ?>  
                <option <?php if(set_value('country') == $code){echo "selected = 'selected'";} ?> value="<?php echo $code; ?>"><?php echo $name; ?></option>
            <?php endforeach ?>
          </select><br />

          <!-- <input class="span5" type="text" name="country" value="<?php //echo set_value('country'); ?>"><br /> -->

          Zip Code <?php if(form_error('zip_code')) echo '<span style="color:red"> *Required</span>'; ?><br />
          <input class="span5" type="text" name="zip_code" value="<?php echo set_value('zip_code'); ?>"><br />
					<input id="help_submit" type="submit" class="btn" value="Continue" />
				</div>
				<?php echo form_close(); ?>
			</div>
		 </div>
          <div>
            <br /><br /><h4 align="center">Your design could be featured right here.</i></h4><br />
           <span class="blue_arrow"><h4><span style="margin-left:30%"><i class="icon-arrow-down1"></i></span><span style="margin-left:18%"><i class="icon-arrow-down1"></i></span><span style="margin-left:18%"><i class="icon-arrow-down1"></i></span></h4></span>

        <div style="margin-left:9%">
        <div class="designlftFoot">
      	     <div class="designboxFoot"></div>
        <div class="likesharewear">
          <div style="display:none;" class="fb_likebtn"><img src="<?php echo base_url() ?>assets/front_theme/img/fb_like.png" /></div>
          <div class="wearit"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt1','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt1" border="0" id="WearIt1" /></a></div>
        </div>
      </div>
      <div class="designlftFoot">
        <div class="designboxFoot"></div>
          <div class="likesharewear">
          <div style="float:left; padding-right:85px;display:none;">
            <img src="<?php echo base_url() ?>assets/front_theme/img/fb_like.png" />
          </div>
          <div class="wearit">
            <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt2','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt2" border="0" id="WearIt2" /></a>
          </div>
        </div>
      </div>
      <div class="designlftFoot">
        <div class="designboxFoot"></div>
        <div class="likesharewear">
        <div style="float:left; padding-right:85px;display:none;">
          <img src="<?php echo base_url() ?>assets/front_theme/img/fb_like.png" />
        </div>
        <div class="wearit"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('WearIt3','','<?php echo base_url() ?>assets/front_theme/img/wearit_hov.png',1)"><img src="<?php echo base_url() ?>assets/front_theme/img/wearit.png" alt="Wear it!" name="WearIt3" border="0" id="WearIt3" /></a>
        </div>
      </div>
    </div>
    </div>
</div> 
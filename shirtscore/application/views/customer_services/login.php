<!DOCTYPE html>
<html class="no-js login" lang="en">
<head>
<meta charset="utf-8">
<title>Login - Customer Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- <link rel="shortcut icon" href="css/images/favicon.png"> -->
<!-- Le styles -->
<link href="<?php echo base_url() ?>assets/theme/css/twitter/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/theme/css/base.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/theme/css/twitter/responsive.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/theme/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/theme/js/plugins/modernizr.custom.32549.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

</head>

<body>
<div id="login_page"> 
  <!-- Login page -->
  <div id="login" style="top:-11%">
    <div class="row-fluid">     
      <span class="span2"></span>
       <div class="span9">
          <div class="box paint color_0">
            <div class="title">
              <h4><span>Customer Service Login</span> </h4>
            </div>
            <div class="content ">
               <?php if($this->session->flashdata('error_msg')): ?>
            <span class="help-block" style="color:white"><?php echo $this->session->flashdata('error_msg'); ?></span>
          <?php endif; ?>

          <?php if($this->session->flashdata('success_msg')): ?>
             <span class="help-block" style="color:white"><?php echo $this->session->flashdata('success_msg'); ?></span>
          <?php endif; ?>
              <!-- <form action="<?php echo current_url() ?>" method="post" class="bs-docs-example form-horizontal"> -->
               <?php echo form_open(current_url(), array('class'=>'bs-docs-example form-horizontal')); ?>
                <div class="control-group row-fluid">
                  <label class="control-label span3" for="inputPassword">Email</label>
                  <div class="controls span9 input-append">
                    <input type="text" id="inputUsername" name="email" placeholder="Email" class="row-fluid">
                    <span class="help-block" style="color:white"><?php echo form_error('email')?></span>
                   </div>
                </div>
                <div class="control-group row-fluid">
                  <label class="control-label span3" for="inputPassword">Password</label>
                  <div class="controls span9 input-append">
                    <input type="password" id="inputPassword" name="password" placeholder="Password" class="row-fluid">
                    <span class="help-block" style="color:white"><?php echo form_error('password')?></span>
                  </div>
                </div>
                
                   <div class="control-group row-fluid">
                 <div class="span3"></div>
                  <div class="controls span9">
                    <input type="checkbox" name="rememberme" value="1"> Remember Me                                       
                  </div>
                </div>
                
                <div class="control-group row-fluid">
                 <div class="span3"></div>
                  <div class="controls span5">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- End .box --> 
        </div>
     
    </div>
  </div>
  <!-- End #login --> 
  <!-- <img src="img/ajax-loader.gif"> --> 
</div>
<!-- End #loading --> 


</body>
</html>

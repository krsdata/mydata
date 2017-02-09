<!DOCTYPE HTML>
<html lang="en">
<head>
  <title><?php echo site_title() ?></title>
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href='<?php echo base_url();?>assets/bootstrap/css/bootstrap.css' rel='stylesheet' type='text/css' />
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery-1.9.1.min.js"></script> 
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>  
  <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
  </style>
</head>
<body>

    
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?php echo site_title() ?> Superadmin Panel</a>
          <div class="nav-collapse collapse">
          

          
         
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<div class="container">
<div class="page-header" style="text-align:center">
    <h1>Superadmin Login</h1>
  </div>

 

    <div class="row-fluid">
        <div class="span4">
        </div>
        <div class="span4">
           <?php if($this->session->flashdata('error_msg')): ?>
             <div class="alert alert-error">
              <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
            </div>
          <?php endif; ?>

          <?php if($this->session->flashdata('success_msg')): ?>
             <div class="alert alert-success">
              <strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
          <?php endif; ?>
         
                <div class="well">
                    <?php echo form_open(current_url()); ?>
                    <div class="form">
                        <p><label>Email:</label> <input type="text" name="email" class="field" style="width:90%;" /></p>
                        <span class="errorr"><?php echo form_error('email')?></span>
                        <p><label>Password:</label><input type="password" name="password" class="field" style="width:90%;" /></p>
                        <span class="errorr"><?php echo form_error('password')?></span>
                    </div>
                    
                    <div class="form-actions">
                         <button class="btn btn-primary" type="submit">Log In</button>
                         
                     </div>
                    <?php echo form_close(); ?>
                </div>
        </div>
            <div class="span4">
            </div>
    </div>
</div> 
<hr>
<div id="footer" style="text-align:center">
<div class="shell">
  <span class="left"><?php echo site_copyright() ?></span>
  <span class="right">
   
  </span>
</div>

</div>
<!-- End Footer -->
  
</body>
</html>

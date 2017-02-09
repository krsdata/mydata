<div class="container">
       <div class="row" style="/* margin-left: 10% */">
       <div id="home_btn" class="span2 home" style="margin-left: 50px;"><!--  <a href="<?php echo base_url(); ?>"><i class="icon-home"></i> Home</a> --></div>
        <div id="dude_text" class="span7 flavor_text">Psst... wanna make some money</div>
        <div id="cart_btn" class="span2 cart"><a href="<?php echo base_url() ?>store/cart"><i class="icon-shopping-cart"></i> Cart</a></div>
      </div>
        <div class="clearfloat"></div>
          <div style="padding: 10px 0;">
              <hr color="#CCCCCC"/> 
          </div>
          <div class="dashcontent">
             <div class="dashbox">
                <h2>Error</h2>
                <?php if($this->session->flashdata('banned_msg')){ ?>
                  <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error :</strong><br><?php echo $this->session->flashdata('banned_msg'); ?>
                  </div>
                <?php } ?> 

                <?php if($this->session->flashdata('no_store_msg')){ ?>
                  <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error :</strong><br><?php echo $this->session->flashdata('no_store_msg'); ?>
                  </div>
                <?php } ?>
                <br>
                <h3><?php echo $error_msg; ?></h3>
                <br /><br /> <!-- <a href="#">https://www.shirtscore.com/receipt...</a> -->
                <hr color="#CCCCCC" />
              </div>
          </div>
</div> 
 <hr color="#CCCCCC" />
<style type="text/css" media="screen">
  .dashcontent{
     font-size: 14px !important;
  }
</style>
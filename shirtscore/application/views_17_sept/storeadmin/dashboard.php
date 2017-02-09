<div class="clearfloat"></div>
<div class="dashcontent">
    <div class="dashbox">
         <?php if($this->session->flashdata('success_msg')){ ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
         <?php } ?>
         <?php if($this->session->flashdata('error_msg')){ ?>
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
            </div>
         <?php } ?>
        <div class="dashicon">
            &nbsp;<i class="icon-envelope"></i>&nbsp;
        </div>
        <h2>New Messages</h2>
        <hr color="#ccc" />
        <?php if($messages): ?>
          <h3><a href="<?php echo base_url().'storeadmin/messages'; ?>">You have (<?php echo count($messages); ?>) new <?php if(count($messages) > 1) echo "messages"; else echo "message"; ?>.</a></h3>
         <!--  <?php //foreach ($messages as $row): ?>
          
            <h3><a href="<?php //echo base_url().'storeadmin/messages'; ?>"><?php //echo $row->subject; ?></a></h3>
            <?php //echo word_limiter($row->message, 10); ?>
          <?php //endforeach; ?> -->
        <?php else: ?>
          <h3><a href="<?php echo base_url().'storeadmin/messages'; ?>">You have (0) new message.</a></h3>
        <?php endif; ?>

        <!---message compelete-->
         <h2>Stores</h2>
         <hr color="#ccc" />
        <?php if($stores){  foreach($stores as $row){ ?> 
          <h3><a href="<?php echo base_url() ?>shop/<?php echo $row->store_link; ?>" target="_blank" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="view Store"><?php echo ucfirst($row->store_name);?></a></h3>
            <h5>Status : <?php if ($row->status == 0){ ?>
              Pending
            <?php }elseif ($row->is_blocked == 1){ echo "<span>Blocked</span>" ?>
          <?php }else echo "<span>Approved</span>" ?></h5>
          <?php }} ?>
          <!---stores compelete-->

       <!--  <hr color="#ccc" />
        <h3><a href="#">Upload a Design!</a></h3>
        Upload a design and start making some $$$, or order some swag for yourself! -->
    </div>
    <div>&nbsp;</div>
    <div class="dashbox">
        <div class="dashicon">
          &nbsp;<i class="icon-upload-alt"></i>&nbsp;
          &nbsp;<i class="icon-picture"></i>&nbsp;
        </div>
        <h2>Pending Designs</h2>
          <hr color="#ccc" />
        
         <?php if($pending_designs): ?>
          
          <h3><a href="<?php echo base_url().'storeadmin/my_designs'; ?>">You have (<?php echo count($pending_designs); ?>) new <?php if(count($pending_designs) > 1) echo "designs"; else echo "design"; ?> pending.</a></h3>


          You have <?php echo count($pending_designs); ?> new 
          <a href="<?php echo base_url().'storeadmin/my_designs'; ?>"><?php if(count($pending_designs) > 1) echo "designs"; 

          else echo "design"; ?></a> pending. Once your design has been approved it will be available for purchase. Most approvals occur within minutes but may take up to 48 hours. While you wait, feel free to 

          <a href="<?php echo base_url().'storeadmin/add_design'; ?>">upload</a> as many new designs as you like.<br />
        <?php else: ?>
          <h3><a href="<?php echo base_url().'storeadmin/my_designs'; ?>">You have (0) new pending design.</a></h3>
          <a class="btn-success btn update_cart btn-large" href="<?php echo base_url() ?>storeadmin/add_design"> Upload New design </a>
        <?php endif; ?>

       


    </div>
<div>&nbsp;</div>
<div>
    <?php if($pending_designs): ?>
        <?php foreach ($pending_designs as $row): ?>
            <div class="designlftFoot">
              <div class="designboxFoot">
               <img src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $row->design_image; ?>" style="height:100%!important;" width="255" />
              </div>
              <div class="pending"><a href="<?php echo base_url().'storeadmin/my_designs'; ?>">Pending</a></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
     
</div>

 
        
</div>



<style type="text/css">
  hr{
    border-color:#3B5998; 
    /*-moz-use-text-color: #FFFFFF !important; */
  }
</style>
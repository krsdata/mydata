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

          <div class="coversation span11">
     <?php if($results){ ?>
        <div class="row-fluid color-white">
            <div class="span1"> 
                <img src='<?php echo base_url()?>assets/front_theme/img/user.png' style="width:60px; margin-top:15px"> 
            </div>
            <div class="span10">
                <div class="msg_top"><b><?php echo $results->name ?></b> <span class="pull-right"><?php echo $results->email ?></span></div>
                <div class="row-fluid" style="color:#808080"><span><?php echo $results->question; ?></span></div>
                <div class="row-fluid" style="color:#808080"><?php $time=explode(',',timespan(strtotime($results->created), time())); echo $time[0];  ?> ago</div>
            </div>
        </div>
     <?php } ?>
     <?php if($reply){ 
                  $ij = 1;
                 foreach ($reply as $row): ?>
             <br>
             <div class="row-fluid color-white">
             <!--   <?php //echo $info['id']." = ".$row->user_id; ?> -->
             <?php if ($ij != 1): ?>
             <?php endif ?>
               <?php if(!($info['id'] == $row->user_id)){?>
                <div class="span10">

                  <div class="msg_top"><b><?php echo $row->user_name ?></b> <span class="pull-right"><?php echo $row->email ?></span></div>
                  <div class="row-fluid" style="color:#808080"><span><?php echo $row->message; ?></span></div>
                  <div class="row-fluid" style="color:#808080"><?php $time=explode(',',timespan(strtotime($row->created), time())); echo $time[0];  ?> ago</div>

                </div>

                <div class="span1"> 
              <img src='<?php echo base_url()?>assets/front_theme/img/user.png' style="width:60px; margin-top:15px"> 
            </div>

              <?php }else{ ?>
           
            <div class="span1"> 
              <img src='<?php echo base_url()?>assets/front_theme/img/user.png' style="width:60px; margin-top:15px"> 
            </div>
                <div class="span10">

                  <div class="msg_top"><b><?php echo $row->user_name ?></b> <span class="pull-right"><?php echo $row->email ?></span></div>
                  <div class="row-fluid" style="color:#808080"><span><?php echo $row->message; ?></span></div>
                  <div class="row-fluid" style="color:#808080"><?php $time=explode(',',timespan(strtotime($row->created), time())); echo $time[0];  ?> ago</div>
                </div>
              <?php } ?>
            </div>            
             <?php $ij++; endforeach; } ?>
 </div>
            <div class="row"><a id="reply" href="javascript:void(0)" class="btn btn-large" style="float:right; margin-right:10%">Reply</a>
              <div id="form_div">
                <?php echo form_open(current_url(),array('class'=>'row-fluid')); ?>
                <div class="row-fluid">
                  <span id="reply_box">
                   <br><textarea style="margin-left:8%; width:88%;" name="reply" rows="" class="span6"></textarea>
                  </span>
                </div>
                <div class="row-fluid">
                    <button style="margin-left:8%;" type="submit" class="btn " value="reply">Send</button>
                </div><br>
               </div>
               <?php echo form_close(); ?>
          </div>
      </div>      
    </div>
  </div>
     <script type="text/javascript">
    $(document).ready(function(){
         $('#form_div').hide();
    });
      $('#reply').click(function(){
        $('#reply').hide();
         $('#form_div').show();
      });
    </script>
    <style type="text/css">
      .messages_layout{
        list-style: none !important;        
      }
    </style>


<style type="text/css" media="screen">
  .designboxFoot span{
    color:green;
  }
  .coversation{
    padding: 15px;
  }
  .designboxFoot{
    border-radius: 5px 5px 5px 5px;
      padding: 10px;
    height: 100px;
    float: left;
    background: none repeat scroll 0 0 #FFFFFF;
  }
   .color-white{
      padding-left: 10px;
      background-color:#C0E3FF !important;
      border-radius:15px;
      padding: 15px;
      margin-left: 3%;
   }
   .msg_top{
    padding:10px;
    color:#808080;
   }
</style>
<div class="dashcontent" style="padding-left:20px;">
		
		<?php if($this->session->flashdata('success_msg')){ ?>
	        <div class="alert alert-success">
	          <button type="button" class="close" data-dismiss="alert">&times;</button>
	          <strong>Info :</strong><br><?php echo $this->session->flashdata('success_msg'); ?>
	        </div>
        <?php } ?>
</div>

<div class="coversation span9">
     <?php if($results){ ?>
        <div class="row-fluid color-white">
            <div class="span1"> 
                <img src='<?php echo base_url()?>assets/front_theme/img/user.png' style="width:60px; margin-top:15px"> 
            </div>
            <div class="span9">
                <div class="msg_top"><b><?php echo $results->name ?></b> <span class="pull-right"><?php echo $results->email ?></span></div>
                <div class="row-fluid" style="color:#808080"><span><?php echo $results->question; ?></span></div>
                <div class="row-fluid" style="color:#808080"><?php $time=explode(',',timespan(strtotime($results->created), time())); echo $time[0];  ?> ago</div>
            </div>
        </div>
     <?php } ?>
     <br>
     <?php if($reply){ 
                foreach ($reply as $row): ?>
               
            <?php if($info['id'] == $row->user_id){
              
               $span_class_text='11';
               $span_class_img='1';
             }else{
             
               $span_class_text='1';
               $span_class_img='11';
             }
            ?>
             <div class="row-fluid color-white">
             <!-- 	<?php //echo $info['id']." = ".$row->user_id; ?> -->
               <?php if(!($info['id'] == $row->user_id)){?>
                <div class="span9">

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
                <div class="span9">

                  <div class="msg_top"><b><?php echo $row->user_name ?></b> <span class="pull-right"><?php echo $row->email ?></span></div>
                  <div class="row-fluid" style="color:#808080"><span><?php echo $row->message; ?></span></div>
                  <div class="row-fluid" style="color:#808080"><?php $time=explode(',',timespan(strtotime($row->created), time())); echo $time[0];  ?> ago</div>

                </div>

               
                
              <?php } ?>


            </div>

            <div class="row-fluid ">
              <div class="span12"> </div>              
            </div>

             <?php endforeach; } ?>
 </div>

 <!-- <div class="dashcontent">
	<div class="dashbox"> -->
		<div class="row-fluid" style="margin-left:40px;">
		  <div class="span6">
		      <?php echo form_open(current_url()); ?>
		  <p style="color: #808080;"><strong>Reply</strong></p>
		   <p> <textarea name="reply" class="span12" ><?php echo set_value('reply'); ?></textarea></p>
		    <span style="color:red; font-size: 12px;"><p><?php echo form_error('reply') ?></p></span>

		    <p><input type="submit" value="reply" class="btn btn-info"></p>
		  
		 <?php echo form_close(); ?> 
		  </div>              
		</div>
	<!-- </div>
</div> -->

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
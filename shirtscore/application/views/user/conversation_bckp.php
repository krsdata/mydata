<div class="dashcontent">
	<div class="dashbox">
		<h2>Conversation</h2>
	</div>
</div>
	
	<div class="coversation span11">
	    <div class="row-fluid color-white">
	      <div class="span1"> 
	        <img src='<?php echo base_url()?>assets/front_theme/img/user.png' style="width:50px; margin-top:15px"> 
	      </div>
	      <!-- <div class=" span11">  -->

	        <div class="msg_top"><b>User_name</b> <span class="pull-right">email@mail.com</span></div>
	        <div class="row-fluid" style="color:#808080"><span>this is the test reply</span></div>
	        <div class="row-fluid" style="color:#808080"><?php $time=explode(',',timespan(strtotime(date('Y-m-d')), time())); echo $time[0];  ?> ago</div>
	      <!-- </div> -->
	    </div>
    </div>

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

               <?php if($info['id'] == $row->user_id){?>

                <div class="span11">

                  <div class="msg_top"><b><?php echo $row->user_name ?></b> <span class="pull-right"><?php echo $row->email ?></span></div>
                  <div class="row-fluid span11" style="color:#808080"><span><?php echo $row->message; ?></span></div>
                  <div class="row-fluid span11" style="color:#808080"><?php $time=explode(',',timespan(strtotime($row->created), time())); echo $time[0];  ?> ago</div>

                </div>

                <div class="span1"> 

                  <img src="<?php echo base_url() ?>assets/uploads/user.jpg" style="width:50px; margin-top:15px">

                </div>

              <?php }else{ ?>


                <div class="span1"> 

                  <img src="<?php echo base_url() ?>assets/uploads/user.jpg" style="width:50px; margin-top:15px">

                </div>

                <div class="span11">

                  <div class="msg_top"><b><?php echo $row->user_name ?></b> <span class="pull-right"><?php echo $row->email ?></span></div>
                  <div class="row-fluid span11" style="color:#808080"><span><?php echo $row->message; ?></span></div>
                  <div class="row-fluid span11" style="color:#808080"><?php $time=explode(',',timespan(strtotime($row->created), time())); echo $time[0];  ?> ago</div>

                </div>

               
                
              <?php } ?>


            </div>

            <div class="row-fluid ">
              <div class="span12"> </div>              
            </div>

             <?php endforeach; } ?>






<!-- <div class="coversation">
	<div>
		<img style="float:left" src="<?php //echo base_url()?>assets/front_theme/img/user.png"/>
		<div class="designboxFoot" styele="float:left;">
			<span>Superadmin</span>
			<p>This is some reply</p>
		</div>
	</div>

	<div>
		<img style="float:left" src="<?php //echo base_url()?>assets/front_theme/img/user.png"/>
		<div class="designboxFoot" styele="float:left;">
			<span>Superadmin</span>
			<p>This is some reply</p>
		</div>
	</div>

	<div>
		<div class="designboxFoot" styele="float:left;">
			<span>User</span>
			<p>This is some reply</p>
		</div>
		<img style="float:right" src="<?php //echo base_url()?>assets/front_theme/img/user.png"/>
	</div>
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
     background-color:#ffffff !important;
      border-radius:5px;
      padding: 15px;
   }
   .msg_top{
    padding:10px;
    color:#808080
   }
</style>
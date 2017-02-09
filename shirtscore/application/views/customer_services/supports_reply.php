   <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

      <?php if($this->session->flashdata('success_msg')){ ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
      <?php } ?>         

           <div class="span6">
          <div class="box color_0 ">
            <div class="title row-fluid">
              <h4 class="pull-left"><span><?php if(!empty($support->subject)) echo $support->subject; ?></span></h4>
              <div class="btn-toolbar pull-right ">
                <div class="btn-group"><!--  <a class="btn">View All</a> --> <a class="btn change_color_outside"><i class="paint_bucket"></i></a> </div>
              </div>
            </div>
            <!-- End .title -->
            <div class="content row-fluid">
              <ul class="messages_layout">
                
                <li class="from_user left"> <a href="#" class="avatar"><img src="<?php echo THEME_URL ?>img/user.png"/></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name" href="#"><?php if(!empty($support->name)) echo $support->name ?></a> <span class="author"><a href="#"><?php if(!empty($support->email)) echo $support->email ?></a></span></div>
                    <div class="text"><?php if(!empty($support->question)) echo $support->question ?></div>
                    <div class="footer">
                        <span class="time"><?php if(!empty($support->created)){ $time=explode(',',timespan(strtotime($support->created), time())); echo $time[0]; } ?> ago</span>
                        <!-- <div class="actions pull-right hidden-phone">
                          <ul class="pull-right">
                            <li><a href="#"><i class=" gicon-share-alt icon-white"></i>Reply</a></li>
                            <li><a href="#"><i class=" gicon-share icon-white"></i>Share</a></li>
                            <li><a href="#"><i class=" gicon-star icon-white"></i>Favorite</a></li>
                          </ul>
                        </div> -->
                    </div>
                  </div>
                </li>

                <?php if($reply){ foreach ($reply as $row): ?> 
                <?php if($support_type == 'storeadmin'){ ?> 
                <?php if ($row->user_id != $support->admin_id){ $class = "by_myself right"; }else $class = "from_user left";  ?>
                <?php }elseif($support_type == 'user'){ ?>
                <?php if ($row->user_id != $support->customer_id){ $class = "by_myself right"; }else $class = "from_user left";  ?>
                <?php }elseif($support_type == 'public'){?>
                <?php $class="by_myself right"; ?>
                <?php } ?>
                <li class="<?php echo $class;  ?>"> <a href="#" class="avatar"><img src="<?php echo THEME_URL ?>img/user.png"/></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name" href="#"><?php echo $row->user_name ?></a> <span class="author"><a href="#"><?php echo $row->email; ?></a></span></div>
                    <div class="text"><?php echo $row->message; ?></div>
                    <div class="footer">
                        <span class="time"><?php $time=explode(',',timespan(strtotime($row->created), time())); echo $time[0];  ?> ago</span>                        
                    </div>
                  </div>
                </li>
             <?php endforeach; } ?>
              <?php  /*<!-- <li class="by_myself right"> <a href="#" class="avatar"><img src="<?php echo THEME_URL ?>img/user.png"/></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name" href="#"><?php if(!empty($support->name)) echo $support->name ?></a> <span class="author"><a href="#"><?php if(!empty($support->email)) echo $support->email ?></a></span></div>
                    <div class="text"><?php if(!empty($support->question)) echo $support->question ?></div>
                    <div class="footer">
                        <span class="time"><?php $time=explode(',',timespan(strtotime($support->created), time())); echo $time[0];  ?> ago</span>
                        <!-- <div class="actions pull-right hidden-phone">
                          <ul class="pull-right">
                            <li><a href="#"><i class=" gicon-share-alt icon-white"></i>Reply</a></li>
                            <li><a href="#"><i class=" gicon-share icon-white"></i>Share</a></li>
                            <li><a href="#"><i class=" gicon-star icon-white"></i>Favorite</a></li>
                          </ul>
                        </div> -->
                   <!--  </div>
                  </div>
                </li> --> */?>
              </ul>
            </div>
            <div class="row"><a id="reply" href="javascript:void(0)" class="btn btn-large" style="float:right">Reply</a>
              <div id="form_div">
                <?php echo form_open(current_url(),array('class'=>'row-fluid')); ?>
                <div class="row-fluid">
                  <span id="reply_box">
                   <br><textarea style="margin-left:3%; width:80%;" name="reply" rows="" class="span6"></textarea>                    
                  </span>
                </div>
                <div class="row-fluid">
                    <button style="margin-left:3%" type="submit" class="btn " value="reply">Reply</button>
                </div><br>
               </div>
               <?php echo form_close(); ?>
              </div>




            <!-- End .content --> 
          </div>
          <!-- End .box -->          
        </div>
        <!-- End .span6 --> 

          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
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
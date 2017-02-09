   
<div class="clearfloat"></div>
<div class="dashcontent">
    <div class="dashbox">
        <div class="dashicon">
            &nbsp;<i class="icon-envelope"></i>&nbsp;
        </div>
        <h2> Message </h2>
        <hr color="#ccc" />
        <h3><?php if(!empty($msg->subject)) echo $msg->subject; ?></h3>
        <?php if(!empty($msg->message)) echo $msg->message; ?> <br><br>
        Received On: <?php if(!empty($msg->created)) echo date('Y-m-d',strtotime($msg->created)); ?>
        <hr color="#ccc" />
    </div>
    <div>&nbsp;</div>
</div>

<style type="text/css">
  hr{
    border-color:#3B5998; 
    -moz-use-text-color: #FFFFFF !important; 
  }
</style>
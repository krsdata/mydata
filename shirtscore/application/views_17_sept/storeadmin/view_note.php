<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">
            <div class="title">
              <h4><span> View Note </span> </h4>
            </div>
            <!-- End .title -->    
  				  <?php if($order_note){ ?>
             <div class="form-row control-group row-fluid">
                 <label class="control-label span3" for="normal-field">Title
                 </label>
                 <div class="controls span9">
                   <?php if(!empty($order_note->title)) echo $order_note->title; ?>
                 </div>
              </div>

              <div class="form-row control-group row-fluid">
                 <label class="control-label span3" for="normal-field">Note 
                 </label>
                 <div class="controls span9">
                   <?php if(!empty($order_note->note)) echo $order_note->note; ?>
                 </div>
              </div>
            <?php } ?> 
              </div>
      </div>      
    </div>
  </div>
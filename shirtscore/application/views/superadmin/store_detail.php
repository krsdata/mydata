



  <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

       

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class="icon-reorder"></i> <span>Store Info </span> </h4>
            </div>
            <!-- End .title -->
				 <!--  -->          
				  <div class="content">
				
           <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Store Name
               </label>
              <div class="controls span9">
                 <?php if(!empty($store_detail->store_name)) echo $store_detail->store_name; ?>
               </div>
            </div>
            <?php /* ?> 
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Store Email
               </label>
              <div class="controls span9">
                 <?php if(!empty($store_detail->store_email)) echo $store_detail->store_email; ?>
               </div>
            </div>
            <?php */ ?>
           <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Store Admin Name 
               </label>
              <div class="controls span9">
                 <?php if(!empty($store_detail->firstname)) echo $store_detail->firstname." ".$store_detail->lastname ; ?>
               </div>
            </div> 
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Store Link 
               </label>
              <div class="controls span9">
                 <?php if(!empty($store_detail->store_link)) echo base_url().'shop/'.$store_detail->store_link; ?>
               </div>
            </div> 
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Store Banner
               </label>
              <div class="controls span9">
                  <?php if(!empty($store_detail->store_banner)){?>
                 <img style="width:200px;height:200px;" src="<?php echo base_url() ?>assets/uploads/store/<?php echo $store_detail->store_banner; ?>">
                 <?php } ?>
               </div>
            </div> 
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Store created date
               </label>
              <div class="controls span9">
                 <?php if(!empty($store_detail->created)) echo date('m/d/Y', strtotime($store_detail->created)); ?>
               </div>
            </div> 
             <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Store description
               </label>
              <div class="controls span9">
                 <?php if(!empty($store_detail->store_description)) echo $store_detail->store_description; ?>
               </div>
            </div> 




             <!--  -->

            <!-- End row-fluid --> 
          </div>
          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
    </div>  
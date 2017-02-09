<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">

   <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

          <?php if($this->session->flashdata('success_msg')){ ?>
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
      </div>
      <?php } ?>

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span>User Details </span> </h4>
            </div>
            <!-- End .title -->
				 <!--  -->          
				  <div class="content">
				  <?php if($results){ ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">First Name                 
              	</label>
                  <div class="controls span9">
                   <?php if(!empty($results->firstname)) echo $results->firstname ?>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Last Name 
                  
                  </label>
                  <div class="controls span9">
                   <?php if(!empty($results->lastname)) echo $results->lastname ?>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="email-field">Email  
                 </label>
                  <div class="controls span9">
                    <?php if(!empty($results->email)) echo $results->email ?>
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="mobile-input">Mobile
                 
                </label>
                  <div class="controls span9">
                     <?php if(!empty($results->mobile)) echo $results->mobile ?>
                  </div>
                </div> 
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">Addess
                  	
                  </label>
                  <div class="controls span9">
                     <?php if(!empty($results->address)) echo $results->address ?>
                  </div>
                </div>

                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">City
                   
               </label>
                  <div class="controls span9">
                    <?php if(!empty($results->city)) echo $results->city; ?>
                  </div>
                </div>              

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">State
                  
               </label>
                  <div class="controls span9">
                 <?php  if(!empty($results->state)) echo $results->state; ?>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="country-input">Country
                 
              	</label>
                  <div class="controls span9">
                    <?php if(!empty($results->country)) echo $results->country; ?>
                  </div>
                </div>

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-tooltip">Zip Code
                  
              	</label>
                  <div class="controls span9">
                     <?php if(!empty($results->zip)) echo $results->zip; ?>
                  </div>
                </div>

               

               <?php }else{ ?>
			

                <div class="form-row control-group row-fluid">                 
                  <div class="controls span9">
 					<label class="control-label span9"> NO User Found.	</label>
                  </div>
                </div> 
				<?php } ?>

                         
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
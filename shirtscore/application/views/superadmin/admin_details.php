   <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">


          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-user"></i> <span>Admin Details </span> </h4>
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
                  <a class="btn" href="<?php echo base_url() ?>superadmin/emailtostore_admin/<?php echo $results->id ?>"><?php if(!empty($results->email)) echo $results->email ?></a>
                    
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
            <?php if(!empty($stores)){ ?>

            	 <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
					<th>Store name</th>	
					<th>Store Link</th>				
                  </tr>
                </thead>
                <tbody>
            <?php foreach ($stores as $row) { 
            	if(!empty($row)){ ?>
               
                <tr>
					<td><?php if(!empty($row->store_name)) echo $row->store_name; ?></td>
					<td><a class="btn" href="<?php echo base_url().'shop/'.$row->store_link;?>" target="_blank"><?php if(!empty($row->store_link)) echo $row->store_link; ?></a></td>
				</tr>
                  
                 	<?php } else { ?>
					<tr>
						<td colspan="9" style="text-align: center;font-style: italic;"><h3>No Stores found yet</h3></td>
					</tr>
					<?php } 
					} ?>	
						
                </tbody>
              </table>
             
            </div>
            <!-- End row-fluid --> 
            	
            <?php } ?>
               
               

         <?php } else{ ?>
			

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
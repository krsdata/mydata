   <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class="icon-reorder"></i> <span>Product Info </span> </h4>
            </div>
            <!-- End .title -->
				 <!--  -->          
				  <div class="content">
				  <?php if($product){ ?>

             <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Product Name 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->regular_name)) echo $product->regular_name; else echo "NA"; ?>
               </div>
            </div> 

           <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Prefix 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->prefix)) echo $product->prefix; else echo "NA"; ?>
               </div>
            </div> 
            <!-- <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Regular name 
               </label>
              <div class="controls span9">
                 <?php // if(!empty($product->regular_name)) echo $product->regular_name ?>
               </div>
            </div>  -->
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Short Name 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->short_name)) echo $product->short_name; else echo "NA"; ?>
               </div>
            </div>
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Singular 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->singular)) echo $product->singular; else echo "NA"; ?>
               </div>
            </div>  
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">URI 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->uri)) echo $product->uri; else echo "NA"; ?>
               </div>
            </div>         
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Status 
               </label>
              <div class="controls span9">
                 <?php if($product->product_status == 1) echo "Published"; else echo "Unpublished"; ?>
               </div>
            </div>
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Product Group 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->group_name)) echo $product->group_name; else echo "NA"; ?>
               </div>
            </div> 
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Description 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->desc)) echo $product->desc; else echo "NA"; ?>
               </div>
            </div> 

            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Available Sizes 
               </label>
              <div class="controls span9">
                 <?php if(!empty($product->size_id)){
                    $s_id = unserialize($product->size_id);
                    $size_name  = get_size_name($s_id);
                    echo implode(', ',$size_name);
                  } ?>
               </div>
            </div>

          
            <div class="form-row control-group row-fluid">
               <label class="control-label span3" for="normal-field">Product category 
               </label>
              <div class="controls span9">
                 <?php $cats='Uncategorized';  
                 if(!empty($categories)){?>
                    <?php $sym=1; foreach ($categories as $row): 
                    if ($sym > 1 ){
                      $cats.=', '.ucfirst($row->category_name);
                    }
                    else{
                      $cats=ucfirst($row->category_name);
                      $sym++;
                    }
                    ?>
                    <?php endforeach ?>
                 <?php } ?>
                 <?php echo $cats; ?>
               </div>
            </div>

             <br>
               <h3><strong>Colors And Images -</strong></h3><br>
               <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <th style="text-align:center">#</th>
                  <th style="text-align:center">Color</th>
                  <th style="text-align:center">Front</th>
                  <th style="text-align:center">Back</th>
                </thead>
                <tbody>
                <?php if($color){ $i=1; foreach ($color as $key){ ?>
                  <tr>
                    <td style="text-align:center"><?php echo $i ?></td>
                    <td style="text-align:center"><div style="background-color:<?php echo $key->color_code ?>; border:1px solid black; height:20px; width:20px;margin-left: 45%;"></div></td>

                      <td style="text-align:center">
                        <?php if (!empty($key->main_image)): ?>
                          <img src="<?php echo base_url() ?>assets/uploads/color_img/thumbnail/<?php echo $key->main_image; ?>">
                        <?php endif ?>
                      </td> 

                      <td style="text-align:center">
                        <?php if (!empty($key->back_image)): ?>
                          <img src="<?php echo base_url() ?>assets/uploads/color_img/thumbnail/<?php echo $key->back_image; ?>">
                        <?php endif ?>
                      </td>
                  </tr>
                <?php $i++; } }else{ ?>  
                  <td style="text-align:center" colspan="6">Nothing found</td>
                <?php } ?>
                </tbody>
               </table>
                    
          <?php }else{ ?>
                <div class="form-row control-group row-fluid">                 
                  <div class="controls span9">
 					            <label class="control-label span9"> NO Product Info Found.	</label>
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
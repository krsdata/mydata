<div class="dashcontent" style="margin:0px;">

    <div class="dashbox" style="min-height:340px">

      <div class="clearfloat"></div>

      <div class="dashcontent">

        <div class="dashbox">

            <h4><span>Product Info </span></h4>

            <?php if($product){ ?>

           <div class="form-row control-group row-fluid">

               <label class="control-label span3" for="normal-field">Product Name 

               </label>

              <div class="controls span9">

                 <?php if(!empty($product->regular_name)) echo $product->regular_name ?>

               </div>

            </div> 

            <div class="form-row control-group row-fluid">

               <label class="control-label span3" for="normal-field">Store Name 

               </label>

              <div class="controls span9">

                 <?php if(!empty($product->store_name)) echo $product->store_name ?>

               </div>

            </div> 

            <div class="form-row control-group row-fluid">

               <label class="control-label span3" for="normal-field">Status 

               </label>

              <div class="controls span9">

                 <?php if($product->custom_product_status == 1) echo "Approved"; else echo "Blocked"; ?>

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

                      $cats.=', '.$row->category_name;

                    }

                    else{

                      $cats=$row->category_name;

                      $sym++;

                    }

                    ?>

                    <?php endforeach ?>

                 <?php } ?>

                 <?php echo $cats; ?>

               </div>

            </div> 

            <div class="form-row control-group row-fluid">

               <label class="control-label span3" for="normal-field">Description 

               </label>

              <div class="controls span9">

                 <?php if(!empty($product->desc)) echo $product->desc ?>

               </div>

            </div> 

             <div class="form-row control-group row-fluid">

               <label class="control-label span3" for="normal-field">Main Image 

               </label>

              <div class="controls span9">

                 <?php if(!empty($product->main_image)){?>

                 <img src="<?php echo base_url() ?>assets/uploads/custom_prod_img/<?php echo $product->main_image; ?>">

                 <?php } ?>

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

          <?php }else{ ?>

                <div class="form-row control-group row-fluid">                 

                  <div class="controls span9">

                     <label class="control-label span9"> NO Product Found. </label>

                  </div>

                </div> 

        <?php } ?>

        </div>

      </div>      

    </div>

  </div>  
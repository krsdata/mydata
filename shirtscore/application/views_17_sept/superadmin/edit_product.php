     <?php if (!empty($product->main_image)): ?>
       <?php 
            $prod_img  = getimagesize(base_url().'assets/uploads/products/'.$product->main_image); 
       ?>
     <?php endif ?>
    <style type="text/css">
      .product-img{
          width: <?php echo $prod_img[0]."px"; ?>;
          height: <?php echo $prod_img[1]."px"; ?>;
          background-image:url(<?php echo base_url().'assets/uploads/products/'.$product->main_image; ?>);
      }
    </style>

    <div id="main_container">
      <div class="row-fluid ">     	

        <div class="span12">

       

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-money"></i> <span> Edit Product </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
               <!-- <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="search-input">Main Image
                  <span class="help-block"><?php // echo $this->session->flashdata('image_error');?></span>
                </label>
                  <div class="controls span9">
                   <input type="file" id="new_img" name="userfile"  class="spa1n6 fileinput"><br>
                   <div id="old_img" class="row">
                   <?php // if (!empty($product->main_image)): ?>
                     <img src="<?php // echo base_url() ?>assets/uploads/products/thumbnail/<?php // echo $product->main_image; ?>">
                   <?php // endif ?>
                   </div>
                  </div>
                </div> -->
                <?php echo validation_errors(); ?>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Order<br>
                  <small>To place Product order</small>
                  <span class="help-block"><?php echo form_error('order'); ?></span>
                </label>
                  <div class="controls span1">
                    <input type="text" class="row-fluid" name="order" value="<?php if(isset($product->order)){echo $product->order;} ?>" placeholder="Color Name">
                  </div>
                </div>
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Position
                  <br><small>Default : Center</small>
                  <span class="help-block"><?php echo form_error('position'); ?></span>
                </label>
                <div class="controls span9">
                    <select name="position" class="chzn-select">
                      <option value="center" <?php if(!empty($product->position)) if($product->position=='center') echo "selected='selected'"; ?>>Default(center)</option>
                      <option value="left" <?php if(!empty($product->position)) if($product->position=='left') echo "selected='selected'"?>>Left</option>
                      <option value="right" <?php if(!empty($product->position)) if($product->position=='right') echo "selected='selected'"?>>Right</option>


                  </select>
                </div></div>  

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Margin from left
                  <br><small>Example : 0, 10, etc<br>Default :0</small>
                  <span class="help-block"><?php echo form_error('left'); ?></span>
                </label>
                  <div class="controls span1">
                    <input type="text" class="row-fluid" name="left" value="<?php if(isset($product->left)){echo $product->left;} ?>" placeholder="Left margin">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Design Width to desplay 
                  <br><small>Example: 100, 120. etc<br>Default: 120</small>
                  <span class="help-block"><?php echo form_error('left'); ?></span>
                </label>
                  <div class="controls span1">
                    <input type="text" class="row-fluid" name="width" value="<?php if(isset($product->width)){echo $product->width;} ?>" placeholder="Width">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Margin from top
                  <br><small>Example:140,150, etc<br>Default : 160</small>
                  <span class="help-block"><?php echo form_error('top'); ?></span>
                </label>
                  <div class="controls span1">
                    <input type="text" class="row-fluid" name="top" value="<?php if(isset($product->top)){echo $product->top;} ?>" placeholder="Top">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Product Color
                    <span class="help-block"><?php echo form_error('color'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" data-color="<?php if(isset($color->color_code)){echo $color->color_code;}else{echo '#4a8cf7;';} ?>" data-color-format="hex" id="colorpicker3">
                      <input type="text"   name="color" value="<?php if(isset($color->color_code)){echo $color->color_code;}else{echo '#4a8cf7;';} ?>" placeholder="color">
                      <span class="add-on"><i style="<?php if(isset($color->color_code)){echo $color->color_code;}else{echo '#4a8cf7;';} ?>"></i></span>
                    </div>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Color Name
                  <span class="help-block"><?php echo form_error('color_name'); ?></span>
                </label>
                  <div class="controls span5">
                    <input type="text" class="row-fluid" name="color_name" value="<?php if(isset($product->color_name)){echo $product->color_name;} ?>" placeholder="Color Name">
                  </div>
                </div>


                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Main Image
                    <span class="help-block"><?php echo form_error('userfile'); ?></span>
                  </label>
                  <div class="controls span9">
                      <input id="new_img" type="file" name="userfile" class="span6" style="opacity: 1;!important;"><br>
                    <div id="old_img" class="row">
                     <?php if (!empty($product->main_image)): ?>
                       <img src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $product->main_image; ?>">
                     <?php endif ?>
                   </div>
                  </div>
                </div>

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input1">Back Image
                    <span class="help-block"><?php echo form_error('back'); ?></span>
                  </label>
                  <div class="controls span9">
                      <input type="file" id = "new_img1" name="back" class="span6" style="opacity: 1;!important;"><br>
                    <div id="old_img1" class="row">
                     <?php if (!empty($product->back_image)): ?>
                       <img src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $product->back_image; ?>">
                     <?php endif ?>
                   </div>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">                            
                <label class="control-label span3" for="normal-field">Regular Name
                  <span class="help-block"><?php echo form_error('regular_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" id="title" class="row-fluid" name="regular_name" value="<?php  if(!empty($product->regular_name)) echo $product->regular_name; ?>" placeholder="ie:Long Sleeved Pigmented T-Shirt">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Product Slug
                    <span class="help-block"><?php echo form_error('slug'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" id="slug" class="row-fluid" name="slug" value="<?php if(set_value('slug')){echo set_value('slug');}elseif(!empty($product->slug)){echo $product->slug;} ?>" placeholder="Product Slug">
                  </div>
                </div>
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Prefix
                  <span class="help-block"><?php echo form_error('prefix'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="prefix" value="<?php if(!empty($product->prefix)) echo $product->prefix; ?>" placeholder="Product prefix">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Short Name
                  <span class="help-block"><?php echo form_error('short_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="short_name" value="<?php if(!empty($product->short_name)) echo $product->short_name; ?>"  placeholder="ie:Long Sleeved T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Singular
                  <span class="help-block"><?php echo form_error('singular'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="singular" value="<?php if(!empty($product->singular)) echo $product->singular; ?>"  placeholder="ie:T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">URI
                  <span class="help-block"><?php echo form_error('uri'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="uri" value="<?php if(!empty($product->uri)) echo $product->uri; ?>"  placeholder="ie:long sleeved T-Shirt">
                  </div>
                </div>              
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Description
                    <span class="help-block"><?php echo form_error('desc'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <textarea type="text" class="row-fluid" rows="5" name="desc" ><?php if(!empty($product->desc)) echo $product->desc; ?></textarea>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Available Sizes
                  <span class="help-block"><?php echo form_error('size_id'); ?></span>
                </label>
                <div class="controls span9">
                  <table id="datatable_example" class="responsive table table-striped table-bordered">
                    <tr>
                      <th>Available Sizes <input type="checkbox" name="check_all" id="check_all" ></th>
                    </tr>
                  <?php  if(!empty($sizes)){ foreach ($sizes as $size): ?>                        
                    <tr>
                      <td class="prod_sizes"><input type="checkbox" <?php if(!empty($product->size_id)) if($product->size_id){ $arr = unserialize($product->size_id); if(in_array($size->id, $arr)) echo "checked='checked'"; } ?> class="checked_all" name="size_id[]" value="<?php echo $size->id; ?>" > <?php echo $size->size_name; ?>
                      </td><td>
                        <input type="text" name="price_size[]" placeholder="Price" 
                        value="<?php if(in_array($size->id, $arr)){
                        $product_price=productprice($product->id,$size->id);
                        if(!empty($product_price->price))
                          { echo $product_price->price;}}?>" class="span3">
                        </td>
                    </tr>
                      <?php endforeach; }
                      else{ ?>
                      <tr><td>No size found</td></tr>
                      <?php } ?>
                  </table>
                  </div>                 
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="normal-field">Categories
                    <br><small>You can select max 3 category.</small>
                      <span class="help-block"><?php echo form_error('category'); ?></span>
                    </label>
                    <div class="controls span9">
                          <div class="row-fluid">
                          <?php $c_no = 1; $cat_count = 1;?>
                          <?php if(!empty($product_categories)){
                            $cat_arr = unserialize($product->category);
                           foreach ($product_categories as $row): ?>
                            <?php if($c_no == 5): ?>
                              </div>
                              <div class="row-fluid">
                                <?php $c_no = 1; ?>
                            <?php endif ?>
                              <div class="span3"><input type="checkbox"  class="row-fluid" name="category[]" value="<?php echo $row->id; ?>" <?php if($cat_arr){ if(in_array($row->id, $cat_arr)) {echo "checked='checked'";} } ?> > <?php echo ucfirst($row->category_name); ?></div>
                            <?php $c_no++; ?>
                            <?php $cat_count++; ?>
                          <?php endforeach?>
                          <?php }?>
                        </div>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Base Price &nbsp;<?php money_symbol(); ?>
                  <span class="help-block"><?php echo form_error('price'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="" name="price"  value="<?php if(!empty($product->price)) echo $product->price; ?>"  placeholder="0.00">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Product Grouping
                   <span class="help-block"><?php echo form_error('group_id'); ?></span>
                  </label>
                  <div class="controls span9">
                    <select name="group_id" class="chzn-select">
                      <option value="">Select Group</option>                                               
                      <?php foreach ($group as $key): ?>                  
                      <option value="<?php echo $key->id ?>" <?php if(!empty($product->group_id)) if($key->id == $product->group_id) echo "selected='selected'"; ?> ><?php echo $key->group_name;?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Add Size Chart
                    <!-- <span class="help-block"><?php // echo form_error('addsizechart'); ?></span>  -->
                  </label>
                  <div class="controls span9">
                    <input <?php  if($product->is_sizechart == 1){echo "checked";}?> type="checkbox" id="add-size" name="addsizechart" value="1" >
                  </div>
                </div>
                <?php  
                  if (($product->is_sizechart == 1) || (!empty($product->sizechart)))
                    $display = 'style="display: block;"';
                  else
                    $display = 'style="display: none;"';
                ?>

                <div <?php echo $display; ?> class="form-row control-group row-fluid" id="size-chart">
                  <label class="control-label span3" for="editor1">Size Chart HTML
                    <span class="help-block"><?php echo form_error('sizechart'); ?></span> <br>
                    <span class="help-block"><?php echo form_error('addsizechart'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea id="editor1" type="text" class="row-fluid" rows="5" name="sizechart" ><?php if(!empty($product->sizechart))  echo $product->sizechart; ?></textarea>
                  </div>
                </div>


                <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Submit</button>                    
                  </div>
                </div>
            <?php echo form_close(); ?>
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

<style type="text/css">
  .uploader input{
    opacity: 1 !important;

  }
</style>

  <script type="text/javascript">
    $("#check_all").change(function(){
      var status = $(this).attr("checked") ? "checked" : false;

       if(status){
         $("td.prod_sizes div.checker span").addClass("checked");
         $(".checked_all").prop("checked", true);
       }
       else{
         $("td.prod_sizes div.checker span").removeClass("checked");
         $(".checked_all").prop("checked", false);
       }
      // alert('pp');
    });

   $("#cat_all").change(function(){

      var status = $(this).prop("checked") ? "checked" : false;

      if(status){
         $("td.product_cat div.checker span").addClass("checked");
         $(".pro_cat").prop("checked", true);
      }
      else{
        $("td.product_cat div.checker span").removeClass("checked");
        $(".pro_cat").prop("checked", false);
      }

  });
    </script>


    <script type="text/javascript">
        $(document).ready(function () {

          $("#search-input").attr('style', 'opacity: 1 !important');
          $("#search-input1").attr('style', 'opacity: 1 !important');
          $("#title,#slug").on('change keyup blur',function(){
            var stringToReplace = $(this).val().toLowerCase();
            stringToReplace = $.trim(stringToReplace);
            var desired = stringToReplace.replace(/[^a-zA-Z0-9\s-]/gi, '');
            desired = desired.replace(/[^a-zA-Z0-9-]/gi, '-');
            $('#slug').val(desired);
          });

          $("#add_rest").click(function() {
              jQuery("#img_sel").show(500);
              jQuery("#btn_div").hide(500);
          }); 

          $("#new_img").on('change',function() {
              jQuery("#img_para").hide(500);
              jQuery("#old_img").hide(500);
          });

          $("#new_img1").on('change',function() {
              jQuery("#img_para1").hide(500);
              jQuery("#old_img1").hide(500);
          });

          $('#photo').imgAreaSelect({ maxWidth: 295, maxHeight: 425, handles: true, onSelectEnd: function (img, selection) {
                    var x1 = selection.x1;
                    var y1 = selection.y1;
                    var x2 = selection.x2;
                    var y2 = selection.y2;
                    var h = y2 - y1;
                    var w = x2 - x1;
                    $("#log").text( "X1: " + x1 + ", Y1: " + y1 + "X2: " + x2 + ", Y2: " + y2 + " <br> Widht = " + w + "Height " + h  );
                    $( "#left" ).val(x1);
                    $( "#top" ).val(y1);
                    $( "#width" ).val(w);
                    $( "#height" ).val(h);
                } 
            });

        });

        $(document).ready(function () {
            $("#add-size").on('change',function(){
                if(($(this).prop("checked") === true) || ($(this).prop("checked") === 'true'))
                  $('#size-chart').show();
                else
                  $('#size-chart').hide();
            });
        });
    </script>
<div class="dashcontent" style="margin:0px;">
    <div class="dashbox" style="min-height:340px">
      <div class="clearfloat"></div>
      <div class="dashcontent">
        <div class="dashbox">
            <?php if($this->session->flashdata('success_msg')){ ?>
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>
          </div>
          <?php } ?>
          <h4><span> Edit Product </span></h4>

          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?> 
               <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="search-input">Main Image
                  <span class="help-block"><?php echo $this->session->flashdata('image_error');?></span>
                </label>
                  <div class="controls span9">
                   <input type="file" name="userfile"  class="spa1n6 fileinput"><br>
                   <div class="row">
                   <?php if (!empty($product->main_image)): ?><br>
                     <img src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $product->main_image; ?>">
                   <?php endif ?>
                   </div>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Prefix
                  <span class="help-block"><?php echo form_error('prefix'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="prefix" value="<?php echo $product->prefix; ?>" placeholder="Product prefix">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">                            
                <label class="control-label span3" for="normal-field">Regular Name
                  <span class="help-block"><?php echo form_error('regular_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="regular_name" value="<?php echo $product->regular_name; ?>" placeholder="ie:Long Sleeved Pigmented T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Short Name
                  <span class="help-block"><?php echo form_error('short_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="short_name" value="<?php echo $product->short_name; ?>"  placeholder="ie:Long Sleeved T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Singular
                  <span class="help-block"><?php echo form_error('singular'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="singular" value="<?php echo $product->singular; ?>"  placeholder="ie:T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">URI
                  <span class="help-block"><?php echo form_error('uri'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="uri" value="<?php echo $product->uri; ?>"  placeholder="ie:long sleeved T-Shirt">
                  </div>
                </div>              
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Description
                    <span class="help-block"><?php echo form_error('desc'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <textarea type="text" class="row-fluid" rows="5" name="desc" ><?php  echo $product->desc; ?></textarea>
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
                      <?php if(isset($sizes)){ foreach ($sizes as $size): ?>                        
                    <tr>
                      <td class="prod_sizes"><input type="checkbox" <?php if($product->size_id){ $arr = unserialize($product->size_id); if(in_array($size->id, $arr)) echo "checked='checked'"; } ?> class="checked_all" name="size_id[]" value="<?php echo $size->id; ?>" > <?php echo $size->size_name; ?></td>
                    </tr>
                      <?php endforeach; }else{ ?>
                      <tr><td>No size found</td></tr>
                      <?php } ?>
                  </table>
                  </div>                 
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="normal-field">Product Category
                    <span class="help-block"><?php echo form_error('category'); ?></span>
                    </label>
                    <div class="controls span9">
                      <table>
                        <tr>
                          <td> Select All <input type="checkbox" id="cat_all" name="cat_all" value=""></td>
                        </tr>
                        <tr>
                        <?php foreach ($product_categories as $row): ?>
                        <td class="product_cat">
                          <input type="checkbox" <?php if($product->category_id){ $arr = unserialize($product->category_id); if(in_array($row->id, $arr)) echo "checked='checked'"; } ?> class="row-fluid pro_cat" name="category[]" value="<?php echo $row->id; ?>">
                           <?php echo $row->category_name ?></td>
                        <?php endforeach ?>
                        </tr>
                      </table>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Base Price
                  <span class="help-block"><?php echo form_error('price'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="" name="price"  value="<?php echo $product->price; ?>"  placeholder="0.00">
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
                      <option value="<?php echo $key->id ?>" <?php if($key->id == $product->group_id) echo "selected='selected'"; ?> ><?php echo $key->group_name;?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>  
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Size Chart HTML
                    <span class="help-block"><?php echo form_error('sizechart'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <textarea type="text" class="row-fluid" rows="5" name="sizechart" ><?php  echo $product->sizechart; ?></textarea>
                  </div>
                </div>        
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="with-placeholder">                    
                  </label>
                  <div class="controls span9">
                    <button type="submit" class="btn">Submit</button>                    
                  </div>
                </div> 
            <?php echo form_close(); ?>

        </div>
      </div>      
    </div>
  </div>
   
  <script type="text/javascript">
    $("#check_all").change(function(){
      var status = $(this).prop("checked") ? true : false;

       if(status){
        
         $(".checked_all").prop("checked", true);
       }
       else{
        
         $(".checked_all").prop("checked", false);
       }
      // alert('pp');
    });

   $("#cat_all").change(function(){

      var status = $(this).prop("checked") ? "checked" : false;

      if(status){
        
         $(".pro_cat").prop("checked", true);
      }
      else{
        
        $(".pro_cat").prop("checked", false);
      }

  });
    </script>
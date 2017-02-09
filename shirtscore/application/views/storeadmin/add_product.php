<?php // print_r($this->session->userdata('new_product_info')); ?>
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
            <?php if($this->session->flashdata('error_msg')){ ?>
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
            </div>
            <?php } ?>
          <h4><span> Add Product </span> </h4>

          <?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>               
                 <!-- <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Store
                   <span class="help-block"><?php //echo form_error('store_id'); ?></span>
                  </label>
                  <div class="controls span9">
                    <select name="store_id" class="chzn-select">
                      <option value="">Select store</option>                                               
                      <?php //foreach ($stores as $key): ?>                  
                      <option value="<?php //echo $key->id ?>" ><?php //echo $key->store_name;?></option>
                      <?php //endforeach ?>
                    </select>
                  </div>
                </div>   -->
                <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="search-input">Main Image
                  <span class="help-block"><?php echo $this->session->flashdata('image_error');?></span>
                </label>
                  <div class="controls span9">
                   <img src="<?php echo base_url().$product['png_url']; ?>">
                  </div>
                </div>                       
               <!--  <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Prefix
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="prefix" value="<?php // echo set_value('prefix'); ?>" placeholder="Product prefix">
                    <span class="span9 error"><?php // echo form_error('prefix'); ?></span>
                  </div>
                </div> -->
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Regular Name
                </label>
                  <div class="controls span9">
                    <input type="text" id="title" class="row-fluid" name="regular_name" value="<?php echo set_value('regular_name'); ?>" placeholder="ie:Long Sleeved Pigmented T-Shirt">
                    <span class="span9 error"><?php echo form_error('regular_name'); ?></span>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Product Slug
                  </label>
                  <div class="controls span9">
                    <input type="text" id="slug" class="row-fluid" name="slug" value="<?php echo set_value('slug'); ?>" placeholder="Product Slug">
                  </div>
                  <span class="span9 error"><?php echo form_error('slug'); ?></span>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Description
                  </label>
                  <div class="controls span9">
                    <textarea type="text" class="row-fluid" rows="5" name="desc" ><?php  echo set_value('desc'); ?></textarea>
                    <span class="span9 error"><?php echo form_error('desc'); ?></span> 
                  </div>
                </div>
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Sizes
                </label>
                <div class="controls span9">
                  <table id="datatable_example" class="responsive table table-striped table-bordered">
                    <tr>
                      <td style="width:20%">Available Sizes</td>
                      <td style="width:80%">
                        <?php $sz=1; foreach ($sizes as $size): ?>
                        <?php if ($sz != 1): ?>
                          <?php echo ", ".$size->size_name; ?>
                        <?php else: ?>
                          <?php echo $size->size_name; ?>
                        <?php endif; ?>
                        <?php $sz++; endforeach; ?>
                      </td>
                    </tr>
                  </table>
                  </div>                 
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="normal-field">Product Category
                    </label>
                    <div class="controls span9">
                      <table>
                        <tr>
                          <td> Select All <input type="checkbox" id="cat_all" name="cat_all" value=""></td>
                        </tr>
                        <tr>
                        <?php foreach ($product_categories as $row): ?>
                        <td class="product_cat"><input type="checkbox"  class="row-fluid pro_cat" name="category[]" value="<?php echo $row->id; ?>"> <?php echo $row->category_name ?></td>
                        <?php endforeach ?>
                        </tr>
                      </table>
                    </div>
                    <span class="span9 error"><?php echo form_error('category'); ?></span>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Base Price
                </label>
                  <div class="controls span9">
                   <?php echo money_symbol(); ?> <input type="text"  readonly="readonly" name="price"  value="<?php echo $product['price']; ?>">
                  </div>
                  <span class="span9 error"><?php echo form_error('price'); ?></span>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="default-select">Stores
                  </label>
                  <div class="controls span9">
                    <select name="store_id" class="chzn-select">
                      <option value="">Select Store</option>
                      <?php if ($my_stores): ?>
                        <?php foreach ($my_stores as $key): ?>                  
                          <option value="<?php echo $key->id ?>" ><?php echo $key->store_name;?></option>
                        <?php endforeach ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <span class="span9 error"><?php echo form_error('store_id'); ?></span>
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
  <style type="text/css">
    .error{
      color:red;
      font-size: 14px;
    }
  </style>
  <script type="text/javascript">
    $("#check_all").change(function(){
        var status = $(this).prop("checked") ? true : false;
        if(status){     
           $(".all_size").prop("checked", true);
        }
        else{       
          $(".all_size").prop("checked", false);
        }
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
          $("#title,#slug").on('change keyup blur',function(){
            var stringToReplace = $(this).val().toLowerCase();
            stringToReplace = $.trim(stringToReplace);
            var desired = stringToReplace.replace(/[^a-zA-Z0-9\s-]/gi, '');
            desired = desired.replace(/[^a-zA-Z0-9-]/gi, '-');
            $('#slug').val(desired);
          });
        });
    </script>
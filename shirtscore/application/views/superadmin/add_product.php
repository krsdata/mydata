
    <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
        

          <div class="box paint color_0">
            <div class="title">
              <h4> <i class=" icon-money"></i> <span> Add Product </span> </h4>
            </div>
            <!-- End .title -->
 <!--  -->          
  <div class="content">
  				<?php echo form_open_multipart(current_url(),array('class'=>'form-horizontal row-fluid')); ?>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">Main Image
                    <span class="help-block"><?php echo form_error('userfile'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append row-fluid">
                      <input type="file" name="userfile" class="spa1n6" id="search-input">
                      > 
                    </div>
                  </div>
                </div>

                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input1">Back Image
                    <span class="help-block"><?php echo form_error('back'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append row-fluid">
                      <input type="file" name="back" class="spa1n6" id="search-input1">
                      > 
                    </div>
                  </div>
                </div>

               <!--  <div class="form-row control-group row-fluid">
                  <label class="control-label span3">Main Image
                    <span class="help-block"><?php // echo form_error('userfile'); ?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" name="userfile"  class="span8 fileinput">
                  </div>
                </div> -->

                <!-- <div class="form-row control-group row-fluid">
                  <label class="control-label span3">Back Image
                    <span class="help-block"><?php // echo form_error('back'); ?></span>
                  </label>
                  <div class="controls span9">
                   <input type="file" name="back"  class="span8 fileinput">
                  </div>
                </div> -->

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Product Color
                  <span class="help-block"><?php echo form_error('color'); ?></span>
                  </label>
                  <div class="controls span9">
                    <div class="input-append color" data-color="<?php if(set_value('color')) echo set_value('color');else echo '#4a8cf7'; ?>" data-color-format="hex" id="colorpicker3">
                    <input type="text"   name="color" value="<?php if(set_value('color')) echo set_value('color');else echo '#4a8cf7'; ?>" placeholder="color">
                    <span class="add-on"><i style="<?php if(set_value('color')) echo set_value('color');else echo '#4a8cf7'; ?> "></i></span> </div>
                  </div>
                </div>

               <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Color Name
                  <span class="help-block"><?php echo form_error('color_name'); ?></span>
                </label>
                  <div class="controls span5">
                    <input type="text" class="row-fluid" name="color_name" value="<?php echo set_value('color_name'); ?>" placeholder="Color Name">
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Regular Name
                  <span class="help-block"><?php echo form_error('regular_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text" id="title" class="row-fluid" name="regular_name" value="<?php echo set_value('regular_name'); ?>" placeholder="ie:Long Sleeved Pigmented T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Product Slug
                    <span class="help-block"><?php echo form_error('slug'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" id="slug" class="row-fluid" name="slug" value="<?php echo set_value('slug'); ?>" placeholder="Product Slug">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Prefix
                    <span class="help-block"><?php echo form_error('prefix'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="prefix" value="<?php echo set_value('prefix'); ?>" placeholder="Product prefix">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Short Name
                  <span class="help-block"><?php echo form_error('short_name'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="short_name" value="<?php echo set_value('short_name'); ?>"  placeholder="ie:Long Sleeved T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Singular
                  <span class="help-block"><?php echo form_error('singular'); ?></span>
              	</label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="singular" value="<?php echo set_value('singular'); ?>"  placeholder="ie:T-Shirt">
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">URI
                  <span class="help-block"><?php echo form_error('uri'); ?></span>
                </label>
                  <div class="controls span9">
                    <input type="text"  class="row-fluid" name="uri" value="<?php echo set_value('uri'); ?>"  placeholder="ie:long sleeved T-Shirt">
                  </div>
                </div>              
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Description
                    <span class="help-block"><?php echo form_error('desc'); ?></span> 
                  </label>
                  <div class="controls span9">
                    <textarea type="text" class="row-fluid" rows="5" name="desc" ><?php  echo set_value('desc'); ?></textarea>
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
                      <?php foreach ($sizes as $size): ?>                        
                      <tr>
                        <td class="prod_sizes"><input type="checkbox" class="checked_all" name="size_id[]" value="<?php echo $size->id; ?>" <?php if(!empty($size_arr)){ if(in_array($size->id, $size_arr)){ echo "checked='checked'";} } ?> > <?php echo $size->size_name; ?>
                        </td><td><input type="text" name="price_size[]" placeholder="Price" class="span3">
                        </td>
                      </tr>
                      <?php endforeach; ?>
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
                        <?php $c_no = 1; $cat_count = 1; ?>
                        <?php foreach ($product_categories as $row): ?>
                          <?php if($c_no == 5): ?>
                            </div>
                            <div class="row-fluid">
                              <?php $c_no = 1; ?>
                          <?php endif ?>
                          <div class="span3"><input type="checkbox"  class="row-fluid" name="category[]" value="<?php echo $row->id; ?>" <?php if(!empty($category_arr)){ if(in_array($row->id, $category_arr) && ($cat_count < 4)){ echo "checked='checked'"; $cat_count++;} } ?> > <?php echo ucfirst($row->category_name); ?></div>
                        <?php $c_no++; ?>
                        <?php endforeach ?>
                    </div>

                    <?php /* ?><table>
                      <tr>
                    <?php $c_no = 1; ?>
                    <?php foreach ($design_category as $row): ?>
                      <?php if($c_no == 8): ?>
                        </tr>
                        <tr>
                          <?php $c_no = 1; ?>
                      <?php endif ?>
                      <td><input type="checkbox"  class="row-fluid" name="category[]" value="<?php echo $row->id; ?>"> <?php echo ucfirst($row->category_name); ?></td>
                    <?php $c_no++; ?>
                    <?php endforeach ?>
                    </tr>
                    </table> <?php */ ?>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Base Price &nbsp; <?php money_symbol(); ?>
                    <span class="help-block"><?php echo form_error('price'); ?></span>
                  </label>
                  <div class="controls span9">
                    <input type="text" name="price"  value="<?php echo set_value('price'); ?>"  placeholder="0.00">
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
                      <option value="<?php echo $key->id ?>" <?php if(set_value('group_id') && $key->id == set_value('group_id')){echo 'selected="selected"';} ?>><?php echo $key->group_name;?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="normal-field">Add Size Chart
                    <!-- <span class="help-block"><?php // echo form_error('addsizechart'); ?></span>  -->
                  </label>
                  <div class="controls span9">
                    <input <?php  if(set_value('addsizechart')){echo "checked";}?> type="checkbox" id="add-size" name="addsizechart" value="0" >
                  </div>
                </div>
                <?php  
                  if (set_value('addsizechart') || set_value('sizechart') || form_error('addsizechart') || form_error('sizechart'))
                    $display = 'style="display: block;"'; 
                  else
                    $display = 'style="display: none;"';

                  $sizechart = '';
                  if ($this->session->userdata('sizechart'))
                     $sizechart = $this->session->userdata('sizechart');

                ?>
                <div <?php echo $display; ?> class="form-row control-group row-fluid" id="size-chart">
                  <label class="control-label span3" for="editor1">Size Chart HTML
                    <span class="help-block"><?php echo form_error('sizechart'); ?></span> <br>
                    <span class="help-block"><?php echo form_error('addsizechart'); ?></span>
                  </label>
                  <div class="controls span9">
                    <textarea id="editor1" type="text" class="row-fluid" rows="5" name="sizechart" > <?php echo $sizechart; ?> </textarea>
                  </div>
                </div>

                <div class="form-actions row-fluid">
                <div class="span3 visible-desktop"></div>
                  <div class="span7 ">
                    <button type="submit" class="btn btn-primary">Submit</button></div>
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

        $(document).ready(function () {
            $("#add-size").on('change',function(){
                if(($(this).prop("checked") === true) || ($(this).prop("checked") === 'true'))
                  $('#size-chart').show();
                else
                  $('#size-chart').hide();
            });
        });
    </script>
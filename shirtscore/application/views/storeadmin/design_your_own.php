<div class="">

<div class="clearfloat"></div>

<div class="prodcontent">

</div>



<div class="dashcontent">

<div class="dashbox">

  <div class="row-fluid">

  <div class="span6"><h2>Create Product</h2></div>

  <div class="span6">

          <?php if(isset($error_msg)){ ?>

            <div class="alert alert-error">

              <button type="button" class="close" data-dismiss="alert">&times;</button>

              <strong>Success :</strong> <br> <?php echo $error_msg; ?>

            </div>

         <?php } ?>

   <div class="api-buttons clearfix" >

      <?php echo form_open(current_url(), array('id' => 'filter-form')); ?>

          <?php if(FALSE): // $product_groups ?>

            <select name="group" class="filter">

                <option value=""> Groups </option>

                <?php foreach ($product_groups as $group) { ?>

                    <option value="<?php  echo $group->id; ?>"> <?php  echo ucfirst($group->group_name); ?> </option>

                <?php } ?>

            </select>

          <?php endif; ?> 



          <?php if(FALSE): // $categories ?>

            <select name="category" class="filter">

                <option value=""> Categories </option>

                <?php foreach ($categories as $cat) { ?>

                    <option <?php if($selected_cat == $cat->id){echo 'selected="selected"';} ?> value="<?php  echo $cat->id; ?>"> <?php  echo ucfirst($cat->category_name); ?> </option>

                <?php } ?>

            </select>

          <?php endif; ?>

      <?php echo form_close(); ?>

      <a href="#" id="print-button" class="btn btn-mini btn-info">Print Preview</a>

      

      <!--  <a href="#" id="recreation-button" class="btn btn-success">Recreate Image</a> -->

      <a href="#" id="upload-button" class="btn btn-mini btn-warning">Upload own design</a> 

      <a href="#" id="image-button" class="btn btn-mini btn-success">Create & Submit</a>



      <input id="colorizable" type="checkbox"> Colorizable?



      <span class="price badge badge-inverse"><?php echo money_symbol(); ?><span id="thsirt-price"></span> </span>



      <input type="file" id="design-upload" style="display: none;" >

      <form action="<?php echo base_url() ?>store/design_recreation" id="recreation-form" method="post">

        <input type="hidden" name="base64_image" value="" >

        <input type="hidden" name="recreation_product" value="" >

        <input type="hidden" name="assets" value="" >

        <input type="hidden" name="upload_url" value="assets/uploads/test/" >

        <input type="hidden" name="price" value="" >

      </form>



       <form action="<?php echo base_url() ?>storeadmin/design_save" id="recreation_n_submit" method="post">

        <input type="hidden" name="base64_image" value="" >

        <input type="hidden" name="assets" value="" >

        <input type="hidden" name="upload_url" value="assets/uploads/test/" >

        <input type="hidden" name="price" value="" >

      </form>



    </div>



    </div>

</div>





    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/css/smoothness/jquery-ui-1.9.2.custom.min.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/css/jquery.fancyProductDesigner.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/css/jquery.fancyProductDesigner-fonts.css" />





  <script src="<?php echo base_url() ?>assets/designer_source/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  <script src="<?php echo base_url() ?>assets/designer_source/js/jquery.fancyProductDesigner.min.js" type="text/javascript"></script>

<script type="text/javascript">

 jQuery(document).ready(function() {



      jQuery('.filter').on('change',function(){

        var val = jQuery(this).val();

        if (val != '') {

          jQuery('#filter-form').submit();

        };

      });



      // jQuery('.filter').on('change',function(){

      //   var group = jQuery('#group').val();

      //   var category = jQuery('#category').val();

      //   jQuery.ajax({

      //                   type: "POST",

      //                   data: { action: 'get_content',},

      //                   url: "<?php echo base_url() ?>store/ajax_prod_dsn/"+group+"/"+category,

      //                   success: function(res){

                          

      //                     // console.clear(res);

      //                     // console.log(res);

      //                     // var obj = jQuery.parseJSON(res);

      //                     jQuery('#fpd').html(res);

      //                   }

      //               });

      // });

      

      //call the plugin and save it in a variable to have access to the API

      var fpd = $('#fpd').fancyProductDesigner({

        editorMode: false,allowProductSaving :false,

        fonts: ['Arial', 'Helvetica', 'Times New Roman', 'Verdana', 'Geneva', 'Fearless'],

        //these are the parameters for the text that is added via the "Add Text" button

        customTextParamters: {x: 210, y: 250, colors: "#000000", removable: true, resizable: true, draggable: true, rotatable: true, price: 3}

      })

      .data('fancy-product-designer');

        //button to create an image of the product

      $('#image-button').click(function(){

        fpd.createImage(false, true);

        return false;

      });



      //the handler when the image is created

      $('#fpd').bind('imageCreate', function(evt, canvas, base64Image) {

        var product = fpd.getProduct(false);

        //$('#recreation-form input:first').val(JSON.stringify(product));

         

        $('input[name="base64_image"]').val(base64Image);

        $('input[name="assets"]').val(JSON.stringify(product));

        $('input[name="price"]').val($('#thsirt-price').text());

        if(confirm('Are You Sure?') == false) return false;



        $('#recreation_n_submit').submit();

        //send 64-bit encoded image url to php

        /*$.post("<?php echo base_url() ?>store/design_save", { base64_image: base64Image,upload_url:'assets/uploads/test/',price:$('#thsirt-price').text(),assets:$('#recreation-form input:first').val()}, function(data) {

          //successful

          if(data) {

            //open product image a new window

            //window.open(data, '_blank');

            alert('Item added successfully!');

          }

          //failed

          else {

            //do what you want here, e.g.

            alert('Image Generation failed!');

          }

        });*/

      });

      

      //get current price when product is created and update it when price changes

      $('#fpd')

      .bind('productCreate', function(evt){

        //$('#thsirt-output').html('Click the "Checkout" button to see the returning object with all properties.');

        $('#thsirt-price').text(fpd.getPrice());

      })

      .bind('priceChange', function(evt, price, currentPrice) {

        currentPrice = parseFloat(currentPrice).toFixed(2);

        $('#thsirt-price').text(currentPrice);

      });

      

      //button to print the product

      $('#print-button').click(function(){

        fpd.print();

   /*     alert('hello');

        $("#design<?php if(!empty($design->id)) echo $design->id ?>").trigger('click');*/

        return true;

      });

      

      //button to print the product 



     

      /*$('#checkout-button').click(function(){

        //get only editable elements

        var product = fpd.getProduct(true);

        var output = '';

        for(var i=0; i < product.length; ++i) {

          output += _getProductOutput(product[i]);

        }

        

        $('#thsirt-output').html(output);

                

        return false;

      });*/

      

      //recreate products

      $('#recreation-button').click(function(){

        var product = fpd.getProduct(false);

        $('#recreation-form input:first').val(JSON.stringify(product)).parent().submit();

        return false;

      });

      

      //click handler for input upload

      $('#upload-button').click(function(){

        $('#design-upload').click();

        return false;

      });

      

      //upload image

      document.getElementById('design-upload').onchange = function (e) {

        if(window.FileReader) {

          var canvas_w=695;

          var canvas_h=570;

          var reader = new FileReader();

            reader.readAsDataURL(e.target.files[0]); 

            reader.onload = function (e) {

              var image = new Image;

              image.src = e.target.result;

              image.onload = function() {

              

              var maxWidth = 215,

              maxHeight = 200,

              scaling = 1;



              //calculate scaling

              if(this.width > maxWidth && this.width >= this.height) {

                scaling = maxWidth / this.width;

              }

              if(this.height > maxHeight  && this.height > this.width) {

                scaling = maxHeight / this.height;

              }



               // get canvas center cordian

                var w_f=(canvas_w-215)/2;

                var h_f=(canvas_h-200)/2;



                //add new image to product

                fpd.addElement('image', e.target.result, 'my custom design', {colors:$('#colorizable').is(':checked') ? '#000000' : false, zChangeable: true, removable: true, draggable: true, resizable: true, rotatable: true, x: w_f, y: h_f,scale: scaling.toFixed(2), price: 0, slug: 0});   

              };

          };

        }

        else {

          alert('FileReader API is not supported in your browser, please use Firefox, Safari, Chrome or IE10!')

        }

      };     



      //format a product object for the output panel

      function _getProductOutput(product) {

        var output = '<strong>Product:</strong> '+product.title;

        

        output += '<br /><strong>Elements:</strong>';

        output += '<p>';

        $(product.elements).each(function(i, elem) {

          output += '<strong>Title:</strong> ' + elem.title;

          output += '<br />';

          output += '<strong>Parameters:</strong><br />';

          for (var prop in elem.parameters) {

              output += prop + ": " + elem.parameters[prop] + ', ';

           }

           output = output.substring(0, output.length-2);

           output += '<br /><br />';

        });

        output += '</p>';

        return output;

      };



      /*$('#print-button').on('click',function(){

        alert('hello');

        $("#design<?php if(!empty($design->id)) echo $design->id ?>").trigger('click');

      });*/

    });  

</script>

<style type="text/css">

.fpd-container {

    width: 100%;

}

 .fpd-container .fpd-product-container {  

    width: 695px  !important;    

}



.fpd-container .fpd-product-selection {  

   width: 200px;

}

.fpd-container .fpd-product-selection ul li{

  float: left;

  width: 49%;

  border-right: 1px solid #D3D3D3;

}

.fpd-container .fpd-product-selection ul li:last-child{

  border-bottom: 1px solid #D3D3D3;

}



.fpd-container .fpd-design-selection {    

    margin-left: 8px;

}



.fpd-container .fpd-design-selection {

  width: 135px;

}



.fpd-design-selection ul li > img {

    max-height: 50px !important;

}

.fpd-design-selection ul li{

/*  width: 24% !important;*/

  height: 55px !important;

}

/*.fpd-design-selection ul li:last-child{

  border-right: 1px solid #D3D3D3;

}*/



/*.fpd-container .fpd-product-selection {

   position: relative; 

   left: 1px;     

   z-index: 2;

   width: 200px;

}

.fpd-container .fpd-product-selection ul li{

  float: left;

  width: 49%;

  border-right: 1px solid #D3D3D3;

}

.fpd-container .fpd-design-selection {  

    position: absolute;

    right: 30px;   

}



 



.fpd-product-container > div > div.fpd-toolbar{

  left: 9%;

  width: 20%;

  /*top: 5px;*/

}*/





</style>

<div class="row-fluid">

  <div class="span12">

<!--  -->

<div id="fpd">   

  <?php if (!empty($products)): ?>

    <?php $i=1; foreach ($products as $row): ?>

  <?php 

  list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/'.$row->main_image); 

/*echo "Image width = " . $width;

echo "<br>";

echo "Image height = " . $height;

echo "<br>";*/

$canvas_width=695; //575

$canvas_height=570;

/*echo "<br>";

echo "canvas width = " . $canvas_width;

echo "<br>";

echo "canvas height = " . $canvas_height;

echo "<br>";*/



$w_f=($canvas_width-$width)/2;

$h_f=($canvas_height-$height)/2;

/*echo "<br>";

echo "Image center x = ".$w_f;

echo "<br>";

echo "Image center y = ".$h_f;*/



?>    

      <div class="fpd-product" title="<?php echo $row->short_name ?>" data-thumbnail="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->main_image ?>">

        <img src="<?php echo base_url() ?>assets/uploads/products/<?php echo $row->main_image ?>" title="<?php echo $row->short_name ?>" data-parameters='{"x": <?php echo $w_f ?>, "y": <?php echo $h_f ?>, "price": <?php echo $row->price ?>,"removable": true,"product_id":<?php echo $row->id ?>}' />

         <?php /* if ($i==1): ?>

            <div class="fpd-product" title="Shirt Back" data-thumbnail="<?php echo base_url() ?>assets/images/yellow_shirt/back/preview.png">

                <img src="<?php echo base_url() ?>assets/images/yellow_shirt/back/base.png" title="Base Back" data-parameters='{"x": 123, "y": 81, "colors": "Base Front", "price": 40}' />

                <img src="<?php echo base_url() ?>assets/images/yellow_shirt/back/body.png" title="Hightlights" data-parameters='{"x": 277, "y": 79}' />

                <img src="<?php echo base_url() ?>assets/images/yellow_shirt/back/shadows.png" title="Shadow" data-parameters='{"x": 123, "y": 81}' />

            </div>

         <?php endif */ ?>

      </div>



    <?php $i++; endforeach ?>

  <?php endif ?>    

<!--  -->



  <div class="fpd-design">

    

        <?php if (!empty($designs)): ?>

          <?php foreach ($designs as $row): ?>

            <img class="designs" id="design<?php echo $row->id ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image ?>" title="<?php echo $row->design_title; ?>" price="<?php echo $row->price ?>" data-parameters='{"x": 215, "y": 200,  "removable": true, "draggable": true, "rotatable":true, "resizable": true, "price": <?php echo $row->price ?>,"design_id":<?php echo $row->id ?>, "slug": 1}' />

          <?php endforeach ?>

        <?php endif ?>

        <!-- <img src="<?php// echo base_url() ?>assets/designer_source/images/designs/swirl.png" title="Swirl" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "price": 10}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/swirl2.png" title="Swirl 2" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/swirl3.png" title="Swirl 3" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/heart_blur.png" title="Heart Blur" data-parameters='{"x": 215, "y": 200, "colors": "#bf0200", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "price": 5}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/converse.png" title="Converse" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/crown.png" title="Crown" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/men_women.png" title="Men hits Women" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/retro_1.png" title="Retro One" data-parameters='{"x": 210, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.25}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/retro_2.png" title="Retro Two" data-parameters='{"x": 193, "y": 180, "colors": "#ffffff", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.46}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/retro_3.png" title="Retro Three" data-parameters='{"x": 240, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.25}' />

        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/heart_circle.png" title="Heart Circle" data-parameters='{"x": 240, "y": 200, "colors": "#007D41", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.4}' />

 -->      </div>



      </div><!-- fpd -->

<!--  -->

  </div><!-- span12 -->

</div>



</div>

</div>

<div class="clearfloat"></div>
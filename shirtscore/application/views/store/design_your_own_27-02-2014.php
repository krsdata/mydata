<div class="container">
<div class="clearfloat"></div>
<div class="prodcontent">
</div>
<hr color="3b5998" />
<div class="dashcontent">
<div class="dashbox">
  <div class="row-fluid">
  <div class="span12">
    
<?php if(isset($error_msg)){ ?>
<div class="alert alert-error">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Success :</strong> <br> <?php echo $error_msg; ?>
</div>
<?php } ?>


  </div>
</div>
  <div class="row-fluid">

  <div class="span5" >


&nbsp; <button id="upload-button" class="btn btn-warning"> <i class="icon-upload icon-white"></i> Upload Your Own Design</button>



 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<button id="image-button" data-original-title="Please select front view of product then proceed." class="btn btn-success">  <i class="icon-shopping-cart icon-white"></i> ADD TO CART</button>


 </div>


  <div class="span6" >
          <span style="color: #51A351; font-size: 24px;font-weight: bold;">DESIGN YOUR OWN SHIRT!</span>
         
        </div>



      <div class="span1">
             
           <div class="api-buttons clearfix pull-right">
            
             
               
                
           
                <div class="price badge badge-inverse" style="padding:8px; min-width:30px;"><?php echo money_symbol(); ?><span id="thsirt-price"></span> </div>

              <input type="file" id="design-upload" style="display: none;" >
             

               <form action="<?php echo base_url() ?>store/design_save" id="recreation_n_submit" method="post">
                  <input type="hidden" name="base64_image" value="" >
                  <input type="hidden" name="assets" value="" >
                  <input type="hidden" name="upload_url" value="assets/uploads/test/" >
                  <input type="hidden" name="price" value="" >
                
              <input type="hidden" name="f_custom_img" value="" />
               <input type="hidden" name="b_custom_img" value="" />                  

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

      jQuery('#is_color').tooltip();

      jQuery('#image-button').tooltip();

      jQuery('.filter').on('change',function(){
        var val = jQuery(this).val();
        if (val != '') {
          jQuery('#filter-form').submit();
        };
      });

      //call the plugin and save it in a variable to have access to the API

      var f_left   = parseInt(jQuery('#f_left').val());
      var f_top    = parseInt(jQuery('#f_top').val());
      var f_width  = parseInt(jQuery('#f_width').val());
      var f_height = parseInt(jQuery('#f_height').val());
      var fpd = jQuery('#fpd').fancyProductDesigner({
        editorMode: false,allowProductSaving :false,
        fonts: ['Arial', 'Helvetica', 'Times New Roman', 'Verdana', 'Geneva', 'Fearless'],
        minTextSize:20,
        maxTestSize:500,
        textSize:20,

        //these are the parameters for the text that is added via the "Add Text" button
        customTextParamters: {x: (f_left+1), y: (f_top+1), colors: "#FFFFFF", removable: true, resizable: true, draggable: true, rotatable: true, price: 3, boundingBox:{x: f_left, y: f_top, width: f_width, height: f_height}}
      })
      .data('fancy-product-designer');
        //button to create an image of the product
      jQuery('button.fpd-add-custom-text').click(function(){
        jQuery('#in_out').val(0);
      });

      jQuery('#image-button').click(function(e){
        var fpd_editable = jQuery('.fpd-single-product').children().length;
        if(!is_in_out()){
          alert('Please check that all items are in containment area then proceed.');
          return false;
        }
        // if (fpd_editable == 2) {jQuery('#in_out').val(1)} else{jQuery('#in_out').val(0)};
        // var in_out = jQuery('#in_out').val();
        var val = jQuery('#product_face').val();
        // if (in_out == 1){
          if (val == 0){
            fpd.createImage(false, true);
            return false;
          }else{
            alert('Please select front view of product then proceed.');
          };
        // }else{
        //   alert('Please check that all items are in containment area then proceed.');
        // };
      });


      jQuery('.fpd-views-selection li').click(function(){
        var index = jQuery(this).index();
        jQuery('#product_face').val(index);
      });

      jQuery('.fpd-product-selection div ul li').click(function(){
        jQuery('#fin_outDiv').html('');
        jQuery('#bin_outDiv').html('');
        jQuery('#product_face').val(0);
        var pro_index = jQuery(this).index();
          jQuery.ajax({
              type: "POST",
              data: { action: 'get_content',},
              url: "<?php echo base_url() ?>store/ajax_prod_color/"+pro_index,
              success: function(res){
                var obj = jQuery.parseJSON(res);
                if(obj.status === 1){
                   jQuery('#color_boxes_data').html(obj.col);
                   // console.log(obj.bound_box.f_width);
                   jQuery('#f_left2').val(obj.bound_box.f_left);
                   jQuery('#f_top2').val(obj.bound_box.f_top);
                   jQuery('#f_width2').val(obj.bound_box.f_width);
                   jQuery('#f_height2').val(obj.bound_box.f_height);
                   jQuery('#b_left').val(obj.bound_box.b_left);
                   jQuery('#b_top').val(obj.bound_box.b_top);
                   jQuery('#b_width').val(obj.bound_box.b_width);
                   jQuery('#b_height').val(obj.bound_box.b_height);

                   setBoundBox();

                }
                else
                   jQuery('#color_boxes_data').html('');
              }
          });
      });


    

      jQuery('div.fpd-element.fpd-editable').click(function(){
      // alert('dsdsdsd');
       var f_left   = jQuery('#f_left').val();
       var f_top    = jQuery('#f_top').val();
       var f_width  = jQuery('#f_width').val();
       var f_height = jQuery('#f_height').val();
      /* console.log('--------------');
       console.log('Left :'+f_left);
       console.log('Top :'+f_top);
       console.log('Width :'+f_width);
       console.log('Height :'+f_height);*/
       jQuery('div.fpd-single-product div.containment').css({"left": f_left+"px","top": f_top+"px", "width": f_width+"px", "height": f_height+"px"});
      });

      jQuery('#fpd').on('elementOut', function(evt) {
        // console.log(evt);
        jQuery('#in_out').val(0);
        // setBoundBox();
      });

      jQuery('#fpd').on('elementIn', function(evt) {
        // console.log(evt);
        jQuery('#in_out').val(1);
        // setBoundBox();
      });
      
      jQuery('#fpd').on('elementAdded', function(evt, element) {
       var idstring = jQuery(element).attr('id');
       var id= idstring.replace ( /[^\d.]/g, '' );

       var f_left   = jQuery('#f_left').val();
       var f_top    = jQuery('#f_top').val();
       var f_width  = jQuery('#f_width').val();
       var f_height = jQuery('#f_height').val();



        if (id > 0){
          //alert('YES '+id);
          jQuery(element).css({
            'left': (parseInt(f_left)+2)+"px",
            'top': (parseInt(f_top)+2)+"px"
          });
            // var newTextBoxDiv = jQuery(document.createElement('div')).attr({"class":"controls","id":'TextBoxDiv' + counter});
            var newTextBoxDiv = jQuery(document.createElement('input')).attr({"value":1, "type":"hidden","class":"in_out","id":'editable_element_'+ idstring ,"ids":'div#'+ idstring +'.fpd-element'});

            // newTextBoxDiv.html('<input class="span4" type="text" name="item[]"> <select name="measure[]" class="sprite-select span3"><option value="0" > None </option><option value="oz" > OZ </option><option value="lb" > Lb </option><option value="cup" > Cup </option><option value="tbsp" > Tablespoon </option><option value="tsp" > Teaspoon </option><option value="nos" > Nos </option></select> <input  class="span3 qty" type="text" name="qty[]"><span class="span2" id="'+counter+'"> <a onclick="remove_ingrd('+counter+')" href="javascript:void(0)">Remove</a> </span>');
            if (jQuery('#product_face').val() == 0){
              newTextBoxDiv.appendTo("#fin_outDiv");
              // console.log('front');
            }
            else{
              newTextBoxDiv.appendTo("#bin_outDiv");
              // console.log('back');
            }
        };
            




jQuery(element).find('img,p').trigger('click');
  //alert(jQuery(element).attr('title'));
  if(jQuery(element).attr('title')=='Text'){
  $('#fpd').find('.fpd-text-input').focus().select();
  
}


      });

      //   // jQuery('div.fpd-single-product div.fpd-element img').each(function( index ) {
      //   //   jQuery(this).attr('src','http://localhost/SS_3-DEC-2013/assets/images/prod/pink.png')
      //   // });
      //   // jQuery('.fpd-product-selection div ul li').
      // });
//////////////////////////
      // jQuery('.fpd-product-selection div ul li img').click(function(){
      //   var src = jQuery(this).attr('src');
      //   alert(src);
      // });
//////////////////////////
      //the handler when the image is created
      $('#fpd').bind('imageCreate', function(evt, canvas, base64Image) {
        var product = fpd.getProduct(false);
        //$('#recreation-form input:first').val(JSON.stringify(product));
        $('input[name="base64_image"]').val(base64Image);
        $('input[name="assets"]').val(JSON.stringify(product));
        $('input[name="price"]').val($('#thsirt-price').text());
        if(confirm('Are you sure want add to Cart?') == false) return false;

        $('#recreation_n_submit').submit();
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
        

           

       // alert(e.target.result.toSource());
       //var fcustomimg=  e.target.result;


       // console.log(' fcustomimg = '+e.toSource());
        // $('#f_custom_img').val(fcustomimg);

       

        if(window.FileReader) {
          var canvas_w=695;
          var canvas_h=570;
          var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]); 
            reader.onload = function (e) {
              var image = new Image;
              image.src = e.target.result;
              image.onload = function() {



                if (jQuery('#product_face').val() == 0){
            var upflag0=true;
            jQuery('div.fpd-single-product:eq(0) div.fpd-element').each(function( index1 ) {
              upid0 = jQuery(this).attr('id');
              uptitle0 = jQuery(this).attr('title');
             // console.log(index1+'upid0 ='+upid0);
             // console.log(index1+'uptitle0 ='+uptitle0);
              if(uptitle0=='my custom design'){                
                upflag0= false;
              }             
            });

            if(upflag0==false){
              alert('Sorry, You can have only one design on one side of a product.');
              $('input[name="f_custom_img"]').val('0');
              return false;
            }else{
              $('input[name="f_custom_img"]').val(e.target.result);
            }

        }else{

           var upflag1=true;
         // console.log(jQuery('div.fpd-single-product:eq(1) div.fpd-element').html);
          jQuery('div.fpd-single-product:eq(1) div.fpd-element').each(function( index2 ) {
            upid1 = jQuery(this).attr('id');
            uptitle1 = jQuery(this).attr('title');
           // console.log(index2+'upid1 ='+upid1);
            //console.log(index2+'uptitle1 ='+uptitle1);
            if(uptitle1=='my custom design'){                
              upflag1= false;
            }             
          });

          if(upflag1==false){
            alert('Sorry, You can have only one design on one side of a product.');
            $('input[name="b_custom_img"]').val('');
            return false;
          }else{
            $('input[name="b_custom_img"]').val(e.target.result);
          }

        }  


              

               var f_width2  = parseInt(jQuery('#f_width').val());
            


              var maxWidth = (f_width2-20),
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
                var f_left   = parseInt(jQuery('#f_left').val());
                var f_top    = parseInt(jQuery('#f_top').val());
                var f_width  = parseInt(jQuery('#f_width').val());
                var f_height = parseInt(jQuery('#f_height').val());
               // console.log(e.target.result);
                // jQuery('#in_out').val(0);

              // var fcustomimg =  e.target.result;
               // alert(fcustomimg);

                // $('#f_custom_img').val(fcustomimg);

                fpd.addElement('image', e.target.result, 'my custom design', {colors:$('#colorizable').is(':checked') ? '#000000' : false, zChangeable: true, removable: true, draggable: true, resizable: true, rotatable: true, x: (f_left + 10), y: (f_top + 10), scale: scaling.toFixed(2), price: 0, slug: 0, boundingBox:{x: f_left, y: f_top, width: f_width, height: f_height}});
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


      //joe

         jQuery('#changedesign').change(function(){
         // alert('dfdf');
          var changedesign_cat_id=$(this).val();
           $.get('<?php echo base_url("store/get_design_ajax/") ?>/'+changedesign_cat_id, function(data) {
           // alert(data);
            var jsondata=$.parseJSON(data);
            if(jsondata.STATUS==1){

              $('.fpd-design-selection').find('ul').empty();

             // alert('TRU ='+jsondata.STATUS+' ## '+jsondata.DATA.length);

              for (var i = 0; i < jsondata.DATA.length; i++) {
                jsondata.DATA[i].design_image;
               // alert('design '+jsondata.DATA[i].design_image);
              var j= '<?php echo base_url() ?>/assets/uploads/designs/thumbnail/'+jsondata.DATA[i].design_image;
              var u=jsondata.DATA[i].design_title;
              
              var a={'removable': true, 'draggable': true, 'resizable': true, 'rotatable': true, 'x': 215, 'y':200, 'scale': 0.30, 'price': parseFloat(jsondata.DATA[i].price),'design_id':parseInt(jsondata.DATA[i].id), 'slug': 1, 'boundingBox':{'x': 100,'y': 200, 'width': 300, 'height': 400}};   
                 fpd.addDesign(j, u,a);

              };

            }else{
             
             if(changedesign_cat_id>0){
              $('.fpd-design-selection div').find('ul').html('');
              }
            }

          });

         });

      $.get('<?php echo base_url("store/get_design_category_ajax") ?>', function(data) {
         $('#changedesign').html(data);
        });

    });

    function changeImage(j){
      if(j == "0"){
        jQuery('#f_left').val(parseInt(jQuery('#f_left2').val()));
        jQuery('#f_top').val(parseInt(jQuery('#f_top2').val()));
        jQuery('#f_width').val(parseInt(jQuery('#f_width2').val()));
        jQuery('#f_height').val(parseInt(jQuery('#f_height2').val()));
      }
      else{
        jQuery('#f_left').val(parseInt(jQuery('#b_left').val()));
        jQuery('#f_top').val(parseInt(jQuery('#b_top').val()));
        jQuery('#f_width').val(parseInt(jQuery('#b_width').val()));
        jQuery('#f_height').val(parseInt(jQuery('#b_height').val()));
      }
    }
    
    function setBoundBox(){
       // alert('dsdsdsd');
       jQuery('#f_left').val(parseInt(jQuery('#f_left2').val()));
        jQuery('#f_top').val(parseInt(jQuery('#f_top2').val()));
        jQuery('#f_width').val(parseInt(jQuery('#f_width2').val()));
        jQuery('#f_height').val(parseInt(jQuery('#f_height2').val()));
       // jQuery('div.fpd-single-product div.containment').css({"left": f_left+"px","top": f_top+"px", "width": f_width+"px", "height": f_height+"px"});

    };

    function is_in_out(){
      var id;
      var resp = true;
      jQuery('.in_out').each(function() {
          if (jQuery(this).attr('id') != 'editable_element_f_0') {
              if (jQuery(this).val() == 0){
                resp = false;
                return false;
              }
          };
      });
      return resp;
    };
</script>
<script type="text/javascript">
  function get_col_imgs(col, ind) {
          // alert(col);
          // return false;
          jQuery.ajax({
                type: "POST",
                data: { action: 'get_content',},
                url: "<?php echo base_url() ?>store/ajax_color_set/"+col,
                success: function(res){
                  // console.log(res);
                  var obj = jQuery.parseJSON(res);
                  if(obj.status === 1){
                     var front = obj.front;
                     var back = obj.back;
                     var path = obj.path;
                     jQuery('div.fpd-single-product').each(function( index ) {
                        if (index == 0) {
                          jQuery('div.fpd-single-product:eq(0) div.fpd-element').each(function( index1 ) {
                            idf = jQuery(this).attr('id');
                            if (index1 == 0 && index == 0){
                              // console.log(jQuery("img", this).attr('src'));
                              jQuery("img", this).attr('src',path+front);
                            }else
                              return false;
                          });
                        }else{
                          jQuery('div.fpd-single-product:eq(1) div.fpd-element').each(function( index1 ) {
                            idb = jQuery(this).attr('id');
                            if (index1 == 0 && index != 0){
                              // console.log(jQuery("img", this).attr('src'));
                              jQuery("img", this).attr('src',path+back);
                            }else
                              return false;
                          });
                        }
                     });

                     jQuery('div.fpd-product-selection div ul img').eq(ind).attr('src',path+"thumbnail/"+front);

                     jQuery('ul.fpd-views-selection li img').each(function( index ) {
                      if (index == 0)
                        jQuery(this).attr('src',path+"thumbnail/"+front);
                      else
                        jQuery(this).attr('src',path+"thumbnail/"+back);
                     });
                  }
                  else
                     jQuery('#color_boxes').html('');
                }
            });
          
          // jQuery('.fpd-product-selection div ul li').
      }
</script>
<style type="text/css">

.fpd-container {
    width: 100%;
}

.fpd-container > div {height: 635px;}
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

.fpd-add-custom-text {
    left: 12px;
    position: relative !important;
    top: -559px;
}

</style>
<div class="row-fluid">
  <?php 
    if ($is_single)
      $con_class = 'span11 offset1';
    else
      $con_class = 'span12';
  ?>
  <div class="<?php echo $con_class; ?>">
<!--  -->
<div id="fpd">   
  <?php if ($product_id == 0): ?>
      <?php if (!empty($products)): ?>
          <?php $i=1; foreach ($products as $row): ?>
          <?php

          list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/'.$row->main_image); 

          $canvas_width=695; //575
          $canvas_height=570;
          $w_f=($canvas_width-$width)/2;
          $h_f=($canvas_height-$height)/2;
          // echo "<br>Canvas Width :".$canvas_width;
          // echo "<br>Canvas Height :".$canvas_height;
          // echo "<br>Image Width :".$width;
          // echo "<br>Image Height :".$height;
          // echo "<br>Left :".$w_f;
          // echo "<br>Top :".$h_f;
          // die();
          ?>    
          <div class="fpd-product" title="<?php echo $row->short_name ?>" data-thumbnail="<?php echo base_url() ?>assets/uploads/products/<?php echo $row->main_image ?>">
            <img src="<?php echo base_url() ?>assets/uploads/products/<?php echo $row->main_image ?>" title="<?php echo $row->short_name ?>" data-parameters='{"x": <?php echo $w_f ?>, "y": <?php echo $h_f ?>, "price": <?php echo $row->price ?>,"removable": false,"product_id":<?php echo $row->id ?>}' />
            <?php if (!empty($row->back_image)): ?>
                <div class="fpd-product" title="Shirt Back" data-thumbnail="<?php echo base_url() ?>assets/uploads/products/<?php echo $row->back_image ?>">
                  <img src="<?php echo base_url() ?>assets/uploads/products/<?php echo $row->back_image ?>" title="Base Back" data-parameters='{"x": <?php echo $w_f ?>, "y": <?php echo $h_f ?>, "price": 0,"removable": false,"product_id":<?php echo $row->id ?>}' />
                </div>
            <?php endif; ?>
          </div>
          <?php $i++; endforeach ?>
      <?php endif; ?>
      
  <?php else: ?>

      <?php if (!empty($products)): ?>
        <?php

        list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/'.$products->main_image); 

        $canvas_width=695; //575
        $canvas_height=570;
        $w_f=($canvas_width-$width)/2;
        $h_f=($canvas_height-$height)/2;

        ?>    
            <div class="fpd-product" title="<?php echo $products->short_name ?>" data-thumbnail="<?php echo base_url() ?>assets/uploads/color_img/<?php echo $color->main_image ?>">
              <img src="<?php echo base_url() ?>assets/uploads/color_img/<?php echo $color->main_image ?>" title="<?php echo $products->short_name ?>" data-parameters='{"x": <?php echo $w_f ?>, "y": <?php echo $h_f ?>, "price": <?php echo $products->price ?>,"removable": false,"product_id":<?php echo $products->id ?>, "boundingBox": {"x": 100, "y": 200, "width": 300, "height": 400}}' />
              <?php if (!empty($color->back_image)): ?>
                  <div class="fpd-product" title="Shirt Back" data-thumbnail="<?php echo base_url() ?>assets/uploads/color_img/<?php echo $color->back_image ?>">
                    <img src="<?php echo base_url() ?>assets/uploads/color_img/<?php echo $color->back_image ?>" title="Base Back" data-parameters='{"x": <?php echo $w_f ?>, "y": <?php echo $h_f ?>, "price": 0,"removable": false,"product_id":<?php echo $products->id ?>, "boundingBox": {"x": 100, "y": 200, "width": 300, "height": 400}}' />
                  </div>
              <?php endif; ?>
            </div>
      <?php endif; ?>

  <?php endif ?>

  <div class="fpd-design">
        <?php if (!empty($products)): ?>
            <?php
              $boundingBox = json_decode($products[0]->restricted_para);
              if (!empty($boundingBox))
                $box = '{"x": '.($boundingBox->f_left).', "y": '.($boundingBox->f_top).' , "width": '.$boundingBox->f_width.' , "height": '.$boundingBox->f_height.' }';
            ?>
        <?php endif; ?>
        <?php if (!empty($designs1)): ?>
           <?php foreach ($designs1 as $row): ?>
          <img class="designs" id="design<?php echo $row->id ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image ?>" title="<?php echo $row->design_title; ?>" price="<?php echo $row->price ?>" data-parameters='{"x": 215, "y": 200,  "removable": true, "draggable": true, "rotatable":true, "resizable": true, "price": <?php echo $row->price ?>,"design_id":<?php echo $row->id ?>, "slug": 1 <?php if (!empty($boundingBox)){ ?>, "boundingBox" : <?php echo $box; } ?>,"scale": 0.30}' />
           <?php endforeach ?>
        <?php //else: ?>
        <?php endif; ?>
          <?php if (!empty($designs)): ?>
            <?php foreach ($designs as $row): ?>
              <img class="designs" id="design<?php echo $row->id ?>" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image ?>" title="<?php echo $row->design_title; ?>" price="<?php echo $row->price ?>" data-parameters='{"x": 215, "y": 200,  "removable": true, "draggable": true, "rotatable":true, "resizable": true, "price": <?php echo $row->price ?>,"design_id":<?php echo $row->id ?>, "slug": 1 <?php if (!empty($boundingBox)){ ?>, "boundingBox" : <?php echo $box; } ?>,"scale": 0.30}' />
            <?php endforeach ?>
          <?php endif; ?>
        
        <!-- <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/swirl.png" title="Swirl" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "price": 10}' /> --> 
       <!--  <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/swirl2.png" title="Swirl 2" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/swirl3.png" title="Swirl 3" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/heart_blur.png" title="Heart Blur" data-parameters='{"x": 215, "y": 200, "colors": "#bf0200", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "price": 5}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/converse.png" title="Converse" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/crown.png" title="Crown" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/men_women.png" title="Men hits Women" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/retro_1.png" title="Retro One" data-parameters='{"x": 210, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.25}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/retro_2.png" title="Retro Two" data-parameters='{"x": 193, "y": 180, "colors": "#ffffff", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.46}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/retro_3.png" title="Retro Three" data-parameters='{"x": 240, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.25}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/heart_circle.png" title="Heart Circle" data-parameters='{"x": 240, "y": 200, "colors": "#007D41", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.4}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/heart_circle.png" title="Heart Circle" data-parameters='{"x": 240, "y": 200, "colors": "#007D41", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.4}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/heart_circle.png" title="Heart Circle" data-parameters='{"x": 240, "y": 200, "colors": "#007D41", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.4}' />
        <img src="<?php // echo base_url() ?>assets/designer_source/images/designs/heart_circle.png" title="Heart Circle" data-parameters='{"x": 240, "y": 200, "colors": "#007D41", "removable": true, "draggable": true, "rotatable":false, "resizable": true, "scale": 0.4}' /> -->
      </div>
      

     

      </div><!-- fpd -->


    <div style=" position: relative;">
      <div  id="color_boxes">
        <div id="color_boxes_data" class="row"><?php echo $col_html; ?></div>
        <div class="row"><span><strong>Select Your Product Color</strong></span></div>
      </div>
    </div>


  </div><!-- span12 -->

</div>

</div>
</div>
<input type="hidden" id="product_face" value="0" >
<!-- <input type="hidden0" id="last_added" value="text" > -->
<div id="fin_outDiv">
<!-- <input type="hidden0" id="in_out" name="in_out" value="1" > -->
</div>
<div id="bin_outDiv">
<!-- <input type="hidden0" id="in_out" name="in_out" value="1" > -->
</div>
  <?php if (!empty($products)): ?>
  <!-- Printing Area  -->
    <?php  $boundingBox = json_decode($products[0]->restricted_para); ?>
    
    
    <input type="hidden" id="f_top" name="f_top" value="<?php echo $boundingBox->f_top; ?>" />
    <input type="hidden" id="f_left" name="f_left" value="<?php echo $boundingBox->f_left; ?>" />
    <input type="hidden" id="f_width" name="f_width" value="<?php echo $boundingBox->f_width; ?>" />
    <input type="hidden" id="f_height" name="f_height" value="<?php echo $boundingBox->f_height; ?>" />


    <input type="hidden" id="f_top2" name="f_top" value="<?php echo $boundingBox->f_top; ?>" />
    <input type="hidden" id="f_left2" name="f_left" value="<?php echo $boundingBox->f_left; ?>" />
    <input type="hidden" id="f_width2" name="f_width" value="<?php echo $boundingBox->f_width; ?>" />
    <input type="hidden" id="f_height2" name="f_height" value="<?php echo $boundingBox->f_height; ?>" />
    
    <input type="hidden" id="b_top" name="b_top" value="<?php echo $boundingBox->b_top; ?>" />
    <input type="hidden" id="b_left" name="b_left" value="<?php echo $boundingBox->b_left; ?>" />
    <input type="hidden" id="b_width" name="b_width" value="<?php echo $boundingBox->b_width; ?>" />
    <input type="hidden" id="b_height" name="b_height" value="<?php echo $boundingBox->b_height; ?>" />
   

   <!--  <textarea id="f_custom_img" name="f_custom_img"></textarea> -->


  <!-- Printing Area  -->
  <?php endif; ?>
<div class="clearfloat"></div>
<style type="text/css">
  .fpd-container .fpd-design-selection {
      width: 134px !important;
  }
  .fpd-container .fpd-product-selection {
      width: 198px !important;
  }
  #color_boxes {
    left: 280px;
    position: absolute;
    top: -138px;
  }
  #changedesign{width:135px !important;padding: 3px!important;}
</style>

<?php if (!empty($designs1)): ?>
<script>
  $(document).ready(function() {
       var selection =jQuery('.fpd-design-selection div ul li:eq(0)');
       $(selection).trigger( "click" );   

  });
</script>
<?php endif; ?>
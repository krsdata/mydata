<div class="container">
<div class="clearfloat"></div>
<div class="prodcontent">
</div>
<hr color="3b5998" />
<div class="dashcontent">
<div class="dashbox">
<h2>Create My Design</h2>
<div clas="row">
	<div class=" offset2">
	<!--  -->	
	<?php if ($this->uri->segment(2)=='create_my_design'): ?>  

	  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/css/smoothness/jquery-ui-1.9.2.custom.min.css" />
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/css/jquery.fancyProductDesigner.css" />
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/css/jquery.fancyProductDesigner-fonts.css" />


	<script src="<?php echo base_url() ?>assets/designer_source/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/designer_source/js/jquery.fancyProductDesigner.min.js" type="text/javascript"></script>
<!--  -->
<script type="text/javascript">  
 jQuery(document).ready(function() {
      
      //call the plugin and save it in a variable to have access to the API
      var fpd = $('#fpd').fancyProductDesigner({
        editorMode: false,allowProductSaving :false,
        fonts: ['Arial', 'Helvetica', 'Times New Roman', 'Verdana', 'Geneva', 'Fearless'],
        //these are the parameters for the text that is added via the "Add Text" button
        customTextParamters: {x: 210, y: 250, colors: "#000000", removable: true, resizable: true, draggable: true, rotatable: true}
      })
      .data('fancy-product-designer');

        //button to create an image of the product
      $('#image-button').click(function(){
        fpd.createImage(false, false);
        return false;
      });

      //the handler when the image is created
      $('#fpd').bind('imageCreate', function(evt, canvas, base64Image) {
        
        if(confirm('Are You Sure?') == false) return false;

        //send 64-bit encoded image url to php
        $.post("<?php echo base_url() ?>store/design_save", { base64_image: base64Image,upload_url:'assets/uploads/test/' }, function(data) {       
          //successful
          if(data) {
            //open product image a new window
            window.open(data, '_blank');
          }
          //failed
          else {
            //do what you want here, e.g. alert('Image Generation failed!');
          }
        } );
      }); 

      
      //get current price when product is created and update it when price changes
      $('#fpd')
      .bind('productCreate', function(evt){
        //$('#thsirt-output').html('Click the "Checkout" button to see the returning object with all properties.');
        $('#thsirt-price').text(fpd.getPrice());
      })
      .bind('priceChange', function(evt, price, currentPrice) {
        $('#thsirt-price').text(currentPrice);
      });
      
      //button to print the product
      $('#print-button').click(function(){
        fpd.print();
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
      /*$('#recreation-button').click(function(){
        var product = fpd.getProduct(false);
        $('#recreation-form input:first').val(JSON.stringify(product)).parent().submit();
        return false;
      });*/
      
      //click handler for input upload
      $('#upload-button').click(function(){
        $('#design-upload').click();
        return false;
      });
      
      //upload image
      document.getElementById('design-upload').onchange = function (e) {
        if(window.FileReader) {
          var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]); 
            reader.onload = function (e) {
              var image = new Image;
              image.src = e.target.result;
              image.onload = function() {
                //add new image to product
                fpd.addElement('image', e.target.result, 'my custom design', {colors:$('#colorizable').is(':checked') ? '#000000' : false, zChangeable: true, removable: true, draggable: true, resizable: true, rotatable: true, x: 200, y: 200});   
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
    });  
</script>	
	<?php //print_r($design)  /*flower_blue.png*/?>
  <?php list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/designs/thumbnail/'.$design->design_image); 
echo "Image width = " . $width;
echo "<br>";
echo "Image height = " . $height;
echo "<br>";
$canvas_width=575;
$canvas_height=570;
echo "<br>";
echo "canvas width = " . $canvas_width;
echo "<br>";
echo "canvas height = " . $canvas_height;
echo "<br>";

$w_f=($canvas_width-$width)/2;
$h_f=($canvas_height-$height)/2;
echo "<br>";
echo "Image center x = ".$w_f;
echo "<br>";
echo "Image center y = ".$h_f;
?>
<div id="fpd">

	<div class="fpd-product" title="<?php echo $design->design_title ?>" data-thumbnail="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $design->design_image ?>">
		
    <img src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $design->design_image ?>" title="<?php echo $design->design_title ?>" data-parameters='{"x": <?php echo $w_f ?>, "y": <?php echo $h_f ?>, "colors": "false", "price": <?php echo number_format($design->price,2) ?>}' />
	</div>
		
			<div class="fpd-design">
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/swirl.png" title="Swirl" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true, "price": 10}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/swirl2.png" title="Swirl 2" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/swirl3.png" title="Swirl 3" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/heart_blur.png" title="Heart Blur" data-parameters='{"x": 215, "y": 200, "colors": "#bf0200", "removable": true, "draggable": true, "rotatable": true, "resizable": true, "price": 5}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/converse.png" title="Converse" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/crown.png" title="Crown" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/men_women.png" title="Men hits Women" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/retro_1.png" title="Retro One" data-parameters='{"x": 210, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true, "scale": 0.25}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/retro_2.png" title="Retro Two" data-parameters='{"x": 193, "y": 180, "colors": "#ffffff", "removable": true, "draggable": true, "rotatable": true, "resizable": true, "scale": 0.46}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/retro_3.png" title="Retro Three" data-parameters='{"x": 240, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "rotatable": true, "resizable": true, "scale": 0.25}' />
	  		<img src="<?php echo base_url() ?>assets/designer_source/images/designs/heart_circle.png" title="Heart Circle" data-parameters='{"x": 240, "y": 200, "colors": "#007D41", "removable": true, "draggable": true, "rotatable": true, "resizable": true, "scale": 0.4}' />
			</div>
	</div><!-- fpd -->

<div class="row" style="margin:30px 10px;">
	
		<div class="api-buttons clearfix" >

    
          
      

		<a href="#" id="print-button" class="btn btn-info">Print</a>
		<a href="#" id="image-button" class="btn btn-success">Create Image</a>
    <a href="#" id="upload-button" class="btn btn-warning">Upload own design</a>    
		<input id="colorizable" type="checkbox"> Colorizable?


		<span class="price badge badge-inverse"><?php echo money_symbol(); ?><span id="thsirt-price"></span> </span>

		<input type="file" id="design-upload" style="display: none;" />
		<form action="<?php echo base_url() ?>store/design_recreation" id="recreation-form" method="post">
		<input type="hidden" name="recreation_product" value="" />
		</form>

		</div>
		<div id="thsirt-output" class="output"></div>
</div>


	<!--  -->
	<?php endif ?>
	</div><!-- offset2 -->
</div><!-- row -->

</div>
</div>
<div class="clearfloat"></div>
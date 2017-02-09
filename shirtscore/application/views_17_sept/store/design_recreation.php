<!DOCTYPE html>
  <head>
      <meta charset="utf-8">
     


<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/designer_source/css/jquery.fancyProductDesigner-fonts.css" />
  <style type="text/css">
    .fpd-recreation {
      width: 575px;
      background: white;
      position: relative;
      margin: 0 auto;
    }
    
    .fpd-recreation div {
      position: relative;
      height: 570px;
    }
    
    .fpd-recreation img, .fpd-recreation canvas, .fpd-recreation span {
      position: absolute;
    }
  </style>

<!--  -->
 <!-- Include js files -->
  <script src="<?php echo base_url() ?>assets/designer_source/js/jquery.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/designer_source/js/html2canvas.js" type="text/javascript"></script>
            
  <script type="text/javascript">

    jQuery(document).ready(function() {
      
      //pass the sent product from $_POST     
      recreateProduct('#recreation-container', <?php echo stripslashes($_POST['recreation_product']); ?>);

      function recreateProduct(container, product) {

        //converts hex colors ro rgb
        var _HexToR = function(h) {return parseInt((_cutHex(h)).substring(0,2),16)};
        var _HexToG = function(h) {return parseInt((_cutHex(h)).substring(2,4),16)};
        var _HexToB = function(h) {return parseInt((_cutHex(h)).substring(4,6),16)};
        var _cutHex = function(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h};
        
        var $container = $(container).addClass('fpd-recreation');

        for(var i=0; i < product.length; ++i) {
          $container.append('<div></div>');
          _createSingleProduct($container.children('div:last'), product[i]);
        }
        
        function _createSingleProduct($productContainer, product) {
          //loop through all elements
          for(var i=0; i < product.elements.length; ++i) {
          
            var element = product.elements[i],
              elementParameters = product.elements[i].parameters;
            
            
            //create text
            if(elementParameters.text) {
              
              $productContainer.append('<span>'+elementParameters.text+'</span>')
              .children('span:last').css({left: elementParameters.x, top: elementParameters.y, 'z-index': elementParameters.z, 
                            color: elementParameters.currentColor, 'fontFamily': elementParameters.font, 'fontSize': elementParameters.textSize});
                            
              _rotateElement($productContainer.children('span:last'), elementParameters.degree);              
            }
            //create canvas 
            else if(elementParameters.currentColor) {
              
              var image = new Image();
              image.src = element.source;
              $(image).data('params', elementParameters);
              image.onload = function() {
                var canvas = document.createElement('canvas'), canvasContext = canvas.getContext('2d'),
                  params = $(this).data('params');
                canvas.width = this.width;
                canvas.height = this.height;
                canvasContext.drawImage(this, 0, 0);
                var imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);
                  var data = imageData.data;
                  for (var j = 0; j < data.length; j += 4) {
                      data[j] = _HexToR(params.currentColor);
                      data[j + 1] = _HexToG(params.currentColor);
                      data[j + 2] = _HexToB(params.currentColor);
                  }
                  // overwrite original image
                  canvasContext.putImageData(imageData, 0, 0);
                $productContainer.append(canvas);
                $(canvas).width(params.width).height(params.height).css({left: params.x, top: params.y, 'z-index': params.z});
                
                _rotateElement($productContainer.children('canvas:last'), params.degree);
              }
              
            }
            //create just an image
            else {
              $productContainer.append('<img src="'+element.source+'" width='+elementParameters.width+' height='+elementParameters.height+' /><input="'+element.source+'">')
              .children('img:last').css({left: elementParameters.x, top: elementParameters.y, 'z-index': elementParameters.z});
              
              _rotateElement($productContainer.children('img:last'), elementParameters.degree);
            }
            
            
            
          }
        };
        
        function _rotateElement(elem, degree) {
          //set a degree
          if(degree) {
            elem.css('-moz-transform', 'rotate('+degree+'deg)');
                elem.css('-webkit-transform', 'rotate('+degree+'deg)');
                elem.css('-o-transform', 'rotate('+degree+'deg)');
                elem.css('-ms-transform', 'rotate('+degree+'deg)');
          }
        };
        
      };
  
    });



$(document).ready(function() {
  
    $('#test').on('click',function() {
    alert('fdsf');
    


 html2canvas( document.body, {
          onrendered: function(canvas) {
            //document.body.appendChild(canvas);
              document.getElementById('new_canvas').appendChild(canvas);
          }
        });

   /* var newabc = $('#recreation-container');
    html2canvas(document.body, {
    onrendered: function(canvas) {
    document.getElementById('new_canvas').appendChild(canvas);
    },
    width: 300,
    height: 300
    });
*/


  });

});
    </script>
  </head>
  <body> 
  
<div id="recreation-container">
</div>  
  

<div id="new_canvas">
  
</div>
<br>
<!-- <div  id="test" class="btn" >CLICK</div> -->
  <!--  -->
 

  </body>
</html>
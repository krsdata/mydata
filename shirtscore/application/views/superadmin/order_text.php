<link href="<?php echo base_url() ?>assets/front_theme/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/pdf.css" rel="stylesheet" type="text/css"/>
<?php 

        if (!empty($order_info)){ ?>
        <?php $ii=1; foreach ($order_info as $row){    
                $cart_detail = json_decode($row->cart_detail);
                   if(!empty($cart_detail->options->Product_id)) 
                       $custom_uplaod_img=get_custom_uplaod_img_from_product($cart_detail->options->Product_id); 
                if(!empty($custom_uplaod_img)){
                        $texts=unserialize($custom_uplaod_img->texts);
                        if(!empty($texts) && is_array($texts)){
                        	
                foreach ($texts as $row2) {
                	?>
                	<?php //echo $row2['text']?>
                	<table class="table5" style="background: rgb(235, 232, 232);"  border="0" cellspacing="10" cellspacing="10">
    					<tr>
    					<td style="font-size: <?php echo $row2['textSize']?>px;color: <?php echo $row2['color']?>;font-family: <?php echo $row2['font']?>;" width="50%">
                             <?php echo $row2['text']?></td>
                             <td>
                             <?php
                            echo '<strong>Text</strong>'." : ".$row2['text']; 
                            echo "<br>";
                            echo '<strong>Text Size</strong>'." : ".$row2['textSize']."px";
                            echo "<br>";
                            echo '<strong>Font</strong>'." : ".$row2['font'];
                            echo "<br>";
                            echo '<strong>Color</strong>'." : ".$row2['color'];
                            
                             ?></td></tr></table>
                            
                             <?php
                          }

                    }
                }
            }
        }
             ?>
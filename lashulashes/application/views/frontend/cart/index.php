<?php 
    if($this->session->userdata('purchase_type'))
    {
        $purchase_type = $this->session->userdata('purchase_type');
    }
    else
    {
        $purchase_type ='';
    }

    if(empty($poPupMsg))
    {
        $poPupMsg = 0;
    }

?>

<section id="page_content" class="cart_content">
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <p class="page_head margin_cutter">Your Shopping Cart</p>
            </div>
        </div>
        <div class="row cart_row3 row_gap">
            <div class="col-xs-12 col-sm-12 col-md-12"><?php echo msg_alert_frontend(); ?></div>
            <div class="col-xs-12 col-sm-8 col-md-8">
                <?php if($this->cart->contents()) { ?>
                    <form action="<?php echo base_url('cart/update')?>" method="post">
                        
                        <table>
                            <thead>
                                <tr>
                                    <td>
                                        <?php 
                                        if($purchase_type=='product') {
                                            echo 'Item';
                                        }
                                        if($purchase_type=='services')
                                        {
                                            echo 'Services';
                                        }
                                        if($purchase_type=='training')
                                        {
                                            echo 'Training';
                                        }
                                        ?>
                                    </td>
                                    <?php if($purchase_type=='product') { ?>
                                    <td>Quantity</td>
                                    <?php } else { ?>
                                    <td>Booking</td>
                                    <?php } ?>
                                    <td>price</td>
                                    <td>total</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($this->cart->contents() as $items): ?>
                                        <input type="hidden" name="<?php echo $i.'[rowid]'; ?>" value="<?php echo $items['rowid']; ?>">
                                        <tr>
                                            <td>
                                                <div class="product_thumb">
                                                    <?php if($purchase_type=='product') { ?>
                                                        <span><img src="<?php echo $items['image'];?>"></span>
                                                        <span>
                                                            
                                                            Name : <?php echo $items['name']; ?><br>
                                                            <?php if($items['type']!='Simple') 
                                                            {
                                                                $variation_detail_array = json_decode($items['variation_detail']);
                                                                if(count($variation_detail_array[0])== $items['variation_length'] )
                                                                {
                                                                    for ($m=0; $m < $items['variation_length'] ; $m++) 
                                                                    { 
                                                                        echo $variation_detail_array[0][$m][1] .' : ' .$variation_detail_array[1][$m][1].'<br>';
                                                                    }
                                                                }

                                                            } ?>
                                                        </span>
                                                    <?php } else if($purchase_type=='services') { ?>
                                                        <p>
                                                            Artist : <?php echo $items['artist_name']; ?><br>
                                                            Treatment Type : <?php if(isset($items['service_name'])&&!empty($items['service_name'])){ echo $items['service_name'].' - '; } ?>  <?php echo $items['name']; ?><br>
                                                            Date : <?php echo date('d M Y',strtotime($items['date'])); ?><br>
                                                            Time : <?php echo $items['timeSlot']; ?><br>
                                                           

                                                        </p>
                                                    <?php } else if($purchase_type=='training') { ?>
                                                        <div style="padding-left: 15px;">
                                                            <h2 class="date">Title : <?php echo $items['name']; ?></h2>
                                                            <p style="padding-left: 15px; font-size: 14px;">
                                                                <?php echo date('d-M-Y',strtotime($items['start_date'])); ?> To <?php echo date('d-M-Y',strtotime($items['end_date'])); ?><br>
                                                                <?php echo $items['timing']; ?><br>
                                                                Category : <?php echo $items['category_name']; ?><br>
                                                                Location : <?php echo $items['state']; ?>
                                                            </p>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- <div class="clerfix"></div> -->
                                                </div>
                                            </td>
                                            <td align="center" style="vertical-align: middle;">
                                                <?php if($purchase_type=='product') { ?>
                                                    <input type="number" name="<?php echo $i.'[qty]'?>" value="<?php echo $items['qty']; ?>" min="1" max="999" style="width:50px;">
                                                <?php } else { ?>
                                                    <label> <?php echo $items['qty']; ?> </label>
                                                <?php } ?>
                                            </td>
                                            <td align="center" style="vertical-align: middle;" ><?php echo '$'.$this->cart->format_number($items['price']); ?></td>
                                            <td align="center" style="vertical-align: middle;">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                            <td align="center" style="vertical-align: middle;">
                                                <a href="<?php echo base_url('cart/remove/'.$items['rowid'])?>" title="Remove" onclick="return confirm('Are you sure want to remove ?');"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>

                                <?php $i++; ?>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                        <div class="row cart_links margin_top_20">
                            <div class="col-xs-12 col-sm-12 col-md-12 ">
                                <?php 
                                if($purchase_type=='product') { ?>
                                    <a href="<?php echo base_url('product')?>">Continue Shopping <i class="fa fa-cart-plus"></i></a>
                                <?php } 
                                if($purchase_type=='services') { ?>
                                    <a href="<?php echo base_url('service/booking')?>">Continue Booking <i class="fa fa-cart-plus"></i>
                                    </a> &nbsp;
                                <?php } 
                                if($purchase_type=='training') { ?>
                                    <a href="<?php echo base_url('training/calendar')?>">Continue Booking <i class="fa fa-cart-plus"></i>
                                    </a> &nbsp;
                                <?php } ?>

                                <?php 
                                if($purchase_type=='product') { ?> 
                                    <button type="submit" class="btn-pink">Update your Cart <i class="fa fa-thumbs-o-up"></i></button>
                                <?php } ?>

                                <a href="<?php echo base_url('cart/empty_cart')?>" onclick="return confirm('Are you sure want to empty cart?');">Empty Cart <i class="fa fa-trash-o"></i></a>
                            </div>
                        </div>

                    </form>

                <?php } else { ?>

                    <div class="alert alert-info">
                        Your cart is empty please select products. <a href="<?php echo base_url('product'); ?>" class="form_carot">Click here..</a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="cart_total">
                    <!-- <p class="section_head_20"></p> -->
                    <table>
                        <thead>
                            <tr>
                                <td>Order Summary</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>Total </td>
                                <td>$175</td>
                            </tr>  -->
                            <tr>
                                <td>Gross Total</td>
                                <td>$<?php echo $this->cart->format_number($total); ?></td>
                            </tr>
                            <!-- <tr>
                                <td>GST (Goods & Services Tax)</td>
                                <td>$<?php //echo $this->cart->format_number($gst); ?></td>
                            </tr>  -->                          
                            <!-- <tr>
                                <td>Shipping</td>
                                <td>$<?php //echo $this->cart->format_number($shipping); ?></td>
                            </tr>
                            <tr>
                                <td>Coupon Discount</td>
                                <td>$<?php //echo $this->cart->format_number($coupon_discount); ?></td>
                            </tr> -->
                            <tr>
                                <td><strong>Grand Total</strong></td>
                                <td><strong>$<?php echo $this->cart->format_number($total); ?></strong></td>
                            </tr>                                                    
                        </tbody>
                    </table>
                </div>
                <div class="row cart_links margin_top_20">
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <?php if($this->cart->contents()) { ?>
                            <?php 
                            if($purchase_type == 'product') { ?> 
                                <a href="<?php echo base_url('cart/checkout');?>" class="pull-right">Proceed to Checkout <i class="fa fa-hand-o-right"></i></a>
                            <?php }
                            if($purchase_type == 'services') { ?>
                                <a href="<?php echo base_url('service/checkout');?>" class="pull-right">Proceed to Checkout <i class="fa fa-hand-o-right"></i></a>
                            <?php } 
                            if($purchase_type == 'training') { ?>
                                <a href="<?php echo base_url('training/checkout');?>" class="pull-right">Proceed to Checkout <i class="fa fa-hand-o-right"></i></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
               <!-- <div class="promo_code_container margin_top_30">
                    <div class="promo_code_pop">
                        <p class="">Promocode Coupon!</p>
                        <form action="" name="promocode_form" method="post" class="margin_top_30">
                            <input type="text" name="" placeholder="Enter your Promocode">
                            <?php //if($this->cart->contents()) { ?>
                                <input type="submit" value="submit" class="">
                            <?php //} ?>
                        </form>
                    </div>
                </div>   -->             
            </div>
        </div>
    </div>
</section>
<script>
        window.onload = function() {
            $("form").bind("keypress", function(e) {
                if (e.keyCode == 13) {
                    return false;
                }
            });
        }
</script>

<?php
    if($poPupMsg){ ?>
            <div class="modal fade" id="poPupMsgModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Membership Alert</h4>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $poPupMsg; ?></p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                    $(document).ready(function() {
                        $("#poPupMsgModal").modal('show');
                    });
            </script>
    <?php }
?>

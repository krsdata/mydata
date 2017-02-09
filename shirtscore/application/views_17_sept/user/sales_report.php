<div class="clearfloat"></div>
  <div class="dashcontent">
    <div class="dashbox">
      <div class="span12 row-fluid">
        <div class="span6">
          <h2>Sales Report</h2>
        </div>
        <div class="dashicon pull-right span6">
          <i class="icon-gift icon-large"></i>&nbsp;&nbsp; Items Sold: <?php if(($sales_history == TRUE) && (!empty($sales_history->qty))){ echo $sales_history->qty; }else{echo '0';}?>&nbsp;&nbsp;&nbsp;&nbsp;
          <i class="icon-money icon-large"></i>&nbsp;&nbsp; Commission:</span> <?php if(($commission_info == TRUE) && (!empty($commission_info->total_paid_com))){?> <?php echo money_symbol(); ?><?php echo number_format($commission_info->total_paid_com, 2); }else{echo '0.00';}?>
        </div>
      </div>
      <hr color="#ccc" />
      <p>&nbsp;</p>
      <?php if($this->session->flashdata('error_msg')){ ?>
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error :</strong><br><?php echo $this->session->flashdata('error_msg'); ?>
          </div>
      <?php } ?>

      <?php if($this->session->flashdata('success_msg')){ ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info :</strong><br><?php echo $this->session->flashdata('success_msg'); ?>
        </div>
      <?php } ?>
        <div class="row-fluid span12">
          <div class="span6">
            <h4>Current Quarter Sales</h4>
          </div>
          <div class="span6">
              <form class="form-search pull-right" style="margin-right: 26px;">
                    List as
                    <select id="list_by" class="chzn-select" name="list_by">
                      <option value="0" <?php if($list_by == 0){echo 'selected="selected"';} ?>>Unpaid</option>
                      <option value="1" <?php if($list_by == 1){echo 'selected="selected"';} ?>>Paid</option>
                    </select>
              </form>
          </div>
        </div>
              <table width="100%" border="0" cellpadding="4px">
                  <tr align="left" style="color:#3b5998;" bgcolor="#edf0f5">
                      <th scope="col">Date</th>
                      <th scope="col">Time</th>
                     <!--  <th scope="col">Order Number</th> -->
                      <th scope="col">Design ID</th>
                      <th scope="col">Retail Cost</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Shipping</th>
                      <th scope="col">Commission</th>
                  </tr>
                  <?php 
                      $total_d_sales = 0;
                      $sales_qty = 0;
                      $total_shipping = 0;
                      $total_com = 0;
                  ?>
                  <?php //print_r($sales);
                  if ($sales): ?>
                      <?php foreach ($sales as $row): ?>
                        <tr>
                          <td><?php if(!empty($row->created)){echo date('m/d/Y',strtotime($row->created));}?></td>
                          <td><?php if(!empty($row->created)){echo date('g:i A',strtotime($row->created));}?></td>
                          <!-- <td><?php if(!empty($row->od_id)){echo $row->od_id;}?></td> -->
                          <td><?php if(!empty($row->design_id)){echo $row->design_id;}?></td>
                          <td><?php if(!empty($row->total)){$total_d_sales += $row->total; ?>
                            <?php echo money_symbol(); ?><?php echo number_format($row->total, 2);}?></td>
                          <td><?php if(!empty($row->qty)){$sales_qty += $row->qty; ?><?php echo $row->qty;}?></td>
                          <td><?php if(!empty($row->total)){ $total_shipping += 4.95; ?> 
                            <?php echo money_symbol(); ?><?php echo number_format('4.95', 2);} ?></td>
                          <td><?php if(!commission_rate()){ echo "N/A"; }else{ if(!empty($row->qty)){$com = ($row->qty * commission_rate()); $total_com += $com; ?> <?php echo money_symbol(); ?><?php echo number_format($com, 2);}}?></td>
                        </tr>
                     <?php endforeach; ?>
                        <?php /*                      
                        <tr>
                          <td colspan="7"> <hr style="margin:0;" color="#ccc" /></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td><?php if($total_d_sales != 0){?> <?php echo money_symbol(); ?><?php echo number_format($total_d_sales, 2);} ?></td>
                          <td><?php if($sales_qty != 0){?> <?php echo $sales_qty;} ?></td>
                          <td><?php if($total_shipping != 0){ ?> <?php echo money_symbol(); ?><?php echo number_format($total_shipping, 2);} ?></td>
                          <td><?php if($total_com != 0){ ?> <?php echo money_symbol(); ?><?php echo number_format($total_com, 2);} ?></td>
                        </tr>
                        */ ?>
                        <?php if ($pagination) { ?>
                        <tr>
                          <td><?php echo $pagination; ?></td>
                        </tr>
                        <?php } ?>
                  <?php else: ?>
                      <tr>
                        <td colspan="7" style="text-align:center">No Records Found</td>
                      </tr>
                  <?php endif ?>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                    <tr>
                    <td><h4>Sales History</h4></td>
                    </tr>
                    <tr align="left" style="color:#3b5998;" bgcolor="#edf0f5">
                      <th scope="col">Total Orders</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col">Retail Cost</th>
                      <th scope="col">Total Quantity</th>
                      <th scope="col">Shipping</th>
                      <th scope="col">Commission Earned</th>
                    </tr>
                    <tr>
                      <td><?php if(!empty($total_orders)){ echo $total_orders; }?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><?php if($total_d_sales != 0){?> <?php echo money_symbol(); ?><?php echo number_format($total_d_sales, 2);} ?></td>
                      <td><?php if($sales_qty != 0){?> <?php echo $sales_qty;} ?></td>
                      <td><?php if($total_shipping != 0){ ?> <?php echo money_symbol(); ?><?php echo number_format($total_shipping, 2);} ?></td>
                      <td><?php if($total_com != 0){ ?> <?php echo money_symbol(); ?><?php echo number_format($total_com, 2);} ?></td>
                    </tr>
                    <?php /*
                    <tr>
                      <td><?php if(!empty($total_orders)){ echo $total_orders; }?></td>
                      <td><?php if(!empty($sales_history->total)){ ?> 
                        <?php echo money_symbol(); ?><?php echo $sales_history->total; }?></td>
                      <td><?php if(!empty($total_orders)){  ?>
                        <?php echo money_symbol(); ?><?php echo number_format(($total_orders * 4.95), 2); }?></td>
                      <td> <?php if(($commission_info == TRUE) && (!empty($commission_info->total_paid_com))){ ?> <?php echo money_symbol(); ?><?php echo number_format($commission_info->total_paid_com, 2); }else{echo '0.00';}?></td>
                      <td> <?php if(($commission_info == TRUE) && (!empty($commission_info->unpaid_com))){ ?> <?php echo money_symbol(); ?><?php echo number_format($commission_info->unpaid_com, 2); }else{echo 'Not Requested Yet';}?></td>
                    </tr>
                    */ ?>
                        <?php
                            $rate = commission_rate();
                            $qty = user_commission(customer_id());
                            $commission = $rate * $qty;
                               if($commission > 25){ 
                        ?>
                                <?php 
                                  $arr = commission_info();
                                  if ($arr) {
                                    if (!empty($arr->paypal_fee))
                                      $pay_pal_fee = number_format( $arr->paypal_fee, 2);
                                    else
                                      $pay_pal_fee = number_format( '5.00', 2);

                                    if (!empty($arr->mailed_check_fee))
                                      $mailed_check_fee = number_format( $arr->mailed_check_fee, 2);
                                    else
                                      $mailed_check_fee = number_format( '8.00', 2);
                                  }
                                ?>
                                <tr>
                                  <td> <a class="btn" href="<?php echo base_url().'user/pay_request/' ?>" onclick="return confirm('There will be a fee associated with payments on demand. <?php echo money_symbol().$mailed_check_fee; ?> for a mailed check and <?php echo money_symbol().$pay_pal_fee; ?> for pay pal transfer. Do u want to Continue?');"  > Pay Request </a>
                                </tr>
                        <?php
                               }
                        ?>
              </table>

              
              <br><br>
              <div class="row-fluid">
                <div class="span4"></div>
                <div class="span8">
                 <div class="text-center">
                   <h5>Sales report by month, day or quarter...</h5>
                 </div>
                 <?php echo form_open(current_url(), array('class'=>'form-search pull-right', 'id' => 'list-form', 'style' => 'margin-bottom:270px ! important;')); ?>
                    From <input type="text" id="from_date" name="from_date" class="input-medium search-query" value="<?php echo $from_date; ?>" readonly> 
                    TO <input type="text" id="to_date" name="to_date" class="input-medium search-query" value="<?php  echo $to_date; ?>" readonly>
                    <input type="hidden" id="list_submit" name="list_by" value="<?php echo $list_by; ?>">
                    <input type="hidden" id="is_clicked" name="is_clicked" value="0">
                    <button type="submit" id="filter" class="btn btn-primary">Filter</button>
                 <?php echo form_close(); ?>
                </div>
              </div>
    </div>
</div>
<style type="text/css" media="screen">
	.designboxFoot span{
		color:green;
	}
	.coversation{
		padding: 15px;
	}
	.designboxFoot{
		border-radius: 5px 5px 5px 5px;
    	padding: 10px;
		height: 100px;
		float: left;
		background: none repeat scroll 0 0 #FFFFFF;
	}
	 .color-white{
    padding-left: 10px;
     background-color:#ffffff !important;
      border-radius:5px;
      padding: 15px;
   }
   .msg_top{
    padding:10px;
    color:#808080
   }
   .sales_text td{
    text-align:center;
   }
</style>
<script type="text/javascript">

  $(document).ready(function() {
      $("#filter").on('click', function(event) {
          $("#is_clicked").val(1);
          // return false;
      }); 

      $("#list_by").on('change', function(event) {
          var list = $("#list_by").val();
          $("#list_submit").val(list);
          $( "#list-form" ).submit();
      });
  });

</script>
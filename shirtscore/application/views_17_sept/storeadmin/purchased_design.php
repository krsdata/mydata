<div class="clearfloat"></div>
  <div class="dashcontent">
    <div class="dashbox">
      <h2>User Shopping Report</h2>
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
          <h4>Purchased Design</h4>
              <table width="100%" border="0" cellpadding="10px">
                  <tr align="left" style="color:#3b5998;" bgcolor="#edf0f5">
                      <th scope="col">#</th>
                      <th scope="col">Image</th>
                      <th scope="col">Title</th>
                      <th scope="col">Design ID</th>
                      <th scope="col">Order ID</th>
                      <th scope="col">Retail Cost</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Total</th>
                      <th scope="col">Date</th>
                  </tr>
                  <?php if ($user_purcahses): ?>
                      <?php 
                          $total_qty = 0;
                          $total_sales_cost = 0;
                          $grant_total = 0;
                       ?>
                      <?php $i=1; foreach ($user_purcahses as $row): ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td>
                            <?php if(!empty($row->design_image)){ ?>
                                <img src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>" style="width: 50%;" />
                            <?php } ?>
                          </td>
                          <td><?php if(!empty($row->design_title)){ echo $row->design_title;}?></td>
                          <td><?php if(!empty($row->design_id)){echo $row->design_id;}?></td>
                          <td><?php if(!empty($row->order_id)){echo $row->order_id;}?></td>
                          <td><?php if(!empty($row->price)){ $total_sales_cost+=$row->price; ?> <?php echo money_symbol(); ?><?php echo number_format($row->price, 2);}?></td>
                          <td><?php if(!empty($row->qty)){ $total_qty+=$row->qty; echo $row->qty;}?></td>
                          <td><?php if(!empty($row->total)){ $grant_total+=$row->total; ?> <?php echo money_symbol(); ?><?php echo number_format($row->total, 2);}?></td>
                          <td><?php if(!empty($row->created)){echo date('m/d/Y',strtotime($row->created));}?></td>
                        </tr>
                     <?php endforeach ?>
                        <tr>
                          <td colspan="9"> <hr style="margin:0;" color="#ccc" /></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td><?php if($total_sales_cost != 0){  ?> <?php echo money_symbol(); ?><?php echo number_format($total_sales_cost, 2);} ?></td>
                          <td><?php if($total_qty != 0){ echo $total_qty;} ?></td>
                          <td><?php if($grant_total != 0){ ?> <?php echo money_symbol(); ?><?php echo number_format($grant_total, 2);} ?></td>
                        </tr>
                        <?php if ($pagination) { ?>
                        <tr>
                          <td><?php echo $pagination; ?></td>
                        </tr>
                        <?php } ?>
                  <?php else: ?>
                      <tr>
                        <td colspan="9" style="text-align:center">No Records Found</td>
                      </tr>
                  <?php endif ?>
              </table>
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
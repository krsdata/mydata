<div class="clearfloat"></div>
  <div class="dashcontent">
    <div class="dashbox">
      <h2>Orders</h2>
      <!-- <hr color="#ccc" /> -->
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
          <h4>Purchase History</h4>
              <table width="100%" border="0" cellpadding="5px">
                  <tr align="left" style="color:#3b5998;" bgcolor="#edf0f5">
                      <th scope="col">Date</th>
                      <th scope="col">Time</th>
                      <th scope="col">Order Number</th>
                      <th scope="col">Amount</th>
                      <th scope="col">View Detail</th>
                  </tr>
                  <?php if ($orders): ?>
                      <?php $total_cost = 0.00; foreach ($orders as $row): ?>
                        <tr>
                          <td><?php if(!empty($row->created)){echo date('jS M Y',strtotime($row->created));}?></td>
                          <td><?php if(!empty($row->created)){echo date('g:i A',strtotime($row->created));}?></td>
                          <td><?php if(!empty($row->order_id)){echo $row->order_id;}?></td>
                          <td><?php if(!empty($row->total_amount)){money_symbol(); echo number_format($row->total_amount, 2); $total_cost+=$row->total_amount;}?></td>
                          <td>
                            <div class="btn-group"> 
                              <a href="<?php echo base_url() ?>storeadmin/order_info/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="See Order Info"><i class="icon-eye-open"></i></a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach ?>
                        <tr>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                        </tr>
                        <tr align="left" style="color:#3b5998;" bgcolor="#edf0f5">
                            <th scope="col" colspan="3">Total Purchase</th>
                            <th scope="col" colspan="3"><?php money_symbol(); echo $total_cost; ?></th>
                        </tr>
                        <?php if ($pagination) { ?>
                        <tr>
                          <td><?php echo $pagination; ?></td>
                        </tr>
                        <?php } ?>
                  <?php else: ?>
                      <tr>
                        <td></td>
                        <td style="text-align:center">No Records Found</td>
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
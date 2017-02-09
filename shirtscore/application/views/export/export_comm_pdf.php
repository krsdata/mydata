<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shirtsscore</title>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/theme/css/export_pdf_style.css">
</head>
<body>

<div id="container">
	<h1> Commissions Requested by users</h1>

	<div id="body">
			<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th style="vertical-align: top;">#</th>
                    <th style="vertical-align: top;">User</th> 
                    <th style="vertical-align: top;width:35%">
                    Account Number<br>
                    Account Holder<br>
                    Bank Name<br>
                    Account Type<br>
                    Routing Number<br>
                    </th>    
                    <th style="vertical-align: top;">Balance Amount<br> Requested</th>
                    <th style="vertical-align: top;">Commission <br>Earned</th>      
                    <th style="vertical-align: top;">Requested On</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php 

                if($pay_request){ $i = 1; foreach($pay_request as $row){ ?> 
                <tr>
                <td><?php echo $i?>.</td>
                <td><?php echo $row->firstname.' '.$row->lastname ?></td>
                <td>
                <?php echo  $row->acc_no?><br>
                <?php echo  $row->acc_holder?><br>
                <?php echo  $row->bank_name?><br>
                <?php $info=$row->acc_type;
                    if($info==1)
                      {
                        echo"Saving";
                        }
                        else{
                        echo"Checking";
                          }?> Account<br>
                 <?php echo  $row->routing_no?>
                </td>
               
                <td style="text-align:center;">$<?php echo number_format($row->unpaid_com, 2); ?></td>
                <td style="text-align:center;">$<?php echo number_format($row->total_paid_com, 2); ?></td>
                <td>
                  <?php echo $row->request_date; ?>
                </td>
              </tr>
                <?php $i++; } ?>
                <?php  } else { ?>
                <tr>
                  <td colspan="6" style="text-align: center;font-style: italic;"><h3>No Requests found.</h3></td>
                </tr>
                <?php } ?>
                </tbody>
              </table>		
	</div>

	<div class="footer">
		
			<a href="<?php echo base_url() ?>">Shirtscore.com</a>
		
	</div>
</div>

</body>
</html>
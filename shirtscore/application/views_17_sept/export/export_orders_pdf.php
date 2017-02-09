<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shirtsscore</title>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/theme/css/export_pdf_style.css">
</head>
<body>

<div id="container">
	<h1> ORDERS - From <?php  if(isset($from_date)) echo date('m/d/Y',strtotime( $from_date)); ?> To <?php if(isset($to_date)) echo date('m/d/Y',strtotime( $to_date)); ?></h1>

	<div id="body">
			<table width="100%" cellpadding="2" cellspacing="0" border="0">			
			<thead>
				<tr>
					
					<th width="15%" align="left">Order Id</th>				
					<th width="10%" align="">Date</th>
					<th width="10%" align="">Status</th>					
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($orders)): ?>
                        <?php 
         				foreach ($orders as $row): ?>                         
                    <tr>
                        <td align="left"><?php echo $row->order_id ?></td>                        
                        <td align="left"><?php echo  date('m/d/Y', strtotime($row->created)); ?></td>                        
                        <td align="left"><?php echo $row->order_status ?></td>                        
                    </tr>                    
                    <?php endforeach; ?>                    
                    <?php else: ?>
                    <tr>
                        <td colspan="9"> <center><strong>NO orders Found.</strong></center></td>   
                    </tr>

                    <?php endif; ?>  
			</tbody>
		</table>		
	</div>

	<div class="footer">
		
			<a href="<?php echo base_url() ?>">Shirtscore.com</a>
		
	</div>
</div>

</body>
</html>
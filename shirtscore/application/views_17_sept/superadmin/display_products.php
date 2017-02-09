

    <div id="main_container">
      <div class="row-fluid ">     	

        
          <div class="box paint color_0">       	


            <div class="title">

              <h4> <i class=" icon-user"></i> <span> Products of <?php if ($type == 'month'){ ?>
                   Month- <?php echo $month; ?>
              <?php }elseif($type=="year"){ echo "year - ".$year; } ?> </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>
                    <th>Image</th>         
          					<th>Product Name</th>					
          					<th>Created</th>
          					<!-- <th style="text-align:center">Control</th>			 -->
          					<!-- <th>Edit</th>
          					<th>Delete</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php if($products){ $i = $offset; foreach($products as $row){ ?>	
                <tr>
                  <td><?php echo $i ?></td>
        					<td><?php if(!empty($row->main_image)): ?>
                    <img src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->main_image; ?>">
                  <?php else: echo "NA"; endif; ?>
                  </td>
        					<td><?php echo $row->regular_name ?></td>					
        					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>																
				        </tr>
                  
                 	<?php $i++; } } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Products found yet</h3></td>
					</tr>
					<?php } ?>	
						
                </tbody>
              </table>
              <div class="row-fluid ">
             
               
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
              </div>
            </div>
            <!-- End row-fluid --> 
          </div>
          <!-- End .content --> 
        </div>
        <!-- End box --> 
      </div>
      <!-- End .span12 --> 
    </div>  
    <style type="text/css">
    #datatable_example tbody tr td a{
    	color: white;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function(){
      $('#m_wise').hide();
      $('#y_wise').hide();      
    });

    $('#select_type').change(function(){

      var type = $(this).val();
       // alert(type);
      if(type == ''){
        $('#m_wise').hide();
        $('#y_wise').hide();
        // return;
      }
      if(type == 'month'){
        $('#y_wise').hide();
        $('#m_wise').show();
      }
      if(type == 'year'){
         $('#m_wise').hide();
        $('#y_wise').show();
      }
    });
    </script>
    <div id="main_container">
      <div class="row-fluid ">     	
          <div class="box paint color_0">       	
            <div class="title">
              <h4> <i class=" icon-user"></i> <span> Products 
             
              <?php if ($type == 'month'){ ?>
                   Of Month - <?php echo $month." ".$year; ?>
              <?php }elseif($type=="year"){ echo "Of Year - ".$year; } ?> <a href="<?php echo base_url() ?>superadmin/add_product/" class="btn btn-info btn-mini" >Add Product</a> </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>
                    <th>Product Image</th>
          					<th>Product Name</th>					
          					<th>Created</th>
                    <th style="text-align:center">Options</th>

          					<th>View</th>	
                    <th>Print<br>Area</th>
                    <th>Edit</th>
                    <th>Delete</th>		          					
                  </tr>
                </thead>
                <tbody>
                <?php if($products){ $i = $offset; foreach($products as $row){ ?>	
                <tr>
					<td><?php echo $i ?></td>
          <td>
            <a href="<?php echo base_url().'superadmin/print_area/'.$row->id; ?>" title="Click to select print area.">
              <?php if (!empty($row->main_image)): ?>
              <img style="width:90px;height:80px;" src="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $row->main_image; ?>">
              <?php endif ?>
            </a>
          </td>
					<td><a class="btn" href="<?php echo base_url() ?>superadmin/product_info/<?php echo $row->id ?>"><?php echo $row->regular_name ?></a></td>					
					<td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>
          <td style="text-align:center">

              <a href="<?php echo base_url().'superadmin/colors/'.$row->id; ?>" title="Add colors"><span class="btn btn-info">colors</span></a>
             <!--  <a href="<?php// echo base_url().'superadmin/product_designs'?>" title="Link with design"><span class="btn btn-info">Designs</span></a> -->
             <?php if ($row->product_status == 0): ?>              
               <a href="<?php echo base_url().'superadmin/product_status/'.$row->id.'/1'; ?>" title="Click to Publish"><span class="btn btn-danger">Publish</span></a>           
             <?php else: ?>
            <a href="<?php echo base_url().'superadmin/product_status/'.$row->id.'/0'; ?>" title="Click to Unpublish"><span class="btn btn-success">Unpublish</span></a>                      
            <?php endif ?>
          </td>												
					<td style="text-align:center">
						<div class="btn-group"> 
  						<a href="<?php echo base_url() ?>superadmin/product_info/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Product"><i class="icon-eye-open"></i></a>
  					</div>
					</td>

          <td>
            <div class="btn-group">
            <a href="<?php echo base_url() ?>superadmin/print_area/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Print Area"><i class="icon-cut"></i></a>
          </div>
          </td>

          <td style="text-align:center">
            <div class="btn-group"> 
            <a href="<?php echo base_url() ?>superadmin/edit_product/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit product"><i class="icon-edit"></i></a>
          </div>
          </td>
          <td style="text-align:center">
            <div class="btn-group"> 
            <a href="<?php echo base_url() ?>superadmin/delete_product/<?php echo $row->id; ?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete product"><i class="icon-remove"></i></a>
            </div>
          </td>					
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

            <div class="row-fluid" style="margin:1%">
              <h2>Display Products</h2><br>
              <?php echo form_open(base_url().'superadmin/products'); ?>
              <input type="hidden" name="type" value="superadmin">
               <span style="margin-left:1%;">Select Type -  &nbsp;
                <select id="select_type" name="select">
                  <option value="-">Please select</option>
                  <option value="month" <?php if($type == 'month'){echo 'selected="selected"';} ?>>Month wise</option>
                  <option value="year" <?php if($type == 'year'){echo 'selected="selected"';} ?>>Year wise</option>
                </select>
               </span>

               <span id="m_wise">
               <span style="margin-left:1%;">Select Month -  &nbsp;
                <select id="select_type" name="month">
                  <option <?php if($month == 'january'){echo 'selected="selected"';} ?> value="january">January</option>                  
                  <option <?php if($month == 'february'){echo 'selected="selected"';} ?> value="february">February</option>                  
                  <option <?php if($month == 'march'){echo 'selected="selected"';} ?> value="march">March</option>                  
                  <option <?php if($month == 'april'){echo 'selected="selected"';} ?> value="april">April</option>                  
                  <option <?php if($month == 'may'){echo 'selected="selected"';} ?> value="may">May</option>                  
                  <option <?php if($month == 'june'){echo 'selected="selected"';} ?> value="june">June</option>                  
                  <option <?php if($month == 'july'){echo 'selected="selected"';} ?> value="july">July</option>                  
                  <option <?php if($month == 'august'){echo 'selected="selected"';} ?> value="august">August</option>                  
                  <option <?php if($month == 'september'){echo 'selected="selected"';} ?> value="september">September</option>                  
                  <option <?php if($month == 'october'){echo 'selected="selected"';} ?> value="october">October</option>                  
                  <option <?php if($month == 'november'){echo 'selected="selected"';} ?> value="november">November</option>                  
                  <option <?php if($month == 'december'){echo 'selected="selected"';} ?> value="december">December</option>                  
                </select>
               </span>
               <span style="margin-left:1%;">Year -  &nbsp;<input type="text" name="year" value="<?php if(!empty($year) && $year != '-'){echo $year;}else{echo date('Y');} ?>">                
               </span>
              <br><br>
              <span style="margin-left:10%;"><input type="submit" value="Submit" class="btn-info btn"></span>
              </span>
              <span id="y_wise">
                <span style="margin-left:1%;">Year -  &nbsp;<input type="text" name="year" value="<?php if(!empty($year) && $year != '-'){echo $year;}else{echo date('Y');} ?>">                
               </span>
              <br><br>
              <span style="margin-left:10%;"><input type="submit" value="Submit" class="btn-info btn"></span>
              </span>
              </div>
              <?php echo form_close(); ?>

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
      var type = $('#select_type').val();
      if (type == 'month')
      {
        // $('#m_wise').hide();
        $('#y_wise').hide();
      };
      if (type == 'year')
      {
        $('#m_wise').hide();
        // $('#y_wise').hide();
      };

      if (type == '-')
      {
        $('#m_wise').hide();
        $('#y_wise').hide();
      };
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
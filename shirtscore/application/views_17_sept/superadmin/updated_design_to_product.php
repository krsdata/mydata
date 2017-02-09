

    <div id="main_container">
      <div class="row-fluid ">
		<?php if(form_error('check')){ ?>
	    <div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error :</strong> <br> <?php echo form_error('check'); ?>
		</div>
		<?php } ?>
   

			

          <div class="box paint color_0">       	


            <div class="title">

              <h4> <i class=" icon-user"></i> <span> Update Designs </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
    
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>                    
                    <th class="no_sort"> # </th>
                    <th>Design</th>
                    <th>Design Title</th>
                    <th>Delete</th>
          					<!-- <th>Select/Deselect <input type="checkbox" name="check_all" id="check_all"> </th>	          					 -->
                  </tr>
                </thead>
                <tbody>
                <?php if($designs){ $i = 1; foreach($designs as $row){ ?>	
                <tr>
                  <td><?php echo $i ?></td>
                  <td>
                    <?php if (!empty($row->design_image)): ?>            
                    <img style="width:20%;" src="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $row->design_image; ?>">
                    <?php endif ?>

                  </td>
        					<td><?php echo $row->design_title ?></td>
                  <td><a href="<?php echo base_url() ?>superadmin/delete_product_designs/<?php echo $row->id.'/'.$row->product_id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete Design"><i class="icon-remove"></i></a></td>
        				</tr>
                <?php $i++; } ?>
                

                <tr>
                  <td colspan="7"><?php echo $pagination; ?></td>
                </tr>
               <?php } else { ?>
					<tr>
						<td colspan="7" style="text-align: center;font-style: italic;"><h3>No Designs found yet</h3></td>
					</tr>
					<?php } ?>	
						
                </tbody>
              </table>
          
            </div>
            <!-- End row-fluid --> 
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
    <!-- script type="text/javascript"> -->

   <!--  //  $(document).ready(function() {
    //     $("#check_all").change(function(){
          
    //       var status = $(this).attr("checked") ? "checked" : false;

    //       if(status)
    //       {
    //        $('.checker span').addClass("checked");
    //        $('.check_1').attr("checked",true);
    //       }
    //       else
    //       {
    //        $('.checker span').removeClass("checked");
    //        $('.check_1').attr("checked",false);
    //       }
    //     });

    //      $("#design_select").click(function(e){
    //       var count_check = 0;
    //       $(".check_1" ).each(function( index ) {
    //         var status = $(this).attr("checked") ? "checked" : false;
    //         if(status)
    //           count_check++;
    //       });

    //       if(count_check > 0){
    //         return true;
    //       }else{
    //         alert('Select at least 1 design.');
    //         return false;
    //       }
    //     });
    // }); -->
    <!-- </script> -->
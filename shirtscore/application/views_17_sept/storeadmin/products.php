<div class="dashcontent" style="margin:0px;">

    <div class="dashbox" style="min-height:340px">

      <div class="clearfloat"></div>

      <div class="dashcontent">

        <div class="dashbox">

            <?php if($this->session->flashdata('success_msg')){ ?>

            <div class="alert alert-success">

            <button type="button" class="close" data-dismiss="alert">&times;</button>

            <strong>Success :</strong> <br> <?php echo $this->session->flashdata('success_msg'); ?>

          </div>

          <?php } ?>



          <?php if($this->session->flashdata('error_msg')){ ?>

          <div class="alert alert-error">

          <button type="button" class="close" data-dismiss="alert">&times;</button>

          <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>

        </div>

        <?php } ?>



        <h4><span> Products </span></h4>

        <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">

                <thead>

                  <tr>                    

                    <th class="no_sort"> # </th>

                    <th>Product Image</th>

                    <th>Product Name</th>         

                    <th>Created</th>

                    <th>View</th> 

                    <!-- <th>Edit</th> -->

                    <th>Delete</th>                       

                  </tr>

                </thead>

                <tbody>

                <?php if($products){ $i = 1; foreach($products as $row){ ?> 

                <tr>

          <td><?php echo $i ?></td>

          <td>

            <?php if (!empty($row->main_image)): ?>            

            <img src="<?php echo base_url() ?>assets/uploads/custom_prod_img/thumbnail/<?php echo $row->main_image; ?>">

            <?php endif ?>

          </td>

          <td><a href="<?php echo base_url() ?>storeadmin/product_info/<?php echo $row->id ?>"><?php echo $row->regular_name ?></a></td>          

          <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>

         <!--  <td>



              <a href="<?php echo base_url().'storeadmin/colors/'.$row->id; ?>" title="Add colors"><span class="btn btn-info">colors</span></a> 



             <?php if ($row->product_status == 0): ?>              

            <a href="<?php echo base_url().'storeadmin/product_status/'.$row->id.'/1'; ?>" title="Click to Publish"><span class="btn btn-info">Publish</span></a>           

          <?php else: ?>

            <a href="<?php echo base_url().'storeadmin/product_status/'.$row->id.'/0'; ?>" title="Click to Unpublish"><span class="btn btn-info">Unpublish</span></a>                      

            <?php endif ?>

          </td>  -->                      

          <td>

            <div class="btn-group"> 

            <a href="<?php echo base_url() ?>storeadmin/product_info/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View Product"><i class="icon-eye-open"></i></a>

          </div>

          </td>

       

          <!-- <td>

            <div class="btn-group"> 

            <a href="<?php echo base_url() ?>storeadmin/edit_product/<?php echo $row->id; ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Edit product"><i class="icon-edit"></i></a>

          </div>

          </td> -->

          <td>

            <div class="btn-group"> 

            <a href="<?php echo base_url() ?>storeadmin/delete_product/<?php echo $row->id; ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete product"><i class="icon-remove"></i></a>

            </div>

          </td>         

        </tr>

                  

                  <?php $i++; } } else { ?>

          <tr>

            <td colspan="6" style="text-align: center;font-style: italic;"><h3>No Products found yet</h3></td>

          </tr>

          <?php } ?>  

            

                </tbody>

              </table>



            <div class="span12">

                <div class="pagination">

                  <?php echo $pagination; ?>

               </div >

            </div>



            <div class="row-fluid" style="margin:1%">

              <h2>Display Products</h2><br>

              <?php echo form_open(base_url().'storeadmin/display_products'); ?>

              <input type="hidden" name="type" value="storeadmin">

               <span style="margin-left:1%;">Select Type -  &nbsp;

                <select id="select_type" name="select">

                  <option value="">Please select</option>

                  <option value="month">Month wise</option>

                  <option value="year">Year wise</option>

                </select>

               </span>

               <br>
               <br>

               <span id="m_wise">

               <span style="margin-left:1%;">Select Month -  &nbsp;

                <select id="select_type" name="month">

                  <option value="january">January</option>                  

                  <option value="february">February</option>                  

                  <option value="march">March</option>                  

                  <option value="april">April</option>                  

                  <option value="may">May</option>                  

                  <option value="june">June</option>                  

                  <option value="july">July</option>                  

                  <option value="august">August</option>                  

                  <option value="september">September</option>                  

                  <option value="october">October</option>                  

                  <option value="november">November</option>                  

                  <option value="december">December</option>                  

                </select>

               </span>

               <span style="margin-left:1%;">Year -  &nbsp;<input type="text" name="year" value="<?php echo date('Y'); ?>">                

               </span>

              <br><br>

              <span style="margin-left:10%;"><input type="submit" value="Submit" class="btn-info btn"></span>

              </span>

              <span id="y_wise">

                <span style="margin-left:1%;">Year -  &nbsp;<input type="text" name="year" value="<?php echo date('Y'); ?>">                

               </span>

              <br><br>

              <span style="margin-left:10%;"><input type="submit" value="Submit" class="btn-info btn"></span>

              </span>

              </div>

              <?php echo form_close(); ?>

        </div>

      </div>      

    </div>

  </div>     

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
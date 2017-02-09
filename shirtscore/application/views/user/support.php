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
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Error :</strong> <br> <?php echo $this->session->flashdata('error_msg'); ?>
    </div>
    <?php } ?>
          <div class="title">
            <h4><span> My Queries </span> </h4>
            </div>
            <!-- End .title -->            
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr class="query">
                    <th class="no_sort"> # </th>          
                    <th>Subject</th>                
                    <th>Created</th>                          
                    <th>Status</th>     
                    <th>Conversation</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($supports){ $i = 1; foreach($supports as $row){ ?> 
                <tr class="query">
                  <td><?php echo $i ?></td>
                  <td><a href="<?php echo base_url() ?>user/view_query/<?php echo $row->id ?>"><?php echo $row->subject ?></a></td>         
                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>         
                 <td>
                    <?php if ($row->admin_replied == 0){ ?>
                    <span class="btn btn-danger">Pending</span>
                    <?php }else{ ?>
                      <span class="btn btn-success">Answered</span>
                    <?php } ?>          
                  </td>    
                  <td>
                    <div class="btn-group"> 
                    <a href="<?php echo base_url() ?>user/view_query/<?php echo $row->id ?>" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="icon-comments"></i></a>
                  </div>
                  </td>
                  <td>
                    <div class="btn-group"> 
                    <a href="<?php echo base_url() ?>user/delete_support/<?php echo $row->id ?>" onclick="return confirm('are you sure?');" class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="icon-trash"></i></a>
                    </div>
                  </td>
                </tr>                  
           <?php $i++; } } else { ?>
          <tr>
            <td colspan="7" style="text-align: center;font-style: italic;"><h3>No queries found yet</h3></td>
          </tr>
          <?php } ?>          
            </tbody>
              </table>              
                <div class="span12">
                  <div class="pagination pull-right ">
                   <?php echo $pagination; ?>
                  </div >
                </div>
            </div>
      </div>      
    </div>
  </div>

  <style type="text/css">
    .query td,.query th{
    text-align:center;
   }
  </style>
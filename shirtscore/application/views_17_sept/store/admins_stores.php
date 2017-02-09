<div class="container">
<div class="dashcontent">
	<div class="dashbox">
		<h2>Stores at ShirtScore</h2><br>

    <h4>Available stores</h4>
		<table class="table">
          <thead>
            <tr>
                <th>#</th>
                <th>Store Name</th>
                <th>Store Owner</th>
                <th>Store URL</th>
                <th>Opened On</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($stores){ ?>
                  <?php $i=1; foreach ($stores as $row){
                     ?>
                      <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php if(!empty($row->store_name)){echo $row->store_name;} ?></td>
                          <td><?php if(!empty($row->firstname)){echo $row->firstname.' ';} if(!empty($row->lastname)){echo $row->lastname;} ?></td>
                          <td> <a href="<?php if(!empty($row->store_link)){echo base_url().'shop/'.$row->store_link;}else{echo "#";} ?>"> <?php if(!empty($row->store_link)){echo base_url().'shop/'.$row->store_link;} ?> </a></td>
                          <td><?php if(!empty($row->created)){echo $row->created;} ?></td>
                      </tr>
                  <?php $i++; }  ?> 
            <?php }else{ ?>  
              <td colspan="5">Nothing found</td>
            <?php } ?>  
          </tbody>
        </table>
        <?php if($pagination){ ?>
          <div class="row-fluid ">
            <div class="span12">
              <div class="pagination pull-right ">
               <?php echo $pagination; ?>
              </div >
            </div>
          </div>
          <!-- echo $pagination; -->
       <?php } ?>
 </div>
</div>
<style type="text/css" media="screen">
	
  .table thead th, .table tbody td{
     text-align: center !important;
  }

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
  .colored-box{
      border: 1px solid #000000;
      height: 20px;
      left: 40px;
      position: relative;
      width: 20px;
  }
   .msg_top{
    padding:10px;
    color:#808080
   }
</style>
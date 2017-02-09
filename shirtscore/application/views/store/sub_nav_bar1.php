<?php
if(isset($sort) && !empty($sort)){
    if($sort==='newest') $active_sub_menu = 1;

    if($sort==='best-selling') $active_sub_menu = 2;
    
}else{
  $sort='newest';
  $active_sub_menu = 1;
}
?>
      <div class="row-fluid boxtopper">

            <div class="span5 products">
                <div class="row-fluid search-form">
                  <?php echo form_open_multipart(base_url().'store/available_products/'.$sort.'/'.$cat.'/'.$keyword ,array('class'=>'form-horizontal row-fluid')); ?>
                      <input type="text" name="search" value="<?php if(($keyword != '-') && !empty($keyword)){echo $keyword;}else{echo '';} ?>"  class="span8 input-large search-query" placeholder="Search Keywords">
                  <?php echo form_close(); ?>
                </div>
            </div>

           <!--  <div class="span1">
            </div> -->
           <div class="span6">

             <div id="sortby" class="navbar"> 

                  <ul class="nav">
                    <li><a href="#"><span class="neutra">Sort by:</span></a> </li>                              
                    <li <?php if($active_sub_menu == 1 ) echo "class='active'"; ?> ><a href="<?php echo base_url().'store/available_products/newest/'.$cat.'/'.$keyword; ?>">Newest</a></li>
                    <li <?php if($active_sub_menu == 2 ) echo "class='active'"; ?> ><a href="<?php echo base_url().'store/available_products/best-selling/'.$cat.'/'.$keyword; ?>">Best Selling</a></li>
                  </ul>

              </div><!-- /.navbar-inner -->

           </div><!-- span7 -->

      </div><!-- row-fluid -->

      <style type="text/css">
        .products{
          color: #8BC53F;
          font-size: 20px;
          margin-left: 2% !important;
          margin-top: 0.5% !important;
        }
        .search-query{
          margin-top: 1%; 
        }

      </style>
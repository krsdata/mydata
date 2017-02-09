<?php
// if(isset($_GET['category'])){
//   $category = $_GET['category'];
// }else{
//   $category = 'ALL';
// }
// if(isset($_GET['search'])){
//   $search = trim($_GET['search']);
// }else
//     $search = NULL;

if(isset($sort) && !empty($sort)){
    if($sort==='newest') $active_sub_menu = 1;

    if($sort==='best-selling') $active_sub_menu = 2;
        
    if($sort==='most-liked') $active_sub_menu = 3;
    
  }else{
    $sort='most-liked';
    $active_sub_menu = 3;
  }
?>
      <div class="row-fluid boxtopper">
            <div class="span5">
                <div class="row-fluid search-form">
                  <?php echo form_open_multipart(base_url().'store/designs/'.$sort.'/'.$cat.'/'.$keyword ,array('class'=>'form-horizontal row-fluid')); ?>
                      <input type="text" name="search" value="<?php if(($keyword != '-') && !empty($keyword)){echo $keyword;}else{echo '';} ?>"  class="span8 input-large search-query" placeholder="Search Keywords ex. Funny Shirts">
                  <?php echo form_close(); ?>
                </div>
            </div>

           <!--  <div class="span1">
            </div> -->
           <div class="span7">

             <div id="sortby" class="navbar"> 

                  <ul class="nav">
                    <li><a href="#"><span class="neutra">Sort by:</span></a> </li>                              
                    <li <?php if($active_sub_menu == 1 ) echo "class='active'"; ?> ><a href="<?php echo base_url().'store/designs/newest/'.$cat.'/'.$keyword; ?>">Newest</a></li>
                    <li <?php if($active_sub_menu == 2 ) echo "class='active'"; ?> ><a href="<?php echo base_url().'store/designs/best-selling/'.$cat.'/'.$keyword; ?>">Best Selling</a></li>
                    <li <?php if($active_sub_menu == 3 ) echo "class='active'"; ?> ><a href="<?php echo base_url().'store/designs/most-liked/'.$cat.'/'.$keyword; ?>">Most Liked</a></li>
                  </ul>

              </div><!-- /.navbar-inner -->

           </div><!-- span7 -->

      </div><!-- row-fluid -->

      <style type="text/css">
        .search-form{
          float: left; 
          /*text-align:center; */
          margin-left: 20px;
          width:95%;
        }
        .search-query{
          margin-top: 1%; 
        }

      </style>
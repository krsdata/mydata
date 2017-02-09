<?php
if(isset($_GET['sort_by']) && !empty($_GET['sort_by'])){
    $sort_by=trim($_GET['sort_by']);
    if($sort_by==='newest') $active_sub_menu = 1;
  }else{
    $active_sub_menu = 0;
  }
?>
      <div class="row-fluid boxtopper">

            <div class="span5">
                <div class="row-fluid search-form">
                  <form action="<?php echo base_url() ?>store/designs/">
                      <input type="text" name="search"  class="span8 input-large search-query" placeholder="Search Keywords">
                  </form>
                </div>
            </div>

           <!--  <div class="span1">
            </div> -->
           <div class="span7">

             <div id="sortby" class="navbar"> 

                  <ul class="nav">
                    <li><a href="#"><span class="neutra">Sort by:</span></a> </li>                              
                    <li <?php if($active_sub_menu == 1 ) echo "class='active'"; ?> ><a href="<?php echo base_url() ?>store/my_products/?sort_by=newest">Newest</a></li>
                  </ul>

              </div><!-- /.navbar-inner -->

           </div><!-- span9 -->

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
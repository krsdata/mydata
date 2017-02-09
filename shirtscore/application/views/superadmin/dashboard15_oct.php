
    <div id="main_container">
      <div class="row-fluid">
        <div class="span6 ">
        <div class="box color_3 title_big height_big paint_hover">
          <div class="title">
            <div class="row-fluid">
              <div class="span12">
                <h4> </i><span id="sales_report">Sales This Month</span> </h4>
              </div>
              <!-- End .span12 --> 
            </div>
            <!-- End .row-fluid --> 
            
          </div>
          <!-- End .title -->
          <div class="content"  style="padding-top:35px;">
            <div id="placeholder" style="width:100%;height:240px;"> </div>
          </div>
          </div>
        </div>
        <!-- End .box .span6-->
        <div class="span6">
          <div class="row-fluid fluid">
            <div class="span6">
              <div class=" box color_2 height_medium paint_hover">
                <div class="content numbers">
                  <h3 class="value"><?php echo $orders;?></h3>
                  <div class="description mb5"><a href="<?php echo base_url().'superadmin/orders'; ?>">Total Orders</a></div>
                  <h1 class="value"><?php echo $order_items;?></h1>
                  <div class="description"><a href="<?php echo base_url().'superadmin/products'; ?>" >Total Sold Items</a></div>
                </div>
              </div>
            </div>
            <!-- End .span6 -->
            <div class="span6">
              <div class="box color_25 height_medium paint_hover">
                <div class="content numbers">
                  <h3 class="value"><?php echo $stores['approved'];?></h3>
                  <div class="description mb5"><a href="<?php echo base_url().'superadmin/approved_stores'; ?>" >Approved Stores</a></div>
                  <h3 class="value"><?php echo $stores['pending'];?></h3>
                  <div class="description"><a href="<?php echo base_url().'superadmin/pending_stores'; ?>" >Pending Stores</a></div> 
                </div>
              </div>
            </div>
            <!-- End .span6 --> 
          </div>
          <!-- End .row-fluid -->
          <div class="row-fluid fluid">
           <div class="span6">
              <div class="box height_medium title_big paint_hover">
                <div class="content numbers">
                  <h3 class="value"><?php echo $pending_designs;?></h3>
                  <div class="description mb5"><a href="<?php echo base_url().'superadmin/designs'; ?>" >Pending Designs</a></div>
                  <h1 class="value"><?php echo $notification;?></h1>
                  <div class="description mb5"><a href="<?php echo base_url().'superadmin/supports'; ?>" >New Support Messages</a></div>
                </div>
              </div>
            </div>
            <!-- End .span6 -->
            <div class="span6">
              <div class=" box color_26 height_medium paint_hover">
                <div class="content icon big_icon"> <a href="<?php echo base_url().'superadmin/messages'; ?>" ><img align="center" src="<?php echo THEME_URL ?>img/general/contacts_icon.png" /></a>
                  <div class="description"><a href="<?php echo base_url().'superadmin/messages'; ?>" >CONTACTS</a></div>
                </div>
              </div>
            </div>
            <!-- End .span6 --> 
          </div>
          <!-- End .row-fluid --> 
          
        </div>
        <!-- End.span6--> 
      </div>
      <!-- End .row-fluid -->
    </div>
    <style type="text/css">
      .description a, .description a:hover{
        color: #ffffff;
        font-size: 14px;
        font-weight: bold;  
      }
      
      #tooltip .date {
          color: #4E6CAB;
          font-size: 12px;
          font-weight: bold;
      }
    </style>
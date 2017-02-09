
      <div class="clearfloat"></div>
      <div class="prodcontent">
      </div>
      <hr color="3b5998" />
      <div class="dashcontent">
          <div class="dashbox row-fluid">
              <div class="row-fluid span12">

                    <div class="design_title span12 " align="left" style="margin-left:3%;"> Title: <?php if($design->design_title !=""){ echo $design->design_title; } ?></div>

                    <div class="design_author span12" align="left"> By : <?php if(!empty($design->artist)){echo $design->artist;} ?></div>

                    <div class="span12">
                        <div class="description span10">
                          <p>"<?php if(!empty($design->desc)){echo $design->desc;}else{echo "This is an awesome design...";} ?>" </p>
                        </div>
                        <div class="span2">
                          <div class="btn-group"> 
                            <a href="<?php echo base_url() ?>storeadmin/download_design/<?php echo $design->id; ?>" class="btn btn-small" > Download <i class="icon-download"></i></a>
                          </div>
                        </div>
                    </div>

                    <div class="span12">
                        <a href="<?php echo base_url().'store/design_your_own/'.$design->slug; ?>">
                          <img slug="<?php echo $design->slug; ?>" dname="<?php echo $design->design_title; ?>" src="<?php echo base_url() ?>assets/uploads/designs/<?php echo $design->design_image; ?>" />
                          <!-- <img src="<?php //echo base_url() ?>assets/uploads/designs/<?php // echo $design->design_image ?>"  /> -->
                        </a>
                    </div>
              </div>
                <br><br>
          </div>
      </div>
      <div class="clearfloat"></div>

      <style type="text/css">
         .row-fluid [class*="span"]{
          margin-left: 0 !important;
        }

        .designlft {
          margin-left: 0;
          margin-top: 0;
          /*width: 270px;*/
        }

        .likeit, .wearit , .shareit{
          text-align: center !important;
        }

       .wearit {
              float: right !important;
              /*margin-top: 5px !important;*/
              /*width: 50px !important;*/
        }

        .description p{
              font-size: 15px !important;
        }

        .shareit {
            float: left !important;
            font-size: 14px !important;
            /*margin-top: 3% !important;*/
            /*padding: 2% 0 0 0% !important;*/
        }

         @media (max-width: 320px){
            .likesharewear{
              margin-left: 0;
              padding: 2%;
              width: 96%;
            }

            .wearit{
              float: right !important;
              margin-top: 5px !important;
              /*width: 50px !important;*/
              /*margin-left: 0;*/
            }

            .row-fluid{
              text-align: center;
            }
            .designlft{
              width: 110% !important;
            }
        }

      </style>

      <script type="text/javascript">
        function fbshare(id){   
            window.open ("http://www.facebook.com/share.php?u=<?php echo current_url() ?>","Facebook_Share","menubar=1,resizable=1,width=900,height=500"); 
        }
      </script>
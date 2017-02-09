

      <!-- FOOTER -->

       <!-- FOOTER -->
      <footer>
          <div class="footer row-fluid">
                <div class="static-links span12">
                  <a href="<?php echo base_url()?>">Home</a> &bull;
                  <a href="<?php echo base_url() ?>store/admins_stores">Stores</a> &bull;
                  <a href="<?php echo base_url() ?>store/faq">FAQ</a> &bull;
                  <?php if(customer_login_in()){?>
                      <?php if(!is_storeadmin()){?>
                    <a href="<?php echo base_url() ?>user/need_help">Support</a> &bull;
                    <?php } else { ?>
                    <a href="<?php echo base_url() ?>storeadmin/need_help">Support</a> &bull;
                  <?php } } else {?>
                  <a href="<?php echo base_url() ?>store/need_help">Support</a> &bull;
                  <?php }?>

                  <?php if(customer_login_in()){?>
                    <?php if(!is_storeadmin()){?>
                      <a href="<?php echo base_url() ?>user/orders"> Order Tracking </a>
                      <?php } else { ?>
                      <a href="<?php echo base_url() ?>storeadmin/orders"> Order Tracking </a>
                    <?php } } else {?>
                      <a href="<?php echo base_url() ?>store/order_info"> Order Tracking </a>
                  <?php }?>

                  <?php 
                  $pages = get_page_link();
                  if ($pages) { 
                      foreach ($pages as $page) {
                        if (!empty($page->page_url) && !empty($page->page_name)) { 
                    ?>
                       &bull; <a href="<?php echo base_url().'store/pages/'.$page->slug ?>"> <?php echo $page->page_name; ?> </a>
                  <?php 
                        }
                      }
                  } ?>
                </div>
                <div class="footer-data span12" style="margin-left:auto;">
                    Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url()?>">ShirtScore.com</a> 
                    All rights reserved
                </div>
          </div><!-- end .footer -->
      </footer>



    </div><!-- /.container -->







    <!-- Le javascript

    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <script src="<?php echo base_url() ?>assets/front_theme/js/jquery.js"></script>

   

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-transition.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-alert.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-modal.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-dropdown.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-scrollspy.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-tab.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-tooltip.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-popover.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-button.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-collapse.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-carousel.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-typeahead.js"></script>

    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/jquery.inputmask.bundle.min.js"></script>

<script>
  $(document).ready(function() {
      $('input[name="mobile"]').inputmask("mask", {"mask": "(999) 999-9999"});
  });

</script>
      <div id="fb-root"></div>

<script type="text/javascript">
 $('#header_color').colorpicker();
 $('#font_color').colorpicker();
</script>

<script type="text/javascript">
 $('#from_date,#to_date').datepicker({format:'yyyy-mm-dd',endDate: '+0d'});
</script>

    <script type="text/javascript">

  window.fbAsyncInit = function() {

      //Initiallize the facebook using the facebook javascript sdk

     FB.init({       

       appId:'563762117019040', // App ID 

       cookie:true, // enable cookies to allow the server to access the session

       status:true, // check login status

       xfbml:true, // parse XFBML

       oauth : true //enable Oauth 

     });



   };

  



   //Read the baseurl from the config.php file



   (function(d){

           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];

           if (d.getElementById(id)) {return;}

           js = d.createElement('script'); js.id = id; js.async = true;

           js.src = "//connect.facebook.net/en_US/all.js";

           ref.parentNode.insertBefore(js, ref);

         }(document));



    //Onclick for fb login



 $('#facebook-signup').click(function(e) {

    FB.login(function(response) {

      if(response.authResponse) {

          parent.location ='<?php echo base_url() ?>store/fblogin'; //redirect uri after closing the facebook popup

      }



 },{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook

});



 

</script>



<script>

  !function ($) {

    $(function(){

      // carousel demo

      $('#myCarousel').carousel()

    })

  }(window.jQuery)

</script>



<script type="text/javascript" >

    jQuery(document).ready(function() {

        var error = jQuery('#img_size_error').val();

        if (typeof(error) != 'undefined')

        {

          if (error != '')

          {

            alert(error);

          };

        };

        // jQuery('#new_pass').on('change keyup blur submit', function() {

        //       str = jQuery(this).val();

        //       var a = parseInt(str.length - 1);

        //       var n = str.charAt(a);

        //       // return false;

        //       if (n != '')

        //       {

        //         var resp = /^[a-zA-Z0-9]+/.test(n);

        //         if (resp){

        //           console.log('Clean');

        //           jQuery('#pass_error').html('');

        //           return true;

        //         }

        //         else{

        //           console.log('error');

        //           jQuery('#pass_error').html('Password Must Contain letters and numeral');

        //           return false;

        //         }

        //       };

        // });

    });

</script>

<script>

  $(function() {

    $( "#start_date" ).datepicker({ minDate: "", maxDate: 0 });

    $( "#end_date" ).datepicker({ minDate: "", maxDate: 0 });

  });

</script>

   

    <script src="<?php echo base_url() ?>assets/front_theme/js/holder/holder.js"></script>

  </body>

</html>


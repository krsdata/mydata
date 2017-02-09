
      <!-- FOOTER -->
      <footer>
          <div class="footer row-fluid">
                
                <div class="footer-data span12" style="margin-left:auto;">
                    Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url()?>">ShirtScore.com</a> 
                    All rights reserved
                </div>
          </div><!-- end .footer -->
      </footer>

    </div><!-- /.container -->
    <style type="text/css">
      .static-links{
        margin-left: 4%;
      } 
      .footer-data a{
        font-size: 16px;
        padding: 1%;
      }
      .footer-data a:hover{
        color: #79B32D;
        font-size: 16px;
        padding: 1%;
      }
      .static-links a{
        font-size: 16px;
        padding: 1%;
      }
      .static-links a:hover{
        color: #79B32D;
        font-size: 16px;
        padding: 1%;
      }
    </style>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    

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



      <div id="fb-root"></div>
    <script type="text/javascript">
  window.fbAsyncInit = function() {
      //Initiallize the facebook using the facebook javascript sdk
     FB.init({       
       // appId:'578966452159790', //jagdish App ID 
       appId:'655965564434612', //awais App ID 
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

    //  FB.getLoginStatus(function(response) {
    //   if (response.status === 'connected') {
    //     // the user is logged in and has authenticated your
    //     // app, and response.authResponse supplies
    //     // the user's ID, a valid access token, a signed
    //     // request, and the time the access token 
    //     // and signed request each expire
    //     var uid = response.authResponse.userID;
    //     var accessToken = response.authResponse.accessToken;
    //     console.log(uid);
    //     console.log(accessToken);
    //     return false;
    //   } else if (response.status === 'not_authorized') {
    //     // the user is logged in to Facebook, 
    //     // but has not authenticated your app
    //   } else {
    //     // the user isn't logged in to Facebook.
    //   }
    // });
     
    FB.login(function(response) {
      // console.log(response);
      // return false;
      if(response.authResponse) {                
          parent.location ='<?php echo base_url() ?>store/fblogin/'; //redirect uri after closing the facebook popup
      }

 },{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook
});

  // post on fb wall
$('.shareit-at-product').click(function(){
var id = $(this).attr('ids');
var imgsrc = $('#'+id).attr('src');
var name = $('#'+id).attr('dname');
var slug = $('#'+id).attr('slug');
    FB.ui(  
      {
        method: 'feed',
        name: name,
        // link: 'https://developers.facebook.com/docs/dialogs/',
        link: '<?php echo base_url(); ?>store/product_info/'+slug,
        picture: imgsrc,
        // caption: ,
        description: 'Designs at shirtscore.com...'
      },
      function(response) {
        if (response && response.post_id) {
          alert('Post was published.');
        } else {
          alert('Post was not published.');
        }
      }
    );
  });

$('#share_it0').click(function(){
  var imgsrc = $('#purchased_image').attr('src');
  // alert(imgsrc);
      FB.ui(
        {
          method: 'feed',
          name: 'ShirtScore Product',
          // link: 'https://developers.facebook.com/docs/dialogs/',
          link: '<?php echo base_url(); ?>',
          picture: imgsrc,
          // caption: ,
          description: 'Design your own and Share it, Wear it'
        },
        function(response) {
          if (response && response.post_id) {
            alert('Post was published.');
          } else {
            alert('Post was not published.');
          }
        }
      );
    });
 
  $('.shareit-at-signup').click(function(){
  var id = $(this).attr('ids');
  var imgsrc = $('#'+id).attr('src');
  var name = $('#'+id).attr('dname');
  var slug = $('#'+id).attr('slug');
      FB.ui(
        {
          method: 'feed',
          name: name,
          // link: 'https://developers.facebook.com/docs/dialogs/',
          link: '<?php echo base_url(); ?>store/design_info/'+slug,
          picture: imgsrc,
          // caption: ,
          description: 'Designs at shirtscore.com...'
        },
        function(response) {
          if (response && response.post_id) {
            alert('Post was published.');
          } else {
            alert('Post was not published.');
          }
        }
      );
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
    <script src="<?php echo base_url() ?>assets/front_theme/js/holder/holder.js"></script>
    <script src="<?php echo base_url() ?>assets/front_theme/js/custom/custom_store.js"></script>

  <?php if ($this->uri->segment(2)!='design_your_own'): ?>  
<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<?php endif; ?>
<script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('pk_pqkoCTImkSVzKtOVB25Xgnrd8bMLM');

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    // $('.submit-button').removeAttr("disabled");
                    // show the errors on the form
                    // $(".payment-errors").html(response.error.message);
                    alert(response.error.message);
                } else {
                    if (!validate_other_info())
                      return false;

                    var form$ = $("#stripeForm");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    form$.get(0).submit();
                }
            }

            function validate_other_info(){
              var val = jQuery( "input:checked" ).val()
              var name = jQuery('#recipient_name').val();
              var address = jQuery('#delivery_address').val();
              var error = true;
              if (val != 0){
                if (name == ''){
                    jQuery('#name-error').html('Recipient Name required.');
                    error = false;
                }
                else{
                    jQuery('#name-error').html('');
                    error = true;
                }

                if (address == ''){
                    jQuery('#address-error').html('Delivery Address required.');
                    error = false;
                }
                else{
                    jQuery('#address-error').html('');
                    error = true;
                }

                return error; 
              }else
                return true;
          }

            $(document).ready(function() {

                $("#pay_by_card").click(function(event) {
                    alert("Please wait we are validate your card");
                    // disable the submit button to prevent repeated clicks
                    // $('.submit-button').attr("disabled", "disabled");
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
                });
            });

              

            jQuery('.color_select').click(function() {
                var col = jQuery(this).attr('id');
                var col = col.split("_");
                if (col[1] != 0)
                {
                  jQuery.ajax({
                                  type: "POST",
                                  data: { action: 'get_content',},
                                  url: "<?php echo base_url() ?>store/ajax_col_imgs/"+col[1],
                                  success: function(res){
                                    // alert(res);
                                    var obj = jQuery.parseJSON(res);
                                    if(obj.result ==='success')
                                    {
                                       jQuery('#colored_imgs').html(obj.imgs);
                                    }
                                    else
                                    {
                                      jQuery('#colored_imgs').html(obj.msg);
                                    }
                                  }
                            });

                  jQuery("#this_color").val(col[1]);
                  jQuery('.color_select').removeClass('its-colored');
                  jQuery(this).addClass('its-colored');
                };
            });

          jQuery(".product-sizes, .qauntity").keydown(function(event) {
              // Allow: backspace, delete, tab, escape, enter and .
              if ( jQuery.inArray(event.keyCode,[46,8,9,27,13,190]) !== -1 ||
                   // Allow: Ctrl+A
                  (event.keyCode == 65 && event.ctrlKey === true) || 
                   // Allow: home, end, left, right
                  (event.keyCode >= 35 && event.keyCode <= 39)) {
                       // let it happen, don't do anything
                       return;
              }
              else {
                  // Ensure that it is a number and stop the keypress
                  if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                      event.preventDefault(); 
                  }   
              }
          });
            
        </script>

        <script type="text/javascript">
        jQuery('.chg_coupon_code1').click(function(){
                var code = document.getElementById('coupon_code1').value;
                var tag = jQuery('#coupon_code1').attr('tag');
                //alert(code);
                // return false;
                  jQuery.ajax({
                        type: "POST",
                        data: { action: 'get_content',},
                        url: "<?php echo base_url() ?>store/ajax_discount_it/"+code,
                        success: function(res){
                          // alert(res);
                          var obj = jQuery.parseJSON(res);
                          if(obj.result ==='success')
                          {
                             window.location.reload();
                          }
                          else
                          { console.log('error');
                            jQuery('#discount_'+tag).html(obj.msg);
                            jQuery('#if_discount_'+tag).fadeIn(function () {
                                jQuery('#if_discount_'+tag).show();
                            });
                          }
                        }
                });

            });          

          function extra_image(image_id) {
            $.post(
              "<?php echo base_url() ?>store/ajax_change_image/"+image_id,       
              function (data){
                  if(data != ""){
                    $('#main_image').html(data);
                  }        
                }
              );
          }


          jQuery('#add_to_cart').click(function() {
              if (check_validate())
              {
                $('#cart_product').submit();
              }
          });

          jQuery('.qty_edit').click(function() {

            var id = jQuery(this).attr('qty');
             jQuery("#"+id).attr('disabled',false);
          });

          jQuery('.update_cart').click(function() {
             jQuery(".qauntity").attr('disabled',false);
          });

          jQuery('.qauntity').focusout(function() {
             jQuery(this).attr('disabled',true);
          });
            
          function check_validate() {
              var valid = true;
              var error = '';
              var is_sized = false;
              var got_it = '';
              var color_count = $('#color_count').val();
              jQuery( ".product-sizes" ).each(function() {
               if (jQuery(this).val() != ''){
                  is_sized = true;
                  got_it = jQuery(this).val();
                  return false;
               }
            });
            // alert(got_it);
            // return false;
            if (!is_sized)
            {
              valid = false;
              error+='Please Select Size.\n\n';
            }

            if (color_count != 0)
            {
              var col_val = jQuery('#this_color').val();
              if (col_val == 0)
              {
                valid = false;
                error+='Please Select Color.';
              };
            };
            if (error != '')
              alert(error);

              return valid;    
            }
        </script>

    
  </body>
</html>

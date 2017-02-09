
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
</div>


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
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/docs.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/front_theme/js/jquery.inputmask.bundle.min.js"></script>
<script>
  $(document).ready(function() {
      $('input[name="mobile"]').inputmask("mask", {"mask": "(999) 999-9999"});
  });
</script>

<script type="text/javascript">
 $('#from_date,#to_date').datepicker({format:'yyyy-mm-dd',endDate: '+0d'});
</script>

<script type="text/javascript">
 $('#header_color').colorpicker();
 $('#font_color').colorpicker();
</script>
<script type="text/javascript">

$('#datepicker').datepicker();
  </script>

<script type="text/javascript">

$('#datepicker2').datepicker();
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
      });
 </script>
</body>   
</html>


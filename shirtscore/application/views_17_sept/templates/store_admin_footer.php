
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

  <?php if($this->uri->segment(1)=='storeadmin'): ?>
      <!-- Add jQuery library -->
   <!-- Add mousewheel plugin (this is optional) -->
  <script type="text/javascript" src="<?php echo THEME_URL ?>fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

  <!-- Add fancyBox main JS and CSS files -->
  <script type="text/javascript" src="<?php echo THEME_URL ?>fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL ?>fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />


  <!-- Add Media helper (this is optional) -->
  <script type="text/javascript" src="<?php echo THEME_URL ?>fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

  <script type="text/javascript">
    $(document).ready(function() {
    
      $('.fancybox-media1')
        .attr('rel', 'media-gallery')
        .fancybox({
          openEffect : 'none',
          closeEffect : 'none',
          prevEffect : 'none',
          nextEffect : 'none',

          arrows : false,
          helpers : {
            media : {},
            buttons : {},
             thumbs : {
              width  : 150,
              height : 150
            }
          }
        });

      


    });
</script>
  <?php endif ?>
   <?php if($this->uri->segment(2)=='edit_design'): ?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/front_theme/jwplayer/example/jwplayer.js"></script>
  <script type="text/javascript">
jwplayer("vertical").setup({
        flashplayer: "<?php echo base_url() ?>assets/front_theme/jwplayer/jwplayer.flash.swf",
        width: 300,
        height: 150,
        primary: "flash",
        file: "<?php echo base_url().str_replace('./','',$design->design_video) ?>"
});
</script>
<?php endif; ?>
</body>   
</html>


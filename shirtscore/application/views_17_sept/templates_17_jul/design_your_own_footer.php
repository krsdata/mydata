</div>
  <div class="footer">
       <!--    <a href="index.html">Home</a> &bull;
        <a href="faq.html">FAQ</a> &bull;
        <a href="support.html">Support</a><br /> -->
        Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url() ?>">ShirtScore.com</a> &bull;
        All rights reserved<br />
  </div><!-- end .footer -->
</div>
</body>   
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

</html>


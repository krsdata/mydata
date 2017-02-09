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
 
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
    ga('create', 'UA-3247839-23', 'auto');
    ga('send', 'pageview');
  
  </script>

</html>


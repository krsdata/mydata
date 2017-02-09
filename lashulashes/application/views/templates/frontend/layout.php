<?php $this->load->view('templates/frontend/header');

$this->load->view($template);

$f_segment1 = $this->uri->segment(1);
$f_segment2 = $this->uri->segment(2);

if(!( (($f_segment1 == 'website') && ($f_segment2 == 'index')) || (($f_segment1 == 'website') && ($f_segment2 == '')) || (($f_segment1 == '') && ($f_segment2 == '')) ))
{
	$this->load->view('templates/frontend/footer');
	?>
	<script type="text/javascript">
            $(document).ready(function() {

                $(".to_top .fa").click(function() {
                    //$('#header-top').css("display","block");
                    $('html, body').animate({
                        scrollTop: $(".body").offset().top - 70
                    }, 600);

                });
              });
    </script>
    <?php
}
else
{ ?>

<script type="text/javascript">
    $(document).ready(function() {
    	$('.to_top').css("display","none");
    });
</script>

<?php
}
?>
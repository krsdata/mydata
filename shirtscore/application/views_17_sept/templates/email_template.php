<?php 

$this->load->view('templates/email_header_template.php');
$this->load->view($template);
$this->load->view('templates/email_footer_template.php');

 ?>
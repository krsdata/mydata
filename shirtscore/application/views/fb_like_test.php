
<SCRIPT type="text/javascript">
window.location="<?php echo $url ?>";
</SCRIPT>	


<meta property="og:title" content="<?php echo $result->design_title ?>" />
<meta property="og:image" content="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $result->design_image ?>" />
<?php $des = strip_tags($result->description) ?>
<meta property="og:description" content="<?php echo $des; ?>" />
<?php
if(isset($_SERVER['HTTP_REFERER'])){
	//a regular expression to match the facebook address from the referer address
	if(preg_match("/www.facebook.com/",$_SERVER['HTTP_REFERER'])){
?>
<SCRIPT type="text/javascript">
window.location="<?php echo $url ?>"; //<?php echo $result->id ?>
</SCRIPT>	
<?php
	}
}
?>

<meta property="og:title" content="<?php echo $result->design_title ?>" />
<meta property="og:image" content="<?php echo base_url() ?>assets/uploads/designs/thumbnail/<?php echo $result->design_image ?>" />
<?php $des = strip_tags($result->description) ?>
<meta property="og:description" content="<?php echo $des; ?>" />
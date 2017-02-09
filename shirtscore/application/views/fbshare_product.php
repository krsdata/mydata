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
<meta property="og:title" content="<?php echo $result->regular_name ?>" />
<meta property="og:image" content="<?php echo base_url() ?>assets/uploads/products/thumbnail/<?php echo $result->main_image ?>" />
<?php $des = strip_tags($result->desc) ?>
<meta property="og:description" content="<?php echo $des; ?>" />
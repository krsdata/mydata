
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" > 
<meta property="fb:app_id" content="130796876963854" />
<meta property="fb:admins" content="12345678" />
<meta property="og:title" content="Your Awesome Title for Your Page"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="http://www.domain.com/canonical-url-to-article"/>
<meta property="og:site_name" content="YourSiteName"/>
<meta property="og:description" content="Your Awesome Description up to 300 characters"/>
<meta property="og:image" content="http://www.domain.com/facebook-picture-150x150px.png"/>
<head>
  <title></title>
</head>
<body>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js" ></script> 
<script type="text/javascript">
window.fbAsyncInit = function() {
FB.init({appId: '<?php echo FB_APP_ID ?>', 
status: true,

cookie: true,
xfbml: true,
channelUrl : 'http://examine247.com/shirtscore/store/fb_result' // add channelURL to avoid IE redirect problems
}); };
(function() {
var e = document.createElement('script'); e.async = true;
e.src = document.location.protocol +
'//connect.facebook.net/en_US/all.js';
document.getElementById('fb-root').appendChild(e);
}()); 
</script>
<script type="text/javascript">
window.fbAsyncInit = function() {
FB.init({appId: '<?php echo FB_APP_ID ?>', status: true, cookie: true, xfbml: true});
try {
if (FB && FB.Event && FB.Event.subscribe) {
// Like and Share
FB.Event.subscribe("edge.create",function(response) {
if (response.indexOf("facebook.com") > 0) {
// if the returned link contains 'facebook,com'. It's a 'Like' for your Facebook Page
_gaq.push(['_trackSocial','Facebook','Like',response]);
} else {
// else, somebody is Sharing the current page
_gaq.push(['_trackSocial','Facebook','Share',response]);
}
});
}
} catch (e) {}
};
</script>

<div class="fb-like-box" data-href="http://www.facebook.com/Savio.no" data-width="265" data-show_faces="true" data-stream="true" data-border_color="#ccc" data-header="false" data-ref="facebook_fb-page"></fb:like-box>

</body>
</html>
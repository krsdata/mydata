<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
[id] => 100004791545034
    [name] => Jams Bond
    [first_name] => Jams
    [last_name] => Bond
    [link] => http://www.facebook.com/jams.bond.35110
    [username] => jams.bond.35110
    [gender] => male
    [email] => joe.parihar@laeffect.com
    [timezone] => 5.5
    [locale] => en_US
    [verified] => 1
    [updated_time] => 2012-12-06T11:30:53+0000

*/
require_once('facebook-php-sdk/src/facebook.php');

class Fbauth {

    Var $CI;
    public $client = NULL;
    public $session = NULL;
    public $req_perms = '';
	public $user 		= NULL;
	//public $user_id 	= FALSE;
	//public $fb 			= FALSE;
	//public $fbSession	= FALSE;
	//public $appkey		= 0;
	public $facebook    = NULL;

	function __construct(){
		$this->CI =& get_instance();
		
		$app_id='478562605515464';  //app_id 
		$secret_key ='f091313c8eccadcefec81510e753cd37'; //secret_key
		
		$this->CI->facebook = new Facebook(array(
		'appId'  => $app_id,
		'secret' => $secret_key,
		//'cookie'  => true
		));
		// Get User ID
		$this->CI->user = $this->CI->facebook->getUser();

	}

    function fbget_status() {

    	 //$this->CI->session=$this->CI->facebook->getSession();  	
    ///print_r($this->CI->session);		
		if ($this->CI->user) {
		  try {
		    // Proceed knowing you have a logged in user who's authenticated.
		    return $user_profile = $this->CI->facebook->api('/me');
		   // $this->CI->session->set_userdata('Facebook_info',$user_profile);
		   // print_r( $user_profile);
		  //	return TRUE;

		  } catch (FacebookApiException $e) {
		  	//print_r($e);
		    error_log($e);
		    $this->CI->$user = NULL;
		  }
		}else{
			return FALSE;
		}
    }



    function fbget_login_url() {  

    	if ($this->CI->user) {
			// user log out
			$params = array( 'next' => base_url());
			return $logoutUrl = $this->CI->facebook->getLogoutUrl();
		 	//echo '<a href="'.$logoutUrl.'">Log Out Facebook</a>';

		} else {			
			// user log in
			$params = array(
  'scope' => 'read_stream, friends_likes',
  'redirect_uri' => base_url().'user/login/check_fblogin/'
);
			return $loginUrl = $this->CI->facebook->getLoginUrl($params);
			//echo '<a href="'.$loginUrl.'">Log In Facebook</a>';
		}
    }

   /* function fb_login_status() {
    	return $this->CI->facebook->get_loggedin_user();
    }*/
    function fb_dest_sess(){
    	
    	
		 $app_id = '306141469497015';
		
$this->CI->facebook->clearAllPersistentData_for_public();
setcookie('fbsr_' . $app_id, '', time()-3600, '/', '.'.$_SERVER['SERVER_NAME']);
$this->CI->facebook->clearAllPersistentData_for_public();
/*unset($_SESSION['fb_'.$app_id.'_access_token']);
    unset($_SESSION['fb_'.$app_id.'_code']);
    unset($_SESSION['fb_'.$app_id.'_user_id']);
    unset($_SESSION['fb_'.$app_id.'_state']);

    // Finally, destroy the session.
    session_unset();
    session_destroy();
*/

 }

 function up_p(){
 	$appid = '306141469497015';
 $appsecret = 'bb3d9b4c30ae923553951f006b4eb713';
 $pageId = 'jams.bond.35110';
 $msg = 'Nice script for posting to Facebook from PHP program';
 $title = 'Tips4php.net';
 $uri = 'http://tips4php.net/2010/12/automatic-post-to-facebook-from-php-script/';
 $desc = 'Learn how to build a script that automatically can post messages from a PHP script to Facebook';
 $pic = 'http://cdn.tips4php.net/wp-content/uploads/2010/12/post_facebook_php.png';
 $action_name = 'Go to Tips4php';
 $action_link = 'http://www.tips4php.net';

$facebook = new Facebook(array(
 'appId' => $appid,
 'secret' => $appsecret,
 'cookie' => false,
 ));

$user = $facebook->getUser();

// Contact Facebook and get token
 if ($user) {
 // you're logged in, and we'll get user acces token for posting on the wall
 try {
 $page_info = $facebook->api("/$pageId?fields=access_token");
 if (!empty($page_info['access_token'])) {
 $attachment = array(
 'access_token' => $page_info['access_token'],
 'message' => $msg,
 'name' => $title,
 'link' => $uri,
 'description' => $desc,
 'picture'=>$pic,
 'actions' => json_encode(array('name' => $action_name,'link' => $action_link))
 );

$status = $facebook->api("/$pageId/feed", "post", $attachment);
 } else {
 $status = 'No access token recieved';
 }
 } catch (FacebookApiException $e) {
 error_log($e);
 $user = null;
 }
 } else {
 // you're not logged in, the application will try to log in to get a access token
 header("Location:{$facebook->getLoginUrl(array('scope' => 'photo_upload,user_status,publish_stream,user_photos,manage_pages'))}");
 }

return  $status;
 }

 public function post_wall($data=''){

 	$USER_ID = "100004791545034"; // Connected once to your APP and not necessary logged-in at the moment
		$args = array(
		  'name' => $data['name'],		 
		  'link' => $data['link'],
		  'description' => $data['description'],
		  'picture' => $data['picture']
		);

		if($post_id = $this->CI->facebook->api("/jams.bond.35110/feed", "post", $args)){
		  //echo "OKK!!!";
		  //print_r($post_id);
		}else{
		  //echo 
			die("ERROR !!!");
		} 	
 }

 public function fb_feeds(){
 	$access_token =  $this->CI->facebook->getAccessToken('user_actions.news');
	//Get the contents of the Facebook page
	$FBpage = file_get_contents('https://graph.facebook.com/jams.bond008/feed?access_token='.$access_token);
	//Interpret data with JSON
	$FBdata = json_decode($FBpage);
	if ($FBdata)
		return $FBdata;
	else
		return FALSE;
 }
   

}
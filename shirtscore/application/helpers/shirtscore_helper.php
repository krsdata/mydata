<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Msg alert */
if ( ! function_exists('msg_alert')) {
	function msg_alert(){
	$CI =& get_instance(); ?>

<?php if($CI->session->flashdata('success_msg')): ?>	
	<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <strong>Success :</strong>  <?php echo $CI->session->flashdata('success_msg'); ?>
	</div>
 <?php endif; ?>

<?php if($CI->session->flashdata('msg_info')): ?>	
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	    <strong></strong>  <?php echo $CI->session->flashdata('msg_info'); ?>
	</div>
<?php endif; ?>

<?php if($CI->session->flashdata('msg_warning')): ?>	
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	    <strong>Warning :</strong>  <?php echo $CI->session->flashdata('msg_warning'); ?>
	</div>
<?php endif; ?>

<?php if($CI->session->flashdata('msg_error')): ?>	
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	    <strong>Error :</strong>  <?php echo $CI->session->flashdata('msg_error'); ?>
	</div>
<?php endif; ?>

	<?php }					
}


/**
*	load site title
*/
if ( ! function_exists('site_title')) {		
	function site_title() {		
		return 'SHIRTSCORE';
	}
}		

/**
*	load site copyright
*/
if ( ! function_exists('site_copyright')) {		
	function site_copyright() {		
		return '<p style="text-align: center;">Copyright &copy; '.date('Y').' <a href="http://shirtscore.com/">shirtscore.com</a></p>';
	}
}

/**
*	check superadmin authentication
*/
if ( ! function_exists('superadmin_login_in')) {	
	function superadmin_login_in() {
		$CI =& get_instance();
		$superadmin_info=$CI->session->userdata('superadmin_info');		
		if($superadmin_info['logged_in']===TRUE && $superadmin_info['user_role']==0):
			return TRUE; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	check customer_services authentication
*/
if ( ! function_exists('customer_services')) {	
	function customer_services() {
		$CI =& get_instance();
		$customerservices_info=$CI->session->userdata('customerservices_info');		
		if($customerservices_info['logged_in']===TRUE && $customerservices_info['user_role']==1):
			return TRUE; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	Give customer service info if authenticated
*/
if ( ! function_exists('customer_services_info')) {	
	function customer_services_info() {
		$CI =& get_instance();
		$info=$CI->session->userdata('customerservices_info');		
		if($info['logged_in']===TRUE && $info['user_role']==1):
			return $info; 			
		else:
			return FALSE; 			
		endif;
	}
}


/**
*	check storeadmin_info authentication
*/
if ( ! function_exists('storeadmin_login_in')) {	
	function storeadmin_login_in() {
		$CI =& get_instance();
		$storeadmin_info=$CI->session->userdata('storeadmin_info');		
		// if($storeadmin_info['logged_in']===TRUE && $storeadmin_info['user_role']==2):
		if($storeadmin_info['logged_in']===TRUE):
			return TRUE; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	check customer authentication
*/
if ( ! function_exists('customer_login_in')) {	
	function customer_login_in() {
		$CI =& get_instance();
		$customer_info=$CI->session->userdata('customer_info');		
		if($customer_info['logged_in']===TRUE && $customer_info['user_role']==3):
			return TRUE; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	Give storeadmin info if authenticated
*/
if ( ! function_exists('storeadmin_info')) {	
	function storeadmin_info() {
		$CI =& get_instance();
		$storeadmin_info=$CI->session->userdata('storeadmin_info');		
		if(($storeadmin_info['logged_in']===TRUE) && ($storeadmin_info['user_role']==3) && ($storeadmin_info['is_storeadmin']==1)):
			return $storeadmin_info; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	Give customer info if authenticated
*/
if ( ! function_exists('customer_info')) {	
	function customer_info() {
		$CI =& get_instance();
		$customer_info=$CI->session->userdata('customer_info');		
		if($customer_info['logged_in']===TRUE && $customer_info['user_role']==3):
			return $customer_info; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	Give superadmin Id.
*/
if ( ! function_exists('superadmin_id')) {	
	function superadmin_id() {
		$CI =& get_instance();
		$superadmin_info=$CI->session->userdata('superadmin_info');
		if($superadmin_info['logged_in']===TRUE && $superadmin_info['user_role']==0):
			return $superadmin_info['id'];
		else:
			return FALSE;
		endif;
	}
}

/**
*	Give superadmin Id.
*/
if ( ! function_exists('default_admin_info')) {	
	function default_admin_info() {
		$CI =& get_instance();
		$CI->db->select('us.id as superadmin_id, st.*');
		$CI->db->from('users as us');
		$CI->db->where('us.user_role', 0);
		$CI->db->join('stores as st','st.user_id=us.id');
		$query = $CI->db->get();
		return $query->row();
	}
}

/**
*	Give user Id.
*/
if ( ! function_exists('customer_id')) {	
	function customer_id() {
		$CI =& get_instance();
		$customer_info=$CI->session->userdata('customer_info');		
		if($customer_info['logged_in']===TRUE && $customer_info['user_role']==3):
			return $customer_info['id']; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	Give storeadmin Id.
*/
if ( ! function_exists('storeadmin_id')) {	
	function storeadmin_id() {
		$CI =& get_instance();
		$user_info=$CI->session->userdata('storeadmin_info');		
		if($user_info['logged_in']===TRUE):
			return $user_info['id']; 			
		else:
			return FALSE; 			
		endif;
	}
}

/**
*	Give store admin name.
*/
if ( ! function_exists('storeadmin_name')) {	
	function storeadmin_name() {
		$CI =& get_instance();
		$user_info=$CI->session->userdata('storeadmin_info');		
		if($user_info['logged_in']===TRUE && $user_info['user_role']==2):
			$name = $user_info['firstname']." ".$user_info['lastname']; 			
		return $name;
		else:
			return FALSE; 			
		endif;
	}
}


/**
*	get superadmin usename
*/
if ( ! function_exists('superadmin_login_username')) {	
	function superadmin_login_username() {
		$CI =& get_instance();		
		$user_info = $CI->session->userdata('superadmin_info');		
		return $user_info['firstname'].' '.$user_info['lastname'];	
	}
}


/**
*	get storeadmin usename
*/
if ( ! function_exists('storeadmin')) {	
	function storeadmin() {
		$CI =& get_instance();		
		$user_info = $CI->session->userdata('storeadmin_info');		
		return $user_info['firstname'].' '.$user_info['lastname'];	
	}
}

/**
*	get usename
*/
if ( ! function_exists('admin_username')) {	
	function admin_username() {
		$CI =& get_instance();		
		$user_info = $CI->session->userdata('storeadmin_info');		
		return $user_info['firstname'].' '.$user_info['lastname'];	
	}
}

/**
*	get usename
*/
if ( ! function_exists('login_username')) {	
	function login_username() {
		$CI =& get_instance();		
		$user_info = $CI->session->userdata('user_info');		
		return $user_info['firstname'].' '.$user_info['lastname'];	
	}
}


/**
*	get store_id
*/
if ( ! function_exists('get_store_info')) {	
	function get_store_info($admin_id) {
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->where('user_id', $admin_id);
		$query = $CI->db->get('stores');
		return $query->row();
		// return $store_id;	
	}
}

/**
*	get store_id
*/
if ( ! function_exists('get_store_id')) {	
	function get_store_id($admin_id) {
		$CI =& get_instance();
		$CI->db->select('id');
		$CI->db->where('user_id', $admin_id);
		$CI->db->order_by('id');
		$query = $CI->db->get('stores');
		return $query->row()->id;
		// return $store_id;	
	}
}

/**
*	get store_id
*/
if ( ! function_exists('get_store_ids')) {	
	function get_store_ids($admin_id) {
		$CI =& get_instance();
		$CI->db->select('id');
		$CI->db->where('user_id', $admin_id);
		$query = $CI->db->get('stores');
		return $query->result();
		// return $store_id;	
	}
}

/**
*	Check Product is customized or not.
*/
if ( ! function_exists('is_customized')) {
	function is_customized($product_id){
		$CI =& get_instance();
		$CI->db->where('id', $product_id);
		$CI->db->where('is_customized', 1);
		$query = $CI->db->get('products');
		//print_r($query->result()); die();
		if($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}
}

/**
*	get static pages link
*/
if ( ! function_exists('get_page_link')) {
	function get_page_link(){
		$CI =& get_instance();
		// $CI->db->select('page_name, page_url');
		$CI->db->where('status', 1);
		$query = $CI->db->get('pages');
		//print_r($query->result()); die();
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}
}


/**
*	last login attempt 
*/
if ( ! function_exists('last_login_status')) {
	function last_login_status(){
		$CI =& get_instance();
		$user_sess_name = $CI->session->userdata('user_sess_name'); // get session name		
		$superadmin_info=$CI->session->userdata($user_sess_name);	
		$last_login = strtotime($superadmin_info["last_login"]); $now = now(); 
		$msg='<div style="font-size:10px;float:right;text-align:right;padding-right:10px;">';	  	
	  	$msg.="Last login : ".timespan($last_login, $now)." ago <br>";
	 	$msg.="IP address : ".$superadmin_info["last_ip"]."</div>";
	  	return $msg;		
	}
}

/**
*	clear cache
*/
if ( ! function_exists('clear_cache')) {
	function clear_cache(){
		$CI =& get_instance();
		$CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
		$CI->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
		$CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
		$CI->output->set_header("Pragma: no-cache");			
	}
}

/**
*	convert id to encrypt code
*/
if ( ! function_exists('id_encrypt')) {	
	function id_encrypt($id = NULL) {
		$CI =& get_instance();
		return $CI->encrypt->encode($id);
	}
}

/**
*	convert decrypt code to id
*/
if ( ! function_exists('id_decrypt')) {	
	function id_decrypt($code = NULL) {
		$CI =& get_instance();
		return $CI->encrypt->decode($code);
	}
}

/**
*	check user authentication
*/
if ( ! function_exists('make_thumb')) {	
	function make_thumb($src, $dest, $desired_width) {
		//$src = '1.jpg';
		//$dest = '2.jpg';
		//$desired_width = 100; 

		/* read the source image */
		$source_image = imagecreatefromjpeg($src);
    	$width = imagesx($source_image);
    	$height = imagesy($source_image);
  
  		/* find the "desired height" of this thumbnail, relative to the desired width  */
  		$desired_height = floor($height * ($desired_width / $width));
  
  		/* create a new, "virtual" image */
  		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
  
  		/* copy source image at a resized size */
  		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
  	
  		/* create the physical thumbnail image to its destination */
  		imagejpeg($virtual_image, $dest);
 	}
}


/**
*	convert decrypt code to id
*/
if ( ! function_exists('socialIcons')) {	
	function socialIcons(){
		$CI =& get_instance();
			$data=$CI->store_model->get_social_icons($CI->session->userdata('storeId'));
		if($data)
			return $data;
		else
			return FALSE;
	}
}




/*twitter feed*/
if ( ! function_exists('twitter_feed')) { 
 function twitter_feed($id = '',$limit='') { 
	$feeds= @file_get_contents("https://api.twitter.com/1/statuses/user_timeline.json?screen_name=".$id.'&include_rts=1&count='.$limit);
	$feed =  json_decode($feeds);	
	if(!empty($feed))
		return $feed;
	else return FALSE;
	}
}



/**
*	get sub domain name
*/
if ( ! function_exists('facebook_feed')) {	
	function facebook_feed($appid='',$width='',$height='') { ?>
	 <div id="fb-root"></div>
   <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $appid ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
 <div class="fb-activity" data-site="http://shirtscore.com/" data-app-id="<?php echo $appid ?>" data-width="<?php echo $width ?>" data-height="<?php echo $height ?>" data-header="true" data-recommendations="false" style="background-color: #FFFFFF;"></div>
<?php	} 
}



function base64_url_encode($input)
{
    return strtr(base64_encode($input), '+/=', '-_#');
}

function base64_url_decode($input)
{
    return base64_decode(strtr($input, '-_#', '+/='));
}





/* get_theme pagination */
if ( ! function_exists('get_theme_pagination')) {
	function get_theme_pagination(){
		$data = array();

		$data['full_tag_open'] = '<span class="pagination">';
		$data['full_tag_close'] = '</span>';
		$data['first_link'] = 'First';
		$data['last_link'] = 'Last';
		$data['next_link'] = '&nbsp;&nbsp;NEXT&nbsp;<i class="icon-double-angle-right"></i>';
		$data['prev_link'] = '&nbsp;&nbsp;<i class="icon-double-angle-left"></i>&nbsp;PREV&nbsp;&nbsp;';
		// $data['first_tag_open'] = '';
		// $data['first_tag_close'] = '';
		$data['num_tag_open'] = '&nbsp;&nbsp;';
		$data['num_tag_close'] = '&nbsp;&nbsp;';
		// $data['last_tag_open'] = '';
		// $data['last_tag_close'] = '';
		// $data['next_tag_open'] = '<div>';
		// $data['next_tag_close'] = '</div>';
		// $data['prev_tag_open'] = '<div>';
		// $data['prev_tag_close'] = '</div>';
		$data['cur_tag_open'] = '<span class="current"><strong>';
		$data['cur_tag_close'] = '</strong></span>';
		return $data;
	}
}	

	


	/**
	*
	*GIves an array of country code and name
	*
	**/

	if ( ! function_exists('get_country_array'))
	{	
		function get_country_array()
		{
			
			return array(
							"AF"=>"Afghanistan",
							"AX"=>"Aland Islands",
							"AL"=>"Albania",
							"DZ"=>"Algeria",
							"AS"=>"American Samoa",
							"AD"=>"Andorra",
							"AO"=>"Angola",
							"AI"=>"Anguilla",
							"AQ"=>"Antarctica",
							"AG"=>"Antigua and Barbuda",
							"AR"=>"Argentina",
							"AM"=>"Armenia",
							"AW"=>"Aruba",
							"AU"=>"Australia",
							"AT"=>"Austria",
							"AZ"=>"Azerbaijan",
							"BS"=>"Bahamas",
							"BH"=>"Bahrain",
							"BD"=>"Bangladesh",
							"BB"=>"Barbados",
							"BY"=>"Belarus",
							"BE"=>"Belgium",
							"BZ"=>"Belize",
							"BJ"=>"Benin",
							"BM"=>"Bermuda",
							"BT"=>"Bhutan",
							"BO"=>"Bolivia, Plurinational State of",
							"BQ"=>"Bonaire, Sint Eustatius and Saba",
							"BA"=>"Bosnia and Herzegovina",
							"BW"=>"Botswana",
							"BV"=>"Bouvet Island",
							"BR"=>"Brazil",
							"IO"=>"British Indian Ocean Territory",
							"BN"=>"Brunei Darussalam",
							"BG"=>"Bulgaria",
							"BF"=>"Burkina Faso",
							"BI"=>"Burundi",
							"KH"=>"Cambodia",
							"CM"=>"Cameroon",
							"CA"=>"Canada",
							"CV"=>"Cape Verde",
							"KY"=>"Cayman Islands",
							"CF"=>"Central African Republic",
							"TD"=>"Chad",
							"CL"=>"Chile",
							"CN"=>"China",
							"CX"=>"Christmas Island",
							"CC"=>"Cocos (Keeling) Islands",
							"CO"=>"Colombia",
							"KM"=>"Comoros",
							"CG"=>"Congo",
							"CD"=>"Congo, The Democratic Republic of the",
							"CK"=>"Cook Islands",
							"CR"=>"Costa Rica",
							"CI"=>"Cote D'Ivoire",
							"HR"=>"Croatia",
							"CU"=>"Cuba",
							"CW"=>"Curaçao",
							"CY"=>"Cyprus",
							"CZ"=>"Czech Republic",
							"DK"=>"Denmark",
							"DJ"=>"Djibouti",
							"DM"=>"Dominica",
							"DO"=>"Dominican Republic",
							"EC"=>"Ecuador",
							"EG"=>"Egypt",
							"SV"=>"El Salvador",
							"GQ"=>"Equatorial Guinea",
							"ER"=>"Eritrea",
							"EE"=>"Estonia",
							"ET"=>"Ethiopia",
							"FK"=>"Falkland Islands (Malvinas)",
							"FO"=>"Faroe Islands",
							"FJ"=>"Fiji",
							"FI"=>"Finland",
							"FR"=>"France",
							"GF"=>"French Guiana",
							"PF"=>"French Polynesia",
							"TF"=>"French Southern Territories",
							"GA"=>"Gabon",
							"GM"=>"Gambia",
							"GE"=>"Georgia",
							"DE"=>"Germany",
							"GH"=>"Ghana",
							"GI"=>"Gibraltar",
							"GR"=>"Greece",
							"GL"=>"Greenland",
							"GD"=>"Grenada",
							"GP"=>"Guadeloupe",
							"GU"=>"Guam",
							"GT"=>"Guatemala",
							"GG"=>"Guernsey",
							"GN"=>"Guinea",
							"GW"=>"Guinea-Bissau",
							"GY"=>"Guyana",
							"HT"=>"Haiti",
							"HM"=>"Heard Island and McDonald Islands",
							"VA"=>"Holy See (Vatican City State)",
							"HN"=>"Honduras",
							"HK"=>"Hong Kong",
							"HU"=>"Hungary",
							"IS"=>"Iceland",
							"IN"=>"India",
							"ID"=>"Indonesia",
							"IR"=>"Iran, Islamic Republic of",
							"IQ"=>"Iraq",
							"IE"=>"Ireland",
							"IM"=>"Isle of Man",
							"IL"=>"Israel",
							"IT"=>"Italy",
							"JM"=>"Jamaica",
							"JP"=>"Japan",
							"JE"=>"Jersey",
							"JO"=>"Jordan",
							"KZ"=>"Kazakhstan",
							"KE"=>"Kenya",
							"KI"=>"Kiribati",
							"KP"=>"Korea, Democratic People's Republic of",
							"KR"=>"Korea, Republic of",
							"KW"=>"Kuwait",
							"KG"=>"Kyrgyzstan",
							"LA"=>"Lao People's Democratic Republic",
							"LV"=>"Latvia",
							"LB"=>"Lebanon",
							"LS"=>"Lesotho",
							"LR"=>"Liberia",
							"LY"=>"Libya",
							"LI"=>"Liechtenstein",
							"LT"=>"Lithuania",
							"LU"=>"Luxembourg",
							"MO"=>"Macao",
							"MK"=>"Macedonia, The Former Yugoslav Republic of",
							"MG"=>"Madagascar",
							"MW"=>"Malawi",
							"MY"=>"Malaysia",
							"MV"=>"Maldives",
							"ML"=>"Mali",
							"MT"=>"Malta",
							"MH"=>"Marshall Islands",
							"MQ"=>"Martinique",
							"MR"=>"Mauritania",
							"MU"=>"Mauritius",
							"YT"=>"Mayotte",
							"MX"=>"Mexico",
							"FM"=>"Micronesia, Federated States of",
							"MD"=>"Moldova, Republic of",
							"MC"=>"Monaco",
							"MN"=>"Mongolia",
							"ME"=>"Montenegro",
							"MS"=>"Montserrat",
							"MA"=>"Morocco",
							"MZ"=>"Mozambique",
							"MM"=>"Myanmar",
							"NA"=>"Namibia",
							"NR"=>"Nauru",
							"NP"=>"Nepal",
							"NL"=>"Netherlands",
							"NC"=>"New Caledonia",
							"NZ"=>"New Zealand",
							"NI"=>"Nicaragua",
							"NE"=>"Niger",
							"NG"=>"Nigeria",
							"NU"=>"Niue",
							"NF"=>"Norfolk Island",
							"MP"=>"Northern Mariana Islands",
							"NO"=>"Norway",
							"OM"=>"Oman",
							"PK"=>"Pakistan",
							"PW"=>"Palau",
							"PS"=>"Palestinian Territory, Occupied",
							"PA"=>"Panama",
							"PG"=>"Papua New Guinea",
							"PY"=>"Paraguay",
							"PE"=>"Peru",
							"PH"=>"Philippines",
							"PN"=>"Pitcairn",
							"PL"=>"Poland",
							"PT"=>"Portugal",
							"PR"=>"Puerto Rico",
							"QA"=>"Qatar",
							"RE"=>"Reunion",
							"RO"=>"Romania",
							"RU"=>"Russian Federation",
							"RW"=>"Rwanda",
							"BL"=>"Saint Barthelemy",
							"SH"=>"Saint Helena, Ascension and Tristan Da Cunha",
							"KN"=>"Saint Kitts and Nevis",
							"LC"=>"Saint Lucia",
							"MF"=>"Saint Martin (French part)",
							"PM"=>"Saint Pierre and Miquelon",
							"VC"=>"Saint Vincent and the Grenadines",
							"WS"=>"Samoa",
							"SM"=>"San Marino",
							"ST"=>"Sao Tome and Principe",
							"SA"=>"Saudi Arabia",
							"SN"=>"Senegal",
							"RS"=>"Serbia",
							"SC"=>"Seychelles",
							"SL"=>"Sierra Leone",
							"SG"=>"Singapore",
							"SX"=>"Sint Maarten (Dutch part)",
							"SK"=>"Slovakia",
							"SI"=>"Slovenia",
							"SB"=>"Solomon Islands",
							"SO"=>"Somalia",
							"ZA"=>"South Africa",
							"GS"=>"South Georgia and the South Sandwich Islands",
							"SS"=>"South Sudan",
							"ES"=>"Spain",
							"LK"=>"Sri Lanka",
							"SD"=>"Sudan",
							"SR"=>"Suriname",
							"SJ"=>"Svalbard and Jan Mayen",
							"SZ"=>"Swaziland",
							"SE"=>"Sweden",
							"CH"=>"Switzerland",
							"SY"=>"Syrian Arab Republic",
							"TW"=>"Taiwan, Province of China",
							"TJ"=>"Tajikistan",
							"TZ"=>"Tanzania, United Republic of",
							"TH"=>"Thailand",
							"TL"=>"Timor-Leste",
							"TG"=>"Togo",
							"TK"=>"Tokelau",
							"TO"=>"Tonga",
							"TT"=>"Trinidad and Tobago",
							"TN"=>"Tunisia",
							"TR"=>"Turkey",
							"TM"=>"Turkmenistan",
							"TC"=>"Turks and Caicos Islands",
							"TV"=>"Tuvalu",
							"UG"=>"Uganda",
							"UA"=>"Ukraine",
							"AE"=>"United Arab Emirates",
							"GB"=>"United Kingdom",
							"US"=>"United States",
							"UM"=>"United States Minor Outlying Islands",
							"UY"=>"Uruguay",
							"UZ"=>"Uzbekistan",
							"VU"=>"Vanuatu",
							"VE"=>"Venezuela, Bolivarian Republic of",
							"VN"=>"Viet Nam",
							"VG"=>"Virgin Islands, British",
							"VI"=>"Virgin Islands, U.S.",
							"WF"=>"Wallis and Futuna",
							"EH"=>"Western Sahara",
							"YE"=>"Yemen",
							"ZM"=>"Zambia",
							"ZW"=>"Zimbabwe"
						);
		}
	}
	/**
	*	Gives Name of Country with respect to the provided country code
	*/
	if ( ! function_exists('get_states_name'))
	{	
		function get_states_name($code='')
		{

			$state_list = array('AL'=>"Alabama", 
				'AK'=>"Alaska", 
				'AZ'=>"Arizona", 
				'AR'=>"Arkansas", 
				'CA'=>"California", 
				'CO'=>"Colorado", 
				'CT'=>"Connecticut", 
				'DE'=>"Delaware", 
				'DC'=>"District Of Columbia", 
				'FL'=>"Florida", 
				'GA'=>"Georgia", 
				'HI'=>"Hawaii", 
				'ID'=>"Idaho", 
				'IL'=>"Illinois", 
				'IN'=>"Indiana", 
				'IA'=>"Iowa", 
				'KS'=>"Kansas", 
				'KY'=>"Kentucky", 
				'LA'=>"Louisiana", 
				'ME'=>"Maine", 
				'MD'=>"Maryland", 
				'MA'=>"Massachusetts", 
				'MI'=>"Michigan", 
				'MN'=>"Minnesota", 
				'MS'=>"Mississippi", 
				'MO'=>"Missouri", 
				'MT'=>"Montana",
				'NE'=>"Nebraska",
				'NV'=>"Nevada",
				'NH'=>"New Hampshire",
				'NJ'=>"New Jersey",
				'NM'=>"New Mexico",
				'NY'=>"New York",
				'NC'=>"North Carolina",
				'ND'=>"North Dakota",
				'OH'=>"Ohio", 
				'OK'=>"Oklahoma", 
				'OR'=>"Oregon", 
				'PA'=>"Pennsylvania", 
				'RI'=>"Rhode Island", 
				'SC'=>"South Carolina", 
				'SD'=>"South Dakota",
				'TN'=>"Tennessee", 
				'TX'=>"Texas", 
				'UT'=>"Utah", 
				'VT'=>"Vermont", 
				'VA'=>"Virginia", 
				'WA'=>"Washington", 
				'WV'=>"West Virginia", 
				'WI'=>"Wisconsin", 
				'WY'=>"Wyoming");		

			return $state_list;
		}
	}

	/**
	*	Gives Name of Country with respect to the provided country code
	*/
	if ( ! function_exists('get_country_name'))
	{	
		function get_country_name($code='')
		{

			$CI =& get_instance();		

			$country = $CI->get_country_array();		

			return element($code, $country);
		}
	}



if ( ! function_exists('select_check'))	{
	function select_check($row_id,$search_arr){ 
	  if(!empty($search_arr) && is_array($search_arr)){ 
	    $a=array_search($row_id, $search_arr);
	    if($a===FALSE) return FALSE; else return TRUE;
	  }
	} 
}

/**
*	get sales_statistic
*/
if ( ! function_exists('sales_statistic')) {	
	function sales_statistic($store_id='') {
		$CI =& get_instance();
		$start_date=date('Y-m-d');
		$end_date=date('Y-m-d', strtotime('-6 day', strtotime($start_date)));
        $CI->db->select('SUM(quantity) as sales, DATE_FORMAT(created, "%d") as date',FALSE);
        $CI->db->from('order_items');
        if(!empty($store_id)){  
        	$CI->db->where('store_id',$store_id);
    	}

        $CI->db->where("created BETWEEN  '$end_date' AND '$start_date' ");
        $CI->db->group_by('created'); 
        $query=$CI->db->get();
        // print_r($query->result());
        $array_data=array();
        $Days=array();
        $Daysf=array();
        for ($iDay = 6; $iDay >= 0; $iDay--) {
    	$Days[] = date('d', strtotime("-" . $iDay . " day"));
    	$Daysf[] = date('Y-m-d', strtotime("-" . $iDay . " day"));
		}
		
        if($query->num_rows()>0){
        	$result=$query->result_array();

          for ($i=0; $i <count($Days) ; $i++) {          
           	$array_data[$i]['sale']='0';
           	$array_data[$i]['date']=$Days[$i];
           	$array_data[$i]['date_full']=$Daysf[$i];  

	          	foreach ($result as $row) {          		
	          		if($row['date']==$Days[$i]){
	          			$array_data[$i]['sale']=$row['sales'];
		         		$array_data[$i]['date']=$Days[$i];
		         		$array_data[$i]['date_full']=$Daysf[$i];
		         	}
		        }	
	        }
		$statistic=$array_data;
		// print_r($statistic);
	        ?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Sale'],
      <?php foreach($statistic as $row): ?>
      ['<?php echo date("d/m/Y",strtotime($row["date_full"])); ?>', <?php echo $row["sale"] ?>],
      <?php endforeach; ?>
    ]);
var options = {
      title: 'Product sale last 6 days',
      hAxis: {title: 'date', titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
</script>
<div id="chart_div" class="span3" style="height: 300px; margin-left:10%"></div> 
	        <?php         	        	
            return $array_data;        
        }else{ 
        	return FALSE;
        }        	
	}
}

/**
*	get total_store
*/
if ( ! function_exists('total_store'))	{
	function total_store(){ 
	  $CI =& get_instance();
		$data=$CI->db->get('stores');
		return $data->num_rows();
	} 
}

/**
*	get total_orders
*/
if ( ! function_exists('total_orders'))	{
	function total_orders(){ 
	  $CI =& get_instance();
		$data=$CI->superadmin_model->total_orders_this_month();
		return $data;
	} 
}

/**
*	Get Pagination for bootstrap Style
*/
if ( ! function_exists('get_pagination_style')) {
	function get_pagination_style(){
		$data = array();
		$data['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
		$data['full_tag_close'] = '</ul></div>';
		$data['first_tag_open'] = '<li>';
		$data['first_tag_close'] = '</li>';
		$data['num_tag_open'] = '<li>';
		$data['num_tag_close'] = '</li>';
		$data['last_tag_open'] = '<li>';
		$data['last_tag_close'] = '</li>';
		$data['next_tag_open'] = '<li>';
		$data['next_tag_close'] = '</li>';
		$data['prev_tag_open'] = '<li>';
		$data['prev_tag_close'] = '</li>';
		$data['cur_tag_open'] = '<li class="active"><a href="#">';
		$data['cur_tag_close'] = '</a></li>';
		return $data;
	}
}

/**
*	Read Order Status .
*/
if ( ! function_exists('fetch_order_status')) {	
	function fetch_order_status($status='') {	
		
		$status_array = array(
                                    '1' => 'In Queue',
                                    '2' => 'In Production',
                                    '3' => 'Production Complete',
                             ); 
		return element($status, $status_array);
	}
}

/**
*	Read Order Status .
*/
if ( ! function_exists('order_status_array')) {	
	function order_status_array($status='') {
	
		$status_array = array(
                                    '1' => 'In Queue',
                                    '2' => 'In Production',
                                    '3' => 'Production Complete',
                             ); 
		// returns "red"
		return $status_array;
		// // returns NULL
		// echo element('size', $array, NULL);
	}
}

if (!function_exists('field_array')){
    function field_array(){
     		$f_array = array(
                            '1' => 'Text',
                            '2' => 'TextArea',
                            '3' => 'Radio Button',
                            '4' => 'Check Box',
                            '5' => 'Select Box',
                            '6' => 'File Type',
                            '7' => 'Password',
                            '8' => 'Hidden',
                            '9' => 'Color Picker',
                            '10' => 'Date Picker',
                            '11' => 'Submit'
                             ); 
		return $f_array; 
    }
 }

 if (!function_exists('get_f_type')){
    function get_f_type($id=1){
     	$f_array = array(
                            '1' => 'Text',
                            '2' => 'TextArea',
                            '3' => 'Radio Button',
                            '4' => 'Check Box',
                            '5' => 'Select Box',
                            '6' => 'File Type',
                            '7' => 'Password',
                            '8' => 'Hidden',
                            // '9' => 'Color Picker',
                            // '10' => 'Date Picker',
                            '11' => 'Submit'
                             ); 
		return element($id, $f_array); 
    }
  }

   if (!function_exists('get_f_type')){
    function get_form_type($id=''){
     	$f_array = array(
                            '1' => 'text',
                            '2' => 'textarea',
                            '3' => 'radio',
                            '4' => 'checkbox',
                            '5' => 'select',
                            '6' => 'file',
                            '7' => 'password',
                            '8' => 'hidden',
                            '9' => 'text',
                            '10' => 'text',
                            '11' => 'submit'
                             ); 
		return element($id, $f_array); 
    }
  } 

/**
*	Read Order Status .
*/
if ( ! function_exists('fetch_img_view')) {	
	function fetch_img_view($match='') {	
		
		$images = array('front' => 'front','back' => 'back','left' => 'left','right' => 'right');
		return element($match, $images);
	}
}

/**
*	get_size_name
*/
if ( ! function_exists('get_size_name')) {	
	function get_size_name($size_id) {
		$CI =& get_instance();
		$size_arr = array();
		foreach ($size_id as $key => $value) {
			$val = $CI->db->get_where('product_sizes', array('id'=>$value));
			if(isset($val->row()->size_name))
				$size_arr[]=$val->row()->size_name;
		}
		return $size_arr;	
	}
}


/**
*	is_storeadmin
*/
if ( ! function_exists('is_storeadmin')) {	
	function is_storeadmin() {
		$CI =& get_instance();
		$user = $CI->session->userdata('customer_info');
		$query = $CI->db->get_where('users', array('id'=>$user['id']));
		if($query->num_rows() > 0){
			$storeadmin = $query->row()->is_storeadmin;			
			if($storeadmin == 1){
				return TRUE;
			}else{				
				return FALSE;
			}
		}else{
			return FALSE;
		}

		}
	}

/**
*	Gives Commission Rate
*/
if ( ! function_exists('commission_info')) {
	function commission_info() {
		$CI =& get_instance();
		$CI->db->limit(1, 0);
		$query = $CI->db->get('commission');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return FALSE;
		}
	}
}

/**
*	Gives Commission Rate
*/
if ( ! function_exists('commission_rate')) {
	function commission_rate() {
		$CI =& get_instance();
		$CI->db->select('commission_price');
		$CI->db->from('commission');
		$CI->db->limit(1, 0);
		$query = $CI->db->get();
		if($query->num_rows() > 0){
			return $query->row()->commission_price;
		}else{
			return FALSE;
		}
	}
}

/**
*	Gives Earned Commission
*/
if ( ! function_exists('my_commission')) {
	function my_commission($user_id) {
		$CI =& get_instance();
		$CI->db->select('total_paid_com');
		$CI->db->where('user_id', $user_id);
		$query = $CI->db->get('commission_request');
		if($query->num_rows() > 0){
			return $query->row()->total_paid_com;
		}else{
			return FALSE;
		}
	}
}
// public function sales_history($uid){
// 		$this->db->select_sum('d_sales.total');
// 		$this->db->select_sum('d_sales.qty');
// 		$this->db->from('orders as od');
// 		$this->db->where('dgn.artist_id', $uid);
// 		$this->db->where('d_sales.payment_status', 0);
// 		$this->db->join('design_sales as d_sales','od.id=d_sales.order_id');			
// 		$this->db->join('design as dgn','dgn.id=d_sales.design_id');
// 		$query=$this->db->get();
// 		if($query->num_rows()>0)
// 			return $query->row();
// 		else
// 			return FALSE;
// 	}

/**
*	Gives Commission Rate
*/
if ( ! function_exists('user_commission')) {
	function user_commission($uid) {
		$CI =& get_instance();
		// $CI->db->select_sum('d_sales.total');
		$CI->db->select_sum('d_sales.qty');
		$CI->db->from('design_sales as d_sales');
		$CI->db->join('design as dgn','dgn.id=d_sales.design_id');
		$CI->db->where('d_sales`.`design_owner_id', $uid);
		$CI->db->where('d_sales.payment_status',0);
		$query = $CI->db->get();
		if($query->num_rows() > 0){
			return $query->row()->qty;
		}else{
			return FALSE;
		}
	}
}

/**
*	Gives Commission Rate
*/
if ( ! function_exists('design_owner')) {
	function design_owner($did) {
		$CI =& get_instance();
		$CI->db->select('artist_id');
		$CI->db->where('id', $did);
		$query = $CI->db->get('design');
		if($query->num_rows() > 0){
			return $query->row()->artist_id;
		}else{
			return FALSE;
		}
	}
}

/**
*	Gives Home URL
*/
if ( ! function_exists('home_url')) {
	function home_url() {
		 $CI =& get_instance();
		 if ($CI->session->userdata('my_store'))
		 {
	        $store = $CI->session->userdata('my_store');
	        $link = $store->store_link;
	        $home_url = 'shop/'.$link;
	     }
	     else
	        $home_url = 'store';

			return $home_url;
	}
}

/**
*	Gives Home URL
*/
if ( ! function_exists('money_symbol')) {
	function money_symbol() {		 
		 echo "$";
	}
}

/**
* Gives Commission Rate
*/
if ( ! function_exists('slider_content')) {
 function slider_content() {
  $CI =& get_instance();
  $CI->db->where('status', 1);
  $query = $CI->db->get('sliders');
  if($query->num_rows() > 0){
   return $query->result();
  }else{
   return FALSE;
  }
 }
}

/**
* Gives Commission Rate
*/
if ( ! function_exists('get_facebook_likes')) {
	function get_facebook_likes($url='',$post_id='') {	
		$CI =& get_instance();
		$json_string = file_get_contents('http://api.ak.facebook.com/restserver.php?v=1.0&method=links.getStats&urls='.$url.'&format=json');
	    $json = json_decode($json_string); 
	    //print_r( $json);
	    if (!empty($json)) {
	  	 	$fblikes=$json[0]->like_count;
			$CI->db->update('design',array('fb_like_count'=>$fblikes),array('id'=>$post_id));    	
	     } 
 	}
}

if ( ! function_exists('get_selected_design_to_multistore')) {
	function get_selected_design_store($array='',$findme='') {	
		if(!empty($array)){
			foreach ($array as $row) {
				if($row->store_id==$findme)
					return TRUE;
			}
		}
 	}
}

if ( ! function_exists('encrypt_id')) {
	function encrypt_id($id){
		$CI =& get_instance();
		return str_replace('%2F', '_S_H_I_R_T_S_C_O_R_E', urlencode($CI->encrypt->encode($id)));
	}
}

/**
*   decrypt id
*/
if ( ! function_exists('decrypt_id')) {
    function decrypt_id($code){
        $CI =& get_instance();
        return $CI->encrypt->decode(urldecode(str_replace('_S_H_I_R_T_S_C_O_R_E', '%2F', $code)));
    }
}

/**
*   get store admin store ids
*/
if ( ! function_exists('get_admin_store_ids')) {
    function get_admin_store_ids(){
    	$CI =& get_instance();
    	$info = $CI->session->userdata('storeadmin_info');
		$admin_id = $info['id'];
    	$store_arr = get_store_ids($admin_id);
		$stores_id=array();
		foreach ($store_arr as $row) {
			$stores_id[]=$row->id;
			break;
		}
		if(count($stores_id) > 0)
			return $stores_id;
		else
			return FALSE;
    }
}

function days_of_month($month, $year)
{
	return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
}



if ( ! function_exists('get_custom_uplaod_img_from_product')) {
	function get_custom_uplaod_img_from_product($product_id='')
	{ $CI =& get_instance();
	  return $data=$CI->superadmin_model->get_row('products',array('id'=>$product_id));
	}
}	

if ( ! function_exists('productprice')) {
	function productprice($product_id='',$size_id='')
	{ $CI =& get_instance();
	  return $data=$CI->superadmin_model->get_row('product_size_price',array('product_id'=>$product_id,'size_id'=>$size_id));
	}
}	

if ( ! function_exists('get_size_details')) {	

	function get_size_details($product_id,$size_id) {
	$CI =& get_instance();
	$CI->db->where('size_id',$size_id);
	$CI->db->where('product_id',$product_id);
    $query = $CI->db->get('product_size_price');
    return $query->row();

	}

}

if ( ! function_exists('get_design_id')) {	

	function get_design_id($order_id,$product_id) {
	$CI =& get_instance();
	$CI->db->where('order_id',$order_id);
	$CI->db->where('product_id',$product_id);
    $query = $CI->db->get('design_sales');
    if($query->num_rows() > 0){
    $res = $query->result();
    return $res;

    }else{

    return FALSE;

  }

	}

}

if ( ! function_exists('get_size_detail_cus')) {	
	function get_size_detail_cus($main_product_id,$size_id) {
	$CI =& get_instance();

	$product_info=$CI->store_model->get_row('products',array('id'=>$main_product_id));
	$product_used_id=$product_info->product_used;
	$product_price=$product_info->price;
	$product_used=$CI->store_model->get_row('products',array('id'=>$product_used_id));
	$product_default_price=$product_used->price;
	$designs_price=$product_price - $product_default_price;
    
	$CI->db->where('size_id',$size_id);
	$CI->db->where('product_id',$product_used_id);
    $query = $CI->db->get('product_size_price');
    $size_details=$query->row();
    return $size_details->price + $designs_price;
	}
}

if ( ! function_exists('get_design_image')) {	

	function get_design_image($des_id) {
	$CI =& get_instance();
	$CI->db->where('id',$des_id);
    $query = $CI->db->get('design');
    if($query->num_rows() > 0){
    	$res = $query->row();
    return $res;
	 }
	 else{
	    return FALSE;
	  }
	}
}

if ( ! function_exists('get_color_id')) {	

	function get_color_id($color_id) {
	$CI =& get_instance();
	$CI->db->where('id',$color_id);
    $query = $CI->db->get('product_colors');
    if($query->num_rows() > 0){
    $res = $query->row();
    return $res;

    }
    }}


    if ( ! function_exists('upload_file')) {
	function upload_file($param = null){
		$CI =& get_instance();		
		
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|csv|jpeg|pdf|doc|docx';
		$config['max_size']	= 1024*90;
		$config['image_resize']= TRUE;
		// $config['resize_width']= 126;
		// $config['resize_height']= 126;
		
		if ($param){
            $config = $param + $config;
        }
		$CI->load->library('upload');
		$CI->upload->initialize($config);
        if(!empty($config['file_name']))
			$file_Status = $CI->upload->do_upload($config['file_name']);
		else
			$file_Status = $CI->upload->do_upload();

		if (!$file_Status){
			
			return array('STATUS'=>FALSE,'FILE_ERROR' => $CI->upload->display_errors());			
		}else{
			$uplaod_data=$CI->upload->data();
	
			$upload_file = explode('.', $uplaod_data['file_name']);
			
			if($config['image_resize'] && in_array(strtolower($upload_file[1]), array('gif','jpeg','jpg','png','bmp','jpe'))){
				$param2=array(
					'source_image' 	=>	$config['source_image'].$uplaod_data['file_name'],
					'new_image' 	=>	$config['new_image'].$uplaod_data['file_name'],
					'create_thumb' 	=>	FALSE,
					'maintain_ratio'=>	TRUE,
					// 'width' 		=>	$config['resize_width'],
					// 'height' 		=>	$config['resize_height'],
					);
			
				image_resize($param2);
				
			}	
			return array('STATUS'=>TRUE,'UPLOAD_DATA' =>$uplaod_data );
		}
	}
}
/**
*	image resize
*/
if ( ! function_exists('image_resize')) {
	function image_resize($param = null){
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image']	= './assets/uploads/';
		$config['new_image']	= './assets/uploads/';		
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 150;
		$config['height'] = 150;
		
		 if ($param) {
            $config = $param + $config;
        }
        
		$CI->load->library('image_lib', $config); 
		if ( ! $CI->image_lib->resize())
		{
		   //return array('STATUS'=>TRUE,'MESSAGE'=>$CI->image_lib->display_errors()); 
			die($CI->image_lib->display_errors());
		}else{
			 return array('STATUS'=>TRUE,'MESSAGE'=>'Image resized.'); 
		}
	}
}

/**
*	thumbnail image
*/
if ( ! function_exists('create_thumbnail')) {
	function create_thumbnail($config_img='') {
		$CI =& get_instance();
		$config_image['image_library'] = 'gd2';
		$config_image['source_image'] = $config_img['source_path'].$config_img['file_name'];	
		//$config_image['create_thumb'] = TRUE;
		$config_image['new_image'] = $config_img['destination_path'].$config_img['file_name'];
		$config_image['maintain_ratio'] = TRUE;
		$config_image['width'] = $config_img['width'];
		$config_image['height'] = $config_img['height'];
		$CI->load->library('image_lib', $config_image);
		if(!$CI->image_lib->resize()) 
			return array('status'=>FALSE,'error_msg'=>$CI->image_lib->display_errors());
		else
			return array('status'=>TRUE,'file_name'=>$config_img['file_name']);
	}
}

/**

*	Get YouTube video ID from URL

*/

if ( ! function_exists('get_youtube_id_from_url')) {

	function get_youtube_thumbnail($youtube_url='',$alt=TRUE,$height='400px',$width='300px'){

		if (strpos($youtube_url,'youtube') !== false) {
			$youtubeId = preg_replace('/^[^v]+v.(.{11}).*/', '$1', $youtube_url);

			if($alt) $alt='alt="'.$youtubeId.'"'; else $alt='';

			return'<img src="http://img.youtube.com/vi/'.$youtubeId.'/0.jpg" '.$alt.' height='.$height.' width='.$width.'>';
   
		}

		if(strpos($youtube_url,'vimeo') !== false){
		$url = explode('/', $youtube_url);
		$imgid = array_pop($url);
		$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$imgid.'.php'));
		return'<img src='.$hash[0]['thumbnail_medium'].' height="400px" width="300px"/>';
		}

	}					

}

if( ! function_exists('get_best_selling_product')) {
	
	function get_best_selling_product()
	{
		$CI =& get_instance();
		$CI->load->model('superadmin_model');
		$query = $CI->superadmin_model->get_row('best_seller');
		if($query>0){
			return $query;
		}else{
			return FALSE;
		}
	}
}

if(!function_exists('get_user_info')){
	function get_user_info($id='')
	{
		$CI =& get_instance();
		$CI->load->model('superadmin_model');
		$query = $CI->superadmin_model->get_row('users',array('id'=>$id,'user_role !='=>0));
		if($query>0){
			return $query;
		}else{
			return FALSE;
		}
	}
}

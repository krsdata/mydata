<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $img1 = base_url()."/assets/images/ci_logo_flame.jpg";
		// $img2 = base_url()."/assets/images/user.jpg";
		// $img3 = "./assets/images/merged.jpg";
		// $this->merge($img1, $img2, $img3);


		$this->load->view('fbtest');

		// $this->merge('images/myimg.jpg', 'images/second.gif', 'images/merged.jpg');
		// $this->load->view('welcome_message');
	}

	public function merge($filename_x, $filename_y, $filename_result) 
	{
		// Load the stamp and the photo to apply the watermark to
		$im = imagecreatefromjpeg($filename_x);

		// First we create our stamp image manually from GD
		$stamp = imagecreatetruecolor(100, 70);
		// imagefilledrectangle($stamp, 0, 0, 99, 69, 0x0000FF);
		// imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
		$im = imagecreatefromjpeg($filename_y);
		$im = imagecreatetruecolor(100, 70);
		// imagefilledrectangle($im, 0, 0, 99, 69, 0x0000FF);
		// imagefilledrectangle($im, 9, 9, 90, 60, 0xFFFFFF);

		// Set the margins for the stamp and get the height/width of the stamp image
		$marge_right = 10;
		$marge_bottom = 10;
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);

		// Merge the stamp onto our photo with an opacity of 50%
		imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

		// Save the image to file and free memory
		imagejpeg($im, $filename_result);
		imagedestroy($im);
	}

	// public function merge($filename_x, $filename_y, $filename_result) 
	// {
	// 	 // Get dimensions for specified images
	// 	 $config1['image_library'] = 'gd2';
	// 	 $this->load->library('image_lib', $config1);
	// 	 // $this->load->library('gd');
		 
	// 	 list($width_x, $height_x) = getimagesize($filename_x);
	// 	 list($width_y, $height_y) = getimagesize($filename_y);

	// 	 // Create new image with desired dimensions

	// 	 $image = imagecreatetruecolor($width_x + $width_y, $height_x);

	// 	 // Load images and then copy to destination image

	// 	 $image_x = imagecreatefromjpeg($filename_x);
	// 	 $image_y = imagecreatefromjpeg($filename_y);
	// 	 // $image_y = imagecreatefromgif($filename_y);


	// 	 imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
	// 	 imagecopy($image, $image_y, $width_x, 0, 0, 0, $width_y, $height_y);

	// 	 // Save the resulting image to disk (as JPEG)

	// 	 imagejpeg($image, $filename_result);

	// 	 // Clean up

	// 	 imagedestroy($image);
	// 	 imagedestroy($image_x);
	// 	 imagedestroy($image_y);
	// }
	// merge('images/myimg.jpg', 'images/second.gif', 'images/merged.jpg');


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */



 /*public function facebook_test(){  

        $config=array(
       'appId'  => '578966452159790',
        'secret' => '2f2672fc6c90e45dde1447ba92a5d3bc'
        );

        $this->load->library('facebook/facebook', $config);

        // Get User ID
        $user = $this->facebook->getUser();
        
        if ($user) {            


          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = $this->facebook->api('/me');

             print_r($user_profile); 
          } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
          }
        }

        // Login or logout url will be needed depending on current user state.
        if ($user) {
          $logoutUrl = $this->facebook->getLogoutUrl();

             echo anchor( $logoutUrl ,'Logout');
        } else {
          $statusUrl = $this->facebook->getLoginStatusUrl();
          $loginUrl = $this->facebook->getLoginUrl(array(
		'scope' => 'email',
		'redirect_uri'=> base_url().'welcome/fb_login_check'
		));

           echo anchor( $loginUrl ,'Login with Facebook');
        }

    }


    public function fb_login_check($value=''){
        $config=array(
        'appId'  => '578966452159790',
        'secret' => '2f2672fc6c90e45dde1447ba92a5d3bc'
        );

        $this->load->library('facebook/facebook', $config);

        // Get User ID
        $user = $this->facebook->getUser();
        
        if ($user) {            


          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = $this->facebook->api('/me');

             print_r($user_profile); 
          } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
          }
        }
    }*/


    /*****************************************************************************************************/


     function fb_login(){
		
		$loginUrl='';
			$config=array(
			'appId'  => FB_APP_ID,
			'secret' => FB_APP_SECRET);

			$this->load->library('facebook/facebook', $config);
			$user = $this->facebook->getUser();
			if ($user) {
				try {
				// Proceed knowing you have a logged in user who's authenticated.
				$user_profile =  $this->facebook->api('/me');
				
				} catch (FacebookApiException $e) {
					error_log($e);
					$user = null;
				}
			}
			
			//if ($user) {
			//return $logoutUrl = $this->facebook->getLogoutUrl();
			// echo '<a href="'.$logoutUrl.'"> Logout Facebook</a>';
			// return $this->facebook->api('/me');
			//} else {
			 $loginUrl = $this->facebook->getLoginUrl(array(
			 	'scope' => 'email',
			 	'redirect_uri'=> base_url().'welcome/fb_login_check'
			 	)
			 );
			 //echo '<a href="'.$loginUrl.'"> Login With Facebook</a>';
			//}			
			//return $loginUrl;
			  echo anchor( $loginUrl ,'Login with Facebook');

	}

	public function fb_login_check(){			
		$config=array(
			'appId'  => FB_APP_ID,
			'secret' => FB_APP_SECRET);

		$this->load->library('facebook/facebook', $config);
		$user = $this->facebook->getUser();
		
		if ($user) {
			$user_profile = (object) $this->facebook->api('/me');
			print_r($user_profile );
			// check user exist
			/*if($user_data=$this->user_model->get_row('users',array('email'=>trim($user_profile->email)))){									
	
				echo form_open('user/login', array('id'=>'login_hideen'),array('SECURED_HEDDEN'=>TRUE,'email'=>$user_data->email,'password'=>$user_data->password));					
				echo form_close();
				echo '<script>';
				echo 'document.getElementById("login_hideen").submit();';
				echo '</script>';		
				
			}else{

				$this->session->set_userdata('FB_LOGIN_INFO',$user_profile);
				redirect('user/candidate_signup/');
			}*/
		}else{			
			echo "FALSE";
		}
	}


	public function fb_like_test()
	{
		$this->load->view('facebook_like');
	}

}
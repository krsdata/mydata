<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recover_password extends CI_Controller {
	function __construct(){
	 parent::__construct();

	 $this->load->model('recover_password_model');
	}

	public function check_useremail_exist($user_email){

		// echo  $user_email;
		// die();

		if ($user_email != ''){
			$resp = $this->recover_password_model->get_row('users', array('email' => $user_email, 'activated' =>1));
			if ($resp){
				return TRUE;
			}else{
				$this->form_validation->set_message('check_useremail_exist', ' Email address not exist.');
				return FALSE;
			}
				
			
		}else{
			$this->form_validation->set_message('check_useremail_exist', 'Registred Email required.');
			return FALSE;
		}
	}



	public function forget_password(){
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email||callback_check_useremail_exist[]');
	if($this->form_validation->run() === TRUE){
		$email = $this->input->post('email');	
		//echo $email; die();
		$length = 10;
		$secret_key = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);			
		$user_id = $this->recover_password_model->check_email($email, $secret_key);
		$this->send_mail($email, $secret_key);
		$this->session->set_flashdata('success_msg', 'your request successfully submitted please check your email');											
		redirect('store/login');
	}

		$data['template'] = 'store/recover_password';
        $this->load->view('templates/store_template', $data);		
	}

	public function send_mail($email, $secret_key)
	{


		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Reset Password';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form
		$to = array(
			 $email,
		);

		$html = $this->template_for_recover_password($secret_key);

		
		$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
		if($is_fail){
		echo "ERROR :";
		print_r($is_fail);
		}
	}

	public function template_for_recover_password($secret_key){
		$url = base_url("recover_password/reset_password/".$secret_key);	
		$message = '';
		$message .= '<html>
						<body>
						<h3>Forgot your password ?</h3>';
		
		$message .=	'<p>To reset your password, click on the link below</p><br/>
						<a href="'.$url.'">'.$url.'</a>';
					
				
		$message .=	'</body></html>';

		return $message;
	}

	public function reset_password($secret_key){
		if($this->recover_password_model->check_secret_key($secret_key)){
			$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
			$this->form_validation->set_rules('c_password', 'confirm Password','required|matches[password]');
			if($this->form_validation->run() === TRUE){
				$data = array(
					'password'		=>	sha1($this->input->post('password')),
					'secret_key' 	=> ''
					);
				$user_role = $this->recover_password_model->update_password($data, $secret_key);
				$this->session->set_flashdata('success_msg', 'Your Password is successfully updated');
				if($user_role == 3)				
				redirect('store/login');
				
			}

			$data['template'] = 'store/reset_password';
        	$this->load->view('templates/store_template', $data);	
			
		}else{
			$this->session->set_flashdata('error', 'Invalid Secret Key !!!');
			redirect('recover_password/forget_password');
		}
	}
public function success(){
		$this->session->set_flashdata('success', 'Your Password is successfully updated');
	}

	public function forget_password_store(){

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if($this->form_validation->run() === TRUE){
			$email = $this->input->post('email');	
			//echo $email; die();
			$length = 10;
			$secret_key = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);			
			$user_id = $this->recover_password_model->check_storeadmin_email($email, $secret_key);
			$this->send_storeadmin_mail($email, $secret_key);
			$this->session->set_flashdata('success_msg', 'your request successfully submitted please check your email');											
			redirect('storeadmin/login');
		}

	
		
        $this->load->view('storeadmin/recover_password');		
	}

	public function send_storeadmin_mail($email, $secret_key)
	{


		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Reset Password';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form
		$to = array(
			 $email,
		);

		$html = $this->template_for_recover_password1($secret_key);

		
		$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
		if($is_fail){
		echo "ERROR :";
		print_r($is_fail);
		}
	}

	public function template_for_recover_password1($secret_key){
		$url = base_url("recover_password/reset_storeadmin_password/".$secret_key);	
		$message = '';
		$message .= '<html>
						<body>
						<h3>Forgot your password ?</h3>';
		
		$message .=	'<p>To reset your password, click on the link below</p><br/>
						<a href="'.$url.'">'.$url.'</a>';
					
				
		$message .=	'</body></html>';

		return $message;
	}

	public function reset_storeadmin_password($secret_key){
		if($this->recover_password_model->check_secret_key($secret_key)){
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('c_pass', 'confirm Password', 'matches[password]');
			if($this->form_validation->run() === TRUE){
				$data = array(
					'password'		=>	sha1($this->input->post('password')),
					'secret_key' 	=> ''
					);
				$user_role = $this->recover_password_model->update_password($data, $secret_key);
				$this->session->set_flashdata('success_msg', 'Your Password is successfully updated');
				if($user_role == 2)				
				redirect('storeadmin/login');
				
			}

			// $data['template'] = 'store/reset_password';
        	// $this->load->view('templates/store_template', $data);
        	$this->load->view('storeadmin/reset_password')	;

			
		}else{
			$this->session->set_flashdata('error', 'Invalid Secret Key !!!');
			redirect('recover_password/forget_password_store');
		}
	}




}

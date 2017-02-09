<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_service extends CI_Controller {

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

	public function __construct(){
		parent::__construct();		
		clear_cache();		
		$this->load->model('customer_service_model');
	}

	public function index()
	{
		$this->check_login();
		$this->tagged_queries();
	}

	private function check_login(){
		if(customer_services()===FALSE)
			redirect('customer_service/login');
	}

	public function login(){
		$this->load->model('login_model');

		if(customer_services()===TRUE)
			redirect('customer_service');

		if(isset($_COOKIE['customer_services_me'])){
			$details = unserialize(decrypt_id($_COOKIE['customer_services_me']));
			$status=$this->login_model->login($details['email'], $details['password'],1);
			if($status['status']){
				$data = encrypt_id(serialize($details));
				setcookie('customer_services_me',$data ,time()+1209600); //set cookie				
				redirect('customer_service');
			}else{
				$this->session->set_flashdata('error_msg', $status['error_msg']);
				redirect('customer_service/login');
			}
		}
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');				
		if ($this->form_validation->run() == TRUE){
			$status=$this->login_model->login($this->input->post('email'),$this->input->post('password'),1);

			if($status['status']){
				//remember me
				if($this->input->post('rememberme') == 1){
					//$info = $this->session->userdata('customerservices_info');
					$value = array('email' => $this->input->post('email'),'password' => $this->input->post('password'));
					$data = encrypt_id(serialize($value));
					setcookie('customer_services_me',$data,time()+1209600); //set cookie							
				}
				redirect('customer_service');
			}
			else{
				$this->session->set_flashdata('error_msg', $status['error_msg']);
				redirect('customer_service/login');
			}
		}		
		$this->load->view('customer_services/login');					
	}

	public function logout(){
	 	if ($this->session->userdata('customerservices_info')) {
			$this->session->set_userdata('customerservices_info','');
			$this->session->unset_userdata('customerservices_info');
		}
	 	setcookie("customer_services_me", "", time()-3600); //delete cookie
	 	redirect('customer_service/login');
	 }

	public function check_unique_email($new_email, $old_email){
        if ($new_email == $old_email){
            return TRUE;
        }else{
            $resp = $this->customer_service_model->get_row('users', array('email' => $new_email));
            if ($resp){
                $this->form_validation->set_message('check_unique_email', 'Email alredy exist');
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
	 public function profile(){
		$this->check_login();
		$info = customer_services_info();
		$data['profile'] = $this->customer_service_model->get_row('users', array('id' => $info['id']));
		$this->form_validation->set_rules('fname', 'first name', 'required');
		$this->form_validation->set_rules('lname', 'last name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$data['profile']->email.']');				
		$this->form_validation->set_rules('mobile', 'mobile', 'required');				
		$this->form_validation->set_rules('city', 'city', 'required');				
		$this->form_validation->set_rules('state', 'state', 'required');				
		$this->form_validation->set_rules('address', 'address', 'required');				
		$this->form_validation->set_rules('country', 'country', 'required');				
		$this->form_validation->set_rules('zip', 'zip', 'required');						
		if ($this->form_validation->run() == TRUE){
			$data = array(
				'firstname' => $this->input->post('fname'),
				'lastname'  => $this->input->post('lname'),
				'email'  	=> $this->input->post('email'),
				'mobile'    => $this->input->post('mobile'),
				'city'		=> $this->input->post('city'),
				'state'		=> $this->input->post('state'),
				'zip' 		=> $this->input->post('zip'),
				'address' 	=> $this->input->post('address'),
				'country' 	=> $this->input->post('country'),				
					);
			$this->customer_service_model->update('users', $data, array('id' => $info['id']));
			$this->session->set_flashdata('success_msg', 'Profile successfully updated');
			redirect(current_url());
		}
		$data['template'] = 'customer_services/profile';
  		$this->load->view('templates/customer_service_template', $data);
	}

	public function check_password_confirmation($new_pass ,$old_pass){
		
        if (sha1($new_pass) == $old_pass){
            return TRUE;
        }else{
            $this->form_validation->set_message('check_password_confirmation', 'Password confirmation failed.');
            return FALSE;
        }
    }
	public function change_password(){
		$login = $this->check_login();
		$info = customer_services_info();
		$data['user'] = $this->customer_service_model->get_row('users', array('id' => $info['id']));
       	$this->form_validation->set_rules('c_pass', 'Confirm Password', 'required|matches[password]');
       	$this->form_validation->set_rules('password', 'New Password', 'required|matches[password]');
       	$this->form_validation->set_rules('old_pass', 'Old Password', 'required|callback_check_password_confirmation['.$data['user']->password.']');
        if($this->form_validation->run() === TRUE){
			$password = array(
				  				'password' => sha1($this->input->post('password')),
						);
			// echo "Password : ".$this->input->post('password');
			// die();
			$this->customer_service_model->update('users', $password, array('id' => $info['id']));
			$this->session->set_flashdata('success_msg', 'Password successfully updated');
			redirect(current_url());
		}
		$data['template'] = 'customer_services/change_password';
		$this->load->view('templates/customer_service_template', $data);
	}

	public function tagged_queries($offset = 0)
	{
		$this->check_login();
		// echo "Login Successfull";
		$limit=10;
		$data['supports'] = $this->customer_service_model->tagged_queries($limit, $offset);
		$config = get_pagination_style();
		$config['base_url'] = base_url().'customer_service/tagged_queries/';
		$config['total_rows'] = $this->customer_service_model->tagged_queries(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();

		$data['template'] = 'customer_services/tagged_queries';
  		$this->load->view('templates/customer_service_template', $data);
	}

	public function supports_reply($support_id=''){
		$this->check_login();
		if($support_id=='')
			redirect('customer_service/tagged_queries');

		$data['support'] = $this->customer_service_model->get_row('supports', array('id'=>$support_id));
		// print_r($data['support']);
  // 		die();
		$data['info'] = customer_services_info();
        $s_name = $data['info']['firstname']." ".$data['info']['lastname'];
        $s_id = $data['info']['id'];
        $s_email = $data['info']['email'];
		$this->form_validation->set_rules('reply', 'reply', 'required');
        if($this->form_validation->run() === TRUE){
        	$update_data = array(
        		'message'   => $this->input->post('reply'),
        		'created'	=> date('Y-m-d H:i:s'),
        		'user_name' => $s_name,
        		'user_id' 	=> $s_id,
        		'email' 	=> $s_email,
        		'support_id'=> $support_id
        	);

        	// print_r($update_data);
        	// die();
        	$name = $data['support']->name;
        	$email = $data['support']->email;
        	$s_subject = $data['support']->subject;

        	$message = $this->input->post('reply');
        	$this->send_support_mail($name, $email,$s_subject,$message);
        	$this->customer_service_model->insert('cs_conversation', $update_data);
        	$this->customer_service_model->update('supports', array('cust_service_replied' => 1, 'superadmin_replied' => 1, 'admin_replied' => 0, 'user_replied' => 0), array('id'=>$support_id));
        	$this->session->set_flashdata('success_msg',"Query Successfully Answered.");
			redirect(current_url());
        }
        
        $reply = $this->customer_service_model->get_result('conversation', array('support_id'=>$support_id));	
		$reply2 = $this->customer_service_model->get_result('cs_conversation', array('support_id'=>$support_id));
		 if ($reply != FALSE && $reply2 != FALSE) { // Validating data records
            $result = array_merge($reply, $reply2); // Merge records array
            usort($result, array($this,'sortFunction')); // Sort Array in DESC
        }elseif($reply){
            $result = $reply;
            usort($result, array($this,'sortFunction'));
        }elseif($reply2){
            $result = $reply2;
            usort($result, array($this,'sortFunction'));
        }else
            $result = FALSE;
        $data['reply'] = $result;
		// if ($reply) {
		// 	if ($reply2) {
		// 		foreach ($reply2 as $rpl) {
		// 			array_push($reply, $rpl);
		// 		}
		// 	}
		// 	$data['reply'] = $reply;
		// }else
		// 	$data['reply'] = $reply2;
        if ($data['support']->is_public_support != 0) {
        	$data['support_type'] = 'public';
        }elseif ($data['support']->admin_id != 0) {
        	$data['support_type'] = 'storeadmin';
        }elseif ($data['support']->customer_id != 0) {
        	$data['support_type'] = 'user';
        }
		$data['template'] = 'customer_services/supports_reply';
        $this->load->view('templates/customer_service_template', $data);
	}

	private function sortFunction( $a, $b ) {
        $d1 = strtotime($a->created);
        $d2 = strtotime($b->created);
        if ($d1 == $d2)
            return  0;
        elseif($d1 < $d2)
            return  -1;
        elseif($d1 > $d2)
            return  1;
    }

	public function send_support_mail($name,$email_to,$s_subject,$message){
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Message From Customer Service';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'Shirtscore.com');	// From email in array form	
		$to = array(
			 $email_to,
		);
		$html = "<em><strong>Hello ".$name." !</strong></em> <br>
				<p><strong>Subject - ".$s_subject."</strong></p>
				<p><strong>Message - ".$message."</strong></p>";
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
	}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
}
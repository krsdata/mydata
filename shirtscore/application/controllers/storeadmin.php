<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Storeadmin extends CI_Controller {	

	public function __construct(){
		parent::__construct();		
		clear_cache();		
		$this->load->model('store_admin_model');
	}

	private function check_login(){
		if(storeadmin_login_in()===FALSE)
			redirect('store/login');
	}
		
	public function index(){
	//$this->output->enable_profiler(TRUE);	
		$this->check_login();
		$data['stores'] = $this->store_admin_model->store_home_dashboard();
		//print_r($data['stores']);
		$uid = storeadmin_id();
		$data['report'] = $this->store_admin_model->dashboard_report($uid);
		$data['pending_designs'] = $this->store_admin_model->get_result('design', array('artist_id' => $uid, 'status' => 0));
		$data['messages']=$this->store_admin_model->get_result('messages', array('status' => 0, 'admin_id' => $uid));

		$data['template'] = 'storeadmin/dashboard';
  		$this->load->view('templates/storeadmin_template', $data);			
	}

	// public function test1(){
	// 	var_dump($_COOKIE['storeadmin_remember_me']);
	// }

	public function login(){
		$this->load->model('login_model');
		if(storeadmin_login_in()===TRUE)
			redirect('storeadmin');

		if(isset($_COOKIE['storeadmin_remember_me'])){
			// echo "here"; die();
			$details = unserialize($_COOKIE['storeadmin_remember_me']);
			$status=$this->login_model->login($details['email'], $details['password'],2);
			if($status['status']){
				setcookie('storeadmin_remember_me',serialize($details),time()+1209600); //set cookie
				redirect('storeadmin/index');
			}else{
				$this->session->set_flashdata('error_msg', $status['error_msg']);
				redirect('store/login');
			}
		}

		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$status=$this->login_model->login($this->input->post('email'),$this->input->post('password'),2);	
			if($status){
				if($this->input->post('rememberme') == 1){
					// echo "1"; die();
					// print_r($info); die();
					$info = $this->session->userdata('storeadmin_info'); 
				$value = array('email' => $this->input->post('email'),'password' => $this->input->post('password'));
				setcookie('storeadmin_remember_me',serialize($value),time()+1209600); //set cookie							
				}

				redirect('storeadmin');
			}
			else
				redirect('store/login');
		}		
	/*	$this->load->view('store/login');
		$this->load->view('templates/store_template', $data);*/
	}

	public function logout(){
	 	$this->session->set_userdata('storeadmin_info','');
	 	$this->session->unset_userdata('storeadmin_info');
	 	$this->session->unset_userdata('customer_info');
	 	setcookie("storeadmin_remember_me", "", time()-3600); //delete cookie	 	
	 	redirect('store/login');
	 }

	 public function check_password($old_pass, $prev_pass){
        if (sha1($old_pass) == $prev_pass){
            return TRUE;
        }else{
            $this->form_validation->set_message('check_password', 'Password confirmation failed');
            return FALSE;
        }
    } 

    public function check_unique_email($new_email, $old_email){
        if ($new_email == $old_email){
            // echo "Same password";
            // die();
            return TRUE;
        }else{
            $resp = $this->user_model->get_row('users', array('email' => $new_email));
            if ($resp){
                $this->form_validation->set_message('check_unique_email', 'Email alredy exist');
                // echo "Not Unique";
                // die();
                return FALSE;
            }else{
                // echo "New password";
                // die();
                return TRUE;
            }
        }
    }
    
	 public function admin_profile(){
        $this->check_login();
        $uid = storeadmin_id();
        $data['user'] = $this->store_admin_model->get_row('users',array('id'=>$uid));
      // print_r($data['user']);
       // die();
        if ($this->input->post('profile')) {
            $this->form_validation->set_rules('firstname', 'First name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$data['user']->email.']');              
            $this->form_validation->set_rules('lastname', 'Last name', 'required');
            //$this->form_validation->set_rules('mobile', 'Phone Number', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');				
			$this->form_validation->set_rules('state', 'State', 'required');				
			$this->form_validation->set_rules('address', 'Address', 'required');				
			$this->form_validation->set_rules('country', 'Country', 'required');				
			$this->form_validation->set_rules('zip', 'Zip', 'required|integer |exact_length[5]');
			$this->form_validation->set_rules('mobile', 'mobile', 'required');
            if ($this->input->post('new_pass') != ''){
                $this->form_validation->set_message('min_length', "Password must contain atleast 6 characters.");
                $this->form_validation->set_rules('old_pass', 'Old Password', 'required|callback_check_password['.$data['user']->password.']');
                $this->form_validation->set_rules('new_pass', 'New Password', 'required|min_length[6]');
            }
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
        }
        if ($this->input->post('payee')) {
            // echo "payee update";
            // die();
             $this->form_validation->set_rules('payee', '', 'required');
            //$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            // $this->form_validation->set_rules('acc_holder', 'A/C Holder Name', 'required');
            // $this->form_validation->set_rules('acc_no', 'A/C number', 'required');
            // $this->form_validation->set_rules('acc_type', 'A/c Type', 'required');
            // $this->form_validation->set_rules('routing_no', 'Routing Number', 'required');
            // $this->form_validation->set_rules('is_paypal', 'Paypal User', 'required');
            if ($this->input->post('is_paypal') == 1) {
                //$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');//paypal_email
            }
        }
        if($this->form_validation->run() == TRUE){
            if($this->input->post('profile')) {
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname'  => $this->input->post('lastname'),
                    'email'     => $this->input->post('email'),
                    'mobile'    => $this->input->post('mobile'),
                    'address'   => $this->input->post('address'),
                    'city'    	=> $this->input->post('city'),
                    'state'    	=> $this->input->post('state'),
                    'country'   => $this->input->post('country'),
                    'zip'    	=> $this->input->post('zip'),
                    'modified'  => date('Y-m-d')            
                );
                if ($this->input->post('new_pass') != '') {
                    $data['password'] = sha1($this->input->post('new_pass'));
                }
                $this->store_admin_model->update('users', $data, array('id' => $uid));
            }

            if ($this->input->post('payee')) {
                $data1 = array(
                    'bank_name'     => $this->input->post('bank_name'),
                    'acc_holder'    => $this->input->post('acc_holder'),
                    'acc_no'        => $this->input->post('acc_no'),
                    'acc_type'      => $this->input->post('acc_type'),
                    'routing_no'    => $this->input->post('routing_no'),
                    'is_paypal'     => $this->input->post('is_paypal'),
                    'paypal_email'  => $this->input->post('paypal_email'),
                    'updated'       => date('Y-m-d')
                );
                // print_r($data1);
                // die();
                 $this->store_admin_model->update('user_payee_info', $data1, array('user_id' => $uid));
            }
            $this->session->set_flashdata('success_msg', 'Profile has been updated successfully.');
            redirect(current_url());
        }
        $data['state']=$this->store_admin_model->get_result('state');
        $data['template'] = 'storeadmin/admin_profile';
  		$this->load->view('templates/storeadmin_template', $data);
	}

	public function change_password(){
		$login = $this->check_login();
		$info = $this->session->userdata('storeadmin_info');
		$data['user'] = $this->store_admin_model->get_row('users', array('id' => $info['id']));
       	$this->form_validation->set_rules('c_pass', 'Confirm Password', 'required|matches[password]');
       	$this->form_validation->set_rules('password', 'New Password', 'required|matches[password]');
       	$this->form_validation->set_rules('old_pass', 'Old Password', 'required');
        if($this->form_validation->run() === TRUE){
 		if($this->input->post('password') != ''){
				$old_pass = $data['user']->password;
				$prev_pass = sha1($this->input->post('old_pass'));
				if ($prev_pass != $old_pass) {
	        		$this->session->set_flashdata('error_msg', 'Invalid Old Password');
	        		redirect('storeadmin/change_password');
	        	}else{
	        		$password = array(
	      			  	'password' => sha1($this->input->post('password')),
	        					);
	        		}
        	 }
			$this->store_admin_model->update('users', $password, array('id' => $info['id']));
			$this->session->set_flashdata('success_msg', 'password successfully updated');
			redirect(current_url(),'refresh');
		}
		$data['template'] = 'storeadmin/change_password';
		$this->load->view('templates/storeadmin_template', $data);
	}



	public function stores($offset = 0){
		$this->check_login(); 		
		$limit=10;
		$data['stores'] = $this->store_admin_model->stores($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/stores/';
		$config['total_rows'] = $this->store_admin_model->stores(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/stores';
        $this->load->view('templates/storeadmin_template', $data);	
	}

	public function check_banner($banner){
		if($_FILES['userfile']['name'] == '')
		{
			$this->form_validation->set_message('check_banner', 'Store Banner required.');
			return FALSE;
		}
		else
			return TRUE;
	}

	public function add_store(){
		$this->check_login();
		$this->form_validation->set_message('is_unique', 'Store link you are choosing already exist.');
		$this->form_validation->set_rules('store_name', 'Store Name', 'required');
		$this->form_validation->set_rules('store_description', 'Store description', 'required');
		$this->form_validation->set_rules('userfile', 'Banner', 'callback_check_banner');
		$this->form_validation->set_rules('store_link', 'Store Link', 'trim|required|xss_clean|is_unique[stores.store_link]');
		if ($this->form_validation->run() == TRUE){			
			$store=array(
				'user_id' => storeadmin_id(),				
				'store_name'=>$this->input->post('store_name'),
				'store_link'=>strtolower(str_replace(' ', '-', trim($this->input->post('store_link')))),
				'store_description'=>$this->input->post('store_description'),
				/*'header_color'=>$this->input->post('header_color'),
				'font_color'=>$this->input->post('font_color'),*/
				'created' => date('Y-m-d')
				);
			if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('storeadmin/add_store/');
				}else{
					$store['store_banner']=$do_upload['upload_data']['file_name'];
				}
			}
			$store_id = $this->store_admin_model->insert('stores',$store);
			$this->session->set_userdata('new_store',$store_id);
			$this->session->set_flashdata('success_msg',"Store has been added successfully wait for approval.");
			redirect('storeadmin/stores');
		}
		$data['store_admin'] = $this->store_admin_model->get_result('users', array('user_role'=>2));
		$data['template'] = 'storeadmin/add_store';
        $this->load->view('templates/storeadmin_template', $data);		
	}
	public function add_more_designs(){
       
	   $this->form_validation->set_rules('artist', 'Artist', 'required');
       $this->form_validation->set_rules('design_title', 'Design title', 'required');
       $this->form_validation->set_rules('description', 'Description', 'required');
       $this->form_validation->set_rules('designfile', 'Design File', 'callback_check_img_size');
       if ($this->session->userdata('new_store'))
	        $store_id = $this->session->userdata('new_store');
	   else{
	    	$this->session->set_flashdata('error_msg','Store details are missing.');
	    	redirect('storeadmin/add_store');
	   }
        if ($this->form_validation->run() == TRUE){
       		//print_r($_POST);
		    // print_r($_FILES);
		    // die();

	        if (isset($_POST["add_more"])) {
	        	$data=array(
	                'artist'=>$this->input->post('artist'),
	                'artist_id'=>customer_id(),
	                'design_title'=>$this->input->post('design_title'),
	                'slug'=>$this->input->post('design_slug'),
	                'description'=>$this->input->post('description'),
	                'category'=>serialize($this->input->post('category')),
	                'created' => date('Y-m-d') 
	            	);
	             
	               if($_FILES['designfile']['name']!=''){
		                $config['upload_path'] = './assets/uploads/designs';
		                $config['allowed_types'] = 'gif|jpg|png';
		                $config['max_size'] = '99999999';
		                $this->load->library('upload', $config);

	                    if ( ! $this->upload->do_upload('designfile')){
	                      $this->session->set_flashdata('error_msg', $do_upload['error']);                      
	                      redirect(current_url());
	                      	//redirect('superadmin/add_product/');
	                    }else{
	                        // echo " <br> Uploded";
	                        $upload_data = $this->upload->data();
	                        $data['design_image'] = $upload_data['file_name'];
	                        $this->designs_thumb_file($data['design_image']);
	                    }
	               }else{
	                	$this->session->set_flashdata('error_msg', 'Please select an image to upload');
	                	redirect(current_url());
	               }

	               $design_id = $this->store_admin_model->insert('design',$data);

		           $this->store_admin_model->insert('design_to_multistore',array('design_id' => $design_id, 'store_id' => $store_id));

		           $data['success_msg'] = 'Design Added Successfully....';

		           $count = $this->input->post('design_count');

		           $count++;

		           $data['design_count'] = $count;

	        }elseif (isset($_POST["save"])) {
	        	$data=array(
	                'artist'=>$this->input->post('artist'),
	                'artist_id'=>customer_id(),
	                'design_title'=>$this->input->post('design_title'),
	                'slug'=>$this->input->post('design_slug'),
	                'description'=>$this->input->post('description'),
	                'category'=>serialize($this->input->post('category')),
	                'created' => date('Y-m-d') 
	                );

	               if($_FILES['designfile']['name']!=''){
		                $config['upload_path'] = './assets/uploads/designs';
		                $config['allowed_types'] = 'gif|jpg|png';
		                $config['max_size'] = '99999999';
		                $this->load->library('upload', $config);
	                    if ( ! $this->upload->do_upload('designfile')){
	                      $this->session->set_flashdata('error_msg', $do_upload['error']);                      
	                      redirect(current_url());
	                      //redirect('superadmin/add_product/');
	                    }else{
	                        // echo " <br> Uploded";
	                        $upload_data = $this->upload->data();   
	                        $data['design_image'] = $upload_data['file_name'];
	                        $this->designs_thumb_file($data['design_image']);
	                    }
	               }else{
		                $this->session->set_flashdata('error_msg', 'Please select an image to upload...');
		                redirect(current_url());
	               }

		           $design_id = $this->store_admin_model->insert('design',$data);

		           $this->store_admin_model->insert('design_to_multistore',array('design_id' => $design_id, 'store_id' => $store_id));
		            
		           $this->store_admin_model->update('stores', array('is_processed' => 1), array('id' => $store_id));
				   
				   $user = $this->store_admin_model->get_row('users', array('id' => customer_id()));

				   $this->send_store_open_email($user->firstname, $user->lastname, $user->email);

				   $this->session->set_userdata('new_store','');

				   $this->session->unset_userdata('new_store');
				   $this->session->set_flashdata('success_msg', 'Store Creation Request Recieved Successfully');
				   redirect('storeadmin/stores');
	        }
	    }

	    if (!isset($data['design_count']))
	    	$data['design_count'] = 0;
	    else{
	    	if(isset($data['success_msg'])){
	    		
	    	$this->session->set_flashdata('success_msg', 'Design Added Successfully....');
	    	 redirect('storeadmin/add_more_designs');
	    	}
	    }

	    $data['category']= $this->store_admin_model->get_result('design_category');
		$data['template'] = 'storeadmin/add_store_designs';
        $this->load->view('templates/storeadmin_template', $data);
    }
    
    public function template_for_store_open($fname, $lname, $email){
     
       $data = array(
                 'name'=>$fname."  ".$lname,
                 'email'=>$email,
               );
       $data['template'] = 'email/template_store_open_registration_on_storeadmin.php';
       $message = $this->load->view('templates/email_template',$data,TRUE);
       return $message;
	}
	
	public function send_store_open_email($fname, $lname, $email){
	
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Shirtscore User';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'Shirtscore.com');	// From email in array form
		$to = array(
			 $email,
		);
		$html = $this->template_for_store_open($fname, $lname, $email);
		$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
		if($is_fail){
		// echo "ERROR :";
		// print_r($is_fail);
		}
		// else{
		// //echo "DONE";
		// }
	}

	public function check_store_link($link, $id){

		if ($link != ''){
			$resp = $this->store_admin_model->get_row('stores', array('id !=' => $id, 'store_link' => $link));
			if ($resp){
				$this->form_validation->set_message('check_store_link', 'Store link you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}else{
			$this->form_validation->set_message('check_store_link', 'Store link required.');
				return FALSE;
		}
	}

	public function edit_store($store_id){
		$this->check_login(); 
		if(empty($store_id))
			redirect('storeadmin/stores');


		$data['store'] = $this->store_admin_model->get_store($store_id);

		if (!$data['store'])
			redirect('storeadmin/stores');	
		
		//$this->form_validation->set_rules('store_name', 'Store Name', 'required');
		$this->form_validation->set_rules('store_description', 'Store description', 'required');
		//$this->form_validation->set_rules('store_link', 'Store Link', 'trim|required|xss_clean|alpha_dash|callback_check_store_link['.$store_id.']');
		if ($this->form_validation->run() == TRUE){

			$store=array(
				'user_id' => storeadmin_id(),				
				//'store_name'=>$this->input->post('store_name'),
				//'store_link'=>strtolower(str_replace(' ', '-', trim($this->input->post('store_link')))),
				'store_description'=>$this->input->post('store_description'),
				/*'header_color'=>$this->input->post('header_color'),
				'font_color'=>$this->input->post('font_color')*/
				);

			/*if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('error_msg' , $do_upload['error']);
					redirect('storeadmin/edit_store/'.$store_id);
				}else{
					$store['store_banner']=$do_upload['upload_data']['file_name'];
					$this->remove_image($store_id);
				}
			}*/
			$this->store_admin_model->update('stores',$store, array('id'=>$store_id));
			$this->session->set_flashdata('success_msg',"Store has been updated successfully.");
			redirect('storeadmin/stores');
		}
		$data['store_admin'] = $this->store_admin_model->get_result('users', array('user_role'=>2));
		$data['template'] = 'storeadmin/edit_store';
        $this->load->view('templates/storeadmin_template', $data);
	}

	public function delete_store($store_id){

		if(empty($store_id) && empty($store_call)) redirect('superadmin/approved_stores');

		$store_ids[] = $store_id;

		$designs = $this->store_admin_model->get_designs_array($store_ids);

		if ($designs) {
			foreach ($designs as $dsn) {
				$other = $this->store_admin_model->get_result('design_to_multistore', array('store_id !=' => $store_id, 'design_id' => $dsn->id));
				if (!$other) {
					$del = $this->store_admin_model->delete('design',array('id' => $dsn->id));
					if ($del) {
						$path='./assets/uploads/designs/';
						if(!empty($dsn->design_image)){
							@unlink($path.$dsn->design_image);
							@unlink($path.'thumbnail/'.$dsn->design_image);
						}
					}
				}
				$this->store_admin_model->delete('design_to_multistore', array('store_id' => $store_id, 'design_id' => $dsn->id));
			}
		}

		$this->store_admin_model->delete('stores', array('id'=> $store_id));		
		$this->session->set_flashdata('success_msg',"Store has been deleted successfully.");
		redirect('storeadmin/stores');
	}

	// public function delete_store($store_id){

	// 	$this->check_login();
	// 	if(empty($store_id)) redirect('storeadmin/stores');

	// 	$data['store'] = $this->store_admin_model->get_store($store_id);
	// 	$this->store_admin_model->delete('stores', array('id'=> $store_id));		
	// 	$this->session->set_flashdata('success_msg',"Store has been deleted successfully.");
	// 	redirect('storeadmin/stores');
	// }

	public function do_upload(){
		$this->check_login(); 	
		$config['upload_path'] = './assets/uploads/store';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload()){
			return array('status'=> FALSE,'error' => $this->upload->display_errors());			
		}else{
			return array('status'=> TRUE,'upload_data' => $this->upload->data());			
		}
	}

	public function remove_image($store_id =''){
		$query = $this->store_admin_model->get_row('stores', array('id'=>$store_id));
		if(!empty($query->store_banner)){
			$path = "assets/uploads/store/";
			unlink($path.$query->store_banner);
			$this->store_admin_model->update('stores', array('store_banner' => ""), array('id' => $store_id));
			// echo "done";
		}
	}

	
	/*public function users($offset=0){
		$this->check_login();
		$store_id = get_store_id(storeadmin_id());
		$limit=10;
		$data['users']=$this->store_admin_model->users($limit, $offset, $store_id);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/users/';
		$config['total_rows'] = $this->store_admin_model->users(0, 0, $store_id);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();	
		$data['template'] = 'storeadmin/users';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function user_purcahses($user_id='')
	{
		if ($user_id == '') {
			$this->session->set_flashdata('error_msg', 'Cannot get user information.');
			redirect('storeadmin/users');
		}

		$store_id = get_store_id(storeadmin_id());

		$store_orders = $this->store_admin_model->store_orders($store_id, $user_id);

		if (!$store_orders) {
			$this->session->set_flashdata('error_msg', 'No orders found.');
			redirect('storeadmin/users');
		}

		$orders =array();
		foreach ($store_orders as $value) {
			$orders[] = $value->order_id;
		}
		
		$data['user_purcahses'] = $this->store_admin_model->user_purcahses($orders);
		$data['pagination'] = FALSE;
		
		// print_r($data['user_purcahses']);
		// die();

		$data['template'] = 'storeadmin/purchased_design';
        $this->load->view('templates/storeadmin_template', $data);
	}*/

	// public function add_user(){
	// 	$this->check_login(); 
	// 	$this->form_validation->set_rules('firstname', 'First name', 'required');
	// 	$this->form_validation->set_rules('lastname', 'Last name', 'required');		
	// 	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
	// 	$this->form_validation->set_rules('phone', 'phone', 'required');
	// 	$this->form_validation->set_rules('city', 'city', 'required');
	// 	$this->form_validation->set_rules('address', 'address', 'required');
	// 	$this->form_validation->set_rules('zip', 'zip', 'required');
	// 	$this->form_validation->set_rules('state', 'state', 'required');
	// 	$this->form_validation->set_rules('country', 'country', 'required');
	// 	$this->form_validation->set_rules('password', 'Password', 'required');
	// 	$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');				
	// 	if ($this->form_validation->run() == TRUE){		
	// 		$name     = $this->input->post('firstname')." ".$this->input->post('lastname');
	// 		$email    = $this->input->post('email');
	// 		$password = $this->input->post('password');

	// 		$user=array(
	// 			'user_role' =>3,
	// 			'firstname'=>$this->input->post('firstname'),
	// 			'lastname'=>$this->input->post('lastname'),
	// 			'email'=>$this->input->post('email'),
	// 			'mobile'=>$this->input->post('phone'),
	// 			'address'=>$this->input->post('address'),
	// 			'city'=>$this->input->post('city'),
	// 			'zip'=>$this->input->post('zip'),
	// 			'state'=>$this->input->post('state'),
	// 			'country'=>$this->input->post('country'),
	// 			'password'=>sha1(trim($this->input->post('password'))),				
	// 			'created' => date('Y-m-d')
	// 			);

	// 		$this->store_admin_model->insert('users',$user);		
	// 		$this->send_registration_mail($name, $email, $password);
	// 		$this->session->set_flashdata('success_msg',"user has been added successfully.");
	// 		redirect('storeadmin/users');
	// 	}
	// 	$data['template'] = 'storeadmin/add_user';
 //        $this->load->view('templates/storeadmin_template', $data);		
	// }

	public function send_registration_mail($name, $email, $password){
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'shirtscore.com';
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');
		$to = array(
			 $email,
		);
		$html = "<em><strong>Hello ".$name." !</strong></em> your Account has been successfully created, you can login with the following credentials <br>
				<p><strong>Email - ".$email."</strong></p>
				<p><strong>Password - ".$password."</strong></p>";
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	/*public function edit_user($id=''){
		$this->check_login();
		if(empty($id)) redirect('storeadmin/users');

		if($this->input->post('email') !=""){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');			
		}
		$this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');			
		$this->form_validation->set_rules('phone', 'phone', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('zip', 'zip', 'required');
		$this->form_validation->set_rules('state', 'state', 'required');
		$this->form_validation->set_rules('country', 'country', 'required');					
		if ($this->form_validation->run() == TRUE){				
			$user=array(				
				'firstname'=>$this->input->post('firstname'),
				'lastname'=>$this->input->post('lastname'),				
				'mobile'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'zip'=>$this->input->post('zip'),
				'state'=>$this->input->post('state'),
				'country'=>$this->input->post('country'),								
				);
			if($this->input->post('email') !=""){
				$user['email']=$this->input->post('email');
			}
			$this->store_admin_model->update('users',$user,array('id'=>$id));
			$this->session->set_flashdata('success_msg',"user has been updated successfully.");
			redirect('storeadmin/users');
		}

		$data['users'] = $this->store_admin_model->get_row('users',array('id'=>$id));
		$data['template'] = 'storeadmin/edit_user';
        $this->load->view('templates/storeadmin_template', $data);	
        
	}
	public function user_details($user_id){
		$this->check_login(); 
		if(empty($user_id)) redirect('storeadmin/users');

		$data['results'] = $this->store_admin_model->get_row('users', array('id' => $user_id));
		$data['template'] = 'storeadmin/user_details';
        $this->load->view('templates/storeadmin_template', $data);		
	}*/
	
	public function remove_page_image($page_id){
		$data['pages'] = $this->store_admin_model->get_row('pages',array('id'=>$page_id));		
		if(!empty($data['pages']->image)){
		$path='./assets/uploads/';		
			@unlink($path.$data['pages']->image);
			$this->store_admin_model->update('pages', array('image' => ""), array('id' => $page_id));
			echo "done";
		}
	}

	public function delete_user($id){
		$this->check_login();
		if(empty($id)) redirect('storeadmin/users');
		$this->store_admin_model->delete('users',array('id'=>$id));		
		$this->session->set_flashdata('success_msg','user has been deleted successfully.');
		redirect('storeadmin/users');
	}
	

	public function block_user($user_id='', $val=''){
		$this->check_login(); 
		if(empty($user_id) && empty($val)) redirect('storeadmin/users');
		$this->store_admin_model->update('users', array('banned'=> $val), array('id' => $user_id));		
		if($val == 0){
			$this->session->set_flashdata('success_msg', 'User unblocked successfully');
		}
		if($val == 1){
			$this->session->set_flashdata('success_msg', 'User successfully blocked');
		}
		redirect('storeadmin/users');
	}

	public function supports($offset = 0){
		$this->check_login();
		$limit=10;
		$data['supports']= FALSE;
		//$this->store_admin_model->supports($limit, $offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'storeadmin/supports/';
		$config['total_rows'] = 0;
		// $this->store_admin_model->supports(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/supports';
        $this->load->view('templates/storeadmin_template', $data);
	}

	public function supports_reply($support_id=''){
		$this->check_login();
		if(empty($support_id)) redirect('storeadmin/supports');

		$data['support'] = $this->store_admin_model->get_row('supports', array('id'=>$support_id));	
		$this->form_validation->set_rules('answer', 'Answer', 'required');
        if($this->form_validation->run() === TRUE){
        	$update_data = array(
        		'answer'     => $this->input->post('answer'),
        		'admin_replied'=> 1,
        		'superadmin_replied'=>0,
        		'cust_service_replied'=>0,
        		'updated'	 =>date('Y-m-d H:i:s'),
        	);
        	$name = $data['support']->name;
        	$email = $data['support']->email;
        	$s_subject = $data['support']->subject;
        	$message = $this->input->post('answer');
        	$this->send_support_mail($name, $email,$s_subject,$message);
        	$this->store_admin_model->update('supports', $update_data, array('id' => $support_id));
        	$this->session->set_flashdata('success_msg',"Replied Successfully.");
			redirect('storeadmin/supports');
        }
		$data['template'] = 'storeadmin/supports_reply';
        $this->load->view('templates/storeadmin_template', $data);
	}

	public function send_support_mail($name,$email_to,$s_subject,$message){
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Message From storeadmin';	
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');
		$to = array(
			 $email_to,
		);
		$html = "<em><strong>Hello ".$name." !</strong></em> <br>
				<p><strong>Subject - ".$s_subject."</strong></p>
				<p><strong>Message - ".$message."</strong></p>";
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	public function need_help(){
		$this->check_login();		
		$admin = $this->session->userdata('storeadmin_info');					
		$data['info'] = $this->store_admin_model->get_row('users', array('id' => $admin['id']));
		$name = $data['info']->firstname." ".$data['info']->lastname;			
		$email = $data['info']->email;
        $this->form_validation->set_rules('subject', 'Subject', 'required');      
        $this->form_validation->set_rules('question', 'question', 'required');      
		if($this->form_validation->run() === TRUE){			
			$support=array(
					'name'=>$name,					
					'email'=>$email,										
					'admin_id'=>$admin['id'],					
					'subject'=>$this->input->post('subject'),			
					'question'=>$this->input->post('question'),								
					'created'=>date('Y-m-d h:i:s'),			
					);		
			$last_id = $this->store_admin_model->insert('supports',$support);
			$token=str_pad($last_id, 5, "0", STR_PAD_LEFT);					
			$token_new= date('y').$token;
			$resp = $this->store_admin_model->update('supports',array('token' => $token_new), array('id' => $last_id));
			if ($resp){				
				$subject = $this->input->post('subject');
				$message = $this->input->post('question');

				$this->sendmail_to_superadmin($token_new,$email,$name,$subject,$message);
				 $this->load->library('smtp_lib/smtp_email');
		         $subject = 'Successfully received query';                                     // Subject for email
		         $from = array("no-reply@shirtscore.com" =>'shirtscore.com');              // From email in array form
		         $to = array(
		                $email
		         		);                                                                  // To email address in array form

		         // $html = "<em><strong>Hello</strong></em> <br>
		         //        <p>".$name." Thank you for contacting with us, <br> We have recieved your Query and we will respond back to you soon.</p>
		         //        <strong>Your Token no. :</strong> <strong>".$token_new."</strong><br><br>
		         // ";
		         $html = $this->template_sendmail_to_superadmin($name,$token_new);
		         $is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
			} 
			$this->session->set_flashdata('success_msg', 'query Successfully submitted');
			redirect('storeadmin/my_queries');     	
		}

		$data['template'] = 'storeadmin/need_help';
        $this->load->view('templates/storeadmin_template', $data);	
	}

	public function template_sendmail_to_superadmin($name,$token_new){
      $data['name'] = $name;
      $data['token_new'] = $token_new;
      $data['template'] = 'email/need_help_template';
      $message = $this->load->view('templates/email_template',$data,TRUE);
      return $message;
    }
    
	public function sendmail_to_superadmin($token_new,$email,$name,$subject1,$message){
		$query = $this->store_admin_model->get_row('users', array('user_role' => 0));
		$superadmin_email =  $query->email;
		$this->load->library('smtp_lib/smtp_email');
		         $subject = $token_new;
		         $from = array("no-reply@shirtscore.com" =>'shirtscore.com');
		         $to = array(		  
						$superadmin_email,		         	                  
		         );                 		        
		         $html = "<em><strong>Support Query</strong></em> <br>
		                <p> Name -".$name."</p>
		                <p> Email -".$email."</p>
		                <p> Subject -".$subject1."</p>
		                <p> Message -".$message."</p>
		                <strong>Token no. :</strong> <strong>".$token_new."</strong><br><br>";
		        $this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	public function my_queries($offset=0){
		$this->check_login(); 			
		$limit=10;
		$data['queries']=$this->store_admin_model->my_query($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/my_queries/';
		$config['total_rows'] = $this->store_admin_model->my_query(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();	
		$data['template'] = 'storeadmin/my_queries';
        $this->load->view('templates/storeadmin_template', $data);
						
	}

	public function send_reply_mail($reply_to, $name, $email,$s_subject,$message){
		
		$this->load->library('smtp_lib/smtp_email');
		         $subject = 'Reply from '.$name;                                     
		         $from = array("no-reply@shirtscore.com" =>'shirtscore.com');        
		         $to = array(		  
						$reply_to,         	                  
		         );
		         $html = "<em><strong>Support Query</strong></em> <br>
		                <p> Name -".$name."</p>
		                <p> Email -".$email."</p>
		                <p> Subject -".$s_subject."</p>
		                <p> Message -".$message."</p>
		                <br><br>";
		        $this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	public function view_query($support_id=''){
		$this->check_login(); 
		if(empty($support_id)) redirect('storeadmin/my_queries');

		$data['info'] = $this->session->userdata('storeadmin_info');					
		$data['results'] = $this->store_admin_model->get_row('supports', array('id' => $support_id));

		$a_name = $data['info']['firstname']." ".$data['info']['lastname'];
        $admin_id = $data['info']['id'];
        $admin_email = $data['info']['email'];

		$this->form_validation->set_rules('reply', 'reply', 'required');
        if($this->form_validation->run() === TRUE){     	

        	$update_data = array(
        		'message'   => $this->input->post('reply'),        		
        		'created'	=> date('Y-m-d H:i:s'),
        		'user_name' => $a_name,
        		'user_id' 	=> $admin_id,
        		'email' 	=> $admin_email,
        		'support_id'=> $support_id
        	);

        	$name = $data['results']->name;
        	$email = $data['results']->email;
        	$s_subject = $data['results']->subject;

        	$is_tagged = $this->store_admin_model->get_row('support_tags', array('support_id' => $support_id));

        	if ($is_tagged) {
        		$query = $this->store_admin_model->get_row('users', array('id' => $is_tagged->cust_service_id));
				$reply_to =  $query->email;
        	}else{
        		$query = $this->store_admin_model->get_row('users', array('user_role' => 0));
				$reply_to =  $query->email;
        	}
        	
        	$message = $this->input->post('reply');        
        	$this->send_reply_mail($reply_to, $name, $email, $s_subject, $message);
        	if ($is_tagged) {
        		$this->store_admin_model->insert('cs_conversation', $update_data);
	        	$this->store_admin_model->update('supports', array('cust_service_replied'=>0, 'superadmin_replied'=>0, 'admin_replied'=>1),array('id'=>$support_id));
        	}else{
	        	$this->store_admin_model->insert('conversation', $update_data);
	        	$this->store_admin_model->update('supports', array('cust_service_replied'=>0, 'superadmin_replied'=>0, 'admin_replied'=>1),array('id'=>$support_id));
        	}	
        	$this->session->set_flashdata('success_msg',"Replied Successfully.");
			redirect(current_url(),'refresh');
        }	

		$reply = $this->store_admin_model->get_result('conversation', array('support_id'=>$support_id));	
		$reply2 = $this->store_admin_model->get_result('cs_conversation', array('support_id'=>$support_id));

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
		
		$data['template'] = 'storeadmin/view_query';
        $this->load->view('templates/storeadmin_template', $data);		
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
	
	public function delete_query($id=''){
		$this->check_login();
		if(empty($id)) redirect('storeadmin/my_queries');

		$this->store_admin_model->delete('supports',array('id'=>$id));		
		$this->session->set_flashdata('success_msg','query has been deleted successfully.');
		redirect('storeadmin/my_queries');
	}
	public function products($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['products']=$this->store_admin_model->products($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/products/';
		$config['total_rows'] = $this->store_admin_model->products(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();

		$data['template'] = 'storeadmin/products';
        $this->load->view('templates/storeadmin_template', $data);		
	}


	public function product_info($product_id=''){
		$this->check_login();
		if(empty($product_id)) redirect('storeadmin/products');
		$col_arr = array();
		$col_img = array();
		$data['product'] = $this->store_admin_model->get_product($product_id);
		if (!empty($data['product']->category_id))
			$data['categories'] = $this->store_admin_model->get_products_categories(unserialize($data['product']->category_id));
		else
			$data['categories']='';
		$color = $this->store_admin_model->get_colors($product_id);
		$i=1;
		foreach ($color as $val) {
			$col_img[$val->view] = $val->image_name;
			if ($i == 4) {
				$col_arr[] = array('color_id' => $val->color_id, 'color_code' => $val->color_code, 'color_img' => $col_img, );
				$col_img = array();
				$i=0;
			}
			$i++;
		}
		$data['color'] = $col_arr;
		$data['template'] = 'storeadmin/product_info';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function display_products($type="-", $month="-", $year="-",$offset = 0){
		$this->check_login();	
		if($this->input->post('select'))
			$type = $this->input->post('select');
		if($type == 'month'){
			if($this->input->post('month'))
				$month = $this->input->post('month');
			if($this->input->post('year'))
				$year = $this->input->post('year');
			$limit=10;
			$data['month'] = $month;
			$data['type'] = $type;
			$data['year'] = $year;
			$data['products'] = $this->store_admin_model->display_products($limit, $offset, $type, $month, $year);				
			$config= get_pagination_style();	
			$config['base_url'] = base_url().'storeadmin/display_products/'.$type."/".$month."/".$year."/";
			$config['total_rows'] = $this->store_admin_model->display_products(0, 0, $type, $month, $year);
			$config['uri_segment'] = 6;
			$config['per_page'] = $limit;
			$config['num_links'] = 5;		
			$this->pagination->initialize($config); 		
			$data['pagination'] = $this->pagination->create_links();
			$data['template'] = 'storeadmin/display_products';
	        $this->load->view('templates/storeadmin_template', $data);										
		}elseif ($type == "year"){
			if($this->input->post('year'))		
				$year = $this->input->post('year');

			$limit=10;				
			$data['type'] = $type;
			$data['year'] = $year;
			$data['products'] = $this->store_admin_model->display_products($limit, $offset, $type, $month="", $year);				
			$config= get_pagination_style();	
			$config['base_url'] = base_url().'storeadmin/display_products/'.$type."/0/".$year."/";
			$config['total_rows'] = $this->store_admin_model->display_products(0, 0, $type, $month, $year);
			$config['uri_segment'] = 6;
			$config['per_page'] = $limit;
			$config['num_links'] = 5;		
			$this->pagination->initialize($config); 		
			$data['pagination'] = $this->pagination->create_links();

			$data['template'] = 'storeadmin/display_products';
	        $this->load->view('templates/storeadmin_template', $data);
		}
		else
			redirect('storeadmin/products');
	}

	public function product_categories($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['product_categories']=$this->store_admin_model->product_categories($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/product_categories/';
		$config['total_rows'] = $this->store_admin_model->product_categories(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/product_categories';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function add_product_category(){
		$this->check_login(); 			
		$this->form_validation->set_rules('category', 'category', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'category_name'=>$this->input->post('category'),
				'created' => date('Y-m-d H:i:s')		
				);			
			$this->store_admin_model->insert('product_category',$data);		
			$this->session->set_flashdata('success_msg',"category has been added successfully.");
			redirect('storeadmin/product_categories');
		}
		$data['template'] = 'storeadmin/add_product_category';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function edit_product_category($cat_id=''){
		$this->check_login(); 
		if(empty($cat_id)) redirect('storeadmin/product_categories');
 
		$this->form_validation->set_rules('category', 'category', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'category_name'=>$this->input->post('category'),
				);	
				// print_r($data); die();		
			$this->store_admin_model->update('product_category',$data,array('id'=>$cat_id));
			$this->session->set_flashdata('success_msg',"category has been updated successfully.");
			redirect('storeadmin/product_categories');
		}		
		$data['product_categories'] = $this->store_admin_model->get_row('product_category',array('id'=>$cat_id));
		$data['template'] = 'storeadmin/edit_product_category';
        $this->load->view('templates/storeadmin_template', $data);	        
	}


	public function delete_product_category($cat_id=''){
		$this->check_login();	
		if(empty($cat_id)) redirect('storeadmin/product_categories');

		$this->store_admin_model->delete('product_category',array('id'=>$cat_id));
		$this->session->set_flashdata('success_msg',"Category has been deleted successfully.");
			redirect('storeadmin/product_categories');
	}

	public function check_prod_slug($slug, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_slug = $param[1];
		if ($called === 'add'){
			$resp = $this->store_admin_model->get_row('products', array('slug' => $slug));
			if ($resp){
				$this->form_validation->set_message('check_prod_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif ($old_slug === $slug) {
				return TRUE;
		}else{
			$resp = $this->store_admin_model->get_row('products', array('slug' => $slug));
			if ($resp) {
				$this->form_validation->set_message('check_prod_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

	public function check_size($fields){
		if ($fields[0] == ''){
			$this->form_validation->set_message('check_size', 'Size required.');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function add_product(){
		$this->check_login();
		if (!($this->session->userdata('new_product_info'))){
			$this->session->set_flashdata('error_msg', 'No product created...');
			redirect('storeadmin/submit_product');
		}
		$product = $this->session->userdata('new_product_info');
		$product_used = $this->store_admin_model->get_row('products', array('id' => $product['product_used']));
		$this->form_validation->set_rules('store_id', 'Store', 'required');
		$this->form_validation->set_rules('regular_name', 'regular name', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('desc', 'desc', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_prod_slug['."add,slug".']');
		if ($this->form_validation->run() == TRUE){

			$this->create_cust_thumb($product['prod_img']);
			$data=array(
				'size_id'=>$product_used->size_id,			
				'group_id'=>$product_used->group_id,
				'regular_name'=>$this->input->post('regular_name'),				
				'sizechart'=>$product_used->sizechart,
				'price'=>$product['price'],
				'main_image' => $product['prod_img'],
				'image_url' => base_url().$product['png_url'],
				'store_id' => $this->input->post('store_id'),
				'desc' => $this->input->post('desc'),								
				'admin_custom' => 1,
				'created' => date('Y-m-d H:i:s')		
			);

			if ($this->input->post('category') != ''){
				$data['category_id'] = serialize($this->input->post('category'));
			}
			else{
				$data['category_id'] = '';
			}
			
			$this->store_admin_model->insert('products',$data);

			$this->session->set_flashdata('success_msg',"Product has been created successfully.");
			redirect('storeadmin/products');
		}
		$data['sizes'] = $this->store_admin_model->custom_product_sizes(unserialize($product_used->size_id));
		$data['product'] = $product;
		$data['my_stores'] = $this->store_admin_model->my_stores();
		$data['stores'] = $this->store_admin_model->get_result('stores');
		$data['product_categories'] = $this->store_admin_model->get_result('product_category');
		$data['template'] = 'storeadmin/add_product';
        $this->load->view('templates/storeadmin_template', $data);		
	}


	public function edit_product($product_id=''){
		$this->check_login();
		if ($product_id == ''){
			$this->session->set_flashdata('error_msg', 'Product Id  not found....!!!');
			redirect('storeadmin/products');
		}
		$data['product'] = $this->store_admin_model->get_row('products',array('id'=>$product_id));
		$this->form_validation->set_rules('group_id', 'group_id', 'required');				
		$this->form_validation->set_rules('prefix', 'prefix', 'required');		
		$this->form_validation->set_rules('regular_name', 'regular name', 'required');		
		$this->form_validation->set_rules('short_name', 'short name', 'required');		
		$this->form_validation->set_rules('singular', 'singular', 'required');		
		$this->form_validation->set_rules('uri', 'URI', 'required');		
		$this->form_validation->set_rules('size_id', 'size_id', 'callback_check_size');		
		$this->form_validation->set_rules('price', 'price', 'required');		
		$this->form_validation->set_rules('desc', 'desc', 'required');				
		if ($this->form_validation->run() == TRUE){	
		

			$update_data=array(
				'size_id'=>serialize($this->input->post('size_id')),			
				'group_id'=>$this->input->post('group_id'),				
				'prefix'=>$this->input->post('prefix'),				
				'regular_name'=>$this->input->post('regular_name'),				
				'short_name'=>$this->input->post('short_name'),				
				'singular'=>$this->input->post('singular'),				
				'uri'=>$this->input->post('uri'),				
				'sizechart'=>$this->input->post('sizechart'),				
				'price'=>$this->input->post('price'),				
				'desc'=>$this->input->post('desc'),				
				'modified'=> date('Y-m-d h:i:s')							
				);

			if ($this->input->post('category') != ''){
				$update_data['category_id'] = serialize($this->input->post('category'));
			}
			else{
				$update_data['category_id'] = '';
			}

			// print_r($data['category_id']);
			// print_r($this->input->post('category'));
			// die();	

			if($_FILES['userfile']['name']!=''){

				$path ='assets/uploads/products/';

				$thumb_path ='assets/uploads/products/thumbnail/';

				if(!empty($data['product']->main_image)){

					unlink($path.$data['product']->main_image);
					unlink($thumb_path.$data['product']->main_image);
				}

				$config['upload_path'] = './assets/uploads/products';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '10000';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload()){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('storeadmin/edit_product/');
				}else{
				   $upload_data = $this->upload->data();			
					$update_data['main_image']=$upload_data['file_name'];
				}
				$this->create_thumb_file($update_data['main_image']);
			}

			$this->store_admin_model->update('products',$update_data,array('id'=>$product_id));
			$this->session->set_flashdata('success_msg',"product has been updated successfully.");
			redirect('storeadmin/products');
		}
		$data['stores'] = $this->store_admin_model->get_result('stores');
		$data['category'] = $this->store_admin_model->get_result('product_category');
		$data['sizes'] = $this->store_admin_model->get_result('product_sizes');
		$data['group'] = $this->store_admin_model->get_result('product_group');
		$data['product_categories'] = $this->store_admin_model->get_result('product_category');
		$data['template'] = 'storeadmin/edit_product';
        $this->load->view('templates/storeadmin_template', $data);
        
	}

	public function create_cust_thumb($file){

		$path='./assets/uploads/custom_prod_img';	
		 if (!is_writable($path.'/')) {
            if (!chmod($path.'/', 0777)) {
                 echo "Cannot change the mode of file ($0777)";
                 exit;
            }
        }

		// create file rezize
		$this->load->library('image_lib');
		$config2['image_library'] = 'gd2';
		$config2['source_image'] = $path.'/'.$file;
		$config2['new_image'] = $path.'/thumbnail/'.$file;
		// $config2['new_image'] = $path.'/'.$file;
		$config2['quality'] = '100%';
		$config2['maintain_ratio'] = FALSE;
		$config2['width'] = 100;
		$config2['height']	= 100;
		$this->image_lib->initialize($config2);

		if ( ! $this->image_lib->resize()){
			 echo $this->image_lib->display_errors(); 
			 exit;
		}

		$this->image_lib->clear();
	
	}

	public function product_status($product_id='', $val=''){
		if(empty($product_id)) redirect('storeadmin/products');
		$this->store_admin_model->update('products', array('product_status' => $val), array('id' => $product_id));
		if($val == 1)
			$this->session->set_flashdata('success_msg', 'Product Successfully Published');
		else
			$this->session->set_flashdata('success_msg', 'product Successfully Unpublished');
		redirect('storeadmin/products');
					
	}


	public function delete_product($product_id=''){
		$this->check_login();
		if(empty($product_id)) redirect('storeadmin/products');

		$images = $this->store_admin_model->get_row('products', array('id'=>$product_id));		
		if(!empty($images->main_image)){			
			$path ='assets/uploads/custom_prod_img/';
			$thumb_path ='assets/uploads/custom_prod_img/thumbnail/';
			unlink($path.$images->main_image);
			unlink($thumb_path.$images->main_image);
		}
		$this->store_admin_model->delete('products',array('id'=>$product_id));
		$this->session->set_flashdata('success_msg',"product has been deleted successfully.");
		redirect('storeadmin/products');
	}	

	public function sizes($offset=0){
		$this->check_login(); 		
		$limit=10;
		$data['sizes']=$this->store_admin_model->sizes($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/sizes/';
		$config['total_rows'] = $this->store_admin_model->sizes(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/sizes';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function add_size(){
		$this->check_login(); 	
		$this->form_validation->set_rules('size_name', 'size name', 'required');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(					
				'size_name'=>$this->input->post('size_name'),								
				'created' => date('Y-m-d H:i:s')		
				);	
			$this->store_admin_model->insert('product_sizes',$data);		
			$this->session->set_flashdata('success_msg',"Added Successfully.");
			redirect('storeadmin/sizes');
		}
		$data['template'] = 'storeadmin/add_size';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function edit_size($id=''){
		$this->check_login();
		if(empty($id)) redirect('storeadmin/sizes');

		$this->form_validation->set_rules('size_name', 'size name', 'required');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(				
				'size_name'=>$this->input->post('size_name'),				
				'updated' => date('Y-m-d H:i:s')		
				);	
			$this->store_admin_model->update('product_sizes',$data, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"Successfully Updated.");
			redirect('storeadmin/sizes');
		}
		$data['size'] = $this->store_admin_model->get_row('product_sizes', array('id'=>$id));
		$data['template'] = 'storeadmin/edit_size';
        $this->load->view('templates/storeadmin_template', $data);
        
	}

	public function delete_size($size_id){
		$this->check_login();
		if(empty($size_id)) redirect('storeadmin/sizes');
		 
		$this->store_admin_model->delete('product_sizes',array('id'=>$size_id));
		$this->session->set_flashdata('success_msg',"Deleted successfully.");
			redirect('storeadmin/sizes');
	}

	public function product_group($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['product_group']=$this->store_admin_model->product_group($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/product_group/';
		$config['total_rows'] = $this->store_admin_model->product_group(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/product_group';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function add_group(){
		$this->check_login(); 			
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'group_name'=>$this->input->post('group_name'),				
				'created' => date('Y-m-d H:i:s')		
				);			
			$this->store_admin_model->insert('product_group',$data);		
			$this->session->set_flashdata('success_msg',"group has been added successfully.");
			redirect('storeadmin/product_group');
		}
		$data['template'] = 'storeadmin/add_group';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function edit_group($group_id=''){
		$this->check_login(); 
		if(empty($group_id))redirect('storeadmin/product_group');
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'group_name'=>$this->input->post('group_name'),								
				);			
			$this->store_admin_model->update('product_group',$data,array('id'=>$group_id));
			$this->session->set_flashdata('success_msg',"group has been updated successfully.");
			redirect('storeadmin/product_group');
		}		
		$data['product_group'] = $this->store_admin_model->get_row('product_group',array('id'=>$group_id));
		$data['template'] = 'storeadmin/edit_group';
        $this->load->view('templates/storeadmin_template', $data);	        
	}




	public function delete_group($group_id){	
		if(empty($group_id))redirect('storeadmin/product_group');

		$this->store_admin_model->delete('product_group',array('id'=>$group_id));
		$this->session->set_flashdata('success_msg',"group has been deleted successfully.");
			redirect('storeadmin/product_group');
	}


	public function categories($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['categories']=$this->store_admin_model->categories($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/categories/';
		$config['total_rows'] = $this->store_admin_model->categories(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/categories';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function add_category(){
		$this->check_login(); 			
		$this->form_validation->set_rules('category', 'category', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'category_name'=>$this->input->post('category'),				
				'created' => date('Y-m-d H:i:s')		
				);			
			$this->store_admin_model->insert('product_category',$data);		
			$this->session->set_flashdata('success_msg',"category has been added successfully.");
			redirect('storeadmin/categories');
		}
		$data['template'] = 'storeadmin/add_category';
        $this->load->view('templates/storeadmin_template', $data);		
	}


	public function edit_category($category_id=''){
		$this->check_login(); 
		if(empty($category_id)) redirect('storeadmin/categories');

		$this->form_validation->set_rules('category', 'category', 'required');
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'category_name'=>$this->input->post('category'),								
				);			
			$this->store_admin_model->update('product_category',$data,array('id'=>$category_id));
			$this->session->set_flashdata('success_msg',"category has been updated successfully.");
			redirect('storeadmin/categories');
		}	

		$data['category'] = $this->store_admin_model->get_row('product_category',array('id'=>$category_id));
		$data['template'] = 'storeadmin/edit_category';
        $this->load->view('templates/storeadmin_template', $data);	        
	}

	

	public function delete_category($category_id=''){
		if(empty($category_id)) redirect('storeadmin/categories');

		$this->store_admin_model->delete('product_category',array('id'=>$category_id));
		$this->session->set_flashdata('success_msg',"category has been deleted successfully.");
			redirect('storeadmin/categories');
	}

	public function parameters($product_id){
		$this->check_login(); 
		if(empty($product_id)) redirect('storeadmin/products');
		
		$data['product_id'] = $product_id;
		$data['parameters'] = $this->store_admin_model->get_result('product_parameters',array('product_id'=>$product_id));
		$data['template'] = 'storeadmin/parameters';
        $this->load->view('templates/storeadmin_template', $data);		
	}


	public function add_parameters($product_id=''){
		$this->check_login();
		if(empty($product_id)) redirect('storeadmin/products');

		$this->form_validation->set_rules('size', 'size', 'required');		
		$this->form_validation->set_rules('price', 'price', 'required');				
		$this->form_validation->set_rules('weight', 'weight', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'product_id' => $product_id,
				'size'=>$this->input->post('size'),				
				'price'=>$this->input->post('price'),				
				'weight'=>$this->input->post('weight'),								
				);			
			$this->store_admin_model->insert('product_parameters',$data);		
			$this->session->set_flashdata('success_msg',"parameter has been added successfully.");
			redirect('storeadmin/parameters/'.$product_id);
		}		
		$data['template'] = 'storeadmin/add_parameters';
        $this->load->view('templates/storeadmin_template', $data);		
	}


	public function edit_parameters($product_id,$parameter_id=''){
		$this->check_login();
		if(empty($product_id) && empty($parameter_id)) redirect('storeadmin/products');

		$this->form_validation->set_rules('size', 'size', 'required');		
		$this->form_validation->set_rules('price', 'price', 'required');				
		$this->form_validation->set_rules('weight', 'weight', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'product_id' => $product_id,
				'size'=>$this->input->post('size'),				
				'price'=>$this->input->post('price'),				
				'weight'=>$this->input->post('weight'),								
				);			
			$this->store_admin_model->update('product_parameters',$data,array('id'=>$parameter_id));
			$this->session->set_flashdata('success_msg',"parameter has been updated successfully.");
			redirect('storeadmin/parameters/'.$product_id);
		}		
		$data['parameters'] = $this->store_admin_model->get_row('product_parameters', array('id'=> $parameter_id)); 
		$data['template'] = 'storeadmin/edit_parameters';
        $this->load->view('templates/storeadmin_template', $data);	
        
	}

	

	public function delete_parameters($product_id, $parameter_id){
		$this->check_login();
		if(empty($product_id) && empty($parameter_id)) redirect('storeadmin/products');

		$this->store_admin_model->delete('product_parameters', array('id'=>$parameter_id));
		$this->session->set_flashdata('success_msg',"parameter has been deleted successfully.");
			redirect('storeadmin/parameters/'.$product_id);
	}

	public function colors($product_id){		
		$this->check_login();
		if(empty($product_id)) redirect('storeadmin/products'); 
		$data['product_id'] = $product_id;		
		$data['color']=$this->store_admin_model->colors($product_id);
		$data['template'] = 'storeadmin/colors';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function add_color($product_id){
		$this->check_login(); 
		if(empty($product_id)) redirect('storeadmin/products'); 

		$this->form_validation->set_rules('color', 'color', 'required');			
		$this->form_validation->set_rules('front', 'color', 'callback_check_front_img['."add".']');
		$this->form_validation->set_rules('left', 'color', 'callback_check_left_img['."add".']');
		$this->form_validation->set_rules('back', 'color', 'callback_check_back_img['."add".']');
		$this->form_validation->set_rules('right', 'color', 'callback_check_right_img['."add".']');	
		if ($this->form_validation->run() == TRUE){
			$img = array();
			$data=array(
				'color_code'=>$this->input->post('color'),
				'product_id'=> $product_id,
				'created'=> date('Y-m-d')
				);

			$color_id = $this->store_admin_model->insert('product_colors', $data);						
			$images = array('front','back','left','right');

			foreach ($images as $name)
			{
				$img['view'] = $name;

				$img['image_name'] = $this->color_img_upload($name);

				$this->create_design_thumb($img['image_name']); 

				$img['product_id']=$product_id;

				$img['color_id'] = $color_id;

				$img['created'] = date('Y-m-d');

				$this->store_admin_model->insert('product_images',$img);		
			}

			$this->session->set_flashdata('success_msg',"Successfully Added.");
			redirect('storeadmin/colors/'.$product_id);
		}
		$data['template'] = 'storeadmin/add_colors';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function edit_color($product_id='',$color_id=''){
		$this->check_login();
		if(empty($product_id) && empty($color_id)) redirect('storeadmin/products');

		$this->form_validation->set_rules('color', 'color', 'required');
		$this->form_validation->set_rules('front', 'color', 'callback_check_front_img['."edit".']');
		$this->form_validation->set_rules('left', 'color', 'callback_check_left_img['."edit".']');
		$this->form_validation->set_rules('back', 'color', 'callback_check_back_img['."edit".']');
		$this->form_validation->set_rules('right', 'color', 'callback_check_right_img['."edit".']');			
		if ($this->form_validation->run() == TRUE){		
			// print_r($_POST); die();	

			$colors=array(
				'color_code'=>$this->input->post('color'),								
				);

			$this->store_admin_model->update('product_colors',$colors,array('id'=>$color_id));

			$images = array('front','back','left','right');
			$img_save = array();
			$k = 0;
			// Tommorrow Task
			foreach ($images as $name)
			{
				if($this->input->post($name.'1') == '')
				{
					$img['view'] = $name;
					$img['image_name'] = $this->color_img_upload($name);
					$this->create_design_thumb($img['image_name']);
					// echo "<br> Image Name = ".$img['image_name'];
					$img_save[$name] = $img['image_name'];
					$img['product_id']=$product_id;
					$img['color_id'] = $color_id;
					$img['created'] = date('Y-m-d');
					$this->store_admin_model->insert('product_images',$img);
					$k++;	
				}
			}

			// echo "<br> Done";
			// die();
			$this->session->set_flashdata('success_msg',"Successfully Updated.");
			redirect('storeadmin/colors/'.$product_id);
		}
		$data['colors'] = $this->store_admin_model->color_n_images($color_id);
		// print_r($data['colors']);
		// die();
		$data['template'] = 'storeadmin/edit_colors';
        $this->load->view('templates/storeadmin_template', $data);	        
	}

	public function delete_colors($product_id,$color_id){
		$this->check_login();
		if(empty($product_id) && empty($color_id)) redirect('storeadmin/products');	

		$images = $this->store_admin_model->get_result('product_images',array('product_id' => $product_id,'color_id' => $color_id));
		foreach ($images as $img) {
			$this->delete_image_test($img->image_name);
		}

		$this->store_admin_model->delete('product_colors',array('id' => $color_id));
		$this->store_admin_model->delete('product_images',array('product_id' => $product_id,'color_id' => $color_id));
		$this->session->set_flashdata('success_msg',"color has been deleted successfully.");
		redirect('storeadmin/colors/'.$product_id);
	}

	public function color_img_upload($name='')
    {
    	if($_FILES[$name]['name']!=''){
	        $config['upload_path'] = './assets/uploads/products';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] = '99999999';
	        $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload($name)){
	              $this->session->set_flashdata('image_error',$do_upload['error']);
	              redirect(current_url());
	            }else{
	                $upload_data = $this->upload->data();
	                return $upload_data['file_name'];
	            }
       }else{
	        $this->session->set_flashdata('error_msg', ''.$name.'image not found');
	        redirect(current_url());
       }
    }

    public function create_design_thumb($file){
		$path='./assets/uploads/designs';  
	     if (!is_writable($path.'/')) {
	        if (!chmod($path.'/', 0777)) {
	             echo "Cannot change the mode of file ($0777)";
	             exit;
	        }
	    }
	    $config1['image_library'] = 'gd2';
	    $config1['source_image']    = $path.'/'.$file;
	    $config1['new_image']   = $path.'/thumbnail/'.$file;    
	    // $config1['create_thumb'] = TRUE;    
	     $config1['quality'] = '100%';
        list($width, $height, $type, $attr) = getimagesize($config1['source_image']);
        $config1['width'] = 240;
        $config1['height']  = 240 ;

        if ($width < $height) {
        	$cal=$width/$height;	       
        	$config1['width']=$config1['width']*$cal;
        	}
		else
			{
			$cal=$height/$width;
        	$config1['height']=$config1['height']*$cal;
			}
	    $config1['maintain_ratio'] = TRUE;
	    
	    $this->load->library('image_lib', $config1);        
	    if ( ! $this->image_lib->resize()){
	         echo $this->image_lib->display_errors(); 
	         exit;
	    }
	    $this->image_lib->clear();
	
	}


    public function create_thumb_file($file){
		// echo $ext = pathinfo($file, PATHINFO_EXTENSION); 
        // $f=explode($ext, $file);		
		$path='./assets/uploads/products';	
		 if (!is_writable($path.'/')) {
            if (!chmod($path.'/', 0777)) {
                 echo "Cannot change the mode of file ($0777)";
                 exit;
            }
        }       
          

        $config1['image_library'] = 'gd2';
		$config1['source_image']	= $path.'/'.$file;
		$config1['new_image']	= $path.'/thumbnail/'.$file;	
		//$config1['create_thumb'] = TRUE;	
		$config1['quality'] = '100%';
		$config1['maintain_ratio'] = FALSE;
		$config1['width'] = 100;
		$config1['height']	= 100 ;
		
		$this->load->library('image_lib', $config1);		
		if ( ! $this->image_lib->resize()){
			 echo $this->image_lib->display_errors(); 
			 exit;
		}
		

		$this->image_lib->clear();	

		// crwate file rezize
	
		$config2['source_image'] = $path.'/'.$file;
		$config2['new_image'] = $path.'/'.$file;
		$config1['quality'] = '100%';
		$config1['maintain_ratio'] = FALSE;
		$config2['width'] = 295;
		$config2['height']	= 425;				
		$this->image_lib->initialize($config2); 

		if ( ! $this->image_lib->resize()){
			 echo $this->image_lib->display_errors(); 
			 exit;
		}
	
	}


	public function delete_image_test($file){		
		$path='./assets/uploads/products/';
		if(!empty($file)){
			@unlink($path.$file);
			@unlink($path.'thumbnail/'.$file);			
		}
		//echo "1";
	}

	public function test($value='')	{	

		if($_FILES['userfile']['name']!=''){
			$config['upload_path'] = './assets/uploads/products/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '0';
			$config['max_width']  = '0'; //1024
			$config['max_height']  = '0'; //768
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload()){
				$error =$this->upload->display_errors();
				echo '<div class="error-alert">'.$error.'</div>';			
			}else{
				$file_name = $this->upload->data();

				$image=$file_name['file_name'];	

				$this->create_thumb_file($image);

				echo '<img alt="" src="'.base_url().'assets/uploads/products/thumbnail/'.$image.'" data-img="'.$image.'"><input type="hidden" name="images[]"  value="'.$image.'"><a data-img="'.$image.'" href="javascript:void(0)" class="delete_label"> Delete </a>';
			}
		}

	}


	public function remove_product_images($img_id)
	{
		$image = $this->store_admin_model->get_row('product_images', array('id'=> $img_id));
		$path = "assets/uploads/products/";
		$path_thumb = "assets/uploads/products/thumbnail/";
		if(!empty($image->image_name))
		{
			unlink($path.$image->image_name);
			unlink($path_thumb.$image->image_name);
		}
		$res = $this->store_admin_model->delete('product_images', array('id'=>$img_id));
		if($res)
			echo "done";
		else
			return FALSE;

	}

	/*public function coupons($offset=0){		
		$this->check_login();		
		$limit=10;
		$data['coupons']=$this->store_admin_model->coupons($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/coupons/';
		$config['total_rows'] = $this->store_admin_model->coupons(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/coupons';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function send_coupon_mail($email,$message, $coupon){
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'shirtscore discount coupons';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form
		$to = array(
			 $email,
		);
		$html = $this->template_coupon($email,$message, $coupon);
		$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
		if($is_fail){
		echo "ERROR :";
		print_r($is_fail);
		}
		// else{
		// //echo "DONE";
		// }
	}

	public function template_coupon($email,$message1, $coupon)
	{
		$message = '';
		$message .= '<html>
						<body>
						<h3>Hello <br></h3><h4>'.$message1.'<br> Coupon Number : '.$coupon.'</h4>';
		
		$message .=	'</table></body></html>';

		return $message;
	}


	public function add_coupon(){
		$this->check_login();
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('start_date', 'Start date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');		
		$this->form_validation->set_rules('type', 'Amount Type', 'required|is_numeric');		
		$this->form_validation->set_rules('discount_use', 'Discount Use', 'required|is_numeric');
		$this->form_validation->set_rules('amount', 'Amount', 'required');					
		if ($this->form_validation->run() == TRUE)
		{
			$code = strtoupper(uniqid());

			$data=array(
				'code'=>$code,	
				'name'=>$this->input->post('name'),				
				'start_date'=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),				
				'reduction_type'=>$this->input->post('type'),
				'discount_use'=>$this->input->post('discount_use'),
				'reduction_amount'=>$this->input->post('amount'),
				'created'=>date('Y-m-d H:i:s'),
				);
			// print_r($data); die();
			$page_id=$this->store_admin_model->insert('coupons',$data);		
			$this->session->set_flashdata('success_msg',"Coupon has been added successfully.");
			redirect('storeadmin/coupons');
		}
		$data['template'] = 'storeadmin/add_coupon';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function edit_coupon($coupon_id='')
	{		
		$this->check_login();
		if(empty($coupon_id)) redirect('storeadmin/coupons');

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('start_date', 'Start date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');		
		$this->form_validation->set_rules('type', 'Amount Type', 'required|is_numeric');
		$this->form_validation->set_rules('discount_use', 'Discount Use', 'required|is_numeric');
		$this->form_validation->set_rules('amount', 'Amount', 'required');					
		if ($this->form_validation->run() == TRUE)
		{			
			$data=array(
				'name'=>$this->input->post('name'),				
				'start_date'=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),			
				'reduction_type'=>$this->input->post('type'),				
				'discount_use'=>$this->input->post('discount_use'),				
				'reduction_amount'=>$this->input->post('amount'),
				);							
			$page_id=$this->store_admin_model->update('coupons',$data, array('id' => $coupon_id));		
			$this->session->set_flashdata('success_msg',"Coupon has been updated successfully.");
			redirect('storeadmin/coupons');
		}
		$data['coupon'] = $this->store_admin_model->get_row('coupons', array('id' => $coupon_id));		
		$data['template'] = 'storeadmin/edit_coupon';
        $this->load->view('templates/storeadmin_template', $data);
	}



	public function change_coupon_status($status='', $id=''){
		$this->check_login();
		if(empty($id) && empty($status)) redirect('storeadmin/coupons');

		$this->store_admin_model->update('coupons', array('status' => $status), array('id' => $id));		
		$this->session->set_flashdata('success_msg',"Status has been changed successfully.");
		redirect('storeadmin/coupons');
	}

	public function view_coupon($coupon_id){
		$this->check_login();
		if(empty($coupon_id)) redirect('storeadmin/coupons');

		$data['coupon'] = $this->store_admin_model->get_row('coupons', array('id'=> $coupon_id));
		$data['template'] = 'storeadmin/view_coupon';
        $this->load->view('templates/storeadmin_template', $data);
	}

	public function delete_coupon($coupon_id){
		if(empty($coupon_id)) redirect('storeadmin/coupons');

		$this->store_admin_model->delete('coupons', array('id'=> $coupon_id));		
		$this->session->set_flashdata('success_msg',"coupon has been deleted successfully.");
		redirect('storeadmin/coupons');
	}*/

	/*public function orders($offset=0){		
		$this->check_login();
		$search = "";
		$search_email="";
		$search_name="";
		$search_number="";
		$search_order_date="";
		$admin_id = storeadmin_id();
		$store_id = get_store_id($admin_id);
		// echo $store_id;
		// die();
		if($_POST){
			
			if($this->input->post('search') != ""){
				$search = trim($this->input->post('search'));				
			}
			if($this->input->post('search_email') != ""){
				$search_email = trim($this->input->post('search_email'));				
			}
			if($this->input->post('search_name') != ""){
				$search_name = $this->input->post('search_name');				
			}
			if($this->input->post('search_number') != ""){
				$search_number = $this->input->post('search_number');				
			}
			if($this->input->post('search_order_date') != ""){
				$search_order_date = $this->input->post('search_order_date');				
			}
		}
		$limit=10;
		$data['orders']=$this->store_admin_model->orders($store_id,$limit,$offset, $search,$search_email,$search_name,$search_number,$search_order_date);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/orders/';
		$config['total_rows'] = $this->store_admin_model->orders($store_id,0, 0,$search,$search_email,$search_name,$search_number,$search_order_date);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/orders';
        $this->load->view('templates/storeadmin_template', $data);
	}*/


	/*public function new_orders($offset=0){
		$this->check_login();
		$search = "";
		$search_email="";
		$search_name="";

		if($_POST)
		{
			
			if($this->input->post('search') != ""){
				$search = trim($this->input->post('search'));				
			}
			if($this->input->post('search_email') != ""){
				$search_email = trim($this->input->post('search_email'));				
			}
			if($this->input->post('search_name') != ""){
				$search_name = $this->input->post('search_name');				
			}
		}
		$admin_id = storeadmin_id();
		$store_id = get_store_id($admin_id);
		$limit=10;
		$data['orders']=$this->store_admin_model->new_orders($store_id, $limit, $offset,$search,$search_email,$search_name);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/new_orders/';
		$config['total_rows'] = $this->store_admin_model->new_orders($store_id, 0, 0,$search,$search_email,$search_name);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/new_orders';
        $this->load->view('templates/storeadmin_template', $data);
	
	}*/


	/*public function old_orders($offset=0)
	{
		$this->check_login();
		$search = "";
		$search_email="";
		$search_name="";

		if($_POST)
		{
			
			if($this->input->post('search') != ""){
				$search = trim($this->input->post('search'));				
			}
			if($this->input->post('search_email') != ""){
				$search_email = trim($this->input->post('search_email'));				
			}
			if($this->input->post('search_name') != ""){
				$search_name = $this->input->post('search_name');				
			}
		}
		$admin_id = storeadmin_id();
		$store_id = get_store_id($admin_id);
		$limit=10;
		$data['orders']=$this->store_admin_model->old_orders($store_id, $limit, $offset ,$search,$search_email,$search_name);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'storeadmin/old_orders/';
		$config['total_rows'] = $this->store_admin_model->old_orders($store_id, 0, 0,$search,$search_email,$search_name);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/new_orders';
        $this->load->view('templates/storeadmin_template', $data);
	}*/


	/*public function order_info($order_id=''){		
		$this->check_login();
		if(empty($order_id)) redirect('storeadmin/new_orders');	

		$user_data=$this->store_admin_model->order_user_info($order_id);				
		$data['order_user_info']=$user_data;
		if ($this->input->post()) {
			$status = $this->input->post('order_status');
			$resp=$this->store_admin_model->update("orders", array('order_status' => $status), array('id' => $order_id));
			if ($resp){
				$msg = "Status of the order with order id <strong>#".$user_data->order_id."</strong> has been updated to <strong>".fetch_order_status($status)."</strong>";
				$this->load->library('smtp_lib/smtp_email');
				$subject = 'Notification For Change In Order Status';	// Subject for email
				$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form
				$to = array($user_data->email => $user_data->firstname." ".$user_data->lastname);
				$html = "<em>Hello</em> <br>
	                <p>". $user_data->firstname." ".$user_data->lastname.".</p>
	                <strong>Subject :</strong> ".$subject."<br><br>
	                <strong>Message :</strong>".$msg;
				$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
				if($is_fail){
					$this->session->set_flashdata('error_msg', 'Email notification failed');
					$this->session->set_flashdata('success_msg', 'Order Status Updated');
				}
				else{
					$this->session->set_flashdata('success_msg', 'Order Status Updated');
				}
			}
			redirect('storeadmin/order_info/'.$order_id);
		}
		$data['order_info']=$this->store_admin_model->order_info($order_id);
		$data['product_info'] = $this->store_admin_model->get_product_info($order_id);		
		$data['order_id'] = $order_id;
		$data['template'] = 'storeadmin/order_info';
        $this->load->view('templates/storeadmin_template', $data);		
	}*/



	/*public function orders_status($order_id, $status){
		$this->check_login();
		if(empty($order_id) && empty($status))  redirect('storeadmin/orders');

		$this->store_admin_model->update('orders', array('order_status'=>$status),array('id'=>$order_id));
		if($status == 6){
			$this->session->set_flashdata('success_msg', 'orders successfully Approved');
		}elseif($status == 7){
			$this->session->set_flashdata('success_msg', 'orders Declined successfully');
		}elseif($status == 8){
			$this->session->set_flashdata('success_msg', 'orders successfully Blocked');
		}
		redirect('storeadmin/orders');
	}*/
	

	/*public function delete_order($order_id){
		$this->store_admin_model->delete('orders', array('id'=> $order_id));		
		$this->store_admin_model->delete('order_items', array('order_id'=> $order_id));		
		$this->session->set_flashdata('success_msg',"Order has been deleted successfully.");
		redirect('storeadmin/orders');
	}*/

// -----------------------------------------------------------

	public function add_note($order_id='')
	{
		 $this->check_login();
		 if (empty($order_id)){
		 	$this->session->set_flashdata('error_msg', 'Order Id not found.');
		 	redirect('storeadmin/orders');
		 }

		 $this->form_validation->set_rules('note', 'Note', 'required');
		 $this->form_validation->set_rules('title', 'Title', 'required');

		 if ($this->form_validation->run() == TRUE){

		 	$data=array(
				'user_id'=>storeadmin_id(),
				'order_id'=>$order_id,
				'note'=> $this->input->post('note'),
				'title'=> $this->input->post('title'),
				'created'=> date('Y-m-d')
				);
		 	 $status=$this->store_admin_model->insert('order_notes',$data);
		 	 if ($status)
		 	 	$this->session->set_flashdata('success_msg', 'Note Added successfully.');
		 	 else
		 	 	$this->session->set_flashdata('error_msg', 'Error in adding note.');

		 	 redirect('storeadmin/order_notes/'.$order_id);
		 }

		$data['template'] = 'storeadmin/add_note';
        $this->load->view('templates/storeadmin_template', $data);
	}

	  /*public function order_notes($order_id='', $offset=0){
       	$this->check_login();

       	if (empty($order_id)){
		 	$this->session->set_flashdata('error_msg', 'Order Id not found.');
		 	redirect('storeadmin/orders');
		}

        $limit=5;
        $data['order_notes']=$this->store_admin_model->order_notes($order_id, $limit,$offset);
        // print_r($data);
        // die();
        $config = get_pagination_style();
        $config['base_url'] = base_url().'storeadmin/order_notes/';
        $config['total_rows'] = $this->store_admin_model->order_notes($order_id, 0,0);
        $config['uri_segment'] = 4;
        $config['per_page'] = $limit;
        $config['num_links'] = 5;       
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        // $order = $this->superadmin_model->get_row('forms', array('id' => $form_id));
        $data['order_id'] = $order_id;
        $data['template'] = 'storeadmin/order_notes';
        $this->load->view('templates/storeadmin_template', $data);    
    }

    public function edit_note($id, $order_id='')
	{
		 $this->check_login();
		 if (empty($order_id) && empty($id)){
		 	$this->session->set_flashdata('error_msg', 'Order Id not found.');
		 	redirect('storeadmin/orders');
		 }


		 $this->form_validation->set_rules('note', 'Note', 'required');
		 $this->form_validation->set_rules('title', 'Title', 'required');

		 if ($this->form_validation->run() == TRUE){

		 	$data=array(
				'note'=> $this->input->post('note'),
				'title'=> $this->input->post('title'),
				'updated'=> date('Y-m-d')
				);
		 	 $status=$this->store_admin_model->update('order_notes', $data, array('id' => $id));
		 	 if ($status)
		 	 	$this->session->set_flashdata('success_msg', 'Note Updated successfully.');
		 	 else
		 	 	$this->session->set_flashdata('error_msg', 'Error in Updating note.');

		 	 redirect('storeadmin/order_notes/'.$order_id);
		 }
		$data['order_note'] = $this->store_admin_model->get_row('order_notes', array('id' => $id));
		$data['template'] = 'storeadmin/edit_note';
        $this->load->view('templates/storeadmin_template', $data);
	}



	public function view_note($id='')
	{
		$this->check_login();
		if(empty($id)) redirect('storeadmin/orders');

		$data['order_note'] = $this->store_admin_model->get_row('order_notes', array('id' => $id));
		// print_r($data['order_note']);
		// die();
		$data['template'] = 'storeadmin/view_note';
        $this->load->view('templates/storeadmin_template', $data);
	}


	public function delete_note($id, $order_id){
		$this->check_login();
		if(empty($id) && empty($order_id))  redirect('storeadmin/orders');

		$this->store_admin_model->delete('order_notes', array('id'=> $id));		
		$this->session->set_flashdata('success_msg',"Note has been deleted successfully.");
		redirect('storeadmin/order_notes/'.$order_id);
	}*/

// -----------------------------------------------------------
	/*public function faqs($offset=0){
		$this->check_login();
		$info = $this->session->userdata('storeadmin_info'); 
		$limit=10;
		$data['faqs']=$this->store_admin_model->faqs($limit, $offset, $info['id']);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/faqs/';
		$config['total_rows'] = $this->store_admin_model->faqs(0, 0, $info['id']);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/faqs';
        $this->load->view('templates/storeadmin_template', $data);		
	}

	public function add_faq(){
		$this->check_login(); 
		$info = $this->session->userdata('storeadmin_info');
		$this->form_validation->set_rules('question', 'question', 'required');			
		$this->form_validation->set_rules('answer', 'answer', 'required');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'question'=>$this->input->post('question'),				
				'answer'=>$this->input->post('answer'),	
				'user_id' => $info['id'],
				'created' => date('Y-m-d H:i:s')		
				);	
			$this->store_admin_model->insert('faq',$data);		
			$this->session->set_flashdata('success_msg',"Successfully Added.");
			redirect('storeadmin/faqs');
		}
		$data['template'] = 'storeadmin/add_faq';
        $this->load->view('templates/storeadmin_template', $data);		
	}


	public function edit_faq($id=''){
		$this->check_login();
		if(empty($id)) redirect('storeadmin/faqs'); 		
		$this->form_validation->set_rules('question', 'question', 'required');			
		$this->form_validation->set_rules('answer', 'answer', 'required');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'question'=>$this->input->post('question'),				
				'answer'=>$this->input->post('answer'),				
				'created' => date('Y-m-d H:i:s')		
				);	
			$this->store_admin_model->update('faq',$data, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"Successfully Updated.");
			redirect('storeadmin/faqs');
		}
		$data['faq'] = $this->store_admin_model->get_row('faq', array('id'=>$id));
		$data['template'] = 'storeadmin/edit_faq';
        $this->load->view('templates/storeadmin_template', $data);        
	}
    

	public function delete_faq($faq_id){

		$this->check_login();
		if(empty($faq_id)) redirect('storeadmin/faqs');

		$this->store_admin_model->delete('faq',array('id'=>$faq_id));
		$this->session->set_flashdata('success_msg',"Deleted successfully.");
		redirect('storeadmin/faqs');
	}*/


	public function A1($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['A1']=$this->store_admin_model->A1($limit, $offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'storeadmin/A1/';
		$config['total_rows'] = $this->store_admin_model->A1(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'storeadmin/A1';
        $this->load->view('templates/storeadmin_template', $data);		
	}
	

	public function add_A1(){
		$this->check_login(); 
		$this->form_validation->set_rules('A1', 'A1', 'required');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'A1'=>$this->input->post('A1'),				
				'created' => date('Y-m-d H:i:s')		
				);			
			if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('storeadmin/add_page/');
				}else{
					$pages['image']=$do_upload['upload_data']['file_name'];
				}
			}

			$this->store_admin_model->insert('A1',$A1);		
			$this->session->set_flashdata('success_msg',"A1 has been added successfully.");
			redirect('storeadmin/A1');
		}
		$data['template'] = 'storeadmin/add_A1';
        $this->load->view('templates/storeadmin_template', $data);		
	}


	public function edit_A1($id=''){
		$this->check_login();
		if(empty($id))  redirect('storeadmin/A1');

		$this->form_validation->set_rules('A1_name', 'A1 name', 'required');				
		if ($this->form_validation->run() == TRUE){		
			$A1s=array(
				'A1'=>$this->input->post('A1'),								
				);

				if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('storeadmin/edit_A1/'.$id);
				}else{
					$A1s['image']=$do_upload['upload_data']['file_name'];
				}
			}					

			$this->store_admin_model->update('A1s',$A1s,array('id'=>$id));
			$this->session->set_flashdata('success_msg',"A1 has been updated successfully.");
			redirect('storeadmin/A1s');
		}
		$data['A1s'] = $this->store_admin_model->get_row('A1s',array('id'=>$id));
		$data['template'] = 'storeadmin/edit_A1';
        $this->load->view('templates/storeadmin_template', $data);	
        
	}




	public function delete_a1($a1_id){
		$this->check_login();
		if(empty($a1_id)) redirect('storeadmin/A1');
		$this->store_admin_model->delete('A',array('id', $a1_id));
		$this->session->set_flashdata('success_msg',"A1 has been deleted successfully.");
			redirect('storeadmin/A1s');
	}

	/////////Designs//////////

	 public function my_designs($paging='',$offset=0){
        $this->check_login();
        $uid = storeadmin_id();
        if ($paging == 'pendings') {
           $offset1 = $offset;
           $offset2 = 0;
        }else{
           $offset1 = 0;
           $offset2 = $offset;
        }

        $limit=12;

        $data['pending_designs'] = $this->store_admin_model->pending_designs($uid, $limit, $offset1);
        $config1 = get_pagination_style();
        $config1['base_url'] = base_url().'storeadmin/my_designs/pendings/';
        $config1['total_rows'] = $this->store_admin_model->pending_designs($uid, 0, 0);
        $data['pendings_count'] =  $config1['total_rows'];
        $config1['uri_segment'] = 4;
        $config1['per_page'] = $limit;
        $config1['num_links'] = 5;
        $this->pagination->initialize($config1);
        $data['pagination_pending'] = $this->pagination->create_links();

        $data['approved_designs'] = $this->store_admin_model->approved_designs($uid, $limit, $offset2);
        $config2 = get_pagination_style();
        $config2['base_url'] = base_url().'storeadmin/my_designs/approved/';
        $config2['total_rows'] = $this->store_admin_model->approved_designs($uid, 0, 0);
        $data['approved_count'] =  $config2['total_rows'];
        $config2['uri_segment'] = 4;
        $config2['per_page'] = $limit;
        $config2['num_links'] = 5;
        $this->pagination->initialize($config2);
        $data['pagination_approved'] = $this->pagination->create_links();

        $data['template'] = 'storeadmin/my_designs';
        $this->load->view('templates/storeadmin_template', $data);    
    }

    public function check_dgn_slug($slug, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_slug = $param[1];
		if ($called === 'add'){
			$resp = $this->store_admin_model->get_row('design', array('slug' => $slug));
			if ($resp){
				$this->form_validation->set_message('check_dgn_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif ($old_slug === $slug) {
				return TRUE;
		}else{
			$resp = $this->store_admin_model->get_row('design', array('slug' => $slug));
			if ($resp) {
				$this->form_validation->set_message('check_dgn_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

    public function add_design()
     {
       $this->check_login();
       $this->form_validation->set_rules('artist', 'Artist', 'required');    
       $this->form_validation->set_rules('store_id[]', 'Store', 'required');    
       $this->form_validation->set_rules('design_title', 'Design title', 'required');
       $this->form_validation->set_rules('slug', 'Title-slug', 'required|callback_check_dgn_slug['."add,slug".']');
       $this->form_validation->set_rules('description', 'Description', 'required');    
       $this->form_validation->set_rules('category', 'Category', 'callback_check_design_categories');
       $this->form_validation->set_rules('designfile', 'Design File', 'callback_check_img_size['."add".']'); 
        if(!empty($_FILES['upload_video']['name'])){
             $this->form_validation->set_rules('upload_video', 'video', 'callback_upload_video');
            
        }
          if($this->form_validation->run()==TRUE)
          {
           if($this->session->userdata('upload_video')!=''){
           	    $upload_video=$this->session->userdata('upload_video');
                $data['design_video'] = $upload_video['upload_video'];  
                $data['design_video_type'] = $this->input->post('design_video_type');
            }else if(!empty($_POST['design_video'])){
                $data['design_video_type'] = $this->input->post('design_video_type');
            	$data['design_video'] = $this->input->post('design_video');
                
           }
                $data['artist'] = $this->input->post('artist');
                $data['artist_id'] = customer_id();
                $data['design_title'] = $this->input->post('design_title');
                $data['slug'] = $this->input->post('slug');
                $data['description'] = $this->input->post('description');
                $data['category'] = serialize($this->input->post('category'));
                $data['created'] = date('Y-m-d');


             
               if($_FILES['designfile']['name']!=''){
                $config['upload_path'] = './assets/uploads/designs';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload');
                $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('designfile')){
                      $this->session->set_flashdata('image_error', $do_upload['error']);                      
                      redirect(current_url());
                      //redirect('superadmin/add_product/');
                    }else{
                        // echo " <br> Uploded";
                        $upload_data = $this->upload->data();   
                        $data['design_image']=$upload_data['file_name'];
                        $this->create_design_thumb($data['design_image']);
                    }
               }else{
                $this->session->set_flashdata('error_msg', 'Please select an image to upload');
                redirect(current_url());
               }
           	$design_id=$this->store_admin_model->insert('design',$data);
           	 if($this->session->userdata('upload_video')!=''):
                    $this->session->unset_userdata('upload_video');
                endif;

           	if(isset($_POST['store_id']) && !empty($_POST['store_id'])){
           		if($_POST['store_id']!=in_array('not_store', $_POST['store_id'])){
           		foreach ($_POST['store_id'] as $row) {           			
	           		if(!empty($row))           			
	           		$this->store_admin_model->insert('design_to_multistore',array('design_id'=>$design_id,'store_id'=>$row));
           		}}
       		}

           
           $this->session->set_flashdata('success_msg',"Design has been added successfully.");
           redirect('storeadmin/my_designs');
          }

        if ($this->input->post('category')){
			$data['category_arr'] = $this->input->post('category'); 
			// print_r($data); 
			// die();
        }
		else
			$data['category_arr'] = array();

		if ($this->input->post('store_id'))
			$data['store_id'] = $this->input->post('store_id');
		else
			$data['store_id'] = array();
		// print_r($data);
		// die();
        $data['stores'] = $this->store_admin_model->get_result('stores', array('user_id'=>customer_id()));        
        $data['category']= $this->store_admin_model->get_result('design_category');
        $data['template'] = 'storeadmin/add_design';
        $this->load->view('templates/storeadmin_template', $data);
     }

     function upload_video($str='')
     {
        if(!empty($_FILES['upload_video']['name'])):

            $param=array(
                'file_name' =>'upload_video',
                'upload_path'  => './assets/uploads/upload_video/',
                'allowed_types'=> 'flv|mp4',
                'encrypt_name' => TRUE,
                        );

                            $upload_file=upload_file($param);

                            if($upload_file['STATUS']){
                                if($this->session->userdata('upload_video')=='')
                                $this->session->set_userdata('upload_video',array('upload_video'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name']));
                                else{
                                $content = $this->session->userdata('upload_video');
                                $this->session->set_userdata('upload_video',array('upload_video'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name']));

                  
                               
                                return TRUE;
                                }   
                           return TRUE;
                                
                            }else{     
                            $this->form_validation->set_message('upload_video', $this->upload->display_errors());
                             return FALSE;     
                                   
                            }
                
        endif;
       
     }

    public function edit_design($design_id="")
    {

    		$this->check_login();
    		if(empty($design_id))  redirect('storeadmin/my_designs');
            $data['design']=$this->store_admin_model->get_row('design',array('id' =>$design_id));
            
            if(!$data['design'])  redirect('storeadmin/my_designs');
           
            $data['stores_id']=$this->store_admin_model->get_selected_design_to_multistore($design_id);
            $file = $data['design']->design_image;
            $old_slug = $data['design']->slug;
           	
            	$this->form_validation->set_rules('store_id[]', 'Store', 'required');
                $this->form_validation->set_rules('artist', 'artist', 'required');              
                $this->form_validation->set_rules('design_title', 'design_title', 'required');
                $this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_dgn_slug['."edit".','.$old_slug.']');
                $this->form_validation->set_rules('description', 'description', 'required');
                $this->form_validation->set_rules('category', 'Category', 'callback_check_design_categories');
                if($_FILES['designfile']['name']!=''){
                 $this->form_validation->set_rules('designfile', 'designfile', 'callback_check_img_size['."edit".']');   
                }

                if(!empty($_FILES['upload_video']['name'])){
                    $this->form_validation->set_rules('upload_video', 'video', 'callback_upload_video');
                }


                if($this->form_validation->run()==TRUE)
                {


					if(isset($_POST['store_id']) && !empty($_POST['store_id'])){
						$this->store_admin_model->delete('design_to_multistore',array('design_id'=>$design_id));

						if($_POST['store_id']!=in_array('not_store', $_POST['store_id'])){
							
						foreach ($_POST['store_id'] as $row) {           			
						if(!empty($row))           			
						$this->store_admin_model->insert('design_to_multistore',array('design_id'=>$design_id,'store_id'=>$row));
						}}
					}

                    // $data=array(
                    // 'artist'=>$this->input->post('artist'),
                    // 'design_title'=>$this->input->post('design_title'),
                    // 'design_video'=>$this->input->post('design_video'),
                    // 'description'=>$this->input->post('description'),
                    // 'category'=>serialize($this->input->post('category'))
                    // );


           if($this->session->userdata('upload_video')!=''){  
                $upload_video=$this->session->userdata('upload_video');
                $data1['design_video'] = $upload_video['upload_video'];  
                $data1['design_video_type'] = $this->input->post('design_video_type');
           }else if(!empty($_POST['design_video'])){
                $data1['design_video'] = $this->input->post('design_video');
                $data1['design_video_type'] = $this->input->post('design_video_type');
			}

                $data1['artist'] = $this->input->post('artist');
                $data1['design_title'] = $this->input->post('design_title');
                $data1['description'] = $this->input->post('description');
                $data1['category'] = serialize($this->input->post('category'));
               


                   /* if($_FILES['designfile']['name']!='')
                    {               
                        $config['upload_path'] = './assets/uploads/designs';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = '99999999';
                        $this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload('designfile'))
                        {
                            $this->session->set_flashdata('image_error'.$do_upload['error']);
                            //redirect('superadmin/add_product/');
                        }
                        else
                        {
                            $path='./assets/uploads/designs/';
                            if(!empty($file)){
                                @unlink($path.$file);
                                @unlink($path.'thumbnail/'.$file);          
                            }
                            $upload_data = $this->upload->data();            
                            $data['design_image']=$upload_data['file_name'];
                            $this->create_design_thumb($data['design_image']);
                        }
                    }*/
                //      if ($this->session->userdata('upload_video')!='') {
                //      	$video = $this->user_model->get_row('design',array('id'=>$design_id));

                //     if($video->design_video_type=='2'){
                //         unlink($video->design_video);
                //      }
                // }
               
              $upload_video1 =  $this->store_admin_model->update('design',$data1,array('id'=>$design_id));
                    if($upload_video1){
                     if($this->session->userdata('upload_video')!=''):
                        $this->session->unset_userdata('upload_video');
                    endif;
                    $this->session->set_flashdata('success_msg',"Design has been updated successfully.");
                    redirect('storeadmin/my_designs');
                    	
                    }
                
                }
            

            if ($this->input->post('category'))
				$data['category_arr'] = $this->input->post('category');
			else
				$data['category_arr'] = array();

			if ($this->input->post('store_id'))
				$data['store_id'] = $this->input->post('store_id');
			else
				$data['store_id'] = array();

                 if($this->session->userdata('upload_video')!=''):
        $this->session->unset_userdata('upload_video');
    endif;

      		$data['stores'] = $this->store_admin_model->get_result('stores', array('user_id'=>customer_id()));
      		$data['countstore']=$this->store_admin_model->count_store_design($design_id); 
      		//print_r($data['countstore']);
      		//die;       
            $data['category']=  $this->store_admin_model->get_result('design_category');
            $data['template'] = 'storeadmin/edit_design';
            $this->load->view('templates/storeadmin_template', $data);  

      }

      public function check_img_size($a='',$called=''){
     
        if ($called == 'add') {
           if ($_FILES['designfile']['tmp_name'] == '') {
               $this->form_validation->set_message('check_img_size', 'Select an image design to upload.');
                return FALSE;
           }
        }else{
          if ($_FILES['designfile']['tmp_name'] == '')
              return TRUE; 
        }

            $image = getimagesize($_FILES['designfile']['tmp_name']);

            if ($image[0] < 600 || $image[0] < 600) {
                $this->form_validation->set_message('check_img_size', 'Oops! Your design image needs to be atleast 600 x 600 pixels.
                    Otherwise its too small to print on our products.');
               return FALSE;
            }
            else{
                return TRUE;
            }
    }

    public function check_design_categories($fields){  
        $type = gettype($fields);
        if ($type === 'NULL'){
            $this->form_validation->set_message('check_design_categories', 'Select atleast 1 category.');
            return FALSE;
        }else{
            if (count($fields) > 3 ){
            $this->form_validation->set_message('check_design_categories', 'select up to 3 categories only.');
            return FALSE;
            }else{
                return TRUE;
            }
        }
    }

     public function designs_thumb_file($file){

        $path='./assets/uploads/designs';  
         if (!is_writable($path.'/')) {
            if (!chmod($path.'/', 0777)) {
                 echo "Cannot change the mode of file ($0777)";
                 exit;
            }
        }
        $config1['image_library'] = 'gd2';
        $config1['source_image']    = $path.'/'.$file;
        $config1['new_image']   = $path.'/thumbnail/'.$file;    
        // $config1['create_thumb'] = TRUE;    
        $config1['quality'] = '100%';
        $config1['maintain_ratio'] = FALSE;
        $config1['width'] = 295;
        $config1['height']  = 295 ;
        
        $this->load->library('image_lib', $config1);        
        if ( ! $this->image_lib->resize()){
             echo $this->image_lib->display_errors(); 
             exit;
        }
        $this->image_lib->clear();    
    }
	/////////Designs//////////

    public function sales_report($list_by=0, $from_date='-', $to_date='-', $offset=0)
    {
        if ($this->input->post('list_by')){
        	$list_by = $this->input->post('list_by');
        	$offset=0;
        }

        if ($this->input->post('is_clicked')){
        	if ($this->input->post('is_clicked') == 1){
        		$from_date = $this->input->post('from_date');
        		$to_date = $this->input->post('to_date');
        		$offset=0;
        	}
        }

        $this->check_login();
        $uid = storeadmin_id();
        $limit=50;

        $data['sales']=$this->store_admin_model->sales_report($uid ,$list_by ,$from_date ,$to_date ,$limit ,$offset);
        $data['sales_history'] = $this->store_admin_model->sales_history($uid);
        $data['total_orders'] = $this->store_admin_model->design_sales_orders($uid);
        $data['commission_info'] = $this->store_admin_model->commission_info($uid);
        $config = get_pagination_style();
        $config['base_url'] = base_url().'storeadmin/sales_report/'.$list_by.'/'.$from_date.'/'.$to_date.'/';
        $config['total_rows'] = $this->store_admin_model->sales_report($uid ,$list_by ,$from_date ,$to_date ,0,0);
        $config['per_page'] = $limit;
        $config['num_links'] = 5;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['list_by'] = $list_by;

        // if ($to_date != '-')
        // 	$data['to_date'] = '';
        //  else
        	$data['to_date'] = $to_date;

        // if ($from_date != '-')
        // 	$data['from_date'] = '';
        // else
        	$data['from_date'] = $from_date;

        $data['template'] = 'storeadmin/sales_report';
        $this->load->view('templates/storeadmin_template', $data);
    }

     public function pay_request($uid)
    {
       if(empty($uid)) redirect('storeadmin/sales_report');

        $this->check_login();
        $com_rate = 0.00;
        $com_amount = 0.00;
        $com_qty = 0.00;
        $uid = customer_id();
        if ($com_rate=commission_rate())
            $com_rate;

        if ($com_qty=user_commission($uid))
            $com_qty;

            $com_amount=$com_rate*$com_qty;

        if ($com_amount <= 25) {
            $this->session->set_flashdata('error_msg', 'Payment request cannot completed, Unpaid Commission is Insufficient.');
            redirect('storeadmin/sales_report');
        }else{
            $resp = $this->store_admin_model->get_row('commission_request', array('user_id' => $uid));

            if ($resp)
                $unpaid_com = ($resp->unpaid_com + $com_amount);
            else
                $unpaid_com = $com_amount;

            $data = array(
                            'user_id' => $uid,
                            'unpaid_com' => $unpaid_com,
                            'pay_status' => 0,
                            'request_date' => date('Y-m-d H:i:s')
                        );

            if ($resp) {
                $this->store_admin_model->update('commission_request', $data, array('user_id' => $uid));
            }else{
                $this->store_admin_model->insert('commission_request', $data);
            }

            $data = array(
                            'user_id' => $uid,
                            'unpaid_com' => $com_amount,
                            'request_date' => date('Y-m-d')
                        );

            $this->store_admin_model->update('design_sales', array('payment_status' => 1) , array('design_owner_id' => $uid));

            $this->session->set_flashdata('success_msg', 'Your Payment Request Accepted And Will Be Proccessed Soon.');
            redirect('storeadmin/sales_report');
        }
    }

   public function submit_product(){
    	$this->load->model('store_model');
    	$my_stores = $this->store_admin_model->my_stores();
    	if (!$my_stores) {
    		$this->session->set_flashdata('error_msg','No active stores found to add new product.');
    		redirect('storeadmin/stores');
    	}
    	if ($_POST) {
  			$data['products']=$this->store_model->get_products_for_editor($_POST);
  			if(!$data['products'])
  				$data['products']=$this->store_model->get_result('products',array('product_status'=>1));

  			if (!empty($_POST['category']))
  				$data['designs']=$this->store_model->get_designs_for_editor($_POST['category']);

  			if(isset($data['designs']))
  				$data['designs']=$this->store_model->get_result('design',array('status'=>1));
  		}else{
	  		$data['designs']=$this->store_model->get_result('design',array('status'=>1));
	  		$data['products']=$this->store_model->get_result('products',array('product_status'=>1));
	  		$data['selected_cat'] = 0;
  		}

  		if (!empty($_POST['category']))
			$data['selected_cat'] = $_POST['category'];
		else
			$data['selected_cat'] = 0;

  		$data['product_groups']=$this->store_model->get_result('product_group');

  		$data['categories']=$this->store_model->get_result('design_category');

  		$data['template'] = 'storeadmin/design_your_own';
  		$this->load->view('templates/design_your_own_template', $data);
    }

    public function design_save(){
    	$this->load->model('store_model');
		if (empty($_POST))
			redirect('storeadmin/submit_product');

		$assets= json_decode(stripslashes($_POST['assets']));
		$product_id=0;
		$design_id_arr=array();
		$text_id_arr=array();
		$price = 0;
		if(isset($_POST['assets']) && !empty($_POST['assets']) ){
			$assets= json_decode(stripslashes($_POST['assets']));
			foreach ($assets as $asset) {
				$i=0;
				$j=0;

				foreach ($asset->elements as $row) {
					if($i==0){
						$product_title = $row->title;
					 	$product_id = $row->parameters->product_id;
					}
					else{
						if ($row->type == 'image') {
							if ($row->parameters->slug == 1) {
								if (element($row->parameters->design_id, $design_id_arr)) {
									$design_id_arr[$row->parameters->design_id]['design_qty']++;
									$design_id_arr[$row->parameters->design_id]['price'] += $row->parameters->price;
								}else{
									$design_id_arr[$row->parameters->design_id]['design_qty'] = 1;
									$design_id_arr[$row->parameters->design_id]['price'] = $row->parameters->price;
								}
							}
						} else {
							$text_id_arr[] = array(
													'text' 		=> $row->parameters->text,
													'textSize' 	=> $row->parameters->textSize,
													'font' 		=> $row->parameters->font,
													'color' 	=> $row->parameters->currentColor,
													'price' 	=> $row->parameters->price,
											);
						}
					}

					$price += $row->parameters->price;
					$i++;
				}
			}
			$base64_str = substr($_POST['base64_image'], strpos($_POST['base64_image'], ",")+1);
			$decoded = base64_decode($base64_str);
			$prod_img = 'new-design-me'.date('Ymdhis').'.png'; // Upload path => assets/uploads/custom_prod_img/img_name
			$png_url = 'assets/uploads/custom_prod_img/new-design-me'.date('Ymdhis').'.png'; // Upload path => assets/uploads/custom_prod_img/img_name
			$result = file_put_contents($png_url, $decoded);

			$new_product_image = array(
					'prod_img' => $prod_img,
					'png_url' => $png_url,
					'price' => $price,
					'product_used' => $product_id
				);

			$this->session->set_userdata('new_product_info', $new_product_image);
			redirect('storeadmin/add_product');
		}else{
			redirect('storeadmin/submit_product');
		}
	}

	public function messages($offset = 0){
		$this->check_login();
		$limit=10;
		$data['messages']=$this->store_admin_model->messages($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'storeadmin/messages/';
		$config['total_rows'] = $this->store_admin_model->messages(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;		
		$data['template'] = 'storeadmin/messages';
        $this->load->view('templates/storeadmin_template', $data);
	}

	public function read_message($id){
		$this->check_login();
		if (empty($id)) {
			$this->session->set_flashdata('error_msg', 'Message not found....!!!');
			redirect('superadmin/messages');
		}
		$data['msg'] = $this->store_admin_model->get_row('messages',array('id'=>$id));
		if (!$data['msg']) {
			$this->session->set_flashdata('error_msg', 'Message not found....!!!');
			redirect('storeadmin/messages');	
		}
		if ($data['msg']->status != 1)
			$this->store_admin_model->update('messages' , array('status'=>1), array('id'=>$id));

		$data['template'] = 'storeadmin/read_message';
        $this->load->view('templates/storeadmin_template', $data);
	}

	public function delete_message($id=""){
		$this->check_login();

		if (empty($id)) {
			$this->session->set_flashdata('error_msg', 'Message not found....!!!');
			redirect('storeadmin/messages');
		}

		$del = $this->store_admin_model->delete('messages',array('id'=>$id));

		if ($del)
			$this->session->set_flashdata('success_msg','Message has been deleted successfully.');
		else
			$this->session->set_flashdata('error_msg','Message cannot be deleted...!!!');

		redirect('storeadmin/messages');
	}

	public function orders($offset=0)
    {
        $this->check_login();
        $uid = storeadmin_id();
        if (!$uid) {
            $this->session->set_flashdata('error_msg', 'No order found');
            redirect('storeadmin/dashboard');
        }
        $limit=10;      
        $data['orders']=$this->store_admin_model->orders($limit,$offset,$uid);
        $config= get_pagination_style();    
        $config['base_url'] = base_url().'storeadmin/orders/';
        $config['total_rows'] = $this->store_admin_model->orders(0, 0,$uid);
        $config['per_page'] = $limit;
        $config['num_links'] = 5;       
        $this->pagination->initialize($config);         
        $data['pagination'] = $this->pagination->create_links();
        $data['template'] = 'storeadmin/orders';
        $this->load->view('templates/storeadmin_template', $data);
    }

    public function order_info($order_id=''){
    	if (empty($order_id)) {
            $this->session->set_flashdata('error_msg', 'No order found');
            redirect('storeadmin/orders');
        }
        $oid = 0;
        $user_data = $this->store_admin_model->order_user_info($order_id);
        $data['order_user_info'] = $user_data;
        $data['order_info'] = $this->store_admin_model->order_info($order_id);
        $data['order_id'] = $oid;
        // print_r($data);
        // die();
        $data['template'] = 'storeadmin/order_info';
        $this->load->view('templates/storeadmin_template', $data);       
    }

    public function download_design($design_id=""){
		$design = $this->store_admin_model->get_row('design', array('id' => $design_id));
		if(!$design || empty($design_id)){
			$this->session->set_flashdata('error_msg', 'No design found.');
			redirect('superadmin/designs');
		}
		
		if (storeadmin_id() == $design->artist_id) {
			if(!empty($design->design_image))
			{
				$pth    =   file_get_contents(base_url()."assets/uploads/designs/".$design->design_image);
				$nme    =   date('Ymdhis').$design->design_image;
				force_download($nme, $pth);
			}
		}
	}

	public function design_info($design_slug=""){
  		if (empty($design_slug))
  			redirect('store/designs');
  		
  		$data['design']=$this->store_admin_model->get_row('design',array('status'=>1, 'slug'=>$design_slug));

  		if (!$data['design']) {
  			redirect('store');
  		}
  		
		$data['template'] = 'storeadmin/design_info';
  		$this->load->view('templates/storeadmin_template', $data);
  	}

  public function admin_payee_profile(){
  	//print_r($_POST);
        $this->check_login();
        $uid = storeadmin_id();
        $data['user'] = $this->store_admin_model->get_row('user_payee_info',array('user_id'=>$uid));
        // / print_r($data['user']);
         $data['state']=$this->store_admin_model->get_result('state');
        // echo $this->input->post('payee_type');
        if ($this->input->post('payee_type')==1) {
        	$this->form_validation->set_rules('payee_type', '', 'required');
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            $this->form_validation->set_rules('acc_holder', 'A/C Holder Name', 'required');
            $this->form_validation->set_rules('acc_no', 'A/C number', 'required');
            $this->form_validation->set_rules('acc_type', 'A/c Type', 'required');
            $this->form_validation->set_rules('routing_no', 'Routing Number', 'required');
           }

        if($this->input->post('payee_type')==2) {
            $this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');//paypal_email
            }
      if($this->input->post('payee_type')==3) {
      	$this->form_validation->set_rules('name', 'Full name', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');				
		$this->form_validation->set_rules('state', 'State', 'required');				
		$this->form_validation->set_rules('address', 'Address', 'required');				
		$this->form_validation->set_rules('country', 'Country', 'required');				
		$this->form_validation->set_rules('zip', 'Zip', 'required|integer |exact_length[5] ');
      }
      if($this->input->post('payee_type')==0) {
		$this->form_validation->set_rules('payee_method', 'payee_method', 'required');				
      }
       $this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
        
        if($this->form_validation->run() == TRUE){
            
            if ($this->input->post('payee_type')==1) {
                $data1 = array(
                    'bank_name'     => $this->input->post('bank_name'),
                    'acc_holder'    => $this->input->post('acc_holder'),
                    'acc_no'        => $this->input->post('acc_no'),
                    'acc_type'      => $this->input->post('acc_type'),
                    'routing_no'    => $this->input->post('routing_no'),
                    'updated'       => date('Y-m-d'),
                	 );
            }
            if ($this->input->post('payee_type')==2) {
                $data1 = array(
                	'is_paypal'=>1,
                    'paypal_email'     => $this->input->post('paypal_email'),
                    'updated'       => date('Y-m-d'),
                    );
            }
            if ($this->input->post('payee_type')==3) {
                $data1 = array(
                    'full_name'     => $this->input->post('name'),
                    'address'    => $this->input->post('address'),
                    'city'        => $this->input->post('city'),
                    'state'      => $this->input->post('state'),
                    'country'    => $this->input->post('country'),
                    'zip_code'	=> $this->input->post('zip'),
                    'updated'       => date('Y-m-d'),
                	);
            }
             if ($this->input->post('payee_type')==0) {
	             	if($this->input->post('payee_method')==2)
	                {
	                	$paypal =1;
	                }
	                else{
	                	$paypal =0;
	              	}
	                $data1 = array('payee_type' => $this->input->post('payee_method'),
	                					'is_paypal'=>$paypal);
	            }
             $this->store_admin_model->update('user_payee_info', $data1, array('user_id' => $uid));
             $this->session->set_flashdata('success_msg', 'Account Detail has been updated successfully.');
            redirect(current_url());
        }
        $data['template'] = 'storeadmin/admin_payee_profile';
  		$this->load->view('templates/storeadmin_template', $data);
	}


}/* End of file storeadmin.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Superadmin extends CI_Controller {

	public function __construct(){
		parent::__construct();		
		clear_cache();		
		$this->load->model('superadmin_model');
	}

	private function check_login(){
		if(superadmin_login_in()===FALSE)
			redirect('superadmin/login');
	}
		
	public function index(){
		$this->dashboard();
	}

	public function dashboard(){
		$this->check_login();
		$data['users']=$this->superadmin_model->get_user();
	    $data['orders']=$this->superadmin_model->get_orders();
	    $data['order_items']=$this->superadmin_model->get_items();
	    $data['stores']=$this->superadmin_model->store();
	    // print_r($data['stores']);
	    // die();
	    $data['items']=$this->superadmin_model->items();
	    $data['notification'] = $this->superadmin_model->get_support_notification();
	    $data['pending_designs'] = $this->superadmin_model->get_pending_designs();

	    $date = explode("-", date('Y-m-d'));
	    $no_of_days = days_of_month($date[1], $date[0]);
	    // echo $no_of_days;
	    // die();
	    $campaign = $this->superadmin_model->get_order_date_wise();
	    
	    $campaign1 = array();
		if ($campaign) {

			foreach ($campaign as $v) {
				$day = date('j', strtotime($v->created));
				$campaign1[$day] = $v;
			}
			// print_r($campaign1);
	  //   	die();
			$data_array = '[';
			for ($i=1; $i <= $no_of_days; $i++) {
				if($i == 1){
					if (isset($campaign1[$i]))
						$data_array .= '['.$i.','.$campaign1[$i]->total_qty.']'; //$data_array .= '['.$i.',25]';
					else
						$data_array .= '['.$i.',0]';
				}
				else{
					if (isset($campaign1[$i]))
						$data_array .= ', ['.$i.','.$campaign1[$i]->total_qty.']'; //$data_array .= ', ['.$i.',25]';
					else
						$data_array .= ', ['.$i.',0]';
				}
			}
			$data_array .= '];';
			$data['campaign_string'] = $data_array;
		}else{
			$data['campaign_string'] = FALSE;
		}
		$data['template'] = 'superadmin/dashboard';
  		$this->load->view('templates/superadmin_template', $data);
	}

	public function ajax_get_order_date_wise(){
		$campaign1 = array();
		$temp_arr = array();
		$campaign = $this->superadmin_model->get_order_date_wise();

		if ($campaign) {
			foreach ($campaign as $key => $value) {
				$temp_arr['total_qty'] = $value->total_qty;
				$temp_arr['day_sell'] = $value->day_sell;
				$temp_arr['created'] = date('dS F Y', strtotime($value->created));
				$day = date('j', strtotime($value->created));
				$campaign1['item'.$day] = $temp_arr;
				// $campaign1['item'.$i] = $temp_arr;
				$temp_arr = array();
			}
		}
		if ($campaign){
			$msg = json_encode(array('status' => true, 'data' => $campaign1));
		}else{
			$msg = json_encode(array('status' => false, 'data' => 'Some data missing....'));
		}
		echo $msg;
	}

	public function ajax_dashboard_data(){
		$data = $this->superadmin_model->get_order_date_wise();
		$arr = json_encode($data);
 		echo $arr;
	}

	// public function test(){
	// 	if (isset($_COOKIE['superadmin_remember_me'])) {
	// 		print_r(unserialize(decrypt_id($_COOKIE['superadmin_remember_me'])));
	// 		// print_r(decrypt_id($_COOKIE['superadmin_remember_me']));
	// 		// die();
	// 		// var_dump($_COOKIE['superadmin_remember_me']);
	// 	}else{
	// 		echo "No Cookie";
	// 	}
	// }

	public function login(){
		$this->load->model('login_model');
		if(superadmin_login_in()===TRUE)
			redirect('superadmin');

			
		if(isset($_COOKIE['superadmin_remember_me'])){
			$details = unserialize(decrypt_id($_COOKIE['superadmin_remember_me']));
			$status=$this->login_model->login($details['email'], $details['password'],0);
			if($status['status']){
				$data = encrypt_id(serialize($details));
				setcookie('superadmin_remember_me',$data ,time()+1209600); //set cookie				
				redirect('superadmin/dashboard');
			}else{
				$this->session->set_flashdata('error_msg', $status['error_msg']);
				redirect('superadmin/login');
			}
		}
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');				
		if ($this->form_validation->run() == TRUE){
			$status=$this->login_model->login($this->input->post('email'),$this->input->post('password'),0);

			if($status['status']){
				//remember me
				if($this->input->post('rememberme') == 1){
					//$info = $this->session->userdata('superadmin_info');
					$value = array('email' => $this->input->post('email'),'password' => $this->input->post('password'));
					$data = encrypt_id(serialize($value));
					setcookie('superadmin_remember_me',$data,time()+1209600); //set cookie							
				}
				redirect('superadmin/dashboard');
			}
			else{
				$this->session->set_flashdata('error_msg', $status['error_msg']);
				redirect('superadmin/login');
			}
		}		
		$this->load->view('superadmin/login');					
	}

	public function logout(){
	 	$this->session->set_userdata('superadmin_info','');
	 	$this->session->unset_userdata('superadmin_info');
	 	if ($this->session->userdata('storeadmin_info')) {
			$this->session->set_userdata('storeadmin_info','');
			$this->session->unset_userdata('storeadmin_info');
		}
		if ($this->session->userdata('customer_info')) {
		$this->session->set_userdata('customer_info','');
		$this->session->unset_userdata('customer_info');
		}
	 	setcookie("superadmin_remember_me", "", time()-3600); //delete cookie
	 	redirect('superadmin/login');
	 }


	public function profile(){
		$this->check_login();
		$info = $this->session->userdata('superadmin_info');
		$data['profile'] = $this->superadmin_model->get_row('users', array('id' => $info['id']));
		$this->form_validation->set_rules('fname', 'first name', 'required');
		$this->form_validation->set_rules('lname', 'last name', 'required');				
		$this->form_validation->set_rules('mobile', 'mobile', 'required');				
		$this->form_validation->set_rules('city', 'city', 'required');				
		$this->form_validation->set_rules('state', 'state', 'required');				
		$this->form_validation->set_rules('address', 'address', 'required');				
		$this->form_validation->set_rules('country', 'country', 'required');				
		$this->form_validation->set_rules('zip', 'Zip', 'required');
		$this->form_validation->set_message('is_natural_no_zero', 'Please enter valid value');
		if ($this->form_validation->run() == TRUE){
			$data = array(
				'firstname' => $this->input->post('fname'),
				'lastname'  => $this->input->post('lname'),
				'mobile'    => $this->input->post('mobile'),
				'city'		=> $this->input->post('city'),
				'state'		=> $this->input->post('state'),
				'zip' 		=> $this->input->post('zip'),
				'address' 	=> $this->input->post('address'),
				'country' 	=> $this->input->post('country'),				
					);
			$this->superadmin_model->update('users', $data, array('id' => $info['id']));
			$this->session->set_flashdata('success_msg', 'Profile updated successfully.');
			redirect(current_url());
		}
		$data['template'] = 'superadmin/profile';
  		$this->load->view('templates/superadmin_template', $data);
	}



	public function change_password(){
		$login = $this->check_login();
		$info = $this->session->userdata('superadmin_info');
		$data['user'] = $this->superadmin_model->get_row('users', array('id' => $info['id']));

       	$this->form_validation->set_rules('c_pass', 'Confirm Password', 'required|matches[password]');
       	$this->form_validation->set_rules('password', 'New Password', 'required|matches[password]');
       	$this->form_validation->set_rules('old_pass', 'Old Password', 'required');
        if($this->form_validation->run() === TRUE){
 		if($this->input->post('password') != ''){
				$old_pass = $data['user']->password;
				$prev_pass = sha1($this->input->post('old_pass'));
				if ($prev_pass != $old_pass) {
	        		$this->session->set_flashdata('error_msg', 'Invalid Old Password.');
	        		redirect('superadmin/change_password');
	        	}else{
	        		$password = array(
	      			  	'password' => sha1($this->input->post('password')),
	        					);
	        		}
        	 }
			$this->superadmin_model->update('users', $password, array('id' => $info['id']));
			$this->session->set_flashdata('success_msg', 'Password updated successfully.');
			redirect(current_url());
		}
		$data['template'] = 'superadmin/change_password';
		$this->load->view('templates/superadmin_template', $data);
	}
	



	public function approved_stores($storename = "-" ,$storeid = "-", $offset = 0){
		$this->check_login();

		if($_POST){

			if ($this->input->post('storename') != "")
				$storename = $this->input->post('storename');

			if ($this->input->post('storeid') != "")
				$storeid = $this->input->post('storeid');

		}

		$limit=30;
		$data['stores']=$this->superadmin_model->approved_stores($limit, $offset, $storename, $storeid);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/approved_stores/'.$storename.'/'.$storeid.'/';
		$config['total_rows'] = $this->superadmin_model->approved_stores(0, 0, $storename, $storeid);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$config['uri_segment'] = 5;		
		$this->pagination->initialize($config);
		$offset++;
		$data['offset'] = $offset;
		$data['pagination'] = $this->pagination->create_links();

		if ($storename == '-')
			$data['storename'] = "";
		else
			$data['storename'] = $storename;

		if ($storeid == '-')
			$data['storeid'] = "";
		else
			$data['storeid'] = $storeid;

		$data['template'] = 'superadmin/approved_stores';
        $this->load->view('templates/superadmin_template', $data);	
	}


	public function approve_store($store_id, $user_id){
		
		$this->check_login();
		if(empty($store_id) && empty($user_id)) redirect('superadmin/approved_stores');

		$store_info = $this->superadmin_model->get_store_user($user_id);
		$name = ucfirst($store_info->firstname)." ".ucfirst($store_info->lastname);
		$email = $store_info->email;
		$s_subject = 'Notification of store approval';
		$message = "Your Store has been successfully approved, Now you can access your store by switching from dashbord to admin panel.";
		
		$this->superadmin_model->update('stores', array('status'=> 1), array('id' => $store_id));
		$this->superadmin_model->update('users', array('is_storeadmin' => 1), array('id'=>$user_id));
		$this->send_store_aproval_mail($name,$email,$s_subject,$message,$store_id);		
		$this->session->set_flashdata('success_msg', 'Status changed successfully.');
		redirect('superadmin/approved_stores');
	}

	public function send_store_aproval_mail($name,$email_to,$s_subject,$message,$store_id){
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Notification of store aproval';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
		$to = array(
			 $email_to,
		);
		// $html = "<em><strong>Hello ".$name." !</strong></em> <br>
		// 		<p><strong>Subject - ".$s_subject."</strong></p>
		// 		<p><strong>Message - ".$message."</strong></p>";
		$html = $this->template_send_store_aproval_mail($name,$s_subject,$message,$store_id,$email_to);
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	public function template_send_store_aproval_mail($name,$s_subject,$message,$store_id,$email_to){
		$store_admin=$this->superadmin_model->get_row('stores', array('id' => $store_id));
		$data = array(
					'name'=>$name,
					's_subject'=>$s_subject,
					'message'=>$message,
					'store_link' =>$store_admin->store_link,
					
					'email_to' =>$email_to,
					);
		$data['template'] = '';
		$message = $this->load->view('email/template_send_store_aproval_mail',$data,TRUE);
		return $message;
	}

	public function ajax_check_slug($slug = '')
	{
		$designs = $this->superadmin_model->get_row('design', array('slug' => $slug));

		if ($designs)
			$resp = array('status' => false, 'msg' => 'Slug you are choosing already exist...');
		else
			$resp = array('status' => true, 'msg' => 'SUCCESS');

		echo json_encode($resp);
	}

	public function uploaded_designs($storeid = '')
	{
		$this->check_login();
		if ($storeid == '') {
			$this->session->set_flashdata('error_msg', 'No Store selected.');
			redirect('store/pending_stores');
		}

		$data['designs'] = $this->superadmin_model->uploaded_designs($storeid);
		$data['template'] = 'superadmin/uploaded_designs';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function pending_stores($storename = "-" ,$storeid = "-", $offset = 0){

		$this->check_login();

		if($_POST){

			if ($this->input->post('storename') != "")
				$storename = $this->input->post('storename');

			if ($this->input->post('storeid') != "")
				$storeid = $this->input->post('storeid');

		}

		$limit=30;
		$data['stores']=$this->superadmin_model->pending_stores($limit, $offset, $storename, $storeid);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/pending_stores/'.$storename.'/'.$storeid.'/';
		$config['total_rows'] = $this->superadmin_model->pending_stores(0, 0, $storename, $storeid);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['incomplete_stores'] = $this->superadmin_model->get_incomplete_stores();
		$offset++;
		$data['offset'] = $offset;

		if ($storename == '-')
			$data['storename'] = "";
		else
			$data['storename'] = $storename;

		if ($storeid == '-')
			$data['storeid'] = "";
		else
			$data['storeid'] = $storeid;

		$data['template'] = 'superadmin/pending_stores';
        $this->load->view('templates/superadmin_template', $data);	
	}

	public function incomplete_store(){
		$stores = $this->superadmin_model->get_incomplete_stores();
		$store_ids = array();

		foreach ($stores as $value)
			$store_ids[] = $value->id;

		if ($stores){
			$designs = $this->superadmin_model->get_designs_array($store_ids);
			if ($designs) {
				foreach ($designs as $dsn) {
					$del = $this->superadmin_model->delete('design',array('id' => $dsn->id));
					if ($del) {
						$path='./assets/uploads/designs/';
						if(!empty($dsn->design_image)){
							@unlink($path.$dsn->design_image);
							@unlink($path.'thumbnail/'.$dsn->design_image);
						}
					}
				}
			}
			foreach ($stores as $value){
				$this->superadmin_model->delete('design_to_multistore', array('store_id' => $value->id));
				$this->superadmin_model->delete('stores', array('id' => $value->id, 'is_processed' => 0));
			}
		}else{
			$this->session->set_flashdata('error_msg', 'No incomplete sign ups.');
			redirect('superadmin/pending_stores');
		}

		$this->session->set_flashdata('success_msg', 'Incomplete sign ups deleted successfully.');
		redirect('superadmin/pending_stores');
	}

	// public function stores($offset = 0){
	// 	$this->check_login(); 		
	// 	$limit=30;
	// 	$data['stores']=$this->superadmin_model->stores($limit, $offset);
	// 	$config= get_pagination_style();	
	// 	$config['base_url'] = base_url().'superadmin/stores/';
	// 	$config['total_rows'] = $this->superadmin_model->stores(0, 0);
	// 	$config['per_page'] = $limit;
	// 	$config['num_links'] = 5;		
	// 	$this->pagination->initialize($config); 		
	// 	$data['pagination'] = $this->pagination->create_links();
	// 	$data['template'] = 'superadmin/stores';
 //        $this->load->view('templates/superadmin_template', $data);	
	// }

	public function check_declartion($declaration){

		if(!empty($_FILES))
		{
			if($declaration)
				return TRUE;
			else
			{
				$this->form_validation->set_message('check_declartion', 'Declaration reqired for this upload ');
				return FALSE;
			}
		}
		else
			return TRUE;
	}

	public function check_print_area($declaration){
		$f_width = $this->input->post('f_width');
		$f_height = $this->input->post('f_height');
		$f_left = $this->input->post('f_left');
		$f_top = $this->input->post('f_top');
		$b_width = $this->input->post('b_width');
		$b_height = $this->input->post('b_height');
		$b_left = $this->input->post('b_left');
		$b_top = $this->input->post('b_top');
		$error_msg='';
		if($f_width == 0 || $f_height == 0)
			$error_msg='<br>Please select front image printing area.';

		if($b_width == 0 || $b_height == 0)
			$error_msg='<br>Please select back image printing area.';

		if (!empty($error_msg)) {
			$this->form_validation->set_message('check_print_area', $error_msg);
			return FALSE;
		}else
			return TRUE;
	}

	// public function add_store(){
	// 	$this->check_login(); 		
	// 	// $this->form_validation->set_rules('firstname', 'First name', 'required');
	// 	// $this->form_validation->set_rules('lastname', 'Last name', 'required');		
	// 	// $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
	// 	// $this->form_validation->set_rules('phone', 'phone', 'required');
	// 	// $this->form_validation->set_rules('password', 'Password', 'required');
	// 	// $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');		
	// 	$this->form_validation->set_rules('store_name', 'Store Name', 'required');
	// 	$this->form_validation->set_rules('store_description', 'Store description', 'required');
	// 	$this->form_validation->set_rules('i_declare', 'Declaration', 'callback_check_declartion');

	// 	if ($this->form_validation->run() == TRUE){			
	// 		$store=array(
	// 			'user_id' => $this->input->post('admin_id'),				
	// 			'store_name'=>$this->input->post('store_name'),
	// 			'store_description'=>$this->input->post('store_description'),
	// 			'created' => date('Y-m-d')
	// 			);
	// 		if($_FILES['userfile']['name']!=''){				
	// 			$do_upload = $this->do_upload();			
	// 			if($do_upload['status']==FALSE){
	// 				$this->session->set_flashdata('image_error'.$do_upload['error']);
	// 				redirect('superadmin/add_store/');
	// 			}else{
	// 				$store['store_banner']=$do_upload['upload_data']['file_name'];
	// 			}
	// 		}
	// 		$this->superadmin_model->insert('stores',$store);
	// 		$this->session->set_flashdata('success_msg',"Store has been added successfully.");
	// 		redirect('superadmin/pending_stores');
	// 	}
	// 	$data['store_admin'] = $this->superadmin_model->get_result('users', array('user_role'=>2));
	// 	$data['template'] = 'superadmin/add_store';
 //        $this->load->view('templates/superadmin_template', $data);		
	// }

	public function check_banner($banner){
		if($_FILES['userfile']['name'] == '')
		{
			$this->form_validation->set_message('check_banner', 'Store Banner required.');
			return FALSE;
		}
		else
			return TRUE;
	}

	public function add_store()
	{
		$this->check_login();
		$this->form_validation->set_message('is_unique', 'Store link you are choosing already exist.');
		$this->form_validation->set_rules('store_name', 'Store Name', 'required');
		$this->form_validation->set_rules('admin_id', 'Store Admin', 'required');
		$this->form_validation->set_rules('store_description', 'Store description', 'required');
		$this->form_validation->set_rules('userfile', 'Banner', 'callback_check_banner');
		$this->form_validation->set_rules('store_link', 'Store Link', 'trim|required|xss_clean|is_unique[stores.store_link]');
		
		if ($this->form_validation->run() == TRUE){
			// $user = $this->superadmin_model->get_row('users', array('id' => $this->input->post('admin_id')));
			// print_r($user);
			// die();
			$store_link = strtolower(str_replace(' ', '-', trim($this->input->post('store_link'))));
			$store=array(
				'user_id' 			=> 	$this->input->post('admin_id'),				
				'store_name'		=> 	$this->input->post('store_name'),
				'store_description'	=> 	$this->input->post('store_description'),
				'store_link'		=> 	$store_link,
				'is_processed'		=> 	1,
				'status'			=> 	1,
				'created' 			=> 	date('Y-m-d')
				);
			if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('error_msg' , $do_upload['error']);
					redirect('superadmin/add_store/');
				}else{
					$store['store_banner']=$do_upload['upload_data']['file_name'];
				}
			}

			$store_id=$this->superadmin_model->insert('stores',$store);
			if ($store_id) {
				$user = $this->superadmin_model->get_row('users', array('id' => $this->input->post('admin_id')));
				$s_subject = 'Store creation notification';
				$message = 'Hello '.$user->firstname.' '.$user->lastname.':<br>';
				$message .= 'You have a store created at ShirtScore.com, Now you can add your artwork, sell them and get paid for it.<br>';
				$message .= 'Your store is available at following url:<br>';
				$message .= 'Store Url :'.base_url().'shop/'.$store_link.'<br>';
				$name = $user->firstname.' '.$user->lastname;
				$email = $user->email;
				$this->send_store_creation_mail($name,$email,$s_subject,$message);
				$this->session->set_flashdata('success_msg',"Store has been added successfully.");
			}else{
				$this->session->set_flashdata('error_msg',"Store has been added successfully.");
			}
			redirect('superadmin/approved_stores');
		}
		$data['store_admin'] = $this->superadmin_model->get_result('users', array('user_role' => 3, 'is_storeadmin' => 1));
		$data['template'] = 'superadmin/add_store';
        $this->load->view('templates/superadmin_template', $data);		
	}
 	
 	public function send_store_creation_mail($name,$email_to,$s_subject,$message){
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'Store Creation Notification';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
		$to = array(
			 $email_to,
		);
		// $html = "<em><strong>Hello ".$name." !</strong></em> <br>
		// 		<p><strong>Subject - ".$s_subject."</strong></p>
		// 		<p><strong>Message - ".$message."</strong></p>";
		$html = $this->template_send_store_creation_mail($name,$s_subject,$message);
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	public function template_send_store_creation_mail($name,$s_subject,$message){
		$data = array(
					'name'=>$name,
					's_subject'=>$s_subject,
					'message'=>$message
					);
		$data['template'] = 'email/template_send_store_creation_mail';
		$message = $this->load->view('templates/email_template',$data,TRUE);
		return $message;
	}

 	public function check_store_link($link, $id){

		if ($link != ''){
			$resp = $this->superadmin_model->get_row('stores', array('id !=' => $id, 'store_link' => $link));
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

	public function edit_store($store_id='', $called = 'pending_stores'){
		$this->check_login();
		if($store_id=='')
			redirect('superadmin/'.$called);

		$data['store'] = $this->superadmin_model->get_store($store_id);
	

		// echo $data['store']->user_id; die();
		// $this->form_validation->set_rules('firstname', 'First name', 'required');
		// $this->form_validation->set_rules('lastname', 'Last name', 'required');
		// $this->form_validation->set_rules('phone', 'phone', 'required');
		$this->form_validation->set_rules('store_name', 'Store Name', 'required');
		
		$this->form_validation->set_rules('store_description', 'Store description', 'required');
		$this->form_validation->set_rules('store_link', 'Store Link', 'trim|required|xss_clean|callback_check_store_link['.$store_id.']');
		
		if($called != 'pending_stores')
			$this->form_validation->set_rules('admin_id', 'Store Admin', 'required');

		if ($this->form_validation->run() == TRUE){
			$store=array(
				'store_name'=>$this->input->post('store_name'),
				'store_description'=>$this->input->post('store_description'),
				'store_link'=>strtolower(str_replace(' ', '-', trim($this->input->post('store_link'))))
				);

			if($called != 'pending_stores')
				$store['user_id'] = $this->input->post('admin_id');

			if($_FILES['userfile']['name'] != ''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('error_msg' , $do_upload['error']);
					redirect('superadmin/edit_store/'.$store_id.'/'.$called);
				}else{
					$store['store_banner']=$do_upload['upload_data']['file_name'];
					// $this->remove_image($store_id);
				}
			}

			$this->superadmin_model->update('stores',$store, array('id'=>$store_id));
			$this->session->set_flashdata('success_msg',"Store has been updated successfully.");
			redirect('superadmin/'.$called);

		}
		$data['called'] = $called;
		$data['store_admin'] = $this->superadmin_model->get_result('users', array('user_role' => 3, 'is_storeadmin' => 1));
		$data['template'] = 'superadmin/edit_store';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function store_detail($store_id)
	{
		$this->check_login();
		if(empty($store_id)) redirect('superadmin/approved_stores');

		$data['store_detail']=$this->superadmin_model->store_detail($store_id);

		$data['template'] = 'superadmin/store_detail';
        $this->load->view('templates/superadmin_template', $data);
    }

	public function delete_store($store_id, $store_call=''){

		if(empty($store_id) && empty($store_call)) redirect('superadmin/approved_stores');

		$store_ids[] = $store_id;

		$designs = $this->superadmin_model->get_designs_array($store_ids);

		if ($designs) {
			foreach ($designs as $dsn) {
				$other = $this->superadmin_model->get_result('design_to_multistore', array('store_id !=' => $store_id, 'design_id' => $dsn->id));
				if (!$other) {
					$del = $this->superadmin_model->delete('design',array('id' => $dsn->id));
					if ($del) {
						$path='./assets/uploads/designs/';
						if(!empty($dsn->design_image)){
							@unlink($path.$dsn->design_image);
							@unlink($path.'thumbnail/'.$dsn->design_image);
						}
					}
				}
				$this->superadmin_model->delete('design_to_multistore', array('store_id' => $store_id, 'design_id' => $dsn->id));
			}
		}

		$this->superadmin_model->delete('stores', array('id'=> $store_id));

		$this->session->set_flashdata('success_msg',"Store has been deleted successfully.");
		redirect('superadmin/'.$store_call);
	}

	public function suspend_store($store_id, $val, $from){
		$this->check_login();
		if(empty($store_id) && empty($form))  redirect('superadmin/approved_stores');

		$this->superadmin_model->update('stores', array('is_blocked'=> $val), array('id' => $store_id));		
		if($val == 0){
		$this->session->set_flashdata('success_msg', 'Store unblocked successfully.');
		}
		if($val == 1){
		$this->session->set_flashdata('success_msg', 'Store blocked successfully.');
		}
		redirect('superadmin/'.$from);
	}

	public function do_upload(){
		$this->check_login(); 	
		$config['upload_path'] = './assets/uploads/store';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '50000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload()){
			return array('status'=> FALSE,'error' => $this->upload->display_errors());			
		}else{
			return array('status'=> TRUE,'upload_data' => $this->upload->data());			
		}
	}


	public function remove_image($store_id){
		if(empty($store_id)) redirect('superadmin/approved_stores');

		$query = $this->superadmin_model->get_row('stores', array('id'=>$store_id));
		if(!empty($query->store_banner)){
			$path = "assets/uploads/store/";
			unlink($path.$query->store_banner);
			$this->superadmin_model->update('stores', array('store_banner' => ""), array('id' => $store_id));
			echo "done";
		}
	}


	public function login_as_storeadmin($admin_id='')
	{
		$this->check_login();

		if ($admin_id == ''){
			$this->session->set_flashdata('error_msg', 'Cannot procced, information missing.');
			redirect('superadmin/store_admins');
		}

		if ($this->session->userdata('storeadmin_info')) {
			$this->session->set_userdata('storeadmin_info','');
			$this->session->unset_userdata('storeadmin_info');
		}

		if ($this->session->userdata('customer_info')) {
		$this->session->set_userdata('customer_info','');
		$this->session->unset_userdata('customer_info');
		}
		$this->load->model('login_model');
		
		$user_info = $this->superadmin_model->get_row('users', array('id' => $admin_id,'banned'=>0 ));

		if( !empty($user_info)){
			$user_role = 2;
			if ($user_info->is_storeadmin != 0)
				$user_role = 3;
			
			$status = $this->login_model->login($user_info->email, $user_info->password, $user_role, 'yes');
			if ($status['status']) {
				redirect('storeadmin');
			}
			else{
				$this->session->set_flashdata('error_msg', 'Login failed.');
				redirect('storeadmin/login');
			}
		}
		else{
			$this->session->set_flashdata('error_msg', 'Login failed. store admin already banned.');
			redirect('superadmin/store_admins');

		}	
	}

	public function customer_service($fname = "-", $lname = "-", $email = "-", $user_id = "-", $offset = 0){
		$this->check_login(); 		
		
		if($_POST){

			if($this->input->post('fname') != ""){
				$fname = $this->input->post('fname');
			}

			if($this->input->post('lname') != ""){
				$lname = $this->input->post('lname');	
			}

			if($this->input->post('email') != ""){
				$email = $this->input->post('email');
			}

			if($this->input->post('user_id') != ""){
				$user_id = $this->input->post('user_id');
				// echo "UID :".$user_id;
				// die();
			}
		}
		$limit=10;
		$data['cust_service']=$this->superadmin_model->customer_service($limit, $offset, $fname, $lname, $email, $user_id);
		// print_r($data['cust_service']);
		// die();
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/customer_service/'.$fname."/".$lname."/".$email."/".$user_id."/";
		$config['total_rows'] = $this->superadmin_model->customer_service(0, 0, $fname, $lname, $email, $user_id);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$config['uri_segment'] = 7;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;

		if ($fname == '-')
			$data['fname'] = "";
		else
			$data['fname'] = $fname;

		if ($lname == '-')
			$data['lname'] = "";
		else
			$data['lname'] = $lname;

		if ($email == '-')
			$data['email'] = "";
		else
			$data['email'] = $email;

		if ($user_id == '-')
			$data['user_id'] = "";
		else
			$data['user_id'] = $user_id;

		// $data['commission'] = $this->superadmin_model->get_admin_commission();
		$data['template'] = 'superadmin/customer_service';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function change_status_customer_service($cust_service_id, $val){
		$this->check_login(); 	
		if(empty($cust_service_id) && empty($val)) redirect('superadmin/customer_service');

		$this->superadmin_model->update('users', array('banned'=> $val), array('id' => $cust_service_id));		
		if($val == 0){
		$this->session->set_flashdata('success_msg', 'Customer Service Associate unblocked successfully.');
		}
		if($val == 1){
		$this->session->set_flashdata('success_msg', 'Customer Service Associate blocked successfully.');
		}
		redirect('superadmin/customer_service');
	}

	public function store_admins($offset = 0){
		$this->check_login(); 		
		// $fname = $this->session->userdata('fname_val_for_store_admins');
		// $lname = $this->session->userdata('lname_val_for_store_admins');
		// $email = $this->session->userdata('email_val_for_store_admins');
		// $user_id = $this->session->userdata('user_id_val_for_store_admins');
		$fname = '';
		$lname = '';
		$email = '';
		$user_id = '';
		if($_POST){
			$fname = $this->input->post('fname');
			//	$this->session->set_userdata('fname_val_for_store_admins', $fname);
			$lname = $this->input->post('lname');
			//	$this->session->set_userdata('lname_val_for_store_admins', $lname);
			$email = $this->input->post('email');
			//	$this->session->set_userdata('email_val_for_store_admins', $email);
			$user_id = $this->input->post('user_id');
			//$this->session->set_userdata('user_id_val_for_store_admins', $user_id);
			$data['fname'] 		= $this->input->post('fname');
			$data['lname'] 		= $this->input->post('lname');
			$data['email'] 		=  $this->input->post('email');
			$data['user_id'] 	= $this->input->post('user_id');
		}
		$limit=10;
		$data['store_admins']=$this->superadmin_model->store_admins($limit, $offset, $fname, $lname, $email, $user_id);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/store_admins/';
		$config['total_rows'] = $this->superadmin_model->store_admins(0, 0, $fname, $lname, $email, $user_id);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		// $data['commission'] = $this->superadmin_model->get_admin_commission();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/store_admins';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function message_center($offset = 0){
		$this->check_login(); 		

		$limit=10;
		$data['messages']=$this->superadmin_model->messages($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/message_center/';
		$config['total_rows'] = $this->superadmin_model->messages(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;		
		$data['template'] = 'superadmin/message_center';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function message_info($id){
		$this->check_login();
		if (empty($id)) {
			$this->session->set_flashdata('error_msg', 'Message not found.');
			redirect('superadmin/message_center');
		}
		$data['msg'] = $this->superadmin_model->get_row('messages',array('id'=>$id));		
		$data['template'] = 'superadmin/message_info';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function delete_message($id=""){
		$this->check_login();
		if (empty($id)) {
			$this->session->set_flashdata('error_msg', 'Message not found.');
			redirect('superadmin/message_center');
		}
		$del = $this->superadmin_model->delete('messages',array('id'=>$id));
		if ($del)
			$this->session->set_flashdata('success_msg','Message has been deleted successfully.');
		else
			$this->session->set_flashdata('error_msg','Message cannot be deleted.');
		redirect('superadmin/message_center');
	}

	public function messages($offset = 0){
		$this->check_login();
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ($this->form_validation->run() == TRUE){
			$all_admins = $this->input->post('all_admins');
			$admin_ids = $this->input->post('admin_id');

			if (empty($admin_ids)) {
				$this->session->set_flashdata('error_msg', 'Recievers info is missing.');
				redirect('superadmin/messages');
			}
			$admins = $this->superadmin_model->get_admins_for_msg($admin_ids, $all_admins);
			// print_r($admins);
			// die();
			$s_subject = $this->input->post('subject');
			$message = $this->input->post('message');
			foreach ($admins as $admin) {
				$name = $admin->firstname." ".$admin->lastname;
				$this->load->library('smtp_lib/smtp_email');
				$subject = $s_subject;	// Subject for email

				$msg = array(
							 'admin_id' 	=> 		$admin->id,
							 'name' 		=> 		$name,
							 'email' 		=> 		$admin->email,
							 'subject' 		=> 		$subject,
							 'message' 		=> 		$message,
							 'created' 		=> 		date('Y-m-d H:i:s')
							);
				$this->superadmin_model->insert('messages', $msg);
				$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
				$to = array(
					 $admin->email,
				);

				$html = $this->template_message_to_multiple_storeadmin($name,$s_subject,$message);
				// $html = "<em>Hello <strong>".$name." !</strong></em> <br>
				// 		<p>Subject - ".$s_subject."</p>
				// 		<p>Message - ".$message."</p>";
						// echo $html; die(); 
				$this->smtp_email->sendEmail($from, $to, $subject, $html);
			}

			$this->session->set_flashdata('success_msg',"Message Sent successfully.");
			redirect('superadmin/message_center');
		}
		$limit=10;
		$data['store_admins']=$this->superadmin_model->store_admins1($limit, $offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/messages/';
		$config['total_rows'] = $this->superadmin_model->store_admins1(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/messages';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function template_message_to_multiple_storeadmin($name,$s_subject,$message){
		$data = array(
					'name'=>$name,
					's_subject'=>$s_subject,
					'message'=>$message
					);
		$data['template'] = 'email/template_message_to_multiple_storeadmin';
		$message = $this->load->view('templates/email_template',$data,TRUE);
		return $message;
	}

	public function add_store_admin(){
		$this->check_login();
		$this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zip', 'Zip', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_message('is_natural_no_zero', 'Please enter valid value');
		if ($this->form_validation->run() == TRUE){
			$length = 8;
	        // $admin_pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	        $name = $this->input->post('firstname')." ".$this->input->post('lastname');
	        $email = $this->input->post('email');
			$user=array(
				'user_role' 	=>3,
				'firstname'		=>strtolower($this->input->post('firstname')),
				'lastname'		=>strtolower($this->input->post('lastname')),
				'email'			=>$email,
				'is_storeadmin'	=>1,
				'activated'	    =>1,
				'banned'	    =>0,
				'mobile'		=>$this->input->post('mobile'),
				'password'		=>sha1(trim($this->input->post('password'))),
				'address'		=>		$this->input->post('address'),	
				'city'			=>		$this->input->post('city'),	
				'state'			=>		$this->input->post('state'),	
				'zip'			=>		$this->input->post('zip'),	
				'country'		=>		$this->input->post('country'),
				'created' 		=> date('Y-m-d')
				);

			$user_id=$this->superadmin_model->insert('users',$user);
			$this->load->model('store_model');
			$this->store_model->insert('user_payee_info', array('user_id' => $user_id, 'created' => date('Y-m-d')));
			
			if ($user_id) {
				$this->session->set_flashdata('success_msg',"Store Admin has been added successfully. Please give store details and choose created store admin.");
				redirect('superadmin/add_store');
			}else{
				$this->session->set_flashdata('error_msg',"Error in adding information.");
				redirect('superadmin/store_admins');
			}

		}		
		$data['template'] = 'superadmin/add_store_admin';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function add_customer_services(){
		$this->check_login();
		$this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'phone', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zip', 'Zip', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_message('is_natural_no_zero', 'Please enter valid value');
		if ($this->form_validation->run() == TRUE){
	        // $admin_pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	        $name = $this->input->post('firstname')." ".$this->input->post('lastname');
	        $email = $this->input->post('email');
			$user=array(
				'user_role' 	=>		1,
				'firstname'		=>		strtolower($this->input->post('firstname')),
				'lastname'		=>		strtolower($this->input->post('lastname')),
				'email'			=>		$email,
				'activated'		=>		1,
				'mobile'		=>		$this->input->post('phone'),
				'password'		=>		sha1(trim($this->input->post('password'))),
				'address'		=>		$this->input->post('address'),	
				'city'			=>		$this->input->post('city'),	
				'state'			=>		$this->input->post('state'),	
				'zip'			=>		$this->input->post('zip'),	
				'country'		=>		$this->input->post('country'),
				'created' 		=>		date('Y-m-d')
				);
			// print_r($user);
			// die();
			$user_id=$this->superadmin_model->insert('users',$user);
			if ($user_id) {
				$message="You have successfully added to the customer service section of ShirtScore.";
				$message.="Your Login Credentials Are <br>";
				$message.="Link :".base_url()."customer_service/login <br>";
				$message.="Username :".$email." <br>";
				$message.="Password :".trim($this->input->post('password'))." <br>";
				$this->send_customer_service_mail($name,$email,$message);
				$this->session->set_flashdata('success_msg',"Customer Service added successfully.");
				redirect('superadmin/customer_service');
			}else{
				$this->session->set_flashdata('error_msg',"Error in adding information.");
				redirect('superadmin/customer_service');
			}
		}		
		$data['template'] = 'superadmin/add_customer_services';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function check_is_email_unique($new_email, $old_email){
		if ($old_email === $new_email) {
				return TRUE;
			}else{
				$resp = $this->superadmin_model->get_row('users', array('email' => $new_email));
				if ($resp) {
					$this->form_validation->set_message('check_is_email_unique', 'Email you are choosing already exist.');
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}

	public function edit_customer_services($cust_service_id=''){
        $this->check_login();   
        if($cust_service_id =='')
        	redirect('superadmin/customer_service');

        $data['cust_service'] = $this->superadmin_model->get_customer_service($cust_service_id);               
        // print_r($data['cust_service']);
        // die();
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_is_email_unique['.$data['cust_service']->email.']');
        $this->form_validation->set_rules('firstname', 'First name', 'required');
        $this->form_validation->set_rules('lastname', 'Last name', 'required');               
        $this->form_validation->set_rules('phone', 'phone', 'required');       
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zip', 'Zip', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_message('is_natural_no_zero', 'Please enter valid value');
        // if($this->input->post('password')!=""){
        //     $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        // 	$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');               
        // }
        if ($this->form_validation->run() == TRUE){      

            $user=array(               
                'firstname'		=>		strtolower($this->input->post('firstname')),
				'lastname'		=>		strtolower($this->input->post('lastname')),
				'email'			=>		$this->input->post('email'),
				'mobile'		=>		$this->input->post('phone'),
				'address'		=>		$this->input->post('address'),	
				'city'			=>		$this->input->post('city'),	
				'state'			=>		$this->input->post('state'),	
				'zip'			=>		$this->input->post('zip'),	
				'country'		=>		$this->input->post('country'),	
				'modified' 		=>		date('Y-m-d')
                );

          //   	print_r($user);
        		// die();
            $resp = $this->superadmin_model->update('users', $user, array('id' => $cust_service_id));       
            if ($resp)
	            $this->session->set_flashdata('success_msg',"Updated successfully.");
	        else
	            $this->session->set_flashdata('error_msg',"Cannot Update info.");

	            redirect('superadmin/customer_service');

        }

        $data['template'] = 'superadmin/edit_customer_services';
        $this->load->view('templates/superadmin_template', $data);
    }

    public function delete_customer_services($cust_service_id){				
		$this->check_login();
		if(empty($cust_service_id)) redirect('superadmin/customer_service');

		$resp = $this->superadmin_model->delete('users', array('id'=> $cust_service_id));

		if ($resp)
			$this->session->set_flashdata('success_msg',"Customer services has been deleted successfully.");
		else
			$this->session->set_flashdata('error_msg',"Customer services cannot deleted.");
		
		redirect('superadmin/customer_service');
	}

	public function send_customer_service_mail($name, $email_to, $message){
		$this->load->library('smtp_lib/smtp_email');
		$subject = 'ShirtScore Staff Notification';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
		$to = array(
			 $email_to,
		);
		// $html = "<em><strong>Hello ".$name." !</strong></em> <br>
		// 		<p><strong>Subject - ShirtScore Staff Notification </strong></p>
		// 		<p><strong>Message - ".$message."</strong></p>";
		$html = $this->template_send_customer_service_mail($name, $email_to, $message);
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	public function template_send_customer_service_mail($name,$email_to,$message){
		$data = array(
					'name'=>$name,
					'email_to'=>$email_to,
					'message'=>$message
					);
		$data['template'] = 'email/template_send_customer_service_mail';
		$message = $this->load->view('templates/email_template',$data,TRUE);
		return $message;
	}

	public function admin_details($admin_id){
		$this->check_login();
		if(empty($admin_id)) redirect('superadmin/store_admins');
	
		$data['results'] = $this->superadmin_model->get_row('users', array('id' => $admin_id));
		
		if(!empty($data['results']->id)){
			$data['stores'] = $this->superadmin_model->get_result('stores', array('user_id'=>$data['results']->id));
		
		}

		$data['template'] = 'superadmin/admin_details';
        $this->load->view('templates/superadmin_template', $data);		
	}


	public function emailtostore_admin($admin_id){
		$this->check_login(); 
		if(empty($admin_id)) redirect('superadmin/store_admins');
		$data['admin'] = $this->superadmin_model->get_row('users', array('id'=>$admin_id));

		$name = $data['admin']->firstname." ".$data['admin']->lastname;
		$this->form_validation->set_rules('subject', 'Subject', 'required');				
		$this->form_validation->set_rules('message', 'Message', 'required');				
		if ($this->form_validation->run() == TRUE){

			$s_subject = $this->input->post('subject');
			$message = $this->input->post('message');

			$this->load->library('smtp_lib/smtp_email');
			$subject = $s_subject;	// Subject for email
			$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
			$to = array(
				 $data['admin']->email,
			);
			$html = $this->template_emailtostore_admin($name,$s_subject,$message);
			// $html = "<em><strong>Hello ".$name." !</strong></em> <br>
			// 		<p><strong>Subject - ".$s_subject."</strong></p>
			// 		<p><strong>Message - ".$message."</strong></p>";
					// echo $html; die(); 
			$this->smtp_email->sendEmail($from, $to, $subject, $html);

			$this->session->set_flashdata('success_msg',"Email has been Sent successfully.");
			redirect('superadmin/store_admins');
		}

		$data['template'] = 'superadmin/emailtostore_admin';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function template_emailtostore_admin($name,$s_subject,$message){
		$data = array(
					'name'=>$name,
					's_subject'=>$s_subject,
					'message'=>$message
					);
		$data['template'] = 'email/template_emailtostore_admin';
		$message = $this->load->view('templates/email_template',$data,TRUE);
		return $message;
	}

	public function edit_store_admin($admin_id=''){
        $this->check_login();   
        if($admin_id =='')
        	redirect('superadmin/store_admins');
        $data['state']=$this->superadmin_model->get_result('state');
        $data['pay_info'] = $this->superadmin_model->get_row('user_payee_info',array('user_id'=>$admin_id));
        $data['store_admin'] = $this->superadmin_model->get_store_user($admin_id);   
        if(!empty($data['store_admin']->id)){ 
		$data['stores'] = $this->superadmin_model->get_result('stores',array('user_id'=>$data['store_admin']->id)); 
		}            
        if($this->input->post('email') !=""){
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');           
        }

        // if($this->input->post('password')!=""){
        //     $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        // }

        $this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_is_email_unique['.$data['store_admin']->email.']');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');      
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zip', 'Zip', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_message('is_natural_no_zero', 'Please enter valid value');
        		
		


        //$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');               
        if ($this->form_validation->run() == TRUE){
            $user=array(               
                'firstname'	=>	$this->input->post('firstname'),
                'lastname'	=>	$this->input->post('lastname'),               
                'mobile'	=>	$this->input->post('mobile'),
                'address'		=>		$this->input->post('address'),	
				'city'			=>		$this->input->post('city'),	
				'state'			=>		$this->input->post('state'),	
				'zip'			=>		$this->input->post('zip'),	
				'country'		=>		$this->input->post('country'),
				'modified' 		=>		date('Y-m-d')
                );
                if($this->input->post('email') !="")
                {
                    $user['email']=$this->input->post('email');
                }
                $store_name = '';
            $this->superadmin_model->update_store_user($user,$store_name,$admin_id);       
            $this->session->set_flashdata('success_msg',"Store admin updated successfully.");
            redirect('superadmin/store_admins');

        }

        $data['template'] = 'superadmin/edit_store_admin';
        $this->load->view('templates/superadmin_template', $data);
    }

	// public function edit_store_admin($admin_id){
	// 	$this->check_login(); 	
	// 	$data['store_admin'] = $this->superadmin_model->get_row('users',array('id' => $admin_id));
	// 	// echo $data['store']->user_id; die();
	// 	$this->form_validation->set_rules('firstname', 'First name', 'required');
	// 	$this->form_validation->set_rules('lastname', 'Last name', 'required');				
	// 	$this->form_validation->set_rules('phone', 'phone', 'required');		
	// 	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
	// 	$this->form_validation->set_rules('password', 'Password', 'required');
	// 	$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');				
	// 	if ($this->form_validation->run() == TRUE){	

	// 		$user=array(				
	// 			'firstname'=>$this->input->post('firstname'),
	// 			'lastname'=>$this->input->post('lastname'),				
	// 			'mobile'=>$this->input->post('phone'),								
	// 			);

	// 		$this->superadmin_model->update('users',$user, array('id'=>$data['store']->user_id));		
	// 		$this->session->set_flashdata('success_msg',"Store has been updated successfully.");
	// 		redirect('superadmin/store_admins');

	// 	}


	// 	$data['template'] = 'superadmin/edit_store_admin';
 //        $this->load->view('templates/superadmin_template', $data);
	// }

	public function pages($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['pages']=$this->superadmin_model->pages($limit, $offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'superadmin/pages/';
		$config['total_rows'] = $this->superadmin_model->pages(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();	
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/pages';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function check_page_slug($slug, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_slug = $param[1];
		if ($called === 'add'){
			$resp = $this->superadmin_model->get_row('pages', array('slug' => $slug));
			if ($resp){
				$this->form_validation->set_message('check_page_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif ($old_slug === $slug) {
				return TRUE;
		}else{
			$resp = $this->superadmin_model->get_row('pages', array('slug' => $slug));
			if ($resp) {
				$this->form_validation->set_message('check_page_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

	public function add_page(){
		$this->check_login(); 
		$this->form_validation->set_rules('page_name', 'Page name', 'required');		
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_page_slug['."add,slug".']');
		$this->form_validation->set_rules('sub_header1', 'Sub header', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');		
		if ($this->form_validation->run() == TRUE){			
			$pages=array(
				'page_name'		=>	$this->input->post('page_name'),				
				'page_url'		=>	base_url().'store/pages/'.$this->input->post('slug'),
				'slug'			=>	$this->input->post('slug'),
				'sub_heading'	=>	$this->input->post('sub_header1'),
				'body'			=>	$this->input->post('body'),	
				'created' 		=>	date('Y-m-d H:i:s')		
			);
			// print_r($pages);
			// die();
			/*if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('superadmin/add_page/');
				}else{
					$pages['image']=$do_upload['upload_data']['file_name'];
				}
			}*/

			$this->superadmin_model->insert('pages',$pages);		
			$this->session->set_flashdata('success_msg',"Page has been added successfully.");
			redirect('superadmin/pages');
		}
		$data['template'] = 'superadmin/add_page';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function edit_page($id=''){
		$this->check_login();
		if($id=='')
		redirect('superadmin/pages');
		$data['pages'] = $this->superadmin_model->get_row('pages',array('id'=>$id));
		$old_slug = $data['pages']->slug;
		$this->form_validation->set_rules('page_name', 'Page name', 'required');		
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_page_slug['."edit".','.$old_slug.']');
		$this->form_validation->set_rules('sub_header1', 'Sub header 1', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');					
		if ($this->form_validation->run() == TRUE){				

			$pages=array(
				'page_name'		=>	$this->input->post('page_name'),				
				'page_url'		=>	base_url().'store/pages/'.$this->input->post('slug'),
				'slug'			=>	$this->input->post('slug'),
				'sub_heading'	=>	$this->input->post('sub_header1'),
				'body'			=>	$this->input->post('body'),	
				'modified' 		=>	date('Y-m-d H:i:s')		
			);

				/*if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('error_msg', $do_upload['error']);
					redirect('superadmin/edit_page/'.$id);
				}else{
					$pages['image']=$do_upload['upload_data']['file_name'];
					$this->remove_page_image($id);
				}
			}			*/		

			$this->superadmin_model->update('pages',$pages,array('id'=>$id));
			$this->session->set_flashdata('success_msg',"Page has been updated successfully.");
			redirect('superadmin/pages');
		}
		// $data['pages'] = $this->superadmin_model->get_row('pages',array('id'=>$id));
		$data['template'] = 'superadmin/edit_page';
        $this->load->view('templates/superadmin_template', $data);	
        
	}

	public function remove_page_image($page_id){
		$this->check_login();
		if(empty($page_id)) redirect('superadmin/pages');

		$data['pages'] = $this->superadmin_model->get_row('pages',array('id'=>$page_id));		
		/*if(!empty($data['pages']->image)){
		$path='./assets/uploads/store/';		
			@unlink($path.$data['pages']->image);
			$this->superadmin_model->update('pages', array('image' => ""), array('id' => $page_id));
			echo "done";
		}*/

	}

	public function change_page_status($page_id, $val){
		$this->check_login();
		if(empty($page_id) && empty($val)) redirect('superadmin/pages');

		$this->superadmin_model->update('pages', array('status' => $val), array('id' => $page_id));

		if($val == 0){
			$this->session->set_flashdata('success_msg', 'Page status set to unpublish successfully.');
		}

		if($val == 1){
			$this->session->set_flashdata('success_msg', 'Page status set to publish successfully.');
		}

		redirect('superadmin/pages');
	}

	public function delete_page($id){
		$this->check_login();
	if(empty($id)) redirect('superadmin/pages');
		/*$pages = $this->superadmin_model->get_row('pages',array('id'=>$id));
		$file=$pages->image;
		if(!empty($pages->image)){
		$path='./assets/uploads/';		
			@unlink($path.$pages->image);			
		}*/
		$this->superadmin_model->delete('pages',array('id'=>$id));		
		$this->session->set_flashdata('success_msg','Page has been deleted successfully.');
		redirect('superadmin/pages');
	}

	public function delete_store_admin($admin_id=''){				
		$this->check_login();
		if(empty($admin_id)) redirect('superadmin/store_admins');

		$this->superadmin_model->delete('users', array('id'=> $admin_id));		
		$this->session->set_flashdata('success_msg',"Store Admin has been deleted successfully.");
		redirect('superadmin/store_admins');
	}

	public function block_store_admins($admin_id, $val){
		$this->check_login(); 	
		if(empty($admin_id) && empty($val)) redirect('superadmin/store_admins');

		$this->superadmin_model->update('users', array('banned'=> $val), array('id' => $admin_id));		
		if($val == 0){
			$this->session->set_flashdata('success_msg', 'Store Admin unblocked successfully.');
		}
		if($val == 1){
			$this->session->set_flashdata('success_msg', 'Store Admin blocked successfully.');
		}
		redirect('superadmin/store_admins');
	}

	public function design_seller_block($admin_id, $val){
		$this->check_login(); 	
		if(empty($admin_id) && empty($val)) redirect('superadmin/store_admins');

		$this->superadmin_model->update('users', array('banned'=> $val), array('id' => $admin_id));		
		if($val == 0){
			$this->session->set_flashdata('success_msg', 'Admin unblocked successfully.');
		}
		if($val == 1){
			$this->session->set_flashdata('success_msg', 'Admin blocked successfully.');
		}
		redirect('superadmin/design_seller');
	}

	public function supports($offset = 0){
		$this->check_login(); 		
		$limit=10;
		$data['supports']=$this->superadmin_model->supports($limit, $offset);
		$config = get_pagination_style();
		$config['base_url'] = base_url().'superadmin/supports/';
		$config['total_rows'] = $this->superadmin_model->supports(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/supports';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function tag_cust_services(){
		$this->check_login();

		if ($this->input->post('add_tag')) {
			// print_r($this->input->post('add_tag'));
			// die();
			$this->form_validation->set_rules('cust_service_id', 'Customer Service', 'required');
			$this->form_validation->set_rules('excerpt', 'Excerpt', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			if ($this->form_validation->run() == TRUE){
				$tagging =	array(
									'cust_service_id'	=>	$this->input->post('cust_service_id'),
									'excerpt'			=>	$this->input->post('excerpt'),
									'description'		=>	$this->input->post('description'),
									'created'			=>	date('Y-m-d')
							);
				
				$support_ids = json_decode($this->input->post('support_ids'));
				foreach ($support_ids as $k => $support_id) {
					$tagging['support_id'] = $support_id;
					$already_tagged = $this->superadmin_model->get_row('support_tags', array('support_id' => $support_id));
					if (!$already_tagged) {	
						$support_info = $this->superadmin_model->get_row('supports', array('id' => $support_id));
						$this->superadmin_model->insert('support_tags',$tagging);
						$this->superadmin_model->update('supports', array('tag_status' => 1, 'cust_service_replied' => $support_info->superadmin_replied), array('id' => $support_id));
					}
				}
				// die();
				/////mail to tagged customer services/////

				$cust_service = $this->superadmin_model->get_row('users', array('id' => $tagging['cust_service_id']));
				$s_subject = 'ShirtScore Tagging Notification';
				$this->load->library('smtp_lib/smtp_email');
				$subject = $s_subject;	// Subject for email
				$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
				$to = array(
					$cust_service->email,
				);
				// $html = "<em>Hello <strong>".$cust_service->firstname." ".$cust_service->lastname." !</strong></em> <br>
				// 		<p>Subject - ".$s_subject."</p>
				// 		<p>Message - You have been tagged for customer queries. Please check the details on your panel at shirtscore.</p>
				// 		Panel Login :".base_url()."customer_service/login
				// 		<br><br> Thank You...";
						// echo $html; die(); 
				$html = $this->template_tag_cust_services($cust_service->firstname,$cust_service->lastname,$s_subject);
				$this->smtp_email->sendEmail($from, $to, $subject, $html);

				/////mail to tagged customer services/////

				$this->session->set_flashdata('success_msg',"Supports tagging has been completed successfully.");
				redirect('superadmin/supports');
			}
			$data['cust_services'] = $this->superadmin_model->get_result('users', array('user_role' => 1));
			$data['queries'] = json_decode($this->input->post('support_ids'));
			$data['template'] = 'superadmin/tag_cust_services';
	        $this->load->view('templates/superadmin_template', $data);
		}else{
			if (!$this->input->post('check')) {
				$this->session->set_flashdata('error_msg', 'No queries selected.');
				redirect('superadmin/supports');
			}
			$data['cust_services'] = $this->superadmin_model->get_result('users', array('user_role' => 1));
			$data['queries'] = $this->input->post('check');
			$data['template'] = 'superadmin/tag_cust_services';
	        $this->load->view('templates/superadmin_template', $data);
		}
		
	}

	public function template_tag_cust_services($firstname,$lastname,$s_subject){
		$data = array(
					'name'=>$firstname." ".$lastname,
					's_subject'=>$s_subject
					);
       $data['template'] = 'email/template_tag_cust_services';
       $message = $this->load->view('templates/email_template',$data,TRUE);
       return $message;
    }

	public function untag_status($support_id='')
	{
		$this->check_login();
		if ($support_id == '')
			redirect('superadmin/supports');

		$resp = $this->superadmin_model->delete('support_tags', array('support_id' => $support_id));

		if ($resp){
			$this->superadmin_model->update('supports', array('tag_status' => 0), array('id' => $support_id));
			$this->session->set_flashdata('success_msg', 'Support Untagged Successfully.');
		}
		else
			$this->session->set_flashdata('error_msg', 'Cannot Untagged.');
		
		redirect('superadmin/supports');


	}
	// public function supports_reply($support_id){
	// 	$data['support'] = $this->superadmin_model->get_row('supports', array('id'=>$support_id));	
	// 	$this->form_validation->set_rules('answer', 'Answer', 'required');
 //        if($this->form_validation->run() === TRUE){
 //        	$update_data = array(
 //        		'answer'     => $this->input->post('answer'),
 //        		'is_answered'=> 1,
 //        		'updated'	 =>date('Y-m-d H:i:s'),
 //        			);
 //        	$name = $data['support']->name;
 //        	$email = $data['support']->email;
 //        	$s_subject = $data['support']->subject;
 //        	$message = $this->input->post('answer');        
 //        	$this->send_support_mail($name, $email,$s_subject,$message);	
 //        	$this->superadmin_model->update('supports', $update_data, array('id' => $support_id));
 //        	$this->session->set_flashdata('success_msg',"Query Successfully Answered.");
	// 		redirect('superadmin/supports');
 //        }
	// 	$data['template'] = 'superadmin/supports_reply';
 //        $this->load->view('templates/superadmin_template', $data);
	// }

	public function supports_reply($support_id=''){
		
		$this->check_login();
		if($support_id=='')
			redirect('superadmin/supports');

		$data['support'] = $this->superadmin_model->get_row('supports', array('id'=>$support_id));	
		$data['info'] = $this->session->userdata('superadmin_info');
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

        	$name = $data['support']->name;
        	$email = $data['support']->email;
        	$s_subject = $data['support']->subject;

        	$message = $this->input->post('reply');
        	$this->send_support_mail($name, $email,$s_subject,$message);
        	$this->superadmin_model->insert('conversation', $update_data);
        	$this->superadmin_model->update('supports', array('superadmin_replied'=>1, 'admin_replied'=>0, 'user_replied'=>0),array('id'=>$support_id));
        	$this->session->set_flashdata('success_msg',"Query answered successfully.");
			redirect(current_url());
        }
        $reply = $this->superadmin_model->get_result('conversation', array('support_id'=>$support_id));	
		$reply2 = $this->superadmin_model->get_result('cs_conversation', array('support_id'=>$support_id));

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
		// $data['reply'] = $reply2;
		if ($data['support']->is_public_support != 0) {
        	$data['support_type'] = 'public';
        }elseif ($data['support']->admin_id != 0) {
        	$data['support_type'] = 'storeadmin';
        }elseif ($data['support']->customer_id != 0) {
        	$data['support_type'] = 'user';
        }
		$data['template'] = 'superadmin/supports_reply';
        $this->load->view('templates/superadmin_template', $data);
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
		$subject = 'Message From Superadmin';	// Subject for email
		$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
		$to = array(
			 $email_to,
		);
		// $html = "<em><strong>Hello ".$name." !</strong></em> <br>
		// 		<p><strong>Subject - ".$s_subject."</strong></p>
		// 		<p><strong>Message - ".$message."</strong></p>";
		$html = $this->template_send_support_email_to($name,$s_subject,$message);
		$this->smtp_email->sendEmail($from, $to, $subject, $html);
	}

	public function template_send_support_email_to($name,$s_subject,$message){
		$data = array(
					'name'=>$name,
					's_subject'=>$s_subject,
					'message'=>$message
					);
		$data['template'] = 'email/template_send_support_email';
		$message = $this->load->view('templates/email_template',$data,TRUE);
		return $message;
	}

	public function delete_support($id){
		$this->check_login();
		$this->superadmin_model->delete('supports',array('id'=>$id));		
		$this->session->set_flashdata('success_msg','query has been deleted successfully.');
		redirect('superadmin/supports');
	}

	// public function orders($offset=0){		
	// 	$this->check_login();
	// 	$search = "";		
	// 	if($_POST){
	// 		if($this->input->post('search') != ""){
	// 			$search = trim($this->input->post('search'));				
	// 		}
	// 	}
	// 	$limit=10;		
	// 	$data['orders']=$this->superadmin_model->orders($limit, $offset, $search);
	// 	$config= get_pagination_style();	
	// 	$config['base_url'] = base_url().'superadmin/orders/';
	// 	$config['total_rows'] = $this->superadmin_model->orders(0, 0,$search);
	// 	$config['per_page'] = $limit;
	// 	$config['num_links'] = 5;		
	// 	$this->pagination->initialize($config); 		
	// 	$data['pagination'] = $this->pagination->create_links();
	// 	$data['template'] = 'superadmin/orders';
 //        $this->load->view('templates/superadmin_template', $data);		
	// }
	public function add_note($order_id='')
	{
		 if (empty($order_id)){
		 	$this->session->set_flashdata('error_msg', 'Order Id not found.');
		 	redirect('superadmin/orders');
		 }

		$this->check_login();

		 $this->form_validation->set_rules('note', 'Note', 'required');
		 $this->form_validation->set_rules('title', 'Title', 'required');

		 if ($this->form_validation->run() == TRUE){

		 	$data=array(
				'user_id'=>superadmin_id(),
				'order_id'=>$order_id,
				'note'=> $this->input->post('note'),
				'title'=> $this->input->post('title'),
				'created'=> date('Y-m-d')
				);
		 	 $status=$this->superadmin_model->insert('order_notes',$data);
		 	 if ($status)
		 	 	$this->session->set_flashdata('success_msg', 'Note added successfully.');
		 	 else
		 	 	$this->session->set_flashdata('error_msg', 'Error in adding note.');

		 	 redirect('superadmin/order_notes/'.$order_id);
		 }

		$data['template'] = 'superadmin/add_note';
        $this->load->view('templates/superadmin_template', $data);
	}

	  public function order_notes($order_id='', $offset=0){
       	$this->check_login();

       	if (empty($order_id)){
		 	$this->session->set_flashdata('error_msg', 'Order Id not found.');
		 	redirect('superadmin/orders');
		}

        $limit=5;
        $data['order_notes']=$this->superadmin_model->order_notes($order_id, $limit,$offset);
        $config = get_pagination_style();
        $config['base_url'] = base_url().'superadmin/order_notes/';
        $config['total_rows'] = $this->superadmin_model->order_notes($order_id, 0,0);
        $config['uri_segment'] = 4;
        $config['per_page'] = $limit;
        $config['num_links'] = 5;       
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        // $order = $this->superadmin_model->get_row('forms', array('id' => $form_id));
        $data['order_id'] = $order_id;
        $offset++;
		$data['offset'] = $offset;
        $data['template'] = 'superadmin/order_notes';
        $this->load->view('templates/superadmin_template', $data);    
    }


    public function edit_note($id, $order_id='')
	{
		 if (empty($order_id) && empty($id)){
		 	$this->session->set_flashdata('error_msg', 'Order Id not found.');
		 	redirect('superadmin/orders');
		 }

		$this->check_login();

		 $this->form_validation->set_rules('title', 'Title', 'required');
		 $this->form_validation->set_rules('note', 'Note', 'required');
		 

		 if ($this->form_validation->run() == TRUE){

		 	$data=array(
				'note'=> $this->input->post('note'),
				'title'=> $this->input->post('title'),
				'updated'=> date('Y-m-d')
				);
		 	 $status=$this->superadmin_model->update('order_notes', $data, array('id' => $id));
		 	 if ($status)
		 	 	$this->session->set_flashdata('success_msg', 'Note Updated successfully.');
		 	 else
		 	 	$this->session->set_flashdata('error_msg', 'Error in updating note.');

		 	 redirect('superadmin/order_notes/'.$order_id);
		 }
		$data['order_note'] = $this->superadmin_model->get_row('order_notes', array('id' => $id));
		$data['template'] = 'superadmin/edit_note';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function view_note($id='')
	{
		$this->check_login();
		if(empty($id)) redirect('superadmin/orders');

		$data['order_note'] = $this->superadmin_model->get_row('order_notes', array('id' => $id));
		
		$data['template'] = 'superadmin/view_note';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function delete_note($id, $order_id){
		$this->check_login();
		if(empty($id) && empty($order_id)) redirect('superadmin/orders');

		$this->superadmin_model->delete('order_notes', array('id'=> $id));		
		$this->session->set_flashdata('success_msg',"Note has been deleted successfully.");
		redirect('superadmin/order_notes/'.$order_id);
	}



	public function orders($offset=0)
	{		
		$this->check_login();
		$search = "";
		$search_email="";
		$search_name="";
		$search_number="";
		$search_order_date="";	
		$status="";
		$set_status=0;
		if($this->uri->segment(4)!='null')
			{
				$set_status=$this->uri->segment(4);
				$status = $this->uri->segment(4);
			}

		if($_POST)
		{
			if($this->input->post('search') != "")
			{
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
			if($this->input->post('status') != ""){
				$status = $this->input->post('status');
				$set_status = $this->input->post('status');
			}
		}
		$data['search'] 			= $this->input->post('search');
		$data['search_email'] 		= $this->input->post('search_email');
		$data['search_name'] 		= $this->input->post('search_name');
		$data['search_number'] 		= $this->input->post('search_number');
		$data['search_order_date'] 	= $this->input->post('search_order_date');
		$data['status'] 	= $this->input->post('status');
		$limit=1000;		
		$data['orders']=$this->superadmin_model->orders($limit,$offset, $search,$search_email,$search_name,$search_number,$search_order_date,$status);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/orders/';
		$config['total_rows'] = $this->superadmin_model->orders(0, 0,$search,$search_email,$search_name,$search_number,$search_order_date,$status);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['set_status']=$set_status;
		$data['template'] = 'superadmin/orders';
        $this->load->view('templates/superadmin_template', $data);

	}

	public function multi_ops()
	{
		//ini_set('memory_limit',"164M");
		$this->check_login();
		// print_r($this->input->post());
		if ($this->input->post('check'))
		{
			if ($this->input->post('changestatus'))
			{
				$check_ids=$this->input->post('check');
				$status=$this->input->post('order_status');


				foreach ($check_ids as $value) {
					$resp=$this->superadmin_model->update("orders", array('order_status' => $status), array('order_id' => $value));
					$this->session->set_flashdata('success_msg','Order status change Sucessfully.');
				}
				redirect('superadmin/orders');
			}

		 if ($this->input->post('order_download'))
		  {
			$check_ids=$this->input->post('check');
			include(APPPATH."libraries/mpdf/mpdf.php");
			foreach ($check_ids as $value) 
			{
				$order = $this->superadmin_model->get_row('orders',array('order_id'=>$value));
				$order_id=$order->id;
			
			$text='';
			$img_front_cus='';
			$img_back_cus='';
			$design_image1='';
			$design_image2='';

			$this->load->library('zip');
			
			$order_pdf=$this->order_pdf_zip($order_id);	
			$data['order_info'] = $this->superadmin_model->order_info($order_id);
			//print_r($data['order_info']);
			foreach($data['order_info'] as $row)
			{    
				$cart_detail = json_decode($row->cart_detail);			
					if(!empty($cart_detail->options->Product_id)) 
						$custom_uplaod_img=get_custom_uplaod_img_from_product($cart_detail->options->Product_id); 

					if(!empty($custom_uplaod_img)){
						$texts=unserialize($custom_uplaod_img->texts);

					if(!empty($texts) && is_array($texts)){
						$text=$this->merge_text($order_id);
						$lp=1;

						foreach ($texts as $row8) {							
						  $img_f='assets/text/'.$value.'_'.$lp.'.png';
						
			 			$this->zip->read_file($img_f);
						 $lp++;}
					}
				}

				if($custom_uplaod_img->is_custom_uploaded){ 

			 		if(!empty($custom_uplaod_img->front_upload_image)){
			 		$img_front_cus='assets/uploads/test/custom_uploads/'.$custom_uplaod_img->front_upload_image;
			 		$this->zip->read_file($img_front_cus);
			 		}
				 
					if(!empty($custom_uplaod_img->back_upload_image)){
				  		$img_back_cus='assets/uploads/test/custom_uploads/'.$custom_uplaod_img->back_upload_image;
				  		$this->zip->read_file($img_back_cus);
				  	}
				}
			 	
			 	 if($get_design_id=get_design_id($row->order_id,$row->product_id))
                  {
                      foreach ($get_design_id as $key ) {
                      	$design = $this->superadmin_model->get_row('design', array('id' => $key->design_id));
						$design_image  = "assets/uploads/designs/".$design->design_image;
						$this->zip->read_file($design_image);
                      }
                  }
				}
				$datas=array(
	        		$value.'.pdf' => $order_pdf,
	        		);
				if(!empty($text)){
					$datas[$value.'Text.pdf'] = $text;
					}
					$this->zip->add_data($datas);
			}
	        	
				$this->zip->download($idd.'ShirtScore.zip');
			
				if ($this->input->post('delete'))
					$this->delete_orders();
				elseif($this->input->post('message')){
						$this->order_messages();
				}
			}
		}
				else{
					   $this->session->set_flashdata('error_msg','Please select any order to perform action.');
						redirect('superadmin/orders');
					}
	}

	public function order_messages()
	{
		$this->check_login();
		if ($this->input->post('send')) {

			$this->form_validation->set_rules('sub', 'Subject', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			if ($this->form_validation->run() == TRUE){
				$buyers_ids = json_decode($this->input->post('buyers_ids'));
				$buyers = $this->superadmin_model->get_buyers_for_msg($buyers_ids);
				if (!$buyers) {
					$this->session->set_flashdata('error_msg', 'No buyers found.');
					redirected('superadmin/order_messages');
				}
				$s_subject = $this->input->post('sub');
				$message = $this->input->post('message');
				// print_r($this->input->post());
				// print_r($buyers);
				// die();
				foreach ($buyers as $buyer) {
					$name = $buyer->recipient_name;
					$this->load->library('smtp_lib/smtp_email');
					$subject = $s_subject;	// Subject for email
					$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form	
					$to = array(
						 $buyer->email,
					);
					$html = "<em>Hello <strong>".$name."</strong></em> <br>
							<p>Info from ShirtScore about Order reference No. - ".$buyer->order_id."</p>
							<p>Subject - ".$s_subject."</p>
							<p>Message - ".$message."</p>";
					$this->smtp_email->sendEmail($from, $to, $subject, $html);
				}
				$this->session->set_flashdata('success_msg',"Email sent successfully.");
				redirect('superadmin/orders');
			}else{
				// print_r(json_decode($this->input->post('buyers_ids')));
				// die();
				$data['buyers_ids'] = json_decode($this->input->post('buyers_ids'));
				$data['template'] = 'superadmin/order_messages';
	    		$this->load->view('templates/superadmin_template', $data);
			}
		}
		else{
			// echo "else"; die();
			$data['buyers_ids'] = $this->input->post('check');
			$data['template'] = 'superadmin/order_messages';
    		$this->load->view('templates/superadmin_template', $data);
		}
	}

	public function delete_orders($order_id="")
	{
		$this->check_login();
		if($order_id !='')
		{
			$this->superadmin_model->delete('orders',array( 'id' => $order_id));
			$this->session->set_flashdata('success_msg','Order delete successfully.');
			redirect('superadmin/orders');
		}

		if($this->input->post('check')!='')
		{
			$data1 = $this->input->post('check');
			$this->superadmin_model->delete_orders($data1);
			$this->session->set_flashdata('success_msg','Orders delete successfully.');
			redirect('superadmin/orders');
		}
		else
		{
			$this->session->set_flashdata('error_msg','Please select the order/orders you want to delete.');
			redirect('superadmin/orders');
			
		}

	}


	public function new_orders($offset=0)
	{	
		$this->check_login();
		$search = "";
		$search_email="";
		$search_name="";
		
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
		
		}

		$limit=10;
		$data['orders']=$this->superadmin_model->new_orders($limit, $offset, $search,$search_email,$search_name);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/new_orders/';
		$config['total_rows'] = $this->superadmin_model->new_orders(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/new_orders';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function old_orders($offset=0)
	{
		$this->check_login();
		$search = "";
		$search_email="";
		$search_name="";

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
		}
		$limit=10;
		$data['orders']=$this->superadmin_model->old_orders($limit, $offset, $search,$search_email,$search_name);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/old_orders/';
		$config['total_rows'] = $this->superadmin_model->old_orders(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/old_orders';

        $this->load->view('templates/superadmin_template', $data);
	}

	public function order_info($order_id=''){		
		$this->check_login();
		if($order_id=='')
		redirect('superadmin/orders');		
		$user_data=$this->superadmin_model->order_user_info($order_id);
		$data['order_user_info']=$user_data;
		$this->form_validation->set_rules('order_status', 'Order Status', 'required');

		if ($this->form_validation->run() == TRUE){
			
			$status = $this->input->post('order_status');
			$resp=$this->superadmin_model->update("orders", array('order_status' => $status), array('id' => $order_id));
			if ($resp){
				$msg = "Status of the order with order id <strong>#".$user_data->order_id."</strong> has been updated to <strong>".fetch_order_status($status)."</strong>";
				$this->load->library('smtp_lib/smtp_email');
				$subject = 'Notification For Change In Order Status';	// Subject for email
				$from = array('no-reply@shirtscore.com' =>'shirtscore.com');	// From email in array form
				$to = array($user_data->email => $user_data->recipient_name);
				// $html = "<em>Hello</em> <br>
	   //              <p>". $user_data->recipient_name."</p>
	   //              <strong>Subject :</strong> ".$subject."<br><br>
	   //              <strong>Message :</strong>".$msg;
				$html = $this->template_order_info_status($user_data->recipient_name,$subject,$msg);
				$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
				if($is_fail){
					$this->session->set_flashdata('error_msg', 'Email notification failed.');
					$this->session->set_flashdata('success_msg', 'Order status updated successfully.');
				}
				else{
					$this->session->set_flashdata('success_msg', 'Order status updated successfully.');
				}
			}
			redirect('superadmin/order_info/'.$order_id);
		}
		$data['order_info'] = $this->superadmin_model->order_info($order_id);
		
		$data['order_id'] = $order_id;

		$data['template'] = 'superadmin/order_info';

        $this->load->view('templates/superadmin_template', $data);		
	}
	
	public function template_order_info_status($receipent_name,$subject,$message){
		$data = array(
					'receipent_name'=>$receipent_name,
					'subject'=>$subject,
					'message'=>$message
					);
		$data['template'] = 'email/template_order_info_status';
		$message = $this->load->view('templates/email_template',$data,TRUE);
		return $message;
	}

	public function products($type="-", $month="-", $year="-",$offset = 0){
		$this->check_login(); 
		$limit=10;

		if($_POST){
			// print_r($_POST);
			// die();
			if($this->input->post('select'))			
				$type = $this->input->post('select');	

			if($type == 'month'){

				if($this->input->post('month'))					
					$month = $this->input->post('month');

				if($this->input->post('year'))
					$year = $this->input->post('year');

			}else{

				if($this->input->post('year'))
					$year = $this->input->post('year');

			}
		}
		$data['products']=$this->superadmin_model->products($limit, $offset, $type, $month, $year);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/products/'.$type.'/'.$month.'/'.$year.'/';
		$config['total_rows'] = $this->superadmin_model->products(0, 0, $type, $month, $year);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['type'] = $type;
		$data['month'] = $month;
		$data['year'] = $year;
		$data['template'] = 'superadmin/products';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function print_area($product_id=''){
		$this->check_login(); 
		
		$data['product'] = $this->superadmin_model->get_row('products',array('id'=>$product_id));

		if (!$data['product']) {
			$this->session->set_flashdata('error_msg', 'Product Not found.');
			redirect('superadmin/products');
		}
		$this->form_validation->set_rules('f_width', 'Width', 'callback_check_print_area');
		$this->form_validation->set_rules('b_width', 'Width', 'callback_check_print_area');
		 
		if ($this->form_validation->run() == TRUE){
	  		list($width, $height, $type, $attr) = getimagesize(base_url().'assets/uploads/products/'.$data['product']->main_image); 
	  		list($width1, $height1, $type1, $attr1) = getimagesize(base_url().'assets/uploads/products/'.$data['product']->back_image); 
            $canvas_width=695; //575
            $canvas_height=570;
            $f_w_ofst=($canvas_width-$width)/2;
            $f_h_ofst=($canvas_height-$height)/2; 
            $b_w_ofst=($canvas_width-$width1)/2;
            $b_h_ofst=($canvas_height-$height1)/2;
            // print_r(json_decode($data['product']->restricted_para));
            // print_r($_POST);
            // die();
            $f_left = ($this->input->post('f_left') + $f_w_ofst);
            $f_top = ($this->input->post('f_top') + $f_h_ofst);
            $b_left = ($this->input->post('b_left') + $b_w_ofst);
            $b_top = ($this->input->post('b_top') + $b_h_ofst);
			$update_data['restricted_para'] = json_encode(array(
											'f_width' 	=> $this->input->post('f_width'),
											'f_height' 	=> $this->input->post('f_height'),
											'f_left' 	=> $f_left,
											'f_top' 	=> $f_top,
											'b_width' 	=> $this->input->post('b_width'),
											'b_height' 	=> $this->input->post('b_height'),
											'b_left' 	=> $b_left,
											'b_top' 	=> $b_top,
										));
			$this->superadmin_model->update("products", $update_data, array('id' => $product_id));
			$this->session->set_flashdata('success_msg', 'Print area updated successfully.');
			redirect('superadmin/products');
		}
		$data['template'] = 'superadmin/print_area';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function colors($product_id){		
		$this->check_login(); 
		if(empty($product_id)) redirect('superadmin/products');

		$data['product_id'] = $product_id;		
		$data['color']=$this->superadmin_model->colors($product_id);
		$data['template'] = 'superadmin/colors';
		$this->load->view('templates/superadmin_template', $data);		
	}

	public function check_front_img($a, $called){
		if ($called == 'edit') {
			if (!($this->input->post('front1') == ''))
	        	return TRUE;
		}

       if ($_FILES['front']['tmp_name'] == '') {
           $this->form_validation->set_message('check_front_img', 'Front image required.');
            return FALSE;
       }
       else
       		return TRUE;
    }



	public function check_left_img($a, $called){

		if ($called == 'edit') {
			if (!($this->input->post('left1') == ''))
	        	return TRUE;
		}

       if ($_FILES['left']['tmp_name'] == '') {
           $this->form_validation->set_message('check_left_img', 'Left image required.');
            return FALSE;
       }
       else
       		return TRUE;
    }

	public function check_back_img($a, $called){

		if ($called == 'edit') {
			if (!($this->input->post('back1') == ''))
	        	return TRUE;
		}

	   if ($_FILES['back']['tmp_name'] == '') {
	       $this->form_validation->set_message('check_back_img', 'Back image required.');
	        return FALSE;
	   }
	   else
	   		return TRUE;
	}

	public function check_right_img($a, $called){

		if ($called == 'edit') {
			if (!($this->input->post('right1') == ''))
	        	return TRUE;
		}

       if ($_FILES['right']['tmp_name'] == '') {
           $this->form_validation->set_message('check_right_img', 'Right image required.');
            return FALSE;
       }
       else
       		return TRUE;
    }

    public function color_img_upload($name='')
    {
        $config['upload_path'] = './assets/uploads/color_img/';
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
    }

	public function add_color($product_id){
		$this->check_login();
		if(empty($product_id)) redirect('superadmin/products');

 		$this->form_validation->set_rules('color', 'color', 'required');
 		$this->form_validation->set_rules('color_name', 'color name', 'required');
		$this->form_validation->set_rules('front', 'color', 'callback_check_front_img['."add".']');
		// $this->form_validation->set_rules('left', 'color', 'callback_check_left_img['."add".']');
		$this->form_validation->set_rules('back', 'color', 'callback_check_back_img['."add".']');
		// $this->form_validation->set_rules('right', 'color', 'callback_check_right_img['."add".']');
		if ($this->form_validation->run() == TRUE){
			$img = array();

			$data=array(
				'color_code'=>$this->input->post('color'),
				'product_id'=> $product_id,
				'color_name'=>$this->input->post('color_name'),
				'created'=> date('Y-m-d')
				);

			$this->load->library('image_lib');

			if($_FILES['front']['name']!=''){
				$data['main_image'] = $this->color_img_upload('front');
				$this->create_color_thumb($data['main_image'], $product_id);
			}

			if($_FILES['back']['name']!=''){
				$data['back_image'] = $this->color_img_upload('back');
				$this->create_color_thumb($data['back_image'], $product_id);
			}

			$this->superadmin_model->insert('product_colors', $data);						

			$this->session->set_flashdata('success_msg',"Color added successfully.");
			redirect('superadmin/colors/'.$product_id);
		}
		$data['template'] = 'superadmin/add_colors';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function edit_color($product_id='',$color_id=''){

		$this->check_login();

		if(empty($product_id) && empty($color_id))  redirect('superadmin/products');

		$data['colors'] = $this->superadmin_model->get_row('product_colors',array('id' => $color_id));

		$this->form_validation->set_rules('color', 'color', 'required');
		if ($this->form_validation->run() == TRUE){

			$colors=array(
				'color_code'=>$this->input->post('color'),	
				'color_name'=>$this->input->post('color_name'),							
				);

			$this->load->library('image_lib');
			if ($_FILES['front']['name'] != ''){

				if(!empty($data['colors']->main_image)){
					$cpath ='assets/uploads/color_img/';
					$cthumb_path ='assets/uploads/color_img/thumbnail/';
					@unlink($cpath.$data['colors']->main_image);
					@unlink($cthumb_path.$data['colors']->main_image);
				}

				$colors['main_image'] = $this->color_img_upload('front');
				$this->create_color_thumb($colors['main_image'], $product_id);
			}
			if ($_FILES['back']['name'] != ''){

				if(!empty($data['colors']->back_image)){
					$cpath ='assets/uploads/color_img/';
					$cthumb_path ='assets/uploads/color_img/thumbnail/';
					@unlink($cpath.$data['colors']->back_image);
					@unlink($cthumb_path.$data['colors']->back_image);
				}

				$colors['back_image'] = $this->color_img_upload('back');
				$this->create_color_thumb($colors['back_image'], $product_id);
			}
			
			$this->superadmin_model->update('product_colors',$colors,array('id'=>$color_id));

			$this->session->set_flashdata('success_msg',"Color updated successfully.");
			redirect('superadmin/colors/'.$product_id);
		}

		
		$data['template'] = 'superadmin/edit_colors';
        $this->load->view('templates/superadmin_template', $data);	        
	}

	public function create_color_thumb($file, $product_id=""){
		$path='./assets/uploads/color_img';	
		 if (!is_writable($path.'/')) {
            if (!chmod($path.'/', 0777)) {
            	 $this->session->set_flashdata('error_msg', "Cannot change the mode of file ($0777).");
				 redirect('superadmin/colors/'.$product_id);
            }
        }

		// create file rezize
		$config2['image_library'] = 'gd2';
		$config2['source_image'] = $path.'/'.$file;
		$config2['new_image'] = $path.'/thumbnail/'.$file;		
		$config2['quality'] = '100%';
		$config2['maintain_ratio'] = TRUE;
		$config2['width'] = 300;
		$config2['height']	= 250 ;
		$this->image_lib->initialize($config2);

		if ( ! $this->image_lib->resize()){
			$this->session->set_flashdata('error_msg', $this->image_lib->display_errors());
			redirect('superadmin/colors/'.$product_id);
		}

		$this->image_lib->clear();

        $config1['image_library'] = 'gd2';
		$config1['source_image']	= $path.'/'.$file;
		$config1['new_image']	= $path.'/'.$file;			
		$config1['quality'] = '100%';
		$config1['maintain_ratio'] = TRUE;
		$config1['width'] = 450;
		$config1['height']	= 650;

		$this->image_lib->initialize($config1);		
		if ( ! $this->image_lib->resize()){
			$this->session->set_flashdata('error_msg', $this->image_lib->display_errors());
			redirect('superadmin/colors/'.$product_id);
		}

		$this->image_lib->clear();
	}

	public function delete_colors($product_id,$color_id){
		
		$this->check_login();

		if(empty($product_id) && empty($color_id))  redirect('superadmin/products');

		$col = $this->superadmin_model->get_row('product_colors',array('product_id' => $product_id,'id' => $color_id));

		if (!$col){
			$this->session->set_flashdata('error_msg', 'Color not found.');
			redirect('superadmin/colors');
		}


		$resp1 = $this->superadmin_model->delete('product_colors',array('id'=>$col->id));

		if ($resp1) {

			$cpath ='assets/uploads/color_img/';

			$cthumb_path ='assets/uploads/color_img/thumbnail/';
			
			if(!empty($col->main_image)){
				@unlink($cpath.$col->main_image);
				@unlink($cthumb_path.$col->main_image);
			}

			if(!empty($col->back_image)){
				@unlink($cpath.$col->back_image);
				@unlink($cthumb_path.$col->back_image);
			}
		}

		$this->session->set_flashdata('success_msg',"color has been deleted successfully.");
		redirect('superadmin/colors/'.$product_id);
	}

	public function delete_image_test($file){		
		$path='./assets/uploads/products/';
		$path1='./assets/uploads/color_img/';
		if(!empty($file)){
			@unlink($path.$file);
			@unlink($path.'thumbnail/'.$file);			
			@unlink($path1.'/'.$file);			
		}
	}

	// public function edit_color($product_id,$color_id=''){
	// 	$this->check_login(); 				
	// 	$this->form_validation->set_rules('color', 'color', 'required');				
	// 	if ($this->form_validation->run() == TRUE){		
	// 		// print_r($_POST); die();	

	// 		$colors=array(
	// 			'color_code'=>$this->input->post('color'),								
	// 			);

	// 		$this->superadmin_model->update('product_colors',$colors,array('id'=>$color_id));

	// 			for ($j=0; $j < count($_POST['images']) ; $j++){			
	// 		    $images['image_name'] = $_POST['images'][$j];			  			   		
	// 			if(!empty($product_id)){
	// 				$images['product_id']=$product_id;
	// 				$images['color_id'] = $color_id;
	// 				$this->superadmin_model->insert('product_images',$images);
	// 			}				
	// 		}							
	// 		$this->session->set_flashdata('success_msg',"Successfully Updated.");
	// 		redirect('superadmin/colors/'.$product_id);
	// 	}
	// 	$data['colors'] = $this->superadmin_model->color_n_images($color_id);
	// 	// print_r($data['colors']);
	// 	$data['template'] = 'superadmin/edit_colors';
 //        $this->load->view('templates/superadmin_template', $data);	        
	// }
	// public function product_info($product_id){
	// 	$this->check_login();
	// 	$data['product'] = $this->superadmin_model->get_product($product_id);
	// 	// print_r($data['product']); die();
	// 	$data['color'] = $this->superadmin_model->get_colors($product_id);
	// 	$data['parameters'] = $this->superadmin_model->get_result('product_parameters', array('product_id' => $product_id));
	// 	// print_r($data);
	// 	$data['template'] = 'superadmin/product_info';
 //        $this->load->view('templates/superadmin_template', $data);		
	// }

	public function product_info($product_id=''){
		$this->check_login();
		if($product_id=='')
			redirect('superadmin/products');
		$col_arr = array();
		$col_img = array();
		$data['product'] = $this->superadmin_model->get_product($product_id);
		if (!empty($data['product']->category))
			$data['categories'] = $this->superadmin_model->get_products_categories(unserialize($data['product']->category));
		else
			$data['categories']='';
		$data['color'] = $this->superadmin_model->get_result('product_colors', array('product_id' => $product_id));
		// print_r(unserialize($data['product']->category));
		// print_r($data['categories']);
		// die();
		$data['template'] = 'superadmin/product_info';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function product_status($product_id, $val){
		$this->superadmin_model->update('products', array('product_status' => $val), array('id' => $product_id));
		if($val == 1)
			$this->session->set_flashdata('success_msg', 'Product published successfully.');
		else
			$this->session->set_flashdata('success_msg', 'product Unpublished successfully.');
		redirect('superadmin/products');
					
	}

	/*form*/

	public function check_fields($fields){
		$this->check_login();	
		if ($fields[0] == ''){
			$this->form_validation->set_message('check_fields', 'Form fields required.');
			return FALSE;
		}else{
			return TRUE;
		}
	}


	public function form_add_new(){
		$this->check_login();

		$this->form_validation->set_rules('form_name', 'Form Name', 'required');
		$this->form_validation->set_rules('form_action', 'Form Action', 'required');		
		$this->form_validation->set_rules('fields', 'Form Fields', 'callback_check_fields');		
		$fields = array();
		if ($this->form_validation->run() == TRUE){
			$field = $this->input->post('fields');
			$required = $this->input->post('required');
			if (!empty($field))	{
				foreach ($field as $key => $name){
					$fields[$field[$key]] = (isset($required[$key])) ?  $required[$key]: 0 ;
				}
			}
			

			$fields = serialize($fields);
			$form_name = $this->input->post('form_name');
			$form_action = $this->input->post('form_action');
			$content = $this->input->post('form_content');
			
			$form_id = $this->superadmin_model->insert('forms', array('form_name' => $form_name,'form_action' => $form_action,'form_content' => $content, 'fields' => $fields,'created' => date('Y-m-d'), 'updated' => date('Y-m-d')));

			if ($form_id){
				foreach ($field as $ids){
					$this->superadmin_model->update('form_fields', array('form_id' => $form_id,'status' => 1), array('id' => $ids));
				}
				$this->session->set_flashdata('success_msg','Form Added Successfully.');
			}else
				$this->session->set_flashdata('error_msg','Form cannot be Added.');

			redirect('superadmin/forms');			
		}

		$data['fields'] =  $this->superadmin_model->get_result('form_fields', array('form_id' => 0,'status' => 0));
		$data['template'] = 'superadmin/form_add_new';
        $this->load->view('templates/superadmin_template', $data);	
	}




	public function form_edit($form_id=''){
		$this->check_login();
		if(empty($form_id)) redirect('superadmin/forms');

		$data['form_id'] =$form_id;	

		$this->form_validation->set_rules('form_name', 'Form Name', 'required');
		$this->form_validation->set_rules('form_action', 'Form Action', 'required');
		$this->form_validation->set_rules('fields', 'Form Fields', 'callback_check_fields');		
		$fields = array();
		if ($this->form_validation->run() == TRUE){			
			$this->superadmin_model->update('form_fields', array('form_id' => 0,'status' => 0), array('form_id' => $form_id));
			$field = $this->input->post('fields');
			$required = $this->input->post('required');
			if (!empty($field)){
				foreach ($field as $key => $name){
					$fields[$field[$key]] = (isset($required[$key])) ?  $required[$key]: 0 ;
				}
			}
		
			$fields = serialize($fields);
			$form_name = $this->input->post('form_name');
			$form_action = $this->input->post('form_action');			
			$content = $this->input->post('form_content');
			$id = $this->superadmin_model->update('forms', array('form_name' => $form_name,'form_action' => $form_action,'form_content' => $content, 'fields' => $fields, 'updated' => date('Y-m-d')), array('id' => $form_id));

			if ($id){

				foreach ($field as $ids){
					$this->superadmin_model->update('form_fields', array('form_id' => $form_id,'status' => 1), array('id' => $ids));
				}
				$this->session->set_flashdata('success_msg','Form Added Successfully.');
			}else
				$this->session->set_flashdata('error_msg','Form cannot be Added.');

			redirect('superadmin/forms');
			
		}

		$data['forms'] = $this->superadmin_model->get_row('forms', array('id' => $form_id));		
		$data['fields'] =  $this->superadmin_model->get_result('form_fields',array('form_id' => $form_id),array('status' => 0));
		$data['template'] = 'superadmin/form_edit';
        $this->load->view('templates/superadmin_template', $data);	
	}

	public function form_delete($fid=""){
		$this->check_login();
		if(empty($fid)) redirect('superadmin/forms');
		$this->superadmin_model->update('form_fields', array('form_id' => 0,'status' => 0), array('form_id' => $fid));
		$resp = $this->superadmin_model->delete('forms', array('id' => $fid));
		if ($resp)
			$this->session->set_flashdata('success_msg','Form deleted Successfully.');
		else 
			$this->session->set_flashdata('error_msg','Form cannot be deleted.');

		redirect('superadmin/forms');
	}

	public function forms($offset=0){
		$this->check_login();

		$limit=10;
		$data['forms']=$this->superadmin_model->forms($limit,$offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/forms/';
		$config['total_rows'] = $this->superadmin_model->forms(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['template'] = 'superadmin/forms';

        $this->load->view('templates/superadmin_template', $data);			
	}

	public function check_options($f_type, $option){
		$this->check_login();	

		$field_type = $f_type;

		if (!empty($field_type)){
			if ($field_type == 5){
				if($option != ''){
					return TRUE;
				}else{
					$this->form_validation->set_message('check_options', 'Please Enter Options for select box.');
					return FALSE;
				}
				
			}else{
				return TRUE;
			}
		}else{
			$this->form_validation->set_message('check_options', 'Please select field type.');
			return FALSE;
		}
	}

	public function form_field_add_new(){
		$this->check_login();	

		$this->form_validation->set_rules('field_name', 'Field Name', 'required');
		$optn = $this->input->post('option');
		$this->form_validation->set_rules('field_type', 'Field Type', 'callback_check_options['.$optn.']');
		
		$attributes = array();
		if ($this->form_validation->run() == TRUE){
			$attr_name = $this->input->post('attr_name');
			$attr_value = $this->input->post('attr_value');
			if (!empty($attr_name) && !empty($attr_value)){
				foreach ($attr_name as $key => $name){
					$attributes[$attr_name[$key]] = $attr_value[$key];
				}
			}
			
			$attributes = serialize($attributes);
			$option="";
			$f_name = $this->input->post('field_name');
			$f_type = $this->input->post('field_type');			
			if ($f_type == 5){
				$option=$this->input->post('option');			
			}

			if ($f_type == 9){
				$option = array(
								'type' => 'text',
								'class' => 'pick-a-color'
							   );
				$option = serialize($option);
			}

			if ($f_type == 10){
				$option = array(
								'type' => 'text',
								'class' => 'pick-date'
							   );
				$option = serialize($option);
			}

			$id = $this->superadmin_model->insert('form_fields', array('field_name' => $f_name,'field_type' => $f_type, 'extras' => $option, 'attr' => $attributes,'created' => date('Y-m-d'), 'updated' => date('Y-m-d')));

			if ($id)
				$this->session->set_flashdata('success_msg','Field Added Successfully.');
			else
				$this->session->set_flashdata('error_msg','Field cannot be added.');

			redirect('superadmin/form_fields');			
		}

		$data['template'] = 'superadmin/form_field_add_new';
        $this->load->view('templates/superadmin_template', $data);	
	}

	public function form_fields($offset=0){
		$this->check_login();		
		$limit=10;
		$data['fields']=$this->superadmin_model->form_fields($limit,$offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/form_fields/';
		$config['total_rows'] = $this->superadmin_model->form_fields(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();	
		$data['template'] = 'superadmin/form_fields';
        $this->load->view('templates/superadmin_template', $data);			
	}



	public function form_field_edit($fid=''){
		$this->check_login();
		if(empty($fid)) redirect('superadmin/form_fields');	

		$this->form_validation->set_rules('field_name', 'Field Name', 'required');
		$optn = $this->input->post('option');
		$this->form_validation->set_rules('field_type', 'Field Type', 'callback_check_options['.$optn.']');
		$attributes = array();
		if ($this->form_validation->run() == TRUE){
			$attr_name = $this->input->post('attr_name');
			$attr_value = $this->input->post('attr_value');
			if (!empty($attr_name) && !empty($attr_value)){
				foreach ($attr_name as $key => $name){
					$attributes[$attr_name[$key]] = $attr_value[$key];
				}
			}

			$attributes = serialize($attributes);
			$option = "";
			$f_name = $this->input->post('field_name');
			$f_type = $this->input->post('field_type');			
			if ($f_type == 5){
				$option=$this->input->post('option');			
			}

			if ($f_type == 9){
				$option = array(
								'type' => 'text',
								'class' => 'pick-a-color'
							   );
				$option = serialize($option);
			}

			if ($f_type == 10){
				$option = array(
								'type' => 'text',
								'class' => 'pick-date'
							   );
				$option = serialize($option);
			}

			$id = $this->superadmin_model->update('form_fields', array('field_name' => $f_name,'field_type' => $f_type, 'extras' => $option, 'attr' => $attributes, 'updated' => date('Y-m-d')), array('id' => $fid));

			if ($id)
				$this->session->set_flashdata('success_msg','Field Updated Successfully.');
			else
				$this->session->set_flashdata('error_msg','Field cannot be Updated.');

			redirect('superadmin/form_fields');			
		}

		$data['field'] = $this->superadmin_model->get_row('form_fields', array('id' => $fid));

		$data['template'] = 'superadmin/form_field_edit';
        $this->load->view('templates/superadmin_template', $data);	
	}

	
	public function form_field_delete($fid=""){
		$this->check_login();
		if(empty($fid)) redirect('superadmin/form_fields');		

		$check = $this->superadmin_model->get_row('form_fields', array('id' => $fid, 'status' => 1));
		if ($check){
			$this->session->set_flashdata('error_msg','Cannot delete this field, Field is using within any form.');
		}else{
			$resp = $this->superadmin_model->delete('form_fields', array('id' => $fid));

			if ($resp)
				$this->session->set_flashdata('success_msg','Field deleted successfully.');
			else 
				$this->session->set_flashdata('error_msg','Field cannot be deleted.');
		}

		redirect('superadmin/form_fields');
	}

	public function active_form($fid=''){
		$this->check_login();	
		
		create_form_template($fid);
	}



	public function build_form($form_id=''){
		$html='';
		if(empty($form_id)){
			
			if(!empty($_POST['form_action']))
				$form_url=base_url($_POST['form_action']);
			else
				$form_url=base_url();

			$html.= form_open($form_url);
			$html.=	$this->call_fields();
			$html.= form_close();

			//echo "INVLID From ID.";

		}else{
			$form = $this->superadmin_model->get_row('forms', array('id' => $form_id));
			if($form){
				$html.= form_open(base_url($form->form_action));
					
				$html.=	$this->call_fields();
				$html.="\n";
				$html.= form_close();

			}			

		}
		
		$html = htmlentities($html);
		echo $html;	
	}
 
	public function call_fields(){		
		$html2='';
		$html2.="\n";
		
		if(!empty($_POST['fields'])){

			$fields =  $this->superadmin_model->get_fields($_POST['fields']);
			
			if($fields){
				foreach ($fields as $field) {
					if(!empty($field->field_name))
					$html2.= ' <label> '.$field->field_name.' </label> ';

					if(!empty($field->attr)){
						$attributes=unserialize($field->attr);
						$extras=unserialize($field->extras);
						
						switch($field->field_type){
							case '1':
								$html2.="\n";	
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
								
								$html2.= ' <input type="text" '.$attrib.'> ';
								break;

							case '2':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'"';
								
								$html2.= "<textarea ".$attrib."></textarea>";
							
								break;
								
							case '3':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
								
								$html2.= ' <input type="radio" '.$attrib.'> ';
								break;
								
							case '4':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
								
								$html2.= ' <input type="checkbox" '.$attrib.'> ';
								break;	

							case '5':
								$html2.="\n";										
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
								
								$html2.= ' <select '.$attrib.'> ';
								$html2.="\n";
								if(!empty($field->extras)){
									foreach(explode(',', $field->extras) as $val){
										$html2.= ' <option value="'.$val.'">'.$val.'</option> ';
										$html2.="\n";
									}
								}
								$html2.= ' </select> ';
								break;
							case '6':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
									
								$html2.= ' <input type="file" '.$attrib.'> ';
								break;

							case '7':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
								
								$html2.= ' <input type="password" '.$attrib.'> ';
								break;
								
							case '8':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
								
								$html2.= ' <input type="hidden" '.$attrib.'> ';
								break;
								
							case '9':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
								{
									if (strtolower($key) == "type") {
										$val = $extras['type'];
										continue;
									}
									if (strtolower($key) == "class") {
										$val = $extras['class'];
										continue;
									}
									
									$attrib.= ' '.$key.'="'.$val.'" ';
								}
								
								$html2.= ' <input type="text" '.$attrib.'> ';
								break;
								
							case '10':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
								{
									if (strtolower($key) == "type") {
										$val = $extras['type'];
										continue;
									}
									if (strtolower($key) == "class") {
										$val = $extras['class'];
										continue;
									}
									
									$attrib.= ' '.$key.'="'.$val.'" ';
								}
								
								$html2.= ' <input type="text" '.$attrib.'> ';
								break;	

							case '11':
								$html2.="\n";
								$attrib='';
								foreach($attributes as $key=>$val)
									$attrib.= ' '.$key.'="'.$val.'" ';
								
								$html2.= ' <input type="submit" '.$attrib.'> ';					
								
							default:
								
								$html2.= '  ';	
								break;
						}
						$html2.="\n";
					}	
				   
				}
			        
			}
		}	
		return $html2;
	}

	/*form*/

	public function faqs($offset=0){
		$this->check_login(); 
		$info = $this->session->userdata('superadmin_info');
		$limit=10;
		$data['faqs']=$this->superadmin_model->faqs($limit, $offset, $info['id']);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/faqs/';
		$config['total_rows'] = $this->superadmin_model->faqs(0, 0, $info['id']);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/faqs';
        $this->load->view('templates/superadmin_template', $data);		
	}


	public function add_faq(){
		$this->check_login(); 
		$info = $this->session->userdata('superadmin_info');
		$this->form_validation->set_rules('question', 'question', 'required');			
		$this->form_validation->set_rules('answer', 'answer', 'required');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'question'=>$this->input->post('question'),				
				'answer'=>$this->input->post('answer'),				
				'user_id'=> $info['id'],
				'created' => date('Y-m-d H:i:s')		
				);	
			$this->superadmin_model->insert('faq',$data);		
			$this->session->set_flashdata('success_msg',"FAQ added successfully.");
			redirect('superadmin/faqs');
		}
		$data['template'] = 'superadmin/add_faq';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function edit_faq($id=''){
		$this->check_login();
		if($id=='')
		redirect('superadmin/faqs');

		$this->form_validation->set_rules('question', 'question', 'required');			
		$this->form_validation->set_rules('answer', 'answer', 'required');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'question'=>$this->input->post('question'),				
				'answer'=>$this->input->post('answer'),				
				'created' => date('Y-m-d H:i:s')		
				);	
			$this->superadmin_model->update('faq',$data, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"FAQ updated successfully.");
			redirect('superadmin/faqs');
		}
		$data['faq'] = $this->superadmin_model->get_row('faq', array('id'=>$id));
		$data['template'] = 'superadmin/edit_faq';
        $this->load->view('templates/superadmin_template', $data);
        
	}

	public function delete_faq($faq_id){
		$this->superadmin_model->delete('faq',array('id'=>$faq_id));
		$this->session->set_flashdata('success_msg',"FAQ deleted successfully.");
			redirect('superadmin/faqs');
	}

	public function check_size(){
		// print_r($this->input->post('size_id'));
		// die();
		$fields = $this->input->post('size_id');
		if (empty($fields) && $fields[0] == ''){
			$this->form_validation->set_message('check_size', 'Please select size .');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function check_prod_slug($slug, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_slug = $param[1];
		if ($called === 'add'){
			$resp = $this->superadmin_model->get_row('products', array('slug' => $slug));
			if ($resp){
				$this->form_validation->set_message('check_prod_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif ($old_slug === $slug) {
				return TRUE;
			}else{
				$resp = $this->superadmin_model->get_row('products', array('slug' => $slug));
				if ($resp) {
					$this->form_validation->set_message('check_prod_slug', 'Slug you are choosing already exist.');
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}

	public function check_size_chart($fields){
		if (isset($_POST['addsizechart'])){

			if ($this->input->post('sizechart') == '') {
				$this->session->set_userdata('sizechart', '');
				$this->session->unset_userdata('sizechart');
				$this->form_validation->set_message('check_size_chart', 'Size Chart is required.');
				return FALSE;
			} else {
				$this->session->set_userdata('sizechart', $this->input->post('sizechart'));
				return TRUE;
			}
			
		}else{
			return TRUE;
		}
	}

	public function check_prod_img($a, $called){
		if ($called == 'edit') {
			if (!($this->input->post('userfile') == ''))
	        	return TRUE;
		}

       if ($_FILES['userfile']['name'] == '') {
           $this->form_validation->set_message('check_prod_img', 'Product main image is required.');
            return FALSE;
       }
       else
       		return TRUE;
    }

    public function check_cback_img($a, $called){
		if ($called == 'edit') {
			if (!($this->input->post('back') == ''))
	        	return TRUE;
		}

       if ($_FILES['back']['name'] == '') {
           $this->form_validation->set_message('check_cback_img', 'Product back image is required.');
            return FALSE;
       }
       else
       		return TRUE;
    }

	public function add_product(){
		$this->check_login(); 		
		$this->form_validation->set_rules('group_id', 'group_id', 'required');		
		$this->form_validation->set_rules('regular_name', 'regular name', 'required');
 		$this->form_validation->set_rules('color_name', 'color name', 'required');
		
		$this->form_validation->set_rules('color', 'Product Color', 'required');
		$this->form_validation->set_rules('size_id', 'size_id', 'callback_check_size');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('desc', 'desc', 'required');
		$this->form_validation->set_rules('addsizechart', 'Size Chart', 'callback_check_size_chart');
		// $this->form_validation->set_rules('sizechart', 'Size Chart', 'callback_check_size_chart');
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_prod_slug['."add,slug".']');
		$this->form_validation->set_rules('userfile', 'Product Image', 'callback_check_prod_img['."add".']');
		$this->form_validation->set_rules('back', 'Product Back Image', 'callback_check_cback_img['."add".']');
		$this->form_validation->set_rules('category', 'Category', 'callback_check_design_categories');
		// if ($_POST){

		if ($this->form_validation->run() == TRUE){
		
			$data=array(
				'size_id'=>serialize($this->input->post('size_id')),
				
				'category'=>serialize($this->input->post('category')),
				'group_id'=>$this->input->post('group_id'),	
				'prefix'=>$this->input->post('prefix'),
				'regular_name'=>$this->input->post('regular_name'),
				'short_name'=>$this->input->post('short_name'),
				'singular'=>$this->input->post('singular'),
				'uri'=>$this->input->post('uri'),
				'price'=>$this->input->post('price'),
				'desc'=>$this->input->post('desc'),
				'slug'=>$this->input->post('slug'),
				'created' => date('Y-m-d H:i:s'),
				'color_name'=>$this->input->post('color_name')
			);
			// echo $this->input->post('color');
			// print_r($this->input->post('category'));

			if (isset($_POST['addsizechart'])){
				$this->session->set_userdata('sizechart', '');
				$this->session->unset_userdata('sizechart');
				$data['sizechart'] = $this->input->post('sizechart');
				$data['is_sizechart'] = 1;
			}

			$this->load->library('image_lib');
			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/products';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '50000';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload()){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('superadmin/add_product/');
				}else{
				   $upload_data = $this->upload->data();			
				   $data['main_image']=$upload_data['file_name'];
				   // $copy_scr = './assets/uploads/products/'.$data['main_image'];
				   // $dest_thum = './assets/uploads/color_img/'.$data['main_image'];
				   // copy($copy_scr, $dest_thum);
				   $this->create_thumb_file($data['main_image']);
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload.');
				redirect(current_url());
			}

			if($_FILES['back']['name']!=''){
				$config['upload_path'] = './assets/uploads/products';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '50000';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('back')){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('superadmin/add_product/');
				}else{
				   $upload_data = $this->upload->data();			
			       $data['back_image']=$upload_data['file_name'];
			    //    $copy_scr = './assets/uploads/products/'.$data['back_image'];
				   // $dest_thum = './assets/uploads/color_img/'.$data['back_image'];
				   // copy($copy_scr, $dest_thum);
				   $this->create_thumb_file($data['back_image']);
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload.');
				redirect(current_url());
			}
			$product_id = $this->superadmin_model->insert('products',$data);

			$price_size=$this->input->post('price_size');
			$size_id=$this->input->post('size_id');
			$i=0;
			foreach ($size_id as $value) {
				if(!empty($price_size[$i])){
				$data2=array(
					'size_id'=>$value,
					'price'=>$price_size[$i],
					'product_id'=>$product_id
					);
				$this->superadmin_model->insert('product_size_price',$data2);
				}$i++;
			}

			$data1=array(
						'color_code'	=> $this->input->post('color'),
						'product_id'	=> $product_id,
						'main_image'	=> $data['main_image'],
						'back_image'	=> $data['back_image'],
						'is_default'	=> 1,
						'created'		=> date('Y-m-d'),
						'color_name'=>$this->input->post('color_name')
				  );

			$color_id = $this->superadmin_model->insert('product_colors', $data1);

			$this->superadmin_model->update('products', array('default_color' => $color_id), array('id'=>$product_id));

			$this->session->set_flashdata('success_msg',"Product has been added successfully.");
			redirect('superadmin/products');
		}

		if ($this->input->post('size_id'))
			$data['size_arr'] = $this->input->post('size_id');
		else
			$data['size_arr'] = array();

		if ($this->input->post('category'))
			$data['category_arr'] = $this->input->post('category');
		else
			$data['category_arr'] = array();

		if ($this->input->post('group_id'))
			$data['group'] = $this->input->post('group_id');
		else
			$data['group'] = '';

		$data['sizes'] = $this->superadmin_model->get_result('product_sizes');
		$data['group'] = $this->superadmin_model->get_result('product_group');
		$data['product_categories'] = $this->superadmin_model->get_result('design_category');
		$data['template'] = 'superadmin/add_product';
        $this->load->view('templates/superadmin_template', $data);		
	}


	public function test_thumb_file($file){
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
		$config1['create_thumb'] = TRUE;
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
        $config1['width'] = 190;
        $config1['height']  = 190 ;

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
		$config1['quality'] = '100%';
		$config1['maintain_ratio'] = TRUE;
		$config1['width'] = 300;
		$config1['height']	= 250 ;

		$this->image_lib->initialize($config1);		
		if ( ! $this->image_lib->resize()){
			 echo $this->image_lib->display_errors(); 
			 exit;
		}

		$this->image_lib->clear();	

		$copy_scr1 = $path.'/thumbnail/'.$file;
		$dest_thum1 = './assets/uploads/color_img/thumbnail/'.$file;
		copy($copy_scr1, $dest_thum1);

        $config1['image_library'] = 'gd2';
		$config1['source_image']	= $path.'/'.$file;
		$config1['new_image']	= $path.'/'.$file;			
		$config1['quality'] = '100%';
		$config1['maintain_ratio'] = TRUE;
		$config1['width'] = 450;
		$config1['height']	= 650;

		$this->image_lib->initialize($config1);		
		if ( ! $this->image_lib->resize()){
			 echo $this->image_lib->display_errors(); 
			 exit;
		}

		$this->image_lib->clear();	

		$copy_scr1 = $path.'/'.$file;
		$dest_thum1 = './assets/uploads/color_img/'.$file;
		copy($copy_scr1, $dest_thum1);
	}


	public function delete_product($product_id){
		$this->check_login();
		if(empty($product_id)) redirect('superadmin/products');

		$images = $this->superadmin_model->get_row('products', array('id'=>$product_id));

		$colors = $this->superadmin_model->get_result('product_colors', array('product_id'=>$product_id));

		$resp = $this->superadmin_model->delete('products',array('id'=>$product_id));

		if ($resp) {

			$path ='assets/uploads/products/';

			$thumb_path ='assets/uploads/products/thumbnail/';

			$cpath ='assets/uploads/color_img/';

			$cthumb_path ='assets/uploads/color_img/thumbnail/';

			if(!empty($images->main_image)){
				@unlink($path.$images->main_image);
				@unlink($thumb_path.$images->main_image);
			}

			if(!empty($images->back_image)){
				@unlink($path.$images->back_image);
				@unlink($thumb_path.$images->back_image);
			}

			if ($colors) {
				foreach ($colors as $col) {
					$resp1 = $this->superadmin_model->delete('product_colors',array('id'=>$col->id));
					if ($resp1) {
						if(!empty($col->main_image)){
							@unlink($cpath.$col->main_image);
							@unlink($cthumb_path.$col->main_image);
						}

						if(!empty($col->back_image)){
							@unlink($cpath.$col->back_image);
							@unlink($cthumb_path.$col->back_image);
						}
					}
				}
			}
			
			$this->session->set_flashdata('success_msg',"Product has been deleted successfully.");
			redirect('superadmin/products');
		}

	}
		
	public function edit_product($product_id=''){
		$this->check_login();

		if($product_id =='')
			redirect('superadmin/products');

		$data['product'] = $this->superadmin_model->get_row('products',array('id'=>$product_id));
		if (!$data['product']) {
			$this->session->set_flashdata('error_msg', 'Product Not found.');
			redirect('superadmin/products');
		}
		$old_color = '';
		$color_data = array();
		$default_color = $data['product']->default_color;
		$data['color'] = $this->superadmin_model->get_row('product_colors',array('id'=>$default_color));
		if ($data['color']) {
			$old_color = $data['color']->color_code;
		}
		$old_slug = $data['product']->slug;
		$this->form_validation->set_rules('group_id', 'group_id', 'required');				
		$this->form_validation->set_rules('regular_name', 'regular name', 'required');		
		$this->form_validation->set_rules('size_id', 'size_id', 'callback_check_size');		
		$this->form_validation->set_rules('price', 'price', 'required');		
		$this->form_validation->set_rules('desc', 'desc', 'required');
		$this->form_validation->set_rules('addsizechart', 'Size Chart', 'callback_check_size_chart');
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_prod_slug['."edit".','.$old_slug.']');
 		$this->form_validation->set_rules('color_name', 'color name', 'required');
 		$this->form_validation->set_rules('order', 'order', 'required');
		$this->form_validation->set_rules('category', 'category', 'callback_check_design_categories');
		if ($this->form_validation->run() == TRUE){

			if ($this->input->post('top')) {
				$rest_para = array(
									'top' => $this->input->post('top'),
									'left' => $this->input->post('left'),
									'height' => $this->input->post('height'),
									'width' => $this->input->post('width')
								);
				$rest_para = json_encode($rest_para);
			}else{
				$rest_para = '';
			}
			/*print_r($this->input->post('size_id'));
			print_r($this->input->post('price_size'));
			echo"<br>".count($this->input->post('size_id'));
			echo"<br>".count($this->input->post('price_size'));

			die;*/

			$color_img['position']=$this->input->post('position');
			$color_img['width']=$this->input->post('width');
			$color_img['top']=$this->input->post('top');
			$color_img['left']=$this->input->post('left');
			$this->superadmin_model->update('product_colors',$color_img,array('product_id'=>$product_id));

			$update_data=array(

				'size_id'=>serialize($this->input->post('size_id')),
				'group_id'=>$this->input->post('group_id'),
				'prefix'=>$this->input->post('prefix'),
				'regular_name'=>$this->input->post('regular_name'),
				'restricted_para'=>$rest_para,
				'short_name'=>$this->input->post('short_name'),
				'singular'=>$this->input->post('singular'),
				'uri'=>$this->input->post('uri'),
				'price'=>$this->input->post('price'),
				'desc'=>$this->input->post('desc'),
				'slug'=>$this->input->post('slug'),
				'modified'=> date('Y-m-d h:i:s'),
				'order'=>$this->input->post('order'),
				'position'=>$this->input->post('position'),
				'width'=>$this->input->post('width'),
				'top'=>$this->input->post('top'),
				'left'=>$this->input->post('left')
			);
			
			//echo $_POST['addsizechart'];
			if (!empty($_POST['addsizechart'])){
				$this->session->set_userdata('sizechart', '');
				$this->session->unset_userdata('sizechart');
				$update_data['sizechart'] = $this->input->post('sizechart');
				$update_data['is_sizechart'] = 1;
			}
			else
			{
				$update_data['sizechart'] ='';
				$update_data['is_sizechart'] = 0;
			}

			if ($this->input->post('category') != ''){
				$update_data['category'] = serialize($this->input->post('category'));
			}
			else{
				$update_data['category'] = '';
			}

			if ($this->input->post('color') != $old_color){
				$color_data['color_code'] = $this->input->post('color');
			}

			$this->load->library('image_lib');
			
			if($_FILES['userfile']['name']!=''){

				$path ='assets/uploads/products/';

				$thumb_path ='assets/uploads/products/thumbnail/';

				$cpath ='assets/uploads/color_img/';

				$cthumb_path ='assets/uploads/color_img/thumbnail/';

				if(!empty($data['product']->main_image)){
					@unlink($path.$data['product']->main_image);
					@unlink($thumb_path.$data['product']->main_image);
					@unlink($cpath.$data['product']->main_image);
					@unlink($cthumb_path.$data['product']->main_image);
				}

				$config['upload_path'] = './assets/uploads/products';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '50000';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload()){
					$do_upload = $this->upload->display_errors();
					$this->session->set_flashdata('error_msg' , $do_upload);
					redirect('superadmin/edit_product/'.$product_id);
				}else{
				   $upload_data = $this->upload->data();			
				   $color_data['main_image'] = $update_data['main_image'] = $upload_data['file_name'];
				   // $copy_scr1 = './assets/uploads/products/'.$update_data['main_image'];
				   // $dest_thum1 = './assets/uploads/color_img/'.$update_data['main_image'];
				   // copy($copy_scr1, $dest_thum1);
				   $this->create_thumb_file($update_data['main_image']);
				}
			}

			if($_FILES['back']['name']!=''){

				$path ='assets/uploads/products/';

				$thumb_path ='assets/uploads/products/thumbnail/';

				$cpath ='assets/uploads/color_img/';

				$cthumb_path ='assets/uploads/color_img/thumbnail/';

				if(!empty($data['product']->back_image)){
					@unlink($path.$data['product']->back_image);
					@unlink($thumb_path.$data['product']->back_image);
					@unlink($cpath.$data['product']->back_image);
					@unlink($cthumb_path.$data['product']->back_image);
				}

				$config['upload_path'] = './assets/uploads/products';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '50000';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('back')){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('superadmin/add_product/');
				}else{
				   $upload_data = $this->upload->data();			
			       $color_data['back_image'] = $update_data['back_image'] = $upload_data['file_name'];
			    //    $copy_scr = './assets/uploads/products/'.$update_data['back_image'];
				   // $dest_thum = './assets/uploads/color_img/'.$update_data['back_image'];
				   // copy($copy_scr, $dest_thum);
				   $this->create_thumb_file($update_data['back_image']);
				}
			}
			//print_r($update_data);
			//die;
			$data_chk=array(
					'product_id'=>$product_id
					);

			$this->superadmin_model->update('products',$update_data,array('id'=>$product_id));

			$price_size=$this->input->post('price_size');
			$size_id=$this->input->post('size_id');
			$i=0;
			$this->superadmin_model->delete('product_size_price',$data_chk);
			foreach ($size_id as $value) {
				if(!empty($price_size[$i])){
				$data2=array(
					'size_id'=>$value,
					'price'=>$price_size[$i],
					'product_id'=>$product_id
					);
				$size_id_product[]=$value;
				$this->superadmin_model->insert('product_size_price',$data2);
				}$i++;
			}
			$this->superadmin_model->update('products',array('size_id'=>serialize($size_id_product)),array('id'=>$product_id));

			$color_data['color_name']=$this->input->post('color_name');
			
			if (!empty($color_data))
				$this->superadmin_model->update('product_colors',$color_data,array('id'=>$default_color));

			

			$this->session->set_flashdata('success_msg',"Product has been updated successfully.");
			redirect('superadmin/products');
		}
		
		$data['sizes'] = $this->superadmin_model->get_result('product_sizes');
		$data['group'] = $this->superadmin_model->get_result('product_group');
		$data['product_categories'] = $this->superadmin_model->get_result('design_category');
		$data['template'] = 'superadmin/edit_product';
        $this->load->view('templates/superadmin_template', $data);
        
	}

	public function sizes($offset=0){
		$this->check_login(); 		
		$limit=10;
		$data['sizes']=$this->superadmin_model->sizes($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/sizes/';
		$config['total_rows'] = $this->superadmin_model->sizes(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/sizes';
        $this->load->view('templates/superadmin_template', $data);		
	}
	

	public function add_size(){
		$this->check_login(); 	
		$this->form_validation->set_rules('size_name', 'size_name', 'required|callback_check_size_name['."add,slug".']');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(					
				'size_name'=>$this->input->post('size_name'),								
				'created' => date('Y-m-d H:i:s')		
				);	
			$this->superadmin_model->insert('product_sizes',$data);		
			$this->session->set_flashdata('success_msg',"Size added successfully.");
			redirect('superadmin/sizes');
		}
		$data['template'] = 'superadmin/add_size';
        $this->load->view('templates/superadmin_template', $data);		
	}
	public function check_size_name($name, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_name = $param[1];
		if ($called === 'add'){
			$resp = $this->superadmin_model->get_row('product_sizes', array('size_name' => $name));
			if ($resp){
				$this->form_validation->set_message('check_size_name', 'size name you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif ($old_name === $name) {
				return TRUE;
			}else{
				$resp = $this->superadmin_model->get_row('product_sizes', array('size_name' => $name));
				if ($resp) {
					$this->form_validation->set_message('check_size_name', 'size name you are choosing already exist.');
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}


	public function edit_size($id=''){
		$this->check_login();
		if($id=='')
		redirect('superadmin/sizes');
		$data['size'] = $this->superadmin_model->get_row('product_sizes', array('id'=>$id));
		$size_name = $data['size']->size_name; 				
		$this->form_validation->set_rules('size_name', 'size_name', 'required|callback_check_size_name['."edit,".$size_name.']');			
		if ($this->form_validation->run() == TRUE){			
			$data=array(				
				'size_name'=>$this->input->post('size_name'),				
				'updated' => date('Y-m-d H:i:s')		
				);	
			$this->superadmin_model->update('product_sizes',$data, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"Size updated successfully.");
			redirect('superadmin/sizes');
		}
		$data['template'] = 'superadmin/edit_size';
        $this->load->view('templates/superadmin_template', $data);
        
	}

	public function delete_size($size_id){
		$this->superadmin_model->delete('product_sizes',array('id'=>$size_id));
		$this->session->set_flashdata('success_msg',"Size deleted successfully.");
			redirect('superadmin/sizes');
	}

	public function product_group($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['product_group']=$this->superadmin_model->product_group($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/product_group/';
		$config['total_rows'] = $this->superadmin_model->product_group(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/product_group';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function add_group(){
		$this->check_login(); 			
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');				
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'group_name'=>$this->input->post('group_name'),				
				'created' => date('Y-m-d H:i:s')		
				);			
			$this->superadmin_model->insert('product_group',$data);		
			$this->session->set_flashdata('success_msg',"Group has been added successfully.");
			redirect('superadmin/product_group');
		}
		$data['template'] = 'superadmin/add_group';
        $this->load->view('templates/superadmin_template', $data);		
	}


	public function edit_group($group_id=''){
		$this->check_login(); 
		if($group_id=='')
		redirect('superadmin/product_group');		
		$this->form_validation->set_rules('group_name', 'group_name', 'required');
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'group_name'=>$this->input->post('group_name'),								
				);			
			$this->superadmin_model->update('product_group',$data,array('id'=>$group_id));
			$this->session->set_flashdata('success_msg',"Group has been updated successfully.");
			redirect('superadmin/product_group');
		}		
		$data['product_group'] = $this->superadmin_model->get_row('product_group',array('id'=>$group_id));
		$data['template'] = 'superadmin/edit_group';
        $this->load->view('templates/superadmin_template', $data);	        
	}


	public function delete_group($group_id){
		$this->check_login();
		if(empty($group_id)) redirect('superadmin/product_group');

		$this->superadmin_model->delete('product_group',array('id'=>$group_id));
		$this->session->set_flashdata('success_msg',"Group has been deleted successfully.");
			redirect('superadmin/product_group');
	}



	public function design_categories($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['design_categories']=$this->superadmin_model->design_categories($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/design_categories/';
		$config['total_rows'] = $this->superadmin_model->design_categories(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/design_categories';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function check_cat_slug($slug, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_slug = $param[1];
		if ($called === 'add'){
			$resp = $this->superadmin_model->get_row('design_category', array('slug' => $slug));
			if ($resp){
				$this->form_validation->set_message('check_cat_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif ($old_slug === $slug) {
				return TRUE;
			}else{
				$resp = $this->superadmin_model->get_row('design_category', array('slug' => $slug));
				if ($resp) {
					$this->form_validation->set_message('check_cat_slug', 'Slug you are choosing already exist.');
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}

	public function add_design_category(){
		$this->check_login(); 			
		$this->form_validation->set_rules('category', 'category', 'required|callback_check_cat_title['."add,slug".']');				
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_cat_slug['."add,slug".']');
		if ($this->form_validation->run() == TRUE){
			$data = array(
				'category_name' => $this->input->post('category'),
				'slug'			=> $this->input->post('slug'),
				'created' 		=> date('Y-m-d H:i:s')		
				);
			$this->superadmin_model->insert('design_category',$data);		
			$this->session->set_flashdata('success_msg',"Category has been added successfully.");
			redirect('superadmin/design_categories');
		}
		$data['template'] = 'superadmin/add_design_category';
        $this->load->view('templates/superadmin_template', $data);		
	}


	public function edit_design_category($cat_id=''){
		$this->check_login();
		if($cat_id=='')
			redirect('superadmin/design_categories');

		$data['design_categories'] = $this->superadmin_model->get_row('design_category',array('id'=>$cat_id));
		$old_slug = $data['design_categories']->slug;
		$old_title = $data['design_categories']->category_name;
		$this->form_validation->set_rules('category', 'category', 'required|callback_check_cat_title['."edit".','.$old_title.']');
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_cat_slug['."edit".','.$old_slug.']');
		if ($this->form_validation->run() == TRUE){
			$data=array(
				'category_name'=>$this->input->post('category'),
				'slug'=>$this->input->post('slug')
				);
				// print_r($data); die();
			$this->superadmin_model->update('design_category',$data,array('id'=>$cat_id));
			$this->session->set_flashdata('success_msg',"Category has been updated successfully.");
			redirect('superadmin/design_categories');
		}		
		$data['template'] = 'superadmin/edit_design_category';
        $this->load->view('templates/superadmin_template', $data);	        
	}

	public function delete_design_category($cat_id){		
		$this->superadmin_model->delete('design_category',array('id'=>$cat_id));
		$this->session->set_flashdata('success_msg',"Category has been deleted successfully.");
		redirect('superadmin/design_categories');
	}

	public function categories($offset=0){
		$this->check_login(); 
		$limit=10;
		$data['product_categories']=$this->superadmin_model->categories($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/categories/';
		$config['total_rows'] = $this->superadmin_model->categories(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'superadmin/categories';
        $this->load->view('templates/superadmin_template', $data);		
	}

public function check_cat_title($name, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_name = $param[1];
		if ($called == 'add'){
			$resp = $this->superadmin_model->get_row('design_category', array('category_name' => strtolower($name)));
			if ($resp){
				$this->form_validation->set_message('check_cat_title', 'Category Name you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif (strtolower($old_name) == strtolower($name)) {
				return TRUE;
			}else{
				$resp = $this->superadmin_model->get_row('design_category', array('category_name' => strtolower($name)));
				if ($resp) {
					$this->form_validation->set_message('check_cat_title', 'Category Name you are choosing already exist.');
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}

	public function check_banner2($banner){
		if($_FILES['userfile']['name'] == '')
		{
			$this->form_validation->set_message('check_banner2', 'Category Header required.');
			return FALSE;
		}
		else
			return TRUE;
	}

	public function do_upload1($path='./assets/uploads/store'){
		$this->check_login(); 	
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '50000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload()){
			return array('status'=> FALSE,'error' => $this->upload->display_errors());			
		}else{
			return array('status'=> TRUE,'upload_data' => $this->upload->data());			
		}
	}

	public function add_category(){
		$this->check_login(); 			
		$this->form_validation->set_rules('category', 'category', 'required|callback_check_cat_title['."add,slug".']');
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_cat_slug['."add,slug".']');
		/*$this->form_validation->set_rules('userfile', 'Category Banner', 'callback_check_banner2');*/
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'category_name'=>$this->input->post('category'),
				'slug'=>$this->input->post('slug'),
				'created' => date('Y-m-d H:i:s')		
				);

			/*if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload1('./assets/uploads/category');			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('error_msg' , $do_upload['error']);
					redirect('superadmin/add_category');
				}else{
					$data['category_banner']=$do_upload['upload_data']['file_name'];
				}
			}*/

			$this->superadmin_model->insert('design_category',$data);

			$this->session->set_flashdata('success_msg',"Category has been added successfully.");
			redirect('superadmin/categories');
		}
		$data['template'] = 'superadmin/add_category';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function edit_category($cat_id=''){
		$this->check_login(); 
		if($cat_id=='')
		redirect('superadmin/categories')	;	
		$data['categories'] = $this->superadmin_model->get_row('design_category',array('id'=>$cat_id));
		$old_slug = $data['categories']->slug;
		$old_title = $data['categories']->category_name;
		/*$old_img = $data['categories']->category_banner;*/
		$this->form_validation->set_rules('category', 'category', 'required|callback_check_cat_title['."edit".','.$old_title.']');
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_cat_slug['."edit".','.$old_slug.']');
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'category_name'=>strtolower($this->input->post('category')),
				'slug'=>$this->input->post('slug')
				);

			/*if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload1('./assets/uploads/category');			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('error_msg' , $do_upload['error']);
					redirect('superadmin/edit_category');
				}else{
					$data['category_banner']=$do_upload['upload_data']['file_name'];
					@unlink('assets/uploads/category/'.$old_img);
				}
			}*/
			$this->superadmin_model->update('design_category',$data,array('id'=>$cat_id));

			$this->session->set_flashdata('success_msg',"Category has been updated successfully.");
			redirect('superadmin/categories');
		}		
		$data['template'] = 'superadmin/edit_category';
        $this->load->view('templates/superadmin_template', $data);	        
	}
	public function delete_category($cat_id){
		$this->check_login();
		if($cat_id=='') redirect('superadmin/categories');	
		$cat = $this->superadmin_model->get_row('design_category',array('id'=>$cat_id));
		if ($cat) {
			@unlink('assets/uploads/category/'.$cat->category_banner);
			$this->superadmin_model->delete('design_category',array('id'=>$cat_id));
			$this->session->set_flashdata('success_msg',"Category has been deleted successfully.");
		}
		redirect('superadmin/categories');
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

    public function check_dgn_slug($slug, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_slug = $param[1];
		if ($called === 'add'){
			$resp = $this->superadmin_model->get_row('design', array('slug' => $slug));
			if ($resp){
				$this->form_validation->set_message('check_dgn_slug', 'Slug you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif ($old_slug === $slug) {
				return TRUE;
			}else{
				$resp = $this->superadmin_model->get_row('design', array('slug' => $slug));
				if ($resp) {
					$this->form_validation->set_message('check_dgn_slug', 'Slug you are choosing already exist.');
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}

	public function add_design(){
		$this->check_login(); 			
		$this->form_validation->set_rules('artist', 'Artist', 'required');				
		$this->form_validation->set_rules('design_title', 'Design Title', 'required');				
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_dgn_slug['."add,slug".']');
		$this->form_validation->set_rules('description', 'Description', 'required');				
		$this->form_validation->set_rules('price', 'Price', 'required');				
		$this->form_validation->set_rules('category', 'Category', 'callback_check_design_categories');
		 if(!empty($_FILES['upload_video']['name'])){
         $this->form_validation->set_rules('upload_video', 'video', 'callback_upload_video');
        }
		if($this->form_validation->run() == TRUE){			
			$show_on_editor=0;
			if($this->input->post('show_on_editor'))
			{
				$show_on_editor=1;
			}	
			if($this->session->userdata('upload_video')!=''){  
                $upload_video=$this->session->userdata('upload_video');
                $data['design_video'] = $upload_video['upload_video'];  
            	$data['design_video_type'] 	= $this->input->post('design_video_type');
            }else if(!empty($_POST['design_video'])){
                $data['design_video'] 	= $this->input->post('design_video');
            	$data['design_video_type'] 	= $this->input->post('design_video_type');

            }
              	$data['artist'] 		= $this->input->post('artist');
               	$data['design_title'] 	= $this->input->post('design_title');
            	$data['slug'] 			= $this->input->post('slug');
                $data['description'] 	= $this->input->post('description');
                $data['category'] 		= serialize($this->input->post('category'));
				$data['price']			= $this->input->post('price');
				$data['status']			= 1;
				$data['created'] 		= date('Y-m-d H:i:s');
				$data['show_on_editor']	= $show_on_editor;		
			


				if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/designs';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '99999999';
				$this->load->library('upload');
				$this->upload->initialize($config);
				if (!$this->upload->do_upload()){
					$do_upload = $this->upload->display_errors();
					$this->session->set_flashdata('error_msg' , $do_upload);
					redirect('superadmin/add_product/');
				}else{
				   $upload_data = $this->upload->data();
				    $this->create_design_thumb($upload_data['file_name']);				
					$data['design_image']=$upload_data['file_name'];
				}
				
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload.');
				redirect(current_url());
			}			
			$store_id = get_store_id(superadmin_id());
			$design_id = $this->superadmin_model->insert('design',$data);
			$this->superadmin_model->insert('design_to_multistore',array('design_id'=>$design_id,'store_id'=>$store_id));
			if($this->session->userdata('upload_video')!=''):
                $this->session->unset_userdata('upload_video');
            endif;
			$this->session->set_flashdata('success_msg',"Design has been added successfully.");
			redirect('superadmin/designs');
		}
		$data['design_category'] = $this->superadmin_model->get_result('design_category');
		$data['template'] = 'superadmin/add_design';
        $this->load->view('templates/superadmin_template', $data);		
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
	public function edit_design($design_id=''){
		$this->check_login();
		$flag = 0;
		if($design_id=='')
		redirect('superadmin/designs');

		$data['designs'] = $this->superadmin_model->get_row('design', array('id'=>$design_id));
		$old_slug = $data['designs']->slug;
		$this->form_validation->set_rules('artist', 'artist', 'required');				
		$this->form_validation->set_rules('design_title', 'design_title', 'required');				
		$this->form_validation->set_rules('description', 'description', 'required');				
		$this->form_validation->set_rules('category', 'category', 'callback_check_design_categories');
		$this->form_validation->set_rules('slug', 'Slug', 'required|callback_check_dgn_slug['."edit".','.$old_slug.']');
		if(!empty($_FILES['upload_video']['name'])){
         $this->form_validation->set_rules('upload_video', 'video', 'callback_upload_video');
        }
		if($this->input->post('price'))
		{
			$this->form_validation->set_rules('price', 'Design Price', 'required');				
			$flag =1;
		}	
		$show_on_editor=0;
		if($this->input->post('show_on_editor'))
		{
			$show_on_editor=1;
		}			
		if ($this->form_validation->run() == TRUE){	

			if($this->session->userdata('upload_video')!=''){  
                $upload_video=$this->session->userdata('upload_video');
                $update_data['design_video'] = $upload_video['upload_video'];  
            	$update_data['design_video_type'] 	= $this->input->post('design_video_type');
            }else if(!empty($_POST['design_video'])){
                $update_data['design_video'] 	= $this->input->post('design_video');
            	$update_data['design_video_type'] 	= $this->input->post('design_video_type');

            }
				$update_data['artist'] 			= $this->input->post('artist');
               	$update_data['design_title'] 	= $this->input->post('design_title');
                $update_data['slug'] 			= $this->input->post('slug');
                $update_data['description'] 	= $this->input->post('description');
                $update_data['category'] 		= serialize($this->input->post('category'));
				$update_data['updated'] 		= date('Y-m-d H:i:s');
				$update_data['show_on_editor']	= $show_on_editor;
                		

			if($flag!=0)
			{
				$update_data['price'] = $this->input->post('price');
			}

			if($_FILES['userfile']['name']!=''){
				
				$config['upload_path'] = './assets/uploads/designs';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '999999';
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload()){
					$do_upload = $this->upload->display_errors();
					$this->session->set_flashdata('error_msg' , $do_upload);
					redirect('superadmin/edit_design/'.$design_id);
				}else{
				    $upload_data = $this->upload->data();
				    $update_data['design_image']=$upload_data['file_name'];
				    $this->create_design_thumb($update_data['design_image']);
				    $path='./assets/uploads/designs/';
					$file = $data['designs']->design_image;
	                if(!empty($file)){
	                    @unlink($path.$file);
	                    @unlink($path.'thumbnail/'.$file);          
	                }
				}				
			}
			
			if ($this->session->userdata('upload_video')!='') {
                    if($video = $this->superadmin_model->get_row('design',array('id'=>$design_id))){
                        unlink($video->design_video);
                     }
                }
			$this->superadmin_model->update('design',$update_data, array('id'=>$design_id));
			if($this->session->userdata('upload_video')!=''):
                $this->session->unset_userdata('upload_video');
            endif;
			$this->session->set_flashdata('success_msg',"Design has been updated successfully.");
			redirect('superadmin/designs');
		}
		
		$data['design_category'] = $this->superadmin_model->get_result('design_category');
		$data['template'] = 'superadmin/edit_design';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function designs($design_id = "-" ,$artist = "-",$keyword = "-" ,$design_status='null',$offset = 0){
		$this->check_login();
		$design_status = 2;
		if ($_POST) {

			if($this->input->post('design_id') != ""){
				$design_id = $this->input->post('design_id');
			}

			if($this->input->post('artist') != ""){
				$artist = $this->input->post('artist');	
			}

			if($this->input->post('keyword') != ""){
				$keyword = $this->input->post('keyword');
			}
			if($design_status!='null')
			{	
			if($this->input->post('design_status') != 2){
				$design_status = $this->input->post('design_status');
				$set_status = $this->input->post('design_status');
			}}
		}

		$limit=20;
		$data['designs']=$this->superadmin_model->designs($limit, $offset,$design_id, $artist, $keyword,$design_status);

		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/designs/';
		$config['total_rows'] = $this->superadmin_model->designs(0, 0, $design_id, $artist, $keyword,$design_status);
		$config['per_page'] = $limit;
		$config['num_links'] = 6;		
		$config['uri_segment'] = 7;		
		$config['prefix'] = $design_id."/".$artist."/".$keyword."/".$design_status."/";		
		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;

		if ($design_id == '-')
			$data['design_id'] = "";
		else
			$data['design_id'] = $design_id;

		if ($artist == '-')
			$data['artist'] = "";
		else
			$data['artist'] = $artist;

		if ($keyword == '-')
			$data['keyword'] = "";
		else
			$data['keyword'] = $keyword;

		$data['set_status']=$design_status;
		// $data['design_id'] = $design_id;
		// $data['artist'] = $artist;
		// $data['keyword'] = $keyword;

		$data['template'] = 'superadmin/designs';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function design_price($design_id='',$offset=0)
	{
		$this->check_login(); 
		if(empty($design_id)) redirect('superadmin/designs');

		$this->form_validation->set_rules('price', 'Design Price', 'required');

		if($this->form_validation->run() == TRUE){
			$data= array(	
				'price'=>$this->input->post('price')
				 ); 
	  		$this->superadmin_model->update('design',$data, array('id'=>$design_id));
			redirect('superadmin/designs/'.$offset);	
	 	}
		$data['template'] = 'superadmin/add_design_price';
        $this->load->view('templates/superadmin_template', $data);	

	}

	public function approved_design($design_id='' ,$offset=0)
	{
	  $this->check_login();
	  if(empty($design_id))
	  	redirect('superadmin/designs');
	  $design = $this->superadmin_model->get_row('design', array('id' => $design_id));
	  if (!$design) {
	  	$this->session->set_flashdata('error_msg',"Some info is missing.");
	  	redirect('superadmin/designs');
	  }

	  if ($design->price == 0.00) {
	  	$this->session->set_flashdata('error_msg',"Please first add price for this design.");
	  	redirect('superadmin/designs');
	  }

 	  $data= array('status' => 1 ); 
	  $this->superadmin_model->update('design',$data, array('id'=>$design_id));
	
	  $this->session->set_flashdata('success_msg',"Design has been approved with price successfully.");
	  redirect('superadmin/designs/'.$offset);	
	}
	
	public function delete_design($design_id){

		$this->check_login();

		if(empty($design_id)) redirect('superadmin/designs');

		$images = $this->superadmin_model->get_row('design', array('id'=>$design_id));

		if (!$images) {
			$this->session->set_flashdata('error_msg',"design Info not found.");
			redirect('superadmin/designs');
		}

		$this->superadmin_model->delete('design_to_multistore',array('design_id'=>$design_id));
		
		$del = $this->superadmin_model->delete('design',array('id'=>$design_id));

		if($del){
			if(!empty($images->design_image)){
				$path='./assets/uploads/designs/';
	            if(!empty($images->design_image)){
	                @unlink($path.$images->design_image);
	                @unlink($path.'thumbnail/'.$images->design_image);
	            }
			}
		}

		$this->session->set_flashdata('success_msg',"designs has been deleted successfully.");
		redirect('superadmin/designs');
	}

	// Waseem's work

	public function product_designs($offset=0){
		$this->check_login();
		$limit=10;
		$data['products']=$this->superadmin_model->products($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/product_designs/';
		$config['total_rows'] = $this->superadmin_model->products(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();

		$data['template'] = 'superadmin/product_designs';
        $this->load->view('templates/superadmin_template', $data);		
	}

    public function delete_product_design($product_id = 0, $offset = 0){

		$this->check_login();

		if ($product_id == 0) {
	   		$this->session->set_flashdata('error_msg',"No Product has been selected.");
			redirect('superadmin/products');
	    }
		
		if ($this->input->post('delete_design')){
			
			$design = $this->input->post('design');

			$resp = $this->superadmin_model->delete_product_design($product_id, $design);
			if ($resp)
				$this->session->set_flashdata('success_msg',"Product Design has been deleted successfully.");
			else
				$this->session->set_flashdata('error_msg',"Product Design cannot deleted.");
			redirect('superadmin/product_designs');
		}

		$limit=10;
		$data['designs']=$this->superadmin_model->selected_prod_designs($product_id, $limit, $offset);
		
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/delete_product_design/'.$product_id.'/';
		$config['total_rows'] = $this->superadmin_model->selected_prod_designs($product_id, 0, 0);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;		
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

		$data['template'] = 'superadmin/delete_product_design';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function select_design($product_id = 0, $offset = 0){

		$this->check_login();
		if ($product_id == 0) {
	   		$this->session->set_flashdata('error_msg',"No Product has been selected.");
			redirect('superadmin/product_designs');
	    }
		if ($this->input->post('select_design')){
			$design = $this->input->post('design');
			$data = array(
							'product_id'=>$product_id,
							'created' => date('Y-m-d H:i:s'),
							'updated' => date('Y-m-d H:i:s')
					);

			$this->superadmin_model->select_design($data, $design);
			$this->session->set_flashdata('success_msg',"Product design has been added successfully.");
			redirect('superadmin/product_designs');
		}
		$limit=10;
		$data['designs']=$this->superadmin_model->designs_for_select($limit, $offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/select_design/'.$product_id.'/';
		$config['total_rows'] = $this->superadmin_model->designs_for_select(0, 0);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$data['template'] = 'superadmin/select_design';
        $this->load->view('templates/superadmin_template', $data);	

	}

	public function update_product_design($product_id = 0, $offset = 0){

		$this->check_login();

		if ($product_id == 0) {
	   		$this->session->set_flashdata('error_msg',"No Product has been selected.");
			redirect('superadmin/product_designs');
	    }
	    
		$selected_designs = $this->superadmin_model->selected_designs_id($product_id);
	
		if(!empty($selected_designs)){
			$arr = array();
			foreach ($selected_designs as $v1) {
				$arr[$v1->design_id] = $v1->id;
			}
			$data['selected_designs'] = $arr;
		}
		if ($this->input->post('select_design')){
			$design = $this->input->post('design');
		
			$data = array(
						'product_id'=>$product_id,
						'created' => date('Y-m-d H:i:s'),
						'updated' => date('Y-m-d H:i:s')
					);

			$this->superadmin_model->update_product_design($data, $design, $arr);
			$this->session->set_flashdata('success_msg',"Product design has been added successfully.");
			redirect('superadmin/product_designs');
		}

		$limit=10;
		$data['designs']=$this->superadmin_model->designs_for_select($limit, $offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/update_product_design/'.$product_id.'/';
		$config['total_rows'] = $this->superadmin_model->designs_for_select(0, 0);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['template'] = 'superadmin/update_product_design';
        $this->load->view('templates/superadmin_template', $data);		
	}	

	public function updated_design($product_id ,$offset=0){
		$this->check_login();
		$limit=10;
		$data['designs']=$this->superadmin_model->updated_design($limit, $offset,$product_id );
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/updated_design/'.$product_id.'/';
		$config['total_rows'] = $this->superadmin_model->updated_design(0, 0,$product_id);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();	

		$data['template'] = 'superadmin/updated_design_to_product';
        $this->load->view('templates/superadmin_template', $data);	

	}

	public function user_pay_request($offset=0){
		$this->check_login();
		$limit=100;
		$data['pay_request'] = $this->superadmin_model->pay_request($limit, $offset);
		
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/user_pay_request/';
		$config['total_rows'] = $this->superadmin_model->pay_request(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/user_pay_request';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function user_pay_request_approve($offset=0){
		$this->check_login();
		$limit=100;
		$data['pay_request'] = $this->superadmin_model->pay_request_approve($limit, $offset);
		
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/user_pay_request_approve/';
		$config['total_rows'] = $this->superadmin_model->pay_request_approve(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/user_pay_request_approve';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function paypal_users($offset=0){
		$this->check_login();


		$limit=25;
		$data['pay_request'] = $this->superadmin_model->paypal_users($limit, $offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/user_pay_request/';
		$config['total_rows'] = $this->superadmin_model->paypal_users(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/paypal_users';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function pay_to_users(){
		$this->check_login();

		$user_ids = $this->input->post('user_id');
		if (empty($user_ids)) {
			$this->session->set_flashdata('error_msg', 'No Users are selected for the process.');
			redirect('superadmin/paypal_users');
		}
		$user_info = $this->superadmin_model->get_users_for_pay($user_ids);
		if (empty($user_info)) {
			$this->session->set_flashdata('error_msg', 'Users Info not found.');
			redirect('superadmin/paypal_users');
		}
		
		$emailSubject =urlencode('example_email_subject');
		$receiverType = urlencode('EmailAddress');
		$currency = urlencode('USD');	// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

		// Add request-specific fields to the request string.
		$nvpStr="&EMAILSUBJECT=$emailSubject&RECEIVERTYPE=$receiverType&CURRENCYCODE=$currency";

		$receiversArray = array();
		$j=0;
	    $commission_info = commission_info();
		foreach ($user_info as $user) {
			//Create Token
			 $key1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
			 $key2 = substr(str_shuffle("0123456789"), 0, 2);
			 $key3 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
	         $uniqueid = date('d').$key1.$key2.$key3.$user->user_id;
	         $payable_amount = $user->unpaid_com - $commission_info->paypal_fee;
			$receiverData = array(	'receiverEmail' => $user->paypal_email,
									'amount' => $payable_amount,
									'uniqueID' => $uniqueid,
									'note' => "Commission_Payment_By_ShirtScore.",
									'userid' => $user->user_id);
			$receiversArray[$j] = $receiverData;
			$j++;
		}
		foreach($receiversArray as $i => $receiverData) {
			$receiverEmail = urlencode($receiverData['receiverEmail']);
			$amount = urlencode($receiverData['amount']);
			$uniqueID = urlencode($receiverData['uniqueID']);
			$note = urlencode($receiverData['note']);
			$nvpStr .= "&L_EMAIL$i=$receiverEmail&L_Amt$i=$amount&L_UNIQUEID$i=$uniqueID&L_NOTE$i=$note";
		}
	
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = $this->PPHttpPost('MassPay', $nvpStr);

		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
			// exit('MassPay Completed Successfully: '.print_r($httpParsedResponseAr, true));
			$commission_info = commission_info();
			foreach ($user_info as $user) {
				$last_paid = ($user->unpaid_com - $commission_info->paypal_fee);
				$total_paid = ($user->total_paid_com + $user->unpaid_com);
				$data = array('unpaid_com' 				=> 0,
							  'last_paid_com' 			=> $last_paid,
							  'total_paid_com' 			=> $total_paid,
							  'pay_status' 				=> 1,
							  'payment_date' 			=> urldecode($httpParsedResponseAr["TIMESTAMP"]),
							  'payment_method'=>2,
							  );

				$this->superadmin_model->update('commission_request', $data, array('user_id' => $user->user_id));

				$data = array('user_id' 				=> $user->user_id,
							  'payment_amount' 			=> $last_paid,
							  'pay_status' 				=> 1,
							  'paypal_transaction_id' 	=> urldecode($httpParsedResponseAr["CORRELATIONID"]),
							  'payment_date' 			=> urldecode($httpParsedResponseAr["TIMESTAMP"])
							  );
				$this->superadmin_model->insert('paypal_transaction', $data);
			}

			$this->session->set_flashdata('success_msg', 'Payment completed for the selected user.');

			redirect('superadmin/user_pay_request');
		} else  {
			$this->session->set_flashdata('error_msg', urldecode($httpParsedResponseAr['L_LONGMESSAGE0']).'.');
			redirect('superadmin/user_pay_request');
			// exit('MassPay failed: ' . print_r($httpParsedResponseAr, true));
		}

		//API Call End
	}

	function PPHttpPost($methodName_, $nvpStr_) {
			$environment = 'sandbox';	// or 'beta-sandbox' or 'live'
			// global $environment;
			// Set up your API credentials, PayPal end point, and API version.
			$API_UserName = urlencode('ritesh_api1.laeffect.com');
			$API_Password = urlencode('1377521951');
			$API_Signature = urlencode('AAfThrmA0boO83OlJtnonCEAT-QOAa87AOFXA5qcScDj.Fj7UsCZxRKF');
			$API_Endpoint = "https://api-3t.paypal.com/nvp";
			if("sandbox" === $environment || "beta-sandbox" === $environment) {
				$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
			}
			$version = urlencode('51.0');

			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);

			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);

			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

			// Get response from the server.
			$httpResponse = curl_exec($ch);

			if(!$httpResponse) {
				$this->session->set_flashdata('error_msg', "$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
				redirect('superadmin/user_pay_request');
				// exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}

			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);

			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}

			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
			}

			return $httpParsedResponseAr;
		}
	

	public function slide_status($status=0, $id=''){
		$this->check_login();
		if ($id == '') {
			$this->session->set_flashdata('error_msg', 'Slide not found');
			return FALSE;
		}
		else{
			$resp = $this->superadmin_model->update('sliders', array('status' => $status), array('id' => $id));
			if ($resp)
				$this->session->set_flashdata('success_msg', 'Slide status updated Successfully.');
			else
				$this->session->set_flashdata('error_msg', 'Slide status not updated.');

			redirect('superadmin/slider_settings');
		}
    }

	public function slider_settings($offset=0)
	{
		$this->check_login();
		$limit=10;
		$data['slider']=$this->superadmin_model->slider_settings($limit, $offset);
		$config=get_pagination_style();
		$config['base_url'] = base_url().'superadmin/slider_settings/';
		$config['total_rows'] = $this->superadmin_model->slider_settings(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$data['template'] = 'superadmin/slider_settings';
	    $this->load->view('templates/superadmin_template', $data);
	}

	public function check_slider_img(){
       if ($_FILES['slider_image']['tmp_name'] == '') {
           $this->form_validation->set_message('check_slider_img', 'Slider image required.');
            return FALSE;
       }
       else
       		return TRUE;
    }

	public function add_slider_content(){
		$this->check_login();

		$this->form_validation->set_rules('caption', 'Caption', 'xss_clean|required');
		$this->form_validation->set_rules('slider_image', 'Image', 'callback_check_slider_img');

		if ($this->form_validation->run('') === TRUE){
			if(!empty($_FILES['slider_image']['name']))	{
				$config['upload_path'] = './assets/uploads/slider_images/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['remove_spaces'] = TRUE;
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('slider_image')){
					$error = array('error' => $this->upload->display_errors());
					$error = $error['error'];
					$this->session->set_flashdata('image_error', $error);
					redirect('superadmin/add_slider_content');

				}else{
					$file_info = $this->upload->data();

					$data = array(						
						'caption'           =>  $this->input->post('caption'),
						'image'           	=>  $file_info['file_name'],
						'created'           =>  date('Y-m-d H:i:s'),
						'updated'           =>  date('Y-m-d H:i:s')
					);

					$this->superadmin_model->insert('sliders', $data);							

					$this->session->set_flashdata('success_msg', 'Slider image added Successfully.');
				}

				redirect('superadmin/slider_settings');
			}else{
				$this->session->set_flashdata('image_error', "Please select an image.");
				redirect('superadmin/add_slider_content');
			}
		}

		$data['template'] = 'superadmin/add_slider_content';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function remove_slider_image($id){
		$query = $this->superadmin_model->get_row('sliders', array('id'=>$id));
		if(!empty($query->image)){
			$path = "assets/uploads/slider_images/";
			unlink($path.$query->image);
			$this->superadmin_model->update('sliders', array('image' => ""), array('id' => $id));
			echo "done";
		}
	}

	public function check_is_delete($slug){
		if ($slug == '1'){
			if ($_FILES['slider_image']['tmp_name'] == '') {
		        $this->form_validation->set_message('check_is_delete', 'Slider Image Required.');
		        return FALSE;
		    }else
		        return TRUE;
		}else{
			return TRUE;
		}
	}

	public function edit_slider_content($slider_id){
		$this->check_login();

		$this->form_validation->set_rules('caption', 'Caption', 'xss_clean|required');

		$this->form_validation->set_rules('img_deleted', 'Image', 'callback_check_is_delete');

		$slider = $this->superadmin_model->get_row('sliders', array('id' => $slider_id));

		$data['slider_content'] = $slider;

		if ($this->form_validation->run('') === TRUE){
			$image = $slider->image;
			if(!empty($_FILES['slider_image']['name'])){
				$this->delete_image($image,'./assets/uploads/slider_images/'); // delete image
				$config['upload_path'] = './assets/uploads/slider_images/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['remove_spaces'] = TRUE;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('slider_image')){
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('image_error', $error);
					redirect('superadmin/slider_settings');
				}else{

					$file_info = $this->upload->data();
					$image = $file_info['file_name'];
				}
			}
			$data = array(					
					'caption'           =>  $this->input->post('caption'),
					'image'           	=>  $image,
					'updated'           =>  date('Y-m-d H:i:s')
				);			

			$this->superadmin_model->update('sliders', $data, array('id' => $slider_id));							
			$this->session->set_flashdata('success_msg', 'Slider content updated successfully.');

			redirect('superadmin/slider_settings');
		}


		$data['template'] = 'superadmin/edit_slider_content';
        $this->load->view('templates/superadmin_template', $data);
	}


	public function delete_slider_content($slider_id){
		$this->check_login(); 

		$slider = $this->superadmin_model->get_row('sliders',array('id'=>$slider_id));
		
		$file = $slider->image;					
		
		$this->delete_image($file,'./assets/uploads/slider_images/'); // delete image

		$this->superadmin_model->delete('sliders',array('id'=>$slider_id));

		$this->session->set_flashdata('success_msg','Slider content has been deleted successfully.');

		redirect('superadmin/slider_settings');
	}

	private function delete_image($file,$path=''){

		if ($path=='')
		{
			$path='./assets/uploads/slider/';
		}
		else{
			$path = $path;
		}

		if(!empty($file))
			@unlink($path.$file);

	}



	public function  store_setting(){
		$this->check_login();
		$data['commission']=$this->superadmin_model->get_row('commission');
		$this->form_validation->set_message('greater_than', 'Value must be greater than zero');
		$this->form_validation->set_rules('comm_per_product', 'Commission Price', 'required|greater_than[0.00]');
		$this->form_validation->set_rules('paypal_fee', 'Paypal Fee', 'required|greater_than[0.00]');
		$this->form_validation->set_rules('mailed_check_fee', 'Mailed Check Fee', 'required|greater_than[0.00]');
		$this->form_validation->set_rules('max_design', 'Max Design', 'required|greater_than[0]');

		if($this->form_validation->run() == TRUE){
			
			$data= array(
				'commission_price'=>$this->input->post('comm_per_product'),
				'paypal_fee'=>$this->input->post('paypal_fee'),
				'mailed_check_fee'=>$this->input->post('mailed_check_fee'),
				'max_design'=>$this->input->post('max_design')
				 );
	  		$this->superadmin_model->update('commission',$data, array('comm_id'=>1));
	  		$this->session->set_flashdata('success_msg','Commission has been updated successfully.');
			redirect('superadmin/store_setting');
	 	}
	 	
		$data['template'] = 'superadmin/store_setting';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function coupons($offset=0){		
		$this->check_login();		
		$limit=10;
		$data['coupons']=$this->superadmin_model->coupons($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/coupons/';
		$config['total_rows'] = $this->superadmin_model->coupons(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/coupons';
        $this->load->view('templates/superadmin_template', $data);		
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

	public function check_coupons_date(){

		$start_date = strtotime($this->input->post('start_date'));

		$end_date = strtotime($this->input->post('end_date'));
		// echo $start_date.','.$end_date;
		// die();
		if ($start_date > $end_date){
			$this->form_validation->set_message('check_coupons_date', 'Start date should not exceeds than End date.');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function add_coupon(){
		$this->check_login();
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('coupon_code', 'Coupon code', 'required|callback_check_coupon_code['."add,coupon_code".']');
		$this->form_validation->set_rules('start_date', 'Start date', 'required|callback_check_coupons_date');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');		
		$this->form_validation->set_rules('type', 'Amount Type', 'required|is_numeric');		
		$this->form_validation->set_rules('discount_use', 'Discount Use', 'required|is_numeric');
		$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
		if ($this->input->post('discount_use') == 2) {
			$this->form_validation->set_rules('max_use', 'Max No. Of Use', 'required');
		}
		if ($this->form_validation->run() == TRUE)
		{
			//$code = strtoupper(uniqid());
			$data=array(
				'code'=>$this->input->post('coupon_code'),	
				'name'=>$this->input->post('name'),				
				'start_date'=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),				
				'reduction_type'=>$this->input->post('type'),
				'discount_use'=>$this->input->post('discount_use'),
				'reduction_amount'=>$this->input->post('amount'),
				'created'=>date('Y-m-d H:i:s'),
				);
				if ($this->input->post('discount_use') == 2) {
					$data['max_uses'] = $this->input->post('max_use');
				}
			
			$page_id=$this->superadmin_model->insert('coupons',$data);		
			$this->session->set_flashdata('success_msg',"Coupon has been added successfully.");
			redirect('superadmin/coupons');
		}
		$data['template'] = 'superadmin/add_coupon';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function check_coupon_code($code, $params){
		$param = explode(',', $params);
		$called = $param[0];
		$old_name = $param[1];
		if ($called == 'add'){
			$resp = $this->superadmin_model->get_row('coupons', array('code' => strtolower($code)));
			if ($resp){
				$this->form_validation->set_message('check_coupon_code', 'Code you are choosing already exist.');
				return FALSE;
			}else
				return TRUE;
		}elseif (strtolower($old_name) == strtolower($code)) {
				return TRUE;
			}else{
				$resp = $this->superadmin_model->get_row('coupons', array('code' => strtolower($code)));
				if ($resp) {
					$this->form_validation->set_message('check_coupon_code', 'Code you are choosing already exist.');
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}

	public function edit_coupon($coupon_id='')
	{		
		$this->check_login();
		if(empty($coupon_id)) redirect('superadmin/coupons');
		$data['coupon'] = $this->superadmin_model->get_row('coupons', array('id' => $coupon_id));
		$old_code  =  $data['coupon']->code;
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('coupon_code', 'Coupon code', 'required|callback_check_coupon_code['."edit,".$old_code.']');
		$this->form_validation->set_rules('start_date', 'Start date', 'required|callback_check_coupons_date');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');		
		$this->form_validation->set_rules('type', 'Amount Type', 'required|is_numeric');
		$this->form_validation->set_rules('discount_use', 'Discount Use', 'required|is_numeric');
		$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
		if ($this->input->post('discount_use') == 2) {
			$this->form_validation->set_rules('max_use', 'Max No. Of Use', 'required');
		}
		if ($this->form_validation->run() == TRUE)
		{			
			$data=array(
				'code'=>$this->input->post('coupon_code'),
				'name'=>$this->input->post('name'),				
				'start_date'=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))),			
				'reduction_type'=>$this->input->post('type'),				
				'discount_use'=>$this->input->post('discount_use'),				
				'reduction_amount'=>$this->input->post('amount'),
				);
			if ($this->input->post('discount_use') == 2) {
				$data['max_uses'] = $this->input->post('max_use');
			}

			$page_id=$this->superadmin_model->update('coupons',$data, array('id' => $coupon_id));		
			$this->session->set_flashdata('success_msg',"Coupon has been updated successfully.");
			redirect('superadmin/coupons');
		}
				
		$data['template'] = 'superadmin/edit_coupon';
        $this->load->view('templates/superadmin_template', $data);
	}



	public function change_coupon_status($status='', $id=''){
		$this->check_login();
		if(empty($id) && empty($status)) redirect('superadmin/coupons');

		$this->superadmin_model->update('coupons', array('status' => $status), array('id' => $id));		
		$this->session->set_flashdata('success_msg',"Coupon status has been changed successfully.");
		redirect('superadmin/coupons');
	}

	public function view_coupon($coupon_id){
		$this->check_login();
		if(empty($coupon_id)) redirect('superadmin/coupons');

		$data['coupon'] = $this->superadmin_model->get_row('coupons', array('id'=> $coupon_id));
		$data['template'] = 'superadmin/view_coupon';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function delete_coupon($coupon_id){
		if(empty($coupon_id)) redirect('superadmin/coupons');

		$this->superadmin_model->delete('coupons', array('id'=> $coupon_id));		
		$this->session->set_flashdata('success_msg',"Coupon has been deleted successfully.");
		redirect('superadmin/coupons');
	}

	public function store_custom_product($sort_base='-', $month = '-', $year = '-', $offset=0){
		$this->check_login(); 
		$limit=10;
		if ($_POST) {
			$sort_base = $this->input->post('sort_base');
			if ($sort_base == 'month' || $sort_base == 'year') {
				if($this->input->post('month'))					
					$month = $this->input->post('month');
				if($this->input->post('year'))
					$year = $this->input->post('year');
			}
		}
		$data['products']=$this->superadmin_model->store_custom_product($limit, $offset, $sort_base, $month, $year);
		$config = get_pagination_style();	
		$config['uri_segment'] = 6;
		$config['base_url'] = base_url().'superadmin/store_custom_product/'.$sort_base.'/'.$month.'/'.$year.'/';
		$config['total_rows'] = $this->superadmin_model->store_custom_product(0, 0, $sort_base, $month, $year);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();

		$data['template'] = 'superadmin/store_custom_product';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function store_product_info($product_id=''){
		$this->check_login();
		if($product_id=='')
			redirect('superadmin/store_product_info');

		$data['product'] = $this->superadmin_model->get_custom_product($product_id);
		if (!empty($data['product']->category_id))
			$data['categories'] = $this->superadmin_model->get_products_categories(unserialize($data['product']->category_id));
		else
			$data['categories']='';
		// print_r($data['product']);
		// die();
		$data['template'] = 'superadmin/store_product_info';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function delete_custom_product($product_id){
		$this->check_login();
		if(empty($product_id)) redirect('superadmin/products');

		$images = $this->superadmin_model->get_row('products', array('id'=>$product_id));		
		if(!empty($images->main_image)){			
			$path ='assets/uploads/custom_prod_img/';
			$thumb_path ='assets/uploads/custom_prod_img/thumbnail/';
			@unlink($path.$images->main_image);
			@unlink($thumb_path.$images->main_image);
		}
		$this->superadmin_model->delete('products',array('id'=>$product_id));
		$this->session->set_flashdata('success_msg',"Product has been deleted successfully.");
			redirect('superadmin/store_custom_product');
	}

	public function custom_product_status($product_id, $val){
		$this->superadmin_model->update('products', array('custom_product_status' => $val), array('id' => $product_id));
		if($val == 1)
			$this->session->set_flashdata('success_msg', 'Product approved successfully.');
		else
			$this->session->set_flashdata('success_msg', 'Product blocked successfully.');
		redirect('superadmin/products');
					
	}

	public function download_design($design_id=""){
		
		$design = $this->superadmin_model->get_row('design', array('id' => $design_id));

		if(!$design || empty($design_id)){
			$this->session->set_flashdata('error_msg', 'No design found.');
			redirect('superadmin/designs');
		}

		if(!empty($design->design_image))
		{
			$pth    =   file_get_contents(base_url()."assets/uploads/designs/".$design->design_image);
			$nme    =   date('Ymdhis').$design->design_image;
			force_download($nme, $pth);
		}
	}

	public function product_cleanup(){

		$products = $this->superadmin_model->get_result('products', array('is_customized' => 1, 'product_status' => 0, 'is_purchased' => 0));

		if ($products){

			foreach ($products as $prod) {

				$del = $this->superadmin_model->delete('products',array('id' => $prod->id, 'is_customized' => 1, 'product_status' => 0, 'is_purchased' => 0));

				if ($del) {

					$path='./assets/uploads/test/';

					if(!empty($prod->main_image)){

						@unlink($path.'temp/'.$prod->main_image);

						@unlink($path.'thumbnail/'.$prod->main_image);

					}

					if(!empty($prod->back_image)){

						@unlink($path.'temp/'.$prod->back_image);

						@unlink($path.'thumbnail/'.$prod->back_image);

					}

				}

			}

		}else{

			$this->session->set_flashdata('error_msg', 'No product found.');

			redirect('superadmin/products');

		}

		$this->session->set_flashdata('success_msg', 'Cleanup completed successfully.');

		redirect('superadmin/products');
		
	}

	public function page_content($slug=''){
		$this->check_login();
		if($slug != "tc" && $slug !="pp")
		redirect('superadmin');
		if($slug == "tc") { $id=1; }
		if($slug == "pp") { $id=2; }
		$this->form_validation->set_rules('content', 'Page Content', 'required');							

		if ($this->form_validation->run() == TRUE)
		{				
			$content = array(
				'content'		=>	$this->input->post('content'),	
				'updated' 		=>	time()		
			);
			$this->superadmin_model->update('page_content',$content,array('id'=>$id));
			if($id==1)
			{	
			$this->session->set_flashdata('success_msg',"Terms & Conditions have been updated successfully.");
			}
			else
			{	
			$this->session->set_flashdata('success_msg',"Private Policies have been updated successfully.");
			}
			redirect('superadmin/page_content/'.$slug);
		}
		$data['content'] = $this->superadmin_model->get_row('page_content',array('id'=>$id));
		$data['template'] = 'superadmin/page_content';
        $this->load->view('templates/superadmin_template', $data);	
	}

	public function download_custom_image($image=''){
	    $imagefile='assets/uploads/test/custom_uploads/'.$image;
	    if(file_exists($imagefile)){
	      $data = file_get_contents($imagefile); // Read the file's contents
	      $name = $image;
	      force_download($name, $data);
	    }else{
	      exit('Invalid File.');
	    }
  }

  public function design_seller($offset = 0){
		$this->check_login(); 		
		// $fname = $this->session->userdata('fname_val_for_store_admins');
		// $lname = $this->session->userdata('lname_val_for_store_admins');
		// $email = $this->session->userdata('email_val_for_store_admins');
		// $user_id = $this->session->userdata('user_id_val_for_store_admins');
		$fname = '';
		$lname = '';
		$email = '';
		$user_id = '';
		if($_POST){
			$fname = $this->input->post('fname');
			//	$this->session->set_userdata('fname_val_for_store_admins', $fname);
			$lname = $this->input->post('lname');
			//	$this->session->set_userdata('lname_val_for_store_admins', $lname);
			$email = $this->input->post('email');
			//	$this->session->set_userdata('email_val_for_store_admins', $email);
			$user_id = $this->input->post('user_id');
			//$this->session->set_userdata('user_id_val_for_store_admins', $user_id);
			$data['fname'] 		= $this->input->post('fname');
			$data['lname'] 		= $this->input->post('lname');
			$data['email'] 		=  $this->input->post('email');
			$data['user_id'] 	= $this->input->post('user_id');
		}
		$limit=20;
		$data['design_seller']=$this->superadmin_model->design_seller($limit, $offset, $fname, $lname, $email, $user_id);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/design_seller/';
		$config['total_rows'] = $this->superadmin_model->design_seller(0, 0, $fname, $lname, $email, $user_id);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		// $data['commission'] = $this->superadmin_model->get_admin_commission();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/design_seller';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function edit_design_seller($admin_id=''){
        $this->check_login();   
        if($admin_id =='')
        	redirect('superadmin/design_seller');

        $data['design_seller'] = $this->superadmin_model->get_row('users',array('id'=>$admin_id));
        $data['pay_info'] = $this->superadmin_model->get_row('user_payee_info',array('user_id'=>$admin_id));   
        /*print_r($data['design_seller']);
        die();            
*/
        if($this->input->post('email') !=""){
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');           
        }
        if(!empty($_POST))
        {

        $this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_is_email_unique['.$data['design_seller']->email.']');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');      
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zip', 'Zip', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_message('is_natural_no_zero', 'Please enter valid value');
        //$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');               
        if ($this->form_validation->run() == TRUE){
            $user=array(               
                'firstname'	=>	$this->input->post('firstname'),
                'lastname'	=>	$this->input->post('lastname'),               
                'mobile'	=>	$this->input->post('mobile'),
                'address'		=>		$this->input->post('address'),	
				'city'			=>		$this->input->post('city'),	
				'state'			=>		$this->input->post('state'),	
				'zip'			=>		$this->input->post('zip'),	
				'country'		=>		$this->input->post('country'),
				'modified' 		=>		date('Y-m-d')
                );
                if($this->input->post('email') !="")
                {
                    $user['email']=$this->input->post('email');
                }
                $store_name = '';
            $this->superadmin_model->update_store_user($user,$store_name,$admin_id);       
            $this->session->set_flashdata('success_msg',"Design seller updated successfully.");
            redirect('superadmin/design_seller');
        }
    }
   		 $data['state']=$this->superadmin_model->get_result('state');
        $data['template'] = 'superadmin/edit_design_seller';
        $this->load->view('templates/superadmin_template', $data);
    }

public function delete_design_seller($admin_id=''){				
		$this->check_login();
		if(empty($admin_id)) redirect('superadmin/design_seller');

		$this->superadmin_model->delete('users', array('id'=> $admin_id));		
		$this->session->set_flashdata('success_msg',"Design seller has been deleted successfully.");
		redirect('superadmin/design_seller');
	}
	public function best_seller($offset = 0){
		$this->check_login(); 		
		
		$limit=20;
		$data['best_seller']=$this->superadmin_model->best_seller($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/best_seller/';
		$config['total_rows'] = $this->superadmin_model->best_seller(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/best_seller';
        $this->load->view('templates/superadmin_template', $data);
	}
	public function best_sell_image($str){			
		if(!empty($_FILES['best_sell_image']['name'])):
			if($this->session->userdata('best_sell_image')){				
				return TRUE;
			}else{
				$param=array(
					'file_name'	=>'best_sell_image',
					'upload_path'  => './assets/uploads/best_sell_image/',
					'allowed_types'=> 'gif|jpg|png|jpeg',
					'image_resize' => TRUE,
					'source_image' => './assets/uploads/best_sell_image/',
					'new_image'	   => './assets/uploads/best_sell_image/thumb/',
					'encrypt_name' => TRUE,
					);
			
				$upload_file=upload_file($param);
				if($upload_file['STATUS']){
					$this->session->set_userdata('best_sell_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));			
					return TRUE;		
				}else{			
					$this->form_validation->set_message('best_sell_image', $upload_file['FILE_ERROR']);				
					return FALSE;
				}
			}
		endif;				
	}
	public function add_edit_best_seller($seller_id=''){
        $this->check_login();   
       if(!empty($_FILES['best_sell_image']['name'])){
         $this->form_validation->set_rules('best_sell_image', 'Best Seller Design', 'callback_best_sell_image');
        }
         $this->form_validation->set_rules('best_sell_link', 'Design Link', 'required');
           
        if ($this->form_validation->run() == TRUE){
        	if($this->session->userdata('best_sell_image')!=''):	
        		$query=$this->superadmin_model->get_row('best_seller',array('id'=>$seller_id));
				$filepath=$query->file_path;
				if(!empty($filepath)) unlink($filepath);
				$thumbfilepath=$query->thumb_image;	
				if(!empty($thumbfilepath)) unlink($thumbfilepath);
					
				$best_sell_image=$this->session->userdata('best_sell_image');
				$data['file_path'] = $best_sell_image['image'];  
				$data['thumb_image'] = $best_sell_image['thumb_image'];	
			endif;
                $data['best_sell_title'] =	$this->input->post('best_sell_title');
                $data['best_sell_link'] =	$this->input->post('best_sell_link');               
               	$data['created'] = date('Y-m-d');
               
		$msg='';
            if(!empty($seller_id)) {
            	$this->superadmin_model->update('best_seller',$data, array('id'=>$seller_id));       
            	$msg='Best Seller Design Updated Successfully.';
            }else{
            	$this->superadmin_model->insert('best_seller',$data);       
            	$msg='New Best Seller Design Added Successfully.';
            } 
            if($this->session->userdata('best_sell_image')):
					$this->session->unset_userdata('best_sell_image');
				endif;  
            $this->session->set_flashdata('success_msg',$msg);
            redirect('superadmin/best_seller');
        }
  		if(!empty($seller_id)){
   		$data['best_sell']=$this->superadmin_model->get_row('best_seller', array('id'=>$seller_id));
  		}
        $data['template'] = 'superadmin/add_edit_best_seller';
        $this->load->view('templates/superadmin_template', $data);
    }
    public function delete_best_seller($seller_id=''){				
		$this->check_login();
		if(empty($seller_id)) redirect('superadmin/best_seller');
		$data['img']=$this->superadmin_model->get_row('best_seller',array('id'=>$seller_id));
		$filepath=$data['img']->file_path;
		if(!empty($filepath)) unlink($filepath);
		$thumbfilepath=$data['img']->thumb_image;	
		if(!empty($thumbfilepath)) unlink($thumbfilepath);
		$this->superadmin_model->delete('best_seller', array('id'=> $seller_id));		
		$this->session->set_flashdata('success_msg',"Best Seller has been deleted successfully.");
		redirect('superadmin/best_seller');
	}
	
	function update_best_selling($status="")	{
		$this->check_login(); //check login authentication
		
		if($status==0){
		$userstatus=1;
		}
		if($status==1){
		$userstatus=0;
		}
		
		$data=array('status'=>$userstatus);
		$selling_detail = $this->superadmin_model->get_row('best_seller',array('status'=>$status));
		if($selling_detail->status==1){
			if($this->superadmin_model->update('best_seller',$data,array('status'=>$status)))
			{
			$this->session->set_flashdata('success_msg',"Best Selling Product Show Successfully on Home page.");
		redirect('superadmin/best_seller');
			}
		}else if($selling_detail->status==0){
			if($this->superadmin_model->update('best_seller',$data,array('status'=>$status)))
			{
			$this->session->set_flashdata('success_msg',"Best Selling Product Hide Successfully on Home page.");
			redirect('superadmin/best_seller');	
			}
		}
	}
	public function user_pay_request_bank($offset=0)
	{
		$this->check_login();
		$limit=50;
		$data['pay_request'] = $this->superadmin_model->user_pay_request_bank($limit, $offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/user_pay_request_bank/';
		$config['total_rows'] = $this->superadmin_model->user_pay_request_bank(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/user_pay_request_bank';
        $this->load->view('templates/superadmin_template', $data);
	}
	public function user_pay_request_cheque($offset=0)
	{
		$this->check_login();
		$limit=50;
		$data['pay_request'] = $this->superadmin_model->user_pay_request_cheque($limit, $offset);
		$config= get_pagination_style();
		$config['base_url'] = base_url().'superadmin/user_pay_request_cheque/';
		$config['total_rows'] = $this->superadmin_model->user_pay_request_cheque(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$offset++;
		$data['offset'] = $offset;
		$data['template'] = 'superadmin/user_pay_request_cheque';
        $this->load->view('templates/superadmin_template', $data);
	}
	public function pay_to_users_cheque_bank($type){
		$this->check_login();
		$user_ids = $this->input->post('user_id');

		foreach ($user_ids as $value) {
			$data_find=array('user_id' => $value,
						'pay_status'=>0, );
			$user_info=$this->superadmin_model->get_row('commission_request',$data_find);

			$data=array(
			'last_paid_com' => $user_info->unpaid_com,
			'pay_status'=>1,
			'unpaid_com'=>0,
			'total_paid_com'=> $user_info->unpaid_com + $user_info->last_paid_com,
			'payment_method'=>$type,
			'payment_date'=>date('Y-m-d H:i:s'),
			 );
			$this->superadmin_model->update('commission_request', $data, $data_find);
		}
		$this->session->set_flashdata('success_msg', 'Payment completed for the selected user.');
		redirect('superadmin/user_pay_request');
	}

	function barcode($id) {
		$this->check_login();
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		$test = Zend_Barcode::draw('code128', 'image', array('text' =>$id), array());
		// var_dump($test);
		imagejpeg($test,'assets/barcode/'. $id.'.jpg', 150);
		}

	public function order_pdf($order_id){
		$this->check_login();
		//$this->check_login();
			if($order = $this->superadmin_model->order_user_info($order_id)){
			$oid = $order->id;
			$data['order_user_info'] = $order;
			$this->barcode($data['order_user_info']->order_id);
			$data['order_info'] = $this->superadmin_model->order_info($order_id);		
    		$file=$this->load->view('superadmin/order_pdf_genrate',$data,TRUE);
			$stylesheet = file_get_contents('assets/pdf.css');
			$stylesheet = file_get_contents('assets/pdfclient.css');
    		$this->load->library('mpdf');        
        	$this->mpdf->WriteHTML($file);
		 	$this->mpdf->Output('ShirtScore-'.date('YmdHis').'.pdf','D');
		}
		else{
			 $this->session->set_flashdata('error_msg', 'Invalid order ID');
			 redirect('user/orders');
		}
	}
	

	public function order_pdf_pro($order_id){
		$this->check_login();
		//$this->check_login();
			if($order = $this->superadmin_model->order_user_info($order_id)){
			$oid = $order->id;
			$data['order_user_info'] = $order;
			$this->barcode($data['order_user_info']->order_id);
			$data['order_info'] = $this->superadmin_model->order_info($order_id);		
    		$file=$this->load->view('superadmin/order_pdf_genrate_cus',$data,TRUE);
			$stylesheet = file_get_contents('assets/pdfclient.css');
    		$this->load->library('mpdf');        
        	$this->mpdf->WriteHTML($file);
		 	$this->mpdf->Output('ShirtScore-'.date('YmdHis').'.pdf','D');
		}
		else{
			 $this->session->set_flashdata('error_msg', 'Invalid order ID');
			 redirect('user/orders');
		}
	}
	public function download_text($order_id){
		$this->check_login();
		$data['order_info'] = $this->superadmin_model->get_result('order_items',array('id'=>$order_id));
		//print_r($data['order_info']);
		$file=$this->load->view('superadmin/order_text',$data,TRUE);
		$stylesheet = file_get_contents('assets/pdf.css');
		$this->load->library('mpdf');        
    	$this->mpdf->WriteHTML($file);
	 	$this->mpdf->Output('ShirtScore-Text'.$order_id.'.pdf','D');
	}

	public function download_zip($idd,$order_id){
		$this->check_login();
		
		}


	public function order_pdf_zip($order_id){
			$this->check_login();
			$order = $this->superadmin_model->order_user_info($order_id);
			$oid = $order->id;
			$data['order_user_info'] = $order;
			$this->barcode($data['order_user_info']->order_id);
			$data['order_user_info'] = $order;
			$data['order_info'] = $this->superadmin_model->order_info($order_id);		
    		$file=$this->load->view('superadmin/order_pdf_genratecus',$data,TRUE);
			$stylesheet = file_get_contents('assets/pdf.css');
			$stylesheet = file_get_contents('assets/pdfclient.css');
    		$mpdf=new mPDF('c','A4');
			$mpdf->SetImportUse();
        	$mpdf->WriteHTML($file);
        	return $mpdf->Output('','S');	       	
		}
	

	public function order_pdf_pro_zip($order_id){
			$this->check_login();
			$order = $this->superadmin_model->order_user_info($order_id);
			$oid = $order->id;
			$data['order_user_info'] = $order;
			$this->barcode($data['order_user_info']->order_id);
			$data['order_info'] = $this->superadmin_model->order_info($order_id);		
    		$file=$this->load->view('superadmin/order_pdf_genrate_cus',$data,TRUE);
			$stylesheet = file_get_contents('assets/pdfclient.css');
    		$mpdf1=new mPDF('');
			$mpdf1->SetImportUse(); 
        	$mpdf1->WriteHTML($file);
        	return $mpdf1->Output('','S'); 
		}

	public function download_text_zip($order_id){
		$data['order_info'] = $this->superadmin_model->get_result('order_items',array('id'=>$order_id));
		$file=$this->load->view('superadmin/order_text',$data,TRUE);
		$stylesheet = file_get_contents('assets/pdf.css');
		$mpdf2=new mPDF('');
		$mpdf2->SetImportUse(); 
    	$mpdf2->WriteHTML($file);
	 	return $mpdf2->Output('','S'); 
	}

		function merge_text($id){
			$this->check_login();
	   $order_info = $this->superadmin_model->get_result('order_items',array('order_id'=>$id));
	   foreach ($order_info as $row){
		$order = $this->superadmin_model->get_row('orders',array('id'=>$row->order_id));
		$product = $this->superadmin_model->get_row('products',array('id'=>$row->product_id));
		$text_info = unserialize($product->texts);

		if(!empty($text_info)){
			$i=1;
			foreach ($text_info as $row2) {
				header("Content-type: image/png");
			    $im=$order->order_id.'_'.$i;
			    // header("Pragma: public");
			    // header("Expires: 0");
			    // header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
			    // header("Content-Type: application/force-download");
			    // header("Content-Type: application/octet-stream");
			    // header("Content-Type: application/download");
			    // header("Content-Disposition: attachment;filename=".$im.".png");
			    // header("Content-Transfer-Encoding: binary ");
			     $font = 300;
			    $string = $row2['text'];
			    $im = @imagecreatetruecolor(strlen($string) * $font , $font);
			    imagesavealpha($im, true);
			    imagealphablending($im, false);
			    $white = imagecolorallocatealpha($im, 255, 255, 255, 127);
			    imagefill($im, 0, 0, $white);

			     $hex = str_replace("#", "", $row2['color']);
			       if(strlen($hex) == 3) {
			          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
			       } else {
			          $r = hexdec(substr($hex,0,2));
			          $g = hexdec(substr($hex,2,2));
			          $b = hexdec(substr($hex,4,2));
			       }

			    $lime = imagecolorallocate($im, $r,$g,$b);
			    $font_type='assets/fonts/'.$row2['font'].'.ttf';
			    imagettftext($im, $font, 0, 0, $font - 3, $lime, $font_type, $string);
			   // header("Content-type: image/png");
			    imagepng($im,'assets/text/'.$order->order_id.'_'.$i.'.png');
			    imagedestroy($im);
			    $i++;
		  }
		 }
		}
	}

	function merge_text_i($id,$product_id){
	$this->check_login();
	
	$this->load->library('zip');
	 
	   $order_info = $this->superadmin_model->get_row('order_items',array('order_id'=>$id));
	  
		$order = $this->superadmin_model->get_row('orders',array('id'=>$order_info->order_id));
		$product = $this->superadmin_model->get_row('products',array('id'=>$product_id));
		$text_info = unserialize($product->texts);

		if(!empty($text_info)){
			$i=1;
			foreach ($text_info as $row2) {
				header("Content-type: image/png");
			    $im=$order->order_id.'_'.$i;
			    $font = 300;
			    $string = $row2['text'];
			    $im = @imagecreatetruecolor(strlen($string) * $font , $font);
			    imagesavealpha($im, true);
			    imagealphablending($im, false);
			    $white = imagecolorallocatealpha($im, 255, 255, 255, 127);
			    imagefill($im, 0, 0, $white);

			     $hex = str_replace("#", "", $row2['color']);
			       if(strlen($hex) == 3) {
			          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
			       } else {
			          $r = hexdec(substr($hex,0,2));
			          $g = hexdec(substr($hex,2,2));
			          $b = hexdec(substr($hex,4,2));
			       }

			    $lime = imagecolorallocate($im, $r,$g,$b);
			    $font_type='assets/fonts/'.$row2['font'].'.ttf';
			    imagettftext($im, $font, 0, 0, $font - 3, $lime, $font_type, $string);
			    header("Content-type: image/png");
			    imagepng($im,'assets/text/'.$order->order_id.'_'.$i.'.png');
			    imagedestroy($im);
			   	 $this->zip->read_file('assets/text/'.$order->order_id.'_'.$i.'.png');
	 			$i++;
		 	}
		 	$this->zip->download('ShirtScore_text.zip');
		  	$this->parser->parse('merge_text_i', $data); 
		  	$this->zip->archive('my_photo.zip');
			}
			
	}
	
function merge_text_ii($order_id='6'){
	
	$this->load->library('zip');
	$data['order_info'] = $this->superadmin_model->order_info($order_id);

			foreach($data['order_info'] as $row)
			{    
				$cart_detail = json_decode($row->cart_detail);			
					if(!empty($cart_detail->options->Product_id)) 
						$custom_uplaod_img=get_custom_uplaod_img_from_product($cart_detail->options->Product_id); 

					if(!empty($custom_uplaod_img)){
						$texts=unserialize($custom_uplaod_img->texts);

					if(!empty($texts) && is_array($texts)){
						$text=$this->merge_text($order_id);
						$lp=1;
						print_r($texts);
						die();
						foreach ($texts as $row8) {							
						  $img_f='assets/text/'.$value.'_'.$lp.'.png';
						
			 			$this->zip->read_file($img_f);
						 $lp++;}
					}
				}

				$this->zip->download('ShirtScore.zip');
		}

	}
}

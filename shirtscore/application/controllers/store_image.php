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
		$this->check_login();
		$data['template'] = 'superadmin/dashboard';
  		$this->load->view('templates/superadmin_template', $data);			
	}

	public function login(){
		if(superadmin_login_in()===TRUE)
			redirect('superadmin');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');				
		if ($this->form_validation->run() == TRUE){
			$this->load->model('login_model');
			$status=$this->login_model->login($this->input->post('email'),$this->input->post('password'),0);	
			if($status)
				redirect('superadmin/index');
			else
				redirect('superadmin/login');
		}		
		$this->load->view('superadmin/login');					
	}

	public function logout(){
	 	$this->session->set_userdata('superadmin_info','');
	 	$this->session->unset_userdata('superadmin_info');
	 	redirect('superadmin');
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
		$this->form_validation->set_rules('zip', 'zip', 'required');						
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
			$this->session->set_flashdata('success_msg', 'profile successfully updated');
			redirect(current_url(),'refresh');			
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
	        		$this->session->set_flashdata('error_msg', 'Invalid Old Password');
	        		redirect('superadmin/change_password');
	        	}else{
	        		$password = array(
	      			  	'password' => sha1($this->input->post('password')),
	        					);
	        		}

        	 }
			$this->superadmin_model->update('users', $password, array('id' => $info['id']));
			$this->session->set_flashdata('success_msg', 'password successfully updated');
			redirect(current_url(),'refresh');
		}

		$data['template'] = 'superadmin/change_password';
		$this->load->view('templates/superadmin_template', $data);

	}


	public function stores($offset = 0){
		$this->check_login(); 		
		$limit=10;
		$data['stores']=$this->superadmin_model->stores($limit, $offset);
		$config= get_pagination_style();	
		$config['base_url'] = base_url().'superadmin/stores/';
		$config['total_rows'] = $this->superadmin_model->stores(0, 0);
		$config['per_page'] = $limit;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();

		$data['template'] = 'superadmin/stores';
        $this->load->view('templates/superadmin_template', $data);	
	}

	public function add_store(){
		$this->check_login(); 		
		$this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'phone', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');		
		$this->form_validation->set_rules('store_name', 'Store Name', 'required');
		$this->form_validation->set_rules('store_description', 'Store description', 'required');	
		if ($this->form_validation->run() == TRUE){

			// print_r($_FILES);
			// print_r($_POST); die();

			$user=array(
				'user_role' =>2,
				'firstname'=>$this->input->post('firstname'),
				'lastname'=>$this->input->post('lastname'),
				'email'=>$this->input->post('email'),
				'mobile'=>$this->input->post('phone'),
				'password'=>sha1(trim($this->input->post('password'))),				
				'created' => date('Y-m-d')
				);

			$user_id=$this->superadmin_model->insert('users',$user);

			$store=array(
				'user_id' => $user_id,				
				'store_name'=>$this->input->post('store_name'),
				'store_description'=>$this->input->post('store_description'),
				'created' => date('Y-m-d')
				);

			if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('superadmin/add_store/');
				}else{
					$store['store_banner']=$do_upload['upload_data']['file_name'];
				}
			}

			$user_id=$this->superadmin_model->insert('stores',$store);
			$this->session->set_flashdata('success_msg',"Store has been added successfully.");
			redirect('superadmin/stores');
		}

		$data['template'] = 'superadmin/add_store';
        $this->load->view('templates/superadmin_template', $data);		
	}

	public function edit_store($store_id){
		$this->check_login(); 	
		$data['store'] = $this->superadmin_model->get_store($store_id);
		// echo $data['store']->user_id; die();
		$this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');				
		$this->form_validation->set_rules('phone', 'phone', 'required');
		$this->form_validation->set_rules('phone','phone_no','required');
		$this->form_validation->set_rules('store_description', 'Store description', 'required');
		$this->form
		if ($this->form_validation->run() == TRUE){

			$user=array(				
				'firstname'=>$this->input->post('firstname'),
				'lastname'=>$this->input->post('lastname'),				
				'mobile'=>$this->input->post('phone'),								
				);

			$this->superadmin_model->update('users',$user, array('id'=>$data['store']->user_id));

			$store=array(				
				'store_name'=>$this->input->post('store_name'),
				'store_description'=>$this->input->post('store_description'),
				'created' => date('Y-m-d')
				);

			if($_FILES['userfile']['name']!=''){				
				$do_upload = $this->do_upload();			
				if($do_upload['status']==FALSE){
					$this->session->set_flashdata('image_error'.$do_upload['error']);
					redirect('superadmin/add_store/');
				}else{
					$store['store_banner']=$do_upload['upload_data']['file_name'];
				}
			}

			$this->superadmin_model->update('stores',$store, array('id'=>$store_id));
			$this->session->set_flashdata('success_msg',"Store has been updated successfully.");
			redirect('superadmin/stores');

		}


		$data['template'] = 'superadmin/edit_store';
        $this->load->view('templates/superadmin_template', $data);
	}

	public function delete_store($store_id){
		$data['store'] = $this->superadmin_model->get_store($store_id);
		$this->superadmin_model->delete('stores', array('id'=> $store_id));
		$this->superadmin_model->delete('users', array('id'=> $data['store']->user_id));		
		$this->session->set_flashdata('success_msg',"Store has been deleted successfully.");
		redirect('superadmin/stores');
	}

	public function suspend_store($store_id, $val){
		$this->check_login(); 	
		$this->superadmin_model->update('stores', array('is_blocked'=> $val), array('id' => $store_id));		
		if($val == 0){
		$this->session->set_flashdata('success_msg', 'Store successfully blocked');
		}
		if($val == 1){
		$this->session->set_flashdata('success_msg', 'Store unblocked successfully');
		}
		redirect('superadmin/stores');
	}

	public function approved_store($store_id){
		$this->check_login(); 	
		$this->superadmin_model->update('stores', array('status'=> 1), array('id' => $store_id));		
		$this->session->set_flashdata('success_msg', 'Status successfully changed');
		redirect('superadmin/stores');
	}

	public function do_upload(){
	
		$config['upload'] = '';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$this->load->library('upload', $config);
		if 
		( ! $this->upload->do_upload()){
			return array('status'=> FALSE,'error' => $this->upload->display_errors());			
		}
		else{
			return array('status'=> TRUE,'upload_data' => $this->upload->data());			
		}
	}

	public function remove_image($store_id){
		$query = $this->superadmin_model->get_row('stores', array('id'=>$store_id));
		if(!empty($query->store_banner)){
			$path = "assets/uploads/";
			unlink($path.$query->store_banner);
			$this->superadmin_model->update('stores', array('store_banner' => ""), array('id' => $store_id));
			echo "done";
		}
		public function upload_work()
		{
			if(!empty($query-$store_banner_id))
			{
				$this->check_login(); 	
		$this->superadmin_model->update('stores', array('status'=> 1), array('id' => $store_id));		
		$this->session->set_flashdata('success_msg', 'Status successfully changed');
		redirect('stores');
		$this->superadmin_model->insert('this',$this );
		$this->store[
	}
		}
	}
}/* End of file superadmin.php */

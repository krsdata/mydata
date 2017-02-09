<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();        
        if(superadmin_logged_in()==FALSE)
         {
          redirect('backend/login'); 
         }
     
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
	}

	
	public function index()
    {	
       $data['page_title'] = 'Dashboard :: Admin Panel';	
       $this->load->view('templates/backend/header',$data);
       $this->load->view('backend/dashboard',$data);
       $this->load->view('templates/backend/footer',$data);  

	}
 
    public function change_password()
    {  
        $data['page_title'] = 'Dashboard :: Admin Panel'; 
        $data['functionname'] = 'changepassword';
        $data['boxtitle'] = array('add'=>'Change password');// box titles arrray	
        $user_id = $this->session->userdata('admin_id');   
        $this->load->view('templates/backend/header',$data);
        if($this->form_validation->run('changePassword')==FALSE)
        {	 
          $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
          $this->load->view('backend/changepassword',$data);

      	}
      	else
        {
          $oldpassword=$this->input->post('oldpassword');
          $retypepassword=$this->input->post('retypepassword');
          $where=array('password'=>md5($oldpassword),'id'=>$user_id);
          $res=$this->Admin_model->getColumnDataWhere('users','password',$where,'','');
          if(count($res)>0)
          {
             $this->Admin_model->update_data('users',array('password' =>md5($retypepassword)),array('id' =>$user_id));	
             $this->session->set_flashdata('msg_success', 'Password changed successfully.');
             redirect('backend/superadmin/change_password');
          }
          else
          {
            $this->session->set_flashdata('msg_error', 'Wrong old password.');
            redirect('backend/superadmin/change_password');
          }	            
              
              
      	}

       $this->load->view('templates/backend/footer',$data);	
    }
   

    public function profile()
    {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $data['functionname'] = 'profile';
      $data['boxtitle'] = array('add'=>'Edit Profile');// box titles arrray  
      $user_id = $this->session->userdata('admin_id');   
      $this->load->view('templates/backend/header',$data);

      $where=array('id'=>$user_id);
      $data['update']=$this->Admin_model->getColumnDataWhere('users',' ',$where,'','');
      
         
 
        if($this->form_validation->run('editmyprofile')==FALSE)
        {  
          $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
          $this->load->view('backend/profile',$data);
        }
        else
        {
          $dataup['first_name']=$this->input->post('first_name');
          $dataup['last_name']=$this->input->post('last_name');
          $dataup['email']=$this->input->post('email');

          $where=array('email'=>$dataup['email'],'id !='=>$user_id);
          $res=$this->Admin_model->getColumnDataWhere('users','id',$where,'','');
          if(count($res)==0)
          {
             $this->Admin_model->update_data('users',$dataup,array('id' =>$user_id));  
             $this->session->set_flashdata('msg_success', 'Profile updated successfully.');
             redirect('backend/superadmin/profile');
          }
          else{
            $this->session->set_flashdata('msg_error', 'Email already exist.');
            redirect('backend/superadmin/profile');
          } 
        }

       $this->load->view('templates/backend/footer',$data);  
    }
         

	public function logout(){
			$this->session->sess_destroy();
		  redirect('backend/login');
	}

}

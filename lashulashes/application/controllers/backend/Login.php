<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
 	{
 		
        parent::__construct();
         
         if(superadmin_logged_in()==TRUE)
         {
          redirect('backend/superadmin'); 
         }
			   
	}

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
    	$data['labelmessage']="Enter Email and password.";
		if($this->form_validation->run('login')==FALSE)
		{
			$this->form_validation->set_error_delimiters('<div class="form_error">','</div>');		
		    $this->load->view('backend/login',$data);
	    }
	    else{
             $email=$this->input->post('username');
             $password=$this->input->post('password');
             $where= array('email' =>$email,'password'=>md5($password));

              $res=$this->Admin_model->getColumnDataWhere('users','',$where,'','');
              if(count($res)>0)
              {
                $this->session->set_flashdata('message', 'Login successfully.');
                $this->session->set_userdata(array('admin_name'=>$res[0]->user_name,'admin_id'=>$res[0]->id,'admin_role'=>0,'admin_logged_in'=>TRUE));
				redirect('backend/superadmin');
                
              } 
              else{

              	$data['labelmessage'] = "Invalid Email/Password"; 
    			$this->session->set_flashdata('msg_error', 'Invalid Email/Password.');

                $this->load->view('backend/login',$data);
              }
             
        
	        }
	}
}

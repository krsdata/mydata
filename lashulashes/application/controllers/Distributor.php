<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        $this->load->model('webs_model');
        $this->load->model('products_model'); 
	}

	
	public function index()
  {
    $this->login();
       	 
	}

  public function login()
  {
    if(distributor_logged_in()) redirect('distributor/profile');
    //$data['labelmessage']="Enter Email and password.";
    if($this->form_validation->run('customer')==FALSE)
    {
      $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');   
      //$this->load->view('distributor/others/login',$data);
      $data['template'] = 'distributor/login';
      $this->load->view('templates/frontend/layout', $data);
    }
    else
    {
       $email    = $this->input->post('email');
       $password = $this->input->post('pwd');
       $where    = array('email' =>$email,'password'=>md5($password),'user_role'=>2);

        $res=$this->Admin_model->getColumnDataWhere('users','',$where,'','');
        /*echo $this->db->last_query();
        print_r($res);
        die();*/
        if(count($res)>0)
        {
          if($res[0]->status==1)
          {
              //$this->session->set_flashdata('msg_success', 'Login successfully.');
              $this->session->set_userdata(array('distributor_name'=> $res[0]->first_name.' '.$res[0]->last_name,'id'=>$res[0]->id,'distributor_role'=>2,'distributor_logged_in'=>TRUE,'distributor_image'=>$res[0]->image));
              redirect('distributor/profile');
          }
          else
          {
              $this->session->set_flashdata('msg_info', 'Your account not activated yet.');
              redirect('distributor/login');
          }
        } 
        else{

           $this->session->set_flashdata('msg_error', 'Invalid Email Or Password.');
           //$data['labelmessage'] = "Invalid Email/Password";  
           redirect('distributor/login');
        }
    }    
  }


	public function activation($key='')
  {
		if($key=="" || $key==NULL)
    {
			redirect('distributor/registration');
		}

    $where= array('secret_key' =>trim($key),'status'=>0,'user_role'=>2);
    $res=$this->Admin_model->getColumnDataWhere('users','id',$where,'','');

		if(count($res)>0)
    {
      $user = $res[0];		
			$user_data=array('status'=>1,'secret_key'=>'');
			$this->Admin_model->update_data('users',$user_data,array('id'=>$user->id));	

      $this->session->set_flashdata('msg_success', 'Account activated successfully. Please login');	
			redirect('distributor/login');
		}
		else
    {
			redirect('distributor/registration');
		}
	}

  public function forget($key='')
  {
        if($key=="" || $key==NULL){
          redirect('distributor/registration');
        }

        $where= array('new_password_key' =>trim($key),'status'=>1,'user_role'=>2);
        $res=$this->Admin_model->getColumnDataWhere('users','id',$where,'','');

        if(count($res)>0)
        {  
          $user = $res[0];
          $data['user_id'] = $user->id;    
          $user_data=array('status'=>1,'new_password_key'=>'');
          $this->Admin_model->update_data('users',$user_data,array('id'=>$user->id));      
          $data['template'] = 'distributor/forget_change_pass';
          $this->load->view('templates/frontend/layout', $data);           
        }
        else
        {
          redirect('distributor/registration');
        }
  }

  //use for changing forget password on email link
  public function change_password()
  {
      //if(!distributor_logged_in()) redirect('distributor/login');
      if($_POST)
      { 
          if($this->form_validation->run('change_password')==FALSE)
          {    
              $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');
              $data['template'] = 'distributor/forget_change_pass';
              $this->load->view('templates/frontend/layout', $data);
          }
          else
          {
            $user_id =  $this->input->post('user_id');
            $password = $this->input->post('npwd',TRUE);
            if($this->Common_model->update('users',array('password'=>md5($password)),array('id'=>$user_id,'user_role'=>2)))
            {
              $this->session->set_flashdata('msg_success', 'Password changed successfully. Please login');
              //echo md5($password);
              redirect('distributor/login');
            }
            else
            {
              $this->session->set_flashdata('msg_error', 'Password changed failed. Please try again');
              redirect('distributor/forget_password');
            }
          }
      }
      else
      {
        redirect('distributor/registration');
      }
  }



  public function forget_password()
  {
    if(distributor_logged_in()) redirect('distributor/profile');
    //$data['labelmessage']="Enter Email and password.";
    if($this->form_validation->run('forget_password')==FALSE)
    {
        $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>'); 
        $data['template'] = 'distributor/forget';
        $this->load->view('templates/frontend/layout', $data);
    }
    else
    {
      $email = $this->input->post('email');
      if($this->Common_model->get_result('users',array('email'=>$email,'user_role'=>2,'status'=>1)))
      { 
            $secret_key=trim(md5($email));
            $inset['new_password_key'] = $secret_key;
            $this->Common_model->update('users',$inset,array('email'=>$email));
            $this->session->set_flashdata('msg_success', 'Request sent successfully, Confirmation email has been Sent.');
            // mail to user
            $this->load->library('chapter247_email');
            $email_template=$this->chapter247_email->get_email_template(4);

            $param=array(

            'template'  =>  array(
                    'temp'      =>  $email_template->template_body,
                    'var_name'  =>  array(
                                   'activation_key' =>  base_url().'distributor/forget/'.$secret_key,   
                                         ), 
                                  ),      
                    'email'     =>  array(
                                  'to'        =>   $email,
                                  'from'      =>   NO_REPLY_EMAIL,
                                  'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                                  'subject'   =>   $email_template->template_subject,
                                 )
                        );
            $status=$this->chapter247_email->send_mail($param);
            redirect('distributor/forget_password');
      }
      else
      {
       $this->session->set_flashdata('msg_error', 'Your email adderss not found.');
       redirect('distributor/forget_password');
      }
    }

  }

  public function profile()
  {
    if(!distributor_logged_in()) redirect('distributor/login');

    //$data['template'] = 'distributor/profile';
    $data['user_detail']  = $this->Common_model->get_row('users',array('id'=>distributor_id()));
    if(!$data['user_detail']) redirect('distributor/login');
    $data['template'] = 'distributor/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  
  }

  // use for change password by user dashboard
  public function password()
  {
      if(!distributor_logged_in()) redirect('distributor/login');
      $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>distributor_id()));
      if(!$data['user_detail']) redirect('distributor/login');
      if($this->form_validation->run('user_password')==FALSE)
      {
        $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');   
        $data['template'] = 'distributor/dashboard';
        $this->load->view('templates/frontend/layout', $data);
      }
      else
      {
             $user_id       = distributor_id();
             if(!$user_id) redirect('distributor/login');
             $password      = $this->input->post('pwd');
             $new_password  = $this->input->post('npwd');
             $where    = array('id' =>$user_id,'password'=>md5($password),'user_role'=>2);
             if($this->Common_model->get_row('users',$where))
             {
                if($this->Common_model->update('users',array('password'=>md5($new_password)),array('id' =>$user_id)))
                {
                      $this->session->set_flashdata('msg_success', 'Your password changed successfully.');
                      redirect('distributor/password');
                }
                else
                {
                      $this->session->set_flashdata('msg_info','Please try again.');
                      redirect('distributor/password');
                }
             }
             else
             {
                $this->session->set_flashdata('msg_error','Your current password not matched.');
                redirect('distributor/password');
             }
      }
      
  }

  public function update_detail()
  {
      if(!distributor_logged_in()) redirect('distributor/login');

      //$data['template'] = 'distributor/profile';
      $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>distributor_id()));
      if(!$data['user_detail']) redirect('distributor/login');

      if($this->form_validation->run('update_detail_by_user')==FALSE)
      {
        $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>'); 
      }
      else
      {
        $data = array(
                      'first_name' => $this->input->post('first_name'),
                      'last_name'=> $this->input->post('last_name'),
                      'address'=> $this->input->post('address'),
                      'city'=> $this->input->post('city'),
                      'state'=> $this->input->post('state'),
                      'zip'=> $this->input->post('zip'),
                      //'county'=> $this->input->post('county'),
                      'mobile'=> $this->input->post('mobile'),
                      'shipping'=> $this->input->post('shipping'),
                      's_first_name'=> $this->input->post('s_first_name'),
                      's_last_name'=> $this->input->post('s_last_name'),
                      's_email'=> $this->input->post('s_email'),
                      's_address'=> $this->input->post('s_address'),
                      's_city'=> $this->input->post('s_city'),
                      's_state'=> $this->input->post('s_state'),
                      's_zip'=> $this->input->post('s_zip'),
                      //'s_county'=> $this->input->post('s_county'),
                      's_mobile'=> $this->input->post('s_mobile'),
                    );
            $this->Common_model->update('users',$data,array('id'=>distributor_id()));
        $this->session->set_flashdata('msg_success', 'Your address detail changed successfully.');
        redirect('distributor/update_detail');
      }

      $data['template'] = 'distributor/dashboard';
      $this->load->view('templates/frontend/layout', $data);
  
  }

  public function dashboard_image()
  {

        if(!distributor_logged_in()) redirect('distributor/login');

            $config['upload_path']    = './assets/uploads/user/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg';
            $config['max_size']       = 2*1024;
            $config['min_width']      = 150;
            $config['min_height']     = 150;
            $config['max_width']      = 200;
            $config['max_height']     = 200;
            $config['encrypt_name']   = TRUE;

            $this->load->library('upload', $config);
            //$this->upload->initialize($config);

            if ($this->upload->do_upload('fileupload'))
            {
              $upload=$this->upload->data();
              $data = array('image'=> $config['upload_path'].$upload['file_name']);
              if($this->Common_model->update('users',$data,array('id'=>distributor_id())))
              {
                $this->session->set_flashdata('msg_success', 'Your profile image changed successfully.');
                $user_image = $this->session->userdata('user_image');
                if(!empty($user_image) && file_exists($user_image))
                {
                  @unlink($user_image);
                }
                $this->session->set_userdata('user_image',$config['upload_path'].$upload['file_name']);
              }
              else
              {
                 $this->session->set_flashdata('msg_error','Please try again.');
              }

            }
            else
            {
              $this->session->set_flashdata('msg_error', $this->upload->display_errors());
            }
            redirect('distributor/profile');

  }

  public function logout()
  {
    $this->session->sess_destroy();
    //start_session();
    $this->session->set_flashdata('msg_success', 'Log-out successfully.');
    redirect('distributor/login');
  
  }

  public function order_detail($offset=0)
  {
    if(!distributor_logged_in()) redirect('distributor/login');
    $data['user_detail']  = $this->Common_model->get_row('users',array('id'=>distributor_id()));
    if(!$data['user_detail']) redirect('distributor/login');
    $data['offset'] = $offset;
    $per_page =10;
    $data['order_detail'] = $this->Common_model->get_result_pagination('orders',$offset,$per_page,array('distributor_id'=>distributor_id()),array('order_id','desc'));
    
    $config = frontend_pagination();
    $config['base_url']     = base_url().'distributor/order_detail/';
    $config['total_rows']   = $this->Common_model->get_result_pagination('orders',0,0,array('distributor_id'=>distributor_id()),array('order_id','desc'));
    $config['per_page']     = $per_page;
    $config['uri_segment']  = 3;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();

    $data['template'] = 'distributor/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  }







}

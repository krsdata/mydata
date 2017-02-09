<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        $this->load->model('webs_model');
        $this->load->model('products_model');
        $this->load->model('discount_model'); 
			  $this->load->model('orders_model'); 
	}

	
	public function index()
  {
  
   $data['template'] = "frontend/home/index";
   $this->load->view('templates/frontend/layout', $data);
       	 
	}

  /*get aus cities option for all front/back end*/

  public function get_aus_cities($state)
  {
    if(empty($state))
    {
      echo "<option value=''>Select City</option>";
    }
    else
    {
      $city = $this->Common_model->get_result('australia_cities',array('state_code'=>$state));
      if($city)
      { 
        echo "<option value=''>Select City</option>";
        foreach ($city as $city_row) 
        {
          echo "<option value='".$city_row->city_name."'>".$city_row->city_name."</option>";
        }
      }
      else
      {
        echo "<option value=''>Select City</option>";
      }
    }

  }

  public function validate_postcode()
  {
      //postal_code //3626
      //$city = array();
      //$cityCount = 0;
      $state_array = array('ACT','NSW','NT','QLD','SA','TAS','VIC','WA');
      $city = '';
      $state ='';
      $status = 1;
      $code = $_POST['code'];
      $result =  file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$code+AU");
      $result = json_decode($result);
      if($result->status== 'OK')
      {
        if($result->results[0]->address_components[0]->types[0]=='postal_code')
        {
            $status = 1;
            $address_components = $result->results[0]->address_components;
            $components_count = count($address_components);
            $city = $address_components[1]->long_name;
            $state = $address_components[$components_count-2 ]->short_name;
            if(!in_array($state, $state_array))
            {
              $status = 0;
            }  
        }
        else
        {
          $status = 0;
        }
      }

      if($status)
      {
          $data =  array('status'=>1,'city'=>$city,'state'=> $state);
      }
      else
      {
          $data =  array('status'=>0);
      }
      header('Content-Type: application/json');
      $data = json_encode($data);
      echo $data;
  }

  public function test()
  {
    
    $this->load->model('products_model');
    echo "<pre>";
    $list = $this->products_model->product_attribute_details(1);
    echo $list;
    echo "<br>";
    print_r(json_decode($list));

  }

  function login_oo()
  {
      $data['labelmessage']="Enter Email and password.";
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');   

      if($this->form_validation->run('login')==FALSE)
      {
          $data['template'] = 'website/login';
          $this->load->view('templates/frontend/layout', $data);
      }
      else
      {
         $email=$this->input->post('username');
         $password=$this->input->post('password');
         $where= array('email' =>$email,'password'=>md5($password));

          $res=$this->Admin_model->getColumnDataWhere('users','',$where,'','');
          if(count($res)>0)
          {
            $this->session->set_flashdata('message', 'Login successfully.');
            $this->session->set_userdata(array('user_name'=>$res[0]->user_name,'id'=>$res[0]->id,'user_role'=>0));
            redirect('superadmin');
            
          } 
          else{

            $data['labelmessage'] = "Invalid Email/Password";  
             $this->load->view('others/login',$data);
          }
      }
  } 

	function registration()
	{
        if(user_logged_in()) redirect('website/profile');
        //form_carot
        $this->form_validation->set_message('is_unique', 'The {field} address already exists.');    
        if($this->form_validation->run('registration')==FALSE)
        {    
          $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');

          //$this->load->view('website/others/registration');
          $data['template'] = 'website/registration';
          $this->load->view('templates/frontend/layout', $data);

        }
        else
        {
       	  if($this->input->post('submit'))
       	    {  
       	      $inset['first_name']= $this->input->post('fname');
       	      $inset['last_name'] = $this->input->post('lname');
              $inset['abn']       = $this->input->post('abn');
       	      $inset['email']     = $this->input->post('email');
       	      $inset['password']  = md5($this->input->post('pwd'));
       	      $inset['user_role'] = 1;
              $inset['status']    = 0;

       	      $secret_key=trim(md5($this->input->post('email')));
       	      $inset['secret_key']=$secret_key;
       	      $this->Admin_model->insert_data('users',$inset);
       	      $this->session->set_flashdata('msg_success', 'Register successfully, Confirmation email has been Sent.');
              // mail to user
              $this->load->library('chapter247_email');
      				$email_template=$this->chapter247_email->get_email_template(3);

      				$param=array(
          				'template' 	=>	array(
          								'temp'	    => 	$email_template->template_body,
          								'var_name' 	=> 	array(
          												 'user_name'	    =>	ucfirst($inset['first_name']).' '. ucfirst($inset['last_name']),
          												 'activation_key' =>  base_url().'website/activation/'.$secret_key,		
          												               ), 
          				                      ),			
          				'email'	=> 	array(
              						'to' 		=>	 $inset['email'],
              						'from' 		=>	 NO_REPLY_EMAIL,
              						'from_name' =>	 NO_REPLY_EMAIL_FROM_NAME,
              						'subject'	=>	 $email_template->template_subject,
              					)
				      );	
				      $status=$this->chapter247_email->send_mail($param);	
       	      redirect('website/registration'); 
       	    }
            else
            {
              $this->session->set_flashdata('msg_info', 'Please try again.');
              redirect('website/registration');
            }
          
       }
	}


	public function activation($key='')
  {
		if($key=="" || $key==NULL)
    {
			redirect('website/registration');
		}

    $where= array('secret_key' =>trim($key),'status'=>0,'user_role'=>1);
    $res=$this->Admin_model->getColumnDataWhere('users','id',$where,'','');

		if(count($res)>0)
    {
      $user = $res[0];		
			$user_data=array('status'=>1,'secret_key'=>'');
			$this->Admin_model->update_data('users',$user_data,array('id'=>$user->id));	

      $this->session->set_flashdata('msg_success', 'Account activated successfully. Please login');	
			redirect('website/login');
		}
		else
    {
			redirect('website/registration');
		}
	}

  public function forget($key='')
  {
        if($key=="" || $key==NULL){
          redirect('website/login');
        }

        $where= array('new_password_key' =>trim($key),'status'=>1,'user_role'=>1);
        $res=$this->Admin_model->getColumnDataWhere('users','id',$where,'','');

        if(count($res)>0)
        {  
          $user = $res[0];
          $data['user_id'] = $user->id;    
          $user_data=array('status'=>1,'new_password_key'=>'');
          $this->Admin_model->update_data('users',$user_data,array('id'=>$user->id));      
          $data['template'] = 'website/forget_change_pass';
          $this->load->view('templates/frontend/layout', $data);           
        }
        else
        {
          $this->session->set_flashdata('msg_info','These link is expired. Please try again');
          redirect('website/login');
        }
  }

  //use for changing forget password on email link
  public function change_password()
  {
      //if(!user_logged_in()) redirect('website/login');
      if($_POST)
      { 
          if($this->form_validation->run('change_password')==FALSE)
          {    
              $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');
              $data['template'] = 'website/forget_change_pass';
              $this->load->view('templates/frontend/layout', $data);
          }
          else
          {
            $user_id =  $this->input->post('user_id');
            $password = $this->input->post('npwd',TRUE);
            if($this->Common_model->update('users',array('password'=>md5($password)),array('id'=>$user_id,'user_role'=>1)))
            {
              $this->session->set_flashdata('msg_success', 'Password changed successfully. Please login');
              //echo md5($password);
              redirect('website/login');
            }
            else
            {
              $this->session->set_flashdata('msg_error', 'Password changed failed. Please try again');
              redirect('website/forget_password');
            }
          }
      }
      else
      {
        redirect('website/registration');
      }
  }

  public function login()
  {
    if(user_logged_in()) redirect('website/profile');
	  //$data['labelmessage']="Enter Email and password.";
		if($this->form_validation->run('customer')==FALSE)
		{
	    $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');   
      //$this->load->view('website/others/login',$data);
      $data['template'] = 'website/login';
      $this->load->view('templates/frontend/layout', $data);
    }
    else{
           $email    = $this->input->post('email');
           $password = $this->input->post('pwd');
           $where    = array('email' =>$email,'password'=>md5($password),'user_role'=>1);

            $res=$this->Admin_model->getColumnDataWhere('users','',$where,'','');
            /*print_r($res);
            die();*/
            if(count($res)>0)
            {
            	if($res[0]->status==1)
            	{
                  //$this->session->set_flashdata('msg_success', 'Login successfully.');
                  $this->session->set_userdata(array('user_name'=> $res[0]->first_name.' '.$res[0]->last_name,'id'=>$res[0]->id,'user_role'=>1,'logged_in'=>TRUE,'user_image'=>$res[0]->image));
                  if($this->uri->segment(3)!=''){
                    $str = $this->uri->segment(3);
                    $str = base64_decode($str);
                    if(strpos($str,"product_details_") !== false){
                      $id = str_replace('product_details_', '', $str);
                      $detail         = $this->Common_model->get_row('products',array('id'=>$id,'status'=>1));
                      redirect('product/view/'.$detail->slug);
                    }
                    if(strpos($str,"product_page") !== false){
                      redirect('product');
                    }
                  }
                  redirect('website/profile');
              }
              else
              {
                  $this->session->set_flashdata('msg_info', 'Your account not activated yet.');
                  redirect('website/login');
              }
            } 
            else{

               $this->session->set_flashdata('msg_error', 'Invalid Email Or Password.');
            	 //$data['labelmessage'] = "Invalid Email/Password";  
               redirect('website/login');
            }
        }    
  }

  public function forget_password()
  {
    if(user_logged_in()) redirect('website/profile');
    //$data['labelmessage']="Enter Email and password.";
    if($this->form_validation->run('forget_password')==FALSE)
    {
        $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>'); 
        $data['template'] = 'website/forget';
        $this->load->view('templates/frontend/layout', $data);
    }
    else
    {
      $email = $this->input->post('email');
      if($this->Common_model->get_result('users',array('email'=>$email,'user_role'=>1,'status'=>1)))
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
                                   'activation_key' =>  base_url().'website/forget/'.$secret_key,   
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
            redirect('website/forget_password');
      }
      else
      {
       $this->session->set_flashdata('msg_error', 'Your email adderss not found.');
       redirect('website/forget_password');
      }
    }

  }

  public function profile()
  {
    if(!user_logged_in()) redirect('website/login');

    //$data['template'] = 'website/profile';
    $data['user_detail']  = $this->Common_model->get_row('users',array('id'=>user_id()));
    if(!$data['user_detail']) redirect('website/login');

    $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());

    $data['template'] = 'website/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  }

  public function order_detail($offset=0)
  {
    if(!user_logged_in()) redirect('website/login');
    $data['user_detail']  = $this->Common_model->get_row('users',array('id'=>user_id()));
    $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());
    if(!$data['user_detail']) redirect('website/login');
    $data['offset'] = $offset;
    $per_page =10;
    $data['order_detail'] = $this->Common_model->get_result_pagination('orders',$offset,$per_page,array('user_id'=>user_id()),array('order_id','desc'));
    
    $config = frontend_pagination();
    $config['base_url']     = base_url().'website/order_detail/';
    $config['total_rows']   = $this->Common_model->get_result_pagination('orders',0,0,array('user_id'=>user_id()),array('order_id','desc'));
    $config['per_page']     = $per_page;
    $config['uri_segment']  = 3;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();

    $data['template'] = 'website/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  } 

  public function services($offset=0)
  {
    if(!user_logged_in()) redirect('website/login');
    $data['user_detail']  = $this->Common_model->get_row('users',array('id'=>user_id()));
    $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());
    if(!$data['user_detail']) redirect('website/login');
    $data['offset'] = $offset;
    $per_page =10;
    $data['services_detail'] = $this->orders_model->orders_services($offset,$per_page,user_id()); 
    
    $config = frontend_pagination();
    $config['base_url']     = base_url().'website/services/';
    $config['total_rows']   = $this->orders_model->orders_services(0,0,user_id());
    $config['per_page']     = $per_page;
    $config['uri_segment']  = 3;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();

    $data['template'] = 'website/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  }

  public function training($offset=0)
  {
    if(!user_logged_in()) redirect('website/login');
    $data['user_detail']  = $this->Common_model->get_row('users',array('id'=>user_id()));
    $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());
    if(!$data['user_detail']) redirect('website/login');
    $data['offset'] = $offset;
    $per_page =10;
    $data['training_detail'] = $this->orders_model->orders_training($offset,$per_page,user_id());
    
    $config = frontend_pagination();
    $config['base_url']     = base_url().'website/training/';
    $config['total_rows']   = $this->orders_model->orders_training(0,0,user_id());
    $config['per_page']     = $per_page;
    $config['uri_segment']  = 3;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();

    $data['template'] = 'website/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  }

  //user favorites product list
  public function my_favorites($offset=0)
  { 
    if(!user_logged_in()) redirect('website/login');
    $data['user_detail']  = $this->Common_model->get_row('users',array('id'=>user_id()));
   
    $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());
    //print_r($data['membership_detail']);die;
    if(!$data['user_detail']) redirect('website/login');
    $data['offset'] = $offset;
    $per_page =5;
    $data['favorites'] = $this->products_model->favorites_list($offset,$per_page);
    
    $config = frontend_pagination();
    $config['base_url']     = base_url().'website/my_favorites/';
    $config['total_rows']   = $this->products_model->favorites_list(0,0);
    $config['per_page']     = $per_page;
    $config['uri_segment']  = 3;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();

    $data['template'] = 'website/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  }
  // Remove favorites from list
  public function remove_favorites($fav_id)
  {
    if(!user_logged_in()) redirect('website/login');
    if($this->Common_model->delete('my_favorites',array('fav_id'=>$fav_id,'user_id'=>user_id())))
    {
      $this->session->set_flashdata('msg_success','Removed successfully.');
    }
    else
    {
      $this->session->set_flashdata('msg_error','Please try again');
    }
    redirect('website/my_favorites');
  }

  // use for change password by user dashboard
  public function password()
  {
      if(!user_logged_in()) redirect('website/login');
      $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>user_id()));
      if(!$data['user_detail']) redirect('website/login');
      $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());
      if($this->form_validation->run('user_password')==FALSE)
      {
        $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');   
        $data['template'] = 'website/dashboard';
        $this->load->view('templates/frontend/layout', $data);
      }
      else
      {
             $user_id       = user_id();
             if(!$user_id) redirect('website/login');
             $password      = $this->input->post('pwd');
             $new_password  = $this->input->post('npwd');
             $where    = array('id' =>$user_id,'password'=>md5($password),'user_role'=>1);
             if($this->Common_model->get_row('users',$where))
             {
                if($this->Common_model->update('users',array('password'=>md5($new_password)),array('id' =>$user_id)))
                {
                      $this->session->set_flashdata('msg_success', 'Your password changed successfully.');
                      redirect('website/password');
                }
                else
                {
                      $this->session->set_flashdata('msg_info','Please try again.');
                      redirect('website/password');
                }
             }
             else
             {
                $this->session->set_flashdata('msg_error','Your current password not matched.');
                redirect('website/password');
             }
      }
      
  }

  public function membership(){
    $user_id       = user_id();
    if(!$user_id) redirect('website/login');

    if(!user_logged_in()) redirect('website/login');
      $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>user_id()));

    if(!$data['user_detail']) redirect('website/login');
      $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());

    $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');

    if($this->form_validation->run('user_membership')===TRUE){

      $discount_code = $this->input->post('discount_code');    
      if($this->Common_model->update('plan_discount_code',array('is_used'=>1,'user_id'=> $user_id ),array('discount_code' =>$discount_code))){
        $this->session->set_flashdata('msg_success', 'Your membership updated successfully.');
      }else{
        $this->session->set_flashdata('msg_info','Please try again.');
      }

      redirect('website/membership');
    }
    
    $data['template'] = 'website/dashboard';
    $this->load->view('templates/frontend/layout', $data);
  }

  function validate_discount_code($str){
    $errorFlag  = 0;
    $message    =  "Invalid Discount Code!";
    $discount_data = $this->discount_model->validate_discount_code($str);
    if(count($discount_data)>0){
      $user_id  = user_id();
      if($user_id == $discount_data->user_id || $discount_data->user_id == 0){
        $current_date   = date('Y-m-d');
        if(!((strtotime($current_date )<=strtotime($discount_data->end_date))&&(strtotime($current_date )>=strtotime($discount_data->start_date)))){
          $errorFlag++;
          $message  =  "Discount Code expired!";  
        }else{
          $membership_detail  = $this->discount_model->get_user_plan_details($user_id);
          if($membership_detail->plan_id > $discount_data->plan_id){
            $errorFlag++;
            $message  =  "Membership can not update! Discount code used for lower plan!";
          }else if($membership_detail->plan_id == $discount_data->plan_id){
            $errorFlag++;
            $message  =  "Membership plan already exist!";
          }
        }
      }else{
        $errorFlag++;
      }
    }else{
      $errorFlag++;
    }

    if($errorFlag ==  0){
      return TRUE;
    }else{
      $this->form_validation->set_message('validate_discount_code', $message);
      return FALSE;
    }
  }

  public function update_detail()
  {
      if(!user_logged_in()) redirect('website/login');

      //$data['template'] = 'website/profile';
      $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>user_id()));
      $data['membership_detail']  = $this->discount_model->get_user_plan_details(user_id());
      if(!$data['user_detail']) redirect('website/login');

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
            $this->Common_model->update('users',$data,array('id'=>user_id()));
        $this->session->set_flashdata('msg_success', 'Your address detail changed successfully.');
        redirect('website/update_detail');
      }

      $data['template'] = 'website/dashboard';
      $this->load->view('templates/frontend/layout', $data);
  }

  public function dashboard_image()
  {

        if(!user_logged_in()) redirect('website/login');

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
              if($this->Common_model->update('users',$data,array('id'=>user_id())))
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
            redirect('website/profile');

  }

  public function logout()
  {
    $this->session->sess_destroy();
    //start_session();
    $this->session->set_flashdata('msg_success', 'Log-out successfully.');
    redirect('website/login');
  }


	public function blog($offset = 0,$tag=0)
	{
       
       $per_page = 5;
       $data['blogs'] = $this->webs_model->blogs($offset, $per_page);  
     
       $data['category'] = $this->Common_model->get_result('blog_category', array('status'=>'1'),array('category_name,category_slug'),'','');              
       $data['tags'] = $this->Common_model->get_result('blog_tags', array('status'=>'1'),array('tag_name,tag_slug'),'','');              
                    
       $config = frontend_pagination();

        $config['base_url'] = base_url() . 'website/blog/';

        $config['total_rows'] = $this->webs_model->blogs(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
		    $data['template'] = "frontend/blogs/index";
        $this->load->view('templates/frontend/layout', $data);
	
	}



	public function blog_details($blogid = 0)
	{
       
       $data['category'] = $this->Common_model->get_result('blog_category', array('status'=>'1'),array('category_name,category_slug'),'','');              
       
       $data['tags'] = $this->Common_model->get_result('blog_tags', array('status'=>'1'),array('tag_name,tag_slug'),'','');                     
       $data['latest_blogs'] = $this->webs_model->blogs('0','10'); 
       $data['commnets'] = $this->Common_model->get_result('posts', array('status'=>'1','post_parent'=>$blogid,'post_type'=>'post'),array('post_content'),'','');              
         
       if($this->form_validation->run('blog_comment')==TRUE)
  	   {
           $insert['post_parent']=$blogid;
           $insert['post_author']=1;
           //$insert['name']=$this->input->post('name');
           //$insert['email']=$this->input->post('email');
           $insert['status']=0;
            $insert['post_type']='post';
           $insert['post_content']=$this->input->post('comments');
           $this->Common_model->insert('posts',$insert);
           redirect('website/blog_details/'.$blogid);

        }            
       
       $data['blogs'] = $this->Common_model->get_result('blogs', array('blog_slug'=>$blogid),'','','');              
       $data['template'] = "frontend/blogs/details";
       $this->load->view('templates/frontend/layout', $data);
	
	}

	public function contact()
	{
	  if($this->form_validation->run('contact')==TRUE)
	  {
         $insert['first_name']=$this->input->post('first_name');
         $insert['last_name']=$this->input->post('last_name');
         $insert['email']=$this->input->post('email');
         $insert['moble']=$this->input->post('moble');
         $insert['message']=$this->input->post('message');
         $this->Common_model->insert('supports',$insert);
         redirect('website/contact');

      }
       $data['template'] = "frontend/contact/index.php";
       $this->load->view('templates/frontend/layout', $data);
	}

	public function term()
	{
       $data['template'] = "frontend/term/index.php";
       $this->load->view('templates/frontend/layout', $data);
	}

	public function privacy_policy()
	{
      $data['template'] = "frontend/privacy_policy/index";
      $this->load->view('templates/frontend/layout', $data);
	}

	public function news($offset=0)
	{

	   $data['latest_news'] = $this->Common_model->get_result('posts', array('status'=>'1','post_type'=>'news'),array('post_content,post_title,post_slug'),array('id','desc'),10);              
	   $per_page = 5;
       $data['news'] = $this->webs_model->news($offset, $per_page);  
                  
       $config = frontend_pagination();

        $config['base_url'] = base_url() . 'website/news/';

        $config['total_rows'] = $this->webs_model->news(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
		$data['template'] = "frontend/news/index";
        $this->load->view('templates/frontend/layout', $data);
	}

  public function news_detail($post_slug='')
  {
    $data['news'] = $this->Common_model->get_result('posts', array('status'=>'1','post_type'=>'news','post_slug'=>$post_slug),array('post_content,post_title,post_slug,created_at'),'','');              
    $data['latest_news'] = $this->Common_model->get_result('posts', array('status'=>'1','post_type'=>'news'),array('id,post_content,post_title,post_slug,created_at'),array('id','desc'),10);              

    $data['template'] = "frontend/news/view";
    $this->load->view('templates/frontend/layout', $data);
  }





}

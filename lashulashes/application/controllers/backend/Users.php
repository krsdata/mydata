<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
 	{
    parent::__construct();
    if(superadmin_logged_in()==FALSE)
    {
      redirect('backend/login'); 
    }
    $this->load->model('users_model');
	}

	
	public function index($offset = 0)
  {	
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = RECORDS_PER_PAGE;
      $data['offset']=$offset;
      $data['users'] = $this->users_model->users($offset, $per_page);

      $config = backend_pagination();

      $config['base_url'] = base_url() . 'backend/users/index/';

      $config['total_rows'] = $this->users_model->users(0, 0);

      $config['per_page'] = $per_page;

      $config['uri_segment']  = 4;
      if(!empty($_SERVER['QUERY_STRING']))
      {
      $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
      }

      $this->pagination->initialize($config);

      $data['pagination'] = $this->pagination->create_links();

      $data['template'] = "backend/users/index";
      $this->load->view('templates/backend/layout', $data);
	}
    

  public function add() 
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('user_add')==TRUE)
      { 

          $inset['first_name']    = $this->input->post('first_name');
          $inset['last_name']     = $this->input->post('last_name');
          $inset['email']         = $this->input->post('email');
          $inset['mobile']        = $this->input->post('mobile');
          $inset['address']       = $this->input->post('address');
          $inset['city']          = $this->input->post('city');
          $inset['state']         = $this->input->post('state');
          $inset['zip']           = $this->input->post('zip');

          $inset['shipping']      = $this->input->post('shipping');

          $inset['s_first_name']  = $this->input->post('s_first_name');
          $inset['s_last_name']   = $this->input->post('s_last_name');
          $inset['s_email']       = $this->input->post('s_email');
          $inset['s_mobile']      = $this->input->post('s_mobile');
          $inset['s_address']     = $this->input->post('s_address');
          $inset['s_city']        = $this->input->post('s_city');
          $inset['s_state']       = $this->input->post('s_state');
          $inset['s_zip']         = $this->input->post('s_zip');


          $inset['status']        = 0;
          $inset['user_role']     = 1;
          $inset['created_at']    = date('Y-m-d h:i:s');
          $inset['password']      = md5($this->input->post('password'));
          $secret_key=trim(md5($this->input->post('email')));
          $inset['secret_key']    = $secret_key;
          

          if($this->Common_model->insert('users',$inset))
          {
              $this->session->set_flashdata('msg_success', 'User added successfully.');
              // mail to user
              $this->load->library('chapter247_email');
              $email_template=$this->chapter247_email->get_email_template(1);

              $param=array(

              'template'  =>  array(
                      'temp'      =>  $email_template->template_body,
                      'var_name'  =>  array(
                               'user_name'      =>  ucfirst($inset['first_name']).' '.ucfirst($inset['last_name']),
                               'activation_key' =>  base_url().'website/activation/'.$secret_key,
                               'password' =>  $this->input->post('password'),
                                             ), 
                                    ),      
              'email' =>  array(
                      'to'    =>   $inset['email'],
                      'from'    =>   NO_REPLY_EMAIL,
                      'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                      'subject' =>   $email_template->template_subject,
                    )
              );  
              $status=$this->chapter247_email->send_mail($param); 
          }
          else
          {

           $this->session->set_flashdata('msg_error', 'New add user failed, Please try again.');

          }
          redirect('backend/users/index');
      } 

      $data['template']='backend/users/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 



  public function edit($id=0,$offset=0)
  {  
    $data['offset'] = $offset;
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('users','',array('id'=>$id,'user_role'=>1),'','');
    if(!$data['update']) redirect('backend/users/');
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    $this->session->set_userdata('edit_user_id',$id);
    if($this->form_validation->run('user_edit')==TRUE)
    {    

            $inset['first_name']      = $this->input->post('first_name');
            $inset['last_name']       = $this->input->post('last_name');
            $inset['email']           = $this->input->post('email');
            $inset['mobile']          = $this->input->post('mobile');
            $inset['address']         = $this->input->post('address');
            $inset['city']            = $this->input->post('city');
            $inset['state']           = $this->input->post('state');
            $inset['zip']             = $this->input->post('zip');

            $inset['shipping']        = $this->input->post('shipping');

            $inset['s_first_name']    = $this->input->post('s_first_name');
            $inset['s_last_name']     = $this->input->post('s_last_name');
            $inset['s_email']         = $this->input->post('s_email');
            $inset['s_mobile']        = $this->input->post('s_mobile');
            $inset['s_address']       = $this->input->post('s_address');
            $inset['s_city']          = $this->input->post('s_city');
            $inset['s_state']         = $this->input->post('s_state');
            $inset['s_zip']           = $this->input->post('s_zip');

            $inset['modified_at']     = date('Y-m-d h:i:s');

        if($this->Common_model->update('users',$inset,array('id'=>$id,'user_role'=>1)))
        {
          $this->session->set_flashdata('msg_success', 'User updated successfully.');
        }
        else
        {
         $this->session->set_flashdata('msg_error', 'User update failed, Please try again.');
        }
        redirect('backend/users/index/'.$offset);              

    }
    $data['template']='backend/users/edit';     
    $this->load->view('templates/backend/layout',$data);
  } 



  public function delete($news_id = 0)
  {

      if (empty($news_id)) redirect('backend/users');
      if ($this->Common_model->delete('users', array('id' => $news_id,'user_role'=>1))) {
          $this->session->set_flashdata('msg_success', 'User deleted successfully.');
      } else {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }

     redirect('backend/users');
  }


  public function status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/users/');
      if($status==0){
          $cat_status=1;
      }

      if($status==1){
          $cat_status=0;
      }       

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('users', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','User status has been updated successfully.');
      }
      else{
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

      }
      redirect('backend/users/index/'.$offset);  
  }

  public function check_user_email($str)
  {
    $id = $this->session->userdata('edit_user_id');
    $check = $this->Common_model->get_row('users',array('id !='=>$id,'email'=>$str));
    if($check)
    { 
        $this->form_validation->set_message('check_user_email',"The email field must contain a unique value.");
        return FALSE;
    }
    else
    {
        return TRUE;
    }
  }

  public function view_user($user_id=0)
  {
    $res=$this->Admin_model->getColumnDataWhere('users','',array('id'=>$user_id,'user_role'=>1),'','');
    if(count($res)>0)
    {
      if($res[0]->status==1)
      {
          //$this->session->set_flashdata('msg_success', 'Login successfully.');
          $this->session->set_userdata(array('user_name'=> $res[0]->first_name.' '.$res[0]->last_name,'id'=>$res[0]->id,'user_role'=>1,'logged_in'=>TRUE,'user_image'=>$res[0]->image));
          redirect('website/profile');
      }
      else
      {
          $this->session->set_flashdata('msg_info', 'User account not activated yet.');
          redirect('backend/users/');
      }
    }
    else
    {
      $this->session->set_flashdata('msg_error', 'User not found. Please try again');
      redirect('backend/users/');
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


  
}


/*stdClass Object
(
    [address_components] => Array
        (
            [0] => stdClass Object
                (
                    [long_name] => 3221
                    [short_name] => 3221
                    [types] => Array
                        (
                            [0] => postal_code
                        )

                )

            [1] => stdClass Object
                (
                    [long_name] => Barrabool
                    [short_name] => Barrabool
                    [types] => Array
                        (
                            [0] => locality
                            [1] => political
                        )

                )

            [2] => stdClass Object
                (
                    [long_name] => Victoria
                    [short_name] => VIC
                    [types] => Array
                        (
                            [0] => administrative_area_level_1
                            [1] => political
                        )

                )

            [3] => stdClass Object
                (
                    [long_name] => Australia
                    [short_name] => AU
                    [types] => Array
                        (
                            [0] => country
                            [1] => political
                        )

                )

        )*/
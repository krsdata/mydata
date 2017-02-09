<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('client_model');
	}

	
	public function index($offset = 0)
  {	
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = RECORDS_PER_PAGE;
      $data['offset']=$offset;
      $data['client'] = $this->client_model->client($offset, $per_page);

      $config = backend_pagination();

      $config['base_url'] = base_url() . 'backend/client/index/';

      $config['total_rows'] = $this->client_model->client(0, 0);

      $config['per_page'] = $per_page;

      if(!empty($_SERVER['QUERY_STRING']))
      {
        $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
      }

      $this->pagination->initialize($config);

      $data['pagination'] = $this->pagination->create_links();
     
      $data['template'] = "backend/client/index";
      $this->load->view('templates/backend/layout', $data);
	}
    

  public function add() 
  {  

      $query = $this->Common_model->get_result_array('products',array(),array('id'));
      if(!$query)
      {
        $query =array();
        $query = json_encode($query);
      }
      else
      {
       $query = array_column($query,'id');
       $query = json_encode($query);
      }
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('client_add')==TRUE)
      { 
          $inset['user_role']          = 2;
          $inset['cliend_kind']        = $this->input->post('cliend_kind');;
          $inset['title']              = $this->input->post('title');
          $inset['user_name']          = $this->input->post('user_name');
          $inset['paypal']             = $this->input->post('paypal');
          $inset['email']              = $this->input->post('email');
          $inset['email_2']            = $this->input->post('email_2');
          $inset['mobile']             = $this->input->post('mobile');
          $inset['mobile_2']           = $this->input->post('mobile_2');
          $inset['address']            = $this->input->post('address');
          $inset['state']              = $this->input->post('state');
          $inset['city']               = $this->input->post('city');
          $inset['zip']                = $this->input->post('zip');
          $inset['charity_paypal']     = $this->input->post('charity_paypal');
          $inset['charity_percentage'] = $this->input->post('charity_percentage');
          $inset['state_paypal']       = $this->input->post('state_paypal');
          $inset['state_percentage']   = $this->input->post('state_percentage');
          $inset['lash_percentage']    = $this->input->post('lash_percentage');
          $inset['status']             = 1;
          $inset['created_at']         = date('Y-m-d h:i:s');
          $inset['my_products']        = $query; 
          $inset['password']           = md5($this->input->post('password'));


          if($this->Common_model->insert('users',$inset))
          {
              $this->session->set_flashdata('msg_success', 'Distributor added successfully.');
              // mail to user
             /* $this->load->library('chapter247_email');
              $email_template=$this->chapter247_email->get_email_template(9);

              $param=array(

              'template'  =>  array(
                      'temp'      =>  $email_template->template_body,
                      'var_name'  =>  array(
                               'user_name'      =>  $inset['first_name'].' '. $inset['last_name'],
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
              $status=$this->chapter247_email->send_mail($param); */
          }
          else
          {

           $this->session->set_flashdata('msg_error', 'New add distributor failed, Please try again.');

          }
          redirect('backend/client');
      } 

      $data['template']='backend/client/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 

  public function edit($id=0,$offset=0)
  {  
    
    if(empty($id)) redirect('backend/client');
    if(!is_numeric($id)) redirect('backend/client');
    if(isset($_POST['product']))
    {
      $product_array = array();
      if(isset($_POST['products_array']))
      {
        $product_array = $_POST['products_array'];
      }
      $product_array = json_encode($product_array);
      $inset = array('my_products'=> $product_array);

      if($this->Common_model->update('users',$inset,array('id'=>$id,'user_role'=>2)))
      {
        $this->session->set_flashdata('msg_success', 'Distributor updated successfully.');
      }
      else
      {
       $this->session->set_flashdata('msg_error', 'Distributor update failed, Please try again.');
      }

      redirect('backend/client/index/'.$offset); 
    }
    $data['offset'] = $offset;
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('users','',array('id'=>$id,'user_role'=>2),'','');
    if(count($data['update'])<1) redirect('backend/client');
    $data['products']=$this->Common_model->get_result('products');
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    $this->session->set_userdata('edit_user_id',$id);
    
    if(isset($_POST['detail']))
    { 
      if($this->form_validation->run('client_edit')==TRUE)
      {    
        $inset['user_role']          = 2;
        $inset['cliend_kind']        = $this->input->post('cliend_kind');;
        $inset['title']              = $this->input->post('title');
        $inset['user_name']          = $this->input->post('user_name');
        $inset['paypal']             = $this->input->post('paypal');
        $inset['email']              = $this->input->post('email');
        $inset['email_2']            = $this->input->post('email_2');
        $inset['mobile']             = $this->input->post('mobile');
        $inset['mobile_2']           = $this->input->post('mobile_2');
        $inset['address']            = $this->input->post('address');
        $inset['state']              = $this->input->post('state');
        $inset['city']               = $this->input->post('city');
        $inset['zip']                = $this->input->post('zip');

        $inset['charity_paypal']     = $this->input->post('charity_paypal');
        $inset['charity_percentage'] = $this->input->post('charity_percentage');
        $inset['state_paypal']       = $this->input->post('state_paypal');
        $inset['state_percentage']   = $this->input->post('state_percentage');
        $inset['lash_percentage']    = $this->input->post('lash_percentage');
        //$inset['status']           = 1;
        $inset['modified_at']        = date('Y-m-d h:i:s');

        if($this->Common_model->update('users',$inset,array('id'=>$id,'user_role'=>2)))
        {
          $this->session->set_flashdata('msg_success', 'Distributor updated successfully.');
        }
        else
        {
          $this->session->set_flashdata('msg_error', 'Distributor update failed, Please try again.');
        }
        redirect('backend/client/index/'.$offset);              
      }
    }
    $data['template']='backend/client/edit';     
    $this->load->view('templates/backend/layout',$data);
    //$this->load->view('backend/client/test');
  } 



  public function delete($news_id = 0)
  {

      if (empty($news_id)) redirect('backend/users');
      if ($this->Common_model->delete('users', array('id' => $news_id,'user_role'=>2))) {
          $this->session->set_flashdata('msg_success', 'Distributor deleted successfully.');
      } else {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }

     redirect('backend/client');
  }


  public function status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/client/');
      if($status==0){
          $cat_status=1;
      }

      if($status==1){
          $cat_status=0;
      }       

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('users', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Distributor status has been updated successfully.');
      }
      else{
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

      }
      redirect('backend/client/index/'.$offset);  
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

  public function check_alternate_email($str)
  {
    if(!empty($str))
    {
      if (!filter_var($str, FILTER_VALIDATE_EMAIL) === false) 
      {
        return TRUE;
      }
      else
      {
        $this->form_validation->set_message('check_alternate_email','The alternate email field must contain a valid email address.');
        return FALSE;
      }
    }
    else
    {
      return TRUE;
    }
  }

  public function view_user($user_id=0)
  {
    $res=$this->Admin_model->getColumnDataWhere('users','',array('id'=>$user_id,'user_role'=>2),'','');
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
          $this->session->set_flashdata('msg_info', 'User account not activated yet.');
          redirect('backend/client/');
      }
    }
    else
    {
      $this->session->set_flashdata('msg_error', 'User not found. Please try again');
      redirect('backend/client/');
    }
  }

 


  
}

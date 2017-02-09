<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
        {
          redirect('backend/login'); 
        }
        $this->load->model('orders_model');
	}

	
    public function index($offset = 0)
    {	
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page =100;
        $data['offset'] =$offset;
        $data['order_detail'] = $this->orders_model->orders_product($offset,$per_page);
        $config = backend_pagination();
        $config['base_url']     = base_url().'backend/orders/index';
        $config['total_rows']   = $this->orders_model->orders_product(0,0);
        $config['per_page']     = $per_page;
        $config['uri_segment']  = 4;
        if(!empty($_SERVER['QUERY_STRING']))
        {
          $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
        }
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['template'] = 'backend/orders/index';
        $this->load->view('templates/backend/layout', $data);
    }

    public function training($offset = 0)
    { 
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page =RECORDS_PER_PAGE;
        $data['offset'] =$offset;
        $data['order_detail'] = $this->orders_model->orders_training($offset,$per_page);
        /*echo $this->db->last_query();
        die();*/
        $config = backend_pagination();
        $config['base_url']     = base_url().'backend/orders/training';
        $config['total_rows']   = $this->orders_model->orders_training(0,0); 
        $config['per_page']     = $per_page;
        $config['uri_segment']  = 4;
        if(!empty($_SERVER['QUERY_STRING']))
        {
          $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
        }
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['template'] = 'backend/orders/index_training';
        $this->load->view('templates/backend/layout', $data);
    }


    public function services($offset = 0)
    { 
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page =RECORDS_PER_PAGE;
        $data['offset'] =$offset;
        $data['order_detail'] = $this->orders_model->orders_services($offset,$per_page);  
        $config = backend_pagination();
        $config['base_url']     = base_url().'backend/orders/services';
        $config['total_rows']   = $this->orders_model->orders_services(0,0);
        $config['per_page']     = $per_page;
        $config['uri_segment']  = 4;
        if(!empty($_SERVER['QUERY_STRING']))
        {
          $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
        }
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['template'] = 'backend/orders/index_services';
        $this->load->view('templates/backend/layout', $data);
    }

    public function send_mail()
    {
        $order_id = $_POST['order_id'];
        $status = 1;
        $msg ='';
        $mail_status['EMAIL_STATUS'] = true;
        
        $this->load->library('chapter247_email');
        $email_template=$this->chapter247_email->get_email_template(8);

        $data['type'] ='product';
        $data['value'] = $this->Common_model->get_row('orders',array('order_id'=>$order_id));
        if($data['value'])
        {
            //mail to admin and distributor
            $data['message'] = $email_template->template_body_admin;
            $html = $this->load->view('website/email',$data,true);

            if(!empty($data['value']->distributor_id) && $data['value']->distributor_id>1)
            {
                $users_admin = $this->Common_model->get_row('users',array('id'=>$data['value']->distributor_id));
                if($users_admin)
                {  
                    $admin_param = array(
                        'template'  =>  array(
                                        'temp'      => $html,
                                        'var_name'  => array(
                                                            'distributor_name'  => ucfirst($data['value']->distributor_name),
                                                            ), 
                                              ),            
                        'email' =>  array(
                                    'to'        => $users_admin->email,
                                    //'bcc'       => SUPERADMIN_EMAIL,
                                    'from'      => NO_REPLY_EMAIL,
                                    'from_name' => NO_REPLY_EMAIL_FROM_NAME,
                                    'subject'   => $email_template->template_subject_admin,
                                )
                      );
                    $mail_status = $this->chapter247_email->send_mail($admin_param);

                }
                else
                {   
                    $status=0;
                    $msg= "Distributor not found. Please try again.";
                }
            }
            else
            {
                $admin_param = array(
                    'template'  =>  array(
                                    'temp'      => $html,
                                    'var_name'  => array(
                                                        'distributor_name'  => ucfirst($data['value']->distributor_name),
                                                        ), 
                                          ),            
                    'email' =>  array(
                                'to'        => SUPERADMIN_EMAIL,
                                //'bcc'       => SUPERADMIN_EMAIL,
                                'from'      => NO_REPLY_EMAIL,
                                'from_name' => NO_REPLY_EMAIL_FROM_NAME,
                                'subject'   => $email_template->template_subject_admin,
                            )
                  );
                $mail_status=$this->chapter247_email->send_mail($admin_param);
            }

            if($mail_status['EMAIL_STATUS'])
            {
                $status=1;
                $msg= "Forwarded order mail successfully";  
            }
            else
            {
                $status=0;
                $msg= "Please try again.";
            }
            
        }
        else
        {
            $status=0;
            $msg= "Please try again.";
        }

        if($status)
        {
            $msg = '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-check-circle"></i> '.$msg.'
                    </div>';
        }
        else
        {
            $msg = '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-times-circle-o"></i> '.$msg.'
                    </div>';
        }


        $result = array('STATUS'=>$status,'msg'=>$msg);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    
  
}

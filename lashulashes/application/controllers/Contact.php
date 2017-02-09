<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
			   
	}


	
	public function index( $category ='',$location='')
  {
      if(!empty($category) && !empty($location))
      {
        $data['category']=$category;
        $data['location']=$location;
        $data['store_list'] = $this->Common_model->get_result('contact_location',array('type'=>$category,'location'=>$location));
        if(!$data['store_list']) redirect('contact');
      } 
      else
      {
        $data['category']='';
        $data['location']='';
      }

      $this->form_validation->set_error_delimiters('<div class="form_carot">','</div>');          
      if($this->form_validation->run('contact')==TRUE)
       {   
           if(!empty($category) && !empty($location))
            {
                
                if('H'==$category) $insert['type'] = "Wholesale Store";
                if('E'==$category) $insert['type'] = "Education Centre"; 
                $insert['location'] = $location;
                $insert['store_name'] = $this->input->post('location_name');
            }

           $insert['first_name']  = $this->input->post('name');
           $insert['email'] = $this->input->post('email');
           $insert['mobile']=$this->input->post('mobile');
           $insert['message']=$this->input->post('comments');
           $insert['created_at']=date('Y-m-d h:i:s');
           $this->Common_model->insert('supports',$insert);
           $this->session->set_flashdata('msg_success', 'Submitted successfully.');

           $this->load->library('chapter247_email');
           $email_template=$this->chapter247_email->get_email_template(5);

          $param=array(

                       'template'  =>  array(   
                                    'temp'      =>  $email_template->template_body,
                                    'var_name'  =>  array(
                                                  'user_name'      =>  ucfirst($insert['first_name']),
                                                  'email'     =>  $insert['email'],
                                                  'message'   =>  $insert['message'],
                                                  'site_name'   => SITE_NAME  
                                                           ), 
                                        ),

                          'email' =>  array(
                                  'to'        =>   $insert['email'],
                                  'from'      =>   NO_REPLY_EMAIL,
                                  'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                                  'subject'   =>   $email_template->template_subject,
                                )
                  );  
            $status=$this->chapter247_email->send_mail($param); 

            $param_admin=array(
                    'template'  =>  array(
                                    'temp'      =>  $email_template->template_body_admin,
                                    'var_name'  =>  array(
                                                    'site_name'   => SITE_NAME,
                                                    'user_name'   => ucfirst($insert['first_name']),
                                                    'email'       => $insert['email'],
                                                    'message'     => $insert['message']
                                                    ),
                                      ),
                        'email' =>  array(
                                      'to'      =>   SUPERADMIN_EMAIL,
                                      'from'    =>   $insert['email'],
                                      'reply_to'=>   $insert['email'],
                                      'subject' =>   $email_template->template_subject_admin,
                                    )
                          );
            $admin_status=$this->chapter247_email->send_mail($param_admin);

            redirect('contact');
       }
       else
       {

          $our_locations = $this->Common_model->get_row('options',array('id'=>1));
          $phone = $this->Common_model->get_row('options',array('id'=>2));
          $location_json =array();
          if($our_locations)
          {
                // foreach ($our_locations as $rows)
                // {
                //   $temp = array();

                //   $temp['address']  = $rows->address.' '.$rows->city.' '.$rows->zip.' '.$rows->state.' '.$rows->country;
                //   $temp['name']     = $rows->name;
                //   $temp['phone']    = $rows->mobile;
                //   if($rows->type=='H'||$rows->type=='h')
                //   {
                //      $temp['type']     = 1;
                //   }
                //   else
                //   {
                //     $temp['type']     = 2;
                //   }

                //   $location_json[] =$temp;
                // }
                if(!empty($phone->option_value) && $phone->option_value!='#')
                {
                  $phone = $phone->option_value;
                }
                else
                {
                  $phone ='';
                }
 
                if(!empty($our_locations->option_value) && $our_locations->option_value!='#')
                {
                  $location_json[] = array('address'=>$our_locations->option_value,'type'=>0,'name'=>'Lash U Lashes Head Office','phone'=>$phone);
                }

            $data['location_json'] = json_encode($location_json);

          }
          else
          {
            $data['location_json'] = json_encode($location_json);
          }

        $data['template'] = "frontend/page/contactus";
        $this->load->view('templates/frontend/layout', $data);

       }

  }
  public function location($category ='',$location='')
  {
    
    $type_array = array('H','h','E','e');
    $location_array = array('VIC','vic','NSW','nsw','QLD','qld','SA','sa','ALL','all');
    if(empty($category) && empty($location)) redirect('contact');
    if(!in_array($category, $type_array)) redirect('contact');
    if(!in_array($location, $location_array)) redirect('contact');

    if($location=='ALL' || $location=='all')
    {
      $data['store_list'] = $this->Common_model->get_result('contact_location',array('type'=>$category,'status'=>1));
    }
    else
    {
      $data['store_list'] = $this->Common_model->get_result('contact_location',array('type'=>$category,'location'=>$location,'status'=>1)); 
    }
    

    if(!$data['store_list'])
    {

      $this->session->set_flashdata('msg_success', 'No location found.');
      redirect('contact');

    }
    $location_json =array();
          if($data['store_list'])
          {
                foreach ($data['store_list'] as $rows)
                {
                  $temp = array();

                  $temp['address']  = $rows->address.' '.$rows->city.' '.$rows->zip.' '.$rows->state.' '.$rows->country;
                  $temp['name']     = $rows->name;
                  $temp['phone']    = $rows->mobile;
                  if($rows->type=='H'||$rows->type=='h')
                  {
                     $temp['type']     = 1;
                  }
                  else
                  {
                    $temp['type']     = 2;
                  }

                  $location_json[] =$temp;
                }
                //$location_json =array();
                $data['location_json'] = json_encode($location_json);

          }
          else
          {
            $data['location_json'] = json_encode($location_json);
          }


    $data['template'] = "frontend/page/sub_contact";
    $this->load->view('templates/frontend/layout', $data);

  }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supports extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('supports_model');
	}

	
	public function index($offset = 0)
    {	
       $data['page_title'] = 'Dashboard :: Admin Panel';
       $per_page = RECORDS_PER_PAGE;

        $data['news'] = $this->supports_model->supports($offset, $per_page);

       $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/supports/index/';

        $config['total_rows'] = $this->supports_model->supports(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/supports/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    




  public function edit($id=0)
  {  
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('supports','',array('id'=>$id),'','');

  if(!$data['update']) redirect('backend/supports/index');
  
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

  if($this->form_validation->run('support_edit')==TRUE)
  {
    $inset['reply_message']=$this->input->post('reply_message');
    $inset['reply_status']=1;

    if($this->Common_model->update('supports',$inset,array('id'=>$id)))
    {
       $this->load->library('chapter247_email');
          $email_template=$this->chapter247_email->get_email_template(2);

          $param=array(
          'template'  =>  array(
                  'temp'  =>  $email_template->template_body,
                  'var_name'  =>  array(
                          'fullname'  =>  ucfirst($data['update'][0]->first_name).' '.ucfirst($data['update'][0]->last_name),
                          'email'=>$data['update'][0]->email,
                          'reply'=>$this->input->post('reply_message'),
                          'date'=>date('d-m-Y h:i:s')     
                          ), 
          ),      
          'email' =>  array(
              'to'    =>   $data['update'][0]->email,
              'from'    =>   NO_REPLY_EMAIL,
              'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
              'subject' =>   $email_template->template_subject,
            )
          );  
          $status=$this->chapter247_email->send_mail($param);
             
 

      $this->session->set_flashdata('msg_success', 'Support updated successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'Support update failed, Please try again.');

    }
    redirect('backend/supports/index');              

    }
    $data['template']='backend/supports/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 



    public function delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/supports');
        if ($this->Common_model->delete('supports', array('id' => $news_id))) {
            $this->session->set_flashdata('msg_success', 'Support message deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/supports');

    }

  
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_templates extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('email_templates_model');
	}

	
	public function index($offset = 0)
    {	
       $data['page_title'] = 'Dashboard :: Admin Panel';
       $per_page = 10;

        $data['templates'] = $this->email_templates_model->email_templates($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/email_templates/index/';

        $config['total_rows'] = $this->email_templates_model->email_templates(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/email_templates/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

public function add() {  
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

  if($this->form_validation->run('emailtemplets_add')==TRUE)
  { 
    $inset['template_name']=$this->input->post('template_name');
    $inset['template_subject']=$this->input->post('template_subject');
    $inset['template_body']=$this->input->post('template_body');
    $inset['template_subject_admin']=$this->input->post('template_subject_admin');
    $inset['template_body_admin']=$this->input->post('template_body_admin');
    if($this->Common_model->insert('email_templates',$inset))
    {
      $this->session->set_flashdata('msg_success', 'New email template added successfully.');
    }else{

     $this->session->set_flashdata('msg_error', 'New add email template failed, Please try again.');

    }
    redirect('backend/email_templates/index');
  } 

  $data['template']='backend/email_templates/add'; 
  $this->load->view('templates/backend/layout', $data);
} 



  public function edit($id=0)
  {  
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('email_templates','',array('id'=>$id),'','');

  if(!$data['update']) redirect('backend/email_templates');
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

  if($this->form_validation->run('emailtemplets_add')==TRUE)
  {
    $inset['template_name']=$this->input->post('template_name');
    $inset['template_subject']=$this->input->post('template_subject');
    $inset['template_body']=$this->input->post('template_body');
    $inset['template_subject_admin']=$this->input->post('template_subject_admin');
    $inset['template_body_admin']=$this->input->post('template_body_admin');

    if($this->Common_model->update('email_templates',$inset,array('id'=>$id)))
    {
      $this->session->set_flashdata('msg_success', 'Email template updated successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'Email template update failed, Please try again.');

    }
    redirect('backend/email_templates/index');              

    }
    $data['template']='backend/email_templates/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 



    public function delete($template_id = 0)

   {

        if (empty($template_id)) redirect('backend/email_templates');
        if ($this->email_templates_model->delete('email_templates', array('id' => $template_id))) {
            $this->session->set_flashdata('msg_success', 'Email template deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/email_templates');

    }
 

   
	public function logout(){
			$this->session->sess_destroy();
		redirect(base_url());
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('faqs_model');
	}

	
	public function index($offset = 0)
    {	
       $data['page_title'] = 'Dashboard :: Admin Panel';
       $per_page = 10;
        $data['offset']=$offset;
        $data['news'] = $this->faqs_model->faqs($offset, $per_page);

       $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/faqs/index/';

        $config['total_rows'] = $this->faqs_model->faqs(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/faqs/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

  public function add() 
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('faqs_add')==TRUE)
      { 
           $inset['question'] = $this->input->post('question');
           $inset['answer']   = $this->input->post('answer');
           $inset['type']     = $this->input->post('type');
           $inset['status']   = $this->input->post('status');
           $inset['created_at']=date('Y-m-d h:i:s');
          

          if($this->Common_model->insert('faqs',$inset))
          {
            $this->session->set_flashdata('msg_success', 'Faq added successfully.');
          }
          else
          {

           $this->session->set_flashdata('msg_error', 'New add Faq failed, Please try again.');

          }
          redirect('backend/faqs/index');
      } 

      $data['template']='backend/faqs/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 



  public function edit($id=0,$offset=0)
  {  
  $data['offset'] = $offset;
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('faqs','',array('id'=>$id),'','');

  if(!$data['update'])  redirect('backend/faqs/index');              

  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

  if($this->form_validation->run('faqs_edit')==TRUE)
  {
      $inset['question']= $this->input->post('question');
        $inset['answer']= $this->input->post('answer');
        $inset['type']  = $this->input->post('type');
        $inset['status']= $this->input->post('status');
        $inset['updated_at']=date('Y-m-d h:i:s');
    

    if($this->Common_model->update('faqs',$inset,array('id'=>$id)))
    {
      $this->session->set_flashdata('msg_success', 'Faq updated successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'Faq update failed, Please try again.');

    }
    redirect('backend/faqs/index/'.$offset);              

    }
    $data['template']='backend/faqs/edit';     
    $this->load->view('templates/backend/layout',$data);
  } 



    public function delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/faqs');
        if ($this->Common_model->delete('faqs', array('id' => $news_id))) {
            $this->session->set_flashdata('msg_success', 'Faq deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/faqs');

    }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/faqs/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('faqs', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Faq status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/faqs/index/'.$offset);  


    }

 


  
}

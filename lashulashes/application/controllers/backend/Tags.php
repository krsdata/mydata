<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('tags_model');
	}

	
	public function index($offset = 0)
  {	
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = 10;
      $data['offset']=$offset;
      $data['news'] = $this->tags_model->tags($offset, $per_page);

      $config = backend_pagination();
      $config['base_url'] = base_url() . 'backend/tags/index/';
      $config['total_rows'] = $this->tags_model->tags(0, 0);
      $config['per_page'] = $per_page;
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();


      $data['template'] = "backend/tags/index";
      $this->load->view('templates/backend/layout', $data);
  }
    

  public function add() 
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('tags_add')==TRUE)
      { 
          $inset['tag_name']=$this->input->post('tag_name');
          $inset['status']=$this->input->post('status');
          $inset['tag_slug']= url_title($this->input->post('tag_name'),'-');

          if($this->Common_model->insert('blog_tags',$inset))
          {   
            $this->session->set_flashdata('msg_success', 'Tag added successfully.');
          }
          else
          {
            $this->session->set_flashdata('msg_error', 'New add tag failed, Please try again.');
          }
          redirect('backend/tags/index');
      } 

      $data['template']='backend/tags/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 

  public function edit($id=0)
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $data['update']=$this->Admin_model->getColumnDataWhere('blog_tags','',array('id'=>$id),'','');
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
      $this->session->set_userdata('categotyid',$id);

      if($this->form_validation->run('tags_edit')==TRUE)
      {
          $inset['tag_name']=$this->input->post('tag_name');
          $inset['status']=$this->input->post('status');
          $inset['tag_slug']= url_title($this->input->post('tag_name'),'-');

          if($this->Common_model->update('blog_tags',$inset,array('id'=>$id)))
          {      
            $this->session->set_flashdata('msg_success', 'Tag updated successfully.');
          }
          else
          {
            $this->session->set_flashdata('msg_error', 'Tag update failed, Please try again.');
          }
          redirect('backend/tags/index');              

      }
      $data['template']='backend/tags/edit';     
      $this->load->view('templates/backend/layout', $data);
  } 

  public function check_updatetag($str)
  {
      $id=$this->session->userdata('categotyid'); 
      $check=$this->Admin_model->getColumnDataWhere('blog_tags','',array('id !='=>$id,'tag_name'=>$str),'','');

      if(count($check)>0)
      { 
        $this->form_validation->set_message('check_updatetag',"The Tag name field must contain a unique value.");
        return FALSE;
      }
      else
      {
        return TRUE;
      }
  }

  public function delete($news_id = 0)
  {
      if (empty($news_id)) redirect('backend/tags');
      if ($this->Common_model->delete('blog_tags', array('id' => $news_id))) 
      {
          $this->session->set_flashdata('msg_success', 'Tag deleted successfully.');
      } 
      else 
      {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }

      redirect('backend/tags');
  }


  public function status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/tags/');
      if($status==0)
      {
        $cat_status=1;
      }

      if($status==1)
      {
        $cat_status=0;
      }       

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('blog_tags', $data ,array('id'=>$id)))
      {
        $this->session->set_flashdata('msg_success','Tags status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
      }
      redirect('backend/tags/index/'.$offset);  
  }

 


  
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_category extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
      $this->load->model('member_category_model');
	}

	
	public function index($offset = 0)
    {	
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = 10;
        $data['offset']=$offset;
        $data['news'] = $this->member_category_model->member_category($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/member_category/index/';

        $config['total_rows'] = $this->member_category_model->member_category(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/member_category/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

public function add()
 {  
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
   
  if($this->form_validation->run('member_category_add')==TRUE)
  { 
     
     $inset['name']=$this->input->post('name');
     $inset['status']=$this->input->post('status');

    if($this->Common_model->insert('membership_category',$inset))
    {   
      $this->session->set_flashdata('msg_success', 'Category added successfully.');
    }else{

     $this->session->set_flashdata('msg_error', 'New add Category failed, Please try again.');

    }
    redirect('backend/member_category/index');
  } 

  $data['template']='backend/member_category/add'; 
  $this->load->view('templates/backend/layout', $data);
} 


  
  public function edit($id=0,$offset=0)
  { 
  $data['offset ']=$offset;
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('membership_category','',array('id'=>$id),'','');
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
  $this->session->set_userdata('categotyid',$id); 
  if($this->form_validation->run('member_category_edit')==TRUE)
  {
    $inset['name']=$this->input->post('name');
    $inset['status']=$this->input->post('status');

    if($this->Common_model->update('membership_category',$inset,array('id'=>$id)))
    {
      
      $this->session->set_flashdata('msg_success', 'Category updated successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'Category update failed, Please try again.');

    }
    redirect('backend/member_category/index');              

    }
    $data['template']='backend/member_category/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 

 public function check_edit_traning_cat($str)
     {
       $id=$this->session->userdata('categotyid'); 
       $check=$this->Admin_model->getColumnDataWhere('membership_category','',array('id !='=>$id,'name'=>$str),'','');

       if(count($check)>0)
       { 
            $this->form_validation->set_message('check_edit_traning_cat',"The category name field must contain a unique value.");
            return FALSE;
       }
        else{
           return TRUE;
        }
  
     }

    public function delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/member_category');
        if ($this->Common_model->delete('membership_category', array('id' => $news_id))) {
            $this->session->set_flashdata('msg_success', 'Category deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/member_category');

    }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/member_category/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('membership_category', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Category status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/member_category/index/'.$offset);  


    }


 public function test() {  
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
 // if($this->form_validation->run('category_add')==TRUE)
  //{ 
     
    /* $inset['category_name']=$this->input->post('category_name');
     $inset['status']=$this->input->post('status');

    if($this->Common_model->insert('blog_category',$inset))
    {   
      $this->session->set_flashdata('msg_success', 'Category added successfully.');
    }else{

     $this->session->set_flashdata('msg_error', 'New add Category failed, Please try again.');

    }
    redirect('backend/category/index');*/
  //} 

  $data['template']='backend/category/test'; 
  $this->load->view('templates/backend/layout', $data);
} 

 


  
}

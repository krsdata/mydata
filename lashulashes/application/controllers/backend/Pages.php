<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
      if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }       
      $this->load->model('pages_model');
	}

	
	public function index($offset = 0)
    {	
       $data['page_title'] = 'Dashboard :: Admin Panel';
       $per_page = 10;
       $data['offset']=$offset;
        $data['news'] = $this->pages_model->pages($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/pages/index/';

        $config['total_rows'] = $this->pages_model->pages(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/pages/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

  public function add() 
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('pages_add')==TRUE)
      { 
           $inset['post_slug']=url_title($this->input->post('post_title'),'-');
           $inset['post_title']=$this->input->post('post_title');
           $inset['status']=$this->input->post('status');
           $inset['post_content']=$this->input->post('post_content');
           $inset['post_type']='page';
           $inset['created_at']=date('Y-m-d h:i:s');

          if($this->Common_model->insert('posts',$inset))
          {
            $this->session->set_flashdata('msg_success', 'Page added successfully.');
          }else{

           $this->session->set_flashdata('msg_error', 'New add Page failed, Please try again.');

          }
          redirect('backend/pages/index');
      } 

      $data['template']='backend/pages/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 



  public function edit($id=0,$offset = 0)
  {  
    $data['offset'] = $offset;
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('posts','',array('id'=>$id),'','');
    if(count($data['update'])<1) redirect('backend/pages/index/');
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    $this->session->set_userdata('newsid',$id);

    if($this->form_validation->run('page_edit')==TRUE)
    {
       $inset['post_slug']=url_title($this->input->post('post_title'),'-');
       $inset['post_title']=$this->input->post('post_title');
       $inset['status']=$this->input->post('status');
       $inset['post_content']=$this->input->post('post_content');
       $inset['updated_at']=date('Y-m-d h:i:s');
       if($this->Common_model->update('posts',$inset,array('id'=>$id)))
        {
          $this->session->set_flashdata('msg_success', 'Page updated successfully.');
        }else{
         $this->session->set_flashdata('msg_error', 'Page update failed, Please try again.');

        }
        redirect('backend/pages/index/'.$offset);              

    }
    $data['template']='backend/pages/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 



  public function delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/pages');
        if ($this->Common_model->delete('posts', array('id' => $news_id,'level !='=>1))) {
            $this->session->set_flashdata('msg_success', 'Page deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }
        redirect('backend/pages');

    }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/pages/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('posts', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Page status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/pages/index/'.$offset);  


    }

  public function slug_check($str)
   {
        $val=url_title($str,'-');
        $checkexist=$this->Admin_model->getColumnDataWhere('posts','',array('post_slug'=>$val),'','');      

      if (count($checkexist)>0)
      {
        $this->form_validation->set_message('slug_check', 'The %s  already exist.');
        return FALSE;
      }
      else
      {
        return TRUE;
      }
   }

   public function slug_check_edit($str)
   {
        $newsid=$this->session->userdata('newsid');
        $val=url_title($str,'-');
        $checkexist=$this->Admin_model->getColumnDataWhere('posts','',array('post_slug'=>$val,'id !='=>$newsid),'','');      
       
        if(count($checkexist)>0)
        {
          $this->form_validation->set_message('slug_check_edit', 'The %s field must contain a unique value.');
          return FALSE;
        }
        else
        {
          return TRUE;
        }
   }
 

   
	public function logout(){
			$this->session->sess_destroy();
		  redirect(base_url());
	}

}

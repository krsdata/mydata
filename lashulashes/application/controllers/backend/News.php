<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('news_model');
	}

	
	public function index($offset = 0)
    {	
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = 10;
        $data['offset']=$offset;
        $data['news'] = $this->news_model->news($offset, $per_page);
        $config = backend_pagination();
        $config['base_url'] = base_url() . 'backend/news/index/';
        $config['total_rows'] = $this->news_model->news(0, 0);
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['template'] = "backend/news/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

public function add() {  
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

  if($this->form_validation->run('news_add')==TRUE)
  { 
     
      if($this->session->userdata('features_image')): 
              $features_image=$this->session->userdata('features_image');
              $inset['news_image'] = $features_image['image'];  
              $inset['news_thumb'] = $features_image['thumb_image']; 
      endif;

     $inset['post_slug']=url_title($this->input->post('post_title'),'-');
     $inset['post_title']=$this->input->post('post_title');
     $inset['status']=$this->input->post('status');
     $inset['post_content']=$this->input->post('post_content');
     $inset['post_type']='news';
     $inset['created_at']=date('Y-m-d h:i:s');

    if($this->Common_model->insert('posts',$inset))
    {
      if($this->session->userdata('features_image')):
        $this->session->unset_userdata('features_image');
        
      endif; 
      $this->session->set_flashdata('msg_success', 'News added successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'New add news failed, Please try again.');
    }
    redirect('backend/news/index');
  } 

  $data['template']='backend/news/add'; 
  $this->load->view('templates/backend/layout', $data);
} 



  public function edit($id=0,$offset=0)
  {
  $data['offset'] = $offset; 
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('posts','',array('id'=>$id),'','');
  if(count($data['update'])<1) redirect('backend/news/index/');
  $detail = $data['update'][0];
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
  $this->session->set_userdata('newsid',$id);

  if($this->form_validation->run('news_edit')==TRUE)
  {
      if($this->session->userdata('features_image')): 
              $features_image=$this->session->userdata('features_image');
              $inset['news_image'] = $features_image['image'];  
              $inset['news_thumb'] = $features_image['thumb_image']; 
      endif;

     $inset['post_slug']=url_title($this->input->post('post_title'),'-');
     $inset['post_title']=$this->input->post('post_title');
     $inset['status']=$this->input->post('status');
     $inset['post_content']=$this->input->post('post_content');
     $inset['updated_at']=date('Y-m-d h:i:s');

    if($this->Common_model->update('posts',$inset,array('id'=>$id)))
    {
      if($this->session->userdata('features_image')):
        $this->session->unset_userdata('features_image');
        if(!empty($detail->news_image) && file_exists($detail->news_image)) { @unlink($detail->news_image);}
        if(!empty($detail->news_thumb) && file_exists($detail->news_thumb)) { @unlink($detail->news_thumb);}
      endif;
      $this->session->set_flashdata('msg_success', 'News updated successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'News update failed, Please try again.');

    }
    redirect('backend/news/index');              

    }
    $data['template']='backend/news/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 

 /* public function features_image_check_add($str)
  {     
    
      if($this->session->userdata('features_image')){       
        return TRUE;

      }else{
        $param=array(
          'file_name'    => 'features_image',
          'upload_path'  => './assets/uploads/news/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/news/',
          'new_image'    => './assets/uploads/news/thumb/',
          'encrypt_name' => TRUE,
          'min_height'   => 300,
          'min_width'    => 300,
          'max_height'   => 786,
          'max_width'    => 1024,
          'resize_width' => 300,
          'resize_height'=> 300
          );        
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){

          $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{ 

          $this->form_validation->set_message('features_image_check_add', $upload_file['FILE_ERROR']);        
          return FALSE;
        }
      }
      
  }*/

  public function features_image_check_edit($str)
  {      
    if(!empty($_FILES['features_image']['name'])):
      if($this->session->userdata('features_image')){       
        return TRUE;
      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/news/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/news/',
          'new_image'    => './assets/uploads/news/thumb/',
          'encrypt_name' => TRUE,
          'min_height'   => 300,
          'min_width'    => 300,
          'max_height'   => 786,
          'max_width'    => 1024,
          'resize_width' => 300,
          'resize_height'=> 300

        );   
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){
          $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          //print_r(expression)
          return TRUE;    
        }else{      
          $this->form_validation->set_message('features_image_check_edit', $upload_file['FILE_ERROR']);       
          return FALSE;
        }
      }
    endif;
  }



  public function delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/news');
        $detail = $this->Common_model->get_row('posts',array('id'=>$news_id));
        if(empty($detail)) redirect('backend/news');
        if ($this->Common_model->delete('posts', array('id' => $news_id))) 
        {
            if(!empty($detail->news_image) && file_exists($detail->news_image)) { @unlink($detail->news_image);}
            if(!empty($detail->news_thumb) && file_exists($detail->news_thumb)) { @unlink($detail->news_thumb);}

            $this->session->set_flashdata('msg_success', 'News deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/news');

    }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/news/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('posts', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','News status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/news/index/'.$offset);  


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

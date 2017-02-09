<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
       if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('blogs_model');
	}

	
	public function index($offset = 0)
  {	
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = 10;
        $data['offset']=$offset;
        $data['news'] = $this->blogs_model->blogs($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/blogs/index/';

        $config['total_rows'] = $this->blogs_model->blogs(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/blogs/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

  public function add()
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
      $data['category']=$this->Admin_model->getColumnDataWhere('blog_category','*',array('status'=>'1'),'',''); 
      //$data['tag']=$this->Admin_model->getColumnDataWhere('blog_tags','id,tag_name,tag_slug',array('status'=>'1'),'','');
      
      $data['blog_tag_list'] = "[]";

      $detail = $this->Common_model->get_result('blogs',array('blog_status'=>1),array('blog_tag'));
      $temp = array();
      foreach ($detail as $value) 
      {
        //foreach(explode(',', $value->blog_tag) as $key)
        //{
          //$temp[] = $key;
        //}
        $temp[] = explode(',', $value->blog_tag);
      }
      $temp = array_reduce($temp, 'array_merge',array());
      if(count($temp) >0)
      {
        $temp = array_unique($temp);
        $temp = array_values($temp);
        $data['blog_tag_list'] = json_encode($temp);
      }
      
          if($this->form_validation->run('blogs_add')==TRUE)
          { 
            
              if($this->session->userdata('features_image')): 
                $features_image=$this->session->userdata('features_image');
                $inset['blog_image'] = $features_image['image'];  
                $inset['blog_thumb'] = $features_image['thumb_image']; 
              endif;
              
              $inset['blog_categoryid']=$this->input->post('blog_category');
              $inset['blog_tag']=$this->input->post('blog_tagid');
              $inset['blog_style']=$this->input->post('blog_style');
              $inset['blog_slug']=url_title($this->input->post('blog_title'),'-');
              $inset['blog_title']=$this->input->post('blog_title');
              $inset['blog_description']=$this->input->post('blog_description');
              $inset['blog_status']=$this->input->post('blog_status');
              $inset['blog_created']=date('Y-m-d h:i:s',strtotime($this->input->post('blog_created')));


              if($this->Common_model->insert('blogs',$inset))
              {

                  if($this->session->userdata('features_image')):
                      $this->session->unset_userdata('features_image');
                  endif;  
                  $this->session->set_flashdata('msg_success', 'Media post added successfully.');
              }
              else{

                  $this->session->set_flashdata('msg_error', 'New add media post failed, Please try again.');

              }
              redirect('backend/blogs/index');
          } 

          $data['template']='backend/blogs/add'; 
          $this->load->view('templates/backend/layout', $data);
  } 


  public function features_image_check_add($str)
  {     
    
      if($this->session->userdata('features_image')){       
        return TRUE;

      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/blog/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/blog/',
          'new_image'    => './assets/uploads/blog/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 500,
          'min_height'   => 500,
          'max_width'    => 700,
          'max_height'   => 700,
          'resize_width' => 500,
          'resize_height'=> 500,
          'maintain_ratio'=> FALSE,
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
      
  }

  public function features_image_check_edit($str)
  {      
      if(!empty($_FILES['features_image']['name'])):
        if($this->session->userdata('features_image')){       
        return TRUE;
      }
      else
      {
          $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/blog/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/blog/',
          'new_image'    => './assets/uploads/blog/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 500,
          'min_height'   => 500,
          'max_width'    => 700,
          'max_height'   => 700,
          'resize_width' => 500,
          'resize_height'=> 500,
          'maintain_ratio'=> FALSE,

          );   
          $upload_file=upload_file($param);
          if($upload_file['STATUS'])
          {
              $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
              //print_r(expression)
              return TRUE;    
          }
          else
          {      
              $this->form_validation->set_message('features_image_check_edit', $upload_file['FILE_ERROR']);       
              return FALSE;
          }
      }
      endif;
  }

  public function edit($id=0,$offset=0)
  { 
      $data['offset'] = $offset; 
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $data['update']=$this->Admin_model->getColumnDataWhere('blogs','',array('blog_id'=>$id),'','');
      if(count($data['update'])<1) redirect('backend/blogs/index/');

      $detail = $data['update'][0];
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
      $data['category']=$this->Admin_model->getColumnDataWhere('blog_category','*',array('status'=>'1'),'','');
      //$data['tag']=$this->Admin_model->getColumnDataWhere('blog_tags','id,tag_name,tag_slug',array('status'=>'1'),'','');  
      $this->session->set_userdata('blogid',$id);

      $data['blog_tag_list'] = "[]";

      $detail = $this->Common_model->get_result('blogs',array('blog_status'=>1),array('blog_tag'));
      $temp = array();
      foreach ($detail as $value) 
      {
        //foreach(explode(',', $value->blog_tag) as $key)
        //{
          //$temp[] = $key;
        //}
        $temp[] = explode(',', $value->blog_tag);
      }
      $temp = array_reduce($temp, 'array_merge',array());
      if(count($temp) >0)
      {
        $temp = array_unique($temp);
        $temp = array_values($temp);
        $data['blog_tag_list'] = json_encode($temp);
      }

      if($this->form_validation->run('blogs_edit')==TRUE)
      {

          if($this->session->userdata('features_image')): 
              $features_image=$this->session->userdata('features_image');
              $inset['blog_image'] = $features_image['image'];
              $inset['blog_thumb'] = $features_image['thumb_image'];               
          endif;

          $inset['blog_categoryid']=$this->input->post('blog_category');
          $inset['blog_tag']=$this->input->post('blog_tagid');
          $inset['blog_style']=$this->input->post('blog_style');
          $inset['blog_slug']=url_title($this->input->post('blog_title'),'-');
          $inset['blog_title']=$this->input->post('blog_title');
          $inset['blog_description']=$this->input->post('blog_description');
          $inset['blog_status']=$this->input->post('blog_status');
          $inset['blog_updated']=date('Y-m-d h:i:s');
          $inset['blog_created']=date('Y-m-d h:i:s',strtotime($this->input->post('blog_created')));


          if($this->Common_model->update('blogs',$inset,array('blog_id'=>$id)))
          {  
              if($this->session->userdata('features_image')):
                  $this->session->unset_userdata('features_image');
                  if(!empty($detail->blog_image) && file_exists($detail->blog_image)) { @unlink($detail->blog_image);}
                  if(!empty($detail->blog_thumb) && file_exists($detail->blog_thumb)) { @unlink($detail->blog_thumb);}
              endif;
              $this->session->set_flashdata('msg_success', 'Media post updated successfully.');
          }
          else
          {
              $this->session->set_flashdata('msg_error', 'Media post update failed, Please try again.');
          }
          redirect('backend/blogs/index/'.$offset);              

      }

      $data['template']='backend/blogs/edit';     
      $this->load->view('templates/backend/layout', $data);
  } 



  public function delete($news_id = 0)
  {

      if (empty($news_id)) redirect('backend/blogs');
      $detail = $this->Common_model->get_row('blogs',array('blog_id' => $news_id));
      if(empty($detail)) redirect('backend/blogs');
      if ($this->Common_model->delete('blogs', array('blog_id' => $news_id))) 
      {
          $this->session->set_flashdata('msg_success', 'Media post deleted successfully.');
          if(!empty($detail->blog_image) && file_exists($detail->blog_image)) { @unlink($detail->blog_image);}
          if(!empty($detail->blog_thumb) && file_exists($detail->blog_thumb)) { @unlink($detail->blog_thumb);}
      }
      else
      {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }
      redirect('backend/blogs');

  }


  public function status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/blogs/');
      if($status==0)
      {
          $cat_status=1;
      }
      if($status==1)
      {
          $cat_status=0;
      }       
      $data = array('blog_status'=>$cat_status);
      if($this->Common_model->update('blogs', $data ,array('blog_id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Media post status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
      }
      redirect('backend/blogs/index/'.$offset);
  }

  public function check_blogtitle($str)
  {
    $id=$this->session->userdata('blogid');
    $check = $this->Common_model->get_row('blogs',array('blog_id !='=>$id,'blog_title'=>$str));
    if($check)
    { 
        $this->form_validation->set_message('check_blogtitle',"The blog title field must contain a unique value.");
        return FALSE;
    }
    else
    {
        return TRUE;
    }
  } 

  public function comment_list($blog_id,$offset=0)
  { 
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = 10;
      $data['offset']=$offset;
      $data['news'] = $this->blogs_model->comment_list($offset,$per_page,$blog_id);
      $config = backend_pagination();

      $config['base_url'] = base_url().'backend/blogs/comment_list/'.$blog_id.'/';

      $config['total_rows'] = $this->blogs_model->comment_list(0, 0,$blog_id);
      $config['uri_segment'] = 5;

      $config['per_page'] = $per_page;

      $this->pagination->initialize($config);

      $data['pagination'] = $this->pagination->create_links();
     
      $data['template'] = "backend/blogs/comment_index";
      $this->load->view('templates/backend/layout', $data);     
  } 

  public function comment_status($id="",$blog_id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/blogs/');
      if($status==0)
      {
          $cat_status=1;
      }
      if($status==1)
      {
          $cat_status=0;
      }       
      $data = array('status'=>$cat_status);
      if($this->Common_model->update('blog_comment', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Comment status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
      }
      redirect('backend/blogs/comment_list/'.$blog_id.'/'.$offset);
  }

  public function comment_delete($blog_id=0,$comment_id=0)
  {
      if ($this->Common_model->delete('blog_comment', array('id' => $comment_id))) 
      {
          $this->session->set_flashdata('msg_success', 'Comment deleted successfully.');
      }
      else
      {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }
      redirect('backend/blogs/comment_list/'.$blog_id);

  }
}

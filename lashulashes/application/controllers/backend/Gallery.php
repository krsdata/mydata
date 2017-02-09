<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
      $this->load->model('gallery_model');
	}

	
	public function index($offset = 0)
    {	
       $data['page_title'] = 'Dashboard :: Admin Panel';
       
        $per_page = 10;
        $data['offset']=$offset;
        $data['gallery'] = $this->gallery_model->gallery($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/gallery/index/';

        $config['total_rows'] = $this->gallery_model->gallery(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
       
        $data['template'] = "backend/gallery/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

public function add() {  

  if($this->gallery_model->gallery(0, 0) >19)
  {
    $this->session->set_flashdata('msg_error', 'Maximum 20 images are allowed in Gallery.');
    redirect('backend/gallery/index');
  }
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
   
  if($this->form_validation->run('gallery_add')==TRUE)
  { 
     if($this->session->userdata('features_image')): 
          $features_image=$this->session->userdata('features_image');
          $inset['gallery_image'] = $features_image['image'];  
          $inset['thumb_image'] = $features_image['thumb_image']; 
        endif;
     
     $inset['gallery_title']=$this->input->post('gallery_title');
     $inset['status']=$this->input->post('status');
     $inset['created_at']=date('Y-m-d h:i:s');

    if($this->Common_model->insert('gallery',$inset))
    {  if($this->session->userdata('features_image')):
            $this->session->unset_userdata('features_image');
          endif;    
      $this->session->set_flashdata('msg_success', 'Image added successfully.');
    }else{

     $this->session->set_flashdata('msg_error', 'New add image failed, Please try again.');

    }
    redirect('backend/gallery/index');
  } 

  $data['template']='backend/gallery/add'; 
  $this->load->view('templates/backend/layout', $data);
} 


  
  public function edit($id=0,$offset=0)
  {  
  $data['offset'] = $offset;
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('gallery','',array('id'=>$id),'','');
  if(!$data['update']) redirect('backend/gallery/');
  
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

    if($this->form_validation->run('gallery_edit')==TRUE)
    {
        $data['update'] = $data['update'][0];
       /* print_r($data['update']);
        die();*/
        if($this->session->userdata('features_image')): 
            $features_image=$this->session->userdata('features_image');
            $inset['gallery_image'] = $features_image['image'];  
        endif;
        $inset['gallery_title']=$this->input->post('gallery_title');
        $inset['status']=$this->input->post('status');

      if($this->Common_model->update('gallery',$inset,array('id'=>$id)))
      {
          if($this->session->userdata('features_image'))
          {
             if(!empty($data['update']->gallery_image) && file_exists($data['update']->gallery_image))
             {
                @unlink($data['update']->gallery_image);
             }
            $this->session->unset_userdata('features_image');
          } 
        $this->session->set_flashdata('msg_success', 'Image updated successfully.');
      }
      else
      {
       $this->session->set_flashdata('msg_error', 'Image update failed, Please try again.');

      }
      redirect('backend/gallery/index/'.$offset);              

    }
    $data['template']='backend/gallery/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 

 public function features_image_check_add($str){     
    
      if($this->session->userdata('features_image')){       
        return TRUE;

      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/gallery/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => FALSE,
          'source_image' => './assets/uploads/gallery/',
          'new_image'    => './assets/uploads/gallery/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 350,
          'min_height'   => 235,
          //'max_width'    => 1024,
          //'max_height'   => 750,

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

  public function features_image_check_edit($str){      
    if(!empty($_FILES['features_image']['name'])):
      if($this->session->userdata('features_image')){       
        return TRUE;
      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/gallery/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => FALSE,
          'source_image' => './assets/uploads/gallery/',
          'new_image'    => './assets/uploads/gallery/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 350,
          'min_height'   => 235,
          //'max_width'    => 1024,
          //'max_height'   => 750,
        );      
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){
          $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{      
          $this->form_validation->set_message('features_image_check_edit', $upload_file['FILE_ERROR']);       
          return FALSE;
        }
      }
    endif;
  }



  public function delete($news_id =0)
   {

        if (empty($news_id)) redirect('backend/gallery');
        $detail = $this->Common_model->get_row('gallery',array('id'=>$news_id));
        if(!$detail) redirect('backend/gallery');
        if ($this->Common_model->delete('gallery', array('id' => $news_id))) 
        {
           //$file=$image1.'/'.$image2.'/'.$image3.'/'.$image4; 
            if(!empty($detail->gallery_image) && file_exists($detail->gallery_image)) { @unlink($detail->gallery_image);}
            if(!empty($detail->thumb_image) && file_exists($detail->thumb_image)) { @unlink($detail->thumb_image);}
            $this->session->set_flashdata('msg_success', 'Image deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

      redirect('backend/gallery');

    }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/gallery/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('gallery', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Image status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/gallery/index/'.$offset);  


    }




 


  
}

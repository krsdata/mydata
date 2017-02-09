<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('testimonials_model');
	}

	
	public function index($offset = 0)
    {	
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = 10;
        $data['offset']=$offset;
        $data['news'] = $this->testimonials_model->testimonials($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/testimonials/index/';

        $config['total_rows'] = $this->testimonials_model->testimonials(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/testimonials/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

    public function add() 
    {  
          $data['page_title'] = 'Dashboard :: Admin Panel'; 
          $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

          if($this->form_validation->run('testimonial_add')==TRUE)
          { 
            
             if($this->session->userdata('features_image')): 
                  $features_image=$this->session->userdata('features_image');
                  $inset['featured_photo'] = $features_image['image'];  
                  $inset['thumb']         = $features_image['thumb_image']; 
                 endif;

                   $inset['client_name']=$this->input->post('client_name');
                   $inset['location']=$this->input->post('location');
                   $inset['status']=$this->input->post('status');
                   $inset['feedback']=$this->input->post('feedback');
                
            

            if($this->Common_model->insert('testimonials',$inset))
            {     
                  if($this->session->userdata('features_image')):
                    $this->session->unset_userdata('features_image');
                  endif; 
                  $this->session->set_flashdata('msg_success', 'Testimonial added successfully.');

            }else{

             $this->session->set_flashdata('msg_error', 'New add testimonial failed, Please try again.');

            }
            redirect('backend/testimonials/index');
          } 

          $data['template']='backend/testimonials/add'; 
          $this->load->view('templates/backend/layout', $data);
    } 


    public function testimonial_image_check_add($str)
    {  
      if($this->session->userdata('features_image')){      
        return TRUE;

      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/testimonial/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/testimonial/',
          'new_image'    => './assets/uploads/testimonial/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 300,
          'min_height'   => 300,
          'max_width'    => 500,
          'max_height'   => 500,
          'resize_width' => 300,
          'resize_height'=> 300,
          'maintain_ratio'=> FALSE,
          );
      
        
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){

          $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{ 

          $this->form_validation->set_message('testimonial_image_check_add', $upload_file['FILE_ERROR']);        
          return FALSE;
        }
      }
      
  }


  public function testimonial_image_check_edit($str)
  {      
    if(!empty($_FILES['features_image']['name'])):
      if($this->session->userdata('features_image')){       
        return TRUE;
      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/testimonial/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/testimonial/',
          'new_image'    => './assets/uploads/testimonial/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 300,
          'min_height'   => 300,
          'max_width'    => 500,
          'max_height'   => 500,
          'resize_width' => 300,
          'resize_height'=> 300,
          'maintain_ratio'=> FALSE,
        );      
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){
          $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{      
          $this->form_validation->set_message('testimonial_image_check_edit', $upload_file['FILE_ERROR']);       
          return FALSE;
        }
      }
    endif;
  }

  public function edit($id=0,$offset=0)
  {  
      $data['offset'] = $offset;
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $data['update']=$this->Admin_model->getColumnDataWhere('testimonials','',array('id'=>$id),'','');
      if(count($data['update'])<1) redirect('backend/testimonials/');
      $detail = $data['update'][0];
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('testimonial_edit')==TRUE)
      {
         
          if($this->session->userdata('features_image')): 
              $features_image=$this->session->userdata('features_image');
              $inset['featured_photo'] = $features_image['image'];
              $inset['thumb']          = $features_image['thumb_image'];          
          endif;

         $inset['client_name']=$this->input->post('client_name');
         $inset['location']=$this->input->post('location');
         $inset['status']=$this->input->post('status');
         $inset['feedback']=$this->input->post('feedback');


        if($this->Common_model->update('testimonials',$inset,array('id'=>$id)))
        {
            if($this->session->userdata('features_image')):
              $this->session->unset_userdata('features_image');
              if(!empty($detail->featured_photo) && file_exists($detail->featured_photo)) { @unlink($detail->featured_photo);}
              if(!empty($detail->thumb) && file_exists($detail->thumb)) { @unlink($detail->thumb);}
            endif;  
          $this->session->set_flashdata('msg_success', 'Testimonial updated successfully.');
        }
        else{
         $this->session->set_flashdata('msg_error', 'Testimonial update failed, Please try again.');

        }
        redirect('backend/testimonials/index/'.$offset);              

      }
      $data['template']='backend/testimonials/edit';     
      $this->load->view('templates/backend/layout', $data);
  } 



  public function delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/testimonials');
        $detail = $this->Common_model->get_row('testimonials', array('id' => $news_id));
        if(empty($detail)) redirect('backend/testimonials');
        if ($this->Common_model->delete('testimonials', array('id' => $news_id))) {
            if(!empty($detail->featured_photo) && file_exists($detail->featured_photo)) { @unlink($detail->featured_photo);}
            if(!empty($detail->thumb) && file_exists($detail->thumb)) { @unlink($detail->thumb);}
            $this->session->set_flashdata('msg_success', 'Testimonial deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/testimonials');

  }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/testimonials/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('testimonials', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Testimonials status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/testimonials/index/'.$offset);  


    }

 


  
}

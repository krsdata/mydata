<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       // get_result_pagination($tablename,$offset =0,$per_page ='',$condition=array(),$orderby='')
	}

	
	public function index($offset = 0)
    {	
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = 10;
        $data['offset']=$offset;
        $data['about'] = $this->Common_model->get_result_pagination('about',$offset, $per_page,array('type'=>'about'));

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/about/index/';

        $config['total_rows'] = $this->Common_model->get_result_pagination('about',0,0,array('type'=>'about'));

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/aboutus/about/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

  public function add() 
  {  
        $data['page_title'] = 'Dashboard :: Admin Panel'; 
        $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

        if($this->form_validation->run('about_add')==TRUE)
        { 
          
          if($this->session->userdata('features_image')): 
            $features_image=$this->session->userdata('features_image');
            $inset['image'] = $features_image['image'];  
            $inset['thumb']         = $features_image['thumb_image']; 
          endif;

          $inset['title']   = $this->input->post('title');
          $inset['content'] = $this->input->post('content');
          $inset['status']  = $this->input->post('status');
          $inset['type']    = 'about';
          

          if($this->Common_model->insert('about',$inset))
          {     
                if($this->session->userdata('features_image')):
                  $this->session->unset_userdata('features_image');
                endif; 
                $this->session->set_flashdata('msg_success', 'About added successfully.');

          }else{

           $this->session->set_flashdata('msg_error', 'New add about failed, Please try again.');

          }
          redirect('backend/about/index');
        } 

        $data['template']='backend/aboutus/about/add'; 
        $this->load->view('templates/backend/layout', $data);
  } 


  public function about_image_check_add($str)
  {  
      if($this->session->userdata('features_image')){      
        return TRUE;

      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/about/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/about/',
          'new_image'    => './assets/uploads/about/thumb/',
          'encrypt_name' => TRUE,
          'min_height'   => 300,
          'min_width'    => 300,
          'max_height'   => 500,
          'max_width'    => 500,
          'resize_width' => 300,
          'resize_height'=> 300,
          'maintain_ratio'=> FALSE,

          );
      
        
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){

          $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{ 

          $this->form_validation->set_message('about_image_check_add', $upload_file['FILE_ERROR']);        
          return FALSE;
        }
      }
    
  }


  public function about_image_check_edit($str)
  {      
    if(!empty($_FILES['features_image']['name'])):
      if($this->session->userdata('features_image')){       
        return TRUE;
      }else{
        $param=array(
          'file_name' =>'features_image',
          'upload_path'  => './assets/uploads/about/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/about/',
          'new_image'    => './assets/uploads/about/thumb/',
          'encrypt_name' => TRUE,
          'min_height'   => 300,
          'min_width'    => 300,
          'max_height'   => 786,
          'max_width'    => 1024,
          'resize_width' => 300,
          'resize_height'=> 300,
          'maintain_ratio'=> FALSE,
        );      
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){
          $this->session->set_userdata('features_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{      
          $this->form_validation->set_message('about_image_check_edit', $upload_file['FILE_ERROR']);       
          return FALSE;
        }
      }
    endif;
  }

  public function edit($id=0,$offset=0)
  {  
      $data['offset'] = $offset;
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $data['update']=$this->Admin_model->getColumnDataWhere('about','',array('id'=>$id,'type'=>'about'),'','');
      if(count($data['update'])<1) redirect('backend/about/');
      $detail = $data['update'][0];
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('about_edit')==TRUE)
      {
         
          if($this->session->userdata('features_image')): 
              $features_image=$this->session->userdata('features_image');
              $inset['image']   = $features_image['image'];
              $inset['thumb']   = $features_image['thumb_image'];          
          endif;

          $inset['title']=$this->input->post('title');
          $inset['content']=$this->input->post('content');
          $inset['status']=$this->input->post('status');


        if($this->Common_model->update('about',$inset,array('id'=>$id)))
        {
            if($this->session->userdata('features_image')):
                $this->session->unset_userdata('features_image');
                if(!empty($detail->image) && file_exists($detail->image)) { @unlink($detail->image);}
                if(!empty($detail->thumb) && file_exists($detail->thumb)) { @unlink($detail->thumb);}
            endif;  
          $this->session->set_flashdata('msg_success', 'About updated successfully.');
        }
        else{
         $this->session->set_flashdata('msg_error', 'About update failed, Please try again.');

        }
        redirect('backend/about/index/'.$offset);              

      }
      $data['template']='backend/aboutus/about/edit';     
      $this->load->view('templates/backend/layout', $data);
  } 

  public function delete($news_id = 0)
  {
        if (empty($news_id)) redirect('backend/about');
        $detail = $this->Common_model->get_row('about', array('id' => $news_id,'type'=>'about'));
        if(empty($detail)) redirect('backend/about');
        if ($this->Common_model->delete('about', array('id' => $news_id))) {
            if(!empty($detail->image) && file_exists($detail->image)) { @unlink($detail->image);}
            if(!empty($detail->thumb) && file_exists($detail->thumb)) { @unlink($detail->thumb);}
            $this->session->set_flashdata('msg_success', 'About deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/about');
  }


  public function status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/about/');
      if($status==0){
          $cat_status=1;
      }

      if($status==1){
          $cat_status=0;
      }       

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('about', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','About status has been updated successfully.');
      }
      else{
        $this->session->set_flashdata('msg_error', 'About updated failed, Please try again.');

      }
      redirect('backend/about/index/'.$offset);  

  }

  public function team($offset = 0)
  { 
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = 10;
        $data['offset']=$offset;
        $data['about'] = $this->Common_model->get_result_pagination('about',$offset, $per_page,array('type'=>'team'));

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/about/team/';

        $config['total_rows'] = $this->Common_model->get_result_pagination('about',0,0,array('type'=>'team'));

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/aboutus/team/index";
        $this->load->view('templates/backend/layout', $data);
  }

  public function team_add() 
  {  
        $data['page_title'] = 'Dashboard :: Admin Panel'; 
        $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

        if($this->form_validation->run('team_add')==TRUE)
        { 
          
          if($this->session->userdata('features_image')): 
            $features_image=$this->session->userdata('features_image');
            $inset['image']   = $features_image['image'];  
            $inset['thumb']   = $features_image['thumb_image']; 
          endif;

          $inset['title']   = $this->input->post('title');
          $inset['content'] = $this->input->post('content');
          $inset['post']    = $this->input->post('post');
          $inset['status']  = $this->input->post('status');
          $inset['type']    = 'team';
          

          if($this->Common_model->insert('about',$inset))
          {     
                if($this->session->userdata('features_image')):
                  $this->session->unset_userdata('features_image');
                endif; 
                $this->session->set_flashdata('msg_success', 'Team added successfully.');

          }else{

           $this->session->set_flashdata('msg_error', 'New add team failed, Please try again.');

          }
          redirect('backend/about/team');
        } 

        $data['template']='backend/aboutus/team/add'; 
        $this->load->view('templates/backend/layout', $data);
  }

  public function team_edit($id=0,$offset=0)
  {  
      $data['offset'] = $offset;
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $data['update']=$this->Admin_model->getColumnDataWhere('about','',array('id'=>$id,'type'=>'team'),'','');
      if(count($data['update'])<1) redirect('backend/about/team');
      $detail = $data['update'][0];
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('team_edit')==TRUE)
      {
         
          if($this->session->userdata('features_image')): 
              $features_image=$this->session->userdata('features_image');
              $inset['image']   = $features_image['image'];
              $inset['thumb']   = $features_image['thumb_image'];          
          endif;

          $inset['title']=$this->input->post('title');
          $inset['content']=$this->input->post('content');
          $inset['post']=$this->input->post('post');
          $inset['status']=$this->input->post('status');


        if($this->Common_model->update('about',$inset,array('id'=>$id)))
        {
            if($this->session->userdata('features_image')):
                $this->session->unset_userdata('features_image');
                if(!empty($detail->image) && file_exists($detail->image)) { @unlink($detail->image);}
                if(!empty($detail->thumb) && file_exists($detail->thumb)) { @unlink($detail->thumb);}
            endif;  
          $this->session->set_flashdata('msg_success', 'Team updated successfully.');
        }
        else{
         $this->session->set_flashdata('msg_error', 'Team update failed, Please try again.');

        }
        redirect('backend/about/team/'.$offset);              

      }
      $data['template']='backend/aboutus/team/edit';     
      $this->load->view('templates/backend/layout', $data);
  }

  public function team_delete($news_id = 0)
  {
      if (empty($news_id)) redirect('backend/about/team');
      $detail = $this->Common_model->get_row('about', array('id' => $news_id,'type'=>'team'));
      if(empty($detail)) redirect('backend/about/team');
      if ($this->Common_model->delete('about', array('id' => $news_id))) {
          if(!empty($detail->image) && file_exists($detail->image)) { @unlink($detail->image);}
          if(!empty($detail->thumb) && file_exists($detail->thumb)) { @unlink($detail->thumb);}
          $this->session->set_flashdata('msg_success', 'Team member deleted successfully.');
      } else {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }
      redirect('backend/about/team');
  }

  public function team_status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/about/team');
      if($status==0){
          $cat_status=1;
      }

      if($status==1){
          $cat_status=0;
      }       

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('about', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Member status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Memeber updated failed, Please try again.');

      }
      redirect('backend/about/team/'.$offset);  

  }

  public function charity($offset = 0)
  { 
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = 10;
        $data['offset']=$offset;
        $data['about'] = $this->Common_model->get_result_pagination('about',$offset, $per_page,array('type'=>'charity'));

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/about/charity/';

        $config['total_rows'] = $this->Common_model->get_result_pagination('about',0,0,array('type'=>'charity'));

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/aboutus/charity/index";
        $this->load->view('templates/backend/layout', $data);
  }

  public function charity_add() 
  {  
        $data['page_title'] = 'Dashboard :: Admin Panel'; 
        $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

        if($this->form_validation->run('charity_add')==TRUE)
        { 

          $inset['title']         = $this->input->post('title');
          $inset['short_content'] = $this->input->post('short_content');
          $inset['content']       = $this->input->post('content');
          $inset['date']          = date('Y-m-d h:i:s',strtotime($this->input->post('date')));
          $inset['status']        = $this->input->post('status');
          $inset['type']          = 'charity';
          

          if($this->Common_model->insert('about',$inset))
          {      
              $this->session->set_flashdata('msg_success', 'Charity added successfully.');

          }else{

              $this->session->set_flashdata('msg_error', 'New add charity failed, Please try again.');

          }
          redirect('backend/about/charity');
        } 

        $data['template']='backend/aboutus/charity/add'; 
        $this->load->view('templates/backend/layout', $data);
  }

  public function charity_edit($id=0,$offset=0)
  {  
      $data['offset'] = $offset;
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $data['update']=$this->Admin_model->getColumnDataWhere('about','',array('id'=>$id,'type'=>'charity'),'','');
      if(count($data['update'])<1) redirect('backend/about/charity');
      $detail = $data['update'][0];
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('charity_edit')==TRUE)
      {

          $inset['title']         = $this->input->post('title');
          $inset['short_content'] = $this->input->post('short_content');
          $inset['content']       = $this->input->post('content');
          $inset['date']          = date('Y-m-d h:i:s',strtotime($this->input->post('date')));
          $inset['status']        = $this->input->post('status');


        if($this->Common_model->update('about',$inset,array('id'=>$id)))
        { 
          $this->session->set_flashdata('msg_success', 'Charity updated successfully.');
        }
        else
        {
         $this->session->set_flashdata('msg_error', 'Charity update failed, Please try again.');
        }
        redirect('backend/about/charity/'.$offset);              

      }
      $data['template']='backend/aboutus/charity/edit';     
      $this->load->view('templates/backend/layout', $data);
  }

  public function charity_delete($news_id = 0)
  {
      if (empty($news_id)) redirect('backend/about/charity');
      $detail = $this->Common_model->get_row('about', array('id' => $news_id));
      if(empty($detail)) redirect('backend/about/charity');
      if ($this->Common_model->delete('about', array('id' => $news_id))) {
          $this->session->set_flashdata('msg_success', 'Charity member deleted successfully.');
      } else {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }
      redirect('backend/about/charity');
  }

  public function charity_status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/about/charity');
      if($status==0){
          $cat_status=1;
      }

      if($status==1){
          $cat_status=0;
      }       

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('about', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Charity status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Charity updated failed, Please try again.');

      }
      redirect('backend/about/charity/'.$offset);  

  }

}

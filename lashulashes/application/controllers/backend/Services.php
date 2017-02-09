<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {

	public function __construct()
 	{
      parent::__construct();
      if(superadmin_logged_in()==FALSE)
      redirect('backend/login');       
      $this->load->model('services_model');
	}


  public function categories($offset = 0)
  { 
    $data['page_title'] = 'Dashboard :: Admin Panel';
    $per_page = RECORDS_PER_PAGE;
    $data['offset']=$offset;
    $data['categories'] = $this->services_model->categories($offset, $per_page);
    $config = backend_pagination();
    $config['base_url'] = base_url() . 'backend/services/categories/';
    $config['total_rows'] = $this->services_model->categories(0, 0);
    $config['per_page'] = $per_page;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();
    $data['template'] = "backend/services/categories/index";
    $this->load->view('templates/backend/layout', $data);
  }

  public function categories_add()
  {    
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    if($this->form_validation->run('services_category_add')== TRUE)
    {
      $inset = array(
                      'parent_id'     => 0,
                      'sub_parent_id' => 0,
                      'price_status'  => 0,
                      'name'          => $this->input->post('name'),
                      'detail'        => $this->input->post('detail'),
                      'status'        => $this->input->post('status'),
                      'orders'        => 1
                    );

      if($this->session->userdata('service_image')): 
                $features_image  = $this->session->userdata('service_image');  
                $inset['image']  = $features_image['thumb_image']; 
      endif;

      if( $this->Common_model->insert('services_category',$inset))
      {
        $this->session->set_flashdata('msg_success', 'Service added successfully.');
        if($this->session->userdata('service_image')):
            $this->session->unset_userdata('service_image');
        endif;
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'New add category failed, Please try again.');
      }
      redirect('backend/services/categories');
    }

    $data['template'] = "backend/services/categories/add";
    $this->load->view('templates/backend/layout', $data);
  }

  public function categories_edit($id=0,$offset=0)
  {
    $data['offset'] = $offset;  
    $data['detail'] = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id'=>0));
    if(!$data['detail']) redirect('backend/services/categories/'.$offset);
    
    $this->session->set_userdata('category_id',$id);

    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    if($this->form_validation->run('services_category_edit')==TRUE)
    {
        $inset = array(
                      'parent_id'=> 0,
                      'sub_parent_id' => 0,
                      'price_status'  => 0,
                      'name'     => $this->input->post('name'),
                      'detail'   => $this->input->post('detail'),
                      'status'   => $this->input->post('status'),
                      'orders'   => 1
                    );
        if($this->session->userdata('service_image')): 
              $features_image = $this->session->userdata('service_image');
              $inset['image'] = $features_image['thumb_image'];          
        endif;

        if($this->Common_model->update('services_category',$inset,array('id'=>$id,'parent_id'=>0)))
        {
          $this->session->set_flashdata('msg_success', 'Service updated successfully.');

          if($this->session->userdata('service_image')):
              if(!empty($data['detail']->image) && file_exists($data['detail']->image)) { @unlink($data['detail']->image); }
              $temp = str_replace('thumb/','', $data['detail']->image);
              if(!empty($temp) && file_exists($temp)) { @unlink($temp); }
              $this->session->unset_userdata('service_image');  
          endif;
        }
        else
        {
          $this->session->set_flashdata('msg_error', 'Updation failed, Please try again.');
        }
        redirect('backend/services/categories/'.$offset);
    }
    $data['template'] = "backend/services/categories/edit";
    $this->load->view('templates/backend/layout', $data);
  }

  public function services_image_check_add($str)
  {
    if($this->session->userdata('service_image')){      
        return TRUE;

      }else{
        $param=array(
          'file_name' =>'service_image',
          'upload_path'  => './assets/uploads/services/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/services/',
          'new_image'    => './assets/uploads/services/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 400,
          'min_height'   => 400,
          'max_width'    => 600,
          'max_height'   => 600,
          'resize_width' => 400,
          'resize_height'=> 400,
          'maintain_ratio'=> FALSE,
          );
      
        
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){

          $this->session->set_userdata('service_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{ 

          $this->form_validation->set_message('services_image_check_add', $upload_file['FILE_ERROR']);        
          return FALSE;
        }
      }
  }

  public function services_image_check_edit($str)
  {      
    if(!empty($_FILES['service_image']['name'])):
      if($this->session->userdata('service_image')){       
        return TRUE;
      }else{
        $param=array(
          'file_name' =>'service_image',
          'upload_path'  => './assets/uploads/services/',
          'allowed_types'=> 'gif|jpg|png|jpeg',
          'image_resize' => TRUE,
          'source_image' => './assets/uploads/services/',
          'new_image'    => './assets/uploads/services/thumb/',
          'encrypt_name' => TRUE,
          'min_width'    => 400,
          'min_height'   => 400,
          'max_width'    => 600,
          'max_height'   => 600,
          'resize_width' => 400,
          'resize_height'=> 400,
          'maintain_ratio'=> FALSE,
        );      
        $upload_file=upload_file($param);
        if($upload_file['STATUS']){
          $this->session->set_userdata('service_image',array('image'=>$param['upload_path'].$upload_file['UPLOAD_DATA']['file_name'],'thumb_image'=>$param['new_image'].$upload_file['UPLOAD_DATA']['file_name']));      
          return TRUE;    
        }else{      
          $this->form_validation->set_message('services_image_check_edit', $upload_file['FILE_ERROR']);       
          return FALSE;
        }
      }
    endif;
  }

  public function check_updatecategory($str)
  {
    if($this->session->userdata('category_id'))
    {
      $id=$this->session->userdata('category_id');
      $this->session->unset_userdata('category_id');
      $where = array('id !='=>$id,'name'=>$str,'parent_id'=>0);
    }
    else
    {
      $id = 0;
      $where = array('name'=>$str,'parent_id'=>0);
    }
    if($this->Common_model->get_result('services_category',$where))
    {
      $this->form_validation->set_message('check_updatecategory',"The service name field must contain a unique value.");
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }


  public function categories_delete($id = 0)
  {
    if(empty($id)) redirect('backend/services/categories');
    $detail = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id'=>0));
    if($detail)
    {  
      if($this->Common_model->delete('services_category', array('id'=>$id,'parent_id'=>0))) 
      {
          if(!empty($detail->image) && file_exists($detail->image)) { @unlink($detail->image); }
          $temp = str_replace('thumb/','', $detail->image);
          if(!empty($temp) && file_exists($temp)) { @unlink($temp); }

          $this->Common_model->delete('services_category', array('parent_id'=>$id));
          $this->session->set_flashdata('msg_success', 'Category deleted successfully.');
          
      } else {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }
    }else{
      $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }
    redirect('backend/services/categories');
  }

  public function categories_status($id="",$status="",$offset="")
  {
    if(empty($id)) redirect('backend/services/categories');
    if($status==0) $cat_status=1;
    if($status==1) $cat_status=0;

    $data = array('status'=>$cat_status);
    if($this->Common_model->update('services_category', $data ,array('id'=>$id)))
    {
       $this->session->set_flashdata('msg_success','Category status has been updated successfully.');
    }
    else
    {
      $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
    }
    redirect('backend/services/categories/'.$offset);  
  }

  public function sub_categories($id)
  {
    $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id'=>0));

    if(!$result) redirect('backend/services/categories/');
    $data['category_name'] = $result->name;
    $data['parent_id'] = $id;
    //$data['offset'] = $offset;
    $data['categories'] = $this->Common_model->get_result('services_category',array('parent_id'=>$id));
    $data['template'] = "backend/services/categories/sub_index";
    $this->load->view('templates/backend/layout', $data);
  }

  public function sub_categories_add($id)
  {
    $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id'=>0));
    if(!$result) redirect('backend/services/categories/');
    $data['category_name'] = $result->name;
    $data['parent_id'] = $id;

    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    if($this->form_validation->run('services_sub_category_add')==TRUE)
    {
        $inset = array(
                        'parent_id'     => $this->input->post('parent_id'),
                        'name'          => $this->input->post('name'),
                        'orders'        => 1,
                        'status'        => $this->input->post('status'),
                       );

        if(isset($_POST['price_status']))
        {
          $inset['price_status']  = 0;
        }
        else
        {
           $inset['price_status'] = 1;
        }

        if($this->Common_model->insert('services_category',$inset))
        {
            $this->session->set_flashdata('msg_success', 'Sub-Category added successfully.');
        }
        else
        {
          $this->session->set_flashdata('msg_error', 'New add sub category failed, Please try again.'); 
        }
        
        redirect('backend/services/sub_categories/'.$this->input->post('parent_id'));
    }

    $data['template'] = "backend/services/categories/sub_add";
    $this->load->view('templates/backend/layout', $data);
  }

  public function sub_categories_edit($id=0)
  {
    $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id !='=>0));
    if(!$result) redirect('backend/services/categories/');

    $data['detail'] = $result;
    $data['category_name'] = $result->name;
    $data['parent_id'] = $result->parent_id;
    
    $this->session->set_userdata('sub_category_id',$id);

    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    if($this->form_validation->run('services_sub_category_edit')==TRUE)
    {
        $inset = array(
                        'name'          => $this->input->post('name'),
                        'orders'        => 1,
                        'status'        => $this->input->post('status'),
                       );

        if(isset($_POST['price_status']))
        {
          $inset['price_status']  = 0; // It have childs.
        }
        else
        {
           $inset['price_status'] = 1; // It is final category , and no more childs.
        }
        
        
        if($this->Common_model->update('services_category',$inset,array('id'=>$id,'parent_id !='=>0)))
        {
            $this->session->set_flashdata('msg_success', 'Sub-Category updated successfully.');
            if($result->price_status == 0 && $inset['price_status'] == 1 )
            {
                $this->Common_model->delete('services_category', array('parent_id'=>$id));
            }
        }
        else
        {
          $this->session->set_flashdata('msg_error', 'Updation failed, Please try again.');
        }
        redirect('backend/services/sub_categories/'.$data['parent_id']);
    }
    $data['template'] = "backend/services/categories/sub_edit";
    $this->load->view('templates/backend/layout', $data);
  }

  public function check_updateSubCategory($str)
  {
      $parent_id = $this->input->post('parent_id');

      if($this->session->userdata('sub_category_id'))
      {
        $id=$this->session->userdata('sub_category_id');
        $this->session->unset_userdata('sub_category_id');
        $where = array('id !='=>$id,'name'=>$str,'parent_id'=>$parent_id);
      }
      else
      {
        $where = array('name'=>$str,'parent_id'=>$parent_id);
        $id = 0;
      }
      if($this->Common_model->get_result('services_category',$where))
      {
        $this->form_validation->set_message('check_updateSubCategory',"The category name field must contain a unique value.");
        return FALSE;
      }
      else
      {
        return TRUE;
      }
  }

  public function sub_categories_status($id="",$status="")
  {
      if(empty($id)) redirect('backend/services/categories');
      $result = $this->Common_model->get_row('services_category',array('id'=>$id));
      if(!$result) redirect('backend/services/categories');
      if($status==0) $cat_status=1;
      if($status==1) $cat_status=0;

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('services_category', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Category status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
      }
      redirect('backend/services/sub_categories/'.$result->parent_id);  
  }

  public function sub_categories_delete($id = 0)
  {
    
    if(empty($id)) redirect('backend/services/categories');
    $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id !='=>0));
    if(!$result) redirect('backend/services/categories');

    if($this->Common_model->delete('services_category', array('id'=>$id))) 
    {
        $this->Common_model->delete('services_category', array('parent_id'=>$id));
        $this->session->set_flashdata('msg_success', 'Category deleted successfully.');
    } else {
        $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }
    redirect('backend/services/sub_categories/'.$result->parent_id);
  }

  //////////////////////////////////////////////


  public function last_categories($id)
  {
      $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id !='=>0,'price_status'=>0));

      if(!$result) redirect('backend/services/categories/');
      $data['back']           = $result->parent_id;
      $data['category_name']  = $result->name;
      $data['parent_id']      = $id;
      $data['categories']     = $this->Common_model->get_result('services_category',array('parent_id'=>$id));
      $data['template']       = "backend/services/categories/last_index";
      $this->load->view('templates/backend/layout', $data);
  }

  public function last_categories_add($id)
  {
      $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id !='=>0,'price_status'=>0));
      if(!$result) redirect('backend/services/categories/');
      $data['category_name'] = $result->name;
      $data['parent_id'] = $id;

      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
      if($this->form_validation->run('services_last_category_add')==TRUE)
      {
          $inset = array(
                          'parent_id'     => $this->input->post('parent_id'),
                          'name'          => $this->input->post('name'),
                          'orders'        => 1,
                          'status'        => $this->input->post('status'),
                          'price_status'  => 1
                         );

          if($this->Common_model->insert('services_category',$inset))
          {
              $this->session->set_flashdata('msg_success', 'Sub-Category added successfully.');
          }
          else
          {
            $this->session->set_flashdata('msg_error', 'New add sub category failed, Please try again.'); 
          }
          
          redirect('backend/services/last_categories/'.$this->input->post('parent_id'));
      }

      $data['template'] = "backend/services/categories/last_add";
      $this->load->view('templates/backend/layout', $data);
  }

  public function last_categories_edit($id=0)
  {
    $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id !='=>0,'price_status !='=>0));
    if(!$result) redirect('backend/services/categories/');

    $data['detail'] = $result;
    $data['category_name'] = $result->name;
    $data['parent_id'] = $result->parent_id;
    
    $this->session->set_userdata('sub_category_id',$id);

    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    if($this->form_validation->run('services_last_category_edit')==TRUE)
    {
        $inset = array(
                        'name'          => $this->input->post('name'),
                        'orders'        => 1,
                        'status'        => $this->input->post('status'),
                       );
        
        if($this->Common_model->update('services_category',$inset,array('id'=>$id,'parent_id !='=>0)))
        {
            $this->session->set_flashdata('msg_success', 'Sub-Category updated successfully.');
        }
        else
        {
          $this->session->set_flashdata('msg_error', 'Updation failed, Please try again.');
        }
        redirect('backend/services/last_categories/'.$data['parent_id']);
    }
    $data['template'] = "backend/services/categories/last_edit";
    $this->load->view('templates/backend/layout', $data);
  }

  public function check_updateLastCategory($str)
  {
      $parent_id = $this->input->post('parent_id');

      if($this->session->userdata('sub_category_id'))
      {
        $id=$this->session->userdata('sub_category_id');
        $this->session->unset_userdata('sub_category_id');
        $where = array('id !='=>$id,'name'=>$str,'parent_id'=>$parent_id);
      }
      else
      {
        $where = array('name'=>$str,'parent_id'=>$parent_id);
        $id = 0;
      }
      if($this->Common_model->get_result('services_category',$where))
      {
        $this->form_validation->set_message('check_updateLastCategory',"The category name field must contain a unique value.");
        return FALSE;
      }
      else
      {
        return TRUE;
      }
  }

  public function last_categories_status($id="",$status="1")
  {
      if(empty($id)) redirect('backend/services/categories');
      $result = $this->Common_model->get_row('services_category',array('id'=>$id));
      if(!$result) redirect('backend/services/categories');
      if($status==0) $cat_status=1;
      if($status==1) $cat_status=0;

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('services_category', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Category status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
      }
      redirect('backend/services/last_categories/'.$result->parent_id);  
  }

  public function last_categories_delete($id = 0)
  {
    
    if(empty($id)) redirect('backend/services/categories');
    $result = $this->Common_model->get_row('services_category',array('id'=>$id,'parent_id !='=>0));
    if(!$result) redirect('backend/services/categories');

    if($this->Common_model->delete('services_category', array('id'=>$id))) 
    {
        $this->session->set_flashdata('msg_success', 'Category deleted successfully.');
    } else {
        $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }
    redirect('backend/services/last_categories/'.$result->parent_id);
  }
  //////////////////////////////////////////////

  public function artist()
  {
      $data['artist']       = $this->Common_model->get_result('services_artist','',array(),array('name','ASC'));
      $data['template']     = "backend/services/artist/index";
      $this->load->view('templates/backend/layout', $data);
  }

  public function artist_add()
  {
      
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
      if($this->form_validation->run('services_artist_add')==TRUE)
      {
          $inset = array();
          $inset['name'] = $this->input->post('name');
          $inset['timing'] = array(
                                    array($this->input->post('timeStart1'),$this->input->post('timeEnd1')),
                                    array($this->input->post('timeStart2'),$this->input->post('timeEnd2')),
                                    array($this->input->post('timeStart3'),$this->input->post('timeEnd3')),
                                    array($this->input->post('timeStart4'),$this->input->post('timeEnd4')),
                                    array($this->input->post('timeStart5'),$this->input->post('timeEnd5')),
                                    array($this->input->post('timeStart6'),$this->input->post('timeEnd6')),
                                    array($this->input->post('timeStart7'),$this->input->post('timeEnd7')),
                                  );
          $inset['timing'] = json_encode($inset['timing']);
          $inset['detail'] = $this->input->post('description');
          $inset['status'] = $this->input->post('status');

          if($this->session->userdata('service_image')): 
                $features_image  = $this->session->userdata('service_image');  
                $inset['image']  = $features_image['thumb_image']; 
          endif;

          if($insert_id = $this->Common_model->insert('services_artist',$inset))
          {
              $this->session->set_flashdata('msg_success', 'Artist added successfully.');

              if($this->session->userdata('service_image')):
                $this->session->unset_userdata('service_image');
              endif;
              redirect('backend/services/artist_edit/'.$insert_id);
          }
          else
          {
            $this->session->set_flashdata('msg_error', 'New add artist failed, Please try again.'); 
            redirect('backend/services/artist');
          }
          
      }

      $data['template'] = "backend/services/artist/add";
      $this->load->view('templates/backend/layout', $data);
  }

  public function check_updateArtist($str)
  {
      if($this->session->userdata('artistId'))
      {
        $id=$this->session->userdata('artistId');
        $this->session->unset_userdata('artistId');
        $where = array('id !='=>$id,'name'=>$str);
      
        if($this->Common_model->get_result('services_artist',$where))
        {
          $this->form_validation->set_message('check_updateArtist',"The artist name field must contain a unique value.");
          return FALSE;
        }
        else
        {
          return TRUE;
        }
      }
      else
      {
        $this->form_validation->set_message('check_updateArtist',"The artist name field must contain a unique value.");
        return FALSE;
      }
  }

  public function artist_edit($id='',$tab =0)
  {   
      $data['tab'] = $tab;
      $data['id']  = $id;
      if(empty($id)) redirect('backend/services/artist');
      $data['detail'] = $this->Common_model->get_row('services_artist',array('id'=>$id));
      $data['artist_offs']  = $this->Common_model->get_result('services_artist_offs',array('artist_id'=>$id),array(),array('date','DESC'));
      if(!$data['detail']) redirect('backend/services/artist');

      $this->session->set_userdata('artistId',$id);

      $data['categoryLevel1'] = $this->Common_model->get_result('services_category',array('parent_id'=>'0','status'=>1));

      $data['categoryLevel2'] = $this->Common_model->get_result('services_category',array('parent_id !='=>'0','price_status'=>0,'status'=>1));
      $data['categoryLevel2_index'] = array();
      if($data['categoryLevel2'])
      {
        foreach ($data['categoryLevel2'] as $key => $value2) 
        {
          $data['categoryLevel2_index'][] = $value2->parent_id;
        }
      }
      $data['categoryLevel2_index'] = array_unique($data['categoryLevel2_index']);

      $data['categoryLevel3'] = $this->Common_model->get_result('services_category',array('parent_id !='=>'0','price_status'=>1,'status'=>1));
      $data['categoryLevel3_index'] = array();

      if($data['categoryLevel3'])
      {
        foreach ($data['categoryLevel3'] as $key => $value) 
        {
          $data['categoryLevel3_index'][] = $value->parent_id;
        }
      }
      $data['categoryLevel3_index'] = array_unique($data['categoryLevel3_index']);

      if(isset($_POST['detail']))
      {
          $data['tab'] = 0;
          $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
          if($this->form_validation->run('services_artist_edit')==TRUE)
          {
              $inset= array( 
                              'name'   => $this->input->post('name'),
                              'status' => $this->input->post('status'),
                              'detail' => $this->input->post('description'),
                            );

              if($this->session->userdata('service_image')): 
                    $features_image = $this->session->userdata('service_image');
                    $inset['image'] = $features_image['thumb_image'];          
              endif;

              if($this->Common_model->update('services_artist',$inset, array('id'=>$id)))
              {
                if($this->session->userdata('service_image')):
                    if(!empty($data['detail']->image) && file_exists($data['detail']->image)) { @unlink($data['detail']->image); }
                    $temp = str_replace('thumb/','', $data['detail']->image);
                    if(!empty($temp) && file_exists($temp)) { @unlink($temp); }
                    $this->session->unset_userdata('service_image');  
                endif;

                $this->session->set_flashdata('msg_success', 'Artist detail updated successfully.');
              }
              else
              {
                $this->session->set_flashdata('msg_error', 'Please try again.'); 
              }
                
              redirect('backend/services/artist_edit/'.$id);
          }
      }

      if(isset($_POST['workingDays']))
      {
        $data['tab'] = 1;
            $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
            if($this->form_validation->run('services_working_days_edit')==TRUE)
            {
                $inset = array(
                                array($this->input->post('timeStart1'),$this->input->post('timeEnd1')),
                                array($this->input->post('timeStart2'),$this->input->post('timeEnd2')),
                                array($this->input->post('timeStart3'),$this->input->post('timeEnd3')),
                                array($this->input->post('timeStart4'),$this->input->post('timeEnd4')),
                                array($this->input->post('timeStart5'),$this->input->post('timeEnd5')),
                                array($this->input->post('timeStart6'),$this->input->post('timeEnd6')),
                                array($this->input->post('timeStart7'),$this->input->post('timeEnd7')),
                              );
                $inset = array( 
                                'timing' => json_encode($inset) 
                              );

                if($this->Common_model->update('services_artist',$inset, array('id'=>$id)))
                {
                  $this->session->set_flashdata('msg_success', 'Artist working days updated successfully.');
                }
                else
                {
                  $this->session->set_flashdata('msg_error', 'Please try again.'); 
                }
                
                redirect('backend/services/artist_edit/'.$id.'/1');
            }
            $this->session->set_flashdata('msg_error', 'Please try again.'); 
      }

      if(isset($_POST['services']))
      {
        $data['tab'] = 2;
        foreach ($data['categoryLevel3'] as $key3 => $value3) 
        {
          $this->form_validation->set_rules("categoryPrice_$value3->id",'price',"trim|required|callback_check_aritstPrice[categoryPrice_$value3->id]");
          $this->form_validation->set_rules("categoryTime_$value3->id",'time',"trim|required|callback_check_aritstTime[categoryTime_$value3->id]");
        }
        $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
        if($this->form_validation->run()==TRUE)
        {
            $inset = array();
            foreach ($data['categoryLevel3'] as $value3) 
            {
              $inset["categoryPrice_$value3->id"] = $this->input->post("categoryPrice_$value3->id");
              $inset["categoryTime_$value3->id"]  = $this->input->post("categoryTime_$value3->id");
            }

            $inset = array(
                            'services' => json_encode($inset)
                          );

            if($this->Common_model->update('services_artist',$inset, array('id'=>$id)))
            {
              $this->session->set_flashdata('msg_success', 'Artist services updated successfully.');
            }
            else
            {
              $this->session->set_flashdata('msg_error', 'Please try again.'); 
            }
            redirect('backend/services/artist_edit/'.$id.'/2');
        }
      }

      $data['template'] = "backend/services/artist/edit";
      $this->load->view('templates/backend/layout', $data);
  }

  // Method for form validation
  public function check_aritstPrice($str,$name)
  {
     //return FALSE;
      /*if(empty($str))
      {
        return TRUE;
      }
      else
      {*/
        //die('else');
        if($str == 'x')
        {
          return TRUE;
        }
        else
        {
          if(!is_numeric($str))
          {
            $this->form_validation->set_message('check_aritstPrice',"The price field must contain only numeric value.");
            return FALSE;
          }
          else if($str < 1)
          {
            $this->form_validation->set_message('check_aritstPrice',"The price field must contain a number greater than zero.");
            return FALSE;
          }
          else
          {
            return TRUE;
          }
        }
      //}
     
  }

  // Method for form validation
  public function check_aritstTime($str,$name)
  {
      /*if(empty($str))
      {
        return TRUE;
      }
      else
      {*/
        if(strlen($str) < 4)
        {
          $this->form_validation->set_message('check_aritstTime','The time field must be exactly 4 characters in length.');
          return FALSE;
        }
        else
        {
          return TRUE;
        }
      //}
  }

  public function artist_status($id="",$status="")
  {
      if(empty($id)) redirect('backend/services/artist');
      $result = $this->Common_model->get_row('services_artist',array('id'=>$id));
      if(!$result) redirect('backend/services/artist');
      if($status==0) $cat_status=1;
      if($status==1) $cat_status=0;

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('services_artist', $data ,array('id'=>$id)))
      {
         $this->session->set_flashdata('msg_success','Artist status has been updated successfully.');
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
      }
      redirect('backend/services/artist');  
  }

  public function artist_delete($id = 0)
  {
    
    if(empty($id)) redirect('backend/services/artist');
    $result = $this->Common_model->get_row('services_artist',array('id'=>$id));
    if(!$result) redirect('backend/services/artist');

    if($this->Common_model->delete('services_artist', array('id'=>$id))) 
    {
      if(!empty($result->image) && file_exists($result->image)) { @unlink($result->image); }
          $temp = str_replace('thumb/','', $result->image);
          if(!empty($temp) && file_exists($temp)) { @unlink($temp); }
      $this->session->set_flashdata('msg_success', 'Artist deleted successfully.');
    } else {
        $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }
    redirect('backend/services/artist');
  }


  public function add_fullDay_leave()
  {
      $id       = $_POST['id'];
      $offDate  = $_POST['offDate'];

      $msg = 'Please enter all required fields.';
      $status = 0;
      if(!empty($id) && !empty($offDate))
      {
         $offDate = date('Y-m-d', strtotime($offDate));
         $off = $this->Common_model->get_result('services_artist_offs',array('artist_id'=>$id,'date'=>$offDate));
         if(!$off)
         {
            $bookings = $this->Common_model->get_result('services_bookings',array('artist_id'=>$id,'book_date'=>$offDate));

            if(!$bookings)
            {
                $inset = array(
                                'artist_id' => $id,
                                'off_type'  => 1,
                                'date'      => $offDate,
                              );
                $this->Common_model->insert('services_artist_offs', $inset);
                $status = 1;
                $msg = '';
                $this->session->set_flashdata('msg_success', 'Leave added successfully.');
            }
            else
            {
              $status = 0;
              $msg ='Some bookings on this date.';
            }
         }
         else
         {
            $status = 0;
            $msg = 'Already applied leave on this date.';
         }
      }
      
      $result = array('status'=>$status, 'msg'=>$msg);
      header('Content-Type: application/json');
      echo json_encode($result);

  }

  public function add_time_leave()
  {
      $id       = $_POST['id'];
      $offDate  = $_POST['offDate'];
      $t1       = $_POST['startOffTime'];
      $t2       = $_POST['endOffTime'];

      $msg = '';
      $status = 0;

      if(!empty($id) && !empty($offDate) && (strlen($t1) ==4) && (strlen($t2) == 4) )
      {
        $offDate = date('Y-m-d', strtotime($offDate));
        $off = $this->Common_model->get_result('services_artist_offs',array('artist_id'=>$id,'date'=>$offDate));
        if(!$off)
        {
          $result = $this->services_model->check_booking_for_leave($id, $offDate, $t1, $t2);

          /* SELECT * FROM `services_bookings` WHERE `artist_id` = '4' AND `book_date` = '2016-09-17' AND `time_from` <= '0900' AND 
             `time_to` > '0900' AND `time_from` < '0930' AND `time_to` > '0930' */ // not success

          /*  SELECT * FROM `services_bookings` WHERE (`time_from` < 1000) AND (`time_to` > 0800) */

          if(!$result)
          { 
              $inset = array(
                                'artist_id' => $id,
                                'off_type'  => 2,
                                'date'      => $offDate,
                                'time_from' => $t1,
                                'time_to'   => $t2
                            );

              $this->Common_model->insert('services_artist_offs', $inset);
              $status = 1;
              $msg = '';
              $this->session->set_flashdata('msg_success', 'Leave added successfully.');
          }
          else
          {
              $status = 0;
              $msg ='Some bookings on this time.';
          }
        }
        else
        {
          $status = 0;
          $msg = 'Already applied leave on this date.';
        }
      }
      else
      {
        $msg = 'Please enter all required fields.';
        $status = 0;
      }

      $result = array('status'=>$status, 'msg'=>$msg);
      header('Content-Type: application/json');
      echo json_encode($result);
  }

  public function artist_off_delete($id='',$leaveId = 0)
  {
    if(empty($id) || empty($leaveId)) redirect('backend/services/artist');

    if($this->Common_model->delete('services_artist_offs',array('id'=>$leaveId, 'artist_id'=>$id)))
    {
       $this->session->set_flashdata('msg_success', 'Leave deleted successfully.');
    }
    else
    {
      $this->session->set_flashdata('msg_error', 'Please try again.');
    }
    redirect('backend/services/artist_edit/'.$id.'/3');
  }
	
  public function index($offset = 0)
  {	
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = 10;
      $data['offset']=$offset;
      $data['services'] = $this->services_model->services($offset, $per_page);
      $config = backend_pagination();
      $config['base_url'] = base_url() . 'backend/services/index/';
      $config['total_rows'] = $this->services_model->services(0, 0);
      $config['per_page'] = $per_page;
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
      $data['template'] = "backend/services/index";
      $this->load->view('templates/backend/layout', $data);
  }
    

  public function add() 
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('services_add')==TRUE)
      { 
         

        $inset['post_slug']=url_title($this->input->post('post_title'),'-');
        $inset['post_title']=$this->input->post('post_title');
        $inset['status']=$this->input->post('status');
        $inset['post_content']=$this->input->post('post_content');
        $inset['post_type']='services';
        $inset['created_at']=date('Y-m-d h:i:s');

        if($this->Common_model->insert('posts',$inset))
        {
          $this->session->set_flashdata('msg_success', 'Services added successfully.');
        }
        else
        {
         $this->session->set_flashdata('msg_error', 'New add services failed, Please try again.');
        }
        redirect('backend/services/index');
      } 

      $data['template']='backend/services/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 



  public function edit($id=0,$offset=0)
  {
  $data['offset'] = $offset; 
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('posts','',array('id'=>$id),'','');
  if(count($data['update'])<1) redirect('backend/services/index/');
  $detail = $data['update'][0];
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
  $this->session->set_userdata('servicesid',$id);

  if($this->form_validation->run('services_edit')==TRUE)
  {

     $inset['post_slug']=url_title($this->input->post('post_title'),'-');
     $inset['post_title']=$this->input->post('post_title');
     $inset['status']=$this->input->post('status');
     $inset['post_content']=$this->input->post('post_content');
     $inset['updated_at']=date('Y-m-d h:i:s');

    if($this->Common_model->update('posts',$inset,array('id'=>$id)))
    {
      $this->session->set_flashdata('msg_success', 'Services updated successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'Services update failed, Please try again.');

    }
    redirect('backend/services/index');              

    }
    $data['template']='backend/services/edit';     
    $this->load->view('templates/backend/layout', $data);
  }


  public function delete($Services_id = 0)
  {

    if (empty($Services_id)) redirect('backend/services');
    if ($this->Common_model->delete('posts', array('id' => $Services_id))) 
    {
        $this->session->set_flashdata('msg_success', 'Services deleted successfully.');
    } else {
        $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }

    redirect('backend/services');

  }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/services/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('posts', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Services status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/services/index/'.$offset);  


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

        $Servicesid=$this->session->userdata('servicesid');
        $val=url_title($str,'-');
        $checkexist=$this->Admin_model->getColumnDataWhere('posts','',array('post_slug'=>$val,'id !='=>$Servicesid),'','');      
       
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


  public function time_range($offset = 0)
  { 
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = 20;
      $data['offset']=$offset;
      $data['services'] = $this->services_model->time_range($offset, $per_page);
      $config = backend_pagination();
      $config['base_url'] = base_url() . 'backend/services/time_range/';
      $config['total_rows'] = $this->services_model->time_range(0,0);
      $config['per_page'] = $per_page;
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
      $data['template'] = "backend/services/range_index";
      $this->load->view('templates/backend/layout', $data);
  }
    

  public function range_add() 
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('time_range_add')==TRUE)
      { 
         

        $inset['timing']       = $this->input->post('timing');
        $inset['max_booking']  = $this->input->post('max_booking');
        $inset['status']       = $this->input->post('status');
        $inset['created']      = date('Y-m-d h:i:s');

        if($this->Common_model->insert('services_timing',$inset))
        {
          $this->session->set_flashdata('msg_success', 'Time range added successfully.');
        }
        else
        {
         $this->session->set_flashdata('msg_error', 'New add time range failed, Please try again.');
        }
        redirect('backend/services/time_range');
      } 

      $data['template']='backend/services/range_add'; 
      $this->load->view('templates/backend/layout', $data);
  } 


  public function range_edit($id=0,$offset=0)
  {
    $data['offset'] = $offset; 
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('services_timing','',array('id'=>$id),'','');
    if(count($data['update'])<1) redirect('backend/services/time_range');
    $detail = $data['update'][0];
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

    if($this->form_validation->run('time_range_edit')==TRUE)
    {

     $inset['timing']       = $this->input->post('timing');
     $inset['max_booking']  = $this->input->post('max_booking');
     $inset['status']       = $this->input->post('status');

    if($this->Common_model->update('services_timing',$inset,array('id'=>$id)))
    {
      $this->session->set_flashdata('msg_success', 'Time range updated successfully.');
    }
    else
    {
     $this->session->set_flashdata('msg_error', 'Time range update failed, Please try again.');
    }
    redirect('backend/services/time_range/'.$offset);              

    }
    $data['template']='backend/services/range_edit';     
    $this->load->view('templates/backend/layout', $data);
  }


  public function range_delete($Services_id = 0)
   {

        if (empty($Services_id)) redirect('backend/services');
        if ($this->Common_model->delete('services_timing', array('id' => $Services_id))) 
        {
            $this->session->set_flashdata('msg_success', 'Time range deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/services/time_range');

    }


    public function range_status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/services/time_range');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('services_timing', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Time range status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/services/time_range/'.$offset);  


    }
 
  public function pricing()
  { 
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $data['services'] = $this->Common_model->get_result('services_pricing',array('id>'=>1));
      $data['template'] = "backend/services/price_index";
      $this->load->view('templates/backend/layout', $data);
  }
  public function price_edit($id=0)
  {
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('services_pricing','',array('id'=>$id),'','');
    if(count($data['update'])<1) redirect('backend/services/time_range');
    $detail = $data['update'][0];
    $this->form_validation->set_rules('price','services price','trim|required|numeric|greater_than[0]');
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

    if($this->form_validation->run()==TRUE)
    {
         $inset['price']       = $this->input->post('price');

        if($this->Common_model->update('services_pricing',$inset,array('id'=>$id)))
        {
          $this->session->set_flashdata('msg_success', 'Price updated successfully.');
        }
        else
        {
         $this->session->set_flashdata('msg_error', 'Price update failed, Please try again.');
        }
        redirect('backend/services/pricing/');              

    }
    $data['template']='backend/services/price_edit';     
    $this->load->view('templates/backend/layout', $data);
  }
   
	public function logout()
  {
			$this->session->sess_destroy();
		redirect(base_url());
	}

}

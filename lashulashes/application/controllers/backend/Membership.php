<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
      $this->load->model('plans_model');
      $this->load->model('discount_model');
	}

	
	public function index($offset = 0) {	
    redirect('backend/membership/plan_list');
  }

  public function plan_list($offset = 0)
    { 
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = RECORDS_PER_PAGE;
        $data['offset']=$offset;
        $data['plans'] = $this->plans_model->plans($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/membership/plan_list/';

        $config['total_rows'] = $this->plans_model->plans(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/plans/index";
        $this->load->view('templates/backend/layout', $data);
     

  }

  
    

public function plan_add() {  
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
   
  if($this->form_validation->run('plans_add')==TRUE)
  { 
     
      if($this->session->userdata('features_image')): 
        $features_image=$this->session->userdata('features_image');
        $inset['image'] = $features_image['image'];  
      endif;

      $inset['title']=$this->input->post('title');
      $inset['title_slug']=url_title($this->input->post('title'),'-');
      $inset['description']= $this->input->post('description');
      $inset['amount']= $this->input->post('amount');
      $inset['duration']= $this->input->post('duration');
      $inset['status']=$this->input->post('status');

    if($this->Common_model->insert('plans',$inset))
    {   
      if($this->session->userdata('features_image')):
          $this->session->unset_userdata('features_image');
      endif;  
      $this->session->set_flashdata('msg_success', 'Plan added successfully.');
    }
    else{
      $this->session->set_flashdata('msg_error', 'New add plan failed, Please try again.');
    }
    redirect('backend/membership/plan_list');
  } 

  $data['template']='backend/plans/add'; 
  $this->load->view('templates/backend/layout', $data);
} 




  
  public function plan_edit($id=0,$offset=0)
  {  
        $data['offset']= $offset;
        $data['page_title'] = 'Dashboard :: Admin Panel'; 
        $data['update']=$this->Admin_model->getColumnDataWhere('plans','',array('id'=>$id),'','');
        if(count($data['update'])<1) redirect('backend/plans/');
        $detail = $data['update'][0];
        $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
        $this->session->set_userdata('planid',$id); 
        if($this->form_validation->run('plans_edit')==TRUE)
        {
            if($this->session->userdata('features_image')): 
              $features_image=$this->session->userdata('features_image');
              $inset['image'] = $features_image['image'];           
            endif;


            $inset['title']=$this->input->post('title');
            $inset['title_slug']=url_title($this->input->post('title'),'-');
            $inset['description']= $this->input->post('description');
            $inset['amount']= $this->input->post('amount');
            $inset['duration']= $this->input->post('duration');
            $inset['status']=$this->input->post('status');
            if($this->Common_model->update('plans',$inset,array('id'=>$id)))
            {
              
              if($this->session->userdata('features_image')):
                $this->session->unset_userdata('features_image');
                if(!empty($detail->image) && file_exists($detail->image)) { @unlink($detail->image);}
              endif;
              $this->session->set_flashdata('msg_success', 'Plan updated successfully.');

            }
            else
            {
             $this->session->set_flashdata('msg_error', 'Plan update failed, Please try again.');

            }
            redirect('backend/membership/plan_list/'.$offset);              

        }
    $data['template']='backend/plans/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 

 public function check_edit_plans($str)
     {
       $id=$this->session->userdata('planid'); 
       $check=$this->Admin_model->getColumnDataWhere('plans','',array('id !='=>$id,'title'=>$str),'','');

       if(count($check)>0)
       { 
            $this->form_validation->set_message('check_edit_plans',"The title field must contain a unique value.");
            return FALSE;
       }
        else{
           return TRUE;
        }
  
     }

     
    public function plan_delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/plans');
        $detail = $this->Common_model->get_row('plans',array('id' => $news_id));
        if(empty($detail)) redirect('backend/plans');
        if ($this->Common_model->delete('plans', array('id' => $news_id))) {
            $this->session->set_flashdata('msg_success', 'Plan deleted successfully.');
             if(!empty($detail->image) && file_exists($detail->image)) { @unlink($detail->image);}
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/membership');

    }


    public function plan_status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/membership/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('plans', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Plan status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/membership/plan_list/'.$offset);  


    }

    public function features_image_check_add($str)
    {     
      
        if($this->session->userdata('features_image')){       
          return TRUE;

        }else{
          $param=array(
            'file_name' =>'features_image',
            'upload_path'  => './assets/uploads/plan/',
            'allowed_types'=> 'gif|jpg|png|jpeg',
            'image_resize' => FALSE,
            //'source_image' => './assets/uploads/blog/',
            //'new_image'    => './assets/uploads/blog/thumb/',
            'encrypt_name' => TRUE,
            'min_width'    => 700,
            'min_height'   => 500,
            //'max_height'   => 786,
            //'max_width'    => 1024,
            //'resize_width' => 400,
            //'resize_height'=> 400
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
          if($this->session->userdata('features_image'))
          {       
          return TRUE;
          }
          else
          {
              $param=array(
                'file_name' =>'features_image',
                'upload_path'  => './assets/uploads/plan/',
                'allowed_types'=> 'gif|jpg|png|jpeg',
                'image_resize' => FALSE,
                //'source_image' => './assets/uploads/plan/',
                //'new_image'    => './assets/uploads/plan/thumb/',
                'encrypt_name' => TRUE,
                'min_width'    => 700,
                'min_height'   => 500,
                 //'max_height'   => 786,
                 //'max_width'    => 1024,
                 //'resize_width' => 400,
                 //'resize_height'=> 400

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


    public function discount_list($offset=0){
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = RECORDS_PER_PAGE;
      $data['offset']=$offset;
      $data['discountList'] = $this->discount_model->discount($offset, $per_page);
      $config = backend_pagination();
      $config['base_url'] = base_url().'backend/membership/discount_list/';
      $config['total_rows'] = $this->discount_model->discount(0, 0);
      $config['per_page'] = $per_page;
      $config['uri_segment']  = 4;
      if(!empty($_SERVER['QUERY_STRING'])){
        $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
      }
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
      $data['template'] = "backend/discount/index";
      $this->load->view('templates/backend/layout', $data);
    }

    public function discount_add() {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
       
      if($this->form_validation->run('discount_add')==TRUE){ 
        $inset['plan_id']=$this->input->post('plan_id');
        $detail = $this->Common_model->get_row('plans',array('id' => $inset['plan_id']));
        $inset['discount_code']=$this->input->post('discount_code');
        $inset['start_date']=date('Y-m-d', strtotime($this->input->post('start_date')));
        $inset['end_date']=date('Y-m-d', strtotime($this->input->post('start_date').' +'.$detail->duration.' months'));
        if($this->input->post('user_id')){
           $inset['user_id']=$this->input->post('user_id');
        }
        $this->Common_model->update('plan_discount_code',array('is_used' => 1),$inset);
        if($this->Common_model->insert('plan_discount_code',$inset)){   
          $this->session->set_flashdata('msg_success', 'Membership added successfully.');
        }else{
          $this->session->set_flashdata('msg_error', 'New add membership failed, Please try again.');
        }
        redirect('backend/membership/discount_list');
      } 
      $data['planList'] = $this->Common_model->getColumnDataWhere('plans','*',' status = 1 ','id','ASC');
      $data['userList'] = $this->Common_model->getColumnDataWhere('users','*',' user_role = 1 and status = 1 ','first_name, last_name ','ASC');
      $data['template']='backend/discount/add'; 
      $this->load->view('templates/backend/layout', $data);
    } 

    public function discount_edit($id=0,$offset=0)
    {  
          $data['offset']= $offset;
          $data['page_title'] = 'Dashboard :: Admin Panel'; 
          $data['update']=$this->Admin_model->getColumnDataWhere('plan_discount_code','',array('id'=>$id),'','');
          if(count($data['update'])<1) redirect('backend/plans/');
          $detail = $data['update'][0];
          $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
          $this->session->set_userdata('discountid',$id); 
          if($this->form_validation->run('discount_edit')==TRUE)
          {
              $inset['plan_id']=$this->input->post('plan_id');
              $detail = $this->Common_model->get_row('plans',array('id' => $inset['plan_id']));
              $inset['discount_code']=$this->input->post('discount_code');
              $inset['start_date']=date('Y-m-d', strtotime($this->input->post('start_date')));
              $inset['end_date']=date('Y-m-d', strtotime($this->input->post('start_date').' +'.$detail->duration.' months'));
              if($this->input->post('user_id')){
                 $inset['user_id']=$this->input->post('user_id');
              }

              if($this->Common_model->update('plan_discount_code',$inset,array('id'=>$id))){
                $this->session->set_flashdata('msg_success', 'Membership updated successfully.');
              }else{
                $this->session->set_flashdata('msg_error', 'Membership update failed, Please try again.');
              }
              redirect('backend/membership/discount_list/'.$offset);              

          }
      $data['planList'] = $this->Common_model->getColumnDataWhere('plans','*',' status = 1 ','id','ASC');
      $data['userList'] = $this->Common_model->getColumnDataWhere('users','*',' user_role = 1 and status = 1 ','first_name, last_name ','ASC');
      $data['template']='backend/discount/edit';     
      $this->load->view('templates/backend/layout', $data);
    } 

    public function check_edit_discount_code($str){
       $id=$this->session->userdata('discountid'); 
       $check=$this->Admin_model->getColumnDataWhere('plan_discount_code','',array('id !='=>$id,'discount_code'=>$str),'','');
       if(count($check)>0)
       { 
            $this->form_validation->set_message('check_edit_discount_code',"The title field must contain a unique value.");
            return FALSE;
       }
        else{
           return TRUE;
        }
  
     }


    public function discount_delete($id = 0){

        if (empty($id)) redirect('backend/membership/discount_list');
        $detail = $this->Common_model->get_row('plan_discount_code',array('id' => $id));
        if(empty($detail)) redirect('backend/membership/discount_list');
        if ($this->Common_model->delete('plan_discount_code', array('id' => $id))) {
            $this->session->set_flashdata('msg_success', 'Membership deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/membership/discount_list');

    }

    public function membership_order_list($offset = 0)
    { 
        $data['page_title'] = 'Dashboard :: Admin Panel';
        $per_page = RECORDS_PER_PAGE;
        $data['offset']=$offset;
        $data['orders'] = $this->discount_model->get_membership_order($offset, $per_page);

        $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/membership/membership_order_list/';

        $config['total_rows'] = $this->discount_model->get_membership_order(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/discount/membership_order";
        $this->load->view('templates/backend/layout', $data);
     

  }

  public function get_end_date(){
    $plan_id  = $this->input->post('plan_id');
    $start_date  = $this->input->post('start_date');
    $detail = $this->Common_model->get_row('plans',array('id' =>  $plan_id));
    $end_date=date('j M Y', strtotime($this->input->post('start_date').' +'.$detail->duration.' months'));
    echo json_encode(array("status"=>1,"end_date"=>$end_date));
  }

  public function check_exist_membership(){
    $plan_id  = $this->input->post('plan_id');
    $user_id  = $this->input->post('user_id');
    $discount_code  = $this->input->post('discount_code');
    $start_date  = $this->input->post('start_date');
    $detail = $this->discount_model->get_user_plan_details($user_id);
    $status = 0;
    $message = "";
    if($detail){
      if(strtotime($detail->end_date)>strtotime(date('Y-m-d'))){
        $status = 1;
        $message = "Selected user have already assigned ".$detail->plan_name." and expire on ".date('d M Y',strtotime($detail->end_date)).". Are you want to assigned new plan to the user?";
      }
    }
    echo json_encode(array("status"=>$status,"message"=>$message));
  }


  
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promocode extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
      $this->load->model('promocode_model');
	}

	
	public function index($offset = 0)
  {	
      $data['page_title']   = 'Dashboard :: Admin Panel';
      $per_page             = 10;
      $data['offset']       = $offset;
      $data['values']       = $this->promocode_model->promocode($offset, $per_page);

      $config               = backend_pagination();
      $config['base_url']   = base_url('backend/promocodes/index/');
      $config['total_rows'] = $this->promocode_model->promocode(0, 0);
      $config['per_page']   = $per_page;
      $this->pagination->initialize($config);

      $data['pagination']   = $this->pagination->create_links();
      $data['template']     = "backend/promocode/index";

      $this->load->view('templates/backend/layout', $data);
     
	}
    

  public function add() 
  {  
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
     
    if($this->form_validation->run('promocode_add')==TRUE)
    { 
       $inset = array(
                        'applied_on' => json_encode($_POST['applied_on']),
                        'code'       => $this->input->post('code'),
                        'start_date' => date('Y-m-d h:i:s',strtotime($this->input->post('start_date'))),
                        'end_date'   => date('Y-m-d h:i:s',strtotime($this->input->post('end_date'))),
                        'min_amount' => $this->input->post('min_amount'),
                        'discount'   => $this->input->post('discount'),
                      'discount_type'=> $this->input->post('discount_type'),
                        'status'     => $this->input->post('status'),
                      );
       /*rint_r($inset);
       die();*/

      if($this->Common_model->insert('promo_code',$inset))
      {   
        $this->session->set_flashdata('msg_success', 'Promo code added successfully.');
      }else{

       $this->session->set_flashdata('msg_error', 'New add promo code failed, Please try again.');

      }
      redirect('backend/promocode/index');
    } 

    $data['template']='backend/promocode/add'; 
    $this->load->view('templates/backend/layout', $data);
  } 


  
  public function edit($id=0,$offset=0)
  {  
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']     = $this->Common_model->get_row('promo_code',array('id'=>$id));
    
    if(!$data['update'] ) redirect('backend/promocode/index'); 

    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    $this->session->set_userdata('promocodeid',$id); 
    if($this->form_validation->run('promocode_edit')==TRUE)
    {
       $inset = array(
                        'applied_on' => json_encode($_POST['applied_on']),
                        'code'       => $this->input->post('code'),
                        'start_date' => date('Y-m-d h:i:s',strtotime($this->input->post('start_date'))),
                        'end_date'   => date('Y-m-d h:i:s',strtotime($this->input->post('end_date'))),
                        'min_amount' => $this->input->post('min_amount'),
                        'discount'   => $this->input->post('discount'),
                      'discount_type'=> $this->input->post('discount_type'),
                        'status'     => $this->input->post('status'),
                      );

      if($this->Common_model->update('promo_code',$inset,array('id'=>$id)))
      {
        $this->session->set_flashdata('msg_success', 'Promo code updated successfully.');
      }
      else
      {
       $this->session->set_flashdata('msg_error', 'Promo Code update failed, Please try again.');
      }
      redirect('backend/promocode/index/'.$offset);              

    }
    $data['template']='backend/promocode/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 

  public function check_updatepromocode($str)
  {
    $id=$this->session->userdata('promocodeid'); 
    $check=$this->Common_model->get_row('promo_code',array('id !='=>$id,'code'=>$str));

    if($check)
    { 
      $this->form_validation->set_message('check_updatepromocode',"The promo code name field must contain a unique value.");
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }

  public function check_percentage($str){
    $discount_type = $this->input->post('discount_type');
    $discount = $this->input->post('discount');
    $isValid  = TRUE;
    if($discount_type == 2){ 
      if($discount>100){
        $this->form_validation->set_message('check_percentage',"The Discount percentage field must contain a number less than or equal to 100.");
        $isValid = FALSE;
      }
    }else if($discount_type == 1){
      $min_amount = $this->input->post('min_amount');
      if($discount>$min_amount){
        $this->form_validation->set_message('check_percentage',"The Discount field must contain a number less than Minimum Amount.");
        $isValid = FALSE;
      }
    }
    return $isValid;
  }

  public function delete($promo_id = 0)
  {
    if (empty($promo_id)) redirect('backend/promocode');
    if ($this->Common_model->delete('promo_code', array('id' => $promo_id))) {
        $this->session->set_flashdata('msg_success', 'Promo code deleted successfully.');
    } else {
        $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }

   redirect('backend/promocode');

  }


  public function status($id="",$status="",$offset="")
  {
    if(empty($id)) redirect('backend/promocode');
    if($status)
    {
      $cat_status=0;
    }
    else
    {
      $cat_status=1;
    }       

    $data = array('status'=>$cat_status);
    if($this->Common_model->update('promo_code', $data ,array('id'=>$id)))
    {
       $this->session->set_flashdata('msg_success','Promo code status has been updated successfully.');
    }
    else
    {
      $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');
    }
    redirect('backend/promocode/index/'.$offset);  
  }
}

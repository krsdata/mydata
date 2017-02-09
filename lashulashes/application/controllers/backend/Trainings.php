<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainings extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
      $this->load->model('traning_model');
	}

	public function index($offset = 0)
  {	
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = RECORDS_PER_PAGE;
      $data['offset']=$offset;
      $data['traning'] = $this->traning_model->traning($offset, $per_page);

      $config = backend_pagination();

      $config['base_url'] = base_url() . 'backend/trainings/index/';

      $config['total_rows'] = $this->traning_model->traning(0, 0);

      $config['per_page'] = $per_page;

      $this->pagination->initialize($config);

      $data['pagination'] = $this->pagination->create_links();

      $data['template'] = "backend/traning/index";
      $this->load->view('templates/backend/layout', $data);
	}
    
  public function add() 
  {  
      $data['category'] = $this->Common_model->get_result('traning_category');
      $data['aus_state'] = $this->Common_model->get_aus_state();
     /* print_r($data['aus_state']);
      die();*/
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
       
      if($this->form_validation->run('traning_add')==TRUE)
      { 
         
         $inset['category_id']  = $this->input->post('category');
         $inset['title']        = $this->input->post('title');
         $inset['description']  = $this->input->post('description');
         $inset['fees']         = $this->input->post('fee');
         $inset['timing']       = $this->input->post('timing');
         $inset['start_date']   = date('Y-m-d',strtotime($this->input->post('start_date')));
         $inset['end_date']     = date('Y-m-d',strtotime($this->input->post('end_date')));
         $inset['participant']  = $this->input->post('participant');
         $inset['state']        = $this->input->post('state');
         $inset['status']       = $this->input->post('status');

        if($this->Common_model->insert('traning',$inset))
        {  
          $this->session->set_flashdata('msg_success', 'Training added successfully.');
        }
        else
        {
         $this->session->set_flashdata('msg_error', 'New add training failed, Please try again.');
        }
        redirect('backend/trainings/index');
      } 
      $data['template']='backend/traning/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 
   
  public function edit($id=0,$offset=0)
  {  
    $data['offset'] = $offset;
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('traning','',array('id'=>$id),'','');
    if(count($data['update'])<1) redirect('backend/trainings');
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    $data['category'] = $this->Common_model->get_result('traning_category');
    $data['aus_state'] = $this->Common_model->get_aus_state();
    if($this->form_validation->run('traning_edit')==TRUE)
    {
        $inset['category_id']  = $this->input->post('category');
        $inset['title']        = $this->input->post('title');
        $inset['description']  = $this->input->post('description');
        $inset['fees']         = $this->input->post('fee');
        $inset['timing']       = $this->input->post('timing');
        $inset['start_date']   = date('Y-m-d',strtotime($this->input->post('start_date')));
        $inset['end_date']     = date('Y-m-d',strtotime($this->input->post('end_date')));
        $inset['participant']  = $this->input->post('participant');
        $inset['state']        = $this->input->post('state');
        $inset['status']       = $this->input->post('status');

      if($this->Common_model->update('traning',$inset,array('id'=>$id)))
      {
  
        $this->session->set_flashdata('msg_success', 'Training updated successfully.');
      }
      else
      {
       $this->session->set_flashdata('msg_error', 'Training update failed, Please try again.');
      }
      redirect('backend/trainings/index/'.$offset);              

    }
    $data['template']='backend/traning/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 

  public function delete($id = 0)
  {
      if($this->Common_model->delete('traning',array('id'=>$id)))
      {
  
        $this->session->set_flashdata('msg_success', 'Training deleted successfully.');
      }
      else
      {
       $this->session->set_flashdata('msg_error', 'Training delete failed, Please try again.');
      }
      redirect('backend/trainings/index'); 
  }

  public function status($id="",$status="",$offset="")
  {
      if(empty($id)) redirect('backend/trainings/');
      if($status==0){
          $cat_status=1;
      }

      if($status==1){
          $cat_status=0;
      }       

      $data = array('status'=>$cat_status);
      if($this->Common_model->update('traning', $data ,array('id'=>$id)))
      {
        //echo "success";
        $this->session->set_flashdata('msg_success', 'Status changed successfully.');
        redirect('backend/trainings/index/'.$offset);
      }
      else
      {
        $this->session->set_flashdata('msg_error', 'Status change faild. Please try again.');
        redirect('backend/trainings/index/'.$offset);
      }
  }
 
}

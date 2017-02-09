<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
      $this->load->model('Attributes_model');
	}

	
	public function index($offset = 0)
  {	
      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = RECORDS_PER_PAGE;
      $data['offset']=$offset;
      $data['values'] = $this->Attributes_model->attributes($offset, $per_page);

      $config = backend_pagination();

      $config['base_url'] = base_url() . 'backend/attributes/index/';

      $config['total_rows'] = $this->Attributes_model->attributes(0, 0);

      $config['per_page'] = $per_page;

      $this->pagination->initialize($config);

      $data['pagination'] = $this->pagination->create_links();

      $data['template'] = "backend/attributes/index";
      $this->load->view('templates/backend/layout', $data);
     

	}
    

public function add() 
{  
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
   
  if($this->form_validation->run('attributes_add')==TRUE)
  { 
     
     $inset['attribute']=$this->input->post('attribute');
     $inset['status']=$this->input->post('status');

    if($this->Common_model->insert('product_attributes',$inset))
    {   
      $this->session->set_flashdata('msg_success', 'Attribute added successfully.');
    }else{

     $this->session->set_flashdata('msg_error', 'New add Attribute failed, Please try again.');

    }
    redirect('backend/attributes/index');
  } 

  $data['template']='backend/attributes/add'; 
  $this->load->view('templates/backend/layout', $data);
} 


  
  public function edit($id=0,$offset=0)
  {  
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('product_attributes','',array('id'=>$id),'','');
    if(!$data['update'] ) redirect('backend/attributes/index');  

    if(!$data['update']) redirect('backend/attributes/index'); 
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
     $this->session->set_userdata('categotyid',$id); 
    if($this->form_validation->run('attributes_edit')==TRUE)
    {
       $inset['attribute']=$this->input->post('attribute');
       $inset['status']=$this->input->post('status');

      if($this->Common_model->update('product_attributes',$inset,array('id'=>$id)))
      {
        
        $this->session->set_flashdata('msg_success', 'Attribute updated successfully.');
      }else{
       $this->session->set_flashdata('msg_error', 'Attribute update failed, Please try again.');

      }
      redirect('backend/attributes/index/'.$offset);              

    }
    $data['template']='backend/attributes/edit';     
    $this->load->view('templates/backend/layout', $data);
  } 

 public function check_updateattributes($str)
     {
       $id=$this->session->userdata('categotyid'); 
       $check=$this->Admin_model->getColumnDataWhere('product_attributes','',array('id !='=>$id,'attribute'=>$str),'','');

       if(count($check)>0)
       { 
            $this->form_validation->set_message('check_updateattributes',"The attribute name field must contain a unique value.");
            return FALSE;
       }
        else{
           return TRUE;
        }
  
     }

    public function delete($news_id = 0)
   {

        if (empty($news_id)) redirect('backend/attributes');
        if ($this->Common_model->delete('product_attributes', array('id' => $news_id))) {
            $this->session->set_flashdata('msg_success', 'Attributes deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/attributes');

    }


    public function status($id="",$status="",$offset="")
    {

        if(empty($id)) redirect('backend/attributes/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('product_attributes', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Attribute status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/attributes/index/'.$offset);  


    }



 


  
}

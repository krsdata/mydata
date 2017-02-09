<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplates extends CI_Controller {

	public function __construct()
 	{
      parent::__construct();
      //$this->load->model('webs_model');
			   
	}

	
	public function index()
  {
    $this->load->view('website/email');

  }

  public function training($id=1)
  {
    
    
    $data['type'] ='training';
    $data['message'] = "Training templates testing";
    $data['value'] = $this->Common_model->get_row('training_booking',array('id'=>$id));
    $this->load->view('website/email',$data);  
  }

  public function services($id=2)
  {
    
    $data['type'] ='service';
    $data['message'] = "Services templates testing";
    $data['value'] = $this->Common_model->get_row('services_booking',array('id'=>$id));
    $this->load->view('website/email',$data);  
  }

  public function product($id=2)
  {
    $data['type'] ='product';
    $data['message'] = "Product templates testing";
    $data['value'] = $this->Common_model->get_row('orders',array('order_id'=>$id));
    $this->load->view('website/email',$data);  
  }
}

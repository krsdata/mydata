<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

	public function __construct()
 	{
      parent::__construct();			   
	}

	
	public function index($offset=0)
  {   
    /*$per_page =6;
    $data['offset'] =$offset;
    $data['testimonials'] = $this->Common_model->get_result_pagination('testimonials',$offset,$per_page,array('status'=>1));

    $config = frontend_pagination();
    $config['base_url']     = base_url().'testimonials/index';
    $config['total_rows']   = $this->Common_model->get_result_pagination('testimonials',0,0,array('status'=>1));
    $config['per_page']     = $per_page;
    $config['uri_segment']  = 3;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();*/
    $data['testimonials'] = $this->Common_model->get_result('testimonials', array('status'=>'1'),'','','');              
    $data['template'] = "frontend/page/testimonials";
    $this->load->view('templates/frontend/layout', $data);
  }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
 	{
      parent::__construct();
      $this->load->model('webs_model');
			   
	}

	
	public function index($offset=0)
    {
    	$data['latest_news'] = $this->Common_model->get_result('posts', array('status'=>'1','post_type'=>'news'),array('post_content,post_title,post_slug,created_at'),array('id','desc'),10);              
      $per_page = 12;
      $data['offset']=$offset;
      $data['news'] = $this->webs_model->news($offset, $per_page);                   
      $config = frontend_pagination();
      $config['base_url'] = base_url() . 'news/index';
      $config['total_rows'] = $this->webs_model->news(0, 0);
      $config['per_page'] = $per_page;
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
      $data['template'] = "frontend/news/index";
      $this->load->view('templates/frontend/layout', $data);
	  }


    public function view($offset=0,$post_slug='')
    {  
      if( is_numeric($offset)){
      $data['offset']=$offset;
       }
       else{
           $post_slug=$offset;
       }
      $data['news'] = $this->Common_model->get_result('posts', array('status'=>'1','post_type'=>'news','post_slug'=>$post_slug),array(),'','');              
      $data['latest_news'] = $this->Common_model->get_result('posts', array('status'=>'1','post_type'=>'news'),array('id,post_content,post_title,post_slug,created_at'),array('id','desc'),10);              
      $data['template'] = "frontend/news/view";
      $this->load->view('templates/frontend/layout', $data);
    }

}

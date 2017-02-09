<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct()  {
	    parent::__construct();
	   $this->load->model('api_model');
	}

	public function themes($offset=0){		
		$per_page=10;		
		
		$this->load->library('pagination');		
		$config['base_url'] = base_url().'api/themes/';
		$config['total_rows'] = $this->api_model->themes(0,0);
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$this->pagination->create_links();

		$data['data']=$this->api_model->themes($per_page, $offset);
		$data['offset']=$offset;
		$data['per_page']=$per_page;
		$data['total_rows']=$config['total_rows'];	

		if($data['data']){
			$data['resp'] = true;
			echo json_encode($data);
		}else{
			$data['resp'] = false;
			$data['error'] = 'No Data Found';
			echo json_encode($data);
		}
	}

	public function get_theme($theme_id=''){
		$theme_id='';
		// if ($this->input->post('theme_id'))
		// 	$theme_id=$this->input->post('theme_id');

		if(empty($theme_id)){
			$data['resp'] = false;
			$data['error'] = 'No Request Found';
			echo json_encode($data);
		}

		$data['theme']=$this->api_model->get_row('themes', array('id' => $theme_id));
		$data['image_nd_sound']=$this->api_model->images($theme_id);

		if(!empty($data['data']) && !empty($data['images'])){
			$data['resp'] = true;
			echo json_encode($data);
		}else{
			$data['resp'] = false;
			$data['error'] = 'No Data Found';
			echo json_encode($data);
		}
	}
}
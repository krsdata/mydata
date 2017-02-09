<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {

	public function __construct(){
		parent::__construct();		
		clear_cache();		
		$this->load->model('superadmin_model');
	}

	private function barcode($id) {
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		$test = Zend_Barcode::draw('code128', 'image', array('text' =>$id), array());
		// var_dump($test);
		imagejpeg($test,'assets/barcode/'. $id.'.jpg', 150);
	}

	

	
}/* End of file superadmin.php */
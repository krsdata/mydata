<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elfinders extends CI_Controller {

	public function index()
	{	
		if(superadmin_logged_in()==FALSE)
	       {
	        redirect('backend/login'); 
	       }
		//$this->load->helper('url');
		$this->load->view('elfinders');
	}

	public function init(){
		$this->load->helper('url');
		$this->load->helper('path');

		$opts = array(
			// 'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => set_realpath('assets/uploads'),         // path to files (REQUIRED)
					'URL'           => site_url('assets/uploads') . '/', // URL to files (REQUIRED)
					'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)
					'uploadOverwrite'=>FALSE,
				    'tmbPath'=>set_realpath('assets/uploads').'/thumb',
				    'tmbURL' =>site_url('assets/uploads') . '/thumb/',
				    'tmbSize' =>220,
				)
			)
		);
	
		$this->load->library('elfinder-2.x/connector', $opts);
		//$this->load->library('elfinder/connector', $opts);
	}

	public function demo()
	{	
		$this->load->helper('url');
		$this->load->view('demo');
	}
}
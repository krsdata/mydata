<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angular extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
	}

	
  public function getattribute($id=0)
  {
   
   $data=$this->Admin_model->getColumnDataWhere('product_configure_terms','',array(' attribute_id'=>$id),'','');
   
   echo json_encode($data);

  }
	
 


  
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
         if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('contact_model');
	}

	
	public function index($offset = 0)
    {	
       $data['page_title'] = 'Dashboard :: Admin Panel';
       $per_page = 15;
        $data['offset']=$offset;
        $data['news'] = $this->contact_model->contact($offset, $per_page);

       $config = backend_pagination();

        $config['base_url'] = base_url() . 'backend/contacts/index/';

        $config['total_rows'] = $this->contact_model->contact(0, 0);

        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
       
        $data['template'] = "backend/contact/index";
        $this->load->view('templates/backend/layout', $data);
     

	}
    

  public function add() 
  {  
      $data['page_title'] = 'Dashboard :: Admin Panel'; 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      if($this->form_validation->run('location_add')==TRUE)
      { 
          $address = url_title($this->input->post('address').' + '.$this->input->post('city').' + '.$this->input->post('zip').' + '.$this->input->post('state').' + '.$this->input->post('country'), '+', TRUE);
          $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          $response = curl_exec($ch);
          curl_close($ch);
          $response_a = json_decode($response);

          if($response_a->status!='ZERO_RESULTS')
          {
            $inset['lat'] = $response_a->results[0]->geometry->location->lat;
            $inset['lnt'] = $response_a->results[0]->geometry->location->lng;
          }
          else
          {
            $inset['lat']='';
            $inset['lnt']='';
          }

          $inset['type']     = $this->input->post('type');
          $inset['location'] = $this->input->post('location');
          $inset['name']     = $this->input->post('name');
          $inset['mobile']   = $this->input->post('mobile');
          $inset['address']  = $this->input->post('address');
          $inset['city']     = $this->input->post('city');
          $inset['state']    = $this->input->post('state');
          $inset['zip']      = $this->input->post('zip');
          $inset['country']  = $this->input->post('country');
          $inset['status']   = $this->input->post('status');
          $inset['created_at']=date('Y-m-d h:i:s');
          

          if($this->Common_model->insert('contact_location',$inset))
          {
            $this->session->set_flashdata('msg_success', 'Location added successfully.');
          }
          else
          {

           $this->session->set_flashdata('msg_error', 'New add location failed, Please try again.');

          }
          redirect('backend/contacts/index');
      } 

      $data['template']='backend/contact/add'; 
      $this->load->view('templates/backend/layout', $data);
  } 



  public function edit($id=0,$offset=0)
  {  
  $data['offset'] = $offset;
  $data['page_title'] = 'Dashboard :: Admin Panel'; 
  $data['update']=$this->Admin_model->getColumnDataWhere('contact_location','',array('id'=>$id),'','');

  if(!$data['update']) redirect('backend/contacts/index/');    

  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

  if($this->form_validation->run('location_add')==TRUE)
  {
          $address = url_title($this->input->post('address').' + '.$this->input->post('city').' + '.$this->input->post('zip').' + '.$this->input->post('state').' + '.$this->input->post('country'), '+', TRUE);
          $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          $response = curl_exec($ch);
          curl_close($ch);
          $response_a = json_decode($response);
          //print_r($response_a);
          if($response_a->status!='ZERO_RESULTS')
          {
            $inset['lat'] = $response_a->results[0]->geometry->location->lat;
            $inset['lnt'] = $response_a->results[0]->geometry->location->lng;
          }
          else
          {
            $inset['lat']='';
            $inset['lnt']='';
          }
          
        $inset['type']     = $this->input->post('type');
        $inset['location'] = $this->input->post('location');
        $inset['name']     = $this->input->post('name');
        $inset['mobile']   = $this->input->post('mobile');
        $inset['address']  = $this->input->post('address');
        $inset['city']     = $this->input->post('city');
        $inset['state']    = $this->input->post('state');
        $inset['zip']      = $this->input->post('zip');
        $inset['country']  = $this->input->post('country');
        $inset['status']   = $this->input->post('status');
        $inset['updated_at']=date('Y-m-d h:i:s');
    

    if($this->Common_model->update('contact_location',$inset,array('id'=>$id)))
    {
      $this->session->set_flashdata('msg_success', 'Location updated successfully.');
    }else{
     $this->session->set_flashdata('msg_error', 'Location update failed, Please try again.');

    }
    redirect('backend/contacts/index/'.$offset);              

    }
    $data['template']='backend/contact/edit';     
    $this->load->view('templates/backend/layout',$data);
  } 



   public function delete($news_id = 0)
    {

        if (empty($news_id)) redirect('backend/contacts');
        if ($this->Common_model->delete('contact_location', array('id' => $news_id))) {
            $this->session->set_flashdata('msg_success', 'Location deleted successfully.');
        } else {
            $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
        }

       redirect('backend/contacts');

    }


    public function status($id="",$status="",$offset="")
    {
        if(empty($id)) redirect('backend/contacts/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('contact_location', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Location status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        redirect('backend/contacts/index/'.$offset);  


    }

 


  
}

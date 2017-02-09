<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configure_terms extends CI_Controller {

	public function __construct()
 	{

        parent::__construct();
        if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
      $this->load->model('Configure_terms_model');
	}

	
	public function index($id=0,$offset = 0)
  {	
      $data['offset'] = $offset;
      $res=$this->Admin_model->getColumnDataWhere('product_attributes','attribute',array('id'=>$id),'','');
      if($res)
      $data['attribute']=$res[0]->attribute;
      else
      redirect('backend/attributes/index');

      $data['page_title'] = 'Dashboard :: Admin Panel';
      $per_page = 10;

      $data['values'] = $this->Configure_terms_model->configure_terms($offset, $per_page,$id);

      $config = backend_pagination();

      $config['base_url'] = base_url() . 'backend/configure_terms/index/'.$id;

      $config['total_rows'] = $this->Configure_terms_model->configure_terms(0,0,$id);

      $config['per_page'] = $per_page;
      $config['uri_segment']  = 5;

      $this->pagination->initialize($config);

      $data['pagination'] = $this->pagination->create_links();

      $data['template'] = "backend/configure_terms/index";
      $this->load->view('templates/backend/layout', $data);
	}
    

  public function add($id=0) 
  {   
        $lastid = 0;
        $data['page_title'] = 'Dashboard :: Admin Panel'; 
        $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
        $res=$this->Admin_model->getColumnDataWhere('product_attributes','attribute',array('id'=>$id),'','');
        if($res)
        $data['attribute']=$res[0]->attribute;
        else
        redirect('backend/attributes/index');

        if($this->form_validation->run('configure_terms_add')==TRUE)
        { 
            $q=0;
            $message ='';
           foreach($this->input->post('nameadd') as $val)   
           { 
             $inset['attribute_id']=$id;
             $inset['name']=$this->input->post('nameadd')[$q];
             if(!$this->Common_model->get_row('product_configure_terms',$inset))
              {
                 $inset['status'] = 1;
                 $lastid=$this->Common_model->insert('product_configure_terms',$inset);
              }
              else
              {
                $message .= $inset['name'].', ';
              }
             $q++;
           }
            if($lastid)
            {  
              if(empty($message)) 
              {
                $this->session->set_flashdata('msg_success', 'Added successfully.');
              }
              else
              {
                $this->session->set_flashdata('msg_success', 'Added successfully.<br>'.$message.' already exist.');
              }
            }else{

             $this->session->set_flashdata('msg_error', 'Please try again.');

            }
            redirect('backend/configure_terms/index/'.$id);
        } 

        $data['template']='backend/configure_terms/add'; 
        $this->load->view('templates/backend/layout', $data);
  } 


  
  public function edit($id=0,$aid=0,$offset=0)
  {  
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['update']=$this->Admin_model->getColumnDataWhere('product_configure_terms','',array('id'=>$id),'','');
    if(!$data['update']) redirect('backend/configure_terms/index/');
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    $this->session->set_userdata('aid',$aid);
    $this->session->set_userdata('vid',$id);
      if($this->form_validation->run('configure_terms_edit')==TRUE)
      {
          $inset['name']=$this->input->post('name');
          $inset['status']=$this->input->post('status');

          if($this->Common_model->update('product_configure_terms',$inset,array('id'=>$id)))
          {
            
            $this->session->set_flashdata('msg_success', 'Updated successfully.');
          }
          else
          {
           $this->session->set_flashdata('msg_error', 'Update failed, Please try again.');
          }
          redirect('backend/configure_terms/index/'.$aid.'/'.$offset); 
      }
      $data['template']='backend/configure_terms/edit';     
      $this->load->view('templates/backend/layout', $data);
  } 

 public function check_configure_terms($str)
  {
   $vid=$this->session->userdata('vid');
   $aid=$this->session->userdata('aid');

   $check=$this->Admin_model->getColumnDataWhere('product_configure_terms','',array('id !='=>$vid,'name'=>$str,'attribute_id'=>$aid),'','');

   if(count($check)>0)
   { 
        $this->form_validation->set_message('check_configure_terms',"The name field must contain a unique value.");
        return FALSE;
   }
    else{
       return TRUE;
    }

  }

  public function delete($news_id = 0,$offset=0,$id=0)
  {

      if (empty($news_id)) redirect('backend/configure_terms/index/'.$offset.'/'.$id.'');
      if ($this->Common_model->delete('product_configure_terms', array('id' => $news_id))) {
          $this->session->set_flashdata('msg_success', 'Deleted successfully.');
      } 
      else 
      {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }

    redirect('backend/configure_terms/index/'.$offset.'/'.$id.'');

  }


    public function status($id="",$status="",$offset="",$atid=0)
    {

        if(empty($id)) redirect('backend/configure_terms/index/');
        if($status==0){
            $cat_status=1;
        }

        if($status==1){
            $cat_status=0;
        }       

        $data = array('status'=>$cat_status);
        if($this->Common_model->update('product_configure_terms', $data ,array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Status has been updated successfully.');
        }
        else{
          $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

        }
        if($_SERVER['HTTP_REFERER']){
            redirect($_SERVER['HTTP_REFERER']);
        }else{

            redirect('backend/configure_terms/index/'.$offset.'/'.$atid);  
        }


    }



 


  
}

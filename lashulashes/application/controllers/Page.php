<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
			   
	}

	
	public function index()
    {
       $slug=$this->uri->segment(1);
       $data['page']=$this->Common_model->page($slug);

      
      switch ($slug) {
        
      	case 'contact-us':
          $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');

      	if($this->form_validation->run('contact')==TRUE)
        {

            $insert['first_name']=$this->input->post('first_name');
            $insert['last_name']=$this->input->post('last_name');
            $insert['email']=$this->input->post('email');
            $insert['subject']=$this->input->post('subject');
            $insert['message']=$this->input->post('message');
            $insert['address']=$this->input->post('address');
            $insert['mobile']=$this->input->post('mobile');

            $this->Common_model->insert('supports',$insert);
            redirect('contact-us');

        }
      	 $data['template'] = "frontend/page/contactus";

      	break;
        //$this->load->view('website/others/registration');
        /*case 'registration':             
           $data['template'] = "website/others/registration";
        break;*/
        case 'gallery':
           $data['gallery'] = $this->Common_model->get_result('gallery', array('status'=>'1'),'','','');
           $data['gallery_json'] = "[]";
           $data['image_count'] = -1 ;
           if($data['gallery'])
           {
              $data['gallery_json'] = json_encode($data['gallery'] );
              $data['image_count'] = count($data['gallery']) ;
           }
           $data['template'] = "frontend/page/gallery";
        break;

        case 'faq':
           $data['faqs']    = $this->Common_model->get_result('faqs', array('status'=>'1'),'','','');              
           $data['template'] = "frontend/page/faq";
        break;

      	case 'privacy-policy':
      		 $data['template'] = "frontend/page/privacy_policy";
      	break;

      	case 'terms-condition':
          $data['page']    = $this->Common_model->get_row('posts', array('post_slug'=>'terms-condition'),'','',''); 
      	 	$data['template'] = "frontend/page/terms_condition";
      	break;

      	case 'about-us':
        $data['about']    = $this->Common_model->get_result('about', array('status'=>1),'','','');
				$data['template']='frontend/page/aboutus';
		    break;

        case 'testimonials_old':
          $data['testimonials'] = $this->Common_model->get_result('testimonials', array('status'=>'1'),'','','');              
          $data['template'] = "frontend/page/testimonials_old";
        break;
	
    		/*default:
    		  $data['template']='frontend/page/page_404';
    		break; */


        default:
          $data['page']    = $this->Common_model->get_row('posts', array('post_slug'=>$slug,'status' => 1),'','',''); 
          if($data['page']){
            $data['template'] = "frontend/page/terms_condition";
          }else{
            $data['template']='frontend/page/page_404';
          }
        break;


      }
      $this->load->view('templates/frontend/layout', $data);
		  //$this->load->view('frontend/page/contactus');
	}


	


}

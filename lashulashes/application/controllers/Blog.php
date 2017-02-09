<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        $this->load->model('webs_model');
        $this->load->model('blogs_model');
			   
	}

	public function index($offset=0)
  { 
      //$data['latest_blogs'] = $this->Common_model->get_result('blogs', array('blog_status'=>'1'),'',''); 
      if(isset($_GET['Categories']))
      {
        $data['type']='cat';
        if(!empty($_GET['Categories'])) 
        $data['get'] = $_GET['Categories'];
        else
        $data['get']=0;
      }
      else if(isset($_GET['Tag']))
      {
        $data['type']='tag';
        if(!empty($_GET['Tag'])) 
        $data['get'] = $_GET['Tag'];
        else
        $data['get']=0;
      }
      else
      {
        $data['type']=0;
        $data['get']=0;
      }

      if(!empty($data['get']) && !empty($data['type']) )
      {
        /*if($data['type'] == 'tag')
        $data['total_rows'] = $this->Common_model->get_result_pagination('blogs',0,0,array('blog_status'=>'1','blog_tag'=>$data['get']));
        if($data['type'] == 'cat')
        $data['total_rows'] = $this->Common_model->get_result_pagination('blogs',0,0,array('blog_status'=>'1','blog_categoryid'=>$data['get']));*/
        $data['total_rows'] = $this->blogs_model->blog_list(0,0,$data['type'],$data['get']);
      }
      else
      {
        //$data['total_rows'] = $this->Common_model->get_result_pagination('blogs',0,0,array('blog_status'=>'1'));
          $data['total_rows'] = $this->blogs_model->blog_list(0,0);
      }

      $data['offset'] = $offset;
      $data['page_title']='Lash U Lashes :: Blog';
      $data['category'] = $this->Common_model->get_result('blog_category', array('status'=>'1'),array('category_name,category_slug'),'','');
      $data['template'] = "frontend/blogs/index";
      $this->load->view('templates/frontend/layout', $data);      
  }

  public function blog_list($type=0,$get=0,$limit=0,$offset=0)
  {  
      $offset_new = $limit * $offset;
      /*echo $get;
      die();*/
      //$per_page = 2;
      if(!empty($get) && !empty($type))
      {
        /*old*/

          /*if($type == 'tag')
            $products  = $this->Common_model->get_result_pagination('blogs',$offset,$limit,array('blog_status'=>'1','blog_tag'=>$get));
          if($type == 'cat')
            $products  = $this->Common_model->get_result_pagination('blogs',$offset,$limit,array('blog_status'=>'1','blog_categoryid'=>$get));*/
          //$total_rows =$this->Common_model->get_result_pagination('blogs',0,0,array('blog_status'=>'1','blog_categoryid'=>$get));

        /*new*/
        $products = $this->blogs_model->blog_list($offset_new,$limit,$type,$get);
      
      }
      else
      {
        /*old*/
        //$products   = $this->Common_model->get_result_pagination('blogs',$offset,$limit,array('blog_status'=>'1'));
        //$total_rows = $this->Common_model->get_result_pagination('blogs',0,0,array('blog_status'=>'1'));
        /*new*/
        $products = $this->blogs_model->blog_list($offset_new,$limit);

      }
      $html = '';
      if($products)
      {
          
          $social = array('facebook','twitter','instagram','pinterest');
          foreach ($products as $row) 
          {  
                  $html .='<div class="grid-item';
                            if(!empty($row->blog_style)) 
                            { 
                              $html .= ' '.$row->blog_style; 
                            }  
                            if(!empty($row->blog_categoryid)) 
                            { 
                              $html .=' '.$row->blog_categoryid; 
                            } 
                            if(in_array($row->blog_categoryid, $social))
                            {
                              $html .=' social'; 
                            } 
                      
                      $html .='">';

                  $html .='<a ';
                      if(!empty($row->blog_slug))
                      {
                        $html .='href="'.base_url('blog/view/'.$row->blog_slug).'"';
                      }
                        $html .=  'class="back_img">';

                      if(!empty($row->blog_thumb) && file_exists($row->blog_thumb)) 
                      {
                        $html .='<img src="'.base_url($row->blog_thumb).'">';
                      } 
                      else 
                      {
                        $html .='<img src="'.base_url('assets/frontend/images/blog_default.png').'">';
                      } 
                        $html .='</a>';

                  $html .= '<a ';
                     if(!empty($row->blog_slug))
                      {
                        $html .= 'href="'.base_url('blog/view/'.$row->blog_slug).'"';
                      }
                        $html .= 'class="cell_text">';

                        $html .='<h1>';
                          if(!empty($row->blog_title))
                          {
                            $html .= character_limiter($row->blog_title,30); 
                          }
                        $html .='</h1>';
                        $html .='<p>';
                          if(!empty($row->blog_description))
                          {
                            $html .= character_limiter(strip_tags($row->blog_description),25);
                          }
                        $html .='</p>';
                  $html .='</a>';
                  $html .='<div class="cell_type"></div>
                            <div class="cell_date">
                              <p>';
                               if(!empty($row->blog_created))
                                { 
                                  $time = strtotime($row->blog_created);
                                  $html .= date("d M 'y",$time);
                                }
                  $html .=    '</p>
                            </div>
                        </div>';
          } 
          //$html .= $this->db->last_query();

          $resulr_array = array('status'=>1,'html'=>$html);
          header('Content-Type: application/json');
          echo json_encode($resulr_array);
      }
      else
      {
          $resulr_array = array('status'=>0,'html'=>$html);
          header('Content-Type: application/json');
          echo json_encode($resulr_array);
      }
      //echo $html;
  }

  public function add_comment()
  {
      $blog_id = $_POST['blog_id'];
      $comment = $_POST['comment'];
      if(user_id() && !empty($blog_id) && !empty($comment))
      {
        $data_comment = array('blog_id'=>$blog_id,'user_id'=>user_id(),'status'=>0,'created'=>date('Y-m-d h:i:s'),'comment'=>$comment);
        if($this->Common_model->insert('blog_comment',$data_comment))
        {
            $result = array('status'=>1);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
        else
        {
            $result = array('status'=>0);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
      }
      else
      {
          $this->session->set_flashdata('msg_info', 'Please login to continue.');
          $result = array('status'=>2);
          header('Content-Type: application/json');
          echo json_encode($result);
      }
  }




	public function view($blogid = 0)
	{     
      if(empty($blogid)) redirect('blog');
      $data['blogs'] = $this->blogs_model->blog_view($blogid);              

      if(!$data['blogs']) redirect('blog');

      $data['page_title'] = 'Lash U Lashes :: Blog';
      $data['comments']   = $this->blogs_model->comment($data['blogs']->blog_id);
      $data['category']   = $this->Common_model->get_result('blog_category', array('status'=>'1'),array('category_name,category_slug'),'','');
      $data['latest_blogs'] = $this->Common_model->get_result('blogs', array('blog_status'=>'1'),'','','5');     
      //$data['tags'] = $this->Common_model->get_result('blog_tags', array('status'=>'1'),array('tag_name,tag_slug'),'',''); 
      
      $data['tags'] = '';

      $detail = $this->Common_model->get_result('blogs',array('blog_status'=>1),array('blog_tag'));
      $temp = array();
      foreach ($detail as $value) 
      {
        //foreach(explode(',', $value->blog_tag) as $key)
        //{
          //$temp[] = $key;
        //}
        $temp[] = explode(',', $value->blog_tag);
      }
      $temp = array_reduce($temp, 'array_merge',array());
      if(count($temp) >0)
      {
        $temp = array_unique($temp);
        $temp = array_values($temp);
        $data['tags'] = $temp;
      }         
       
      $data['template'] = "frontend/blogs/view";
      $this->load->view('templates/frontend/layout', $data);
	
	}

}

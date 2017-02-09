<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
			  $this->load->model('products_model');
	}
	
    public function index($offset=0)
    {

        $per_page = 9;
        $data['offset']     = $offset;
        $data['products']   = $this->products_model->product_list($offset,$per_page);

        $config             = frontend_pagination();
        $config['base_url'] = base_url('product/index/');
        $config['total_rows']=$this->products_model->product_list(0,0);
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        if(!empty($_SERVER['QUERY_STRING']))
        {
            $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
        }
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['best_product'] = $this->products_model->product_list_fix_category('best');
        $data['template'] = "frontend/product/index";
        $this->load->view('templates/frontend/layout', $data);
        
    }

    public function category($slug,$offset=0)
    {
        if(empty($slug)) redirect('product');
        $category = $this->Common_model->get_row('product_category',array('status'=>1,'category_slug'=>$slug));
        if(!$category) redirect('product');
        $category = $category->id;

        $per_page = 9;
        $data['offset']     = $offset;
        $data['products']   = $this->products_model->product_list($offset,$per_page,$category);

        $config             = frontend_pagination();
        $config['base_url'] = base_url('product/category/'.$slug);
        $config['total_rows']=$this->products_model->product_list(0,0,$category);
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        if(!empty($_SERVER['QUERY_STRING']))
        {
            $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
        }
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();



        $data['best_product'] = $this->products_model->product_list_fix_category('best');
        $data['template'] = "frontend/product/index";
        $this->load->view('templates/frontend/layout', $data);

    }

    public function featured($offset=0)
    {
        $per_page = 9;
        $data['offset']     = $offset;
        $data['products']   = $this->products_model->featured_product_list($offset,$per_page);

        $config             = frontend_pagination();
        $config['base_url'] = base_url('product/featured/');
        $config['total_rows']=$this->products_model->featured_product_list(0,0);
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        if(!empty($_SERVER['QUERY_STRING']))
        {
            $config['suffix']       = "?".$_SERVER['QUERY_STRING'];
        }
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['best_product'] = $this->products_model->product_list_fix_category('best');
        $data['template'] = "frontend/product/index";
        $this->load->view('templates/frontend/layout', $data);
    }

    public function view($slug='')
    {
        if(empty($slug)) redirect('product');
        $data['detail']         = $this->Common_model->get_row('products',array('slug'=>$slug,'status'=>1));
        if(!$data['detail']) redirect('product');
        $data['category']       = $this->Common_model->get_row('product_category',array('id'=>$data['detail']->category_id,'status'=>1));
        if(!$data['category']) redirect('product');
        $data['product_rating'] = $this->products_model->get_product_ratings($data['detail']->id);
        $data['best_product']   = $this->products_model->product_list_fix_category('best');
        $data['images']         = $this->Common_model->get_result('product_image',array('product_id'=>$data['detail']->id));
        $data['template']       = "frontend/product/detail";
        $this->load->view('templates/frontend/layout', $data);

    }


    public function attribute_options()
    {
        $product_id     = $_POST['product_id'];
        $attr_id        = $_POST['attr_id'];
        $position       = $_POST['position'];
        $variation_ids   = $_POST['variation_ids'];
        //print_r($variation_ids);
        
        $variation_key_array = array();
        $product_attribute_details = $this->Common_model->get_result('product_attribute_details',array('product_id'=>$product_id,'attribute_value !='=>'','variation_key !='=>'','status'=>1));
        
        foreach ($product_attribute_details as $row) 
        {
            $row->attribute_key = json_decode($row->attribute_key);
            $row->variation_key = json_decode($row->variation_key);
            $temp_flag = 1;
            for ($i=$position; $i >=0 ; $i--) 
            { 
                
                //echo $row->variation_key[$i].'-'.$variation_ids[$i].'<br>';
                if($row->variation_key[$i] != $variation_ids[$i])
                { 
                    $temp_flag = 0;
                    //break;
                }
                
            }
            if($temp_flag)
            {
                $variation_key_array[] = $row->variation_key[$position+1];
            }
        }
        // print_r($variation_key_array);
        $variation_list = $this->Common_model->get_in_array('product_configure_terms','id',$variation_key_array,array('status'=>1));
        $html = '<option value="">--Select--</option>';
        if($variation_list)
        {
            foreach ($variation_list as $variation_list_row)
            {
               $html .= '<option value="'.$variation_list_row->id.'">'.$variation_list_row->name.'</option>';
            }
        }
       
        echo $html;
    }


    public function product_price()
    {
        $product_id = $_POST['id'];
        $attribute_key = json_encode($_POST['argument']);
        $variation_key = json_encode($_POST['value']);
        $price = $this->Common_model->get_row('product_attribute_details',array('product_id'=>$product_id,'attribute_key'=>$attribute_key,'variation_key'=>$variation_key));
        if(!$price) 
        {
            $result = array('status'=>0);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
        else
        {
            if(!empty($price->attribute_value))
            {
                $result = array('status'=>1,'price'=>$price->attribute_value,'variation_id'=>$price->id);
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

    }

    public function check_review()
    {
        if(user_logged_in())
        {
            $product_id = $_POST['product_id'];
            if($this->Common_model->get_row('rating',array('user_id'=>user_id(),'product_id'=>$product_id)))
            {
                $result = array('status'=>1);
                header('Content-Type: application/json');
                echo json_encode($result);
            }
            else
            {
                $result = array('status'=>2);
                header('Content-Type: application/json');
                echo json_encode($result);

            }
        }
        else
        {
            $result = array('status'=>0);
            header('Content-Type: application/json');
            echo json_encode($result);

        }
    }

    public function add_review()
    {
            $product_id = $_POST['product_id'];
            $review = $_POST['review'];
            $score = $_POST['score'];
            $result = array('status'=>0);

            if($this->Common_model->get_row('rating',array('user_id'=>user_id(),'product_id'=>$product_id)))
            {
                $result = array('status'=>0);
            }
            else
            {
                if($this->Common_model->insert('rating',array('user_id'=>user_id(),'product_id'=>$product_id,'review'=>$review,'rating'=>$score,'status'=>0)))
                {
                    $result = array('status'=>1);
                }
                else
                {
                    $result = array('status'=>2);
                }
            }

            header('Content-Type: application/json');
            echo json_encode($result);
    }

    public function add_to_favorites()
    {
            $product_id = $_POST['product_id'];
            $user_id = user_id();

            if($user_id)
            {
                if($this->Common_model->get_row('my_favorites',array('user_id'=>user_id(),'product_id'=>$product_id)))
                {
                    $result = array('status'=>1);
                }
                else
                {
                    if($this->Common_model->insert('my_favorites',array('user_id'=>user_id(),'product_id'=>$product_id)))
                    {
                        $result = array('status'=>2);
                    }
                    else
                    {
                        $result = array('status'=>3);
                    }
                }
            }
            else
            {
                $result = array('status'=>0);
            }

            header('Content-Type: application/json');
            echo json_encode($result);
    }


}

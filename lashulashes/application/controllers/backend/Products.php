<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
       if(superadmin_logged_in()==FALSE)
       {
        redirect('backend/login'); 
       }
       
      $this->load->model('products_model');
	}

	
public function index($offset = 0)
{	
    $data['page_title'] = 'Dashboard :: Admin Panel';
    $per_page = RECORDS_PER_PAGE;
    $data['offset']=$offset; 
    $data['products'] = $this->products_model->products($offset, $per_page);
    $config = backend_pagination();
    $config['base_url'] = base_url().'backend/products/index/';
    $config['total_rows'] = $this->products_model->products(0, 0);
    $config['per_page'] = $per_page;
    $config['uri_segment']  = 4;
    if(!empty($_SERVER['QUERY_STRING']))
    {
      $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
    }


    $this->pagination->initialize($config);

    $data['pagination'] = $this->pagination->create_links();

    $data['template'] = "backend/products/index";
    $this->load->view('templates/backend/layout', $data);

}
    

public function add() 
{ 

    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    $data['category']=$this->Admin_model->getColumnDataWhere('product_category','id,category_name',array('status'=>'1'),'','');
    //$data['variation'] = $this->Admin_model->getColumnDataWhere('product_attributes','id,attribute',array('status'=>'1'),'',''); 
    $data['type']=$this->Admin_model->getColumnDataWhere('product_type','id,type',array('status'=>'1'),'',''); 

         if($this->input->post('type')=='Simple')
         {
           $validation='products_add_simple';
         }
         else
         {
           $validation='products_add_variation'; 
         }

        if($this->form_validation->run($validation)==TRUE)
        { 
                $inset['title']       = $this->input->post('title');
                $inset['slug']        = url_title($this->input->post('title'),'-');
                $inset['type']        = $this->input->post('type');
                $inset['category_id'] = $this->input->post('category_id');
                $inset['price']       = $this->input->post('price');
                $inset['bar_code']    = $this->input->post('bar_code');
                $inset['description'] = $this->input->post('description');
                $inset['short_description'] = $this->input->post('short_description'); 
                $inset['popular']     = $this->input->post('popular');
                $inset['recent']      = $this->input->post('recent');   
                $inset['best']        = $this->input->post('best');
                $inset['status']      = $this->input->post('status');

                $lastid=$this->Common_model->insert('products',$inset);

                if($lastid)
                {
                  $users = $this->Common_model->get_result('users',array('user_role'=>2));
                  if($users)
                  {
                    foreach ($users as $users_row) 
                    {
                        $my_products = json_decode($users_row->my_products);
                        if(!is_array($my_products)) $my_products = array();
                        //echo var_dump($my_products[0]);exit;
                        $my_products[] = (string)$lastid;
                        $my_products = json_encode($my_products);
                        $this->Common_model->update('users',array('my_products'=>$my_products),array('id'=>$users_row->id,'user_role'=>2));
                    }
                  }



                  if($inset['type']=='Simple')
                  {
                      $this->session->set_flashdata('msg_success', 'Product added successfully. Please select product images');
                      redirect('backend/products/add_one/'.$lastid.'/profile');
                  }
                  else
                  {
                      $this->session->set_flashdata('msg_success', 'Product added successfully. Please select product attributes');
                      redirect('backend/products/add_one/'.$lastid.'/attributes');
                  }
                }
                else
                {

                 $this->session->set_flashdata('msg_error', 'New add product failed, Please try again.');

                }

                
        } 

    $data['template']='backend/products/add'; 
    $this->load->view('templates/backend/layout', $data);

} 


public function add_one($productid=0,$tab='',$offset=0) 
{  
    $data['offset'] = $offset;
    if(empty($productid)) redirect('backend/products');
    
    if(empty($tab)) 
    $data['tab'] = "home";
    else
    $data['tab'] = $tab;
    
    $data['product_id'] = $productid;
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    
    $data['category']=$this->Admin_model->getColumnDataWhere('product_category','id,category_name',array('status'=>'1'),'',''); 
    
    $data['distributor'] = $this->Common_model->get_result('users',array('user_role'=>2));

    $data['type']=$this->Admin_model->getColumnDataWhere('product_type','id,type',array('status'=>'1'),'','');
    
    $data['all_attribute'] = $this->Admin_model->getColumnDataWhere('product_attributes as pa','pa.id,pa.attribute,(select count(pv.id) from product_configure_terms as pv where pv.attribute_id = pa.id and pv.status=1) as count',array('status'=>'1'),'attribute','');

    $data['variation'] = $this->Admin_model->getColumnDataWhere('product_attribute_details','',array('product_id'=>$productid),'','');
    
    $data['all_variation'] = $this->Admin_model->getColumnDataWhere('product_configure_terms','',array('status'=>1),'','');
    
    $data['update_image']=$this->Admin_model->getColumnDataWhere('product_image','',array('product_id'=>$productid),'','');
   
    $data['update']=$this->Admin_model->getColumnDataWhere('products','',array('id'=>$productid),'','');
    
    if(count($data['update'])<1) redirect('backend/products');    
    
    $data['attribute']=$this->Admin_model->getColumnDataWhere('product_attributes','',array('status'=>1),'','');
    
    $this->session->set_userdata('productid',$productid); 
    
    $data['variation_status'] = 1;

    if($data['update'][0]->type=='Simple')
    { 
      $validation='products_add_one_simple';
      $attr = array();
    } 
    else
    {
      $validation='products_add_one_variation';
      if(!empty($data['update'][0]->attributes)) 
      {
        ///echo $data['update'][0]->attributes;
        $attr = json_decode($data['update'][0]->attributes);
        foreach ($data['all_attribute'] as $attr_row) 
        {
           if(in_array($attr_row->id,$attr))
           {
              if($attr_row->count<1)
              {
                $data['variation_status']=0;
                $this->session->set_flashdata('msg_error', 'Please reset product attributes.');
              }
           }
        }
      }

    }

    if($_POST)
    {
      if($this->input->post('type')=='Simple')
      {
        $validation='products_add_one_simple';
        $attr = array();
      }
      else
      {
        $validation='products_add_one_variation';
      }
    }
    
    
    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
    if($this->form_validation->run($validation)==TRUE)
    {
          $inset['title']       = $this->input->post('title');
          $inset['slug']        = url_title($this->input->post('title'),'-');
          $inset['category_id'] = $this->input->post('category_id');
          $inset['status']      = $this->input->post('status');
          $inset['description'] = $this->input->post('description');
          $inset['price']       = $this->input->post('price');
          $inset['bar_code']    = $this->input->post('bar_code');
          $inset['type']        = $this->input->post('type');
          $inset['recent']      = $this->input->post('recent');   
          $inset['popular']     = $this->input->post('popular');
          $inset['best']        = $this->input->post('best');
          $inset['short_description'] = $this->input->post('short_description'); 
               
          if($inset['type']=='Simple')
          {
            $inset['attributes'] = '';
            
          }
          else
          {
            $inset['price']      = '';
            $inset['bar_code']   = '';
          }

          if($this->Common_model->update('products',$inset,array('id'=>$productid)))
          {
            if($inset['type']=='Simple') 
            {
              $this->Common_model->delete('product_attribute_details',array('product_id'=>$productid));
            }
            $this->session->set_flashdata('msg_success', 'Product save successfully.');
            redirect('backend/products/add_one/'.$productid.'/home/'.$offset);
          }//$productid=0,$tab='',$offset=0
          else{

          $this->session->set_flashdata('msg_error', 'Failed, Please try again.');

          }
          //redirect('backend/products/index');
    } 

    $data['template']='backend/products/add_one'; 
    $this->load->view('templates/backend/layout', $data);

} 

public function add_attributes($productid=0,$offset=0)
{
    if(empty($productid)) redirect('backend/products');

    if(isset($_POST['attributes']))
    {
          $attributes=$_POST['attributes'];
          $attributes_array=array();
          foreach ($attributes as $value) 
          {
            $attributes_array[]=$value;
          }
          $attributes = json_encode($attributes_array);
          $this->Common_model->update('products',array('attributes'=>$attributes),array('id'=>$productid));
          $this->Common_model->delete('product_attribute_details', array('product_id'=>$productid));

          $this->Common_model->insert('product_attribute_details', array('product_id'=>$productid,'attribute_key'=>$attributes));
          $this->session->set_flashdata('msg_success', 'Attributes update successfully. Please select variation.');
          redirect('backend/products/add_one/'.$productid.'/attributes/'.$offset);  
    }   
    else
    {
     $this->session->set_flashdata('msg_error', 'Please select product attributes.');
     redirect('backend/products/add_one/'.$productid.'/attributes/'.$offset);
    }

}

public function save_variations($productid=0,$offset=0)
{
    if(empty($productid)) redirect('backend/products');

    $attribute_details = $this->Common_model->get_result('product_attribute_details',array('product_id'=>$productid));
    if(!$attribute_details) redirect('backend/products');
    
    foreach ($attribute_details as $key) 
    {
      $this->form_validation->set_rules('price_'.$key->id, 'price', 'required');
      $this->form_validation->set_rules('bar_code_'.$key->id, 'price', 'required');
    }

    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');


    if($this->form_validation->run() == FALSE)
    {
          $this->session->set_flashdata('msg_error', 'Please enter all price or bar code fields.');
          redirect('backend/products/add_one/'.$productid.'/variation/'.$offset);
    }
    else
    {
            $save_count=0;
            $duplicate_count = 0;

            $details =$this->Common_model->get_row('products',array('id'=>$productid));
            if(!$details) redirect('backend/products');
            $attribute = $details->attributes;
            if(empty($attribute)) redirect('backend/products');
            $attribute_keys  = json_decode($attribute);
            $attribute_count = count($attribute_keys);
            /*$all_variation = $this->Common_model->get_result('product_configure_terms');
            if(!$all_variation) redirect('backend/products');*/
            $bar_array1 = $this->Common_model->get_result('products',array('type'=>'Simple'),array('bar_code'));
            $bar_array2 = $this->Common_model->get_result('product_attribute_details',array(),array('id','bar_code'));
            $temp =array();
            foreach ($bar_array1 as $value) 
            {
              if(!empty($value->bar_code))
              {
                $temp[] = $value->bar_code;
              }
            }
            $bar_array1 = $temp;

            $temp = array();
            foreach ($bar_array2 as $value) 
            {
              if(!empty($value->bar_code))
              {
                  $temp[] = array('id'=>$value->id,'bar_code'=>$value->bar_code);
              }
            }
            $bar_array2 = $temp;
            unset($temp);
            $flag = 1;
            $repeated_bar = array();
            foreach ($attribute_details as $key) 
            {
                if(in_array($this->input->post('bar_code_'.$key->id), $bar_array1))
                {
                  $flag = 0;
                  $repeated_bar[$key->id] = $this->input->post('bar_code_'.$key->id);
                }

                foreach ($bar_array2 as $row2) 
                {
                  if(($row2['id']!=$key->id)&&(!empty($row2['bar_code'])))
                  {
                    if($row2['bar_code'] == $this->input->post('bar_code_'.$key->id))
                    {
                      $flag = 0;
                      $repeated_bar[$key->id] = $this->input->post('bar_code_'.$key->id);
                    }
                  }
                }
            }

            if($flag == 0)
            {
              $k=0;
              $bar_msg='';
              $repeated_bar_count = count($repeated_bar);
              if($repeated_bar_count > 0)
              {
                  foreach ($repeated_bar as $row3) 
                  {
                      if($k<1)
                      {
                        $bar_msg = $row3;
                      }
                      else
                      {
                        $bar_msg .= ', '.$row3;
                      }
                      $k++;
                  }
                  if($repeated_bar_count == 1 )
                  {
                    $this->session->set_flashdata('msg_error', ' '.$bar_msg.'. This barcode already exists.');
                  }
                  else
                  {
                    $this->session->set_flashdata('msg_error', ' '.$bar_msg.'. All of these barcodes already exists.');
                  }
              }
              else
              {
                $this->session->set_flashdata('msg_error', 'Please remove duplicate entries.');
              }


              redirect('backend/products/add_one/'.$productid.'/variation/'.$offset);
            }

            foreach ($attribute_details as $key) 
            {
                $attribute_key_array = array();
                for ($ac=0; $ac <$attribute_count; $ac++) 
                { 
                  //$input = 'var_'.$ac.'_'.$key->id;
                  $attribute_key_array[]= $this->input->post('var_'.$ac.'_'.$key->id);
                }
               $data['variation_key'] = json_encode($attribute_key_array);
               $data['attribute_value'] = $this->input->post('price_'.$key->id);
               $data['bar_code'] = $this->input->post('bar_code_'.$key->id);
               $data['status'] =1;

               $temp_detail = $this->Common_model->get_row('product_attribute_details',array('id'=>$key->id));
               $temp_id     = $temp_detail->product_id;
               $temp_detail = $temp_detail->attribute_key;
               if($this->Common_model->get_row('product_attribute_details',array('product_id'=>$temp_id,'attribute_key'=>$temp_detail,'variation_key'=>$data['variation_key'],'id !='=>$key->id)))
               {
                  //$this->Common_model->delete('product_attribute_details',array('id'=>$key->id));
                  $duplicate_count++;
               }
               else
               {
                  $this->Common_model->update('product_attribute_details',$data,array('id'=>$key->id));
                  $save_count++;
               }
            }
            $message='';
            if($save_count>0)
            {
              $message = $save_count.' - Variations updated successfully.<br>';
              $this->session->set_flashdata('msg_success', $message);
            }
            if($duplicate_count>0)
            {
              $message = $duplicate_count.' - Variation already exists.';
              $this->session->set_flashdata('msg_error', $message);
            }
            if($save_count<1 && $duplicate_count<1)
            {
              $this->session->set_flashdata('msg_error', 'Please try again.');
            }
            /* else
            {
              $this->session->set_flashdata('msg_success', $message);            
            }*/

            redirect('backend/products/add_one/'.$productid.'/variation/'.$offset);
    } 

}

public function add_more_variation()
{
  $id   = $_POST['id'];
  $attr = $_POST['attr'];
  $insert_id = $this->Common_model->insert('product_attribute_details',array('product_id'=>$id,'attribute_key'=>$attr));
  $data = $this->Common_model->get_result('product_attribute_details',array('product_id'=>$id));
  $data_count = count($data);
  $all_variation = $this->Admin_model->getColumnDataWhere('product_configure_terms','',array(),'','');
  $data_count--;
  $html='';
  $attribute_keys  = json_decode($attr);
  $attribute_count = count($attribute_keys);
  $html .='
            <div class="form-group" id="variation_row_'.$data_count.'">
            <div class="col-md-2">
                Bar Code
                  <input type="text"  required="" name="bar_code_'.$insert_id.'" value="" class="form-control" placeholder="Enter bar code">
                </div>';
              for ($ac=0; $ac < $attribute_count; $ac++) {  
                $html .='<div class="col-md-2">
                          '.ucwords(strtolower(attribute_name($attribute_keys[$ac]))).'
                          <select name="var_'.$ac.'_'.$insert_id.'" class="form-control" required>';
                             foreach ($all_variation as $row) { 
                                 if($row->attribute_id==$attribute_keys[$ac]) {
                                  $html .='<option value="'.$row->id.'">'. $row->name.'</option>';
                                 } 
                              } 
                $html .='  </select>
                        </div>';
                } 
                $html .='<div class="col-md-1">
                  Price
                  <input type="text" name="price_'.$insert_id.'" value="" required class="form-control" placeholder="Enter price" onkeyup="input_numeric(this);">
                </div>
                <div class="col-md-1 pull-right">';
                   if($data_count>0) { 
                    $html .='<label onclick="remove_variarion('.$insert_id.','.$data_count.');" class="text-danger" style ="cursor: pointer">remove</label>';
                   } 
  $html .='     </div>
                <div class="clearfix"></div><hr>
          </div>';

  echo $html;
}

public function remove_more_variation()
{
  $id = $_POST['id'];
  if($this->Common_model->delete('product_attribute_details',array('id'=>$id)))
    echo TRUE;
  else
    echo FALSE;
}

public function change_active_image()
{
    $id = $_POST['id'];
    $id = explode('_',  $id);
    if(count($id)==2)
    {
      $imageid = $id[0];
      $productid = $id[1];
      $this->Common_model->update('product_image',array('active'=>0),array('product_id'=>$productid));
      $this->Common_model->update('product_image',array('active'=>1),array('product_id'=>$productid,'id'=>$imageid));

    }
   
}

public function reload_image_page()
{
   $html = $_POST['html'];
   $this->session->set_flashdata('msg_info',$html);
   echo 1;
}

 
public function addvariation1($product_id)
{ 
    $inset['product_id']=$product_id;
    $i=0;
    foreach($this->input->post('key') as $keys)
    {
      $inset['attribute_key']=$this->input->post('key')[$i];
      $inset['attribute_value']=$this->input->post('value')[$i];
      $lastid=$this->Common_model->insert('product_attribute_details',$inset); 
      $i++; 
    }

    redirect('backend/products/add_one/'.$product_id);
}

public function addvariation($product_id)
{
  
        $inset['product_id']=$product_id;  
        for($i=0;$i<$_POST['count_view_one'];$i++)
          {                   
          
            $inset['attribute_key']=$this->input->post('LessionViewOneSentence'.$i);
            $inset['attribute_value']=$this->input->post('LessionViewOneOtherSentence'.$i);
            $lastid=$this->Common_model->insert('product_attribute_details',$inset); 
  
          }
        $this->session->set_flashdata('msg_success', 'Variation added successfully.'); 
        redirect('backend/products/add_one/'.$product_id);
    
}




public function edit($productid=0)
{  
    $data['page_title'] = 'Dashboard :: Admin Panel'; 
    $data['category']=$this->Admin_model->getColumnDataWhere('product_category','id,category_name',array('status'=>'1'),'',''); 
    $data['type']=$this->Admin_model->getColumnDataWhere('product_type','id,type',array('status'=>'1'),'',''); 
    $data['update']=$this->Admin_model->getColumnDataWhere('products','',array('id'=>$productid),'','');
    $data['variation'] = $this->Admin_model->getColumnDataWhere('product_attributes','id,attribute',array('status'=>'1'),'',''); 
    $data['update_image']=$this->Admin_model->getColumnDataWhere('product_image','',array('product_id'=>$productid),'','');
   

    $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
     
        if($this->form_validation->run('products_add_one_simple')==TRUE)
          {      
             $inset['title']=$this->input->post('title');
             $inset['slug']=url_title($this->input->post('slug'),'-');
             $inset['category_id']=$this->input->post('category_id');
             $inset['status']=$this->input->post('status');
             $inset['description']=$this->input->post('description');
             $inset['price']=$this->input->post('price');    
            if($this->Common_model->update('products',$inset,array('id'=>$productid)))
            { 
              $this->session->set_flashdata('msg_success', 'Product updated successfully.');
            }else{
             $this->session->set_flashdata('msg_error', 'Product update failed, Please try again.');

            }
            redirect('backend/products/index');              

          }
    $data['template']='backend/products/edit_next';     
    $this->load->view('templates/backend/layout', $data);
} 

public function delete($product_id = 0)
{

      if (empty($product_id)) redirect('backend/products/index');
      if ($this->Common_model->delete('products', array('id' => $product_id)))
      {
          $this->Common_model->delete('product_attribute_details', array('product_id' => $product_id));
          $this->session->set_flashdata('msg_success', 'Product deleted successfully.');
      } 
      else 
      {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }

     redirect('backend/products/index');
}


public function deleteimage($imageid = 0,$productid=0,$offset=0)
{
       
    if (empty($imageid)) redirect('backend/products/index');
    if (empty($productid)) redirect('backend/products/index');
    $detail = $this->Common_model->get_row('product_image',array('id'=>$imageid));
    /* print_r($detail);
    die();*/
    if(!$detail) redirect('backend/products/index');

    if ($this->Common_model->delete('product_image', array('id' => $imageid))) {
        $filepath="assets/uploads/product/".$detail->image.""; 
        if(!empty($filepath)&&file_exists($filepath)) unlink($filepath);
        $this->session->set_flashdata('msg_success', 'Image deleted successfully.');
    } else {
        $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }

   redirect('backend/products/add_one/'.$productid.'/profile/'.$offset);

}

public function save_distributor($productid=0,$offset=0)
{
  if(empty($productid)) redirect('backend/products');
  if($this->Common_model->get_row('products', array('id' => $productid)))
  {
    $distributor_array = array();
    if(isset($_POST['distributor_array']))
    {
      $distributor_array = $_POST['distributor_array'];
    }

    /*print_r($distributor_array);
    die();*/
    //$distributor_array = json_encode($distributor_array);

    $users = $this->Common_model->get_result('users',array('user_role'=>2));
    
    if($users)
    {
      foreach ($users as $users_row)
      {
        $my_products = json_decode($users_row->my_products);
        if(!is_array($my_products)) $my_products = array();
        $my_products = array_values($my_products);

        if(in_array($users_row->id,$distributor_array))
        {
            if(!in_array($productid, $my_products))
            {
              $my_products[] = $productid;
              $my_products = json_encode($my_products);

              $this->Common_model->update('users',array('my_products'=>$my_products),array('id'=>$users_row->id,'user_role'=>2));
              //die('found');
            }
        }
        else
        {
          
          $key = array_search($productid,$my_products);

          if($key === 0 || $key > 0)
          { 
            
            unset($my_products[$key]);
            $my_products = json_encode($my_products);
            $this->Common_model->update('users',array('my_products'=>$my_products),array('id'=>$users_row->id,'user_role'=>2));
          }

        }

      }
      $this->session->set_flashdata('msg_success', 'Distributor List updated successfully.');

    }
    else
    {
      $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      redirect('backend/products/add_one/'.$productid.'/distributor/'.$offset);
    }
  } 
  else 
  {
      if(empty($productid)) redirect('backend/products');
  }
  redirect('backend/products/add_one/'.$productid.'/distributor/'.$offset);
}

public function status($id="",$status="",$offset="")
{
    if(empty($id)) redirect('backend/products/index/');
    if($status==0){
        $cat_status=1;
    }

    if($status==1){
        $cat_status=0;
    }       

    $data = array('status'=>$cat_status);
    if($this->Common_model->update('products', $data ,array('id'=>$id)))
    {
       $this->session->set_flashdata('msg_success','Product status has been updated successfully.');
    }
    else{
      $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

    }
    redirect('backend/products/index/'.$offset);  
}

public function getattribute($id)
{
     $data=$this->Admin_model->getColumnDataWhere('product_attribute_details','',array('product_id'=>$id),'','');
     echo json_encode($data);
}

public function upload($product_id)
{
    $output_dir = "assets/uploads/product/";

    if(isset($_FILES["myfile"]))
    {
      $ret = array();

      $error =$_FILES["myfile"]["error"];
      {
        
          if(!is_array($_FILES["myfile"]['name'])) //single file
          {
              $name = $_FILES["myfile"]['name'];
              $param=array(
                  'file_name' =>'myfile',
                  'upload_path'  => './assets/uploads/product/',
                  'allowed_types'=> 'gif|jpg|png|jpeg',
                  'image_resize' => TRUE,
                  'source_image' => './assets/uploads/product/',
                  'new_image'    => './assets/uploads/product/thumb/',
                  'encrypt_name' => TRUE,
                  'min_width'    => 450,
                  'min_height'   => 400,
                  'max_width'    => 1280,
                  'max_height'   => 1280,
                  'resize_width' => 450,
                  'resize_height'=> 400
                );

                $upload_file=upload_file($param);

                if($upload_file['STATUS'])
                {

                  $inset['product_id']=$product_id;
                  $inset['image']=$upload_file['UPLOAD_DATA']['file_name'];
                  $inset['thumb']=$upload_file['UPLOAD_DATA']['file_name'];
                  $lastid=$this->Common_model->insert('product_image',$inset); 
                  
                  $ret[$name]= "Uploaded successfully";
                }
                else{         
                  $ret[$name]= $upload_file['FILE_ERROR'];
                }
                
          }
          else
          {
            $fileCount = count($_FILES["myfile"]['name']);
            for($i=0; $i < $fileCount; $i++)
            {
                
                $_FILES['test_image']['name']     = $_FILES["myfile"]['name'][$i];
                $_FILES['test_image']['type']     = $_FILES["myfile"]['type'][$key];
                $_FILES['test_image']['tmp_name'] = $_FILES["myfile"]['tmp_name'][$key];
                $_FILES['test_image']['error']    = $_FILES["myfile"]['error'][$key];
                $_FILES['test_image']['size']     = $_FILES["myfile"]['size'][$key];  
                $name = $_FILES["myfile"]['name'][$i];
                $param=array(
                    'file_name' =>'test_image',
                    'upload_path'  => './assets/uploads/product/',
                    'allowed_types'=> 'gif|jpg|png|jpeg',
                    'image_resize' => TRUE,
                    'source_image' => './assets/uploads/product/',
                    'new_image'    => './assets/uploads/product/thumb/',
                    'encrypt_name' => TRUE,
                    'min_width'    => 450,
                    'min_height'   => 400,
                    'max_width'    => 1280,
                    'max_height'   => 1280,
                    'resize_width' => 450,
                    'resize_height'=> 400
                  );

                $upload_file=upload_file($param);

                if($upload_file['STATUS'])
                {

                  $inset['product_id']=$product_id;
                  $inset['image']=$upload_file['UPLOAD_DATA']['file_name'];
                  $inset['thumb']=$upload_file['UPLOAD_DATA']['file_name'];
                  $lastid=$this->Common_model->insert('product_image',$inset); 
                  
                  $ret[$name]= "Uploaded successfully";
                }
                else{         
                  $ret[$name]= $upload_file['FILE_ERROR'];
                }

            }
          }
      
      }
             
      echo json_encode($ret);       
    }
}

function addtest()
{
  
   $data['template']='backend/products/add_test'; 
   $this->load->view('templates/backend/layout', $data);
}

public function check_updateproduct($str)
{
    $id=$this->session->userdata('productid');
    $check=$this->Admin_model->getColumnDataWhere('products','',array('id !='=>$id,'title'=>$str),'','');

    if(count($check)>0)
    { 
        $this->form_validation->set_message('check_updateproduct',"The product name field must contain a unique value.");
        return FALSE;
    }
    else
    {
      return TRUE;
    }

}

public function rating($product_id='',$offset=0)
{
  if(empty($product_id)) redirect('backend/products');
  $product_detail = $this->Common_model->get_row('products',array('id'=>$product_id));
  if(!$product_detail) redirect('backend/products');

    $data['page_title'] = 'Dashboard :: Admin Panel';
    $per_page = 10;
    $data['offset']=$offset; 
    $data['products'] = $this->products_model->rating_list($product_id,$offset, $per_page);

    $config = backend_pagination();

    $config['base_url'] = base_url() .'backend/products/rating/'.$product_id;

    $config['total_rows'] = $this->products_model->rating_list($product_id,0,0);

    $config['per_page'] = $per_page;
    $config['uri_segment'] = 5;

    $this->pagination->initialize($config);

    $data['pagination'] = $this->pagination->create_links();

    $data['template'] = "backend/products/rating";
    $this->load->view('templates/backend/layout', $data);

}

public function rating_status($id="",$product_id="",$status="",$offset="")
{
    if(empty($id)||empty($product_id)) redirect('backend/products/index/');
    if($status==0){
        $cat_status=1;
    }

    if($status==1){
        $cat_status=0;
    }       

    $data = array('status'=>$cat_status);
    if($this->Common_model->update('rating', $data ,array('rating_id'=>$id)))
    {
       $this->session->set_flashdata('msg_success','Status has been updated successfully.');
    }
    else{
      $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

    }
    redirect('backend/products/rating/'.$product_id.'/'.$offset);  
}

public function rating_delete($rating_id = 0,$product_id=0)
{

    if (empty($rating_id)) redirect('backend/products/rating');
    if($this->Common_model->delete('rating', array('rating_id' => $rating_id)))
    {          
        $this->session->set_flashdata('msg_success', 'Deleted successfully.');
    } 
    else 
    {
        $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
    }

    redirect('backend/products/rating/'.$product_id);
}

public function check_barcode($bar)
{
    if($this->Common_model->get_result('products',array('bar_code'=>$bar)))
    {
      $this->form_validation->set_message('check_barcode',"The bar code field must contain a unique value.");
      return FALSE;
    }
    else
    {
      if($this->Common_model->get_result('product_attribute_details',array('bar_code'=>$bar)))
      {
        $this->form_validation->set_message('check_barcode',"The bar code field must contain a unique value.");
        return FALSE;
      }
      else
      {
        return TRUE;
      }

    }
}

public function check_edit_barcode($bar)
{
    $productid = $this->session->userdata('productid'); 

    if($this->Common_model->get_result('products',array('bar_code'=>$bar,'id !='=>$productid)))
    {
      $this->form_validation->set_message('check_edit_barcode',"The bar code field must contain a unique value.");
      return FALSE;
    }
    else
    {
      if($this->Common_model->get_result('product_attribute_details',array('bar_code'=>$bar)))
      {
        $this->form_validation->set_message('check_edit_barcode',"The bar code field must contain a unique value.");
        return FALSE;
      }
      else
      {
        return TRUE;
      }

    }
}

public function arrange_orders()
{
  $data['page_title'] = 'Dashboard :: Admin Panel';
  $data['products'] = $this->Common_model->get_result('products',array(),array(),array('order','asc'));
  foreach ($data['products'] as $row) 
  {
    $this->form_validation->set_rules('order_'.$row->id,'Order','trim|required|numeric');
  }
  $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
  if($this->form_validation->run()==TRUE)
  {
    $inset = array();
    foreach ($data['products'] as $row) {
        
        $temp  =  array(
                        'id' => $row->id,
                    'order'  => $this->input->post('order_'.$row->id)
                 );
        $inset[] = $temp;
    }
    $this->db->update_batch('products',$inset,'id');

    $this->session->set_flashdata('msg_success', 'Product order updated successfully.');

    redirect('backend/products/');
  }
  $data['template'] = "backend/products/arrange_order";
  $this->load->view('templates/backend/layout', $data);
}
  
}

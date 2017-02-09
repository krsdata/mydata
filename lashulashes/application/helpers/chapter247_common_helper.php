<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('clear_cache')) {

	function clear_cache(){

		$CI =& get_instance();

		$CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT' );

		$CI->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');

		$CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");

		$CI->output->set_header("Pragma: no-cache");

	}

}



if ( ! function_exists('superadmin_logged_in')) {
	function superadmin_logged_in(){
		$CI =& get_instance();
		$user_role = $CI->session->userdata('admin_role');
		$logged_in = $CI->session->userdata('admin_logged_in');
		if($logged_in===TRUE && $user_role == 0 )
			return TRUE;
		else
			return FALSE;
	}
}

if ( ! function_exists('user_logged_in')) {
	function user_logged_in(){
		$CI =& get_instance();
		$user_role = $CI->session->userdata('user_role');
		$logged_in = $CI->session->userdata('logged_in');
		if($logged_in===TRUE && $user_role == 1 )
			return TRUE;
		else
			return FALSE;
	}
}

if ( !function_exists('user_id')) {
	function user_id(){
		$CI =& get_instance();
		$user_id = $CI->session->userdata('id');
		$user_role = $CI->session->userdata('user_role');
		$logged_in = $CI->session->userdata('logged_in');
		if($logged_in===TRUE && $user_role == 1)
			return $user_id;
		else
			return FALSE;
	}
}
if ( !function_exists('user_name')) {
	function user_name(){
		$CI =& get_instance();
		$user_name = $CI->session->userdata('user_name');
		$user_role = $CI->session->userdata('user_role');
		$logged_in = $CI->session->userdata('logged_in');
		if($logged_in===TRUE && $user_role == 1)
			return $user_name;
		else
			return FALSE;
	}
}

if ( !function_exists('user_image')) {
	function user_image(){
		$CI =& get_instance();
		$user_image = $CI->session->userdata('user_image');
		$user_role = $CI->session->userdata('user_role');
		$logged_in = $CI->session->userdata('logged_in');
		if($logged_in===TRUE && $user_role == 1)
		{
			if(!empty($user_image) && file_exists($user_image))
			{
			 	return base_url($user_image);
		    }
		    else
		    {
		    	return base_url('assets/frontend/images/user_image.jpg');
		    }
		}
		else
			return FALSE;
	}
}
////////////////////////////////////

if ( ! function_exists('distributor_logged_in')) {
	function distributor_logged_in(){
		$CI =& get_instance();
		$user_role = $CI->session->userdata('distributor_role');
		$logged_in = $CI->session->userdata('distributor_logged_in');
		if($logged_in===TRUE && $user_role == 2 )
			return TRUE;
		else
			return FALSE;
	}
}

if ( !function_exists('distributor_id')) {
	function distributor_id(){
		$CI =& get_instance();
		$user_id = $CI->session->userdata('id');
		$user_role = $CI->session->userdata('distributor_role');
		$logged_in = $CI->session->userdata('distributor_logged_in');
		if($logged_in===TRUE && $user_role == 2)
			return $user_id;
		else
			return FALSE;
	}
}
if ( !function_exists('distributor_name')) {
	function distributor_name(){
		$CI =& get_instance();
		$user_name = $CI->session->userdata('distributor_name');
		$user_role = $CI->session->userdata('distributor_role');
		$logged_in = $CI->session->userdata('distributor_logged_in');
		if($logged_in===TRUE && $user_role == 2)
			return $user_name;
		else
			return FALSE;
	}
}

if ( !function_exists('distributor_image')) {
	function distributor_image(){
		$CI =& get_instance();
		$user_image = $CI->session->userdata('distributor_image');
		$user_role = $CI->session->userdata('distributor_role');
		$logged_in = $CI->session->userdata('distributor_logged_in');
		if($logged_in===TRUE && $user_role == 2)
		{
			if(!empty($user_image) && file_exists($user_image))
			{
			 	return base_url($user_image);
		    }
		    else
		    {
		    	return base_url('assets/frontend/images/user_image.jpg');
		    }
		}
		else
			return FALSE;
	}
}
///////////////////////////////////////////////////////

if (!function_exists('variation_price')) 
{
	function variation_price($user_id)
	{
		$CI =& get_instance();
		$result = $CI->Common_model->get_result('product_attribute_details',array('product_id'=>$user_id));
		if($result)
		{
			if(count($result)>1)
			{
				$price = array();
				foreach ($result as $value) 
				{
					if(in_array($value->attribute_value, $price) || empty($value->attribute_value))
					{

					}
					else
					{
						$price[] = $value->attribute_value;
					}
				}

				if(count($price) > 1)
				{
					asort($price);
					$temp = '('.current($price).' - '.end($price).')';
					return $temp;
				}
				else if(count($price) == 1)
				{
					return $price[0];
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return $result[0]->attribute_value;
			}
		}
		else
		{
			return '';
		}
	}
}

if (!function_exists('attribute_name')) 
{
	function attribute_name($att_id)
	{
		$CI =& get_instance();
		$result = $CI->Common_model->get_row('product_attributes',array('id'=>$att_id));
		if($result)
		{
			if(!empty($result->attribute))
			{
				return $result->attribute;
			}
			else
			{
				return '';
			}
		}
		else
		{
			return '';
		}

	}
}



if ( ! function_exists('upload_file')) {

	function upload_file($param = null){

		$CI =& get_instance();

       

		$config['upload_path'] = '.assets/uploads/';

		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|csv|jpeg|pdf|doc|docx';

		$config['max_size']	= 1024*2;

		$config['image_resize']= FALSE;

		$config['resize_width']= 126;

		$config['resize_height']= 126;

		$config['min_width']= 0;

		$config['min_height']= 0;

		$config['maintain_ratio'] = TRUE;
		

		if ($param){

            $config = $param + $config;

        }

		$CI->load->library('upload', $config);

		if(!empty( $config['file_name']))

			$file_Status = $CI->upload->do_upload($config['file_name']);

		else

			$file_Status = $CI->upload->do_upload();

		if (!$file_Status){

			return array('STATUS'=>FALSE,'FILE_ERROR' => $CI->upload->display_errors());

		}else{

			$uplaod_data=$CI->upload->data();



			$upload_file = explode('.', $uplaod_data['file_name']);



			if($config['image_resize'] && in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){

				$param2=array(

					'source_image' 	=>	$config['source_image'].$uplaod_data['file_name'],

					'new_image' 	=>	$config['new_image'].$uplaod_data['file_name'],

					'create_thumb' 	=>	FALSE,

					'maintain_ratio'=>	$config['maintain_ratio'],

					'width' 		=>	$config['resize_width'],

					'height' 		=>	$config['resize_height'],

					'file_name'		=>  $uplaod_data['file_name'],

					);

				if($config['image_resize'])
                 {
                  create_thumbnail($param2); 
				  //image_resize($param2);
				 }

			}

			return array('STATUS'=>TRUE,'UPLOAD_DATA' =>$uplaod_data );

		}

	}

}


if ( ! function_exists('image_resize')) {

	function image_resize($param = null){

		$CI =& get_instance();

		$config['image_library'] = 'gd2';

		$config['source_image']	= '.assets/uploads/';

		$config['new_image']	= '.assets/uploads/';

		$config['create_thumb'] = FALSE;

		$config['maintain_ratio'] = FALSE;

		$config['width']	 = 150;

		$config['height']	= 150;



		 if ($param) {

            $config = $param + $config;

        }

		$CI->load->library('image_lib', $config);

		if ( ! $CI->image_lib->resize())

		{

		   //return array('STATUS'=>TRUE,'MESSAGE'=>$CI->image_lib->display_errors());

			die($CI->image_lib->display_errors());

		}else{

			 return array('STATUS'=>TRUE,'MESSAGE'=>'Image resized.');

		}

	}

}



if ( ! function_exists('file_delete')) {

	function file_delete($param = null){

		$config['file_path']	= './assets/uploads/';

		$config['file_thumb_path']	= './assets/uploads/';



		if ($param){

            $config = $param + $config;

        }

        //print_r($config); die;

        if(file_exists($config['file_path'])){

				unlink($config['file_path']);

		}

		if(file_exists($config['file_thumb_path'])){

				unlink($config['file_thumb_path']);

		}

	}

}




if ( ! function_exists('create_thumbnail')) {

	function create_thumbnail($config_img='') {

		$CI =& get_instance();

		$config_image['image_library'] = 'gd2';

		$config_image['source_image'] = $config_img['source_image'];

		//$config_image['create_thumb'] = TRUE;

		$config_image['new_image'] = $config_img['new_image'];

		$config_image['maintain_ratio'] = $config_img['maintain_ratio']; 

		$config_image['height']=$config_img['height'];

		$config_image['width']=$config_img['width'];

		list($width, $height, $type, $attr) = getimagesize($config_img['source_image']);

        if ($width < $height && $config_image['maintain_ratio']) {

        	$cal=$width/$height;

        	$config_image['width']=$config_img['width']*$cal;

        }

		if ($height < $width && $config_image['maintain_ratio'])

		{

			$cal=$height/$width;

	    	$config_image['height']=$config_img['height']*$cal;

		}



		$CI->load->library('image_lib', $config_image);

		if(!$CI->image_lib->resize())

			return array('status'=>FALSE,'error_msg'=>$CI->image_lib->display_errors());

		else

			return array('status'=>TRUE,'file_name'=>$config_img['file_name']);

	}

}


function msg_alert_frontend()
{
$CI = & get_instance();
?>
<?php if ($CI->session->flashdata('msg_success')): ?>
    <div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-check-circle"></i>
        <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('msg_success'); ?>
    </div>
<?php endif; ?>
<?php if ($CI->session->flashdata('msg_info')): ?>
    <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="fa fa-info-circle"></i>
        <!-- <strong>Info :</strong> <br> --> <?php echo $CI->session->flashdata('msg_info'); ?>
    </div>
<?php endif; ?>
<?php if ($CI->session->flashdata('msg_warning')): ?>

    <div class="alert alert-warning fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <!--  <strong>Warning :</strong> <br> --> <?php echo $CI->session->flashdata('msg_warning'); ?>
    </div>
<?php endif; ?>
<?php if ($CI->session->flashdata('msg_error')): ?>
    <div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-times-circle-o"></i>
        <!-- <strong>Error :</strong> <br> --> <?php echo $CI->session->flashdata('msg_error'); ?>
    </div>
<?php endif; ?>
<?php
}

function msg_alert_backend()
{
$CI = & get_instance();
?>
<?php if ($CI->session->flashdata('msg_success')): ?>

    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    	<i class="fa fa-check-circle"></i>
        <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('msg_success'); ?>
    </div>
<?php endif; ?>
<?php if ($CI->session->flashdata('msg_info')): ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-info-circle"></i>
        <!-- <strong>Info :</strong> <br> --> <?php echo $CI->session->flashdata('msg_info'); ?>
    </div>

<?php endif; ?>
<?php if ($CI->session->flashdata('msg_warning')): ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-exclamation-triangle"></i>
        <!--  <strong>Warning :</strong> <br> --> <?php echo $CI->session->flashdata('msg_warning'); ?>
    </div>
<?php endif; ?>
<?php if ($CI->session->flashdata('msg_error')): ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-times-circle-o"></i>
        <!-- <strong>Error :</strong> <br> --> <?php echo $CI->session->flashdata('msg_error'); ?>
    </div>
<?php endif; ?>
<?php
}


if ( ! function_exists('backend_pagination')) {

	function backend_pagination(){

		$data = array();

		$data['full_tag_open'] = '<ul class="pagination">';

		$data['full_tag_close'] = '</ul>';

		$data['first_tag_open'] = '<li>';

		$data['first_tag_close'] = '</li>';

		$data['num_tag_open'] = '<li>';

		$data['num_tag_close'] = '</li>';

		$data['last_tag_open'] = '<li>';

		$data['last_tag_close'] = '</li>';

		$data['next_tag_open'] = '<li>';

		$data['next_tag_close'] = '</li>';

		$data['prev_tag_open'] = '<li>';

		$data['prev_tag_close'] = '</li>';

		$data['cur_tag_open'] = '<li class="active"><a href="#">';

		$data['cur_tag_close'] = '</a></li>';

		return $data;

	}

}


if ( ! function_exists('frontend_pagination')) {

	function frontend_pagination(){

		$data = array();

		$data['full_tag_open'] = '<ul class="pagination">';

		$data['full_tag_close'] = '</ul>';

		$data['first_tag_open'] = '<li>';

		$data['first_tag_close'] = '</li>';

		$data['num_tag_open'] = '<li>';

		$data['num_tag_close'] = '</li>';

		$data['last_tag_open'] = '<li>';

		$data['last_tag_close'] = '</li>';

		$data['next_tag_open'] = '<li>';

		$data['next_tag_close'] = '</li>';

		$data['prev_tag_open'] = '<li>';

		$data['prev_tag_close'] = '</li>';

		$data['cur_tag_open'] = '<li class="active"><a href="#">';

		$data['cur_tag_close'] = '</a></li>';

		return $data;

	}

}


if ( ! function_exists('faq_types')) {

	function faq_types(){

		return array('1'=>'Wearing Lashes','2'=>'Learning Lashes','3'=>'Purchasing Lashes','4'=>'Other');

	}
}

/*if ( ! function_exists('blog_types')) {

	function blog_types(){

		return array(
					'facebook'=>'Facebook',
					'twitter'=>'Twitter',
					'pinterest'=>'Pinterest',
					'instagram'=>'instagram',
					'u'=>'Event',
					'star'=>'News',
					);
	}
}*/

if ( ! function_exists('blog_image_sizes')) {

	function blog_image_sizes(){

		return array(
					'cell_1'=>'Square [200 X 200]',
					'cell_2'=>'Square [400 x 400]',
					'cell_3'=>'Rectangle [400 x 200]',
					'cell_4'=>'Rectangle [200 x 400]',
					);
	}
}

//change on 29-02-16
if (!function_exists('variation_list_array')) {

	function variation_list_array($productid=0,$attribute='')
	{
		//die();
		if(empty($productid) || empty($attribute)) 
		return FALSE;

		$result1 = array();
		$result2 = array();
		
		$CI =& get_instance();

		$product_attribute_details = $CI->Common_model->get_result('product_attribute_details',array('product_id'=>$productid,'attribute_key'=>$attribute,'attribute_value !='=>'','variation_key !='=>'','status'=>1));

		if($product_attribute_details)
		{
			$first_attribute_options = array();
			foreach($product_attribute_details as $act_attr_row) 
			{
				$act_attr_row = json_decode($act_attr_row->variation_key);
				$first_attribute_options[] = $act_attr_row[0];

			}
			$attribute = json_decode($attribute);
			$attribute_count = count($attribute);

			//$variation_list = $CI->Common_model->get_in_array('product_configure_terms','attribute_id',array(4),array('status'=>1));

			$variation_list = $CI->Common_model->get_in_array('product_configure_terms','id',$first_attribute_options,array('status'=>1));

			if(!$variation_list) $variation_list = array();

			$attribute_list = $CI->Common_model->get_in_array('product_attributes','id',$attribute,array('status'=>1));
		
			if(!$attribute_list)
			{
				$attribute_list = array();
				$variation_list = array();
			}

			if($attribute_count == count($attribute_list))
			{
				for ($i=0; $i < $attribute_count; $i++) 
				{ 					
					$str = array();
					foreach ($variation_list as $row) 
					{
						if($row->attribute_id == $attribute[$i] )
						{
						 	$str[] = $row;
						}
					}
					$result1[$attribute[$i]] = $str;
					
					$find = 0;
					foreach ($attribute_list as $row) 
					{
						if($row->id == $attribute[$i])
						{
							$result2[$attribute[$i]] = $row;
							$find =1;
							break;
						}
						
						/*if(isset($attribute_list[$i]))
						{
						 $result2[$attribute[$i]] = $attribute_list[$i];
						}
						else
						{
						 $result2[$attribute[$i]] = array();
						}*/
					}
					if(!$find)
					{
						$result2[$attribute[$i]] = array();
					}

					
				}
			}
			//die();
			$result[] = $result1;
			$result[] = $result2;
			return $result;
		}
		else
		{
			return FALSE;
		}
	}
}

if (!function_exists('popular_products')) {
	function popular_products()
	{
			$CI = & get_instance();
			$CI->load->model('products_model');
			$result = $CI->products_model->product_list_fix_category('popular',4);
			return $result;

	}
}

if ( ! function_exists('recent_products')) {
	function recent_products()
	{
			$CI = & get_instance();
			$CI->load->model('products_model');
			$result = $CI->products_model->product_list_fix_category('recent',4);
			return $result;
	}
}

if ( ! function_exists('products_category')) {

	function products_category()
	{
			$CI = & get_instance();
			$result = $CI->Common_model->get_result('product_category',array('status'=>1));
			return $result;
	}
}

if ( ! function_exists('membership_category')) {

	function membership_category()
	{
			$CI = & get_instance();
			$result = $CI->Common_model->get_result('plans',array('status'=>1));
			return $result;
	}
}

if ( ! function_exists('service_category')) {

	function service_category()
	{
			$CI = & get_instance();
			$result = $CI->Common_model->get_result('posts',array('status'=>1,'post_type'=>'services'));
			return $result;
	}
}

if (!function_exists('get_option')) {

	function get_option($id=0)
	{
		$CI = & get_instance();
		$result = $CI->Common_model->get_row('options',array('id'=>$id));
		if($result)
		{
			if(empty($result->option_value) || $result->option_value == "#" )
			{
				return FALSE;
			}
			else
			{
				return $result->option_value;
			}
		}
		else
		{
			return FALSE;
		}
	}
}

if (!function_exists('get_row')) {

	function get_row($table=0,$id = array())
	{
		if(empty($table) || empty($id))
		{
			return FALSE;
		}
		else
		{
		 $CI = & get_instance();
		 return $CI->Common_model->get_row($table,$id);
		}
	}
}

if (!function_exists('get_aus_states')) {

	function get_aus_states()
	{
		 $CI = & get_instance();
		 return $CI->Common_model->get_aus_state();
	}
}

if (!function_exists('get_aus_cities')) {

	function get_aus_cities($state='')
	{
		 $CI = & get_instance();
		 return $CI->Common_model->get_result('australia_cities',array('state_code'=>$state));
	}
}

if (!function_exists('get_services_list')) {

	function get_services_list($id='')
	{
		$CI = & get_instance();
		 /*$services_list = array(
		 						'1'=>array('name'=>'Spray tan','price'=>1),
		 						'2'=>array('name'=>'Waxing','price'=>2),
		 						'3'=>array('name'=>'Eye brows','price'=>3),
		 						'4'=>array('name'=>'Eye - Lashes - 3D','price'=>4),
		 						'5'=>array('name'=>'Eye - Lashes - Classic','price'=>5),
		 						'6'=>array('name'=>'Eye - Lashes - Re-fill - 1week - 3D','price'=>6),
		 						'7'=>array('name'=>'Eye - Lashes - Re-fill - 1week - Classic','price'=>7),
		 						'8'=>array('name'=>'Eye - Lashes - Re-fill - 2week - 3D','price'=>8),
		 						'9'=>array('name'=>'Eye - Lashes - Re-fill - 2week - Classic','price'=>9),
		 					   '10'=>array('name'=>'Eye - Lashes - Re-fill - 3week - 3D','price'=>10),
		 					   '11'=>array('name'=>'Eye - Lashes - Re-fill - 3week - Classic','price'=>11),
		 					   '12'=>array('name'=>'Eye - Lashes - Re-fill - 4week - 3D','price'=>12),
		 					   '13'=>array('name'=>'Eye - Lashes - Re-fill - 4week - Classic','price'=>13),
		 					   '14'=>array('name'=>'Hair extensions','price'=>14)
		 						);*/
		$services_list = $CI->Common_model->get_result('services_pricing');
		if(!empty($id))
		{
			if(isset($services_list[$id]))
				{
					return $services_list[$id];
				}
		}
		else
		{
			return $services_list;
		}
	}
}

if (!function_exists('get_services_time_name')) {

	function get_services_time_name($time='')
	{
		 $CI = & get_instance();
		 return $CI->Common_model->get_row('services_timing',array('id'=>$time));
	}
}

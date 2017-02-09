<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{

            parent::__construct();

            $this->load->model('products_model'); 
            $this->load->model('discount_model'); 
            // If session cart purchase_type == product
            if($this->session->userdata('purchase_type'))
            {
            	$purchase_type = $this->session->userdata('purchase_type');

            	if(!$this->cart->contents())
            	{            		
            		if($purchase_type != 'product')
            		{
	   			    	$this->session->set_userdata('purchase_type','product');
	   			    }

            	}
            }
            else
            {
            	$this->session->set_userdata('purchase_type','product');
            }      
    }

    public function memberShipPoPupMessage($plan_id,$planStartDate,$planEndDate,$cartCount)
    {
    	$msg = 0;
    	$current_date   = date('Y-m-d');
    	//return strtotime($current_date).", end = ".strtotime($planEndDate).", start = ".strtotime($planStartDate);
		if( (strtotime($current_date)<=strtotime($planEndDate))&&(strtotime($current_date )>=strtotime($planStartDate))&&($cartCount > 1)
		  )
		{
			//buy2=get1halfprice
			if($cartCount == 2 && $plan_id > 0){
				$msg = "Add 1 more product and get 1 in half price.";
			}

			//buy3=get1FREE
			if($cartCount == 3 && $plan_id > 1){
				$msg = "Add 1 more product and get 1 in zero price.";

			}

			//buy5=get2FREE
			if($cartCount == 5 && $plan_id > 2){
				
				$msg = "Add 2 more product and get 2 in zero price.";

			}

			//buy10=get5FREE	
			if($cartCount == 10 && $plan_id > 3){
				$msg = "Add 5 more product and get 5 in zero price.";
			}
		}
    	return $msg;
    }

     //display all cart product
	public function index()
	{

		if($this->session->userdata('purchase_type')=='product')
		{
			$data['total']	= $this->cart->total();
			/*member ship message*/
				$membership_detail	= $this->discount_model->get_user_plan_details(user_id());
				if($membership_detail){
					$plan_id 		= $membership_detail->plan_id;
					$planStartDate	= $membership_detail->start_date;
					$planEndDate	= $membership_detail->end_date;
					$cartCount 		= $this->cart->total_items();

					$data['poPupMsg'] = $this->memberShipPoPupMessage($plan_id,$planStartDate,$planEndDate,$cartCount);
				}
			/* #member ship message*/
			//$data['gst']	  			= 0;
			/*$data['shipping'] 			= 0 ;
			$data['coupon_discount']	= 0 ;*/
		}
		else if($this->session->userdata('purchase_type')=='services')
		{
			$data['total']	= $this->cart->total();
			//$data['gst']	= 1;
		}
		else if($this->session->userdata('purchase_type')=='training')
		{
			$data['total']	= $this->cart->total();
			//$data['gst']	= 1;
		}
		else
		{
			$data['total']=0;
			//$data['gst']=0;
		}


		$data['template'] = 'frontend/cart/index';
		$this->load->view('templates/frontend/layout', $data);
	}

	// add product in cart by link
	public function add($slug)
	{
		if($this->session->userdata('purchase_type')=='services')
		{
			$this->session->set_flashdata('msg_info','Please empty cart to buy products. <a href="'.base_url('cart').'" class="form_carot">Cart</a>');
            if(isset($_SERVER['HTTP_REFERER'])) 
            {
			    redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect('product');
			}
		}

		else if($this->session->userdata('purchase_type')=='training')
		{
			$this->session->set_flashdata('msg_info','Please empty cart to buy products. <a href="'.base_url('cart').'" class="form_carot">Cart</a>');
			if(isset($_SERVER['HTTP_REFERER'])) 
            {
			    redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect('product');
			}
		}
		else if(!user_logged_in())
		{
			$this->session->set_flashdata('msg_info','Please login or sign-up to buy products. <a href="'.base_url('website/login/'.base64_encode('product_page')).'" class="form_carot">Login</a>');
            if(isset($_SERVER['HTTP_REFERER'])) 
            {
			    redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect('product');
			}
		}

		$detail = $this->products_model->single_product_by_slug($slug);

		if(!$detail) 
		{
			$this->session->set_flashdata('msg_info', 'Please try again.');
			if(isset($_SERVER['HTTP_REFERER'])) {
			    redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect('product');
			}
		}
		if($detail->type != 'Simple')
		{
			$this->session->set_flashdata('msg_info', 'Please select product variation to add in cart.');
			redirect('product/view/'.$detail->slug);
		}
		else
		{
				if(!empty($detail->active_image) && file_exists('./assets/uploads/product/thumb/'.$detail->active_image))
		        {
		            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$detail->active_image;
		        }
		        else if(!empty($detail->first_image) && file_exists('./assets/uploads/product/thumb/'.$detail->first_image))
		        {
		            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$detail->first_image;
		        }
		        else
		        {
		            $image = FRONTEND_THEME_URL_NEW.'images/product_1.png';
		        }

		        		$data = array(
						        'id'      => $detail->id,
						        'qty'     => 1,
						        'price'   => $detail->price,
						        'name'    => $detail->title,
						        'type'	  => $detail->type,
						        'image'	  => $image
								);
		        		$this->cart->product_name_rules = '[:print:]';
				 		$this->cart->insert($data);
				 		$this->session->set_flashdata('msg_success', 'Product added successfully in your cart.');
				redirect('cart');
		}

		redirect('cart');
	}

	// add product in cart by detail page
	public function add_to_cart()
	{
		if($this->session->userdata('purchase_type')=='services')
		{
            $result = array('status'=>0,'message'=>'<div class="alert alert-info">Please empty cart to buy products. <a href="'.base_url('cart').'" class="form_carot">Cart</a></div>');
            header('Content-Type: application/json');
            echo json_encode($result);
		}
		else if(!user_logged_in())
		{
			$result = array('status'=>0,'message'=>'<div class="alert alert-info">Please login or sign-up to buy products. <a href="'.base_url('website/login/'.base64_encode("product_details_".$_POST['id'])).'" class="form_carot">Login</a></div>');
            header('Content-Type: application/json');
            echo json_encode($result);
		}
		else
		{
				//simple
				//id:product_id,type:type,price:price,quantity:quantity 


				//variation
				//id:product_id,type:type,price:price,quantity:quantity,variation:variation

				$product_id = $_POST['id'];
				$type		= $_POST['type'];
				$price	 	= $_POST['price'];
				$quantity	= $_POST['quantity'];
				$detail = $this->products_model->single_product($product_id);

				if(!$detail)
				{
					$result = array('status'=>0,'message'=>'Please try again.');
		            header('Content-Type: application/json');
		            echo json_encode($result);
				}
				else
				{
					if(!empty($detail->active_image) && file_exists('./assets/uploads/product/thumb/'.$detail->active_image))
			        {
			            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$detail->active_image;
			        }
			        else if(!empty($detail->first_image) && file_exists('./assets/uploads/product/thumb/'.$detail->first_image))
			        {
			            $image = BACKEND_THEME_URL.'assets/uploads/product/thumb/'.$detail->first_image;
			        }
			        else
			        {
			            $image = FRONTEND_THEME_URL_NEW.'images/product_1.png';
			        }

					if($type == 'Simple')
					{
				 		$data = array(
							        'id'      => $product_id,
							        'qty'     => $quantity,
							        'price'   => $price,
							        'name'    => $detail->title,
							        'type'	  => $type,
							        'image'	  => $image
									);

				 		//print_r($data);
				 		$this->cart->product_name_rules = '[:print:]';
				 		$this->cart->insert($data);
				 		$this->session->set_flashdata('msg_success', 'Product added successfully in your cart.');

				 		$result = array('status'=>1);
			            header('Content-Type: application/json');
			            echo json_encode($result);

					}
					else
					{
						$variation 			= $_POST['variation'];
						$variation_length	= $_POST['variation_length'];
						$data = array(
										'id'      	=> $product_id.'_'.$variation,
										'qty'     	=> $quantity,
										'price'   	=> $price,
										'name'    	=> $detail->title,
										'type'	  	=> $type,
									'variation_id'	=> $variation,
								'variation_length'	=> $variation_length,
								'variation_detail' 	=> $this->products_model->product_attribute_details($variation),
										'image'	  	=> $image
									);
						$this->cart->product_name_rules = '[:print:]';
						$this->cart->insert($data);
						$this->session->set_flashdata('msg_success', 'Product added successfully in your cart.');
						$result = array('status'=>1);
			            header('Content-Type: application/json');
			            echo json_encode($result);
					}
				}

			//redirect('cart');
		}
	}

	//update quantity of product
    public function update()
	{
	   $i=0;
	    foreach ($this->cart->contents() as $items)
	    {$i++;
	    	$data = array(
				        'rowid' => $this->input->post($i.'[rowid]'),
				        'qty'   => $this->input->post($i.'[qty]')
						);
	    	$this->cart->update($data);

	    }
	    $this->session->set_flashdata('msg_success', 'Cart updated successfully.');
		redirect('cart');
	}

	//remove product from cart
	public function remove($rowid)
	{
		$this->cart->remove($rowid);
		$this->session->set_flashdata('msg_success', 'Product successfully removed from your cart.');
		redirect('cart');
	}
	//destroy cart
	public function empty_cart()
	{
		$this->cart->destroy();
		$this->session->set_flashdata('msg_success', 'Your cart is empty please select products.');
		redirect('cart');
		/*<a href="'.base_url('product').'">Cleck here..</a>*/
	}

	public function checkout()
	{
		if(!user_logged_in())
		{
			redirect('website/login');
		}
		if(!$this->cart->contents()) redirect('product');

		if($this->session->userdata('purchase_type'))
		{
			if($this->session->userdata('purchase_type') != 'product') redirect('product');
		}
		else
		{
			redirect('product');	
		}
		$data['user_detail'] = $this->Common_model->get_row('users',array('id'=>user_id()));

		if($this->form_validation->run('update_detail_at_buying')==FALSE)
		{
			$this->form_validation->set_error_delimiters('<div class="form_carot">','</div>'); 
			//$this->session->set_flashdata('msg_info','All feilds are mandatory.');
		}
		else
		{
			$detail_array = array(
		              'first_name' => $this->input->post('first_name'),
		              'last_name'=> $this->input->post('last_name'),
		              'address'=> $this->input->post('address'),
		              'city'=> $this->input->post('city'),
		              'state'=> $this->input->post('state'),
		              'zip'=> $this->input->post('zip'),
		              //'county'=> $this->input->post('county'),
		              'mobile'=> $this->input->post('mobile'),
		              'shipping'=> $this->input->post('shipping'),
		              's_first_name'=> $this->input->post('s_first_name'),
		              's_last_name'=> $this->input->post('s_last_name'),
		              's_email'=> $this->input->post('s_email'),
		              's_address'=> $this->input->post('s_address'),
		              's_city'=> $this->input->post('s_city'),
		              's_state'=> $this->input->post('s_state'),
		              's_zip'=> $this->input->post('s_zip'),
		              //'s_county'=> $this->input->post('s_county'),
		              's_mobile'=> $this->input->post('s_mobile'),
		            );
		    $this->Common_model->update('users',$detail_array,array('id'=>user_id()));
			//$this->session->set_flashdata('msg_success', 'Your address detail changed successfully.');
			redirect('cart/distributor');
		}
		
		$data['template'] = 'frontend/cart/checkout';
		$this->load->view('templates/frontend/layout', $data);
	}

	public function order_detail()
	{

	}

	public function payment()
	{
		//print_r($_SERVER);die;
		if(!user_logged_in())
		{
		  redirect('website/login');
		}
		if($_SERVER['REQUEST_METHOD']!='POST') 
		{
			redirect('cart');
		}
		else
		{
			if(isset($_POST['distributor_id'])&&!empty($_POST['distributor_id'])){
				$distributor_id = $this->input->post('distributor_id');
				$distributor_detail = $this->Common_model->get_row('users',array('id'=>$distributor_id));
				$user_detail = $this->Common_model->get_row('users',array('id'=>user_id()));
				if(!$distributor_detail) redirect('cart');

				if($distributor_id==1) 
					{
						$distributor_detail->title = 'Lash U Lashes';
						$distributor_detail->email = SUPERADMIN_EMAIL;
					}
				if(empty($distributor_detail->title)) $distributor_detail->title = '';
					
				/* Start save detail on session to access at payment function */
		
				$checkout_detail = array(
									'distributor_id'   => $distributor_id,
									'distributor_name' => $distributor_detail->title,
									'distributor_email'=> $distributor_detail->email,
									'distributor_state'=> $distributor_detail->state,
									'user_s_state'     => $user_detail->s_state,
									);
					
				$this->session->set_userdata('checkout_detail', $checkout_detail);
				/* #Start save detail on session to access at payment function */
			}
		
		}

		if($this->session->userdata('purchase_type') != 'product') 
			redirect('product');

		if(!$this->cart->contents()) redirect('product');


		$data['total'] = $this->cart->total();

		$checkout_detail = $this->session->userdata('checkout_detail');

		/*shipping calculation strart*/
			/*if(isset($distributor_detail)&&($distributor_detail->state == $user_detail->s_state)){
				$shipping_charges_id = 15;
			}else{
				$shipping_charges_id = 16;
			}*///cumment by neo

		if($checkout_detail['distributor_state'] == $checkout_detail['user_s_state']){
			$shipping_charges_id = 15;
		}else{
			$shipping_charges_id = 16;
		}

		$shipping = $this->Common_model->get_row('options',array('id'=>$shipping_charges_id));
		if($shipping)
		{
			if(!empty($shipping->option_value))
			{
				$data['shipping'] 	= $shipping->option_value;
			}
			else
			{
				$data['shipping'] 	= 0;
			}
		}
		else
		{
			$data['shipping'] 	    = 0;
		}
		/*shipping calculation end*/

		

		$discount_data = $this->calculate_discount();

		$data['discount_type']	= $discount_data['discount_type'];
		
		
		$checkout_detail['discount_type'] = $discount_data['discount_type'];
		$checkout_detail['discount_str'] = $discount_data['discount_str'];
		if($discount_data['discount_type'] == 1){
			$data['membership_discount']	= $discount_data['discount'];
		}else{
			$data['coupon_discount']	= $discount_data['discount'];
		}	
		$checkout_detail['discount'] = $discount_data['discount'];
		$this->session->set_userdata('checkout_detail', $checkout_detail);
		

		$data['gst'] = $data['shipping']+($data['total'] - $discount_data['discount']);

		$gst = $this->Common_model->get_row('options',array('id'=>14));

		if($gst)
		{
			if(!empty($gst->option_value))
			{
				$gst = $gst->option_value;
			}
			else
			{
				$gst = 0;
			}
		}
		else
		{
			$gst = 0;
		}

		$data['gst'] = ($data['gst']*$gst)/100;
		$data['promocode_message'] = $discount_data['promocode_message'];
		$data['template'] 			= 'frontend/cart/payment';
		$this->load->view('templates/frontend/layout', $data);
	}


	function calculate_discount(){
		$membership_detail	= $this->discount_model->get_user_plan_details(user_id());
		$discount = 0;
		$discount_type = 1;
		$discount_str = '';
		if($membership_detail){
			$current_date   = date('Y-m-d');
			if(((strtotime($current_date )<=strtotime($membership_detail->end_date))&&(strtotime($current_date )>=strtotime($membership_detail->start_date)))&&($this->cart->total_items()>=3)){
				$discount 	= $this->calculate_membership_discount();
				$discount_str = $membership_detail->plan_name;
	    	}else{
	    		$discount_type = 2;
	    	}	
		}else{
			$discount_type = 2;
		}
    
		$invalid_message = "";
		$error = 0;
		if($discount_type == 2){
			if(isset($_POST['promocode'])&&!empty($_POST['promocode'])){
				$promocodeData	= $this->Common_model->get_row('promo_code',array('code'=>trim($_POST['promocode']),'status'=>1));
				
				$current_date = date('Y-m-d');
				if(!empty($promocodeData)){
					if(!((strtotime($current_date )<=strtotime($promocodeData->end_date))&&(strtotime($current_date )>=strtotime($promocodeData->start_date)))){
						$invalid_message = "Invalid Promocode!";
						$error++;
					}else{
						$appliedOn = json_decode($promocodeData->applied_on);
						if(in_array(1, $appliedOn)){
							$totalAmt	= $this->cart->total();
							if($promocodeData->min_amount <= $totalAmt){
								if($promocodeData->discount_type == 1){
									$discount	= $promocodeData->discount;
								}else if($promocodeData->discount_type == 2){
									$discount	= $totalAmt*($promocodeData->discount/100);
								}
								$discount_str = trim($_POST['promocode']);
							}else{
								$invalid_message = "Invalid Promocode! Minimum Cart total should be $".$promocodeData->min_amount.".";
								$error++;
							}
						}else{
							$invalid_message = "Invalid Promocode!";
							$error++;
						}
					}
				}else{
					$invalid_message = "Invalid Promocode!";
					$error++;
				}
				
			}
		}
		return array('discount_type' => $discount_type,'discount' => $discount,'promocode_message' => $invalid_message,'discount_str'=> $discount_str);
	}

	function calculate_membership_discount($flag=0){
		$total_with_discount = 0;
		$membership_detail	= $this->discount_model->get_user_plan_details(user_id());
		if($membership_detail)
		{
			$plan_id	= $membership_detail->plan_id; 
			if(isset($plan_id)&&!empty($plan_id)){
				$current_date   = date('Y-m-d');
		        if(((strtotime($current_date )<=strtotime($membership_detail->end_date))&&(strtotime($current_date )>=strtotime($membership_detail->start_date)))){
		          
		        	$plan_discount_on_item	= array(1 => 3,
		            								2 => 4,
		            								3 => 7,
		            								4 => 15);
		            $priceList = array();
		            $productIdList = array();
		            $discount_amount = Array();
					if($this->cart->total_items()>0){
						$cartItem	= $this->cart->contents();
						foreach($cartItem as $item){
							for($i=0;$i<$item['qty'];$i++){
								$priceList[$item['id'].'_'.$i]	= $item['price'];
								$productIdList[$item['id'].'_'.$i] = $item['id'];
								if (!array_key_exists($item['id'], $discount_amount)) {
								    $discount_amount[$item['id']] = 0;
								}
							}
						}
					}
					arsort($priceList);
					arsort($productIdList);
		           	$packageSize	= $plan_discount_on_item[$plan_id];
		            $packects	= ceil(count($priceList)/$packageSize);
		            $this->session->set_userdata('discount_amount_array',$discount_amount);
		           	$total_with_discount = $this->price_calculation($priceList,$plan_discount_on_item[$plan_id],$plan_id,$productIdList);
		           	$cartTotal = $this->cart->total();
		           	$total_with_discount = $cartTotal-$total_with_discount;
		            $discount_amount = $this->session->userdata('discount_amount_array');
		        }
			}
		}
        if($flag==1){
        	return array("plan_name" => $membership_detail->plan_name,"discount" => $total_with_discount);
        }else{
        	return  $total_with_discount;
        }
        
	}


	function price_calculation($price_array,$packSize,$plan_id,$productIdList,$recursiveFlag=0){
		$discount = 0;
		$discount_amount = $this->session->userdata('discount_amount_array');
		if(count($productIdList)<$packSize){
			if($plan_id == 1 && count($productIdList)<3){
				foreach($price_array as $key=>$val){
					$discount += $val;
				}
			}else {
				if(count($productIdList)<4){
					$plan_id = 1;
					$packSize = 3;
				}else if(count($productIdList)<7){
					$plan_id = 2;
					$packSize = 4;
				}else if(count($productIdList)<15){
					$plan_id = 3;
					$packSize = 7;
				}
				$returnDiscount = $this->price_calculation($price_array,$packSize,$plan_id,$productIdList,1);
				$discount += $returnDiscount['discount'];
				if(!empty($returnDiscount['discount_amount_array'])){
					foreach ($returnDiscount['discount_amount_array'] as $key => $value) {
						$discount_amount[$key] += $value;
					}
				}
			}
		}else{
			$packects	= ceil(count($price_array)/$packSize);
			$packectsArr = array();
			$packectsIdsArr = array();
			if($plan_id == 1){
				$size = $packSize-1;
				$remainingSize = 1;
			}else if($plan_id == 2){
				$size = $packSize-1;
				$remainingSize = 1;
			}else if($plan_id == 3){
				$size = $packSize-2;
				$remainingSize = 2;
			}else if($plan_id == 4){
				$size = $packSize-5;
				$remainingSize = 5;
			}

			for($i=0;$i<$packects;$i++){
				arsort($price_array);
				$j=0;
				foreach($price_array as $key=>$val){
					if($j<$size){
						$packectsArr[$i][] = $price_array[$key];
						$packectsIdsArr[$i][] = $productIdList[$key];

						unset($price_array[$key]);
						unset($productIdList[$key]);
					}
					$j++;
				}
				

				asort($price_array);
				$j=0;
				foreach($price_array as $key=>$val){
					if($j<($remainingSize)){
						$packectsArr[$i][] = $price_array[$key];
						$packectsIdsArr[$i][] = $productIdList[$key];
						unset($price_array[$key]);
						unset($productIdList[$key]);
					}
					$j++;
				}
			}
			

			for($i=0;$i<count($packectsArr);$i++){
				if(count($packectsArr[$i])<$packSize){
					if($plan_id == 1 && count($packectsArr[$i])<3){
						for($k=0;$k<count($packectsArr[$i]);$k++){
							$discount += $packectsArr[$i][$k];
						}
					}else {
						if(count($packectsArr[$i])<4){
							$plan_id = 1;
							$packSize = 3;
						}else if(count($packectsArr[$i])<7){
							$plan_id = 2;
							$packSize = 4;
						}else if(count($packectsArr[$i])<15){
							$plan_id = 3;
							$packSize = 7;
						}
						$price_array 	= array();
						$productIdList	= array();
						for($m=0;$m<count($packectsArr[$i]);$m++){
							$price_array[$packectsIdsArr[$i][$m].'_'.$m] = $packectsArr[$i][$m];
							$productIdList[$packectsIdsArr[$i][$m].'_'.$m] = $packectsIdsArr[$i][$m];
						}
						$returnDiscount = $this->price_calculation($price_array,$packSize,$plan_id,$productIdList,1);
						$discount += $returnDiscount['discount'];
						if(!empty($returnDiscount['discount_amount_array'])){
							foreach ($returnDiscount['discount_amount_array'] as $key => $value) {
								$discount_amount[$key] += $value;
							}
						}
					}
				}else{
					for($j=0;$j<count($packectsArr[$i]);$j++){
						if($j<$size){
							$discount += $packectsArr[$i][$j];
						}else if($j < ($size+$remainingSize)){
							if($plan_id == 1){
								$discount += ($packectsArr[$i][$j]/2);
								$discount_amount[$packectsIdsArr[$i][$j]] += ($packectsArr[$i][$j]/2);
							}else{
								$discount_amount[$packectsIdsArr[$i][$j]] += $packectsArr[$i][$j];
							}
						}
					}
				}
				
			}
		}
		$this->session->set_userdata('discount_amount_array', $discount_amount);
		if($recursiveFlag == 1){
			return array("discount" => $discount,"discount_amount_array"=>$discount_amount);
		}else{
			return $discount;
		}
		
	}


	public function distributor()
	{

		if(!user_logged_in())
		{
		  redirect('website/login');
		}
		if($this->session->userdata('purchase_type'))
		{
			if($this->session->userdata('purchase_type') != 'product') redirect('product');
		}
		else
		{
			redirect('product');	
		}

		if(!$this->cart->contents()) redirect('product');

		$data['users'] = $this->Common_model->get_row('users',array('id'=>user_id()));

		$data['distributors'] = $this->Common_model->get_result('users',array('user_role'=>2,'status'=>1),array(),array('title','asc'));

		$cart_product_ids = array();
		$distributors_temp= array();
		foreach($this->cart->contents() as $cart_row)
		{
			if($cart_row['type']=='Simple')
			{
				$cart_product_ids[] = $cart_row['id'];
			}
			else
			{
				$cart_product_ids[] = current(explode('_',$cart_row['id']));
			}
		}

		foreach($data['distributors'] as $distributor_row)
		{
			$flag = 1;
			$my_products = json_decode($distributor_row->my_products);
			if(!is_array($my_products)) $my_products = array();
			foreach ($cart_product_ids as $cart_temp_id)
			{
				if(!in_array($cart_temp_id,$my_products))
				{
					$flag = 0;
					break;
				}
			}
			if($flag)
			{
				$distributors_temp[] = $distributor_row;
			}
		}

		$data['distributors'] = $distributors_temp;

		$distributors_temp = array();

		$shipping_address = $data['users']->s_address.' '.$data['users']->s_city.' '.$data['users']->s_state.' '.$data['users']->s_zip.' australia';
		$shipping_address = str_replace('/','-',$shipping_address);
		$shipping_address = url_title($shipping_address,'dash');

		foreach ($data['distributors'] as $row) 
		{
			$origins_address = $row->address.' '.$row->city.' '.$row->state.' '.$row->zip.' australia';
			$origins_address = str_replace('/','-',$origins_address);
			$origins_address = url_title($origins_address,'dash');


			// echo "Origins = ".$origins_address.'<br>';
			// echo "Destination = ".$shipping_address.'<br>';

			$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origins_address."&destinations=".$shipping_address;
			// echo "Url = '".$url."'<br>";

			$temp_dis = file_get_contents($url);
			$temp_dis = json_decode($temp_dis);
			$temp_dis = $temp_dis->rows[0]->elements[0];
			if($temp_dis->status==='OK')
			{
				$max_distance = $this->Common_model->get_row('options',array('id'=>13));
				if($max_distance)
				{
					if(!empty($max_distance->option_value))
					{
						$max_distance = ($max_distance->option_value)*1000;
						//$max_distance = 100*1000;
					}
					else
					{
						$max_distance = 50*1000;
					}
				}
				else
				{
					$max_distance = 50*1000;
				}

				$distance = $temp_dis->distance->value; //distance in meter
				
				if($max_distance >= $distance)
				{
					$row->max_distance = $distance;
					$distributors_temp[] = $row;
				}
			}
			
		}
		//print_r($distributors_temp);
		$data['distributors'] = $distributors_temp;
		//$data['distributors'] = array();

		$data['total']				= $this->cart->total();
		$data['gst']	  			= 0;
		$data['shipping'] 			= 0;
		$data['coupon_discount']	= 0;
		$data['template'] 			= 'frontend/cart/distributor';
		$this->load->view('templates/frontend/layout', $data);
	}

	public function pay_paypal()
	{
		if(!user_logged_in())
		{
		  redirect('website/login');
		}

		if($this->session->userdata('purchase_type'))
		{
			if($this->session->userdata('purchase_type') != 'product') redirect('product');
		}
		else
		{
			redirect('product');	
		}

		if(!$this->cart->contents()) redirect('product');

		if(!$this->session->userdata('checkout_detail'))
		{
			redirect('cart/distributor');	
		}
		else
		{
			$checkout_detail	= $this->session->userdata('checkout_detail');
			if(!isset($checkout_detail['distributor_id'])) $checkout_detail['distributor_id']=1;	
			if(!isset($checkout_detail['distributor_name'])) $checkout_detail['distributor_name']='Lash U Lashes';
		}


        $this->load->library('paypalfunctions');

        $paymentAmount  = 0;
        $shippingOption = 0;
        $extracharge 	= 0;
        $total		    = $this->cart->total(); // producttotal cart amount
        $total = number_format($total,2,'.', '');
        
        //////////////////////////////////////////////////////////////////////////////////////////////

        /*shipping calculation strart*/
        
		if($checkout_detail['distributor_state'] == $checkout_detail['user_s_state'])
		{
			$shippingOption = 15;			
		}
		else
		{
			$shippingOption = 16;
		}
		
		$shipping = $this->Common_model->get_row('options',array('id'=>$shippingOption));
		if($shipping)
		{
			if(!empty($shipping->option_value))
			{ $extracharge 	= $shipping->option_value; }

		}

		$extracharge = number_format($extracharge,2,'.', '');
			
		/*shipping calculation end*/
		//$extracharge = number_format($extracharge,2);


		/*gst calculation start*/
		$coupon_code   = '';
		$discountData 	   = $this->calculate_membership_discount(1);
		if($discountData['discount']>0){
			$discount      = $discountData['discount'];
			$discount 	   = number_format($discount,2,'.', '');
			$checkout_detail = $this->session->userdata('checkout_detail');
			$checkout_detail['discount_type'] = 1;
			$checkout_detail['discount'] = $discount;
			$coupon_code   = 'Membership - '.$discountData['plan_name'];
			$this->session->set_userdata('checkout_detail', $checkout_detail);
		}else{
			$discount 	   = 0;
			if($checkout_detail['discount_type'] == 2 && $checkout_detail['discount']>0){
				$discount 	   = number_format($checkout_detail['discount'],2,'.', '');
				$coupon_code   = 'Coupon Code - '.$checkout_detail['discount_str'];
			}
			
		}
		$tax  = $extracharge + ($total - $discount);

		$gst = $this->Common_model->get_row('options',array('id'=>14));

		if($gst)
		{
			if(!empty($gst->option_value))
			{ $gst = $gst->option_value; }
			else
			{ $gst = 0; }
		}
		else 
		{ $gst = 0; }

		$tax  = ($tax*$gst)/100;
		//$tax = number_format($tax,2);
		$tax  = number_format($tax, 2, '.', '');
		/*gst calculation start*/

        //////////////////////////////////////////////////////////////////////////////////////////////
        //$extracharge   = 0;	//shipping and other charge
        //$tax 		   = 0; //if not required set 0
        //if not required set -0 , allways negative sign
       

        $items         = array();

        foreach ($this->cart->contents() as $row) 
        {
        	if($row['type']=='Simple')
        	{
        		$items[]       = array('name'=>$row['name'], 'amt' =>$row['price'], 'qty' => $row['qty'],'desc'=>'');
        	}
        	else
        	{
        		$temp = '';
        		$variation_detail_array = json_decode($row['variation_detail']);
                if(count($variation_detail_array[0])== $row['variation_length'] )
                {
                        for ($m=0; $m < $row['variation_length'] ; $m++) 
                        { 
                           $temp .= $variation_detail_array[0][$m][1] .' : ' .$variation_detail_array[1][$m][1].', ';
                        }
                }

        		$items[]    = array('name'=>$row['name'], 'amt' =>$row['price'], 'qty' => $row['qty'],'desc'=>$temp);
        	}
        
        }
        //$items[]       = array('name'=>'test discount', 'amt' =>10, 'qty' => 1,'desc'=>'');

       /* echo '<br/>total>>'.$total;
        echo '<br/>extracharge>>'.$extracharge;
        echo '<br/>tax>>'.$tax;
        echo '<br/>discount>>'.$discount;
		
		*/

        $paymentAmount = $total+$extracharge+$tax;
        $paymentAmount = $paymentAmount - $discount;
        // echo '<br/>paymentAmount>>'.$paymentAmount;die;
        $paymentAmount = number_format($paymentAmount,2, '.', '');
        /*print_r(array('shipping'=> $extracharge, 'tax'=>$tax, 'tax_percent'=>$gst, 'total'=>$total, 'discount'=>$discount*(-1), 'coupon_code'=>$coupon_code, 'grand_total'=>$paymentAmount, 'distributor_id'=>$checkout_detail['distributor_id'], 'distributor_name'=>$checkout_detail['distributor_name'], 'distributor_email'=>$checkout_detail['distributor_email'],'discount_type'=>$checkout_detail['discount_type']));die;*/
        $this->session->set_userdata('payment_data',array('shipping'=> $extracharge, 'tax'=>$tax, 'tax_percent'=>$gst, 'total'=>$total, 'discount'=>$discount*(-1), 'coupon_code'=>$coupon_code, 'grand_total'=>$paymentAmount, 'distributor_id'=>$checkout_detail['distributor_id'], 'distributor_name'=>$checkout_detail['distributor_name'], 'distributor_email'=>$checkout_detail['distributor_email'],'discount_type'=>$checkout_detail['discount_type']));

        $_SESSION["Payment_Amount"] = $paymentAmount;
        $currencyCodeType = "USD";
        $paymentType = "Sale";
                //'------------------------------------            
        $returnURL = product_returnURL;
                //'------------------------------------
        $cancelURL = product_cancelURL;

       

        $resArray = $this->paypalfunctions->CallShortcutExpressCheckoutWithDiss_tax( $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL, $items, $extracharge, $tax, $discount*(-1) );
            // print_r($resArray);

        if(isset($resArray["ACK"]))
        {
        	$ack = strtoupper($resArray["ACK"]);
            if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
                {
                    //$this->session->set_userdata('plan_slug',$data['detail']->title_slug);
                    $this->paypalfunctions->RedirectToPayPal( $resArray["TOKEN"] );
                } 
            else{

            	 //$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                // $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
                 $this->session->set_flashdata('msg_error',$resArray["L_LONGMESSAGE0"]);
                 //$this->session->set_flashdata('msg_error',$ErrorLongMsg.'-');
                 redirect('cart');
                 //echo $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
               }
        }
        else  
        {
        		/*$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"].'-2');
				$this->session->set_flashdata('msg_error',$ErrorLongMsg);*/

                //$this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
                $this->session->set_flashdata('msg_error',$resArray["L_LONGMESSAGE0"]);

                redirect('cart');
        }
	}

	public function confirm()
	{	
		$this->load->library('paypalfunctions');
		//$plan_slug = $this->session->userdata('plan_slug');
		$PaymentOption = "PayPal";
		if ($PaymentOption == "PayPal")
		{           
		  
			$finalPaymentAmount =  $_SESSION["Payment_Amount"];

			$resArray = $this->paypalfunctions->ConfirmPayment($finalPaymentAmount);
			//print_r($resArray);die;
			$ack = strtoupper($resArray["ACK"]);
			if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" )
			{
			  $transactionId      = $resArray["PAYMENTINFO_0_TRANSACTIONID"]; 
			  // ' Unique transaction ID of the payment. Note:  If the PaymentAction of the request was Authorization or Order, this value is your AuthorizationID for use with the Authorization & Capture APIs. 
			  $transactionType    = $resArray["PAYMENTINFO_0_TRANSACTIONTYPE"]; 
			  //' The type of transaction Possible values: l  cart l  express-checkout 
			  $paymentType        = $resArray["PAYMENTINFO_0_PAYMENTTYPE"];  
			  //' Indicates whether the payment is instant or delayed. Possible values: l  none l  echeck l  instant 
			  $orderTime          = $resArray["PAYMENTINFO_0_ORDERTIME"];  
			  //' Time/date stamp of payment
			  $amt                = $resArray["PAYMENTINFO_0_AMT"];  
			  //' The final amount charged, including any shipping and taxes from your Merchant Profile.
			  $currencyCode       = $resArray["PAYMENTINFO_0_CURRENCYCODE"];  
			  //' A three-character currency code for one of the currencies listed in PayPay-Supported Transactional Currencies. Default: USD. 
			  $feeAmt             = $resArray["PAYMENTINFO_0_FEEAMT"]; 
			  //' PayPal fee amount charged for the transaction
			  // $settleAmt          = $resArray["PAYMENTINFO_0_SETTLEAMT"]; 
			  //' Amount deposited in your PayPal account after a currency conversion.
			  $taxAmt             = $resArray["PAYMENTINFO_0_TAXAMT"];  
			  
			  $paymentStatus  = $resArray["PAYMENTINFO_0_PAYMENTSTATUS"]; 
			  
			  $pendingReason  = $resArray["PAYMENTINFO_0_PENDINGREASON"];  

			  $reasonCode     = $resArray["PAYMENTINFO_0_REASONCODE"];

			    if($this->session->userdata('payment_data'))
			    { 
			     
					$payment_data = $this->session->userdata('payment_data');

					if(!$this->session->userdata('checkout_detail'))
					{
						redirect('cart/distributor');	
					}
			    	$user_detail  		 = $this->Common_model->get_row('users',array('id'=>user_id()));
			  		$distributor_detail  = $this->Common_model->get_row('users',array('id'=>$payment_data['distributor_id']));

					$charity_amount =0;
					$state_manager_amount=0;
					$distributor_amount =0;
					$lashulashes_amount=0;
					$distribution_detail = array();

					$cart_total  = $payment_data['total']+$payment_data['discount']; //$payment_data['discount'] its always contain a negative values
					$gst_percent = $payment_data['tax_percent'];
					$grand_total = $cart_total+(($cart_total*$gst_percent)/100);


			  		if($payment_data['distributor_id']!=1)
			  		{
			  			$distributor_percent =100;
			  			if(!empty($distributor_detail->charity_percentage))
			  			{
							$charity_amount = $grand_total*$distributor_detail->charity_percentage/100;
							$distributor_percent = $distributor_percent-$distributor_detail->charity_percentage;
			  			}
			  			if(!empty($distributor_detail->state_percentage))
			  			{
							$state_manager_amount = $grand_total*$distributor_detail->state_percentage/100;
							$distributor_percent = $distributor_percent-$distributor_detail->state_percentage;
			  			}
			  			if(!empty($distributor_detail->lash_percentage))
			  			{
							//$lashulashes_amount = $grand_total*$distributor_detail->lash_percentage/100;
							$distributor_percent = $distributor_percent-$distributor_detail->lash_percentage;
			  			}
			  			if(!empty($distributor_percent))
			  			{
							$distributor_amount = $grand_total*$distributor_percent/100;
			  			}

			  			$lashulashes_amount = $grand_total - ($charity_amount+$state_manager_amount+$distributor_amount);
			  			$distributor_amount = $distributor_amount + ($payment_data['grand_total'] - $grand_total);


			  			/*1st distribution //charity */
			  			$distributionResArray1 = $this->paypalfunctions->MassPay($distributor_detail->charity_paypal,number_format($charity_amount,2)); // Charity
			  			if(isset($distributionResArray1["ACK"]))
						{
							$ack = strtoupper($distributionResArray1["ACK"]);
					        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
					        {   
					            $distribution_detail['charity'] = array(
					            											'status'		=> 'ok',
					            											'paypal'        => $distributor_detail->charity_paypal,
											                                'amount'        => $charity_amount,
											                                'timestamp'     => $distributionResArray1['TIMESTAMP'],
											                                'ack'           => $distributionResArray1['ACK'],
											                                'correlationid' => $distributionResArray1['CORRELATIONID'],
											                                'build'         => $distributionResArray1['BUILD'],
											                                'created'       => date('Y-m-d h:i:s'),
											                                'json'			=> $distributionResArray1,
											                                'msg'			=> ''
					            										);
					        } 
					        else 
					        {
					            $distribution_detail['charity'] = array(
					            											'status'		=> 'failed',
					            											'paypal'        => $distributor_detail->charity_paypal,
											                                'amount'        => $charity_amount,
											                                'timestamp'     => $distributionResArray1['TIMESTAMP'],
											                                'ack'           => $distributionResArray1['ACK'],
											                                'correlationid' => $distributionResArray1['CORRELATIONID'],
											                                'build'         => $distributionResArray1['BUILD'],
											                                'created'       => date('Y-m-d h:i:s'),
											                                'json'			=> $distributionResArray1,
											                                'msg'			=> $distributionResArray1["L_LONGMESSAGE0"]
					            										);
					        }
						}
						else
						{
							$distribution_detail['charity'] = array(
				            											'status'		=> 'failed',
				            											'paypal'        => $distributor_detail->charity_paypal,
										                                'amount'        => $charity_amount,
										                                'timestamp'     => '',
										                                'ack'           => '',
										                                'correlationid' => '',
										                                'build'         => '',
										                                'created'       => date('Y-m-d h:i:s'),
										                                'json'			=> $distributionResArray1,
										                                'msg'			=> 'Error in connecting with paypal'
			            											);
						}

			  			/*1st distribution //state manager */
			  			$distributionResArray2 = $this->paypalfunctions->MassPay($distributor_detail->state_paypal,number_format($state_manager_amount,2)); // State manager 
						if(isset($distributionResArray1["ACK"]))
						{	
							$ack = strtoupper($distributionResArray1["ACK"]);
					        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
					        {   
					            $distribution_detail['state'] = array(
					            											'status'		=> 'ok',
					            											'paypal'        => $distributor_detail->state_paypal,
											                                'amount'        => $state_manager_amount,
											                                'timestamp'     => $distributionResArray2['TIMESTAMP'],
											                                'ack'           => $distributionResArray2['ACK'],
											                                'correlationid' => $distributionResArray2['CORRELATIONID'],
											                                'build'         => $distributionResArray2['BUILD'],
											                                'created'       => date('Y-m-d h:i:s'),
											                                'json'			=> $distributionResArray2,
											                                'msg'			=> ''
					            										);
					        } 
					        else 
					        {
					            $distribution_detail['state'] = array(
					            											'status'		=> 'failed',
					            											'paypal'        => $distributor_detail->state_paypal,
											                                'amount'        => $state_manager_amount,
											                                'timestamp'     => $distributionResArray2['TIMESTAMP'],
											                                'ack'           => $distributionResArray2['ACK'],
											                                'correlationid' => $distributionResArray2['CORRELATIONID'],
											                                'build'         => $distributionResArray2['BUILD'],
											                                'created'       => date('Y-m-d h:i:s'),
											                                'json'			=> $distributionResArray2,
											                                'msg'			=> $distributionResArray1["L_LONGMESSAGE0"]
					            										);
					        }

						}
						else
						{
							$distribution_detail['state'] = array(
				            											'status'		=> 'failed',
				            											'paypal'        => $distributor_detail->state_paypal,
										                                'amount'        => $state_manager_amount,
										                                'timestamp'     => '',
										                                'ack'           => '',
										                                'correlationid' => '',
										                                'build'         => '',
										                                'created'       => date('Y-m-d h:i:s'),
										                                'json'			=> $distributionResArray2,
										                                'msg'			=> 'Error in connecting with paypal'
			            											);
						}

			  			/*1st distribution //disributer */

			  			$distributionResArray3 = $this->paypalfunctions->MassPay($distributor_detail->paypal,number_format($distributor_amount,2)); // Distributer 
						if(isset($distributionResArray1["ACK"]))
						{
							$ack = strtoupper($distributionResArray1["ACK"]);
					        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
					        {   
					            $distribution_detail['distributor'] = array(
					            											'status'		=> 'ok',
					            											'paypal'        => $distributor_detail->paypal,
											                                'amount'        => $distributor_amount,
											                                'timestamp'     => $distributionResArray3['TIMESTAMP'],
											                                'ack'           => $distributionResArray3['ACK'],
											                                'correlationid' => $distributionResArray3['CORRELATIONID'],
											                                'build'         => $distributionResArray3['BUILD'],
											                                'created'       => date('Y-m-d h:i:s'),
											                                'json'			=> $distributionResArray3,
											                                'msg'			=> ''
					            										);
					        } 
					        else 
					        {
					            $distribution_detail['distributor'] = array(
					            											'status'		=> 'failed',
					            											'paypal'        => $distributor_detail->paypal,
											                                'amount'        => $distributor_amount,
											                                'timestamp'     => $distributionResArray3['TIMESTAMP'],
											                                'ack'           => $distributionResArray3['ACK'],
											                                'correlationid' => $distributionResArray3['CORRELATIONID'],
											                                'build'         => $distributionResArray3['BUILD'],
											                                'created'       => date('Y-m-d h:i:s'),
											                                'json'			=> $distributionResArray3,
											                                'msg'			=> $distributionResArray1["L_LONGMESSAGE0"]
					            										);
					        }

						}
						else
						{
							$distribution_detail['distributor'] = array(
				            											'status'		=> 'failed',
				            											'paypal'        => $distributor_detail->paypal,
										                                'amount'        => $distributor_amount,
										                                'timestamp'     => '',
										                                'ack'           => '',
										                                'correlationid' => '',
										                                'build'         => '',
										                                'created'       => date('Y-m-d h:i:s'),
										                                'json'			=> $distributionResArray3,
										                                'msg'			=> 'Error in connecting with paypal'
			            											);
						}

			  		}
			  		$discountArr = $this->session->userdata('discount_amount_array');
					$order_detail  = $this->cart->contents();
					$created_date = date('Y-m-d h:i:s');
					$result_array  = array(
								//'order_id'			=> 
								'user_id'               => user_id(),
								'user_detail'           => json_encode($user_detail),
								'order_detail'			=> json_encode($order_detail),
								'shipping'				=> $payment_data['shipping'],
								'tax'					=> $payment_data['tax'],
								'total'					=> $payment_data['total'],
								'discount'				=> $payment_data['discount'],
								'coupon_code'			=> $payment_data['coupon_code'],
								'grand_total'			=> $payment_data['grand_total'],
								'payment_type'          => 'paypal',
								'transaction_id'        => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
								'fee'                   => $resArray['PAYMENTINFO_0_FEEAMT']+$resArray['PAYMENTINFO_0_TAXAMT'],
								'payment_status'        => $resArray['PAYMENTINFO_0_PAYMENTSTATUS'],
								'response'              => json_encode($resArray),
								'created'				=> $created_date,
								'distributor_id'		=> $payment_data['distributor_id'],
								'distributor_name'		=> $payment_data['distributor_name'],
								'charity'				=> $charity_amount,
								'state_manager'			=> $state_manager_amount,
								'lashulashes'			=> number_format($lashulashes_amount,2),
								'distribution_detail'	=> json_encode($distribution_detail),
								 

					);

					if($payment_data['discount_type']==1){
						$result_array['membership_discount_array'] = json_encode($discountArr);
					}

					$data['discount_type'] = $payment_data['discount_type'];
					$insert_id = $this->Common_model->insert('orders',$result_array);
					$created = date('ymd-His',strtotime($created_date)).'P-'.$insert_id;
                  	$this->Common_model->update('orders',array('unique_order_id'=>$created),array('order_id'=>$insert_id));
					$data['discountArr'] = $discountArr;

					//print_r($data['discountArr']);die;
				 	 // mail to user
		            $this->load->library('chapter247_email');
		            $email_template=$this->chapter247_email->get_email_template(8);

		            $data['type'] ='product';
		            $data['value'] = $this->Common_model->get_row('orders',array('order_id'=>$insert_id));
		            $data['message'] = $email_template->template_body;

		          	$html = $this->load->view('website/email',$data,true);
		            $param = array(
		                'template'  =>  array(
		                                'temp'      =>  $html,
		                                'var_name'  =>  array(
		                                                 'user_name'  => ucfirst($user_detail->first_name).' '. ucfirst($user_detail->last_name),
		                                                 'email'      => $user_detail->email,     
		                                                 'contact'    => $user_detail->mobile,
		                                                    ), 
		                                      ),            
		                'email' =>  array(
		                            'to'        =>   $user_detail->email,
		                            'from'      =>   NO_REPLY_EMAIL,
		                            'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
		                            'subject'   =>   $email_template->template_subject,
		                        )
		              );
		            $status=$this->chapter247_email->send_mail($param);

		            $data['message'] = $email_template->template_body_admin;
		            $html = $this->load->view('website/email',$data,true);

		            $admin_param = array(
		                'template'  =>  array(
		                                'temp'      => $html,
		                                'var_name'  => array(
															'distributor_name'	=> ucfirst($payment_data['distributor_name']),
		                                                    ), 
		                                      ),            
		                'email' =>  array(
		                            'to'        => $payment_data['distributor_email'],
		                            'bcc'		=> SUPERADMIN_EMAIL,
		                            'from'      => NO_REPLY_EMAIL,
		                            'from_name' => NO_REPLY_EMAIL_FROM_NAME,
		                            'subject'   => $email_template->template_subject_admin,
		                        )
		              );
		            $status=$this->chapter247_email->send_mail($admin_param);

					$this->session->set_flashdata('msg_success','Your order has been placed successfully. Your order-id is '.$created.'.');
					$this->cart->destroy();							
					redirect('website/profile');
			    }               
			}
			else  
			{
			  //Display a user friendly Error on the page using any of the following error information returned by PayPal
			  $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
			  $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
			  $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
			  $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

			  /*if ($this->session->userdata('buyer_detail')):
			      $this->session->unset_userdata('buyer_detail');
			     endif;
			  $data['message'] = '<div class="alert alert-danger" role="alert"><h5>'.$ErrorLongMsg.'</h5></div>';
			  $data['template']= 'frontend/paypal_error';
			  $this->load->view('templates/frontend/layout',$data);*/
			  $this->session->set_flashdata('msg_error',$ErrorLongMsg);
			  redirect('cart');
			  
			  /*echo "GetExpressCheckoutDetails API call failed. ";
			  echo "Detailed Error Message: " . $ErrorLongMsg;
			  echo "Short Error Message: " . $ErrorShortMsg;
			  echo "Error Code: " . $ErrorCode;
			  echo "Error Severity Code: " . $ErrorSeverityCode;*/
			}
		}

	}

	public function cancel()
	{
		if($this->session->userdata('payment_data'))
		{
			$this->session->unset_userdata('payment_data');
		}
		$this->session->set_flashdata('msg_success','Your transaction is canceled successfully.');
        redirect('cart');
	}

	public function pay_stripe()
	{ 
		if(!user_logged_in())
		{
		  $this->session->set_flashdata('msg_info', 'Please login or sign-up to buying.');
		  redirect('website/login');
		}
		
		if($this->session->userdata('purchase_type'))
		{
			if($this->session->userdata('purchase_type') != 'product') redirect('product');
		}
		else
		{
			redirect('product');	
		}

		if(!$this->session->userdata('checkout_detail'))
		{
			redirect('cart/distributor');	
		}
		else
		{
			$checkout_detail	= $this->session->userdata('checkout_detail');
			
			if(!isset($checkout_detail['distributor_id'])) $checkout_detail['distributor_id']=1;	
			if(!isset($checkout_detail['distributor_name'])) $checkout_detail['distributor_name']='Lash U Lashes';
		}

		$total		   	= $this->cart->total(); // total cart amount
        $extracharge   	= 0;	//shipping and other charge
        $tax 		   	= 0; //if not required set 0
        $discount 	   	= -0;//if not required set -0 , allways negative sign
        $coupon_code   	= '';
        $grand_total	= $total+$extracharge+$tax+$discount; 
		$user_detail  	= $this->Common_model->get_row('users',array('id'=>user_id()));
		$order_detail 	= $this->cart->contents();
		

		$data['descrip']      = 'products';
		$data['amount']       = $grand_total;
		$data['card_number']  = $_POST['card_number'];
		$data['exp_month']    = $_POST['exp_month'];
		$data['exp_year']     = $_POST['exp_year'];
		$data['cvc']          = $_POST['cvc'];



		if(empty($grand_total)||empty($data['card_number'])||empty($data['exp_month'])||empty($data['exp_year'])||empty($data['cvc']))
		{ 
		  $this->session->set_flashdata('msg_info', 'Please enter all required fields.');
		  if(isset($_SERVER['HTTP_REFERER'])) 
            {
			    redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect('cart/payment');
			}
		}
		/*load stripe library */
		$this->load->library('stripe-php/init');    
		$charge = $this->init->charge($data);

		if($charge)
		{       
		    if($charge['application_fee']==null) $fee = 0; else $fee = $charge['application_fee'];

			$result_array  = array(
					//'order_id'			=> 
					'user_id'               => user_id(),
					'user_detail'           => json_encode($user_detail),
					'order_detail'			=> json_encode($order_detail),
					'shipping'				=> $extracharge,
					'tax'					=> $tax,
					'total'					=> $total,
					'discount'				=> $discount,
					'coupon_code'			=> $coupon_code,
					'grand_total'			=> $grand_total,
					'payment_type'          => 'stripe',
					'transaction_id'        => $charge['id'],
					'fee'                   => $fee,
					'payment_status'        => $charge['status'],
					'response'              => json_encode($charge),
					'created'				=> date('Y-m-d h:i:s'),
					'distributor_id'		=> $checkout_detail['distributor_id'],
					'distributor_name'		=> $checkout_detail['distributor_name'],
						   );
			$order_id = $this->Common_model->insert('orders',$result_array);
			
			$this->session->unset_userdata('checkout_detail');	

			 // mail to user
            $this->load->library('chapter247_email');
            $email_template=$this->chapter247_email->get_email_template(8);

            $data['type'] ='product';
            $data['value'] = $this->Common_model->get_row('orders',array('order_id'=>$order_id));
            
            //mail to user 
            $data['message'] = $email_template->template_body;
            $html = $this->load->view('website/email',$data,true);

            $param=array(
                'template'  =>  array(
                                'temp'      =>  $html,
                                'var_name'  =>  array(
                                                 'user_name'  => ucfirst($user_detail->first_name).' '. ucfirst($user_detail->last_name),
                                                 'email'      => $user_detail->email,     
                                                 'contact'    => $user_detail->mobile,
                                                    ), 
                                      ),            
                'email' =>  array(
                            'to'        =>   $user_detail->email,
                            'from'      =>   NO_REPLY_EMAIL,
                            'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                            'subject'   =>   $email_template->template_subject,
                        )
              );
            $status=$this->chapter247_email->send_mail($param);

            //mail to admin and distributor
            $data['message'] = $email_template->template_body_admin;
		    $html = $this->load->view('website/email',$data,true);

		            $admin_param = array(
		                'template'  =>  array(
		                                'temp'      => $html,
		                                'var_name'  => array(
															'distributor_name'	=> ucfirst($checkout_detail['distributor_name']),
		                                                    ), 
		                                      ),            
		                'email' =>  array(
		                            'to'        => $checkout_detail['distributor_email'],
		                            'bcc'		=> SUPERADMIN_EMAIL,
		                            'from'      => NO_REPLY_EMAIL,
		                            'from_name' => NO_REPLY_EMAIL_FROM_NAME,
		                            'subject'   => $email_template->template_subject_admin,
		                        )
		              );
		            $status=$this->chapter247_email->send_mail($admin_param);


			$this->session->set_flashdata('msg_success','Your order has been placed successfully. Your order-id is '.$order_id.'.');
			$this->cart->destroy();							
			redirect('website/profile');
		}
		else
		{
		  $this->session->set_flashdata('msg_info', 'There is some error please try again.');
		   if(isset($_SERVER['HTTP_REFERER'])) 
            {
			    redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect('cart/payment');
			}
		}
		/*echo "<pre>";
		print_r(json_encode($charge));*/
	}
}



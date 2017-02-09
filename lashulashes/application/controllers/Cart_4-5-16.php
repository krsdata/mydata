<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{

            parent::__construct();

            $this->load->model('products_model'); 
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
     //display all cart product
	public function index()
	{

		if($this->session->userdata('purchase_type')=='product')
		{
			$data['total']				= $this->cart->total();
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

		if(!user_logged_in())
		{
			$this->session->set_flashdata('msg_info','Please login or sign-up to buy products. <a href="'.base_url('website/login').'" class="form_carot">Login</a>');
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
			$result = array('status'=>0,'message'=>'<div class="alert alert-info">Please login or sign-up to buy products. <a href="'.base_url('website/login').'" class="form_carot">Login</a></div>');
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
			$distributor_id = $this->input->post('distributor_id');
			$distributor_detail = $this->Common_model->get_row('users',array('id'=>$distributor_id));
			if(!$distributor_detail) redirect('cart');

			if($distributor_id==1) 
				{
					$distributor_detail->title = 'Lash U Lashes';
					$distributor_detail->email = SUPERADMIN_EMAIL;
				}
			if(empty($distributor_detail->title)) $distributor_detail->title = '';
			$checkout_detail = array(
									'distributor_id'=>$distributor_id,
									'distributor_name'=>$distributor_detail->title,
									'distributor_email'=>$distributor_detail->email);
			
			$this->session->set_userdata('checkout_detail', $checkout_detail);
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
		$data['total']				= $this->cart->total();
		$data['gst']	  			= 0;
		$data['shipping'] 			= 0;
		$data['coupon_discount']	= 0;
		$data['template'] 			= 'frontend/cart/payment';
		$this->load->view('templates/frontend/layout', $data);
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
				$max_distance = 100*1000;//distance in meter
				$distance = $temp_dis->distance->value;//distance in meter
				
				if($max_distance >= $distance)
				{
					$distributors_temp[] = $row;
				}
			}
			else
			{
				
			}
		}

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

        $paymentAmount = 0;
        $total		   = $this->cart->total(); // producttotal cart amount
        $extracharge   = 0;	//shipping and other charge
        $tax 		   = 0; //if not required set 0
        $discount 	   = -0;//if not required set -0 , allways negative sign
        $coupon_code   = '';

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


        $paymentAmount = $total+$extracharge+$discount+$tax;         

        $this->session->set_userdata('payment_data',array('shipping'=> $extracharge, 'tax'=>$tax, 'total'=>$total, 'discount'=>$discount, 'coupon_code'=>$coupon_code, 'grand_total'=>$paymentAmount, 'distributor_id'=>$checkout_detail['distributor_id'], 'distributor_name'=>$checkout_detail['distributor_name'], 'distributor_email'=>$checkout_detail['distributor_email']));

        $_SESSION["Payment_Amount"] = $paymentAmount;
        $currencyCodeType = "USD";
        $paymentType = "Sale";
                //'------------------------------------            
        $returnURL = product_returnURL;
                //'------------------------------------
        $cancelURL = product_cancelURL;

        $resArray = $this->paypalfunctions->CallShortcutExpressCheckoutWithDiss_tax( $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL, $items, $extracharge, $tax, $discount );
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

                 $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
                 redirect('cart/payment');
                 //echo $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
               }
        }
        else  
        {

                $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
                redirect('cart/payment');
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
					$user_detail 	= $this->Common_model->get_row('users',array('id'=>user_id()));
					$order_detail = $this->cart->contents();
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
								'created'				=> date('Y-m-d h:i:s'),
								'distributor_id'		=> $payment_data['distributor_id'],
								'distributor_name'		=> $payment_data['distributor_name'],

									   );
					$order_id = $this->Common_model->insert('orders',$result_array);

				 	 // mail to user
		            $this->load->library('chapter247_email');
		            $email_template=$this->chapter247_email->get_email_template(8);

		            $data['type'] ='product';
		            $data['value'] = $this->Common_model->get_row('orders',array('order_id'=>$order_id));
		            $data['message'] = $email_template->template_body;
		            $html = $this->load->view('website/email',$data,true);

		            $param = array(
		                'template'  =>  array(
		                                'temp'      =>  $html,
		                                'var_name'  =>  array(
		                                                 'user_name'  => $user_detail->first_name.' '. $user_detail->last_name,
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
															'distributor_name'	=> $payment_data['distributor_name'],
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

					$this->session->set_flashdata('msg_success','Your order has been placed successfully. Your order-id is '.$order_id.'.');
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
                                                 'user_name'  => $user_detail->first_name.' '. $user_detail->last_name,
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
															'distributor_name'	=> $checkout_detail['distributor_name'],
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



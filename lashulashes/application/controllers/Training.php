<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

	public function __construct()
 	{
        parent::__construct();
        $this->load->model('traning_model');
	}

	
    public function index($offset=0)
    {               
        $data['template'] = "frontend/training/training";
        $this->load->view('templates/frontend/layout', $data);
    }
    public function view($slug='#1')
    {               
        $data['template'] = "frontend/training/training";
        $this->load->view('templates/frontend/layout', $data);
    }

    public function calendar()
    {
        $month_list = $this->Common_model->get_result('traning',array('status'=>1,'start_date >'=>date('Y-m-d')),array('start_date'));
        $temp_month_list = array();
        if($month_list)
        {
            foreach ($month_list as $month_list_row) 
            {
                $temp1 = date('M Y',strtotime($month_list_row->start_date));
                $temp2 = date('Y-m',strtotime($month_list_row->start_date));
                $temp_month_list[$temp2] = $temp1;
            }
            ksort($temp_month_list);
        }
        /*print_r($temp_month_list);
        die();*/
        

        $month_list = $temp_month_list;
        $data['selected_training'] = $this->traning_model->get_selected_training();
        $data['month_list'] = $month_list;
        $data['training'] = $this->traning_model->get_act_training();
        $data['template'] = "frontend/training/calendar";
        $this->load->view('templates/frontend/layout', $data);
    }

    public function check_training_detail()
    {
        $id = $_POST['id'];
        $msg = '';
        $flag = 0;
        $detail = $this->traning_model->get_training_row($id);
        if($detail)
        {
            $total_booking = $this->Common_model->get_row('training_booking',array('training_id'=>$id),array('sum(slot) as total_booking'));
            $total_booking = $total_booking->total_booking;
            if($total_booking == null) $total_booking=0;
            $total_booking = intval($total_booking);
            $detail->participant = $detail->participant - $total_booking;

            if($detail->participant>0)
            {
                if($this->session->userdata('purchase_type'))
                {
                    if($this->cart->contents())
                    {          
                        if($this->session->userdata('purchase_type')!= 'training')
                        {
                          $msg = 'Please empty the cart. <a href="'.base_url('cart').'" class="form_carot"> Cart.. </a>';
                          $flag = 0; 
                        }
                        else
                        {
                            //$this->session->set_userdata('purchase_type','training');
                            foreach ($this->cart->contents() as $row) 
                            {
                                if($row['id'] == $id)
                                {
                                    $detail->participant = $detail->participant - $row['qty'];
                                }
                            }
                            if($detail->participant>0)
                            {
                                $msg = $detail;
                                $flag = 1;
                            }
                            else
                            {
                                $msg = 'You have already booked the maximum seats in cart. ';
                                $flag = 0;
                            }


                        }
                    }
                    else
                    {
                        $this->session->set_userdata('purchase_type','training');
                        $msg = $detail;
                        $flag = 1;
                    }
                }
                else
                {
                    $this->session->set_userdata('purchase_type','training');
                    $msg = $detail;
                    $flag = 1;
                }
            }
            else
            {
                $msg = 'All seats are booked.';
                $flag = 0;
            }
        }
        else
        {
            $msg = 'Please try again.';
            $flag = 0; 
        }
        $result = array('STATUS'=>$flag,'msg'=>$msg);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function book_training_seats()
    {
        $id     =  $_POST['id'];
        $qty    =  $_POST['qty'];
        $flag   =  0;
        $msg    =  'Please try after some time.';
        $detail = $this->traning_model->get_training_row($id);
        if($detail)
        {
            $data = array(
                        'id'            => $id,
                        'qty'           => $qty,
                        'price'         => $detail->fees,
                        'name'          => $detail->title,
                        'start_date'    => $detail->start_date,
                        'end_date'      => $detail->end_date,
                        'timing'        => $detail->timing,
                        'state'         => $detail->state,
                        'category_id'   => $detail->category_id,
                        'category_name' => $detail->name,
                        );
            $this->cart->insert($data);
            $flag = 1;
            $this->session->set_flashdata('msg_success', 'Training sucessfully added to your cart.');

        }
        else
        {
            $msg = 'Please try again.';
            $flag = 0;
        }

        $result = array('STATUS'=>$flag,'msg'=>$msg);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function checkout()
    {
        if($this->session->userdata('purchase_type'))
        {
            if($this->session->userdata('purchase_type') == 'training')
            {
                $this->form_validation->set_error_delimiters('<label class="form_carot">','</label>'); 
                if($this->form_validation->run('contact_detail_at_buying')==FALSE)
                {

                }
                else
                {
                    $data_array =array(
                                    'first_name'  => $this->input->post('first_name'),
                                    'last_name'   => $this->input->post('last_name'),
                                    'email'       => $this->input->post('email'),
                                    'contact'     => $this->input->post('contact')
                                        );
                    $this->session->set_userdata('buyer_detail',$data_array);
                    redirect('training/payment');
                }
                $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>user_id()));
                $data['template'] = 'frontend/cart/checkout_2';
                $this->load->view('templates/frontend/layout', $data);
            }
            else
            {
                redirect('training/calendar');
            }
        }
        else
        {
            redirect('training/calendar');
        }
    }

    public function payment()
    {
        if($this->session->userdata('purchase_type'))
        {
            if($this->session->userdata('purchase_type') == 'training')
            {
                if(!$this->cart->contents()) redirect('training/calendar');
                if( $this->session->userdata('buyer_detail'))
                {
                    $data['total']              = $this->cart->total();
                    $data['gst']                = 0;
                    $data['shipping']           = 0;
                    $data['coupon_discount']    = 0;
                    $data['template']           = 'frontend/cart/payment';
                    $this->load->view('templates/frontend/layout', $data);
                }
                else
                {
                    redirect('training/calendar');
                }
            }
            else
            {
                redirect('training/calendar');
            }
        }
        else
        {
            redirect('training/calendar');
        }
    }

    public function pay_paypal()
    {

        if($this->session->userdata('purchase_type'))
        {
            if($this->session->userdata('purchase_type') != 'training') redirect('training/calendar');
        }
        else
        {
            redirect('training/calendar');   
        }

        if(!$this->cart->contents()) redirect('training/calendar');

        $this->load->library('paypalfunctions');

        $paymentAmount = 0;

        $total         = $this->cart->total(); // producttotal cart amount
        $extracharge   = 0; //shipping and other charge
        $tax           = 0; //if not required set 0
        $discount      = -0;//if not required set -0 , allways negative sign
        $coupon_code   = '';

        $items         = array();
        foreach ($this->cart->contents() as $row) 
        {
            $items[]   = array('name'=>$row['name'], 'amt' =>$row['price'], 'qty' => $row['qty'],'desc'=>'');
        }
        //$items[]       = array('name'=>'test discount', 'amt' =>10, 'qty' => 1,'desc'=>'');


        $paymentAmount = $total+$extracharge+$discount+$tax;         

        $this->session->set_userdata('payment_data',array('shipping'=> $extracharge, 'tax'=>$tax, 'total'=>$total, 'discount'=>$discount, 'coupon_code'=>$coupon_code, 'grand_total'=>$paymentAmount));

        $_SESSION["Payment_Amount"] = $paymentAmount;
        $currencyCodeType = "USD";
        $paymentType = "Sale";
                //'------------------------------------            
        $returnURL = training_returnURL;
                //'------------------------------------
        $cancelURL = training_cancelURL;

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
                 redirect('training/payment');
                 //echo $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
               }
        }
        else  
        {

                $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
                redirect('training/payment');
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
                    $buyer_detail = $this->session->userdata('buyer_detail');
                    $order_detail = $this->cart->contents();
                    if(user_id())
                    {
                        $user_id = user_id();
                    }
                    else
                    {
                        $user_id = 0;
                    }
                    $insert_id=0;
                    $i=0;
                    foreach ($order_detail as $row) 
                    {
                        $created = date('Y-m-d H:i:s');
                        $i++;
                        if($i==1)
                        {
                            $result_array1  = array(
                                    'booking_id'      => $insert_id,
                                    'client_id'       => $user_id,
                                    'first_name'      => $buyer_detail['first_name'],
                                    'last_name'       => $buyer_detail['last_name'],
                                    'email'           => $buyer_detail['email'],
                                    'contact'         => $buyer_detail['contact'],
                                    'training_id'     => $row['id'],
                                    'training_name'   => $row['name'],
                                    'category_id'     => $row['category_id'],
                                    'category_name'   => $row['category_name'],
                                    'slot'            => $row['qty'],
                                    'price'           => $row['price'],
                                    'store_location'  => $row['state'],
                                    'order_detail'    => json_encode($order_detail),
                                    'payment_type'    => 'paypal',
                                    'transaction_id'  => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
                                    'tax'             => $payment_data['tax'],
                                    'total'           => $payment_data['total'],
                                    'discount'        => $payment_data['discount'],
                                    'coupon_code'     => $payment_data['coupon_code'],
                                    'grand_total'     => $payment_data['grand_total'],
                                    'fee'             => $resArray['PAYMENTINFO_0_FEEAMT']+$resArray['PAYMENTINFO_0_TAXAMT'],
                                    'payment_status'  => $resArray['PAYMENTINFO_0_PAYMENTSTATUS'],
                                    'response'        => json_encode($resArray),
                                    'created'         => $created,
                                    );

                            $insert_id = $this->Common_model->insert('training_booking',$result_array1);
                            $created = date('ymd-His',strtotime($created)).'T-'.$insert_id;
                            $this->Common_model->update('training_booking',array('booking_id'=>$insert_id,'registration_id'=>$created),array('id'=>$insert_id));
                        }
                        else
                        {   
                            $result_array1  = array(
                                    'booking_id'      => $insert_id,
                                    'client_id'       => $user_id,
                                    'first_name'      => $buyer_detail['first_name'],
                                    'last_name'       => $buyer_detail['last_name'],
                                    'email'           => $buyer_detail['email'],
                                    'contact'         => $buyer_detail['contact'],
                                    'training_id'     => $row['id'],
                                    'training_name'   => $row['name'],
                                    'category_id'     => $row['category_id'],
                                    'category_name'   => $row['category_name'],
                                    'slot'            => $row['qty'],
                                    'price'           => $row['price'],
                                    'store_location'  => $row['state'],
                                    'created'         => date('Y-m-d h:i:s')
                                    );
                            $this->Common_model->insert('training_booking',$result_array1);
                        }
                    }

                    $this->session->set_flashdata('msg_success','Your order has been placed successfully. Your order-id is '.$created.'.');
                    // mail to user
                    $this->load->library('chapter247_email');
                    $email_template=$this->chapter247_email->get_email_template(6);

                    $data['type'] ='training';
                    $data['value'] = $this->Common_model->get_row('training_booking',array('id'=>$insert_id));
                    $data['message'] = $email_template->template_body;
                    $html = $this->load->view('website/email',$data,true);

                    $param=array(
                        'template'  =>  array(
                                        'temp'      =>  $html,
                                        'var_name'  =>  array(
                                                         'user_name'  => ucfirst($buyer_detail['first_name']).' '. ucfirst($buyer_detail['last_name']),
                                                         'email'      => $buyer_detail['email'],     
                                                         'contact'    => $buyer_detail['contact'],
                                                         'order-id'   => $created,
                                                            ), 
                                              ),            
                        'email' =>  array(
                                    'to'        =>   $buyer_detail['email'],
                                    'from'      =>   NO_REPLY_EMAIL,
                                    'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                                    'subject'   =>   $email_template->template_subject,
                                )
                      );
                    $status=$this->chapter247_email->send_mail($param);

                    $this->cart->destroy();                         
                    redirect('training/calendar');
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
        
        if($this->session->userdata('purchase_type'))
        {
            if($this->session->userdata('purchase_type') != 'training') redirect('training/calendar');
        }
        else
        {
            redirect('training/calendar');    
        }

        $total          = $this->cart->total(); // total cart amount
        $extracharge    = 0;    //shipping and other charge
        $tax            = 0; //if not required set 0
        $discount       = -0;//if not required set -0 , allways negative sign
        $coupon_code    = '';
        $grand_total    = $total+$extracharge+$tax+$discount;         

        $data['descrip']      = 'Training';
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
                redirect('training/payment');
            }
        }
        /*load stripe library */
        $this->load->library('stripe-php/init');    
        $charge = $this->init->charge($data);

        if($charge)
        {       
            if($charge['application_fee']==null) $fee = 0; else $fee = $charge['application_fee'];
            ///////////////////////////////////////////////////////////////////////////////////
            $buyer_detail = $this->session->userdata('buyer_detail');
            $order_detail = $this->cart->contents();
            if(user_id())
            {
                $user_id = user_id();
            }
            else
            {
                $user_id = 0;
            }
            $insert_id=0;
            $i=0;
            foreach ($order_detail as $row) 
            {
                $i++;
                if($i==1)
                {
                    $result_array1  = array(
                            'booking_id'      => $insert_id,
                            'client_id'       => $user_id,
                            'first_name'      => $buyer_detail['first_name'],
                            'last_name'       => $buyer_detail['last_name'],
                            'email'           => $buyer_detail['email'],
                            'contact'         => $buyer_detail['contact'],
                            'training_id'     => $row['id'],
                            'training_name'   => $row['name'],
                            'category_id'     => $row['category_id'],
                            'category_name'   => $row['category_name'],
                            'slot'            => $row['qty'],
                            'price'           => $row['price'],
                            'store_location'  => $row['state'],
                            'order_detail'    => json_encode($order_detail),
                            'payment_type'    => 'stripe',
                            'transaction_id'  => $charge['id'],
                            'tax'             => $tax,
                            'total'           => $total,
                            'discount'        => $discount,
                            'coupon_code'     => $coupon_code,
                            'grand_total'     => $grand_total,
                            'fee'             => $fee,
                            'payment_status'  => $charge['status'],
                            'response'        => json_encode($charge),
                            'created'         => date('Y-m-d h:i:s'),
                            );

                    $insert_id = $this->Common_model->insert('training_booking',$result_array1);
                    $this->Common_model->update('training_booking',array('booking_id'=>$insert_id),array('id'=>$insert_id));
                }
                else
                {   
                    $result_array1  = array(
                            'booking_id'      => $insert_id,
                            'client_id'       => $user_id,
                            'first_name'      => $buyer_detail['first_name'],
                            'last_name'       => $buyer_detail['last_name'],
                            'email'           => $buyer_detail['email'],
                            'contact'         => $buyer_detail['contact'],
                            'training_id'     => $row['id'],
                            'training_name'   => $row['name'],
                            'category_id'     => $row['category_id'],
                            'category_name'   => $row['category_name'],
                            'slot'            => $row['qty'],
                            'price'           => $row['price'],
                            'store_location'  => $row['state'],
                            'created'         => date('Y-m-d h:i:s')
                            );
                    $this->Common_model->insert('training_booking',$result_array1);
                }
            }
            
            // mail to user
            $this->load->library('chapter247_email');
            $email_template=$this->chapter247_email->get_email_template(6);

            $data['type'] ='training';
            $data['value'] = $this->Common_model->get_row('training_booking',array('id'=>$insert_id));
            $data['message'] = $email_template->template_body;
            $html = $this->load->view('website/email',$data,true);

            $param=array(
                'template'  =>  array(
                                'temp'      =>  $html,
                                'var_name'  =>  array(
                                                 'user_name'  => ucfirst($buyer_detail['first_name']).' '. ucfirst($buyer_detail['last_name']),
                                                 'email'      => $buyer_detail['email'],     
                                                 'contact'    => $buyer_detail['contact'],
                                                    ), 
                                      ),            
                'email' =>  array(
                            'to'        =>   $buyer_detail['email'],
                            'from'      =>   NO_REPLY_EMAIL,
                            'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                            'subject'   =>   $email_template->template_subject,
                        )
              );
            $status=$this->chapter247_email->send_mail($param);
            $this->session->set_flashdata('msg_success','Your order has been placed successfully. Your order-id is '.$insert_id.'.');
            $this->cart->destroy();                         
            redirect('training/calendar');
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
                redirect('training/payment');
            }
        }
        /*echo "<pre>";
        print_r(json_encode($charge));*/
    }

}

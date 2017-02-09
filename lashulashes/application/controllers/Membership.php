<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends CI_Controller {

	public function __construct()
 	{
      parent::__construct();
      $this->load->model('webs_model');
			   
	}

	
	public function index($offset=0)
  {
    $data['plans'] = $this->Common_model->get_result('plans',array('status'=>1));
    $data['template'] = "frontend/membership/index";
    $this->load->view('templates/frontend/layout', $data);
  }

  public function detail($plan_slug='',$place='#1')
  {
    if(empty($plan_slug)) redirect('membership');
    $data['detail'] = $this->Common_model->get_row('plans',array('status' =>1,'title_slug'=>$plan_slug));
    if(!$data['detail'])  redirect('membership');
    $data['template'] = "frontend/membership/detail";
    $this->load->view('templates/frontend/layout', $data);
  }

  public function checkout($plan_slug=''){ 
    if(empty($plan_slug)) redirect('membership');
    if($this->input->post()){
         $this->form_validation->set_error_delimiters('<label class="form_carot">','</label>'); 
        if($this->form_validation->run('membership_buyer_detail')==TRUE){
          $data_array =array(
                                    'first_name'  => $this->input->post('first_name'),
                                    'last_name'   => $this->input->post('last_name'),
                                    'email'       => $this->input->post('email'),
                                    'contact'     => $this->input->post('contact')
                                        );
          $this->session->set_userdata('membership_buyer_detail',$data_array);
          redirect('membership/buy_now/'.$plan_slug);
        }
    }
    $data['user_detail'] = $this->Common_model->get_row('users',array('id'=>user_id()));
    $data['template'] = 'frontend/membership/checkout';
    $this->load->view('templates/frontend/layout', $data);
  }

  public function buy_now($plan_slug='')
  {
    /*if(!user_logged_in())
    {
        $this->session->set_flashdata('msg_info', 'Please login or sign-up to buy membership plans.');
        redirect('website/login');
    }*/
    if(empty($plan_slug)) redirect('membership');
    $data['detail'] = $this->Common_model->get_row('plans',array('status' =>1,'title_slug'=>$plan_slug));
    if(!$data['detail'])  redirect('membership');
    if(empty($data['detail']->amount)||empty($data['detail']->title_slug)) redirect('membership');    
    $data['template'] = "frontend/membership/payment";
    $this->load->view('templates/frontend/layout', $data);
  }

  /*paypal payment functions*/

  public function pay_paypal($plan_slug='')
  { 
      /*if(!user_logged_in())
      {
          $this->session->set_flashdata('msg_info', 'Please login or sign-up to buy membership plans.');
          redirect('website/login');
      }*/ 
      if(empty($plan_slug)) redirect('membership');
      $data['detail'] = $this->Common_model->get_row('plans',array('status' =>1,'title_slug'=>$plan_slug));
      if(!$data['detail'])  redirect('membership');
      if(empty($data['detail']->amount)||empty($data['detail']->title_slug)||empty($data['detail']->title)) redirect('membership');

        $this->load->library('paypalfunctions');

        $paymentAmount = 0;
        $extracharge   = 0;
        $items         = array();

        $items[]       = array('name'=>$data['detail']->title.' Membership Plan', 'amt' =>$data['detail']->amount, 'qty' => 1);

        $paymentAmount = $data['detail']->amount;         
        $_SESSION["Payment_Amount"] = $paymentAmount;
        $currencyCodeType = "USD";
        $paymentType = "Sale";
                //'------------------------------------            
        $returnURL = member_returnURL;
                //'------------------------------------
        $cancelURL = member_cancelURL;

        //echo $returnURL;die; 

                //'------------------------------------
                // http://205.134.251.196/~examin8/CI/duolegends/
                //' Calls the SetExpressCheckout API call
                //'
                //' The CallShortcutExpressCheckout function is defined in the file PayPalFunctions.php,
                //' it is included at the top of this file.
                //'-------------------------------------------------
                /*$items = array();
                $items[] = array('name'=> 'nitesh', 'amt' => 1, 'qty' => 1);
                $items[] = array('name'=> 'nitesh2', 'amt' => 2, 'qty' => 3);*/  

        $resArray = $this->paypalfunctions->CallShortcutExpressCheckout ($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL, $items,$extracharge);
            // print_r($resArray);
        if(isset($resArray["ACK"]))
        {
        $ack = strtoupper($resArray["ACK"]);
            if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
                {
                    $this->session->set_userdata('plan_slug',$data['detail']->title_slug);
                    $this->paypalfunctions->RedirectToPayPal( $resArray["TOKEN"] );
                } 
            else{

                 $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
                 redirect('membership/buy_now/'.$data['detail']->title_slug);
               }
        }
        else  
        {

                $this->session->set_flashdata('msg_error','There is some error in connecting with Paypal. Please Try again later!');
                redirect('membership/buy_now/'.$data['detail']->title_slug);
        }
  }

  public function confirm()
  {
      $this->load->library('paypalfunctions');
      //$plan_slug = $this->session->userdata('plan_slug');
      $PaymentOption = "PayPal";
      if ( $PaymentOption == "PayPal" )
      {
          /*
          '------------------------------------
          ' The paymentAmount is the total value of 
          ' the shopping cart, that was set 
          ' earlier in a session variable 
          ' by the shopping cart page
          '------------------------------------
          */            
          $finalPaymentAmount =  $_SESSION["Payment_Amount"];
          
          /*
          '------------------------------------
          ' Calls the DoExpressCheckoutPayment API call
          '
          ' The ConfirmPayment function is defined in the file PayPalFunctions.jsp,
          ' that is included at the top of this file.
          '-------------------------------------------------
          */
          $resArray = $this->paypalfunctions->ConfirmPayment($finalPaymentAmount);
          //print_r($resArray);
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
              //' Tax charged on the transaction.
              //$exchangeRate       = $resArray["PAYMENTINFO_0_EXCHANGERATE"];  
              //' Exchange rate if a currency conversion occurred. Relevant only if your are billing in their non-primary currency. If the customer chooses to pay with a currency other than the non-primary currency, the conversion occurs in the customer’s account.
              
              /*
              ' Status of the payment: 
                      'Completed: The payment has been completed, and the funds have been added successfully to your account balance.
                      'Pending: The payment is pending. See the PendingReason element for more information. 
              */
              
              $paymentStatus  = $resArray["PAYMENTINFO_0_PAYMENTSTATUS"]; 

              /*
              'The reason the payment is pending:
              '  none: No pending reason 
              '  address: The payment is pending because your customer did not include a confirmed shipping address and your Payment Receiving Preferences is set such that you want to manually accept or deny each of these payments. To change your preference, go to the Preferences section of your Profile. 
              '  echeck: The payment is pending because it was made by an eCheck that has not yet cleared. 
              '  intl: The payment is pending because you hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview.       
              '  multi-currency: You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment. 
              '  verify: The payment is pending because you are not yet verified. You must verify your account before you can accept this payment. 
              '  other: The payment is pending for a reason other than those listed above. For more information, contact PayPal customer service. 
              */
              
              $pendingReason  = $resArray["PAYMENTINFO_0_PENDINGREASON"];  

              /*
              'The reason for a reversal if TransactionType is reversal:
              '  none: No reason code 
              '  chargeback: A reversal has occurred on this transaction due to a chargeback by your customer. 
              '  guarantee: A reversal has occurred on this transaction due to your customer triggering a money-back guarantee. 
              '  buyer-complaint: A reversal has occurred on this transaction due to a complaint about the transaction from your customer. 
              '  refund: A reversal has occurred on this transaction because you have given the customer a refund. 
              '  other: A reversal has occurred on this transaction due to a reason not listed above. 
              */            
              $reasonCode     = $resArray["PAYMENTINFO_0_REASONCODE"];

              if($this->session->userdata('plan_slug'))
                { 
                 
                  $buyer_detail = $this->session->userdata('membership_buyer_detail');
                  $plan_slug = $this->session->userdata('plan_slug');
                  $data['detail'] = $this->Common_model->get_row('plans',array('title_slug'=>$plan_slug));
                  $time  = date('Y-m-d h:i:s');  
                  $time2 = date('Y-m-d h:i:s', strtotime(date("Y-m-d h:i:s", strtotime($time))." +".$data['detail']->duration." month"));
                  $order_date = date('Y-m-d H:i:s');
                  $result_array  = array(
                              'user_id'                => user_id(),
                              'email_address'          => $buyer_detail['email'],
                              'first_name'             => $buyer_detail['first_name'],
                              'last_name'              => $buyer_detail['last_name'],
                              'phone'                  => $buyer_detail['contact'],
                              'plan_id'                => $data['detail']->id,
                              //'plan_name'              => $data['detail']->title,
                              //'plan_month'             => $data['detail']->duration,
                              //'plan_start'             => $time,
                              //'plan_end'               => $time2,
                              'plan_amount'            => $data['detail']->amount,
                              //'plan_detail'            => $data['detail']->description,
                              'payment_type'           => 'paypal',
                              'transaction_id'         => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
                              'fee'                    => $resArray['PAYMENTINFO_0_FEEAMT']+$resArray['PAYMENTINFO_0_TAXAMT'],
                              'payment_status'         => $resArray['PAYMENTINFO_0_PAYMENTSTATUS'],
                              'order_date'             => $order_date, 
                              'response'               => json_encode($resArray),
                              //'paypal_transaction_id'  => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
                              //'paypal_user_id'         => $resArray['PAYMENTINFO_0_SECUREMERCHANTACCOUNTID'],
                              //'paypal_payment_status'  => $resArray['PAYMENTINFO_0_PAYMENTSTATUS'],
                              //'paypal_token'           => $resArray['TOKEN'],
                              //'paypal_response'        => json_encode($resArray),
                              //'paypal_fee'             => $resArray['PAYMENTINFO_0_FEEAMT']+$resArray['PAYMENTINFO_0_TAXAMT'],

                                       );
                  $insert_id = $this->Common_model->insert('users_plans_detail',$result_array);
                  $created = date('ymd-His',strtotime($order_date)).'M-'.$insert_id;
                  $this->Common_model->update('users_plans_detail',array('membership_order_id'=>$created),array('id'=>$insert_id));



                  


           // mail to user
                $this->load->library('chapter247_email');
                $email_template=$this->chapter247_email->get_email_template(9);

                $data['type'] ='membership';
                $data['value'] = $this->webs_model->get_plan_order_details($insert_id);
                $data['message'] = $email_template->template_body;

                $html = $this->load->view('website/email',$data,true);
               // echo $html;
                $param = array(
                    'template'  =>  array(
                                    'temp'      =>  $html,
                                    'var_name'  =>  array(
                                                     'user_name'  => ucfirst($data['value']->first_name).' '. ucfirst($data['value']->last_name),
                                                     'email'      => $data['value']->email_address,     
                                                     'contact'    => $data['value']->phone,
                                                        ), 
                                          ),            
                    'email' =>  array(
                                'to'        =>   $data['value']->email_address,
                                'from'      =>   NO_REPLY_EMAIL,
                                'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
                                'subject'   =>   $email_template->template_subject,
                            )
                  );
                $status=$this->chapter247_email->send_mail($param);

                $data['message'] = $email_template->template_body_admin;
                $html = $this->load->view('website/email',$data,true);
                //echo $html;die;
                $admin_param = array(
                    'template'  =>  array(
                                    'temp'      => $html,
                                    'var_name'  => array(
                                                        ), 
                                          ),            
                    'email' =>  array(
                                'to'   => SUPERADMIN_EMAIL,
                                'from'      => NO_REPLY_EMAIL,
                                'from_name' => NO_REPLY_EMAIL_FROM_NAME,
                                'subject'   => $email_template->template_subject_admin,
                            )
                  );
                $status=$this->chapter247_email->send_mail($admin_param);



                  if($this->session->userdata('membership_buyer_detail'))
                  {
                    $this->session->unset_userdata('membership_buyer_detail');
                  }
                  if($this->session->userdata('plan_slug')){
                    $this->session->unset_userdata('plan_slug');
                  }

                  if($this->session->userdata('Payment_Amount')){
                    $this->session->unset_userdata('Payment_Amount');
                  }

                  $this->session->set_flashdata('msg_success', $data['detail']->title.' is added successfully in your account.Your order-id is '.$created.'.');
                  redirect('website/login');
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
              redirect('membership');
              
              /*echo "GetExpressCheckoutDetails API call failed. ";
              echo "Detailed Error Message: " . $ErrorLongMsg;
              echo "Short Error Message: " . $ErrorShortMsg;
              echo "Error Code: " . $ErrorCode;
              echo "Error Severity Code: " . $ErrorSeverityCode;*/
          }
      }
  }

  /*public function confirm()
  {
    $this->session->set_flashdata('msg_success', 'You have successfully purchased.');
    redirect('membership');
  }*/

  public function cancel()
  {
      if($this->session->userdata('membership_buyer_detail'))
      {
        $this->session->unset_userdata('membership_buyer_detail');
      }
      if($this->session->userdata('plan_slug')){
        $this->session->unset_userdata('plan_slug');
      }

      if($this->session->userdata('Payment_Amount')){
        $this->session->unset_userdata('Payment_Amount');
      }
      $this->session->set_flashdata('msg_error','Your transection has been canceled successfully.');
      redirect('membership');
  }

  /*stripe payment methods*/

  public function pay_stripe($plan_slug='')
  { 
      if(!user_logged_in())
      {
          $this->session->set_flashdata('msg_info', 'Please login or sign-up to buy membership plans.');
          redirect('website/login');
      }
      if(empty($plan_slug)) 
        redirect('membership');

      $data['detail'] = $this->Common_model->get_row('plans',array('status' =>1,'title_slug'=>$plan_slug));

      if(!$data['detail'])  
        redirect('membership');

      if(empty($data['detail']->amount)||empty($data['detail']->title_slug)||empty($data['detail']->title)) 
        redirect('membership');
      $data['descrip']      = $data['detail']->title.' Membership Plan';

      $data['amount']       = $_POST['amount'];
      $data['card_number']  = $_POST['card_number'];
      $data['exp_month']    = $_POST['exp_month'];
      $data['exp_year']     = $_POST['exp_year'];
      $data['cvc']          = $_POST['cvc'];



      if(empty($data['amount'])||empty($data['card_number'])||empty($data['exp_month'])||empty($data['exp_year'])||empty($data['cvc']))
        { 
          $this->session->set_flashdata('msg_info', 'Please enter all required fields.');
          redirect('membership');
        }
        /*load stripe library */
        $this->load->library('stripe-php/init');    
        $charge = $this->init->charge($data);
        
        if($charge)
        {       
            $time  = date('Y-m-d h:i:s');  
            $time2 = date('Y-m-d h:i:s', strtotime(date("Y-m-d h:i:s", strtotime($time))." +".$data['detail']->duration." month"));
            if($charge['application_fee']==null) $fee = 0; else $fee = $charge['application_fee'];
            $result_array  = array(
                                'user_id'                       => user_id(),
                                'plan_id'                       => $data['detail']->id,
                                'plan_name'                     => $data['detail']->title,
                                'plan_month'                    => $data['detail']->duration,
                                'plan_start'                    => $time,
                                'plan_end'                      => $time2,
                                'plan_amount'                   => $data['detail']->amount,
                                'plan_detail'                   => $data['detail']->description,
                                'payment_type'                  => 'stripe',
                                'transaction_id'                => $charge['id'],
                                'fee'                           => $fee,
                                'payment_status'                => $charge['status'],
                                'response'                      => json_encode($charge),
                                //'strip_id'                      => $charge['id'],
                                //'strip_balance_transaction_id'  => $charge['balance_transaction'],
                                //'strip_payment_status'          => $charge['status'],
                                //'strip_source_brand'            => $charge['source']->brand,
                                //'strip_response'                => json_encode($charge),
                                //'strip_application_fee'         => $charge['application_fee'],
                                 );
            $this->Common_model->insert('users_plans_detail',$result_array);
            $this->session->set_flashdata('msg_success', $data['descrip'].' is added successfully in your account.');
            redirect('website/profile');
        }
        else
        {
          $this->session->set_flashdata('msg_info', 'There is some error please try again.');
        }
        /*echo "<pre>";
        print_r(json_encode($charge));*/
  }

}

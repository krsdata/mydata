<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//Do your magic here
		$this->load->model('cron_job_model');
	}

	public function index(){
		$this->auto_pay_process();		
	}


	private function get_users_for_auto_pay(){
		$user_info = $this->cron_job_model->get_users_for_pay();
		if ($user_info) {
			return $user_info;
		}else{
			echo "No data";
			die();
		}
	}

	private function auto_pay_process()
	{
		$user_info = $this->get_users_for_auto_pay();
		
		// Set request-specific fields.
		$emailSubject =urlencode('example_email_subject');
		$receiverType = urlencode('EmailAddress');
		$currency = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

		// Add request-specific fields to the request string.
		$nvpStr="&EMAILSUBJECT=$emailSubject&RECEIVERTYPE=$receiverType&CURRENCYCODE=$currency";

		$receiversArray = array();
		$j=0;
	    $commission_info = commission_info();
		foreach ($user_info as $user) {
			//Create Token
			 $key1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
			 $key2 = substr(str_shuffle("0123456789"), 0, 2);
			 $key3 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
	         $uniqueid = date('d').$key1.$key2.$key3.$user->user_id;
	         $payable_amount = $user->unpaid_com - $commission_info->paypal_fee;
			$receiverData = array(	'receiverEmail' => $user->paypal_email,
									'amount' => $payable_amount,
									'uniqueID' => $uniqueid,
									'note' => "Commission_Payment_By_ShirtScore.",
									'userid' => $user->user_id);
			$receiversArray[$j] = $receiverData;
			$j++;
		}
		foreach($receiversArray as $i => $receiverData) {
			$receiverEmail = urlencode($receiverData['receiverEmail']);
			$amount = urlencode($receiverData['amount']);
			$uniqueID = urlencode($receiverData['uniqueID']);
			$note = urlencode($receiverData['note']);
			$nvpStr .= "&L_EMAIL$i=$receiverEmail&L_Amt$i=$amount&L_UNIQUEID$i=$uniqueID&L_NOTE$i=$note";
		}

		// print_r($nvpStr);
		// die();
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = $this->PPHttpPost('MassPay', $nvpStr);

		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
			// exit('MassPay Completed Successfully: '.print_r($httpParsedResponseAr, true));
			$commission_info = commission_info();
			foreach ($user_info as $user) {
				$last_paid = ($user->unpaid_com - $commission_info->paypal_fee);
				$total_paid = ($user->total_paid_com + $user->unpaid_com);
				$data = array('unpaid_com' 				=> 0,
							  'last_paid_com' 			=> $last_paid,
							  'total_paid_com' 			=> $total_paid,
							  'pay_status' 				=> 1,
							  'payment_date' 			=> urldecode($httpParsedResponseAr["TIMESTAMP"])
							  );

				$this->cron_job_model->update('commission_request', $data, array('user_id' => $user->user_id));

				$data = array('user_id' 				=> $user->user_id,
							  'payment_amount' 			=> $last_paid,
							  'pay_status' 				=> 1,
							  'paypal_transaction_id' 	=> urldecode($httpParsedResponseAr["CORRELATIONID"]),
							  'payment_date' 			=> urldecode($httpParsedResponseAr["TIMESTAMP"])
							  );
				$this->cron_job_model->insert('paypal_transaction', $data);
			}
		} else  {
			exit('MassPay failed: ' . print_r($httpParsedResponseAr, true));
		}

		//API Call End
	}

	private function PPHttpPost($methodName_, $nvpStr_) {
			$environment = 'sandbox';	// or 'beta-sandbox' or 'live'
			// global $environment;
			// Set up your API credentials, PayPal end point, and API version.
			$API_UserName = urlencode('ritesh_api1.laeffect.com');
			$API_Password = urlencode('1377521951');
			$API_Signature = urlencode('AAfThrmA0boO83OlJtnonCEAT-QOAa87AOFXA5qcScDj.Fj7UsCZxRKF');
			$API_Endpoint = "https://api-3t.paypal.com/nvp";
			if("sandbox" === $environment || "beta-sandbox" === $environment) {
				$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
			}
			$version = urlencode('51.0');

			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);

			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);

			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

			// Get response from the server.
			$httpResponse = curl_exec($ch);

			if(!$httpResponse) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}

			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);

			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}

			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
			}

			return $httpParsedResponseAr;
		}


















	
	private function send_mail_for_stock(){
		// when product is out of stock or running low
		$query = $this->cron_job_model->get_email_stock_low();
		//print_r($query); //die;		
		$newarray = array();
		if($query){
			foreach($query as $key => $value){
				// echo "<p>".$value['in_stock']."</p>";
 				
 				//$query[$key]['stock'] = $value['in_stock'] - $value['sold'];
 				
 				// echo "<p> OLD ".$query[$key]['stock']."</p>";
 				$total_stock = $value['in_stock']+$value['sales_from_stock'];
 				
 				 $query[$key]['in_stock'] = $total_stock - $value['sold'];

 				//echo "<p>TOTAL stock=$total_stock , SOLD Stock= ".$value['sold'].", IN Stock ".$query[$key]['in_stock']."</p>";
 				
 				$query[$key]['total_stock']=$total_stock;
 				$query[$key]['sold_stock']=$value['sold'];
 				$query[$key]['in_available_stock']=$query[$key]['in_stock'];

 				$query[$key]['low_qty'] = floor(($query[$key]['total_stock'] * 50) / 100); // getting low quantity @30%
 				if( $query[$key]['in_available_stock'] <= $query[$key]['low_qty'] )
 					$newarray[] = $key;
 			}
 			//print_r($newarray);
			$email = array();			
			foreach($newarray as $key){
				$products = array(
							'product_title' =>$query[$key]['name'],
							'size_name' =>$query[$key]['size'],
							'in_available_stock' =>$query[$key]['in_available_stock'],
							'sold_stock' =>$query[$key]['sold_stock'],
							'total_stock' =>$query[$key]['total_stock']
							);
				$email[$query[$key]['id']]['store_title'] = $query[$key]['store_name'];
				$email[$query[$key]['id']]['name'] = $query[$key]['firstname'].' '.$query[$key]['lastname'];
				$email[$query[$key]['id']]['email'] = $query[$key]['email'];
				$email[$query[$key]['id']]['products'][] = $products;
			}
			

			//print_r($email);
			foreach($email as $row){
				//print_r($row);
				/*$config['mailtype'] = 'html';
		    	$this->email->initialize($config);
				$this->email->from('info@bayts.com');
				$this->email->to($row['email']);				
				$this->email->subject('Stock is running low');
				$this->email->message($this->stock_running_low_template($row));				
				$this->email->send();
				echo $this->email->print_debugger();*/

				$this->load->library('smtp_lib/smtp_email');
				$from = array('info@bayts.com' =>'Bayts.com');
				$to = $row['email'];
				$subject = 'Stock is running low on '.date('m/d/Y');
				$html = $this->stock_running_low_template($row);
				$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
				/*if($is_fail){
					echo "Email FAILED.";
				}else{
					echo "Email SEND."; 
				}*/
			}
		}
	}

	private function stock_running_low_template($data){		
				$m = '<table cellpadding="2" cellspacing="2"  border="0">
				<tr>
				  <td > Store Name: '.$data["store_title"] .'</td>
				</tr>
				<tr>
				  <td > Name: '. $data["name"] .'</td>
				</tr>
				<tr>
				  <td >Email: '. $data["email"] .'</td>
				</tr>

				<tr>
				<td> &nbsp;</td>
				</tr>
				</table>
				<table cellpadding="2" cellspacing="2" border="0">
				  <tr>
				      <th align="left">Product Name</th>
				      <th align="right">Size Name</th>
				      <th align="right">Total qty</th>
				      <th align="right">Sold</th>
				      <th align="right">Stock</th>
				  </tr>';

				  foreach($data["products"] as $row):
				 $m .= '<tr>   
				      <td align="left">'.$row["product_title"] .'</td>
				      <td align="right">'.$row["size_name"] .'</td>
				      <td align="right">'. $row["total_stock"] .'</td>
				      <td align="right">'. $row["sold_stock"] .'</td>
				      <td align="right">'. $row["in_available_stock"] .'</td>
				  </tr>';
				 endforeach;

				$m .='</table>';
		return $m;
	}	
}
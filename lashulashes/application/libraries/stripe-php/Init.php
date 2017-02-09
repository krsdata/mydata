<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//include_once dirname(__FILE__).'elFinderConnector.class.php';
	// Stripe singleton
	require(dirname(__FILE__).'/lib/Stripe.php');

	// Utilities
	require(dirname(__FILE__).'/lib/Util/RequestOptions.php');
	require(dirname(__FILE__).'/lib/Util/Set.php');
	require(dirname(__FILE__).'/lib/Util/Util.php');

	// HttpClient
	require(dirname(__FILE__).'/lib/HttpClient/ClientInterface.php');
	require(dirname(__FILE__).'/lib/HttpClient/CurlClient.php');

	// Errors
	require(dirname(__FILE__).'/lib/Error/Base.php');
	require(dirname(__FILE__).'/lib/Error/Api.php');
	require(dirname(__FILE__).'/lib/Error/ApiConnection.php');
	require(dirname(__FILE__).'/lib/Error/Authentication.php');
	require(dirname(__FILE__).'/lib/Error/Card.php');
	require(dirname(__FILE__).'/lib/Error/InvalidRequest.php');
	require(dirname(__FILE__).'/lib/Error/RateLimit.php');

	// Plumbing
	require(dirname(__FILE__).'/lib/ApiResponse.php');
	require(dirname(__FILE__).'/lib/JsonSerializable.php');
	require(dirname(__FILE__).'/lib/StripeObject.php');
	require(dirname(__FILE__).'/lib/ApiRequestor.php');
	require(dirname(__FILE__).'/lib/ApiResource.php');
	require(dirname(__FILE__).'/lib/SingletonApiResource.php');
	require(dirname(__FILE__).'/lib/AttachedObject.php');
	require(dirname(__FILE__).'/lib/ExternalAccount.php');

	// Stripe API Resources
	require(dirname(__FILE__).'/lib/Account.php');
	require(dirname(__FILE__).'/lib/AlipayAccount.php');
	require(dirname(__FILE__).'/lib/ApplicationFee.php');
	require(dirname(__FILE__).'/lib/ApplicationFeeRefund.php');
	require(dirname(__FILE__).'/lib/Balance.php');
	require(dirname(__FILE__).'/lib/BalanceTransaction.php');
	require(dirname(__FILE__).'/lib/BankAccount.php');
	require(dirname(__FILE__).'/lib/BitcoinReceiver.php');
	require(dirname(__FILE__).'/lib/BitcoinTransaction.php');
	require(dirname(__FILE__).'/lib/Card.php');
	require(dirname(__FILE__).'/lib/Charge.php');
	require(dirname(__FILE__).'/lib/Collection.php');
	require(dirname(__FILE__).'/lib/Coupon.php');
	require(dirname(__FILE__).'/lib/Customer.php');
	require(dirname(__FILE__).'/lib/Dispute.php');
	require(dirname(__FILE__).'/lib/Event.php');
	require(dirname(__FILE__).'/lib/FileUpload.php');
	require(dirname(__FILE__).'/lib/Invoice.php');
	require(dirname(__FILE__).'/lib/InvoiceItem.php');
	require(dirname(__FILE__).'/lib/Order.php');
	require(dirname(__FILE__).'/lib/Plan.php');
	require(dirname(__FILE__).'/lib/Product.php');
	require(dirname(__FILE__).'/lib/Recipient.php');
	require(dirname(__FILE__).'/lib/Refund.php');
	require(dirname(__FILE__).'/lib/SKU.php');
	require(dirname(__FILE__).'/lib/Subscription.php');
	require(dirname(__FILE__).'/lib/Token.php');
	require(dirname(__FILE__).'/lib/Transfer.php');
	require(dirname(__FILE__).'/lib/TransferReversal.php');


class Init
{
	public function __construct()
	{
		\Stripe\Stripe::setApiKey('sk_test_kqhSOGciGCjlWKuVj81HQgj7');
		//pk_test_9OfNz8DfhmnWmGPlEBJYUZcm
	}

	public function charge($detail=array())
	{
		/*$myCard = array('number' => '4242424242424242', 'exp_month' => 8, 'exp_year' => 2018);
				$charge = \Stripe\Charge::create(array('card' => $myCard, 'amount' => 2000, 'currency' => 'usd'));
				return $charge;*/
				//tok_17NJmn2eZvKYlo2CthnedrZz


		if(count($detail)>1)
		{
			// $token 		= $detail['token'];
			// $amount 	= $detail['amount'];
			// $descrip 	= $detail['descrip'];

			// if(!empty($token)&&!empty($descrip)&&!empty($amount))
			// {
				/*$myCard = array('number' => '4242424242424242', 'exp_month' => 8, 'exp_year' => 2018);
				$charge = \Stripe\Charge::create(array('card' => $myCard, 'amount' => 2000, 'currency' => 'usd'));
				return $charge;*/

				/*$charge = \Stripe\Charge::create(array("amount"=> $amount*100,"currency"=> "usd","source"=>trim($token),"description" => $descrip));*/

				// Create the charge on Stripe's servers - this will charge the user's card
				$myCard = array(
								'number' 	=> $detail['card_number'], 
								'exp_month' => $detail['exp_month'], 
								'exp_year' 	=> $detail['exp_year'],
								);
				try 
				{
					$charge = \Stripe\Charge::create(
											array(
													"card" 			=> $myCard,
													"amount"		=> $detail['amount']*100, // amount in cents, again
													"currency" 		=> "usd",
													"description" 	=> $detail['descrip']
												)
											);
					return $charge;
				}
				catch(\Stripe\Error\Card $e) 
				{
					// The card has been declined
					//return $e;
					return false;
					//return 'error';
				}
			// }
			// else
			// {
			// 	return false;	
			// }
		}
		else
		{
			return false;
		}

	}
}
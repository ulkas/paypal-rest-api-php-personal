<?php
session_start();
include_once('inc/functions.inc');
require 'inc/rest-api-sdk-php-master/bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Billing;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\ChargeModels;
use PayPal\Api\BillingAgreement;
use PayPal\Api\BillingPlan;
use PayPal\Api\WebProfiles;

$baseUrl = getBaseUrl();
$baseUrl=trim($baseUrl,'/');
if (substr($baseUrl, -11) == 'rewrite.php') $baseUrl = substr($baseUrl, 0, strrpos($baseUrl, '/'));
$baseUrl=trim($baseUrl,'/');
//var_dump($baseUrl);die();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/test.php?success=true")
->setCancelUrl("$baseUrl/test.php?success=false");

$amount = new Amount();
$amount->setCurrency("USD")
->setValue('39');

$amount2 = new Amount();
$amount2->setCurrency('USD')
->setValue('1');

$charge = new ChargeModels();
$charge->setType('SHIPPING')
->setamount($amount2);
$charge2 = new ChargeModels();
$charge2->setType('TAX')
->setamount($amount2);

$definition = new PaymentDefinition();
$definition->setName('regular payments')
->setType('REGULAR')
->setfrequency_interval('1')
->setfrequency('MONTH')
//->setcycles('12')
->setamount($amount);
//->setcharge_models(array($charge, $charge2));


$preferences = new MerchantPreferences();
$preferences->setcancel_url($redirectUrls->getCancelUrl())
->setreturn_url($redirectUrls->getReturnUrl())
->setauto_bill_amount('YES');
// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$billing = new BillingPlan();
$billing->setName('testing bill')
->setDescription('testing bill for testing billing plan for recurring payments')
->setType('INFINITE')
->setPayment_definitions(array($definition))
->setMerchant_preferences($preferences);
//->setExperience_profile_id('XP-MZ5R-MNFT-LXZ8-EHD3');

// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
try {
	$billing->create($apiContext);
} catch (PayPal\Exception\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}


$list = Billing::getList($apiContext);
r($list);
r($billing->getId());
r($billing->activate($apiContext));

$payer = new Payer();
$payer->setPayment_method('paypal');

$plan = new BillingPlan();
$plan->setId($billing->getId());

$agreement = new BillingAgreement();
$agreement->setName('test agreement')
->setDescription('test agreement description')
->setStart_date(gmdate("Y-m-d\TH:i:s\Z", time()+3600))
->setPayer($payer)
->setPlan($plan);

try {
	$agreement->create($apiContext);
} catch (PayPal\Exception\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}
foreach ($agreement->getLinks() as $link){
	r($link->getHref());
	r($link->getRel());
}


$profile = new WebProfiles();
$profile->setName('test web profile2');
try {
	$tmp = $profile->create($apiContext);
	r($tmp->getId());
} catch (PayPal\Exception\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());
	exit(1);
}
// ### Redirect buyer to PayPal website
// Save the payment id so that you can 'complete' the payment
// once the buyer approves the payment and is redirected
// back to your website.
//
// It is not a great idea to store the payment id
// in the session. In a real world app, you may want to
// store the payment id in a database.

if(isset($redirectUrl)) {
//	header("Location: $redirectUrl");
//	exit;
}

//--------------

?>
<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Api\PatchRequest;
use PayPal\Transport\PPRestCall;
use PayPal\Api\Dummy;


class BillingAgreement extends PPModel implements IResource
{
	/**
	 * Get Links
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	/**
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	public function getState() {
		return $this->state;
	}
	public function setDescription($description)
	{
		$this->description = $description;
	
		return $this;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function setStart_date($start_date)
	{
		$this->start_date = $start_date;
	
		return $this;
	}
	public function getStart_date()
	{
		return $this->start_date;
	}
	public function setPayer($payer)
	{
		$this->payer = $payer;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\Payer
	 */
	public function getPayer()
	{
		return $this->payer;
	}
	public function setShipping_address($shipping_address)
	{
		$this->shipping_address = $shipping_address;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\Address
	 */
	public function getShipping_address()
	{
		return $this->shipping_address;
	}


    public function setOverride_merchant_preferences($override_merchant_preferences)
    {
        $this->override_merchant_preferences = $override_merchant_preferences;

        return $this;
    }

    /**
     * Get Links
     *
     * @return \PayPal\Api\MerchantPreferences
     */
    public function getOverride_merchant_preferences()
    {
        return $this->override_merchant_preferences;
    }
    
    public function setOverride_charge_models($override_charge_models)
    {
    	$this->override_charge_models = $override_charge_models;
    
    	return $this;
    }
    
    /**
     * Get Links
     *
     * @return \PayPal\Api\OverrideChargeModels
     */
    public function getOverride_charge_models()
    {
    	return $this->override_charge_models;
    }
    public function setPlan($plan)
    {
    	$this->plan = $plan;
    
    	return $this;
    }
    
    /**
     * Get Links
     *
     * @return \PayPal\Api\BillingPlan
     */
    public function getPlan()
    {
    	return $this->plan;
    }
    public function setCreate_time($create_time)
    {
    	$this->create_time = $create_time;
    
    	return $this;
    }
    
    public function getCreate_time()
    {
    	return $this->create_time;
    }
    public function setUpdate_time($update_time)
    {
    	$this->update_time = $update_time;
    
    	return $this;
    }
    
    public function getUpdate_time()
    {
    	return $this->update_time;
    }
    public function setLinks($links)
    {
    	$this->links = $links;
    
    	return $this;
    }
    /**
     * Get Links
     *
     * @return \PayPal\Api\Links
     */
    public function getLinks()
    {
    	return $this->links;
    }
    


    /**
     * Create
     *
     * @param \PayPal\Rest\ApiContext|null $apiContext
     *
     * @return $this
     */
    public function create($apiContext = null)
    {
        $payLoad = $this->toJSON();

        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }

        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/billing-agreements", "POST", $payLoad);
        $this->fromJson($json);

        return $this;
    }

    /**
     * Get
     *
     * @param int                          $paymentId
     * @param \PayPal\Rest\ApiContext|null $apiContext
     *
     * @return Payment
     * @throws \InvalidArgumentException
     */
    public static function get($paymentId, $apiContext = null)
    {
        if (($paymentId == null) || (strlen($paymentId) <= 0)) {
            throw new \InvalidArgumentException("paymentId cannot be null or empty");
        }

        $payLoad = "";

        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }

        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/billing-plans/$paymentId", "GET", $payLoad);

        $ret = new Billing();
        $ret->fromJson($json);

        return $ret;
    }
    /**
     * Get
     *
     * @param int                          $paymentId
     * @param \PayPal\Rest\ApiContext|null $apiContext
     *
     * @return Payment
     *
     */
    public static function getList($apiContext = null)
    {

    
    	$payLoad = "";
    
    	if ($apiContext == null) {
    		$apiContext = new ApiContext(self::$credential);
    	}
    
    	$call = new PPRestCall($apiContext);
    	$json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/billing-plans", "GET", $payLoad);
    	$json = json_decode($json);
    	$return = array();
    	
    	foreach ($json->plans as $plan) {
    		$ret = new Billing();
    		$ret->fromJson(json_encode($plan));
    		$return[] = $ret;
    	}
    	
    	return $return;
    }
    /**
     * Get
     *
     * @param int                          $paymentId
     * @param \PayPal\Rest\ApiContext|null $apiContext
     *
     * @return Payment
     *
     */
    public function remove($apiContext = null)
    {
    	$id = $this->getId();
    
    	$payLoad = new PatchRequest();
    	$value = new Dummy();
    	$value->setState('INACTIVE');
    	$payLoad->setOp('remove')
    	->setPath('/')
    	->setValue($value);
    	//->setFrom('/');
    	$payLoad = $payLoad->toJSON();
    	$payLoad = '['.$payLoad.']';
    	r($payLoad);
    
    	if ($apiContext == null) {
    		$apiContext = new ApiContext(self::$credential);
    	}
    
    	$call = new PPRestCall($apiContext);
    	
    	$json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/billing-plans/" . $id, "PATCH", $payLoad);
    	
    	
    	 
    	return $return;
    }
    public function activate($apiContext = null)
    {
    	$id = $this->getId();
    
    	$payLoad = new PatchRequest();
    	$value = new Dummy();
    	$value->setState('ACTIVE');
    	$payLoad->setOp('replace')
    	->setPath('/')
    	->setValue($value);
    	//->setFrom('/');
    	$payLoad = $payLoad->toJSON();
    	$payLoad = '['.$payLoad.']';
    	r($payLoad);
    
    	if ($apiContext == null) {
    		$apiContext = new ApiContext(self::$credential);
    	}
    
    	$call = new PPRestCall($apiContext);
    	 
    	$json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/billing-plans/" . $id, "PATCH", $payLoad);    	 
    
    	return true;
    }

    /**
     * All
     *
     * @param array                        $params
     * @param \PayPal\Rest\ApiContext|null $apiContext
     *
     * @return PaymentHistory
     * @throws \InvalidArgumentException
     */
    public static function all($params, $apiContext = null)
    {
        if (($params == null)) {
            throw new \InvalidArgumentException("params cannot be null or empty");
        }

        $payLoad = "";

        $allowedParams = array(
            'name'       => 1,
            'description'    => 1,
            'type' => 1,
            'payment_definitions'  => 1,
            'merchant_preferences'    => 1,
            'links'    => 1,
        );

        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }

        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/payment?" . http_build_query(array_intersect_key($params, $allowedParams)), "GET", $payLoad);

        $ret = new PaymentHistory();
        $ret->fromJson($json);

        return $ret;
    }
}
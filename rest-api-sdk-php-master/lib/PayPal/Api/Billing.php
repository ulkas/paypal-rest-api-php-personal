<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Api\PatchRequest;
use PayPal\Transport\PPRestCall;
use PayPal\Api\Dummy;


class Billing extends PPModel implements IResource
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
	public function setType($type)
	{
		$this->type = $type;
	
		return $this;
	}
	public function getType()
	{
		return $this->type;
	}
	public function setPayment_definitions($payment_definitions)
	{
		$this->payment_definitions = $payment_definitions;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\PaymentDefinition
	 */
	public function getPayment_definitions()
	{
		return $this->payment_definitions;
	}
	public function setMerchant_preferences($merchant_preferences)
	{
		$this->merchant_preferences = $merchant_preferences;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\MerchantPreferences
	 */
	public function getMerchant_preferences()
	{
		return $this->merchant_preferences;
	}

    /**
     * Set Links
     *
     * @param \PayPal\Api\Links $links
     *
     * @return $this
     */
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
    
    public function setExperience_profile_id($experience_profile_id) {
    	$this->experience_profile_id = $experience_profile_id;
    	return $this;
    }
    public function getExperience_profile_id(){
    	return $this->experience_profile_id;
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
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/billing-plans", "POST", $payLoad);
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
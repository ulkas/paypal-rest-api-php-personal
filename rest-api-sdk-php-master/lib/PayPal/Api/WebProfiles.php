<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;
use PayPal\Api\FlowConfig;
use PayPal\Api\InputFields;
use PayPal\Api\Presentation;
use PayPal\Api\CreateProfileResponse;


class WebProfiles extends PPModel
{
	
	public function setId($id)
	{
		$this->id = $id;
	
		return $this;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setFlow_config($flow_config)
	{
		$this->flow_config = $flow_config;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\FlowConfig
	 */
	public function getFlow_config()
	{
		return $this->flow_config;
	}	
	public function setInput_fields($input_fields)
	{
		$this->input_fields = $input_fields;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\InputFields
	 */
	public function getInput_fields()
	{
		return $this->input_fields;
	}	
	public function setPresentation($presentation)
	{
		$this->presentation = $presentation;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\Presentation
	 */
	public function getPresentation()
	{
		return $this->presentation;
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
		$json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payment-experience/web-profiles", "POST", $payLoad);
		$return = new CreateProfileResponse();
		$return->fromJson($json);
	
		return $return;
	}

}
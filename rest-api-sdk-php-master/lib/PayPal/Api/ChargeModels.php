<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class ChargeModels extends PPModel
{
	
	public function setType($type)
	{
		$this->type = $type;
	
		return $this;
	}
	public function getType()
	{
		return $this->type;
	}
	public function setamount($amount)
	{
		$this->amount = $amount;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\Amount
	 */
	public function getAmount()
	{
		return $this->amount;
	}


}
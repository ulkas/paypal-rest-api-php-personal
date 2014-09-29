<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\Currency;
use PayPal\Transport\PPRestCall;


class OverrideChargeModels extends PPModel
{
	
	public function setCharge_id($charge_id)
	{
		$this->charge_id = $charge_id;
	
		return $this;
	}
	public function getCharge_id()
	{
		return $this->charge_id;
	}
	public function setAmount($amount)
	{
		$this->amount = $amount;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\Currency
	 */
	public function getAmount()
	{
		return $this->amount;
	}


}
<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class PaymentDefinition extends PPModel
{
	
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	public function getName()
	{
		return $this->name;
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
	public function setfrequency_interval($frequency_interval)
	{
		$this->frequency_interval = $frequency_interval;
	
		return $this;
	}
	public function getfrequency_interval()
	{
		return $this->frequency_interval;
	}
	public function setfrequency($frequency)
	{
		$this->frequency = $frequency;
	
		return $this;
	}
	public function getfrequency()
	{
		return $this->frequency;
	}
	public function setcycles($cycles)
	{
		$this->cycles = $cycles;
	
		return $this;
	}
	public function getcycles()
	{
		return $this->cycles;
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
	public function setcharge_models($charge_models)
	{
		$this->charge_models = $charge_models;
	
		return $this;
	}
	/**
	 * @return \PayPal\Api\ChargeModels
	 */
	public function getCharge_models()
	{
		return $this->charge_models;
	}

}
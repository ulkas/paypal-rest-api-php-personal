<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class Dummy extends PPModel
{
	
	public function setState($state)
	{
		$this->state = $state;
	
		return $this;
	}
	public function getState()
	{
		return $this->state;
	}

}
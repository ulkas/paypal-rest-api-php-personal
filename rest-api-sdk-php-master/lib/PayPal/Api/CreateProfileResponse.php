<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class CreateProfileResponse extends PPModel
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

}
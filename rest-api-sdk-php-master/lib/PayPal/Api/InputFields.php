<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class InputFields extends PPModel
{
	
	public function setAllow_note($allow_note)
	{
		$this->allow_note = $allow_note;
	
		return $this;
	}
	public function getAllow_note()
	{
		return $this->allow_note;
	}
	public function setNo_shipping($no_shipping)
	{
		$this->no_shipping = $no_shipping;
	
		return $this;
	}
	public function getNo_shipping()
	{
		return $this->no_shipping;
	}
	public function setAddress_override($address_override)
	{
		$this->address_override = $address_override;
	
		return $this;
	}
	public function getAddress_override()
	{
		return $this->address_override;
	}


}
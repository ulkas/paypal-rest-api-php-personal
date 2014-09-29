<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class PatchRequest extends PPModel
{
	
	public function setOp($op)
	{
		$this->op = $op;
	
		return $this;
	}
	public function getOp()
	{
		return $this->op;
	}
	public function setPath($path)
	{
		$this->path = $path;
	
		return $this;
	}
	public function getPath()
	{
		return $this->path;
	}
	public function setValue($value)
	{
		$this->value = $value;
	
		return $this;
	}
	public function getValue()
	{
		return $this->value;
	}

	public function setFrom($from) {
		$this->from = $from;
		return $this;
	}
	public function getFrom()
	{
		return $this->from;
	}

}
<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class Presentation extends PPModel
{
	
	public function setBrand_name($brand_name)
	{
		$this->brand_name = $brand_name;
	
		return $this;
	}
	public function getBrand_name()
	{
		return $this->brand_name;
	}
	public function setLogo_image($logo_image)
	{
		$this->logo_image = $logo_image;
	
		return $this;
	}
	public function getLogo_image()
	{
		return $this->logo_image;
	}
	public function setLocale_code($locale_code)
	{
		$this->locale_code = $locale_code;
	
		return $this;
	}
	public function getLocale_code()
	{
		return $this->locale_code;
	}


}
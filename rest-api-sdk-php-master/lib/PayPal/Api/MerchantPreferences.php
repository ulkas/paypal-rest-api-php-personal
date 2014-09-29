<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class MerchantPreferences extends PPModel
{
	
	public function setcancel_url($cancel_url)
	{
		$this->cancel_url = $cancel_url;
	
		return $this;
	}
	public function getcancel_url()
	{
		return $this->cancel_url;
	}
	public function setreturn_url($return_url)
	{
		$this->return_url = $return_url;
	
		return $this;
	}
	public function getreturn_url()
	{
		return $this->return_url;
	}
	public function setauto_bill_amount($auto_bill_amount)
	{
		$this->auto_bill_amount = $auto_bill_amount;
	
		return $this;
	}
	public function getauto_bill_amount()
	{
		return $this->auto_bill_amount;
	}
	/**
	 * @return \PayPal\Api\Amount
	 */
	public function getSetupFee() {
		return $this->setup_fee;
	}

}
<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\PaymentHistory;
use PayPal\Transport\PPRestCall;


class FlowConfig extends PPModel
{
	
	public function setLanding_page_type($landing_page_type)
	{
		$this->landing_page_type = $landing_page_type;
	
		return $this;
	}
	public function getLanding_page_type()
	{
		return $this->landing_page_type;
	}
	public function setBank_txn_pending_url($bank_txn_pending_url)
	{
		$this->bank_txn_pending_url = $bank_txn_pending_url;
	
		return $this;
	}
	public function getBank_txn_pending_url()
	{
		return $this->bank_txn_pending_url;
	}
	

}
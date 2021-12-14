<?php

namespace Strategy;

use Event\EventBus;

class PurchaseServiceContext
{
	public static function purchase(PurchaseStrategy $strategy): \Entity\Service
	{
		$service = $strategy->purchase();

		EventBus::getInstance()->publish("onServicePurchase", $service);

		return $service;
	}
}
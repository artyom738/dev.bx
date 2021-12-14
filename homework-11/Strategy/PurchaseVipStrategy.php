<?php

namespace Strategy;

use Entity\Service;

class PurchaseVipStrategy implements PurchaseStrategy
{

	public function purchase(): Service
	{
		// take money
		$service = new Service();

		$service->setActivatedUntil((new \DateTime())->modify("+ 14 days"));
		$service->setType(Service::TYPES['vip']);
		return $service;
	}
}